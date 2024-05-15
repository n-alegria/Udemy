<div class="contenedor crear">
    
    <?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear tu cuenta en UpTask</p>

        <form class="formulario" method="POST" action="/crear">

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>
            
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email">
            </div>
            
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu password">
            </div>
            
            <div class="campo">
                <label for="password2">Repetir Password</label>
                <input type="password" name="password2" id="password2" placeholder="Repite tu password">
            </div>
            
            <input type="submit" value="Crear Cuenta" class="boton">
        
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión.</a>
            <a href="/olvide">¿Olvidaste tu password? Resetea tu password.</a>
        </div>
    </div> <!-- .contenedor-sm -->

</div>