<?php

    require 'config.php';

    /*
        Realizamos la conexión a base de datos
    */
    try {
        $conexion_pdo = new PDO(DATASOURCENAME, USER, USERPASSWORD);

        // Configuramos para que PDO lance excepciones
        $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Desactivamos las preparaciones emuladas para poder pasar un arreglo con execute() en PDO
        $conexion_pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

    } catch (PDOException $e) {

        // Obtenemos mensaje y detenemos programa
        echo 'Error: ' . $e->getMessage();
        die();
    }

?>