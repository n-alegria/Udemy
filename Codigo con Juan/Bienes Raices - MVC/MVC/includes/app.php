<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    use Model\ActiveRecord;
    
    // Conectar a la base de datos
    $db = conectarDB();

    ActiveRecord::setDB($db);

?>