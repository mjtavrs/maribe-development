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
                            <div id="logosGrid">
                                <!-- Linha superior: 3 logos horizontais -->
                                <div class="logo-item horizontal-top">
                                    <img src="/assets/images/public/logos/logo_horizontal.webp" alt="Logo horizontal Maribe">
                                </div>
                                <div class="logo-item horizontal-top">
                                    <img src="/assets/images/public/logos/logo_horizontal_com_assinatura.webp" alt="Logo horizontal com assinatura Maribe">
                                </div>
                                <div class="logo-item horizontal-top">
                                    <img src="/assets/images/public/logos/logo_horizontal_estendida.webp" alt="Logo horizontal estendida Maribe">
                                </div>
                                
                                <!-- Logo ao lado esquerdo -->
                                <div class="logo-item around-logo around-left">
                                    <img src="/assets/images/public/logos/simbolo.webp" alt="Símbolo Maribe">
                                </div>
                                
                                <!-- Logo vertical centralizada -->
                                <div class="logo-item vertical-center">
                                    <img src="/assets/images/public/logos/logo_vertical.webp" alt="Logo vertical Maribe">
                                </div>
                                
                                <!-- Logo ao lado direito -->
                                <div class="logo-item around-logo around-right">
                                    <img src="/assets/images/public/logos/simbolo_reduzido.webp" alt="Símbolo reduzido Maribe">
                                </div>
                                
                                <!-- Logo embaixo -->
                                <div class="logo-item around-logo around-bottom">
                                    <img src="/assets/images/public/logos/submark.webp" alt="Submark Maribe">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>