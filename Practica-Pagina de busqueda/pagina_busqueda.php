<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar artículos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
    <!-- <form action="conexion.php" method="POST"> -->

        <div class="contenedor-busqueda">
            <label for="nombre_articulo">Ingrese un artículo: </label> <br>
            <input type="text" name="nombre_articulo" id="nombre_articulo" required> <br> <br>
            <input type="submit" name="btn_buscar_articulo" id="btn_buscar_articulo" value="Buscar"> <br> <br>
        </div>
        <br><br>
    </form>


    <div class="contenedor-resultado">
        
        <?php
        
            require 'traer_datos.php';

            // Si el botón ha sido pulsado, mandamos a llamar a la función
            if (isset($_POST['btn_buscar_articulo']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

                // Obtenemos el valor introducido y lo pasamos a la función
                $busquedaArticulo = $_POST['nombre_articulo'];
                mostrarResultados($busquedaArticulo);
            }

        ?>

    </div>

    
</body>
</html>