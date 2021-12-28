-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-12-2021 a las 17:56:37
-- Versión del servidor: 8.0.26
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Electronica', 1, '2021-11-06 23:44:09', '2021-11-06 23:44:09'),
(2, 'Computacion', 1, '2021-11-06 23:45:40', '2021-11-06 23:45:40'),
(3, 'Automotriz', 1, '2021-11-09 01:55:13', '2021-12-16 20:58:51'),
(4, 'Telefonia', 1, '2021-11-09 01:56:53', '2021-11-09 01:56:53'),
(5, 'Ejemplo', 1, '2021-11-09 01:57:44', '2021-11-09 01:57:44'),
(6, 'ejenmplo', 1, '2021-11-09 01:58:20', '2021-11-09 01:58:20'),
(7, 'Ejemplo 3', 1, '2021-11-09 01:59:36', '2021-11-09 01:59:36'),
(8, 'Ejemplo 5', 1, '2021-11-09 02:00:49', '2021-11-09 02:00:49'),
(9, 'otro ejemplo', 1, '2021-11-09 02:05:23', '2021-11-09 02:05:23'),
(10, 'EJEMPLOAA', 1, '2021-11-18 02:44:23', '2021-11-18 02:44:23'),
(11, 'SADAWDASDWAWDSA', 1, '2021-11-18 02:44:30', '2021-11-18 02:44:30'),
(12, 'DSADWADSADFFVVVVV', 1, '2021-11-18 02:44:35', '2021-11-18 02:44:35'),
(13, 'Muebles', 1, '2021-12-03 04:50:51', '2021-12-03 04:50:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_ventas`
--

DROP TABLE IF EXISTS `datos_ventas`;
CREATE TABLE IF NOT EXISTS `datos_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` text NOT NULL,
  `imagen` text NOT NULL,
  `id_venta` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_datos_ventas_idx` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_ventas`
--

INSERT INTO `datos_ventas` (`id`, `numero`, `imagen`, `id_venta`, `created_at`) VALUES
(1, '1234567895', '1640704656.png', 1, '2021-12-28 21:17:36'),
(2, '798456313', '1640704712.png', 2, '2021-12-28 21:18:32'),
(3, '1234567892', '1640704758.png', 3, '2021-12-28 21:19:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Ahuachapán', NULL, NULL),
(2, 'Cabañas', NULL, NULL),
(3, 'Chalatenango', NULL, NULL),
(4, 'Cuscatlán', NULL, NULL),
(5, 'La Libertad', NULL, NULL),
(6, 'La Paz', NULL, NULL),
(7, 'La Unión', NULL, NULL),
(8, 'Morazán', NULL, NULL),
(9, 'San Miguel', NULL, NULL),
(10, 'San Salvador', NULL, NULL),
(11, 'San Vicente', NULL, NULL),
(12, 'Santa Ana', NULL, NULL),
(13, 'Sonsonate', NULL, NULL),
(14, 'Usulután', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_venta` int NOT NULL,
  `cantidad` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_producto`, `id_venta`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 1, '2021-12-28 21:17:36', '2021-12-28 21:17:36'),
(2, 10, 1, 1, '2021-12-28 21:17:36', '2021-12-28 21:17:36'),
(3, 9, 1, 1, '2021-12-28 21:17:36', '2021-12-28 21:17:36'),
(4, 16, 2, 1, '2021-12-28 21:18:32', '2021-12-28 21:18:32'),
(5, 13, 3, 1, '2021-12-28 21:19:18', '2021-12-28 21:19:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facturacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `referencia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_municipio` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direcciones_id_user_foreign` (`id_user`),
  KEY `direcciones_id_municipio_foreign` (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `direccion`, `first_name`, `last_name`, `email`, `facturacion`, `referencia`, `telefono`, `id_user`, `id_municipio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'por ahi en una calle del bazar col uno', 'Jose Antonio', 'Alas Alvarenga', 'example@example.com', 'por ahi en una calle del bazar col uno', 'por el poste de la derecha', '12345678', 1, 1, NULL, NULL, NULL),
(3, 'por ahi en una calle del bazar col uno', 'Jose Antonio', 'Alas Alvarenga', 'example@example.com', 'por ahi en una calle del bazar col uno facturacion', NULL, '12345678', 7, 1, NULL, NULL, NULL),
(4, 'Direccion de prueba 2 kk', 'Diego Uriel', 'Martinez', 'admin@gmail.com', 'Direccion de prueba 2 facturacion', 'A la par del dollar city', '23659856', 7, 26, '2021-11-23 03:45:52', '2021-11-23 03:45:52', NULL),
(5, 'cas canyuco', 'Diego Uriel', 'Martinez', 'admin@gmail.com', 'cas canyuco facturacion', 'A la par de la tiendita ayala', '12345678', 7, 26, '2021-12-02 03:18:45', '2021-12-02 03:18:45', NULL),
(6, 'Chalatenango, El barrio san juan', 'Diego Uriel', 'Martinez', 'admin@gmail.com', 'Chalatenango, El barrio san juan facturacion', NULL, '123456789', 7, 210, '2021-12-02 03:23:05', '2021-12-02 03:23:05', NULL),
(7, 'dddddd', 'jose', 'alas', 'example@example.com', NULL, NULL, '12345678', 1, 224, '2021-12-03 03:57:45', '2021-12-03 03:57:45', NULL),
(8, 'upps', 'joseeee', 'alaas', 'example@example.com', NULL, NULL, '123456789', 1, 211, '2021-12-03 04:54:36', '2021-12-03 04:54:36', NULL),
(9, 'cas canyuco', 'jose', 'sdfsd', 'example@example.com', NULL, NULL, '12345678', 1, 224, '2021-12-03 04:55:09', '2021-12-03 04:55:09', NULL),
(10, 'dddddd cas', 'joseeee', 'kata', 'example@example.com', NULL, NULL, '12345678', 1, 224, '2021-12-03 04:55:59', '2021-12-03 04:55:59', NULL),
(11, 'cas canyuco 21', 'jose', 'alas', 'alas@example.com', NULL, NULL, '12345678', 1, 240, '2021-12-03 04:57:37', '2021-12-03 04:57:37', NULL),
(12, 'cas canyuco 31', 'joseeee', 'kata', 'example@example.com', NULL, NULL, '12345678', 1, 224, '2021-12-03 04:58:38', '2021-12-03 04:58:38', NULL),
(13, 'cas canyuco 14', 'joseeee', 'kata', 'example@example.com', NULL, NULL, '12345678', 1, 211, '2021-12-04 01:47:17', '2021-12-04 01:47:17', NULL),
(14, 'cas canyuco 144', 'joseeee', 'sdfsd', 'example@example.com', NULL, NULL, '12345678', 1, 1, '2021-12-04 01:50:25', '2021-12-04 01:50:25', NULL),
(15, 'cas canyuco  5555', 'orengun', 'alas', 'example@example.com', NULL, NULL, '12345678', 1, 133, '2021-12-04 02:15:47', '2021-12-04 02:15:47', NULL),
(16, '1234657', 'joseeee', 'alas', 'example@example.com', NULL, NULL, '12345678', 1, 159, '2021-12-04 02:43:04', '2021-12-04 02:43:04', NULL),
(17, '1235893', 'ss123', 'alas', 'example@example.com', NULL, NULL, '12345678', 1, 218, '2021-12-07 23:49:59', '2021-12-07 23:49:59', NULL),
(18, 'El pedregal', 'Jose', 'Antonio', 'example@example.com', NULL, NULL, '12345678', 1, 26, '2021-12-07 23:56:53', '2021-12-07 23:56:53', NULL),
(19, 'calle a san bartolo', 'joseeee', 'alas', 'zerodrieswolf@gmail.com', NULL, NULL, '12345678', 1, 179, '2021-12-08 02:18:03', '2021-12-08 02:18:03', NULL),
(21, 'jlhagdhjweavdgavdgwvgdvasvdhvahgwvdavdhvavdwvadvhavhgwvhgdav', 'Diego', 'Martinez', 'icanva45@gmail.com', 'por ahi donde don juan', NULL, '89698569', 21, 34, '2021-12-17 04:35:14', '2021-12-17 04:35:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

DROP TABLE IF EXISTS `inventarios`;
CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_descuento` decimal(10,2) DEFAULT NULL,
  `codigo` varchar(500) NOT NULL,
  `stock` int NOT NULL,
  `min_stock` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_oferta` int DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_inventarios_productos` (`id_producto`),
  KEY `fk_inventarios_ofertas` (`id_oferta`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `precio_compra`, `precio_venta`, `precio_descuento`, `codigo`, `stock`, `min_stock`, `id_producto`, `id_oferta`, `estado`, `created_at`, `updated_at`) VALUES
(1, '80.55', '210.50', NULL, 'AAS45WAD66', 150, 30, 7, 1, 1, '2021-11-17 21:54:34', '2021-12-17 04:21:33'),
(2, '100.00', '150.00', NULL, 'LDLA6464AAP', 1, 0, 8, 1, 1, '2021-11-20 03:01:47', '2021-12-11 01:29:33'),
(3, '1200.00', '1350.00', NULL, 'ALLLPPPP55', 50, 10, 10, NULL, 1, '2021-11-30 02:25:50', '2021-12-17 04:21:22'),
(4, '99.00', '120.00', NULL, 'AA896556AQ', 295, 0, 9, 1, 1, '2021-11-30 02:31:22', '2021-12-28 21:53:21'),
(5, '85.00', '105.00', NULL, 'A556EERSA7', 73, 0, 11, 1, 1, '2021-11-30 02:38:10', '2021-12-16 03:09:04'),
(6, '699.00', '899.00', NULL, 'WR8QJKIO88', 19, 0, 12, 1, 1, '2021-12-03 04:44:54', '2021-12-10 23:18:55'),
(7, '400.00', '800.00', NULL, 'QWER569ANH', 1, 0, 14, 1, 1, '2021-12-03 05:15:42', '2021-12-04 03:04:14'),
(8, '350.00', '550.00', NULL, 'LPIOVTY563', 48, 0, 13, 1, 1, '2021-12-03 05:17:29', '2021-12-28 21:53:15'),
(9, '800.00', '1500.00', NULL, 'P8IALPZ789', 20, 10, 15, 1, 1, '2021-12-03 09:25:43', '2021-12-28 22:32:57'),
(10, '616.00', '1600.00', NULL, 'ALP89321QPO', 88, 0, 16, NULL, 1, '2021-12-03 10:37:55', '2021-12-28 21:53:18'),
(11, '40.00', '99.00', NULL, '0SDQPLO456', 40, 20, 17, 1, 1, '2021-12-13 23:28:11', '2021-12-13 23:46:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', '1636139103.png', 1, '2021-11-06 07:05:03', '2021-11-29 22:57:48'),
(2, 'Dell', '1636150932.png', 1, '2021-11-06 07:06:55', '2021-11-29 22:57:40'),
(4, 'Bosch', '1638205049.png', 1, '2021-11-11 02:24:44', '2021-11-29 22:57:29'),
(5, 'Canon', '1638205128.png', 1, '2021-11-29 22:58:48', '2021-11-29 22:58:48'),
(6, 'Hp', '1638205184.png', 1, '2021-11-29 22:59:44', '2021-11-29 22:59:44'),
(7, 'Sony', '1638205198.png', 1, '2021-11-29 22:59:58', '2021-11-29 22:59:58'),
(8, 'Gucci', '1638205493.png', 1, '2021-11-29 23:04:53', '2021-11-29 23:04:53'),
(9, 'Asus', '1638206132.png', 1, '2021-11-29 23:09:26', '2021-12-17 03:24:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pagos`
--

DROP TABLE IF EXISTS `metodos_pagos`;
CREATE TABLE IF NOT EXISTS `metodos_pagos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `numero` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuenta_asociado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodos_pagos`
--

INSERT INTO `metodos_pagos` (`id`, `nombre`, `qr`, `numero`, `cuenta_asociado`, `estado`, `created_at`, `updated_at`) VALUES
(5, 'Chivo Wallet', '[\"Screenshot_20211201-095700.png\",\"Screenshot_20211201-102056.png\"]', NULL, 'Jose Antonio Alas A.', 1, '2021-12-01 22:54:34', '2021-12-09 01:40:55'),
(6, 'Banco Agricola', '[\"Screenshot_20211201-095700.png\"]', '123456789123456789123699999', 'Jos Anto Alas A.', 1, '2021-12-01 22:59:50', '2021-12-16 03:05:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_12_01_145412_create_metodos_pagos_table', 1),
(2, '2021_12_06_165524_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departamento` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipios_id_departamento_foreign` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `id_departamento`, `created_at`, `updated_at`) VALUES
(1, 'Ahuachapán', 1, NULL, NULL),
(2, 'Apaneca', 1, NULL, NULL),
(3, 'Atiquizaya', 1, NULL, NULL),
(4, 'Concepción de Ataco', 1, NULL, NULL),
(5, 'El Refugio', 1, NULL, NULL),
(6, 'Guaymango', 1, NULL, NULL),
(7, 'Jujutla', 1, NULL, NULL),
(8, 'San Francisco Menéndez', 1, NULL, NULL),
(9, 'San Lorenzo', 1, NULL, NULL),
(10, 'San Pedro Puxtla', 1, NULL, NULL),
(11, 'Tacuba', 1, NULL, NULL),
(12, 'Turín', 1, NULL, NULL),
(13, 'Cinquera', 2, NULL, NULL),
(14, 'Dolores', 2, NULL, NULL),
(15, 'Guacotecti', 2, NULL, NULL),
(16, 'Ilobasco ', 2, NULL, NULL),
(17, 'Jutiapa', 2, NULL, NULL),
(18, 'San Isidro', 2, NULL, NULL),
(19, 'Sensuntepeque', 2, NULL, NULL),
(20, 'Tejutepeque', 2, NULL, NULL),
(21, 'Victoria', 2, NULL, NULL),
(22, 'Agua Caliente', 3, NULL, NULL),
(23, 'Arcatao', 3, NULL, NULL),
(24, 'Azacualpa', 3, NULL, NULL),
(25, 'Cancasque', 3, NULL, NULL),
(26, 'Chalatenango', 3, NULL, NULL),
(27, 'Citalá', 3, NULL, NULL),
(28, 'Comalapa', 3, NULL, NULL),
(29, 'Concepción Quezaltepeque', 3, NULL, NULL),
(30, 'Dulce Nombre de María', 3, NULL, NULL),
(31, 'El Carrizal', 3, NULL, NULL),
(32, 'El Paraíso', 3, NULL, NULL),
(33, 'La Laguna', 3, NULL, NULL),
(34, 'La Palma', 3, NULL, NULL),
(35, 'La Reina', 3, NULL, NULL),
(36, 'Las Vueltas', 3, NULL, NULL),
(37, 'Los Ranchos', 3, NULL, NULL),
(38, 'Nombre de Jesús', 3, NULL, NULL),
(39, 'Nueva Concepción', 3, NULL, NULL),
(40, 'Nueva Trinidad', 3, NULL, NULL),
(41, 'San José Ojos de Agua', 3, NULL, NULL),
(42, 'Potonico', 3, NULL, NULL),
(43, 'San Antonio de La Cruz', 3, NULL, NULL),
(44, 'San Fernando', 3, NULL, NULL),
(45, 'San Francisco Lempa', 3, NULL, NULL),
(46, 'San Francisco Morazán', 3, NULL, NULL),
(47, 'San Ignacio', 3, NULL, NULL),
(48, 'San Isidro ', 3, NULL, NULL),
(49, 'San José Las Flores', 3, NULL, NULL),
(50, 'San Luis del Carmen', 3, NULL, NULL),
(51, 'San Miguel de Mercedes', 3, NULL, NULL),
(52, 'San Rafael', 3, NULL, NULL),
(53, 'Santa Rita', 3, NULL, NULL),
(54, 'Tejutla', 3, NULL, NULL),
(55, 'Candelaria', 4, NULL, NULL),
(56, 'Cojutepeque', 4, NULL, NULL),
(57, 'El Carmen', 4, NULL, NULL),
(58, 'El Rosario', 4, NULL, NULL),
(59, 'Monte San Juan', 4, NULL, NULL),
(60, 'Oratorio de Concepción', 4, NULL, NULL),
(61, 'San Bartolomé Perulapilla', 4, NULL, NULL),
(62, 'San Cristobal', 4, NULL, NULL),
(63, 'San José Guayabal', 4, NULL, NULL),
(64, 'San Pedro Perulapán', 4, NULL, NULL),
(65, 'San Rafael Cedros', 4, NULL, NULL),
(66, 'San Ramón', 4, NULL, NULL),
(67, 'Santa Cruz Analquito', 4, NULL, NULL),
(68, 'Santa Cruz Michapa', 4, NULL, NULL),
(69, 'Suchitoto', 4, NULL, NULL),
(70, 'Tenancingo', 4, NULL, NULL),
(71, 'Antiguo Cuscatlán', 5, NULL, NULL),
(72, 'Chiltiupán', 5, NULL, NULL),
(73, 'Ciudad Arce', 5, NULL, NULL),
(74, 'Colón', 5, NULL, NULL),
(75, 'Comasagua', 5, NULL, NULL),
(76, 'Huizúcar', 5, NULL, NULL),
(77, 'Jayaque', 5, NULL, NULL),
(78, 'Jicalapa', 5, NULL, NULL),
(79, 'La Libertad', 5, NULL, NULL),
(80, 'Nuevo Cuscatlán', 5, NULL, NULL),
(81, 'Quezaltepeque', 5, NULL, NULL),
(82, 'Sacacoyo', 5, NULL, NULL),
(83, 'San José Villanueva', 5, NULL, NULL),
(84, 'San Juan Opico', 5, NULL, NULL),
(85, 'San Matías', 5, NULL, NULL),
(86, 'San Pablo Tacachico', 5, NULL, NULL),
(87, 'Santa Tecla', 5, NULL, NULL),
(88, 'Talnique', 5, NULL, NULL),
(89, 'Tamanique', 5, NULL, NULL),
(90, 'Teotepeque', 5, NULL, NULL),
(91, 'Tepecoyo', 5, NULL, NULL),
(92, 'Zaragoza', 5, NULL, NULL),
(93, 'Cuyultitán', 6, NULL, NULL),
(94, 'El Rosario', 6, NULL, NULL),
(95, 'Jerusalen', 6, NULL, NULL),
(96, 'Mercedes la Ceiba', 6, NULL, NULL),
(97, 'Olocuilta', 6, NULL, NULL),
(98, 'Paraíso de Osorio', 6, NULL, NULL),
(99, 'San Antonio Masahuat', 6, NULL, NULL),
(100, 'San Emigdio', 6, NULL, NULL),
(101, 'San Francisco Chinameca', 6, NULL, NULL),
(102, 'San Juan Nonualco', 6, NULL, NULL),
(103, 'San Juan Talpa', 6, NULL, NULL),
(104, 'San Juan Tepezontes', 6, NULL, NULL),
(105, 'San Luis La Herradura', 6, NULL, NULL),
(106, 'San Luis Talpa', 6, NULL, NULL),
(107, 'San Miguel Tepezontes', 6, NULL, NULL),
(108, 'San Pedro Masahuat', 6, NULL, NULL),
(109, 'San Pedro Nonualco', 6, NULL, NULL),
(110, 'San Rafael Obrajuelo', 6, NULL, NULL),
(111, 'Santa María Ostuma', 6, NULL, NULL),
(112, 'Santiago Nonualco', 6, NULL, NULL),
(113, 'Tapalhuaca', 6, NULL, NULL),
(114, 'Zacatecoluca', 6, NULL, NULL),
(115, 'Anamorós', 7, NULL, NULL),
(116, 'Bolívar', 7, NULL, NULL),
(117, 'Concepción de Oriente', 7, NULL, NULL),
(118, 'Conchagua', 7, NULL, NULL),
(119, 'El Carmen', 7, NULL, NULL),
(120, 'El Sauce', 7, NULL, NULL),
(121, 'Intipucá', 7, NULL, NULL),
(122, 'La Unión', 7, NULL, NULL),
(123, 'Lislique', 7, NULL, NULL),
(124, 'Meanguera del Golfo', 7, NULL, NULL),
(125, 'Nueva Esparta', 7, NULL, NULL),
(126, 'Pasaquina', 7, NULL, NULL),
(127, 'Polorós', 7, NULL, NULL),
(128, 'San Alejo', 7, NULL, NULL),
(129, 'San José', 7, NULL, NULL),
(130, 'Santa Rosa de Lima', 7, NULL, NULL),
(131, 'Yayantique', 7, NULL, NULL),
(132, 'Yucuaiquín', 7, NULL, NULL),
(133, 'Arambala', 8, NULL, NULL),
(134, 'Cacaopera', 8, NULL, NULL),
(135, 'Chilanga', 8, NULL, NULL),
(136, 'Corinto', 8, NULL, NULL),
(137, 'Delicias de Concepción ', 8, NULL, NULL),
(138, 'El Divisadero', 8, NULL, NULL),
(139, 'El Rosario', 8, NULL, NULL),
(140, 'Gualococti', 8, NULL, NULL),
(141, 'Guatajiagua', 8, NULL, NULL),
(142, 'Joateca', 8, NULL, NULL),
(143, 'Jocoatique', 8, NULL, NULL),
(144, 'Jocoro', 8, NULL, NULL),
(145, 'Lolotiquillo', 8, NULL, NULL),
(146, 'Meanquera', 8, NULL, NULL),
(147, 'Osicala', 8, NULL, NULL),
(148, 'Perquín ', 8, NULL, NULL),
(149, 'San Carlos', 8, NULL, NULL),
(150, 'San Fernando - Morazán', 8, NULL, NULL),
(151, 'San Francisco Gotera', 8, NULL, NULL),
(152, 'San Isidro', 8, NULL, NULL),
(153, 'San Simón', 8, NULL, NULL),
(154, 'Sensembra', 8, NULL, NULL),
(155, 'Sociedad', 8, NULL, NULL),
(156, 'Torola', 8, NULL, NULL),
(157, 'Yamabal', 8, NULL, NULL),
(158, 'Yoloaiquín', 8, NULL, NULL),
(159, 'Carolina', 9, NULL, NULL),
(160, 'Chapeltique', 9, NULL, NULL),
(161, 'Chinameca', 9, NULL, NULL),
(162, 'Chirilagua', 9, NULL, NULL),
(163, 'Ciudad Barrios', 9, NULL, NULL),
(164, 'Comacarán', 9, NULL, NULL),
(165, 'El Tránsito', 9, NULL, NULL),
(166, 'Lolotique', 9, NULL, NULL),
(167, 'Moncagua', 9, NULL, NULL),
(168, 'Nueva Guadalupe', 9, NULL, NULL),
(169, 'Nuevo Eden de San Juan', 9, NULL, NULL),
(170, 'Quelepa', 9, NULL, NULL),
(171, 'San Antonio', 9, NULL, NULL),
(172, 'San Gerardo', 9, NULL, NULL),
(173, 'San Jorge', 9, NULL, NULL),
(174, 'San Luis de La Reina', 9, NULL, NULL),
(175, 'San Miguel', 9, NULL, NULL),
(176, 'San Rafael Oriente', 9, NULL, NULL),
(177, 'Sesori', 9, NULL, NULL),
(178, 'Uluazapa', 9, NULL, NULL),
(179, 'Aguilares', 10, NULL, NULL),
(180, 'Apopa', 10, NULL, NULL),
(181, 'Ayutuxtepeque', 10, NULL, NULL),
(182, 'Ciudad Delgado', 10, NULL, NULL),
(183, 'Cuscatancingo', 10, NULL, NULL),
(184, 'El Paisnal', 10, NULL, NULL),
(185, 'Guazapa', 10, NULL, NULL),
(186, 'Ilopango', 10, NULL, NULL),
(187, 'Mejicanos', 10, NULL, NULL),
(188, 'Nejapa', 10, NULL, NULL),
(189, 'Panchimalco', 10, NULL, NULL),
(190, 'Rosario de Mora', 10, NULL, NULL),
(191, 'San Marcos', 10, NULL, NULL),
(192, 'San Martín', 10, NULL, NULL),
(193, 'San Salvador', 10, NULL, NULL),
(194, 'Santiago Texacuangos', 10, NULL, NULL),
(195, 'Santo Tomas', 10, NULL, NULL),
(196, 'Soyapango', 10, NULL, NULL),
(197, 'Tonacatepeque', 10, NULL, NULL),
(198, 'Apastepeque', 11, NULL, NULL),
(199, 'Guadalupe', 11, NULL, NULL),
(200, 'San Cayetano Istepeque', 11, NULL, NULL),
(201, 'San Esteban Catarina', 11, NULL, NULL),
(202, 'San Ildefonso', 11, NULL, NULL),
(203, 'San Lorenzo', 11, NULL, NULL),
(204, 'San Sebastián', 11, NULL, NULL),
(205, 'San Vicente', 11, NULL, NULL),
(206, 'Santa Clara', 11, NULL, NULL),
(207, 'Santo Domingo', 11, NULL, NULL),
(208, 'Tecoluca', 11, NULL, NULL),
(209, 'Tepetitán', 11, NULL, NULL),
(210, 'Verapaz', 11, NULL, NULL),
(211, 'Candelaria de la Frontera', 12, NULL, NULL),
(212, 'Chalchuapa', 12, NULL, NULL),
(213, 'Coatepeque', 12, NULL, NULL),
(214, 'El Congo', 12, NULL, NULL),
(215, 'El Porvenir', 12, NULL, NULL),
(216, 'Masahuat', 12, NULL, NULL),
(217, 'Metapán', 12, NULL, NULL),
(218, 'San Antonio Pajonal', 12, NULL, NULL),
(219, 'San Sebastián Salitríllo', 12, NULL, NULL),
(220, 'Santa Ana', 12, NULL, NULL),
(221, 'Santa Rosa Guachipilín', 12, NULL, NULL),
(222, 'Santiago de la Frontera', 12, NULL, NULL),
(223, 'Texistepeque', 12, NULL, NULL),
(224, 'Acajutla', 13, NULL, NULL),
(225, 'Armenia', 13, NULL, NULL),
(226, 'Caluco', 13, NULL, NULL),
(227, 'Cuisnahuat', 13, NULL, NULL),
(228, 'Izalco', 13, NULL, NULL),
(229, 'Juayúa', 13, NULL, NULL),
(230, 'Nahuilingo', 13, NULL, NULL),
(231, 'Nahuizalco', 13, NULL, NULL),
(232, 'Salcoatitán', 13, NULL, NULL),
(233, 'San Antonio del Monte', 13, NULL, NULL),
(234, 'San Julián', 13, NULL, NULL),
(235, 'Santa Catarina Masahuat', 13, NULL, NULL),
(236, 'Santa Isabel Ishuatán', 13, NULL, NULL),
(237, 'Santo Domingo de Guzmán', 13, NULL, NULL),
(238, 'Sonsonate', 13, NULL, NULL),
(239, 'Sonzacate', 13, NULL, NULL),
(240, 'Alegría', 14, NULL, NULL),
(241, 'Berlín', 14, NULL, NULL),
(242, 'California', 14, NULL, NULL),
(243, 'Concepción Batres', 14, NULL, NULL),
(244, 'El Triunfo', 14, NULL, NULL),
(245, 'Ereguayquín', 14, NULL, NULL),
(246, 'Estanzuelas', 14, NULL, NULL),
(247, 'Jiquilisco', 14, NULL, NULL),
(248, 'Jucuapa', 14, NULL, NULL),
(249, 'Jucuarán', 14, NULL, NULL),
(250, 'Mercedes Umaña', 14, NULL, NULL),
(251, 'Nueva Granada', 14, NULL, NULL),
(252, 'Osatlán', 14, NULL, NULL),
(253, 'Puerto El Triunfo', 14, NULL, NULL),
(254, 'San Agustín', 14, NULL, NULL),
(255, 'San Buenaventura', 14, NULL, NULL),
(256, 'San Dionisio', 14, NULL, NULL),
(257, 'San Francisco Javier', 14, NULL, NULL),
(258, 'Santa Elena', 14, NULL, NULL),
(259, 'Santa María', 14, NULL, NULL),
(260, 'Santiago de María', 14, NULL, NULL),
(261, 'Tecapán', 14, NULL, NULL),
(262, 'Usulután', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03db59e1-6595-41df-a5de-73ce6ba4bd12', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":101,\"estado\":0}', '2021-12-14 01:53:28', '2021-12-14 01:53:17', '2021-12-14 01:53:17'),
('080f703b-ab48-406a-aa2c-9cb3e8f97de3', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":2,\"estado\":0}', NULL, '2021-12-28 21:18:32', '2021-12-28 21:18:32'),
('0c2d137a-e59a-482b-97e1-8fa3c524f34f', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":1,\"estado\":0}', NULL, '2021-12-28 21:17:37', '2021-12-28 21:17:37'),
('10e56f8c-2dd8-4ae5-b1ab-c27a2f6e8fc0', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":94,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 23:25:20', '2021-12-13 23:42:24'),
('10e83c88-c220-4db3-a501-930cc32d1840', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":96,\"estado\":0}', NULL, '2021-12-10 23:36:03', '2021-12-10 23:36:03'),
('11b477dd-0731-45e3-a405-69a68865ce8e', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":97,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-11 03:50:18', '2021-12-13 23:42:24'),
('161d8891-cdf5-480c-8ff8-0a662a1b3e62', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":95,\"estado\":0}', NULL, '2021-12-10 23:32:58', '2021-12-10 23:32:58'),
('16a99ca8-8716-4556-b562-db9aebd8f249', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":9}', '2021-12-28 22:32:30', '2021-12-28 21:53:21', '2021-12-28 21:53:21'),
('17c41504-e8f1-4de8-9f99-b3263ec9afdc', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":79,\"estado\":0}', NULL, '2021-12-07 03:58:40', '2021-12-07 03:58:40'),
('1836d377-8e0d-41f4-80e3-b93abfb46b2a', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":83,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 23:54:05', '2021-12-13 23:42:24'),
('18bbda6a-8b86-4dd3-9b80-e2619b99a94b', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":92,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 22:56:37', '2021-12-13 23:42:24'),
('24507c8a-a1ec-4da8-a4ff-6b98a029b4e2', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":93,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 23:23:45', '2021-12-13 23:42:24'),
('26b550a3-482a-4374-8733-7577eedef9c9', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":106,\"estado\":0}', NULL, '2021-12-17 04:35:14', '2021-12-17 04:35:14'),
('28768feb-2a99-4301-853a-d63bed0047b3', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":95,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 23:32:58', '2021-12-13 23:42:24'),
('2b500639-a56c-44f5-b34b-c6080f41a4a3', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":104,\"estado\":0}', NULL, '2021-12-14 02:13:51', '2021-12-14 02:13:51'),
('2c0a3e1a-70c8-4a7f-bfc0-a7d3729fa7c8', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":85,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-08 02:16:30', '2021-12-13 23:42:24'),
('31cbe94b-e9e2-4dec-b73f-edcc7cc34626', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":9}', '2021-12-14 02:47:47', '2021-12-14 02:12:17', '2021-12-14 02:12:17'),
('33857634-5d8d-4c45-ac55-0c15371d427e', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":105,\"estado\":0}', NULL, '2021-12-17 04:26:41', '2021-12-17 04:26:41'),
('3536305b-352f-4264-b996-555c22ec6596', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":89,\"estado\":0}', NULL, '2021-12-09 03:25:39', '2021-12-09 03:25:39'),
('363e38c3-8670-4be7-ae60-7a50df9e54bb', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":97,\"estado\":0}', NULL, '2021-12-11 03:50:18', '2021-12-11 03:50:18'),
('3ada464b-c402-44b3-b400-98527146d3a6', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":100,\"estado\":0}', NULL, '2021-12-14 01:39:13', '2021-12-14 01:39:13'),
('40172789-0842-4b37-90c7-e60019faa817', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":96,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 23:36:03', '2021-12-13 23:42:24'),
('408a8eac-99bf-4ed0-bdcc-9ff5bc0f53b1', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":80,\"estado\":0}', NULL, '2021-12-07 23:28:56', '2021-12-07 23:28:56'),
('4378105c-32ed-49c5-9ce4-0c4e9b95a742', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":77,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 00:14:48', '2021-12-13 23:42:24'),
('440e9dd2-f6c9-4a44-be63-4a07b2ea2ebb', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":80,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 23:28:56', '2021-12-13 23:42:24'),
('47b3c284-06ea-4afb-aae5-967198fadf53', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":104,\"estado\":0}', '2021-12-14 02:14:33', '2021-12-14 02:13:51', '2021-12-14 02:13:51'),
('50007b31-60a9-4544-a798-c9c35da2c444', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":79,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 03:58:40', '2021-12-13 23:42:24'),
('585d5e33-4250-4d9f-baae-0420c7fcc0ac', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":1}', NULL, '2021-12-14 02:08:21', '2021-12-14 02:08:21'),
('5baafb41-1a00-46d6-9b65-5b56fe6fd67a', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":98,\"estado\":0}', NULL, '2021-12-13 21:26:38', '2021-12-13 21:26:38'),
('610a6013-ba23-45ff-87f2-91ee18cb160d', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":86,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-08 02:18:03', '2021-12-13 23:42:24'),
('63f67bbd-d452-4099-aa24-f72267d5ae31', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":2,\"estado\":0}', NULL, '2021-12-28 21:18:32', '2021-12-28 21:18:32'),
('65937973-70ff-4e9e-b0ce-3d2b7b831b0e', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":78,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 00:39:13', '2021-12-13 23:42:24'),
('67041074-3a14-4639-b0f0-3df818af940c', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":9}', NULL, '2021-12-14 02:12:17', '2021-12-14 02:12:17'),
('68ada780-855b-46c5-95d2-76ba0ac54e6f', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":107,\"estado\":0}', NULL, '2021-12-17 04:36:37', '2021-12-17 04:36:37'),
('72d88110-b657-4cf4-b992-9d828e7e9401', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":1}', '2021-12-14 03:29:50', '2021-12-14 03:03:03', '2021-12-14 03:03:03'),
('7800bc6b-be0d-4b69-9a60-fb376218c38b', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":94,\"estado\":0}', NULL, '2021-12-10 23:25:20', '2021-12-10 23:25:20'),
('78447b6e-9f0a-4709-b5b8-ab5bf7595a70', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":92,\"estado\":0}', NULL, '2021-12-10 22:56:37', '2021-12-10 22:56:37'),
('8130030f-0687-4817-bae7-f5f9570802d4', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":103,\"estado\":0}', NULL, '2021-12-14 02:11:58', '2021-12-14 02:11:58'),
('819ead60-3e5f-43b1-a3a8-8c2a3213af85', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":91,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-10 22:47:46', '2021-12-13 23:42:24'),
('854b5a14-d5bc-4c42-97a8-c3ddc75f52cb', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":1,\"estado\":0}', NULL, '2021-12-28 21:17:37', '2021-12-28 21:17:37'),
('87a68bb1-be6d-44f7-9aca-368e8c31aaf9', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":84,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 23:56:53', '2021-12-13 23:42:24'),
('8afa87f4-d6c6-468b-a1b8-5e95d123865e', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":1}', '2021-12-15 04:08:53', '2021-12-14 02:08:21', '2021-12-14 02:08:21'),
('8c914e5f-7fad-4600-b9b4-b94f20e9380b', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":105,\"estado\":0}', NULL, '2021-12-17 04:26:41', '2021-12-17 04:26:41'),
('8d5cf2f4-a75e-41ce-bf48-ea82b311739d', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":86,\"estado\":0}', NULL, '2021-12-08 02:18:03', '2021-12-08 02:18:03'),
('9208aa34-0c66-42b2-a27a-a18819a5581c', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":99,\"estado\":0}', '2021-12-13 23:57:16', '2021-12-13 23:47:01', '2021-12-13 23:47:01'),
('92daa7d2-37c2-430b-8778-1a088d7847fe', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":98,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-13 21:26:38', '2021-12-13 23:42:24'),
('9b459bae-4d17-4628-8a38-cc86d9541e45', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":103,\"estado\":0}', '2021-12-14 02:12:14', '2021-12-14 02:11:58', '2021-12-14 02:11:58'),
('9c0a4cfb-a54a-49c6-82ac-59334cb4c0fe', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":82,\"estado\":0}', NULL, '2021-12-07 23:49:59', '2021-12-07 23:49:59'),
('a092deaa-479a-439b-8967-d7d4b3798635', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":81,\"estado\":0}', NULL, '2021-12-07 23:47:17', '2021-12-07 23:47:17'),
('a530ab1b-c32a-40fc-a804-47ef2194be18', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":100,\"estado\":0}', '2021-12-14 01:49:04', '2021-12-14 01:39:13', '2021-12-14 01:39:13'),
('a568e183-cfdc-444e-abf7-12857031ce2d', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":1}', '2021-12-14 03:29:30', '2021-12-14 03:03:43', '2021-12-14 03:03:43'),
('ad1f5dbc-1a47-425a-89b4-f99b92c4e198', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":1}', NULL, '2021-12-14 03:03:13', '2021-12-14 03:03:13'),
('ae4da896-16fa-4c0a-98d5-d26696229134', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":81,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 23:47:17', '2021-12-13 23:42:24'),
('b0c6f05a-b112-49cc-92bc-3b6e307b3b14', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":3,\"estado\":0}', NULL, '2021-12-28 21:19:18', '2021-12-28 21:19:18'),
('b1a07487-45fe-4c42-9b5c-c02708344a6a', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":102,\"estado\":0}', '2021-12-14 01:57:17', '2021-12-14 01:57:10', '2021-12-14 01:57:10'),
('b394a4ee-5457-4e55-a737-3726e7012f2c', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":9}', NULL, '2021-12-28 21:53:21', '2021-12-28 21:53:21'),
('b9f3fb85-f6c7-4515-975e-8791f6ad455f', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":89,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-09 03:25:39', '2021-12-13 23:42:24'),
('bba2b5fb-9d47-4262-90db-70d4d39ca969', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":85,\"estado\":0}', NULL, '2021-12-08 02:16:30', '2021-12-08 02:16:30'),
('c2a9be68-b082-4c73-8f59-4d28219c45cd', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":93,\"estado\":0}', NULL, '2021-12-10 23:23:45', '2021-12-10 23:23:45'),
('ceee9607-74b2-4225-8705-b36dabac64aa', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":1}', NULL, '2021-12-14 03:03:03', '2021-12-14 03:03:03'),
('cf552700-0509-4926-a90b-ef3417ce7141', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":84,\"estado\":0}', NULL, '2021-12-07 23:56:53', '2021-12-07 23:56:53'),
('d09ff955-a44c-4852-b556-8dc5de601530', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":83,\"estado\":0}', NULL, '2021-12-07 23:54:05', '2021-12-07 23:54:05'),
('d117132e-c2da-434f-95c5-350b2f426266', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":82,\"estado\":0}', '2021-12-13 23:42:24', '2021-12-07 23:49:59', '2021-12-13 23:42:24'),
('d844d85a-8e46-4cb0-b98a-52b656afbcbb', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":101,\"estado\":0}', NULL, '2021-12-14 01:53:17', '2021-12-14 01:53:17'),
('dbc6efc3-1112-4c36-8549-20d831c68012', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":106,\"estado\":0}', NULL, '2021-12-17 04:35:14', '2021-12-17 04:35:14'),
('e498d78d-f5f8-40a8-a0b6-6204ce290f5a', 'App\\Notifications\\MinStock', 'App\\User', 1, '{\"id_inventario\":1}', NULL, '2021-12-14 03:03:43', '2021-12-14 03:03:43'),
('ec9ce6f6-c245-4866-be38-e998ba276f1a', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":102,\"estado\":0}', NULL, '2021-12-14 01:57:10', '2021-12-14 01:57:10'),
('f7da2831-181f-4201-b88e-142ecb4bf0d2', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":107,\"estado\":0}', NULL, '2021-12-17 04:36:37', '2021-12-17 04:36:37'),
('fb295394-260e-4724-973f-a04faf972fd6', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":78,\"estado\":0}', NULL, '2021-12-07 00:39:13', '2021-12-07 00:39:13'),
('fc9ae62b-edd4-4302-906c-8e0c4bc3f3a8', 'App\\Notifications\\EstadoVenta', 'App\\User', 7, '{\"venta_id\":3,\"estado\":0}', '2021-12-28 22:33:02', '2021-12-28 21:19:18', '2021-12-28 21:19:18'),
('fe291ca7-941d-48e6-a5bc-dcd5586d1f2b', 'App\\Notifications\\MinStock', 'App\\User', 7, '{\"id_inventario\":1}', '2021-12-14 03:29:45', '2021-12-14 03:03:13', '2021-12-14 03:03:13'),
('fef6a0f3-d98e-40ed-b304-135b1df8c3ae', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":99,\"estado\":0}', NULL, '2021-12-13 23:47:01', '2021-12-13 23:47:01'),
('ff2abbaf-6295-414a-a641-89beaf3fb6e8', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":91,\"estado\":0}', NULL, '2021-12-10 22:47:46', '2021-12-10 22:47:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `id_tipo_oferta` int NOT NULL,
  `tiempo_limite` date NOT NULL,
  `estado` int DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_ofertas_tipos_ofertas` (`id_tipo_oferta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `nombre`, `id_tipo_oferta`, `tiempo_limite`, `estado`, `created_at`, `updated_at`) VALUES
(1, '10', 1, '2021-11-26', 1, '2021-11-16 04:45:09', '2021-11-23 17:20:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

DROP TABLE IF EXISTS `opiniones`;
CREATE TABLE IF NOT EXISTS `opiniones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `rating` decimal(10,1) NOT NULL DEFAULT '0.0',
  `id_producto` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_opiniones_users` (`id_usuario`),
  KEY `fk_opiniones_productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id`, `title`, `descripcion`, `id_usuario`, `rating`, `id_producto`, `created_at`, `deleted_at`) VALUES
(1, 'usado really test', 'Nice producto from los gringos [edited]', 1, '4.5', 1, '2021-11-09 05:35:07', NULL),
(2, 'nuevo', 'adios', 1, '0.5', 1, '2021-11-09 05:36:53', NULL),
(3, 'ahi se va', 'asdasd', 1, '1.0', 1, '2021-11-09 05:37:30', NULL),
(4, 'curioso', 'asdasda', 1, '2.0', 1, '2021-11-09 05:38:37', NULL),
(5, 'entretenido', 'asdasd', 1, '1.5', 1, '2021-11-09 05:40:54', NULL),
(6, 'valñe bien', 'yop', 1, '2.5', 1, '2021-11-09 07:59:59', NULL),
(7, 'zfzx', 'ass', 1, '3.0', 1, '2021-11-09 08:00:50', NULL),
(8, 'zfxzx', 'asdasdas', 1, '3.5', 1, '2021-11-09 08:01:12', NULL),
(9, 'zfxf', 'adasd 4', 1, '4.0', 1, '2021-11-09 08:01:27', NULL),
(10, 'Excelente', 'sadasd', 1, '5.0', 1, '2021-11-09 08:46:15', NULL),
(11, 'Masomenos [update]-', 'No lose rick parece chino [edited]', 2, '2.0', 1, '2021-11-09 10:27:15', NULL),
(12, 'nada mal eh', 'asdasdas', 1, '0.5', 1, '2021-11-10 02:30:17', NULL),
(13, 'Excelenteasdasd', 'dasdas', 1, '1.0', 1, '2021-11-10 02:30:49', NULL),
(14, 'usado update', 'Nice producto from los gringos update', 1, '4.5', 1, '2021-11-10 05:04:31', NULL),
(15, 'usado test', 'Nice producto from los gringos', 1, '4.5', 1, '2021-11-10 05:05:08', NULL),
(16, 'nicenice', 'nyahallo', 1, '5.0', 1, '2021-11-10 05:49:15', NULL),
(17, 'asds', 'adsdsa', 2, '4.0', 1, '2021-11-10 08:50:02', NULL),
(20, 'Banner de Ejemplo 1', 'sdfsdfsd 1', 7, '2.0', 7, '2021-11-18 23:01:29', '2021-11-18 23:01:58'),
(21, 'dfgdfgdfg', 'dfgg', 7, '4.0', 7, '2021-11-18 23:02:05', NULL),
(22, 'xd update', 'por ahi dsadaw', 20, '4.0', 15, '2021-12-13 21:49:45', NULL),
(23, 'xd', 'por ahi', 20, '4.0', 15, '2021-12-13 21:50:53', '2021-12-13 21:51:51'),
(24, 'dsadas', 'dasdas', 20, '1.5', 15, '2021-12-13 21:56:14', NULL),
(25, 'Banner de Ejemplo', '.,nmabdkhgwvadvgfhjacvdgfa', 21, '1.5', 15, '2021-12-17 04:32:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `direccion` varchar(1000) NOT NULL,
  `telefono` int NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfiles_users` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `imagen` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_proveedor` int NOT NULL,
  `id_marca` int NOT NULL,
  `id_categoria` int NOT NULL,
  `id_subcat` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productos_categorias` (`id_categoria`),
  KEY `fk_productos_proveedores` (`id_proveedor`),
  KEY `fk_productos_marcas` (`id_marca`),
  KEY `fk_productos_subcategorias` (`id_subcat`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `imagen`, `descripcion`, `id_proveedor`, `id_marca`, `id_categoria`, `id_subcat`, `created_at`, `updated_at`) VALUES
(7, 'Camisa Gucci', '[\"\\/storage\\/imagenes\\/productos\\/zEMnPcBzbVir1YkgTGRB7ZR7rD02WAxUV9KrwJXK.webp\",\"\\/storage\\/imagenes\\/productos\\/iY6mXvCfnL4pOMxOCRPWUVOB99c6ObrTFXh1P233.jpg\",\"\\/storage\\/imagenes\\/productos\\/koBHTsdEfOd7oXD2PzsZb2Q8zIUZDkk3lnJI1LST.jpg\",\"\\/storage\\/imagenes\\/productos\\/V13Pc792fbJhtuMcNYxXBGzcWjH5VmoRLIK7ba8Q.jpg\",\"\\/storage\\/imagenes\\/productos\\/rCqpyr5bhVP6oCTH4CcwRJzsTYfJbq6UNgkvDdPo.jpg\",\"\\/storage\\/imagenes\\/productos\\/yOQoUnERM1uAAyIc1t2yzFoBtc1uG7PXNJHhbVL4.jpg\"]', 'Esta camiseta extragrande forma parte de la colección The North Face x Gucci, una colaboración que conecta dos marcas con una historia y valores similares para celebrar el espíritu de la exploración. The North Face hace gala de un rico patrimonio que impulsa la innovación y rompe con las reglas a la hora de crear estilos con unos detalles de diseño exclusivos y distintivos', 1, 8, 9, 4, '2021-11-12 04:15:09', '2021-11-30 01:41:15'),
(8, 'Whirlpool Microondas', '[\"\\/storage\\/imagenes\\/productos\\/1rJjCSxi7hcgbaxTZDQFdANzUilC49Ib0cY0wqam.jpg\",\"\\/storage\\/imagenes\\/productos\\/NzWEhsVI5F8VKwzmDUFtaf1vThqNceme8CVlmxCD.jpg\",\"\\/storage\\/imagenes\\/productos\\/iJy6Z5Xoi7mPivrUgwJgzi5CHyCJSttCxmwXFVP0.jpg\"]', 'Calienta en pocos minutos tus alimentos gracias al microondas de Whirlpool modelo WM1114D, el cual cuenta con una capacidad de 1.4 pies cúbicos, también cuenta con una potencia de 1450 W, además cuenta con 6 funciones pre-programadas (palomitas, papa asada, pizza, bebidas, congelados y recalentado, Además de tener 4 opciones de programación (cocción por etapas, cocción por peso, descongelar por peso, descongelar rápido)\r\n\r\nPosee también cronómetro, reloj, plato giratorio y manija en la puerta.', 4, 1, 1, 4, '2021-11-20 02:27:22', '2021-11-20 02:27:22'),
(9, 'Samsung Galaxy Buds Plus', '[\"\\/storage\\/imagenes\\/productos\\/RQZzxPqcpZYRkQdVXhK0UOknxoEBEFxYKcz1ct2T.png\",\"\\/storage\\/imagenes\\/productos\\/TrjTxSlfQpjvkc8AHG3ZnRHr5d0Nl2syw6FMbw3Q.png\",\"\\/storage\\/imagenes\\/productos\\/8OK8MtAzat6o5qpBYWq9M4tj7wyZgJqk2kPQAFGU.png\",\"\\/storage\\/imagenes\\/productos\\/wMTRqxif5TYY42gKk4vzBkn5yNHBNDTq4SzibAph.png\",\"\\/storage\\/imagenes\\/productos\\/hlzMzqRDjbciFzkS5gfYew5yzeA98zHu4aQTMtDS.png\",\"\\/storage\\/imagenes\\/productos\\/mQu9r4M3AjSsnX0TmVs9UKHwCkUWHF7RK92l7AfZ.png\"]', 'Galaxy Buds Plus Samsung, los puedes conectar por medio de Bluetooth, utiliza una batería de 85 mAh y la duración de la batería en llamada es de hasta 11 horas de duración con el estuche de carga, en cuanto a la duración de la batería con reproductor de música es de hasta 6 horas de funcionamiento ininterrumpido, además son compatibles con todos los dispositivos', 4, 1, 2, 1, '2021-11-30 02:21:14', '2021-11-30 04:29:08'),
(10, 'Apple Laptop Macbook Pro 13', '[\"\\/storage\\/imagenes\\/productos\\/ACJLORW6wLGvHbGBefoddncq3j3d5uqKGvuM8ro7.jpg\",\"\\/storage\\/imagenes\\/productos\\/ImGmJ8UMQKRUrEo0rEohFtPqNofvSra5dIMgQT93.jpg\",\"\\/storage\\/imagenes\\/productos\\/JsJs0GFMpq1RxPS399eHw258tokqXkm3a9CV5kAC.jpg\",\"\\/storage\\/imagenes\\/productos\\/J5ecRFzD0s7qHraRAWnZZCBhPFcGV5BBCsYyLB3w.jpg\"]', 'MacBook Pro de 13 pulgadas alcanza un nuevo nivel de potencia y velocidad. El CPU es hasta 2.8 veces más rápido y los gráficos son hasta 5 veces más veloces. El Neural Engine, el más avanzado hasta ahora, permite un aprendizaje automático hasta 11 veces más rápido. Y la batería te acompaña hasta por 20 horas, la mayor duración en una Mac.', 1, 9, 2, 1, '2021-11-30 02:24:53', '2021-11-30 02:24:53'),
(11, 'Ups 375w con 6 tomas', '[\"\\/storage\\/imagenes\\/productos\\/ivKxLDhftioYoEruZ7Qav7QdXLbJds5keFa0c2jx.jpg\",\"\\/storage\\/imagenes\\/productos\\/aKSJjWzIGBLHJngwdYfmH6ZY1f2ZW8ND1VplhxVP.jpg\",\"\\/storage\\/imagenes\\/productos\\/N2yQCq8PR8Sf3uROy1U9LDI6G5sWPWhP2cKElzM5.jpg\"]', 'UPS interactivo en línea con Control de microprocesador inteligente\r\nCorrija las fluctuaciones menores de energía (bajo y sobrevoltaje) sin cambiar a la batería. Extiende la vida útil de la batería y es esencial en áreas donde las fluctuaciones de energía ocurren regularmente. Las aplicaciones típicas son electrónica de consumo, PC, equipos de red y servidores de rango medio.', 4, 4, 2, 2, '2021-11-30 02:36:54', '2021-11-30 02:36:54'),
(12, 'Sala seccional con ottoman Café', '[\"\\/storage\\/imagenes\\/productos\\/Jzci6AnZbAKiaHYmbKayfwY7zky5x3YvYJXIFFiS.webp\",\"\\/storage\\/imagenes\\/productos\\/EPS3i9UqWE32vj1f8YS3HGNYDwaC9lWsZ5jJfNli.webp\",\"\\/storage\\/imagenes\\/productos\\/UeFaGFp43aZopQxTLoCzNn3KVHBuxV2NtAt7pw8F.webp\",\"\\/storage\\/imagenes\\/productos\\/OzfWLe4QhgHV7oxlfaRX8AnunkX10yTzvzKQ7tcN.webp\",\"\\/storage\\/imagenes\\/productos\\/F4frabj1TBFzC5TnibIp5jqHfCpLqFCPV6EXudtS.webp\"]', 'Sala seccional con ottoman color café con patas metálicas, gracias a su estilo contemporáneo podrás tenerlos por muchos años.', 4, 8, 13, 6, '2021-12-03 04:42:42', '2021-12-03 04:59:00'),
(13, 'Mueble para cocina compacta tati', '[\"\\/storage\\/imagenes\\/productos\\/wDQAfRNxoZc6H5N8c5NTvLls0KeX854fEUkAhaTZ.webp\",\"\\/storage\\/imagenes\\/productos\\/alPAAAa50LPyx2uB0uO0y5opE6glBwLxmPJ0ri5G.webp\",\"\\/storage\\/imagenes\\/productos\\/PLumxuswiAvF3alDCiytqkEpWQs6BrVCKmU5JG7i.webp\"]', 'Mueble para cocina son prácticas y acogedor, que son fáciles de mantener ordenado y ayudar en la composición de otros muebles. La cocina compacta está diseñada para proporcionar una mejor ergonomía y comodidad para el usuario. Se fabrica en MDP 15mm y mate / brillo. Es bisagras de metal.', 3, 9, 13, 9, '2021-12-03 05:09:41', '2021-12-03 05:09:41'),
(14, 'Muebles para cocina', '[\"\\/storage\\/imagenes\\/productos\\/zV1aa93LfPZOtjS2GOBYkEvarBVQsvfACvlokj9d.webp\",\"\\/storage\\/imagenes\\/productos\\/J4wJYNtWHBeK4zpLp42UBXrtOn01gTSa51yAjjWC.webp\",\"\\/storage\\/imagenes\\/productos\\/JR5eMzLJpRxzwFxnwoZXznNjXLfElcsq4kSf9XL5.webp\",\"\\/storage\\/imagenes\\/productos\\/Xs8CxCoSSOk3FyPfgeNxgRTy6yMzLipdbmRm41xS.webp\"]', 'De un toque de elagancia a su cocina, con el mueble de 4 piezas. Hecho en madera MDF.', 4, 5, 13, 9, '2021-12-03 05:14:48', '2021-12-03 05:14:48'),
(15, 'Iphone 13 pro max', '[\"\\/storage\\/imagenes\\/productos\\/I9lPTYQtJObFwclw0ldvVDYLY7pdOG8S7uFQWN2Z.webp\",\"\\/storage\\/imagenes\\/productos\\/Le7mFgTR4vmeY2jxWTyMLnKzYbuYnDAtpEku9Rh0.jpg\",\"\\/storage\\/imagenes\\/productos\\/bKUKwAC29EdUBac12YOGIwiuav6EgXqZToxDjnSg.webp\",\"\\/storage\\/imagenes\\/productos\\/MNOfD6StmXrUlZeNIC0txzMrMg8HIwEl16dylAfe.webp\"]', 'El Apple iPhone 13 Pro Max mejora a su predecesor con una tasa de refresco de pantalla de 120Hz, el nuevo procesador Apple A15 Bionic y mejoras en sus cámaras. Con una pantalla OLED de 6.7 pulgadas a resolución FHD+, el iPhone 13 Pro Max está disponible con 512GB de alamcenamiento interno. La cámara cuádruple llega con tres lentes de 12MP y un sensor ToF 3D que integra estabilización óptica de imagen y zoom 3x, y su cámara selfie es de 12MP. El iPhone 13 Pro Max cuenta con parlantes stereo, Face ID para seguridad, resistencia IP68 al polvo y agua, y carga rápida e inalámbrica.', 4, 9, 1, 10, '2021-12-03 09:24:09', '2021-12-03 09:27:19'),
(16, 'Tablet 8.7\" tab a7 lite wifi 3gb ram - 32gb plata', '[\"\\/storage\\/imagenes\\/productos\\/85N3NadVEdjo9aCb7uFYi0FcOktdKFwH5MWcBn63.jpg\",\"\\/storage\\/imagenes\\/productos\\/s9fyWwm1I94UZMmi6lf3zOUS0CfhVtfnrtDmuwkb.webp\",\"\\/storage\\/imagenes\\/productos\\/eClLb5Kblu7vRv3PSnhUCfq78EhQSZn2QNxzkeW5.webp\",\"\\/storage\\/imagenes\\/productos\\/5RjHAEu3IJRwiCxxtoaPuLjOoOEmPu7NMMJ3YXxJ.webp\",\"\\/storage\\/imagenes\\/productos\\/ciXlxX5su4kThihmaEAii3sjxcuS5M02s4JJckyD.webp\",\"\\/storage\\/imagenes\\/productos\\/Gnhn3hbfSOyibRE1xf6sUdyv5LJT9r2K36PLpQyU.webp\"]', 'El Samsung Galaxy Tab A7 Lite es una variante de menores prestaciones del Galaxy Tab A7. Con una pantalla de 8.7 pulgadas a 800 x 1340 pixels de resolución, el Galaxy Tab A7 Lite cuenta con un procesador Helio P22T de MediaTek, con 3GB de RAM y 32GB de almacenamiento. Las cámaras son de 8MP y 2MP, tiene una batería de 5100 mAh de carga rápida, parlantes stereo y corre Android 11.', 4, 1, 4, 10, '2021-12-03 10:37:17', '2021-12-03 10:37:17'),
(17, 'Mesa de centro', '[\"\\/storage\\/imagenes\\/productos\\/7BNe0h5P1tJNbh04V4nSjlK5HTMwpKv38Bhu5RM2.webp\"]', 'Con sus patas cortas y su perfil bajo y lineal, la mesa de centro MC2228 es una maestría en el minimalismo de mediados de siglo. El aspecto puede ser un diseño de galería de alta gama, pero el precio es maravillosamente realista. El acabado a dos tonos café y blanco es maravillosamente agradable a la vista.', 1, 7, 13, 6, '2021-12-13 23:25:41', '2021-12-13 23:25:41'),
(18, 'Freidora de aire 5 litros negra', '[\"\\/storage\\/imagenes\\/productos\\/5yRfnoW0nGWjlRa7gzkrk4AZFpiu8ra11yuDWRt0.webp\",\"\\/storage\\/imagenes\\/productos\\/kRZ4HXmJbGWO5OaLC2fY6OZTjcUI6LfoN91oTwWq.webp\",\"\\/storage\\/imagenes\\/productos\\/tR3NyiBiQL9kvQnranCMV7RCnDFmKrYdH1nyI8nQ.webp\",\"\\/storage\\/imagenes\\/productos\\/5NG2vtTENNWpHf11EOXEWgd5ugR9GY0jwUt3MfMZ.webp\",\"\\/storage\\/imagenes\\/productos\\/WZfadBRX5VQ6LK7iw1BEhuc679efCfUmhx1M6VUG.webp\"]', 'Cocina sin culpa y mas rápido con La Freidora de Aire Saludable de Black + Decker. Con capacidad grande de 5 litros, es perfecta para freír y hornear porciones más grandes de tus comidas favoritas en poco tiempo. Con esta revolucionaria manera de cocinar, puedes disfrutar deliciosos alimentos fritos sin grasa y con el mismo sabor.Fríe y Hornea con aire de manera saludable sin aceite con la Freidora de Aire Extra Grande de Black + Decker. Capacidad extra grande de 5 Litros para preparar porciones más grandes. Control de temperatura de hasta 200°C para preparar diferentes recetas en menos tiempo. Temporizador de 60 minutos con apagado automático para puedas hacer otras actividades sin preocupación. Cocina tus alimentos 70% más rápido comparado con el modelo anterior de airfryer Black + Decker al cocinar papas fritas congeladas.', 3, 4, 2, 10, '2021-12-27 21:23:10', '2021-12-27 21:23:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` int NOT NULL,
  `nombre_contacto` varchar(100) NOT NULL,
  `tel_contacto` int NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `direccion`, `telefono`, `nombre_contacto`, `tel_contacto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Proveedor de prueba 1 update', 'Direccion de prueba updayte', 55555555, 'Nombre contacto 1 update', 33333333, 1, '2021-11-10 04:00:00', '2021-11-10 04:39:01'),
(3, 'Proveedor de prueba 2', 'Direccion de prueba 2', 23123231, 'Nombre contacto 2', 56154568, 1, '2021-11-10 04:59:05', '2021-11-10 04:59:05'),
(4, 'Proveedor de prueba 3', 'Direccion de prueba 3', 32132165, 'Nombre contacto 3', 56415646, 1, '2021-11-10 04:59:37', '2021-11-10 04:59:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_categorias`
--

DROP TABLE IF EXISTS `sub_categorias`;
CREATE TABLE IF NOT EXISTS `sub_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategorias_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sub_categorias`
--

INSERT INTO `sub_categorias` (`id`, `nombre`, `id_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Electronica digital', 1, '2021-11-09 04:59:26', '2021-11-09 04:59:26'),
(2, 'Electronica sub-2', 1, '2021-11-09 05:01:27', '2021-11-09 05:01:27'),
(3, 'Electronica sub-3', 1, '2021-11-09 05:01:44', '2021-11-09 05:01:44'),
(4, 'Electronica sub-4', 1, '2021-11-09 05:02:04', '2021-11-09 05:02:04'),
(5, 'Motherboar', 2, '2021-11-09 05:10:31', '2021-11-09 05:10:31'),
(6, 'Salas', 13, '2021-12-03 04:51:12', '2021-12-03 04:51:12'),
(7, 'Comedores', 13, '2021-12-03 04:53:53', '2021-12-03 04:53:53'),
(8, 'Decoración', 13, '2021-12-03 04:54:16', '2021-12-03 04:54:16'),
(9, 'Cocina', 13, '2021-12-03 05:06:26', '2021-12-03 05:06:26'),
(10, 'Celulares', 1, '2021-12-03 09:22:11', '2021-12-03 09:22:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_ofertas`
--

DROP TABLE IF EXISTS `tipos_ofertas`;
CREATE TABLE IF NOT EXISTS `tipos_ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_ofertas`
--

INSERT INTO `tipos_ofertas` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Descuentos', 1, '2021-11-16 01:52:59', '2021-11-16 23:19:53'),
(2, 'Producto Extra', 1, '2021-12-03 18:40:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

DROP TABLE IF EXISTS `tipos_usuarios`;
CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_usuario` int NOT NULL DEFAULT '2',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `email_verified_at`, `password`, `id_tipo_usuario`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jose__', '/storage/frontend/client/1/2YNw7JvB8AalX5P1B0tAwGTuteP6bXirUDB4zQ4w.jpg', 'example@example.com', NULL, '$2y$10$GhX1amKZDj4TSFbpbygG8.RPdOYnTyIoz44Ps1b1.dq5b2uA23GbK', 1, 'YnxKK67yzEYW156PXPALIyapGesuwdv8nYDR9ylf8de4X1oSnQ9C0ZZluYos', '2021-11-05 10:02:59', '2021-11-07 05:56:48'),
(2, 'Antonio', NULL, 'admin@gmail.com', NULL, '$2y$10$paJsf1H2tmH5hFG7y8BfhOWOykwy6U6PoVJSlCWUBHI1UWasMcrsW', 2, NULL, '2021-11-05 10:45:01', '2021-11-05 10:45:01'),
(3, 'Alas', NULL, 'alas@example.com', NULL, '$2y$10$5/g5UIY8KP1y7MbFmwZkb.vgsR8O..lqmywEGbc93VeAIV1SPe2R.', 2, NULL, '2021-11-06 05:54:43', '2021-11-06 05:54:43'),
(7, 'diego', '/storage/frontend/client/7/KSQH9L33HZiM5HiY8Yd0aVpOktuOeAmC76WulRD1.jpg', 'spotdiego877@gmail.com', '2021-12-13 21:49:09', '$2y$10$eU/SNOlFEFbVih2iccsadeNE1GhU03g8naEagqOTMyappH1OyqbrC', 1, NULL, '2021-11-18 22:51:42', '2021-12-13 23:10:00'),
(8, 'Alas___', NULL, 'zerodrieswolf@gmail.com', NULL, '$2y$10$iTFoNNWNeoJks86NewM2WONfqkeOy9aWZH6XcKst1nTiR3v3bGLmG', 2, NULL, '2021-12-07 04:24:28', '2021-12-07 04:24:28'),
(9, 'pepito', NULL, 'example3@example.com', NULL, '$2y$10$xJCwIU1MP4JQa708Fim5.O0a5OpxvDveIlvANA9taacsEom6L.cYG', 2, NULL, '2021-12-07 04:29:23', '2021-12-07 04:29:23'),
(10, '__Vega', NULL, 'example@example22.com', NULL, '$2y$10$oGG6oXuXx1X08DQQNi3ehOrOlJxDR8f.qjYub51wmhRrtFksufkwG', 2, NULL, '2021-12-07 20:23:11', '2021-12-07 20:23:11'),
(11, 'costumer 3', NULL, 'example@example3.com', NULL, '$2y$10$jFrXG/kkJG6kpRvkkKJaaOhnpE6C5c/kWK9kYtNsZZHURVNEWz1va', 2, NULL, '2021-12-09 02:13:28', '2021-12-09 02:13:28'),
(12, 'costumer 7', NULL, 'example@example7.com', NULL, '$2y$10$CjUdH82egHkaXJpPCozrvuvsQEK0.SsK74mlJyOKl.yaD8vbvbaF2', 2, NULL, '2021-12-08 07:36:52', '2021-12-08 07:36:52'),
(13, 'costumer 8', NULL, 'example@example8.com', NULL, '$2y$10$XiJGxM4SexEB0.Ses.MRxOpljuHyZRh8ZSIKmjea5sT4IrWNT71xq', 2, NULL, '2021-12-08 07:37:42', '2021-12-08 07:37:42'),
(14, 'costumer 9', NULL, 'example@example9.com', NULL, '$2y$10$zyM1WtJkC0cqPONtwk1fLeZ4uU2tobfroB3.le4HVIS0hrIunff3.', 2, NULL, '2021-12-11 03:44:53', '2021-12-11 03:44:53'),
(20, 'SrDiego', '/storage/frontend/client/20/di3XVkuZGoT8a0j8FJu1eVrSqkMOpj0DvMg2n8t9.jpg', 'diegouriel.martinez15@gmail.com', '2021-12-13 21:49:09', '$2y$10$c2nUWMeqxauRdfb6cZzX3uEW2Ydzbu/c2tzbqh0JPVMnDGi4LQGem', 2, NULL, '2021-12-13 21:49:02', '2021-12-13 23:14:45'),
(21, 'prueba1', NULL, 'icanva45@gmail.com', '2021-12-17 04:29:44', '$2y$10$KM0Av2B9YXY3hOSnipP7ueOsuC8SukfUvXzR9s83CQOQ7BMywEW6K', 2, NULL, '2021-12-17 04:29:24', '2021-12-17 04:31:34'),
(22, 'diego2', NULL, 'proyectospruebas9@gmail.com', '2021-12-20 20:15:11', '$2y$10$k.kpDr.ySFrGKq34iYB8.uK25SGvuTiZrsdhtD7YTB1QWtsOUxQXy', 2, NULL, '2021-12-20 20:14:56', '2021-12-20 20:15:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `num_transaccion` varchar(500) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_direccion` bigint UNSIGNED DEFAULT NULL,
  `id_metodo_pago` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `fk_ventas_direcciones` (`id_direccion`),
  KEY `fk_ventas_metodo_pago_idx` (`id_metodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `total`, `num_transaccion`, `estado`, `id_direccion`, `id_metodo_pago`, `created_at`, `updated_at`) VALUES
(1, 7, '2808.00', '41f3096b91d99465d4d5f5ff4193f33a196e3a98', 1, 4, 5, '2021-12-28 21:17:36', '2021-12-28 21:53:21'),
(2, 7, '1600.00', 'b384b64f115afc8410c03a8637e67e8370bd4369', 1, 4, 5, '2021-12-28 21:18:32', '2021-12-28 21:53:18'),
(3, 7, '495.00', '8adce3e49805fb2af32f41eab347fd3b442bcbca', 1, 4, 5, '2021-12-28 21:19:18', '2021-12-28 21:53:15');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_ventas`
--
ALTER TABLE `datos_ventas`
  ADD CONSTRAINT `fk_datos_ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcciones_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `fk_inventarios_ofertas` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventarios_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `fk_ofertas_tipos_ofertas` FOREIGN KEY (`id_tipo_oferta`) REFERENCES `tipos_ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `fk_perfiles_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
