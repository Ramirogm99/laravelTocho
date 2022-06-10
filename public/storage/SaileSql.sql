-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: alquiler_laravel
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.22-MariaDB
-- Date: Thu, 21 Apr 2022 07:36:18 +0000

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
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poblacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codpost` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_nombre_unique` (`nombre`),
  UNIQUE KEY `clients_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `clients` VALUES (1,'Freeman Lowe','Freeman Lowe','141 Pagac Rapid\nSchultzmouth, DC 10131','France',0,'Angola','98730','2022-04-18 08:19:13','2022-04-18 08:19:13'),(2,'Hortense Sipes MD','Hortense Sipes MD','1964 Brakus Tunnel\nDavonmouth, NM 52575-9660','Sierra Leone',0,'Armenia','67551','2022-04-18 08:19:13','2022-04-18 08:19:13'),(3,'Prof. Emerald Wiegand','Prof. Emerald Wiegand','2186 Roy Cliff\nRogelioview, UT 34922-7268','British Virgin Islands',0,'Zimbabwe','47049','2022-04-18 08:19:13','2022-04-18 08:19:13'),(4,'Miss Cathryn Spencer PhD','Miss Cathryn Spencer PhD','14299 Jerrod Pass Apt. 815\nNew Haleyhaven, AR 83685-1363','Korea',0,'Pakistan','97452','2022-04-18 08:19:13','2022-04-18 08:19:13'),(5,'Dr Prueba','Dr. Caden Stiedemann','81555 Reichert Skyway Apt. 602Lake Michael, NC 49185-4715','Brunei Darussalam',1,'Brunei Darussalam','89730','2022-04-18 08:19:13','2022-04-20 05:57:09'),(6,'Moshe Boehm Sr.','Moshe Boehm Sr.','9042 Ankunding Divide\nPort Laceyport, WA 16282','Kyrgyz Republic',0,'Taiwan','8662','2022-04-18 08:19:13','2022-04-18 08:19:13'),(7,'Jane King DVM','Jane King DVM','1195 Goldner Junctions Suite 568\nPort Malvina, MD 72516','Libyan Arab Jamahiriya',0,'Comoros','2146','2022-04-18 08:19:13','2022-04-18 08:19:13'),(8,'Ms. Aurelia Dooley I','Ms. Aurelia Dooley I','80089 Hauck Way Apt. 660\nNorth Ethelyn, SC 10818','Cape Verde',0,'Ghana','70627','2022-04-18 08:19:13','2022-04-18 08:19:13'),(9,'Rick Daugherty','Rick Daugherty','4831 Dietrich Point\nAnkundingside, MA 19696-6210','Andorra',0,'Fiji','62559','2022-04-18 08:19:13','2022-04-18 08:19:13'),(10,'Myrl Walker Jr.','Myrl Walker Jr.','8606 Giles Rapid\nEast Sydniestad, SC 86545','Guinea-Bissau',0,'Egypt','29313','2022-04-18 08:19:13','2022-04-18 08:19:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `contratos` VALUES (2,'2022-04-20 05:08:00','2022-08-13 06:07:00','',0,'2022-04-18 10:49:04','2022-04-18 10:49:04',2),(3,'2022-04-19 08:18:00','2022-04-28 06:22:00','',0,'2022-04-19 06:18:48','2022-04-19 06:18:48',8),(4,'2022-04-24 06:28:00','2022-04-27 11:25:00','',0,'2022-04-19 06:25:20','2022-04-19 06:25:20',1),(5,'2022-04-28 22:00:00','2022-04-30 21:59:00','',0,'2022-04-19 08:10:42','2022-04-19 08:10:42',4),(6,'2022-04-21 09:11:00','2022-04-24 09:11:00','',0,'2022-04-20 08:14:49','2022-04-20 08:14:49',1);
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `contratos` with 5 row(s)
--

--
-- Table structure for table `contratos_vallas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos_vallas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_contrato` bigint(20) unsigned NOT NULL,
  `id_valla` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contratos_vallas_id_contrato_foreign` (`id_contrato`),
  KEY `contratos_vallas_id_valla_foreign` (`id_valla`),
  CONSTRAINT `contratos_vallas_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `contratos_vallas_id_valla_foreign` FOREIGN KEY (`id_valla`) REFERENCES `vallas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos_vallas`
--

LOCK TABLES `contratos_vallas` WRITE;
/*!40000 ALTER TABLE `contratos_vallas` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `contratos_vallas` VALUES (2,2,4,NULL,NULL),(3,2,2,NULL,NULL),(4,3,6,NULL,NULL),(5,3,3,NULL,NULL),(6,4,5,NULL,NULL),(7,5,7,NULL,NULL),(8,5,1,NULL,NULL),(9,5,8,NULL,NULL),(10,5,6,NULL,NULL),(11,5,3,NULL,NULL),(12,5,11,NULL,NULL),(13,5,10,NULL,NULL),(14,5,9,NULL,NULL),(15,5,5,NULL,NULL),(16,6,1,NULL,NULL),(17,6,8,NULL,NULL);
/*!40000 ALTER TABLE `contratos_vallas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `contratos_vallas` with 16 row(s)
--

--
-- Table structure for table `datos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_fiscal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poblacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  UNIQUE KEY `datos_nombre_comercial_unique` (`nombre_comercial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos`
--

LOCK TABLES `datos` WRITE;
/*!40000 ALTER TABLE `datos` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `datos` VALUES (1,'GRUPO DE COMUNICACION SAILE S.L.','Saile','C. Secunda Romana, 56','Córdoba','Córdoba','14009',661843906,0,661843906,'info@saile.es','comercial@saile.es','saile1.jpg',NULL,NULL);
/*!40000 ALTER TABLE `datos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `datos` with 1 row(s)
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
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_03_17_092437_create_clients_table',1),(6,'2022_03_21_074333_datos',1),(7,'2022_03_22_072043_create_contratos_table',1),(8,'2022_03_23_073822_vallas',1),(9,'2022_04_08_063403_contratos_vallas',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migrations` with 9 row(s)
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
  `auth_level` enum('3','7','9','12') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Admin','','',0,0,0,0,'9','admin@admin',NULL,'$2y$10$7V5MJdr3Z9Jni4YHUt3jxecD0T6oipE/D5lHCRSKxjud2ISGadism',NULL,NULL,NULL),(2,'Robin Balistreri Jr.','','user1.jpg',0,0,1,0,'3','joelle15@example.org','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Hy53CDNLBl3Zlkty6jvpYNK0r1hLd8ZYmyp5um6ZsOu5iqUyltHmDS4aUZt9','2022-04-18 08:19:13','2022-04-18 08:42:48'),(3,'Dakota Kunze','a','user1.jpg',0,0,1,1,'3','antone15@example.org','2022-04-18 08:19:13','$2y$10$jCO5I9GGdAJ6pGyC73hnt.x6EEipB8n729fr9ko9kH1EupkgL0NlW','yvgu3C2LRoOjdE1k97bUL3jKFuRTzXc6NBlTdpUrK1xQI44I4UEIsLKXdIyo','2022-04-18 08:19:13','2022-04-20 05:54:37'),(4,'Kayli VonRueden','','user2.jpg',0,0,0,0,'3','albina.moore@example.net','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','R4O3c5o4tR','2022-04-18 08:19:13','2022-04-18 08:19:13'),(5,'Jaeden Baumbach','','user2.jpg',0,0,0,0,'3','cwalter@example.net','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','GPZ28Nm66M','2022-04-18 08:19:13','2022-04-18 08:19:13'),(6,'Jerad Blick','','user1.jpg',0,0,0,0,'3','armani.carroll@example.net','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','XhQIocaAP1','2022-04-18 08:19:13','2022-04-18 08:19:13'),(7,'Ashton Kiehn','','user2.jpg',0,0,0,0,'3','bradtke.leif@example.net','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','PPOoHNS132','2022-04-18 08:19:13','2022-04-18 08:19:13'),(8,'Chadd Schultz','','user1.jpg',0,0,0,0,'3','bode.andres@example.com','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','NdX942h4bj','2022-04-18 08:19:13','2022-04-18 08:19:13'),(9,'Rosemarie Haley','','user2.jpg',0,0,0,0,'3','hkuhn@example.org','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','wJYdDxOaDL','2022-04-18 08:19:13','2022-04-18 08:19:13'),(10,'Janet Lakin','','user1.jpg',0,0,0,0,'3','bogisich.velva@example.org','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ROCTSWgmuF','2022-04-18 08:19:13','2022-04-18 08:19:13'),(11,'Gardner Donnelly II','','user2.jpg',0,0,0,0,'3','green.marge@example.net','2022-04-18 08:19:13','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','R0QHbny2dL','2022-04-18 08:19:13','2022-04-18 08:19:13'),(12,'Anto','Anto','A141PTCEATM6rriMHyAVBeGYv01yvQitb3x2p1N7.png',0,0,0,1,'3','A@a.com',NULL,'$2y$10$Tc72ZRu3onI3NfXuErI.webMRc33tC28sLzcgmSrswkNC9dUIVG12',NULL,'2022-04-20 08:02:35','2022-04-20 08:02:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 12 row(s)
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
  `vinilo` tinyint(1) NOT NULL DEFAULT 0,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `fotografia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incidencias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vallas`
--

LOCK TABLES `vallas` WRITE;
/*!40000 ALTER TABLE `vallas` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `vallas` VALUES (1,'Explanada Top Level S.L.','Calle Helsinki 6',1,37.9001041,-4.7333211,0,'ejemploValla.jpg','Esta valla esta en buen estado',NULL,NULL),(2,'Mrs. Francisca Moore PhD','56372 Era Burg Apt. 432\nSchultzchester, SC 50759',0,-77.1074790,54.1644960,0,'saile1.jpg','These were the cook, to see anything; then she heard her voice sounded hoarse and strange, and the other two were using it as you might knock, and I shall have some fun now!\' thought Alice. \'I mean.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(3,'Mr. Layne Funk DVM','2836 Wilfredo Village Suite 321\nTurcottestad, MD 76099',0,77.4716240,53.5987820,0,'saile2.jpg','Queen?\' said the Hatter. He had been anxiously looking across the field after it, never once considering how in the last word with such a puzzled expression that she did not notice this last remark.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(4,'Raphaelle Little','72908 Nitzsche Mountain\nNorth Lionel, PA 78106-4576',0,29.1881260,120.5450880,0,'saile2.jpg','King said, turning to Alice: he had taken his watch out of it, and fortunately was just saying to herself, as usual. \'Come, there\'s no name signed at the bottom of a dance is it?\' \'Why,\' said the.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(5,'Mrs. Lorena Nienow Jr.','4877 Ross Mission Apt. 059\nWalshside, OK 02155-6836',1,45.0317340,-2.3886110,0,'saile2.jpg','I gave her one, they gave him two, You gave us three or more; They all sat down a good opportunity for repeating his remark, with variations. \'I shall do nothing of the lefthand bit of stick, and.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(6,'Dr. Allen Douglas Jr.','37075 Stamm Circles Suite 869\nNorth Kellystad, GA 81755',0,-35.2934710,119.2232010,0,'saile2.jpg','Who ever saw one that size? Why, it fills the whole thing very absurd, but they were trying to make it stop. \'Well, I\'d hardly finished the guinea-pigs!\' thought Alice. \'I\'m glad they don\'t give.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(7,'Brooke Thompson','128 Cristina Hollow\nNew Norbertoburgh, CT 06891',0,87.2289340,-90.4646770,0,'saile2.jpg','I wonder if I like being that person, I\'ll come up: if not, I\'ll stay down here till I\'m somebody else\"--but, oh dear!\' cried Alice, quite forgetting in the sea. But they HAVE their tails in their.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(8,'Miss Ashlynn Huels','30548 Adriana Extension Apt. 854\nEast Gardnerborough, MI 80032',0,-38.1413320,89.9715840,0,'saile1.jpg','King. \'Nearly two miles high,\' added the Gryphon, \'you first form into a conversation. Alice replied, so eagerly that the Queen was silent. The King and Queen of Hearts, carrying the King\'s crown on.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(9,'Prof. Demetrius Dooley','978 Waldo Tunnel Apt. 637\nHeloiseshire, AZ 86579-3994',1,5.4010140,106.8622210,0,'saile2.jpg','Time, and round Alice, every now and then, \'we went to him,\' said Alice in a low curtain she had somehow fallen into it: there was a table, with a sudden burst of tears, but said nothing. \'This here.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(10,'Garth Stamm','732 Donnell Mill Apt. 828\nFeilport, AZ 43681-3159',1,41.5216690,-77.1892860,0,'saile2.jpg','I am very tired of this. I vote the young Crab, a little of it?\' said the King. (The jury all brightened up again.) \'Please your Majesty,\' he began, \'for bringing these in: but I shall never get to.','2022-04-18 08:19:13','2022-04-18 08:19:13'),(11,'Ivy Lebsack','84781 Ezekiel Center Apt. 736\nKatelintown, ID 30878-3706',0,-76.3879040,-12.5307430,0,'saile1.jpg','I was thinking I should think it so quickly that the Gryphon whispered in reply, \'for fear they should forget them before the trial\'s over!\' thought Alice. \'I\'m a--I\'m a--\' \'Well! WHAT are you?\' And.','2022-04-18 08:19:13','2022-04-18 08:19:13');
/*!40000 ALTER TABLE `vallas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `vallas` with 11 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Thu, 21 Apr 2022 07:36:18 +0000
