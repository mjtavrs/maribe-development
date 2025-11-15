<!-- Footer -->
<footer>
    <div id="socialLinks">
        <ul>
            <li>
                <a href="https://www.instagram.com/maribe.arquitetura" target="_blank" aria-label="Acesse nosso Instagram">
                    <i title="Acesse nosso Instagram" class="ph-light ph-instagram-logo"></i>
                </a>
            </li>
            <li>
                <a href="https://web.facebook.com/people/Maribe-Arquitetura/100089975852864/" target="_blank" aria-label="Acesse nosso Facebook">
                    <i title="Acesse nosso Facebook" class="ph-light ph-facebook-logo"></i>
                </a>
            </li>
            <li>
                <a href="https://www.tiktok.com/@maribe.arquitetura" target="_blank" aria-label="Acesse nosso Tiktok">
                    <i title="Acesse nosso Tiktok" class="ph-light ph-tiktok-logo"></i>
                </a>
            </li>
            <li>
                <a href="https://br.pinterest.com/maribearquitetura/" target="_blank" aria-label="Acesse nosso Pinterest">
                    <i title="Acesse nosso Pinterest" class="ph-light ph-pinterest-logo"></i>
                </a>
            </li>
        </ul>
    </div>
    <div id="legalInformation" role="contentinfo">
        <p>
            <span>maribe arquitetura</span> • <?php echo function_exists('t') ? htmlspecialchars(t('footer.rights'), ENT_QUOTES, 'UTF-8') : 'todos os direitos reservados'; ?> &copy; <?php echo date('Y'); ?>
        </p>
        <p>
            <?php echo function_exists('t') ? htmlspecialchars(t('footer.madeBy'), ENT_QUOTES, 'UTF-8') : 'feito com 🧡 por marcos tavares'; ?>
        </p>
        <a href="<?php echo function_exists('url') ? url('politica-de-privacidade', function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt') : 'politica-de-privacidade.php'; ?>">
            <?php echo function_exists('t') ? htmlspecialchars(t('footer.privacyPolicy'), ENT_QUOTES, 'UTF-8') : 'política de privacidade'; ?>
        </a>
    </div>
</footer>