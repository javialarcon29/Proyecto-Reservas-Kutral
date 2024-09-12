-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2024 a las 13:42:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kutral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `num_comensales` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `id_usuario` varchar(255) NOT NULL,
  `estado_reserva` varchar(50) DEFAULT 'PENDIENTE',
  `rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `telefono`, `email`, `contraseña`, `fecha_reserva`, `hora_entrada`, `num_comensales`, `motivo`, `id_usuario`, `estado_reserva`, `rol`) VALUES
(1, 'asd', 'asd', 'asd@gmail.com', '$2y$10$Kj.1yRzrwUVb6TN1dsOHke.Bg9gBwTcNU78ZyLGfKbPVVUi6Y1QuK', '2024-01-12', '13:37:00', 4, 'asd', '', 'PENDIENTE', 'admin'),
(5, 'adrian', '342423', 'hola@example.com', '$2y$10$Zl29RZiWkr.uMxQO2UXv1uLBtdtAt0zHTo.nRTSJp8MgHZ4Yrd3.G', '0000-00-00', '12:23:00', 2424, '123213', '65a661a434f59', 'Confirmada', NULL),
(6, 'asd', 'asd', 'hola2@example.com', '$2y$10$NcKMMR38FArXm39oZXwcYu6xAWGlRnA3Gbvwp7eTh3WD6e4S0uxJO', '3123-02-11', '12:31:00', 123, '123', '65a6654701292', 'Confirmar', NULL),
(7, 'prueba', '2234234', 'prueba@prueba.com', '$2y$10$Z4/2OHkaSLV3R2sIf2CFdOWAS4YUAdQnnlqgj3njwPvEo/EHLwcIS', '0000-00-00', '12:23:00', 123, '123', '65a6671d3aacd', 'Cancelada', NULL),
(8, 'test', '13412312', 'test@test.com', '$2y$10$ZSG8ncI0H5cIwsWM5mHnIOPaI53BYT.7so1bgXbtKYxqmShyRuiye', '0000-00-00', '13:02:00', 1, 'asdas', '65a6712100507', 'Pendiente', 'admin'),
(9, 'javi', 'javi', 'javi@javi', '$2y$10$6t/8i/9L4eA.CZvuU7dADOOJD20E/DIpgEF5Ey5I3EOCSwuEiLhnC', '0003-03-21', '12:03:00', 23, 'javi', '65a8d72f9e9b6', 'Confirmada', NULL),
(10, 'admin', '1111111', 'admin@admin.com', '$2y$10$Di1IFpS1qe4LrbB//PEZ8.EGbXRTm9n2UWnjlT./leX1D5b/Kn/tG', '0000-00-00', '12:31:00', 5, 'asd', '65a8dde9490ed', 'Cancelada', 'admin'),
(11, 'asd', 'asd', 'asdss@gmail.com', '$2y$10$hGcQ37fMhLpDPDquXPDSru6IH8rXD8daV6/D8oWy9PhXI2MhR4eOa', '0013-03-12', '12:23:00', 123, '123', '65a8e2ecb6b50', 'PENDIENTE', NULL),
(12, 'asd', '123', 'jorgesilvda@example.com', '$2y$10$lSFl6EXSucyqtKlh6H53G.9..9oCMYqvkC3EBQbc1MLenrg4TbnWO', '0123-03-12', '12:03:00', 23123, 'asdas', '65a8e9bbdc16b', 'PENDIENTE', NULL),
(13, 'prueba4', '134213123123123', 'prueba4@prueba4.com', '$2y$10$KkakRQAx8b7usDNkU7WvRevLvzL881ayt2ON5zuAesatjluK9hKpK', '0000-00-00', '12:03:00', 11, 'asdasd', '65a9041511f9a', 'PENDIENTE', NULL),
(14, 'prueba4', '134213123123123', 'prueba4@prueba4.com', '$2y$10$OmiNwz3.WIgm6sVo0TX59ONM08S7GlSXZ2sHQCQZ9rXcJ15H3kQNi', '0000-00-00', '12:03:00', 11, 'asdasd', '65a9041db761d', 'PENDIENTE', NULL),
(15, 'preebaaaaa', '234233422535345', 'preeba@preeba.com', '$2y$10$b//2FbGfW2Dd2vzyLwkY0OvJWh5dbimiQWVpCa1Bo9Tdhu7mEc.sm', '2024-02-11', '13:00:00', 10, 'asdas', '65a907e1ec979', 'Cancelada', NULL),
(16, 'preebaaaaa', '234233422', 'preeba@preeba.com', '$2y$10$b30njDHRX.aesCVss8sJOOypb6FsQfFzkR4WsaZxv3XGsM.A8qLQy', '2024-02-11', '13:00:00', 10, 'asdas', '65a907ff9ede3', 'Confirmar', NULL),
(17, 'prueba5', '123456789', 'prueba5@prueba.com', '$2y$10$lPLzX4OHga21bsEneExUlea97N8jrtdARdjreg2wg6TBUYHQW8age', '2024-12-12', '16:00:00', 4, 'aa', '65a90a82635b0', 'Confirmada', NULL),
(18, 'asd', '123123213', 'preeba1@preeba.com', '$2y$10$ZVKMruKADu3gFKmB6gnCwuz5x6HziM19VW1c/oYT3rAFAMUfAGIvO', '2024-03-12', '13:02:00', 2, 'asd', '65a91ac7d61ff', 'PENDIENTE', NULL),
(19, 'asd', '123123213', 'aadaaa@preeba.com', '$2y$10$x/W3Q5Zdu6Bd6x1d/b/gDu7R4TkzZZiUkCMrvd8wq1fq/YeJFddg.', '2024-03-12', '13:02:00', 2, 'asd', '65a91b12b43b2', 'PENDIENTE', NULL),
(20, 'asd', '123123213', 'aadaaa@preeba.com', '$2y$10$LFUxBb.B6qEBaXIlp0iHM.s2epy3.O7U0gQxbgsGaIV5dAWuoMSii', '2024-03-12', '13:02:00', 2, 'asd', '65a91bbd0671b', 'PENDIENTE', NULL),
(21, '3333', '333333333', 'adriancampayoa@hotmail.com', '$2y$10$.d10Sr8fYfe3LpdSYox63uWRuPlhMmBvMPLR80F35jN4uySb2suPm', '2024-02-12', '16:00:00', 3, 'a', '65a91c07d4d47', 'Cancelada', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
