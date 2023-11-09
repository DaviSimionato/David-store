const produtos = document.querySelectorAll(".recomendadosProdutos .produtos");
const setaProx = document.querySelector(".recomendadosProdutos .prox");
const setaAnt = document.querySelector(".recomendadosProdutos .ant");
function changeProds() {
    let min = parseInt(setaAnt.dataset.vlr);
    let max = parseInt(setaProx.dataset.vlr);
    if(max > produtos.length) {
        setaProx.dataset.vlr = 5;
        setaAnt.dataset.vlr = 0;
    }
    produtos.forEach((prod)=> {
        prod.style.display = "none";
    });
    for(let i=min;i<max;i++) {
        produtos[i].style.display = "flex";
    }
}
setaProx.addEventListener("click",()=> {
    setaProx.dataset.vlr = parseInt(setaProx.dataset.vlr) + 5;
    setaAnt.dataset.vlr = parseInt(setaAnt.dataset.vlr) + 5;
    changeProds();
});
setaAnt.addEventListener("click",()=> {
    if(setaProx.dataset.vlr < 10 || setaAnt.dataset.vlr < 5) {
        setaProx.dataset.vlr = 5;
        setaAnt.dataset.vlr = 0;
    }else {
        setaProx.dataset.vlr = parseInt(setaProx.dataset.vlr) - 5;
        setaAnt.dataset.vlr = parseInt(setaAnt.dataset.vlr) - 5;
    }
    changeProds();
});
changeProds();