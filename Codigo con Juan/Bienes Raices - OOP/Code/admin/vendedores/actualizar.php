<?php

require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();
    
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header("Location: ../");
}

// Obtener los datos del vendedor
$vendedor = Vendedor::find($id);
if(!$vendedor){
    header("Location: ../");
}

$errores = Vendedor::getErrores();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // Asigno los valores
    $args = $_POST['vendedor'];

    // Sincronizo los valores
    $vendedor->sincronizar($args);

    // Validacion de errores
    $errores = $vendedor->validar();
    
    if(empty($errores)){
        $resultado = $vendedor->guardar();

        if($resultado){
            header("Location: ../?mensaje=2");
        }
    }
}

incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor (a)</h1>
        <a href="/BienesRaices/Code/admin/" class="boton boton-verde">Volver</a>
    
        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error;?></p>
        <?php endforeach; ?>

        <form  method="POST" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>