<?php

    // Iniciamos o reanudamos sesión
    session_start();

    // Verificamos si hay una sesión activa
    if (!isset($_SESSION['usuario'])) {
        header('Location: login_view.php');
    }

    // Accedemos al nombre
    $nombre_usuario = $_SESSION['usuario'];

?>