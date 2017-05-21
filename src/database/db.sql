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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pexcel`
--

LOCK TABLES `pexcel` WRITE;
/*!40000 ALTER TABLE `pexcel` DISABLE KEYS */;
INSERT INTO `pexcel` VALUES (4,4,1,9,21,'[{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"xx\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"bb\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"MAI TH\\u1eca H\\u1ed2NG\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"2\",\"student_birth_month\":\"10\",\"student_birth_year\":2001,\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":\"2.5\",\"student_score_prior_comment\":\"cc\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"12\",\"student_birth_month\":\"11\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"K\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3301\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca V\\u00c2N\",\"student_last_name\":\"ANH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"7\",\"student_birth_month\":\"12\",\"student_birth_year\":\"2000\",\"student_birth_place\":\"Th\\u00e1i B\\u00ecnh\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"9906\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":4,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"H\\u1ed2 TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"\\u00c1NH\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"30\",\"student_birth_month\":\"9\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy h\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":308,\"school_district_code\":\"33\",\"student_class\":\"9A\",\"student_capacity_6\":\"TB\",\"student_conduct_6\":\"TB\",\"student_capacity_7\":\"TB\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"TB\",\"student_conduct_8\":\"K\",\"student_capacity_9\":\"TB\",\"student_conduct_9\":\"K\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"TB\",\"student_score_prior\":null,\"student_score_prior_comment\":null,\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"3300\",\"school_code_option_2\":\"3302\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"}]','asdfasdfasdf','<p>asdfasdfasdf</p>','/files/1/test.xlsx',11,1495103213,1495126121),(10,4,149,11,20,'[{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"TR\\u1ea6N TU\\u1ea4N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"05\",\"student_birth_month\":\"06\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":3,\"student_score_prior_comment\":\"KK3,KK3\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"D\\u01af\\u01a0NG T\\u00d9NG\",\"student_last_name\":\"B\\u00c1CH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"18\",\"student_birth_month\":\"05\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"\\u0110\\u1ed3ng Xu\\u00e2n, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"PH\\u1ea0M XU\\u00c2N\",\"student_last_name\":\"B\\u00c1CH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"20\",\"student_birth_month\":\"05\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"DI\\u1ec6P \\u0110\\u1ea0I\",\"student_last_name\":\"B\\u1ea2N\",\"student_sex\":\"Nam\",\"student_birth_day\":\"08\",\"student_birth_month\":\"08\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"K\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"V\\u00d5 HO\\u00c0NG DUY\",\"student_last_name\":\"B\\u1ea2O\",\"student_sex\":\"Nam\",\"student_birth_day\":\"01\",\"student_birth_month\":\"01\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9B\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0893668212\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"B\\u1ed8I\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"24\",\"student_birth_month\":\"03\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9C\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"KK3,KK4\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0883779789\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"\\u0110\\u1eb6NG HU\\u1ef2NH B\\u1ea2O\",\"student_last_name\":\"CH\\u00c2U\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"14\",\"student_birth_month\":\"08\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9D\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"G\",\"student_score_prior\":3.5,\"student_score_prior_comment\":\"KK3,KK2\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 \\u0110AN\",\"student_last_name\":\"CHI\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"01\",\"student_birth_month\":\"02\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"\\u0110\\u00f4ng H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"UT3,KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090910\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"PH\\u1ea0M MINH\",\"student_last_name\":\"CHI\\u1ebeN\",\"student_sex\":\"Nam\",\"student_birth_day\":\"24\",\"student_birth_month\":\"04\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"G\",\"student_score_prior\":4,\"student_score_prior_comment\":\"KK3,KK1\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"NGUVAN\",\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0873891366\"},{\"pexcel_id\":10,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"V\\u00d5 TH\\u1eca THU\",\"student_last_name\":\"D\\u00c2N\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"29\",\"student_birth_month\":\"09\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy An, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"UT3,KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0864002943\"}]','Ư','<p>Ư</p>','/files/149/59215ebb64632.xls',33,1495359440,1495359440),(13,4,170,11,22,'[{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"TR\\u1ea6N TU\\u1ea4N\",\"student_last_name\":\"ANH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"05\",\"student_birth_month\":\"06\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":3,\"student_score_prior_comment\":\"KK3,KK3\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0913445058\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"D\\u01af\\u01a0NG T\\u00d9NG\",\"student_last_name\":\"B\\u00c1CH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"18\",\"student_birth_month\":\"05\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"\\u0110\\u1ed3ng Xu\\u00e2n, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":\"9901\",\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0903556635\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"PH\\u1ea0M XU\\u00c2N\",\"student_last_name\":\"B\\u00c1CH\",\"student_sex\":\"Nam\",\"student_birth_day\":\"20\",\"student_birth_month\":\"05\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"DI\\u1ec6P \\u0110\\u1ea0I\",\"student_last_name\":\"B\\u1ea2N\",\"student_sex\":\"Nam\",\"student_birth_day\":\"08\",\"student_birth_month\":\"08\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"K\",\"student_capacity_8\":\"K\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"K\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":\"1\",\"school_code_option\":\"9900\",\"school_class_code\":\"TOANTIN\",\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090909\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"V\\u00d5 HO\\u00c0NG DUY\",\"student_last_name\":\"B\\u1ea2O\",\"student_sex\":\"Nam\",\"student_birth_day\":\"01\",\"student_birth_month\":\"01\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9B\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0893668212\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N TH\\u1eca NG\\u1eccC\",\"student_last_name\":\"B\\u1ed8I\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"24\",\"student_birth_month\":\"03\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9C\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"KK3,KK4\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0883779789\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"\\u0110\\u1eb6NG HU\\u1ef2NH B\\u1ea2O\",\"student_last_name\":\"CH\\u00c2U\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"14\",\"student_birth_month\":\"08\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9D\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"7.5\",\"student_average_1\":\"7.6\",\"student_average_2\":\"8.0\",\"student_graduate\":\"G\",\"student_score_prior\":3.5,\"student_score_prior_comment\":\"KK3,KK2\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NG\\u00d4 \\u0110AN\",\"student_last_name\":\"CHI\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"01\",\"student_birth_month\":\"02\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"\\u0110\\u00f4ng H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"5.6\",\"student_average_1\":\"6.5\",\"student_average_2\":\"7.3\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"UT3,KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090910\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"PH\\u1ea0M MINH\",\"student_last_name\":\"CHI\\u1ebeN\",\"student_sex\":\"Nam\",\"student_birth_day\":\"24\",\"student_birth_month\":\"04\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"6.0\",\"student_average_1\":\"6.0\",\"student_average_2\":\"5.9\",\"student_graduate\":\"G\",\"student_score_prior\":4,\"student_score_prior_comment\":\"KK3,KK1\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"NGUVAN\",\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"mthanh@gmail.com\",\"student_phone\":\"0873891366\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"V\\u00d5 TH\\u1eca THU\",\"student_last_name\":\"D\\u00c2N\",\"student_sex\":\"N\\u1eef\",\"student_birth_day\":\"29\",\"student_birth_month\":\"09\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy An, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":2.5,\"student_score_prior_comment\":\"UT3,KK3\",\"student_nominate\":null,\"school_code_option\":null,\"school_class_code\":null,\"school_code_option_1\":\"1100\",\"school_code_option_2\":\"1101\",\"student_email\":\"nvanh@gmail.com\",\"student_phone\":\"0864002943\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"TR\\u1ea6N TH\\u1ebe\",\"student_last_name\":\"D\\u01af\\u01a0NG\",\"student_sex\":\"Nam\",\"student_birth_day\":\"28\",\"student_birth_month\":\"07\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9A\",\"student_capacity_6\":\"K\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"K\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"K\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"K\",\"student_score_prior\":1,\"student_score_prior_comment\":\"KK4\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"HOAHOC\",\"school_code_option_1\":\"1101\",\"school_code_option_2\":\"1102\",\"student_email\":\"vananh@gmail.com\",\"student_phone\":\"0914188188\'\"},{\"pexcel_id\":13,\"category_name\":\"2017 - 2018\",\"student_first_name\":\"NGUY\\u1ec4N \\u0110\\u00d4NG\",\"student_last_name\":\"D\\u01af\\u01a0NG\",\"student_sex\":\"Nam\",\"student_birth_day\":\"29\",\"student_birth_month\":\"06\",\"student_birth_year\":\"2001\",\"student_birth_place\":\"Tuy H\\u00f2a, Ph\\u00fa Y\\u00ean\",\"school_code\":402,\"school_district_code\":\"44\",\"student_class\":\"9B\",\"student_capacity_6\":\"G\",\"student_conduct_6\":\"T\",\"student_capacity_7\":\"G\",\"student_conduct_7\":\"T\",\"student_capacity_8\":\"G\",\"student_conduct_8\":\"T\",\"student_capacity_9\":\"G\",\"student_conduct_9\":\"T\",\"student_average\":\"8.5\",\"student_average_1\":\"8.3\",\"student_average_2\":\"8.5\",\"student_graduate\":\"G\",\"student_score_prior\":1.5,\"student_score_prior_comment\":\"KK3\",\"student_nominate\":null,\"school_code_option\":\"9900\",\"school_class_code\":\"TOAN\",\"school_code_option_1\":\"1102\",\"school_code_option_2\":null,\"student_email\":\"anh@yahoo.com\",\"student_phone\":\"0909090911\"}]','Ư','<p>Ư</p>','/files/170/592160775919c.xls',33,1495360576,1495360576);
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
  `student_point_sum` double DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_students`
--

LOCK TABLES `school_students` WRITE;
/*!40000 ALTER TABLE `school_students` DISABLE KEYS */;
INSERT INTO `school_students` VALUES (23,NULL,NULL,NULL,'TRẦN TUẤN','ANH','Nam',991674000,'05','06','2001','Tuy Hòa, Phú Yên',402,44,'9A','Y','Y',NULL,'Y','Y',NULL,'Y','Y',NULL,'Y','Y',NULL,8.5,8.3,8.5,'G',3,'KK3,KK3',0,0,'9900','TOAN','1100','1101','mthanh@gmail.com','01236907788','4020023','4020023','2017 - 2018',13),(2,NULL,NULL,NULL,'DƯƠNG TÙNG','BÁCH','Nam',990118800,'18','05','2001','Đồng Xuân, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',1.5,'KK3',0,NULL,'9901',NULL,'1101','1102','nvanh@gmail.com','0903556635','4020002','4020002','2017 - 2018',11),(3,NULL,NULL,NULL,'PHẠM XUÂN','BÁCH','Nam',990291600,'20','05','2001','Tuy Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',1.5,'KK3',0,NULL,NULL,NULL,'1102',NULL,'vananh@gmail.com','0914188188\'','4020003','4020003','2017 - 2018',11),(4,NULL,NULL,NULL,'DIỆP ĐẠI','BẢN','Nam',997203600,'08','08','2001','Tuy Hòa, Phú Yên',402,44,'9A','K','T',NULL,'K','K',NULL,'K','T',NULL,'K','T',NULL,6,6,5.9,'K',1.5,'KK3',0,1,'9900','TOANTIN','1100','1101','anh@yahoo.com','0909090909','4020004','4020004','2017 - 2018',11),(5,NULL,NULL,NULL,'VÕ HOÀNG DUY','BẢO','Nam',978282000,'01','01','2001','Tuy Hòa, Phú Yên',402,44,'9B','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',1.5,'KK3',0,NULL,NULL,NULL,'1101','1102','mthanh@gmail.com','0893668212','4020005','4020005','2017 - 2018',11),(6,NULL,NULL,NULL,'NGUYỄN THỊ NGỌC','BỘI','Nữ',985366800,'24','03','2001','Tuy Hòa, Phú Yên',402,44,'9C','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'KK3,KK4',0,NULL,NULL,NULL,'1102',NULL,'nvanh@gmail.com','0883779789','4020006','4020006','2017 - 2018',11),(7,NULL,NULL,NULL,'ĐẶNG HUỲNH BẢO','CHÂU','Nữ',997722000,'14','08','2001','Tuy Hòa, Phú Yên',402,44,'9D','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',3.5,'KK3,KK2',0,NULL,NULL,NULL,'1100','1101','vananh@gmail.com','0914188188\'','4020007','4020007','2017 - 2018',11),(8,NULL,NULL,NULL,'NGÔ ĐAN','CHI','Nữ',980960400,'01','02','2001','Đông Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1101','1102','anh@yahoo.com','0909090910','4020008','4020008','2017 - 2018',11),(9,NULL,NULL,NULL,'PHẠM MINH','CHIẾN','Nam',988045200,'24','04','2001','Tuy Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,6,6,5.9,'G',4,'KK3,KK1',0,NULL,'9900','NGUVAN','1102',NULL,'mthanh@gmail.com','0873891366','4020009','4020009','2017 - 2018',11),(10,NULL,NULL,NULL,'VÕ THỊ THU','DÂN','Nữ',1001696400,'29','09','2001','Tuy An, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1100','1101','nvanh@gmail.com','0864002943','4020010','4020010','2017 - 2018',11),(11,NULL,NULL,NULL,'TRẦN TUẤN','ANH','Nam',991674000,'05','06','2001','Tuy Hòa, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',3,'KK3,KK3',0,NULL,'9900','TOAN','1100','1101','mthanh@gmail.com','0913445058','1000011','1000011','2017 - 2018',12),(12,NULL,NULL,NULL,'DƯƠNG TÙNG','BÁCH','Nam',990118800,'18','05','2001','Đồng Xuân, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',1.5,'KK3',0,NULL,'9901',NULL,'1101','1102','nvanh@gmail.com','0903556635','1000012','1000012','2017 - 2018',12),(13,NULL,NULL,NULL,'PHẠM XUÂN','BÁCH','Nam',990291600,'20','05','2001','Tuy Hòa, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',1.5,'KK3',0,NULL,NULL,NULL,'1102',NULL,'vananh@gmail.com','0914188188\'','1000013','1000013','2017 - 2018',12),(14,NULL,NULL,NULL,'DIỆP ĐẠI','BẢN','Nam',997203600,'08','08','2001','Tuy Hòa, Phú Yên',100,11,'9A','K','T',NULL,'K','K',NULL,'K','T',NULL,'K','T',NULL,6,6,5.9,'K',1.5,'KK3',0,1,'9900','TOANTIN','1100','1101','anh@yahoo.com','0909090909','1000014','1000014','2017 - 2018',12),(15,NULL,NULL,NULL,'VÕ HOÀNG DUY','BẢO','Nam',978282000,'01','01','2001','Tuy Hòa, Phú Yên',100,11,'9B','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',1.5,'KK3',0,NULL,NULL,NULL,'1101','1102','mthanh@gmail.com','0893668212','1000015','1000015','2017 - 2018',12),(16,NULL,NULL,NULL,'NGUYỄN THỊ NGỌC','BỘI','Nữ',985366800,'24','03','2001','Tuy Hòa, Phú Yên',100,11,'9C','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'KK3,KK4',0,NULL,NULL,NULL,'1102',NULL,'nvanh@gmail.com','0883779789','1000016','1000016','2017 - 2018',12),(17,NULL,NULL,NULL,'ĐẶNG HUỲNH BẢO','CHÂU','Nữ',997722000,'14','08','2001','Tuy Hòa, Phú Yên',100,11,'9D','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',3.5,'KK3,KK2',0,NULL,NULL,NULL,'1100','1101','vananh@gmail.com','0914188188\'','1000017','1000017','2017 - 2018',12),(18,NULL,NULL,NULL,'NGÔ ĐAN','CHI','Nữ',980960400,'01','02','2001','Đông Hòa, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1101','1102','anh@yahoo.com','0909090910','1000018','1000018','2017 - 2018',12),(19,NULL,NULL,NULL,'PHẠM MINH','CHIẾN','Nam',988045200,'24','04','2001','Tuy Hòa, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,6,6,5.9,'G',4,'KK3,KK1',0,NULL,'9900','NGUVAN','1102',NULL,'mthanh@gmail.com','0873891366','1000019','1000019','2017 - 2018',12),(20,NULL,NULL,NULL,'VÕ THỊ THU','DÂN','Nữ',1001696400,'29','09','2001','Tuy An, Phú Yên',100,11,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1100','1101','nvanh@gmail.com','0864002943','1000020','1000020','2017 - 2018',12),(21,NULL,NULL,NULL,'TRẦN THẾ','DƯƠNG','Nam',996253200,'28','07','2001','Tuy Hòa, Phú Yên',100,11,'9A','K','T',NULL,'K','T',NULL,'G','T',NULL,'K','T',NULL,8.5,8.3,8.5,'K',1,'KK4',0,NULL,'9900','HOAHOC','1101','1102','vananh@gmail.com','0914188188\'','1000021','1000021','2017 - 2018',12),(22,NULL,NULL,NULL,'NGUYỄN ĐÔNG','DƯƠNG','Nam',993747600,'29','06','2001','Tuy Hòa, Phú Yên',100,11,'9B','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',1.5,'KK3',0,NULL,'9900','TOAN','1102',NULL,'anh@yahoo.com','0909090911','1000022','1000022','2017 - 2018',12),(24,NULL,NULL,NULL,'DƯƠNG TÙNG','BÁCH','Nam',990118800,'18','05','2001','Đồng Xuân, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',1.5,'KK3',0,NULL,'9901',NULL,'1101','1102','nvanh@gmail.com','0903556635','4020024','4020024','2017 - 2018',13),(25,NULL,NULL,NULL,'PHẠM XUÂN','BÁCH','Nam',990291600,'20','05','2001','Tuy Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',1.5,'KK3',0,NULL,NULL,NULL,'1102',NULL,'vananh@gmail.com','0914188188\'','4020025','4020025','2017 - 2018',13),(26,NULL,NULL,NULL,'DIỆP ĐẠI','BẢN','Nam',997203600,'08','08','2001','Tuy Hòa, Phú Yên',402,44,'9A','K','T',NULL,'K','K',NULL,'K','T',NULL,'K','T',NULL,6,6,5.9,'K',1.5,'KK3',0,1,'9900','TOANTIN','1100','1101','anh@yahoo.com','0909090909','4020026','4020026','2017 - 2018',13),(27,NULL,NULL,NULL,'VÕ HOÀNG DUY','BẢO','Nam',978282000,'01','01','2001','Tuy Hòa, Phú Yên',402,44,'9B','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',1.5,'KK3',0,NULL,NULL,NULL,'1101','1102','mthanh@gmail.com','0893668212','4020027','4020027','2017 - 2018',13),(28,NULL,NULL,NULL,'NGUYỄN THỊ NGỌC','BỘI','Nữ',985366800,'24','03','2001','Tuy Hòa, Phú Yên',402,44,'9C','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'KK3,KK4',0,NULL,NULL,NULL,'1102',NULL,'nvanh@gmail.com','0883779789','4020028','4020028','2017 - 2018',13),(29,NULL,NULL,NULL,'ĐẶNG HUỲNH BẢO','CHÂU','Nữ',997722000,'14','08','2001','Tuy Hòa, Phú Yên',402,44,'9D','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,7.5,7.6,8,'G',3.5,'KK3,KK2',0,NULL,NULL,NULL,'1100','1101','vananh@gmail.com','0914188188\'','4020029','4020029','2017 - 2018',13),(30,NULL,NULL,NULL,'NGÔ ĐAN','CHI','Nữ',980960400,'01','02','2001','Đông Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,5.6,6.5,7.3,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1101','1102','anh@yahoo.com','0909090910','4020030','4020030','2017 - 2018',13),(31,NULL,NULL,NULL,'PHẠM MINH','CHIẾN','Nam',988045200,'24','04','2001','Tuy Hòa, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,6,6,5.9,'G',4,'KK3,KK1',0,NULL,'9900','NGUVAN','1102',NULL,'mthanh@gmail.com','0873891366','4020031','4020031','2017 - 2018',13),(32,NULL,NULL,NULL,'VÕ THỊ THU','DÂN','Nữ',1001696400,'29','09','2001','Tuy An, Phú Yên',402,44,'9A','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'UT3,KK3',0,NULL,NULL,NULL,'1100','1101','nvanh@gmail.com','0864002943','4020032','4020032','2017 - 2018',13),(33,NULL,NULL,NULL,'TRẦN THẾ','DƯƠNG','Nam',996253200,'28','07','2001','Tuy Hòa, Phú Yên',402,44,'9A','K','T',NULL,'K','T',NULL,'G','T',NULL,'K','T',NULL,8.5,8.3,8.5,'K',1,'KK4',0,NULL,'9900','HOAHOC','1101','1102','vananh@gmail.com','0914188188\'','4020033','4020033','2017 - 2018',13),(34,NULL,NULL,NULL,'NGUYỄN ĐÔNG','DƯƠNG','Nam',993747600,'29','06','2001','Tuy Hòa, Phú Yên',402,44,'9B','G','T',NULL,'G','T',NULL,'G','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',1.5,'KK3',0,NULL,'9900','TOAN','1102',NULL,'anh@yahoo.com','0909090911','4020034','4020034','2017 - 2018',13);
/*!40000 ALTER TABLE `school_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_tests`
--

DROP TABLE IF EXISTS `school_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_tests` (
  `school_test_id` int(11) NOT NULL,
  `school_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_test_name_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_test_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_district_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `school_test_level_id` int(11) DEFAULT '2',
  `school_test_contact_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_test_contact_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_tests`
--

LOCK TABLES `school_tests` WRITE;
/*!40000 ALTER TABLE `school_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `school_tests` ENABLE KEYS */;
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
  `school_number_room` int(11) NOT NULL DEFAULT '24',
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'100','55','Trường THCS Đồng Khởi',NULL,'Phú Yên','057','100@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_100','1','Nhập điện thoại','Nhập email',0,24),(2,'101','44','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','101@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_101','1','Nhập điện thoại','Nhập email',0,24),(3,'102','','Trường THCS Huỳnh Thúc Kháng',NULL,'Phú Yên','057','102@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_102','1','Nhập điện thoại','Nhập email',0,24),(4,'103','','Trường THCS Lê Hoàn',NULL,'Phú Yên','057','103@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_103','1','Nhập điện thoại','Nhập email',0,24),(5,'104','','Trường THCS Nguyễn Anh Hào',NULL,'Phú Yên','057','104@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_104','1','Nhập điện thoại','Nhập email',0,24),(6,'105','','Trường THCS Nguyễn Tất Thành',NULL,'Phú Yên','057','105@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_105','1','Nhập điện thoại','Nhập email',0,24),(7,'106','','Trường THCS Nguyễn Thị Định',NULL,'Phú Yên','057','106@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_106','1','Nhập điện thoại','Nhập email',0,24),(8,'107','','Trường THCS Phạm Đình Quy',NULL,'Phú Yên','057','107@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_107','1','Nhập điện thoại','Nhập email',0,24),(9,'108','','Trường THCS Phạm Văn Đồng',NULL,'Phú Yên','057','108@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_108','1','Nhập điện thoại','Nhập email',0,24),(10,'109','','Trường THCS Tây Sơn',NULL,'Phú Yên','057','109@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_109','1','Nhập điện thoại','Nhập email',0,24),(11,'110','','Trường THCS Lê Lợi',NULL,'Phú Yên','057','110@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_110','1','Nhập điện thoại','Nhập email',0,24),(12,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','11',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(13,'200','','Trường THCS Tôn Đức Thắng',NULL,'Phú Yên','057','200@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_200','1','Nhập điện thoại','Nhập email',0,24),(14,'201','','Trường THCS Trần Hưng Đạo',NULL,'Phú Yên','057','201@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_201','1','Nhập điện thoại','Nhập email',0,24),(15,'202','','Trường THCS Hoàng Hoa Thám',NULL,'Phú Yên','057','202@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_202','1','Nhập điện thoại','Nhập email',0,24),(16,'203','','Trường THCS Quang Trung',NULL,'Phú Yên','057','203@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_203','1','Nhập điện thoại','Nhập email',0,24),(17,'204','','Trường THCS Nguyễn Chí Thanh',NULL,'Phú Yên','057','204@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_204','1','Nhập điện thoại','Nhập email',0,24),(18,'205','','Trường THCS Trần Nhân Tông',NULL,'Phú Yên','057','205@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_205','1','Nhập điện thoại','Nhập email',0,24),(19,'206','','Trường THCS Trần Kiệt',NULL,'Phú Yên','057','206@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_206','1','Nhập điện thoại','Nhập email',0,24),(20,'207','','Trường THCS Lương Tấn Thịnh',NULL,'Phú Yên','057','207@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_207','1','Nhập điện thoại','Nhập email',0,24),(21,'208','','Trường THCS Trường Chinh',NULL,'Phú Yên','057','208@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_208','1','Nhập điện thoại','Nhập email',0,24),(22,'209','','Trường THCS Lê Thánh Tôn',NULL,'Phú Yên','057','209@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_209','1','Nhập điện thoại','Nhập email',0,24),(23,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','22',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(24,'300','','Trường THCS Sông Hinh',NULL,'Phú Yên','057','300@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_300','1','Nhập điện thoại','Nhập email',0,24),(25,'301','','Trường THCS Trần Phú',NULL,'Phú Yên','057','301@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_301','1','Nhập điện thoại','Nhập email',0,24),(26,'302','','Trường THCS Đức Bình Đông',NULL,'Phú Yên','057','302@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_302','1','Nhập điện thoại','Nhập email',0,24),(27,'303','','Trường THCS Đức Bình',NULL,'Phú Yên','057','303@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_303','1','Nhập điện thoại','Nhập email',0,24),(28,'304','','Trường THCS Ea Bá',NULL,'Phú Yên','057','304@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_304','1','Nhập điện thoại','Nhập email',0,24),(29,'305','','Trường THCS Ea Lâm',NULL,'Phú Yên','057','305@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_305','1','Nhập điện thoại','Nhập email',0,24),(30,'306','','Trường THCS Eatrol',NULL,'Phú Yên','057','306@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_306','1','Nhập điện thoại','Nhập email',0,24),(31,'307','','Trường THCS Ea Bar',NULL,'Phú Yên','057','307@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_307','1','Nhập điện thoại','Nhập email',0,24),(32,'308','','Trường THCS EaLy',NULL,'Phú Yên','057','308@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_308','1','Nhập điện thoại','Nhập email',0,24),(33,'309','','Trường THCS Tố Hữu',NULL,'Phú Yên','057','309@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_309','1','Nhập điện thoại','Nhập email',0,24),(34,'310','','Trường THCS & THPT Võ Văn Kiệt',NULL,'Phú Yên','057','310@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_310','1','Nhập điện thoại','Nhập email',0,24),(35,'311','','Trường PTDTNT Sông Hinh',NULL,'Phú Yên','057','311@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_311','1','Nhập điện thoại','Nhập email',0,24),(36,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','33',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(37,'400','','Trường THCS Hòa An',NULL,'Phú Yên','057','400@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_400','1','Nhập điện thoại','Nhập email',0,24),(38,'401','','Trường THCS Nguyễn Thế Bảo',NULL,'Phú Yên','057','401@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_401','1','Nhập điện thoại','Nhập email',0,24),(39,'402','33','THCS Thị Trấn Phú Hòa',NULL,'Phú Yên','057','thcs402@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_402','1','0123','Nhập emaille',0,24),(40,'403','','Trường THCS Hòa Định Tây',NULL,'Phú Yên','057','403@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_403','1','Nhập điện thoại','Nhập email',0,24),(41,'404','','Trường THCS Hòa Hội',NULL,'Phú Yên','057','404@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_404','1','Nhập điện thoại','Nhập email',0,24),(42,'405','','Trường THCS Lương Văn Chánh',NULL,'Phú Yên','057','405@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_405','1','Nhập điện thoại','Nhập email',0,24),(43,'406','','Trường THCS Trần Hào',NULL,'Phú Yên','057','406@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_406','1','Nhập điện thoại','Nhập email',0,24),(44,'407','','Trường THCS Hòa Quang',NULL,'Phú Yên','057','407@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_407','1','Nhập điện thoại','Nhập email',0,24),(45,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','44',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(46,'500','','Trường THCS Trần Rịa',NULL,'Phú Yên','057','500@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_500','1','Nhập điện thoại','Nhập email',0,24),(47,'501','','Trường THCS Nguyễn Thái Bình',NULL,'Phú Yên','057','501@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_501','1','Nhập điện thoại','Nhập email',0,24),(48,'502','','Trường THCS An Dương Vương',NULL,'Phú Yên','057','502@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_502','1','Nhập điện thoại','Nhập email',0,24),(49,'503','','Trường THCS Lê Văn Tám',NULL,'Phú Yên','057','503@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_503','1','Nhập điện thoại','Nhập email',0,24),(50,'504','','Trường THCS Huỳnh Thúc Kháng',NULL,'Phú Yên','057','504@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_504','1','Nhập điện thoại','Nhập email',0,24),(51,'505','','Trường THCS  An Hiệp',NULL,'Phú Yên','057','505@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_505','1','Nhập điện thoại','Nhập email',0,24),(52,'506','','Trường THCS Kim Đồng',NULL,'Phú Yên','057','506@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_506','1','Nhập điện thoại','Nhập email',0,24),(53,'507','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','507@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_507','1','Nhập điện thoại','Nhập email',0,24),(54,'508','','Trường THCS Võ Trứ',NULL,'Phú Yên','057','508@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_508','1','Nhập điện thoại','Nhập email',0,24),(55,'509','','Trường THCS Lê Duẩn',NULL,'Phú Yên','057','509@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_509','1','Nhập điện thoại','Nhập email',0,24),(56,'510','','Trường THCS Ngô Mây',NULL,'Phú Yên','057','510@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_510','1','Nhập điện thoại','Nhập email',0,24),(57,'511','','Trường THCS Lê Thánh Tông',NULL,'Phú Yên','057','511@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_511','1','Nhập điện thoại','Nhập email',0,24),(58,'512','','Trường THCS Nguyễn Bá Ngọc',NULL,'Phú Yên','057','512@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_512','1','Nhập điện thoại','Nhập email',0,24),(59,'513','','Trường THCS Nguyễn Hoa',NULL,'Phú Yên','057','513@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_513','1','Nhập điện thoại','Nhập email',0,24),(60,'514','','Trường THCS & THPT Võ Thị Sáu',NULL,'Phú Yên','057','514@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_514','1','Nhập điện thoại','Nhập email',0,24),(61,'515','','Trường THCS & THPT Nguyễn Viết Xuân',NULL,'Phú Yên','057','515@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_515','1','Nhập điện thoại','Nhập email',0,24),(62,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','55',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(63,'600','','Trường THCS Nguyễn Viết Xuân',NULL,'Phú Yên','057','600@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_600','1','Nhập điện thoại','Nhập email',0,24),(64,'601','','Trường THCS Trần Quốc Toản',NULL,'Phú Yên','057','601@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_601','1','Nhập điện thoại','Nhập email',0,24),(65,'602','','Trường THCS Phan Lưu Thanh',NULL,'Phú Yên','057','602@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_602','1','Nhập điện thoại','Nhập email',0,24),(66,'603','','Trường THCS Trần Quốc Tuấn',NULL,'Phú Yên','057','603@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_603','1','Nhập điện thoại','Nhập email',0,24),(67,'604','','Trường THCS Nguyễn Văn Trỗi',NULL,'Phú Yên','057','604@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_604','1','Nhập điện thoại','Nhập email',0,24),(68,'605','','Trường THCS Hoàng Văn Thụ',NULL,'Phú Yên','057','605@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_605','1','Nhập điện thoại','Nhập email',0,24),(69,'606','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','606@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_606','1','Nhập điện thoại','Nhập email',0,24),(70,'607','','Trường THCS Nguyễn Hào Sự',NULL,'Phú Yên','057','607@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_607','1','Nhập điện thoại','Nhập email',0,24),(71,'608','','Trường THCS Lê Văn Tám',NULL,'Phú Yên','057','608@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_608','1','Nhập điện thoại','Nhập email',0,24),(72,'609','','Trường PTDTBT Đinh Núp',NULL,'Phú Yên','057','609@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_609','1','Nhập điện thoại','Nhập email',0,24),(73,'610','','Trường THCS & THPT Chu Văn An',NULL,'Phú Yên','057','610@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_610','1','Nhập điện thoại','Nhập email',0,24),(74,'611','','Trường PTDTNT Đồng Xuân',NULL,'Phú Yên','057','611@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_611','1','Nhập điện thoại','Nhập email',0,24),(75,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','66',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(76,'700','','Trường THCS Tô Vĩnh Diện',NULL,'Phú Yên','057','700@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_700','1','Nhập điện thoại','Nhập email',0,24),(77,'701','','Trường THCS Bùi Thị Xuân',NULL,'Phú Yên','057','701@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_701','1','Nhập điện thoại','Nhập email',0,24),(78,'702','','Trường THCS Triệu Thị Trinh',NULL,'Phú Yên','057','702@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_702','1','Nhập điện thoại','Nhập email',0,24),(79,'703','','Trường THCS Cù Chính Lan',NULL,'Phú Yên','057','703@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_703','1','Nhập điện thoại','Nhập email',0,24),(80,'704','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','704@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_704','1','Nhập điện thoại','Nhập email',0,24),(81,'705','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','705@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_705','1','Nhập điện thoại','Nhập email',0,24),(82,'706','','Trường THCS Mạc Đỉnh Chi',NULL,'Phú Yên','057','706@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_706','1','Nhập điện thoại','Nhập email',0,24),(83,'707','','Trường THCS Hoàng Văn Thụ',NULL,'Phú Yên','057','707@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_707','1','Nhập điện thoại','Nhập email',0,24),(84,'708','','Trường THCS Nguyễn Hồng Sơn',NULL,'Phú Yên','057','708@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_708','1','Nhập điện thoại','Nhập email',0,24),(85,'709','','Trường THCS Đoàn Thị Điểm',NULL,'Phú Yên','057','709@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_709','1','Nhập điện thoại','Nhập email',0,24),(86,'710','','Trường THCS & THPT Nguyễn Khuyến',NULL,'Phú Yên','057','710@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_710','1','Nhập điện thoại','Nhập email',0,24),(87,'711','','Trường TH & THCS Lê Thánh Tông',NULL,'Phú Yên','057','711@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_711','1','Nhập điện thoại','Nhập email',0,24),(88,'712','','Trường TH & THCS Lê Quí Đôn',NULL,'Phú Yên','057','712@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_712','1','Nhập điện thoại','Nhập email',0,24),(89,'713','','Trường THCS & THPT Võ Nguyên Giáp',NULL,'Phú Yên','057','713@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_713','1','Nhập điện thoại','Nhập email',0,24),(90,'714','','Trường  TH & THCS Chu Văn An',NULL,'Phú Yên','057','714@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_714','1','Nhập điện thoại','Nhập email',0,24),(91,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','77',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(92,'800','','Trường THCS thị trấn Củng Sơn',NULL,'Phú Yên','057','800@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_800','1','Nhập điện thoại','Nhập email',0,24),(93,'801','','Trường THCS Vừ A Dính',NULL,'Phú Yên','057','801@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_801','1','Nhập điện thoại','Nhập email',0,24),(94,'802','','Trường THCS Sơn Nguyên',NULL,'Phú Yên','057','802@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_802','1','Nhập điện thoại','Nhập email',0,24),(95,'803','','Trường THCS Sơn Hà',NULL,'Phú Yên','057','803@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_803','1','Nhập điện thoại','Nhập email',0,24),(96,'804','','Trường THCS Suối Bạc',NULL,'Phú Yên','057','804@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_804','1','Nhập điện thoại','Nhập email',0,24),(97,'805','','Trường PTDTBT La Văn Cầu',NULL,'Phú Yên','057','805@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_805','1','Nhập điện thoại','Nhập email',0,24),(98,'806','','Trường THCS Đinh Núp',NULL,'Phú Yên','057','806@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_806','1','Nhập điện thoại','Nhập email',0,24),(99,'807','','Trường THCS Kpa Kơ Lơng',NULL,'Phú Yên','057','807@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_807','1','Nhập điện thoại','Nhập email',0,24),(100,'808','','Trường THCS Krông Pa',NULL,'Phú Yên','057','808@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_808','1','Nhập điện thoại','Nhập email',0,24),(101,'809','','Trường THCS Suối Trai',NULL,'Phú Yên','057','809@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_809','1','Nhập điện thoại','Nhập email',0,24),(102,'810','','Trường TH & THCS Sơn Định',NULL,'Phú Yên','057','810@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_810','1','Nhập điện thoại','Nhập email',0,24),(103,'811','','Trường THCS Phước Tân',NULL,'Phú Yên','057','811@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_811','1','Nhập điện thoại','Nhập email',0,24),(104,'812','','Trường THCS &THPT Nguyễn Bá Ngọc',NULL,'Phú Yên','057','812@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_812','1','Nhập điện thoại','Nhập email',0,24),(105,'813','','Trường PTDTNT Sơn Hòa',NULL,'Phú Yên','057','813@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_813','1','Nhập điện thoại','Nhập email',0,24),(106,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','88',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(107,'900','','Trường THCS Trường THCS Lê Lợi',NULL,'Phú Yên','057','900@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_900','1','Nhập điện thoại','Nhập email',0,24),(108,'901','','Trường THCS Nguyễn Du',NULL,'Phú Yên','057','901@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_901','1','Nhập điện thoại','Nhập email',0,24),(109,'902','','Trường THCS Nguyễn Văn Trỗi',NULL,'Phú Yên','057','902@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_902','1','Nhập điện thoại','Nhập email',0,24),(110,'903','','Trường THCS Trần Quốc Toản',NULL,'Phú Yên','057','903@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_903','1','Nhập điện thoại','Nhập email',0,24),(111,'904','','Trường THCS Hùng Vương',NULL,'Phú Yên','057','904@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_904','1','Nhập điện thoại','Nhập email',0,24),(112,'905','','Trường THCS Ngô Quyền',NULL,'Phú Yên','057','905@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_905','1','Nhập điện thoại','Nhập email',0,24),(113,'906','','Trường THCS Lương Thế Vinh',NULL,'Phú Yên','057','906@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_906','1','Nhập điện thoại','Nhập email',0,24),(114,'907','','Trường THCS Lý Tự Trọng',NULL,'Phú Yên','057','907@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_907','1','Nhập điện thoại','Nhập email',0,24),(115,'908','','Trường THCS Đinh Tiên Hoàng',NULL,'Phú Yên','057','908@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_908','1','Nhập điện thoại','Nhập email',0,24),(116,'909','','Trường THCS Võ Văn Kiệt',NULL,'Phú Yên','057','909@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_909','1','Nhập điện thoại','Nhập email',0,24),(117,'910','','Trường THCS Trần Hưng Đạo',NULL,'Phú Yên','057','910@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_910','1','Nhập điện thoại','Nhập email',0,24),(118,'911','','Trường THCS Nguyễn Thị Định',NULL,'Phú Yên','057','911@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_911','1','Nhập điện thoại','Nhập email',0,24),(119,'912','','Trường THCS Nguyễn Hữu Thọ',NULL,'Phú Yên','057','912@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_912','1','Nhập điện thoại','Nhập email',0,24),(120,'913','','Trường THCS Trần Phú',NULL,'Phú Yên','057','913@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_913','1','Nhập điện thoại','Nhập email',0,24),(121,'914','','Trường THCS Trần Cao Vân',NULL,'Phú Yên','057','914@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_914','1','Nhập điện thoại','Nhập email',0,24),(122,'915','','Trường Phổ thông Duy Tân (cấp THCS)',NULL,'Phú Yên','057','915@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_915','1','Nhập điện thoại','Nhập email',0,24),(123,'999','','Vãng lai',NULL,'Phú Yên','057','999@phuyen.edu.vn','Nhập  họ và tên liện hệ','99',2,'cap2_999','1','Nhập điện thoại','Nhập email',0,24),(124,'1100',NULL,'Trường THPT Lê Hồng Phong',NULL,'Phú Yên','0573843348','beta@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1100','1','Nhập điện thoại','Nhập emailleanpha@phuyen.edu.vn',0,24),(125,'1101','','Trường THPT Nguyễn Thị Minh Khai',NULL,'Phú Yên','0573843349','leanpha@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1101','1','Nhập điện thoại','Nhập email',0,24),(126,'1102','','Trường THPT Phạm Văn Đồng',NULL,'Phú Yên','0573843350','leanpha@phuyen.edu.vn','Lê An Pha','11',3,'cap3_1102','1','Nhập điện thoại','Nhập email',0,24),(127,'2200','22','Trường THPT Lê Trung Kiên','Lê Trung Kiên','Phú Yên','0573843351','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2200','1','Nhập điện thoại','Nhập email',0,24),(128,'2201','','Trường THPT Nguyễn Công Trứ',NULL,'Phú Yên','0573843352','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2201','1','Nhập điện thoại','Nhập email',0,24),(129,'2202','','Trường THPT Nguyễn Văn Linh',NULL,'Phú Yên','0573843353','leanpha@phuyen.edu.vn','Lê An Pha','22',3,'cap3_2202','1','Nhập điện thoại','Nhập email',0,24),(130,'3300','','Trường THPT Nguyễn Du',NULL,'Phú Yên','0573843354','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3300','1','Nhập điện thoại','Nhập email',0,24),(131,'3301','','Trường THPT Tôn Đức Thắng',NULL,'Phú Yên','0573843355','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3301','1','Nhập điện thoại','Nhập email',0,24),(132,'3302','','Trường THCS & THPT Võ Văn Kiệt',NULL,'Phú Yên','0573843356','leanpha@phuyen.edu.vn','Lê An Pha','33',3,'cap3_3302','1','Nhập điện thoại','Nhập email',0,24),(133,'4400','','Trường THPT Trần Bình Trọng',NULL,'Phú Yên','0573843357','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4400','1','Nhập điện thoại','Nhập email',0,24),(134,'4401','','Trường THPT Trần Quốc Tuấn',NULL,'Phú Yên','0573843358','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4401','1','Nhập điện thoại','Nhập email',0,24),(135,'4402','','Trường THPT Trần Suyền',NULL,'Phú Yên','0573843359','leanpha@phuyen.edu.vn','Lê An Pha','44',3,'cap3_4402','1','Nhập điện thoại','Nhập email',0,24),(136,'5500','','Trường THPT Lê Thành Phương',NULL,'Phú Yên','0573843360','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5500','1','Nhập điện thoại','Nhập email',0,24),(137,'5501','','Trường THCS & THPT Nguyễn Viết Xuân',NULL,'Phú Yên','0573843361','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5501','1','Nhập điện thoại','Nhập email',0,24),(138,'5502','','Trường THPT Trần Phú',NULL,'Phú Yên','0573843362','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5502','1','Nhập điện thoại','Nhập email',0,24),(139,'5503','','Trường THCS&THPT Võ Thị Sáu',NULL,'Phú Yên','0573843363','leanpha@phuyen.edu.vn','Lê An Pha','55',3,'cap3_5503','1','Nhập điện thoại','Nhập email',0,24),(140,'6600','','Trường THCS & THPT Chu Văn An',NULL,'Phú Yên','0573843364','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6600','1','Nhập điện thoại','Nhập email',0,24),(141,'6601','','Trường THPT Lê Lợi',NULL,'Phú Yên','0573843365','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6601','1','Nhập điện thoại','Nhập email',0,24),(142,'6602','','Trường THPT Nguyễn Thái Bình',NULL,'Phú Yên','0573843366','leanpha@phuyen.edu.vn','Lê An Pha','66',3,'cap3_6602','1','Nhập điện thoại','Nhập email',0,24),(143,'7700','','Trường THPT Phan Chu Trinh',NULL,'Phú Yên','0573843367','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7700','1','Nhập điện thoại','Nhập email',0,24),(144,'7701','','Trường THPT Phan Đình Phùng',NULL,'Phú Yên','0573843368','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7701','1','Nhập điện thoại','Nhập email',0,24),(145,'7702','','Trường THCS & THPT Võ Nguyên Giáp',NULL,'Phú Yên','0573843369','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7702','1','Nhập điện thoại','Nhập email',0,24),(146,'7703','','Trường THCS & THPT  Nguyễn Khuyến',NULL,'Phú Yên','0573843370','leanpha@phuyen.edu.vn','Lê An Pha','77',3,'cap3_7703','1','Nhập điện thoại','Nhập email',0,24),(147,'8800','','Trường THCS & THPT Nguyễn Bá Ngọc',NULL,'Phú Yên','0573843371','leanpha@phuyen.edu.vn','Lê An Pha','88',3,'cap3_8800','1','Nhập điện thoại','Nhập email',0,24),(148,'8801','','Trường THPT Phan Bội Châu',NULL,'Phú Yên','0573843372','leanpha@phuyen.edu.vn','Lê An Pha','88',3,'cap3_8801','1','Nhập điện thoại','Nhập email',0,24),(149,'9900','','Trường THPT chuyên Lương Văn Chánh',NULL,'Phú Yên','0573843373','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9900','1','Nhập điện thoại','Nhập email',1,24),(150,'9901','','Trường PTDTNT Tỉnh',NULL,'Phú Yên','0573843374','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9901','1','Nhập điện thoại','Nhập email',1,24),(151,'9902','','Trường THPT Ngô Gia Tự',NULL,'Phú Yên','0573843375','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9902','1','Nhập điện thoại','Nhập email',0,24),(152,'9903','','Trường THPT Nguyễn Huệ',NULL,'Phú Yên','0573843376','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9903','1','Nhập điện thoại','Nhập email',0,24),(153,'9904','','Trường THPT Nguyễn Trãi',NULL,'Phú Yên','0573843377','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9904','1','Nhập điện thoại','Nhập email',0,24),(154,'9905','','Trường THPT Nguyễn Trường Tộ',NULL,'Phú Yên','0573843378','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9905','1','Nhập điện thoại','Nhập email',0,24),(155,'9906','','Trường Phổ thông Duy Tân (cấp THPT)',NULL,'Phú Yên','0573843379','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9906','1','Nhập điện thoại','Nhập email',0,24),(156,'9907','','Trường THPT Nguyễn Bỉnh Khiêm',NULL,'Phú Yên','0573843380','leanpha@phuyen.edu.vn','Lê An Pha','99',3,'cap3_9907','1','Nhập điện thoại','Nhập email',0,24);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL),(2,4,'192.168.1.8',0,0,0,NULL,NULL,NULL),(3,4,'127.0.0.1',0,0,0,NULL,NULL,NULL),(4,6,'127.0.0.1',0,0,0,NULL,NULL,NULL),(5,7,'127.0.0.1',0,0,0,NULL,NULL,NULL),(6,13,'127.0.0.1',0,0,0,NULL,NULL,NULL),(7,14,'127.0.0.1',0,0,0,NULL,NULL,NULL),(8,18,'127.0.0.1',0,0,0,NULL,NULL,NULL),(9,31,'127.0.0.1',0,0,0,NULL,NULL,NULL),(10,53,'127.0.0.1',0,0,0,NULL,NULL,NULL),(11,84,'127.0.0.1',0,0,0,NULL,NULL,NULL),(12,85,'127.0.0.1',0,0,0,NULL,NULL,NULL),(13,106,'127.0.0.1',0,0,0,NULL,NULL,NULL),(14,86,'127.0.0.1',0,0,0,NULL,NULL,NULL),(15,127,'127.0.0.1',0,0,0,NULL,NULL,NULL),(16,149,'127.0.0.1',0,0,0,NULL,NULL,NULL),(17,170,'127.0.0.1',0,0,0,NULL,NULL,NULL),(18,181,'127.0.0.1',0,0,0,NULL,NULL,NULL),(19,206,'127.0.0.1',0,0,0,NULL,NULL,NULL);
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
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(204,205,NULL,NULL,'NGUYỄN ĐÔNG','DƯƠNG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(205,206,NULL,NULL,'Lê An Pha',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 10:47:58','2017-05-21 10:47:58'),(180,181,NULL,NULL,'Nhập  họ và tên liện hệ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:41:26','2017-05-21 09:41:26'),(193,194,NULL,NULL,'TRẦN TUẤN','ANH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(194,195,NULL,NULL,'DƯƠNG TÙNG','BÁCH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(195,196,NULL,NULL,'PHẠM XUÂN','BÁCH',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(196,197,NULL,NULL,'DIỆP ĐẠI','BẢN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(197,198,NULL,NULL,'VÕ HOÀNG DUY','BẢO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(198,199,NULL,NULL,'NGUYỄN THỊ NGỌC','BỘI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(199,200,NULL,NULL,'ĐẶNG HUỲNH BẢO','CHÂU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(200,201,NULL,NULL,'NGÔ ĐAN','CHI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(201,202,NULL,NULL,'PHẠM MINH','CHIẾN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(202,203,NULL,NULL,'VÕ THỊ THU','DÂN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(203,204,NULL,NULL,'TRẦN THẾ','DƯƠNG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(169,170,NULL,NULL,'Nhập  họ và tên liện hệ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-05-21 09:39:39','2017-05-21 09:39:39');
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
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@admin.com','admin','$2y$10$/Fs8Eq4psGkY4NVAspwirOAcb16E746U.BJq9KReOEiXmCTKoePx.',NULL,1,0,NULL,NULL,'2017-05-21 13:07:23','$2y$10$MwfMwNMABQU4rs/73YcSrurkI.QvOk38jVvbdrtXn/8Jwu8XABzhm',NULL,0,1,'2017-04-23 00:58:57','2017-05-21 13:07:23'),(194,'4020023@phuyen.edu.vn','4020023','$2y$10$YncCbp7/EOeBjsYyn5sJ.e2aiVH/ldQeQKSJqt9nAo2j8DVJUnmOu','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(195,'4020024@phuyen.edu.vn','4020024','$2y$10$5kMJTMSHf/fRHW0X85lVtent8tNbBWrsmyssw9xvDTwvK0HE7vEuO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(196,'4020025@phuyen.edu.vn','4020025','$2y$10$a30X1Xx0FawCoIvBffekF.sT5qPioJBT2aLTQ5aeodaJTZWs06Vb.','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(197,'4020026@phuyen.edu.vn','4020026','$2y$10$VBjuSB7h7QJrGKOfGU2gTOjTJnmn51NrZuETrfsEW4IiiNUtpgCRK','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(198,'4020027@phuyen.edu.vn','4020027','$2y$10$f4zZMWXiPGuO6EuzLHZtreiJK3hUlb6iG6xNP6yirALffzH44c2QS','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(199,'4020028@phuyen.edu.vn','4020028','$2y$10$FyiEozq1EOCAzjBsPxWIzuiY5d2NUYk7pxdEV4NcNTnOebJV/OwvW','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(200,'4020029@phuyen.edu.vn','4020029','$2y$10$vOZwoX3BjNeJrd/XT6NFx.u2HVOCUkFJmtOfI9LqRhF2/DHt1RExO','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(201,'4020030@phuyen.edu.vn','4020030','$2y$10$w7oX.z5g62HQ5B9WsqyOI.penfKHipcLWe4BDAHlVnho1WWydT8ce','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:33','2017-05-21 09:56:33'),(202,'4020031@phuyen.edu.vn','4020031','$2y$10$eD8lfwrZbR5w4RDY4KfNl.uTvkvJJSgnTVB6Nzs5I52NCFltL3x6a','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(203,'4020032@phuyen.edu.vn','4020032','$2y$10$xiHJdnqOQSq.ymkSqklz/O3VHDdl95tFQhaTGddB9EcOHI4tvS1hm','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(204,'4020033@phuyen.edu.vn','4020033','$2y$10$4QrLJmWMubHJyjTd2BC8cuzslAB4rLSCtVIkmree1Ms2et6jykkMe','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(205,'4020034@phuyen.edu.vn','4020034','$2y$10$UmE/DMhk/zw.mZmNtFoEBepDiwmWIK/2V.2q7IYmCwJ4Y78UO17Oa','{\"_student\":1}',1,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 09:56:34','2017-05-21 09:56:34'),(206,'leanpha@phuyen.edu.vn','cap3_2200','$2y$10$atgty6DVDfwRbL9WQyBRQObOiCKzUrxIsW8Jod6tMNcY.IjjLE1km','{\"_mod-3\":1}',1,0,NULL,NULL,'2017-05-21 10:48:03','$2y$10$JOkXd8/xaR2w9lChRPcgUuwaVWjepdYB0EnR75fDbnlqqaK7AzmLW',NULL,0,NULL,'2017-05-21 10:47:58','2017-05-21 10:48:03'),(170,'thcs402@phuyen.edu.vn','cap2_402','$2y$10$oGWEGOlkzAVM1nYfq.Pw1eJT2O7rU3WEl9XkuwercHrONBV9r/E0e','{\"_mod-2\":1,\"_my-pexcel\":1}',1,0,NULL,NULL,'2017-05-21 10:18:21','$2y$10$oudaHSFUrxlT48qSjVc3tOlN6RHsYJll9hPaz9vl6U4E.yRGiLU3q',NULL,0,NULL,'2017-05-21 09:39:39','2017-05-21 10:18:21');
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

-- Dump completed on 2017-05-21 20:43:54
