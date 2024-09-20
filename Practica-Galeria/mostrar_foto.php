<?php

    // Importamos archivo que hace la consulta de la foto
    require 'Connection/obtener_fotos_class.php';

    // Instanciamos un objeto de la clase
    $foto = new ObtenerFotos();

    // Obtenemos ID seleccionado
    $id = (isset($_GET['id'])) ? (int) $_GET['id'] : false;

    // Verificamos que sea un id valido, sino reedirigimos
    if (!$id) {
        header('Location: index.php');
    }

    // Consultamos la foto individual
    $foto_individual = $foto->FotoId($id);

    // Verificamos que sea una foto valida, sino reedirigimos
    if (!$foto_individual) {
        header('Location: index.php');
    }

    // Recuperamos el no. de pagina en el que se quedó el usuario
    $ultima_pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

    // Cargamos la vista
    require 'Views/mostrar_foto_view.php';

?>