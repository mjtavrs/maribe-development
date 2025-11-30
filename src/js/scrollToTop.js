/**
 * Botão Scroll to Top
 * 
 * Aparece após 280px de scroll (altura do header) e leva o usuário de volta ao topo
 */

(function() {
    'use strict';

    // Aguarda o DOM estar pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        const scrollToTopButton = document.getElementById('scrollToTopButton');
        
        if (!scrollToTopButton) {
            return;
        }

        const scrollThreshold = 280;
        let ticking = false;

        function updateButtonVisibility() {
            const scrollY = window.scrollY;

            if (scrollY >= scrollThreshold) {
                scrollToTopButton.classList.add('visible');
            } else {
                scrollToTopButton.classList.remove('visible');
            }

            ticking = false;
        }

        function onScroll() {
            if (!ticking) {
                window.requestAnimationFrame(updateButtonVisibility);
                ticking = true;
            }
        }

        // Adiciona o listener de scroll
        window.addEventListener('scroll', onScroll, { passive: true });

        // Handler para o clique no botão
        scrollToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Verifica o estado inicial
        updateButtonVisibility();
    }
})();

