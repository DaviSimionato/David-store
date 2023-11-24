const descritivoTopic = document.querySelector(".descritivoProd .sectionTopic");
const descritivo = document.querySelector(".descritivoProd .descritivo");
const setaDescritivo = document.querySelector(".descritivoProd .mostrar");
const infotecTopic = document.querySelector(".infotecProd .sectionTopic");
const infoTec = document.querySelector(".infotecProd .infoTecnica");
const setainfoTec = document.querySelector(".infotecProd .mostrar");

function mostrarDescritivo() {
    if(descritivo.classList.contains("fechado")) {
        descritivo.classList.remove("fechado");
    }else {
        descritivo.classList.add("fechado");
    }
    if(setaDescritivo.innerHTML == "expand_less") {
        setaDescritivo.innerHTML = "expand_more";
    }else {
        setaDescritivo.innerHTML = "expand_less";
    }
}
function mostrarInfoTec() {
    if(infoTec.classList.contains("fechado")) {
        infoTec.classList.remove("fechado");
    }else {
        infoTec.classList.add("fechado");
    }
    if(setainfoTec.innerHTML == "expand_less") {
        setainfoTec.innerHTML = "expand_more";
    }else {
        setainfoTec.innerHTML = "expand_less";
    }
}
descritivoTopic.addEventListener("click",mostrarDescritivo);
infotecTopic.addEventListener("click",mostrarInfoTec);