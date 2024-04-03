<?php
    require('includes/funciones.php');
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacioamiento">
                    <p>2</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora, dolorem. Minima voluptas praesentium nam, corrupti labore a nemo ut pariatur, libero laudantium officiis cupiditate nesciunt? Amet laborum soluta illo maiores!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid dolore numquam fugiat dolor ea commodi facere ducimus deleniti. Voluptate at tempora laudantium consequuntur eius repellendus ea itaque reiciendis quos facere!</p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>