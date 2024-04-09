<?php
    // Importar la base de datos
    require( __DIR__ . '/../config/database.php');
    $db = conectarDB();

    // Consultar
    $limite = $limite ?? null;
    if($limite === null) {
        $queryConsultaPropiedades = 'SELECT * FROM propiedades';
    }else{
        $queryConsultaPropiedades = "SELECT * FROM propiedades LIMIT {$limite}";
    }

    // Obtener los resultados
    $resultadoPropiedades = mysqli_query($db, $queryConsultaPropiedades);
?>

<?php if($resultadoPropiedades->num_rows === 0): ?>
    <div class="w-100">
    <p class="alerta vacio">No hay anuncios disponibles</p>
<?php else: ?>
    <div class="contenedor-anuncios">
<?php endif; ?>
    <?php while($propiedad = mysqli_fetch_assoc($resultadoPropiedades)): ?>
        <div class="anuncio">
            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']; ?></h3>
                <p><?php echo $propiedad['descripcion']; ?></p>
                <p class="precio">$<?php echo $propiedad['precio']; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacioamiento">
                        <p><?php echo $propiedad['estacionamiento']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                </ul>
                
                <a class="boton boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad['id']; ?>">Ver Propiedad</a>
            </div> <!-- .contenido-anuncio -->
        </div> <!-- .anuncio -->
    <?php endwhile; ?>
</div> <!-- .contenedor-anuncios -->

<?php 
    // Cerrar la conexion
    mysqli_close($db);
?>