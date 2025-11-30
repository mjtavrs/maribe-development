<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header
$currentPage = 'sobre';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('about.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="keywords" content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <title><?php echo htmlspecialchars(t('about.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />
    <link rel="stylesheet" href="/styles/pages/about/about.css" />

    <!-- Scripts -->
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/languageSelector.js"></script>
    <script>
        // Garante loop suave sem flash preto
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('logoHistoryVideo');
            if (video) {
                let isSeeking = false;
                
                // Previne flash preto no loop - reinicia ANTES de chegar ao fim
                video.addEventListener('timeupdate', function() {
                    // Se estiver muito próximo do fim (últimos 0.2 segundos), volta para o início
                    if (!isSeeking && video.duration && video.currentTime >= video.duration - 0.2) {
                        isSeeking = true;
                        video.currentTime = 0;
                        // Pequeno delay para garantir que o seek foi processado
                        setTimeout(function() {
                            isSeeking = false;
                        }, 50);
                    }
                });
                
                // Garante que o vídeo sempre esteja pronto para loop
                video.addEventListener('ended', function() {
                    isSeeking = true;
                    video.currentTime = 0;
                    video.play().catch(function(error) {
                        // Ignora erros de autoplay
                        console.log('Autoplay bloqueado:', error);
                    });
                    setTimeout(function() {
                        isSeeking = false;
                    }, 50);
                });
                
                // Força play se pausar (pode acontecer em alguns navegadores)
                video.addEventListener('pause', function() {
                    if (document.visibilityState === 'visible' && !isSeeking) {
                        video.play().catch(function(error) {
                            console.log('Play bloqueado:', error);
                        });
                    }
                });
                
                // Garante que o vídeo carregue completamente antes de começar
                video.addEventListener('loadeddata', function() {
                    video.play().catch(function(error) {
                        console.log('Autoplay inicial bloqueado:', error);
                    });
                });
            }
        });
    </script>

</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('about.title');
            include 'includes/pageInfo.php';
            ?>
            <div id="sectionsContainer">
                <section>
                    <h2><?php echo htmlspecialchars(t('about.aboutUs'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div id="aboutContentWrapper">
                        <div id="aboutTextContent">
                            <p id="aboutIntroText">
                                <?php echo t('about.description'); ?>
                            </p>
                            <div>
                                <h3><?php echo htmlspecialchars(t('about.heloisa.name'), ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p>
                                    <?php echo t('about.heloisa.description'); ?>
                                </p>
                            </div>
                            <div>
                                <h3><?php echo htmlspecialchars(t('about.nathalia.name'), ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p>
                                    <?php echo t('about.nathalia.description'); ?>
                                </p>
                            </div>
                            <p>
                                <?php echo t('about.together'); ?>
                            </p>
                        </div>
                        <div id="imageContainer">
                            <img src="/assets/images/public/meninas_foto_sem_bg.webp" alt="Foto de Nathalia Ribeiro e Heloisa Marletti">
                            <div id="orangeBox">
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <h2><?php echo htmlspecialchars(t('about.ourSymbol'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div id="symbolContentWrapper">
                        <div id="symbolTextContent">
                            <p>
                                <?php echo t('about.symbolDescription1'); ?>
                            </p>
                            <p>
                                <?php echo t('about.symbolDescription2'); ?>
                            </p>
                            <p>
                                <?php echo t('about.symbolDescription3'); ?>
                            </p>
                        </div>
                        <div id="logosContainer">
                            <video
                                id="logoHistoryVideo"
                                autoplay
                                loop
                                muted
                                playsinline
                                preload="auto"
                                poster="/assets/images/public/logos/logo_vertical.webp"
                                aria-label="História da evolução do logo Maribe Arquitetura"
                            >
                                <source src="/assets/videos/logoHistorySquared.webm" type="video/webm" />
                            </video>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>