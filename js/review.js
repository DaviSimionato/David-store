const inputNota = document.querySelector(".inputNota");
const estrelas = document.querySelectorAll(".estrelaRev");

function setNota() {
    estrelas.forEach((estrela)=> {
        if(estrela.classList.contains("estrelaCheia")) {
            estrela.classList.remove("estrelaCheia");
        }
    });
    for(let i=0;i<inputNota.value;i++) {
        estrelas[i].classList.add("estrelaCheia");
    }
}

inputNota.addEventListener("input",setNota);