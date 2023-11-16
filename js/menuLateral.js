const menuLateral = document.querySelector(".mLateral");
const btnAbreMenu = document.querySelector(".menuLateral");
const btnFechaMenu = document.querySelector(".fechaMenu");
const overlay = document.querySelector(".mLateral .menuLateralOverlay");

function menuLateralHandler() {
    if(menuLateral.classList.contains("aberto")) {
        menuLateral.classList.remove("aberto");
    }else {
        menuLateral.classList.add("aberto");
    }
}
function overlayDrop() {
    if(menuLateral.classList.contains("aberto")) {
        menuLateral.classList.remove("aberto");
    }
}
[btnAbreMenu,btnFechaMenu].forEach((btn)=> {
    btn.addEventListener("click",menuLateralHandler);
});
overlay.addEventListener("click",overlayDrop);