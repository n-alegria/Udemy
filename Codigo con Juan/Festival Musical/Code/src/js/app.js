document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

function iniciarApp(){
    crearGaleria();
    scrollNav();
    navegacionFija();
}

function crearGaleria(){
    const galeria = document.querySelector(".galeria-imagenes");
    
    for(let i = 1; i <= 12; i++){
        const imagen = document.createElement('picture');
        imagen.innerHTML = `
            <source srcset="build/img/thumb/${i}.avif" type="image/avif">
            <source srcset="build/img/thumb/${i}.webp" type="image/webp">
            <img loading="lazy" src="build/img/thumb/${i}.jpg" alt="Imagen galeria">
        `;

        imagen.onclick = function(){
            mostrarImagen(i);
        }
        galeria.appendChild(imagen);
    }
}

function mostrarImagen(id){
    const body =  document.querySelector('body');
    const imagen = document.createElement('picture');
    const overlay = document.createElement('DIV');
    const cerrarModal = document.createElement('P');
    
    imagen.innerHTML = `
        <source srcset="build/img/grande/${id}.avif" type="image/avif">
        <source srcset="build/img/grande/${id}.webp" type="image/webp">
        <img loading="lazy" src="build/img/grande/${id}.jpg" alt="Imagen galeria">
    `;

    // Crear el overlay
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');
    overlay.onclick = function(){
        overlay.remove();
        body.classList.remove('fijar-body');
    }

    // Boton para cerrar el modal
    cerrarModal.textContent = 'X';
    cerrarModal.classList.add('btn-cerrar');
    cerrarModal.onclick = function(){
        overlay.remove();
        body.classList.remove('fijar-body');
    }
    overlay.appendChild(cerrarModal);

    // Añadir al HTML
    body.classList.add('fijar-body');
    body.appendChild(overlay);
}

function scrollNav(){
    const enlaces = document.querySelectorAll('.navegacion-principal a');
    enlaces.forEach( enlace => {
        enlace.addEventListener('click', function(e){
            e.preventDefault();
            const seccionScroll = e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({ behavior: 'smooth' });
        })
    });
}

function navegacionFija(){
    const barra = document.querySelector('.header');
    const sobreFestival = document.querySelector('.sobre-festival');
    const body = document.querySelector('body');

    window.addEventListener('scroll', function(){
        if(sobreFestival.getBoundingClientRect().top < 0){
            barra.classList.add('fijo');
            body.classList.add('body-scroll');
        }
        else{
            barra.classList.remove('fijo');
            body.classList.remove('body-scroll');
        }
    });
}