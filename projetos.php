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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('projects.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="keywords" content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <?php
    // Open Graph Meta Tags
    require_once __DIR__ . '/src/php/openGraph.php';
    $pageTitle = t('projects.title') . ' • maribe arquitetura';
    echo generateOpenGraphTags($pageTitle, t('projects.metaDescription'), 'assets/images/public/logo_home.webp');
    
    // Canonical URL
    echo generateCanonicalTag();
    ?>

    <title><?php echo htmlspecialchars(t('projects.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/scrollbar.css" />
    <link rel="stylesheet" href="/styles/shared/header.css" />
    <link rel="stylesheet" href="/styles/shared/footer.css" />
    <link rel="stylesheet" href="/styles/shared/pageInfo.css" />
    <link rel="stylesheet" href="/styles/shared/separator.css" />
    <link rel="stylesheet" href="/styles/shared/cookiePopup.css" />
    <link rel="stylesheet" href="/styles/shared/forms.css" />
    <link rel="stylesheet" href="/styles/shared/toast.css" />
    <link rel="stylesheet" href="/styles/shared/scrollToTop.css" />
    <link rel="stylesheet" href="/styles/shared/contractDataExplanation.css" />
    <link rel="stylesheet" href="/styles/pages/projects/projects.css" />

    <!-- Scripts -->
    <script>
        // Passa as traduções de alt text para o JavaScript
        window.altTextTranslations = {
            pt: {
                projectCover: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['altText']['projectCover'] ?? 'Capa do projeto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectCoverWithCity: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['altText']['projectCoverWithCity'] ?? 'Capa do projeto :title em :city', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImage: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['altText']['projectImage'] ?? 'Imagem do projeto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImageNumber: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['altText']['projectImageNumber'] ?? 'Imagem :number de :total do projeto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            en: {
                projectCover: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['altText']['projectCover'] ?? 'Cover of project :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectCoverWithCity: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['altText']['projectCoverWithCity'] ?? 'Cover of project :title in :city', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImage: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['altText']['projectImage'] ?? 'Image of project :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImageNumber: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['altText']['projectImageNumber'] ?? 'Image :number of :total of project :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            es: {
                projectCover: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['altText']['projectCover'] ?? 'Portada del proyecto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectCoverWithCity: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['altText']['projectCoverWithCity'] ?? 'Portada del proyecto :title en :city', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImage: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['altText']['projectImage'] ?? 'Imagen del proyecto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                projectImageNumber: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['altText']['projectImageNumber'] ?? 'Imagen :number de :total del proyecto :title', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            }
        };
    </script>
    <script src="/src/js/languageSelector.js"></script>
    <script type="module" src="/src/js/projectsFilters.js" defer></script>
    <script type="module" src="/src/js/projectsSearch.js" defer></script>
    <script type="module" src="/src/js/projectsInjector.js" defer></script>
    <script src="/src/js/cookiePopup.js"></script>
    
    <?php
    // Schema.org JSON-LD
    echo generateLocalBusinessSchema($currentLang);
    echo generateWebSiteSchema($currentLang);
    
    // Breadcrumb Schema
    $breadcrumbs = [
        ['name' => function_exists('t') ? t('menu.home') : 'início', 'url' => url('index', $currentLang)],
        ['name' => function_exists('t') ? t('projects.title') : 'projetos', 'url' => url('projetos', $currentLang)]
    ];
    echo generateBreadcrumbSchema($breadcrumbs);
    ?>
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
                        data-placeholder-desktop="<?php echo htmlspecialchars(t('projects.searchPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        data-placeholder-mobile="<?php echo htmlspecialchars(t('projects.searchPlaceholderMobile'), ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="<?php echo htmlspecialchars(t('projects.searchPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        aria-label="<?php echo htmlspecialchars(t('projects.searchPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                    >
                    <span id="searchKeyboardHelper" class="search-helper"></span>
                </div>
                <div id="projectsFilters" role="group" aria-label="<?php echo htmlspecialchars(t('projects.filtersLabel', 'Filtros de projetos'), ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="button" class="filter-button active" data-filter="todos" aria-pressed="true">
                        <?php echo htmlspecialchars(t('projects.filterAll', 'todos'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                    <button type="button" class="filter-button" data-filter="residencial" aria-pressed="false">
                        <?php echo htmlspecialchars(t('projects.filterResidential', 'residencial'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                    <button type="button" class="filter-button" data-filter="comercial" aria-pressed="false">
                        <?php echo htmlspecialchars(t('projects.filterCommercial', 'comercial'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                </div>
            </div>
            <h2 id="projectsListHeading" class="visually-hidden"><?php echo htmlspecialchars(t('projects.listHeading', 'Lista de projetos'), ENT_QUOTES, 'UTF-8'); ?></h2>
            <div id="projectsContainer" role="list" aria-labelledby="projectsListHeading" aria-live="polite"></div>
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
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>