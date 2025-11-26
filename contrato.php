<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (contrato não aparece no menu, mas definimos para consistência)
$currentPage = 'contrato';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($langAttribute, ENT_QUOTES, 'UTF-8'); ?>">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="<?php echo htmlspecialchars(t('contract.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <title><?php echo htmlspecialchars(t('contract.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />

    <!-- Scripts -->
    <script type="module" src="/src/js/formValidation.js"></script>
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/toast.js"></script>
    <script src="/src/js/floatingLabel.js"></script>
    <script src="/src/js/languageSelector.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <?php include 'includes/toast.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('contract.title');
            include 'includes/pageInfo.php';
            ?>
            <div id="contractDataExplanation" class="policy-card">
                <div class="contract-explanation-header">
                    <h3><?php echo htmlspecialchars(t('contract.form.dataExplanation'), ENT_QUOTES, 'UTF-8'); ?></h3>
                </div>
                <div class="contract-explanation-content">
                    <p><?php echo htmlspecialchars(t('contract.form.dataExplanationText'), ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
            <form action="/src/php/contractForm.php" method="POST">
                <?php
                $csrfToken = generateCSRFToken();
                ?>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="name" id="name" autocomplete="name" required aria-required="true" placeholder="<?php echo htmlspecialchars(t('contract.form.name'), ENT_QUOTES, 'UTF-8'); ?>" minlength="2">
                        <label for="name" class="floating-label"><?php echo htmlspecialchars(t('contract.form.name'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="email" name="email" id="email" placeholder="<?php echo htmlspecialchars(t('contract.form.emailPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="email" aria-required="false">
                        <label for="email" class="floating-label"><?php echo htmlspecialchars(t('contract.form.email'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="cpf" id="cpf" placeholder="<?php echo htmlspecialchars(t('contract.form.cpfPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="off" required aria-required="true" maxlength="14" inputmode="numeric">
                        <label for="cpf" class="floating-label"><?php echo htmlspecialchars(t('contract.form.cpf'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="rg" id="rg" placeholder="<?php echo htmlspecialchars(t('contract.form.rgPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="off" required aria-required="true" maxlength="13" inputmode="numeric">
                        <label for="rg" class="floating-label"><?php echo htmlspecialchars(t('contract.form.rg'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="projectAddress" id="projectAddress" placeholder="<?php echo htmlspecialchars(t('contract.form.projectAddressPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="street-address" required aria-required="true">
                        <label for="projectAddress" class="floating-label"><?php echo htmlspecialchars(t('contract.form.projectAddress'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="clientAddress" id="clientAddress" placeholder="<?php echo htmlspecialchars(t('contract.form.clientAddressPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="street-address" required aria-required="true">
                        <label for="clientAddress" class="floating-label"><?php echo htmlspecialchars(t('contract.form.clientAddress'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <label for="clientBirthDate">
                        <?php echo htmlspecialchars(t('contract.form.birthDate'), ENT_QUOTES, 'UTF-8'); ?>
                        <input type="date" name="clientBirthDate" id="clientBirthDate" required aria-required="true" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
                    </label>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="paymentMethod" id="paymentMethod" placeholder="<?php echo htmlspecialchars(t('contract.form.paymentMethodPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="on" required aria-required="true">
                        <label for="paymentMethod" class="floating-label"><?php echo htmlspecialchars(t('contract.form.paymentMethod'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                    <div class="field-hint">
                        <i class="ph-light ph-info hint-icon" aria-hidden="true"></i>
                        <span><?php echo htmlspecialchars(t('contract.form.paymentMethodExamples'), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
                <div id="buttonContainer">
                    <button type="submit">
                        <?php echo htmlspecialchars(t('contract.form.submit'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                </div>
            </form>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>