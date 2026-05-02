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

    <?php
    // Carrega funções Open Graph
    require_once __DIR__ . '/src/php/openGraph.php';
    
    // Tenta obter dados do projeto para meta tags Open Graph
    $projectSlug = isset($_GET['name']) ? $_GET['name'] : null;
    $projectId = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $project = null;
    
    if ($projectSlug || $projectId) {
        $project = getProjectData($projectSlug, $projectId);
    }
    
    // Se encontrou o projeto, gera meta tags específicas
    if ($project) {
        $projectTitle = $project['titulo'];
        $projectDesc = isset($project['descricao'][$currentLang]) 
            ? $project['descricao'][$currentLang] 
            : $project['descricao']['pt'];
        $projectImage = $project['cover'];
        
        // Constrói URL do projeto
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
        $projectUrl = $protocol . $host . $_SERVER['REQUEST_URI'];
        
        echo generateOpenGraphTags($projectTitle . ' • maribe arquitetura', $projectDesc, $projectImage, $projectUrl, 'article');
        
        // Canonical URL para projeto
        echo generateCanonicalTag($projectUrl);
    } else {
        // Meta tags genéricas para página de projetos
        echo generateOpenGraphTags(t('projects.title') . ' • maribe arquitetura', t('projects.metaDescription'), '', '', 'website');
        
        // Canonical URL genérica
        echo generateCanonicalTag();
    }
    ?>

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
    <link rel="stylesheet" href="/styles/shared/accessibilityWidget.css" />
    <link rel="stylesheet" href="/styles/shared/contractDataExplanation.css" />
    <link rel="stylesheet" href="/styles/shared/lightbox.css" />
    <link rel="stylesheet" href="/styles/pages/project/project.css" />

    <!-- Scripts -->
    <script>
        // Passa as traduções de lightbox para o JavaScript
        window.lightboxTranslations = {
            pt: {
                imageCount: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['lightbox']['imageCount'] ?? 'Imagem %1 de %2', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                previousImage: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['lightbox']['previousImage'] ?? 'Imagem anterior', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                nextImage: <?php 
                    $translations = loadTranslations('pt');
                    echo json_encode($translations['projects']['lightbox']['nextImage'] ?? 'Próxima imagem', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            en: {
                imageCount: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['lightbox']['imageCount'] ?? 'Image %1 of %2', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                previousImage: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['lightbox']['previousImage'] ?? 'Previous image', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                nextImage: <?php 
                    $translations = loadTranslations('en');
                    echo json_encode($translations['projects']['lightbox']['nextImage'] ?? 'Next image', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            },
            es: {
                imageCount: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['lightbox']['imageCount'] ?? 'Imagen %1 de %2', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                previousImage: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['lightbox']['previousImage'] ?? 'Imagen anterior', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>,
                nextImage: <?php 
                    $translations = loadTranslations('es');
                    echo json_encode($translations['projects']['lightbox']['nextImage'] ?? 'Siguiente imagen', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
            }
        };
        
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
    <script src="/src/js/lightbox-plus-jquery.js"></script>
    <script>
        // Configura o lightbox com traduções dinâmicas
        // Aguarda o lightbox estar disponível
        function configureLightbox() {
            const lang = window.location.pathname.match(/^\/(pt|en|es)\//)?.[1] || 'pt';
            if (window.lightboxTranslations && window.lightboxTranslations[lang]) {
                // Tenta configurar imediatamente se já estiver disponível
                if (window.lightbox && window.lightbox.option) {
                    window.lightbox.option({
                        albumLabel: window.lightboxTranslations[lang].imageCount
                    });
                } else {
                    // Se não estiver disponível, tenta novamente após um delay
                    setTimeout(configureLightbox, 100);
                }
            }
        }
        
        // Tenta configurar quando o DOM estiver pronto
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', configureLightbox);
        } else {
            configureLightbox();
        }
    </script>
    <script type="module" src="/src/js/selectedProject.js" defer></script>
    <script src="/src/js/cookiePopup.js"></script>
    
    <?php
    // Schema.org JSON-LD
    echo generateLocalBusinessSchema($currentLang);
    
    // Se encontrou o projeto, adiciona Article Schema e Breadcrumb
    if (isset($project) && $project) {
        echo generateArticleSchema($project, $currentLang);
        
        // Breadcrumb Schema para projeto
        $projectTitle = $project['titulo'];
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
        $currentProjectUrl = $protocol . $host . $_SERVER['REQUEST_URI'];
        $breadcrumbs = [
            ['name' => function_exists('t') ? t('menu.home') : 'início', 'url' => url('index', $currentLang)],
            ['name' => function_exists('t') ? t('projects.title') : 'projetos', 'url' => url('projetos', $currentLang)],
            ['name' => $projectTitle, 'url' => $currentProjectUrl]
        ];
        echo generateBreadcrumbSchema($breadcrumbs);
    } else {
        // Breadcrumb Schema genérico para página de projetos
        $breadcrumbs = [
            ['name' => function_exists('t') ? t('menu.home') : 'início', 'url' => url('index', $currentLang)],
            ['name' => function_exists('t') ? t('projects.title') : 'projetos', 'url' => url('projetos', $currentLang)]
        ];
        echo generateBreadcrumbSchema($breadcrumbs);
    }
    ?>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <div class="project-container">
                <div class="project-back-row">
                    <a
                        href="<?php echo htmlspecialchars(url('projetos', $currentLang), ENT_QUOTES, 'UTF-8'); ?>"
                        id="backToProjects"
                        class="project-back-link"
                    >
                        <i class="ph-bold ph-arrow-left" aria-hidden="true"></i>
                        <span><?php echo htmlspecialchars(t('projects.detail.backToProjects'), ENT_QUOTES, 'UTF-8'); ?></span>
                    </a>
                </div>
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
                            <div id="projectInfoPhotosByItem" class="project-info-item" hidden>
                                <span class="project-info-label"><?php echo htmlspecialchars(t('projects.detail.photosBy'), ENT_QUOTES, 'UTF-8'); ?></span>
                                <span id="projectInfoPhotosBy" class="project-info-value"></span>
                            </div>
                        </div>
                        <p id="projectInfoDescription" class="project-info-description"></p>
                        <div class="project-share">
                            <h3 class="project-share-title"><?php echo htmlspecialchars(t('projects.detail.shareTitle'), ENT_QUOTES, 'UTF-8'); ?></h3>
                            <div class="project-share-buttons">
                                <a href="#" id="shareWhatsApp" class="share-button share-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="<?php echo htmlspecialchars(t('projects.detail.shareWhatsApp'), ENT_QUOTES, 'UTF-8'); ?>">
                                    <svg class="share-button-icon" viewBox="0 0 448 512" aria-hidden="true" focusable="false">
                                        <path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
                                    </svg>
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
    <?php include 'includes/accessibilityWidget.php'; ?>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>
