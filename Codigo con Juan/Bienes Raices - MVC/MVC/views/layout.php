<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION["login"] ?? null;

    if(isset($inicio)){
        $inicio = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Bienes Raices</title>
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header" src="../build/img/logo.svg" alt="Logotipo de bienes raices">
                </a>
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="boton-dark-mode" src="../build/img/dark-mode.svg" alt="Dark Mode">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Session</a>
                        <?php else: ?>
                            <a href="/login">Login</a>
                        <?php endif; ?>
                        
                    </nav>
                </div>
            </div> <!-- .barra -->
            <?php if( isset($inicio) ){ ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>

    <!-- // Contenido variable -->
    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/anuncios">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
    </footer>

    <script src="./build/js/bundle.min.js"></script>
</body>
</html>