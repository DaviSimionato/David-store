const inputTelefone = document.querySelector(".cadTel");
const inputCPF = document.querySelector(".cadCPF");

function formatTel() {
    let numero = inputTelefone.value.replace(/\D/g, '');
    let formattedNumero = '(' + numero.substring(0, 2) + ') ' + numero.substring(2, 7) + '-' + numero.substring(7, 11);
    inputTelefone.value = formattedNumero;
}
function formatCPF() {
    let cpf = inputCPF.value.replace(/\D/g, '');
    let formattedCPF = cpf.substring(0, 3) + '.' + cpf.substring(3, 6) + '.' + cpf.substring(6, 9) + '-' + cpf.substring(9, 11);
    inputCPF.value = formattedCPF;
}
inputTelefone.addEventListener("keydown",(e)=> {
    if(inputTelefone.value.length >= 10) {
        formatTel();
    }else {
        inputTelefone.value = inputTelefone.value.trim();
        inputTelefone.value = inputTelefone.value.replace(" ","");
    }
    if(e.key == "Backspace") {
        inputTelefone.value = inputTelefone.value.replaceAll("(","");
        inputTelefone.value = inputTelefone.value.replaceAll(")","");
        inputTelefone.value = inputTelefone.value.replaceAll("-","");
    }
});
inputCPF.addEventListener("keydown",(e)=> {
    if(inputCPF.value.length >= 10) {
        formatCPF();
    }else {
        inputCPF.value = inputCPF.value.trim();
        inputCPF.value = inputCPF.value.replace(" ","");
    }
    if(e.key == "Backspace") {
        inputCPF.value = inputCPF.value.replaceAll("-","");
        inputCPF.value = inputCPF.value.replaceAll(".","");
    }
});