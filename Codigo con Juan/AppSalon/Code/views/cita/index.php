<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicio y coloca tus datos</p>
<!-- 
<?php
    include_once __DIR__ . "/../templates/alertas.php"
?> -->

<div id="app">

    <nav class="tabs">
        <button type="button" class="actual" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Tus datos y fecha de cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    placeholder="Tu nombre"
                    value="<?php echo s($nombre);?>"
                    disabled
                />
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    type="date"
                    id="fecha"
                    <?php // deshabilita las fechas anteriores al dia de hoy ?>;
                    <?php // strtotime() me permite agregar tiempo al date ?>;
                    min="<?php echo date('Y-m-d', strtotime("+1 day"));?>"
                />
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input
                    type="time"
                    id="hora"
                />
            </div>
        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "<script src='build/js/app.js'></script>"; ?>