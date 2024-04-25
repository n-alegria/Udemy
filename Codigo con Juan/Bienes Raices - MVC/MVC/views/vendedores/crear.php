<main class="contenedor seccion">
    <h1>Dar de Alta al Vendedor (a)</h1>
    <a href="../admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <p class="alerta error"><?php echo $error;?></p>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" value="Dar de alta al Vendedor (a)" class="boton boton-verde">
    </form>

</main>