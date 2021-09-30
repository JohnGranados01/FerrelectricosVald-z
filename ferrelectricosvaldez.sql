-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 30-09-2021 a las 01:10:17
-- Versión del servidor: 5.7.28
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferrelectricosvaldez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `identificacion` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  PRIMARY KEY (`identificacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`identificacion`, `nombre`, `apellidos`, `direccion`, `correo`, `telefono`) VALUES
(23582089, 'quien pregunta', 'Granados Salamanca', 'cll 11 B # 17-13', 'jhon.granados@uptc.edu.co', 333),
(1057610935, 'john', 'Granados Salamanca', 'cll 11 B # 17-13', 'jhon.granados@uptc.edu.co', 333),
(1, 'lina', 'Granados Salamanca', 'cll 11 B # 17-13', 'jhongranadossalamanca@gmail.com', 333),
(9873, 'milton', 'granaods', 'uyr', 'jh@f.com', 321456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE IF NOT EXISTS `comprobante` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cliente` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

DROP TABLE IF EXISTS `detallecompra`;
CREATE TABLE IF NOT EXISTS `detallecompra` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comprobanteId` int(10) NOT NULL,
  `itemId` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `total` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `Id` varchar(12) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`Id`, `nombre`, `descripcion`, `precio`) VALUES
('345', 'gvh', 'gcvhn', 45),
('345', 'puntilla', 'gcvhn', 463),
('123', 'metro', 'gcvhn', 300),
('678', 'chazo', 'pieza de acero inoxidable', 70),
('1002', 'pintura', 'vinilo', 4567),
('2335', 'alambre', 'pieza de cobre', 32000),
('987', 'silicona', '2', 2),
('33', 'pegante', 'boxer', 2500),
('1002', 'cinta', '', 3000),
('111', 'jabon', '', 1500),
('098765', 'boxer para delincuentes', 'malo para la salud', 2000),
('1q', 'peganteas', 's', 213);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`) VALUES
(1, 'john', '$2y$10$w2xRTu3lxYQMWAvs6qg5/eHJC3qB1vsAol8v25.BODLUl6wRKU0km'),
(9, 'john', '$2y$10$dmHeTa6.TuMDTpSu9pPLZOMoI5i3ITBnL28Xkxwdywh2iqlIvo8I2'),
(8, 'test', '$2y$10$tFppmJEusEvSn2Dpuf7hhuCJstjUvtCjNY3fQUM/fDmroY71CYkLa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
