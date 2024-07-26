<?php

    // Variables auxiliares
    $mensajeErrores = '';       # Para concatenar los errores que vayan surgiendo
    $enviado = false;              # Bandera para conocer si se envió correctamente

    // Comprobamos si el formulario se ha enviado
    if (isset($_POST['EnviarFormulario'])) {

        // Almacenamos los datos en variables locales
        $nombre = $_POST['nombreUsuario'];
        $correo = $_POST['correoUsuario'];
        $comentario = $_POST['comentarioUsuario'];

        /* 
        * Realizamos las validaciones individuales
        */

        # Comprobacion del campo nombre
        if (!empty($nombre)) {
            // Eliminamos espacios al inicio y al final de la cadena
            $nombre = trim($nombre); 
            // Sanitizamos nombre
            $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
        } else {
            $mensajeErrores .= "Por favor, ingrese un nombre <br>";
        }

        # Comprobacion del campo correo
        if (!empty($correo)) {
            // Sanitizamos correo
            $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

            // Validamos correo
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mensajeErrores .= "Por favor, ingrese un corre válido <br>";
            }

        } else {
            $mensajeErrores .= "Por favor, ingrese un correo <br>";
        }

        # Comprobación del campo comentario
        if (!empty($comentario)) {
            // Podemos utilizar filter_var, pero queremos convertir las entidades HTML
            $comentario = trim($comentario);                # Eliminamos espacios al inicio y al final
            $comentario = htmlspecialchars($comentario);    # Convertimos a entidades HTML
            $comentario = stripslashes($comentario);        # Eliminamos barras

        } else {
            $mensajeErrores .= "Por favor, ingrese un comentario <br>";
        }

        /*
        * Enviamos correo si todos los campos están correctos
        */
        if (!$mensajeErrores) {

            // Damos estructura al correo (podría ser de forma dinámica)
            $destinatario = 'benjamindelafuente666@gmail.com';
            $asunto = 'Mensaje enviado desde práctica';
            $mensaje = 'De: ' . $nombre . '\n'
                    . 'Correo: ' . $correo . '\n'
                    . 'Mensaje: ' . $comentario
            ;

            // Función mail() para enviar correo (debes configurar XAMPP primero)
            // mail($destinatario, $asunto, $mensaje);

            // Damos los estilos al mensaje de enviado
            $enviado = true;

        }

    }

    require "index.php";

?>