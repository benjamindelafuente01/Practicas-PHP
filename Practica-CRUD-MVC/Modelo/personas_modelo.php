<?php

    // Archivo con la conexion
    require_once 'conexion.php';

    /*
        Clase con los metodos CRUD
    */
    class CRUD extends ConnectionDataBase {

        // Metodo constructor
        public function __construct() {

            // Llamamos al constructor de la clase Padre
            parent::__construct();
        }


        // Método para obtener (leer) los registros
        public function readUsers($lowerLimit, $upperLimit) {

            // Sentencia SQL
            $sql = "SELECT * FROM datosusuarios LIMIT :limiteInferior, :limiteSuperior";
            // Preparamos consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Asociamos valores
            $marcadores = [':limiteInferior' => $lowerLimit, ':limiteSuperior' => $upperLimit];
            // Ejecutamos consulta
            $stmt->execute($marcadores);
            // Guardamos resultado
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Verificamos resultado
            if ($resultado == NULL) {
                return false;
            } else {
                return $resultado;
            }
        }


        // Metodo para eliminar un registro
        public function deleteUser($id) {

            // Sentencia SQL
            $sql = "DELETE FROM datosusuarios WHERE id = :ID";
            // Preparamos consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Asociamos valores con bindValue
            $stmt->bindValue(':ID', $id);
            // Ejecutamos consulta
            $stmt->execute();

            // Guardamos resultado
            $resultado = $stmt->rowCount() > 0 ? true : false;

            return $resultado;
        }


        // Metodo para obtener usuario individual
        public function getUser($id) {

            // Sentencia SQL
            $sql = "SELECT * FROM datosusuarios WHERE id = :ID";
            // Preparamos consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Asociamos valores con bindValue
            $stmt->bindValue(':ID', $id);
            // Ejecutamos consulta
            $stmt->execute();

            // Guardamos resultado
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verificamos que el usuario exista
            if (!$resultado) {
                return false;
            } else {
                return $resultado;
            }
        }


        // Metodo para actualizar registro
        public function updateUser($id, $name, $lastName, $address) {

            // Sentencia SQL
            $sql = "UPDATE datosusuarios SET Nombre = :NOMBRE, Apellido = :APELLIDO, Direccion = :DIRECCION 
                WHERE id = :ID"
            ;
            // Preparamos consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Asociamos valores con un arreglo
            $marcadores = [':NOMBRE' => $name, ':APELLIDO' => $lastName, ':DIRECCION' => $address, ':ID' => $id];
            // Ejecutamos consulta
            $stmt->execute($marcadores);

            // Guardamos resultado
            $resultado = $stmt->rowCount() > 0 ? true : false;

            return $resultado;
        }


        // Metodo para insertar un nuevo usuario
        public function insertUser($nombre, $apellido, $direccion) {

            // Sentencia SQL
            $sql = "INSERT INTO datosusuarios(Nombre, Apellido, Direccion) VALUES (:NOMBRE, :APELLIDO, :DIRECCION)";
            // Preparamos la consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Asociamos valores mediante un arreglo
            $marcadores = [':NOMBRE' => $nombre, ':APELLIDO' => $apellido, ':DIRECCION' => $direccion];
            // Ejecutamos consulta
            $stmt->execute($marcadores);

            // Verificamos resultado
            $resultado = $stmt->rowCount() > 0 ? true : false;

            return $resultado;
        }

        // Método para obtener el total de registros
        public function totalUsers() {

            // Consulta SQL
            $sql = "SELECT COUNT(*) AS totalFilas FROM datosusuarios";
            // Preparamos la consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Ejecutamos la consulta
            $stmt -> execute();

            // Verificamos resultado
            $resultado = $stmt->fetch()['totalFilas'];

            return $resultado;
        }
    }
?>