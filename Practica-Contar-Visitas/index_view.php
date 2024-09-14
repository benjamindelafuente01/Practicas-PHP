<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de visitas</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald:700,400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <h1>Contador de visitas</h1>

    <div class="visitantes">
        <p class="numero">
            <?php 
                require 'index.php';
                echo $visitas;
            ?>
        </p>
        <p class="texto">Visitas</p>
    </div>
    
</body>
</html>