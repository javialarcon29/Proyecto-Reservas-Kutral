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

        // Consulta para verificar si el correo electrónico existe en la base de datos
        $sql = "SELECT * FROM reservas WHERE email='$email'";
        $result = $conexion->query($sql);

        if (!$result) {
            die("Error al ejecutar la consulta: " . $conexion->error);
        }

        if ($result->num_rows > 0) {
            // El correo electrónico existe en la base de datos, proceder con el envío del correo electrónico para restablecer la contraseña
            $token = bin2hex(random_bytes(16)); // Generar un token aleatorio de 16 bytes en formato hexadecimal

            // Aquí deberías almacenar el token en la base de datos junto con el correo electrónico del usuario para verificar más tarde

            $reset_link = "http://kutral.es/reset_password.php?token=$token";
            $email_subject = "Restablecer Contraseña";

            $email_body = "
                    <!DOCTYPE html>
                    <html lang=\"es\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Restablecimiento de Contraseña</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-image: url('https://www.restaurantekutral.com/wp-content/uploads/2021/04/DSC08802-1024x1024.jpg');
                                background-size: cover;
                                background-position: center;
                                color: #333;
                                margin: 0;
                                padding: 0;
                            }

                            header {
                                background-color: #FF9700;
                                color: white;
                                text-align: center;
                                padding: 20px;
                            }

                            section {
                                margin: 20px;
                            }

                            p {
                                margin-bottom: 10px;
                            }

                            footer {
                                background-color: #333;
                                color: white;
                                text-align: center;
                                padding: 10px;
                            }
                        </style>
                    </head>
                    <body>
                        <header>
                            <h1>Restablecer Contraseña</h1>
                        </header>
                        <section>
                            <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
                            <a href=\"$reset_link\">Restablecer Contraseña</a>
                        </section>
                         <br> <br> <br> <br> <br> <br> <br> <br> <br>
                        <footer>
                            <p>Este correo electrónico fue enviado automáticamente. Por favor, no responder | Kutral.es</p>
                        </footer>
                    </body>
                    </html>
                    ";

            $mail = new PHPMailer(true);

            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host       = 'send.one.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'web@kutral.es';
                $mail->Password   = 'ProyectoKUTRAL1#';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;

                // Remitente y destinatario
                $mail->setFrom('web@kutral.es', 'KUTRAL');
                $mail->addAddress($email);

                // Contenido del correo electrónico
                $mail->isHTML(true);
                $mail->Subject = $email_subject;
                $mail->Body    = $email_body;

                // Enviar correo electrónico
                $mail->send();

                // Mostrar mensaje de éxito y redirigir
                echo "<script>
                        Swal.fire({
                          title: 'Correo enviado',
                          text: 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña. Por favor, revisa tu bandeja de entrada.',
                          icon: 'success',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'forgot_password.php';
                          }
                        });
                      </script>";
            } catch (Exception $e) {
                // Mostrar mensaje de error y redirigir
                echo "<script>
                        Swal.fire({
                          title: 'Error',
                          text: 'Error al enviar el correo electrónico: {$mail->ErrorInfo}',
                          icon: 'error',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'forgot_password.php';
                          }
                        });
                      </script>";
            }
        } else {
            // El correo electrónico no existe en la base de datos
            // Mostrar mensaje de error y redirigir
            echo "<script>
                    Swal.fire({
                      title: 'Correo no encontrado',
                      text: 'El correo electrónico proporcionado no está asociado a una cuenta. Por favor, verifícalo e inténtalo de nuevo.',
                      icon: 'error',
                      confirmButtonText: 'OK'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'forgot_password.php';
                      }
                    });
                  </script>";
        }

        // Cerrar conexión a la base de datos
        $conexion->close();
    }