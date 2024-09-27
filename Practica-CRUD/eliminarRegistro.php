<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar registro</title>
    <link rel="stylesheet" href="estilos-index.css">
</head>
<body>

    <?php

    // Archivo para eliminar registro
    require 'conexion.php';

    // Instanciamos un objeto de la clase
    $eliminar = new CRUD();

    // Obtenemos el ID seleccionado
    $idUsuario = (int) $_GET['id'] ?? null;

    // Verificamos que se halla agregado un id válido
    if ($idUsuario == null) {
        echo '<div class="mensaje-error">Primero selecciona un registro válido</div>';
    } else {
        // Eliminamos usuario
        $borrarUsuario = $eliminar->deleteUser($idUsuario);

        // Verificamos operacion
        if ($borrarUsuario) {
            header('Location: index.php');
        } else {
            echo '<div class="mensaje-error">Algo salió mal...</div>';
        }
    }

    ?>
    
</body>
</html>