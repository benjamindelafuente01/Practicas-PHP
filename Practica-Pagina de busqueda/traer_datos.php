<?php

    /*
    Función que realiza la consulta y muestra los resultados en forma de tabla, se llama desde el index
    */
    function mostrarResultados($busquedaUsuario) {

        // Inlcuimos los datos para la conexion
        require 'datos_conexion.php';
        
        // Instancia de mysqli
        $conexion = new mysqli($server, $user, $password, $dbname);

        // Comprobamos que la conexion sea correcta
        if ($conexion->connect_error) {
            die ('Error en la conexión: ' . $conexion->connect_error);
        }

        // Obtenemos los valores que el usuario envió
        // Se usan '{}' para insertar el valor de una variable dentro de una cadena (en este caso, en la misa variable)
        // $busquedaUsuario = '%' . $busquedaUsuario . '%';    # Una forma más sencilla
        $busquedaUsuarioComodin = "%{$busquedaUsuario}%";

        // Estructura de la consulta SQL
        $SqlQuery = "SELECT * FROM productos WHERE NOMBREARTÍCULO LIKE ?";

        // Preparamos la consulta
        $stmtQuery = $conexion->prepare($SqlQuery);
        // Asociamos los valores con las variables
        $stmtQuery->bind_param('s', $busquedaUsuarioComodin);
        // Ejecutamos la consulta
        $stmtQuery->execute();

        // Almacenamos resultado (obtendremos un objeto de tipo 'mysqli_result' y podremos acceder a sus métodos)
        $resultado = $stmtQuery->get_result();

        // Verificamos si la consulta fue exitosa
        if ($resultado->num_rows > 0) {

            echo "<div class='mensaje-consulta-exito'> Resultados asociados a la búsqueda " . "'<i>$busquedaUsuario</i>'... </div>";

            // Creamos tabla y añadimos los elementos
            echo '<table>';

            // Bandera para la fila de titulos
            $bandera = false;

            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr>';

                // Creamos fila para los titulos de la tabla
                if(!$bandera) {
                    echo '<tr>';
                    foreach($fila as $clave => $dato) {
                        echo '<th>' . $clave. '</th>';
                    }
                    echo '</tr>';
                    $bandera = true;
                }

                // Creamos las filas de los datos
                foreach($fila as $clave => $dato) {
                    $dato = $dato ?? '<i>Sin imagen</i>';
                    echo '<td>' . $dato . '</td>';
                }

                echo "</tr>";
            }
            echo '</table>';

        } else {
            echo "<div class='mensaje-consulta-error'> No se encontraron registros con esos datos " . "'<i>$busquedaUsuario</i>'</div>";
        }

    }

?> 