<?php

    // Importamos datos de conexion
    require 'conexion.php';

    /*
        Clase para eliminar los datos de una foto en la base de datos
    */
    class EliminarFoto extends ConexionBD{

        // Método constructor
        public function __construct() {

            // Llamamos al constructor de la clase padre
            parent::__construct();
        }

        // Método para eliminar datos de una imagen
        public function eliminarImagen($nombre) {

            // Estructura de la consulta
            $sql = "DELETE FROM fotos WHERE nombre = :nombre";
            // Preparamos la consulta
            $stmt = $this->conexion_pdo->prepare($sql);
            // Asociamos parametros
            $stmt->bindValue(':nombre', $nombre);
            // Ejecutamos la consulta
            $stmt->execute();

            // Obtenemos resultado
            $resultado = $stmt->rowCount() > 0 ? true : false;

            return $resultado;
        }
    }

?>