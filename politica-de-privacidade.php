<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (politica não aparece no menu, mas definimos para consistência)
$currentPage = 'politica';

// Formata data de atualização conforme idioma
$updateDate = formatDate($currentLang);
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
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('privacy.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <title><?php echo htmlspecialchars(t('privacy.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
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
    <link rel="stylesheet" href="/styles/pages/privacyPolicies/privacyPolicies.css" />

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
            $pageTitle = t('privacy.title');
            $pageDescription = t('privacy.description');
            include 'includes/pageInfo.php';
            ?>
            <div id="policies">
                <span>
                    <?php echo htmlspecialchars(t('privacy.lastUpdate'), ENT_QUOTES, 'UTF-8'); ?>: <?php echo htmlspecialchars($updateDate, ENT_QUOTES, 'UTF-8'); ?>
                </span>

                <!-- Seção: Coleta de Informações -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.collection.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo t('privacy.sections.collection.intro'); ?></p>
                        <h3><?php echo htmlspecialchars(t('privacy.sections.collection.cookieTypes'), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <ul>
                            <li>
                                <strong><?php echo htmlspecialchars(t('privacy.sections.collection.essential.title'), ENT_QUOTES, 'UTF-8'); ?>:</strong> <?php echo htmlspecialchars(t('privacy.sections.collection.essential.description'), ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                            <li>
                                <strong><?php echo htmlspecialchars(t('privacy.sections.collection.functional.title'), ENT_QUOTES, 'UTF-8'); ?>:</strong> <?php echo htmlspecialchars(t('privacy.sections.collection.functional.description'), ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                        </ul>
                        <p>
                            <strong><?php echo htmlspecialchars(t('privacy.sections.collection.important'), ENT_QUOTES, 'UTF-8'); ?></strong> <?php echo htmlspecialchars(t('privacy.sections.collection.importantText'), ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <p><?php echo htmlspecialchars(t('privacy.sections.collection.management'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>

                <!-- Seção: Uso das Informações -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.usage.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.usage.intro'), ENT_QUOTES, 'UTF-8'); ?></p>
                        <ul>
                            <?php 
                            $usageItems = t('privacy.sections.usage.items');
                            // A função t() pode retornar array ou string (chave se não encontrar)
                            if (is_array($usageItems)) {
                                foreach ($usageItems as $item): ?>
                                    <li><?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach;
                            } elseif (is_string($usageItems) && $usageItems !== 'privacy.sections.usage.items') {
                                // Se retornou string válida (não a chave), exibe como item único
                                echo '<li>' . htmlspecialchars($usageItems, ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                            ?>
                        </ul>
                        <span><?php echo htmlspecialchars(t('privacy.sections.usage.sharing'), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </section>

                <!-- Seção: Segurança dos Dados -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.security.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.security.paragraph1'), ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><?php echo htmlspecialchars(t('privacy.sections.security.paragraph2'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>

                <!-- Seção: Links para Sites Externos -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.externalLinks.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.externalLinks.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>

                <!-- Seção: Responsabilidade e Crimes Digitais -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.responsibility.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.responsibility.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>

                <!-- Seção: Propriedade Intelectual -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.intellectual.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.intellectual.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>

                <!-- Seção: Alterações nesta Política -->
                <section class="policy">
                    <h2><?php echo htmlspecialchars(t('privacy.sections.changes.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <div class="policyInfo">
                        <p><?php echo htmlspecialchars(t('privacy.sections.changes.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </section>
            </div>

            <div id="separatorBox">
                <div id="separator"></div>
            </div>

            <div id="contactInformationIfDoubt">
                <h2><?php echo htmlspecialchars(t('privacy.contact.title'), ENT_QUOTES, 'UTF-8'); ?></h2>
                <p>
                    <?php 
                    $contactUrl = function_exists('url') ? url('contato', $currentLang) : '/pt/contato';
                    echo t('privacy.contact.description', ['contactUrl' => $contactUrl]);
                    ?>
                </p>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>
