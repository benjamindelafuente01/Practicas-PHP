<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <title>Galeria</title>
    <link rel="stylesheet" href="CSS/estilos_index.css">
</head>
<body>
    
    <header>
        <div class="contenedor">
            <h1 class="titulo">Mi galeria en PHP y MySQL</h1>
        </div>
    </header>

    <section class="fotos">
        <div class="contenedor">
            
            <!-- Mostramos las imagenes de forma dinámica -->
            <?php
                foreach($fotos as $foto) {
                    echo 
                    '<div class="thumb">
                        <a href="mostrar_foto.php?pagina=' . "$pagina_actual" . '&id=' . "$foto[id]" . '">
                            <img src="fotos_subidas/' . "$foto[nombre]" . '">
                        </a> 
                    </div>';
                }
            ?>

            <div class="paginacion">
                <?php
                    if ($pagina_actual > 1) {
                        echo '<a href="index.php?pagina=' . $pagina_actual - 1 . '" class="izquierda"> <img src="Icons/arrow-left.png" class="iconos" width="50" alt=""><br>Anterior</a>';
                    }
                ?>

                <div class="agregar">
                    <a href="subir_foto.php" class="centro"> <img src="Icons/add.png" class="iconos" width="50" alt=""><br>Agregar</a>
                </div>

                <?php
                    if ($pagina_actual != $total_paginas) {
                        echo '<a href="index.php?pagina=' . $pagina_actual + 1 . '" class="derecha"> <img src="Icons/arrow-right.png" class="iconos" width="50" alt=""><br>Siguiente</a>';
                    }
                ?>
                
            </div>
        </div>
    </section>

    <footer>
        <p class="copyright">Made by benjamindelafuente01</p>
    </footer>

</body>
</html>