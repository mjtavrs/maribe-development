/**
 * Mobile Menu Controller
 * Controla a abertura e fechamento do menu mobile
 */

(function() {
    'use strict';

    // Aguarda o DOM estar pronto
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobileMenuToggle');
        const mainNav = document.getElementById('mainNav');
        const navLinks = mainNav ? mainNav.querySelectorAll('a') : [];

        if (!menuToggle || !mainNav) {
            return;
        }

        /**
         * Toggle do menu - abre/fecha
         */
        function toggleMenu() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            // Atualiza o estado do botão
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            
            // Adiciona/remove classe para animação
            if (!isExpanded) {
                mainNav.classList.add('menu-open');
                document.body.classList.add('menu-mobile-open');
                // Previne scroll do body quando menu está aberto
                document.body.style.overflow = 'hidden';
            } else {
                mainNav.classList.remove('menu-open');
                document.body.classList.remove('menu-mobile-open');
                // Restaura scroll do body
                document.body.style.overflow = '';
            }
        }

        /**
         * Fecha o menu
         */
        function closeMenu() {
            menuToggle.setAttribute('aria-expanded', 'false');
            mainNav.classList.remove('menu-open');
            document.body.classList.remove('menu-mobile-open');
            document.body.style.overflow = '';
        }

        // Event listener no botão hambúrguer (abrir)
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Previne que o clique feche o menu
            toggleMenu();
        });

        // Fecha o menu quando um link é clicado (mobile)
        navLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.stopPropagation(); // Previne que o clique no link feche o menu antes de navegar
                
                // Remove qualquer hash do href para garantir que vá apenas para a página
                const href = link.getAttribute('href');
                if (href && href.includes('#')) {
                    const urlWithoutHash = href.split('#')[0];
                    link.setAttribute('href', urlWithoutHash);
                }
                
                // Só fecha em mobile (quando o menu está visível)
                if (window.innerWidth < 768) {
                    closeMenu();
                }
            });
        });
        
        // Previne que cliques dentro do menu fechem o menu
        mainNav.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Fecha o menu ao clicar fora dele (mobile)
        // Detecta cliques no body/document que não sejam no menu
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 768 && mainNav.classList.contains('menu-open')) {
                const isClickInsideNav = mainNav.contains(e.target);
                const isClickOnToggle = menuToggle.contains(e.target);
                
                // Se clicou fora do menu e do toggle, fecha o menu
                if (!isClickInsideNav && !isClickOnToggle) {
                    closeMenu();
                }
            }
        });

        // Fecha o menu ao redimensionar a janela (se passar para desktop)
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 768 && mainNav.classList.contains('menu-open')) {
                    closeMenu();
                }
            }, 250);
        });

        // Fecha o menu com a tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mainNav.classList.contains('menu-open')) {
                closeMenu();
                menuToggle.focus(); // Retorna o foco para o botão
            }
        });
    });
})();

