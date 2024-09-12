<?php
// Verificar si se ha recibido el correo electrónico por GET
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Establecer la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "kutral");

    // Consulta para obtener el historial de reservas del correo electrónico especificado
    $sql = "SELECT * FROM reservas WHERE email = '$email'";
    $result = $conexion->query($sql);

    // Construir la tabla HTML con el historial de reservas
    $table = "<div class='table-wrapper'><table>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Hora de la reserva</th>
                    <th>Fecha</th>
                    <th>Número de comensales</th>
                    <th>Estado reserva</th>
                </tr>";
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['hora_entrada']}</td>
                        <td>{$row['fecha_reserva']}</td>
                        <td>{$row['num_comensales']}</td>
                        <td>{$row['estado_reserva']}</td>
                    </tr>";
    }
    $table .= "</table></div>";

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibió el correo electrónico, mostrar un mensaje de error
    $table = "<p>Error: Correo electrónico no especificado.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .table-wrapper {
            border-radius: 10px;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historial de Reservas</h1>
    </div>

    <div class="container">
        <?php echo $table; ?>
    </div>

    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Kutral. Todos los derechos reservados.</p>
    </div>
</body>
</html>







