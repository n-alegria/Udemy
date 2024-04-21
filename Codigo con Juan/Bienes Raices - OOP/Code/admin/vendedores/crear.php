<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

$errores = Vendedor::getErrores();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $vendedor = new Vendedor($_POST['vendedor']);
    
    $errores = $vendedor->validar();

    if(empty($errores)){
        $resultado = $vendedor->guardar();
        if($resultado){
            header("Location: ../?mensaje=1");
        }
    }

}

incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Registrar Vendedor (a)</h1>
        <a href="/BienesRaices/Code/admin/" class="boton boton-verde">Volver</a>
    
        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error;?></p>
        <?php endforeach; ?>

        <form  method="POST" action="/BienesRaices/Code/admin/vendedores/crear.php" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>