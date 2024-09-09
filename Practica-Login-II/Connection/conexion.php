<?php

    // Script con los datos de conexion
    require 'config.php';

    /*
        Clase para conectar a la base de datos
    */
    class ConexionBD {

        // Atributos de la clase
        protected $conexion_pdo;

        // Constructor que inicializa la conexion
        public function __construct() {

            try {
                // Realizamos la conexion
                $this->conexion_pdo = new PDO (DATASOURCENAME, USER, PASSWORD);
                // Configuramos para que PDO lance excepciones
                $this->conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Detenemos script
                die ('Error de conexión: ' . $e->getMessage());
            }
        }
    }

?>