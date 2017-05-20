-- MySQL dump 10.13  Distrib 5.7.14, for Win64 (x86_64)
--
-- Host: localhost    Database: tuyensinh_online
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'superadmin','{\"_superadmin\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(2,'editor','{\"_user-editor\":1,\"_group-editor\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(3,'base admin','{\"_user-editor\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(4,'level 2','{\"_my-pexcel\":1,\"_mod-2\":1}',0,'2017-05-15 14:13:46','2017-05-15 14:13:57'),(5,'level 3','{\"_mod-3\":1}',0,'2017-05-15 14:14:42','2017-05-15 14:15:00');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),(2,'2014_02_19_095545_create_users_table',1),(3,'2014_02_19_095623_create_user_groups_table',1),(4,'2014_02_19_095637_create_groups_table',1),(5,'2014_02_19_160516_create_permission_table',1),(6,'2014_02_26_165011_create_user_profile_table',1),(7,'2014_05_06_122145_create_profile_field_types',1),(8,'2014_05_06_122155_create_profile_field',1),(9,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'superadmin','_superadmin',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(2,'user editor','_user-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(3,'group editor','_group-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(4,'permission editor','_permission-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(5,'profile type editor','_profile-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(6,'my pexcel','_my-pexcel',0,'2017-05-15 12:37:02','2017-05-15 12:37:02'),(7,'all pexcel','_all-pexcel',0,'2017-05-15 12:37:11','2017-05-15 12:37:11'),(8,'mod-2','_mod-2',0,'2017-05-15 14:12:36','2017-05-15 14:12:36'),(9,'mod-3','_mod-3',0,'2017-05-15 14:12:49','2017-05-15 14:12:49'),(10,'student','_student',0,'2017-05-17 14:22:22','2017-05-17 14:22:22');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pexcel`
--

DROP TABLE IF EXISTS `pexcel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pexcel` (
  `pexcel_id` int(11) NOT NULL AUTO_INCREMENT,
  `pexcel_category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pexcel_fromrow` int(11) DEFAULT NULL,
  `pexcel_torow` int(11) DEFAULT NULL,
  `pexcel_value` longtext CHARACTER SET utf8,
  `pexcel_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pexcel_description` text COLLATE utf8_unicode_ci,
  `pexcel_file_path` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pexcel_status` tinyint(4) NOT NULL,
  `pexcel_created_at` int(11) DEFAULT NULL,
  `pexcel_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`pexcel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pexcel`
--

LOCK TABLES `pexcel` WRITE;
/*!40000 ALTER TABLE `pexcel` DISABLE KEYS */;
INSERT INTO `pexcel` VALUES (4,4,1,9,21,'[{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"xx\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"bb\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"cc\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"}]','asdfasdfasdf','<p>asdfasdfasdf</p>','/files/1/test.xlsx',11,1495103213,1495126121);
/*!40000 ALTER TABLE `pexcel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pexcel_categories`
--

DROP TABLE IF EXISTS `pexcel_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pexcel_categories` (
  `pexcel_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `pexcel_category_name` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pexcel_category_from` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pexcel_category_to` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pexcel_category_status` tinyint(4) DEFAULT NULL,
  `pexcel_category_created_at` int(11) DEFAULT NULL,
  `pexcel_category_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`pexcel_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pexcel_categories`
--

LOCK TABLES `pexcel_categories` WRITE;
/*!40000 ALTER TABLE `pexcel_categories` DISABLE KEYS */;
INSERT INTO `pexcel_categories` VALUES (4,'2017 - 2018',1,NULL,NULL,99,1494214137,1495100245),(3,'2016 - 2017',1,NULL,NULL,77,1494214118,1495100251);
/*!40000 ALTER TABLE `pexcel_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_field`
--

DROP TABLE IF EXISTS `profile_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `profile_field_type_id` int(10) unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profile_field_profile_id_profile_field_type_id_unique` (`profile_id`,`profile_field_type_id`),
  KEY `profile_field_profile_field_type_id_foreign` (`profile_field_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_field`
--

LOCK TABLES `profile_field` WRITE;
/*!40000 ALTER TABLE `profile_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_field_type`
--

DROP TABLE IF EXISTS `profile_field_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_field_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_field_type`
--

LOCK TABLES `profile_field_type` WRITE;
/*!40000 ALTER TABLE `profile_field_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_field_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_categories`
--

DROP TABLE IF EXISTS `school_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_categories` (
  `school_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_category_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`school_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_categories`
--

LOCK TABLES `school_categories` WRITE;
/*!40000 ALTER TABLE `school_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `school_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_classes`
--

DROP TABLE IF EXISTS `school_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_classes` (
  `school_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_class_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_class_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`school_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_classes`
--

LOCK TABLES `school_classes` WRITE;
/*!40000 ALTER TABLE `school_classes` DISABLE KEYS */;
INSERT INTO `school_classes` VALUES (1,'TOAN','TOÁN'),(2,'NGUVAN','NGỮ VĂN'),(3,'VATLY','VẬT LÝ'),(4,'HOAHOC','HÓA HỌC'),(5,'SINHHOC','SINH HỌC'),(6,'TIENGANH','TIẾNG ANH'),(7,'TIN','TIN HỌC'),(8,'TOANTIN','TIN HỌC THI TOÁN'),(9,'DIALY','ĐỊA LÝ'),(10,'LICHSU','LỊCH SỬ');
/*!40000 ALTER TABLE `school_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_courses`
--

DROP TABLE IF EXISTS `school_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_courses` (
  `school_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_course_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_course_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `flat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`school_course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_courses`
--

LOCK TABLES `school_courses` WRITE;
/*!40000 ALTER TABLE `school_courses` DISABLE KEYS */;
INSERT INTO `school_courses` VALUES (1,'2016-2017','Năm học 2016-2017',0);
/*!40000 ALTER TABLE `school_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_districts`
--

DROP TABLE IF EXISTS `school_districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_districts` (
  `school_district_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_district_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_district_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`school_district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_districts`
--

LOCK TABLES `school_districts` WRITE;
/*!40000 ALTER TABLE `school_districts` DISABLE KEYS */;
INSERT INTO `school_districts` VALUES (1,'11','Tây Hòa'),(2,'22','Đông Hòa'),(3,'33','Sông Hinh'),(4,'44','Phú Hòa'),(5,'55','Tuy An'),(6,'66','Đồng Xuân'),(7,'77','Sông Cầu'),(8,'88','Sơn Hòa'),(9,'99','Tp Tuy Hòa');
/*!40000 ALTER TABLE `school_districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_point_priors`
--

DROP TABLE IF EXISTS `school_point_priors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_point_priors` (
  `school_prior_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_prior_point_1` double DEFAULT NULL,
  `school_prior_point_2` double NOT NULL,
  `school_prior_point_3` double NOT NULL,
  PRIMARY KEY (`school_prior_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_point_priors`
--

LOCK TABLES `school_point_priors` WRITE;
/*!40000 ALTER TABLE `school_point_priors` DISABLE KEYS */;
INSERT INTO `school_point_priors` VALUES (1,1,2,1);
/*!40000 ALTER TABLE `school_point_priors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_points`
--

DROP TABLE IF EXISTS `school_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_points` (
  `school_point_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_point_capacity` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `school_point_conduct` enum('T','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `school_point_point` double DEFAULT NULL,
  PRIMARY KEY (`school_point_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_points`
--

LOCK TABLES `school_points` WRITE;
/*!40000 ALTER TABLE `school_points` DISABLE KEYS */;
INSERT INTO `school_points` VALUES (7,'G','TB',7),(6,'G','K',9),(5,'G','T',10),(8,'G','Y',5),(9,'K','T',9),(10,'K','K',8),(11,'K','TB',6),(12,'K','Y',5),(13,'TB','T',7),(14,'TB','K',6),(15,'TB','TB',5),(16,'TB','Y',5),(17,'Y','T',5),(18,'Y','K',5),(19,'Y','TB',5),(20,'Y','Y',5);
/*!40000 ALTER TABLE `school_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_students`
--

DROP TABLE IF EXISTS `school_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_identifi` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_identifi_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_room` int(11) DEFAULT NULL,
  `student_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth` int(11) DEFAULT NULL,
  `student_birth_day` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_month` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_year` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_place` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `school_code` int(11) DEFAULT NULL,
  `school_district_code` int(11) DEFAULT NULL,
  `student_class` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `student_capacity_6` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_conduct_6` enum('T','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_point_6` double DEFAULT NULL,
  `student_capacity_7` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_conduct_7` enum('T','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_point_7` double DEFAULT NULL,
  `student_capacity_8` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_conduct_8` enum('T','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_point_8` double DEFAULT NULL,
  `student_capacity_9` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_conduct_9` enum('T','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_point_9` double DEFAULT NULL,
  `student_average` double DEFAULT NULL,
  `student_average_1` double DEFAULT NULL,
  `student_average_2` double DEFAULT NULL,
  `student_graduate` enum('G','K','TB','Y') CHARACTER SET utf8 DEFAULT NULL,
  `student_score_prior` double DEFAULT NULL,
  `student_score_prior_comment` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `student_point_sum` double NOT NULL,
  `student_nominate` int(11) DEFAULT '0',
  `school_code_option` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_class_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_code_option_1` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_code_option_2` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_user` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `student_pass` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pexcel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_students`
--

LOCK TABLES `school_students` WRITE;
/*!40000 ALTER TABLE `school_students` DISABLE KEYS */;
INSERT INTO `school_students` VALUES (1,'991',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'xx',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080001','3080001','2017 - 2018',4),(2,'992',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080002','3080002','2017 - 2018',4),(3,'993',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080003','3080003','2017 - 2018',4),(4,'994',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080004','3080004','2017 - 2018',4),(5,'995',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'bb',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080005','3080005','2017 - 2018',4),(6,'996',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080006','3080006','2017 - 2018',4),(7,'997',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080007','3080007','2017 - 2018',4),(8,'998',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080008','3080008','2017 - 2018',4),(9,'999',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'cc',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080009','3080009','2017 - 2018',4),(10,'9910',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080010','3080010','2017 - 2018',4),(11,'9911',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080011','3080011','2017 - 2018',4),(12,'9912',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080012','3080012','2017 - 2018',4),(13,'9913',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'xx',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080013','3080013','2017 - 2018',4),(14,'9914',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080014','3080014','2017 - 2018',4),(15,'9915',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080015','3080015','2017 - 2018',4),(16,'9916',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080016','3080016','2017 - 2018',4),(17,'9917',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'bb',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080017','3080017','2017 - 2018',4),(18,'9918',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080018','3080018','2017 - 2018',4),(19,'9919',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080019','3080019','2017 - 2018',4),(20,'9920',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080020','3080020','2017 - 2018',4),(21,'9921',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'cc',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080021','3080021','2017 - 2018',4),(22,'9922',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080022','3080022','2017 - 2018',4),(23,'9923',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080023','3080023','2017 - 2018',4),(24,'9924',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080024','3080024','2017 - 2018',4),(25,'9925',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'xx',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080025','3080025','2017 - 2018',4),(26,'9926',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080026','3080026','2017 - 2018',4),(27,'9927',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080027','3080027','2017 - 2018',4),(28,'9928',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080028','3080028','2017 - 2018',4),(29,'9929',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'bb',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080029','3080029','2017 - 2018',4),(30,'9930',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080030','3080030','2017 - 2018',4),(31,'9931',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080031','3080031','2017 - 2018',4),(32,'9932',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080032','3080032','2017 - 2018',4),(33,'9933',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'cc',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080033','3080033','2017 - 2018',4),(34,'9934',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080034','3080034','2017 - 2018',4),(35,'9935',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080035','3080035','2017 - 2018',4),(36,'9936',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080036','3080036','2017 - 2018',4),(37,'9937',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'xx',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080037','3080037','2017 - 2018',4),(38,'9938',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080038','3080038','2017 - 2018',4),(39,'9939',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080039','3080039','2017 - 2018',4),(40,'9940',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080040','3080040','2017 - 2018',4),(41,'9941',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'bb',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080041','3080041','2017 - 2018',4),(42,'9942',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080042','3080042','2017 - 2018',4),(43,'9943',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080043','3080043','2017 - 2018',4),(44,'9944',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080044','3080044','2017 - 2018',4),(45,'9945',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'cc',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080045','3080045','2017 - 2018',4),(46,'9946',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080046','3080046','2017 - 2018',4),(47,'9947',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',7,'TB','T',7,'TB','T',7,'TB','T',7,5.6,6.5,7.3,'TB',NULL,NULL,28,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080047','3080047','2017 - 2018',4),(48,'9948',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',5,'TB','K',6,'TB','K',6,'TB','K',6,6,6,5.9,'TB',NULL,NULL,23,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080048','3080048','2017 - 2018',4),(49,'9949',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',10,'K','K',8,'K','T',9,'G','T',10,8.5,8.3,8.5,'G',2.5,'xx',38,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080049','3080049','2017 - 2018',4),(50,'9950',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',9,'TB','T',7,'K','T',9,'K','T',9,7.5,7.6,8,'K',NULL,NULL,34,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080050','3080050','2017 - 2018',4),(51,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080051','3080051','2017 - 2018',4),(52,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080052','3080052','2017 - 2018',4),(53,'',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',0,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'bb',0,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080053','3080053','2017 - 2018',4),(54,'',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',0,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,0,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080054','3080054','2017 - 2018',4),(55,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080055','3080055','2017 - 2018',4),(56,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080056','3080056','2017 - 2018',4),(57,'',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',0,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'cc',0,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080057','3080057','2017 - 2018',4),(58,'',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',0,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,0,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080058','3080058','2017 - 2018',4),(59,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080059','3080059','2017 - 2018',4),(60,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080060','3080060','2017 - 2018',4),(61,'',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',0,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'xx',0,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080061','3080061','2017 - 2018',4),(62,'',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',0,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,0,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080062','3080062','2017 - 2018',4),(63,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080063','3080063','2017 - 2018',4),(64,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080064','3080064','2017 - 2018',4),(65,'',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',0,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'bb',0,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080065','3080065','2017 - 2018',4),(66,'',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',0,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,0,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080066','3080066','2017 - 2018',4),(67,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080067','3080067','2017 - 2018',4),(68,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080068','3080068','2017 - 2018',4),(69,'',NULL,0,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',0,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'cc',0,NULL,'9900','TOAN','3300','3302','mthanh@gmail.com','0913445058','3080069','3080069','2017 - 2018',4),(70,'',NULL,0,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',0,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,0,NULL,'9901',NULL,'3300','3301','nvanh@gmail.com','0903556635','3080070','3080070','2017 - 2018',4),(71,'',NULL,0,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',0,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,0,NULL,NULL,NULL,'3300','9906','vananh@gmail.com','0914188188\'','3080071','3080071','2017 - 2018',4),(72,'',NULL,0,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',0,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,0,1,'9900','TOANTIN','3300','3302','anh@yahoo.com','0909090909','3080072','3080072','2017 - 2018',4);
/*!40000 ALTER TABLE `school_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_upload`
--

DROP TABLE IF EXISTS `school_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_upload` (
  `school_upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`school_upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_upload`
--

LOCK TABLES `school_upload` WRITE;
/*!40000 ALTER TABLE `school_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `school_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `school_code_room` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_name_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_district_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `school_level_id` int(11) DEFAULT '2',
  `user_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_contact_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_contact_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_choose_specialist` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'100','','Trường THCS Đồng Khởi',NULL,'Phú Yên','057','100@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_100','1','Nhập điện thoại','Nhập email',0),(2,'101','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','101@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_101','1','Nhập điện thoại','Nhập email',0),(3,'102','','Trường THCS Huỳnh Thúc Kháng',NULL,'Phú Yên','057','102@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_102','1','Nhập điện thoại','Nhập email',0),(4,'103','','Trường THCS Lê Hoàn',NULL,'Phú Yên','057','103@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_103','1','Nhập điện thoại','Nhập email',0),(5,'104','','Trường THCS Nguyễn Anh Hào',NULL,'Phú Yên','057','104@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_104','1','Nhập điện thoại','Nhập email',0),(6,'105','','Trường THCS Nguyễn Tất Thành',NULL,'Phú Yên','057','105@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_105','1','Nhập điện thoại','Nhập email',0),(7,'106','','Trường THCS Nguyễn Thị Định',NULL,'Phú Yên','057','106@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_106','1','Nhập điện thoại','Nhập email',0),(8,'107','','Trường THCS Phạm Đình Quy',NULL,'Phú Yên','057','107@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_107','1','Nhập điện thoại','Nhập email',0),(9,'108','','Trường THCS Phạm Văn Đồng',NULL,'Phú Yên','057','108@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_108','1','Nhập điện thoại','Nhập email',0),(10,'109','','Trường THCS Tây Sơn',NULL,'Phú Yên','057','109@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_109','1','Nhập điện thoại','Nhập email',0),(11,'110','','Trường THCS Lê Lợi',NULL,'Phú Yên','057','110@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_110','1','Nhập điện thoại','Nhập email',0),(12,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(13,'200','','Trường THCS Tôn Đức Thắng',NULL,'Phú Yên','057','200@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_200','1','Nhập điện thoại','Nhập email',0),(14,'201','','Trường THCS Trần Hưng Đạo',NULL,'Phú Yên','057','201@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_201','1','Nhập điện thoại','Nhập email',0),(15,'202','','Trường THCS Hoàng Hoa Thám',NULL,'Phú Yên','057','202@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_202','1','Nhập điện thoại','Nhập email',0),(16,'203','','Trường THCS Quang Trung',NULL,'Phú Yên','057','203@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_203','1','Nhập điện thoại','Nhập email',0),(17,'204','','Trường THCS Nguyễn Chí Thanh',NULL,'Phú Yên','057','204@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_204','1','Nhập điện thoại','Nhập email',0),(18,'205','','Trường THCS Trần Nhân Tông',NULL,'Phú Yên','057','205@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_205','1','Nhập điện thoại','Nhập email',0),(19,'206','','Trường THCS Trần Kiệt',NULL,'Phú Yên','057','206@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_206','1','Nhập điện thoại','Nhập email',0),(20,'207','','Trường THCS Lương Tấn Thịnh',NULL,'Phú Yên','057','207@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_207','1','Nhập điện thoại','Nhập email',0),(21,'208','','Trường THCS Trường Chinh',NULL,'Phú Yên','057','208@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_208','1','Nhập điện thoại','Nhập email',0),(22,'209','','Trường THCS Lê Thánh Tôn',NULL,'Phú Yên','057','209@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_209','1','Nhập điện thoại','Nhập email',0),(23,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(24,'300','','Trường THCS Sông Hinh',NULL,'Phú Yên','057','300@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_300','1','Nhập điện thoại','Nhập email',0),(25,'301','','Trường THCS Trần Phú',NULL,'Phú Yên','057','301@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_301','1','Nhập điện thoại','Nhập email',0),(26,'302','','Trường THCS Đức Bình Đông',NULL,'Phú Yên','057','302@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_302','1','Nhập điện thoại','Nhập email',0),(27,'303','','Trường THCS Đức Bình',NULL,'Phú Yên','057','303@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_303','1','Nhập điện thoại','Nhập email',0),(28,'304','','Trường THCS Ea Bá',NULL,'Phú Yên','057','304@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_304','1','Nhập điện thoại','Nhập email',0),(29,'305','','Trường THCS Ea Lâm',NULL,'Phú Yên','057','305@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_305','1','Nhập điện thoại','Nhập email',0),(30,'306','','Trường THCS Eatrol',NULL,'Phú Yên','057','306@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_306','1','Nhập điện thoại','Nhập email',0),(31,'307','','Trường THCS Ea Bar',NULL,'Phú Yên','057','307@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_307','1','Nhập điện thoại','Nhập email',0),(32,'308','','Trường THCS EaLy',NULL,'Phú Yên','057','308@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_308','1','Nhập điện thoại','Nhập email',0),(33,'309','','Trường THCS Tố Hữu',NULL,'Phú Yên','057','309@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_309','1','Nhập điện thoại','Nhập email',0),(34,'310','','Trường THCS & THPT Võ Văn Kiệt',NULL,'Phú Yên','057','310@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_310','1','Nhập điện thoại','Nhập email',0),(35,'311','','Trường PTDTNT Sông Hinh',NULL,'Phú Yên','057','311@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_311','1','Nhập điện thoại','Nhập email',0),(36,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(37,'400','','Trường THCS Hòa An',NULL,'Phú Yên','057','400@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_400','1','Nhập điện thoại','Nhập email',0),(38,'401','','Trường THCS Nguyễn Thế Bảo',NULL,'Phú Yên','057','401@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_401','1','Nhập điện thoại','Nhập email',0),(39,'402','99','THCS Thị Trấn Phú Hòa',NULL,'Phú Yên','057','thcs402@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_402','1','0123','Nhập emaille',0),(40,'403','','Trường THCS Hòa Định Tây',NULL,'Phú Yên','057','403@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_403','1','Nhập điện thoại','Nhập email',0),(41,'404','','Trường THCS Hòa Hội',NULL,'Phú Yên','057','404@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_404','1','Nhập điện thoại','Nhập email',0),(42,'405','','Trường THCS Lương Văn Chánh',NULL,'Phú Yên','057','405@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_405','1','Nhập điện thoại','Nhập email',0),(43,'406','','Trường THCS Trần Hào',NULL,'Phú Yên','057','406@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_406','1','Nhập điện thoại','Nhập email',0),(44,'407','','Trường THCS Hòa Quang',NULL,'Phú Yên','057','407@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_407','1','Nhập điện thoại','Nhập email',0),(45,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(46,'500','','Trường THCS Trần Rịa',NULL,'Phú Yên','057','500@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_500','1','Nhập điện thoại','Nhập email',0),(47,'501','','Trường THCS Nguyễn Thái Bình',NULL,'Phú Yên','057','501@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_501','1','Nhập điện thoại','Nhập email',0),(48,'502','','Trường THCS An Dương Vương',NULL,'Phú Yên','057','502@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_502','1','Nhập điện thoại','Nhập email',0),(49,'503','','Trường THCS Lê Văn Tám',NULL,'Phú Yên','057','503@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_503','1','Nhập điện thoại','Nhập email',0),(50,'504','','Trường THCS Huỳnh Thúc Kháng',NULL,'Phú Yên','057','504@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_504','1','Nhập điện thoại','Nhập email',0),(51,'505','','Trường THCS  An Hiệp',NULL,'Phú Yên','057','505@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_505','1','Nhập điện thoại','Nhập email',0),(52,'506','','Trường THCS Kim Đồng',NULL,'Phú Yên','057','506@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_506','1','Nhập điện thoại','Nhập email',0),(53,'507','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','507@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_507','1','Nhập điện thoại','Nhập email',0),(54,'508','','Trường THCS Võ Trứ',NULL,'Phú Yên','057','508@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_508','1','Nhập điện thoại','Nhập email',0),(55,'509','','Trường THCS Lê Duẩn',NULL,'Phú Yên','057','509@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_509','1','Nhập điện thoại','Nhập email',0),(56,'510','','Trường THCS Ngô Mây',NULL,'Phú Yên','057','510@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_510','1','Nhập điện thoại','Nhập email',0),(57,'511','','Trường THCS Lê Thánh Tông',NULL,'Phú Yên','057','511@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_511','1','Nhập điện thoại','Nhập email',0),(58,'512','','Trường THCS Nguyễn Bá Ngọc',NULL,'Phú Yên','057','512@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_512','1','Nhập điện thoại','Nhập email',0),(59,'513','','Trường THCS Nguyễn Hoa',NULL,'Phú Yên','057','513@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_513','1','Nhập điện thoại','Nhập email',0),(60,'514','','Trường THCS & THPT Võ Thị Sáu',NULL,'Phú Yên','057','514@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_514','1','Nhập điện thoại','Nhập email',0),(61,'515','','Trường THCS & THPT Nguyễn Viết Xuân',NULL,'Phú Yên','057','515@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_515','1','Nhập điện thoại','Nhập email',0),(62,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(63,'600','','Trường THCS Nguyễn Viết Xuân',NULL,'Phú Yên','057','600@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_600','1','Nhập điện thoại','Nhập email',0),(64,'601','','Trường THCS Trần Quốc Toản',NULL,'Phú Yên','057','601@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_601','1','Nhập điện thoại','Nhập email',0),(65,'602','','Trường THCS Phan Lưu Thanh',NULL,'Phú Yên','057','602@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_602','1','Nhập điện thoại','Nhập email',0),(66,'603','','Trường THCS Trần Quốc Tuấn',NULL,'Phú Yên','057','603@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_603','1','Nhập điện thoại','Nhập email',0),(67,'604','','Trường THCS Nguyễn Văn Trỗi',NULL,'Phú Yên','057','604@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_604','1','Nhập điện thoại','Nhập email',0),(68,'605','','Trường THCS Hoàng Văn Thụ',NULL,'Phú Yên','057','605@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_605','1','Nhập điện thoại','Nhập email',0),(69,'606','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','606@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_606','1','Nhập điện thoại','Nhập email',0),(70,'607','','Trường THCS Nguyễn Hào Sự',NULL,'Phú Yên','057','607@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_607','1','Nhập điện thoại','Nhập email',0),(71,'608','','Trường THCS Lê Văn Tám',NULL,'Phú Yên','057','608@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_608','1','Nhập điện thoại','Nhập email',0),(72,'609','','Trường PTDTBT Đinh Núp',NULL,'Phú Yên','057','609@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_609','1','Nhập điện thoại','Nhập email',0),(73,'610','','Trường THCS & THPT Chu Văn An',NULL,'Phú Yên','057','610@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_610','1','Nhập điện thoại','Nhập email',0),(74,'611','','Trường PTDTNT Đồng Xuân',NULL,'Phú Yên','057','611@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_611','1','Nhập điện thoại','Nhập email',0),(75,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(76,'700','','Trường THCS Tô Vĩnh Diện',NULL,'Phú Yên','057','700@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_700','1','Nhập điện thoại','Nhập email',0),(77,'701','','Trường THCS Bùi Thị Xuân',NULL,'Phú Yên','057','701@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_701','1','Nhập điện thoại','Nhập email',0),(78,'702','','Trường THCS Triệu Thị Trinh',NULL,'Phú Yên','057','702@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_702','1','Nhập điện thoại','Nhập email',0),(79,'703','','Trường THCS Cù Chính Lan',NULL,'Phú Yên','057','703@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_703','1','Nhập điện thoại','Nhập email',0),(80,'704','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','704@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_704','1','Nhập điện thoại','Nhập email',0),(81,'705','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','705@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_705','1','Nhập điện thoại','Nhập email',0),(82,'706','','Trường THCS Mạc Đỉnh Chi',NULL,'Phú Yên','057','706@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_706','1','Nhập điện thoại','Nhập email',0),(83,'707','','Trường THCS Hoàng Văn Thụ',NULL,'Phú Yên','057','707@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_707','1','Nhập điện thoại','Nhập email',0),(84,'708','','Trường THCS Nguyễn Hồng Sơn',NULL,'Phú Yên','057','708@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_708','1','Nhập điện thoại','Nhập email',0),(85,'709','','Trường THCS Đoàn Thị Điểm',NULL,'Phú Yên','057','709@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_709','1','Nhập điện thoại','Nhập email',0),(86,'710','','Trường THCS & THPT Nguyễn Khuyến',NULL,'Phú Yên','057','710@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_710','1','Nhập điện thoại','Nhập email',0),(87,'711','','Trường TH & THCS Lê Thánh Tông',NULL,'Phú Yên','057','711@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_711','1','Nhập điện thoại','Nhập email',0),(88,'712','','Trường TH & THCS Lê Quí Đôn',NULL,'Phú Yên','057','712@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_712','1','Nhập điện thoại','Nhập email',0),(89,'713','','Trường THCS & THPT Võ Nguyên Giáp',NULL,'Phú Yên','057','713@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_713','1','Nhập điện thoại','Nhập email',0),(90,'714','','Trường  TH & THCS Chu Văn An',NULL,'Phú Yên','057','714@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_714','1','Nhập điện thoại','Nhập email',0),(91,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(92,'800','','Trường THCS thị trấn Củng Sơn',NULL,'Phú Yên','057','800@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_800','1','Nhập điện thoại','Nhập email',0),(93,'801','','Trường THCS Vừ A Dính',NULL,'Phú Yên','057','801@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_801','1','Nhập điện thoại','Nhập email',0),(94,'802','','Trường THCS Sơn Nguyên',NULL,'Phú Yên','057','802@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_802','1','Nhập điện thoại','Nhập email',0),(95,'803','','Trường THCS Sơn Hà',NULL,'Phú Yên','057','803@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_803','1','Nhập điện thoại','Nhập email',0),(96,'804','','Trường THCS Suối Bạc',NULL,'Phú Yên','057','804@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_804','1','Nhập điện thoại','Nhập email',0),(97,'805','','Trường PTDTBT La Văn Cầu',NULL,'Phú Yên','057','805@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_805','1','Nhập điện thoại','Nhập email',0),(98,'806','','Trường THCS Đinh Núp',NULL,'Phú Yên','057','806@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_806','1','Nhập điện thoại','Nhập email',0),(99,'807','','Trường THCS Kpa Kơ Lơng',NULL,'Phú Yên','057','807@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_807','1','Nhập điện thoại','Nhập email',0),(100,'808','','Trường THCS Krông Pa',NULL,'Phú Yên','057','808@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_808','1','Nhập điện thoại','Nhập email',0),(101,'809','','Trường THCS Suối Trai',NULL,'Phú Yên','057','809@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_809','1','Nhập điện thoại','Nhập email',0),(102,'810','','Trường TH & THCS Sơn Định',NULL,'Phú Yên','057','810@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_810','1','Nhập điện thoại','Nhập email',0),(103,'811','','Trường THCS Phước Tân',NULL,'Phú Yên','057','811@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_811','1','Nhập điện thoại','Nhập email',0),(104,'812','','Trường THCS &THPT Nguyễn Bá Ngọc',NULL,'Phú Yên','057','812@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_812','1','Nhập điện thoại','Nhập email',0),(105,'813','','Trường PTDTNT Sơn Hòa',NULL,'Phú Yên','057','813@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_813','1','Nhập điện thoại','Nhập email',0),(106,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(107,'900','','Trường THCS Trường THCS Lê Lợi',NULL,'Phú Yên','057','900@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_900','1','Nhập điện thoại','Nhập email',0),(108,'901','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','901@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_901','1','Nhập điện thoại','Nhập email',0),(109,'902','','Trường THCS Nguyễn Văn Trỗi',NULL,'Phú Yên','057','902@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_902','1','Nhập điện thoại','Nhập email',0),(110,'903','','Trường THCS Trần Quốc Toản',NULL,'Phú Yên','057','903@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_903','1','Nhập điện thoại','Nhập email',0),(111,'904','','Trường THCS Hùng Vương',NULL,'Phú Yên','057','904@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_904','1','Nhập điện thoại','Nhập email',0),(112,'905','','Trường THCS Ngô Quyền',NULL,'Phú Yên','057','905@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_905','1','Nhập điện thoại','Nhập email',0),(113,'906','','Trường THCS Lương Thế Vinh',NULL,'Phú Yên','057','906@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_906','1','Nhập điện thoại','Nhập email',0),(114,'907','','Trường THCS Lý Tự Trọng',NULL,'Phú Yên','057','907@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_907','1','Nhập điện thoại','Nhập email',0),(115,'908','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','908@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_908','1','Nhập điện thoại','Nhập email',0),(116,'909','','Trường THCS Võ Văn Kiệt',NULL,'Phú Yên','057','909@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_909','1','Nhập điện thoại','Nhập email',0),(117,'910','','Trường THCS Trần Hưng Đạo',NULL,'Phú Yên','057','910@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_910','1','Nhập điện thoại','Nhập email',0),(118,'911','','Trường THCS Nguyễn Thị Định',NULL,'Phú Yên','057','911@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_911','1','Nhập điện thoại','Nhập email',0),(119,'912','','Trường THCS Nguyễn Hữu Thọ',NULL,'Phú Yên','057','912@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_912','1','Nhập điện thoại','Nhập email',0),(120,'913','','Trường THCS Trần Phú',NULL,'Phú Yên','057','913@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_913','1','Nhập điện thoại','Nhập email',0),(121,'914','','Trường THCS Trần Cao Vân',NULL,'Phú Yên','057','914@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_914','1','Nhập điện thoại','Nhập email',0),(122,'915','','Trường Phổ thông Duy Tân (cấp THCS)',NULL,'Phú Yên','057','915@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_915','1','Nhập điện thoại','Nhập email',0),(123,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_999','1','Nhập điện thoại','Nhập email',0),(124,'1100','','Trường THPT Lê Hồng Phong',NULL,'Phú Yên','0573843348','leanpha@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1100','1','Nhập điện thoại','Nhập email',0),(125,'1101','','Trường THPT Nguyễn Thị Minh Khai',NULL,'Phú Yên','0573843349','leanpha@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1101','1','Nhập điện thoại','Nhập email',0),(126,'1102','','Trường THPT Phạm Văn Đồng',NULL,'Phú Yên','0573843350','leanpha@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1102','1','Nhập điện thoại','Nhập email',0),(127,'2200','22','Trường THPT Lê Trung Kiên','Lê Trung Kiên','Phú Yên','0573843351','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2200','1','Nhập điện thoại','Nhập email',0),(128,'2201','','Trường THPT Nguyễn Công Trứ',NULL,'Phú Yên','0573843352','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2201','1','Nhập điện thoại','Nhập email',0),(129,'2202','','Trường THPT Nguyễn Văn Linh',NULL,'Phú Yên','0573843353','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2202','1','Nhập điện thoại','Nhập email',0),(130,'3300','','Trường THPT Nguyễn Du',NULL,'Phú Yên','0573843354','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3300','1','Nhập điện thoại','Nhập email',0),(131,'3301','','Trường THPT Tôn Đức Thắng',NULL,'Phú Yên','0573843355','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3301','1','Nhập điện thoại','Nhập email',0),(132,'3302','','Trường THCS & THPT Võ Văn Kiệt',NULL,'Phú Yên','0573843356','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3302','1','Nhập điện thoại','Nhập email',0),(133,'4400','','Trường THPT Trần Bình Trọng',NULL,'Phú Yên','0573843357','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4400','1','Nhập điện thoại','Nhập email',0),(134,'4401','','Trường THPT Trần Quốc Tuấn',NULL,'Phú Yên','0573843358','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4401','1','Nhập điện thoại','Nhập email',0),(135,'4402','','Trường THPT Trần Suyền',NULL,'Phú Yên','0573843359','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4402','1','Nhập điện thoại','Nhập email',0),(136,'5500','','Trường THPT Lê Thành Phương',NULL,'Phú Yên','0573843360','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5500','1','Nhập điện thoại','Nhập email',0),(137,'5501','','Trường THCS & THPT Nguyễn Viết Xuân',NULL,'Phú Yên','0573843361','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5501','1','Nhập điện thoại','Nhập email',0),(138,'5502','','Trường THPT Trần Phú',NULL,'Phú Yên','0573843362','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5502','1','Nhập điện thoại','Nhập email',0),(139,'5503','','Trường THCS&THPT Võ Thị Sáu',NULL,'Phú Yên','0573843363','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5503','1','Nhập điện thoại','Nhập email',0),(140,'6600','','Trường THCS & THPT Chu Văn An',NULL,'Phú Yên','0573843364','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6600','1','Nhập điện thoại','Nhập email',0),(141,'6601','','Trường THPT Lê Lợi',NULL,'Phú Yên','0573843365','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6601','1','Nhập điện thoại','Nhập email',0),(142,'6602','','Trường THPT Nguyễn Thái Bình',NULL,'Phú Yên','0573843366','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6602','1','Nhập điện thoại','Nhập email',0),(143,'7700','','Trường THPT Phan Chu Trinh',NULL,'Phú Yên','0573843367','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7700','1','Nhập điện thoại','Nhập email',0),(144,'7701','','Trường THPT Phan Đình Phùng',NULL,'Phú Yên','0573843368','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7701','1','Nhập điện thoại','Nhập email',0),(145,'7702','','Trường THCS & THPT Võ Nguyên Giáp',NULL,'Phú Yên','0573843369','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7702','1','Nhập điện thoại','Nhập email',0),(146,'7703','','Trường THCS & THPT  Nguyễn Khuyến',NULL,'Phú Yên','0573843370','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7703','1','Nhập điện thoại','Nhập email',0),(147,'8800','','Trường THCS & THPT Nguyễn Bá Ngọc',NULL,'Phú Yên','0573843371','leanpha@phuyen.edu.vn','Lê An Pha','88',3,'cap3_8800','1','Nhập điện thoại','Nhập email',0),(148,'8801','','Trường THPT Phan Bội Châu',NULL,'Phú Yên','0573843372','leanpha@phuyen.edu.vn','Lê An Pha','88',3,'cap3_8801','1','Nhập điện thoại','Nhập email',0),(149,'9900','','Trường THPT chuyên Lương Văn Chánh',NULL,'Phú Yên','0573843373','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9900','1','Nhập điện thoại','Nhập email',1),(150,'9901','','Trường PTDTNT Tỉnh',NULL,'Phú Yên','0573843374','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9901','1','Nhập điện thoại','Nhập email',1),(151,'9902','','Trường THPT Ngô Gia Tự',NULL,'Phú Yên','0573843375','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9902','1','Nhập điện thoại','Nhập email',0),(152,'9903','','Trường THPT Nguyễn Huệ',NULL,'Phú Yên','0573843376','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9903','1','Nhập điện thoại','Nhập email',0),(153,'9904','','Trường THPT Nguyễn Trãi',NULL,'Phú Yên','0573843377','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9904','1','Nhập điện thoại','Nhập email',0),(154,'9905','','Trường THPT Nguyễn Trường Tộ',NULL,'Phú Yên','0573843378','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9905','1','Nhập điện thoại','Nhập email',0),(155,'9906','','Trường Phổ thông Duy Tân (cấp THPT)',NULL,'Phú Yên','0573843379','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9906','1','Nhập điện thoại','Nhập email',0),(156,'9907','','Trường THPT Nguyễn Bỉnh Khiêm',NULL,'Phú Yên','0573843380','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9907','1','Nhập điện thoại','Nhập email',0);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL),(2,4,'192.168.1.8',0,0,0,NULL,NULL,NULL),(3,4,'127.0.0.1',0,0,0,NULL,NULL,NULL),(4,6,'127.0.0.1',0,0,0,NULL,NULL,NULL),(5,7,'127.0.0.1',0,0,0,NULL,NULL,NULL),(6,13,'127.0.0.1',0,0,0,NULL,NULL,NULL),(7,14,'127.0.0.1',0,0,0,NULL,NULL,NULL),(8,18,'127.0.0.1',0,0,0,NULL,NULL,NULL),(9,31,'127.0.0.1',0,0,0,NULL,NULL,NULL),(10,53,'127.0.0.1',0,0,0,NULL,NULL,NULL),(11,84,'127.0.0.1',0,0,0,NULL,NULL,NULL),(12,85,'127.0.0.1',0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_categoy`
--

DROP TABLE IF EXISTS `user_categoy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_categoy` (
  `user_categoy_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_categoy_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `uc_updated_at` int(11) DEFAULT NULL,
  `uc_created_at` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`user_categoy_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_categoy`
--

LOCK TABLES `user_categoy` WRITE;
/*!40000 ALTER TABLE `user_categoy` DISABLE KEYS */;
INSERT INTO `user_categoy` VALUES (1,'AAAAAAA',NULL,NULL,NULL,NULL),(2,'BBBBBBBBB',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_categoy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profile_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(81,82,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(80,81,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(79,80,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(78,79,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(77,78,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(76,77,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(75,76,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(74,75,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(73,74,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(72,73,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(71,72,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(70,71,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(69,70,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(68,69,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(67,68,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(66,67,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(65,66,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(64,65,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(63,64,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(62,63,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(61,62,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(60,61,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(59,60,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(58,59,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(57,58,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(56,57,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(55,56,NULL,NULL,'HỒ THỊ NGỌC','ÁNH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(54,55,NULL,NULL,'NGUYỄN THỊ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(53,54,NULL,NULL,'NGÔ VÂN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(52,53,NULL,NULL,'MAI THỊ HỒNG','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(82,83,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-19 03:05:53','2017-05-19 03:05:53'),(83,84,NULL,NULL,'Nhập  họ và tên liện hệ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-19 10:50:34','2017-05-19 10:50:34'),(84,85,NULL,NULL,'Lê An Pha',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-20 05:38:16','2017-05-20 05:38:16');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `user_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@admin.com','admin','$2y$10$/Fs8Eq4psGkY4NVAspwirOAcb16E746U.BJq9KReOEiXmCTKoePx.',NULL,1,0,NULL,NULL,'2017-05-20 08:24:42','$2y$10$l0ULxSd8bR2BFQKuNOvyNeAXNfsEzI5xyzZdmMez9L8G8SupmTXHK',NULL,0,1,'2017-04-23 00:58:57','2017-05-20 08:24:42'),(82,'3080030@phuyen.edu.vn','3080030','$2y$10$3HR5uqQgJKXrBc3ThudDHul7fdGiWhfwQuK1xIFUaL1IQIvZi/zlO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(81,'3080029@phuyen.edu.vn','3080029','$2y$10$MTOCFH6mzCkmb3fUkJDFQ.TWqaxiPiAzY/nwHVPzwFtkXyj.oSs8K','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(80,'3080028@phuyen.edu.vn','3080028','$2y$10$EoNRNFfeDsfAAh1cClGpmuJLz.YMIPwLF.mZtsKHswgT0A.rdM116','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(79,'3080027@phuyen.edu.vn','3080027','$2y$10$v5TY/CMyLacjBi6umvMSEOp8QLOVrj2ZbAAD6DX5es474M3vEG8mq','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(78,'3080026@phuyen.edu.vn','3080026','$2y$10$4QgCUn3h6o1yfFucOzXn6eDCBoMz4w2gbeW1bP2FlfE/PxaSqT.Nq','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(77,'3080025@phuyen.edu.vn','3080025','$2y$10$j2GpvsQijCD/p7QS15Y99u1LUuwaez6ewfLh/ojdrlin6Ce1E2rlO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(76,'3080024@phuyen.edu.vn','3080024','$2y$10$qSVpOtLNRw53n7AgVTJBVuVhr49Hu2ExJYor5lhLAkGssCIKAruuK','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(75,'3080020@phuyen.edu.vn','3080020','$2y$10$uIs9cDnwCghqd/FO1GERS.Vqx7sYC/AQm87QkZmMY3VL4iHlmAXUG','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(74,'3080023@phuyen.edu.vn','3080023','$2y$10$MWwkh5cV50DmoIkNUj1zCOS9gpz.vvlNKyY9gccFXmmfagyY9mSEO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(72,'3080022@phuyen.edu.vn','3080022','$2y$10$baYQ.EJWBRn59Pikrvt0Tuov/7Wf2zBVofqjGaadTuTxIy.d66Ufm','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(73,'3080019@phuyen.edu.vn','3080019','$2y$10$JshjZ2RKAOR78dM1EMtkLe.X91fNP4A/qbp1yp8.6JGtV5J5xmgNq','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:47','2017-05-18 10:38:47'),(71,'3080018@phuyen.edu.vn','3080018','$2y$10$8L82bSzR2ABBx6gZp.dzE.PXpY5zOZbtU6mbV1KqpIMMmcWmhxYMa','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(70,'3080021@phuyen.edu.vn','3080021','$2y$10$x.BULPRlDz5esynH..KVn.rlBzT/yYT18vz9FV5pyJJL8aGZKZpmO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(69,'3080017@phuyen.edu.vn','3080017','$2y$10$rDhojLCttaUFqhYvkF3GROdtdSzx/UI74Yhg8GGIPxF86zTRDUHZW','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(68,'3080016@phuyen.edu.vn','3080016','$2y$10$/CM6WCQJDbtbyrjBriUNfOVKLg8NCe63iNiRwAk45FNJdCfE2fRAi','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(67,'3080015@phuyen.edu.vn','3080015','$2y$10$x91BHQNgiQJ9GzJFBv3FA.PUbL5rEPwy55IJmTk3siRHa0hL1Znsa','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(66,'3080014@phuyen.edu.vn','3080014','$2y$10$LprJoD9BkJlXtymESQEr7.cALQv.W6EWlBUwRRFTkn5CYQKRcqBF.','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(65,'3080013@phuyen.edu.vn','3080013','$2y$10$.wbUd/z8mSE3xuwRYkVaLOBrABRfmqBgbh8v/7JrPg1z/Q3UJ2wy.','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(64,'3080012@phuyen.edu.vn','3080012','$2y$10$1UY125xaNwovF.c61/Tspe7ScYEiKAJq3AFMW2KCW2Tlqx5ESgTFe','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(63,'3080011@phuyen.edu.vn','3080011','$2y$10$YhV9YMtS4EGgaRDditNsMu/AjiPeion9HHDEFe29EXJ95wJIzQtK6','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:46','2017-05-18 10:38:46'),(62,'3080010@phuyen.edu.vn','3080010','$2y$10$faTLzNClMMjJnR.CnNMmM.PzgMzsKYIoY9wDsQytVy5qdUJJIQp5.','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(61,'3080009@phuyen.edu.vn','3080009','$2y$10$12m6nGL5Gx75Aq1H4S5OPORhw29GS74ZeXhckFMFwn8aH96Q4vq0W','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(60,'3080008@phuyen.edu.vn','3080008','$2y$10$kV6xHJbQajISaGsHm/dLReqqD6jQKQ7us1EFeysGRztYrBwWcuSeq','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(59,'3080007@phuyen.edu.vn','3080007','$2y$10$XHBIV//8dw3QxUBNXwze6.aPeiTqHtY3b2nC.oB9NS0JtO9rH6sri','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(58,'3080006@phuyen.edu.vn','3080006','$2y$10$VhTUCEZ.VMgp65gYvZBmnehJnGdyXF3WLLVHmiM/Df1t/2nehaWDi','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(57,'3080005@phuyen.edu.vn','3080005','$2y$10$p38u3m8vFvdKN2/vE3sAAu8Qmcx27A3/vWjbWvPMkOX/vgL/9hcGu','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(56,'3080004@phuyen.edu.vn','3080004','$2y$10$5wOIIFZRu3mq9/CHW3Wvle71DkEeRYvY2Ryy0nNr5NEtyNmT.i2rq','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(55,'3080003@phuyen.edu.vn','3080003','$2y$10$pICG2DoVoyHTuLB73Km8yu8mVg3VUqFc36ZslqNbdVMsUBm6G8bRC','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(54,'3080002@phuyen.edu.vn','3080002','$2y$10$EDGfkB3P2LS4AufYtPZXouzWZW5zKviyHkvdwIq0kgaoyAzBQgdyS','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 10:38:43','2017-05-18 10:38:43'),(53,'3080001@phuyen.edu.vn','3080001','$2y$10$42mkviM.bL9/Dlq6sJkmMu1n9EyVqMiEPVLpbwvGwuuLkC1SPbRd6','{\"_student\":1}',1,0,NULL,NULL,'2017-05-19 17:40:24','$2y$10$4giaEGTby9f/qg.Q7ZfmJu1JN3qQ1kL5q4R0yd/kgA.4E0dvuwUdK',NULL,0,NULL,'2017-05-18 10:38:43','2017-05-19 17:40:24'),(83,'1','2','$2y$10$Vvw8A5OXZTu2GJyfAIKGe.L8ZLaDHnUvIl3.hQfHtf.ggaou9uqsW','{\"_mod-2\":1,\"_my-pexcel\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-19 03:05:53','2017-05-19 03:05:53'),(84,'thcs402@phuyen.edu.vn','cap2_402','$2y$10$Bg99jnYcGcd07jMKOlI11uiKdTmT4eot0TFc76rvIScmSg58knR6i','{\"_mod-2\":1,\"_my-pexcel\":1}',1,0,NULL,NULL,'2017-05-20 08:25:39','$2y$10$ajl/ZO4Lpq1udUzkDtcCrOq5YGNjrbgkcCoeEuOSMGuXkBMMoUXlq',NULL,0,NULL,'2017-05-19 10:50:34','2017-05-20 08:59:08'),(85,'leanpha@phuyen.edu.vn','cap3_2200','$2y$10$mVS1qoGbRX.41F5Eu8GT6udIv1WVYGoLnA5E4/eBU8HXHhXK8F.nm','{\"_mod-3\":1}',1,0,NULL,NULL,'2017-05-20 05:41:10','$2y$10$KUZTNL.ZcE/m2UMDZIQ3sOeTzWzuPG3/XOm314vtxAj3Pf.CB6cwO',NULL,0,NULL,'2017-05-20 05:38:16','2017-05-20 05:41:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1),(4,4),(7,4);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-20 16:07:00
