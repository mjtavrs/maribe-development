<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header
$currentPage = 'orcamento';
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
    <meta name="description" content="<?php echo htmlspecialchars(t('budget.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="keywords" content="arquitetura, residencial, comercial, urbanismo, recife, pernambuco, maribe, escritório, consultoria, arquitetura residencial, arquitetura infantil, neuroarquitetura" />

    <title><?php echo htmlspecialchars(t('budget.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
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
            $pageTitle = t('budget.title');
            $pageDescription = [
                t('budget.description.0'),
                t('budget.description.1')
            ];
            include 'includes/pageInfo.php';
            ?>
            <form action="/src/php/budgetForm.php" method="POST">
                <?php
                $csrfToken = generateCSRFToken();
                ?>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="name" id="name" placeholder="<?php echo htmlspecialchars(t('budget.form.namePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="name" required aria-required="true" minlength="2">
                        <label for="name" class="floating-label"><?php echo htmlspecialchars(t('budget.form.name'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="email" name="email" id="email" placeholder="<?php echo htmlspecialchars(t('budget.form.emailPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="email" required aria-required="true">
                        <label for="email" class="floating-label"><?php echo htmlspecialchars(t('budget.form.email'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="tel" name="phone" id="phone" placeholder="<?php echo htmlspecialchars(t('budget.form.phonePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="tel" maxlength="15" pattern="\(?[0-9]{2}\)? ?[0-9]{4,5}-?[0-9]{4}" inputmode="numeric" required aria-required="true">
                        <label for="phone" class="floating-label"><?php echo htmlspecialchars(t('budget.form.phone'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                    <div class="field-hint">
                        <i class="ph-light ph-info hint-icon" aria-hidden="true"></i>
                        <span><?php echo htmlspecialchars(t('budget.form.phoneHint'), ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('budget.form.howYouFoundUs'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="howYouFoundUs" id="instagram" value="<?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.instagram'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="instagram"><?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.instagram'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="howYouFoundUs" id="indicacao" value="<?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.indicacao'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="indicacao"><?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.indicacao'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="howYouFoundUs" id="visitaAProjetado" value="<?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.visitaAProjetado'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="visitaAProjetado"><?php echo htmlspecialchars(t('budget.form.howYouFoundUsOptions.visitaAProjetado'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOn'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="whatAreWeWorkingOn" id="interioresResidencialCompleto" value="<?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresResidencialCompleto'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="interioresResidencialCompleto"><?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresResidencialCompleto'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whatAreWeWorkingOn" id="interioresAlgunsAmbientes" value="<?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresAlgunsAmbientes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="interioresAlgunsAmbientes"><?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresAlgunsAmbientes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whatAreWeWorkingOn" id="interioresComercialCompleto" value="<?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresComercialCompleto'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="interioresComercialCompleto"><?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.interioresComercialCompleto'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whatAreWeWorkingOn" id="projetoDeArquitetura" value="<?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.projetoDeArquitetura'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="projetoDeArquitetura"><?php echo htmlspecialchars(t('budget.form.whatAreWeWorkingOnOptions.projetoDeArquitetura'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('budget.form.whenToBeginTheProject'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="whenToBeginTheProject" id="escolhendoMeuNovoLar" value="<?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.escolhendoMeuNovoLar'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="escolhendoMeuNovoLar"><?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.escolhendoMeuNovoLar'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whenToBeginTheProject" id="aguardandoAsChaves" value="<?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.aguardandoAsChaves'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="aguardandoAsChaves"><?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.aguardandoAsChaves'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whenToBeginTheProject" id="estouSemPressa" value="<?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.estouSemPressa'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="estouSemPressa"><?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.estouSemPressa'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="whenToBeginTheProject" id="estouApressado" value="<?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.estouApressado'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="estouApressado"><?php echo htmlspecialchars(t('budget.form.whenToBeginTheProjectOptions.estouApressado'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <div class="form-field">
                        <label for="objective">
                            <span><?php echo htmlspecialchars(t('budget.form.objective'), ENT_QUOTES, 'UTF-8'); ?></span>
                            <textarea name="objective" id="objective" rows="5" placeholder="<?php echo htmlspecialchars(t('budget.form.objectivePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true" minlength="10"></textarea>
                        </label>
                        <div class="field-hint">
                            <i class="ph-light ph-info hint-icon" aria-hidden="true"></i>
                            <span><?php echo htmlspecialchars(t('budget.form.objectiveHint'), ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                    </div>
                </div>
                <label for="privacy" id="privacyLabel">
                    <input type="checkbox" name="privacy" id="privacy" required aria-required="true">
                    <span><?php
                            $privacyUrl = url('politica-de-privacidade', $currentLang);
                            echo t('budget.form.privacy', ['privacyUrl' => $privacyUrl]);
                            ?></span>
                </label>
                <div id="buttonContainer">
                    <button type="submit">
                        <?php echo htmlspecialchars(t('budget.form.submit'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                </div>
            </form>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>