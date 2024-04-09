<?php
    require('../../includes/funciones.php');
    estaAutenticado();
    
    // Base de  datos
    require('../../includes/config/database.php');
    $db = conectarDB();

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorId = "";

    // Consulta de vendedores
    $consultaVendedores = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consultaVendedores);


    // Ejecuta el codigo cuando se envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedorId = mysqli_real_escape_string($db, $_POST["vendedorId"]);
        $creado = date("Y/m/d");

        // Asignar FILES a la imagen
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }
        if(strlen($descripcion) <= 10){
            $errores[] = "La descripcion es muy corta";
        }
        if(!$habitaciones){
            $errores[] = "Debes añadir la cantidad de habitaciones";
        }
        if(!$wc){
            $errores[] = "Debes añadir la cantidad de wc";
        }
        if(!$estacionamiento){
            $errores[] = "Debes añadir la cantidad de estacionamientos";
        }
        if($vendedorId === ""){
            $errores[] = "El vendedor es obligatorio";
        }
        if(!$imagen['name'])
        {
            $errores[] = "La imagen es obligatria";
        }
        $medida = 2000 * 1000;
        if($imagen['size'] >= $medida){
            $errores[] = "La imagen es muy pesada";
        }

        // Revisar si el arreglo de errores esta vacio
        if(empty($errores)){
            /** Subida de archivos **/
            $carpetaImagen = '../../imagenes/';
            if(!is_dir($carpetaImagen)){
                mkdir($carpetaImagen);
            }

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            move_uploaded_file($imagen['tmp_name'], $carpetaImagen . $nombreImagen);

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('{$titulo}', {$precio}, '{$nombreImagen}','{$descripcion}', {$habitaciones}, {$wc}, {$estacionamiento}, '{$creado}', {$vendedorId})";
            
            $resultado = mysqli_query($db, $query);
            
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" placeholder="Descripcion Propiedad"><?php echo $descripcion;?></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>
                
                <label for="habitaciones">Habitaciones</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $habitaciones;?>">

                <label for="wc">Baños</label>
                <input type="number" name="wc" id="wc" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $wc;?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $estacionamiento;?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedorId" id="vendedorId">
                    <option value="" selected>-- Seleccione un vendedor --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?>
                        value="<?php echo $vendedor['id']?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>