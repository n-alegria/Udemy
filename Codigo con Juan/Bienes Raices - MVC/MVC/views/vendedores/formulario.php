<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del vendedor (a)" value="<?php echo s($vendedor->nombre);?>">
    
    <label for="apellido">apellido</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido del vendedor (a)" value="<?php echo s($vendedor->apellido);?>">

</fieldset>

<fieldset>
    <legend>Información Adicional</legend>
    <label for="telefono">telefono</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Telefono del vendedor (a)" value="<?php echo s($vendedor->telefono);?>">
</fieldset>