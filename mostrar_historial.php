<?php
session_start(); // Asegúrate de iniciar la sesión en la parte superior del script

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirige a la página de inicio de sesión si no ha iniciado sesión
    exit();
}



// Establece la conexión a la base de datos


$email = $_GET['email'];

$conexion = new mysqli("localhost", "root", "", "kutral");

// Consulta para obtener las reservas del usuario actual
//$id_usuario = $_SESSION['id_usuario'];
$sql_reservas = "SELECT * FROM reservas WHERE email = '$email'";

$result_reservas = $conexion->query($sql_reservas);

                // Cierra la conexión
$conexion->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reservas.css">
    <title>Kutral</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Estilos para filas de reserva confirmadas */
        tr.Confirmada {
            background-color: #79FF5E; /* Verde claro */
        }

        /* Estilos para filas de reserva Cancelada */
        tr.Cancelada {
            background-color: #FF3C3C; /* Rojo claro */
        }

        /* Estilos para filas de reserva pendientes */
        tr.PENDIENTE {
            background-color: #FAFC66; /* Amarillo claro */
        }

        /* Establecer color de texto negro para todas las celdas de la tabla */
        td, th {
            color: black;
        }
        
        
         tr:hover {
        background-color: #FFFFFF; /* Cambia el color de fondo cuando pasa el ratón por encima */
    }
    </style>
</head>
<body>
<?php require("headadmin.php"); ?>
<main class="main">
    <section class="revd">
        <div class="container">
            <h2 class="main__title"><?=$email ?></h2>
            <ul class="x">
                
                <table border='1' class='center-table'>
                    
                <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Hora de la reserva</th>
                        <th>Fecha</th>
                        <th>Número de comensales</th>
                        <th>Estado reserva</th>
                        <th>Editar</th>
                        <th>Borrar</th>        
                      </tr>

                <?php
                while ($row_reserva = $result_reservas->fetch_assoc()):
                    // Determina la clase CSS según el estado de la reserva
                    $clase_estado = '';
                    switch ($row_reserva['estado_reserva']) {
                        case 'Confirmada':
                            $clase_estado = 'Confirmada';
                            break;
                        case 'Cancelada':
                            $clase_estado = 'Cancelada';
                            break;
                        default:
                            $clase_estado = 'PENDIENTE';
                            break;
                    }
                    
                ?>
        
                    // Genera la fila de la tabla con la clase CSS determinada
                    <tr class='<?=$clase_estado ?>'>
                        <td><?php echo $row_reserva['nombre']; ?></td>
                        <td><?php echo $row_reserva['telefono']; ?></td>
                        <td><a href='mostrar_historial.php?email=<?=$row_reserva['email']?>' class='ver-historial'><?=$row_reserva['email']?></a></td>
                        <td><?=$row_reserva['hora_entrada']?></td>
                        <td><?=$row_reserva['fecha_reserva']?></td>
                        <td><?=$row_reserva['num_comensales']?></td>
                        <td><?=$row_reserva['estado_reserva']?></td>
                        
                        <!-- Añadir icono de editar con la imagen de fondo.jpg -->
                        
                        <td><a href='editar_reserva.php?id=<?=$row_reserva['id']?>'><img src='img/edit.png' alt='Editar' ></a></td>
    
                        <!-- Añadir icono de borrar con la imagen de basura.png y mostrar el modal de confirmación -->
                        <td><img class='delete-icon' src='img/basura.png' data-id='<?=$row_reserva['id']?>'></td>
                        <td><a href='confirmar_reserva.php?id=<?=$row_reserva['id']?>&email=<?=$row_reserva['email']?>'><img src='img/aceptar.png' alt='Confirmar' class='button-small'></a></td>
                        <td><a href='rechazar_reserva.php?id=<?=$row_reserva['id']?>&email=<?=$row_reserva['email']?>'><img src='img/delete.png' alt='Rechazar' class='button-small'></a></td>
                    </tr>
                    
                <?php endwhile; ?>
                
                </table>
            </ul>
        </div>
    </section>
</main>

<?php require("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Función para redireccionar a mostrar_historial.php cuando se hace clic en el correo electrónico
        $(document).on('click', '.ver-historial', function(e) {
            e.preventDefault();
            var email = $(this).attr('href'); // Obtener el valor del atributo href, que es la URL a mostrar_historial.php
            window.location.href = email; // Redireccionar a la página mostrar_historial.php
        });

        // Funcionalidad para eliminar reservas
        $(document).on('click', '.delete-icon', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var deleteIcon = $(this); // Almacenar una referencia al icono de eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Vas a borrar la reserva. Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar reserva',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma la acción, realizar una solicitud AJAX para eliminar la reserva
                    $.ajax({
                        type: 'POST',
                        url: 'borrar_reserva.php',
                        data: { id: id },
                        success: function(response) {
                            // Manejar la respuesta si es necesario
                            Swal.fire('¡Reserva borrada!', '', 'success');
                            // Actualizar la tabla o realizar otras acciones según sea necesario
                            // Por ejemplo, puedes eliminar la fila de la tabla correspondiente a la reserva eliminada
                            deleteIcon.closest('tr').remove(); // Utiliza la referencia almacenada para eliminar la fila de la tabla actual
                        },
                        error: function(xhr, status, error) {
                            // Manejar errores si es necesario
                            console.error(xhr.responseText);
                            Swal.fire('Error al borrar la reserva', '', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>










