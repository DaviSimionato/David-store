const produtosHistorico = document.querySelectorAll(".produtosHistorico .produtos");
const setaProxHist = document.querySelector(".produtosHistorico .prox");
const setaAntHist= document.querySelector(".produtosHistorico .ant");
let minHist = 0;
let maxHist = 5;
function changeProdsHist() {
    setSetasHist();
    produtosHistorico.forEach((prod)=> {
        if(prod.classList.contains("fadeIn")) {
            prod.classList.remove("fadeIn");
        }
        prod.style.display = "none";
    });
    for(let i=minHist;i<maxHist;i++) {
        produtosHistorico[i].style.display = "flex";
        produtosHistorico[i].classList.add("fadeIn");
    }
}
setaProxHist.addEventListener("click",()=> {
    if(maxHist < produtosHistorico.length) {
        minHist+=1;
        maxHist+=1;
        changeProdsHist();
    }
});
setaAntHist.addEventListener("click",()=> {
    if(minHist > 0) {
        minHist-=1;
        maxHist-=1;
        changeProdsHist();
    }
});
function setSetasHist() {
    if(minHist < 1) {
        setaAntHist.style.opacity = "0";
    }else {
        setaAntHist.style.opacity = "1"; 
    }
    if(maxHist >= produtosHistorico.length) {
        setaProxHist.style.opacity = "0";
    }else {
        setaProxHist.style.opacity = "1";
    }
}
window.addEventListener("resize", ()=> {
    if(document.querySelector("body").getClientRects()[0].width < 1200) {
        minHist = 0;
        maxHist = produtosHistorico.length;
        changeProdsHist();
    }
    if(document.querySelector("body").getClientRects()[0].width > 1200) {
        minHist = 0;
        maxHist = 5;
        changeProdsHist();
    }
});
if(document.querySelector("body").getClientRects()[0].width < 1200) {
    minHist = 0;
    maxHist = produtosHistorico.length;
    changeProdsHist();
}
changeProdsHist();