-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2018 a las 21:57:55
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id6126726_cervesium`
--
CREATE DATABASE IF NOT EXISTS `id6126726_cervesium` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id6126726_cervesium`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cerveceria`
--

CREATE TABLE `cerveceria` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cerveceria`
--

INSERT INTO `cerveceria` (`id`, `user_id`, `nombre`, `direccion`, `telefono`) VALUES
(1, 15, 'cervesium', 'Francia 755', '(1234) 567-8901');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cerveceria_horarios`
--

CREATE TABLE `cerveceria_horarios` (
  `id_cerveceria` int(11) NOT NULL,
  `hora_desde` varchar(45) CHARACTER SET utf8 NOT NULL,
  `hora_hasta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cerveceria_horarios`
--

INSERT INTO `cerveceria_horarios` (`id_cerveceria`, `hora_desde`, `hora_hasta`, `id_dia`) VALUES
(1, '21:30', '00:50', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id`, `descripcion`) VALUES
(1, 'Lunes a Viernes'),
(2, 'Sabados y Domingos'),
(3, 'Todos los dias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `cerveceria_id` int(11) DEFAULT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `cerveceria_id`, `fecha_desde`, `fecha_hasta`, `descripcion`, `tipo_id`, `titulo`) VALUES
(1, 1, '2018-06-11 20:30:00', '2018-06-11 23:00:00', 'Solo por hoy 2x1 en cervezas hasta las 23hs.', 1, '2x1 en Cervezas'),
(5, 1, '2018-06-15 22:00:00', '2018-06-15 23:30:00', 'Todos los tragos estan al 50% de descuento!!', 3, '50% en tragos'),
(7, 1, '2018-06-18 20:30:00', '2018-06-18 23:00:00', 'Trae a tus amigos y si todos toman nuestra nueva cerveza, les regalamos las papas!!', 4, 'Papas gratis para vos y tus amigos'),
(8, 1, '2018-10-10 20:30:00', '2018-10-10 00:30:00', 'Si leiste bien 2x1 en tragos', 1, '2x1 en tragos'),
(9, 1, '2018-06-10 20:30:00', '2018-06-10 22:30:00', 'Comete unos buenos nachos con la compra de una pizza', 4, 'Nachos free');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_oferta`
--

CREATE TABLE `tipo_oferta` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `img_path` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_oferta`
--

INSERT INTO `tipo_oferta` (`id_tipo`, `desc_tipo`, `img_path`) VALUES
(1, '2x1', 'img/ofertas/2x1.png'),
(2, 'barra libre', 'img/ofertas/barralibre.png'),
(3, '50% descuento', 'img/ofertas/50off.png'),
(4, 'free', 'img/ofertas/free.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'ADMIN'),
(3, 'OWNER'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `valido` tinyint(4) NOT NULL DEFAULT '0',
  `nombre` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `hash_validacion` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `tipo`, `valido`, `nombre`, `apellido`, `email`, `hash_validacion`) VALUES
(15, 'axel', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 'axel', 'vazquez', 'axel_012@hotmail.com.ar', '7feb293dfc62b718c8990d4bd8a9f554'),
(16, 'negro', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, '1', '1', 'yoel.vzq@hotmail.com', 'b168a52cf63e7a1633188642f0a36c08'),
(17, 'axel2', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0, 'axel', 'vazquez', 'axel_1@algo', '2d2548a0757a19d46be23eeaf90b7c49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cerveceria`
--
ALTER TABLE `cerveceria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `cerveceria_horarios`
--
ALTER TABLE `cerveceria_horarios`
  ADD KEY `id_dia_idx` (`id_dia`),
  ADD KEY `id_cerv_idx` (`id_cerveceria`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_oferta`
--
ALTER TABLE `tipo_oferta`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `nombre` (`usuario`),
  ADD KEY `tipo_idx` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cerveceria`
--
ALTER TABLE `cerveceria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cerveceria`
--
ALTER TABLE `cerveceria`
  ADD CONSTRAINT `cerveceria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `cerveceria_horarios`
--
ALTER TABLE `cerveceria_horarios`
  ADD CONSTRAINT `id_cerv` FOREIGN KEY (`id_cerveceria`) REFERENCES `cerveceria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_dia` FOREIGN KEY (`id_dia`) REFERENCES `dias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
