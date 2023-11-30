const optOrdenar = document.querySelectorAll(".ordenarLista .ordOptions a");
const valorOrd = document.querySelector(".ordenarLista .ordOptions .valorOrd")
const ord = valorOrd.textContent.replace(" ", "");

optOrdenar.forEach((a,i)=> {
    if(a.classList.contains(ord)) {
        optOrdenar[i].classList.add("ativo");
    }else {
        a.classList.remove("ativo");
    }
});
