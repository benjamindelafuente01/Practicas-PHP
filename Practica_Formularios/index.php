<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon web" type="png" href="imagenes/Icono Formulario.png">

</head>
<body>

    <h1>Práctica I.-Formulario de Contacto</h1>

    <hr>

    <h3 class="tituloSecundario">Práctica de Formulario</h3>

    <section class="envolturaFormulario">

        <section class="seccionContacto">

            <img src="imagenes/contacto.png" width="30%" class="iconos">
            <h3>Información de Contacto</h3>
            <img src="imagenes/carta.png" width="10%" class="imgContacto">
            <span>benjamindelafuente666@gmail.com</span>
            <img src="imagenes/telefono.png" width="10%" class="imgContacto">
            <span>783 139 5410</span>
            <img src="imagenes/ubicacion.png" width="10%" class="imgContacto">
            <span>Prol. Miguel Hidalgo S/N CP:92770,</span> 
            <span>Tuxpan, Veracruz</span>

        </section>


        <section class="seccionFormulario">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <fieldset>
                    <legend>Datos de usuario</legend> 

                    <input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Ingresa tu nombre" value="<?php if(!$enviado && isset($nombre)) echo $nombre; ?>"> <br>

                    <input type="text" name="correoUsuario" id="correoUsuario" placeholder="Ingresa tu correo" value="<?php if(!$enviado && isset($correo)) echo $correo; ?>"> <br>

                    <input type="textarea" name="comentarioUsuario" id="comentarioUsuario" placeholder="Escribe un comentario" value="<?php if(!$enviado && isset($comentario)) echo $comentario; ?>"> <br> <br>

                    <!-- Codigo PHP para mostrar mensajes de errores/exito del envio -->
                    <?php if (!empty($mensajeErrores)): ?>
                        <div class="alert error"> <?php echo $mensajeErrores; ?> </div>
                    <?php elseif ($enviado): ?>
                        <p class="alert succes">Enviado correctamente</p>
                    <?php endif ?>

                    <input type="submit" value="Enviar" name="EnviarFormulario" id="enviarFormulario"> <br>

                </fieldset>
            </form>
        </section>
    
    </section>

</body>
</html>