document.addEventListener("DOMContentLoaded", () =>{
    cambiarTitulo();
});

function cambiarTitulo(){
    const tituloPorDefecto = document.title;
    window.addEventListener("blur", () =>{
        document.title = "¡Regresa!";
    })
    window.addEventListener("focus", () =>{
        document.title = tituloPorDefecto;
    })
}