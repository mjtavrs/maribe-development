<!-- Footer -->
<footer>
    <div id="footerTop">
        <div id="footerLogo">
            <img src="/assets/images/public/logo_horizontal_estendido.webp" alt="Logo Maribe Arquitetura">
        </div>
        <div id="socialLinks">
            <h3><?php echo function_exists('t') ? htmlspecialchars(t('footer.socialMedia'), ENT_QUOTES, 'UTF-8') : 'redes sociais'; ?></h3>
            <ul>
                <li>
                    <a href="https://www.instagram.com/maribe.arquitetura" target="_blank" rel="noopener noreferrer"
                        aria-label="Acesse nosso Instagram">
                        <i class="ph-light ph-instagram-logo" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://web.facebook.com/people/Maribe-Arquitetura/100089975852864/" target="_blank" rel="noopener noreferrer"
                        aria-label="Acesse nosso Facebook">
                        <i class="ph-light ph-facebook-logo" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@maribe.arquitetura" target="_blank" rel="noopener noreferrer" aria-label="Acesse nosso Tiktok">
                        <i class="ph-light ph-tiktok-logo" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://br.pinterest.com/maribearquitetura/" target="_blank" rel="noopener noreferrer"
                        aria-label="Acesse nosso Pinterest">
                        <i class="ph-light ph-pinterest-logo" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/company/maribearquitetura/" target="_blank" rel="noopener noreferrer"
                        aria-label="Acesse nosso Linkedin">
                        <i class="ph-light ph-linkedin-logo" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="legalInformation" role="contentinfo">
        <p>
            <span>maribe arquitetura</span> •
            <?php echo function_exists('t') ? htmlspecialchars(t('footer.rights'), ENT_QUOTES, 'UTF-8') : 'todos os direitos reservados'; ?>
            &copy; <?php echo date('Y'); ?>
        </p>
        <a
            href="<?php echo function_exists('url') ? url('politica-de-privacidade', function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt') : 'politica-de-privacidade.php'; ?>">
            <?php echo function_exists('t') ? htmlspecialchars(t('footer.privacyPolicy'), ENT_QUOTES, 'UTF-8') : 'política de privacidade'; ?>
        </a>
        <p>
            <?php echo function_exists('t') ? htmlspecialchars(t('footer.madeBy'), ENT_QUOTES, 'UTF-8') : 'feito com 🧡 por marcos tavares'; ?>
        </p>
    </div>
</footer>