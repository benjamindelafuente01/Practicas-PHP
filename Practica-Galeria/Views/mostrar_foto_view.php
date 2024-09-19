<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <title>Galeria</title>
    <link rel="stylesheet" href="CSS/estilos_index.css">
</head>
<body>
    
    <header>
        <div class="contenedor">
            
            <!-- Agregamos el titulo de la imagen -->
            <?php
                if (!empty($foto_individual['titulo'])) {
                    echo '<h1 class="titulo">' . $foto_individual['titulo'] . '</h1>';
                } else {
                    echo '<h1 class="titulo">' . $foto_individual['nombre'] . '</h1>';
                }
            ?>

        </div>
    </header>

    <div class="contenedor">
        <div class="foto">
            <img src="fotos_subidas/<?php echo $foto_individual['nombre'] ?>" class="img-sola" alt="image">
            <p class="texto"><?php echo $foto_individual['descripcion'] ?></p>
            
            <a href="index.php?pagina=<?php echo $ultima_pagina ?>" class="regresar">
                <img src="Icons/arrow-left.png" class="iconos" width="30" alt="return-icon"><br>Volver
            </a>
            
            <a href="eliminar_foto.php?nombre=<?php echo $foto_individual['nombre'] ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar esta imagen?')"class="regresar">
                <img src="Icons/delete.png" class="iconos" width="30" alt="return-icon"><br>Borrar
            </a>
            
        </div>
    </div>

    <footer>
        <p class="copyright">Made by benjamindelafuente01</p>
    </footer>

</body>
</html>