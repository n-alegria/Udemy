<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $router->render("/paginas/index", [
            "inicio" => true,
            "propiedades" => $propiedades
        ]);
    }
    public static function nosotros(Router $router){
        $router->render("/paginas/nosotros");
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render("/paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar("/");

        $propiedad = Propiedad::find($id);
        
        $router->render("/paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render("/paginas/blog");
    }
    public static function entrada(Router $router){
        $router->render("/paginas/entrada");
    }
    public static function contacto(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $mensaje = null;

            $respuestas = $_POST["contacto"];
            

            // Crear una nueva instancia de PHPMAiler
            $mail = new PHPMailer();

            // Configurar SMTP ( protocolo para envio de emails )
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "87949b72f91b33";
            $mail->Password = "4830c77c74c86a";
            $mail->SMTPSecure = "tls";
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom("admin@bienesraices.com"); // Quien lo envia
            $mail->addAddress("admin@bienesraices.com", "BienesRaices.com"); // A que email enviarlo
            $mail->Subject = "Tienes un Nuevo Mensaje"; // Mensaje cuando llega el mail

            // Habilitar HTML
            $mail->isHTML(true); // habilita html
            $mail->CharSet = "UTF-8"; // caracteres especiales

            // Definir el contenido
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>Nombre: {$respuestas["nombre"]}</p>";

            // Enviar de forma condicional email o telefono
            if($respuestas["contacto"] === "telefono"){
                $contenido .= "<p>Eligio ser contactado por Telefono</p>";
                $contenido .= "<p>Telefono: {$respuestas["telefono"]}</p>";
                $contenido .= "<p>Fecha: {$respuestas["fecha"]}</p>";
                $contenido .= "<p>Hora: {$respuestas["hora"]}</p>";
            }
            else{
                $contenido .= "<p>Eligio ser contactado por Email</p>";
                $contenido .= "<p>Email: {$respuestas["email"]}</p>";
            }
            $contenido .= "<p>Mensaje: {$respuestas["mensaje"]}</p>";
            $contenido .= "<p>Tipo: {$respuestas["tipo"]}</p>";
            $contenido .= "<p>Precio: {$respuestas["precio"]}</p>";
            $contenido .= "<p>Contacto: {$respuestas["contacto"]}</p>";
            $contenido .= "</html>";


            // Enviar el email
            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternativo sin HTML";

            if($mail->send()){
                $mensaje = "Mensaje enviado Correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar";
            }

        }
        $router->render("/paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }
}