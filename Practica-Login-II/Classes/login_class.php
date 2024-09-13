<?php

    // Script para la conexion
    require __DIR__ . '/../Connection/conexion.php';

    /*
        Clase que verifica si el usuario existe o no
    */
    class LoginUsuario extends ConexionBD{

        // Constructor de la clase
        public function __construct() {

            // Llamamos al constructor de la clase padre
            parent::__construct();
        }

        // Funcion para obtener si el usuario existe o no
        public function consultarUsuario($usuario, $contra) {

            // Estructura de la consulta
            $query = "SELECT * FROM usuarios WHERE nombre = :username";
            // Preparamos la consulta
            $stmtQuery = $this->conexion_pdo->prepare($query);
            // Asociamos valores
            $stmtQuery->bindValue(':username', $usuario);
            // Ejecutamos la consulta
            $stmtQuery->execute();

            // Verificamos si el usuario y contraseña son correctos
            $resultado = $stmtQuery->fetch(PDO::FETCH_ASSOC);

            // Si el usuario existe y la contraseña es igual a la encriptada
            if ($resultado && password_verify($contra, $resultado['contra'])) {
                return true;
            }

            return false;
        }
    }

?>