<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        // Con el modelo traigo las propiedades de la base de datos
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET["mensaje"] ?? null;

        // Le paso las propiedades a la vista
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "resultado" => $resultado,
        ]);
    }
    public static function crear(Router $router){
        // La instancio vacia para poder utilizar las validaciones, se completa en el POST
        $propiedad = new Propiedad;

        // Obtengo todos los vendedores
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        // Ejecuta el codigo cuando se envia el formulario via POST
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Creo una nueva propiedad con los valores obtenidos por POST
            $propiedad = new Propiedad($_POST['propiedad']);
    
            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            if($_FILES['propiedad']['tmp_name']['imagen']){
                // Realiza un resize a la imagen
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);  // Seteo el nombre de la imagen
                $propiedad->setImagen($nombreImagen);
            }

            // compruebo si hay errores 
            $errores = $propiedad->validar();
            
            // Revisar si el arreglo de errores esta vacio
            if(empty($errores)){
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                // Sanitizo y guardo en la BD
                $resultado = $propiedad->crear();

                if($resultado){
                    header("Location: ../admin?mensaje=1");
                }
            }
        }
        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores,
        ]);
    }
    public static function actualizar(Router $router){
        // Valido que sea un id valido, sino redirecciono a admin
        $id = validarORedireccionar("/admin");

        // Obtengo la propiedad desde la base de datos
        $propiedad = Propiedad::find($id);
        
        // Obtengo todos los vendedores
        $vendedores = Vendedor::all();

        // Errores
        $errores = Propiedad::getErrores();

        // Ejecuta el codigo cuando se envia el formulario
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            $errores = $propiedad->validar();  

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

            // Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){
                // Realiza un resize a la imagen
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);  // Seteo el nombre de la imagen
                $propiedad->setImagen($nombreImagen);
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            // Revisar si el arreglo de errores esta vacio
            if(empty($errores)){
                $resultado = $propiedad->guardar();
                if($resultado){
                    header("Location: ../admin?mensaje=2");
                }
            }
        }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Obtengo el id a eliminar
            $id = validarORedireccionar("/");

            // Busco la propiedad a eliminar
            $propiedad  = Propiedad::find($id);
            $resultadoEliminar = $propiedad->eliminar();

            if($resultadoEliminar){
                $propiedad->borrarImagen();
                header("Location: ../admin?mensaje=3");
            }
        }
    }
}