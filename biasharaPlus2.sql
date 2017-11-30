-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: biasharaPlus
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `bundles`
--

DROP TABLE IF EXISTS `bundles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bundles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `duration_in_months` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bundles`
--

LOCK TABLES `bundles` WRITE;
/*!40000 ALTER TABLE `bundles` DISABLE KEYS */;
INSERT INTO `bundles` VALUES (1,'Package_1',1000,1,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(2,'Package_2',5000,6,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(3,'Package_3',10000,12,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL);
/*!40000 ALTER TABLE `bundles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'expedita','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(2,'ipsa','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(3,'ipsam','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(4,'sit','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(5,'iusto','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(6,'qui','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification_number` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Tanzania','TZS',0,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(2,'Kenya','KES',1,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(3,'Uganda','UGS',2,'2017-11-29 12:11:32','2017-11-29 12:11:32',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'nellie.smith@hotmail.com','Itaque sapiente est ea.','Quibusdam deleniti aut dignissimos. Eum non dolor accusamus enim.','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(2,'clair.bednar@gmail.com','Fugiat delectus sunt minus cumque ducimus quo.','Temporibus odit voluptatem possimus sint autem quia eum. Excepturi ab quia nihil voluptas asperiores maxime. Est vitae et doloribus soluta nisi velit autem sunt. Dolores est aut optio consequatur et illum et.','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(3,'heidi.aufderhar@herzog.com','Perferendis aliquam iure molestiae.','Magni itaque qui omnis. Neque dolorum omnis debitis et. Non qui nobis deserunt et optio doloremque et. Asperiores odit ea facilis suscipit illum assumenda.','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (328,'2014_10_12_000000_create_users_table',1),(329,'2014_10_12_100000_create_password_resets_table',1),(330,'2016_06_01_000001_create_oauth_auth_codes_table',1),(331,'2016_06_01_000002_create_oauth_access_tokens_table',1),(332,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(333,'2016_06_01_000004_create_oauth_clients_table',1),(334,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(335,'2017_11_07_103342_create_price_lists_table',1),(336,'2017_11_07_103410_create_categories_table',1),(337,'2017_11_07_103422_create_products_table',1),(338,'2017_11_07_103432_create_prices_table',1),(339,'2017_11_07_103458_create_payments_table',1),(340,'2017_11_07_103524_create_user_devices_table',1),(341,'2017_11_07_103552_create_feedback_table',1),(342,'2017_11_07_103605_create_versions_table',1),(343,'2017_11_08_063252_edit_price_lists_table_1',1),(344,'2017_11_08_091528_edit_price_lists_table_2',1),(345,'2017_11_08_113812_edit_users_table_1',1),(346,'2017_11_08_122830_edit_users_table_2',1),(347,'2017_11_08_123615_edit_users_table_3',1),(348,'2017_11_08_131739_edit_users_table_4',1),(349,'2017_11_08_134357_edit_users_table_5',1),(350,'2017_11_13_063810_edit_feedback_table_1',1),(351,'2017_11_13_101550_edit_payments_table_1',1),(352,'2017_11_13_113338_edit_payments_table_2',1),(353,'2017_11_13_115127_edit_feedback_table_2',1),(354,'2017_11_21_094255_edit_price_lists_table_3',1),(355,'2017_11_22_112535_edit_categories_table_1',1),(356,'2017_11_22_203145_edit_products_table_1',1),(357,'2017_11_22_213159_edit_products_table_2',1),(358,'2017_11_22_213415_edit_products_table_3',1),(359,'2017_11_22_214342_edit_products_table_4',1),(360,'2017_11_23_073716_edit_products_table_5',1),(361,'2017_11_23_161258_edit_price_lists_table_4',1),(362,'2017_11_27_111210_edit_categories_table_2',1),(363,'2017_11_27_111310_edit_products_table_6',1),(364,'2017_11_27_111341_edit_price_lists_table_5',1),(365,'2017_11_28_063159_create_countries_table',1),(366,'2017_11_28_063828_create_bundles_table',1),(367,'2017_11_28_063852_create_pay_bill_numbers_table',1),(368,'2017_11_28_100821_edit_users_table_6',1),(369,'2017_11_28_122827_edit_users_table_7',1),(370,'2017_11_28_152012_edit_versions_table_1',1),(371,'2017_11_29_122104_edit_users_table_8',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('c28956991f8147f6b8b93f723842389824f462a76eb6a71c92d1074366356fec5601a2418d1837fe',6,1,'vaeeada@gmail.com','[]',0,'2017-11-29 12:31:10','2017-11-29 12:31:10','2018-11-29 15:31:10'),('e46178bf770947d2c45e839c3df3a4ebf0c7f860dd571f0e6395f8a1176a815b3633733b419c7e71',6,1,'vaeeada@gmail.com','[]',0,'2017-11-29 15:16:47','2017-11-29 15:16:47','2018-11-29 18:16:47');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','8akbmealYNyq0ZL9OAPFfYFfyC0OkxnFy3NO3u9q','http://localhost',1,0,0,'2017-11-29 12:16:13','2017-11-29 12:16:13'),(2,NULL,'Laravel Password Grant Client','WMAmgmOX2tflii9V5y5KbwCUDCjMO4V2m8NMYKZY','http://localhost',0,1,0,'2017-11-29 12:16:13','2017-11-29 12:16:13');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2017-11-29 12:16:13','2017-11-29 12:16:13');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
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
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_bill_numbers`
--

DROP TABLE IF EXISTS `pay_bill_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_bill_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_bill_numbers`
--

LOCK TABLES `pay_bill_numbers` WRITE;
/*!40000 ALTER TABLE `pay_bill_numbers` DISABLE KEYS */;
INSERT INTO `pay_bill_numbers` VALUES (1,'Vodacom','0767188777','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(2,'Tigo','0718728778','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL),(3,'Airtel','0767188777','2017-11-29 12:11:32','2017-11-29 12:11:32',NULL);
/*!40000 ALTER TABLE `pay_bill_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `date_payed` date NOT NULL,
  `operator_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `total_to_date` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_lists`
--

DROP TABLE IF EXISTS `price_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `effective_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_lists`
--

LOCK TABLES `price_lists` WRITE;
/*!40000 ALTER TABLE `price_lists` DISABLE KEYS */;
INSERT INTO `price_lists` VALUES (1,'asst_spvsr','1996-09-26','#31fc20','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(2,'spvsr','2004-09-30','#7e1262','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(3,'asst_man','2006-02-12','#881a8b','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(4,'man','1994-08-19','#c1a8df','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(5,'retail','1985-08-21','#45bc42','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(6,'novus','1974-02-15','#a239d4','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL);
/*!40000 ALTER TABLE `price_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `price_list_id` int(10) unsigned NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT '0',
  `tanzania` bigint(20) NOT NULL DEFAULT '0',
  `kenya` bigint(20) NOT NULL DEFAULT '0',
  `uganda` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prices_product_id_foreign` (`product_id`),
  KEY `prices_price_list_id_foreign` (`price_list_id`),
  CONSTRAINT `prices_price_list_id_foreign` FOREIGN KEY (`price_list_id`) REFERENCES `price_lists` (`id`),
  CONSTRAINT `prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,1,1,11536,5870,5407,10138,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(2,1,2,15124,18415,11457,19291,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(3,1,3,9634,1092,7688,6094,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(4,1,4,13759,1337,14983,1507,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(5,1,5,12519,18591,10624,4604,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(6,1,6,13641,15963,13014,11114,'2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(7,2,1,17408,10042,7513,15106,'2017-11-29 12:13:45','2017-11-29 12:13:45',NULL),(8,2,2,11975,5067,13523,11040,'2017-11-29 12:13:45','2017-11-29 12:13:45',NULL),(9,2,3,7386,15095,5933,9625,'2017-11-29 12:13:45','2017-11-29 12:13:45',NULL),(10,2,4,16917,15853,18391,12713,'2017-11-29 12:13:45','2017-11-29 12:13:45',NULL),(11,2,5,18904,4548,12445,18530,'2017-11-29 12:13:46','2017-11-29 12:13:46',NULL),(12,2,6,7749,8652,16738,17929,'2017-11-29 12:13:46','2017-11-29 12:13:46',NULL),(13,3,1,19625,19127,10909,11341,'2017-11-29 12:15:47','2017-11-29 12:15:47',NULL),(14,3,2,6881,13488,8423,9569,'2017-11-29 12:15:47','2017-11-29 12:15:47',NULL),(15,3,3,7510,16745,12125,1946,'2017-11-29 12:15:47','2017-11-29 12:15:47',NULL),(16,3,4,14522,19354,6134,1188,'2017-11-29 12:15:47','2017-11-29 12:15:47',NULL),(17,3,5,17250,18581,8473,16529,'2017-11-29 12:15:48','2017-11-29 12:15:48',NULL),(18,3,6,6570,13012,5468,2124,'2017-11-29 12:15:48','2017-11-29 12:15:48',NULL);
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` double(17,3) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'fish','1',5.000,'1.jpg','In autem eaque reprehenderit omnis tempore delectus sed. Sed eum perferendis voluptate sapiente. Totam dolore magnam sit est aut dolor tempore. Aut ab eaque odio et non.','2017-11-29 12:11:30','2017-11-29 12:11:30',NULL),(2,2,'car','2',4.000,'1.jpg','Consequatur dolor non maiores quisquam tempora dolorem. Iste deleniti fugiat nihil nulla ut delectus. Voluptates dolor libero voluptatem perferendis. Qui aut voluptatum laboriosam recusandae at rerum fugit.','2017-11-29 12:13:38','2017-11-29 12:13:38',NULL),(3,3,'nissan','3',4.000,'1.jpg','Fugit amet quia ex. Commodi est voluptatibus corrupti aspernatur saepe et. Aut aut qui quam quia quo corporis et. Harum at vero saepe maxime temporibus amet aut nemo.','2017-11-29 12:15:43','2017-11-29 12:15:43',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_devices`
--

DROP TABLE IF EXISTS `user_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `device_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `user_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_devices`
--

LOCK TABLES `user_devices` WRITE;
/*!40000 ALTER TABLE `user_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'free',
  `subscription_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_cc` double(17,3) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'4716964503846929',NULL,'Porter','vheidenreich@gmail.com','+16936754863',NULL,'premium','1989-05-20','2014-05-19',62.000,'Australia','uploads/users/1.jpg',NULL,'2017-11-29 12:11:29','2017-11-29 12:11:29',NULL,0,0),(2,'5400282230270984',NULL,'Karolann','rohan.hans@mayert.com','963.845.8160 x651',NULL,'free','2002-11-05','2004-05-14',69.000,'Benin','uploads/users/1.jpg',NULL,'2017-11-29 12:11:29','2017-11-29 12:11:29',NULL,0,0),(3,'4024007139047855',NULL,'Amelie','mfeest@cronin.com','467-606-3259 x7375',NULL,'premium','1979-05-10','2006-10-30',35.000,'Mozambique','uploads/users/1.jpg',NULL,'2017-11-29 12:11:30','2017-11-29 12:11:30',NULL,0,0),(4,NULL,NULL,'admin',NULL,NULL,'$2y$10$jl7PjZYgJf/u4rTkc6A6pOaEt220GdXfYEgsBKPrDplG20MaRYEHi','free',NULL,NULL,NULL,NULL,NULL,NULL,'2017-11-29 12:11:30','2017-11-29 12:11:30',NULL,1,0),(5,NULL,NULL,'ipf_pay',NULL,NULL,'$2y$10$7bakCTbHP0S8q5r5KS53U.wQ9GyTtzTtpP9ypsWjt7eteyx0hITFe','free',NULL,NULL,NULL,NULL,NULL,NULL,'2017-11-29 12:11:30','2017-11-29 12:11:30',NULL,1,1),(6,NULL,NULL,'mdaefona jonwew','vaeeada@gmail.com','0767188777',NULL,'free','29-11-2017','29-12-2017',12.000,'0',NULL,NULL,'2017-11-29 12:31:10','2017-11-29 12:31:10',NULL,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versions`
--

DROP TABLE IF EXISTS `versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versions`
--

LOCK TABLES `versions` WRITE;
/*!40000 ALTER TABLE `versions` DISABLE KEYS */;
INSERT INTO `versions` VALUES (1,'1.1',1,'More security fixes','2017-11-29 12:11:31','2017-11-29 13:29:39',NULL),(2,'2',0,'More security fixes','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL),(3,'3',0,'More security fixes','2017-11-29 12:11:31','2017-11-29 12:11:31',NULL);
/*!40000 ALTER TABLE `versions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-30 10:55:51
