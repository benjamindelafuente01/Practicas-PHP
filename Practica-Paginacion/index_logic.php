<?php

    // Importamos la conexion a la base de datos
    require 'conexion.php';

    /*
        Variables que utilizaremos
    */
    # Obtenemos el valor de la página actual, sino establecemos '1'
    $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    # Cantidad de artículos mostrados por página
    $articulos_por_pagina = 5;                                          
    # Obtener a partir de qué artículo se realiza la consulta (pagina actual * numero articulos - numero articulos)
    $inicio_articulos = ($pagina_actual > 1) ? ($pagina_actual * $articulos_por_pagina - $articulos_por_pagina) : 0;

    /*
        Realizamos la consulta
    */
    # Estructura de la consulta
    $query = "SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT :inicio, :cantidad";    #SQL_CALC_FOUND_ROWS: Calcula el total de filas en la tabla
    # Preparamos consulta
    $stmtQuery = $conexion_pdo->prepare($query);
    # Asociamos parámetros
    $datos_marcadores = [':inicio' => (int)$inicio_articulos, ':cantidad' => (int)$articulos_por_pagina];
    # Ejecutamos consulta
    $stmtQuery->execute($datos_marcadores);
    # Recuperamos valores
    $resultado = $stmtQuery->fetchAll(PDO::FETCH_ASSOC);
    // print_r($resultado);

    /*
        Comprobamos que existan artículos, sino reedirigimos al indez
    */
    if (!$resultado) {
        header('Location: index_logic.php');
    }

    /*
        Calculamos el total de artículos para después saber el número de páginas de la paginación
    */
    # Consultamos el total de filas y asignamos un as
    $totalArticulos = $conexion_pdo->query('SELECT FOUND_ROWS() as total');
    # Metemos en un arreglo asociativo
    $totalArticulos = $totalArticulos->fetch()['total'];
    # Calculamos el número de páginas y redondeamos hacia arriba
    $numeroPaginas = ceil ($totalArticulos / $articulos_por_pagina);

    
    // Cargamos la vista
    require 'index_view.php';

?>