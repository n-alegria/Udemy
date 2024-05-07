<?php 

use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

// Creo una instancia y le indico la direccion actual
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
ActiveRecord::setDB($db);

