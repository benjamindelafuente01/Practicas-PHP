<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar un nuevo producto</title>
    <link rel="stylesheet" href="../Estilos/estilos_altas.css">
</head>
<body>

    <h1>Registro de Artículos</h1>
    <hr>

    <div class="form-registros">
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

            <table> 

                <tr>
                    <th>Artículo</th>
                    <th>Descripción</th>
                </tr>

                <tr>
                    <td>Código artículo:</td>  
                    <td>  
                        <input type="text" name="codigo_articulo" id="codigo_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Sección:</td>  
                    <td>  
                        <input type="text" name="seccion_articulo" id="seccion_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Nombre artículo:</td>  
                    <td>  
                        <input type="text" name="nombre_articulo" id="nombre_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Precio:</td>  
                    <td>  
                        <input type="text" name="precio_articulo" id="precio_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Fecha:</td>  
                    <td>  
                        <input type="date" name="fecha_articulo" id="fecha_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Importado:</td>  
                    <td>  
                        <select name="importado_articulo" id="importado_articulo">
                            <option value="verdadero"> Si </option>
                            <option value="falso"> No </option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>País de origen</td>  
                    <td>  
                        <input type="text" name="pais_articulo" id="pais_articulo" required>
                    </td>
                </tr>

                <tr>
                    <td>Foto</td>  
                    <td>  
                        <input type="file" name="foto_articulo" id="foto_articulo">
                    </td>
                </tr>

            </table>

            <input type="button" class="btn-volver" onclick="window.location.href='../index.php'" value="  Volver  ">

            <input type="reset" class="btn-eliminar" value="Eliminar">
                    
            <input type="submit" class="btn-registrar" name="btn_alta_registro" id="btn_alta_registro" value="Registrar">

        </form>


        <!-- Contenedor de resultados -->
        <div class="contenedor-resultado">
        
            <?php
            
                require 'insertar_datos.php';

                // Si el botón ha sido pulsado, mandamos a llamar a la función
                if (isset($_GET['btn_alta_registro']) && $_SERVER['REQUEST_METHOD'] == 'GET') {

                    // Obtenemos los datos del articulo ingresado
                    $codigo = strtoupper($_GET['codigo_articulo']);
                    $seccion = strtoupper($_GET['seccion_articulo']);
                    $nombre = strtoupper($_GET['nombre_articulo']);
                    $precio = strtoupper($_GET['precio_articulo']);
                    $fecha = strtoupper($_GET['fecha_articulo']);
                    $importado = strtoupper($_GET['importado_articulo']);
                    $pais = strtoupper($_GET['pais_articulo']);

                    /*
                    -> Manejo de archivos en PHP:

                        Cuando envías un formulario HTML que incluye un campo de tipo file, los archivos subidos se gestionan en PHP mediante 
                        la superglobal $_FILES. Esta superglobal contiene información sobre el archivo, como su nombre, tipo, tamaño, y un 
                        código de error que indica si la subida fue exitosa o no.
                    
                        * $_FILES['foto_articulo']['name']: El nombre original del archivo subido.
                        * $_FILES['foto_articulo']['type']: El tipo MIME del archivo.
                        * $_FILES['foto_articulo']['size']: El tamaño del archivo en bytes.
                        * $_FILES['foto_articulo']['tmp_name']: El nombre temporal del archivo en el servidor.
                        * $_FILES['foto_articulo']['error']: Un código de error que indica el estado de la subida.

                        La clave error en $_FILES es muy importante porque te dice si el archivo se subió correctamente o si ocurrió algún problema. 
                        Aquí están algunos de los posibles valores:
                        * UPLOAD_ERR_OK (valor 0): Significa que el archivo se subió correctamente sin errores.
                        * UPLOAD_ERR_NO_FILE (valor 4): Significa que no se subió ningún archivo.
                        * UPLOAD_ERR_INI_SIZE y UPLOAD_ERR_FORM_SIZE: Indican que el archivo excede el tamaño máximo permitido.
                    
                        isset($_FILES['foto_articulo']): Verifica si el campo foto_articulo existe en el array $_FILES, lo que significa 
                        que el formulario contenía un campo de tipo file con ese nombre.
                    */

                    // Manejo del archivo (foto)
                    if (isset($_FILES['foto_articulo']) && $_FILES['foto_articulo']['error'] === UPLOAD_ERR_OK) {
                        // Si se subió un archivo correctamente, puedes procesarlo o guardar su nombre
                        $foto = strtoupper($_FILES['foto_articulo']['name']);
                    } else {
                        // Si no se subió archivo, asignamos NULL
                        $foto = null;
                    }

                    // Llamamos a la función para insertar datos y almacenamos resultado
                    $consulta = insertarRegistros($codigo, $seccion, $nombre, $precio, $fecha, $importado, $pais, $foto);

                    // Imprimimos resultado
                    if ($consulta) {
                        echo "<div class='alert success'> Artículo agregado correctamente </div>";
                    } else {
                        echo "<div class='alert error'> El artículo no se pudo almacenar correctamente </div>";
                    }
                }

            ?>

        </div>

    </div>
    
</body>
</html>