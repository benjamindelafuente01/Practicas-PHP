<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar artículo</title>
    <link rel="stylesheet" href="../Estilos/estilos_actualizar.css">
</head>
<body>

    <form action="pagina_actualizar_registros.php" method="GET">
        <div class="contenedor-busqueda">
            <label for="codigo_articulo">Ingrese el código del artículo: </label> <br>
            <input class="input-search" type="text" name="codigo_articulo" id="codigo_articulo" required> <br> <br>
            <input type="button" class="btn-volver" onclick="window.location.href='../index.php'" value="  Volver  ">
            <input type="submit" class="btn-buscar" name="btn_buscar_articulo_actualizar" id="btn_buscar_articulo_actualizar" value="  Buscar  "> <br> <br>
        </div>
        <br><br>
    </form>

    
</body>
</html>