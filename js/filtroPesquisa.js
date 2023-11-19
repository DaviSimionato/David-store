const produtos = document.querySelectorAll(".produtosList .produtos");
const produtosPrecos = document.querySelectorAll(".produtosList .produtos .prcOcult");
const btnAplicar = document.querySelector(".filtro .btnAplicar");
const menorPrecoFiltro = {
    label: document.querySelector(".filtro .precoMinLabel"),
    input: document.querySelector(".filtro .precoMinInput"),
};
const maiorPrecoFiltro = {
    label: document.querySelector(".filtro .precoMaxLabel"),
    input: document.querySelector(".filtro .precoMaxInput"),
};
const precosAvista = [];
produtosPrecos.forEach((preco,i)=> {
    let precoFinal = preco.textContent - (preco.textContent * 0.1);
    precosAvista.push(parseFloat(precoFinal.toFixed(3)));
});

function exibirPrecosMinMax() {
    menorPrecoFiltro.label.innerHTML = `Preço mínimo: <strong><br>R$${menorPrecoFiltro.input.value}</strong>`;
    maiorPrecoFiltro.label.innerHTML = `Preço máximo: <strong><br>R$${maiorPrecoFiltro.input.value}</strong>`;
}
function filtrarProdutos() {
    precosAvista.forEach((preco,i)=> {
        if(preco >= parseFloat(menorPrecoFiltro.input.value) && preco <= parseFloat(maiorPrecoFiltro.input.value) + 1) {
            produtos[i].style.display = 'flex';
        } else {
            produtos[i].style.display = 'none';
        }
    });
}
[menorPrecoFiltro.input,maiorPrecoFiltro.input].forEach((input)=> {
    input.addEventListener("input",()=> {
        exibirPrecosMinMax();
        btnAplicar.style.display = "block";
    });
});
btnAplicar.addEventListener("click",()=> {
    btnAplicar.style.display = "none";
    filtrarProdutos();
});

