<?php

require 'includes/funciones.php';

incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <form class="formulario" action="">
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email">

            <label for="password">Password</label>
            <input type="password" placeholder="Tu Password" id="password">

            <input type="submit" value="Iniciar sesión" class="boton boton-verde">


        </form>
    </main>

<?php

incluirTemplate('footer');

?>