<?php
session_start(); 

$email = $_POST['email'];
$password = $_POST['password'];

$conexion = new mysqli("localhost", "root", "", "kutral");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM reservas WHERE email = '$email'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['contraseña'];

    if (password_verify($password, $hashed_password)) {
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];

        // Verifica el rol del usuario
        if ($row['rol'] == 'admin') {
            // Si el rol es admin, redirige a indexadmin.php
            header("Location: indexadmin.php");
        } else {
            // Si no es admin, redirige a usuario normal (indexparauserlogeado.php)
            header("Location: indexparauserlogeado.php");
        }
        exit();
    } else {
        // Contraseña incorrecta
        header("Location: login.php?error=true");
        exit();
    }
} else {
    // Usuario no encontrado
    header("Location: login.php?error=true");
    exit();
}

$conexion->close();
?>
