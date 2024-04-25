document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll("input[name='contacto[contacto]']");
    metodoContacto.forEach(input => {
        input.addEventListener("click", mostrarMetodosContacto);
    });
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

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector("#contacto");
    if(e.target.value === "telefono"){
        contactoDiv.innerHTML = `
        <label for="telefono">Teléfono</label>
        <input type="tel" name="contacto[telefono]" id="telefono" placeholder="Tu Teléfono">
        
        <p>Elija la fecha y hora para la llamada</p>
        <label for="fecha">Fecha:</label>
        <input type="date" name="contacto[fecha]" id="date">
        <label for="hora">Hora:</label>
        <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00">
    `;}
    else if(e.target.value === "email"){
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" name="contacto[email]" id="email" placeholder="Tu E-mail" required>`;
    }
}