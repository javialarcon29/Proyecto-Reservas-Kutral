<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
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
                <input type="email" name="email" required><br>
                <input type="submit" value="Reestablecer">
            </form>
        </div>
    </section>
</main>
 
<?php require("footer.php"); ?>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar Sweet Alert al cargar la página
    Swal.fire({
        title: "¡ Correo Enviado !",
        text: "Se ha enviado un correo para reestablecer la contraseña",
        icon: "success"
    });
</script>
</body>
</html>
