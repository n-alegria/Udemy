<?php
    require('includes/app.php');
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h2>Más Sobre Nosotros</h2> 
        <div class="iconos-nosotros">
            <div class="icono">
                <img loading="lazy" src="build/img/icono1.svg" alt="Icono seguridad">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error ipsam tenetur eius eligendi possimus consectetur qui nemo placeat! In officiis distinctio nulla ad ullam voluptas totam, maxime dolores consequuntur odio.</p>
            </div>
            <div class="icono">
                <img loading="lazy" src="build/img/icono2.svg" alt="Icono precio">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error ipsam tenetur eius eligendi possimus consectetur qui nemo placeat! In officiis distinctio nulla ad ullam voluptas totam, maxime dolores consequuntur odio.</p>
            </div>
            <div class="icono">
                <img loading="lazy" src="build/img/icono3.svg" alt="Icono a tiempo">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error ipsam tenetur eius eligendi possimus consectetur qui nemo placeat! In officiis distinctio nulla ad ullam voluptas totam, maxime dolores consequuntur odio.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>
        
        <?php include('includes/templates/anuncios.php'); ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra La Casa De Tus Sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contactocontigo a la brevedad</p>
        <a href="contacto.php" class="boton boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada de texto">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
            <hr>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Entrada de texto">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>

                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una exelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Juan De La Torre</p>
            </div>
        </section>
    </div>

<?php
    incluirTemplate('footer');
?>