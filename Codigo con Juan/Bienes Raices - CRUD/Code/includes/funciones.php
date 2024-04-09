<?php
require('app.php');
function incluirTemplate( string $nombre, bool $inicio = false ){
    include(TEMPLATES_URL."/{$nombre}.php");
}

function estaAutenticado(){
    session_start();
    if(!isset($_SESSION["login"])){
        header("location: /BienesRaices/Code/");
    }
}