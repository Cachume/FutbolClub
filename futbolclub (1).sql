-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2025 a las 14:17:08
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
(2, 'Keninzon Rivas', '10000000', '04140000000', 'Kennizon@gmail.com', '2000-02-25', 'a', 'entrenador_10000000.jpg'),
(3, 'Alexain Sanchez', '10000001', '04140000000', 'Alexainasd@gmail.com', '2000-02-22', '', 'entrenador_10000001.jpg'),
(4, 'Luis Rivas', '10000002', '04140000000', 'luisrivas@gmail.com', '2002-02-22', '', 'entrenador_10000002.jpg'),
(5, 'Julio Querales', '10000003', '04140000000', 'Julioq@gmail.com', '2002-02-22', '', 'entrenador_10000003.jpg'),
(6, 'Rafael Osorio', '10000004', '04140000000', 'RafaelO@gmail.com', '2002-02-22', '', 'entrenador_10000004.jpg'),
(7, 'Herman Hidalgo', '10000005', '04140000000', 'Herman@gmail.com', '2002-02-22', '', 'entrenador_10000005.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_partidos`
--

CREATE TABLE `estadisticas_partidos` (
  `id` int(11) NOT NULL,
  `partido_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `jugador_id` int(11) DEFAULT NULL,
  `goles` int(11) DEFAULT 0,
  `asistencias` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_partidos`
--

INSERT INTO `estadisticas_partidos` (`id`, `partido_id`, `categoria_id`, `jugador_id`, `goles`, `asistencias`) VALUES
(1, 48, 2, 65, 4, 1),
(2, 48, 2, 70, 0, 1),
(3, 48, 2, 71, 0, 1),
(4, 48, 2, 77, 0, 1),
(5, 48, 3, 72, 2, 1),
(6, 48, 3, 74, 0, 1),
(7, 48, 3, 76, 0, 1),
(8, 48, 3, 78, 0, 0),
(9, 48, 3, 79, 0, 0),
(10, 49, 2, 65, 2, 3),
(11, 49, 2, 70, 0, 0),
(12, 49, 2, 71, 0, 0),
(13, 49, 2, 77, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `partida_nacimiento` int(11) DEFAULT NULL,
  `cedula` int(8) DEFAULT NULL,
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

INSERT INTO `jugadores` (`id`, `partida_nacimiento`, `cedula`, `nombres`, `apellidos`, `fecha_nacimiento`, `genero`, `categoria`, `nombre_camiseta`, `cedula_representante`, `foto`) VALUES
(65, NULL, 3332290, 'Marco', 'Rodriguez', '2020-06-12', 'M', '2', '12', 14776478, 'uploads/jugadores/jugador_3332290.jpg'),
(66, NULL, 16126186, 'Mathias Eduardo', 'Rondon Rivas', '2016-12-16', 'M', '4', '24', 16126186, 'uploads/jugadores/jugador_16126186.jpg'),
(67, NULL, 16189962, 'Antonella Cornomoto', 'Albarran Torres', '2017-11-22', 'F', '4', '23', 16189962, 'uploads/jugadores/jugador_16189962.jpg'),
(68, NULL, 18059550, 'Gabriel David', 'Toro Caballeros', '2017-07-20', 'M', '4', '17', 18059550, 'uploads/jugadores/jugador_18059550.jpg'),
(69, NULL, 18288446, 'kevin Dair', 'Moreno Arcila', '2016-02-27', 'M', '4', '22', 18288446, 'uploads/jugadores/jugador_18288446.jpg'),
(70, NULL, 18838529, 'Luciano Sahir', 'Sanchez', '2021-10-10', 'M', '2', '27', 18838529, 'uploads/jugadores/jugador_18838529.jpg'),
(71, NULL, 20159753, 'Albert', 'Quinterito', '2020-08-13', 'M', '2', 'asdasdasd', 30506910, 'uploads/jugadores/jugador_20159753.jpg'),
(72, NULL, 20407704, 'Gleibies Asdrubal', 'Briceño Hernandez', '2019-10-28', 'M', '3', '17', 20407704, 'uploads/jugadores/jugador_20407704.jpg'),
(73, NULL, 24556919, 'Ericson Gabriel', 'Paredes Parra', '2016-07-13', 'M', '4', '15', 24556919, 'uploads/jugadores/jugador_24556919.jpg'),
(74, NULL, 24823722, 'Liam Alesandro', 'Salas Casrillo', '2019-02-11', 'M', '3', '23', 24823722, 'uploads/jugadores/jugador_24823722.jpg'),
(76, NULL, 25838800, 'Dylan Josueth', 'Duran Guerrero', '2018-01-02', 'M', '3', '11', 25838800, 'uploads/jugadores/jugador_25838800.jpg'),
(77, NULL, 27960593, 'Ronald Alejandro', 'Rivas Paredes', '2020-01-12', 'M', '2', '26', 27960593, 'uploads/jugadores/jugador_27960593.jpg'),
(78, NULL, 30506910, 'Albert', 'Quintero', '2010-08-13', 'M', '3', 'asdasdasdasd', 30506910, 'uploads/jugadores/jugador_30506910.jpg'),
(79, NULL, 33332901, 'Diemar', 'Santiago', '2019-03-12', 'F', '3', '12', 10191733, 'uploads/jugadores/jugador_36232289.jpg'),
(80, NULL, 36232289, 'Estaban Andres', 'Rondon Parra', '2014-02-09', 'M', '5', '22', 24556919, 'uploads/jugadores/jugador_36232289.jpg'),
(81, NULL, 36413176, 'Denjasuack Oneyber', 'Montilva Uzcategui', '2014-11-17', 'M', '5', '12', 20409758, 'uploads/jugadores/jugador_36413176.jpg'),
(82, NULL, 36662131, 'Santiago Andres', 'Ramrez Garcia', '2014-09-19', 'M', '5', '23', 18558356, 'uploads/jugadores/jugador_36662131.jpg'),
(83, NULL, 37302886, 'Asdrubal Moises', 'Briceño Sulbaran', '2016-04-20', 'M', '4', '20', 20407704, 'uploads/jugadores/jugador_37302886.jpg');

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
(8, 'Mensualidad Prueba', 'Septiembre', 200, '2025-11-20'),
(9, 'Uniformes 2025', 'si, uniformes jajjjajja', 100, '2025-11-20');

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
  `estado` enum('pendiente','verificado','rechazado','espera') DEFAULT 'pendiente',
  `metodo_pago` varchar(50) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_pago`, `representante_id`, `monto`, `fecha_pago`, `estado`, `metodo_pago`, `referencia`, `concepto`, `foto`) VALUES
(9, 8, 14776478, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(10, 8, 16126186, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(11, 8, 16189962, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(12, 8, 18059550, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(13, 8, 18288446, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(14, 8, 18838529, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(15, 8, 30506910, 200.00, '0123-03-12', 'verificado', 'pago_movil', '123123123123', 'Mensualidad', 'uploads/pagos/comp_691e9dc21bbd1_189750655_bddd4c16-bedf-4696-8ff7-38e5072df9f0.jpeg'),
(16, 8, 20407704, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(17, 8, 24556919, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(18, 8, 24823722, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(19, 8, 25838800, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(20, 8, 27960593, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(21, 8, 30194545, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(22, 8, 10191733, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(23, 9, 20407704, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(24, 9, 24823722, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(25, 9, 25838800, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(26, 9, 30506910, 0.00, '0000-00-00', 'espera', NULL, NULL, NULL, NULL),
(27, 9, 10191733, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(28, 9, 24556919, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(29, 9, 20409758, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL),
(30, 9, 18558356, 0.00, '0000-00-00', 'pendiente', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_categoria`
--

CREATE TABLE `pago_categoria` (
  `id` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_categoria`
--

INSERT INTO `pago_categoria` (`id`, `id_pago`, `id_categoria`) VALUES
(29, 8, 2),
(30, 8, 3),
(31, 8, 4),
(32, 9, 3),
(33, 9, 5),
(34, 9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_partido` date NOT NULL,
  `completo` int(11) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id`, `nombre`, `descripcion`, `fecha_partido`, `completo`, `creado_en`) VALUES
(46, 'asdasda', 'sdasdasdas\r\ndas\r\ndas\r\nda\r\nsda\r\ns\r\nasd', '0000-00-00', 0, '2025-11-19 02:20:01'),
(47, 'asdasd', 'asdasdsd\r\nasd\r\nasd\r\nasd\r\nas\r\ndas\r\nd', '2003-08-13', 0, '2025-11-19 02:21:44'),
(48, 'Agua Dulce vs Barineses', 'asdasdsd\r\nasd\r\nasd\r\nasd\r\nas\r\ndas\r\nd', '2003-08-13', 1, '2025-11-19 02:25:44'),
(49, 'Agua Dulce vs Barinese', 'Llevar comida', '2026-02-13', 1, '2025-11-19 02:26:23'),
(50, 'Agua Dulce vs Barineses', 'Llevar comida', '2026-08-13', 0, '2025-11-19 02:27:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_categorias`
--

CREATE TABLE `partido_categorias` (
  `id_partido` int(11) NOT NULL,
  `id_categoria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partido_categorias`
--

INSERT INTO `partido_categorias` (`id_partido`, `id_categoria`) VALUES
(46, '2'),
(46, '3'),
(46, '6'),
(47, '2'),
(47, '3'),
(47, '6'),
(47, '8'),
(48, '2'),
(48, '3'),
(48, '6'),
(48, '8'),
(49, '2'),
(50, '2'),
(50, '5');

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
(10, 'Albert Quintero', '2003-08-13', '30506910', '04145099039', 'albertq703@gmail.com', '', 'uploads/representantes/representante_30506910.jpg', NULL, '$2y$10$7HF8vfbYkF0SpVlZW53RkOfSNXj77HWVayUvfMJ7KfiX3.Z7dHMjO'),
(12, 'Evelyn Yudexis Sulbaran Salazar', '1991-12-18', '20407704', '04245964099', 'g1325272@gmail.com', '', 'uploads/representantes/representante_20407704.jpg', NULL, '$2y$10$IVrDktZf5K6Ul/i7QJ6rbeQZiZ5/U7qUg7IG9gRgSL74l5WMZAXDS'),
(13, 'Eudys Andreina Peña Ramirez', '2000-10-23', '27960593', '04125323294', 'i52117261@gmail.com', '', 'uploads/representantes/representante_27960593.jpg', NULL, '$2y$10$UYoEd/p8sCUeFK559Y4HNe1Y2u50gpSgjAI8Rip4ArFmUa.ROHDKa'),
(14, 'Martin Amado Moreno Barazarte', '1981-11-27', '18288446', '04145099039', 'i52117261+gy@gmail.com', 'Barinas', 'uploads/representantes/representante_18288446.jpg', NULL, '$2y$10$R8Em4tkkBPRy/MptYOw6C.1IA1mcETDlmtzA4LIJWp3SiHU/a3lYm'),
(15, 'Eliana Carolina Garcia Uzcategui', '1985-03-06', '18558356', '04245964099', 'valliomr31+we@gmail.com', '', 'uploads/representantes/representante_18558356.jpg', NULL, '$2y$10$YkJ39DBUTNyeAQryM8CcYesj2S8agVTLyaUSRQW5.rjWg4harlvcq'),
(16, 'Isaura Yanett Sanchez Rojas', '1988-10-13', '18838529', '04125323294', 'i52117261+jop@gmail.com', '', 'uploads/representantes/representante_18838529.jpg', NULL, '$2y$10$6EhJMjhdoCGctUHeSE.8ru08FEpuhytnD3yj.UY9lLTM.ZBMhkTzW'),
(17, 'Masaly Andreina Duran Guerrero', '1997-09-24', '25838800', '04245964099', 'g1325272+rt@gmail.com', '', 'uploads/representantes/representante_25838800.jpg', NULL, '$2y$10$3DtfZFL3m.vBHr/EDSXu5O2G0ZdnRBv1rpqKnfLPm6WlpfF.mDXni'),
(18, 'Maria Gabriela Caballeros Perez', '1987-05-03', '18059550', '04165026813', 'diemarsantiago+io@gmail.com', '', 'uploads/representantes/representante_18059550.jpg', NULL, '$2y$10$C7AKzMFrGgswWWWXnopeTudlpZXSR6OkeIKdvQJrYOKIl0L5h.Qx2'),
(19, 'Yaneidy del Valle Uzcategui Lobo', '1990-07-02', '20409758', '04165026813', 'g1325272+ik@gmail.com', '', 'uploads/representantes/representante_20409758.jpg', NULL, '$2y$10$VhhoMJroSsJOkXkCCboRy.91TI3kEyhbk4FWx3MUroyb/XEjjjZjC'),
(20, 'Betsy del Valle Rivas Rojas', '1979-01-17', '16126186', '04145099039', 'i52117261+ss@gmail.com', '', 'uploads/representantes/representante_16126186.jpg', NULL, '$2y$10$oA1JLZt7Pshl6vSCEMSTue1l1bxvdjEOTwXbxWAwZC5JuCoa.IHvG'),
(21, 'Maria  de los Angeles Castillo Peña', '1995-03-07', '24823722', '04145099039', 'valliomr31@gmail.com', '', 'uploads/representantes/representante_24823722.jpg', NULL, '$2y$10$pt5ifKN4AlgUozkJ.oYZL.o03jeykCKH37Y3BtoOkBg6XOI.sX96S'),
(22, 'Maria Beatriz Parra Paredes', '1995-11-16', '24556919', '04145099039', 'violettab722@gmail.com', '', 'uploads/representantes/representante_24556919.jpg', NULL, '$2y$10$MfXZP9vGf2Ak88wIr0.e0O9.uA/j8nGtJQxZuvFHRjVxaRyUUwwBu'),
(23, 'Carlos Alberto Albarran Briceño', '1983-07-15', '16189962', '04245964099', 'violettab722+as@gmail.com', '', 'uploads/representantes/representante_16189962.jpg', NULL, '$2y$10$iViV82gKfcX1SPcDtBqlw.rr8yowDMRIKs2meSHvcBa9ZLsIGaddy'),
(24, 'Albert Quintero', '2020-08-13', '30506123', '04145099039', 'albertq703+gg@gmail.com', '', 'uploads/representantes/representante_30506123.jpg', NULL, '$2y$10$7HF8vfbYkF0SpVlZW53RkOfSNXj77HWVayUvfMJ7KfiX3.Z7dHMjO');

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
-- Indices de la tabla `estadisticas_partidos`
--
ALTER TABLE `estadisticas_partidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `pago_categoria`
--
ALTER TABLE `pago_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido_categorias`
--
ALTER TABLE `partido_categorias`
  ADD PRIMARY KEY (`id_partido`,`id_categoria`);

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
-- AUTO_INCREMENT de la tabla `estadisticas_partidos`
--
ALTER TABLE `estadisticas_partidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `lista_pagos`
--
ALTER TABLE `lista_pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `pago_categoria`
--
ALTER TABLE `pago_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partido_categorias`
--
ALTER TABLE `partido_categorias`
  ADD CONSTRAINT `partido_categorias_ibfk_1` FOREIGN KEY (`id_partido`) REFERENCES `partidos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
