<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        // Creo un aray con alertas vacias
        $alertas = [];
        // Instancio un nuevo usuario para completar los "values"
        $auth = new Usuario;

        // Si el metodo es POST ->
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Instancio un nuevo usuario con los valores obtenidos del form
            $auth = new Usuario($_POST);
            // Validadador de email y contraseña
            $alertas = $auth->validarLogin();

            // Si no hay alertas ( campo email y password correctos )
            if(empty($alertas)){
                // Comprobar que exista el usuario
                $usuario = Usuario::where("email", $auth->email);
                if($usuario){
                    // Verificar el password y que el usuario este confirmado
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        session_start();
                        // Autenticar el usuario
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;

                        // Redireccionar
                        if($usuario->admin === "1"){
                            $_SESSION["admin"] = $usuario->admin ?? null;
                            header("location: /admin");
                        }
                        else{
                            header("location: /cita");
                        }
                    };
                }else{
                    Usuario::setAlerta("error", "Usuario no encontrado");
                }
            }
        }
        
        // Obtengo las nuevas posibles alertas
        $alertas = Usuario::getAlertas();

        $router->render("/auth/login", [
            "alertas" => $alertas,
            "auth" => $auth
        ]);
    }
    public static function logout(Router $router){
        session_start();
        $_SESSION = [];
        session_destroy();
        header("location: /");
    }

    public static function olvide(Router $router){
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            // Valido que se envie un mail por el formulario
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where("email", $auth->email);
                if($usuario && $usuario->confirmado === "1"){
                    // Generar token
                    $usuario->crearToken();
                    $usuario->guardar();

                    // TODO: enviar el mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito","Revisa tu email");
                }
                else{
                    Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                }
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render("/auth/olvide-password", [
            "alertas" => $alertas
        ]);
    }
    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
    
        $token = s($_GET["token"]);
        $usuario = Usuario::where("token", $token);
        
        if(empty($usuario)){
            // Mostrar mensaje de error
            Usuario::setAlerta("error", "Token no valido");
            $error = true;
        }
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Lee el nuevo password
            $auth = new Usuario($_POST);
            $alertas = $auth->validarPassword();

            if(empty($alertas)){
                $usuario->password = $auth->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header("location: /");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        
        $router->render("/auth/recuperar-password", [
            "alertas" => $alertas,
            "error" => $error
        ]);
    }
    public static function crear(Router $router){
        
        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            
            // Revisar que alertas este vacio
            if(empty($alertas)){
                // Verifica que el usuario no este registrado
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }
                else{
                    // No esta registrado
                    $usuario->hashPassword();
                    
                    // Generar un Token unico
                    $usuario->crearToken();

                    // Enviar el email
                    $mail = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $mail->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if($resultado){
                        header("location: /mensaje");
                    }
                }
            }
        }
        $router->render("/auth/crear-cuenta", [
            "usuario" => $usuario,
            "alertas"=> $alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render("auth/mensaje");
    }
    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET["token"]);
        $usuario = Usuario::where("token", $token);
        
        if(empty($usuario)){
            // Mostrar mensaje de error
            Usuario::setAlerta("error", "Token no valido");
        }else{
            // Modificar a usuario confirmado
            $usuario->confirmado = 1;
            $usuario->token = null;

            $resultado = $usuario->guardar();
            if($resultado){
                Usuario::setAlerta("exito", "Cuenta Comprobada Correctamente");
            }
            else{
                Usuario::setAlerta("error", "No Se Pudo Comprobada La Cuenta");
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("/auth/confirmar-cuenta", [
            "alertas" => $alertas
        ]);
    }
}