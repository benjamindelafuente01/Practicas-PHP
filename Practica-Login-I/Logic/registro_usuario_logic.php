<?php

    // Importamos script de la conexión a base de datos
    require '../connection-db/conexion.php';

    // Iniciamos o reanudamos sesión
    session_start();

    // Variables
    $mensajeErrores = '';

    // Verificamos si hay una sesión activa y reedirigimos
    if (isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
    }

    // Recuperamos datos del registro de usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = FILTER_VAR(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
        $contra = $_POST['password1'];
        $contra2 = $_POST['password2'];

        // echo "Usuario: $usuario <br>Contraseña: $contra";

        // Verificamos que los campos no estén vacíos
        if (empty($usuario) || empty($contra) || empty($contra2)) {
            $mensajeErrores .= '<li>Por favor, completa todos los campos</li>';
        } else {
            /*
                Verificamos que el usuario no exista
            */
            $userQuery = "SELECT user FROM USUARIOS WHERE user = :usuario LIMIT 1";
            // Preparamos consulta
            $stmtQuery = $conexion_pdo->prepare($userQuery);
            // Asociamos valores
            $valorUsuario = [':usuario' => $usuario];
            // Ejecutamos consulta
            $stmtQuery->execute($valorUsuario);
            // Almacenamos resultado
            $resultadoUsuario = $stmtQuery->fetch(PDO::FETCH_ASSOC);
    
            if (!empty($resultadoUsuario)) {
                // Agregamos mensaje de error
                $mensajeErrores .= '<li>El usuario ya existe</li>';
            }
            
            /*
                Verificamos contraseñas
            */
            if (!passwordsCompare((string)$contra, (string)$contra2)) {
                $mensajeErrores .= '<li>Verifica las contraseñas</li>';
            } else {
                /*
                    Encriptamos contraseña y almacenamos nuevo usuario
                */
                $contra = encriptarContra($contra);
            }  
        }

        /*
            Si todo está bien, agregamos nuevo usuario a la base de datos
        */
        if ($mensajeErrores == '') {

            // Preparamos consulta SQL
            $userInsertQuery = "INSERT INTO usuarios (user, password) VALUES (:nuevoUsuario, :nuevaContra)";
            // Preparamos consulta
            $stmtInsertQuery = $conexion_pdo->prepare($userInsertQuery);
            // Asociamos valores
            $marcadoresNuevoUsuario = [':nuevoUsuario' => $usuario, ':nuevaContra' => $contra];
            // Ejecutamos consulta
            $stmtInsertQuery->execute($marcadoresNuevoUsuario);

            if($stmtInsertQuery->rowCount() > 0) {
                $_SESSION['usuario'] = $usuario;
                header ('Location: ../index.php');
            } else {
                $mensajeErrores .= '<li>Error al agregar usuario</li>';
            }
        }

    }

    /*
        Función para comparar contraseñas
    */
    function passwordsCompare(string $password1, string $password2): bool {
        
        // Regresamos comparación
        return $password1 === $password2;
    }

    /*
        Función para encriptar contraseña
    */
    function encriptarContra(string $password): string {

        // Hasheamos la contraseña con el algortimo 'sha512'
        $password = hash('sha512', $password);
        return $password;
    }
    
    // Cargamos vista
    require '../Views/registro_usuario_view.php';
?>