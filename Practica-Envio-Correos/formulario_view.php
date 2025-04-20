<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>


    <div class="contenedor-formulario">
        <form action="enviar_mail.php" method="POST">

            <fieldset>
                <legend>Datos de usuario</legend>

                <input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Ingresa tu nombre" required> <br><br>

                <input type="text" name="apellidoUsuario" id="apellidoUsuario" placeholder="Ingresa tu apellido" required> <br><br>

                <input type="email" name="correoUsuario" id="correoUsuario" placeholder="Ingresa tu correo" required> <br><br>

                <input type="number" name="telefonoUsuario" id="telefonoUsuario" placeholder="Ingresa tu telefono" required> <br><br>

                <input type="text" name="asuntoUsuario" id="asuntoUsuario" placeholder="Ingresa el asunto" required> <br><br>

                <input type="textarea" name="comentarioUsuario" id="comentarioUsuario" placeholder="Ingresa tu comentario"> <br><br>

                <input type="submit" value="Enviar">

            </fieldset>

        </form>
    </div>
    
</body>
</html>