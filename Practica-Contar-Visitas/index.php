<?php

    // Establecemos la zona horario como CDMX
    // date_default_timezone_set('America/Mexico_City');

    /*
        Script para contar las visitas
    */

    function contar_visitas() {

        // Archivo donde se almacenará el contador
        $archivo = ('log_visitas.txt');

        // Verificamos si el archivo existe
        if (file_exists($archivo)) {
            
            // Guardamos el archivo como un arreglo
            $contenido = file($archivo);

            // Obtenemos el valor de las visitas hasta el momento (se encuentra en el segundo renglon)
            $cuenta = $contenido[1] + 1;

            // Actualizamos el arreglo (añadimos el salto de linea)
            $contenido[1] = $cuenta . "\n";

            // Agregamos la nueva visita al arreglo
            array_push($contenido, "Visita [$cuenta]: " . date('Y-m-d, H:i:s A') . "\n");

            // Escribimos el arreglo en el archivo
            file_put_contents($archivo, $contenido);

            return $cuenta;

        } else {

            // Si no existe, creamos el archivo y le asignamos un valor
            file_put_contents($archivo, "Total de visitas:\n1\n\nPrimera visita: " . date('Y-m-d, H:i:s A') . "\n");
            
            return 1;
        }
    }

    $visitas = contar_visitas();

?>