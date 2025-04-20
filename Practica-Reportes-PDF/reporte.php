<?php

    // Iniciamos carga de documento html en un buffer
    ob_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hola mundo
</body>
</html>


<?php

    // Obtenemos el archivo html
    $html = ob_get_clean();

    // Importamos
    require_once 'vendor/autoload.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Instanciamos objeto de opciones
    $options = new Options();

    // Configuramos opciones
    $options->set('isHtml5ParserEnabled', true);

    // Instanciamos objeto de dompdf
    $dompdf = new Dompdf($options);

    // Establecemos tamaño carta
    $dompdf->setPaper('letter');

    // Cargamos html
    $dompdf->loadHtml($html);

    // Renderizamos html
    $dompdf->render();

    // Establecemos descarga
    $dompdf->stream("Mi primer PDF.pdf", array("Attachment" => false)); // False solo visualizacion, true descarga

?>