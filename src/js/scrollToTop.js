(function () {
    'use strict';

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeFloatingActionWidget);
        return;
    }

    initializeFloatingActionWidget();

    function initializeFloatingActionWidget() {
        const floatingActionWidget = document.getElementById('floatingActionWidget');
        const scrollToTopButton = document.getElementById('scrollToTopButton');

        if (!floatingActionWidget || !scrollToTopButton) {
            return;
        }

        let isTicking = false;

        function getScrollThreshold() {
            const viewportWidth = window.visualViewport ? window.visualViewport.width : window.innerWidth;

            return viewportWidth <= 767 ? 150 : 280;
        }

        function updateWidgetVisibility() {
            if (window.scrollY >= getScrollThreshold()) {
                floatingActionWidget.classList.add('visible');
            } else {
                floatingActionWidget.classList.remove('visible');
            }

            isTicking = false;
        }

        function handleScroll() {
            if (isTicking) {
                return;
            }

            window.requestAnimationFrame(updateWidgetVisibility);
            isTicking = true;
        }

        window.addEventListener('scroll', handleScroll, { passive: true });

        scrollToTopButton.addEventListener('click', function (event) {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        updateWidgetVisibility();
    }
})();
