<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar artículos</title>
    <link rel="stylesheet" href="../Estilos/estilos_bajas.css">
</head>
<body>

    <div class="contenedor-busqueda">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <label for="nombre_articulo">Ingrese el código del artículo: </label> <br>
                <input type="text" name="nombre_articulo" id="nombre_articulo" required> <br> <br>
                <input type="button" class="btn-volver" onclick="window.location.href='../index.php'" value="  Volver  ">
                <input type="submit" class="btn-eliminar" name="btn_eliminar_articulo" id="btn_eliminar_articulo" value=" Eliminar ">
            <br><br>
        </form>


        <div class="contenedor-resultado">
            
            <?php
            
                require 'eliminar_datos.php';

                // Si el botón ha sido pulsado, mandamos a llamar a la función
                if (isset($_POST['btn_eliminar_articulo']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

                    // Obtenemos el valor introducido y lo pasamos a la función
                    $codigoArticulo = $_POST['nombre_articulo'];
                    $resultado = eliminarRegistros($codigoArticulo);

                    // Imprimimos resultado
                    if ($resultado) {
                        echo "<div class='alert success'> Artículo eliminado correctamente </div>";
                    } else {
                        echo "<div class='alert error'> El artículo no se pudo eliminar </div>";
                    }
                }

            ?>

        </div>
    </div>
    
</body>
</html>