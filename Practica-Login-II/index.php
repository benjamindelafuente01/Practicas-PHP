<?php

    // Iniciamos o reanudamos sesión
    session_start();

    /*
        Verificamos si hay una sesión activa y mandamos al login o contenido
    */
    if (!isset($_SESSION['usuario'])) {

        /*
            Verificamos si hay una cookie con el usuario
        */
        if (isset($_COOKIE['recordar_usuario'])) {
            // Guardamos nombre del usuario en una sesión
            $_SESSION['usuario'] = $_COOKIE['recordar_usuario'];
            // Redirigimos al contenido
            header('Location: Views/contenido_view.php');
        } else {
            // Si no hay sesión ni cookie, redirigimos al login
            header('Location: Views/login_view.php');
        }

    } else {
        // Si hay sesión activa, redirigimos al contenido
        header('Location: Views/contenido_view.php');
    }


?>