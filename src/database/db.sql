-- MySQL dump 10.13  Distrib 5.7.11, for Win64 (x86_64)
--
-- Host: localhost    Database: tuyensinh_online
-- ------------------------------------------------------
-- Server version	5.7.11

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'superadmin','{\"_superadmin\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(2,'editor','{\"_user-editor\":1,\"_group-editor\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(3,'base admin','{\"_user-editor\":1}',0,'2017-04-23 00:58:57','2017-04-23 00:58:57');
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'superadmin','_superadmin',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(2,'user editor','_user-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(3,'group editor','_group-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(4,'permission editor','_permission-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(5,'profile type editor','_profile-editor',0,'2017-04-23 00:58:57','2017-04-23 00:58:57');
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
  `pexcel_value` text CHARACTER SET utf8,
  `pexcel_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pexcel_description` text COLLATE utf8_unicode_ci,
  `pexcel_file_path` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pexcel_status` tinyint(4) DEFAULT NULL,
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
INSERT INTO `pexcel` VALUES (4,0,1,9,21,NULL,'1111111111111111111','<p>111111111111111111111111</p>','/files/1/file/test.xlsx',NULL,1494221518,1494238473);
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
  `pexcel_category_created_at` int(11) DEFAULT NULL,
  `pexcel_category_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`pexcel_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pexcel_categories`
--

LOCK TABLES `pexcel_categories` WRITE;
/*!40000 ALTER TABLE `pexcel_categories` DISABLE KEYS */;
INSERT INTO `pexcel_categories` VALUES (4,'Năm học 2017 - 2018',1,NULL,NULL,1494214137,1494214137),(3,'Năm học 2016 - 2017',1,NULL,NULL,1494214118,1494214118);
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
-- Table structure for table `school_students`
--

DROP TABLE IF EXISTS `school_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_sex` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth` int(11) DEFAULT NULL,
  `student_birth_day` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_month` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_year` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `student_birth_place` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `school_district_id` int(11) DEFAULT NULL,
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
  `student_nominate` int(11) DEFAULT '0',
  `school_id_option` int(11) DEFAULT NULL,
  `school_class_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_id_option_1` int(11) DEFAULT NULL,
  `school_code_option_1` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_id_option_2` int(11) DEFAULT NULL,
  `school_code_option_2` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_user` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `student_pass` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `school_course_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pexcel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=483 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_students`
--

LOCK TABLES `school_students` WRITE;
/*!40000 ALTER TABLE `school_students` DISABLE KEYS */;
INSERT INTO `school_students` VALUES (482,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',NULL,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,1,9900,'TOANTIN',NULL,'3300',NULL,'3302','anh@yahoo.com','0909090909','3080284','3080284',NULL,NULL),(481,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',NULL,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,NULL,NULL,NULL,NULL,'3300',NULL,'9906','vananh@gmail.com','0914188188\'','3080184','3080184',NULL,NULL),(480,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',NULL,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,NULL,9901,NULL,NULL,'3300',NULL,'3301','nvanh@gmail.com','0903556635','3080084','3080084',NULL,NULL),(479,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',NULL,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'cc',NULL,9900,'TOAN',NULL,'3300',NULL,'3302','mthanh@gmail.com','0913445058','3080974','3080974',NULL,NULL),(478,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',NULL,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,1,9900,'TOANTIN',NULL,'3300',NULL,'3302','anh@yahoo.com','0909090909','3080874','3080874',NULL,NULL),(477,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',NULL,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,NULL,NULL,NULL,NULL,'3300',NULL,'9906','vananh@gmail.com','0914188188\'','3080774','3080774',NULL,NULL),(475,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',NULL,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'bb',NULL,9900,'TOAN',NULL,'3300',NULL,'3302','mthanh@gmail.com','0913445058','3080574','3080574',NULL,NULL),(476,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',NULL,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,NULL,9901,NULL,NULL,'3300',NULL,'3301','nvanh@gmail.com','0903556635','3080674','3080674',NULL,NULL),(474,'HỒ THỊ NGỌC','ÁNH','Nữ',1001782800,'30','9','2001','Tuy hòa, Phú Yên',308,33,'9A','TB','TB',NULL,'TB','K',NULL,'TB','K',NULL,'TB','K',NULL,6,6,5.9,'TB',NULL,NULL,1,9900,'TOANTIN',NULL,'3300',NULL,'3302','anh@yahoo.com','0909090909','3080474','3080474',NULL,NULL),(473,'NGUYỄN THỊ VÂN','ANH','Nữ',976122000,'7','12','2000','Thái Bình',308,33,'9A','TB','T',NULL,'TB','T',NULL,'TB','T',NULL,'TB','T',NULL,5.6,6.5,7.3,'TB',NULL,NULL,NULL,NULL,NULL,NULL,'3300',NULL,'9906','vananh@gmail.com','0914188188\'','3080374','3080374',NULL,NULL),(472,'NGÔ VÂN','ANH','Nam',1005498000,'12','11','2001','Tuy Hòa, Phú Yên',308,33,'9A','K','T',NULL,'TB','T',NULL,'K','T',NULL,'K','T',NULL,7.5,7.6,8,'K',NULL,NULL,NULL,9901,NULL,NULL,'3300',NULL,'3301','nvanh@gmail.com','0903556635','3080274','3080274',NULL,NULL),(471,'MAI THỊ HỒNG','ANH','Nam',1001955600,'2','10','2001','Tuy Hòa, Phú Yên',308,33,'9A','G','T',NULL,'K','K',NULL,'K','T',NULL,'G','T',NULL,8.5,8.3,8.5,'G',2.5,'xx',NULL,9900,'TOAN',NULL,'3300',NULL,'3302','mthanh@gmail.com','0913445058','3080174','3080174',NULL,NULL);
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
  `school_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `school_distric_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `school_level_id` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'100','Trường THCS Đồng Khởi','Phú Yên','0573843348','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_100','user_100'),(2,'101','Trường THCS Đinh Tiên Hoàng','Phú Yên','0573843349','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_101','user_101'),(3,'102','Trường THCS Huỳnh Thúc Kháng','Phú Yên','0573843350','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_102','user_102'),(4,'103','Trường THCS Lê Hoàn','Phú Yên','0573843351','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_103','user_103'),(5,'104','Trường THCS Nguyễn Anh Hào','Phú Yên','0573843352','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_104','user_104'),(6,'105','Trường THCS Nguyễn Tất Thành','Phú Yên','0573843353','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_105','user_105'),(7,'106','Trường THCS Nguyễn Thị Định','Phú Yên','0573843354','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_106','user_106'),(8,'107','Trường THCS Phạm Đình Quy','Phú Yên','0573843355','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_107','user_107'),(9,'108','Trường THCS Phạm Văn Đồng','Phú Yên','0573843356','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_108','user_108'),(10,'109','Trường THCS Tây Sơn','Phú Yên','0573843357','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_109','user_109'),(11,'110','Trường THCS Lê Lợi','Phú Yên','0573843358','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_110','user_110'),(12,'999','Vãng lai','Phú Yên','0573843359','leanpha@phuyen.edu.vn','Lê An Pha','11','2','user_999','user_999'),(13,'200','Trường THCS Tôn Đức Thắng','Phú Yên','0573843360','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_200','user_200'),(14,'201','Trường THCS Trần Hưng Đạo','Phú Yên','0573843361','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_201','user_201'),(15,'202','Trường THCS Hoàng Hoa Thám','Phú Yên','0573843362','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_202','user_202'),(16,'203','Trường THCS Quang Trung','Phú Yên','0573843363','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_203','user_203'),(17,'204','Trường THCS Nguyễn Chí Thanh','Phú Yên','0573843364','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_204','user_204'),(18,'205','Trường THCS Trần Nhân Tông','Phú Yên','0573843365','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_205','user_205'),(19,'206','Trường THCS Trần Kiệt','Phú Yên','0573843366','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_206','user_206'),(20,'207','Trường THCS Lương Tấn Thịnh','Phú Yên','0573843367','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_207','user_207'),(21,'208','Trường THCS Trường Chinh','Phú Yên','0573843368','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_208','user_208'),(22,'209','Trường THCS Lê Thánh Tôn','Phú Yên','0573843369','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_209','user_209'),(23,'999','Vãng lai','Phú Yên','0573843370','leanpha@phuyen.edu.vn','Lê An Pha','22','2','user_999','user_999'),(24,'300','Trường THCS Sông Hinh','Phú Yên','0573843371','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_300','user_300'),(25,'301','Trường THCS Trần Phú','Phú Yên','0573843372','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_301','user_301'),(26,'302','Trường THCS Đức Bình Đông','Phú Yên','0573843373','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_302','user_302'),(27,'303','Trường THCS Đức Bình','Phú Yên','0573843374','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_303','user_303'),(28,'304','Trường THCS Ea Bá','Phú Yên','0573843375','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_304','user_304'),(29,'305','Trường THCS Ea Lâm','Phú Yên','0573843376','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_305','user_305'),(30,'306','Trường THCS Eatrol','Phú Yên','0573843377','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_306','user_306'),(31,'307','Trường THCS Ea Bar','Phú Yên','0573843378','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_307','user_307'),(32,'308','Trường THCS EaLy','Phú Yên','0573843379','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_308','user_308'),(33,'309','Trường THCS Tố Hữu','Phú Yên','0573843380','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_309','user_309'),(34,'310','Trường THCS & THPT Võ Văn Kiệt','Phú Yên','0573843381','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_310','user_310'),(35,'311','Trường PTDTNT Sông Hinh','Phú Yên','0573843382','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_311','user_311'),(36,'999','Vãng lai','Phú Yên','0573843383','leanpha@phuyen.edu.vn','Lê An Pha','33','2','user_999','user_999'),(37,'400','Trường THCS Hòa An','Phú Yên','0573843384','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_400','user_400'),(38,'401','Trường THCS Nguyễn Thế Bảo','Phú Yên','0573843385','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_401','user_401'),(39,'402','THCS Thị Trấn Phú Hòa','Phú Yên','0573843386','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_402','user_402'),(40,'403','Trường THCS Hòa Định Tây','Phú Yên','0573843387','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_403','user_403'),(41,'404','Trường THCS Hòa Hội','Phú Yên','0573843388','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_404','user_404'),(42,'405','Trường THCS Lương Văn Chánh','Phú Yên','0573843389','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_405','user_405'),(43,'406','Trường THCS Trần Hào','Phú Yên','0573843390','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_406','user_406'),(44,'407','Trường THCS Hòa Quang','Phú Yên','0573843391','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_407','user_407'),(45,'999','Vãng lai','Phú Yên','0573843392','leanpha@phuyen.edu.vn','Lê An Pha','44','2','user_999','user_999'),(46,'500','Trường THCS Trần Rịa','Phú Yên','0573843393','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_500','user_500'),(47,'501','Trường THCS Nguyễn Thái Bình','Phú Yên','0573843394','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_501','user_501'),(48,'502','Trường THCS An Dương Vương','Phú Yên','0573843395','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_502','user_502'),(49,'503','Trường THCS Lê Văn Tám','Phú Yên','0573843396','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_503','user_503'),(50,'504','Trường THCS Huỳnh Thúc Kháng','Phú Yên','0573843397','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_504','user_504'),(51,'505','Trường THCS  An Hiệp','Phú Yên','0573843398','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_505','user_505'),(52,'506','Trường THCS Kim Đồng','Phú Yên','0573843399','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_506','user_506'),(53,'507','Trường THCS Đinh Tiên Hoàng','Phú Yên','0573843400','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_507','user_507'),(54,'508','Trường THCS Võ Trứ','Phú Yên','0573843401','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_508','user_508'),(55,'509','Trường THCS Lê Duẩn','Phú Yên','0573843402','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_509','user_509'),(56,'510','Trường THCS Ngô Mây','Phú Yên','0573843403','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_510','user_510'),(57,'511','Trường THCS Lê Thánh Tông','Phú Yên','0573843404','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_511','user_511'),(58,'512','Trường THCS Nguyễn Bá Ngọc','Phú Yên','0573843405','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_512','user_512'),(59,'513','Trường THCS Nguyễn Hoa','Phú Yên','0573843406','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_513','user_513'),(60,'514','Trường THCS & THPT Võ Thị Sáu','Phú Yên','0573843407','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_514','user_514'),(61,'515','Trường THCS & THPT Nguyễn Viết Xuân','Phú Yên','0573843408','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_515','user_515'),(62,'999','Vãng lai','Phú Yên','0573843409','leanpha@phuyen.edu.vn','Lê An Pha','55','2','user_999','user_999'),(63,'600','Trường THCS Nguyễn Viết Xuân','Phú Yên','0573843410','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_600','user_600'),(64,'601','Trường THCS Trần Quốc Toản','Phú Yên','0573843411','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_601','user_601'),(65,'602','Trường THCS Phan Lưu Thanh','Phú Yên','0573843412','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_602','user_602'),(66,'603','Trường THCS Trần Quốc Tuấn','Phú Yên','0573843413','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_603','user_603'),(67,'604','Trường THCS Nguyễn Văn Trỗi','Phú Yên','0573843414','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_604','user_604'),(68,'605','Trường THCS Hoàng Văn Thụ','Phú Yên','0573843415','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_605','user_605'),(69,'606','Trường THCS Nguyễn Du','Phú Yên','0573843416','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_606','user_606'),(70,'607','Trường THCS Nguyễn Hào Sự','Phú Yên','0573843417','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_607','user_607'),(71,'608','Trường THCS Lê Văn Tám','Phú Yên','0573843418','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_608','user_608'),(72,'609','Trường PTDTBT Đinh Núp','Phú Yên','0573843419','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_609','user_609'),(73,'610','Trường THCS & THPT Chu Văn An','Phú Yên','0573843420','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_610','user_610'),(74,'611','Trường PTDTNT Đồng Xuân','Phú Yên','0573843421','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_611','user_611'),(75,'999','Vãng lai','Phú Yên','0573843422','leanpha@phuyen.edu.vn','Lê An Pha','66','2','user_999','user_999'),(76,'700','Trường THCS Tô Vĩnh Diện','Phú Yên','0573843423','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_700','user_700'),(77,'701','Trường THCS Bùi Thị Xuân','Phú Yên','0573843424','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_701','user_701'),(78,'702','Trường THCS Triệu Thị Trinh','Phú Yên','0573843425','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_702','user_702'),(79,'703','Trường THCS Cù Chính Lan','Phú Yên','0573843426','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_703','user_703'),(80,'704','Trường THCS Nguyễn Du','Phú Yên','0573843427','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_704','user_704'),(81,'705','Trường THCS Đinh Tiên Hoàng','Phú Yên','0573843428','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_705','user_705'),(82,'706','Trường THCS Mạc Đỉnh Chi','Phú Yên','0573843429','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_706','user_706'),(83,'707','Trường THCS Hoàng Văn Thụ','Phú Yên','0573843430','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_707','user_707'),(84,'708','Trường THCS Nguyễn Hồng Sơn','Phú Yên','0573843431','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_708','user_708'),(85,'709','Trường THCS Đoàn Thị Điểm','Phú Yên','0573843432','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_709','user_709'),(86,'710','Trường THCS & THPT Nguyễn Khuyến','Phú Yên','0573843433','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_710','user_710'),(87,'711','Trường TH & THCS Lê Thánh Tông','Phú Yên','0573843434','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_711','user_711'),(88,'712','Trường TH & THCS Lê Quí Đôn','Phú Yên','0573843435','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_712','user_712'),(89,'713','Trường THCS & THPT Võ Nguyên Giáp','Phú Yên','0573843436','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_713','user_713'),(90,'714','Trường  TH & THCS Chu Văn An','Phú Yên','0573843437','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_714','user_714'),(91,'999','Vãng lai','Phú Yên','0573843438','leanpha@phuyen.edu.vn','Lê An Pha','77','2','user_999','user_999'),(92,'800','Trường THCS thị trấn Củng Sơn','Phú Yên','0573843439','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_800','user_800'),(93,'801','Trường THCS Vừ A Dính','Phú Yên','0573843440','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_801','user_801'),(94,'802','Trường THCS Sơn Nguyên','Phú Yên','0573843441','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_802','user_802'),(95,'803','Trường THCS Sơn Hà','Phú Yên','0573843442','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_803','user_803'),(96,'804','Trường THCS Suối Bạc','Phú Yên','0573843443','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_804','user_804'),(97,'805','Trường PTDTBT La Văn Cầu','Phú Yên','0573843444','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_805','user_805'),(98,'806','Trường THCS Đinh Núp','Phú Yên','0573843445','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_806','user_806'),(99,'807','Trường THCS Kpa Kơ Lơng','Phú Yên','0573843446','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_807','user_807'),(100,'808','Trường THCS Krông Pa','Phú Yên','0573843447','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_808','user_808'),(101,'809','Trường THCS Suối Trai','Phú Yên','0573843448','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_809','user_809'),(102,'810','Trường TH & THCS Sơn Định','Phú Yên','0573843449','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_810','user_810'),(103,'811','Trường THCS Phước Tân','Phú Yên','0573843450','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_811','user_811'),(104,'812','Trường THCS &THPT Nguyễn Bá Ngọc','Phú Yên','0573843451','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_812','user_812'),(105,'813','Trường PTDTNT Sơn Hòa','Phú Yên','0573843452','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_813','user_813'),(106,'999','Vãng lai','Phú Yên','0573843453','leanpha@phuyen.edu.vn','Lê An Pha','88','2','user_999','user_999'),(107,'900','Trường THCS Trường THCS Lê Lợi','Phú Yên','0573843454','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_900','user_900'),(108,'901','Trường THCS Nguyễn Du','Phú Yên','0573843455','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_901','user_901'),(109,'902','Trường THCS Nguyễn Văn Trỗi','Phú Yên','0573843456','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_902','user_902'),(110,'903','Trường THCS Trần Quốc Toản','Phú Yên','0573843457','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_903','user_903'),(111,'904','Trường THCS Hùng Vương','Phú Yên','0573843458','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_904','user_904'),(112,'905','Trường THCS Ngô Quyền','Phú Yên','0573843459','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_905','user_905'),(113,'906','Trường THCS Lương Thế Vinh','Phú Yên','0573843460','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_906','user_906'),(114,'907','Trường THCS Lý Tự Trọng','Phú Yên','0573843461','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_907','user_907'),(115,'908','Trường THCS Đinh Tiên Hoàng','Phú Yên','0573843462','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_908','user_908'),(116,'909','Trường THCS Võ Văn Kiệt','Phú Yên','0573843463','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_909','user_909'),(117,'910','Trường THCS Trần Hưng Đạo','Phú Yên','0573843464','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_910','user_910'),(118,'911','Trường THCS Nguyễn Thị Định','Phú Yên','0573843465','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_911','user_911'),(119,'912','Trường THCS Nguyễn Hữu Thọ','Phú Yên','0573843466','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_912','user_912'),(120,'913','Trường THCS Trần Phú','Phú Yên','0573843467','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_913','user_913'),(121,'914','Trường THCS Trần Cao Vân','Phú Yên','0573843468','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_914','user_914'),(122,'915','Trường Phổ thông Duy Tân (cấp THCS)','Phú Yên','0573843469','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_915','user_915'),(123,'999','Vãng lai','Phú Yên','0573843470','leanpha@phuyen.edu.vn','Lê An Pha','99','2','user_999','user_999'),(124,'1100','Trường THPT Lê Hồng Phong','Phú Yên','0573843348','leanpha@phuyen.edu.vn','Lê An Pha','11','3','user_1100','user_1100'),(125,'1101','Trường THPT Nguyễn Thị Minh Khai','Phú Yên','0573843349','leanpha@phuyen.edu.vn','Lê An Pha','11','3','user_1101','user_1101'),(126,'1102','Trường THPT Phạm Văn Đồng','Phú Yên','0573843350','leanpha@phuyen.edu.vn','Lê An Pha','11','3','user_1102','user_1102'),(127,'2200','Trường THPT Lê Trung Kiên','Phú Yên','0573843351','leanpha@phuyen.edu.vn','Lê An Pha','22','3','user_2200','user_2200'),(128,'2201','Trường THPT Nguyễn Công Trứ','Phú Yên','0573843352','leanpha@phuyen.edu.vn','Lê An Pha','22','3','user_2201','user_2201'),(129,'2202','Trường THPT Nguyễn Văn Linh','Phú Yên','0573843353','leanpha@phuyen.edu.vn','Lê An Pha','22','3','user_2202','user_2202'),(130,'3300','Trường THPT Nguyễn Du','Phú Yên','0573843354','leanpha@phuyen.edu.vn','Lê An Pha','33','3','user_3300','user_3300'),(131,'3301','Trường THPT Tôn Đức Thắng','Phú Yên','0573843355','leanpha@phuyen.edu.vn','Lê An Pha','33','3','user_3301','user_3301'),(132,'3302','Trường THCS & THPT Võ Văn Kiệt','Phú Yên','0573843356','leanpha@phuyen.edu.vn','Lê An Pha','33','3','user_3302','user_3302'),(133,'4400','Trường THPT Trần Bình Trọng','Phú Yên','0573843357','leanpha@phuyen.edu.vn','Lê An Pha','44','3','user_4400','user_4400'),(134,'4401','Trường THPT Trần Quốc Tuấn','Phú Yên','0573843358','leanpha@phuyen.edu.vn','Lê An Pha','44','3','user_4401','user_4401'),(135,'4402','Trường THPT Trần Suyền','Phú Yên','0573843359','leanpha@phuyen.edu.vn','Lê An Pha','44','3','user_4402','user_4402'),(136,'5500','Trường THPT Lê Thành Phương','Phú Yên','0573843360','leanpha@phuyen.edu.vn','Lê An Pha','55','3','user_5500','user_5500'),(137,'5501','Trường THCS & THPT Nguyễn Viết Xuân','Phú Yên','0573843361','leanpha@phuyen.edu.vn','Lê An Pha','55','3','user_5501','user_5501'),(138,'5502','Trường THPT Trần Phú','Phú Yên','0573843362','leanpha@phuyen.edu.vn','Lê An Pha','55','3','user_5502','user_5502'),(139,'5503','Trường THCS&THPT Võ Thị Sáu','Phú Yên','0573843363','leanpha@phuyen.edu.vn','Lê An Pha','55','3','user_5503','user_5503'),(140,'6600','Trường THCS & THPT Chu Văn An','Phú Yên','0573843364','leanpha@phuyen.edu.vn','Lê An Pha','66','3','user_6600','user_6600'),(141,'6601','Trường THPT Lê Lợi','Phú Yên','0573843365','leanpha@phuyen.edu.vn','Lê An Pha','66','3','user_6601','user_6601'),(142,'6602','Trường THPT Nguyễn Thái Bình','Phú Yên','0573843366','leanpha@phuyen.edu.vn','Lê An Pha','66','3','user_6602','user_6602'),(143,'7700','Trường THPT Phan Chu Trinh','Phú Yên','0573843367','leanpha@phuyen.edu.vn','Lê An Pha','77','3','user_7700','user_7700'),(144,'7701','Trường THPT Phan Đình Phùng','Phú Yên','0573843368','leanpha@phuyen.edu.vn','Lê An Pha','77','3','user_7701','user_7701'),(145,'7702','Trường THCS & THPT Võ Nguyên Giáp','Phú Yên','0573843369','leanpha@phuyen.edu.vn','Lê An Pha','77','3','user_7702','user_7702'),(146,'7703','Trường THCS & THPT  Nguyễn Khuyến','Phú Yên','0573843370','leanpha@phuyen.edu.vn','Lê An Pha','77','3','user_7703','user_7703'),(147,'8800','Trường THCS & THPT Nguyễn Bá Ngọc','Phú Yên','0573843371','leanpha@phuyen.edu.vn','Lê An Pha','88','3','user_8800','user_8800'),(148,'8801','Trường THPT Phan Bội Châu','Phú Yên','0573843372','leanpha@phuyen.edu.vn','Lê An Pha','88','3','user_8801','user_8801'),(149,'9900','Trường THPT chuyên Lương Văn Chánh','Phú Yên','0573843373','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9900','user_9900'),(150,'9901','Trường PTDTNT Tỉnh','Phú Yên','0573843374','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9901','user_9901'),(151,'9902','Trường THPT Ngô Gia Tự','Phú Yên','0573843375','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9902','user_9902'),(152,'9903','Trường THPT Nguyễn Huệ','Phú Yên','0573843376','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9903','user_9903'),(153,'9904','Trường THPT Nguyễn Trãi','Phú Yên','0573843377','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9904','user_9904'),(154,'9905','Trường THPT Nguyễn Trường Tộ','Phú Yên','0573843378','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9905','user_9905'),(155,'9906','Trường Phổ thông Duy Tân (cấp THPT)','Phú Yên','0573843379','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9906','user_9906'),(156,'9907','Trường THPT Nguyễn Bỉnh Khiêm','Phú Yên','0573843380','leanpha@phuyen.edu.vn','Lê An Pha','99','3','user_9907','user_9907');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL),(2,2,'127.0.0.1',0,0,0,NULL,NULL,NULL),(3,3,'127.0.0.1',0,0,0,NULL,NULL,NULL),(4,1,'192.168.1.8',0,0,0,NULL,NULL,NULL),(5,3,'192.168.1.9',0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-23 00:58:57','2017-04-23 00:58:57'),(2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-23 01:01:57','2017-04-23 01:01:57'),(3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-23 01:22:46','2017-04-23 01:22:46');
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@admin.com','$2y$10$1xosUmQdzkyfinR36fqRfu5Nen3eFWUulHHLu7rmwNJF6D4h0Ysra',NULL,1,0,NULL,NULL,'2017-05-07 21:18:07','$2y$10$WzxP070..cbokrubAVxCKOyBnu6FT4ySXssiPDYZU9ShwIftyMhcm',NULL,0,'2017-04-23 00:58:57','2017-05-07 21:18:07'),(3,'a@b.c','$2y$10$D9RJBOc88M9YravATlwl3e1nwztTS49F7GkSDlic7XalrL84hoMMG',NULL,1,0,NULL,NULL,'2017-05-08 02:23:42','$2y$10$0APwjjjJnox02WRgc2Uum.BwTtmyliQVgjbf.VIYV.ak/WoKkPZkO',NULL,0,'2017-04-23 01:22:46','2017-05-08 02:23:42');
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
INSERT INTO `users_groups` VALUES (1,1),(3,1);
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

-- Dump completed on 2017-05-08 17:43:55
