<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../admin" class="boton boton-verde">Volver</a>
    <?php foreach($errores as $error): ?>
        <p class="alerta error"><?php echo $error;?></p>
    <?php endforeach; ?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>

</main>