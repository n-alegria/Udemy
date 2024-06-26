<?php

require('includes/app.php');
use App\Propiedad;

    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id){
        header("location: /BienesRaices/Code/");
    }

    // Obtengo la propiedad
    $propiedad = Propiedad::find($id);

    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>
        <img loading="lazy" src="./imagenes/<?php echo $propiedad->imagen;?>" alt="<?php echo $propiedad->titulo;?>">
        
        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio;?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p><?php echo $propiedad->wc;?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacioamiento">
                    <p><?php echo $propiedad->estacionamiento;?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                    <p><?php echo $propiedad->habitaciones;?></p>
                </li>
            </ul>
            <p><?php echo $propiedad->descripcion;?></p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>