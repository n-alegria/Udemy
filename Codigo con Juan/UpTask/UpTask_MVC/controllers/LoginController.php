<?php

namespace Controllers;

use MVC\Router;

class LoginController{

    // Login
    public static function index(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
        }
        $router->render("auth/login", [
            "titulo" => "Iniciar Sesión"
        ]);
    }

    // Logout
    public static function logout(){
        echo "logout";
        // $router->render("");
        
    }

    // Crear nuevo usuario
    public static function crear(Router $router){
        $router->render("auth/crear", [
            "titulo" => "Crear tu cuenta en UpTask"
        ]);
    }
    
    // Formulario resetear contraseña
    public static function olvide(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
        }
        $router->render("auth/olvide", [
            "titulo" => "Olvide mi Password"
        ]);
    }

    // Resetear contraseña
    public static function reestablecer(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
        }
        $router->render("auth/reestablecer", [
            "titulo" => "Reestablecer Password"
        ]);
    }

    // Mensaje reset
    public static function mensaje(Router $router){
        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }

    // Confirmar reset por token
    public static function confirmar(Router $router){
        $router->render("auth/confirmar", [
            "titulo" => "Confirma tu Cuenta UpTask"
        ]);
    }

}