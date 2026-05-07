(function () {
    'use strict';

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeFloatingActionWidget);
        return;
    }

    initializeFloatingActionWidget();

    function initializeFloatingActionWidget() {
        const observerUtils = window.MaribeIntersectionObserverUtils;
        const floatingActionWidget = document.getElementById('floatingActionWidget');
        const scrollToTopButton = document.getElementById('scrollToTopButton');

        if (!floatingActionWidget || !scrollToTopButton) {
            return;
        }

        let isTicking = false;
        let resizeFrame = null;
        let currentThreshold = 0;
        let widgetVisibilityObserver = null;
        let widgetVisibilitySentinel = null;

        function getScrollThreshold() {
            const viewportWidth = window.visualViewport ? window.visualViewport.width : window.innerWidth;

            return viewportWidth <= 767 ? 150 : 280;
        }

        function setWidgetVisibility(isVisible) {
            floatingActionWidget.classList.toggle('visible', isVisible);
        }

        function updateWidgetVisibility() {
            setWidgetVisibility(window.scrollY >= getScrollThreshold());
            isTicking = false;
        }

        function handleScroll() {
            if (isTicking) {
                return;
            }

            window.requestAnimationFrame(updateWidgetVisibility);
            isTicking = true;
        }

        function disconnectWidgetObserver() {
            if (widgetVisibilityObserver && typeof widgetVisibilityObserver.disconnect === 'function') {
                widgetVisibilityObserver.disconnect();
            }

            widgetVisibilityObserver = null;
        }

        function createWidgetVisibilitySentinel() {
            if (!widgetVisibilitySentinel) {
                widgetVisibilitySentinel = document.createElement('span');
                widgetVisibilitySentinel.setAttribute('aria-hidden', 'true');
                widgetVisibilitySentinel.style.position = 'absolute';
                widgetVisibilitySentinel.style.top = '0';
                widgetVisibilitySentinel.style.left = '0';
                widgetVisibilitySentinel.style.width = '1px';
                widgetVisibilitySentinel.style.opacity = '0';
                widgetVisibilitySentinel.style.pointerEvents = 'none';
                widgetVisibilitySentinel.style.userSelect = 'none';
                document.body.insertBefore(widgetVisibilitySentinel, document.body.firstChild);
            }

            widgetVisibilitySentinel.style.height = currentThreshold + 'px';
        }

        function initializeObserverVisibility() {
            currentThreshold = getScrollThreshold();
            createWidgetVisibilitySentinel();
            disconnectWidgetObserver();
            setWidgetVisibility(window.scrollY >= currentThreshold);

            widgetVisibilityObserver = observerUtils.observeVisibility(widgetVisibilitySentinel, {
                threshold: 0,
                onEnter: function () {
                    setWidgetVisibility(false);
                },
                onExit: function () {
                    setWidgetVisibility(true);
                }
            });
        }

        function handleObserverResize() {
            if (resizeFrame !== null) {
                return;
            }

            resizeFrame = window.requestAnimationFrame(function () {
                const nextThreshold = getScrollThreshold();

                if (nextThreshold !== currentThreshold) {
                    initializeObserverVisibility();
                }

                resizeFrame = null;
            });
        }

        scrollToTopButton.addEventListener('click', function (event) {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        if (observerUtils && observerUtils.isSupported()) {
            initializeObserverVisibility();
            window.addEventListener('resize', handleObserverResize, { passive: true });

            if (window.visualViewport) {
                window.visualViewport.addEventListener('resize', handleObserverResize, { passive: true });
            }

            return;
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        updateWidgetVisibility();
    }
})();
