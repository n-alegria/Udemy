<?php

function conectarDB() : mysqli{
    try{
        $db = new mysqli('localhost', 'root', 'ARnal2592?', 'bienesraices_crud', 3306);
        return $db;
    }
    catch(Exception $e){
        echo $e;
        exit;
    }
}