<?php

    // Importamos datos para la conexión a base de datos
    require '../connection-db/conexion.php';

    // Iniciamos o reanudamos sesión
    session_start();

    // Variable para mensaje de errores
    $mensajeErrores = '';

    // Verificamos si hay una sesión activa para mandar al contenido
    if (isset($_SESSION['usuario'])) {
        header ('Location: contenido_logic.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recuperamos datos del login
        $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
        $contra = $_POST['password'];

        // Encriptamos contraseña
        $contra = hash('sha512', $contra);

        /*
            Verificamos que el usuario exista en la bd
        */
        $userSqlQuery = "SELECT * FROM usuarios WHERE user = :usuario AND password = :contra";
        // Preparamos la consulta
        $userStmtQuery = $conexion_pdo->prepare($userSqlQuery);
        // Asociamos valores
        $marcadores_usuario = [':usuario' => $usuario, ':contra' => $contra];
        // Ejecutamos consulta
        $userStmtQuery->execute($marcadores_usuario);
        // Guardamos resultado
        $resultado = $userStmtQuery->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            $mensajeErrores .= '<li>Usuario y/o contraseña inválidos</li>';
        } else {
            // Creamos nueva sesión y reedirigimos
            $_SESSION['usuario'] = $usuario;
            header ('Location: ../index.php');
        }

    }

    // Cargamos la vista de inicio de sesión
    require '../Views/inicio_sesion_view.php';

?>