<?php
    require('../../includes/app.php');
    use Intervention\Image\ImageManagerStatic as Image;
    
    // Compruebo si hay sesion activa
    estaAutenticado();

    // Importo la clase
    use App\Propiedad;
    use App\Vendedor;

    // Nueva propiedad
    $propiedad = new Propiedad;

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Consulta para obtener los vendedores
    $vendedores = Vendedor::all();

    // Ejecuta el codigo cuando se envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // Creo una nueva propiedad con los valores obtenidos por POST
        $propiedad = new Propiedad($_POST['propiedad']);
 
        // Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        if($_FILES['propiedad']['tmp_name']['imagen']){
            // Realiza un resize a la imagen
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);  // Seteo el nombre de la imagen
            $propiedad->setImagen($nombreImagen);
        }

        // compruebo si hay errores 
        $errores = $propiedad->validar();
        
        // Revisar si el arreglo de errores esta vacio
        if(empty($errores)){
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            // Sanitizo y guardo en la BD
            $resultado = $propiedad->crear();

            if($resultado){
                header("Location: ../?mensaje=1");
            }
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/BienesRaices/Code/admin/" class="boton boton-verde">Volver</a>
    
        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error;?></p>
        <?php endforeach; ?>

        <form  method="POST" action="/BienesRaices/Code/admin/propiedades/crear.php" class="formulario" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>