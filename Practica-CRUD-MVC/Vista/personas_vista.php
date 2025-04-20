<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con MVC</title>
    <link rel="stylesheet" href="CSS/estilos-index.css">
</head>

<body>
    <h1>CRUD con MVC
        <span class="subtitulo">Create Read Update Delete</span>
    </h1>
    <hr>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>

            <?php
                // Validamos el registro
                if ($registros != false) {

                    // Variable para insertar titulos
                    $bandera = false;
                    
                    // Recorremos todos los registros
                    foreach($registros as $usuario) { 
                        
                        // Creamos encabezados
                        if (!$bandera) {
                            echo '<tr>';
                            foreach($usuario as $titulo => $valor) {
                                echo '<th>' . strtoupper($titulo) . '</th>';
                            }
                            // Desactivamos bandera
                            $bandera = true;
        
                            // Titulo de acciones
                            echo '<th colspan="2">Acciones</th>';
                            echo '</tr>';
                        }
                        
                        // Añadimos registros
                        echo '<tr>';
                        foreach($usuario as $clave => $valor) {
                            echo '<td>' . $valor . '</td>';
                        }
                        
                        // Añadimos imaganes de acción a cada fila
                        echo '<td>
                                <a href="actualizar_registro.php?id=' . $usuario->id . '" class=""> 
                                    <img src="Iconos/actualizar-usuario.png" class="" width="30" alt="">
                                </a>
                            </td>';
                        echo '<td>
                                <a href="eliminar_registro.php?id=' . $usuario->id . '" class=""> 
                                    <img src="Iconos/quitar-usuario.png" class="" width="30" alt="">
                                </a>
                            </td>';
                        echo '</tr>';
                    }
                }
            ?>

            <!-- Formulario para ingresar un nuevo usuario -->
            <td></td>
            <td>
                <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre" required>
            </td>
            <td>
                <input type="text" id="apellido_usuario" name="apellido_usuario" placeholder="Apellido" required>
            </td>
            <td>
                <input type="text" id="domicilio_usuario" name="domicilio_usuario" placeholder="Dirección" required>
            </td>
            <td  colspan="2">
                <input type="submit" id="agregar_usuario" class="agregar-usuario" name="agregar_usuario" value="Agregar">
            </td>
        </table>
    </form>

    <!-- Paginación -->
    <?php
        echo '<div class="paginacion">';
        for ($i=1; $i<=$total_paginas; $i++) {
            echo '<a class="pagina" href="index.php?pagina=' . $i . '">' . $i . '</a> ';
        }
        echo '</div>';


        // Script para cuando se registre un nuevo usuario
        require_once __DIR__ . '/../Controlador/formularioAgregarPersona_controlador.php';
    ?>

</body>
</html>