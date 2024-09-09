<?php

    // Script para la conexion
    require __DIR__ . '/../Connection/conexion.php';

    /*
        Clase para registrar un nuevo usuario
    */
    class RegistrarUsuario extends ConexionBD{

        // Constructor de la clase
        public function __construct() {
            // Accedemos al constructor de la clase padre
            parent::__construct();
        }

        // Método para verificar si el usuario existe
        public function verificarUsuario($usuario) {

            // Estrucutura consulta para verificar usuario
            $userQuery = "SELECT * FROM usuarios WHERE nombre = :nombre";
            // Preparamos la consulta
            $stmtQuery = $this->conexion_pdo->prepare($userQuery);
            // Asociamos valores con bindValue
            $stmtQuery->bindValue(':nombre', $usuario);
            // Ejecutamos la consulta
            $stmtQuery->execute();

            // Verificamos si el usuario ya existe
            $resultado = $stmtQuery->rowCount() > 0 ? true : false;

            return $resultado;
        }


        // Función para registrar nuevo usuario
        public function registrarNuevoUsuario ($usuario, $contra) {

            // Estructura de la consulta para registrar nuevo usuario
            $insertUser = "INSERT INTO usuarios(nombre, contra) VALUES (:nombre, :contra)";
            // Preparamos la consulta
            $stmtQuery = $this->conexion_pdo->prepare($insertUser);
            // Asociamos valores
            $stmtQuery->bindValue(':nombre', $usuario);
            $stmtQuery->bindValue(':contra', $contra);
            // Ejecutamos consulta
            $stmtQuery->execute();

            // Verificamos el registro de nuevo usuario
            $resultado = $stmtQuery->rowCount() > 0 ? true : false;

            return $resultado;
        }
    }

?>