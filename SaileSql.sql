-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: alquiler_laravel
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.22-MariaDB
-- Date: Wed, 08 Jun 2022 10:34:43 +0200

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
-- Table structure for table `clients`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIF` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codpost` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_nombre_unique` (`nombre`),
  UNIQUE KEY `clients_d_social_unique` (`d_social`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `clients` VALUES (1,'Giles Gorczany','Giles Gorczany','91352 Agustina Skyway\nHahnfurt, FL 68622','36627 Shanelle Burgs\nEvaborough, ND 74966-4812','89204428D','British Indian Ocean Territory (Chagos Archipelago)','Prof. Hailey Padberg',2147483647,0,'nmurazik@lind.com','Belize','62334','2022-06-06 11:16:45','2022-06-06 11:16:45'),(2,'Mrs. Annabelle Okuneva PhD','Mrs. Annabelle Okuneva PhD','4143 Maggie Ford\nAlessandramouth, CT 68850-6790','5313 Agustina Village Suite 860\nNew Craighaven, PA 78291-5258','89204428D','Uganda','Mr. Rollin Hermann',2147483647,0,'romaine.vandervort@yahoo.com','Kyrgyz Republic','27277','2022-06-06 11:16:45','2022-06-06 11:16:45'),(3,'Toni Konopelski','Toni Konopelski','3024 Ursula Rapids\nKaileechester, VA 70871-4420','27487 Mervin Fords Suite 132\nLake Bradenland, VT 92478-9169','89204428D','French Polynesia','Alexie Wisozk',2147483647,0,'laurie05@yahoo.com','Norway','88004','2022-06-06 11:16:45','2022-06-06 11:16:45'),(4,'Jess Kertzmann','Jess Kertzmann','3079 Ella Isle Suite 258\nConnellyshire, WY 20035','9122 Kaelyn Meadow Apt. 539\nLake Vivianeside, VT 91729','89204428D','Guernsey','Miss Myrtle Cremin',2147483647,0,'fdeckow@hotmail.com','Grenada','51989','2022-06-06 11:16:45','2022-06-06 11:16:45'),(5,'Pepito','Pepito','699 Yundt GardensStammton, HI 62977-4973','412 Schumm Fort Apt. 584\nCalebton, PA 44044','89204428D','Maldives','Dr. Lorenz Hagenes',2147483647,0,'theo.jast@lebsack.com','Saint Helena','83015','2022-06-06 11:16:45','2022-06-08 07:25:15'),(6,'Miss Vena Rau DDS','Miss Vena Rau DDS','9672 Jeramie Terrace\nSantosport, MI 15571','748 McDermott Mills\nSashaberg, UT 85955-7809','89204428D','Guatemala','Orlando Ankunding',2147483647,0,'zrussel@walker.info','Cuba','79440','2022-06-06 11:16:45','2022-06-06 11:16:45'),(7,'Ignacio Cole','Ignacio Cole','955 Raphaelle Estate Suite 902\nGordonside, WA 17193-6287','922 Rodriguez Road Suite 410\nDaremouth, NM 59937','89204428D','Mongolia','Marta Ondricka',2147483647,0,'barton.zula@gmail.com','Saint Pierre and Miquelon','53030','2022-06-06 11:16:45','2022-06-06 11:16:45'),(8,'Dandre Yost','Dandre Yost','502 Pacocha Extensions Suite 752\nKerlukestad, AZ 65704','896 Wunsch Pass Apt. 991\nLake Bonnie, NM 24516','89204428D','Korea','Dr. Malachi Cronin',2147483647,0,'hallie.bernhard@hotmail.com','Cook Islands','15335','2022-06-06 11:16:45','2022-06-06 11:16:45'),(9,'Odie Sipes','Odie Sipes','417 Jacobson Roads Apt. 909\nSouth Rosetta, MI 47775','78484 Kuhic Prairie\nEffiefurt, LA 54926-2997','89204428D','Singapore','Roslyn Goyette',2147483647,0,'sabrina.kassulke@gmail.com','Central African Republic','77797','2022-06-06 11:16:45','2022-06-06 11:16:45'),(10,'Weston Breitenberg','Weston Breitenberg','50073 Lockman Terrace\nSchaeferhaven, MA 99458-4509','4197 Lorine Throughway\nHaagfurt, IA 07919-3578','89204428D','Guinea-Bissau','Sterling Parisian',2147483647,0,'oschowalter@gmail.com','Uruguay','45714','2022-06-06 11:16:45','2022-06-06 11:16:45');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `clients` with 10 row(s)
--

--
-- Table structure for table `contratos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `f_inicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `f_fin` timestamp NULL DEFAULT NULL,
  `codpost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baja` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_cliente` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_id_cliente_foreign` (`id_cliente`),
  CONSTRAINT `contratos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `contratos` VALUES (1,'2022-06-06 22:00:00','2022-06-08 08:08:00','',1,'2022-06-07 07:09:02','2022-06-08 08:08:50',2),(2,'2022-06-08 22:00:00','2022-06-16 22:00:00','',1,'2022-06-08 07:19:08','2022-06-08 07:29:17',5),(3,'2022-06-07 22:00:00','2022-06-08 08:13:00','',1,'2022-06-08 08:13:10','2022-06-08 08:13:43',4),(4,'2022-06-07 22:00:00','2022-06-08 08:30:00','',1,'2022-06-08 08:14:29','2022-06-08 08:30:19',3),(5,'2022-06-14 22:00:00','2022-06-08 08:30:00','',1,'2022-06-08 08:30:43','2022-06-08 08:30:57',1),(6,'2022-06-17 22:00:00','2022-06-08 08:32:00','',1,'2022-06-08 08:31:33','2022-06-08 08:32:12',1),(7,'2022-06-17 22:00:00','2022-06-08 08:32:00','',1,'2022-06-08 08:32:12','2022-06-08 08:32:59',1),(8,'2022-06-17 22:00:00','2022-06-08 08:33:00','',1,'2022-06-08 08:32:59','2022-06-08 08:33:12',1),(9,'2022-06-17 22:00:00','2022-06-18 22:00:00','',0,'2022-06-08 08:33:12','2022-06-08 08:33:12',1);
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `contratos` with 9 row(s)
--

--
-- Table structure for table `contratos_vallas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos_vallas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `precio` double NOT NULL DEFAULT 0,
  `precio_produccion` double DEFAULT NULL,
  `id_contrato` bigint(20) unsigned NOT NULL,
  `id_valla` bigint(20) unsigned NOT NULL,
  `id_material` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_vallas_id_contrato_foreign` (`id_contrato`),
  KEY `contratos_vallas_id_valla_foreign` (`id_valla`),
  KEY `contratos_vallas_id_material_foreign` (`id_material`),
  CONSTRAINT `contratos_vallas_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contratos_vallas_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `materiales` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contratos_vallas_id_valla_foreign` FOREIGN KEY (`id_valla`) REFERENCES `vallas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos_vallas`
--

LOCK TABLES `contratos_vallas` WRITE;
/*!40000 ALTER TABLE `contratos_vallas` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `contratos_vallas` VALUES (1,1,2,1,4,3,NULL,NULL),(2,11,11,2,6,2,NULL,NULL),(3,11,11,2,9,2,NULL,NULL),(4,11,11,2,1,2,NULL,NULL),(5,1,1,3,2,2,NULL,NULL),(6,1,1,3,11,1,NULL,NULL),(7,1,2,4,5,2,NULL,NULL),(8,1,222,4,3,1,NULL,NULL),(9,1,1,5,5,1,NULL,NULL),(10,1,1,6,4,1,NULL,NULL),(11,1,1,7,3,1,NULL,NULL),(12,1,1,7,4,1,NULL,NULL),(13,1,1,8,1,3,NULL,NULL),(14,1,1,8,7,3,NULL,NULL),(15,1,1,8,3,3,NULL,NULL),(16,1,1,8,4,3,NULL,NULL),(17,1,1,9,3,2,NULL,NULL),(18,1,1,9,7,2,NULL,NULL),(19,1,1,9,1,2,NULL,NULL),(20,1,1,9,4,2,NULL,NULL);
/*!40000 ALTER TABLE `contratos_vallas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `contratos_vallas` with 20 row(s)
--

--
-- Table structure for table `datos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_fiscal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIF` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representante` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codpost` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `movil` int(11) NOT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `datos_nombre_fiscal_unique` (`nombre_fiscal`),
  UNIQUE KEY `datos_d_social_unique` (`d_social`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos`
--

LOCK TABLES `datos` WRITE;
/*!40000 ALTER TABLE `datos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `datos` VALUES (1,'Saile','GRUPO DE COMUNICACION SAILE S.L.','B14769509','Francisco J. Elías Ordoñez','C. Secunda Romana, 56','Córdoba','Córdoba','14009',661843906,0,661843906,'paco@saile.es','info@saile.es','saile1.jpg',NULL,NULL);
/*!40000 ALTER TABLE `datos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `datos` with 1 row(s)
--

--
-- Table structure for table `estados`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estados_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `estados` VALUES (1,'Alquilada','#FF3434',0,0,NULL,NULL),(2,'Reservada','#ffc107',0,0,NULL,NULL);
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `estados` with 2 row(s)
--

--
-- Table structure for table `failed_jobs`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `failed_jobs` with 0 row(s)
--

--
-- Table structure for table `materiales`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `materiales_tipo_unique` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `materiales` VALUES (1,'Vinilo','#8B00FF',0,0,NULL,NULL),(2,'Carton','#FFC096',0,0,NULL,NULL),(3,'Lona','#96F7FF',0,0,NULL,NULL);
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `materiales` with 3 row(s)
--

--
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_03_17_092437_create_clients_table',1),(6,'2022_03_22_065933_create_estados_table',1),(7,'2022_03_22_072043_create_contratos_table',1),(8,'2022_04_07_064632_create_materiales_table',1),(9,'2022_04_08_050916_create_vallas_table',1),(10,'2022_04_08_063403_contratos_vallas',1),(11,'2022_04_29_091053_create_datos_table',1),(12,'2022_04_29_102804_create_notificaciones_table',1),(13,'2022_05_12_091729_create_promociones_table',1),(14,'2022_05_16_091608_create_promocion_valla_table',1),(15,'2022_05_16_112524_create_ordenes_table',1),(16,'2022_05_31_093227_create_vallas_orden_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migrations` with 16 row(s)
--

--
-- Table structure for table `notificaciones`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_contrato` bigint(20) unsigned NOT NULL,
  `id_cliente` bigint(20) unsigned NOT NULL,
  `borrado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notificaciones_id_cliente_foreign` (`id_cliente`),
  KEY `notificaciones_id_contrato_foreign` (`id_contrato`),
  CONSTRAINT `notificaciones_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id`),
  CONSTRAINT `notificaciones_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `notificaciones` with 0 row(s)
--

--
-- Table structure for table `ordenes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completado` tinyint(1) NOT NULL DEFAULT 0,
  `adjunto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `encargado` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ordenes_encargado_foreign` (`encargado`),
  CONSTRAINT `ordenes_encargado_foreign` FOREIGN KEY (`encargado`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `ordenes` VALUES (1,'a','b',0,NULL,0,NULL,'2022-06-06 11:31:11','2022-06-06 11:31:11'),(2,'asdasdsa','b',0,'ordenes\\JoweB8uciUl5zURCcA8oPgLzX48zDZkcaTDtmzkS.pdf',0,NULL,'2022-06-06 11:47:58','2022-06-06 11:47:58'),(3,'asdasd','asdasdas',0,'ordenes\\ordenes6L860mDrwNdH0jAoQaihuSAIkE0FPTV4JzfDj6zT.pdf',0,NULL,'2022-06-06 11:52:00','2022-06-06 11:52:00'),(4,'1','1',0,'ordenes/TB3juHWIKORLThEhpvNEGYdODe6xdDKuClDA9A7z.pdf',0,NULL,'2022-06-06 11:53:01','2022-06-06 11:53:01'),(5,'ghf','dgrf',0,'ordenes\\k4UrYPQzJiYxn3H0JRPvcz2x8Iouf44keP1wdGNW.pdf',0,NULL,'2022-06-07 10:39:42','2022-06-07 10:39:42');
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `ordenes` with 5 row(s)
--

--
-- Table structure for table `password_resets`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `password_resets` with 0 row(s)
--

--
-- Table structure for table `personal_access_tokens`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `personal_access_tokens` with 0 row(s)
--

--
-- Table structure for table `promociones`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promociones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promociones`
--

LOCK TABLES `promociones` WRITE;
/*!40000 ALTER TABLE `promociones` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `promociones` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `promociones` with 0 row(s)
--

--
-- Table structure for table `promocion_valla`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocion_valla` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_valla` bigint(20) unsigned NOT NULL,
  `id_promocion` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promocion_valla_id_valla_foreign` (`id_valla`),
  KEY `promocion_valla_id_promocion_foreign` (`id_promocion`),
  CONSTRAINT `promocion_valla_id_promocion_foreign` FOREIGN KEY (`id_promocion`) REFERENCES `promociones` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `promocion_valla_id_valla_foreign` FOREIGN KEY (`id_valla`) REFERENCES `vallas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocion_valla`
--

LOCK TABLES `promocion_valla` WRITE;
/*!40000 ALTER TABLE `promocion_valla` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `promocion_valla` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `promocion_valla` with 0 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actualiza` tinyint(1) NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `equipo_id` int(11) NOT NULL,
  `auth_level` enum('1','3','7','9','12') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `react_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Admin','','',0,0,0,0,'9','admin@admin',NULL,'$2y$10$CdCvMkfmFSRmUU74ZzovLuB2h8bbL9kWO6aRL1xAiJqGmVy/GKw3e','7W2CFxoqLy','PdgF4kfbbO',NULL,NULL),(2,'Prof. Theodore Hackett DDS','','user1.jpg',0,0,0,0,'3','teresa.rippin@example.com','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Cr7KSwx3Jm','rBaXIn5Thd','2022-06-06 11:16:45','2022-06-06 11:16:45'),(3,'Wilhelmine Hills','','user1.jpg',0,0,0,0,'3','ycartwright@example.com','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','KTtWZQRkpZ','SRIl05oA9M','2022-06-06 11:16:45','2022-06-06 11:16:45'),(4,'Mrs. Susanna Gaylord DVM','','user1.jpg',0,0,0,0,'3','lsawayn@example.net','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','LS0P33cRxl','TF8uSOSYM3','2022-06-06 11:16:45','2022-06-06 11:16:45'),(5,'Michaela Schmeler','','user2.jpg',0,0,0,0,'3','madaline09@example.org','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','jKQ8r9MMdi','MRgZjkhqW7','2022-06-06 11:16:45','2022-06-06 11:16:45'),(6,'Ida Hackett','','user1.jpg',0,0,0,0,'3','moconnell@example.net','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','jrRgtQwAnY','BX90uPp24B','2022-06-06 11:16:45','2022-06-06 11:16:45'),(7,'Luna Sanford','','user1.jpg',0,0,0,0,'3','russel.sierra@example.org','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','oPFNS0aMHq','EPB499ZKYN','2022-06-06 11:16:45','2022-06-06 11:16:45'),(8,'Prof. Janiya O\'Keefe PhD','','user1.jpg',0,0,0,0,'3','sterling.dickens@example.net','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','niGCJW3xqa','oj2LuKQoEo','2022-06-06 11:16:45','2022-06-06 11:16:45'),(9,'Jeffrey Goldner','','user1.jpg',0,0,0,0,'3','upouros@example.com','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','3CFqCIF2kJ','MSlphPempZ','2022-06-06 11:16:45','2022-06-06 11:16:45'),(10,'Keenan Stark','','user2.jpg',0,0,0,0,'3','bryce31@example.org','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','dP5ln9O5YW','MW85iA58Oe','2022-06-06 11:16:45','2022-06-06 11:16:45'),(11,'Dr. Jasper Mayert','','user1.jpg',0,0,0,0,'3','cruickshank.rosalia@example.org','2022-06-06 11:16:45','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','VVUgWbhvez','tDbbVCsxqR','2022-06-06 11:16:45','2022-06-06 11:16:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 11 row(s)
--

--
-- Table structure for table `vallas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vallas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `tamano` decimal(5,2) NOT NULL,
  `norte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `este` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oeste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_estado` bigint(20) unsigned DEFAULT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `incidencias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vallas_id_estado_foreign` (`id_estado`),
  CONSTRAINT `vallas_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vallas`
--

LOCK TABLES `vallas` WRITE;
/*!40000 ALTER TABLE `vallas` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `vallas` VALUES (1,'Rodolfo Cummerata','4255 Jerry Plains Apt. 503\nNorth Anya, VA 89430-6708','Pricetown',40.8887810,-5.6679780,2.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'Dormouse; \'VERY ill.\' Alice tried to speak, but for a dunce? Go on!\' \'I\'m a poor man, your Majesty,\' the Hatter replied. \'Of course twinkling begins with an anxious look at it!\' This speech caused a.','2022-06-06 11:16:45','2022-06-08 08:32:59'),(2,'Alysha Mosciski','39105 Altenwerth Parkway\nSouth Martina, IL 07372-2353','Valentinachester',38.1846410,-7.7413770,2.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'Alice thought to herself, \'in my going out altogether, like a stalk out of a well?\' The Dormouse again took a great deal too flustered to tell them something more. \'You promised to tell you--all I.','2022-06-06 11:16:45','2022-06-08 08:32:59'),(3,'Claud Ondricka Sr.','3886 Ara Mall Suite 362\nVidalhaven, NH 31661','Willieland',41.7164420,-8.9697990,5.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'Alice whispered to the Caterpillar, and the little door: but, alas! either the locks were too large, or the key was lying on their throne when they saw Alice coming. \'There\'s PLENTY of room!\' said.','2022-06-06 11:16:45','2022-06-08 08:30:58'),(4,'Dr. Sebastian Abbott DDS','53519 Swaniawski Via\nLake Gracie, MN 67726-2194','North Sigurdborough',36.3352150,-1.4061660,10.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'Alice. \'And where HAVE my shoulders got to? And oh, my poor hands, how is it I can\'t quite follow it as well say,\' added the Queen. \'Sentence first--verdict afterwards.\' \'Stuff and nonsense!\' said.','2022-06-06 11:16:45','2022-06-08 08:31:33'),(5,'Herta O\'Hara','8486 Frankie Passage\nPort Trishaville, CA 63016','Rickiebury',42.3161720,-6.5507510,10.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'The chief difficulty Alice found at first she thought to herself. \'Shy, they seem to encourage the witness at all: he kept shifting from one foot up the conversation dropped, and the other.','2022-06-06 11:16:45','2022-06-08 08:32:59'),(6,'Melyna Rohan','476 Terrance Fields\nNew Sethborough, DE 36818-5997','Funkshire',36.4912400,-8.1857710,10.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',NULL,0,'OUTSIDE.\' He unfolded the paper as he spoke, \'we were trying--\' \'I see!\' said the Dormouse into the sky all the unjust things--\' when his eye chanced to fall upon Alice, as she went down on her.','2022-06-06 11:16:45','2022-06-08 07:29:17'),(7,'Edyth Runte V','390 Marian Via Suite 223\nJovanishire, WV 69507-3060','Port Rodgerhaven',39.0834740,-8.5970890,1.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',2,0,'I\'m pleased, and wag my tail when I\'m pleased, and wag my tail when I\'m angry. Therefore I\'m mad.\' \'I call it purring, not growling,\' said Alice. \'Why, SHE,\' said the Mouse, in a tone of great.','2022-06-06 11:16:45','2022-06-08 08:32:59'),(8,'Katheryn Mitchell','1494 Arjun Circles\nPort Scarlett, KY 68235-6432','West Glen',42.2441590,-2.3349500,3.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',NULL,0,'Alice. \'Anything you like,\' said the Dodo replied very solemnly. Alice was not going to do next, when suddenly a White Rabbit cried out, \'Silence in the wood, \'is to grow to my boy, I beat him when.','2022-06-06 11:16:45','2022-06-06 11:16:45'),(9,'Tatyana Simonis','98583 Koch Spring Apt. 613\nLake Lorenz, SD 77255','Lavernton',40.7068470,-5.2533670,8.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',NULL,0,'Alice said to the little glass box that was linked into hers began to say which), and they sat down at her side. She was moving them about as much use in saying anything more till the eyes appeared.','2022-06-06 11:16:45','2022-06-08 07:29:17'),(10,'Catherine Harvey','7238 Ward Isle Suite 819\nNew Kraigville, NM 14397','South Era',38.2111390,-2.9776510,6.00,'saile1.jpg','saile1.jpg','saile1.jpg','saile1.jpg',NULL,0,'However, at last it sat for a minute, while Alice thought she might find another key on it, for she could guess, she was as steady as ever; Yet you finished the goose, with the clock. For instance.','2022-06-06 11:16:45','2022-06-06 11:16:45'),(11,'Explanada Top Level S.L.','Calle Helsinki 6','Córdoba',37.9001041,-4.7333211,5.00,'ejemploValla.jpg','ejemploValla1.jpg','ejemploValla2.jpg','ejemploValla.jpg',2,0,'Esta valla esta en buen estado',NULL,'2022-06-08 08:32:59'),(12,'Hipercor','Ronda de cordoba, 1','Córdoba',37.8924005,-4.8090174,5.00,'hipercor.jpg','hipercor1.jpg','hipercor2.jpg','hipercor.jpg',NULL,0,'Esta valla esta en buen estado',NULL,NULL),(13,'Las delicias','Cañada real Mesetas, 1','Córdoba',37.8839635,-4.8047555,5.00,'delicias.jpg','delicias1.jpg','delicias1.jpg','delicias.jpg',NULL,0,'Esta valla esta en buen estado',NULL,NULL);
/*!40000 ALTER TABLE `vallas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `vallas` with 13 row(s)
--

--
-- Table structure for table `vallas_orden`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vallas_orden` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_valla` bigint(20) unsigned DEFAULT NULL,
  `id_orden` bigint(20) unsigned DEFAULT NULL,
  `completado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vallas_orden_id_valla_foreign` (`id_valla`),
  KEY `vallas_orden_id_orden_foreign` (`id_orden`),
  CONSTRAINT `vallas_orden_id_orden_foreign` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vallas_orden_id_valla_foreign` FOREIGN KEY (`id_valla`) REFERENCES `vallas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vallas_orden`
--

LOCK TABLES `vallas_orden` WRITE;
/*!40000 ALTER TABLE `vallas_orden` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `vallas_orden` VALUES (1,4,1,0,NULL,NULL),(2,7,1,0,NULL,NULL),(3,12,2,0,NULL,NULL),(4,8,2,0,NULL,NULL),(5,11,3,0,NULL,NULL),(6,2,4,0,NULL,NULL),(7,10,5,0,NULL,NULL),(8,8,5,0,NULL,NULL);
/*!40000 ALTER TABLE `vallas_orden` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `vallas_orden` with 8 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Wed, 08 Jun 2022 10:34:43 +0200
