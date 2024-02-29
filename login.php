<?php

// Incluye el header 
require 'includes/funciones.php';

incluirTemplate('header');

require 'includes/config/database.php';

$db = conectarDB();

$errores = [];

// Autentificar el usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST'){



    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);


    if(!$email){
        $errores[] = "El email es obligatorio o no es válido";
    }
    if(!$password){
        $errores[] = "El password es obligatorio";
    }

    if(empty($errores)){
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);
        
        
        if($resultado->num_rows){
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto o no
            $auth = password_verify($password, $usuario["password"]);

            if($auth){
                //Usuario está autenticado
                session_start();

                $_SESSION['usuario'] = $usuario['email'];
                // $_SESSION['rol'] = 1;
                $_SESSION['login'] = true;

                header('Location: /bienesraices/admin');

            } else{
                $errores[] = "El password es incorrecto";
            }

        } else{
            $errores[] = "El usuario no existe";
        }

        }
    }

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>


    <form method="POST" class="formulario" novalidate>
        <legend>Email y Password</legend>

        <label for="email">E-mail</label>
        <input type="email" name="email" placeholder="Tu Email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Tu Password" id="password" required>

        <input type="submit" value="Iniciar sesión" class="boton boton-verde">


    </form>
</main>

<?php

incluirTemplate('footer');

?>