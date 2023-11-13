const produtosSimilaresContainer = document.querySelector(".prodsSim");
const prodsSimilares = produtosSimilaresContainer.querySelectorAll(".produtoSimilar");

if(prodsSimilares.length < 9) {
    for(let i=0;i<(9-prodsSimilares.length);i++) {
        produtosSimilaresContainer.innerHTML+= prodsSimilares[i].outerHTML; 
    }
}