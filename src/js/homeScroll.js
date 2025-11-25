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
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            // Tenta usar o data-target-url primeiro (mais confiável)
            let targetUrl = scrollIndicator.getAttribute('data-target-url');
            
            // Se não tiver data-target-url, constrói a URL baseado no pathname atual
            if (!targetUrl || targetUrl === '#' || targetUrl === '') {
                const currentPath = window.location.pathname;
                
                // Detecta o idioma do pathname (procura por /pt/, /en/ ou /es/ no início)
                let lang = 'pt'; // padrão
                const langMatch = currentPath.match(/^\/(pt|en|es)(\/|$)/);
                if (langMatch) {
                    lang = langMatch[1];
                }
                
                // Mapeia o caminho correto para "sobre" em cada idioma
                const sobrePath = lang === 'en' ? 'about' : 'sobre';
                
                // Constrói a URL completa
                targetUrl = `/${lang}/${sobrePath}`;
            }
            
            // Remove qualquer hash que possa estar no final
            if (targetUrl.includes('#')) {
                targetUrl = targetUrl.split('#')[0];
            }
            
            // Adiciona classe de fade-out + slide up
            smoothOpening.classList.add('fade-out-up');
            
            // Redireciona após a animação usando window.location.assign para garantir navegação completa
            setTimeout(() => {
                window.location.assign(targetUrl);
            }, 800); // Duração da animação
        }, { capture: true }); // Usa capture phase para garantir que seja executado primeiro
    }
})();
