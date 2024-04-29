<?php

    // Recorre las claves del arreglo de alertas
    foreach ($alertas as $key => $mensajes):
        // De cada clave recorre los mensajes
        foreach ($mensajes as $mensaje):
?>
    <div class="alerta <?php echo $key;?>"><?php echo $mensaje;?></div>
<?php
        endforeach;

    endforeach;
?>