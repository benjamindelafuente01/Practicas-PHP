<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar registro</title>
    <link rel="stylesheet" href="CSS/estilos-index.css">
</head>
<body>

<h2>Actualizar Registro</h2>

<?php

    // Verificamos que se haya elegido un registro existente
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
    
    // Controlador para cuando se actualice el registro
    require_once __DIR__ . '/../Controlador/formularioActualizarPersona_controlador.php';
?>
    
</body>
</html>