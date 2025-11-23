/**
 * Seletor de Idioma - Dropdown
 * 
 * Gerencia a abertura/fechamento do dropdown de idiomas
 * e salva a preferência do usuário por 1 semana
 */

document.addEventListener('DOMContentLoaded', () => {
    const languageButton = document.getElementById('languageButton');
    const languageDropdown = document.getElementById('languageDropdown');
    const languageContainer = document.querySelector('.language-dropdown');
    
    if (!languageButton || !languageDropdown || !languageContainer) {
        return; // Se não existir, não faz nada
    }
    
    // Abre/fecha o dropdown
    languageButton.addEventListener('click', (e) => {
        e.stopPropagation();
        const isExpanded = languageButton.getAttribute('aria-expanded') === 'true';
        languageButton.setAttribute('aria-expanded', !isExpanded);
        languageContainer.classList.toggle('active', !isExpanded);
    });
    
    // Fecha o dropdown ao clicar fora
    document.addEventListener('click', (e) => {
        if (!languageContainer.contains(e.target)) {
            languageButton.setAttribute('aria-expanded', 'false');
            languageContainer.classList.remove('active');
        }
    });
    
    // Fecha o dropdown ao pressionar ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && languageButton.getAttribute('aria-expanded') === 'true') {
            languageButton.setAttribute('aria-expanded', 'false');
            languageContainer.classList.remove('active');
            languageButton.focus();
        }
    });
    
    // Fecha o dropdown e salva preferência ao selecionar uma opção
    const languageOptions = languageDropdown.querySelectorAll('.language-option');
    languageOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            // Extrai o idioma da URL do link
            const href = option.getAttribute('href');
            const langMatch = href.match(/\/(pt|en|es)\//);
            if (langMatch) {
                const selectedLang = langMatch[1];
                saveLanguagePreference(selectedLang);
            }
            
            // Fecha o dropdown imediatamente
            languageButton.setAttribute('aria-expanded', 'false');
            languageContainer.classList.remove('active');
        });
    });
});

/**
 * Salva a preferência de idioma por 1 semana
 * 
 * @param {string} lang Código do idioma (pt, en, es)
 */
function saveLanguagePreference(lang) {
    // Verifica se cookies de funcionalidade foram aceitos
    if (typeof isCookieAccepted === 'function' && !isCookieAccepted('functional')) {
        // Se não aceitou cookies de funcionalidade, não salva
        return;
    }
    
    // Salva no localStorage com timestamp
    const preference = {
        lang: lang,
        timestamp: Date.now(),
        expiresIn: 7 * 24 * 60 * 60 * 1000 // 1 semana em milissegundos
    };
    
    localStorage.setItem('preferredLanguage', JSON.stringify(preference));
    
    // Também tenta salvar em cookie (se possível)
    const expireDate = new Date();
    expireDate.setTime(expireDate.getTime() + (7 * 24 * 60 * 60 * 1000));
    document.cookie = `preferred_language=${lang}; expires=${expireDate.toUTCString()}; path=/; SameSite=Lax`;
}

/**
 * Obtém a preferência de idioma salva (se ainda válida)
 * 
 * @return {string|null} Código do idioma ou null se expirado/não encontrado
 */
function getLanguagePreference() {
    try {
        const stored = localStorage.getItem('preferredLanguage');
        if (stored) {
            const preference = JSON.parse(stored);
            const now = Date.now();
            
            // Verifica se ainda está válido (não expirou)
            if (now - preference.timestamp < preference.expiresIn) {
                return preference.lang;
            } else {
                // Remove se expirado
                localStorage.removeItem('preferredLanguage');
            }
        }
    } catch (e) {
        console.error('Erro ao ler preferência de idioma:', e);
    }
    return null;
}

