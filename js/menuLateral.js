const menuLateral = document.querySelector(".mLateral");
const btnAbreMenu = document.querySelector(".menuLateral");
const btnFechaMenu = document.querySelector(".fechaMenu");

function menuLateralHandler() {
    if(menuLateral.classList.contains("aberto")) {
        menuLateral.classList.remove("aberto");
    }else {
        menuLateral.classList.add("aberto");
    }
}
[btnAbreMenu,btnFechaMenu].forEach((btn)=> {
    btn.addEventListener("click",menuLateralHandler);
});