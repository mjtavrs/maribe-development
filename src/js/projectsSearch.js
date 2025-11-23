/**
 * Projects Search Component
 * Gerencia a busca de projetos por título e cidade
 */

import projects from "./projectsData.js";

let searchInput = null;
let searchHelper = null;
let projectsContainer = null;
let currentSearchTerm = "";
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
 * Filtra projetos baseado no termo de busca
 */
function filterProjects(searchTerm) {
    if (!searchTerm || searchTerm.trim() === "") {
        return projects;
    }
    
    const normalizedTerm = searchTerm.toLowerCase().trim();
    
    return projects.filter(project => {
        const title = (project.titulo || "").toLowerCase();
        const city = (project.cidade || "").toLowerCase();
        
        return title.includes(normalizedTerm) || city.includes(normalizedTerm);
    });
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
    
    // Atualiza o helper do teclado
    if (searchHelper) {
        updateKeyboardHelper();
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
                searchHelper.style.display = "none";
            } else {
                // Mostra novamente se não estiver focado (apenas em desktop)
                if (window.innerWidth >= 768) {
                    searchHelper.style.display = "flex";
                }
            }
        }
        
        // Debounce: aguarda 300ms após o usuário parar de digitar
        searchTimeout = setTimeout(() => {
            const filteredProjects = filterProjects(currentSearchTerm);
            triggerProjectsUpdate(filteredProjects);
        }, 300);
    });
    
    // Esconde o helper quando o input recebe foco
    searchInput.addEventListener("focus", () => {
        if (searchHelper) {
            searchHelper.style.display = "none";
        }
    });
    
    // Mostra o helper quando o input perde foco (apenas em desktop)
    searchInput.addEventListener("blur", () => {
        if (searchHelper && window.innerWidth >= 768 && currentSearchTerm.trim() === "") {
            searchHelper.style.display = "flex";
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
    
    // Atualiza o helper quando a janela é redimensionada
    window.addEventListener("resize", () => {
        if (searchHelper) {
            if (window.innerWidth >= 768 && 
                currentSearchTerm.trim() === "" && 
                document.activeElement !== searchInput) {
                searchHelper.style.display = "flex";
            } else {
                searchHelper.style.display = "none";
            }
        }
    });
}

// Inicializa quando o DOM estiver pronto
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initSearch);
} else {
    initSearch();
}

