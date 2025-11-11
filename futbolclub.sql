-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2025 a las 14:14:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futbolclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(50) DEFAULT NULL,
  `periodo` varchar(20) DEFAULT NULL,
  `entrenador_id` int(11) DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre_categoria`, `periodo`, `entrenador_id`, `horario`) VALUES
(2, 'Sub-5', '2020-2021', 2, '4:00PM-5:00PM'),
(3, 'Sub-7', '2018-2019', 3, '4:00PM-5:00PM'),
(4, 'Sub-9', '2016-2017', 4, '4:00PM-5:00PM'),
(5, 'Sub-11', '2014-2015', 4, '2:00PM-5:00PM'),
(6, 'Sub-13', '2012-2013', 5, '2:00PM-3:30PM'),
(7, 'Sub-17', '2008-2009', 7, '5:00PM-6:30PM'),
(8, 'Sub-15', '2011-2010', 6, '3:30PM-5:00PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre_completo`, `cedula`, `telefono`, `correo`, `fecha_nacimiento`, `direccion`, `foto`) VALUES
(2, 'Keninzon Rivas', '10000000', '04140000000', 'Kennizon@gmail.com', '2000-02-25', '', 'entrenador_10000000.jpg'),
(3, 'Alexain Sanchez', '10000001', '04140000000', 'Alexainasd@gmail.com', '2000-02-22', '', 'entrenador_10000001.jpg'),
(4, 'Luis Rivas', '10000002', '04140000000', 'luisrivas@gmail.com', '2002-02-22', '', 'entrenador_10000002.jpg'),
(5, 'Julio Querales', '10000003', '04140000000', 'Julioq@gmail.com', '2002-02-22', '', 'entrenador_10000003.jpg'),
(6, 'Rafael Osorio', '10000004', '04140000000', 'RafaelO@gmail.com', '2002-02-22', '', 'entrenador_10000004.jpg'),
(7, 'Herman Hidalgo', '10000005', '04140000000', 'Herman@gmail.com', '2002-02-22', '', 'entrenador_10000005.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `cedula` bigint(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` char(1) NOT NULL CHECK (`genero` in ('M','F')),
  `categoria` varchar(20) NOT NULL,
  `nombre_camiseta` varchar(20) NOT NULL,
  `cedula_representante` bigint(20) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`cedula`, `nombres`, `apellidos`, `fecha_nacimiento`, `genero`, `categoria`, `nombre_camiseta`, `cedula_representante`, `foto`) VALUES
(20159753, 'Albert', 'Quinterito', '2020-08-13', 'M', '2', 'asdasdasd', 30506910, 'uploads/jugadores/jugador_20159753.jpg'),
(25123741, 'ASASAS', 'QQQQQQ', '2020-08-13', 'F', '2', 'ASDAD', 30506910, 'uploads/jugadores/jugador_25123741.jpg'),
(30506910, 'Albert', 'Quintero', '2010-08-13', 'M', '3', 'asdasdasdasd', 30194545, 'uploads/jugadores/jugador_30506910.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_pagos`
--

CREATE TABLE `lista_pagos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_pagos`
--

INSERT INTO `lista_pagos` (`id`, `nombre`, `descripcion`, `monto`, `fecha_creacion`) VALUES
(1, 'asd', '123', 123, '2025-09-29'),
(2, 'Mensualidad Octubre 2025', 'Mensaulidad', 20, '2025-10-05'),
(3, 'sfdsfdsdf', 'asdasdasd', 200, '2025-10-06'),
(4, 'Mensualidad Diciembre', 'Uniformes y Otros', 20, '2025-10-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL,
  `metodo_pago` varchar(30) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `numero_cuenta` varchar(50) NOT NULL,
  `banco` varchar(100) DEFAULT NULL,
  `detalles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `representante_id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `estado` enum('pendiente','verificado','rechazado') DEFAULT 'pendiente',
  `metodo_pago` varchar(50) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `concepto` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_pago`, `representante_id`, `monto`, `fecha_pago`, `estado`, `metodo_pago`, `referencia`, `concepto`, `foto`) VALUES
(3, 2, 30506910, 20.00, '2025-10-06', 'verificado', 'pago_movil', '1238123321684312', 'Mensualidad Septiembre', 'uploads/pagos/pagomovil.jpg'),
(4, 3, 30506910, 200.00, '2003-08-13', 'verificado', 'pago_movil', '1452111212348126', 'Mensualidad Septiembre', 'uploads/pagos/pagomovil.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_categoria`
--

CREATE TABLE `pago_categoria` (
  `id_pago` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_categoria`
--

INSERT INTO `pago_categoria` (`id_pago`, `id_categoria`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `passwordp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `nombre_completo`, `fecha_nacimiento`, `cedula`, `telefono`, `correo`, `direccion`, `foto`, `id_usuario`, `passwordp`) VALUES
(1, 'Diemar Santiago', '2003-08-13', '30194545', '04245333833', 'diemarsantiago2003@gmail.com', '', 'uploads/representantes/representante_30194545.jpg', NULL, '$2y$10$AOUG/VDuFKY20GFpMjFuOOzNNHL04AIIDVGWCx15JY9mgW5r2CXaW'),
(4, 'asdasdasd asdad', '2000-08-13', '30506916', '04145099039', 'pyduos@gmail.com', '2', 'uploads/representantes/representante_30506910.jpg', NULL, '$2y$10$jB0i3w2lMUIxcdVb84VeWOGXM9bzyIUnqTuy0IPYij.GylppmnB1m'),
(5, 'Albert Quintero', '2003-08-13', '30506912', '04145099039', 'pyduos@gmail.com', '', 'uploads/representantes/representante_30506912.jpg', NULL, '$2y$10$S70cRWey0oOxC3an0qjHc.BJKXPOSsQBqNwdLAmC1H2/O3hxiAtd.'),
(7, 'Albert Quintero', '2003-08-13', '17988392', '04145099039', 'albertq7033@gmail.com', 'd', 'uploads/representantes/representante_17988392.jpg', NULL, '$2y$10$8B7raEa2pgFjOUdax53fn.l04r0Y5KJNW9gHx02jvyMcani9Yg06e'),
(8, 'Albert Quintero', '2003-08-13', '11374377', '04145099033', 'albertq70322@gmail.com', 'asd', 'uploads/representantes/representante_11374377.jpg', NULL, '$2y$10$7ZUzYBTcIi5.8JfnNxOIyeEwHbMARAacVW7TcT0hjjj/brwUaYyXy'),
(9, 'Albert Quintero', '1997-12-31', '30506910', '04145099039', 'albertq703@gmail.com', '1', 'uploads/representantes/representante_17988392.jpg', NULL, '$2y$10$1gFvreqwRZ6.I5dEOqdZgOEUHEMulxauif7kP9aIRVAQSsLrXYiMG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin','entrenador','representante') NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email`, `contraseña`, `rol`, `creado_en`) VALUES
(1, 'Administrador', 'admin@futbolclub.com', '$2y$10$5aZfONrP8Hzrs322rJjM6ubRFTI5poQvlZtiRrfXZzkkkaqmGg0PG', 'admin', '2025-06-24 01:33:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `lista_pagos`
--
ALTER TABLE `lista_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `lista_pagos`
--
ALTER TABLE `lista_pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
