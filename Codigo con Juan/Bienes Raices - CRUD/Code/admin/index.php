<?php
    $mensaje = $_GET['mensaje'] ?? null;
    
    require '../includes/config/database.php';
    $db = conectarDB();

    // Query
    $queryPropiedades = "SELECT * FROM propiedades";

    // Consulta
    $resultadoPropiedades = mysqli_query($db, $queryPropiedades);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: ./');
        }
        else{
            // Seleccionar la imagen a eliminar
            $queryPropiedad = "SELECT * FROM propiedades WHERE id = {$id}";
            $resultadoImagen = mysqli_query($db, $queryPropiedad);
            $propiedad = mysqli_fetch_assoc($resultadoImagen);
            $imagen = $propiedad['imagen'];
            unlink('../imagenes/'.$imagen);

            $queryEliminar = "DELETE FROM propiedades WHERE id = {$id}";
            $resultadoEliminar = mysqli_query($db, $queryEliminar);
            if($resultadoEliminar){
                header("Location: ./?mensaje=3");
            }
        }

    }

    require('../includes/funciones.php');
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($mensaje === '1'): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($mensaje === '2'): ?>
            <p class="alerta exito">Anuncio modificado correctamente</p>
        <?php elseif($mensaje === '3'): ?>
            <p class="alerta exito">Anuncio eliminado correctamente</p>
        <?php endif; ?>
        <a href="/BienesRaices/Code/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    
        <?php if($resultadoPropiedades->num_rows): ?>
            <table class="propiedades">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) : ?>
                        <tr>
                        <td><?php echo $propiedad['id'];?> </td>
                        <td><?php echo $propiedad['titulo'];?> </td>
                        <td>$<?php echo $propiedad['precio'];?> </td>
                        <td>
                            <img class="imagen-small" src="/BienesRaices/Code/imagenes/<?php echo $propiedad['imagen'];?>" alt="<?php echo $propiedad['titulo'];?> ">
                        </td>
                        <td>
                            <a class="boton boton-amarillo-block" href="propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>">Actualizar</a>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                                <input type="submit" class="boton boton-rojo-block" value="Eliminar"></input>                                
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="alerta vacio">No hay anuncios disponibles</p>
        <?php endif; ?>
    </main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>