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

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />
    <meta name="description" content="Gostaria de conversar? Nos envie uma mensagem nessa página." />
    <meta name="keywords"
        content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <title>contato • maribe arquitetura</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/styles/shared/variables.css" />
    <link rel="stylesheet" href="/styles/shared/base.css" />
    <link rel="stylesheet" href="/styles/shared/animations.css" />
    <link rel="stylesheet" href="/styles/shared/components.css" />

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
                            autocomplete="on" required aria-required="true">
                        <label for="name"
                            class="floating-label"><?php echo htmlspecialchars(t('contact.form.name'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="email" name="email" id="email"
                            placeholder="<?php echo htmlspecialchars(t('contact.form.emailPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                            autocomplete="on" required aria-required="true">
                        <label for="email"
                            class="floating-label"><?php echo htmlspecialchars(t('contact.form.email'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="tel" name="phone" id="phone"
                            placeholder="<?php echo htmlspecialchars(t('contact.form.phonePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                            autocomplete="on" maxlength="15" pattern="\(?[0-9]{2}\)? ?[0-9]{4,5}-?[0-9]{4}"
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
                    <div class="floating-label-wrapper">
                        <input type="text" name="subject" id="subject"
                            placeholder="<?php echo htmlspecialchars(t('contact.form.subjectPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"
                            autocomplete="on" maxlength="20" required aria-required="true">
                        <label for="subject"
                            class="floating-label"><?php echo htmlspecialchars(t('contact.form.subject'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <label for="message">
                        <span><?php echo htmlspecialchars(t('contact.form.message'), ENT_QUOTES, 'UTF-8'); ?></span>
                        <textarea name="message" id="message" rows="5" placeholder="<?php echo htmlspecialchars(t('contact.form.messagePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true"></textarea>
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
</body>

</html>