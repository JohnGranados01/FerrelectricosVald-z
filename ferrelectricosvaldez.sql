-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 06-10-2021 a las 21:05:31
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
  `telefono` int(13) NOT NULL,
  PRIMARY KEY (`identificacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`identificacion`, `nombre`, `apellidos`, `direccion`, `correo`, `telefono`) VALUES
(23581636, 'angelica', 'Salamanca', 'cll 15 9-56', 'angelica@gmail.com', 31212),
(1057610935, 'john', 'Granados Salamanca', 'cll 11 B # 17-13', 'jhon.granados@uptc.edu.co', 333),
(1558966, 'lina', 'Granados Salamanca', 'cll 11 B # 17-13', 'linalorena@gmail.com', 316846780),
(4277669, 'milton', 'granados Ochoa', 'crr 9 5 sur', 'miltonMago@gmail.com', 311238065);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE IF NOT EXISTS `comprobante` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `idCliente` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `fecha`, `idCliente`) VALUES
(41, '2021-10-06', 1558966),
(40, '2021-10-06', 4277669),
(39, '2021-10-06', 23581636),
(32, '2021-10-03', 1057610935),
(33, '2021-10-05', 1),
(38, '2021-10-05', 1057610935);

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
  PRIMARY KEY (`id`),
  KEY `comprobanteId` (`comprobanteId`),
  KEY `itemId` (`itemId`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`id`, `comprobanteId`, `itemId`, `cantidad`, `total`) VALUES
(1, 32, 111, 2, 50),
(2, 32, 987, 10, 50),
(6, 34, 111, 4, 30),
(5, 34, 123, 4, 30),
(11, 38, 123, 2, 600),
(12, 38, 123, 2, 600),
(13, 38, 1, 3, 15000),
(14, 38, 1, 3, 15000),
(15, 39, 123, 1, 300),
(16, 39, 2335, 2, 64000),
(17, 39, 111, 1, 1500),
(18, 40, 1, 2, 10000),
(19, 40, 987, 12, 24),
(20, 40, 678, 15, 1050),
(21, 41, 1, 1, 5000),
(22, 41, 123, 1, 300),
(23, 41, 33, 1, 2500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `Id` int(12) NOT NULL,
  `denominacion` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `precio` int(10) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`Id`, `denominacion`, `descripcion`, `precio`) VALUES
(123, 'metro', '10 mts', 300),
(678, 'chazo', 'pieza de acero inoxidable', 70),
(2335, 'alambre', 'pieza de cobre', 32000),
(987, 'silicona', '2', 2),
(33, 'pegante', 'boxer', 2500),
(111, 'jabon', 'liquido desinfectante', 1500),
(1, 'puntilla bareta N5', 'Kilo', 5000);

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
