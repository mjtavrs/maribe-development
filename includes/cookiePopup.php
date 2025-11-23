<!-- Cookie Popup -->
<div id="cookiePopupContainer" class="hidePopup">
    <div id="cookiePopupContent">
        <div id="cookiePopupHeader">
            <h3>Gerenciar Cookies 🍪</h3>
            <p class="cookieDescription">
                Utilizamos cookies e tecnologias similares para melhorar sua experiência de navegação. Você pode escolher quais tipos de cookies deseja aceitar.
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
                        <h4>Cookies Essenciais <span class="cookieRequired">(Obrigatório)</span></h4>
                        <p>Necessários para o funcionamento básico do site. Incluem segurança (tokens CSRF) e sessões.</p>
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
                        <h4>Cookies de Funcionalidade</h4>
                        <p>Permitem que o site lembre suas preferências, como idioma escolhido, para melhorar sua experiência.</p>
                    </div>
                </div>
            </div>

        </div>

        <div id="cookiePopupActions">
            <a href="<?php echo function_exists('url') ? url('politica-de-privacidade', function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt') : '/pt/politica-de-privacidade'; ?>" target="_blank" class="cookiePolicyLink">
                Política de Privacidade
                <i class="ph ph-regular ph-link"></i>
            </a>
            <div class="cookieButtons">
                <button id="acceptAllCookies" class="cookieButton cookieButtonPrimary">
                    Aceitar todos
                </button>
                <button id="saveCookiePreferences" class="cookieButton cookieButtonSecondary">
                    Salvar preferências
                </button>
            </div>
        </div>
    </div>
</div>