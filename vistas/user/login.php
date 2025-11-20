<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/login.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/toastr.min.css">
    <title>Futbol Club | Iniciar Sesión</title>
</head>
<body>
    <main class="main_login">
        <div class="login-container">
        <div class="login-title">
            <div class="login-text">
                <span>INICIAR SESION</span>
                <p>Futbol Club Agua Dulce</p>
            </div>
            <img src="/FutbolClub/assets/img/club-brand.png" alt="">
        </div>
        <form  id="login-form" method="POST" action="/FutbolClub/login/autenticar">
            <div class="form-group">
                <label for="username">USUARIO O EMAIL</label>
                <input class="invalid" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">CONTRASEÑA:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-groups">
                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Seguir Conetado</label>
                </div> 
                <a href="#">¿Has olvidado tu contraseñas?</a>
            </div>
            <button type="submit" name="iniciarsesion">Iniciar Sesión</button>
        </form>
    </div>
    </main>
    
    <!-- <script src="/FutbolClub/assets/js/login.js"></script> -->
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/toastr.min.js"></script>
    <?php if (isset($_SESSION['toast_message'])):
            $type = $_SESSION['toast_type'];
            $message = $_SESSION['toast_message'];
            echo "
            <script>
                toastr.".htmlspecialchars($type)."('".htmlspecialchars($message)."')
            </script>";
            unset($_SESSION['toast_type']);
            unset($_SESSION['toast_message']);
         endif; ?> 
</body>
</html>