<?php

    // Archivo para eliminar registro
    require_once __DIR__ . '/../Modelo/personas_modelo.php';

    // Instanciamos un objeto de la clase
    $eliminar = new CRUD();

    // Obtenemos el ID seleccionado
    $idUsuario = (int) $_GET['id'] ?? null;

    // Realizamos consulta solo en caso de que ID sea diferente de null
    if($idUsuario != null) {
        // Eliminamos usuario
        $borrarUsuario = $eliminar->deleteUser($idUsuario);
    }

    // Cargamos vista
    require_once __DIR__ . '/../Vista/eliminarPersona_vista.php';
?>