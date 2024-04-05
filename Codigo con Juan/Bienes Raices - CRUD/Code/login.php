<?php
    // Importar la conexion
    require('includes/config/database.php');
    $db = conectarDB();
    
    $errores = [];

    // Autenticar al usuario
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST["password"]);
    
        if(!$email){
            $errores['email'] = "El email es obligatorio o no es valido";
        }
        if(!$password){
            $errores['password'] = "El password es obligatorio";
        }

        if(empty($errores)){
            // Consultar para obtener el usuario
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                // Obtengo el usuario de la base de datos
                $usuario = mysqli_fetch_assoc($resultado);
                
                // Verificar si el password es correcto
                $auth = password_verify($password, $usuario["password"]);
                if($auth){
                    // Las credenciales son correctas
                    session_start();

                    // Llenar el arreglo de la sesion
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;
                    header('Location: admin/');
                }
                else{
                    $errores['password'] = "El password es incorrecto";
                }
            }
            else{
                $errores['email'] = "El usuario no existe";
            }
            
        }
    }

    // Incluye el header
    require('includes/funciones.php');
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Iniciar Sesion</h2>
        <form method="POST" class="formulario w-50 contenido-centrado">
        <fieldset>
                <legend>Información Personal</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Tu E-mail" required>
                <?php if(isset($errores['email'])): ?>
                    <div class="alerta light-error"><?php echo $errores['email'] ?></div>
                <?php endif; ?>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password" required>
                <?php if(isset($errores['password'])): ?>
                    <div class="alerta light-error"><?php echo $errores['password'] ?></div>
                <?php endif; ?>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>