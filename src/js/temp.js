import projects from "./projectsData.js";

document.addEventListener("DOMContentLoaded", () => {
    const t = new URLSearchParams(window.location.search);
    const e = parseInt(t.get("id"));
    const o = projects.find((t) => t.id === e);
    
    document.title = `${o.titulo} | maribe arquitetura`;
    
    document.getElementById("projectTitle").innerText = `${o.titulo}`;
    document.getElementById("projectLocationAndYear").innerText = `${o.cidade}, ${o.ano}`;
    document.getElementById("projectDescription").innerText = `${o.descricao}`;
    
    const n = document.getElementById("projectImages");
    
    let i = 1;

    o.outrasFotos.forEach((t) => {
        const e = document.createElement("div"),
            a = document.createElement("a");
        
        (a.href = t), a.setAttribute("data-lightbox", "fotos"), a.setAttribute("data-title", `${o.titulo}`), (a.ariaLabel = `Imagem do ${o.titulo}. Imagem ${i} de ${o.outrasFotos.length}.`), a.setAttribute("aria-role", "listitem");
        
        const d = document.createElement("img");
        (d.src = t), (d.alt = `Imagem do ${o.titulo}. Imagem ${i} de ${o.outrasFotos.length}.`), (d.title = `${o.titulo}`), a.appendChild(d), e.appendChild(a), n.appendChild(e);
        i++;
    });
});
