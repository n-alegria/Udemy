<?php
    // Base de  datos
    require('../../includes/config/database.php');
    conectarDB();

    require('../../includes/funciones.php');
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/BienesRaices/Code/admin/" class="boton boton-verde">Volver</a>
    
        <form action="#" class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" placeholder="Descripcion Propiedad"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>
                
                <label for="habitaciones">Habitaciones</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej.: 3" min="1" max="9">

                <label for="wc">Baños</label>
                <input type="number" name="wc" id="wc" placeholder="Ej.: 3" min="1" max="9">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej.: 3" min="1" max="9">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="vendedor">
                    <option value="" disabled selected>-- Seleccione un vendedor --</option>
                    <option value="1">Juan</option>
                    <option value="2">Karen</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>