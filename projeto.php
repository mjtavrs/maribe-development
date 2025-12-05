<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Força o recarregamento das traduções para garantir que o idioma correto seja usado
// Isso é necessário porque a função t() pode ter carregado traduções de um idioma anterior
global $translations;
$translations = loadTranslations($currentLang);

// Define a página atual para o header
// Se houver parâmetros de projeto na URL, usa 'projeto', senão 'projetos'
$hasProjectParams = isset($_GET['name']) || isset($_GET['id']);
$currentPage = $hasProjectParams ? 'projeto' : 'projetos';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />

    <!-- Title will be dynamically inputed by the selectedProject.js script -->
    <title></title>
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
    <link rel="stylesheet" href="/styles/shared/lightbox.css" />
    <link rel="stylesheet" href="/styles/pages/project/project.css" />

    <!-- Scripts -->
    <script>
        // Passa as traduções de compartilhamento para o JavaScript
        window.shareTranslations = {
            pt: {
                whatsAppMessage: <?php 
                    $translations = loadTranslations('pt');
                    $template = isset($translations['projects']['detail']['shareWhatsAppMessage']) 
                        ? $translations['projects']['detail']['shareWhatsAppMessage'] 
                        : 'Confira este projeto: :title - :url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailSubject: <?php 
                    $translations = loadTranslations('pt');
                    $template = isset($translations['projects']['detail']['shareEmailSubject']) 
                        ? $translations['projects']['detail']['shareEmailSubject'] 
                        : 'Projeto: :title';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailBody: <?php 
                    $translations = loadTranslations('pt');
                    $template = isset($translations['projects']['detail']['shareEmailBody']) 
                        ? $translations['projects']['detail']['shareEmailBody'] 
                        : 'Confira este projeto da maribe arquitetura:\n\n:title\n:description\n\n:url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            en: {
                whatsAppMessage: <?php 
                    $translations = loadTranslations('en');
                    $template = isset($translations['projects']['detail']['shareWhatsAppMessage']) 
                        ? $translations['projects']['detail']['shareWhatsAppMessage'] 
                        : 'Check out this project: :title - :url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailSubject: <?php 
                    $translations = loadTranslations('en');
                    $template = isset($translations['projects']['detail']['shareEmailSubject']) 
                        ? $translations['projects']['detail']['shareEmailSubject'] 
                        : 'Project: :title';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailBody: <?php 
                    $translations = loadTranslations('en');
                    $template = isset($translations['projects']['detail']['shareEmailBody']) 
                        ? $translations['projects']['detail']['shareEmailBody'] 
                        : 'Check out this project from maribe arquitetura:\n\n:title\n:description\n\n:url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            es: {
                whatsAppMessage: <?php 
                    $translations = loadTranslations('es');
                    $template = isset($translations['projects']['detail']['shareWhatsAppMessage']) 
                        ? $translations['projects']['detail']['shareWhatsAppMessage'] 
                        : 'Mira este proyecto: :title - :url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailSubject: <?php 
                    $translations = loadTranslations('es');
                    $template = isset($translations['projects']['detail']['shareEmailSubject']) 
                        ? $translations['projects']['detail']['shareEmailSubject'] 
                        : 'Proyecto: :title';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                emailBody: <?php 
                    $translations = loadTranslations('es');
                    $template = isset($translations['projects']['detail']['shareEmailBody']) 
                        ? $translations['projects']['detail']['shareEmailBody'] 
                        : 'Mira este proyecto de maribe arquitetura:\n\n:title\n:description\n\n:url';
                    echo json_encode($template, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            }
        };
    </script>
    <script src="/src/js/languageSelector.js"></script>
    <script type="module" src="/src/js/selectedProject.js" defer></script>
    <script src="/src/js/lightbox-plus-jquery.js" defer></script>
    <script src="/src/js/cookiePopup.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <div class="project-container">
                <aside class="project-info" role="complementary">
                    <div class="project-info-content">
                        <h2 id="projectInfoTitle" class="project-info-title"></h2>
                        <div class="project-info-meta">
                            <div class="project-info-item">
                                <span class="project-info-label"><?php echo htmlspecialchars(t('projects.detail.location'), ENT_QUOTES, 'UTF-8'); ?></span>
                                <span id="projectInfoLocation" class="project-info-value"></span>
                            </div>
                            <div class="project-info-item">
                                <span class="project-info-label"><?php echo htmlspecialchars(t('projects.detail.year'), ENT_QUOTES, 'UTF-8'); ?></span>
                                <span id="projectInfoYear" class="project-info-value"></span>
                            </div>
                            <div class="project-info-item">
                                <span class="project-info-label"><?php echo htmlspecialchars(t('projects.detail.type'), ENT_QUOTES, 'UTF-8'); ?></span>
                                <span id="projectInfoType" class="project-info-value"></span>
                            </div>
                        </div>
                        <p id="projectInfoDescription" class="project-info-description"></p>
                        <div class="project-share">
                            <h3 class="project-share-title"><?php echo htmlspecialchars(t('projects.detail.shareTitle'), ENT_QUOTES, 'UTF-8'); ?></h3>
                            <div class="project-share-buttons">
                                <a href="#" id="shareWhatsApp" class="share-button share-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="<?php echo htmlspecialchars(t('projects.detail.shareWhatsApp'), ENT_QUOTES, 'UTF-8'); ?>">
                                    <i class="ph-light ph-whatsapp-logo" aria-hidden="true"></i>
                                </a>
                                <a href="#" id="shareEmail" class="share-button share-email" aria-label="<?php echo htmlspecialchars(t('projects.detail.shareEmail'), ENT_QUOTES, 'UTF-8'); ?>">
                                    <span>@</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>
                <div id="projectImages" class="project-gallery" role="list">
                </div>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>