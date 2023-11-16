const produtosSimilaresContainer = document.querySelector(".prodsSim");
const prodsSimilares = document.querySelectorAll(".produtoSimilar");
let tamanho = prodsSimilares.length;
let i = 0;

while(tamanho < 9) {
    if(i == (prodsSimilares.length - 1)) {
        i=0;
    }else {
        i++;
    }
    produtosSimilaresContainer.innerHTML+= prodsSimilares[i].outerHTML;
    tamanho++;
}