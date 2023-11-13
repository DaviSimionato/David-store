const produtosSimilaresContainer = document.querySelector(".prodsSim");
const prodsSimilares = produtosSimilaresContainer.querySelectorAll(".produtoSimilar");

if(prodsSimilares.length < 8) {
    for(let i=0;i<(8-prodsSimilares.length);i++) {
        produtosSimilaresContainer.innerHTML+= prodsSimilares[i].outerHTML; 
    }
}