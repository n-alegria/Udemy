<?php

    require('../includes/app.php');
    estaAutenticado();

    use App\Propiedad;
    use App\Vendedor;

    $mensaje = $_GET['mensaje'] ?? null;

    // Implementar metodo para obtener las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: ./');
        }
        else{
            $tipo = $_POST['tipo'];
            if( validarTipoContenido($tipo) ){
                if($tipo === 'vendedor')
                {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                    header("Location: ./?mensaje=3");
                }
                else if($tipo === 'propiedad')
                {    
                    $propiedad  = Propiedad::find($id);
                    $resultadoEliminar = $propiedad->eliminar();
        
                    if($resultadoEliminar){
                        $propiedad->borrarImagen();
                        header("Location: ./?mensaje=3");
                    }
                }
            }
        }

    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php
            $mensaje = mostrarNotificacion($mensaje);
            if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje);?></p>
        <?php  };?>
        <div class="centrado">
            <a href="/BienesRaices/Code/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
            <a href="/BienesRaices/Code/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>
        </div>
        <h2>Propiedades</h2>
        <?php if($propiedades): ?>
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
                <tbody> <!-- muestra las propiedades -->
                    <?php foreach($propiedades as $propiedad) : ?>
                        <tr>
                        <td><?php echo $propiedad->id;?> </td>
                        <td><?php echo $propiedad->titulo;?> </td>
                        <td>$<?php echo $propiedad->precio;?> </td>
                        <td>
                            <img class="imagen-small" src="/BienesRaices/Code/imagenes/<?php echo $propiedad->imagen;?>" alt="<?php echo $propiedad->titulo;?> ">
                        </td>
                        <td>
                            <a class="boton boton-amarillo-block" href="propiedades/actualizar.php?id=<?php echo $propiedad->id;?>">Actualizar</a>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton boton-rojo-block" value="Eliminar"></input>                                
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="alerta vacio">No hay anuncios disponibles</p>
        <?php endif; ?>

        <h2>Vendedores</h2>
        <?php if($vendedores): ?>
            <table class="propiedades">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                        <th>Telefono</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> <!-- muestra las propiedades -->
                    <?php foreach($vendedores as $vendedor) : ?>
                        <tr>
                        <td><?php echo $vendedor->id;?> </td>
                        <td><?php echo $vendedor->nombre;?> </td>
                        <td><?php echo $vendedor->telefono;?> </td>
                        <td>
                            <a class="boton boton-amarillo-block" href="vendedores/actualizar.php?id=<?php echo $vendedor->id;?>">Actualizar</a>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton boton-rojo-block" value="Eliminar"></input>                                
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="alerta vacio">No hay vendedores disponibles</p>
        <?php endif; ?>
    </main>

<?php
    incluirTemplate('footer');
?>