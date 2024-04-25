<?php

namespace Model;
use Model\ActiveRecord;

class Admin extends ActiveRecord{
    // Base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password"];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->password = $args["password"] ?? null;
    }

    public function validar(){
        if(!$this->email){
            self::$errores["email"] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$errores["password"] = "El password es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '{$this->email}' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows){
            self::$errores["auth"] = "El Usuario no existe";
            return;
        }
        return $resultado;
    }
    
    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();
        // Compruebo el password hash contra el password del usuario ( pasado por el form )
        $autenticado = password_verify($this->password, $usuario->password);
        if(!$autenticado){
            self::$errores["auth"] = "El Password es incorrecto";
            return;
        }
        return $autenticado;
    }

    public function autenticar(){
        // Iniciamos la sesion
        session_start();

        // Llenar el arreglo de sesion
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("location: /admin");
    }

}