<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD en PHP</title>
    <link rel="stylesheet" href="estilos-index.css">

</head>
<body>

    <h1>CRUD
        <span class="subtitulo">Create Read Update Delete</span>
    </h1>
    <hr>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>

            <?php
                // Archivo con las consultas
                require 'conexion.php';

                // Instancia de la clase
                $usuarios = new CRUD();

                /*
                    Creamos variables para la paginacion
                */
                // Página actual
                $pagina_actual = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : (int) 1;

                // Número de registros que aparecerán por pagina
                $registros_por_pagina = 3;

                // Desde qué registro se van a mostrar dependiendo de la página
                $inicio_mostrar_registros = ($pagina_actual - 1) * $registros_por_pagina;

                // Consultamos el total de registros (si no hay registros asignamos un 1)
                $total_registros = $usuarios->totalUsers() > 0 ? $usuarios->totalUsers() : (int) 1;

                // Total de páginas que se van a crear
                $total_paginas = ceil($total_registros / $registros_por_pagina);

                /*
                    Consultamos usuarios
                */
                // Obtenemos usuarios
                $registros = $usuarios->readUsers($inicio_mostrar_registros, $registros_por_pagina);

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
                                <a href="actualizarRegistro.php?id=' . $usuario->id . '" class=""> 
                                    <img src="Iconos/actualizar-usuario.png" class="" width="30" alt="">
                                </a>
                            </td>';
                        echo '<td>
                                <a href="eliminarRegistro.php?id=' . $usuario->id . '" class=""> 
                                    <img src="Iconos/quitar-usuario.png" class="" width="30" alt="">
                                </a>
                            </td>';
                        echo '</tr>';
                    }
                }

            ?>
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
    ?>

    <?php

        /*
            Verificamos que se haya pulsado el botón de insertar usuario
        */
        if (isset($_POST['agregar_usuario']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

            // Obtenemos los datos
            $nombre = filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING);
            $apellido = filter_var($_POST['apellido_usuario'], FILTER_SANITIZE_STRING);
            $domicilio = filter_var($_POST['domicilio_usuario'], FILTER_SANITIZE_STRING);

            // Verificamos que los campos no estén vacíos
            if ($nombre != '' && $apellido != '' && $domicilio != '') {

                // Instanciamos un objeto de la clase
                $insertarUsuario = new CRUD();

                // Insertamos datos
                $insertarUsuario->insertUser($nombre, $apellido, $domicilio);

                if ($insertarUsuario == true) {
                    header('Location: index.php');
                } else {
                    echo '<div class="mensaje-error">Error al insertar usuario...</div>';
                }

            }
        }

    ?>

</body>
</html>