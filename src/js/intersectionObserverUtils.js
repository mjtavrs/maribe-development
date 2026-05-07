(function () {
    'use strict';

    function isSupported() {
        return (
            typeof window !== 'undefined' &&
            'IntersectionObserver' in window &&
            'IntersectionObserverEntry' in window
        );
    }

    function observeVisibility(element, options) {
        const settings = options || {};

        if (!element || !isSupported()) {
            return {
                disconnect: function () {}
            };
        }

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    if (typeof settings.onEnter === 'function') {
                        settings.onEnter(entry, observer);
                    }

                    if (settings.once) {
                        observer.unobserve(element);
                    }

                    return;
                }

                if (typeof settings.onExit === 'function') {
                    settings.onExit(entry, observer);
                }
            });
        }, {
            root: null,
            rootMargin: settings.rootMargin || '0px',
            threshold: typeof settings.threshold === 'undefined' ? 0 : settings.threshold
        });

        observer.observe(element);

        return {
            disconnect: function () {
                observer.unobserve(element);
                observer.disconnect();
            }
        };
    }

    window.MaribeIntersectionObserverUtils = {
        isSupported: isSupported,
        observeVisibility: observeVisibility
    };
})();
