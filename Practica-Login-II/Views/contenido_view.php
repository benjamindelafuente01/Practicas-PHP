<?php
    // Importamos script que verifica que haya una sesión activa
    require __DIR__ . '/../contenido.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido usuario</title>
    <link rel="stylesheet" href="../CSS/estilos-contenido.css">
</head>
<body>

    <div class="glass-container">
        <div class="login-box">
            <h2>Bienvenido, <?php echo $nombre_usuario; ?></h2>
            <div class="options">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit atque sunt eligendi 
                    quasi suscipit debitis, placeat inventore iure, eos saepe explicabo magnam, nulla modi 
                    cupiditate quia nemo nobis fugiat reprehenderit.
                </p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit atque sunt eligendi 
                    quasi suscipit debitis, placeat inventore iure, eos saepe explicabo magnam, nulla modi 
                    cupiditate quia nemo nobis fugiat reprehenderit.
                </p>
            </div>
            <p><a href="../logout.php">Cerrar sesión</a></p>
        </div>
    </div>
    
</body>
</html>