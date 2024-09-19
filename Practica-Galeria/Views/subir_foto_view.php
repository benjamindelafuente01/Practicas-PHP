<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <title>Galeria</title>
    <link rel="stylesheet" href="CSS/estilos_index.css">
</head>
<body>
    
    <header>
        <div class="contenedor">
            <h1 class="titulo">Subir una nueva foto</h1>
        </div>
    </header>

    <div class="contenedor">
        <form class="formulario" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <label for="archivo_foto">Selecciona una foto</label>
            <input type="file" name="archivo_foto" id="archivo_foto" required>

            <label for="titulo_foto">Título</label>
            <input type="text" name="titulo_foto" id="titulo_foto" placeholder="Escribe un título para la foto" required>

            <label for="descripcion_foto">Descripción</label>
            <textarea name="descripcion_foto" id="descripcion_foto" placeholder="Escribe una descripción para la foto" required></textarea>

            <input type="submit" class="submit" value="Subir foto" name="subir_foto" id="subir_foto">

            <!-- Verificamos errores -->
            <?php
                if (isset($error)) {
                    echo '<p class="error">' . $error . '</p>';
                }
            ?>

        </form>
    </div>

    <footer>
        <p class="copyright">Made by benjamindelafuente01</p>
    </footer>

</body>
</html>