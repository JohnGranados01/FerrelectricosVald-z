-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 03-10-2021 a las 04:11:39
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
  `idCliente` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `fecha`, `idCliente`) VALUES
(1, '2021-09-01', 1057610935),
(2, '2021-09-07', 1057610935),
(3, '2021-10-01', 1057610935),
(4, '2021-10-01', 2),
(5, '2021-10-01', 2),
(6, '2021-10-01', 2),
(7, '2021-10-01', 2),
(8, '2021-10-01', 2),
(9, '2021-10-01', 2),
(10, '2021-10-02', 1057610935),
(11, '2021-10-02', 23582089),
(12, '2021-10-02', 23582089),
(13, '2021-10-02', 23582089),
(14, '2021-10-02', 23582089),
(15, '2021-10-02', 1057610935),
(16, '2021-10-02', 1057610935),
(17, '2021-10-02', 1),
(18, '2021-10-02', 1),
(19, '2021-10-02', 1),
(20, '2021-10-02', 9873),
(21, '2021-10-02', 9873),
(22, '2021-10-02', 9873),
(23, '2021-10-02', 1),
(24, '2021-10-02', 1057610935),
(25, '2021-10-02', 1057610935),
(26, '2021-10-03', 1057610935),
(27, '2021-10-03', 1057610935),
(28, '2021-10-03', 1057610935),
(29, '2021-10-03', 1057610935),
(30, '2021-10-03', 1),
(31, '2021-10-03', 9873),
(32, '2021-10-03', 1057610935);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`id`, `comprobanteId`, `itemId`, `cantidad`, `total`) VALUES
(1, 32, 111, 2, 0),
(2, 32, 987, 10, 0);

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
