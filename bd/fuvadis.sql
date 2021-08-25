-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2021 a las 20:25:06
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fuvadis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_beneficiarios`
--

CREATE TABLE `registro_beneficiarios` (
  `id_persona` int(11) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `nacionalidad` varchar(25) NOT NULL,
  `estatus_migratorio` varchar(25) NOT NULL,
  `tipo_documento` varchar(25) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `forma_empleo` varchar(25) NOT NULL,
  `rango_ingresos` varchar(50) NOT NULL,
  `num_comidas_dia` varchar(20) NOT NULL,
  `lgbti` varchar(15) NOT NULL,
  `trabajo_sexual` varchar(15) NOT NULL,
  `condicion_salud` varchar(20) NOT NULL,
  `departamento` varchar(20) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `barrio` varchar(20) NOT NULL,
  `situacion_vivienda` varchar(30) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `telefono2` bigint(20) NOT NULL,
  `num_integrantes` int(10) NOT NULL,
  `num_ninos` int(10) NOT NULL,
  `num_adultos` int(10) NOT NULL,
  `num_discapacidad` int(10) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `num_documento` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_beneficiarios`
--

INSERT INTO `registro_beneficiarios` (`id_persona`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `nacionalidad`, `estatus_migratorio`, `tipo_documento`, `fecha_nacimiento`, `genero`, `email`, `forma_empleo`, `rango_ingresos`, `num_comidas_dia`, `lgbti`, `trabajo_sexual`, `condicion_salud`, `departamento`, `municipio`, `direccion`, `barrio`, `situacion_vivienda`, `telefono`, `telefono2`, `num_integrantes`, `num_ninos`, `num_adultos`, `num_discapacidad`, `descripcion`, `fecha_registro`, `num_documento`) VALUES
(1, 'Lauren', 'Sofia', 'Guerra', 'Martinez', 'Colombiana', 'irregular', 'cedula', '0000-00-00', 'femenino', 'fefef@gmail.com', 'formal', 'mayor a 10 milloes', '34', 'no', 'si', 'bien', 'sucre', 'sincelejo', 'calle 7790 #56-8', 'la peña', 'mala', 2323232, 23323232, 10, 9, 1, 2, 'soy madre de familia migrante y necesito ayuda urgente.', '2021-04-17 20:53:15', 0),
(2, 'Lauren', 'Sofia', 'Guerra', 'Martinez', 'Colombiana', 'irregular', 'cedula', '2011-04-06', 'femenino', 'fefef@gmail.com', 'formal', 'mayor a 10 milloes', '34', 'no', 'si', 'bien', 'sucre', 'sincelejo', 'calle 7790 #56-8', 'la peña', 'mala', 2323232, 23323232, 10, 9, 1, 2, 'estoy embarazada y necesito ayuda para el aborto', '2021-04-17 20:55:46', 1212121212);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Secundario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(18, 'Francisco', 'franpautt@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 1, 1),
(19, 'rodrigo', 'rod@gmail.com', 'rodrigo', '1234', 1, 0),
(20, 'albero', 'alb@gmail.com', 'carlos', '12444', 1, 0),
(21, 'federico', 'fede@gmail.com', 'fed', 'eed8cdc400dfd4ec85dff70a170066b7', 2, 0),
(24, 'Carol Cabrer', 'acro@gmail.co', 'carol', 'a9a0198010a6073db96434f6cc5f22a8', 2, 0),
(25, 'Marvin Solares', 'Marvin@gmail.com', 'marvin', '6e4216cb092bf6b7255c00ac47f16ffe', 1, 0),
(26, 'Lauren Guerra', 'lau@gmail.com', 'lauren', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1),
(27, 'Joseph Martinez', 'josep@gmail.com', 'josep', '50c2bc6f0f354393081acb19da4de424', 1, 1),
(28, 'Grace Diaz', 'grace@gmail.com', 'graced', '0fd212ee05b0a762de8b00c94a7ec2de', 1, 1),
(29, 'lorena guzman', 'lorena@gmail.com', 'lore', 'a3d3d0e6b1810ee9f4687cbfd7ede1c8', 1, 1),
(30, 'dylan bilbao', 'dylan@gmail.com', 'dylan', 'a11e7c4c03c57acba33bddb11d04b957', 2, 0),
(31, 'Santiago Iglesias', 'santi@gmail.com', 'santi', '7abe727a57c72afe4b1839f945e29ee1', 2, 1),
(32, 'David Torres', 'david@gmail.com', 'david', '5fdc308e804c2ad2be3477f0566d20a6', 1, 1),
(33, 'Brian Dominguez', 'brian@fuvadis.com', 'brayan', '2602abbb617cf4caa851a96e875eb69b', 1, 1),
(34, 'fernando urruchurtu', 'fernando@gmail.com', 'fern', '1fcb7f5daeac7ffc67098def88ac7212', 1, 1),
(35, 'Alvaro uribe velez', 'ivan@gmail.com', 'ivanduque', '9c72446df124ddf214b698c1e2312371', 2, 1),
(36, 'Gustavo Petro', 'gus@gmail.com', 'gus', '71f396e4134a1160d90bb1439876df31', 2, 1),
(37, 'Rodolfo Hernandez', 'rodolfo@gmail.com', 'rodolfohernande', '424ac6d0ea9971286b45d14caa4e6a0d', 1, 1),
(38, 'joset guerra', 'joset@jdhdhad.com', 'joset', 'aa5d6eac8caa1b8ef62fe73ac90fc1d2', 2, 1),
(39, 'gregory', 'greg@gmail.com', 'root', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0),
(40, 'Bojack Horseman', 'bojac@hotmail.com', 'root', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0),
(41, 'Bojack Horseman', 'bojac@hotmail.com', 'bojack', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_beneficiarios`
--
ALTER TABLE `registro_beneficiarios`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro_beneficiarios`
--
ALTER TABLE `registro_beneficiarios`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario-rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
