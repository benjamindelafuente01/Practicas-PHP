<?php

    function insertarRegistros($codigo, $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto) {

        // Importamos script con los datos
        require 'datos_conexion.php';

        // Creamos instancia de mysqli
        $conexion = new mysqli($server, $user, $password, $dbname);

        // Comprobamos conexión
        if ($conexion->error) {
            die ('Error de conexión: ' . $conexion->error);
        }

        // Estructura de la consulta SQL
        $sqlQuery = "INSERT INTO productos(CÓDIGOARTÍCULO, SECCIÓN, NOMBREARTÍCULO, PRECIO, FECHA, IMPORTADO, PAÍSDEORIGEN, FOTO)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Preparamos la consulta
        $stmtQuery = $conexion->prepare($sqlQuery);

        // Asociamos los valores a las variables
        $stmtQuery->bind_param('sssdssss', $codigo, $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto);

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