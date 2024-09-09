<?php

    // Iniciamos o reanudamos sesión
    session_start();

    /*
        Verificamos si hay una sesión activa y mandamos al login o contenido
    */
    if (!isset($_SESSION['usuario'])) {
        header ('location: Views/login_view.php');
    } else {
        header ('Location: Views/contenido_view.php');
    }

?>