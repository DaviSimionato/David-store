const btnCompra = document.querySelector(".gotoCarrinho");
const btnPix = document.querySelector(".pix");
const btnCartao = document.querySelector(".cartao");
const valoresCartao = document.querySelectorAll(".cadCartao input");

btnCompra.addEventListener("click",(e)=> {
    if(!(btnPix.classList.contains("selected")) && !(btnCartao.classList.contains("selected"))) {
        e.preventDefault();
        window.alert("Escolha um metodo de pagamento!");
    }
    if(btnCartao.classList.contains("selected")) {
        let erro = false;
        valoresCartao.forEach((input)=> {
            if(input.value == "") {
                erro = true;
            }
        });
        if(erro) {
            e.preventDefault();
            window.alert("Insira todos os dados do cartão!");
        }
    }
});