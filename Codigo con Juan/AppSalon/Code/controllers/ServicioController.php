<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        // Inicio la sesión
        session_start();

        isAdmin();

        $servicios = Servicio::all();
        $router->render("/servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        ]);
    }

    // Crear Servicio
    public static function crear(Router $router){
        // Inicio la sesión
        session_start();

        isAdmin();

        $servicio = new Servicio();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar(); 

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("/servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    // Actualizar Servicio
    public static function actualizar(Router $router){
        // Inicio la sesión
        session_start();

        isAdmin();

        $id = is_numeric($_GET["id"]);
        if(!$id) header("Location: /servicios");
        $servicio = Servicio::find($id);
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("/servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function eliminar(){
        session_start();
        isAdmin();

        $id = $_POST["id"];
        $servicio = Servicio::find($id);

        $servicio->eliminar();
        header("Location: /servicios");
    }
}