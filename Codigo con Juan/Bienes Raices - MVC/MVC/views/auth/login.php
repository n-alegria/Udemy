<main class="contenedor seccion contenido-centrado">
    <h2>Iniciar Sesion</h2>
    <?php if(isset($errores['auth'])): ?>
            <div class="alerta light-error"><?php echo $errores['auth'] ?></div>
        <?php endif; ?>
    <form method="POST" action="/login" class="formulario w-50 contenido-centrado">
    <fieldset>
            <legend>Información Personal</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Tu E-mail" >
            <?php if(isset($errores['email'])): ?>
                <div class="alerta light-error"><?php echo $errores['email'] ?></div>
            <?php endif; ?>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Password" >
            <?php if(isset($errores['password'])): ?>
                <div class="alerta light-error"><?php echo $errores['password'] ?></div>
            <?php endif; ?>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-verde">
    </form>
</main>