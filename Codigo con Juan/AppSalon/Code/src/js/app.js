let paso = 1;
const pasoInicial = 1
const pasoFinal = 3;

const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
}

document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

function iniciarApp(){
    // Muestra y oculta las secciones
    mostrarSeccion();
    // Cambia la seccion cuando se presionen los tabs
    tabs();
    // Agrega o quita los botones del paginador
    botonesPaginador();
    // 
    paginaSiguiente();
    paginaAnterior();

    // Consulta la API en el backend de PHP
    consultarAPI();

    idCliente();
    // Obtiene el nombre del cliente desde el form y lo almacena en la cita
    nombreCliente();

    // Almacena la fecha de la cita en el objeto
    seleccionarFecha();

    // Almacena la hora de la cita en el objeto
    seleccionaHora();

    // Muestra la informacion de la cita
    mostrarResumen();
}

function mostrarSeccion(){
    // Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector(".mostrar");
    if(seccionAnterior){
        seccionAnterior.classList.remove("mostrar");
    }

    // Seleccionar la seccion con el paso obtenido con el click del usuario
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add("mostrar");

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector(".actual");
    if(tabAnterior){
        tabAnterior.classList.remove("actual");
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function tabs(){
    const botones = document.querySelectorAll(".tabs button");
    
    botones.forEach( (boton) => {
        boton.addEventListener("click", (e) =>{
            paso = parseInt( e.target.dataset.paso );
            
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector("#anterior");
    const paginaSiguiente = document.querySelector("#siguiente");

    if(paso === 1){
        paginaAnterior.classList.add("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    }else if(paso === 3){
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.add("ocultar");
        mostrarResumen();
    }else{
        paginaAnterior.classList.remove("ocultar");
        paginaSiguiente.classList.remove("ocultar");
    }
    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector("#anterior");
    paginaAnterior.addEventListener("click", function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}
function paginaSiguiente(){
    const paginaSiguiente = document.querySelector("#siguiente");
    paginaSiguiente.addEventListener("click", function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

// async - await
async function consultarAPI(){
    try {
        const url = `${location.origin}/api/servicios`;
        // await detiene la ejecucion de las siguientes lineas a la espera de la respuesta de fetch
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios){
    servicios.forEach( (servicio) => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;
        
        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        // Agrego un atrbuto personalizado ( data-idServicio ) con el id obtenido en el json
        servicioDiv.dataset.idServicio = id;
        // Le agredo un evento mediante callback ya que requiero pasarle un objeto
        servicioDiv.onclick = function(){
            // servicio -> objeto con los datos del servicio (nombre y precio)
            seleccionarServicio(servicio);
        } 

        // Agrego el nombre y precio
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        // Agrego el div de servicioDiv
        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio){
    // Extraigo el id del servicio
    const { id } = servicio;
    // Extraigo el arreglo de servicios del objeto 'cita'
    const { servicios } = cita;

    // Selecciono el div con el servicio igual al id seleccionado y le agrego la clase de seleccionado
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio fue agregado o quitarlo
    // .some() itera el arreglo y retorna true o false si existe el elemento en el arreglo
    if( servicios.some( agregado => agregado.id === id) ){
        // Eliminarlo
        // .filter() itera el arreglo y retorna los elementos segun la condicion, en este caso retorna los elementos cuyo id no este en el listado de servicios
        cita.servicios = servicios.filter( agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");
    }else{
        // Agrego el nuevo servicio usando 'spread operator' mas la nueva cita obtenida por el click
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");
    }

}

function nombreCliente(){
    const nombre = document.querySelector("#nombre").value;
    // .trim() elimina espacios vacios antes y despues del string
    cita.nombre = nombre.trim();
}
function idCliente(){
    const id = document.querySelector("#id").value;
    // .trim() elimina espacios vacios antes y despues del string
    cita.id = id.trim();
}

function seleccionarFecha(){
    // Seleciono el input fecha
    const inputFecha = document.querySelector("#fecha");
    // Agrego un eventListener con el evento "input", cuando agrega la fecha la obtengo de lo contrario tendria un string vacio
    inputFecha.addEventListener("input", function(e) {
        // .getUTFCDay() obtiene el dia de la semana (numero) siendo domingo = 0
        const dia = new Date(e.target.value).getUTCDay();
        // .includes() me permite saber si un elemento esta dentro de un arreglo
        if( [6, 0].includes(dia) ){
            e.target.value = "";
            mostrarAlerta("Fines de semana no permitidos", "error", ".formulario");
        }else{
            cita.fecha = e.target.value;
        }
    });
}


function seleccionaHora(){
    const inputHora = document.querySelector("#hora");
    inputHora.addEventListener("input", function(e) {
        const horaCita = e.target.value;
        // .split() me permite separar una cadena mediante un delimitador
        const hora = horaCita.split(":")[0];
        if( hora < 10 || hora > 18){
            mostrarAlerta("Hora no valida", "error", ".formulario");
        }else{
            cita.hora = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    const alertaPrevia = document.querySelector(".alerta");
    // Si existe una alerta previa elimina el mensaje previo
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 4000);
    }
}

function mostrarResumen(){
    const resumen = document.querySelector(".contenido-resumen");
    // Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;

    // Limpiar el contenido del resumen, mientras existan elementos en el resumen, lo elimina
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    // Object.values( objeto ) devuelve los valores de un objeto
    // Comprubo que no tenga string vacios
    if(Object.values(cita).includes("") || cita.servicios.length === 0){
        mostrarAlerta("Faltan datos de Servicios, Fecha u hora", "error", ".contenido-resumen", false);
        return;
    }

    // Heading para servicios en resumen
    const headingServicios = document.createElement("H3");
    headingServicios.textContent = "Resumen de Servicios";
    resumen.appendChild(headingServicios);

    // Iterando y mostrando los servicios
    servicios.forEach( (servicio) => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement("DIV");
        
        contenedorServicio.classList.add("contenedor-servicios");
        
        const nombreServicio = document.createElement("P");
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(nombreServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    // Heading para resumen de cita
    const headingCita = document.createElement("H3");
    headingCita.textContent = "Resumen de Cita";
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement("P");
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date( Date.UTC(year, mes, dia) );

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaUTC.toLocaleDateString("es-AR", opciones);
   
    const fechaCita = document.createElement("P");
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement("P");
    horaCita.innerHTML = `<span>Hora:</span> ${hora} horas`;

    // Boton para crear una cita
    const botonReservar = document.createElement("BUTTON");
    botonReservar.classList.add("boton");  
    botonReservar.textContent = "Reservar Cita";
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.append(botonReservar);
}

async function reservarCita(){
    const { id, fecha, hora, servicios } = cita; 

    // Solamente guardo los id de los servicios
    const idServicios = servicios.map(servicio => servicio.id);
    console.log(idServicios);

    const datos = new FormData();
    datos.append("usuarioId", id);
    datos.append("fecha", fecha);
    datos.append("hora", hora);
    datos.append("servicios", idServicios);

    try{
        // Peticion hacia la api
        const url = `${location.origin}/api/citas`;
        const opciones = {
            method: "POST",
            body: datos
        }

        const respuesta = await fetch(url, opciones);
        console.log(respuesta);
        const resultado = await respuesta.json();
        console.log(resultado);

        if(resultado.resultado){
            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita fue creada correctamente"
            }).then( () => {
                setTimeout( () => {
                    window.location.reload()

                }, 1000);
            });
        }
    }catch(error){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al guardar la cita"
        })
    }
    
}