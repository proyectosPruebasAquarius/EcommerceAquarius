-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-12-2021 a las 14:37:31
-- Versión del servidor: 8.0.26
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb3 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Computadoras', 1, '2021-12-13 17:53:54', NULL),
(2, 'Electrodoméstico', 1, '2021-12-13 17:53:54', NULL),
(3, 'Muebles', 1, '2021-12-13 17:53:54', NULL),
(4, 'Celulares y Tablets', 1, '2021-12-13 17:53:54', NULL),
(5, 'Audio', 1, '2021-12-13 17:53:54', NULL),
(6, 'Tegnología', 1, '2021-12-13 17:53:54', NULL),
(7, 'Línea Blanca', 1, '2021-12-13 17:53:54', NULL),
(8, 'Video', 1, '2021-12-13 17:53:54', NULL),
(9, 'Otras Categorias', 1, '2021-12-13 17:53:54', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `datos_ventas`
--

INSERT INTO `datos_ventas` (`id`, `numero`, `imagen`, `id_venta`, `created_at`) VALUES
(1, '12345678', '1639601507.webp', 2, '2021-12-16 02:51:47'),
(2, '1234578', '1639606861.webp', 19, '2021-12-16 04:21:01'),
(3, '12345678', '1639608070.webp', 20, '2021-12-16 04:41:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_producto`, `id_venta`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 17, 1, 2, '2021-12-16 02:18:27', '2021-12-16 02:18:27'),
(2, 16, 1, 3, '2021-12-16 02:18:27', '2021-12-16 02:18:27'),
(3, 13, 2, 5, '2021-12-16 02:51:47', '2021-12-16 02:51:47'),
(4, 7, 3, 1, '2021-12-16 02:52:25', '2021-12-16 02:52:25'),
(5, 1, 4, 2, '2021-12-16 02:57:33', '2021-12-16 02:57:33'),
(6, 13, 5, 1, '2021-12-16 02:58:26', '2021-12-16 02:58:26'),
(7, 11, 6, 1, '2021-12-16 03:00:50', '2021-12-16 03:00:50'),
(8, 14, 7, 3, '2021-12-16 03:05:52', '2021-12-16 03:05:52'),
(9, 1, 8, 1, '2021-12-16 03:11:44', '2021-12-16 03:11:44'),
(10, 1, 9, 1, '2021-12-16 03:13:38', '2021-12-16 03:13:38'),
(20, 2, 19, 1, '2021-12-16 04:21:01', '2021-12-16 04:21:01'),
(21, 5, 20, 5, '2021-12-16 04:41:10', '2021-12-16 04:41:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `facturacion` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `referencia` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_municipio` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direcciones_id_user_foreign` (`id_user`),
  KEY `direcciones_id_municipio_foreign` (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `direccion`, `first_name`, `last_name`, `email`, `telefono`, `facturacion`, `referencia`, `id_user`, `id_municipio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'cas canyuco', 'asdsdsa', 'asdsa', 'zerodrieswolf@gmail.com', '12345678', 'cas ff', NULL, 1, 224, '2021-12-16 02:18:27', '2021-12-16 04:41:25', NULL),
(2, 'calle a san bartolo 123', 'joseeee', 'alas', 'zerodrieswolf@gmail.com', '12345678', 'calle a san bartolo 123', '13', 1, 224, '2021-12-16 04:21:01', '2021-12-16 04:21:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

DROP TABLE IF EXISTS `inventarios`;
CREATE TABLE IF NOT EXISTS `inventarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `codigo` varchar(500) NOT NULL,
  `stock` int NOT NULL,
  `id_producto` int NOT NULL,
  `id_oferta` int DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_inventarios_productos` (`id_producto`),
  KEY `fk_inventarios_ofertas` (`id_oferta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `precio_compra`, `precio_venta`, `codigo`, `stock`, `id_producto`, `id_oferta`, `estado`, `created_at`, `updated_at`) VALUES
(1, '150.00', '299.00', '103271989', 50, 3, 1, 1, '2021-12-14 02:27:26', '2021-12-14 02:27:26'),
(2, '11.00', '22.00', '103322904', 100, 1, NULL, 1, '2021-12-14 02:29:04', '2021-12-14 02:29:04'),
(3, '40.00', '55.00', '103277870', 15, 2, NULL, 1, '2021-12-14 02:33:15', '2021-12-14 02:33:15'),
(4, '900.00', '1299.00', '103114104', 11, 4, NULL, 1, '2021-12-14 03:36:23', '2021-12-14 03:36:23'),
(5, '850.00', '1200.00', '103401903', 5, 5, 1, 1, '2021-12-14 03:40:42', '2021-12-14 03:40:42'),
(6, '750.00', '999.00', '102869619', 6, 6, NULL, 1, '2021-12-14 03:45:38', '2021-12-14 03:45:38'),
(7, '300.00', '450.00', '103148530', 1, 7, NULL, 1, '2021-12-14 03:55:37', '2021-12-13 21:56:49'),
(8, '50.00', '75.00', '102993890', 70, 8, NULL, 1, '2021-12-14 04:05:47', '2021-12-14 04:05:47'),
(9, '70.00', '99.00', '102832684', 55, 9, 1, 1, '2021-12-14 04:11:03', '2021-12-14 04:11:03'),
(10, '900.00', '1029.00', '103396647', 5, 10, 1, 1, '2021-12-14 04:20:51', '2021-12-14 04:20:51'),
(11, '90.00', '215.00', '103174224', 25, 11, 4, 1, '2021-12-14 20:20:43', '2021-12-14 20:20:43'),
(12, '900.00', '1959.00', '103483909', 23, 12, NULL, 1, '2021-12-14 20:26:32', '2021-12-14 20:26:32'),
(13, '30.00', '59.00', '103218581', 50, 13, NULL, 1, '2021-12-14 20:38:18', '2021-12-14 20:38:18'),
(14, '200.00', '429.00', '101724131', 10, 14, NULL, 1, '2021-12-14 20:46:18', '2021-12-14 20:46:18'),
(15, '300.00', '489.00', '102848778', 5, 15, 1, 1, '2021-12-14 20:50:19', '2021-12-14 20:50:19'),
(16, '400.00', '679.00', '102347232', 3, 16, 4, 1, '2021-12-14 20:54:58', '2021-12-14 20:54:58'),
(17, '990.00', '2049.00', '102919233', 2, 17, 4, 1, '2021-12-14 20:58:08', '2021-12-14 20:58:08'),
(18, '1000.00', '2149.00', '103434873', 8, 18, NULL, 1, '2021-12-14 21:04:20', '2021-12-14 21:04:20'),
(19, '300.00', '499.00', '103537132', 12, 19, NULL, 1, '2021-12-14 21:08:11', '2021-12-14 21:08:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', '1636139103.png', 1, '2021-11-06 07:05:03', '2021-11-29 22:57:48'),
(2, 'Dell', '1636150932.png', 1, '2021-11-06 07:06:55', '2021-11-29 22:57:40'),
(4, 'Bosch', '1638205049.png', 1, '2021-11-11 02:24:44', '2021-11-29 22:57:29'),
(5, 'Canon', '1638205128.png', 1, '2021-11-29 22:58:48', '2021-11-29 22:58:48'),
(6, 'HP', '1638205184.png', 1, '2021-11-29 22:59:44', '2021-12-14 22:31:16'),
(7, 'Sony', '1638205198.png', 1, '2021-11-29 22:59:58', '2021-11-29 22:59:58'),
(8, 'Gucci', '1638205493.png', 1, '2021-11-29 23:04:53', '2021-11-29 23:04:53'),
(9, 'Asus', '1638206132.png', 1, '2021-11-29 23:09:26', '2021-11-29 23:15:32'),
(11, 'AKG', '1639431121.png', 1, '2021-12-14 02:01:45', '2021-12-14 03:32:01'),
(12, 'Amazon', '1639431133.png', 1, '2021-12-14 02:19:23', '2021-12-14 03:32:13'),
(13, 'Apple', '1639431107.png', 1, '2021-12-14 03:31:47', '2021-12-14 03:31:47'),
(14, 'Whirlpool', '1639432987.png', 1, '2021-12-14 04:03:07', '2021-12-14 04:03:07'),
(15, 'Hamilton Beach', '1639433296.png', 1, '2021-12-14 04:08:16', '2021-12-14 04:08:29'),
(16, 'Xiaomi', '1639492605.png', 1, '2021-12-14 20:36:45', '2021-12-14 20:36:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pagos`
--

DROP TABLE IF EXISTS `metodos_pagos`;
CREATE TABLE IF NOT EXISTS `metodos_pagos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `qr` text COLLATE utf8mb3_unicode_ci,
  `numero` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cuenta_asociado` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `metodos_pagos`
--

INSERT INTO `metodos_pagos` (`id`, `nombre`, `qr`, `numero`, `cuenta_asociado`, `estado`, `created_at`, `updated_at`) VALUES
(5, 'Chivo Wallet', '[\"Screenshot_20211201-102056.png\",\"Screenshot_20211201-095700.png\"]', NULL, 'Jose Antonio Alas A.', 1, '2021-12-01 22:54:34', '2021-12-01 22:54:34'),
(6, 'Banco Agricola', '[\"Screenshot_20211201-095700.png\"]', '123456789123456789123', 'Jose Antonio Alas A.', 1, '2021-12-01 22:59:50', '2021-12-01 22:59:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_12_01_145412_create_metodos_pagos_table', 1),
(2, '2021_12_06_165524_create_notifications_table', 2),
(3, '2021_12_11_172336_add_soft_deletes_to_direcciones_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_departamento` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipios_id_departamento_foreign` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `id` char(36) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('16d9f0a3-6c99-424d-9051-c6ad48a9140c', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":2,\"estado\":0}', NULL, '2021-12-16 02:51:47', '2021-12-16 02:51:47'),
('2a5d3a35-48d9-4316-bde1-49ca2de60e1d', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":3,\"estado\":0}', NULL, '2021-12-16 02:52:25', '2021-12-16 02:52:25'),
('2edaf275-e25a-44bb-88f7-04a452cbd57f', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":20,\"estado\":0}', NULL, '2021-12-16 04:41:10', '2021-12-16 04:41:10'),
('46334b1f-9d0e-4b7c-87a9-6e94a407e741', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":1,\"estado\":0}', NULL, '2021-12-16 02:18:28', '2021-12-16 02:18:28'),
('61cc407c-6a10-4252-8c5a-f276f8112014', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":7,\"estado\":0}', NULL, '2021-12-16 03:05:52', '2021-12-16 03:05:52'),
('762a3171-7c1f-4c9d-9d21-c4045532848e', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":19,\"estado\":0}', NULL, '2021-12-16 04:21:01', '2021-12-16 04:21:01'),
('805635b6-de6f-4bad-8c5b-a4008cb35711', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":4,\"estado\":0}', NULL, '2021-12-16 02:57:33', '2021-12-16 02:57:33'),
('94187003-1e7c-40de-bb7c-181cd7ed6f3b', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":8,\"estado\":0}', NULL, '2021-12-16 03:11:44', '2021-12-16 03:11:44'),
('aa809f9a-4cf5-47c6-aff4-5cbf5a0e241c', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":9,\"estado\":0}', NULL, '2021-12-16 03:13:38', '2021-12-16 03:13:38'),
('d5092ed8-7ee7-4554-b059-fbd3571315e1', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":6,\"estado\":0}', NULL, '2021-12-16 03:00:50', '2021-12-16 03:00:50'),
('e0a3c4da-a1a6-4194-ace9-8b35139dc42c', 'App\\Notifications\\EstadoVenta', 'App\\User', 1, '{\"venta_id\":5,\"estado\":0}', NULL, '2021-12-16 02:58:26', '2021-12-16 02:58:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `nombre`, `id_tipo_oferta`, `tiempo_limite`, `estado`, `created_at`, `updated_at`) VALUES
(1, '10', 1, '2021-11-26', 1, '2021-11-16 04:45:09', '2021-11-23 17:20:10'),
(2, '2 x 1', 2, '2021-12-09', 1, '2021-12-03 18:42:21', NULL),
(3, '50', 1, '2021-12-31', 1, '2021-12-14 03:04:19', '2021-12-14 03:04:19'),
(4, '12', 1, '2021-12-31', 1, '2021-12-14 20:18:17', '2021-12-14 20:18:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`id`, `title`, `descripcion`, `id_usuario`, `rating`, `id_producto`, `created_at`, `deleted_at`) VALUES
(1, 'Exelente', 'Exelente producto', 1, '5.0', 16, '2021-12-15 01:38:24', NULL),
(2, 'Buen sonido', 'Muy buen sonido', 1, '4.5', 1, '2021-12-15 01:39:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descripcion` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `imagen`, `descripcion`, `id_proveedor`, `id_marca`, `id_categoria`, `id_subcat`, `created_at`, `updated_at`) VALUES
(1, 'Audífonos in ear con cable usb-c', '[\"\\/storage\\/imagenes\\/productos\\/xtGWyQO3eSq5zeJGgFn7FN3ySBl2KR7OZVb8q1tl.webp\",\"\\/storage\\/imagenes\\/productos\\/w9nWDA2Kq4cgS4c0a4sJYzQa1MgSWe2znXj7eHyc.webp\",\"\\/storage\\/imagenes\\/productos\\/lFZxvdAtnrLQrXS9Ag1KDwe4iXsNkHFYEjBmyBna.webp\"]', 'Disfruta sin distorsiones. audio con calidad de estudio. Los auriculares Samsung Type-C están diseñados para separar verdaderamente las señales izquierda y derecha hasta 10 veces mejor que los auriculares de 3,5 mm. Y el DAC integrado mejora la calidad de lo que escuchas, por lo que tu lista de reproducción cobra vida como la concibió el artista.\r\n\r\nFabricados con altavoces de 2 vías, los auriculares tipo C de Samsung ofrecen un audio rico que se transmite de forma clara y equilibrada. La tecnología está ajustada por AKG, por lo que obtienes una calidad de sonido de nivel profesional.\r\n\r\nFabricados con materiales livianos, cada auricular está diseñado para que se sienta cómodamente en sus oídos para que pueda sintonizar el mundo con su música; simplemente elija entre las opciones de almohadillas incluidas para obtener el ajuste correcto. Y el cable de tela evita que los auriculares se enreden en su bolso o bolsillo.', 3, 11, 5, 21, '2021-12-14 02:12:43', '2021-12-14 03:22:11'),
(2, 'Bocina smart amazon echo dot azul 4ta gen', '[\"\\/storage\\/imagenes\\/productos\\/dE9IGginYUIId8GAORBiDGD2YMzLoqozowo4zLdK.webp\",\"\\/storage\\/imagenes\\/productos\\/LXmQ9O8HgXy80cSkihyQ1jyURWy46cBA1RdU6Omw.webp\",\"\\/storage\\/imagenes\\/productos\\/VVYShEIedSVDvxaibKB7KkVlCucnAcJTbKR1ZGXe.webp\"]', 'Completa cualquier habitación con Alexa. Nuestro parlante inteligente más popular tiene un diseño elegante y compacto que se ajusta a la perfección a espacios pequeños. Ofrece voces nítidas y bajos equilibrados, para un sonido completo que puedes disfrutar en cualquier parte de tu hogar.\r\n\r\nUsa tu voz para reproducir una canción, artista o género, por medio de Amazon Music, Apple Music, Spotify, Pandora y más. Con la música multihabitación, puedes llenar todo tu hogar de música, estaciones de radio, podcasts y Audible, al usar dispositivos Echo compatibles en diferentes habitaciones.\r\n\r\nHaz tu vida en casa más fácil. Configura alarmas, haz preguntas, agrega artículos a listas y crea eventos y recordatorios en calendarios. Revisa el tráfico y el clima, o reproduce las noticias. Accede a decenas de miles de Alexa skills, cómo Headspace o Sleep Sounds. Y haz todo eso solamente con tu voz.\r\n\r\nPasa por otras habitaciones instantáneamente o comunica algo en cada habitación que tenga un dispositivo Echo compatible. Hazles saber a todos que la cena está lista, o recuérdales a tus hijos que es hora de dormir. También puedes estar en contacto con amigos o familia, por medio de llamadas a manos libres.', 3, 12, 5, 21, '2021-12-14 02:20:50', '2021-12-14 03:25:36'),
(3, 'Tocadiscos con altavoces estereo - bluetooth', '[\"\\/storage\\/imagenes\\/productos\\/Si47b3lPNyFUdtQs9KKApchxM5BmxxheBTck4pTg.webp\",\"\\/storage\\/imagenes\\/productos\\/WyC6nBkH4RqY6Ja6SumjkoLOb3UklmA4LY6XwIO4.webp\",\"\\/storage\\/imagenes\\/productos\\/KDEBGVdHxtu2mC3X6f3xoFmtvSdRQMiIYEBa6TLa.webp\"]', 'Sonido de vinilo original. Nueva libertad inalámbrica, redescubra la experiencia atemporal del vinilo con controles simples y conectividad BLUETOOTH® estable. Con el tocadiscos PS-LX310BT, puede disfrutar de un sonido claro y natural, ya sea que esté reviviendo su LP favorito o compartiendo una reedición impresionante con la familia. Vinilo desenchufado, ahora puede disfrutar de su colección de vinilos con toda la comodidad de la tecnología inalámbrica. Conéctese mediante la tecnología BLUETOOTH® para escuchar sus discos favoritos en sus altavoces o auriculares inalámbricos. ¿Quieres sacar el máximo partido a tu vinilo? Ajuste el interruptor de ganancia para que coincida con el nivel de audio de su grabación, de modo que pueda escuchar su música en su mejor momento sin distorsiones.', 3, 7, 5, 22, '2021-12-14 02:25:58', '2021-12-14 03:26:02'),
(4, 'Computadora portatil chip M1 8gbram 256 ssd negro', '[\"\\/storage\\/imagenes\\/productos\\/gjGQth4A4Z6h4lucUSQRWw7nsAoIAajaGB8iB1Y1.webp\",\"\\/storage\\/imagenes\\/productos\\/Nhi6OsODZCnWgy5Z6ICNsBvfQ0ws681XZDrsik5n.webp\",\"\\/storage\\/imagenes\\/productos\\/xqsAylF7Dx3jH0A5HCn5anwQgvXdeuJkDG9XMeMf.webp\"]', 'El Apple MacBook Air de 13 \" incluye el primer chip de Apple diseñado específicamente para Mac. El Apple M1 integra la CPU, GPU, Neural Engine, E / S y más en un solo sistema en un chip (SoC). Aborde sus proyectos con la rapidez CPU de 8 núcleos y enfréntate a aplicaciones y juegos con uso intensivo de gráficos con la GPU de 7 núcleos. Acelera las tareas de aprendizaje automático con el motor neuronal de 16 núcleos. Completo con un diseño silencioso, sin ventilador y hasta 18 horas de duración de la batería, el MacBook Air sigue siendo portátil, pero ahora mucho más potente. También tiene 8 GB de RAM unificada y un SSD de 256 GB.\r\n\r\nCon más de 4 millones de píxeles, la pantalla Retina de 13,3 \"presenta una resolución de pantalla de 2560 x 1600 y una relación de aspecto de 16:10 para 227 píxeles por pulgada (ppi). La pantalla también presenta hasta un 48 por ciento más de color que la generación anterior. Con Tecnología True Tone, el balance de blancos se ajusta automáticamente para igualar la temperatura de color de la luz a tu alrededor para una experiencia de visualización más natural.\r\n\r\nConéctese a Internet a través de Wi-Fi 6 (802.11ax) y use periféricos y accesorios inalámbricos compatibles con Bluetooth 5.0. Los dos puertos Thunderbolt 3 brindan compatibilidad con USB4 e incluso se pueden conectar al Apple Pro Display XDR en una resolución completa de 6K. Apple también incluyó micrófonos con calidad de estudio para grabaciones y llamadas claras.', 3, 13, 1, 10, '2021-12-14 03:35:42', '2021-12-14 03:35:42'),
(5, 'Laptop de 15\" intel i7-1165g7 8gb - 512ssd', '[\"\\/storage\\/imagenes\\/productos\\/Dw8XOEXKdxqmfXty5QMkdcAcvd7cI6O75a882ft9.webp\",\"\\/storage\\/imagenes\\/productos\\/4tME6wpGJPZKPurruyXHY7WGX2GNBxe6SF01basR.webp\",\"\\/storage\\/imagenes\\/productos\\/oSAqh40zwEKPrAg1E5XEOu3Lxnm2CUrDmQOLLHLH.webp\"]', 'Con colores sobresalientes y una tecla Enter que bloquea el color, ASUS VivoBook Ultra K15 agrega estilo y dinamismo a la informática diaria. Con su procesador Intel Core i7 de 11va generación y la última GPU para grafícos muy exigentes, VivoBook Ultra K15 proporciona la potencia que necesita para hacer las cosas. También cuenta con un diseño de almacenamiento dual que combina las altas velocidades de datos de un SSD con las grandes capacidades de un HDD, brindándole lo mejor de ambos mundos para aumentar la productividad.\r\n\r\nCon un procesador Intel® Core ™ i7 y gráficos NVIDIA GeForce, el VivoBook 15 le brinda la potencia que necesita para hacer el trabajo.\r\n\r\nFavorece tu productividad, Rendimiento\r\nCon el procesador Intel Core ™ i7 de última generación con 16 GB de memoria y la última GPU NVIDIA GeForce MX330, el VivoBook 15 ofrece el rendimiento que necesita para hacer el trabajo.', 3, 9, 1, 10, '2021-12-14 03:40:07', '2021-12-14 03:40:07'),
(6, 'Laptop HP gaming Pavilion AMD R5 de 15\"', '[\"\\/storage\\/imagenes\\/productos\\/3Hd5fTTchztkWGZB45KCeOffT9G2hmK44GxBxxZM.webp\",\"\\/storage\\/imagenes\\/productos\\/UDSUiL2QaeqcklAXOOEo2nQbGqkg3V10dBli6eRZ.webp\",\"\\/storage\\/imagenes\\/productos\\/KsXbESXpLqWhs9sllJHHG6304w5VevOmtvBjTBh3.webp\"]', 'No sacrifiques nada gracias a la delgada y potente laptop HP Pavilion Gaming 15. Disfruta de gráficos de alta calidad y capacidad de procesamiento para jugar y realizar múltiples tareas, además del enfriamiento térmico mejorado1 para su rendimiento y estabilidad generales. Sumérgete en el juego gracias a una pantalla de bisel con microborde y audio personalizado. El equilibrio perfecto entre trabajo y juego, para que puedas hacer todo. Procesador móvil AMD Ryzen™ 4000 de la serie H con gráficos Radeon, para obtener un rendimiento absoluto para jugar y crear contenido, los procesadores móviles Ryzen™ 4000 de la serie H son el nuevo estándar para obtener rendimiento profesional en laptops innovadoras, nuevas, delgadas y ligeras.', 3, 6, 6, 23, '2021-12-14 03:45:03', '2021-12-14 03:45:03'),
(7, 'Computadora HP AIO Intel Celeron j4025 de 21\"', '[\"\\/storage\\/imagenes\\/productos\\/vBT3bC26HqgrwwToTjxDSPidpgzlbgdA7vsSn9Br.webp\",\"\\/storage\\/imagenes\\/productos\\/a4jGeAXvnZAueb7NCvph3xj2YCoeVM7XYIRLgoij.webp\"]', 'Tu computadora para todos los días, ¿Cansado de que tu viejo equipo ocupe tanto espacio? El equipo Todo-en-Uno HP combina la potencia de un equipo de escritorio con la elegancia de una pantalla elegante y delgada en un dispositivo confiable que está diseñado para crecer contigo.\r\n\r\nLa HP All-in-One es una computadora que combina el diseño ergonómico, funcionalidad y poder. Dándote seguridad y confianza para que todos en tu familia la utilicen sin ninguna preocupación. Incluye todo lo que necesitas sin gastar de más.\r\n\r\nConstruida para durar, haz múltiples tareas fácilmente con un procesador Intel Celeron j4025 fiable y almacena más de aquello que te gusta con 1TB de almacenamiento. Acompañado de un procesador gráfico Intel UHD 600. transmite contenido 4K de manera fluida y juega a tus juegos favoritos en 720p sin necesidad de una tarjeta gráfica independiente. Con el excelente rendimiento de los gráficos Intel UHD notarás la diferencia en todo lo que hagas..\r\n\r\nInnovación inteligente, transmite y navega sin preocupaciones con una cámara con obturador de privacidad que puedes cerrar cuando no la usas. Los micrófonos duales integrados y la reducción de ruido avanzada permiten que te oigan a ti, no a lo que te rodea.', 3, 6, 1, 10, '2021-12-14 03:54:19', '2021-12-14 03:54:19'),
(8, 'Microondas 0.7pcu silver', '[\"\\/storage\\/imagenes\\/productos\\/Rws5Fd9D3YBdMC5PhIbHRiN6ErIHpDwwwRXNKSA7.webp\",\"\\/storage\\/imagenes\\/productos\\/JH0dyrEvIpBtDOWbuUhX9JBtHK1VooSsxpfs3P4m.webp\",\"\\/storage\\/imagenes\\/productos\\/aLFkF9L7uFs2k1YdRAITHvQvQJgM5rRkEMhUCeun.webp\"]', 'Con 5 niveles de potencia, 4 opciones para descongelar y 12 opciones de autococción. Con función Mantener Caliente, Autolimpieza, Modo Ahorro de Energía. Pantalla y control digital con LED, y plato giratorio. Comida que te espera caliente por hasta 60 min, mantén calientes tus alimentos mientras realizas otras actividades, sin agregar tiempo de cocción; además tu comida no pierde su sabor o textura. Descongela en un paso y Función Eco\r\nDescongela tus alimentos en menos de 10 minutos, menos tiempo que otros. Ahorra hasta 66% de energía.', 1, 14, 2, 6, '2021-12-14 04:05:16', '2021-12-14 04:12:38'),
(9, 'Combo licuadora multiblend 800w negra', '[\"\\/storage\\/imagenes\\/productos\\/gEGcBLyRsd0iYul58hTyEHhIcJ4P5uwpKRQHmsuw.webp\"]', 'El versátil sistema de cocina MultiBlend® hace el trabajo de 3 electrodomésticos separados: una licuadora de cocina tradicional, un procesador de alimentos y una licuadora personal. Tiene un potente motor con 800 vatios de potencia máxima que tritura hielo, mezcla, mezcla, pica, rebana, tritura y más. Un solo sistema de cuchillas MultiBlend maneja todas sus necesidades de procesamiento de alimentos y licuado. Simplemente elija el accesorio adecuado: el 52 oz. Tarro de vidrio MultiBlend, el de 20 oz. frasco personal para batidos y batidos de una sola porción, o el accesorio del procesador de alimentos con un disco para rebanar y rallar incluido. Utilice el 52 oz. jarra de vidrio con pico vertedor sin goteo para hacer batidos o para hacer puré de salsa para pasta fresca. O cambie el frasco por el accesorio de procesador de alimentos de 3 tazas para picar verduras o picar ajo por un sofrito; incluye una rampa y un empujador de alimentos para facilitar la adición de alimentos. La porción individual de 20 oz. El tarro de viaje es perfecto para batidos matutinos cuando tienes prisa. No contiene BPA e incluye una tapa a prueba de fugas para beber mientras viaja. Diseñado para una mezcla más silenciosa, el sistema de cocina MultiBlend es fácil de operar, con toda la potencia que necesita y controles simples.', 1, 15, 2, 7, '2021-12-14 04:10:22', '2021-12-14 04:10:22'),
(10, 'Ipad pro 11-inch wi-fi 128gb m1 space gray', '[\"\\/storage\\/imagenes\\/productos\\/cc7AllivuQ0xhRp3IhMUE7FFBJ0d4IFzklJNMpLo.webp\",\"\\/storage\\/imagenes\\/productos\\/SV8xSwlcIgDbptfWkIKM4PTD4M4bTjLlFCeNMoAQ.webp\",\"\\/storage\\/imagenes\\/productos\\/M4d6egXo38PpX7gg7JCR58AFYIALme8YCpg48mYn.webp\"]', 'El Apple iPad Pro 11 (2021) es la renovación para el 2021 del iPad Pro con pantalla de Liquid Retina de 11 pulgadas a 1668 x 2388 pixels de resolución y potenciado por el procesador M1 de Apple con 128GB de almacenamiento interno y 8GB de memoria RAM. La cámara principal del iPad Pro 11\" es triple, con un sensor de 12 MP, un sensor de 10 MP, y un scanner LiDAR, mientras que la cámara frontal es ultrawide de 12 MP. La batería del iPad Pro 11 es de 7538 mAh y soporta carga rápida, cuenta con soporte para Apple Pencil, y cuenta con parlantes stereo.', 3, 13, 4, 19, '2021-12-14 04:20:05', '2021-12-14 04:20:05'),
(11, 'Celular Samsung A12 negro', '[\"\\/storage\\/imagenes\\/productos\\/QuNlfRbeD7DdV8UP39QF15nZfDa9CyNlKEtPUbEB.webp\",\"\\/storage\\/imagenes\\/productos\\/UZqfpjQ2MgiHtWQV6Y9wc6hNxSPa3M2lzkOOwMY7.webp\",\"\\/storage\\/imagenes\\/productos\\/daFGebesagjb1Gg7BqfDB7IUVaohUHtWRwnVyimT.webp\"]', 'El Samsung Galaxy A12 llega como sucesor del Galaxy A11 con una pantalla HD+ de 6.5 pulgadas y potenciado por un procesador de ocho núcleos, con 4GB de RAM con 64GB de almacenamiento,  expandible en  mediante ranura microSD. La cámara posterior del Galaxy A12 es cuádruple, con lentes de 48MP, 5MP, 2MP y 2MP, mientras que la cámara frontal para selfies es de 8 megapixels. Completando las características del Samsung Galaxy A12 econtramos una batería de 5000 mAh de carga rápida, lector de huellas montado de lado, y Android 10 a bordo.', 3, 1, 4, 18, '2021-12-14 20:19:52', '2021-12-14 20:19:52'),
(12, 'Iphone 13 pro max 512gb graphite', '[\"\\/storage\\/imagenes\\/productos\\/glHyuIkwIkyxeVQXvJkwemz4EUrHm97EG0VdzPQZ.webp\",\"\\/storage\\/imagenes\\/productos\\/4qgHylk6CssHH5K7v7D5cXu8uHqGemsOmjxmG8vs.webp\",\"\\/storage\\/imagenes\\/productos\\/6EIZ1meZL8p2xGhxKBquWyJztprLx9DnEl49squl.webp\"]', 'El Apple iPhone 13 Pro Max mejora a su predecesor con una tasa de refresco de pantalla de 120Hz, el nuevo procesador Apple A15 Bionic y mejoras en sus cámaras. Con una pantalla OLED de 6.7 pulgadas a resolución FHD+, el iPhone 13 Pro Max está disponible con 512GB de alamcenamiento interno. La cámara cuádruple llega con tres lentes de 12MP y un sensor ToF 3D que integra estabilización óptica de imagen y zoom 3x, y su cámara selfie es de 12MP. El iPhone 13 Pro Max cuenta con parlantes stereo, Face ID para seguridad, resistencia IP68 al polvo y agua, y carga rápida e inalámbrica.', 1, 13, 4, 19, '2021-12-14 20:25:51', '2021-12-14 20:25:51'),
(13, 'Cámara de seguridad smart para interior giro 360 2k', '[\"\\/storage\\/imagenes\\/productos\\/QmyUUWTlZiqQ91sqfrDGZeV4BaTKMMjCTccKGf9k.webp\",\"\\/storage\\/imagenes\\/productos\\/28VYTiwqIsTVktLPRtVbk4UpKyYXpxjST93hFHn0.webp\",\"\\/storage\\/imagenes\\/productos\\/Tw9Hzs2ougfs09CEOOP1BGjSYNVFl6wSVabldsKq.webp\"]', '2K ultra claro HD  actualizado, calidad de imagen totalmente mejorada\r\nLa Mi 360 ° Home Security Camera 2K utiliza tecnología ultra clara HD para capturar imágenes más detalladas. Disfrute de una experiencia visual mejorada con la tecnología HD ultra clara 2K totalmente mejorada.\r\n\r\nGran apertura F1.4 para una imagen clara incluso en condiciones de poca luz. La lente de gran apertura F1.4 permite que entre mucha más luz, capturando imágenes detalladas incluso en condiciones de poca luz.\r\n\r\nLente 6P mejorada para una visualización de mayor calidad\r\nLa lente completamente mejorada reduce efectivamente la refracción de la luz para obtener imágenes más claras y detalladas.\r\n\r\nVisión nocturna infrarroja mejorada para imágenes claras incluso con poca luz. La luz infrarroja de 940 nm sin brillo rojo visible lo deja a usted ya su familia durmiendo sin ser molestados; cuenta con un sensor de imagen de alta sensibilidad y muestra video en color incluso en condiciones de poca luz.', 3, 16, 6, 24, '2021-12-14 20:37:48', '2021-12-14 20:37:48'),
(14, 'Cocina a gas whirlpool 30 gris', '[\"\\/storage\\/imagenes\\/productos\\/MQLnePGDn7HhjnGYDMYQSDQfxsOkFwPqYcA2ZE56.webp\",\"\\/storage\\/imagenes\\/productos\\/x1htH9KDVqvN0sSHloNfwmBdyqhDX8kP8lrDYTuX.webp\",\"\\/storage\\/imagenes\\/productos\\/S7wlfkXhvQrMNMTMZFSu5duB4uXrODmejMPIWPzB.webp\"]', 'Cocina a gas de 30” pulgadas Whirlpool color gris con 6 quemadores; respaldo de cristal templado. Cubierta de acero inoxidable. Door stop system permite que la puerta del horno se cierre de forma suave, el horno tiene 1 parilla. Perillas ergonómicas Push & Turn. Tecnología everclean para facilitar la limpieza del horno.', 1, 14, 7, 1, '2021-12-14 20:45:43', '2021-12-14 20:45:43'),
(15, 'Lavadora carga superior 22kg Whirlpool xpert system', '[\"\\/storage\\/imagenes\\/productos\\/amHcNuiGKRA5e31ATUc1vOSt1lO4oRd1RVLfre5Y.webp\",\"\\/storage\\/imagenes\\/productos\\/aBWo8dczPLs1aJI1FpFsV9nKp0O24MQsFmOR3ZHV.webp\",\"\\/storage\\/imagenes\\/productos\\/7ijWwqnSIfrQw6FbX3up2tfouO4oLBVDzLWqgvgS.webp\"]', 'Lavadora Carga Superior con gran capacidad de 22 kg Whirlpool color Gun Metal con panel Shadow grey, cuenta con sistema de lavado Xpert System, el mejor sistema de lavado que remueve las manchas más difíciles mejor que otros. Cuenta con Smart Load: te permite conocer el nivel de tamaño de tu ropa seca y así poder elegir el tamaño correcto de carga: CH, M o G, también incluye AutoLevel: detecta el tamaño de carga automáticamente y programa el nivel exacto de agua que tus prendas necesitan. Con Agitador Triple Action con 10 movimientos expertos para una mayor limpieza y cuidado. Cuenta con depósitos automáticos de Detergente, Suavizante y Blanqueador. Con 12 ciclos, (3 ciclos Xpert: Ropa de Color, Ropa Blanca y el nuevo ciclo Intenso con Remojo) Doble Enjuague, Voluminosos, Jeans, Express, Delicados, Remojar, Solo Lavar, Enjuagar y Exprimir, Drenar y Exprimir. 4 temperaturas de agua: Fría, Semifría, Tibia y Caliente. 3 niveles de suciedad: Ligero, Normal e Intenso. Incluye Bloqueo de tapa, Luz LED Indicadora de la Etapa del Ciclo y canasta 100% Acero Inoxidable.', 3, 14, 7, 2, '2021-12-14 20:49:31', '2021-12-14 20:49:31'),
(16, 'Aire acondicionado inverter, mini split, 17.000 btu', '[\"\\/storage\\/imagenes\\/productos\\/6KvZ91bEqwMvHVK2MRhEh4z0a4Yx9g2Zz7E31GyZ.webp\"]', 'Minisplit con sistema inverter para ahorro de energía; mantén fresca la habitación de tus hijos con la tecnología de este minisplit de 17,000 BTU´s de 220 voltios. Modo sleep para que ningún ruido los interrumpa mientras duermen. Para manejarlo fácilmente incluye un práctico control remoto.\r\nNo inlcuye cable de alimentación de 220V.', 1, 14, 7, 3, '2021-12-14 20:54:13', '2021-12-14 20:54:13'),
(17, 'Refrigeradora Samsung french door negro mate 27 PCU', '[\"\\/storage\\/imagenes\\/productos\\/5ZN1MfyPEcmZArx7cH2uCtkgMJ2LRw1WrpyJRwG3.webp\",\"\\/storage\\/imagenes\\/productos\\/2sEGKgYctzqMWwvM94fkNWtVaWVTOvrkHHNgI3ZU.webp\",\"\\/storage\\/imagenes\\/productos\\/FcqM971b8PwHgsoIx0QROQNGSwMQZv1iKs0s8J8a.webp\"]', 'Mantén tu comida fresca por más tiempo y evita el desperdicio de alimentos. Su avanzada funcionalidad logra nuevos estándares en la precisión de temperatura, enfriando el refrigerador y el congelador individualmente, así tus alimentos se mantienen frescos por más tiempo. Tecnología Digital inverter, ofrece mayor durabilidad y ahorra energía hasta en un 50%. A diferencia de los compresores convencionales, ajusta su velocidad automáticamente en respuesta a la demanda de enfriamiento, lo que reduce el desgaste. Sistema All-around Cooling, comprueba continuamente la temperatura y expulsa aire frío. Así, el refrigerador se enfría de manera uniforme de esquina a esquina, por lo que cada alimento permanece fresco por más tiempo.\r\nMulti Flow, permite una distribución uniforme del aire frío en todo el refrigerador. Power Cool y Power Freeze, disfruta de un rápido rendimiento de refrigeración. Con solo tocar un botón, Power Cool libera aire muy frío en el refrigerador para enfriar rápidamente tus alimentos o bebidas favoritas.Fábrica de hielo automática, máquina que genera cubos de hielo de manera automática, ya que esta toma el agua del tanque de tu nevera y en sus moldes genera los cubos de hielo automáticamente', 1, 1, 7, 4, '2021-12-14 20:57:23', '2021-12-14 20:57:23'),
(18, 'Pantalla Samsung smart 85\" UHD/4K Crystal', '[\"\\/storage\\/imagenes\\/productos\\/eDgFyYOR20j7UU8WG3uVj324FuWpwxPcEedmPx6D.webp\",\"\\/storage\\/imagenes\\/productos\\/8FobJ9RhSgEkj5sx8FYKCD3M6AqHfGNVwgJtLeZJ.webp\",\"\\/storage\\/imagenes\\/productos\\/nW1w89gD4u3TfCoG0Sx7elN6KE0xz6RKOr5e47Sa.webp\"]', 'Colores increíbles para una imagen vibrante y vívida\r\nPurColor\r\nPurColor permite que los videos se sientan casi como si estuvieras allí. Permite que el televisor exprese una amplia gama de colores para un rendimiento de imagen óptimo y una experiencia de visualización inmersiva.\r\n\r\nSiente los tonos de colores vívidos con el potente 4K\r\nProcesador Crystal 4K\r\nEl poderoso aumento de 4K asegura que obtengas una resolución de hasta 4K para el contenido que amas. También experimentarás expresiones de color más realistas gracias a su sofisticada tecnología de asignación de color.\r\n\r\nMovimiento suave para una imagen clara\r\nMotion Xcelerator\r\nExperimenta una imagen y un rendimiento claros, ya que calcula y compensa automáticamente los fotogramas de la fuente de contenido.\r\n\r\nResolución 4K\r\nEl televisor 4K UHD va más allá del FHD, ya que tiene 4 veces más pixeles para que puedas ver las imágenes nítidas y claras que mereces. Ahora puedes ver incluso los detalles más pequeños en cada escena.\r\n\r\nHDR\r\nLa característica de alto rango dinámico (HDR) aumenta los niveles de luz del televisor para que puedas disfrutar de un enorme espectro de colores y detalles visuales, incluso en las escenas más oscuras.\r\n\r\nElimina el desorden\r\nSolución para ocultar los cables\r\nMantén tus cables ordenados y escóndelos para disminuir el desorden y mantener una apariencia perfecta en tu TV.', 1, 1, 8, 25, '2021-12-14 21:03:25', '2021-12-14 21:03:25'),
(19, 'Pantalla led smart 43\" uhd/4k', '[\"\\/storage\\/imagenes\\/productos\\/DzkYKydt7qMetIeEi2Rq9L9gmCDRZA0YFoRAiKMv.webp\",\"\\/storage\\/imagenes\\/productos\\/1e3Usu7yNYKdZsyLwNgko26L9BkRNcJs07PVKFev.webp\",\"\\/storage\\/imagenes\\/productos\\/N76hUgjfuHG9bIxCU6XUVr5sMujEbbj7qhm4Fpyg.webp\"]', 'Diseño sin bisel para una experiencia de visualización única\r\nSin bisel en tres lados, este diseño innovador ofrece una relación pantalla-cuerpo más alta y ángulos de visión de 178 °, lo que brinda una experiencia de visualización más inmersiva y agradable.\r\n\r\nExperimente la maravilla de 4K Ultra HD, la resolución 4K UHD ofrece imágenes reales con más detalles y mayor profundidad\r\n\r\nAdmite Dolby Vision para obtener detalles tanto en la oscuridad como en la claridad, un rango dinámico más alto brinda brillos más brillantes y oscuros más oscuros al mejorar la nitidez, el contraste y el color de las imágenes, mientras que los niveles de detalle realistas le permiten ver más que nunca.\r\n\r\nSuavizado de movimiento MEMC para una mayor fluidez sin vibraciones\r\nMEMC puede insertar automáticamente fotogramas de compensación en contenido de baja velocidad de fotogramas para eliminar el desgarro y la vibración de la pantalla, brindando mayor fluidez a los movimientos rápidos durante eventos deportivos, carreras de autos y más.\r\n\r\nUse su voz para crear el entorno de vida perfecto\r\nSe pueden realizar operaciones complejas con simples comandos de voz en un rango de hasta tres metros. Pídale a Google que controle su televisor, responda preguntas y vea su calendario. Haga que controle los dispositivos domésticos inteligentes en toda su casa.', 1, 16, 8, 25, '2021-12-14 21:07:35', '2021-12-14 21:07:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `direccion`, `telefono`, `nombre_contacto`, `tel_contacto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Caribean Ocean S.A de C.V', 'Puerto la Liberta, Pje.Panama', 22279969, 'Juan Esparza', 76691123, 1, '2021-12-13 19:22:58', NULL),
(2, 'Muebles Pablo S.A de C.V', 'Santa Tecla', 22279969, 'Romario Cafu', 76601123, 1, '2021-12-13 19:22:58', NULL),
(3, 'Global Tecla S.A de C.V', 'San Salvador, Soyapango', 22279969, 'Raul Gomez', 61105058, 1, '2021-12-13 19:22:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_categorias`
--

DROP TABLE IF EXISTS `sub_categorias`;
CREATE TABLE IF NOT EXISTS `sub_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategorias_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `sub_categorias`
--

INSERT INTO `sub_categorias` (`id`, `nombre`, `id_categoria`, `created_at`, `updated_at`) VALUES
(1, 'Cocinas', 7, '2021-12-13 19:03:03', NULL),
(2, 'Lavanderia', 7, '2021-12-13 19:03:03', NULL),
(3, 'Climatización', 7, '2021-12-13 19:03:03', NULL),
(4, 'Refrigeradoras', 7, '2021-12-13 19:03:03', NULL),
(6, 'Microondas y Hornos', 2, '2021-12-13 19:03:03', NULL),
(7, 'Preparación de Alimentos', 2, '2021-12-13 19:03:03', NULL),
(8, 'Limpieza del Hogar', 2, '2021-12-13 19:03:03', NULL),
(9, 'Freidoras y Parrillas', 2, '2021-12-13 19:03:03', NULL),
(10, 'Laptops y Desktop', 1, '2021-12-13 19:03:03', NULL),
(11, 'Impresoras', 1, '2021-12-13 19:03:03', NULL),
(12, 'Accesorios', 1, '2021-12-13 19:03:03', NULL),
(13, 'Salas', 3, '2021-12-13 19:03:03', NULL),
(14, 'Muebles de Oficina', 3, '2021-12-13 19:03:03', NULL),
(15, 'Muebles de Cocina', 3, '2021-12-13 19:03:03', NULL),
(16, 'Muebles de Comedor', 3, '2021-12-13 19:03:03', NULL),
(17, 'Camas', 3, '2021-12-13 19:03:03', NULL),
(18, 'Android', 4, '2021-12-13 19:03:03', NULL),
(19, 'IOS', 4, '2021-12-13 19:03:03', NULL),
(21, 'Bocinas', 5, '2021-12-13 19:03:03', NULL),
(22, 'Equipos de Sonido', 5, '2021-12-13 19:03:03', NULL),
(23, 'Gaming', 6, '2021-12-13 19:03:03', NULL),
(24, 'Fotografía', 6, '2021-12-13 19:03:03', NULL),
(25, 'Televisores', 8, '2021-12-13 19:03:03', NULL),
(26, 'Equipaje', 9, '2021-12-13 19:03:03', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_tipo_usuario` int NOT NULL DEFAULT '2',
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `email_verified_at`, `password`, `id_tipo_usuario`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jose', '/storage/frontend/client/1/I3dlRsJCywGFjSkFQZLz10PYihYzeCAs3z00TPBb.jpg', 'zerodrieswolf@gmail.com', '2021-12-13 23:04:10', '$2y$10$qgBLADy.IXhaqH6HJq5/ZODFG0d37mgDnO5.qbwovsh4vuqbYrjqm', 1, NULL, '2021-12-13 23:02:57', '2021-12-13 23:16:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `total`, `num_transaccion`, `estado`, `id_direccion`, `id_metodo_pago`, `created_at`, `updated_at`) VALUES
(1, 1, '5398.80', 'ade3bb1ed590fe1f73bdef4b74746a7b36fc62e2', 0, 1, 5, '2021-12-16 02:18:27', '2021-12-16 02:18:27'),
(2, 1, '295.00', '3e5428852548d3eb25bf1e445d7259a2a3b56fcd', 0, 1, 5, '2021-12-16 02:51:47', '2021-12-16 02:51:47'),
(3, 1, '450.00', 'db1d0e2f699bc292688f4efe69311db2d44e3682', 0, 1, 5, '2021-12-16 02:52:25', '2021-12-16 02:52:25'),
(4, 1, '44.00', '55b63dd9705160252033e11facd7b7089461c7fb', 0, 1, 5, '2021-12-16 02:57:33', '2021-12-16 02:57:33'),
(5, 1, '59.00', 'a3ad51c0588581f1c6f200ccd995db56efb100ce', 0, 1, 5, '2021-12-16 02:58:26', '2021-12-16 02:58:26'),
(6, 1, '189.20', '197563854914ed1e23bf47e063f2b434bdea660a', 0, 1, 5, '2021-12-16 03:00:50', '2021-12-16 03:00:50'),
(7, 1, '1287.00', 'd06c3b9a112a92647023b581d5b3e695c86965f5', 0, 1, 5, '2021-12-16 03:05:52', '2021-12-16 03:05:52'),
(8, 1, '22.00', '12244f3ca98935df36ea3c0dcda25fcebd671899', 0, 1, 5, '2021-12-16 03:11:44', '2021-12-16 03:11:44'),
(9, 1, '22.00', 'ab0f6f70ba4525f25d38f8901d2a98c366df6f81', 0, 1, 5, '2021-12-16 03:13:38', '2021-12-16 03:13:38'),
(19, 1, '55.00', 'cfbab8610e506a73ce8cbbf6bde9420fde2fedf9', 0, 2, 5, '2021-12-16 04:21:01', '2021-12-16 04:21:01'),
(20, 1, '5400.00', 'bb5de3a1743353db54b8763959883a69f8f0d7a8', 0, 2, 5, '2021-12-16 04:41:10', '2021-12-16 04:41:10');

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
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `fk_opiniones_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_opiniones_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `fk_perfiles_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_subcategorias` FOREIGN KEY (`id_subcat`) REFERENCES `sub_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub_categorias`
--
ALTER TABLE `sub_categorias`
  ADD CONSTRAINT `fk_subcategorias_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_direcciones` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`),
  ADD CONSTRAINT `fk_ventas_metodo_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodos_pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
