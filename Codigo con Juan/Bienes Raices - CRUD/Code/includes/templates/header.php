<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $login = $_SESSION["login"] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BienesRaices/Code/build/css/app.css">
    <title>Bienes Raices</title>
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/BienesRaices/Code/index.php">
                    <img class="logo-header" src="/BienesRaices/Code/build/img/logo.svg" alt="Logotipo de bienes raices">
                </a>
                <div class="mobile-menu">
                    <img src="/BienesRaices/Code/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="boton-dark-mode" src="/BienesRaices/Code/build/img/dark-mode.svg" alt="Dark Mode">
                    <nav class="navegacion">
                        <a href="/BienesRaices/Code/nosotros.php">Nosotros</a>
                        <a href="/BienesRaices/Code/anuncios.php">Anuncios</a>
                        <a href="/BienesRaices/Code/blog.php">Blog</a>
                        <a href="/BienesRaices/Code/contacto.php">Contacto</a>
                        <?php if($login): ?>
                            <a href="/BienesRaices/Code/cerrar.php">Cerrar Session</a>
                        <?php else: ?>
                            <a href="/BienesRaices/Code/login.php">Login</a>
                        <?php endif; ?>
                        
                    </nav>
                </div>
            </div> <!-- .barra -->
            <?php if( $inicio ){ ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>