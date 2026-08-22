<?php
require_once __DIR__ . '/src/php/functions.php';

$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');
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
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('about.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <?php
    require_once __DIR__ . '/src/php/openGraph.php';
    echo generateOpenGraphTags(
        t('about.title') . ' • maribe arquitetura',
        t('about.metaDescription'),
        'assets/images/public/nath_1.webp'
    );
    echo generateCanonicalTag();
    ?>

    <title><?php echo htmlspecialchars(t('about.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

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
    <link rel="stylesheet" href="/styles/pages/about/about.css?v=20260822" />

    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/languageSelector.js"></script>

    <?php
    echo generateLocalBusinessSchema($currentLang);

    $breadcrumbs = [
        ['name' => t('menu.home'), 'url' => url('index', $currentLang)],
        ['name' => t('menu.about'), 'url' => url('sobre', $currentLang)]
    ];
    echo generateBreadcrumbSchema($breadcrumbs);
    ?>
</head>

<body>
    <svg class="about-clip-definitions" width="0" height="0" aria-hidden="true" focusable="false">
        <defs>
            <clipPath id="aboutPortraitClip" clipPathUnits="objectBoundingBox">
                <path d="M .29 0 H .97 Q 1 0 1 .03 V .97 Q 1 1 .97 1 H .045 Q .012 1 .018 .95 L .19 .12 Q .205 .02 .29 0 Z" />
            </clipPath>
        </defs>
    </svg>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('about.title');
            include 'includes/pageInfo.php';
            ?>

            <div class="about-sections">
                <section class="about-section">
                    <h2><?php echo htmlspecialchars(t('about.about.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="about-copy">
                        <?php foreach (t('about.about.paragraphs') as $paragraph): ?>
                            <p><?php echo $paragraph; ?></p>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="about-section">
                    <div class="about-profile">
                        <div class="about-subsection about-profile-introduction">
                            <h2><?php echo htmlspecialchars(t('about.leadership.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                            <div class="about-profile-copy">
                                <h3><?php echo htmlspecialchars(t('about.leadership.name'), ENT_QUOTES, 'UTF-8'); ?></h3>
                                <?php foreach (t('about.leadership.paragraphs') as $paragraph): ?>
                                    <p><?php echo $paragraph; ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <figure class="about-portrait">
                            <img
                                src="/assets/images/public/nath_1.webp"
                                alt="<?php echo htmlspecialchars(t('about.leadership.imageAlt'), ENT_QUOTES, 'UTF-8'); ?>"
                                width="1392"
                                height="1740"
                                loading="lazy"
                                decoding="async"
                            >
                        </figure>
                        <div class="about-subsection about-perspective">
                            <h2><?php echo htmlspecialchars(t('about.perspective.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                            <div class="about-copy">
                                <?php foreach (t('about.perspective.paragraphs') as $paragraph): ?>
                                    <p><?php echo $paragraph; ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="about-section">
                    <h2><?php echo htmlspecialchars(t('about.brand.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="about-brand">
                        <div class="about-copy">
                            <?php foreach (t('about.brand.paragraphs') as $paragraph): ?>
                                <p><?php echo $paragraph; ?></p>
                            <?php endforeach; ?>
                        </div>
                        <div class="about-brand-media">
                            <video
                                id="logoHistoryVideo"
                                autoplay
                                loop
                                muted
                                playsinline
                                preload="metadata"
                                poster="/assets/images/public/logos/logo_vertical.webp"
                                aria-label="<?php echo htmlspecialchars(t('about.brand.videoLabel'), ENT_QUOTES, 'UTF-8'); ?>"
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
    <?php include 'includes/accessibilityWidget.php'; ?>
    <?php include 'includes/scrollToTop.php'; ?>
    <script src="/src/js/aboutVideoVisibility.js"></script>
</body>

</html>
