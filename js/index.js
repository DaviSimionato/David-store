const produtos = document.querySelectorAll(".recomendadosProdutos .produtos");
const setaProx = document.querySelector(".recomendadosProdutos .prox");
const setaAnt = document.querySelector(".recomendadosProdutos .ant");
let min = 0;
let max = 5;
function changeProds() {
    setSetas();
    produtos.forEach((prod)=> {
        if(prod.classList.contains("teste")) {
            prod.classList.remove("teste");
        }
        prod.style.display = "none";
    });
    for(let i=min;i<max;i++) {
        produtos[i].style.display = "flex";
        produtos[i].classList.add("teste");
    }
}
setaProx.addEventListener("click",()=> {
    if(max < produtos.length) {
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
    if(max >= produtos.length) {
        setaProx.style.opacity = "0";
    }else {
        setaProx.style.opacity = "1";
    }
}
changeProds();