<?php

namespace MVC;


class Router{
    public $rutasGET = [];
    public $rutasPOST = [];

    // Agrego la URL con la funcion asociada al metodo en el array GET
    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }
    // Agrego la URL con la funcion asociada al metodo en el array POST
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){
        // Inicio sesion
        session_start();
        $auth = $_SESSION["login"] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar"];

        // Obtengo la url y el metodo de acceso
        $urlActual = $_SERVER["REQUEST_URI"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];
    
        if($metodo === "GET"){
            $urlActual = explode("?", $urlActual)[0];
            $fn = $this->rutasGET[$urlActual] ?? null;
        }
        else{
            $urlActual = explode("?", $urlActual)[0];
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header("location: /");
        }


        // Si existe una funcion asociada la llamo y le paso las rutas
        if($fn){
            call_user_func($fn, $this);
        }else{
            echo "Code 404";
        }
    }

    // Muestra una vista, permite pasar datos
    public function render($view, $datos = []){
        // Recorro los datos
        foreach($datos as $key => $value){
            // $$ variable de variable -> pasa a tener el nombre de la key en el array asociativo
            $$key = $value;
        }
        
        // Inicia almacenamiento en memoria
        ob_start();
        include __DIR__ . "/views/{$view}.php";
        
        // Limpia la memoria y la almacena en contenido
        $contenido = ob_get_clean();

        // El contenido se inyecta en layout
        include __DIR__ . "/views/layout.php";
    }
}