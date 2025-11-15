/**
 * Seletor de Idioma - Dropdown
 * 
 * Gerencia a abertura/fechamento do dropdown de idiomas
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
    
    // Fecha o dropdown ao selecionar uma opção (navegação já acontece via link)
    const languageOptions = languageDropdown.querySelectorAll('.language-option');
    languageOptions.forEach(option => {
        option.addEventListener('click', () => {
            // O link já faz a navegação, mas podemos fechar o dropdown imediatamente
            languageButton.setAttribute('aria-expanded', 'false');
            languageContainer.classList.remove('active');
        });
    });
});

