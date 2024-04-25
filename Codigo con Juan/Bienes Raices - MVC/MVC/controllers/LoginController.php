<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
        
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Admin($_POST);
        
            $errores = $auth->validar();

            if(empty($errores)){
                // Verificar si el usuario existe ->
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    // Si no existe actualizo los errores
                    $errores = Admin::getErrores();
                }else{
                    // Verificar el password ->
                    // Si existe, le envio el usuario que existe en la variable $resultado
                    // $autenticado = $auth->comprobarPassword($resultado);
                    $autenticado = true; 
                    // Autenticar al usuario ->
                    // Si no existe actualizo los errores
                    if(!$autenticado){
                        $errores = Admin::getErrores();
                    }
                    else{
                        $auth->autenticar();
                    }

                }
            }
        }

        $router->render("auth/login", [
            "errores" => $errores,
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        session_destroy();

        header("location: /");
    }
}