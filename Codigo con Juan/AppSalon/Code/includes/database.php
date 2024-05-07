<?php

try{
    $db = mysqli_connect('localhost', 'root', 'root', 'appsalon', 3306);

}catch(Exception $e){
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
