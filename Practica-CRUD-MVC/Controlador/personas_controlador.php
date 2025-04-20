<?php

    require_once __DIR__ . '/../Modelo/personas_modelo.php';

    // Instancia de la clase
    $usuarios = new CRUD();

    /*
        Creamos variables para la paginacion
    */
    // Página actual
    $pagina_actual = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : (int) 1;

    // Número de registros que aparecerán por pagina
    $registros_por_pagina = 3;

    // Desde qué registro se van a mostrar dependiendo de la página
    $inicio_mostrar_registros = ($pagina_actual - 1) * $registros_por_pagina;

    // Consultamos el total de registros (si no hay registros asignamos un 1)
    $total_registros = $usuarios->totalUsers() > 0 ? $usuarios->totalUsers() : (int) 1;

    // Total de páginas que se van a crear
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    /*
        Consultamos usuarios
    */
    // Obtenemos usuarios
    $registros = $usuarios->readUsers($inicio_mostrar_registros, $registros_por_pagina);

    // Cargamos la vista
    require __DIR__ . '/../Vista/personas_vista.php';

?>