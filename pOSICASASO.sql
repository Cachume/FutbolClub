-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2025 a las 00:17:26
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
(17, 'Sub-15', '2018-2019', 3, '1233123123123'),
(18, 'Sub-15', '2014-2015', 3, '1233123123123'),
(21, 'asdasd', '2020-2021', 2, 'asdasdasd'),
(25, 'fgdfgfd', '2016-2017', 6, 'sdfsdfsdf'),
(26, 'Cositas', '2014-2015', 6, 'asdasdasd');

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
(1, 'Carlos Mendoza', '30506910', '04145556677', 'albertq703@gmail.com', '2003-08-13', 'asdasd', ''),
(4, 'Ana Torres', '45678901', '04149887766', 'ana.torres@example.com', '2000-08-16', 'asd', ''),
(6, 'Albert', '3506911', '04145099039', 'albertq790@gmail.com', '2003-08-12', 'Barinitas', 'entrenador_3506911.jpg');

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
(4568971, 'asdasd', 'asdasda', '2008-08-13', 'M', 'Sub-17', 'asdasdasd', 17988392, 'uploads/jugadores/jugador_4568971.jpg'),
(15203689, 'asdasdas', 'asdasdasd', '2015-02-11', 'M', 'Sub-11', 'asdasdasdasd', 30506910, 'uploads/jugadores/jugador_15203689.jpg'),
(17988392, 'Albert', 'Mleoasd', '2015-08-13', 'M', 'Sub-11', 'asdasdasd', 30506910, 'uploads/jugadores/jugador_17988392.jpg'),
(30506910, 'Albert Josue', 'Quintero Colina', '2008-08-13', 'M', 'Sub-17', 'Cachume', 17988392, 'uploads/jugadores/jugador_30506910.jpg'),
(30666564, 'Jose', 'Moreno', '2016-05-12', 'M', 'Sub-9', 'Jose', 19620259, 'uploads/jugadores/jugador_30666564.jpg');

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
(2, 'Ana Carolina Colina Montoya', '2003-08-13', '17988392', '04245333833', 'ana23@gmail.com', 'Hola2222', 'uploads/representantes/representante_17988392.jpg', NULL, ''),
(16, 'Albert Josue Quintero Colina', '2003-08-13', '30506910', '04145099039', 'albertq703@gmail.com', '', 'uploads/representantes/representante_30506910.jpg', NULL, '$2y$10$QCTUXlMHo7QXZq5zW5bQ7ugpFkYKIqS0FAcxKlLpjBvH8h1NalT4.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
