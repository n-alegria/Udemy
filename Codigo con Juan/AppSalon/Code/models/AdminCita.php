<?php

namespace Model;

class AdminCita extends ActiveRecord{
    // Base de datos
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ["id", "hora", "fecha", "cliente", "email", "telefono", "servicio", "precio"];

    public $id;
    public $hora;
    public $fecha;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->hora = $args["hora"] ?? null;
        $this->fecha = $args["fecha"] ?? null;
        $this->cliente = $args["cliente"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->telefono = $args["telefono"] ?? null;
        $this->servicio = $args["servicio"] ?? null;
        $this->precio = $args["precio"] ?? null;
    }
}