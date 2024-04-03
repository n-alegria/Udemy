<?php

function conectarDB(){
    $db = mysqli_connect('localhost', 'root', 'ARnal2592?', 'bienesraices_crud');
    if($db){
        echo "Se conecto";
    }
    else{
        echo "No se conecto";
    }
}