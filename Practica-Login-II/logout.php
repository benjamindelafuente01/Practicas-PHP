<?php

    // Reanudar la sesión que está abierta
    session_start();

    // Liberamos las variables de la sesión actual
    session_unset();

    // Finalizamos la sesión
    session_destroy();

    // Reedirigimos al login
    header('Location: Views/login_view.php');

    // Detenemos script
    die();

?>