<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header
$currentPage = 'home';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="Maribe Arquitetura é um escritório de arquitetura e urbanismo baseado em Recife, Pernambuco, com foco em arquitetura residencial, comercial e consultorias." />
    <meta name="keywords" content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <title>home • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />
    <link rel="stylesheet" href="/styles/pages/home/home.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />

    <!-- Scripts -->
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/languageSelector.js"></script>
    <script src="/src/js/homeScroll.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <main>
            <!-- Hero Section -->
            <section id="heroSection">
                <img src="/assets/images/svg/4k_without_logo.svg" aria-hidden="true" id="maribeDesktopBackground">
                <div id="heroContent">
                    <img src="/assets/images/public/logo_home.webp" alt="Logo da Maribe Arquitetura" id="maribeLogo">
                    <a href="/<?php echo $currentLang; ?>/<?php echo $currentLang === 'en' ? 'about' : 'sobre'; ?>" id="scrollIndicator" aria-label="Ir para a página Sobre">
                        <i class="ph ph-regular ph-caret-down" aria-hidden="true"></i>
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>

</html>