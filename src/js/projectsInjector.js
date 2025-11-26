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
 * Configurações de lazy loading
 */
const INITIAL_LOAD = 8; // Quantidade inicial de projetos (aumentado para melhor performance)
const LOAD_MORE = 6; // Quantidade a carregar por vez
let currentIndex = 0; // Índice atual dos projetos carregados
let currentProjects = projects; // Lista atual de projetos (pode ser filtrada)
let sentinelObserver = null; // Observer do sentinela para poder desconectar
let sentinel = null; // Referência ao sentinela

/**
 * Cria um elemento de projeto
 */
function createProjectElement(project) {
    let projectBox = document.createElement("article");
    projectBox.setAttribute("aria-label", `Projeto ${project.titulo}`);
    projectBox.role = "listitem";
    projectBox.classList.add("project-item"); // Classe para identificar projetos
    projectBox.classList.add("fade-in-ready"); // Classe inicial - elemento invisível

    let projectReferrer = document.createElement("a");
    const slug = slugify(project.titulo || project.id);
    projectReferrer.href = `projeto.php?name=${encodeURIComponent(slug)}`;
    const cityInfo = project.cidade ? ` em ${project.cidade}` : '';
    projectReferrer.setAttribute("aria-label", `Ver detalhes do projeto ${project.titulo}${cityInfo}`);

    let projectCover = document.createElement("img");
    projectCover.src = normalizeAssetPath(project.cover);
    projectCover.alt = `${project.titulo}${project.cidade ? ` - ${project.cidade}` : ''}`;
    // Preload da imagem para melhor performance
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
 * Pré-carrega imagens dos próximos projetos para melhor performance
 */
function preloadProjectImages(startIndex, count) {
    const endIndex = Math.min(startIndex + count, currentProjects.length);
    for (let i = startIndex; i < endIndex; i++) {
        const img = new Image();
        img.src = normalizeAssetPath(currentProjects[i].cover);
    }
}

/**
 * Carrega projetos no container (sem animação ainda - será revelado no scroll)
 */
function loadProjects(projectsContainer, projectsToLoad, preloadImages = true) {
    const endIndex = Math.min(currentIndex + projectsToLoad, currentProjects.length);
    const newElements = [];
    
    // Pré-carrega as imagens dos próximos projetos antes de criar os elementos
    if (preloadImages) {
        preloadProjectImages(currentIndex, projectsToLoad);
    }
    
    for (let i = currentIndex; i < endIndex; i++) {
        const project = currentProjects[i];
        const projectElement = createProjectElement(project);
        projectsContainer.appendChild(projectElement);
        newElements.push(projectElement);
    }
    
    currentIndex = endIndex;
    
    // Retorna os novos elementos para observação
    return {
        hasMore: currentIndex < currentProjects.length,
        newElements: newElements
    };
}

/**
 * Observa um projeto individual e aplica fade-in quando entra na viewport
 */
function observeProject(projectElement) {
    // Força o estado inicial antes de verificar visibilidade
    // Isso garante que o CSS seja aplicado primeiro
    projectElement.classList.add("fade-in-ready");
    projectElement.classList.remove("fade-in-active");
    
    // Usa requestAnimationFrame para garantir que o CSS seja aplicado antes da verificação
    requestAnimationFrame(() => {
        // Verifica se o projeto já está visível (primeiros projetos)
        const rect = projectElement.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const isVisible = rect.top < viewportHeight && rect.bottom > 0;
        
        if (isVisible) {
            // Se já está visível, anima após um pequeno delay para garantir que o CSS foi aplicado
            // Adiciona delay escalonado para efeito cascata nos primeiros projetos
            const delay = Array.from(projectElement.parentElement.children).indexOf(projectElement) * 100;
            setTimeout(() => {
                projectElement.classList.remove("fade-in-ready");
                projectElement.classList.add("fade-in-active");
            }, 50 + delay);
            return;
        }
        
        // Se não está visível, observa para quando entrar na viewport
        // Espera o projeto estar mais próximo (threshold mais alto) antes de animar
        const observerOptions = {
            root: null, // Viewport
            rootMargin: "0px", // Não antecipa - espera estar na viewport
            threshold: 0.4 // Precisa estar 40% visível para animar (mais próximo)
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Quando o projeto entra na viewport, remove a classe de "pronto" e aplica fade-in
                    projectElement.classList.remove("fade-in-ready");
                    projectElement.classList.add("fade-in-active");
                    // Para de observar após animar
                    observer.unobserve(projectElement);
                }
            });
        }, observerOptions);

        observer.observe(projectElement);
    });
}

/**
 * Cria um elemento sentinela para detectar quando o usuário está próximo do final
 */
function createSentinel(projectsContainer) {
    const sentinel = document.createElement("div");
    sentinel.id = "projectsSentinel";
    sentinel.setAttribute("aria-hidden", "true");
    sentinel.style.height = "1px";
    sentinel.style.width = "100%";
    projectsContainer.appendChild(sentinel);
    return sentinel;
}


/**
 * Limpa o container de projetos
 */
function clearProjectsContainer(projectsContainer) {
    // Remove o sentinela se existir
    if (sentinel) {
        if (sentinelObserver) {
            sentinelObserver.unobserve(sentinel);
        }
        sentinel.remove();
        sentinel = null;
    }
    
    // Limpa todos os projetos
    projectsContainer.innerHTML = "";
    currentIndex = 0;
}

/**
 * Renderiza projetos (usado tanto na inicialização quanto na busca)
 */
function renderProjects(projectsContainer, projectsToRender, searchTerm = "") {
    clearProjectsContainer(projectsContainer);
    
    // Mostra ou esconde a mensagem de "sem resultados"
    const noResultsMessage = document.getElementById("noResultsMessage");
    if (noResultsMessage) {
        // Só mostra se houver termo de busca E não houver resultados
        if (searchTerm.trim() !== "" && projectsToRender.length === 0) {
            noResultsMessage.classList.remove("no-results-hidden");
            noResultsMessage.classList.add("no-results-visible");
        } else {
            noResultsMessage.classList.remove("no-results-visible");
            noResultsMessage.classList.add("no-results-hidden");
        }
    }
    
    if (projectsToRender.length === 0) {
        return;
    }
    
    // Carrega os primeiros projetos
    const initialResult = loadProjects(projectsContainer, INITIAL_LOAD, true);
    
    // Aguarda um frame para garantir que o DOM foi atualizado
    requestAnimationFrame(() => {
        // Observa todos os projetos carregados para aplicar fade-in quando entrarem na viewport
        initialResult.newElements.forEach(element => {
            observeProject(element);
        });
    });
    
    // Se não há mais projetos, não precisa do sentinela
    if (!initialResult.hasMore) {
        return;
    }
    
    // Cria o sentinela para detectar quando carregar mais projetos
    sentinel = createSentinel(projectsContainer);
    
    // Configura o Intersection Observer para o sentinela
    const observerOptions = {
        root: null, // Viewport
        rootMargin: "400px", // Carrega quando está a 400px do final (mais cedo para evitar lag)
        threshold: 0.1
    };
    
    sentinelObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && currentIndex < currentProjects.length) {
                // Carrega mais projetos no DOM
                const loadResult = loadProjects(projectsContainer, LOAD_MORE);
                
                // Aguarda um frame e observa os novos projetos
                requestAnimationFrame(() => {
                    loadResult.newElements.forEach(element => {
                        observeProject(element);
                    });
                });
                
                // Se não há mais projetos, para de observar
                if (!loadResult.hasMore) {
                    sentinelObserver.unobserve(sentinel);
                    sentinel.remove(); // Remove o sentinela quando não é mais necessário
                    sentinel = null;
                }
            }
        });
    }, observerOptions);
    
    // Inicia a observação do sentinela
    sentinelObserver.observe(sentinel);
}

/**
 * Inicializa o lazy loading com reveal on scroll
 */
document.addEventListener("DOMContentLoaded", () => {
    const projectsContainer = document.getElementById("projectsContainer");
    
    if (!projectsContainer) {
        console.error("Container de projetos não encontrado!");
        return;
    }

    // Renderiza os projetos iniciais
    renderProjects(projectsContainer, currentProjects, "");
    
    // Escuta eventos de busca
    document.addEventListener("projectsSearch", (e) => {
        currentProjects = e.detail.projects;
        const searchTerm = e.detail.searchTerm || "";
        renderProjects(projectsContainer, currentProjects, searchTerm);
    });
});
