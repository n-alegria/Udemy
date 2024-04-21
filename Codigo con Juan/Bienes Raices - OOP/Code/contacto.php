<?php
    require('includes/app.php');
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Destacada contacto">
        </picture>
        <h2>Llene el formulario de Contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
                
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Tu E-mail">
                
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" placeholder="Tu Teléfono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobrela Propiedad</legend>
                <label for="opiones">Tipo de Operación</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-- Seleccionar --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="presupuesto" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto" id="contactar-telefono">
                </div>

                <p>Si eligió teléfono, elija la fecha y hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" name="date" id="date">
                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" min="09:00" max="18:00">

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>