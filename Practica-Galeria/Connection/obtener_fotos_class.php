<?php

    // Importamos archivo de la conexión
    require 'conexion.php';

    /*
        Clase para obtener todas las fotos
    */
    class ObtenerFotos extends ConexionBD {

        // Método constructor
        public function __construct() {

            // Llamamos al constructor de la clase padre
            parent:: __construct();
        }

        // Método para obtener las fotos dentro del rango
        public function consultarImagenes ($inicio, $final) {

            // Estructura de la consulta
            $sql = "SELECT * FROM fotos LIMIT :foto_inicio , :foto_fin";
            // Preparamos la consulta
            $stmt = $this->conexion_pdo->prepare($sql);
            // Asociamos valores
            $marcadores = [':foto_inicio' => $inicio, ':foto_fin' => $final];
            // Ejecutamos la consulta
            $stmt->execute($marcadores);

            // Almacenamos resultado en un arreglo
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Sino hay fotos retornamos false
            if (!$resultado) {
                return false;
            } else {
                return $resultado;
            }
        }

        // Método para consultar el total de las filas
        public function consultarFilas() {

            // Estructura de la consulta para contar todas las filas de la tabla 'fotos'
            $sql = "SELECT COUNT(*) as total_filas FROM fotos";
            // Preparamos la consulta
            $stmt = $this->conexion_pdo->prepare($sql);
            // Ejecutamos la consulta
            $stmt->execute();

            // Almacenamos el resultado
            $resultado = $stmt->fetch()['total_filas'];

            return $resultado;
        }

        // Método para obtener foto en individual de acuerdo a su ID
        public function FotoId ($id) {

            // Estructura de la consulta para obtener foto individual
            $sql = "SELECT * FROM fotos WHERE id = :id";
            // Preparamos la consulta
            $stmt = $this->conexion_pdo->prepare($sql);
            // Asociamos valores
            $stmt->bindValue(':id', $id);
            // Ejecutamos la consulta
            $stmt->execute();

            // Almacenamos resultado
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Comprobamos resultado y devolvemos imagen seleccionada
            if (!$resultado) {
                return false;
            } else {
                return $resultado;
            }
        }
    }

?>