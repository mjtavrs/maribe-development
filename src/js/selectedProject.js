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
document.addEventListener("DOMContentLoaded", () => {
    // Obtém o ID do projeto da URL
    const urlParams = new URLSearchParams(window.location.search);
    const projectId = parseInt(urlParams.get("id"));
    const projectSlug = urlParams.get("name");
    
    // Só redireciona se não houver slug e também não houver um ID válido
    if ((!projectSlug || projectSlug.trim() === "") && (!projectId || isNaN(projectId))) {
        redirectToProjects();
        return;
    }
    
    // Busca o projeto pelo ID
    let project = null;
    if (projectSlug) {
        project = projects.find((p) => slugify(p.titulo) === projectSlug);
    }
    if (!project && projectId) {
        project = projects.find((p) => p.id === projectId);
    }
    
    // Valida se o projeto existe
    if (!project) {
        redirectToProjects();
        return;
    }
    
    // Valida se os elementos necessários existem no DOM
    const projectTitleElement = document.getElementById("projectTitle");
    const projectLocationElement = document.getElementById("projectLocationAndYear");
    const projectDescriptionElement = document.getElementById("projectDescription");
    const projectImagesContainer = document.getElementById("projectImages");
    
    if (!projectTitleElement || !projectLocationElement || !projectDescriptionElement || !projectImagesContainer) {
        console.error("Elementos necessários não encontrados no DOM");
        return;
    }
    
    // Define o título da página
    document.title = `${project.titulo} • maribe arquitetura`;
    
    // Preenche as informações do projeto
    projectTitleElement.textContent = project.titulo;
    projectLocationElement.textContent = `${project.cidade}, ${project.ano}`;
    projectDescriptionElement.textContent = project.descricao;
    
    // Valida se existem fotos do projeto
    if (!project.outrasFotos || project.outrasFotos.length === 0) {
        console.warn("Projeto não possui fotos");
        return;
    }
    
    // Cria os elementos das imagens
    let imageIndex = 1;
    const totalImages = project.outrasFotos.length;
    
    project.outrasFotos.forEach((imageUrl) => {
        const normalized = normalizeAssetPath(imageUrl);
        const imageWrapper = document.createElement("div");
        const imageLink = document.createElement("a");
        
        // Configura o link da imagem
        imageLink.href = normalized;
        imageLink.setAttribute("data-lightbox", "fotos");
        imageLink.setAttribute("data-title", project.titulo);
        imageLink.setAttribute("aria-label", `Imagem do ${project.titulo}. Imagem ${imageIndex} de ${totalImages}.`);
        imageLink.setAttribute("role", "listitem");
        
        // Cria o elemento da imagem
        const image = document.createElement("img");
        image.src = normalized;
        image.alt = `Imagem do ${project.titulo}. Imagem ${imageIndex} de ${totalImages}.`;
        image.title = project.titulo;
        
        // Adiciona lazy loading para melhor performance
        image.loading = "lazy";
        
        // Monta a estrutura
        imageLink.appendChild(image);
        imageWrapper.appendChild(imageLink);
        projectImagesContainer.appendChild(imageWrapper);
        
        imageIndex++;
    });

});

/**
 * Redireciona para a página de projetos quando o projeto não é encontrado
 */
function redirectToProjects() {
    window.location.href = "projetos.php";
}
