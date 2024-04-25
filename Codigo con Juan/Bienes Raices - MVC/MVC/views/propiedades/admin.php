<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php
        if($resultado){    
            $mensaje = mostrarNotificacion($resultado);
            if($mensaje){ ?>
                <p class="alerta exito"><?php echo s($mensaje);?></p>
            <?php }
        }
    ?>

    <div class="centrado">
        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
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
                        <img class="imagen-small" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="<?php echo $propiedad->titulo;?> ">
                    </td>
                    <td>
                        <a class="boton boton-amarillo-block" href="propiedades/actualizar?id=<?php echo $propiedad->id;?>">Actualizar</a>
                        <form method="POST" class="w-100" action="propiedades/eliminar?id=<?php echo $propiedad->id;?>">
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
                        <a class="boton boton-amarillo-block" href="vendedores/actualizar?id=<?php echo $vendedor->id;?>">Actualizar</a>
                        <form method="POST" class="w-100" action="vendedores/eliminar">
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