/**
 * Projects Filters Component
 * Gerencia os filtros por tipo de projeto (todos, residencial, comercial)
 */

import projects from "./projectsData.js";

let currentFilter = "todos";
let filterButtons = [];

/**
 * Filtra projetos por tipo e busca
 */
function filterByTypeAndSearch(type, searchTerm = "") {
    let result = projects;
    
    // Aplica filtro por tipo primeiro
    if (type !== "todos") {
        result = result.filter(project => project.tipo === type);
    }
    
    // Depois aplica busca se houver
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
 * Atualiza o estado visual dos botões de filtro
 */
function updateFilterButtons(activeFilter) {
    filterButtons.forEach(button => {
        const filterValue = button.getAttribute("data-filter");
        const isActive = filterValue === activeFilter;
        
        button.classList.toggle("active", isActive);
        button.setAttribute("aria-pressed", isActive.toString());
    });
}

/**
 * Dispara evento customizado para atualizar a lista de projetos
 */
function triggerProjectsUpdate(filteredProjects, filterType) {
    const event = new CustomEvent("projectsFilter", {
        detail: { projects: filteredProjects, filter: filterType }
    });
    document.dispatchEvent(event);
    
    // Também dispara evento de busca para que o projectsInjector.js seja atualizado
    const searchInput = document.getElementById("projectsSearchInput");
    const searchTerm = searchInput ? searchInput.value : "";
    const searchEvent = new CustomEvent("projectsSearch", {
        detail: { projects: filteredProjects, searchTerm: searchTerm, filter: filterType }
    });
    document.dispatchEvent(searchEvent);
}

/**
 * Inicializa os filtros
 */
function initFilters() {
    const filtersContainer = document.getElementById("projectsFilters");
    
    if (!filtersContainer) {
        console.error("Container de filtros não encontrado!");
        return;
    }
    
    filterButtons = Array.from(filtersContainer.querySelectorAll(".filter-button"));
    
    // Event listeners para cada botão de filtro
    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            const filterType = button.getAttribute("data-filter");
            
            if (filterType === currentFilter) {
                return; // Não faz nada se já está ativo
            }
            
            currentFilter = filterType;
            updateFilterButtons(currentFilter);
            
            // Obtém o termo de busca atual
            const searchInput = document.getElementById("projectsSearchInput");
            const searchTerm = searchInput ? searchInput.value : "";
            
            // Filtra os projetos combinando tipo e busca
            const filteredProjects = filterByTypeAndSearch(currentFilter, searchTerm);
            triggerProjectsUpdate(filteredProjects, currentFilter);
        });
    });
    
    // Inicializa com "todos" ativo
    updateFilterButtons("todos");
}

// Inicializa quando o DOM estiver pronto
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initFilters);
} else {
    initFilters();
}

// Exporta função para obter o filtro atual (para integração com busca)
export function getCurrentFilter() {
    return currentFilter;
}

// Escuta eventos de busca para atualizar filtro
document.addEventListener("projectsSearch", (e) => {
    const searchTerm = e.detail.searchTerm || "";
    const filteredProjects = filterByTypeAndSearch(currentFilter, searchTerm);
    triggerProjectsUpdate(filteredProjects, currentFilter);
});

// Exporta função para resetar o filtro (quando necessário)
export function resetFilter() {
    currentFilter = "todos";
    updateFilterButtons("todos");
    const searchInput = document.getElementById("projectsSearchInput");
    const searchTerm = searchInput ? searchInput.value : "";
    const filteredProjects = filterByTypeAndSearch("todos", searchTerm);
    triggerProjectsUpdate(filteredProjects, "todos");
}

