<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link href="js/js.js" rel="stylesheet">
 
    <title>Restaurante</title>
</head>
<body>
<?php require("head.php"); ?>
 
<main class="main">
    <section class="login">
        <div class="login-container">
            <h2 class="main__title">Reestablecer Contraseña</h2>
              
           <form action="reset_password_process.php" method="post">
    <label for="email">Correo Electrónico:</label>
     <input type="email" id="email" name="email" required><br>
    <input type="submit" value="Reestablecer">
</form>


        </div>
    </section>
</main>
 
<?php require("footer.php"); ?>
 
</body>
</html>
