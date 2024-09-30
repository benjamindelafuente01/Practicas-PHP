<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de paginación</title>
</head>
<body>

    <?php

        // Realizamos consulta a la base de datos
        try {

            // Realizamos la consulta
            $conexion = new PDO('mysql:host=localhost; dbname=ejemplo_cursophp', 'root', 'datos2021');

            // Establecemos para que lance excepciones
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Productos que aparecerán por página
            $registros_por_pagina = 3;

            // Página en la que nos encontramos
            $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : (int) 1;

            // A partir de que registro se van a mostrar en la pagina que se encuentre
            $inicio_mostrar_registro = ($pagina_actual - 1) * $registros_por_pagina;

            /*
                Consulta para obtener el total de resgitros
            */
            $consultar_registros = "SELECT COUNT(*) as totalFilas FROM productos WHERE SECCIÓN = 'DEPORTES'";
            // Preparamos la consulta
            $stmtRows = $conexion->prepare($consultar_registros);
            // Ejecutamos consulta
            $stmtRows->execute();
            // Total de filas
            $total_filas = $stmtRows->fetch()['totalFilas'];

            // Total de páginas que se crearán (redondeamos)
            $total_paginas = ceil ($total_filas / $registros_por_pagina);

            /*
                Realizamos la consulta para traer los registros correspondientes
            */
            // Estructura de la consulta
            $sql = "SELECT NOMBREARTÍCULO, SECCIÓN, PRECIO, PAÍSDEORIGEN FROM productos WHERE SECCIÓN = 'DEPORTES' 
                LIMIT $inicio_mostrar_registro, $registros_por_pagina";
            ;
            // Preparamos consulta
            $stmt = $conexion->prepare($sql);
            // Ejecutamos consulta
            $stmt->execute();

            /*
                Recorremos resultado
            */
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                // Recorremos registros de forma individual
                foreach($fila as $clave => $valor) {
                    echo $clave . ': ' . $valor . '<br>';
                }

                echo '<br><br>';            
            }

            echo 'Registros que devolvió la consulta: ' . $total_filas . '<br>';
            echo  'Página ' . $pagina_actual . ' de ' . $total_paginas . '<br>';

        } catch (PDOException $e) {
            die ('Error al realizar conexión: ') . $e->getMessage();
        }

        /*
            Paginación
        */
        for ($i=1; $i<=$total_paginas; $i++) {
            echo '<a href="paginacion.php?pagina=' . $i . '">' . $i . '</a> ';
        }
        
    ?>
    
</body>
</html>