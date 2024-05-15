<div class="contenedor reestablecer">
    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu Nuevo Password</p>

        <form class="formulario" method="POST" action="/reestablecer">

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password">
            </div>
            
            <input type="submit" value="Enviar Instrucciones" class="boton">
        
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión.</a>    
            <a href="/crear">¿Aún no tienes una cuenta? Obtener una.</a>        
        </div>
    </div> <!-- .contenedor-sm -->

</div>