-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2026 a las 21:30:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `green_volt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones_tecnicas`
--

CREATE TABLE `especificaciones_tecnicas` (
  `id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `capacidad_bateria` varchar(50) DEFAULT NULL,
  `potencia_motor` varchar(50) DEFAULT NULL,
  `tiempo_carga` varchar(50) DEFAULT NULL,
  `velocidad_maxima` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_solicitud`
--

CREATE TABLE `estados_solicitud` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_solicitud`
--

INSERT INTO `estados_solicitud` (`id`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Aprobada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'BYD'),
(2, 'Tesla'),
(3, 'Nissan'),
(4, 'Super Soco'),
(5, 'NIU'),
(6, 'Zero Motorcycles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_compra`
--

CREATE TABLE `solicitudes_compra` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT 1,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT 2,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca_id` int(11) DEFAULT 1,
  `nombre` varchar(150) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `anio` int(11) NOT NULL DEFAULT 2024,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `autonomia` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca_id`, `nombre`, `modelo`, `anio`, `precio`, `autonomia`, `stock`, `descripcion`, `imagen`, `activo`) VALUES
(1, 1, 'BYD Dolphin', 'Dolphin 2024', 2024, 28500.00, 405, 10, 'Hatchback compacto 100% eléctrico.', '/green_volt/public/img/BYD.jpg', 1),
(2, 2, 'Tesla Model 3', 'Model 3 Standard', 2024, 42000.00, 491, 5, 'Sedán eléctrico de gran autonomía.', '/green_volt/public/img/Tesla.jpg', 1),
(3, 3, 'Nissan Leaf', 'Leaf Tekna', 2023, 32000.00, 270, 8, 'Vehículo eléctrico probado y confiable.', '/green_volt/public/img/Nissan.jpg', 1),
(4, 4, 'Super Soco TC Max', 'TC Max 2024', 2024, 4500.00, 110, 6, 'Moto eléctrica de estilo cafe racer urbana, ligera y eficiente.', '/green_volt/public/img/Super Soco TC Max.jpg', 1),
(5, 5, 'NIU NQi GTS', 'NQi GTS Pro', 2024, 3800.00, 130, 8, 'Scooter eléctrico inteligente con doble batería extraíble.', '/green_volt/public/img/NIU NQi GTS.jpg', 1),
(6, 6, 'Zero FXE', 'FXE 2024', 2024, 12500.00, 161, 3, 'Motocicleta eléctrica tipo supermoto de alto rendimiento y aceleración rápida.', '/green_volt/public/img/Zero FXE.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especificaciones_tecnicas`
--
ALTER TABLE `especificaciones_tecnicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`);

--
-- Indices de la tabla `estados_solicitud`
--
ALTER TABLE `estados_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especificaciones_tecnicas`
--
ALTER TABLE `especificaciones_tecnicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_solicitud`
--
ALTER TABLE `estados_solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `especificaciones_tecnicas`
--
ALTER TABLE `especificaciones_tecnicas`
  ADD CONSTRAINT `especificaciones_tecnicas_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  ADD CONSTRAINT `solicitudes_compra_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitudes_compra_ibfk_2` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitudes_compra_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados_solicitud` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
