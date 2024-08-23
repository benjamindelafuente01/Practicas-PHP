<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar registro</title>
    <link rel="stylesheet" href="../Estilos/estilos_actualizar.css">
</head>
<body>

    <?php

        require '../Datos conexion/datos_conexion.php';
        require 'actualizar_datos.php';

        // Si el botón ha sido pulsado, mandamos a llamar a la función
        if (isset($_GET['btn_buscar_articulo_actualizar'])) {

            // Creamos instancia de mysqli
            $conexion = new mysqli($server, $user, $password, $dbname);

            // Verificamos conexión
            if ($conexion->connect_error) {
                die ("Error en la conexión: " . $conexion->connect_error);
            }

            // Obtenemos el código del artículo
            $codigoActualizar = $_GET['codigo_articulo'];
            // Creamos estrucutura de la consulta
            $sqlQuery = "SELECT * FROM productos WHERE CÓDIGOARTÍCULO = ?";
            // Preparamos consulta
            $stmtQuery = $conexion->prepare($sqlQuery);
            // Asociamos valores
            $stmtQuery->bind_param('s', $codigoActualizar);
            // Ejecutamos consulta
            $stmtQuery->execute();
            // Obtenemos resultados
            $resultado = $stmtQuery->get_result();
            

            // Verificamos resultado de la consulta
            if ($resultado->num_rows > 0) {

                echo '<h3>Ingresa los datos a actualizar:</h3>';
                echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="GET">';
                echo '<table>';

                while ($fila = $resultado->fetch_assoc()) {

                    // Creamos encabezado de tabla
                    echo '<tr>';
                    foreach($fila as $clave=>$dato) {
                        echo '<th>' . $clave . '</th>';
                    }
                    echo '</tr>';
                    
                    // Creamos inputs
                    echo '<tr>';
                    echo "<td> <input class='input-table' type='text' name='codigo_articulo' id='codigo_articulo' 
                        value=$fila[CÓDIGOARTÍCULO] readonly></td>";
                    echo "<td> <input class='input-table' type='text' name='seccion_articulo' id='seccion_articulo' 
                        value=$fila[SECCIÓN] required></td>";
                    echo "<td> <input class='input-table' type='text' name='nombre_articulo' id='nombre_articulo' 
                        value=$fila[NOMBREARTÍCULO] required></td>";
                    echo "<td> <input class='input-table' type='text' name='precio_articulo' id='precio_articulo' 
                        value=$fila[PRECIO] required></td>";
                    echo "<td> <input type='date' name='fecha_articulo' id='fecha_articulo' 
                        value=$fila[FECHA] required></td>";
                    echo "<td> <select name='importado_articulo' id='importado_articulo'>
                            <option value='verdadero'" . ($fila['IMPORTADO'] == 'VERDADERO' ? ' selected' : '') . "> Si </option>
                            <option value='falso'" . ($fila['IMPORTADO'] == 'FALSO' ? ' selected' : '') . "> No </option>
                        </select></td>";
                    echo "<td> <input class='input-table' type='text' name='pais_articulo' id='pais_articulo' 
                        value=$fila[PAÍSDEORIGEN] required></td>";
                    echo "<td> <input type='file' name='foto_articulo' id='foto_articulo'  
                        value=$fila[FOTO] ></td>";
                    echo '</tr>';

                }
                echo '</table>';

                // Botones
                echo '<div class="contenedor-botones">';
                echo '<input type="button" value="  Volver  " class="btn-volver" onclick="window.location.href=\'pagina_buscar_articulo.php\'">';
                echo '<input type="submit" class="btn-actualizar" name="btn_actualizar_registro" id="btn_actualizar_registro" value="Actualizar">';
                echo '</div>';

                echo '</form>';

            } else {
                echo "<div class='contenedor-resultado-actualizacion alert error'>
                El artículo con ese código no se pudo encontrar
                <a href='pagina_buscar_articulo.php'> Volver </a>
                </div>";
            }


        }


        /*
        Cuando se envia la actualización
        */
        if (isset($_GET['btn_actualizar_registro']) && $_SERVER['REQUEST_METHOD'] == 'GET') {

            // Obtenemos los datos del articulo ingresado
            $codigo = strtoupper($_GET['codigo_articulo']);
            $seccion = strtoupper($_GET['seccion_articulo']);
            $nombre = strtoupper($_GET['nombre_articulo']);
            $precio = strtoupper($_GET['precio_articulo']);
            $fecha = strtoupper($_GET['fecha_articulo']);
            $importado = strtoupper($_GET['importado_articulo']);
            $pais = strtoupper($_GET['pais_articulo']);

            // Manejo del archivo (foto)
            if (isset($_FILES['foto_articulo']) && $_FILES['foto_articulo']['error'] === UPLOAD_ERR_OK) {
                // Si se subió un archivo correctamente, puedes procesarlo o guardar su nombre
                $foto = strtoupper($_FILES['foto_articulo']['name']);
            } else {
                // Si no se subió archivo, asignamos NULL
                $foto = null;
            }

            // Llamamos a la función para insertar datos y almacenamos resultado
            $consulta = actualizarRegistros($codigo, $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto);

            echo "<div class='contenedor-resultado-actualizacion'>";
            // Imprimimos resultado
            if ($consulta) {
                echo "<div class='alert success'> 
                    Artículo actualizado correctamente
                    <a href='pagina_buscar_articulo.php'> Volver </a>
                </div>";
            } else {
                echo "<div class='alert error'>
                El artículo no se pudo actualizar 
                <a href='pagina_buscar_articulo.php'> Volver </a>
                </div>";
            }
            echo "</div>";
        }

    ?>


</body>
</html>