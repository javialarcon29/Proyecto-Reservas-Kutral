<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <?php require("head.php"); ?>
    <h2>Restablecer Contraseña</h2>
    <main class="main">
        <section class="login">
            <div class="login-container">
                <form action="exitorestablecido.php" method="post">
                    <?php
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];
                        echo '<input type="hidden" name="token" value="' . $token . '">';
                    } else {
                        echo '<p>Error: No se proporcionó el token.</p>';
                    }
                    ?>
                    <label for="email">Correo Electrónico:</label><br>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="new_password">Nueva Contraseña :</label><br>
                    <input type="password" id="new_password" name="new_password" minlength="8" required><br><br>
                    <input type="submit" value="Restablecer Contraseña">
                </form>
            </div>
        </section>
    </main>
    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <?php require("footer.php"); ?>
</body>
</html>
