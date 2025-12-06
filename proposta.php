<?php
// Inicia sessão ANTES de qualquer output
require_once __DIR__ . '/src/php/functions.php';

// Detecta e define o idioma
$currentLang = getCurrentLanguage();
$langAttribute = $currentLang === 'pt' ? 'pt-br' : ($currentLang === 'en' ? 'en-US' : 'es-ES');

// Define a página atual para o header (proposta não aparece no menu, mas definimos para consistência)
$currentPage = 'proposta';
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
    <meta name="description" content="<?php echo htmlspecialchars(t('proposal.metaDescription'), ENT_QUOTES, 'UTF-8'); ?>" />

    <?php
    // Open Graph Meta Tags
    require_once __DIR__ . '/src/php/openGraph.php';
    $pageTitle = t('proposal.title') . ' • maribe arquitetura';
    echo generateOpenGraphTags($pageTitle, t('proposal.metaDescription'), 'assets/images/public/logo_home.webp');
    
    // Canonical URL
    echo generateCanonicalTag();
    ?>

    <title><?php echo htmlspecialchars(t('proposal.title'), ENT_QUOTES, 'UTF-8'); ?> • maribe arquitetura</title>
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

    <!-- Scripts -->
    <script type="module" src="/src/js/formValidation.js"></script>
    <script src="/src/js/cookiePopup.js"></script>
    <script src="/src/js/toast.js"></script>
    <script src="/src/js/floatingLabel.js"></script>
    <script src="/src/js/languageSelector.js"></script>
    
    <?php
    // Schema.org JSON-LD
    echo generateLocalBusinessSchema($currentLang);
    ?>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <?php include 'includes/toast.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = t('proposal.title');
            $pageDescription = [
                t('proposal.description.0'),
                t('proposal.description.1')
            ];
            include 'includes/pageInfo.php';
            ?>
            <form action="/src/php/finalBudgetForm.php" method="POST">
                <?php
                $csrfToken = generateCSRFToken();
                ?>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="name" id="name" placeholder="<?php echo htmlspecialchars(t('proposal.form.namePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="name" required aria-required="true" minlength="2">
                        <label for="name" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.name'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="address" id="address" placeholder="<?php echo htmlspecialchars(t('proposal.form.addressPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="street-address" required aria-required="true">
                        <label for="address" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.address'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="form-field">
                    <div class="floating-label-wrapper">
                        <input type="text" name="maisImportanteNoOrcamento" id="maisImportanteNoOrcamento" placeholder="<?php echo htmlspecialchars(t('proposal.form.mostImportantPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="on" required aria-required="true">
                        <label for="maisImportanteNoOrcamento" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.mostImportant'), ENT_QUOTES, 'UTF-8'); ?></label>
                    </div>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.hasBlueprint'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="imovelTemPlantaOuNao" id="imovelComPlanta" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="imovelComPlanta"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="imovelTemPlantaOuNao" id="imovelSemPlanta" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="imovelSemPlanta"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <div class="form-field">
                        <div class="floating-label-wrapper">
                            <input type="text" name="apartamentoCompletoOuAlgunsAmbientes" id="apartamentoCompletoOuAlgunsAmbientes" placeholder="<?php echo htmlspecialchars(t('proposal.form.apartmentCompletePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="off" required aria-required="true">
                            <label for="apartamentoCompletoOuAlgunsAmbientes" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.apartmentComplete'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="twoColumnsInForm">
                    <div class="form-field">
                        <div class="floating-label-wrapper">
                            <input type="text" name="quantasPessoasResidemEIdades" id="quantasPessoasResidemEIdades" placeholder="<?php echo htmlspecialchars(t('proposal.form.residentsPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="on" required aria-required="true">
                            <label for="quantasPessoasResidemEIdades" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.residents'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <div class="floating-label-wrapper">
                            <input type="text" name="tamanhoEmMetrosQuadrados" id="tamanhoEmMetrosQuadrados" placeholder="<?php echo htmlspecialchars(t('proposal.form.sizePlaceholder'), ENT_QUOTES, 'UTF-8'); ?>" autocomplete="off" required aria-required="true" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?">
                            <label for="tamanhoEmMetrosQuadrados" class="floating-label"><?php echo htmlspecialchars(t('proposal.form.size'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.demolition'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="haveraDemolicaoOuConstrucaoDeParedes" id="haveraDemolicao" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="haveraDemolicao"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="haveraDemolicaoOuConstrucaoDeParedes" id="naoHaveraDemolicao" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoHaveraDemolicao"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.electrical'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="vaiModificarEletrica" id="modificarEletrica" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="modificarEletrica"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="vaiModificarEletrica" id="naoModificarEletrica" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoModificarEletrica"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.plaster'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="vaiModificarGesso" id="modificarGesso" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="modificarGesso"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="vaiModificarGesso" id="naoModificarGesso" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoModificarGesso"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.finishing'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="vaiModificarRevestimentoOuBancadas" id="modificarRevestimentoOuBancadas" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="modificarRevestimentoOuBancadas"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="vaiModificarRevestimentoOuBancadas" id="naoModificarRevestimentoOuBancadas" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoModificarRevestimentoOuBancadas"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                </div>
                <div class="twoColumnsInForm">
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.furniture'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="vaiAproveitarEOuModificarAlgumMovel" id="aproveitarEOuModificarMovelExistente" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="aproveitarEOuModificarMovelExistente"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="vaiAproveitarEOuModificarAlgumMovel" id="naoAproveitarEOuModificarMovelExistente" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoAproveitarEOuModificarMovelExistente"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo htmlspecialchars(t('proposal.form.carpentry'), ENT_QUOTES, 'UTF-8'); ?></legend>
                        <div>
                            <input type="radio" name="pensaEmFazerMoveisComMarcenariaOuPlanejados" id="iraFazerMarcenariaOuPlanejados" value="<?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="iraFazerMarcenariaOuPlanejados"><?php echo htmlspecialchars(t('proposal.form.yes'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                        <div>
                            <input type="radio" name="pensaEmFazerMoveisComMarcenariaOuPlanejados" id="naoIraFazerMarcenariaOuPlanejados" value="<?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?>" required aria-required="true">
                            <label for="naoIraFazerMarcenariaOuPlanejados"><?php echo htmlspecialchars(t('proposal.form.no'), ENT_QUOTES, 'UTF-8'); ?></label>
                        </div>
                    </fieldset>
                </div>
                <div class="form-field">
                    <label for="duvidasOuInformacoesAAcrescentar">
                        <span><?php echo htmlspecialchars(t('proposal.form.additionalInfo'), ENT_QUOTES, 'UTF-8'); ?></span>
                        <textarea name="duvidasOuInformacoesAAcrescentar" id="duvidasOuInformacoesAAcrescentar" rows="6" placeholder="<?php echo htmlspecialchars(t('proposal.form.additionalInfoPlaceholder'), ENT_QUOTES, 'UTF-8'); ?>"></textarea>
                    </label>
                </div>
                <label for="privacy" id="privacyLabel">
                    <input type="checkbox" name="privacy" id="privacy" required aria-required="true">
                    <span><?php
                            $privacyUrl = url('politica-de-privacidade', $currentLang);
                            echo t('proposal.form.privacy', ['privacyUrl' => $privacyUrl]);
                            ?></span>
                </label>
                <div id="buttonContainer">
                    <button type="submit">
                        <?php echo htmlspecialchars(t('proposal.form.submit'), ENT_QUOTES, 'UTF-8'); ?>
                    </button>
                </div>
            </form>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
    <?php include 'includes/scrollToTop.php'; ?>
</body>

</html>