-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: siafe
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias_gastos`
--

DROP TABLE IF EXISTS `categorias_gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_gastos` (
  `id_categoria_gasto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_categoria_gasto` varchar(100) NOT NULL,
  `descripcion_categoria_gasto` text DEFAULT NULL,
  `estado_categoria_gasto` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_categoria_gasto` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_categoria_gasto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_categoria_gasto`),
  UNIQUE KEY `nombre` (`nombre_categoria_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_gastos`
--

LOCK TABLES `categorias_gastos` WRITE;
/*!40000 ALTER TABLE `categorias_gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias_gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_ingresos`
--

DROP TABLE IF EXISTS `categorias_ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_ingresos` (
  `id_categoria_ingreso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_categoria_ingreso` varchar(100) NOT NULL,
  `descripcion_categoria_ingreso` text DEFAULT NULL,
  `estado_categoria_ingreso` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_categoria_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_categoria_ingreso` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_categoria_ingreso`),
  UNIQUE KEY `nombre` (`nombre_categoria_ingreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_ingresos`
--

LOCK TABLES `categorias_ingresos` WRITE;
/*!40000 ALTER TABLE `categorias_ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias_ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_productos`
--

DROP TABLE IF EXISTS `categorias_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_productos` (
  `id_categoria_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_categoria_producto` varchar(100) NOT NULL,
  `descripcion_categoria_producto` text DEFAULT NULL,
  `estado_categoria_producto` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_categoria_producto` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_categoria_producto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_categoria_producto`),
  UNIQUE KEY `nombre_categoria_producto` (`nombre_categoria_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_productos`
--

LOCK TABLES `categorias_productos` WRITE;
/*!40000 ALTER TABLE `categorias_productos` DISABLE KEYS */;
INSERT INTO `categorias_productos` VALUES (1,'Granos','Arroz, frijol, lentejas y otros granos','Activo','2026-09-04 21:27:16','2026-09-04 21:27:16'),(2,'Aceites','Aceites y productos derivados','Activo','2026-09-04 21:27:16','2026-09-04 21:27:16'),(3,'Aseo','Productos para limpieza del hogar','Activo','2026-09-04 21:27:16','2026-09-04 21:27:16'),(4,'Bebidas','Bebidas y refrescos','Activo','2026-09-04 21:27:16','2026-09-04 21:27:16'),(5,'Lácteos','Leche y productos lácteos','Activo','2026-09-04 21:27:16','2026-09-04 21:27:16');
/*!40000 ALTER TABLE `categorias_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `tipo_documento_cliente` enum('CC','TI','CE','PASAPORTE','NIT') NOT NULL,
  `documento_cliente` varchar(20) DEFAULT NULL,
  `nombres_cliente` varchar(100) DEFAULT NULL,
  `apellidos_cliente` varchar(100) DEFAULT NULL,
  `correo_cliente` varchar(150) DEFAULT NULL,
  `telefono_cliente` varchar(20) DEFAULT NULL,
  `direccion_cliente` varchar(200) DEFAULT NULL,
  `ciudad_cliente` varchar(100) DEFAULT NULL,
  `estado_cliente` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_registro_cliente` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_cliente` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `observacion_cliente` text DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `fk_cliente_empresa` (`id_empresa`),
  CONSTRAINT `fk_cliente_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,1,'CC','1001001001','Carlos','Gómez','carlos@gmail.com','3001001001','Calle 10 # 20-30','Bogotá','Activo','2026-09-04 21:28:46','2026-09-04 21:28:46',NULL),(2,1,'CC','1001001002','María','Rodríguez','maria@gmail.com','3001001002','Carrera 15 # 30-40','Bogotá','Activo','2026-09-04 21:28:46','2026-09-04 21:28:46',NULL),(3,1,'CC','1001001003','Andrés','Martínez','andres@gmail.com','3001001003','Calle 50 # 10-20','Bogotá','Activo','2026-09-04 21:28:46','2026-09-04 21:28:46',NULL),(4,1,'CC','1001001004','Laura','Hernández','laura@gmail.com','3001001004','Carrera 7 # 60-15','Bogotá','Activo','2026-09-04 21:28:46','2026-09-04 21:28:46',NULL),(5,1,'CC','1001001005','Sofía','López','sofia@gmail.com','3001001005','Calle 80 # 12-25','Bogotá','Activo','2026-09-04 21:28:46','2026-09-04 21:28:46',NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_ventas` (
  `id_detalle_venta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_venta` int(10) unsigned NOT NULL,
  `id_producto` int(10) unsigned NOT NULL,
  `cantidad_producto_venta` int(11) NOT NULL,
  `precio_unitario_producto_venta` decimal(12,2) NOT NULL,
  `descuento_producto_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `impuesto_producto_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal_producto_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `observacion_producto_venta` text DEFAULT NULL,
  `fecha_creacion_detalle_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_detalle_venta` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_detalle_venta`),
  KEY `fk_det_ven` (`id_venta`),
  KEY `fk_det_pro` (`id_producto`),
  CONSTRAINT `fk_det_pro` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `fk_det_ven` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ventas`
--

LOCK TABLES `detalle_ventas` WRITE;
/*!40000 ALTER TABLE `detalle_ventas` DISABLE KEYS */;
INSERT INTO `detalle_ventas` VALUES (1,1,1,2,4500.00,0.00,0.00,9000.00,'Arroz Blanco 1kg','2026-09-04 21:30:59','2026-09-04 21:30:59'),(2,1,2,1,5500.00,0.00,0.00,5500.00,'Frijol Rojo 500g','2026-09-04 21:30:59','2026-09-04 21:30:59'),(3,1,8,2,6000.00,0.00,0.00,12000.00,'Gaseosa 1.5L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(4,1,9,1,3000.00,0.00,0.00,3000.00,'Agua Mineral 600ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(5,2,3,3,4200.00,0.00,0.00,12600.00,'Lentejas 500g','2026-09-04 21:30:59','2026-09-04 21:30:59'),(6,2,4,2,8500.00,0.00,0.00,17000.00,'Aceite Vegetal 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(7,2,10,2,4800.00,0.00,0.00,9600.00,'Leche Entera 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(8,2,9,1,3000.00,0.00,0.00,3000.00,'Agua Mineral 600ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(9,3,5,2,18500.00,0.00,0.00,37000.00,'Aceite de Oliva 500ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(10,3,7,1,6500.00,0.00,0.00,6500.00,'Lavaloza 500ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(11,3,9,2,3000.00,0.00,0.00,6000.00,'Agua Mineral 600ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(12,3,10,1,4800.00,0.00,0.00,4800.00,'Leche Entera 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(13,4,6,2,9800.00,0.00,0.00,19600.00,'Jabón en Polvo 1kg','2026-09-04 21:30:59','2026-09-04 21:30:59'),(14,4,8,1,6000.00,0.00,0.00,6000.00,'Gaseosa 1.5L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(15,4,10,1,4800.00,0.00,0.00,4800.00,'Leche Entera 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(16,4,2,1,5500.00,0.00,0.00,5500.00,'Frijol Rojo 500g','2026-09-04 21:30:59','2026-09-04 21:30:59'),(17,4,9,1,3000.00,0.00,0.00,3000.00,'Agua Mineral 600ml','2026-09-04 21:30:59','2026-09-04 21:30:59'),(18,5,1,3,4500.00,0.00,0.00,13500.00,'Arroz Blanco 1kg','2026-09-04 21:30:59','2026-09-04 21:30:59'),(19,5,4,2,8500.00,0.00,0.00,17000.00,'Aceite Vegetal 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(20,5,8,1,6000.00,0.00,0.00,6000.00,'Gaseosa 1.5L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(21,5,10,2,4800.00,0.00,0.00,9600.00,'Leche Entera 1L','2026-09-04 21:30:59','2026-09-04 21:30:59'),(22,5,9,1,3000.00,0.00,0.00,3000.00,'Agua Mineral 600ml','2026-09-04 21:30:59','2026-09-04 21:30:59');
/*!40000 ALTER TABLE `detalle_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id_empresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `nit_empresa` varchar(20) DEFAULT NULL,
  `razon_social_empresa` varchar(150) NOT NULL,
  `nombre_comercial_empresa` varchar(150) DEFAULT NULL,
  `correo_empresa` varchar(150) DEFAULT NULL,
  `telefono_empresa` varchar(20) DEFAULT NULL,
  `direccion_empresa` varchar(200) DEFAULT NULL,
  `ciudad_empresa` varchar(100) DEFAULT NULL,
  `departamento_empresa` varchar(100) DEFAULT NULL,
  `sector_economico_empresa` varchar(100) DEFAULT NULL,
  `representante_legal_empresa` varchar(150) DEFAULT NULL,
  `estado_empresa` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_empresa` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_empresa` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `nit` (`nit_empresa`),
  KEY `fk_empresa_usuario` (`id_usuario`),
  CONSTRAINT `fk_empresa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,8,'900123456-7','Comercializadora SIAFE S.A.S.','SIAFE Comercial','contacto@siafe.com','3001234567','Calle 100 # 15-20','Bogotá','Cundinamarca','Comercio','Administrador SIAFE','Activo','2026-09-04 21:26:09','2026-09-04 21:26:09');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id_gasto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_categoria_gasto` int(10) unsigned NOT NULL,
  `valor_gasto` decimal(12,2) NOT NULL,
  `descripcion_gasto` text NOT NULL,
  `comprobante_gasto` varchar(255) DEFAULT NULL,
  `metodo_pago_gasto` enum('Efectivo','Transferencia','Tarjeta','Nequi','Daviplata','Otro') NOT NULL DEFAULT 'Efectivo',
  `observacion_gasto` text DEFAULT NULL,
  `fecha_gasto` date DEFAULT NULL,
  `estado_gasto` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_gasto` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_gasto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_gasto`),
  KEY `fk_gas_emp` (`id_empresa`),
  KEY `fk_gas_cat` (`id_categoria_gasto`),
  CONSTRAINT `fk_gas_cat` FOREIGN KEY (`id_categoria_gasto`) REFERENCES `categorias_gastos` (`id_categoria_gasto`),
  CONSTRAINT `fk_gas_emp` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ia`
--

DROP TABLE IF EXISTS `ia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ia` (
  `id_ia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `tipo_analisis` enum('Prediccion','Anomalia','Recomendacion','Pronostico','Riesgo Financiero') NOT NULL,
  `algoritmo` varchar(100) DEFAULT NULL,
  `version_modelo` varchar(30) DEFAULT NULL,
  `datos_entrada` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_entrada`)),
  `resultado` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`resultado`)),
  `recomendacion` text DEFAULT NULL,
  `porcentaje_confianza` decimal(5,2) DEFAULT NULL,
  `tiempo_procesamiento` decimal(8,3) DEFAULT NULL,
  `estado` enum('Pendiente','Procesando','Finalizado','Error') DEFAULT 'Pendiente',
  `fecha_analisis` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_ia`),
  KEY `fk_ia_empresa` (`id_empresa`),
  KEY `fk_ia_usuario` (`id_usuario`),
  CONSTRAINT `fk_ia_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ia`
--

LOCK TABLES `ia` WRITE;
/*!40000 ALTER TABLE `ia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ia_analisis`
--

DROP TABLE IF EXISTS `ia_analisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ia_analisis` (
  `id_analisis` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_modelo` int(10) unsigned NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `tipo_analisis` enum('Prediccion','Anomalia','Recomendacion','Clasificacion','Pronostico','Riesgo Financiero') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `datos_entrada` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_entrada`)),
  `resultado` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`resultado`)),
  `porcentaje_confianza` decimal(5,2) DEFAULT NULL,
  `tiempo_procesamiento` decimal(8,3) DEFAULT NULL,
  `estado` enum('Pendiente','Procesando','Finalizado','Error') DEFAULT 'Pendiente',
  `fecha_analisis` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_analisis`),
  KEY `fk_analisis_empresa` (`id_empresa`),
  KEY `fk_analisis_usuario` (`id_usuario`),
  KEY `fk_analisis_modelo` (`id_modelo`),
  CONSTRAINT `fk_analisis_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`),
  CONSTRAINT `fk_analisis_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `ia_modelos` (`id_modelo`),
  CONSTRAINT `fk_analisis_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ia_analisis`
--

LOCK TABLES `ia_analisis` WRITE;
/*!40000 ALTER TABLE `ia_analisis` DISABLE KEYS */;
/*!40000 ALTER TABLE `ia_analisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ia_modelos`
--

DROP TABLE IF EXISTS `ia_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ia_modelos` (
  `id_modelo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `algoritmo` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precision_modelo` decimal(5,2) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_modelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ia_modelos`
--

LOCK TABLES `ia_modelos` WRITE;
/*!40000 ALTER TABLE `ia_modelos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ia_modelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ia_recomendaciones`
--

DROP TABLE IF EXISTS `ia_recomendaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ia_recomendaciones` (
  `id_recomendacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_analisis` int(10) unsigned NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `prioridad` enum('Baja','Media','Alta','Critica') DEFAULT 'Media',
  `impacto` enum('Bajo','Medio','Alto') DEFAULT 'Medio',
  `estado` enum('Pendiente','Aplicada','Descartada') DEFAULT 'Pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_recomendacion`),
  KEY `fk_recomendacion_analisis` (`id_analisis`),
  CONSTRAINT `fk_recomendacion_analisis` FOREIGN KEY (`id_analisis`) REFERENCES `ia_analisis` (`id_analisis`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ia_recomendaciones`
--

LOCK TABLES `ia_recomendaciones` WRITE;
/*!40000 ALTER TABLE `ia_recomendaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `ia_recomendaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicadores`
--

DROP TABLE IF EXISTS `indicadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indicadores` (
  `id_indicador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `liquidez` decimal(10,2) DEFAULT NULL,
  `rentabilidad` decimal(10,2) DEFAULT NULL,
  `fecha_calculo` date DEFAULT NULL,
  PRIMARY KEY (`id_indicador`),
  KEY `fk_ind_emp` (`id_empresa`),
  CONSTRAINT `fk_ind_emp` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicadores`
--

LOCK TABLES `indicadores` WRITE;
/*!40000 ALTER TABLE `indicadores` DISABLE KEYS */;
INSERT INTO `indicadores` VALUES (1,1,0.00,0.00,'2026-09-05');
/*!40000 ALTER TABLE `indicadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos` (
  `id_ingreso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_categoria_ingreso` int(10) unsigned NOT NULL,
  `valor_ingreso` decimal(12,2) NOT NULL,
  `descripcion_ingreso` text NOT NULL,
  `comprobante_ingreso` varchar(255) DEFAULT NULL,
  `metodo_pago_ingreso` enum('Efectivo','Transferencia','Tarjeta','Nequi','Daviplata','Otro') NOT NULL DEFAULT 'Efectivo',
  `observacion_ingreso` text DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `estado_ingreso` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_ingreso` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_ingreso`),
  KEY `fk_ing_emp` (`id_empresa`),
  KEY `fk_ing_cat` (`id_categoria_ingreso`),
  CONSTRAINT `fk_ing_cat` FOREIGN KEY (`id_categoria_ingreso`) REFERENCES `categorias_ingresos` (`id_categoria_ingreso`),
  CONSTRAINT `fk_ing_emp` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos`
--

LOCK TABLES `ingresos` WRITE;
/*!40000 ALTER TABLE `ingresos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presupuestos`
--

DROP TABLE IF EXISTS `presupuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presupuestos` (
  `id_presupuesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `anio_presupuesto` year(4) DEFAULT NULL,
  `mes_presupuesto` tinyint(4) DEFAULT NULL,
  `presupuesto_ingresos_estimado` decimal(12,2) DEFAULT NULL,
  `presupuesto_gastos_estimado` decimal(12,2) DEFAULT NULL,
  `presupuesto_utilidad_estimada` decimal(12,2) NOT NULL DEFAULT 0.00,
  `presupuesto_descripcion` text DEFAULT NULL,
  `estado_presupuesto` enum('Activo','Finalizado','Cancelado') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_presupuesto` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_presupuesto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_presupuesto`),
  KEY `fk_pre_emp` (`id_empresa`),
  CONSTRAINT `fk_pre_emp` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presupuestos`
--

LOCK TABLES `presupuestos` WRITE;
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_categoria_producto` int(10) unsigned NOT NULL,
  `codigo_producto` varchar(40) DEFAULT NULL,
  `nombre_producto` varchar(150) NOT NULL,
  `descripcion_producto` text DEFAULT NULL,
  `categoria_producto` varchar(100) DEFAULT NULL,
  `marca_producto` varchar(100) DEFAULT NULL,
  `unidad_medida_producto` varchar(30) DEFAULT 'Unidad',
  `stock_producto` int(11) DEFAULT 0,
  `stock_minimo_producto` int(11) DEFAULT 0,
  `precio_compra_producto` decimal(12,2) DEFAULT NULL,
  `precio_venta_producto` decimal(12,2) DEFAULT NULL,
  `imagen_producto` varchar(255) DEFAULT NULL,
  `estado_producto` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion_producto` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_producto` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo` (`codigo_producto`),
  KEY `fk_producto_empresa` (`id_empresa`),
  KEY `fk_producto_categoria` (`id_categoria_producto`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria_producto`) REFERENCES `categorias_productos` (`id_categoria_producto`) ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,1,'PROD001','Arroz Blanco 1kg','Arroz blanco de primera calidad','Granos','Diana','Unidad',50,10,3200.00,4500.00,'producto_6aa14eba1c2d20.38213997.jpg','Activo','2026-09-04 21:27:42','2026-09-09 07:19:06'),(2,1,1,'PROD002','Frijol Rojo 500g','Frijol rojo seleccionado','Granos','Diana','Unidad',40,10,3800.00,5500.00,'producto_6aa14efe5a0f54.06460710.jpg','Activo','2026-09-04 21:27:42','2026-09-09 07:20:14'),(3,1,1,'PROD003','Lentejas 500g','Lentejas seleccionadas','Granos','Roja','Unidad',45,10,2800.00,4200.00,'producto_6aa14f3a97b0c0.13146003.jpg','Activo','2026-09-04 21:27:42','2026-09-09 07:21:14'),(4,1,2,'PROD004','Aceite Vegetal 2L','Aceite vegetal para cocina','Aceites','Cocinero','Unidad',35,8,6500.00,8500.00,'producto_6aa155b5af6585.78680651.jpg','Activo','2026-09-04 21:27:42','2026-09-09 07:48:53'),(5,1,2,'PROD005','Aceite de Oliva 500ml','Aceite de oliva extra virgen','Aceites','La Española','Unidad',20,5,14000.00,18500.00,NULL,'Activo','2026-09-04 21:27:42','2026-09-04 21:27:42'),(6,1,3,'PROD006','Jabón en Polvo 1kg','Detergente para ropa','Aseo','Ariel','Unidad',30,8,7500.00,9800.00,NULL,'Activo','2026-09-04 21:27:42','2026-09-04 21:27:42'),(7,1,3,'PROD007','Lavaloza 500ml','Jabón líquido para platos','Aseo','Axion','Unidad',25,6,4500.00,6500.00,NULL,'Activo','2026-09-04 21:27:42','2026-09-04 21:27:42'),(8,1,4,'PROD008','Gaseosa 1.5L','Bebida gaseosa sabor cola','Bebidas','Coca-Cola','Unidad',60,15,4000.00,6000.00,NULL,'Activo','2026-09-04 21:27:42','2026-09-04 21:27:42'),(9,1,4,'PROD009','Agua Mineral 600ml','Agua mineral sin gas','Bebidas','Cristal','Unidad',70,15,1800.00,3000.00,NULL,'Activo','2026-09-04 21:27:42','2026-09-04 21:27:42'),(10,1,5,'PROD010','Leche Entera 1L','Leche entera pasteurizada','Lácteos','Alquería','Unidad',40,10,3500.00,4800.00,'producto_6aa14e96531e30.15099915.jpg','Activo','2026-09-04 21:27:42','2026-09-09 07:18:30');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportes`
--

DROP TABLE IF EXISTS `reportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportes` (
  `id_reporte` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `tipo_reporte` enum('Ingresos','Gastos','Utilidad','Presupuesto','Financiero','General') NOT NULL DEFAULT 'General',
  `periodo_anio` year(4) NOT NULL,
  `periodo_mes` tinyint(3) unsigned DEFAULT NULL,
  `total_ingresos` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_gastos` decimal(12,2) NOT NULL DEFAULT 0.00,
  `utilidad` decimal(12,2) NOT NULL DEFAULT 0.00,
  `descripcion_reporte` text DEFAULT NULL,
  `estado_reporte` enum('Generado','Revisado','Archivado') NOT NULL DEFAULT 'Generado',
  `fecha_generacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_reporte`),
  KEY `idx_reportes_empresa` (`id_empresa`),
  KEY `idx_reportes_periodo` (`periodo_anio`,`periodo_mes`),
  KEY `idx_reportes_tipo` (`tipo_reporte`),
  CONSTRAINT `fk_reportes_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportes`
--

LOCK TABLES `reportes` WRITE;
/*!40000 ALTER TABLE `reportes` DISABLE KEYS */;
INSERT INTO `reportes` VALUES (1,1,'Financiero',2026,NULL,0.00,0.00,0.00,'reporte de productos alqueria tipos de leches ','Generado','2026-09-11 11:39:36','2026-09-11 11:39:36');
/*!40000 ALTER TABLE `reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion_rol` varchar(255) DEFAULT NULL,
  `estado_rol` enum('Activo','Inactivo') DEFAULT 'Activo',
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `nombre` (`nombre_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super administrador','Acceso total al sistema y gestión de roles y usuarios.','Activo'),(2,'administrador','Gestiona los módulos administrativos de la empresa.','Activo'),(3,'cajero','Encargado de las ventas y operaciones de productos.','Activo');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_rol` int(10) unsigned NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido_usuario` varchar(100) NOT NULL,
  `tipo_documento_usuario` enum('CC','TI','CE','PASAPORTE','NIT') NOT NULL,
  `numero_documento_usuario` varchar(20) NOT NULL,
  `correo_usuario` varchar(120) NOT NULL,
  `telefono_usuario` varchar(20) DEFAULT NULL,
  `direccion_usuario` varchar(200) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado_usuario` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fecha_creacion_usuario` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_usuario` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ultimo_acceso_usuario` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `numero_documento_usuario` (`numero_documento_usuario`),
  KEY `fk_usuario_rol` (`id_rol`),
  CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (3,3,'Cajero','SIAFE','CC','1000000003','cajero@siafe.com','3000000002','Bogotá',NULL,NULL,'CAJERO','$2y$10$8W0ytfrDrTD1P7eKufuD2.xXmRW8M0pZ17FBLMOscgqQG8xVlkZ32','Activo','2026-09-04 19:33:25','2026-09-04 19:34:12',NULL),(7,1,'Juan','Perez','CC','1000000001','dd3704315@gmail.com','3000000000','Bogotá',NULL,'','JUAN','$2y$10$9/XIG/CtqPWFnLoXRkskcO5LczEHx2jiviU5lUIskKLbl6Z0luxMG','Activo','2026-09-04 19:51:15','2026-09-10 21:50:52',NULL),(8,2,'Administrador','SIAFE','CC','1000000002','admin@siafe.com','3000000001','Bogotá',NULL,NULL,'ADMIN','$2y$10$/zNdndp.yIIci6HZudNk6eiqVUZhHbxz933mPjT3rySK3Zyer2mT6','Activo','2026-09-04 20:55:46','2026-09-04 20:55:46',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas` (
  `id_venta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `numero_factura_venta` varchar(30) NOT NULL,
  `subtotal_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `impuesto_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `descuento_venta` decimal(12,2) NOT NULL DEFAULT 0.00,
  `fecha_venta` datetime DEFAULT current_timestamp(),
  `total_venta` decimal(12,2) DEFAULT NULL,
  `metodo_pago_venta` enum('Efectivo','Transferencia','Tarjeta','Nequi','Daviplata','Otro') NOT NULL DEFAULT 'Efectivo',
  `observacion_venta` text DEFAULT NULL,
  `estado_venta` enum('Pendiente','Pagada','Anulada') NOT NULL DEFAULT 'Pendiente',
  `fecha_creacion_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion_venta` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_venta`),
  UNIQUE KEY `numero_factura_venta` (`numero_factura_venta`),
  KEY `fk_ven_emp` (`id_empresa`),
  KEY `fk_ven_cli` (`id_cliente`),
  KEY `fk_ven_usr` (`id_usuario`),
  CONSTRAINT `fk_ven_cli` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_ven_emp` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`),
  CONSTRAINT `fk_ven_usr` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,1,1,8,'FAC-0001',29500.00,0.00,0.00,'2026-08-20 10:15:00',29500.00,'Efectivo','Venta de productos de prueba','Pagada','2026-09-04 21:29:53','2026-09-04 21:32:17'),(2,1,2,8,'FAC-0002',42200.00,0.00,0.00,'2026-08-22 14:30:00',42200.00,'Nequi','Venta de productos de prueba','Pagada','2026-09-04 21:29:53','2026-09-04 21:32:17'),(3,1,3,8,'FAC-0003',54300.00,0.00,0.00,'2026-08-25 11:20:00',54300.00,'Tarjeta','Venta de productos de prueba','Pagada','2026-09-04 21:29:53','2026-09-04 21:32:17'),(4,1,4,8,'FAC-0004',38900.00,0.00,0.00,'2026-08-28 16:45:00',38900.00,'Transferencia','Venta de productos de prueba','Pagada','2026-09-04 21:29:53','2026-09-04 21:32:17'),(5,1,5,8,'FAC-0005',49100.00,0.00,0.00,'2026-09-01 13:10:00',49100.00,'Daviplata','Venta de productos de prueba','Pagada','2026-09-04 21:29:53','2026-09-04 21:32:17');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-11 14:06:14
