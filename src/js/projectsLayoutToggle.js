const STORAGE_KEY = "maribeProjectsLayout";
const DEFAULT_LAYOUT = "2";
const LAYOUT_ANIMATION_DURATION = 360;
const VALID_LAYOUTS = new Set(["2", "3"]);

function getStoredLayout() {
    try {
        const layout = window.localStorage.getItem(STORAGE_KEY);
        return VALID_LAYOUTS.has(layout) ? layout : DEFAULT_LAYOUT;
    } catch {
        return DEFAULT_LAYOUT;
    }
}

function storeLayout(layout) {
    try {
        window.localStorage.setItem(STORAGE_KEY, layout);
    } catch {
        return;
    }
}

function applyLayout(projectsContainer, buttons, layout) {
    projectsContainer.classList.remove("projects-layout-2", "projects-layout-3");
    projectsContainer.classList.add(`projects-layout-${layout}`);

    buttons.forEach(button => {
        const isActive = button.getAttribute("data-projects-layout") === layout;
        button.classList.toggle("active", isActive);
        button.setAttribute("aria-pressed", isActive.toString());
    });
}

function getProjectRects(projectsContainer) {
    return new Map(
        Array.from(projectsContainer.querySelectorAll("article")).map(project => [
            project,
            project.getBoundingClientRect()
        ])
    );
}

function shouldReduceMotion() {
    return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
}

function animateLayoutChange(projectsContainer, buttons, layout) {
    if (shouldReduceMotion()) {
        applyLayout(projectsContainer, buttons, layout);
        return;
    }

    const previousRects = getProjectRects(projectsContainer);

    applyLayout(projectsContainer, buttons, layout);

    requestAnimationFrame(() => {
        previousRects.forEach((previousRect, project) => {
            const currentRect = project.getBoundingClientRect();
            const deltaX = previousRect.left - currentRect.left;
            const deltaY = previousRect.top - currentRect.top;
            const scaleX = previousRect.width / currentRect.width;
            const scaleY = previousRect.height / currentRect.height;

            project.animate(
                [
                    {
                        transform: `translate(${deltaX}px, ${deltaY}px) scale(${scaleX}, ${scaleY})`,
                        opacity: 0.85
                    },
                    {
                        transform: "translate(0, 0) scale(1, 1)",
                        opacity: 1
                    }
                ],
                {
                    duration: LAYOUT_ANIMATION_DURATION,
                    easing: "cubic-bezier(0.22, 1, 0.36, 1)"
                }
            );
        });
    });
}

function initProjectsLayoutToggle() {
    const projectsContainer = document.getElementById("projectsContainer");
    const toggleContainer = document.getElementById("projectsLayoutToggle");

    if (!projectsContainer || !toggleContainer) {
        return;
    }

    const buttons = Array.from(toggleContainer.querySelectorAll(".layout-toggle-button"));

    if (buttons.length === 0) {
        return;
    }

    applyLayout(projectsContainer, buttons, getStoredLayout());

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const layout = button.getAttribute("data-projects-layout");

            if (!VALID_LAYOUTS.has(layout)) {
                return;
            }

            if (button.getAttribute("aria-pressed") === "true") {
                return;
            }

            animateLayoutChange(projectsContainer, buttons, layout);
            storeLayout(layout);
        });
    });
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initProjectsLayoutToggle);
} else {
    initProjectsLayoutToggle();
}
