<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar registro</title>
    <link rel="stylesheet" href="estilos-index.css">
</head>
<body>

    <h2>Actualizar Registro</h2>

    <?php

    // Archivo de las clases
    require 'conexion.php';

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
    
        if ($registro == false) {
            echo '<div class="mensaje-error">¡Elige un registro válido!</div>';
        } else {
    
            // Formulario
            echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="POST">';
    
            // Creamos tabla para actualizar
            echo '<table>';
    
            // Recorremos registro
            foreach ($registro as $usuario) {
                
                // Creamos titulos de la tabla
                echo '<tr>';
                foreach($usuario as $titulo => $valor) {
                    echo '<th>' . $titulo . '</th>';
                }
                echo '</tr>';
    
                // Creamos inputs de la tabla
                echo '<tr>';
                foreach($usuario as $titulo => $valor) {
                    if ($titulo == 'id')  {
                        echo '<td>';
                        echo '<input type="text" value="' . $valor . '" name="' . $titulo . '" readonly>';
                        echo '</td>';
                    } else {
                        echo '<td>';
                        echo '<input type="text" value="' . $valor . '" name="' . $titulo . '">';
                        echo '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '<table>';
    
            // Botones
            echo '<div class="contenedor-botones">';
            echo '<input type="button" value="  Volver  " class="btn-volver" onclick="window.location.href=\'index.php\'">';
            echo '<input type="submit" class="btn-actualizar" name="btn_actualizar_registro" id="btn_actualizar_registro" value="Actualizar">';
            echo '</div>';
    
            echo '</form>';
        }

    }

    /*
        Se envió el formulario
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
    
</body>
</html>