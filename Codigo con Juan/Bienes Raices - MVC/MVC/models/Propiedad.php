<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $tabla = 'propiedades';    

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';   
    }

    // Valida los datos
    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }
        if(strlen($this->descripcion) <= 10){
            self::$errores[] = "La descripcion es muy corta";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Debes añadir la cantidad de habitaciones";
        }
        if(!$this->wc){
            self::$errores[] = "Debes añadir la cantidad de wc";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "Debes añadir la cantidad de estacionamientos";
        }
        if($this->vendedorId === ""){
            self::$errores[] = "El vendedor es obligatorio";
        }
        if(!$this->imagen)
        {
            self::$errores[] = "La imagen es obligatria";
        }

        return self::$errores;
    }

}