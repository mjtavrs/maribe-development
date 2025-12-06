/**
 * Projects Search Component
 * Gerencia a busca de projetos por título e cidade
 */

import projects from "./projectsData.js";

let searchInput = null;
let searchHelper = null;
let projectsContainer = null;
let currentSearchTerm = "";
let currentFilterType = "todos";
let searchTimeout = null;

/**
 * Detecta se o sistema operacional é Mac
 */
function isMac() {
    return /Mac|iPhone|iPad|iPod/.test(navigator.platform) || 
           /Mac|iPhone|iPad|iPod/.test(navigator.userAgent);
}

/**
 * Atualiza o helper do teclado baseado no sistema operacional
 */
function updateKeyboardHelper() {
    if (!searchHelper) return;
    
    const isMacOS = isMac();
    
    if (isMacOS) {
        searchHelper.innerHTML = '<kbd>⌘</kbd><span>+</span><kbd>K</kbd>';
    } else {
        searchHelper.innerHTML = '<kbd>Ctrl</kbd><span>+</span><kbd>K</kbd>';
    }
}

/**
 * Atualiza o placeholder do input baseado no tamanho da tela
 */
function updatePlaceholder() {
    if (!searchInput) return;
    
    const isMobile = window.innerWidth < 768;
    const desktopPlaceholder = searchInput.getAttribute('data-placeholder-desktop');
    const mobilePlaceholder = searchInput.getAttribute('data-placeholder-mobile');
    
    if (isMobile && mobilePlaceholder) {
        searchInput.placeholder = mobilePlaceholder;
        searchInput.setAttribute('aria-label', mobilePlaceholder);
    } else if (desktopPlaceholder) {
        searchInput.placeholder = desktopPlaceholder;
        searchInput.setAttribute('aria-label', desktopPlaceholder);
    }
}

/**
 * Filtra projetos baseado no termo de busca e tipo
 */
function filterProjects(searchTerm, filterType = "todos") {
    let result = projects;
    
    // Aplica filtro por tipo primeiro
    if (filterType !== "todos") {
        result = result.filter(project => project.tipo === filterType);
    }
    
    // Depois aplica busca
    if (searchTerm && searchTerm.trim() !== "") {
        const normalizedTerm = searchTerm.toLowerCase().trim();
        result = result.filter(project => {
            const title = (project.titulo || "").toLowerCase();
            const city = (project.cidade || "").toLowerCase();
            return title.includes(normalizedTerm) || city.includes(normalizedTerm);
        });
    }
    
    return result;
}

/**
 * Dispara evento customizado para atualizar a lista de projetos
 */
function triggerProjectsUpdate(filteredProjects) {
    const event = new CustomEvent("projectsSearch", {
        detail: { projects: filteredProjects, searchTerm: currentSearchTerm }
    });
    document.dispatchEvent(event);
}

/**
 * Inicializa a busca
 */
function initSearch() {
    searchInput = document.getElementById("projectsSearchInput");
    searchHelper = document.getElementById("searchKeyboardHelper");
    projectsContainer = document.getElementById("projectsContainer");
    
    if (!searchInput || !projectsContainer) {
        console.error("Elementos de busca não encontrados!");
        return;
    }
    
    // Atualiza o placeholder baseado no tamanho da tela
    updatePlaceholder();
    
    // Atualiza o helper do teclado
    if (searchHelper) {
        updateKeyboardHelper();
        // Inicializa a visibilidade baseada no tamanho da tela
        if (window.innerWidth >= 768) {
            searchHelper.style.opacity = "1";
            searchHelper.style.visibility = "visible";
        } else {
            searchHelper.style.opacity = "0";
            searchHelper.style.visibility = "hidden";
        }
    }
    
    // Event listener para busca em tempo real com debounce
    searchInput.addEventListener("input", (e) => {
        currentSearchTerm = e.target.value;
        
        // Limpa o timeout anterior
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        // Esconde o helper quando o input está focado e tem conteúdo
        if (searchHelper) {
            if (e.target.value.trim() !== "" || document.activeElement === searchInput) {
                searchHelper.style.opacity = "0";
                searchHelper.style.visibility = "hidden";
            } else {
                // Mostra novamente se não estiver focado (apenas em desktop)
                if (window.innerWidth >= 768) {
                    searchHelper.style.opacity = "1";
                    searchHelper.style.visibility = "visible";
                }
            }
        }
        
        // Debounce: aguarda 1 segundo após o usuário parar de digitar
        searchTimeout = setTimeout(() => {
            const filteredProjects = filterProjects(currentSearchTerm, currentFilterType);
            triggerProjectsUpdate(filteredProjects);
        }, 1000);
    });
    
    // Esconde o helper quando o input recebe foco
    searchInput.addEventListener("focus", () => {
        if (searchHelper) {
            searchHelper.style.opacity = "0";
            searchHelper.style.visibility = "hidden";
        }
    });
    
    // Mostra o helper quando o input perde foco (apenas em desktop)
    searchInput.addEventListener("blur", () => {
        if (searchHelper && window.innerWidth >= 768 && currentSearchTerm.trim() === "") {
            searchHelper.style.opacity = "1";
            searchHelper.style.visibility = "visible";
        }
    });
    
    // Atalho de teclado global (Ctrl+K ou Cmd+K)
    document.addEventListener("keydown", (e) => {
        const isMacOS = isMac();
        const isModifierPressed = isMacOS ? e.metaKey : e.ctrlKey;
        
        // Previne o comportamento padrão apenas se não estiver em um input/textarea
        if (isModifierPressed && e.key === "k" && 
            document.activeElement.tagName !== "INPUT" && 
            document.activeElement.tagName !== "TEXTAREA") {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
    });
    
    // Atualiza o helper e placeholder quando a janela é redimensionada
    window.addEventListener("resize", () => {
        updatePlaceholder();
        
        if (searchHelper) {
            if (window.innerWidth >= 768 && 
                currentSearchTerm.trim() === "" && 
                document.activeElement !== searchInput) {
                searchHelper.style.opacity = "1";
                searchHelper.style.visibility = "visible";
            } else {
                searchHelper.style.opacity = "0";
                searchHelper.style.visibility = "hidden";
            }
        }
    });
}

// Escuta eventos de filtro para atualizar busca
document.addEventListener("projectsFilter", (e) => {
    currentFilterType = e.detail.filter || "todos";
    // Não dispara evento aqui, pois o filtro já dispara o evento de busca
    // Apenas atualiza o tipo de filtro atual para futuras buscas
});

// Inicializa quando o DOM estiver pronto
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initSearch);
} else {
    initSearch();
}

