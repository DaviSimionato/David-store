const produtosRecomendados = document.querySelectorAll(".recomendadosProdutos .produtos");
const setaProx = document.querySelector(".recomendadosProdutos .prox");
const setaAnt = document.querySelector(".recomendadosProdutos .ant");
let min = 0;
let max = 5;
function changeProds() {
    setSetas();
    produtosRecomendados.forEach((prod)=> {
        if(prod.classList.contains("fadeIn")) {
            prod.classList.remove("fadeIn");
        }
        prod.style.display = "none";
    });
    for(let i=min;i<max;i++) {
        produtosRecomendados[i].style.display = "flex";
        produtosRecomendados[i].classList.add("fadeIn");
    }
}
setaProx.addEventListener("click",()=> {
    if(max < produtosRecomendados.length) {
        min+=1;
        max+=1;
        changeProds();
    }
});
setaAnt.addEventListener("click",()=> {
    if(min > 0) {
        min-=1;
        max-=1;
        changeProds();
    }
});
function setSetas() {
    if(min < 1) {
        setaAnt.style.opacity = "0";
    }else {
        setaAnt.style.opacity = "1"; 
    }
    if(max >= produtosRecomendados.length) {
        setaProx.style.opacity = "0";
    }else {
        setaProx.style.opacity = "1";
    }
}
window.addEventListener("resize", ()=> {
    if(document.querySelector("body").getClientRects()[0].width < 1200) {
        min = 0;
        max = produtosRecomendados.length;
        changeProds();
    }
    if(document.querySelector("body").getClientRects()[0].width > 1200) {
        min = 0;
        max = 5;
        changeProds();
    }
});
if(document.querySelector("body").getClientRects()[0].width < 1200) {
    min = 0;
    max = produtosRecomendados.length;
    changeProds();
}
changeProds();