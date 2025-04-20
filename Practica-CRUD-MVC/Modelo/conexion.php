<?php

    /*
        Constantes para la conexion
    */
    define ('DATA_SOURCE_NAME', 'mysql:host=localhost; dbname=ejemplo_cursophp');
    define ('USER', 'root');
    define ('PASSWORD', 'datos2021');

    /*
        Clase para la conexion
    */
    class ConnectionDataBase {

        // Atributos
        protected $conexionPDO;

        // Método constructor
        public function __construct() {

            try {
                // Realizamos la conexion
                $this->conexionPDO = new PDO(DATA_SOURCE_NAME, USER, PASSWORD);

                // Establecemos para que PDO lance Excepciones
                $this->conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Desactivamos las preparaciones emuladas para poder pasar un arreglo con execute() en PDO
                $this->conexionPDO->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

            } catch (PDOException $e) {
                die ('Error al conectar: ' . $e->getMessage());
            }
        }
    }

?>