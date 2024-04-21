<?php
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    require('../../includes/app.php');
    
    estaAutenticado();
    
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: ../");
    }

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);
    if(!$propiedad){
        header("Location: ../");
    }

    // Consulta de vendedores
    $vendedores = Vendedor::all();
    
    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecuta el codigo cuando se envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();  

        // Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // Subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']){
            // Realiza un resize a la imagen
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);  // Seteo el nombre de la imagen
            $propiedad->setImagen($nombreImagen);
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        // Revisar si el arreglo de errores esta vacio
        if(empty($errores)){
            // Almacenar la imagen

            $resultado = $propiedad->guardar();
            if($resultado){
                header("Location: ../?mensaje=2");
            }
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/BienesRaices/Code/admin/" class="boton boton-verde">Volver</a>
    
        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error;?></p>
        <?php endforeach; ?>

        <form  method="POST" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>