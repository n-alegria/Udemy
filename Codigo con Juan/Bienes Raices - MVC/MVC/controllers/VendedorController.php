<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router){
        // La instancio vacia para poder utilizar las validaciones, se completa en el POST
        $vendedor = new Vendedor;

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        // Ejecuta el codigo cuando se envia el formulario via POST
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Creo una nueva instancia de vendedor con los valores obtenidos por POST
            $vendedor = new Vendedor($_POST['vendedor']);
    
            // Compruebo si hay errores 
            $errores = $vendedor->validar();
            
            // Revisar si el arreglo de errores esta vacio
            if(empty($errores)){
                // Sanitizo y guardo en la BD
                $resultado = $vendedor->crear();

                if($resultado){
                    header("Location: ../admin?mensaje=1");
                }
            }
        }
        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores,
        ]);
    }

    public static function actualizar(Router $router){
        // Valido que sea un id valido, sino redirecciono a admin
        $id = validarORedireccionar("/admin");

        // Obtengo la propiedad desde la base de datos
        $vendedor = Vendedor::find($id);

        // Errores
        $errores = Vendedor::getErrores();

        // Ejecuta el codigo cuando se envia el formulario
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Asignar los atributos
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            $errores = $vendedor->validar();  

            // Revisar si el arreglo de errores esta vacio
            if(empty($errores)){
                $resultado = $vendedor->guardar();
                if($resultado){
                    header("Location: ../admin?mensaje=2");
                }
            }
        }

        $router->render("vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Obtengo el id a eliminar
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if(!$id){
                header('Location: ./');
            }

            // Busco la propiedad a eliminar
            $vendedor  = Vendedor::find($id);
            $resultadoEliminar = $vendedor->eliminar();
            if($resultadoEliminar){
                header("Location: ../admin?mensaje=3");
            }
        }
    }
}