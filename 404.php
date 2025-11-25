<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (404 não está no menu, mas definimos para evitar erros)
$currentPage = 'home';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('notFound.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <title><?php echo htmlspecialchars(t('notFound.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />
    <link rel="stylesheet" href="/styles/pages/404/404.css" />
    
    <!-- Scripts -->
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
</head>
<body>
    <div id="smoothOpening">
        <?php include __DIR__ . '/includes/header.php'; ?>
        <main>
            <div>
                <i class="ph-fill ph-x-circle"></i>
                <div id="notFoundText">
                    <h1>
                        <?php echo htmlspecialchars(t('notFound.heading'), ENT_QUOTES, 'UTF-8'); ?>
                    </h1>
                    <p>
                        <?php echo htmlspecialchars(t('notFound.description'), ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
            </div>
        </main>
        <?php include __DIR__ . '/includes/footer.php'; ?>
    </div>
</body>
</html>

