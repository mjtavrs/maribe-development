/**
 * Home Page Transition
 * 
 * Gerencia a transição de fade-out + slide up ao clicar no chevron
 */

(function () {
    'use strict';

    // Aguarda o DOM estar pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        const scrollIndicator = document.getElementById('scrollIndicator');
        const smoothOpening = document.getElementById('smoothOpening');

        if (!scrollIndicator || !smoothOpening) {
            return; // Não está na página home
        }

        // Adiciona classe de transição ao clicar no chevron
        scrollIndicator.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Pega a URL diretamente do href, garantindo que seja a página sobre
            let targetUrl = scrollIndicator.getAttribute('href');
            
            // Remove qualquer hash que possa estar no final
            if (targetUrl && targetUrl.includes('#')) {
                targetUrl = targetUrl.split('#')[0];
            }
            
            // Se ainda não tiver uma URL válida, constrói manualmente
            if (!targetUrl || targetUrl.includes('index')) {
                const currentPath = window.location.pathname;
                const lang = currentPath.match(/^\/(pt|en|es)/)?.[1] || 'pt';
                const sobrePath = lang === 'en' ? 'about' : 'sobre';
                targetUrl = `/${lang}/${sobrePath}`;
            }
            
            // Adiciona classe de fade-out + slide up
            smoothOpening.classList.add('fade-out-up');
            
            // Redireciona após a animação
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 800); // Duração da animação
        });
    }
})();
