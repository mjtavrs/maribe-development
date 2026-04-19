(function () {
    'use strict';

    const defaultPreferences = {
        textSize: 'default',
        contrast: 'default',
        links: 'default',
        focus: 'default',
        motion: 'default',
        letterSpacing: 'default',
        lineHeight: 'default'
    };

    const state = {
        activeTrigger: null,
        isOpen: false,
        isHelpOpen: false,
        previousBodyOverflow: ''
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeAccessibilityWidget);
        return;
    }

    initializeAccessibilityWidget();

    function initializeAccessibilityWidget() {
        const root = document.getElementById('accessibilityWidget');

        if (!root) {
            return;
        }

        const panel = document.getElementById('accessibilityWidgetPanel');
        const backdrop = document.getElementById('accessibilityWidgetBackdrop');
        const helpLayer = root.querySelector('[data-accessibility-help-layer]');
        const helpModal = document.getElementById('accessibilityWidgetHelpModal');
        const closeButtons = root.querySelectorAll('[data-accessibility-close]');
        const helpOpenButton = root.querySelector('[data-accessibility-help-open]');
        const helpCloseButtons = root.querySelectorAll('[data-accessibility-help-close]');
        const resetButton = root.querySelector('[data-accessibility-reset]');
        const resetContainer = root.querySelector('[data-accessibility-reset-container]');
        const featureCards = root.querySelectorAll('[data-accessibility-card]');
        const openTriggers = document.querySelectorAll('[data-accessibility-open]');
        const liveRegion = document.getElementById('accessibilityWidgetLiveRegion');
        const floatingActionWidget = document.getElementById('floatingActionWidget');

        const storageKey = root.dataset.storageKey || 'maribeAccessibilityPreferences';
        const announcements = {
            updated: root.dataset.preferencesUpdated || 'Accessibility preferences updated.',
            reset: root.dataset.preferencesReset || 'Accessibility preferences restored.'
        };

        initializeViewportLayout(floatingActionWidget);
        applyPreferences(getStoredPreferences(storageKey));
        refreshInterface();

        closeButtons.forEach((button) => {
            button.addEventListener('click', closePanel);
        });

        if (helpOpenButton) {
            helpOpenButton.addEventListener('click', openHelpModal);
        }

        helpCloseButtons.forEach((button) => {
            button.addEventListener('click', closeHelpModal);
        });

        featureCards.forEach((card) => {
            card.addEventListener('click', function () {
                const setting = card.dataset.accessibilitySetting;
                const cycleValues = getCycleValues(card);

                if (!setting || cycleValues.length === 0) {
                    return;
                }

                const currentPreferences = readCurrentPreferences();
                const currentValue = currentPreferences[setting];
                const currentIndex = cycleValues.indexOf(currentValue);
                const nextValue = currentIndex === -1
                    ? cycleValues[0]
                    : (currentIndex === cycleValues.length - 1 ? defaultPreferences[setting] : cycleValues[currentIndex + 1]);
                const nextPreferences = {
                    ...currentPreferences,
                    [setting]: nextValue
                };

                savePreferences(storageKey, nextPreferences);
                applyPreferences(nextPreferences);
                refreshInterface();
                announce(liveRegion, announcements.updated);
            });
        });

        if (resetButton) {
            resetButton.addEventListener('click', function () {
                savePreferences(storageKey, defaultPreferences);
                applyPreferences(defaultPreferences);
                refreshInterface();
                announce(liveRegion, announcements.reset);
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', closePanel);
        }

        document.addEventListener('keydown', function (event) {
            if (!state.isOpen) {
                return;
            }

            if (event.key === 'Escape') {
                event.preventDefault();

                if (state.isHelpOpen) {
                    closeHelpModal();
                    return;
                }

                closePanel();
                return;
            }

            if (event.key === 'Tab') {
                trapFocus(event, state.isHelpOpen ? helpModal : panel);
            }
        });

        document.addEventListener('click', function (event) {
            const openTrigger = event.target.closest('[data-accessibility-open]');

            if (!openTrigger) {
                return;
            }

            event.preventDefault();
            openPanel(openTrigger);
        });

        window.MaribeAccessibilityWidget = {
            openPanel,
            closePanel,
            getPreferences: readCurrentPreferences,
            resetPreferences: function () {
                savePreferences(storageKey, defaultPreferences);
                applyPreferences(defaultPreferences);
                refreshInterface();
                announce(liveRegion, announcements.reset);
            },
            applyPreferences: function (preferences) {
                const nextPreferences = normalizePreferences(preferences);
                savePreferences(storageKey, nextPreferences);
                applyPreferences(nextPreferences);
                refreshInterface();
            }
        };

        function refreshInterface() {
            const currentPreferences = readCurrentPreferences();

            syncFeatureCards(featureCards, currentPreferences);
            syncResetButton(panel, resetButton, resetContainer, currentPreferences);
        }

        function openPanel(triggerElement) {
            if (!panel || !backdrop) {
                return;
            }

            state.activeTrigger = triggerElement || document.activeElement || null;
            state.isOpen = true;
            state.isHelpOpen = false;
            refreshInterface();

            openTriggers.forEach((trigger) => {
                trigger.setAttribute('aria-expanded', 'true');
            });

            panel.hidden = false;
            backdrop.hidden = false;

            requestAnimationFrame(function () {
                panel.classList.add('is-open');
                backdrop.classList.add('is-open');
            });

            panel.setAttribute('aria-hidden', 'false');
            closeHelpModal({ restoreFocus: false });
            lockBodyScroll();

            const firstFocusableElement = getFocusableElements(panel)[0];

            if (firstFocusableElement) {
                firstFocusableElement.focus();
                return;
            }

            panel.focus();
        }

        function closePanel() {
            if (!panel || !backdrop || !state.isOpen) {
                return;
            }

            state.isOpen = false;
            closeHelpModal({ restoreFocus: false });
            refreshInterface();
            panel.classList.remove('is-open');
            backdrop.classList.remove('is-open');
            panel.setAttribute('aria-hidden', 'true');
            openTriggers.forEach((trigger) => {
                trigger.setAttribute('aria-expanded', 'false');
            });
            unlockBodyScroll();

            window.setTimeout(function () {
                panel.hidden = true;
                backdrop.hidden = true;
            }, 220);

            if (state.activeTrigger && typeof state.activeTrigger.focus === 'function') {
                state.activeTrigger.focus();
            }

            state.activeTrigger = null;
        }

        function openHelpModal() {
            if (!helpLayer || !helpModal) {
                return;
            }

            state.isHelpOpen = true;
            helpLayer.hidden = false;

            requestAnimationFrame(function () {
                helpLayer.classList.add('is-open');
                helpModal.classList.add('is-open');
            });

            const firstFocusableElement = getFocusableElements(helpModal)[0];

            if (firstFocusableElement) {
                firstFocusableElement.focus();
                return;
            }

            helpModal.focus();
        }

        function closeHelpModal(options) {
            const closeOptions = {
                restoreFocus: true,
                ...(options || {})
            };

            if (!helpLayer || !helpModal) {
                return;
            }

            state.isHelpOpen = false;
            helpLayer.classList.remove('is-open');
            helpModal.classList.remove('is-open');

            window.setTimeout(function () {
                helpLayer.hidden = true;
            }, 180);

            if (closeOptions.restoreFocus && helpOpenButton && state.isOpen) {
                helpOpenButton.focus();
            }
        }
    }

    function getStoredPreferences(storageKey) {
        try {
            const storedPreferences = window.localStorage.getItem(storageKey);

            if (!storedPreferences) {
                return defaultPreferences;
            }

            return normalizePreferences(JSON.parse(storedPreferences));
        } catch (error) {
            return defaultPreferences;
        }
    }

    function savePreferences(storageKey, preferences) {
        try {
            window.localStorage.setItem(storageKey, JSON.stringify(normalizePreferences(preferences)));
        } catch (error) {
            return;
        }
    }

    function normalizePreferences(preferences) {
        return {
            ...defaultPreferences,
            ...(preferences || {})
        };
    }

    function readCurrentPreferences() {
        const htmlElement = document.documentElement;
        const bodyElement = document.body;

        return normalizePreferences({
            textSize: htmlElement.dataset.a11yTextSize,
            contrast: bodyElement.dataset.a11yContrast,
            links: bodyElement.dataset.a11yLinks,
            focus: bodyElement.dataset.a11yFocus,
            motion: bodyElement.dataset.a11yMotion,
            letterSpacing: bodyElement.dataset.a11yLetterSpacing,
            lineHeight: bodyElement.dataset.a11yLineHeight
        });
    }

    function applyPreferences(preferences) {
        const nextPreferences = normalizePreferences(preferences);
        const htmlElement = document.documentElement;
        const bodyElement = document.body;

        htmlElement.dataset.a11yTextSize = nextPreferences.textSize;
        bodyElement.dataset.a11yContrast = nextPreferences.contrast;
        bodyElement.dataset.a11yLinks = nextPreferences.links;
        bodyElement.dataset.a11yFocus = nextPreferences.focus;
        bodyElement.dataset.a11yMotion = nextPreferences.motion;
        bodyElement.dataset.a11yLetterSpacing = nextPreferences.letterSpacing;
        bodyElement.dataset.a11yLineHeight = nextPreferences.lineHeight;
    }

    function syncFeatureCards(featureCards, currentPreferences) {
        featureCards.forEach((card) => {
            const setting = card.dataset.accessibilityCard;
            const currentValue = currentPreferences[setting];
            const cycleValues = getCycleValues(card);
            const activeIndex = cycleValues.indexOf(currentValue);
            const isActive = activeIndex !== -1;
            const dots = card.querySelectorAll('.accessibility-widget__choice-dot');

            card.classList.toggle('is-active', isActive);
            card.setAttribute('aria-pressed', isActive ? 'true' : 'false');

            dots.forEach((dot, index) => {
                const shouldShow = isActive;
                const isDotActive = index === activeIndex;

                dot.hidden = !shouldShow;
                dot.classList.toggle('is-active', isDotActive);
            });
        });
    }

    function getCycleValues(card) {
        const rawCycleValues = card.dataset.cycleValues || '';

        return rawCycleValues
            .split(',')
            .map(function (value) {
                return value.trim();
            })
            .filter(Boolean);
    }

    function syncResetButton(panel, resetButton, resetContainer, currentPreferences) {
        if (!panel || !resetButton || !resetContainer) {
            return;
        }

        const hasActiveSettings = Object.keys(defaultPreferences).some(function (setting) {
            return currentPreferences[setting] !== defaultPreferences[setting];
        });

        panel.classList.toggle('has-reset', hasActiveSettings);
        resetContainer.classList.toggle('is-visible', hasActiveSettings);
        resetButton.disabled = !hasActiveSettings;
        resetButton.setAttribute('aria-hidden', hasActiveSettings ? 'false' : 'true');
        resetButton.tabIndex = hasActiveSettings ? 0 : -1;
    }

    function announce(liveRegion, message) {
        if (!liveRegion) {
            return;
        }

        liveRegion.textContent = '';

        window.setTimeout(function () {
            liveRegion.textContent = message;
        }, 20);
    }

    function getFocusableElements(container) {
        if (!container) {
            return [];
        }

        return Array.from(
            container.querySelectorAll(
                'button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
            )
        ).filter(function (element) {
            return !element.hidden && element.getAttribute('aria-hidden') !== 'true';
        });
    }

    function trapFocus(event, container) {
        const focusableElements = getFocusableElements(container);

        if (focusableElements.length === 0) {
            event.preventDefault();
            container.focus();
            return;
        }

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        const activeElement = document.activeElement;

        if (event.shiftKey && activeElement === firstElement) {
            event.preventDefault();
            lastElement.focus();
        }

        if (!event.shiftKey && activeElement === lastElement) {
            event.preventDefault();
            firstElement.focus();
        }
    }

    function lockBodyScroll() {
        const bodyElement = document.body;

        if (bodyElement.dataset.accessibilityScrollLock === 'true') {
            return;
        }

        state.previousBodyOverflow = bodyElement.style.overflow;
        bodyElement.style.overflow = 'hidden';
        bodyElement.dataset.accessibilityScrollLock = 'true';
    }

    function unlockBodyScroll() {
        const bodyElement = document.body;

        if (bodyElement.dataset.accessibilityScrollLock !== 'true') {
            return;
        }

        bodyElement.style.overflow = state.previousBodyOverflow;
        delete bodyElement.dataset.accessibilityScrollLock;
    }

    function initializeViewportLayout(floatingActionWidget) {
        updateViewportLayout(floatingActionWidget);

        window.addEventListener('resize', function () {
            updateViewportLayout(floatingActionWidget);
        }, { passive: true });

        window.addEventListener('orientationchange', function () {
            updateViewportLayout(floatingActionWidget);
        }, { passive: true });

        if (!window.visualViewport) {
            return;
        }

        window.visualViewport.addEventListener('resize', function () {
            updateViewportLayout(floatingActionWidget);
        });

        window.visualViewport.addEventListener('scroll', function () {
            updateViewportLayout(floatingActionWidget);
        });
    }

    function updateViewportLayout(floatingActionWidget) {
        const viewport = getViewportMetrics();
        const rootStyle = document.documentElement.style;
        const isMobile = viewport.width <= 767;
        const panelWidth = isMobile
            ? Math.max(Math.min(viewport.width - 20, 430), 280)
            : Math.max(Math.min(viewport.width - 32, 760), 320);
        const panelHeight = isMobile
            ? Math.max(viewport.height - 20, 320)
            : Math.max(Math.min(viewport.height - 32, 800), 360);
        const panelLeft = isMobile
            ? viewport.left + Math.max((viewport.width - panelWidth) / 2, 10)
            : viewport.left + (viewport.width / 2);
        const panelTop = isMobile
            ? viewport.top + 10
            : viewport.top + (viewport.height / 2);

        rootStyle.setProperty('--a11y-viewport-left', formatPixelValue(viewport.left));
        rootStyle.setProperty('--a11y-viewport-top', formatPixelValue(viewport.top));
        rootStyle.setProperty('--a11y-viewport-width', formatPixelValue(viewport.width));
        rootStyle.setProperty('--a11y-viewport-height', formatPixelValue(viewport.height));
        rootStyle.setProperty('--a11y-panel-left', formatPixelValue(panelLeft));
        rootStyle.setProperty('--a11y-panel-top', formatPixelValue(panelTop));
        rootStyle.setProperty('--a11y-panel-width', formatPixelValue(panelWidth));
        rootStyle.setProperty('--a11y-panel-max-height', formatPixelValue(panelHeight));

        if (!floatingActionWidget) {
            return;
        }

        const widgetWidth = floatingActionWidget.offsetWidth || (isMobile ? 105 : 109);
        const widgetHeight = floatingActionWidget.offsetHeight || (isMobile ? 52 : 54);
        const widgetBottomOffset = isMobile ? 20 : (viewport.width >= 1024 ? 50 : 40);
        const widgetLeft = viewport.left + Math.max(viewport.width - widgetWidth, 0);
        const widgetTop = viewport.top + Math.max(viewport.height - widgetHeight - widgetBottomOffset, 0);

        rootStyle.setProperty('--a11y-widget-left', formatPixelValue(widgetLeft));
        rootStyle.setProperty('--a11y-widget-top', formatPixelValue(widgetTop));
    }

    function getViewportMetrics() {
        if (window.visualViewport) {
            return {
                left: window.visualViewport.offsetLeft,
                top: window.visualViewport.offsetTop,
                width: window.visualViewport.width,
                height: window.visualViewport.height
            };
        }

        return {
            left: 0,
            top: 0,
            width: window.innerWidth,
            height: window.innerHeight
        };
    }

    function formatPixelValue(value) {
        return Math.round(value) + 'px';
    }
})();
