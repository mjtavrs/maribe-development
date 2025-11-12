document.addEventListener("DOMContentLoaded", () => {
    const popupContainer = document.getElementById("cookiePopupContainer");
    const acceptButton = document.getElementById("acceptCookies");
    const closePopupButton = document.getElementById("closeCookiesPopup");

    // Verifica se o popup já foi exibido usando localStorage (persiste entre sessões)
    if (!localStorage.getItem("cookiesPopupDisplayed")) {
        setTimeout(() => {
            popupContainer.classList.remove("hidePopup");
            popupContainer.classList.add("showPopupFromBellow");
        }, 1500);

        // Função para fechar o popup e salvar no localStorage
        const closePopup = () => {
            popupContainer.classList.add("hidePopupWithAnimation");
            popupContainer.classList.remove("showPopupFromBellow");
            localStorage.setItem("cookiesPopupDisplayed", "true");
        };

        // Adiciona event listeners
        acceptButton.addEventListener("click", closePopup);
        closePopupButton.addEventListener("click", closePopup);
    }
});