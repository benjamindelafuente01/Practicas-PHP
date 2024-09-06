<?php

    /*
        Script donde se verifica si hay una sesion activa y redirigimos
    */

    session_start();

    if ($_SESSION['usuario']) {
        header('Location: Logic/contenido_logic.php');
    } else {
        header('Location: Logic/inicio_sesion_logic.php');
    }

?>