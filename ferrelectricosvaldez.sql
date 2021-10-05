-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-10-2021 a las 18:36:07
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `idCliente` int(10) NOT NULL,
  `Total` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `fecha`, `idCliente`, `Total`) VALUES
(1, '2021-09-01', 1057610935, 0),
(3, '2021-10-01', 1057610935, 0),
(5, '2021-10-01', 2, 0),
(6, '2021-10-01', 2, 0),
(16, '2021-10-02', 1057610935, 0),
(18, '2021-10-02', 1, 0),
(19, '2021-10-02', 1, 0),
(21, '2021-10-02', 9873, 0),
(22, '2021-10-02', 9873, 0),
(23, '2021-10-02', 1, 0),
(24, '2021-10-02', 1057610935, 0),
(25, '2021-10-02', 1057610935, 0),
(26, '2021-10-03', 1057610935, 0),
(27, '2021-10-03', 1057610935, 0),
(28, '2021-10-03', 1057610935, 0),
(29, '2021-10-03', 1057610935, 0),
(30, '2021-10-03', 1, 0),
(31, '2021-10-03', 9873, 0),
(32, '2021-10-03', 1057610935, 0),
(33, '2021-10-05', 1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`id`, `comprobanteId`, `itemId`, `cantidad`, `total`) VALUES
(1, 32, 111, 2, 0),
(2, 32, 987, 10, 0),
(6, 34, 111, 4, 0),
(5, 34, 123, 4, 0);

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
(123, 'metro', 'gcvhn', 300),
(678, 'chazo', 'pieza de acero inoxidable', 70),
(2335, 'alambre', 'pieza de cobre', 32000),
(987, 'silicona', '2', 2),
(33, 'pegante', 'boxer', 2500),
(111, 'jabon', '', 1500),
(98765, 'boxer para delincuentes', 'malo para la salud', 2000);

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
