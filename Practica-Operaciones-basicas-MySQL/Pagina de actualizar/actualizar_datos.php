<?php

    function actualizarRegistros($codigo, $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto) {
        
        // Importamos script con los datos
        require '../Datos conexion/datos_conexion.php';

        // Creamos instancia de mysqli
        $conexion = new mysqli($server, $user, $password, $dbname);

        // Comprobamos conexión
        if ($conexion->error) {
            die ('Error de conexión: ' . $conexion->error);
        }

        // Estructura de la consulta SQL
        $sqlQuery = "UPDATE productos SET SECCIÓN = ?, NOMBREARTÍCULO = ?, PRECIO = ?, FECHA = ?, IMPORTADO = ?, PAÍSDEORIGEN = ?, FOTO = ?
                    WHERE CÓDIGOARTÍCULO = ?";
        
        // Preparamos la consulta
        $stmtQuery = $conexion->prepare($sqlQuery);

        // Asociamos los valores a las variables
        $stmtQuery->bind_param('ssdsssss', $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto, $codigo);

        // Ejecutamos la consulta
        $stmtQuery->execute();

        // var_dump($conexion);
        // var_dump($stmtQuery);

        // Verificamos que se hayan insertado correctamente (devolverá true si es mayor que 0)
        $resultado = $stmtQuery->affected_rows > 0;

        // Cerramos la consulta y la conexión
        $stmtQuery->close();
        $conexion->close();

        // Regresamos resultado
        return $resultado;
    }

?>