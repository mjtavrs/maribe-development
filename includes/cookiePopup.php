<?php
// Garante que as funções de tradução estão disponíveis
if (!function_exists('t')) {
    require_once __DIR__ . '/../src/php/functions.php';
}

// Detecta idioma atual
$currentLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';

// Força o recarregamento das traduções para garantir que o idioma correto seja usado
global $translations;
if (function_exists('loadTranslations')) {
    $translations = loadTranslations($currentLang);
}
?>
<!-- Cookie Popup -->
<div id="cookiePopupContainer" class="hidePopup">
    <div id="cookiePopupContent">
        <div id="cookiePopupHeader">
            <h3><?php echo htmlspecialchars(t('cookiePopup.title'), ENT_QUOTES, 'UTF-8'); ?></h3>
            <p class="cookieDescription">
                <?php echo htmlspecialchars(t('cookiePopup.description'), ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>

        <div id="cookieOptions">
            <div class="cookieOption">
                <div class="cookieOptionHeader">
                    <label class="cookieToggle">
                        <input type="checkbox" id="cookieEssential" checked disabled>
                        <span class="cookieToggleSlider"></span>
                    </label>
                    <div class="cookieOptionInfo">
                        <h4><?php echo htmlspecialchars(t('cookiePopup.essential.title'), ENT_QUOTES, 'UTF-8'); ?> <span class="cookieRequired"><?php echo htmlspecialchars(t('cookiePopup.essential.required'), ENT_QUOTES, 'UTF-8'); ?></span></h4>
                        <p><?php echo htmlspecialchars(t('cookiePopup.essential.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>

            <div class="cookieOption">
                <div class="cookieOptionHeader">
                    <label class="cookieToggle">
                        <input type="checkbox" id="cookieFunctional">
                        <span class="cookieToggleSlider"></span>
                    </label>
                    <div class="cookieOptionInfo">
                        <h4><?php echo htmlspecialchars(t('cookiePopup.functional.title'), ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p><?php echo htmlspecialchars(t('cookiePopup.functional.description'), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>

        </div>

        <div id="cookiePopupActions">
            <a href="<?php echo function_exists('url') ? url('politica-de-privacidade', $currentLang) : '/pt/politica-de-privacidade'; ?>" target="_blank" class="cookiePolicyLink">
                <?php echo htmlspecialchars(t('cookiePopup.privacyPolicy'), ENT_QUOTES, 'UTF-8'); ?>
                <i class="ph ph-regular ph-link"></i>
            </a>
            <div class="cookieButtons">
                <button id="acceptAllCookies" class="cookieButton cookieButtonPrimary">
                    <?php echo htmlspecialchars(t('cookiePopup.acceptAll'), ENT_QUOTES, 'UTF-8'); ?>
                </button>
                <button id="saveCookiePreferences" class="cookieButton cookieButtonSecondary">
                    <?php echo htmlspecialchars(t('cookiePopup.savePreferences'), ENT_QUOTES, 'UTF-8'); ?>
                </button>
            </div>
        </div>
    </div>
</div>