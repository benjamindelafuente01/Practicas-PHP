<?php

    // Archivo de configuracion
    require 'config.php';

    /*
        Clase para realizar la conexión a la base de datos
    */
    class ConexionBD {

        // Atributos
        protected $conexion_pdo;

        // Realizamos la conexión en el constructor
        public function __construct() {
            try {

                // Realizamos la conexión
                $this->conexion_pdo = new PDO(DATA_SOURCE_NAME, USER, PASSWORD);

                // Configuramos para que PDO lanze excepciones
                $this->conexion_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Desactivamos las preparaciones emuladas para poder pasar un arreglo con execute() en PDO
                $this->conexion_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            } catch (PDOException $e) {
                die ('Error de conexión: ' . $e->getMessage());
            }
        }
        
    }

?>