<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginación</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="contenedor">

        <h1>Libros</h1>

        <!-- Seccion para los artículos -->
        <div class="articulos">
            
            <?php

                // Creamos la tabla
                echo '<table>';
                //var_dump($resultado);
                // Bandera para meter los encabezados
                $bandera = false;

                foreach ($resultado as $libro) {
                    echo '<tr>';

                    if(!$bandera) {
                        echo '<tr>';

                        // Fila de encabezados
                        foreach ($libro as $titulo => $valor) {
                            echo '<th>' . strtoupper($titulo) . '</th>';
                        }
                        // Desactivamos bandera
                        $bandera = true;
                        echo '</tr>';
                    }

                    // Filas para el contenidos de los librps
                    foreach ($libro as $clave => $valor) {
                        echo '<td>' . $valor . '</td>';
                    }

                    echo '</tr>';
                }

                echo '</table>';
            ?>
        </div>

        <!-- Sección para las páginas -->
        <div class="paginacion">
            <ul>

                <!-- Habilitar/deshabilitar botón hacia atrás Inicio-->
                <?php if ($pagina_actual == 1): ?>
                    <li class="disabled">&laquo;</li>
                <?php else: ?>
                    <!-- Se crea el elemento '?pagina' en la URL y se le asigna un valor -->
                    <li><a href="?pagina=<?php echo $pagina_actual -1 ?>">&laquo;</a></li>
                <?php endif; ?>

                <!-- A través de un ciclo mostramos enlaces a las páginas -->
                <?php 
                    for ($i=1; $i<=$numeroPaginas; $i++) { 

                        if ($pagina_actual == $i) {
                            echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
                        } else {
                            echo "<li><a href='?pagina=$i'>$i</a></li>";
                        }
                        
                    } 
                ?>

                <!-- Habilitar/deshabilitar botón hacia atrás Final-->
                <?php if ($pagina_actual == $numeroPaginas): ?>
                    <li class="disabled">&raquo;</li>
                <?php else: ?>
                    <li><a href="?pagina=<?php echo $pagina_actual + 1 ?>">&raquo;</a></li>
                <?php endif; ?>

            </ul>
        </div>

    </div>
    
</body>
</html>