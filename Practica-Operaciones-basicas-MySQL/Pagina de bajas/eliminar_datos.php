<?php

    function eliminarRegistros($codigo) {

        // Importamos script con los datos
        require '../Datos conexion/datos_conexion.php';

        // Creamos instancia de mysqli
        $conexion = new mysqli($server, $user, $password, $dbname);

        // Comprobamos conexión
        if ($conexion->error) {
            die ('Error de conexión: ' . $conexion->error);
        }

        // Estructura de la consulta SQL
        $sqlQuery = "DELETE FROM productos WHERE CÓDIGOARTÍCULO = ?";
        
        // Preparamos la consulta
        $stmtQuery = $conexion->prepare($sqlQuery);

        // Asociamos los valores a las variables
        $stmtQuery->bind_param('s', $codigo);

        // Ejecutamos la consulta
        $stmtQuery->execute();

        // var_dump($conexion);
        // var_dump($stmtQuery);

        // Verificamos que se hayan insertado correctamente (devolverá true si es mayor que 0)
        $resultado = $conexion->affected_rows > 0;

        // Cerramos la consulta y la conexión
        $stmtQuery->close();
        $conexion->close();

        // Regresamos resultado
        return $resultado;
    }

?>