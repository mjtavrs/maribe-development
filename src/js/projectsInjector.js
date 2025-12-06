import projects from "./projectsData.js";

function normalizeAssetPath(path) {
    if (!path) return path;
    return path.startsWith("/") ? path : `/${path}`;
}

function slugify(text) {
    return String(text)
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "") // remove acentos
        .replace(/[^a-z0-9]+/g, "-")     // não alfanumérico -> hífen
        .replace(/^-+|-+$/g, "");        // trim hífens
}

/**
 * Detecta o idioma atual baseado na URL
 */
function detectCurrentLanguage() {
    const pathname = window.location.pathname;
    const match = pathname.match(/^\/(pt|en|es)\//);
    return match ? match[1] : 'pt';
}

/**
 * Gera alt text dinâmico para imagens de projetos
 * 
 * @param {string} type Tipo de alt text ('projectCover', 'projectCoverWithCity', 'projectImage', 'projectImageNumber')
 * @param {Object} project Dados do projeto
 * @param {number} imageNumber Número da imagem (para projectImageNumber)
 * @param {number} totalImages Total de imagens (para projectImageNumber)
 * @returns {string} Alt text traduzido
 */
function generateImageAltText(type, project, imageNumber = null, totalImages = null) {
    const lang = detectCurrentLanguage();
    
    // Verifica se as traduções estão disponíveis
    if (!window.altTextTranslations || !window.altTextTranslations[lang]) {
        // Fallback em português
        if (type === 'projectCoverWithCity' && project.cidade) {
            return `Capa do projeto ${project.titulo} em ${project.cidade}`;
        } else if (type === 'projectCover') {
            return `Capa do projeto ${project.titulo}`;
        } else {
            return `${project.titulo}${project.cidade ? ` - ${project.cidade}` : ''}`;
        }
    }
    
    const templates = window.altTextTranslations[lang];
    let template = '';
    
    if (type === 'projectCoverWithCity' && project.cidade) {
        template = templates.projectCoverWithCity || 'Capa do projeto :title em :city';
        return template.replace(':title', project.titulo).replace(':city', project.cidade);
    } else if (type === 'projectCover') {
        template = templates.projectCover || 'Capa do projeto :title';
        return template.replace(':title', project.titulo);
    } else {
        // Fallback genérico
        return `${project.titulo}${project.cidade ? ` - ${project.cidade}` : ''}`;
    }
}

/**
 * Gera URL do projeto no formato correto do idioma atual
 */
function getProjectUrl(slug) {
    const lang = detectCurrentLanguage();
    
    // Mapeia o nome da página "projeto" para o formato correto do idioma
    const pathMap = {
        'pt': 'projeto',
        'en': 'project',
        'es': 'proyecto'
    };
    
    const projectPage = pathMap[lang] || 'projeto';
    return `/${lang}/${projectPage}?name=${encodeURIComponent(slug)}`;
}

/**
 * Configurações de paginação
 */
const PROJECTS_PER_PAGE = 6;
let currentProjects = projects; // Lista atual de projetos (pode ser filtrada)
let currentPage = 1; // Página atual
let totalPages = 1; // Total de páginas

/**
 * Cria um elemento de projeto
 */
function createProjectElement(project) {
    let projectBox = document.createElement("article");
    projectBox.setAttribute("aria-label", `Projeto ${project.titulo}`);
    projectBox.role = "listitem";
    projectBox.classList.add("project-item");
    projectBox.classList.add("fade-in-ready");

    let projectReferrer = document.createElement("a");
    const slug = slugify(project.titulo || project.id);
    projectReferrer.href = getProjectUrl(slug);
    // Gera aria-label dinâmico
    const lang = detectCurrentLanguage();
    let ariaLabel = '';
    if (window.ariaLabelTranslations && window.ariaLabelTranslations[lang]) {
        const templates = window.ariaLabelTranslations[lang];
        if (project.cidade) {
            ariaLabel = templates.viewProjectDetailsWithCity ? templates.viewProjectDetailsWithCity.replace(':title', project.titulo).replace(':city', project.cidade) : `Ver detalhes do projeto ${project.titulo} em ${project.cidade}`;
        } else {
            ariaLabel = templates.viewProjectDetails ? templates.viewProjectDetails.replace(':title', project.titulo) : `Ver detalhes do projeto ${project.titulo}`;
        }
    } else {
        // Fallback
        const cityInfo = project.cidade ? ` em ${project.cidade}` : '';
        ariaLabel = `Ver detalhes do projeto ${project.titulo}${cityInfo}`;
    }
    projectReferrer.setAttribute("aria-label", ariaLabel);

    let projectCover = document.createElement("img");
    projectCover.src = normalizeAssetPath(project.cover);
    projectCover.alt = generateImageAltText(project.cidade ? 'projectCoverWithCity' : 'projectCover', project);
    projectCover.loading = "lazy";
    projectCover.decoding = "async";

    let titleBox = document.createElement("span");
    titleBox.classList.add("visibilityOff");
    titleBox.setAttribute("aria-hidden", "true");
    
    let projectTitle = document.createElement("h4");
    projectTitle.textContent = project.titulo;

    // Event listeners para hover/touch/focus
    function showTitle() {
        titleBox.classList.remove("visibilityOff");
        projectCover.classList.add("brightnessFilter");
    }
    
    function hideTitle() {
        titleBox.classList.add("visibilityOff");
        projectCover.classList.remove("brightnessFilter");
    }

    projectBox.addEventListener("mouseover", showTitle);
    projectBox.addEventListener("mouseout", hideTitle);
    projectReferrer.addEventListener("focus", showTitle);
    projectReferrer.addEventListener("blur", hideTitle);
    
    projectBox.addEventListener("touchstart", showTitle);
    projectBox.addEventListener("touchend", hideTitle);

    // Monta a estrutura
    titleBox.appendChild(projectTitle);
    projectReferrer.appendChild(projectCover);
    projectReferrer.appendChild(titleBox);
    projectBox.appendChild(projectReferrer);

    return projectBox;
}

/**
 * Observa um projeto individual e aplica fade-in quando entra na viewport
 */
function observeProject(projectElement) {
    projectElement.classList.add("fade-in-ready");
    projectElement.classList.remove("fade-in-active");
    
    requestAnimationFrame(() => {
        const rect = projectElement.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const isVisible = rect.top < viewportHeight && rect.bottom > 0;
        
        if (isVisible) {
            const delay = Array.from(projectElement.parentElement.children).indexOf(projectElement) * 100;
            setTimeout(() => {
                projectElement.classList.remove("fade-in-ready");
                projectElement.classList.add("fade-in-active");
            }, 50 + delay);
            return;
        }
        
        const observerOptions = {
            root: null,
            rootMargin: "0px",
            threshold: 0.4
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    projectElement.classList.remove("fade-in-ready");
                    projectElement.classList.add("fade-in-active");
                    observer.unobserve(projectElement);
                }
            });
        }, observerOptions);

        observer.observe(projectElement);
    });
}

/**
 * Atualiza a URL com o número da página atual
 */
function updateURL(page) {
    const url = new URL(window.location);
    if (page === 1) {
        url.searchParams.delete('page');
    } else {
        url.searchParams.set('page', page);
    }
    window.history.pushState({ page }, '', url);
}

/**
 * Lê a página atual da URL
 */
function getPageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = parseInt(urlParams.get('page') || '1', 10);
    return isNaN(page) || page < 1 ? 1 : page;
}

/**
 * Cria os controles de paginação
 */
function createPaginationControls(container) {
    // Remove controles existentes
    const existingControls = document.getElementById('projectsPagination');
    if (existingControls) {
        existingControls.remove();
    }

    if (totalPages <= 1) {
        return; // Não mostra paginação se houver apenas 1 página
    }

    const paginationContainer = document.createElement('nav');
    paginationContainer.id = 'projectsPagination';
    paginationContainer.setAttribute('aria-label', 'Navegação de páginas');
    paginationContainer.classList.add('projects-pagination');

    const paginationList = document.createElement('ul');
    paginationList.classList.add('pagination-list');

    // Botão Anterior
    const prevLi = document.createElement('li');
    const prevButton = document.createElement('button');
    prevButton.type = 'button';
    prevButton.classList.add('pagination-button', 'pagination-prev');
    prevButton.setAttribute('aria-label', 'Página anterior');
    prevButton.disabled = currentPage === 1;
    prevButton.innerHTML = '<i class="ph ph-regular ph-caret-left" aria-hidden="true"></i>';
    prevButton.addEventListener('click', () => goToPage(currentPage - 1));
    prevLi.appendChild(prevButton);
    paginationList.appendChild(prevLi);

    // Números das páginas
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
    
    // Ajusta se estiver no final
    if (endPage - startPage < maxVisiblePages - 1) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    // Primeira página se não estiver visível
    if (startPage > 1) {
        const firstLi = document.createElement('li');
        const firstButton = document.createElement('button');
        firstButton.type = 'button';
        firstButton.classList.add('pagination-button', 'pagination-number');
        firstButton.textContent = '1';
        firstButton.addEventListener('click', () => goToPage(1));
        firstLi.appendChild(firstButton);
        paginationList.appendChild(firstLi);

        if (startPage > 2) {
            const ellipsisLi = document.createElement('li');
            ellipsisLi.classList.add('pagination-ellipsis');
            ellipsisLi.textContent = '...';
            ellipsisLi.setAttribute('aria-hidden', 'true');
            paginationList.appendChild(ellipsisLi);
        }
    }

    // Páginas visíveis
    for (let i = startPage; i <= endPage; i++) {
        const pageLi = document.createElement('li');
        const pageButton = document.createElement('button');
        pageButton.type = 'button';
        pageButton.classList.add('pagination-button', 'pagination-number');
        if (i === currentPage) {
            pageButton.classList.add('active');
            pageButton.setAttribute('aria-current', 'page');
        }
        pageButton.textContent = i.toString();
        pageButton.setAttribute('aria-label', `Ir para página ${i}`);
        pageButton.addEventListener('click', () => goToPage(i));
        pageLi.appendChild(pageButton);
        paginationList.appendChild(pageLi);
    }

    // Última página se não estiver visível
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            const ellipsisLi = document.createElement('li');
            ellipsisLi.classList.add('pagination-ellipsis');
            ellipsisLi.textContent = '...';
            ellipsisLi.setAttribute('aria-hidden', 'true');
            paginationList.appendChild(ellipsisLi);
        }

        const lastLi = document.createElement('li');
        const lastButton = document.createElement('button');
        lastButton.type = 'button';
        lastButton.classList.add('pagination-button', 'pagination-number');
        lastButton.textContent = totalPages.toString();
        lastButton.addEventListener('click', () => goToPage(totalPages));
        lastLi.appendChild(lastButton);
        paginationList.appendChild(lastLi);
    }

    // Botão Próxima
    const nextLi = document.createElement('li');
    const nextButton = document.createElement('button');
    nextButton.type = 'button';
    nextButton.classList.add('pagination-button', 'pagination-next');
    nextButton.setAttribute('aria-label', 'Próxima página');
    nextButton.disabled = currentPage === totalPages;
    nextButton.innerHTML = '<i class="ph ph-regular ph-caret-right" aria-hidden="true"></i>';
    nextButton.addEventListener('click', () => goToPage(currentPage + 1));
    nextLi.appendChild(nextButton);
    paginationList.appendChild(nextLi);

    paginationContainer.appendChild(paginationList);
    container.appendChild(paginationContainer);
}

/**
 * Renderiza os projetos da página atual
 */
function renderProjects(projectsContainer, projectsToRender, searchTerm = "") {
    // Calcula total de páginas
    totalPages = Math.max(1, Math.ceil(projectsToRender.length / PROJECTS_PER_PAGE));
    
    // Garante que a página atual seja válida
    if (currentPage > totalPages) {
        currentPage = totalPages;
    }
    if (currentPage < 1) {
        currentPage = 1;
    }

    // Limpa o container
    projectsContainer.innerHTML = "";

    // Mostra ou esconde a mensagem de "sem resultados"
    const noResultsMessage = document.getElementById("noResultsMessage");
    if (noResultsMessage) {
        if (searchTerm.trim() !== "" && projectsToRender.length === 0) {
            noResultsMessage.classList.remove("no-results-hidden");
            noResultsMessage.classList.add("no-results-visible");
        } else {
            noResultsMessage.classList.remove("no-results-visible");
            noResultsMessage.classList.add("no-results-hidden");
        }
    }

    if (projectsToRender.length === 0) {
        // Remove paginação se não houver projetos
        const existingControls = document.getElementById('projectsPagination');
        if (existingControls) {
            existingControls.remove();
        }
        return;
    }

    // Calcula índices da página atual
    const startIndex = (currentPage - 1) * PROJECTS_PER_PAGE;
    const endIndex = Math.min(startIndex + PROJECTS_PER_PAGE, projectsToRender.length);
    const projectsForPage = projectsToRender.slice(startIndex, endIndex);

    // Cria e adiciona os elementos dos projetos
    const newElements = [];
    projectsForPage.forEach(project => {
        const projectElement = createProjectElement(project);
        projectsContainer.appendChild(projectElement);
        newElements.push(projectElement);
    });

    // Observa os projetos para animação fade-in
    requestAnimationFrame(() => {
        newElements.forEach(element => {
            observeProject(element);
        });
    });

    // Cria controles de paginação
    const main = projectsContainer.closest('main');
    if (main) {
        createPaginationControls(main);
    }

    // Scroll suave até o input de busca com offset de 20px
    const searchContainer = document.getElementById('projectsSearchContainer');
    if (searchContainer) {
        const elementPosition = searchContainer.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - 20;
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}

/**
 * Navega para uma página específica
 */
function goToPage(page) {
    if (page < 1 || page > totalPages || page === currentPage) {
        return;
    }

    currentPage = page;
    updateURL(currentPage);
    renderProjects(
        document.getElementById("projectsContainer"),
        currentProjects,
        document.getElementById("projectsSearchInput")?.value || ""
    );
}

/**
 * Inicializa a paginação
 */
document.addEventListener("DOMContentLoaded", () => {
    const projectsContainer = document.getElementById("projectsContainer");
    
    if (!projectsContainer) {
        console.error("Container de projetos não encontrado!");
        return;
    }

    // Lê a página da URL
    currentPage = getPageFromURL();

    // Renderiza os projetos iniciais
    renderProjects(projectsContainer, currentProjects, "");

    // Escuta eventos de busca
    document.addEventListener("projectsSearch", (e) => {
        currentProjects = e.detail.projects;
        const searchTerm = e.detail.searchTerm || "";
        currentPage = 1; // Reseta para primeira página na busca
        updateURL(1);
        renderProjects(projectsContainer, currentProjects, searchTerm);
    });

    // Escuta mudanças no histórico do navegador (botão voltar/avançar)
    window.addEventListener('popstate', (e) => {
        currentPage = getPageFromURL();
        renderProjects(
            projectsContainer,
            currentProjects,
            document.getElementById("projectsSearchInput")?.value || ""
        );
    });
});
