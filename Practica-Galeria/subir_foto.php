<?php

    // Importamos el archivo de la clase para subir una nueva foto
    require 'Connection/subir_foto_class.php';

    // Instanciamos un objeto de la clase para subir una nueva imagen
    $subirImagen = new SubirFoto();

    // Verificamos que se haya subido mediante POST y se haya subido un archivo
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {

        // En tmp_name se guarda temporalmente y almacena las caracteristicas. Obtenemos un arrreglo
        $verificar_imagen = @getimagesize($_FILES['archivo_foto']['tmp_name']);

        // Obtenemos datos de la imagen
        $tituloImagen = filter_var($_POST['titulo_foto'], FILTER_SANITIZE_STRING);
        $nombreImagen = $_FILES['archivo_foto']['name'];
        $textoimagen = filter_var($_POST['descripcion_foto'], FILTER_SANITIZE_STRING);

        /*
            La función getimagesize devuelve un arreglo con las características de la imagen (ancho, alto, tipo, etc).
            Si es una imagen invalida devuelve false. El '@' suprime los errores que pudieran mostrarse.
        */
        if ($verificar_imagen !== false) {

            // Ejecutar consulta              
            $resultado = $subirImagen->cargarNuevaFoto($tituloImagen, $nombreImagen, $textoimagen);

            /*
                Si la consulta se ejecutó correctamente (devuelve true), guardamos imagen
            */
            if ($resultado) {
                # Nombre de la carpeta destino
                $carpeta_destino = 'fotos_subidas/';                     
                # Carpeta destino + Nombre del archivo subido (recuperamos el nombre para mantenerlo)
                $archivo_subido = $carpeta_destino. $_FILES['archivo_foto']['name'];    
                # Guardamos archivo (lo sacamos de la ruta temporal y colocamos en la ruta destino)
                move_uploaded_file($_FILES['archivo_foto']['tmp_name'], $archivo_subido);

                // Reedirigimos al index
                header('Location: index.php');

            } else {
                $error = 'Error al guardar la imagen';
            }

        } else {
            // No se subió una imagen como archivo o pesa mucho
            $error = 'Por favor selecciona una imagen o verifica el tamaño de la imagen';
        }
    }

    // Cargamos la vista del formulario
    require 'Views/subir_foto_view.php';

?>