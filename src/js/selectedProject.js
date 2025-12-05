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
    const langMatch = pathname.match(/^\/(pt|en|es)\//);
    return langMatch ? langMatch[1] : 'pt';
}

/**
 * Obtém a descrição do projeto no idioma correto
 */
function getProjectDescription(project, lang) {
    if (typeof project.descricao === 'object' && project.descricao !== null) {
        return project.descricao[lang] || project.descricao.pt || '';
    }
    // Fallback para descrição antiga (string)
    return project.descricao || '';
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
    const projectImagesContainer = document.getElementById("projectImages");
    
    // Elementos da ficha do projeto
    const projectInfoTitleElement = document.getElementById("projectInfoTitle");
    const projectInfoLocationElement = document.getElementById("projectInfoLocation");
    const projectInfoYearElement = document.getElementById("projectInfoYear");
    const projectInfoTypeElement = document.getElementById("projectInfoType");
    const projectInfoDescriptionElement = document.getElementById("projectInfoDescription");
    
    if (!projectImagesContainer) {
        console.error("Container de imagens não encontrado no DOM");
        return;
    }
    
    if (!projectInfoTitleElement || !projectInfoLocationElement || !projectInfoYearElement || !projectInfoTypeElement || !projectInfoDescriptionElement) {
        console.error("Elementos da ficha do projeto não encontrados no DOM");
        return;
    }
    
    // Define o título da página
    document.title = `${project.titulo} • maribe arquitetura`;
    
    // Detecta o idioma atual da URL
    const currentLang = detectCurrentLanguage();
    
    // Traduz o tipo do projeto
    const typeTranslations = {
        'pt': {
            'residencial': 'residencial',
            'comercial': 'comercial'
        },
        'en': {
            'residencial': 'residential',
            'comercial': 'commercial'
        },
        'es': {
            'residencial': 'residencial',
            'comercial': 'comercial'
        }
    };
    
    const translatedType = typeTranslations[currentLang]?.[project.tipo] || project.tipo;
    
    // Obtém a descrição no idioma correto
    const projectDescription = getProjectDescription(project, currentLang);
    
    // Preenche a ficha do projeto
    projectInfoTitleElement.textContent = project.titulo;
    projectInfoLocationElement.textContent = project.cidade;
    projectInfoYearElement.textContent = project.ano;
    projectInfoTypeElement.textContent = translatedType;
    projectInfoDescriptionElement.textContent = projectDescription;
    
    // Configura os botões de compartilhamento
    setupShareButtons(project);
    
    // Valida se existem fotos do projeto
    if (!project.outrasFotos || project.outrasFotos.length === 0) {
        console.warn("Projeto não possui fotos", project);
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
        
        // Cria o elemento da imagem
        const image = document.createElement("img");
        image.src = normalized;
        image.alt = `Imagem do ${project.titulo}. Imagem ${imageIndex} de ${totalImages}.`;
        image.title = project.titulo;
        
        // Adiciona lazy loading para melhor performance
        image.loading = "lazy";
        
        // Tratamento de erro para imagens que não carregam
        image.onerror = function() {
            console.error("Erro ao carregar imagem:", normalized);
        };
        
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

/**
 * Gera URL sem .php no formato /pt/projeto?name=...
 */
function getCleanUrl() {
    const url = new URL(window.location.href);
    const pathname = url.pathname;
    const searchParams = url.searchParams;
    
    // Extrai o idioma da URL (pt, en, es)
    const langMatch = pathname.match(/^\/(pt|en|es)\//);
    const lang = langMatch ? langMatch[1] : 'pt';
    
    // Remove .php se existir e extrai o nome da página
    let page = pathname.replace(/^\/(pt|en|es)\//, '').replace(/\.php$/, '');
    
    // Mapeia nomes de páginas para URLs em diferentes idiomas
    const pathMap = {
        'pt': {
            'projeto': 'projeto',
            'projetos': 'projetos',
            'contato': 'contato',
            'orcamento': 'orcamento',
            'sobre': 'sobre',
            'contrato': 'contrato',
            'proposta': 'proposta',
            'politica-de-privacidade': 'politica-de-privacidade',
            'sucesso': 'sucesso',
            'index': 'index'
        },
        'en': {
            'projeto': 'project',
            'projetos': 'projects',
            'contato': 'contact',
            'orcamento': 'budget',
            'sobre': 'about',
            'contrato': 'contract',
            'proposta': 'proposal',
            'politica-de-privacidade': 'privacy-policy',
            'sucesso': 'success',
            'index': 'home'
        },
        'es': {
            'projeto': 'proyecto',
            'projetos': 'proyectos',
            'contato': 'contacto',
            'orcamento': 'presupuesto',
            'sobre': 'sobre',
            'contrato': 'contrato',
            'proposta': 'propuesta',
            'politica-de-privacidade': 'politica-de-privacidad',
            'sucesso': 'exito',
            'index': 'inicio'
        }
    };
    
    // Mapeia a página para o formato correto do idioma
    const mappedPage = pathMap[lang][page] || page;
    
    // Reconstrói a URL sem .php
    const cleanPath = `/${lang}/${mappedPage}`;
    const queryString = searchParams.toString();
    const cleanUrl = `${url.origin}${cleanPath}${queryString ? '?' + queryString : ''}`;
    
    return cleanUrl;
}

/**
 * Configura os botões de compartilhamento
 */
function setupShareButtons(project) {
    const shareWhatsAppButton = document.getElementById("shareWhatsApp");
    const shareEmailButton = document.getElementById("shareEmail");
    
    if (!shareWhatsAppButton || !shareEmailButton) {
        return;
    }
    
    // Detecta o idioma atual
    const currentLang = detectCurrentLanguage();
    
    // URL limpa sem .php
    const currentUrl = getCleanUrl();
    
    // Obtém as traduções de compartilhamento
    const translations = window.shareTranslations && window.shareTranslations[currentLang] 
        ? window.shareTranslations[currentLang] 
        : window.shareTranslations && window.shareTranslations.pt 
        ? window.shareTranslations.pt 
        : null;
    
    if (!translations) {
        console.warn("Traduções de compartilhamento não encontradas");
        return;
    }
    
    // Obtém a descrição para o email (usa o idioma atual)
    const emailDescription = getProjectDescription(project, currentLang);
    
    // Valida e obtém os templates de tradução (com fallback para português)
    const whatsAppTemplate = translations.whatsAppMessage || 
        (window.shareTranslations && window.shareTranslations.pt && window.shareTranslations.pt.whatsAppMessage) ||
        'Confira este projeto: :title - :url';
    
    const emailSubjectTemplate = translations.emailSubject || 
        (window.shareTranslations && window.shareTranslations.pt && window.shareTranslations.pt.emailSubject) ||
        'Projeto: :title';
    
    const emailBodyTemplate = translations.emailBody || 
        (window.shareTranslations && window.shareTranslations.pt && window.shareTranslations.pt.emailBody) ||
        'Confira este projeto da maribe arquitetura:\n\n:title\n:description\n\n:url';
    
    // Substitui os placeholders nos templates de tradução
    const whatsappMessage = whatsAppTemplate
        .replace(':title', project.titulo || '')
        .replace(':url', currentUrl);
    
    const emailSubject = emailSubjectTemplate
        .replace(':title', project.titulo || '');
    
    const emailBody = emailBodyTemplate
        .replace(':title', project.titulo || '')
        .replace(':description', emailDescription || '')
        .replace(':url', currentUrl);
    
    // Link do WhatsApp - codifica apenas a mensagem completa uma vez
    shareWhatsAppButton.href = `https://wa.me/?text=${encodeURIComponent(whatsappMessage)}`;
    
    // Link de e-mail
    shareEmailButton.href = `mailto:?subject=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;
}
