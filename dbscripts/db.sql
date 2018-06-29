CREATE DATABASE  IF NOT EXISTS `cerventum` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `cerventum`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: cerventum
-- ------------------------------------------------------
-- Server version	5.7.16-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cerveceria`
--

DROP TABLE IF EXISTS `cerveceria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cerveceria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cerveceria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cerveceria`
--

LOCK TABLES `cerveceria` WRITE;
/*!40000 ALTER TABLE `cerveceria` DISABLE KEYS */;
INSERT INTO `cerveceria` VALUES (7,44,'Cervesia','Francia 1234','(1231) 231-2312'),(8,45,'LuchitosBurguer','nose123','(2131) 234-1241');
/*!40000 ALTER TABLE `cerveceria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cerveceria_horarios`
--

DROP TABLE IF EXISTS `cerveceria_horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cerveceria_horarios` (
  `id_cerveceria` int(11) NOT NULL,
  `hora_desde` varchar(45) CHARACTER SET utf8 NOT NULL,
  `hora_hasta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_dia` int(11) NOT NULL,
  KEY `id_dia_idx` (`id_dia`),
  KEY `id_cerv_idx` (`id_cerveceria`),
  CONSTRAINT `id_cerv` FOREIGN KEY (`id_cerveceria`) REFERENCES `cerveceria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_dia` FOREIGN KEY (`id_dia`) REFERENCES `dias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cerveceria_horarios`
--

LOCK TABLES `cerveceria_horarios` WRITE;
/*!40000 ALTER TABLE `cerveceria_horarios` DISABLE KEYS */;
INSERT INTO `cerveceria_horarios` VALUES (7,'20:30','00:30',1),(8,'20:30','22:30',1);
/*!40000 ALTER TABLE `cerveceria_horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dias`
--

DROP TABLE IF EXISTS `dias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias`
--

LOCK TABLES `dias` WRITE;
/*!40000 ALTER TABLE `dias` DISABLE KEYS */;
INSERT INTO `dias` VALUES (1,'Lunes a Viernes'),(2,'Sabados y Domingos'),(3,'Todos los dias');
/*!40000 ALTER TABLE `dias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cerveceria_id` int(11) DEFAULT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cerv_id_idx` (`cerveceria_id`),
  CONSTRAINT `cerv_id` FOREIGN KEY (`cerveceria_id`) REFERENCES `cerveceria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (14,7,'2018-06-22 23:00:00','2018-06-16 10:00:00','algo',1,'2x1 en tragos'),(15,7,'2018-06-22 22:22:00','2018-06-22 22:22:00','asdasd',1,'50% en tragos'),(17,8,'2018-06-22 22:22:00','2018-06-15 22:02:00','qwe',1,'aadd'),(18,8,'2000-01-20 20:30:00','2000-01-20 22:30:00','asdasf',3,'50% en tragos');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_oferta`
--

DROP TABLE IF EXISTS `tipo_oferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_oferta` (
  `id_tipo` int(11) NOT NULL,
  `desc_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `img_path` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_oferta`
--

LOCK TABLES `tipo_oferta` WRITE;
/*!40000 ALTER TABLE `tipo_oferta` DISABLE KEYS */;
INSERT INTO `tipo_oferta` VALUES (1,'2x1','img/ofertas/2x1.png'),(2,'barra libre','img/ofertas/barralibre.png'),(3,'50% descuento','img/ofertas/50off.png'),(4,'free','img/ofertas/free.png');
/*!40000 ALTER TABLE `tipo_oferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'ADMIN'),(3,'OWNER'),(2,'USER');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `valido` tinyint(4) NOT NULL DEFAULT '0',
  `nombre` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_spanish_ci NOT NULL,
  `hash_validacion` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `nombre` (`usuario`),
  KEY `tipo_idx` (`tipo`),
  CONSTRAINT `tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (40,'admin','21232f297a57a5a743894a0e4a801fc3',1,1,'admin','admin','admin@admin',NULL),(44,'axel','81dc9bdb52d04dc20036dbd8313ed055',3,1,'axel','vazquez','axel_012@hotmail.com.ar','f6d31128b4c895ece3864bdfc11b8f64'),(45,'axel2','81dc9bdb52d04dc20036dbd8313ed055',3,1,'asd','asd','asdafa@algoasd','1ee5406f7756b364f8110f38164a2454'),(46,'algo','81dc9bdb52d04dc20036dbd8313ed055',2,1,'asda','asdasd','asd@fgh','4cef85e3db9dda5367fbf0a8b6e459fa');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-29 13:20:13
