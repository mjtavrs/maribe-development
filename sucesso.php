<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (sucesso não aparece no menu, mas definimos para consistência)
$currentPage = 'sucesso';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('success.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <title><?php echo htmlspecialchars(t('success.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />
    <link rel="stylesheet" href="/styles/pages/404/404.css" />

    <!-- Scripts -->
</head>

<body>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main>
            <div>
                <i class="ph-fill ph-seal-check"></i>
                <div id="notFoundText">
                    <h1>
                        <?php echo htmlspecialchars(t('success.heading'), ENT_QUOTES, 'UTF-8'); ?>
                    </h1>
                    <p>
                        <?php
                        $projectsUrl = url('projetos', $currentLang);
                        echo t('success.message', ['projectsUrl' => $projectsUrl]);
                        ?>
                    </p>
                </div>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>