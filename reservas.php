<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/reservas.css">

    <style>

        /* Estilos específicos para móviles */

        @media only screen and (max-width: 600px) {

            .formulario-columnas > div {

                width: 100%; /* Ancho completo en dispositivos móviles */

                margin-bottom: 20px; /* Espacio entre elementos */

            }
 
            .boton-enviar {

                width: 100%; /* Ancho completo en dispositivos móviles */

            }

        }
 
        /* Estilos para ajustar la posición del formulario */

        body, html {

            margin: 0;

            padding: 0;

            height: 100%;

        }
 
        .centrar-formulario {

            display: flex;

            justify-content: center;

            align-items: flex-start;

            height: 100%;

            padding-top: 50px; /* Ajustar el espacio en la parte superior */

        }
 
        .formulario-columnas {

            display: flex;

            flex-wrap: wrap; /* Permitir que los elementos se envuelvan */

            justify-content: space-between; /* Espacio entre columnas */

            align-items: flex-start;

            width: 80%; /* Ancho del formulario */

        }
 
        .formulario-columnas > div {

            width: 48%; /* Ancho de las columnas */

        }
 
        .boton-enviar {

            width: 100%; /* Ancho completo del botón */

            margin-top: 10px; /* Espacio entre el formulario y el botón */

        }
 
        /* Estilos para mensajes de error */

        .error {

            color: red;

            display: none;

        }

    </style>

    <title>Reservas</title>

</head>

<body>

<?php require("head.php"); ?>
 
<br>

<br>
 
<h2> <strong> Formulario de Reserva  </strong></h2>
 
<div class="centrar-formulario">

    <form action="procesar_formulario.php" method="post" class="formulario-columnas" onsubmit="return validarFormulario()">

        <!-- Columna 1: Campos principales -->

        <div>

            <!-- Campo Nombre -->

            <label for="nombre">Nombre:</label>

            <input type="text" id="nombre" name="nombre" minlength="3" maxlength="25" required>

            <!-- Campo Teléfono -->

            <label for="telefono">Teléfono:</label>

            <input type="text" id="prefijo_telefono" name="prefijo_telefono" placeholder="Prefijo" pattern="[0-9]{1,3}" title="Introduce el prefijo de país (requerido)" required>

            <input type="text" id="telefono" name="telefono" placeholder="Introduce un número de 9 dígitos" title="El número debe contener 9 dígitos" pattern="[0-9]{9}" required>

            <!-- Campo Email -->

            <label for="email">Email:</label>

            <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>  

            <span id="emailError" class="error">Por favor, introduce un correo electrónico válido.</span>

            <!-- Repetir Email -->

            <label for="repetir_email">Repetir Email:</label>

            <input type="email" id="repetir_email" name="repetir_email" required>

            <span id="repetirEmailError" class="error">Los correos electrónicos no coinciden.</span>

        </div>

        <!-- Columna 2: Otros campos -->

        <div>

            <!-- Contraseña -->

            <label for="contraseña">Contraseña:</label>

            <input type="password" id="contraseña" name="contraseña" minlength="8" maxlength="20" required oninput="this.value = this.value.replace(/\s/g, '')">

            <!-- Fecha de Reserva -->

            <label for="fecha_reserva">Fecha de Reserva:</label>

            <input type="date" id="fecha_reserva" name="fecha_reserva" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+20 days')); ?>" required>

            <!-- Hora de Entrada -->

            <label for="hora_entrada">Hora de Entrada:</label>

            <input type="time" id="hora_entrada" name="hora_entrada"  max="24:00" min="13:00" required>

            <!-- Número de Comensales -->

            <label for="num_comensales">Número de Comensales:</label>

            <input type="number" id="num_comensales" name="num_comensales" max="10" min="1" required>

            <!-- Motivo -->

            <label for="motivo">Motivo:</label>

            <textarea id="motivo" name="motivo" rows="4" ></textarea>

        </div>

        <!-- Botón de Enviar -->

        <button type="submit" class="boton-enviar">Enviar Reserva</button>

    </form>

</div>
 
<script>

    function validarFormulario() {

        var email = document.getElementById("email").value;

        var repetirEmail = document.getElementById("repetir_email").value;

        var emailError = document.getElementById("emailError");

        var repetirEmailError = document.getElementById("repetirEmailError");
 
        // Validar formato de correo electrónico

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {

            emailError.style.display = "block";

            return false;

        } else {

            emailError.style.display = "none";

        }
 
        // Validar si los correos electrónicos coinciden

        if (email !== repetirEmail) {

            repetirEmailError.style.display = "block";

            return false;

        } else {

            repetirEmailError.style.display = "none";

        }
 
        return true;

    }

</script>
 
</body>

</html>





