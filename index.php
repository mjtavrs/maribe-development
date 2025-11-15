<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (index tem layout especial, não usa o header padrão)
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

    <!-- Scripts -->
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/languageSelector.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <main>
            <img src="/assets/images/svg/3840x2160.svg" aria-hidden="true" id="maribeDesktopBackground">
            <img src="/assets/images/public/logo_home.webp" alt="Logo da Maribe Arquitetura" id="maribeLogo">
            <nav>
                <ul>
                    <li><a href="<?php echo function_exists('url') ? url('sobre', $currentLang) : 'sobre.php'; ?>"><?php echo function_exists('t') ? htmlspecialchars(t('menu.about'), ENT_QUOTES, 'UTF-8') : 'sobre'; ?></a></li>
                    <li><a href="<?php echo function_exists('url') ? url('projetos', $currentLang) : 'projetos.php'; ?>"><?php echo function_exists('t') ? htmlspecialchars(t('menu.projects'), ENT_QUOTES, 'UTF-8') : 'projetos'; ?></a></li>
                    <li><a href="<?php echo function_exists('url') ? url('orcamento', $currentLang) : 'orcamento.php'; ?>"><?php echo function_exists('t') ? htmlspecialchars(t('menu.budget'), ENT_QUOTES, 'UTF-8') : 'orçamento'; ?></a></li>
                    <li><a href="<?php echo function_exists('url') ? url('contato', $currentLang) : 'contato.php'; ?>"><?php echo function_exists('t') ? htmlspecialchars(t('menu.contact'), ENT_QUOTES, 'UTF-8') : 'contato'; ?></a></li>
                </ul>
            </nav>
        </main>
    </div>
</body>

</html>