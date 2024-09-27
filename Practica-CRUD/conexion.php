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

            } catch (PDOException $e) {
                die ('Error al conectar: ' . $e->getMessage());
            }
        }
    }

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
        public function readUsers() {

            // Sentencia SQL
            $sql = "SELECT * FROM datosusuarios";
            // Preparamos consulta
            $stmt = $this->conexionPDO->prepare($sql);
            // Ejecutamos consulta
            $stmt->execute();
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

    }
?>