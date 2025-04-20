<?php

    // Modelo de loos usuarios
    require_once __DIR__ . '/../Modelo/personas_modelo.php';

    /*
        Si se presionó el botón de actualizar
    */
    if (isset($_POST['btn_actualizar_registro'])) {

        // Obtenemos los campos y sanitizamos
        $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
        $nombre = filter_var($_POST['Nombre'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['Apellido'], FILTER_SANITIZE_STRING);
        $direccion = filter_var($_POST['Direccion'], FILTER_SANITIZE_STRING);

        // Realizamos la actualización
        $actualizar = $actualizarUsuario->updateUser($id, $nombre, $apellido, $direccion);

        // Verificamos consulta
        if ($actualizar) {
            // Reedirigimos
            header('Location: index.php');
        } else {
            // Mensaje de error
            echo 
            '<div class="mensaje-error">Error al actualizar usuario
                <a href="index.php"> Volver </a>
            </div>';
        }
    }


?>