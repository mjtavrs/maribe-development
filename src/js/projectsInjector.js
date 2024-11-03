import projects from "./projectsData.js";

document.addEventListener("DOMContentLoaded", () => {
    let projectsContainer = document.getElementById("projectsContainer");
    
    projects.forEach((project) => {
        let projectBox = document.createElement("article");
        (projectBox.ariaLabel = `Saiba mais sobre o ${project.titulo}`), (projectBox.role = "listitem");

        let projectReferrer = document.createElement("a");
        projectReferrer.href = `projeto.html?id=${project.id}`;

        let projectCover = document.createElement("img");
        (projectCover.src = project.cover), (projectCover.alt = `Saiba mais sobre o ${project.titulo}`);

        let titleBox = document.createElement("span");
        titleBox.classList.add("visibilityOff");
        
        let projectTitle = document.createElement("h4");
        (projectTitle.textContent = project.titulo),
            projectBox.addEventListener("mouseover", () => {
                titleBox.classList.remove("visibilityOff"), projectCover.classList.add("brightnessFilter");
            }),
            projectBox.addEventListener("mouseout", () => {
                titleBox.classList.add("visibilityOff"), projectCover.classList.remove("brightnessFilter");
            }),
            projectBox.addEventListener("touchstart", () => {
                titleBox.classList.remove("visibilityOff"), projectCover.classList.add("brightnessFilter");
            }),
            projectBox.addEventListener("touchend", () => {
                titleBox.classList.add("visibilityOff"), projectCover.classList.remove("brightnessFilter");
            }),
            projectReferrer.appendChild(projectCover),
            titleBox.appendChild(projectTitle),
            projectReferrer.appendChild(titleBox),
            projectBox.appendChild(projectReferrer),
            projectsContainer.appendChild(projectBox);
    });
});
