<?php
    
    /*
        Verificamos que se haya pulsado el botón de insertar usuario
    */
    if (isset($_POST['agregar_usuario']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

        // Obtenemos los datos
        $nombre = filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING);
        $apellido = filter_var($_POST['apellido_usuario'], FILTER_SANITIZE_STRING);
        $domicilio = filter_var($_POST['domicilio_usuario'], FILTER_SANITIZE_STRING);

        // Verificamos que los campos no estén vacíos
        if ($nombre != '' && $apellido != '' && $domicilio != '') {

            // Insertamos datos (la clase ya se instanció previamente)
            $usuarios->insertUser($nombre, $apellido, $domicilio);

            if ($usuarios == true) {
                header('Location: index.php');
            } else {
                echo '<div class="mensaje-error">Error al insertar usuario...</div>';
            }

        }
    }

?>