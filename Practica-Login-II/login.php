<?php

    // Importamos archivo de la clase login
    require 'Classes/login_class.php';

    // Creamos instancia de la clase
    $login = new LoginUsuario();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Accedemos a los valores
        $usuario = $_POST['user_name'];
        $contra = $_POST['user_password'];
        
        // Limpiamos valores
        $usuario = htmlentities(addslashes($usuario));
        $contra = htmlentities(addslashes($contra));

        // Llamamos a la función que verifica el usuario
        $acceso = $login->consultarUsuario($usuario, $contra);

        if ($acceso) {

            // Verificamos si se marcó casilla de recordar usuario
            if (isset($_POST['remember_user'])) {
                // Creamos cookie
                setcookie('recordar_usuario', $usuario, time() + 86400, '/');
            }

            // Creamos una nueva sesión
            session_start();
            // Agregamos un identificador y un valor a la sesión
            $_SESSION['usuario'] = $usuario;
            // Reedirigimos al contenido
            header ('Location: Views/contenido_view.php');

        } else {
            header ('Location: Views/login_view.php');
        }
        
    }

?>