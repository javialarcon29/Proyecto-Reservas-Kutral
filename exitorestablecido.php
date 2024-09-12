<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Restablecimiento de Contraseña</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
    // Incluir las clases de PHPMailer y las excepciones
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once("src/phpmailer/PHPMailer.php");
    require_once("src/phpmailer/SMTP.php");
    require_once("src/phpmailer/Exception.php");

    // Verificar si se ha enviado un formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar el correo electrónico proporcionado por el usuario
        $email = $_POST['email'];

        // Conectar a la base de datos
        $servername = "kutral.es.mysql"; // Cambiar por tu servidor
        $username = "kutral_es"; // Cambiar por tu usuario
        $password = "ProyectoKUTRAL1#"; // Cambiar por tu contraseña
        $dbname = "kutral_es"; // Cambiar por tu base de datos

        // Crear conexión
        $conexion = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Recuperar la nueva contraseña del formulario
        $new_password = $_POST['new_password'];

        // Hashear la nueva contraseña
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Consulta para actualizar la contraseña en la base de datos
        $sql = "UPDATE reservas SET contraseña = ? WHERE email = ?";
        
        // Preparar la declaración
        $stmt = $conexion->prepare($sql);

        // Enlazar parámetros
        $stmt->bind_param("ss", $hashed_password, $email);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Contraseña actualizada con éxito
            echo "<script>
                    Swal.fire({
                      title: 'Su contraseña ha sido restablecida con éxito',
                      text: '',
                      icon: 'success',
                      confirmButtonText: 'OK'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'login.php'; // Redirigir al usuario al inicio de sesión
                      }
                    });
                  </script>";
        } else {
            // Error al actualizar la contraseña
            echo "<script>
                    Swal.fire({
                      title: 'Error',
                      text: 'Error al restablecer la contraseña. Por favor, inténtalo de nuevo más tarde.',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'forgot_password.php'; // Redirigir al usuario a la página de restablecimiento de contraseña
                      }
                    });
                  </script>";
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conexion->close();
    }
    ?>
</body>
</html>


