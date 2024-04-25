<?php if(!$propiedades): ?>
    <div class="w-100">
    <p class="alerta vacio">No hay anuncios disponibles</p>
<?php else: ?>
    <div class="contenedor-anuncios">
<?php endif; ?>
    <?php foreach($propiedades as $propiedad): ?>
        <div class="anuncio">
            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacioamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                
                <a class="boton boton-amarillo-block" href="/propiedad?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
            </div> <!-- .contenido-anuncio -->
        </div> <!-- .anuncio -->
    <?php endforeach; ?>
</div> <!-- .contenedor-anuncios -->
