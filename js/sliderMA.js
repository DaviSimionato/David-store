const produtosMaisAcessados = document.querySelectorAll(".produtosMaisAcessados .produtos");
const setaProxMa = document.querySelector(".produtosMaisAcessados .prox");
const setaAntMa= document.querySelector(".produtosMaisAcessados .ant");
let minMa = 0;
let maxMa = 5;
function changeProdsMa() {
    setSetasMa();
    produtosMaisAcessados.forEach((prod)=> {
        if(prod.classList.contains("fadeIn")) {
            prod.classList.remove("fadeIn");
        }
        prod.style.display = "none";
    });
    for(let i=minMa;i<maxMa;i++) {
        produtosMaisAcessados[i].style.display = "flex";
        produtosMaisAcessados[i].classList.add("fadeIn");
    }
}
setaProxMa.addEventListener("click",()=> {
    if(maxMa < produtosMaisAcessados.length) {
        minMa+=1;
        maxMa+=1;
        changeProdsMa();
    }
});
setaAntMa.addEventListener("click",()=> {
    if(minMa > 0) {
        minMa-=1;
        maxMa-=1;
        changeProdsMa();
    }
});
function setSetasMa() {
    if(minMa < 1) {
        setaAntMa.style.opacity = "0";
    }else {
        setaAntMa.style.opacity = "1"; 
    }
    if(maxMa >= produtosMaisAcessados.length) {
        setaProxMa.style.opacity = "0";
    }else {
        setaProxMa.style.opacity = "1";
    }
}
window.addEventListener("resize", ()=> {
    if(document.querySelector("body").getClientRects()[0].width < 1200) {
        minMa = 0;
        maxMa = produtosMaisAcessados.length;
        changeProdsMa();
    }
    if(document.querySelector("body").getClientRects()[0].width > 1200) {
        minMa = 0;
        maxMa = 5;
        changeProdsMa();
    }
});
if(document.querySelector("body").getClientRects()[0].width < 1200) {
    minMa = 0;
    maxMa = produtosMaisAcessados.length;
    changeProdsMa();
}
changeProdsMa();