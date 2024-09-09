<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../CSS/estilos-login.css">
</head>
<body>

    <div class="glass-container">
        <div class="login-box">
            <h2>Iniciar Sesión</h2>

            <form action="../login.php" method="POST">

                <input type="text" name="user_name" id="user_name" placeholder="Usuario" required>
                <input type="password" name="user_password" id="user_password" placeholder="Contraseña" required>

                <div class="options">
                    <input type="checkbox" name="remember_user" id="remember_user">
                    <label for="remember_user">Recordarme</label>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" name="btn_login">Iniciar sesión</button>

                <p>¿No tienes una cuenta? <a href="signup_view.php" name="register" id="register">Regístrate</a></p>

            </form>

        </div>
    </div>
    
</body>
</html>