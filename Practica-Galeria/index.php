<?php

    // Importamos archivo de la clase para traer todas las fotos
    require 'Connection/obtener_fotos_class.php';

    /* 
        Variables generales
    */

    # Establecemos la cantidad de imagenes que aparecerán por página
    $fotos_por_pagina = 8;
    
    # Obtenemos la pagina actual, si no existe la variable, es la pagina 1 (se acaba de cargar el sitio)
    $pagina_actual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    
    # Calculamos a partir de qué imagen se mostrarán las demás
    $inicio_mostrar_fotos = ($pagina_actual > 1) ? $pagina_actual * $fotos_por_pagina - $fotos_por_pagina : 0;
    
    # Instanciamos un objeto de la clase que hace la consulta
    $arreglo_imagenes = new ObtenerFotos();

    // Hacemos la consulta
    $fotos = $arreglo_imagenes->consultarImagenes($inicio_mostrar_fotos, $fotos_por_pagina);

    // Si no hay fotos actualizamos
    if (!$fotos) {
        // Actualizamos la página
        header ('Location: index.php');
    }

    # Consultamos el total de filas
    $total_filas = $arreglo_imagenes->consultarFilas();

    # Calculamos el número de páginas para redondear
    $total_paginas = ceil($total_filas / $fotos_por_pagina);

    // Cargamos la vista
    require 'Views/index_view.php';

?>