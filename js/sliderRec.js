const produtosRecomendados = document.querySelectorAll(".recomendadosProdutos .produtos");
const setaProxRec = document.querySelector(".recomendadosProdutos .prox");
const setaAntRec = document.querySelector(".recomendadosProdutos .ant");
let minRec = 0;
let maxRec = 5;
function changeProdsRec() {
    setSetasRec();
    produtosRecomendados.forEach((prod)=> {
        if(prod.classList.contains("fadeIn")) {
            prod.classList.remove("fadeIn");
        }
        prod.style.display = "none";
    });
    for(let i=minRec;i<maxRec;i++) {
        produtosRecomendados[i].style.display = "flex";
        produtosRecomendados[i].classList.add("fadeIn");
    }
}
setaProxRec.addEventListener("click",()=> {
    if(maxRec < produtosRecomendados.length) {
        minRec+=1;
        maxRec+=1;
        changeProdsRec();
    }
});
setaAntRec.addEventListener("click",()=> {
    if(minRec > 0) {
        minRec-=1;
        maxRec-=1;
        changeProdsRec();
    }
});
function setSetasRec() {
    if(minRec == 0) {
        setaAntRec.style.opacity = "0";
    }else {
        setaAntRec.style.opacity = "1";
    }
    if(maxRec >= produtosRecomendados.length) {
        setaProxRec.style.opacity = "0";
    }else {
        setaProxRec.style.opacity = "1";
    }
}
window.addEventListener("resize", ()=> {
    if(document.querySelector("body").getClientRects()[0].width < 1200) {
        minRec = 0;
        maxRec = produtosRecomendados.length;
        changeProdsRec();
    }
    if(document.querySelector("body").getClientRects()[0].width > 1200) {
        minRec = 0;
        maxRec = 5;
        changeProdsRec();
    }
});
if(document.querySelector("body").getClientRects()[0].width < 1200) {
    minRec = 0;
    maxRec = produtosRecomendados.length;
    changeProdsRec();
}
changeProdsRec();