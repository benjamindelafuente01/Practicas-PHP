<?php

    // Archivo con la conexion a BD
    require 'conexion.php';

    /*
        Clase para subir nuevas fotos
    */
    class SubirFoto extends ConexionBD {

        // Constructor de la clase 
        public function __construct() {

            // Llamamos al constructor de la clase Padre que contiene la conexion
            parent:: __construct();
        }

        // Método para subir una nueva foto
        public function cargarNuevaFoto ($titulo, $imagen, $texto) {

            // Estrucutura de la consulta para insertar una nueva imagen la base de datos
            $sql = "INSERT INTO fotos(titulo, nombre, descripcion) VALUES(:tituloImagen, :rutaImagen, :descripcionImagen)";
            // Preparamos la consulta
            $stmt = $this->conexion_pdo->prepare($sql);
            // Asociamos los valores mediante un arreglo
            $marcadores = [':tituloImagen' => $titulo, ':rutaImagen' => $imagen, ':descripcionImagen' => $texto];
            // Ejecutamos la consulta
            $stmt->execute($marcadores);
            // Almacenamos resultado
            $resultado = $stmt->rowCount() > 0 ? true : false;

            return $resultado;
        }
    }

?>