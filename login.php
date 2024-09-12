<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link href="js/js.js" rel="stylesheet">
 
    <title>Restaurante</title>
    <style>
        .forgot-password-link {
            margin-bottom: 10px; /* Ajusta el valor según sea necesario */
            display: block; /* Esto hace que el enlace ocupe todo el ancho disponible */
        }
    </style>
</head>
<body>
<?php require("head.php"); ?>
 
<main class="main">
    <section class="login">
        <div class="login-container">
            <h2 class="main__title">Inicio sesión</h2>
              
            <form action="login_process.php" method="post">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" required><br>
 
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required><br>
                <a href="forgot_password.php" class="forgot-password-link" style="color: white;">¿Has olvidado tu contraseña?</a>
<br>
                <?php 
                if(isset($_GET['error']) && $_GET['error'] == true) {
                    echo "<p style='color: blue;'>¡Usuario o contraseña incorrectos!</p>";
                }
                ?>

                <input type="submit" value="Iniciar Sesión">
            </form>

        </div>
    </section>
</main>
 
<?php require("footer.php"); ?>
 
</body>
</html>
