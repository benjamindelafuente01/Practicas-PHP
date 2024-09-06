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

        <h1 class="titulo">Iniciar Sesión</h1>

        <hr class="border">

        <div class="contenido">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
                <div class="form-group">
                    <i class="icono izquierda fa fa-user"></i><input type="text" class="usuario" name="usuario" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <i class="icono izquierda fa fa-lock"></i><input type="password" class="password_btn" name="password" placeholder="Contraseña">
                    <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
                </div>

                <!-- Código PHP para mostrar mensaje de errores-->
                <?php
                    if (!empty($mensajeErrores)) {
                        echo '<div class="error">' .  $mensajeErrores . '</div>';
                    }
                ?>
            </form>

            <p class="texto-registrate">
                ¿ No tienes cuenta?
                <a href="../Logic/registro_usuario_logic.php">Regístrate</a>
            </p>
            
        </div>

    </div>

</body>
</html>