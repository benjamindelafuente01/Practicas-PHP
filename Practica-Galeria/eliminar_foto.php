<?php

    // Importamos archivo con clase para eliminar foto
    require 'Connection/eliminar_foto_class.php';

    // Instanciamos un objeto de la clase
    $borrar_foto = new EliminarFoto();

    // Verificamos que si se haya seleccionado una imagen
    if (isset($_GET['nombre'])) {

        // Nombre de la carpeta
        $carpetaImagenes = 'fotos_subidas/';
        
        // Obtenemos el nombre de la imagen enviado (eliminamos rutas en caso de ternerlas y sanitizamos)
        $nombre_imagen = filter_var(basename($_GET['nombre']), FILTER_SANITIZE_STRING);

        // Convertimos una ruta relativa en una ruta absoluta
        $rutaArchivo = realpath($carpetaImagenes . $nombre_imagen);

        /*
            Aseguramos que el archivo esté dentro de la carpeta. strpos() busca la posición donde la ruta de la imagen 
            ($rutaArchivo) comienza en relación con la ruta de la carpeta de imágenes (realpath($carpetaImagenes)).
        */
        if (strpos($rutaArchivo, realpath($carpetaImagenes)) !== 0) {
            die('Acceso denegado.');
        }

        // Verificamos que el archivo exista (pasamos la ruta completa generada por realpath())
        if (file_exists($rutaArchivo)) {

            /*
                Eliminamos imagen de la carpeta
            */
            if (unlink($rutaArchivo)) {

                /*
                    Eliminamos registro de la foto de base de datos
                */

                // Borramos foto de la base de datos
                $resultado = $borrar_foto->eliminarImagen($nombre_imagen);
                
                // Verificamos si se borro correctamente
                if (!$resultado) {
                    die ('Error al eliminar foto de la base de datos');
                }

                // En este punto, la imagen se eliminó correcatemnte tanto de la carpeta como de la base de datos
                // echo 'Imagen eliminada correctamente'

                // Redireccionar después de eliminar
                header('Location: index.php');

            } else {
                die('Hubo un error al intentar eliminar la imagen.');
            }

        } else {
            die('El archivo no existe.');
        }

    } else {
        die ("Debes seleccionar una imagen a eliminar");
    }
  
?>