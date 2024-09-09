<?php

    // Importamos script de la clase de registro
    require 'Classes/signup_class.php';

    // Instanciamos obbjeto de la clase
    $registroUsuario = new RegistrarUsuario();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Accedemos a los valores
        $nombre = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        $contra1 = filter_var($_POST['user_password1'], FILTER_SANITIZE_STRING);
        $contra2 = filter_var($_POST['user_password2'], FILTER_SANITIZE_STRING);

        // Comparamos contraseñas
        if ($contra1 != $contra2) {
            header ('Location: Views/signup_view.php');
        }
        
        // Verificamos si el usuario ya existe
        $usuarioExistente = $registroUsuario->verificarUsuario($nombre);

        if ($usuarioExistente) {
            header ('Location: Views/signup_view.php');

        } else {

            // Insertamos usuario
            $insertarUsuario = $registroUsuario->registrarNuevoUsuario($nombre, $contra1);
    
            if ($insertarUsuario) {
                // Creamos una nueva sesión y reedirigimos
                session_start();
                $_SESSION['usuario'] = $nombre;
                header ('Location: Views/contenido_view.php');
            } else {
                echo 'Error al registrar nuevo usuario';
            }

        }

    }

?>