<?php

// // Importar la conexion
// require("includes/config/database.php");
// $db = conectarDB();

// // Crear un email y password
// $email = 'correo@correo.com';
// $password = '123456';

// $passwordHash = password_hash($password, PASSWORD_DEFAULT);

// // Query para crear el usuario
// $query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}')";

// // Agregarlo a la base de datos
// mysqli_query($db, $query);

// Las credenciales son correctas
session_start();

// Llenar el arreglo de la sesion
$_SESSION["usuario"] = 'correo@correo.com';
$_SESSION["login"] = true;
header('Location: admin/');