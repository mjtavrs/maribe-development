/**
 * Gerenciamento de Cookies com Consentimento Granular
 * 
 * Gerencia o popup de cookies com opções de consentimento granular
 * e salva as preferências do usuário.
 */

document.addEventListener("DOMContentLoaded", () => {
    const popupContainer = document.getElementById("cookiePopupContainer");
    const acceptAllButton = document.getElementById("acceptAllCookies");
    const savePreferencesButton = document.getElementById("saveCookiePreferences");
    const essentialCheckbox = document.getElementById("cookieEssential");
    const functionalCheckbox = document.getElementById("cookieFunctional");

    // Verifica se o popup já foi exibido
    const cookieConsent = getCookieConsent();
    
    if (!cookieConsent || !cookieConsent.displayed) {
        // Mostra o popup após 1.5 segundos
        setTimeout(() => {
            popupContainer.classList.remove("hidePopup");
            popupContainer.classList.add("showPopupFromBellow");
        }, 1500);

        // Carrega preferências salvas anteriormente (se houver)
        if (cookieConsent && cookieConsent.functional !== undefined) {
            functionalCheckbox.checked = cookieConsent.functional;
        }
    }

    // Função para salvar preferências de cookies
    const saveCookiePreferences = (allAccepted = false) => {
        const preferences = {
            displayed: true,
            essential: true, // Sempre true (obrigatório)
            functional: allAccepted || functionalCheckbox.checked,
            timestamp: Date.now()
        };

        // Salva no localStorage
        localStorage.setItem("cookieConsent", JSON.stringify(preferences));

        // Fecha o popup
        popupContainer.classList.add("hidePopupWithAnimation");
        popupContainer.classList.remove("showPopupFromBellow");

        // Após animação, remove completamente
        setTimeout(() => {
            popupContainer.classList.add("hidePopup");
        }, 1000);
    };

    // Aceitar todos os cookies
    if (acceptAllButton) {
        acceptAllButton.addEventListener("click", () => {
            functionalCheckbox.checked = true;
            saveCookiePreferences(true);
        });
    }

    // Salvar preferências selecionadas
    if (savePreferencesButton) {
        savePreferencesButton.addEventListener("click", () => {
            saveCookiePreferences(false);
        });
    }
});

/**
 * Obtém o consentimento de cookies salvo
 * 
 * @return {Object|null} Objeto com preferências ou null se não houver
 */
function getCookieConsent() {
    try {
        const consent = localStorage.getItem("cookieConsent");
        if (consent) {
            return JSON.parse(consent);
        }
    } catch (e) {
        console.error("Erro ao ler consentimento de cookies:", e);
    }
    return null;
}

/**
 * Verifica se um tipo específico de cookie foi aceito
 * 
 * @param {string} type Tipo de cookie ('essential', 'functional')
 * @return {boolean} True se aceito, False caso contrário
 */
function isCookieAccepted(type) {
    const consent = getCookieConsent();
    if (!consent) {
        // Se não há consentimento, apenas essenciais são permitidos
        return type === 'essential';
    }
    
    // Essenciais são sempre aceitos
    if (type === 'essential') {
        return true;
    }
    
    return consent[type] === true;
}