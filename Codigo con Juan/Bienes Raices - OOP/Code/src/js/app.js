document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
    // if(navegacion.classList.contains('mostrar')){
    //     navegacion.classList.remove('mostrar');
    // }
    // else{
    //     navegacion.classList.add('mostrar');
    // }
}

function darkMode(){
    // const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark');
    // if(prefiereDarkMode.matches){
    //     document.body.classList.add('dark-mode');
    // }
    // else{
    //     document.body.classList.remove('dark-mode');
    // }

    prefiereDarkMode.addEventListener('change', () =>{
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }
        else{
            document.body. classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.boton-dark-mode');
    botonDarkMode.addEventListener('click', () =>{
        document.body.classList.toggle('dark-mode');
    });
}