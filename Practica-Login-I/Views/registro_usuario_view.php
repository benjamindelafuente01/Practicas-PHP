<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../CSS/estilos_registro.css">
</head>
<body>

    <div class="contenedor">

        <h1 class="titulo">Regístrate</h1>

        <hr class="border">

        <div class="contenido">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="signin">
                <div class="form-group">
                    <i class="icono izquierda fa fa-user"></i><input type="text" class="usuario" name="usuario" placeholder="Usuario" autofocus>
                </div>
                <div class="form-group">
                    <i class="icono izquierda fa fa-lock"></i><input type="password" class="password" name="password1" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <i class="icono izquierda fa fa-lock"></i><input type="password" class="password_btn" name="password2" placeholder="Repite tu contraseña">
                    <!-- <input type="hidden" name="btn-registro">
                    <i class="submit-btn fa fa-arrow-right" type="button" onclick="signin.submit()" ></i> -->
                    <i class="submit-btn fa fa-arrow-right" onclick="signin.submit()" name="btn-registro"></i>
                </div>

                <!-- Código PHP para mostrar mensaje de errores-->
                <?php
                    if (!empty($mensajeErrores)) {
                        echo '<div class="error">' .  $mensajeErrores . '</div>';
                    }
                ?>
            </form>

            <p class="texto-registrate">
                ¿ Ya tienes cuenta?
                <a href="../Logic/inicio_sesion_logic.php">Iniciar sesión</a>
            </p>
            
        </div>

    </div>

</body>
</html>