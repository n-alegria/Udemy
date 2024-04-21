<?php

namespace App;

class ActiveRecord{
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];
    
    // Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    // Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitiza los datos
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            // Sanitiza los valores medianto POO
            $sanitizado[$key] = self::$db->escape_string($value);          
        }

        return $sanitizado;
    }

    // Validacion
    public static function getErrores(){
        return static::$errores;
    }

    // Valida los datos
    public function validar(){
        static::$errores = [];  
        return static::$errores;
    }

    // Setter imagen
    public function setImagen($imagen){
        // Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        // Asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Guarda la nueva propiedad en la base de datos
    public function crear(){

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // array_keys -> accede a las llaves del arreglo
        // array_values -> accede a los valores del arreglo

        // Insertar en la base de datos
        $query = "INSERT INTO ";
        $query .= static::$tabla . " ( ";
        $query .= join(',', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query( $query );

        return $resultado;    
    }
    public function actualizar(){
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        // Insertar en la base de datos
        $query = "UPDATE " . static::$tabla. " SET ";
        $query .= join(',', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query( $query );

        return $resultado;    
    }

    public function guardar(){
        if(!is_null($this->id)){
            return $this->actualizar();
        }
        else{
            return $this->crear();
        }
    }

    // ELiminar un registro
    public function eliminar(){
        $queryEliminar = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
        $resultado = self::$db->query( $queryEliminar );
        return $resultado;
    }

    // Lista todas los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Lista todas los registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Busca un registro por su id
    public static function find( $id ){        
        $query = "SELECT * FROM ";
        $query .= static::$tabla;
        $query .= " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ); // Retorna el primer elemento
    }

    // Cre unanueva instancia de Propiedad
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            // Comprueba que la clave exista en el objeto
            if( property_exists($objeto, $key) ){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        // Retornar resultados
        return $array;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if( property_exists( $this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}