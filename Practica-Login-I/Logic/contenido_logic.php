<?php

    // Verificamos que haya una sesión activa
    session_start();

    if(isset($_SESSION['usuario'])) {
        // Cargamos vista del contenido
        require '../Views/contenido_view.php';
    } else {
        header('Location: ../index.php');      
    }

    

?>