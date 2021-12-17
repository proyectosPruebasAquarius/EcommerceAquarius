CREATE DATABASE  IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecommerce`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Electronica',1,'2021-11-06 23:44:09','2021-11-06 23:44:09'),(2,'Computacion',1,'2021-11-06 23:45:40','2021-11-06 23:45:40'),(3,'Automotriz update',1,'2021-11-09 01:55:13','2021-11-09 02:43:16'),(4,'Telefonia',1,'2021-11-09 01:56:53','2021-11-09 01:56:53'),(5,'Ejemplo',1,'2021-11-09 01:57:44','2021-11-09 01:57:44'),(6,'ejenmplo',1,'2021-11-09 01:58:20','2021-11-09 01:58:20'),(7,'Ejemplo 3',1,'2021-11-09 01:59:36','2021-11-09 01:59:36'),(8,'Ejemplo 5',1,'2021-11-09 02:00:49','2021-11-09 02:00:49'),(9,'otro ejemplo',1,'2021-11-09 02:05:23','2021-11-09 02:05:23'),(10,'EJEMPLOAA',1,'2021-11-18 02:44:23','2021-11-18 02:44:23'),(11,'SADAWDASDWAWDSA',1,'2021-11-18 02:44:30','2021-11-18 02:44:30'),(12,'DSADWADSADFFVVVVV',1,'2021-11-18 02:44:35','2021-11-18 02:44:35');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Ahuachapán',NULL,NULL),(2,'Cabañas',NULL,NULL),(3,'Chalatenango',NULL,NULL),(4,'Cuscatlán',NULL,NULL),(5,'La Libertad',NULL,NULL),(6,'La Paz',NULL,NULL),(7,'La Unión',NULL,NULL),(8,'Morazán',NULL,NULL),(9,'San Miguel',NULL,NULL),(10,'San Salvador',NULL,NULL),(11,'San Vicente',NULL,NULL),(12,'Santa Ana',NULL,NULL),(13,'Sonsonate',NULL,NULL),(14,'Usulután',NULL,NULL);
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_venta` int NOT NULL,
  `cantidad` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ventas`
--

LOCK TABLES `detalle_ventas` WRITE;
/*!40000 ALTER TABLE `detalle_ventas` DISABLE KEYS */;
INSERT INTO `detalle_ventas` VALUES (1,7,2,1,'2021-11-20 22:54:47','2021-11-20 22:54:47'),(2,8,2,1,'2021-11-20 22:54:47','2021-11-20 22:54:47'),(3,7,3,1,'2021-11-23 03:45:52','2021-11-23 03:45:52'),(4,8,3,1,'2021-11-23 03:45:52','2021-11-23 03:45:52'),(7,7,5,1,'2021-11-23 03:47:58','2021-11-23 03:47:58'),(8,8,5,1,'2021-11-23 03:47:58','2021-11-23 03:47:58'),(9,7,6,1,'2021-11-23 03:49:33','2021-11-23 03:49:33'),(10,8,6,1,'2021-11-23 03:49:33','2021-11-23 03:49:33'),(11,7,7,1,'2021-11-23 03:50:25','2021-11-23 03:50:25'),(12,8,7,1,'2021-11-23 03:50:25','2021-11-23 03:50:25'),(13,7,8,1,'2021-11-23 03:53:23','2021-11-23 03:53:23'),(14,8,8,1,'2021-11-23 03:53:23','2021-11-23 03:53:23'),(15,7,9,1,'2021-11-23 03:53:50','2021-11-23 03:53:50'),(16,8,9,1,'2021-11-23 03:53:50','2021-11-23 03:53:50'),(17,7,10,1,'2021-11-23 21:21:29','2021-11-23 21:21:29'),(18,8,12,1,'2021-11-23 21:24:08','2021-11-23 21:24:08'),(19,7,13,1,'2021-11-24 00:52:00','2021-11-24 00:52:00'),(20,8,14,2,'2021-11-24 00:53:19','2021-11-24 00:53:19'),(21,7,15,2,'2021-11-24 00:55:54','2021-11-24 00:55:54'),(22,8,16,2,'2021-11-24 00:57:59','2021-11-24 00:57:59'),(23,8,17,1,'2021-11-24 00:58:36','2021-11-24 00:58:36'),(24,7,18,1,'2021-11-24 01:21:01','2021-11-24 01:21:01'),(25,8,18,1,'2021-11-24 01:21:01','2021-11-24 01:21:01'),(26,8,19,1,'2021-11-24 01:28:26','2021-11-24 01:28:26'),(27,8,20,1,'2021-11-24 01:29:34','2021-11-24 01:29:34'),(28,8,21,1,'2021-11-24 01:30:55','2021-11-24 01:30:55'),(29,7,22,1,'2021-11-24 01:34:06','2021-11-24 01:34:06'),(30,8,23,1,'2021-11-24 01:35:44','2021-11-24 01:35:44'),(31,8,24,1,'2021-11-24 01:39:21','2021-11-24 01:39:21'),(32,7,25,1,'2021-11-24 01:48:32','2021-11-24 01:48:32'),(33,7,26,1,'2021-11-24 02:15:39','2021-11-24 02:15:39'),(34,7,27,1,'2021-11-25 03:52:50','2021-11-25 03:52:50'),(35,7,28,1,'2021-12-01 04:07:22','2021-12-01 04:07:22'),(36,9,28,1,'2021-12-01 04:07:22','2021-12-01 04:07:22'),(37,10,28,1,'2021-12-01 04:07:22','2021-12-01 04:07:22'),(38,8,28,1,'2021-12-01 04:07:22','2021-12-01 04:07:22');
/*!40000 ALTER TABLE `detalle_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones`
--

DROP TABLE IF EXISTS `direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direcciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint unsigned NOT NULL,
  `id_municipio` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direcciones_id_user_foreign` (`id_user`),
  KEY `direcciones_id_municipio_foreign` (`id_municipio`),
  CONSTRAINT `direcciones_id_municipio_foreign` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `direcciones_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones`
--

LOCK TABLES `direcciones` WRITE;
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
INSERT INTO `direcciones` VALUES (2,'por ahi en una calle del bazar col uno','Jose Antonio','Alas Alvarenga','example@example.com','12345678',1,1,NULL,NULL),(3,'por ahi en una calle del bazar col uno','Jose Antonio','Alas Alvarenga','example@example.com','12345678',7,1,NULL,NULL),(4,'Direccion de prueba 2','Diego','Martinez','admin@gmail.com','23659856',7,26,'2021-11-23 03:45:52','2021-11-23 03:45:52');
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventarios`
--

DROP TABLE IF EXISTS `inventarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventarios` (
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
  KEY `fk_inventarios_ofertas` (`id_oferta`),
  CONSTRAINT `fk_inventarios_ofertas` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inventarios_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventarios`
--

LOCK TABLES `inventarios` WRITE;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
INSERT INTO `inventarios` VALUES (1,80.55,210.50,'AAS45WAD66',2,7,1,1,'2021-11-17 21:54:34','2021-11-17 23:57:41'),(2,100.00,150.00,'LDLA6464AAP',5,8,1,1,'2021-11-20 03:01:47','2021-11-20 03:01:47'),(3,1200.00,1350.00,'ALLLPPPP55',2,10,1,1,'2021-11-30 02:25:50','2021-11-30 02:25:50'),(4,99.00,120.00,'AA896556AQ',298,9,1,1,'2021-11-30 02:31:22','2021-11-30 02:31:22'),(5,85.00,105.00,'A556EERSA7',80,11,1,1,'2021-11-30 02:38:10','2021-11-30 02:38:10');
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Samsung','1636139103.png',1,'2021-11-06 07:05:03','2021-11-29 22:57:48'),(2,'Dell','1636150932.png',1,'2021-11-06 07:06:55','2021-11-29 22:57:40'),(4,'Bosch','1638205049.png',1,'2021-11-11 02:24:44','2021-11-29 22:57:29'),(5,'Canon','1638205128.png',1,'2021-11-29 22:58:48','2021-11-29 22:58:48'),(6,'Hp','1638205184.png',1,'2021-11-29 22:59:44','2021-11-29 22:59:44'),(7,'Sony','1638205198.png',1,'2021-11-29 22:59:58','2021-11-29 22:59:58'),(8,'Gucci','1638205493.png',1,'2021-11-29 23:04:53','2021-11-29 23:04:53'),(9,'Asus','1638206132.png',1,'2021-11-29 23:09:26','2021-11-29 23:15:32');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departamento` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipios_id_departamento_foreign` (`id_departamento`),
  CONSTRAINT `municipios_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO `municipios` VALUES (1,'Ahuachapán',1,NULL,NULL),(2,'Apaneca',1,NULL,NULL),(3,'Atiquizaya',1,NULL,NULL),(4,'Concepción de Ataco',1,NULL,NULL),(5,'El Refugio',1,NULL,NULL),(6,'Guaymango',1,NULL,NULL),(7,'Jujutla',1,NULL,NULL),(8,'San Francisco Menéndez',1,NULL,NULL),(9,'San Lorenzo',1,NULL,NULL),(10,'San Pedro Puxtla',1,NULL,NULL),(11,'Tacuba',1,NULL,NULL),(12,'Turín',1,NULL,NULL),(13,'Cinquera',2,NULL,NULL),(14,'Dolores',2,NULL,NULL),(15,'Guacotecti',2,NULL,NULL),(16,'Ilobasco ',2,NULL,NULL),(17,'Jutiapa',2,NULL,NULL),(18,'San Isidro',2,NULL,NULL),(19,'Sensuntepeque',2,NULL,NULL),(20,'Tejutepeque',2,NULL,NULL),(21,'Victoria',2,NULL,NULL),(22,'Agua Caliente',3,NULL,NULL),(23,'Arcatao',3,NULL,NULL),(24,'Azacualpa',3,NULL,NULL),(25,'Cancasque',3,NULL,NULL),(26,'Chalatenango',3,NULL,NULL),(27,'Citalá',3,NULL,NULL),(28,'Comalapa',3,NULL,NULL),(29,'Concepción Quezaltepeque',3,NULL,NULL),(30,'Dulce Nombre de María',3,NULL,NULL),(31,'El Carrizal',3,NULL,NULL),(32,'El Paraíso',3,NULL,NULL),(33,'La Laguna',3,NULL,NULL),(34,'La Palma',3,NULL,NULL),(35,'La Reina',3,NULL,NULL),(36,'Las Vueltas',3,NULL,NULL),(37,'Los Ranchos',3,NULL,NULL),(38,'Nombre de Jesús',3,NULL,NULL),(39,'Nueva Concepción',3,NULL,NULL),(40,'Nueva Trinidad',3,NULL,NULL),(41,'San José Ojos de Agua',3,NULL,NULL),(42,'Potonico',3,NULL,NULL),(43,'San Antonio de La Cruz',3,NULL,NULL),(44,'San Fernando',3,NULL,NULL),(45,'San Francisco Lempa',3,NULL,NULL),(46,'San Francisco Morazán',3,NULL,NULL),(47,'San Ignacio',3,NULL,NULL),(48,'San Isidro ',3,NULL,NULL),(49,'San José Las Flores',3,NULL,NULL),(50,'San Luis del Carmen',3,NULL,NULL),(51,'San Miguel de Mercedes',3,NULL,NULL),(52,'San Rafael',3,NULL,NULL),(53,'Santa Rita',3,NULL,NULL),(54,'Tejutla',3,NULL,NULL),(55,'Candelaria',4,NULL,NULL),(56,'Cojutepeque',4,NULL,NULL),(57,'El Carmen',4,NULL,NULL),(58,'El Rosario',4,NULL,NULL),(59,'Monte San Juan',4,NULL,NULL),(60,'Oratorio de Concepción',4,NULL,NULL),(61,'San Bartolomé Perulapilla',4,NULL,NULL),(62,'San Cristobal',4,NULL,NULL),(63,'San José Guayabal',4,NULL,NULL),(64,'San Pedro Perulapán',4,NULL,NULL),(65,'San Rafael Cedros',4,NULL,NULL),(66,'San Ramón',4,NULL,NULL),(67,'Santa Cruz Analquito',4,NULL,NULL),(68,'Santa Cruz Michapa',4,NULL,NULL),(69,'Suchitoto',4,NULL,NULL),(70,'Tenancingo',4,NULL,NULL),(71,'Antiguo Cuscatlán',5,NULL,NULL),(72,'Chiltiupán',5,NULL,NULL),(73,'Ciudad Arce',5,NULL,NULL),(74,'Colón',5,NULL,NULL),(75,'Comasagua',5,NULL,NULL),(76,'Huizúcar',5,NULL,NULL),(77,'Jayaque',5,NULL,NULL),(78,'Jicalapa',5,NULL,NULL),(79,'La Libertad',5,NULL,NULL),(80,'Nuevo Cuscatlán',5,NULL,NULL),(81,'Quezaltepeque',5,NULL,NULL),(82,'Sacacoyo',5,NULL,NULL),(83,'San José Villanueva',5,NULL,NULL),(84,'San Juan Opico',5,NULL,NULL),(85,'San Matías',5,NULL,NULL),(86,'San Pablo Tacachico',5,NULL,NULL),(87,'Santa Tecla',5,NULL,NULL),(88,'Talnique',5,NULL,NULL),(89,'Tamanique',5,NULL,NULL),(90,'Teotepeque',5,NULL,NULL),(91,'Tepecoyo',5,NULL,NULL),(92,'Zaragoza',5,NULL,NULL),(93,'Cuyultitán',6,NULL,NULL),(94,'El Rosario',6,NULL,NULL),(95,'Jerusalen',6,NULL,NULL),(96,'Mercedes la Ceiba',6,NULL,NULL),(97,'Olocuilta',6,NULL,NULL),(98,'Paraíso de Osorio',6,NULL,NULL),(99,'San Antonio Masahuat',6,NULL,NULL),(100,'San Emigdio',6,NULL,NULL),(101,'San Francisco Chinameca',6,NULL,NULL),(102,'San Juan Nonualco',6,NULL,NULL),(103,'San Juan Talpa',6,NULL,NULL),(104,'San Juan Tepezontes',6,NULL,NULL),(105,'San Luis La Herradura',6,NULL,NULL),(106,'San Luis Talpa',6,NULL,NULL),(107,'San Miguel Tepezontes',6,NULL,NULL),(108,'San Pedro Masahuat',6,NULL,NULL),(109,'San Pedro Nonualco',6,NULL,NULL),(110,'San Rafael Obrajuelo',6,NULL,NULL),(111,'Santa María Ostuma',6,NULL,NULL),(112,'Santiago Nonualco',6,NULL,NULL),(113,'Tapalhuaca',6,NULL,NULL),(114,'Zacatecoluca',6,NULL,NULL),(115,'Anamorós',7,NULL,NULL),(116,'Bolívar',7,NULL,NULL),(117,'Concepción de Oriente',7,NULL,NULL),(118,'Conchagua',7,NULL,NULL),(119,'El Carmen',7,NULL,NULL),(120,'El Sauce',7,NULL,NULL),(121,'Intipucá',7,NULL,NULL),(122,'La Unión',7,NULL,NULL),(123,'Lislique',7,NULL,NULL),(124,'Meanguera del Golfo',7,NULL,NULL),(125,'Nueva Esparta',7,NULL,NULL),(126,'Pasaquina',7,NULL,NULL),(127,'Polorós',7,NULL,NULL),(128,'San Alejo',7,NULL,NULL),(129,'San José',7,NULL,NULL),(130,'Santa Rosa de Lima',7,NULL,NULL),(131,'Yayantique',7,NULL,NULL),(132,'Yucuaiquín',7,NULL,NULL),(133,'Arambala',8,NULL,NULL),(134,'Cacaopera',8,NULL,NULL),(135,'Chilanga',8,NULL,NULL),(136,'Corinto',8,NULL,NULL),(137,'Delicias de Concepción ',8,NULL,NULL),(138,'El Divisadero',8,NULL,NULL),(139,'El Rosario',8,NULL,NULL),(140,'Gualococti',8,NULL,NULL),(141,'Guatajiagua',8,NULL,NULL),(142,'Joateca',8,NULL,NULL),(143,'Jocoatique',8,NULL,NULL),(144,'Jocoro',8,NULL,NULL),(145,'Lolotiquillo',8,NULL,NULL),(146,'Meanquera',8,NULL,NULL),(147,'Osicala',8,NULL,NULL),(148,'Perquín ',8,NULL,NULL),(149,'San Carlos',8,NULL,NULL),(150,'San Fernando - Morazán',8,NULL,NULL),(151,'San Francisco Gotera',8,NULL,NULL),(152,'San Isidro',8,NULL,NULL),(153,'San Simón',8,NULL,NULL),(154,'Sensembra',8,NULL,NULL),(155,'Sociedad',8,NULL,NULL),(156,'Torola',8,NULL,NULL),(157,'Yamabal',8,NULL,NULL),(158,'Yoloaiquín',8,NULL,NULL),(159,'Carolina',9,NULL,NULL),(160,'Chapeltique',9,NULL,NULL),(161,'Chinameca',9,NULL,NULL),(162,'Chirilagua',9,NULL,NULL),(163,'Ciudad Barrios',9,NULL,NULL),(164,'Comacarán',9,NULL,NULL),(165,'El Tránsito',9,NULL,NULL),(166,'Lolotique',9,NULL,NULL),(167,'Moncagua',9,NULL,NULL),(168,'Nueva Guadalupe',9,NULL,NULL),(169,'Nuevo Eden de San Juan',9,NULL,NULL),(170,'Quelepa',9,NULL,NULL),(171,'San Antonio',9,NULL,NULL),(172,'San Gerardo',9,NULL,NULL),(173,'San Jorge',9,NULL,NULL),(174,'San Luis de La Reina',9,NULL,NULL),(175,'San Miguel',9,NULL,NULL),(176,'San Rafael Oriente',9,NULL,NULL),(177,'Sesori',9,NULL,NULL),(178,'Uluazapa',9,NULL,NULL),(179,'Aguilares',10,NULL,NULL),(180,'Apopa',10,NULL,NULL),(181,'Ayutuxtepeque',10,NULL,NULL),(182,'Ciudad Delgado',10,NULL,NULL),(183,'Cuscatancingo',10,NULL,NULL),(184,'El Paisnal',10,NULL,NULL),(185,'Guazapa',10,NULL,NULL),(186,'Ilopango',10,NULL,NULL),(187,'Mejicanos',10,NULL,NULL),(188,'Nejapa',10,NULL,NULL),(189,'Panchimalco',10,NULL,NULL),(190,'Rosario de Mora',10,NULL,NULL),(191,'San Marcos',10,NULL,NULL),(192,'San Martín',10,NULL,NULL),(193,'San Salvador',10,NULL,NULL),(194,'Santiago Texacuangos',10,NULL,NULL),(195,'Santo Tomas',10,NULL,NULL),(196,'Soyapango',10,NULL,NULL),(197,'Tonacatepeque',10,NULL,NULL),(198,'Apastepeque',11,NULL,NULL),(199,'Guadalupe',11,NULL,NULL),(200,'San Cayetano Istepeque',11,NULL,NULL),(201,'San Esteban Catarina',11,NULL,NULL),(202,'San Ildefonso',11,NULL,NULL),(203,'San Lorenzo',11,NULL,NULL),(204,'San Sebastián',11,NULL,NULL),(205,'San Vicente',11,NULL,NULL),(206,'Santa Clara',11,NULL,NULL),(207,'Santo Domingo',11,NULL,NULL),(208,'Tecoluca',11,NULL,NULL),(209,'Tepetitán',11,NULL,NULL),(210,'Verapaz',11,NULL,NULL),(211,'Candelaria de la Frontera',12,NULL,NULL),(212,'Chalchuapa',12,NULL,NULL),(213,'Coatepeque',12,NULL,NULL),(214,'El Congo',12,NULL,NULL),(215,'El Porvenir',12,NULL,NULL),(216,'Masahuat',12,NULL,NULL),(217,'Metapán',12,NULL,NULL),(218,'San Antonio Pajonal',12,NULL,NULL),(219,'San Sebastián Salitríllo',12,NULL,NULL),(220,'Santa Ana',12,NULL,NULL),(221,'Santa Rosa Guachipilín',12,NULL,NULL),(222,'Santiago de la Frontera',12,NULL,NULL),(223,'Texistepeque',12,NULL,NULL),(224,'Acajutla',13,NULL,NULL),(225,'Armenia',13,NULL,NULL),(226,'Caluco',13,NULL,NULL),(227,'Cuisnahuat',13,NULL,NULL),(228,'Izalco',13,NULL,NULL),(229,'Juayúa',13,NULL,NULL),(230,'Nahuilingo',13,NULL,NULL),(231,'Nahuizalco',13,NULL,NULL),(232,'Salcoatitán',13,NULL,NULL),(233,'San Antonio del Monte',13,NULL,NULL),(234,'San Julián',13,NULL,NULL),(235,'Santa Catarina Masahuat',13,NULL,NULL),(236,'Santa Isabel Ishuatán',13,NULL,NULL),(237,'Santo Domingo de Guzmán',13,NULL,NULL),(238,'Sonsonate',13,NULL,NULL),(239,'Sonzacate',13,NULL,NULL),(240,'Alegría',14,NULL,NULL),(241,'Berlín',14,NULL,NULL),(242,'California',14,NULL,NULL),(243,'Concepción Batres',14,NULL,NULL),(244,'El Triunfo',14,NULL,NULL),(245,'Ereguayquín',14,NULL,NULL),(246,'Estanzuelas',14,NULL,NULL),(247,'Jiquilisco',14,NULL,NULL),(248,'Jucuapa',14,NULL,NULL),(249,'Jucuarán',14,NULL,NULL),(250,'Mercedes Umaña',14,NULL,NULL),(251,'Nueva Granada',14,NULL,NULL),(252,'Osatlán',14,NULL,NULL),(253,'Puerto El Triunfo',14,NULL,NULL),(254,'San Agustín',14,NULL,NULL),(255,'San Buenaventura',14,NULL,NULL),(256,'San Dionisio',14,NULL,NULL),(257,'San Francisco Javier',14,NULL,NULL),(258,'Santa Elena',14,NULL,NULL),(259,'Santa María',14,NULL,NULL),(260,'Santiago de María',14,NULL,NULL),(261,'Tecapán',14,NULL,NULL),(262,'Usulután',14,NULL,NULL);
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `id_tipo_oferta` int NOT NULL,
  `tiempo_limite` date NOT NULL,
  `estado` int DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_ofertas_tipos_ofertas` (`id_tipo_oferta`),
  CONSTRAINT `fk_ofertas_tipos_ofertas` FOREIGN KEY (`id_tipo_oferta`) REFERENCES `tipos_ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,'10',1,'2021-11-26',1,'2021-11-16 04:45:09','2021-11-23 17:20:10');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opiniones`
--

DROP TABLE IF EXISTS `opiniones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opiniones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `id_usuario` bigint unsigned NOT NULL,
  `rating` decimal(10,1) NOT NULL DEFAULT '0.0',
  `id_producto` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_opiniones_users` (`id_usuario`),
  KEY `fk_opiniones_productos` (`id_producto`),
  CONSTRAINT `fk_opiniones_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_opiniones_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opiniones`
--

LOCK TABLES `opiniones` WRITE;
/*!40000 ALTER TABLE `opiniones` DISABLE KEYS */;
INSERT INTO `opiniones` VALUES (1,'usado really test','Nice producto from los gringos [edited]',1,4.5,1,'2021-11-09 05:35:07','2021-11-15 16:44:32',NULL),(2,'nuevo','adios',1,0.5,1,'2021-11-09 05:36:53','2021-11-15 16:44:32',NULL),(3,'ahi se va','asdasd',1,1.0,1,'2021-11-09 05:37:30','2021-11-15 16:44:32',NULL),(4,'curioso','asdasda',1,2.0,1,'2021-11-09 05:38:37','2021-11-15 16:44:32',NULL),(5,'entretenido','asdasd',1,1.5,1,'2021-11-09 05:40:54','2021-11-15 16:44:32',NULL),(6,'valñe bien','yop',1,2.5,1,'2021-11-09 07:59:59','2021-11-15 16:44:32',NULL),(7,'zfzx','ass',1,3.0,1,'2021-11-09 08:00:50','2021-11-15 16:44:32',NULL),(8,'zfxzx','asdasdas',1,3.5,1,'2021-11-09 08:01:12','2021-11-15 16:44:32',NULL),(9,'zfxf','adasd 4',1,4.0,1,'2021-11-09 08:01:27','2021-11-15 16:44:32',NULL),(10,'Excelente','sadasd',1,5.0,1,'2021-11-09 08:46:15','2021-11-15 16:44:32',NULL),(11,'Masomenos [update]-','No lose rick parece chino [edited]',2,2.0,1,'2021-11-09 10:27:15','2021-11-15 16:44:32',NULL),(12,'nada mal eh','asdasdas',1,0.5,1,'2021-11-10 02:30:17','2021-11-15 16:44:32',NULL),(13,'Excelenteasdasd','dasdas',1,1.0,1,'2021-11-10 02:30:49','2021-11-15 16:44:32',NULL),(14,'usado update','Nice producto from los gringos update',1,4.5,1,'2021-11-10 05:04:31','2021-11-15 16:44:32',NULL),(15,'usado test','Nice producto from los gringos',1,4.5,1,'2021-11-10 05:05:08','2021-11-15 16:44:32',NULL),(16,'nicenice','nyahallo',1,5.0,1,'2021-11-10 05:49:15','2021-11-15 16:44:32',NULL),(17,'asds','adsdsa',2,4.0,1,'2021-11-10 08:50:02','2021-11-15 16:44:32',NULL),(20,'Banner de Ejemplo 1','sdfsdfsd 1',7,2.0,7,'2021-11-18 23:01:29','2021-11-18 23:01:58','2021-11-18 23:01:58'),(21,'dfgdfgdfg','dfgg',7,4.0,7,'2021-11-18 23:02:05','2021-11-18 23:02:05',NULL);
/*!40000 ALTER TABLE `opiniones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `direccion` varchar(1000) NOT NULL,
  `telefono` int NOT NULL,
  `id_usuario` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_perfiles_users` (`id_usuario`),
  CONSTRAINT `fk_perfiles_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
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
  KEY `fk_productos_subcategorias` (`id_subcat`),
  CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_subcategorias` FOREIGN KEY (`id_subcat`) REFERENCES `sub_categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (7,'Camisa Gucci','[\"\\/storage\\/imagenes\\/productos\\/zEMnPcBzbVir1YkgTGRB7ZR7rD02WAxUV9KrwJXK.webp\",\"\\/storage\\/imagenes\\/productos\\/iY6mXvCfnL4pOMxOCRPWUVOB99c6ObrTFXh1P233.jpg\",\"\\/storage\\/imagenes\\/productos\\/koBHTsdEfOd7oXD2PzsZb2Q8zIUZDkk3lnJI1LST.jpg\",\"\\/storage\\/imagenes\\/productos\\/V13Pc792fbJhtuMcNYxXBGzcWjH5VmoRLIK7ba8Q.jpg\",\"\\/storage\\/imagenes\\/productos\\/rCqpyr5bhVP6oCTH4CcwRJzsTYfJbq6UNgkvDdPo.jpg\",\"\\/storage\\/imagenes\\/productos\\/yOQoUnERM1uAAyIc1t2yzFoBtc1uG7PXNJHhbVL4.jpg\"]','Esta camiseta extragrande forma parte de la colección The North Face x Gucci, una colaboración que conecta dos marcas con una historia y valores similares para celebrar el espíritu de la exploración. The North Face hace gala de un rico patrimonio que impulsa la innovación y rompe con las reglas a la hora de crear estilos con unos detalles de diseño exclusivos y distintivos',1,8,9,4,'2021-11-12 04:15:09','2021-11-30 01:41:15'),(8,'Whirlpool Microondas','[\"\\/storage\\/imagenes\\/productos\\/1rJjCSxi7hcgbaxTZDQFdANzUilC49Ib0cY0wqam.jpg\",\"\\/storage\\/imagenes\\/productos\\/NzWEhsVI5F8VKwzmDUFtaf1vThqNceme8CVlmxCD.jpg\",\"\\/storage\\/imagenes\\/productos\\/iJy6Z5Xoi7mPivrUgwJgzi5CHyCJSttCxmwXFVP0.jpg\"]','Calienta en pocos minutos tus alimentos gracias al microondas de Whirlpool modelo WM1114D, el cual cuenta con una capacidad de 1.4 pies cúbicos, también cuenta con una potencia de 1450 W, además cuenta con 6 funciones pre-programadas (palomitas, papa asada, pizza, bebidas, congelados y recalentado, Además de tener 4 opciones de programación (cocción por etapas, cocción por peso, descongelar por peso, descongelar rápido)\r\n\r\nPosee también cronómetro, reloj, plato giratorio y manija en la puerta.',4,1,1,4,'2021-11-20 02:27:22','2021-11-20 02:27:22'),(9,'Samsung Galaxy Buds Plus','[\"\\/storage\\/imagenes\\/productos\\/RQZzxPqcpZYRkQdVXhK0UOknxoEBEFxYKcz1ct2T.png\",\"\\/storage\\/imagenes\\/productos\\/TrjTxSlfQpjvkc8AHG3ZnRHr5d0Nl2syw6FMbw3Q.png\",\"\\/storage\\/imagenes\\/productos\\/8OK8MtAzat6o5qpBYWq9M4tj7wyZgJqk2kPQAFGU.png\",\"\\/storage\\/imagenes\\/productos\\/wMTRqxif5TYY42gKk4vzBkn5yNHBNDTq4SzibAph.png\",\"\\/storage\\/imagenes\\/productos\\/hlzMzqRDjbciFzkS5gfYew5yzeA98zHu4aQTMtDS.png\",\"\\/storage\\/imagenes\\/productos\\/mQu9r4M3AjSsnX0TmVs9UKHwCkUWHF7RK92l7AfZ.png\"]','Galaxy Buds Plus Samsung, los puedes conectar por medio de Bluetooth, utiliza una batería de 85 mAh y la duración de la batería en llamada es de hasta 11 horas de duración con el estuche de carga, en cuanto a la duración de la batería con reproductor de música es de hasta 6 horas de funcionamiento ininterrumpido, además son compatibles con todos los dispositivos',4,1,2,1,'2021-11-30 02:21:14','2021-11-30 04:29:08'),(10,'Apple Laptop Macbook Pro 13','[\"\\/storage\\/imagenes\\/productos\\/ACJLORW6wLGvHbGBefoddncq3j3d5uqKGvuM8ro7.jpg\",\"\\/storage\\/imagenes\\/productos\\/ImGmJ8UMQKRUrEo0rEohFtPqNofvSra5dIMgQT93.jpg\",\"\\/storage\\/imagenes\\/productos\\/JsJs0GFMpq1RxPS399eHw258tokqXkm3a9CV5kAC.jpg\",\"\\/storage\\/imagenes\\/productos\\/J5ecRFzD0s7qHraRAWnZZCBhPFcGV5BBCsYyLB3w.jpg\"]','MacBook Pro de 13 pulgadas alcanza un nuevo nivel de potencia y velocidad. El CPU es hasta 2.8 veces más rápido y los gráficos son hasta 5 veces más veloces. El Neural Engine, el más avanzado hasta ahora, permite un aprendizaje automático hasta 11 veces más rápido. Y la batería te acompaña hasta por 20 horas, la mayor duración en una Mac.',1,9,2,1,'2021-11-30 02:24:53','2021-11-30 02:24:53'),(11,'Ups 375w con 6 tomas','[\"\\/storage\\/imagenes\\/productos\\/ivKxLDhftioYoEruZ7Qav7QdXLbJds5keFa0c2jx.jpg\",\"\\/storage\\/imagenes\\/productos\\/aKSJjWzIGBLHJngwdYfmH6ZY1f2ZW8ND1VplhxVP.jpg\",\"\\/storage\\/imagenes\\/productos\\/N2yQCq8PR8Sf3uROy1U9LDI6G5sWPWhP2cKElzM5.jpg\"]','UPS interactivo en línea con Control de microprocesador inteligente\r\nCorrija las fluctuaciones menores de energía (bajo y sobrevoltaje) sin cambiar a la batería. Extiende la vida útil de la batería y es esencial en áreas donde las fluctuaciones de energía ocurren regularmente. Las aplicaciones típicas son electrónica de consumo, PC, equipos de red y servidores de rango medio.',4,4,2,2,'2021-11-30 02:36:54','2021-11-30 02:36:54');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Proveedor de prueba 1 update','Direccion de prueba updayte',55555555,'Nombre contacto 1 update',33333333,1,'2021-11-10 04:00:00','2021-11-10 04:39:01'),(3,'Proveedor de prueba 2','Direccion de prueba 2',23123231,'Nombre contacto 2',56154568,1,'2021-11-10 04:59:05','2021-11-10 04:59:05'),(4,'Proveedor de prueba 3','Direccion de prueba 3',32132165,'Nombre contacto 3',56415646,1,'2021-11-10 04:59:37','2021-11-10 04:59:37');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categorias`
--

DROP TABLE IF EXISTS `sub_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategorias_categorias` (`id_categoria`),
  CONSTRAINT `fk_subcategorias_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categorias`
--

LOCK TABLES `sub_categorias` WRITE;
/*!40000 ALTER TABLE `sub_categorias` DISABLE KEYS */;
INSERT INTO `sub_categorias` VALUES (1,'Electronica digital',1,'2021-11-09 04:59:26','2021-11-09 04:59:26'),(2,'Electronica sub-2',1,'2021-11-09 05:01:27','2021-11-09 05:01:27'),(3,'Electronica sub-3',1,'2021-11-09 05:01:44','2021-11-09 05:01:44'),(4,'Electronica sub-4',1,'2021-11-09 05:02:04','2021-11-09 05:02:04'),(5,'Motherboar',2,'2021-11-09 05:10:31','2021-11-09 05:10:31');
/*!40000 ALTER TABLE `sub_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_ofertas`
--

DROP TABLE IF EXISTS `tipos_ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estado` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_ofertas`
--

LOCK TABLES `tipos_ofertas` WRITE;
/*!40000 ALTER TABLE `tipos_ofertas` DISABLE KEYS */;
INSERT INTO `tipos_ofertas` VALUES (1,'Descuentos update',1,'2021-11-16 01:52:59','2021-11-16 23:19:53');
/*!40000 ALTER TABLE `tipos_ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_usuarios`
--

DROP TABLE IF EXISTS `tipos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_usuarios`
--

LOCK TABLES `tipos_usuarios` WRITE;
/*!40000 ALTER TABLE `tipos_usuarios` DISABLE KEYS */;
INSERT INTO `tipos_usuarios` VALUES (1,'admin'),(2,'user');
/*!40000 ALTER TABLE `tipos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
  KEY `FK_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `fk_users_tipos_usuarios` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipos_usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jose__','/storage/frontend/client/1/2YNw7JvB8AalX5P1B0tAwGTuteP6bXirUDB4zQ4w.jpg','example@example.com',NULL,'$2y$10$GhX1amKZDj4TSFbpbygG8.RPdOYnTyIoz44Ps1b1.dq5b2uA23GbK',2,'xIQDAphCpm05CQMnhbANaUAYPOE0IoJU0bUw4ftohOvxFYQcpRTvvyLDK2Ct','2021-11-05 10:02:59','2021-11-07 05:56:48'),(2,'Antonio',NULL,'admin@gmail.com',NULL,'$2y$10$paJsf1H2tmH5hFG7y8BfhOWOykwy6U6PoVJSlCWUBHI1UWasMcrsW',2,NULL,'2021-11-05 10:45:01','2021-11-05 10:45:01'),(3,'Alas',NULL,'alas@example.com',NULL,'$2y$10$5/g5UIY8KP1y7MbFmwZkb.vgsR8O..lqmywEGbc93VeAIV1SPe2R.',2,NULL,'2021-11-06 05:54:43','2021-11-06 05:54:43'),(7,'diego','/storage/frontend/client/7/U5POlWaGnQUyuZIyNeoWonGH5n7qpFYo0SWMGlJK.jpg','example@example2.com',NULL,'$2y$10$eU/SNOlFEFbVih2iccsadeNE1GhU03g8naEagqOTMyappH1OyqbrC',1,NULL,'2021-11-18 22:51:42','2021-11-26 22:04:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint unsigned NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `num_transaccion` varchar(500) NOT NULL,
  `id_direccion` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `fk_ventas_direcciones` (`id_direccion`),
  CONSTRAINT `fk_ventas_direcciones` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (2,7,360.50,'23335663',NULL,'2021-11-20 22:54:47','2021-11-20 22:54:47'),(3,7,360.50,'61',4,'2021-11-23 03:45:52','2021-11-23 03:45:52'),(5,7,360.50,'452',4,'2021-11-23 03:47:58','2021-11-23 03:47:58'),(6,7,360.50,'314',4,'2021-11-23 03:49:33','2021-11-23 03:49:33'),(7,7,360.50,'143',4,'2021-11-23 03:50:25','2021-11-23 03:50:25'),(8,7,360.50,'310',4,'2021-11-23 03:53:23','2021-11-23 03:53:23'),(9,7,360.50,'20',4,'2021-11-23 03:53:50','2021-11-23 03:53:50'),(10,7,210.50,'414',3,'2021-11-23 21:21:29','2021-11-23 21:21:29'),(11,7,0.00,'207',3,'2021-11-23 21:21:51','2021-11-23 21:21:51'),(12,7,150.00,'2a8472d37d535ab214f5a8d3de73d4ea314fc593',4,'2021-11-23 21:24:08','2021-11-23 21:24:08'),(13,7,210.50,'b36e379a90b81e24b96bb5c88aac3bb2b91251d8',3,'2021-11-24 00:52:00','2021-11-24 00:52:00'),(14,7,300.00,'4511c9004cc9f940655501f25f3bb8207d0e93e2',4,'2021-11-24 00:53:19','2021-11-24 00:53:19'),(15,7,421.00,'66abdb548299c218080662e498e6d541328e2f42',4,'2021-11-24 00:55:54','2021-11-24 00:55:54'),(16,7,300.00,'3908ea025a54c2b44aa135ce4e9efb3f3483545e',4,'2021-11-24 00:57:59','2021-11-24 00:57:59'),(17,7,150.00,'108949ff42c3cf58367609abf61783f7c084c76c',4,'2021-11-24 00:58:36','2021-11-24 00:58:36'),(18,7,360.50,'13c70b1a4f834f46ce1cd31e167a9a1c3ad6ac8d',4,'2021-11-24 01:21:01','2021-11-24 01:21:01'),(19,7,150.00,'23da078f46e1d292681e03f75db60ee31d3485ac',4,'2021-11-24 01:28:26','2021-11-24 01:28:26'),(20,7,150.00,'b9215e3ad975be1b81820c786b0ff38a40e784c6',4,'2021-11-24 01:29:34','2021-11-24 01:29:34'),(21,7,150.00,'3dc4f49167c8996c88c6452f440b262381e3b021',4,'2021-11-24 01:30:55','2021-11-24 01:30:55'),(22,7,210.50,'bca181bdbed3c845dd830feb7d2d7bde7cfe61f0',4,'2021-11-24 01:34:06','2021-11-24 01:34:06'),(23,7,150.00,'4f9aa561c3ec73b83300e96e14edd07da686d4db',4,'2021-11-24 01:35:44','2021-11-24 01:35:44'),(24,7,150.00,'836e305668995f75fc023f3edfd2ab8b57651435',4,'2021-11-24 01:39:21','2021-11-24 01:39:21'),(25,7,210.50,'04499bb77930c8d320545d0fd5ff4c2107a6309f',4,'2021-11-24 01:48:32','2021-11-24 01:48:32'),(26,7,210.50,'3aca900ee40d8178f7a84e9bb3c2e68956ae2709',4,'2021-11-24 02:15:39','2021-11-24 02:15:39'),(27,7,210.50,'087f42877214b9709feec48f144c11108d3b3168',4,'2021-11-25 03:52:50','2021-11-25 03:52:50'),(28,7,1830.50,'870295cc80ca7e825a3146a17464a620aed93fb9',4,'2021-12-01 04:07:22','2021-12-01 04:07:22');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ecommerce'
--

--
-- Dumping routines for database 'ecommerce'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-01  8:16:25
