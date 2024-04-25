<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php
        if($mensaje){
            echo "<p class='alerta exito'>{$mensaje}</p>";
        }
    ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Destacada contacto">
    </picture>
    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" name="contacto[nombre]" id="nombre" placeholder="Tu Nombre" required>
            
            <label for="mensaje">Mensaje</label>
            <textarea name="contacto[mensaje]" id="mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobrela Propiedad</legend>
            <label for="opiones">Tipo de Operación</label>
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>-- Seleccionar --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" name="contacto[precio]" id="presupuesto" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" name="contacto[contacto]" id="contactar-telefono" required>
            </div>

            <div id="contacto">

            </div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>