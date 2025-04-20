<?php

    // Cargamos el modelo
    require_once __DIR__ . '/../Modelo/personas_modelo.php';

    // Obtenemos id del usuario seleccionado
    $idUsuario = $_GET['id'] ?? null;

    // Instancia de la clase para actualizar registro
    $actualizarUsuario = new CRUD();

    // Comprobación de que se haya seleccionado un usuario
    if ($idUsuario != null) {
        
        /*
            Consultamos en la base de datos y creamos formulario
        */
        // Consultamos usuario
        $registro = $actualizarUsuario->getUser($idUsuario);
    }

    // Cargamos la vista
    require_once __DIR__ . '/../Vista/actualizarPersona_vista.php';
?>