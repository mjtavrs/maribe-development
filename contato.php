<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header
$currentPage = 'contato';
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
    <meta name="description" content="<?php echo htmlspecialchars(t('contact.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="keywords"
        content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <?php
    // Open Graph Meta Tags
    require_once __DIR__ . '/src/php/openGraph.php';
    $pageTitle = t('contact.title') . ' • maribe arquitetura';
    echo generateOpenGraphTags($pageTitle, t('contact.metaDescription'), 'assets/images/public/logo_home.webp');
    ?>

    <title><?php echo htmlspecialchars(t('contact.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
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
    <link rel="stylesheet" href="/styles/pages/contact/contact.css" />

    <!-- Scripts -->
    <script type="module" src="/src/js/formValidation.js"></script>
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/floatingLabel.js"></script>
    <script src="/src/js/toast.js"></script>
    <script src="/src/js/languageSelector.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <?php include 'includes/toast.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('contact.title');
            $budgetUrl = url('orcamento', $currentLang);
            $pageDescription = [
                t('contact.description.0'),
                t('contact.description.1', ['budgetUrl' => $budgetUrl])
            ];
            include 'includes/pageInfo.php';
            ?>
            <form action="/src/php/contactForm.php" method="POST">
                <?php
                $csrfToken = generateCSRFToken();
                ?>
                <input type="hidden" name="csrf_token"
                    value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="lang"
                    value="<?php echo htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-field">
                <div class="floating-label-wrapper">
                    <input type="text" name="name" id="name"
                        placeholder="<?php echo htmlspecialchars(t('contact.form.namePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        autocomplete="name" required aria-required="true" minlength="2">
                    <label for="name"
                        class="floating-label"><?php echo htmlspecialchars(t('contact.form.name'), ENT_QUOTES, 'UTF-8'); ?></label>
                </div>
            </div>
            <div class="form-field">
                <div class="floating-label-wrapper">
                    <input type="email" name="email" id="email"
                        placeholder="<?php echo htmlspecialchars(t('contact.form.emailPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        autocomplete="email" required aria-required="true">
                    <label for="email"
                        class="floating-label"><?php echo htmlspecialchars(t('contact.form.email'), ENT_QUOTES, 'UTF-8'); ?></label>
                </div>
            </div>
            <div class="form-field">
                <div class="floating-label-wrapper">
                    <input type="tel" name="phone" id="phone"
                        placeholder="<?php echo htmlspecialchars(t('contact.form.phonePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                        autocomplete="tel" maxlength="15" pattern="\(?[0-9]{2}\)? ?[0-9]{4,5}-?[0-9]{4}"
                        inputmode="numeric" required aria-required="true">
                    <label for="phone"
                        class="floating-label"><?php echo htmlspecialchars(t('contact.form.phone'), ENT_QUOTES, 'UTF-8'); ?></label>
                </div>
                <div class="field-hint">
                    <i class="ph-light ph-info hint-icon" aria-hidden="true"></i>
                    <span><?php echo htmlspecialchars(t('contact.form.phoneHint'), ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </div>
            <div class="form-field">
                <label for="subject">
                    <span><?php echo htmlspecialchars(t('contact.form.subject'), ENT_QUOTES, 'UTF-8'); ?></span>
                    <select name="subject" id="subject" required aria-required="true">
                        <option value=""><?php echo htmlspecialchars(t('contact.form.subjectPlaceholder'), ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="<?php echo htmlspecialchars(t('contact.form.subjectOptions.duvidasProjetos'), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(t('contact.form.subjectOptions.duvidasProjetos'), ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="<?php echo htmlspecialchars(t('contact.form.subjectOptions.consultoria'), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(t('contact.form.subjectOptions.consultoria'), ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="<?php echo htmlspecialchars(t('contact.form.subjectOptions.parcerias'), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(t('contact.form.subjectOptions.parcerias'), ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="<?php echo htmlspecialchars(t('contact.form.subjectOptions.informacoes'), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(t('contact.form.subjectOptions.informacoes'), ENT_QUOTES, 'UTF-8'); ?></option>
                        <option value="<?php echo htmlspecialchars(t('contact.form.subjectOptions.outros'), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(t('contact.form.subjectOptions.outros'), ENT_QUOTES, 'UTF-8'); ?></option>
                    </select>
                </label>
                <div id="subjectOtherWrapper" class="form-field" style="display: none; margin-top: 10px;">
                    <div class="floating-label-wrapper">
                        <input type="text" name="subjectOther" id="subjectOther"
                            placeholder="<?php echo htmlspecialchars(t('contact.form.subjectOtherPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                            autocomplete="off" maxlength="100" minlength="3">
                        <label for="subjectOther" class="floating-label"><?php echo htmlspecialchars(t('contact.form.subjectOtherPlaceholder'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
            </div>
            <div class="form-field">
                <label for="message">
                    <span><?php echo htmlspecialchars(t('contact.form.message'), ENT_QUOTES, 'UTF-8'); ?></span>
                    <textarea name="message" id="message" rows="5" placeholder="<?php echo htmlspecialchars(t('contact.form.messagePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true" minlength="10"></textarea>
                </label>
            </div>
            <label for="privacy" id="privacyLabel">
                <input type="checkbox" name="privacy" id="privacy" required aria-required="true">
                <span><?php
                        $privacyUrl = url('politica-de-privacidade', $currentLang);
                        echo t('contact.form.privacy', ['privacyUrl' => $privacyUrl]);
                        ?></span>
            </label>
            <div id="buttonContainer">
                <button type="submit">
                    <?php echo htmlspecialchars(t('contact.form.submit'), ENT_QUOTES, 'UTF-8'); ?>
                </button>
            </div>
            </form>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>