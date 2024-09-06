<?php

    require 'config.php';

    try {

        // Realizamos conexion
        $conexion_pdo = new PDO(DATASOURCENAME, DBUSER, DBPASSWORD);

        // Configuramos PDO para lanzar excepciones en caso de error
        $conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOExepciton $e) {
        echo 'Error en la conexion: ' . $e->getMessage();
        die();
    }


?>