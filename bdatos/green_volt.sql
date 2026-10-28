-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2026 a las 20:12:36
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
-- Estructura de tabla para la tabla `citas_soporte`
--

CREATE TABLE `citas_soporte` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `vehiculo_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) NOT NULL,
  `estado_id` int(11) DEFAULT 1,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `comentario` text DEFAULT NULL,
  `estado` enum('pendiente','confirmada','completada','cancelada') DEFAULT 'pendiente',
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `documento_identidad` varchar(50) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `icono` varchar(50) DEFAULT 'fa-tools',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `icono`, `activo`) VALUES
(1, 'Mantenimiento Preventivo', 'Revisiones periódicas de batería, frenos regenerativos y software del vehículo.', 'fa-wrench', 1),
(2, 'Instalación de Cargadores', 'Asesoría e instalación domiciliaria o empresarial de puntos de carga rápida.', 'fa-charging-station', 1),
(3, 'Soporte Técnico y Diagnóstico', 'Diagnóstico especializado por escáner de sistemas eléctricos y de alta tensión.', 'fa-laptop-code', 1),
(4, 'Garantía y Repuestos', 'Gestión de garantías oficiales de fábrica y catálogo de repuestos originales.', 'fa-shield-alt', 1),
(5, 'Mantenimiento Preventivo', 'Revisión general de sistemas eléctricos y batería.', 'fa-tools', 1),
(6, 'Diagnóstico Electrónico / Escáner', 'Lectura de fallas informáticas y actualización del software.', 'fa-tools', 1),
(7, 'Instalación de Cargador Domiciliario', 'Soporte e instalación de estación de carga en casa.', 'fa-tools', 1),
(8, 'Chequeo de Salud de Batería (SoH)', 'Diagnóstico técnico del estado de degradación de las celdas.', 'fa-tools', 1),
(9, 'Revisión de Frenos y Neumáticos', 'Inspección de desgaste del sistema regenerativo y llantas.', 'fa-tools', 1),
(10, 'Garantía y Repuestos', 'Gestión de piezas originales y coberturas.', 'fa-tools', 1);

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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol_id`, `nombre`, `email`, `password`, `creado_en`) VALUES
(2, 2, 'Xiomara Pérez Castro', 'xperez@gmail.com', '$2y$10$nrGQZCZUWdTAARKb6g58Jep4GgMN1Cw2LVVOYAG2Vqf33ivBGjYgi', '2026-10-16 20:37:45');

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
  `precio` decimal(15,2) NOT NULL,
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
(1, 1, 'BYD Dolphin', 'Dolphin 2024', 2024, 28500000.00, 405, 10, 'Hatchback compacto 100% eléctrico.', '/green_volt/public/img/BYD.jpg', 1),
(2, 2, 'Tesla Model 3', 'Model 3 Standard', 2024, 42000000.00, 491, 5, 'Sedán eléctrico de gran autonomía.', '/green_volt/public/img/Tesla.jpg', 1),
(3, 3, 'Nissan Leaf', 'Leaf Tekna', 2023, 32000000.00, 270, 8, 'Vehículo eléctrico probado y confiable.', '/green_volt/public/img/Nissan.jpg', 1),
(4, 4, 'Super Soco TC Max', 'TC Max 2024', 2024, 4500000.00, 110, 6, 'Moto eléctrica de estilo cafe racer urbana, ligera y eficiente.', '/green_volt/public/img/Super Soco TC Max.jpg', 1),
(5, 5, 'NIU NQi GTS', 'NQi GTS Pro', 2024, 3800000.00, 130, 8, 'Scooter eléctrico inteligente con doble batería extraíble.', '/green_volt/public/img/NIU NQi GTS.jpg', 1),
(6, 6, 'Zero FXE', 'FXE 2024', 2024, 12500000.00, 161, 3, 'Motocicleta eléctrica tipo supermoto de alto rendimiento y aceleración rápida.', '/green_volt/public/img/Zero FXE.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas_soporte`
--
ALTER TABLE `citas_soporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `servicio_id` (`servicio_id`),
  ADD KEY `fk_citas_estado` (`estado_id`),
  ADD KEY `fk_citas_vehiculo` (`vehiculo_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`);

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
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitudes_vehiculo` (`vehiculo_id`),
  ADD KEY `fk_solicitudes_usuario` (`usuario_id`),
  ADD KEY `fk_solicitudes_estado` (`estado_id`);

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
-- AUTO_INCREMENT de la tabla `citas_soporte`
--
ALTER TABLE `citas_soporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas_soporte`
--
ALTER TABLE `citas_soporte`
  ADD CONSTRAINT `citas_soporte_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_soporte_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `fk_citas_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_solicitud` (`id`),
  ADD CONSTRAINT `fk_citas_vehiculo` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `especificaciones_tecnicas`
--
ALTER TABLE `especificaciones_tecnicas`
  ADD CONSTRAINT `especificaciones_tecnicas_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_compra`
--
ALTER TABLE `solicitudes_compra`
  ADD CONSTRAINT `fk_solicitudes_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados_solicitud` (`id`),
  ADD CONSTRAINT `fk_solicitudes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_solicitudes_vehiculo` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE,
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
