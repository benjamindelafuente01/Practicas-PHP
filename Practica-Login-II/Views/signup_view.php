<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate</title>
    <link rel="stylesheet" href="../CSS/estilos-signup.css">
</head>
<body>

    <div class="glass-container">
        <div class="login-box">
            <h2>Crear una cuenta</h2>

            <form action="../signup.php" method="POST">

                <input type="text" name="user_name" id="user_name" placeholder="Usuario" required>
                <input type="password" name="user_password1" id="user_password1" placeholder="Contraseña" required>
                <input type="password" name="user_password2" id="user_password2" placeholder="Repite tu contraseña" required>

                <div class="options">
                    
                </div>

                <button type="submit" name="btn_signup">Regístrarte</button>

                <p>¿Ya tienes una cuenta? <a href="login_view.php" name="register" id="register">Iniciar sesión</a></p>

            </form>

        </div>
    </div>
    
</body>
</html>