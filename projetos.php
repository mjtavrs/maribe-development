<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header
$currentPage = 'projetos';
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
    <meta name="description" content="<?php echo htmlspecialchars(t('projects.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="keywords" content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <title><?php echo htmlspecialchars(t('projects.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />
    <link rel="stylesheet" href="/styles/pages/projects/projects.css" />

    <!-- Scripts -->
    <script src="/src/js/languageSelector.js"></script>
    <script type="module" src="/src/js/projectsSearch.js" defer></script>
    <script type="module" src="/src/js/projectsInjector.js" defer></script>
    <script src="/src/js/cookiePopup.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('projects.title');
            $pageDescription = t('projects.description');
            include 'includes/pageInfo.php';
            ?>
            <div id="projectsSearchContainer">
                <div id="projectsSearchWrapper">
                    <i class="ph ph-regular ph-magnifying-glass" id="searchIcon"></i>
                    <input 
                        type="text" 
                        id="projectsSearchInput" 
                        placeholder="<?php echo htmlspecialchars(t('projects.searchPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        aria-label="<?php echo htmlspecialchars(t('projects.searchPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                    >
                    <span id="searchKeyboardHelper" class="search-helper"></span>
                </div>
            </div>
            <div id="projectsContainer" role="list" aria-live="polite"></div>
            <div id="noResultsMessage" class="no-results-hidden" aria-live="polite" aria-atomic="true">
                <div class="no-results-icon-wrapper">
                    <i class="ph ph-regular ph-magnifying-glass" aria-hidden="true"></i>
                    <i class="ph ph-regular ph-question-mark question-icon question-icon-1" aria-hidden="true"></i>
                    <i class="ph ph-regular ph-question-mark question-icon question-icon-2" aria-hidden="true"></i>
                    <i class="ph ph-regular ph-question-mark question-icon question-icon-3" aria-hidden="true"></i>
                    <i class="ph ph-regular ph-question-mark question-icon question-icon-4" aria-hidden="true"></i>
                </div>
                <p class="no-results-text"><?php echo t('projects.noResultsMessage'); ?></p>
                <a href="<?php echo htmlspecialchars(url('orcamento', $currentLang), ENT_QUOTES, 'UTF-8'); ?>" class="no-results-button">
                    <?php echo htmlspecialchars(t('projects.requestBudget'), ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>