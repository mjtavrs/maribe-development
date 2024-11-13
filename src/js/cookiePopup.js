document.addEventListener("DOMContentLoaded", () => {
    const popupContainer = document.getElementById("cookiePopupContainer");
    const acceptButton = document.getElementById("acceptCookies");
    const closePopupButton = document.getElementById("closeCookiesPopup");

    if (!sessionStorage.getItem("cookiesPopupDisplayed")) {
        setTimeout(() => {
            popupContainer.classList.remove("hidePopup");
            popupContainer.classList.add("showPopupFromBellow");
            sessionStorage.setItem("cookiesPopupDisplayed", "true");
        }, 2000);

        const autoCloseCookiesPopup = setTimeout(() => {
            popupContainer.classList.add("hidePopupWithAnimation");
            popupContainer.classList.remove("showPopupFromBellow");
        }, 12000);

        acceptButton.addEventListener("click", () => {
            popupContainer.classList.add("hidePopupWithAnimation");
            popupContainer.classList.remove("showPopupFromBellow");
            clearTimeout(autoCloseCookiesPopup);
        });

        closePopupButton.addEventListener("click", () => {
            popupContainer.classList.add("hidePopupWithAnimation");
            popupContainer.classList.remove("showPopupFromBellow");
            clearTimeout(autoCloseCookiesPopup);
        });
    }
});