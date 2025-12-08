<?php
// Carrega traduções para usar no scroll to top
$currentLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';
if (function_exists('loadTranslations')) {
    $translations = loadTranslations($currentLang);
}
$scrollToTopLabel = isset($translations['scrollToTop']['label']) 
    ? $translations['scrollToTop']['label'] 
    : 'Voltar ao topo';
$scrollToTopTitle = isset($translations['scrollToTop']['title']) 
    ? $translations['scrollToTop']['title'] 
    : 'Voltar ao topo';
?>
<!-- Botão Scroll to Top -->
<button id="scrollToTopButton" aria-label="<?php echo htmlspecialchars($scrollToTopLabel, ENT_QUOTES, 'UTF-8'); ?>" title="<?php echo htmlspecialchars($scrollToTopTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <i class="ph-bold ph-caret-up" aria-hidden="true"></i>
</button>
<script src="/src/js/scrollToTop.js"></script>

