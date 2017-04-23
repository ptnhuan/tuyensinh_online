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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'superadmin','{\"_superadmin\":1}',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(2,'editor','{\"_user-editor\":1,\"_group-editor\":1}',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(3,'base admin','{\"_user-editor\":1}',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(4,'hrm admin','{\"_hrm-admin\":1}',0,'2016-05-28 03:45:42','2016-05-28 03:45:52'),(5,'hrm user','{\"_hrm-user\":1}',0,'2016-05-28 03:46:05','2016-05-28 03:46:09');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),('2014_02_19_095545_create_users_table',1),('2014_02_19_095623_create_user_groups_table',1),('2014_02_19_095637_create_groups_table',1),('2014_02_19_160516_create_permission_table',1),('2014_02_26_165011_create_user_profile_table',1),('2014_05_06_122145_create_profile_field_types',1),('2014_05_06_122155_create_profile_field',1),('2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_report_fields`
--

DROP TABLE IF EXISTS `payroll_report_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_report_fields` (
  `payroll_report_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_report_field_val` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_report_id` int(11) NOT NULL,
  `payroll_type_field_name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payroll_report_field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_report_fields`
--

LOCK TABLES `payroll_report_fields` WRITE;
/*!40000 ALTER TABLE `payroll_report_fields` DISABLE KEYS */;
INSERT INTO `payroll_report_fields` VALUES (1,'F',1,'payroll_type_field_isvat'),(2,'K',1,'payroll_type_field_isinsurrance');
/*!40000 ALTER TABLE `payroll_report_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_reports`
--

DROP TABLE IF EXISTS `payroll_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_reports` (
  `payroll_report_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_report_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_report_description` text COLLATE utf8_unicode_ci NOT NULL,
  `payroll_report_template_original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_report_template_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payroll_report_user_col` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_report_fromrow` tinyint(4) NOT NULL,
  PRIMARY KEY (`payroll_report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_reports`
--

LOCK TABLES `payroll_reports` WRITE;
/*!40000 ALTER TABLE `payroll_reports` DISABLE KEYS */;
INSERT INTO `payroll_reports` VALUES (1,'Báo cáo thuế TNCN','<p>Mẫu b&aacute;o c&aacute;o thuế TNCN</p>','','1467957980.xlsx','B',6);
/*!40000 ALTER TABLE `payroll_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_support_categories`
--

DROP TABLE IF EXISTS `payroll_support_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_support_categories` (
  `payroll_support_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_support_category_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_support_category_description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payroll_support_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_support_categories`
--

LOCK TABLES `payroll_support_categories` WRITE;
/*!40000 ALTER TABLE `payroll_support_categories` DISABLE KEYS */;
INSERT INTO `payroll_support_categories` VALUES (1,'Quản lý lương','<p>Hướng dẫn c&aacute;c thao t&aacute;c quản l&yacute; bảng lương</p>');
/*!40000 ALTER TABLE `payroll_support_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_supports`
--

DROP TABLE IF EXISTS `payroll_supports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_supports` (
  `payroll_support_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_support_category_id` int(11) NOT NULL,
  `payroll_support_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_support_overview` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_support_description` text COLLATE utf8_unicode_ci NOT NULL,
  `payroll_support_created_date` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`payroll_support_id`),
  KEY `payroll_support_category_id` (`payroll_support_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_supports`
--

LOCK TABLES `payroll_supports` WRITE;
/*!40000 ALTER TABLE `payroll_supports` DISABLE KEYS */;
INSERT INTO `payroll_supports` VALUES (1,1,'Hướng dẫn tạo loại lương','Cấu hình <b>loại lương</b> là công việc đầu tiên trước khi thêm <b>bảng lương</b>','<p><span style=\"color: #ff0000;\"><strong>Nội dung b&agrave;i viết</strong></span></p>\r\n<ol style=\"list-style-type: upper-alpha;\">\r\n<li style=\"padding-left: 30px;\"><a href=\"#khai-niem\">Kh&aacute;i niệm</a></li>\r\n<li style=\"padding-left: 30px;\"><a href=\"#vi-du-minh-hoa\">V&iacute; dụ minh họa</a></li>\r\n<li style=\"padding-left: 30px;\"><a href=\"#cac-diem-chu-y\">C&aacute;c điểm ch&uacute; &yacute;</a></li>\r\n<li style=\"padding-left: 30px;\"><a href=\"cac-buoc-thuc-hien\">C&aacute;c bước thực hiện</a></li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #ff0000;\"><strong>A. Kh&aacute;i niệm<a id=\"khai-niem\"></a></strong></span></p>\r\n<p><strong>Loại lương&nbsp;</strong>- được hiểu như một định dạng file excel lưu trữ bảng thanh to&aacute;n lương cho nh&acirc;n vi&ecirc;n.</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #ff0000;\"><strong>B. V&iacute; dụ minh họa<a id=\"vi-du-minh-hoa\"></a></strong></span></p>\r\n<p><strong>V&iacute; dụ:</strong></p>\r\n<p>Ch&uacute;ng ta c&oacute; 03 file excel lưu trữ bảng thanh to&aacute;n lương như sau:</p>\r\n<ol>\r\n<li style=\"padding-left: 30px;\">Lương căn bản th&aacute;ng 7 năm 2016.xlsx</li>\r\n<li style=\"padding-left: 30px;\">Lương tăng th&ecirc;m th&aacute;ng 7 năm 2016.xlsx</li>\r\n<li style=\"padding-left: 30px;\">Lương phụ cấp h&agrave;nh ch&iacute;nh năm 2016.xlsx</li>\r\n</ol>\r\n<p>Khi đ&oacute;, ch&uacute;ng ta phải tạo 03 loại lương tương ứng với 03 file excel tr&ecirc;n</p>\r\n<ol>\r\n<li style=\"padding-left: 30px;\">Lương căn bản</li>\r\n<li style=\"padding-left: 30px;\">Lương tăng th&ecirc;m</li>\r\n<li style=\"padding-left: 30px;\">Lương phụ cấp h&agrave;nh ch&iacute;nh</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #ff0000;\"><strong>C. C&aacute;c điểm ch&uacute; &yacute;<a id=\"cac-diem-chu-y\"></a></strong></span></p>\r\n<ol>\r\n<li style=\"padding-left: 30px;\"><strong>Loại lương mang t&iacute;nh tổng qu&aacute;t<br /><br /></strong>Như v&iacute; dụ tại mục B, loại lương phải mang t&iacute;nh tổng qu&aacute;t, nghĩa l&agrave; mang định dạng tổng qu&aacute;t. <strong>Lương căn bản th&aacute;ng 7 năm 2016.xlsx</strong> c&oacute; loại lương tương ứng l&agrave;&nbsp;<strong>Lương căn bản</strong>, khi đ&oacute; lương th&aacute;ng 8, 9, ... phải c&oacute; c&ugrave;ng định dạng với lương th&aacute;ng 7. Nếu c&oacute; sự kh&aacute;c biệt,&nbsp;loại lương&nbsp;<strong>Lương căn bản</strong> sẽ kh&ocirc;ng hiểu định dạng mới n&agrave;y.<strong><br /><br />V&iacute; dụ 1:&nbsp;</strong>trường hợp sai<br />Bảng lưu trữ lương th&aacute;ng 7 năm 2016.xlsx, cột lương nhận đợt 1 năm 2016 tại cột F<br />Bảng lưu trữ lương th&aacute;ng 8 năm 2016.xlsx, cột lương nhận đợt 1 năm 2016 tại cột K<br /><br />2 bảng lương tr&ecirc;n c&oacute; c&ugrave;ng loại lương l&agrave;&nbsp;<strong>Lương căn bản</strong>, nhưng mỗi file một định dạng kh&aacute;c nhau. Hệ thống sẽ kh&ocirc;ng hiểu trong trường hợp n&agrave;y, v&agrave; g&acirc;y sai x&oacute;t về mặt dữ liệu.<br /><br /><strong>V&iacute; dụ 2:</strong> trường hợp đ&uacute;ng<br />Bảng lưu trữ lương th&aacute;ng 7 năm 2016.xlsx, cột lương nhận đợt 1 năm 2016 tại cột F<br />Bảng lưu trữ lương th&aacute;ng 8 năm 2016.xlsx, cột lương nhận đợt 1 năm 2016 tại cột F<br /><br />Do đ&oacute;, loại lương mang t&iacute;nh tổng qu&aacute;t h&oacute;a, c&aacute;c file excel c&oacute; c&ugrave;ng loại lương phải c&oacute; c&ugrave;ng cấu tr&uacute;c lưu trữ tương ứng nhau.&nbsp;<br /><br /></li>\r\n<li style=\"padding-left: 30px;\"><strong>C&aacute;c mẫu b&aacute;o c&aacute;o lương</strong><br /><br />C&aacute;c mẫu b&aacute;o c&aacute;o lương dạng file excel, người quản trị n&ecirc;n nhất qu&aacute;n, tập trung tại một nơi, để việc lập b&aacute;o cao lương c&oacute; c&ugrave;ng định dạng cấu tr&uacute;c lưu trữ. Nhờ vậy, việc cập nhật bảng lương v&agrave;o hệ thống sẽ dễ d&agrave;ng hơn v&agrave; ch&iacute;nh x&aacute;c về mặt dữ liệu.<br /><br /></li>\r\n<li style=\"padding-left: 30px;\"><strong>Định nghĩa cột dữ liệu trong file excel<br /><br />V&iacute; dụ:</strong> <span style=\"color: #800000;\">lương căn bảng th&aacute;ng 7 năm 2016.xlsx</span> l&agrave; file excel mang th&ocirc;ng tin bảng lương của nh&acirc;n vi&ecirc;n trong th&aacute;ng 7 năm 2016.<br /><br />Trong file excel n&agrave;y c&oacute; nhiều th&ocirc;ng tin như: ph&iacute; c&ocirc;ng đo&agrave;n, bảo hiểm, thực l&atilde;nh, lương đợt 1, .... Tuy nhi&ecirc;n, trong hệ thống n&agrave;y của ch&uacute;ng ta chỉ quan t&acirc;m đến c&aacute;c th&ocirc;ng tin sau tr&ecirc;n từng nh&acirc;n vi&ecirc;n: m&atilde; nh&acirc;n vi&ecirc;n, lương đợt 1, thực l&atilde;nh (lương đợt 2), tổng tiền, tổng bảo hiểm. Ch&iacute;nh v&igrave; vậy, PHẢI cần khai b&aacute;o cho hệ thống biết vị tr&iacute; của c&aacute;c cột n&agrave;y. Vị tr&iacute; cột được x&aacute;c định l&agrave; chỉ số vị tr&iacute; của cột.<br /><br />Cột A =&gt; Vị tr&iacute; số 1<br />Cột B =&gt; Vị tr&iacute; số 2<br />...<br />...<br />Ch&uacute; &yacute;, c&aacute;c cột bị ẩn, việc x&aacute;c định vị tr&iacute; sai, khiến th&ocirc;ng tin nhận được từ file excel bị sai lệch.<br />Việc x&aacute;c định vị tr&iacute; ch&iacute;nh x&aacute;c của cột th&ocirc;ng qua c&aacute;c bước sau:<br /><br />Bước 1: Mở file excel lưu trữ bảng lương<br />Bước 2: Chọn &ocirc; A1<br />Bước 3: Giữ chuột tại &ocirc; A1 k&eacute;o đến cột cần lưu trữ<br />Bước 4: Quan s&aacute;t vị tr&iacute; ngay mouse sẽ thấy 1 con số mang th&ocirc;ng tin cột<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; V&iacute; dụ: (4Rx5C), cột thứ 5<br /><br /><br /></li>\r\n<li style=\"padding-left: 30px;\"><strong>File excel c&oacute; r&agrave;ng buộc dữ liệu đến file excel kh&aacute;c<br /><br />V&iacute; dụ:</strong>&nbsp;<span style=\"color: #800000;\">lương căn bảng th&aacute;ng 7 năm 2016.xlsx&nbsp;<span style=\"color: #000000;\">c&oacute; cột n&agrave;o đ&oacute; li&ecirc;n kết gi&aacute; trị đến một file excel kh&aacute;c<br />Trường hợp n&agrave;y ch&uacute;ng ta d&ugrave;ng file excel n&agrave;y nhập liệu v&agrave;o hệ thống, hệ thống ngay lập tức sẽ ph&aacute;t sinh ra lỗi. V&igrave; hệ thống kh&ocirc;ng t&igrave;m thấy li&ecirc;n kết của file excel.<br /><br />Ch&uacute; &yacute; rằng, hệ thống n&agrave;y được đặt tại vị tr&iacute; trung t&acirc;m của ph&ograve;ng tin học thuộc trường. Ch&iacute;nh v&igrave; vậy, c&aacute;c li&ecirc;n kết nội bộ tại m&aacute;y t&iacute;nh c&aacute; nh&acirc;n của nh&acirc;n vi&ecirc;n kế to&aacute;n, hệ thống sẽ kh&ocirc;ng thể li&ecirc;n kết được. Hệ thống chỉ nhận được file gửi đến, kh&ocirc;ng kết nối với c&aacute;c file li&ecirc;n kết.<br /><br />Cần x&oacute;a bỏ c&aacute;c li&ecirc;n kết trong file excel đến file kh&aacute;c th&ocirc;ng qua c&aacute;c bước sau (nếu c&oacute;):<br />Bước 1: Mở file excel c&oacute; li&ecirc;n kết gi&aacute; trị đến file excel kh&aacute;c<br />Bước 2: Chọn&nbsp;<strong>Data<br /></strong>Bước 3: Chọn&nbsp;<strong>Edit link</strong><br />Bước 4: Chọn&nbsp;<strong>Break link<br /></strong>Bước 5: Chọn&nbsp;<strong>Ok</strong></span></span></li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #ff0000;\"><strong>D. C&aacute;c bước thực hiện<a id=\"cac-buoc-thuc-hien\" style=\"color: #ff0000;\"></a></strong></span></p>\r\n<p><span style=\"color: #800000;\"><span style=\"color: #000000;\">Trước khi tạo <strong>loại lương&nbsp;</strong>cần nắm r&otilde; c&aacute;c điểm ch&uacute; &yacute; tại mục C.&nbsp;</span></span></p>\r\n<p><span style=\"color: #800000;\"><span style=\"color: #000000;\">C&aacute;c bước tạo&nbsp;<strong>loại lương</strong> được thực hiện lần lượt như sau:</span></span></p>\r\n<p style=\"padding-left: 30px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\"><strong>Bước 1:</strong> &nbsp;Đăng nhập v&agrave;o t&agrave;i khoản c&oacute; quyền quản trị</span></span></p>\r\n<p style=\"padding-left: 30px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\"><strong>Bước 2:</strong> B&ecirc;n tr&aacute;i m&agrave;n h&igrave;nh, chọn&nbsp;<strong>HRM -&gt; Loại lương -&gt; Th&ecirc;m loại lương</strong></span></span></p>\r\n<p style=\"padding-left: 30px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\"><strong>Bước 3:</strong> Điền c&aacute;c th&ocirc;ng tin trong form</span></span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Ti&ecirc;u đề loại lương</span></span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Dữ liệu từ d&ograve;ng</span></span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Vị tr&iacute; cột m&atilde; nh&acirc;n vi&ecirc;n</span></span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* File mẫu</span></span></p>\r\n<p style=\"padding-left: 60px;\">&nbsp;<span style=\"color: #800000;\"><span style=\"color: #000000;\">Giải th&iacute;ch c&aacute;c dữ liệu điền v&agrave;o</span></span></p>\r\n<p style=\"padding-left: 90px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Ti&ecirc;u đề loại lương</span></span></p>\r\n<p style=\"padding-left: 120px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">M&ocirc; tả loại lương chi trả cho CBCNV (C&aacute;n bộ C&ocirc;ng nh&acirc;n vi&ecirc;n)</span></span></p>\r\n<p style=\"padding-left: 90px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Dữ liệu từ d&ograve;ng</span></span></p>\r\n<p style=\"padding-left: 120px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">Dữ liệu mang gi&aacute; trị cần xử l&yacute; được t&iacute;nh từ d&ograve;ng. Điều n&agrave;y nhằm gi&uacute;p hệ thống loại bỏ c&aacute;c d&ograve;ng đầu ti&ecirc;n của file excel mang c&aacute;c th&ocirc;ng tin kh&ocirc;ng cần thiết. V&iacute; dụ như: t&ecirc;n trường, t&ecirc;n văn bản, ti&ecirc;u đề bảng lương, ...</span></span></p>\r\n<p style=\"padding-left: 90px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* Vị tr&iacute; cột m&atilde; nh&acirc;n vi&ecirc;n</span></span></p>\r\n<p style=\"padding-left: 120px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">X&aacute;c định ch&iacute;nh x&aacute;c gi&aacute; trị số, vị tr&iacute; cột m&atilde; nh&acirc;n vi&ecirc;n tại cột số. Ch&uacute; &yacute; rằng, mặc định vị tr&iacute; cột trong excel được t&iacute;nh l&agrave; k&yacute; tự A, B, ... ch&uacute;ng ta phải x&aacute;c định gi&aacute; trị số. C&aacute;ch x&aacute;c định gi&aacute; trị số của cột được m&ocirc; tả tại mục&nbsp;<strong>C3</strong>.</span></span></p>\r\n<p style=\"padding-left: 90px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">* File mẫu</span></span></p>\r\n<p style=\"padding-left: 120px;\"><span style=\"color: #800000;\"><span style=\"color: #000000;\">Quản l&yacute; c&aacute;c file mẫu, c&aacute;c loại bảng lương để chi trả. Điều n&agrave;y gi&uacute;p hệ thống c&oacute; t&iacute;nh thống nhất về c&aacute;c loại biểu mẫu của bảng lương.</span></span></p>\r\n<p style=\"padding-left: 30px;\"><strong>&nbsp;Bước 4:&nbsp;</strong>Nhất n&uacute;t&nbsp;<strong>Lưu</strong></p>\r\n<p>Thực hiện xong 04 bước tr&ecirc;n, ch&uacute;ng ta mới chỉ khai b&aacute;o cho hệ thống biết&nbsp;loại lương, c&ocirc;ng việc tiếp theo ch&uacute;ng ta cần tiến h&agrave;nh l&agrave; khai b&aacute;o cho hệ thống biết c&aacute;c cột th&ocirc;ng tin trong&nbsp;loại lương<strong>&nbsp;</strong>đ&oacute; cần xử l&yacute;. Đ&acirc;y l&agrave; việc bắt buộc, nếu kh&ocirc;ng tiến h&agrave;nh bước n&agrave;y, hệ thống sẽ kh&ocirc;ng nhận được dữ liệu khi tạo bảng lương.&nbsp;</p>\r\n<p>Ch&uacute;ng ta lần lượt tiến h&agrave;nh c&aacute;c bước sau để khai b&aacute;o&nbsp;cấu h&igrave;nh cho loại lương</p>\r\n<p style=\"padding-left: 30px;\"><strong>Bước 5:&nbsp;</strong>Tiếp tục với bước 4 hoặc chọn&nbsp;loại lương cần cấu h&igrave;nh tại bản danh s&aacute;ch c&aacute;c loại lương</p>\r\n<p style=\"padding-left: 30px;\"><strong>Bước 6:&nbsp;</strong>Chọn&nbsp;<strong>Th&ecirc;m cấu h&igrave;nh</strong></p>\r\n<p style=\"padding-left: 30px;\"><strong>Bước 7:&nbsp;</strong>Điền c&aacute;c th&ocirc;ng tin tại form</p>\r\n<p style=\"padding-left: 60px;\">* Ti&ecirc;u đề cột</p>\r\n<p style=\"padding-left: 60px;\">* Vị tr&iacute; cột số</p>\r\n<p style=\"padding-left: 60px;\">* Thuộc loại lương</p>\r\n<p style=\"padding-left: 60px;\">* T&iacute;nh thuế</p>\r\n<p style=\"padding-left: 60px;\">* Bảo hiểm</p>\r\n<p style=\"padding-left: 60px;\">* Ẩn/hiện cột</p>\r\n<p style=\"padding-left: 60px;\">Giải th&iacute;ch th&ocirc;ng tin của c&aacute;c gi&aacute; trị tr&ecirc;n</p>\r\n<p style=\"padding-left: 90px;\">* Ti&ecirc;u đề cột</p>\r\n<p style=\"padding-left: 120px;\">T&ecirc;n ti&ecirc;u đề của cột cần lấy thống tin để nhập v&agrave;o hệ thống. V&iacute; dụ: Lương đợt 1, lương thực l&atilde;nh, ... T&ecirc;n ti&ecirc;u đề n&ecirc;n viết dễ hiểu, để biết được nguồn thu nhập n&agrave;y l&agrave; khoản n&agrave;o.</p>\r\n<p style=\"padding-left: 90px;\">* Vị tr&iacute; cột số</p>\r\n<p style=\"padding-left: 120px;\">X&aacute;c định gi&aacute; trị số của cột dữ liệu. Xem th&ecirc;m mục&nbsp;<strong>C3&nbsp;</strong>về c&aacute;ch x&aacute;c định</p>\r\n<p style=\"padding-left: 90px;\">* Ti&ecirc;u đề loại lương</p>\r\n<p style=\"padding-left: 120px;\">X&aacute;c định cột n&agrave;y thuộc về loại lương n&agrave;o</p>\r\n<p style=\"padding-left: 90px;\">* T&iacute;nh thuế</p>\r\n<p style=\"padding-left: 120px;\">Gi&aacute; trị cột n&agrave;y d&ugrave;ng để t&iacute;nh thuế hay kh&ocirc;ng</p>\r\n<p style=\"padding-left: 90px;\">* Bảo hiểm</p>\r\n<p style=\"padding-left: 120px;\">Gi&aacute; trị cột n&agrave;y d&ugrave;ng để t&iacute;nh bảo hiểm hay kh&ocirc;ng</p>\r\n<p style=\"padding-left: 90px;\">* Ẩn/hiện cột</p>\r\n<p style=\"padding-left: 120px;\">Gi&aacute; trị cột n&agrave;y c&oacute; được hiển thị đến người nhận lương hay kh&ocirc;ng</p>\r\n<p style=\"padding-left: 30px;\"><strong>Bước 8:&nbsp;</strong>Chọn&nbsp;<strong>Lưu</strong></p>\r\n<p>&nbsp;</p>\r\n<p style=\"padding-left: 30px;\">&nbsp;</p>\r\n<p>&nbsp;</p>',1467170548,'2016-06-29','2016-06-30'),(2,1,'Hướng dẫn tạo bảng lương','Hướng dẫn tạo bảng lương','<p><strong><span style=\"color: #ff0000;\">Nội dung b&agrave;i viết</span></strong></p>\r\n<ol style=\"list-style-type: upper-alpha;\">\r\n<li style=\"padding-left: 30px;\"><span style=\"color: #000000;\"><a href=\"#khai-niem\">Kh&aacute;i niệm</a></span></li>\r\n<li style=\"padding-left: 30px;\"><a href=\"#cac-diem-chu-y\">C&aacute;c điểm ch&uacute; &yacute;</a></li>\r\n<li style=\"padding-left: 30px;\"><a href=\"#cac-buoc-thuc-hien\">C&aacute;c bước thực hiện</a></li>\r\n</ol>\r\n<p><span style=\"color: #000000;\"><strong><span style=\"color: #ff0000;\">A. Kh&aacute;i niệm</span></strong><a id=\"khai-niem\"></a></span></p>\r\n<p><span style=\"color: #000000;\">Bất cứ c&aacute;c khoản thu nhập n&agrave;o được chi trả tới CBCNV (C&aacute;n bộ C&ocirc;ng nh&acirc;n vi&ecirc;n) đều phải được nhập v&agrave;o hệ thống. Dữ liệu bảng lương được tr&iacute;ch ra từ bộ phận kế to&aacute;n của trường.</span></p>\r\n<p><span style=\"color: #000000;\"><strong><span style=\"color: #ff0000;\">B. C&aacute;c điểm ch&uacute; &yacute;</span></strong><a id=\"cac-diem-chu-y\"></a></span></p>\r\n<ol>\r\n<li style=\"padding-left: 30px;\"><strong>Bảng lương</strong><br /><br />Phải độc lập dữ liệu. Nghĩa l&agrave;, file excel được nhập v&agrave;o hệ thống kh&ocirc;ng được li&ecirc;n kết dữ liệu đến file excel kh&aacute;c. N&oacute; phải mang c&aacute;c gi&aacute; trị độc lập v&agrave; t&aacute;ch biệt.<br /><br /></li>\r\n<li style=\"padding-left: 30px;\"><strong>Đảm bảo t&iacute;nh ch&iacute;nh x&aacute;c dữ liệu<br /><br /><br /></strong>Nhằm đảm bảo t&iacute;nh ch&iacute;nh x&aacute;c dữ liệu, khi tiến h&agrave;nh nhập v&agrave;o hệ thống, hệ thống sẽ y&ecirc;u cầu kiểm duyệt 1 lần nữa. Sau khi kiểm duyệt v&agrave; được x&eacute;t duyệt, l&uacute;c n&atilde;y, giao dịch mới được xem l&agrave; cập nhật th&agrave;nh c&ocirc;ng.</li>\r\n</ol>\r\n<p><span style=\"color: #000000;\"><span style=\"color: #ff0000;\"><strong>C. C&aacute;c bước thực hiện</strong></span><a id=\"cac-buoc-thuc-hien\"></a></span></p>\r\n<p><span style=\"color: #000000;\">Trước khi tạo bảng lương, cần chắc chắn rằng bạn đ&atilde; hiểu r&otilde; về loại lương cũng như đ&atilde; cấu h&igrave;nh th&agrave;nh c&ocirc;ng loại lương.</span></p>\r\n<p><span style=\"color: #000000;\">Thao t&aacute;c lần lượt c&aacute;c bước sau:</span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 1:</span></strong><span style=\"color: #000000;\"> Y&ecirc;u cầu đăng nhập v&agrave;o hệ thống với quyền quản trị</span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 2:&nbsp;</span></strong><span style=\"color: #000000;\">Đ&atilde; tạo loại lương tương th&iacute;ch với bảng lương dự kiến nhập v&agrave;o hệ thống</span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 3:</span></strong><span style=\"color: #000000;\"> Chọn&nbsp;<strong>HRM -&gt; Bảng lương -&gt; Th&ecirc;m bảng lương</strong></span></p>\r\n<p style=\"padding-left: 30px;\"><span style=\"color: #000000;\"><strong>Bước 4:&nbsp;</strong>Điền đầy đủ c&aacute;c th&ocirc;ng tin tại form</span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #000000;\">* Nội dung chuyển tiền</span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #000000;\">* M&ocirc; tả</span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #000000;\">* Ti&ecirc;u đề loại lương</span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #000000;\">* Trả lương ng&agrave;y</span></p>\r\n<p style=\"padding-left: 60px;\"><span style=\"color: #000000;\">* File đ&iacute;nh k&egrave;m</span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 5:&nbsp;</span></strong><span style=\"color: #000000;\">Chọn&nbsp;<strong>Lưu</strong></span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 6:&nbsp;</span></strong><span style=\"color: #000000;\">Dữ liệu trong file excel sẽ được hiển thị tr&ecirc;n hệ thống (nếu việc đọc th&agrave;nh c&ocirc;ng). L&uacute;c n&atilde;y người quản trị cần kiểm duyệt lại dữ liệu, để x&aacute;c thực dữ liệu đọc v&agrave;o l&agrave; ch&iacute;nh x&aacute;c.</span></p>\r\n<p style=\"padding-left: 30px;\"><strong><span style=\"color: #000000;\">Bước 7:</span></strong><span style=\"color: #000000;\">&nbsp;Kiểm duyệt dữ liệu</span></p>',1467261032,'2016-06-30','2016-06-30');
/*!40000 ALTER TABLE `payroll_supports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_type_fields`
--

DROP TABLE IF EXISTS `payroll_type_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_type_fields` (
  `payroll_type_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_type_id` int(11) NOT NULL,
  `payroll_type_field_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_type_field_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_type_field_val` tinyint(4) NOT NULL,
  `payroll_type_field_isvisible` tinyint(4) NOT NULL,
  `payroll_type_field_isinsurrance` tinyint(4) DEFAULT NULL,
  `payroll_type_field_isvat` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payroll_type_field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_type_fields`
--

LOCK TABLES `payroll_type_fields` WRITE;
/*!40000 ALTER TABLE `payroll_type_fields` DISABLE KEYS */;
INSERT INTO `payroll_type_fields` VALUES (1,1,'Thực lãnh','',6,1,0,1),(3,2,'Đợt 2','',30,1,0,0),(4,2,'Tổng tiền lương','',18,0,0,1),(5,2,'Bảo hiểm','',22,0,1,0),(6,3,'Thực lãnh','',18,1,0,0),(7,3,'Tính thuế','',14,0,0,1),(8,4,'Phụ cấp hành chính','',13,1,0,1),(9,5,'Lương căn bản đợt 1','',16,1,0,0);
/*!40000 ALTER TABLE `payroll_type_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_types`
--

DROP TABLE IF EXISTS `payroll_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_types` (
  `payroll_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_type_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_type_fromrow` tinyint(4) NOT NULL,
  `payroll_type_col_user` tinyint(4) NOT NULL,
  `payroll_type_file_template` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payroll_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_types`
--

LOCK TABLES `payroll_types` WRITE;
/*!40000 ALTER TABLE `payroll_types` DISABLE KEYS */;
INSERT INTO `payroll_types` VALUES (1,'Coi thi chấm thi',6,2,'1467957066.xls'),(2,'Lương căn bản',9,2,'1467957661.xlsx'),(3,'Thu nhập tăng thêm',7,2,'1468375468.xlsx'),(4,'Phụ cấp hành chính',8,2,'1468996023.xlsx'),(5,'Lương căn bản đợt 1',9,2,'1469516678.xlsx');
/*!40000 ALTER TABLE `payroll_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_users`
--

DROP TABLE IF EXISTS `payroll_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_users` (
  `payroll_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_uid` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_type_id` int(11) NOT NULL,
  `payroll_type_field_id` int(11) NOT NULL,
  `payroll_user_received` double DEFAULT NULL,
  `payroll_user_status` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`payroll_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1909 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_users`
--

LOCK TABLES `payroll_users` WRITE;
/*!40000 ALTER TABLE `payroll_users` DISABLE KEYS */;
INSERT INTO `payroll_users` VALUES (643,9,113,'HVCT113',4,8,720090,NULL),(644,9,114,'HVCT114',4,8,47970,NULL),(645,9,115,'HVCT115',4,8,889635,NULL),(646,9,116,'HVCT116',4,8,858584,NULL),(647,9,117,'HVCT117',4,8,709422,NULL),(648,9,118,'HVCT118',4,8,762381,NULL),(649,9,119,'HVCT119',4,8,696087,NULL),(650,9,120,'HVCT120',4,8,699135,NULL),(651,9,121,'HVCT121',4,8,760095,NULL),(652,9,245,'HVCT245',4,8,24030,NULL),(653,9,122,'HVCT122',4,8,697230,NULL),(654,9,123,'HVCT123',4,8,782955,NULL),(655,9,124,'HVCT124',4,8,826770,NULL),(656,9,125,'HVCT125',4,8,3697,NULL),(657,9,126,'HVCT126',4,8,696087,NULL),(658,9,127,'HVCT127',4,8,396240,NULL),(659,9,128,'HVCT128',4,8,883920.0000000001,NULL),(660,9,1,'HVCT101',4,8,826770,NULL),(661,9,129,'HVCT129',4,8,571500,NULL),(662,9,130,'HVCT130',4,8,571500,NULL),(663,9,131,'HVCT131',4,8,508635,NULL),(664,9,132,'HVCT132',4,8,657225,NULL),(665,9,133,'HVCT133',4,8,445770,NULL),(666,9,139,'HVCT139',4,8,782955,NULL),(667,9,140,'HVCT140',4,8,872490,NULL),(668,9,141,'HVCT141',4,8,872490,NULL),(669,9,142,'HVCT142',4,8,634365,NULL),(670,9,246,'HVCT246',4,8,27000,NULL),(671,9,143,'HVCT143',4,8,508635,NULL),(672,9,144,'HVCT144',4,8,571500,NULL),(673,9,145,'HVCT145',4,8,697230,NULL),(674,9,146,'HVCT146',4,8,508635,NULL),(675,9,147,'HVCT147',4,8,21060,NULL),(676,9,148,'HVCT148',4,8,720090,NULL),(677,9,149,'HVCT149',4,8,697230,NULL),(678,9,150,'HVCT150',4,8,508635,NULL),(679,9,151,'HVCT151',4,8,508635,NULL),(680,9,152,'HVCT152',4,8,508635,NULL),(681,9,153,'HVCT153',4,8,445770,NULL),(682,9,231,'HVCT231',4,8,508635,NULL),(955,11,110,'HVCT110',3,6,1376000,NULL),(956,11,111,'HVCT111',3,6,2138400,NULL),(957,11,112,'HVCT112',3,6,2138400,NULL),(958,11,113,'HVCT113',3,6,1663200,NULL),(959,11,114,'HVCT114',3,6,261818.1818181818,NULL),(960,11,115,'HVCT115',3,6,1425600,NULL),(961,11,116,'HVCT116',3,6,0,NULL),(962,11,117,'HVCT117',3,6,1188000,NULL),(963,11,118,'HVCT118',3,6,1188000,NULL),(964,11,119,'HVCT119',3,6,972000,NULL),(965,11,120,'HVCT120',3,6,1188000,NULL),(966,11,121,'HVCT121',3,6,918000,NULL),(967,11,122,'HVCT122',3,6,1188000,NULL),(968,11,123,'HVCT123',3,6,1512000,NULL),(969,11,124,'HVCT124',3,6,0,NULL),(970,11,125,'HVCT125',3,6,0,NULL),(971,11,126,'HVCT126',3,6,1188000,NULL),(972,11,127,'HVCT127',3,6,397606.3199999999,NULL),(973,11,128,'HVCT128',3,6,1663200,NULL),(974,11,1,'HVCT101',3,6,1425600,NULL),(975,11,129,'HVCT129',3,6,1188000,NULL),(976,11,130,'HVCT130',3,6,1188000,NULL),(977,11,131,'HVCT131',3,6,1188000,NULL),(978,11,132,'HVCT132',3,6,1436400,NULL),(979,11,133,'HVCT133',3,6,1134000,NULL),(980,11,134,'HVCT134',3,6,1188000,NULL),(981,11,135,'HVCT135',3,6,1188000,NULL),(982,11,136,'HVCT136',3,6,1188000,NULL),(983,11,137,'HVCT137',3,6,1188000,NULL),(984,11,138,'HVCT138',3,6,1188000,NULL),(985,11,139,'HVCT139',3,6,1663200,NULL),(986,11,140,'HVCT140',3,6,1134000,NULL),(987,11,141,'HVCT141',3,6,1188000,NULL),(988,11,142,'HVCT142',3,6,1188000,NULL),(989,11,246,'HVCT246',3,6,218181.8181818182,NULL),(990,11,143,'HVCT143',3,6,1134000,NULL),(991,11,144,'HVCT144',3,6,1188000,NULL),(992,11,145,'HVCT145',3,6,1188000,NULL),(993,11,146,'HVCT146',3,6,1188000,NULL),(994,11,147,'HVCT147',3,6,381818.1818181818,NULL),(995,11,148,'HVCT148',3,6,1663200,NULL),(996,11,149,'HVCT149',3,6,1188000,NULL),(997,11,150,'HVCT150',3,6,1188000,NULL),(998,11,151,'HVCT151',3,6,1026000,NULL),(999,11,152,'HVCT152',3,6,1188000,NULL),(1000,11,153,'HVCT153',3,6,1188000,NULL),(1001,11,154,'HVCT154',3,6,0,NULL),(1002,11,155,'HVCT155',3,6,0,NULL),(1003,11,156,'HVCT156',3,6,0,NULL),(1004,11,157,'HVCT157',3,6,218181.8181818182,NULL),(1005,11,159,'HVCT159',3,6,1200000,NULL),(1006,11,160,'HVCT160',3,6,0,NULL),(1007,11,161,'HVCT161',3,6,1663200,NULL),(1008,11,162,'HVCT162',3,6,1425600,NULL),(1009,11,163,'HVCT163',3,6,1306800,NULL),(1010,11,164,'HVCT164',3,6,1188000,NULL),(1011,11,165,'HVCT165',3,6,1188000,NULL),(1012,11,166,'HVCT166',3,6,1188000,NULL),(1013,11,167,'HVCT167',3,6,1188000,NULL),(1014,11,168,'HVCT168',3,6,1188000,NULL),(1015,11,169,'HVCT169',3,6,1200000,NULL),(1016,11,170,'HVCT170',3,6,1663200,NULL),(1017,11,171,'HVCT171',3,6,1188000,NULL),(1018,11,172,'HVCT172',3,6,1188000,NULL),(1019,11,173,'HVCT173',3,6,39400,NULL),(1020,11,174,'HVCT174',3,6,1188000,NULL),(1021,11,175,'HVCT175',3,6,1188000,NULL),(1022,11,176,'HVCT176',3,6,1188000,NULL),(1023,11,177,'HVCT177',3,6,1306800,NULL),(1024,11,178,'HVCT178',3,6,1188000,NULL),(1025,11,179,'HVCT179',3,6,1188000,NULL),(1026,11,180,'HVCT180',3,6,1188000,NULL),(1027,11,181,'HVCT181',3,6,1188000,NULL),(1028,11,182,'HVCT182',3,6,1306800,NULL),(1029,11,183,'HVCT183',3,6,1069200,NULL),(1030,11,184,'HVCT184',3,6,1069200,NULL),(1031,11,185,'HVCT185',3,6,1069200,NULL),(1032,11,186,'HVCT186',3,6,1069200,NULL),(1033,11,187,'HVCT187',3,6,1663200,NULL),(1034,11,188,'HVCT188',3,6,1188000,NULL),(1035,11,189,'HVCT189',3,6,1188000,NULL),(1036,11,190,'HVCT190',3,6,1188000,NULL),(1037,11,191,'HVCT191',3,6,1188000,NULL),(1038,11,192,'HVCT192',3,6,1306800,NULL),(1039,11,193,'HVCT193',3,6,1188000,NULL),(1040,11,194,'HVCT194',3,6,1306800,NULL),(1041,11,195,'HVCT195',3,6,1188000,NULL),(1042,11,196,'HVCT196',3,6,1188000,NULL),(1043,11,197,'HVCT197',3,6,1188000,NULL),(1044,11,198,'HVCT198',3,6,1188000,NULL),(1045,11,199,'HVCT199',3,6,1425600,NULL),(1046,11,200,'HVCT200',3,6,1425600,NULL),(1047,11,201,'HVCT201',3,6,1188000,NULL),(1048,11,202,'HVCT202',3,6,1188000,NULL),(1049,11,203,'HVCT203',3,6,1188000,NULL),(1050,11,204,'HVCT204',3,6,1188000,NULL),(1051,11,205,'HVCT205',3,6,1188000,NULL),(1052,11,206,'HVCT206',3,6,1188000,NULL),(1053,11,207,'HVCT207',3,6,1188000,NULL),(1054,11,208,'HVCT208',3,6,218181.8181818182,NULL),(1055,11,209,'HVCT209',3,6,1306800,NULL),(1056,11,210,'HVCT210',3,6,1188000,NULL),(1057,11,211,'HVCT211',3,6,1188000,NULL),(1058,11,212,'HVCT212',3,6,1188000,NULL),(1059,11,213,'HVCT213',3,6,1188000,NULL),(1060,11,214,'HVCT214',3,6,1188000,NULL),(1061,11,215,'HVCT215',3,6,1188000,NULL),(1062,11,216,'HVCT216',3,6,1188000,NULL),(1063,11,217,'HVCT217',3,6,1188000,NULL),(1064,11,218,'HVCT218',3,6,1188000,NULL),(1065,11,219,'HVCT219',3,6,1663200,NULL),(1066,11,220,'HVCT220',3,6,1188000,NULL),(1067,11,221,'HVCT221',3,6,1188000,NULL),(1068,11,222,'HVCT222',3,6,1306800,NULL),(1069,11,223,'HVCT223',3,6,1188000,NULL),(1070,11,224,'HVCT224',3,6,1306800,NULL),(1071,11,225,'HVCT225',3,6,1188000,NULL),(1072,11,226,'HVCT226',3,6,1188000,NULL),(1073,11,227,'HVCT227',3,6,1188000,NULL),(1074,11,228,'HVCT228',3,6,1306800,NULL),(1075,11,229,'HVCT229',3,6,1188000,NULL),(1076,11,230,'HVCT230',3,6,1188000,NULL),(1077,11,231,'HVCT231',3,6,1188000,NULL),(1078,11,232,'HVCT232',3,6,1188000,NULL),(1079,11,233,'HVCT233',3,6,1306800,NULL),(1080,11,234,'HVCT234',3,6,1188000,NULL),(1081,11,235,'HVCT235',3,6,1188000,NULL),(1082,11,236,'HVCT236',3,6,1188000,NULL),(1083,11,237,'HVCT237',3,6,1188000,NULL),(1084,11,238,'HVCT238',3,6,1188000,NULL),(1085,11,239,'HVCT239',3,6,1425600,NULL),(1086,11,240,'HVCT240',3,6,0,NULL),(1087,11,241,'HVCT241',3,6,1306800,NULL),(1088,11,242,'HVCT242',3,6,1188000,NULL),(1089,11,243,'HVCT243',3,6,1188000,NULL),(1090,11,244,'HVCT244',3,6,1425600,NULL),(1091,11,110,'HVCT110',3,7,2400000,NULL),(1092,11,111,'HVCT111',3,7,2160000,NULL),(1093,11,112,'HVCT112',3,7,2160000,NULL),(1094,11,113,'HVCT113',3,7,1680000,NULL),(1095,11,114,'HVCT114',3,7,261818.1818181818,NULL),(1096,11,115,'HVCT115',3,7,1440000,NULL),(1097,11,116,'HVCT116',3,7,0,NULL),(1098,11,117,'HVCT117',3,7,1200000,NULL),(1099,11,118,'HVCT118',3,7,1200000,NULL),(1100,11,119,'HVCT119',3,7,981818.1818181818,NULL),(1101,11,120,'HVCT120',3,7,1200000,NULL),(1102,11,121,'HVCT121',3,7,927272.7272727273,NULL),(1103,11,122,'HVCT122',3,7,1200000,NULL),(1104,11,123,'HVCT123',3,7,1527272.727272727,NULL),(1105,11,124,'HVCT124',3,7,0,NULL),(1106,11,125,'HVCT125',3,7,0,NULL),(1107,11,126,'HVCT126',3,7,1200000,NULL),(1108,11,127,'HVCT127',3,7,401622.5454545454,NULL),(1109,11,128,'HVCT128',3,7,1680000,NULL),(1110,11,1,'HVCT101',3,7,1440000,NULL),(1111,11,129,'HVCT129',3,7,1200000,NULL),(1112,11,130,'HVCT130',3,7,1200000,NULL),(1113,11,131,'HVCT131',3,7,1200000,NULL),(1114,11,132,'HVCT132',3,7,1450909.090909091,NULL),(1115,11,133,'HVCT133',3,7,1145454.545454545,NULL),(1116,11,134,'HVCT134',3,7,1200000,NULL),(1117,11,135,'HVCT135',3,7,1200000,NULL),(1118,11,136,'HVCT136',3,7,1200000,NULL),(1119,11,137,'HVCT137',3,7,1200000,NULL),(1120,11,138,'HVCT138',3,7,1200000,NULL),(1121,11,139,'HVCT139',3,7,1680000,NULL),(1122,11,140,'HVCT140',3,7,1145454.545454545,NULL),(1123,11,141,'HVCT141',3,7,1200000,NULL),(1124,11,142,'HVCT142',3,7,1200000,NULL),(1125,11,246,'HVCT246',3,7,218181.8181818182,NULL),(1126,11,143,'HVCT143',3,7,1145454.545454545,NULL),(1127,11,144,'HVCT144',3,7,1200000,NULL),(1128,11,145,'HVCT145',3,7,1200000,NULL),(1129,11,146,'HVCT146',3,7,1200000,NULL),(1130,11,147,'HVCT147',3,7,381818.1818181818,NULL),(1131,11,148,'HVCT148',3,7,1680000,NULL),(1132,11,149,'HVCT149',3,7,1200000,NULL),(1133,11,150,'HVCT150',3,7,1200000,NULL),(1134,11,151,'HVCT151',3,7,1036363.636363636,NULL),(1135,11,152,'HVCT152',3,7,1200000,NULL),(1136,11,153,'HVCT153',3,7,1200000,NULL),(1137,11,154,'HVCT154',3,7,0,NULL),(1138,11,155,'HVCT155',3,7,0,NULL),(1139,11,156,'HVCT156',3,7,0,NULL),(1140,11,157,'HVCT157',3,7,218181.8181818182,NULL),(1141,11,159,'HVCT159',3,7,1200000,NULL),(1142,11,160,'HVCT160',3,7,0,NULL),(1143,11,161,'HVCT161',3,7,1680000,NULL),(1144,11,162,'HVCT162',3,7,1440000,NULL),(1145,11,163,'HVCT163',3,7,1320000,NULL),(1146,11,164,'HVCT164',3,7,1200000,NULL),(1147,11,165,'HVCT165',3,7,1200000,NULL),(1148,11,166,'HVCT166',3,7,1200000,NULL),(1149,11,167,'HVCT167',3,7,1200000,NULL),(1150,11,168,'HVCT168',3,7,1200000,NULL),(1151,11,169,'HVCT169',3,7,1200000,NULL),(1152,11,170,'HVCT170',3,7,1680000,NULL),(1153,11,171,'HVCT171',3,7,1200000,NULL),(1154,11,172,'HVCT172',3,7,1200000,NULL),(1155,11,173,'HVCT173',3,7,60000,NULL),(1156,11,174,'HVCT174',3,7,1200000,NULL),(1157,11,175,'HVCT175',3,7,1200000,NULL),(1158,11,176,'HVCT176',3,7,1200000,NULL),(1159,11,177,'HVCT177',3,7,1320000,NULL),(1160,11,178,'HVCT178',3,7,1200000,NULL),(1161,11,179,'HVCT179',3,7,1200000,NULL),(1162,11,180,'HVCT180',3,7,1200000,NULL),(1163,11,181,'HVCT181',3,7,1200000,NULL),(1164,11,182,'HVCT182',3,7,1320000,NULL),(1165,11,183,'HVCT183',3,7,1080000,NULL),(1166,11,184,'HVCT184',3,7,1080000,NULL),(1167,11,185,'HVCT185',3,7,1080000,NULL),(1168,11,186,'HVCT186',3,7,1080000,NULL),(1169,11,187,'HVCT187',3,7,1680000,NULL),(1170,11,188,'HVCT188',3,7,1200000,NULL),(1171,11,189,'HVCT189',3,7,1200000,NULL),(1172,11,190,'HVCT190',3,7,1200000,NULL),(1173,11,191,'HVCT191',3,7,1200000,NULL),(1174,11,192,'HVCT192',3,7,1320000,NULL),(1175,11,193,'HVCT193',3,7,1200000,NULL),(1176,11,194,'HVCT194',3,7,1320000,NULL),(1177,11,195,'HVCT195',3,7,1200000,NULL),(1178,11,196,'HVCT196',3,7,1200000,NULL),(1179,11,197,'HVCT197',3,7,1200000,NULL),(1180,11,198,'HVCT198',3,7,1200000,NULL),(1181,11,199,'HVCT199',3,7,1440000,NULL),(1182,11,200,'HVCT200',3,7,1440000,NULL),(1183,11,201,'HVCT201',3,7,1200000,NULL),(1184,11,202,'HVCT202',3,7,1200000,NULL),(1185,11,203,'HVCT203',3,7,1200000,NULL),(1186,11,204,'HVCT204',3,7,1200000,NULL),(1187,11,205,'HVCT205',3,7,1200000,NULL),(1188,11,206,'HVCT206',3,7,1200000,NULL),(1189,11,207,'HVCT207',3,7,1200000,NULL),(1190,11,208,'HVCT208',3,7,218181.8181818182,NULL),(1191,11,209,'HVCT209',3,7,1320000,NULL),(1192,11,210,'HVCT210',3,7,1200000,NULL),(1193,11,211,'HVCT211',3,7,1200000,NULL),(1194,11,212,'HVCT212',3,7,1200000,NULL),(1195,11,213,'HVCT213',3,7,1200000,NULL),(1196,11,214,'HVCT214',3,7,1200000,NULL),(1197,11,215,'HVCT215',3,7,1200000,NULL),(1198,11,216,'HVCT216',3,7,1200000,NULL),(1199,11,217,'HVCT217',3,7,1200000,NULL),(1200,11,218,'HVCT218',3,7,1200000,NULL),(1201,11,219,'HVCT219',3,7,1680000,NULL),(1202,11,220,'HVCT220',3,7,1200000,NULL),(1203,11,221,'HVCT221',3,7,1200000,NULL),(1204,11,222,'HVCT222',3,7,1320000,NULL),(1205,11,223,'HVCT223',3,7,1200000,NULL),(1206,11,224,'HVCT224',3,7,1320000,NULL),(1207,11,225,'HVCT225',3,7,1200000,NULL),(1208,11,226,'HVCT226',3,7,1200000,NULL),(1209,11,227,'HVCT227',3,7,1200000,NULL),(1210,11,228,'HVCT228',3,7,1320000,NULL),(1211,11,229,'HVCT229',3,7,1200000,NULL),(1212,11,230,'HVCT230',3,7,1200000,NULL),(1213,11,231,'HVCT231',3,7,1200000,NULL),(1214,11,232,'HVCT232',3,7,1200000,NULL),(1215,11,233,'HVCT233',3,7,1320000,NULL),(1216,11,234,'HVCT234',3,7,1200000,NULL),(1217,11,235,'HVCT235',3,7,1200000,NULL),(1218,11,236,'HVCT236',3,7,1200000,NULL),(1219,11,237,'HVCT237',3,7,1200000,NULL),(1220,11,238,'HVCT238',3,7,1200000,NULL),(1221,11,239,'HVCT239',3,7,1440000,NULL),(1222,11,240,'HVCT240',3,7,0,NULL),(1223,11,241,'HVCT241',3,7,1320000,NULL),(1224,11,242,'HVCT242',3,7,1200000,NULL),(1225,11,243,'HVCT243',3,7,1200000,NULL),(1226,11,244,'HVCT244',3,7,1440000,NULL),(1364,13,110,'HVCT110',5,9,4000000,NULL),(1365,13,111,'HVCT111',5,9,5500000,NULL),(1366,13,112,'HVCT112',5,9,5000000,NULL),(1367,13,113,'HVCT113',5,9,3000000,NULL),(1368,13,114,'HVCT114',5,9,NULL,NULL),(1369,13,115,'HVCT115',5,9,3500000,NULL),(1370,13,116,'HVCT116',5,9,1000000,NULL),(1371,13,117,'HVCT117',5,9,2500000,NULL),(1372,13,118,'HVCT118',5,9,3000000,NULL),(1373,13,119,'HVCT119',5,9,2500000,NULL),(1374,13,120,'HVCT120',5,9,2500000,NULL),(1375,13,121,'HVCT121',5,9,2500000,NULL),(1376,13,122,'HVCT122',5,9,2500000,NULL),(1377,13,123,'HVCT123',5,9,3500000,NULL),(1378,13,124,'HVCT124',5,9,3500000,NULL),(1379,13,125,'HVCT125',5,9,NULL,NULL),(1380,13,126,'HVCT126',5,9,2500000,NULL),(1381,13,127,'HVCT127',5,9,1500000,NULL),(1382,13,128,'HVCT128',5,9,3500000,NULL),(1383,13,1,'HVCT101',5,9,3000000,NULL),(1384,13,129,'HVCT129',5,9,2000000,NULL),(1385,13,130,'HVCT130',5,9,2000000,NULL),(1386,13,131,'HVCT131',5,9,2000000,NULL),(1387,13,132,'HVCT132',5,9,2500000,NULL),(1388,13,133,'HVCT133',5,9,1800000,NULL),(1389,13,134,'HVCT134',5,9,3000000,NULL),(1390,13,135,'HVCT135',5,9,3000000,NULL),(1391,13,136,'HVCT136',5,9,3000000,NULL),(1392,13,137,'HVCT137',5,9,2500000,NULL),(1393,13,138,'HVCT138',5,9,2500000,NULL),(1394,13,139,'HVCT139',5,9,3500000,NULL),(1395,13,140,'HVCT140',5,9,3500000,NULL),(1396,13,141,'HVCT141',5,9,3500000,NULL),(1397,13,142,'HVCT142',5,9,3000000,NULL),(1398,13,246,'HVCT246',5,9,NULL,NULL),(1399,13,143,'HVCT143',5,9,2000000,NULL),(1400,13,144,'HVCT144',5,9,2000000,NULL),(1401,13,145,'HVCT145',5,9,2500000,NULL),(1402,13,146,'HVCT146',5,9,2000000,NULL),(1403,13,147,'HVCT147',5,9,NULL,NULL),(1404,13,148,'HVCT148',5,9,2500000,NULL),(1405,13,149,'HVCT149',5,9,2500000,NULL),(1406,13,150,'HVCT150',5,9,2000000,NULL),(1407,13,151,'HVCT151',5,9,2000000,NULL),(1408,13,152,'HVCT152',5,9,2000000,NULL),(1409,13,153,'HVCT153',5,9,1800000,NULL),(1410,13,154,'HVCT154',5,9,3500000,NULL),(1411,13,155,'HVCT155',5,9,3000000,NULL),(1412,13,156,'HVCT156',5,9,NULL,NULL),(1413,13,157,'HVCT157',5,9,NULL,NULL),(1414,13,158,'HVCT158',5,9,NULL,NULL),(1415,13,159,'HVCT159',5,9,2500000,NULL),(1416,13,160,'HVCT160',5,9,2500000,NULL),(1417,13,161,'HVCT161',5,9,5000000,NULL),(1418,13,162,'HVCT162',5,9,3500000,NULL),(1419,13,163,'HVCT163',5,9,5000000,NULL),(1420,13,164,'HVCT164',5,9,4500000,NULL),(1421,13,165,'HVCT165',5,9,3000000,NULL),(1422,13,166,'HVCT166',5,9,2500000,NULL),(1423,13,167,'HVCT167',5,9,2500000,NULL),(1424,13,168,'HVCT168',5,9,2500000,NULL),(1425,13,169,'HVCT169',5,9,2500000,NULL),(1426,13,170,'HVCT170',5,9,4000000,NULL),(1427,13,171,'HVCT171',5,9,3500000,NULL),(1428,13,172,'HVCT172',5,9,4000000,NULL),(1429,13,173,'HVCT173',5,9,3500000,NULL),(1430,13,174,'HVCT174',5,9,3000000,NULL),(1431,13,175,'HVCT175',5,9,3000000,NULL),(1432,13,176,'HVCT176',5,9,2500000,NULL),(1433,13,177,'HVCT177',5,9,3500000,NULL),(1434,13,178,'HVCT178',5,9,3000000,NULL),(1435,13,179,'HVCT179',5,9,2500000,NULL),(1436,13,180,'HVCT180',5,9,2500000,NULL),(1437,13,181,'HVCT181',5,9,2500000,NULL),(1438,13,182,'HVCT182',5,9,2500000,NULL),(1439,13,183,'HVCT183',5,9,2500000,NULL),(1440,13,184,'HVCT184',5,9,2500000,NULL),(1441,13,185,'HVCT185',5,9,2500000,NULL),(1442,13,186,'HVCT186',5,9,2500000,NULL),(1443,13,187,'HVCT187',5,9,6000000,NULL),(1444,13,188,'HVCT188',5,9,3500000,NULL),(1445,13,189,'HVCT189',5,9,3500000,NULL),(1446,13,190,'HVCT190',5,9,3000000,NULL),(1447,13,191,'HVCT191',5,9,3000000,NULL),(1448,13,192,'HVCT192',5,9,2500000,NULL),(1449,13,193,'HVCT193',5,9,2500000,NULL),(1450,13,194,'HVCT194',5,9,2500000,NULL),(1451,13,195,'HVCT195',5,9,3500000,NULL),(1452,13,196,'HVCT196',5,9,3000000,NULL),(1453,13,197,'HVCT197',5,9,2500000,NULL),(1454,13,198,'HVCT198',5,9,2500000,NULL),(1455,13,199,'HVCT199',5,9,3500000,NULL),(1456,13,200,'HVCT200',5,9,4800000,NULL),(1457,13,201,'HVCT201',5,9,4500000,NULL),(1458,13,202,'HVCT202',5,9,4000000,NULL),(1459,13,203,'HVCT203',5,9,4000000,NULL),(1460,13,204,'HVCT204',5,9,3500000,NULL),(1461,13,205,'HVCT205',5,9,3500000,NULL),(1462,13,206,'HVCT206',5,9,3000000,NULL),(1463,13,207,'HVCT207',5,9,2500000,NULL),(1464,13,208,'HVCT208',5,9,NULL,NULL),(1465,13,209,'HVCT209',5,9,4000000,NULL),(1466,13,210,'HVCT210',5,9,4500000,NULL),(1467,13,211,'HVCT211',5,9,3500000,NULL),(1468,13,212,'HVCT212',5,9,3500000,NULL),(1469,13,213,'HVCT213',5,9,4000000,NULL),(1470,13,214,'HVCT214',5,9,4000000,NULL),(1471,13,215,'HVCT215',5,9,3000000,NULL),(1472,13,216,'HVCT216',5,9,3000000,NULL),(1473,13,217,'HVCT217',5,9,3000000,NULL),(1474,13,218,'HVCT218',5,9,3000000,NULL),(1475,13,219,'HVCT219',5,9,5000000,NULL),(1476,13,220,'HVCT220',5,9,4000000,NULL),(1477,13,221,'HVCT221',5,9,3000000,NULL),(1478,13,222,'HVCT222',5,9,4000000,NULL),(1479,13,223,'HVCT223',5,9,4000000,NULL),(1480,13,224,'HVCT224',5,9,3500000,NULL),(1481,13,225,'HVCT225',5,9,3000000,NULL),(1482,13,226,'HVCT226',5,9,3500000,NULL),(1483,13,227,'HVCT227',5,9,3000000,NULL),(1484,13,228,'HVCT228',5,9,3000000,NULL),(1485,13,229,'HVCT229',5,9,3500000,NULL),(1486,13,230,'HVCT230',5,9,3500000,NULL),(1487,13,231,'HVCT231',5,9,2000000,NULL),(1488,13,232,'HVCT232',5,9,2000000,NULL),(1489,13,233,'HVCT233',5,9,3000000,NULL),(1490,13,234,'HVCT234',5,9,3500000,NULL),(1491,13,235,'HVCT235',5,9,3000000,NULL),(1492,13,236,'HVCT236',5,9,3000000,NULL),(1493,13,237,'HVCT237',5,9,2500000,NULL),(1494,13,238,'HVCT238',5,9,2500000,NULL),(1495,13,239,'HVCT239',5,9,3500000,NULL),(1496,13,240,'HVCT240',5,9,NULL,NULL),(1497,13,241,'HVCT241',5,9,2500000,NULL),(1498,13,242,'HVCT242',5,9,2500000,NULL),(1499,13,243,'HVCT243',5,9,2500000,NULL),(1500,13,244,'HVCT244',5,9,3500000,NULL),(1501,14,110,'HVCT110',2,3,418555.5,NULL),(1502,14,111,'HVCT111',2,3,2444516.15,NULL),(1503,14,112,'HVCT112',2,3,1742074.1,NULL),(1504,14,113,'HVCT113',2,3,1455855.5,NULL),(1505,14,114,'HVCT114',2,3,1734400,NULL),(1506,14,115,'HVCT115',2,3,1863869.5,NULL),(1507,14,116,'HVCT116',2,3,-1752614.35,NULL),(1508,14,117,'HVCT117',2,3,1487845.4,NULL),(1509,14,118,'HVCT118',2,3,1185541.7,NULL),(1510,14,119,'HVCT119',2,3,732679.7461538458,NULL),(1511,14,120,'HVCT120',2,3,1430019.5,NULL),(1512,14,121,'HVCT121',2,3,912691.5,NULL),(1513,14,122,'HVCT122',2,3,1219311,NULL),(1514,14,123,'HVCT123',2,3,1502086.2,NULL),(1515,14,124,'HVCT124',2,3,-0.1999999999097781,NULL),(1516,14,125,'HVCT125',2,3,0,NULL),(1517,14,126,'HVCT126',2,3,1412885.9,NULL),(1518,14,127,'HVCT127',2,3,0,NULL),(1519,14,128,'HVCT128',2,3,1496574,NULL),(1520,14,1,'HVCT101',2,3,1457489,NULL),(1521,14,129,'HVCT129',2,3,1122550,NULL),(1522,14,130,'HVCT130',2,3,1062550,NULL),(1523,14,131,'HVCT131',2,3,619169.5,NULL),(1524,14,132,'HVCT132',2,3,655376.923076923,NULL),(1525,14,133,'HVCT133',2,3,596889,NULL),(1526,14,134,'HVCT134',2,3,1774720.5,NULL),(1527,14,135,'HVCT135',2,3,1714720.5,NULL),(1528,14,136,'HVCT136',2,3,1051550,NULL),(1529,14,137,'HVCT137',2,3,715209,NULL),(1530,14,138,'HVCT138',2,3,1318379.5,NULL),(1531,14,139,'HVCT139',2,3,1516932.249999999,NULL),(1532,14,140,'HVCT140',2,3,981346.846153846,NULL),(1533,14,141,'HVCT141',2,3,1374493,NULL),(1534,14,142,'HVCT142',2,3,1464355.5,NULL),(1535,14,246,'HVCT246',2,3,1076276.923076923,NULL),(1536,14,143,'HVCT143',2,3,714911.8076923075,NULL),(1537,14,144,'HVCT144',2,3,1102550,NULL),(1538,14,145,'HVCT145',2,3,1389311,NULL),(1539,14,146,'HVCT146',2,3,649169.5,NULL),(1540,14,147,'HVCT147',2,3,1177900,NULL),(1541,14,148,'HVCT148',2,3,1560430.5,NULL),(1542,14,149,'HVCT149',2,3,1249311,NULL),(1543,14,150,'HVCT150',2,3,719169.5,NULL),(1544,14,151,'HVCT151',2,3,296396.423076923,NULL),(1545,14,152,'HVCT152',2,3,759169.5,NULL),(1546,14,153,'HVCT153',2,3,445789,NULL),(1547,14,154,'HVCT154',2,3,0,NULL),(1548,14,155,'HVCT155',2,3,0,NULL),(1549,14,156,'HVCT156',2,3,0,NULL),(1550,14,157,'HVCT157',2,3,298218.4615384615,NULL),(1551,14,159,'HVCT159',2,3,1330686.5,NULL),(1552,14,160,'HVCT160',2,3,0,NULL),(1553,14,161,'HVCT161',2,3,1864431.800000001,NULL),(1554,14,162,'HVCT162',2,3,1338430.5,NULL),(1555,14,163,'HVCT163',2,3,2375899.85,NULL),(1556,14,164,'HVCT164',2,3,1844263.8,NULL),(1557,14,165,'HVCT165',2,3,1131550,NULL),(1558,14,166,'HVCT166',2,3,1318379.5,NULL),(1559,14,167,'HVCT167',2,3,1188379.5,NULL),(1560,14,168,'HVCT168',2,3,805209,NULL),(1561,14,169,'HVCT169',2,3,883523,NULL),(1562,14,170,'HVCT170',2,3,1747560.5,NULL),(1563,14,171,'HVCT171',2,3,1618398.549999999,NULL),(1564,14,172,'HVCT172',2,3,1745787.65,NULL),(1565,14,173,'HVCT173',2,3,-3923076.5,NULL),(1566,14,174,'HVCT174',2,3,2166651.6,NULL),(1567,14,175,'HVCT175',2,3,2217891,NULL),(1568,14,176,'HVCT176',2,3,785209,NULL),(1569,14,177,'HVCT177',2,3,1223179.5,NULL),(1570,14,178,'HVCT178',2,3,1071550,NULL),(1571,14,179,'HVCT179',2,3,1328379.5,NULL),(1572,14,180,'HVCT180',2,3,715209,NULL),(1573,14,181,'HVCT181',2,3,845209,NULL),(1574,14,182,'HVCT182',2,3,1490879.5,NULL),(1575,14,183,'HVCT183',2,3,1138379.5,NULL),(1576,14,184,'HVCT184',2,3,1328379.5,NULL),(1577,14,185,'HVCT185',2,3,1138379.5,NULL),(1578,14,186,'HVCT186',2,3,1328379.5,NULL),(1579,14,187,'HVCT187',2,3,1861055.4,NULL),(1580,14,188,'HVCT188',2,3,1747891,NULL),(1581,14,189,'HVCT189',2,3,1487891,NULL),(1582,14,190,'HVCT190',2,3,1774720.5,NULL),(1583,14,191,'HVCT191',2,3,1301550,NULL),(1584,14,192,'HVCT192',2,3,1560879.5,NULL),(1585,14,193,'HVCT193',2,3,795209,NULL),(1586,14,194,'HVCT194',2,3,1510379.5,NULL),(1587,14,195,'HVCT195',2,3,1666651.6,NULL),(1588,14,196,'HVCT196',2,3,1584720.5,NULL),(1589,14,197,'HVCT197',2,3,725209,NULL),(1590,14,198,'HVCT198',2,3,705209,NULL),(1591,14,199,'HVCT199',2,3,1438430.5,NULL),(1592,14,200,'HVCT200',2,3,1359287.65,NULL),(1593,14,201,'HVCT201',2,3,1949931.8,NULL),(1594,14,202,'HVCT202',2,3,1755409.1,NULL),(1595,14,203,'HVCT203',2,3,1875409.1,NULL),(1596,14,204,'HVCT204',2,3,1747891,NULL),(1597,14,205,'HVCT205',2,3,1747891,NULL),(1598,14,206,'HVCT206',2,3,1301550,NULL),(1599,14,207,'HVCT207',2,3,1288379.5,NULL),(1600,14,208,'HVCT208',2,3,3243172.307692308,NULL),(1601,14,209,'HVCT209',2,3,2027909.1,NULL),(1602,14,210,'HVCT210',2,3,1989931.8,NULL),(1603,14,211,'HVCT211',2,3,1578398.549999999,NULL),(1604,14,212,'HVCT212',2,3,2257615.6,NULL),(1605,14,213,'HVCT213',2,3,1796166.199999999,NULL),(1606,14,214,'HVCT214',2,3,1721061.5,NULL),(1607,14,215,'HVCT215',2,3,2480891,NULL),(1608,14,216,'HVCT216',2,3,1301550,NULL),(1609,14,217,'HVCT217',2,3,1301550,NULL),(1610,14,218,'HVCT218',2,3,1261550,NULL),(1611,14,219,'HVCT219',2,3,2034431.800000001,NULL),(1612,14,220,'HVCT220',2,3,1757615.6,NULL),(1613,14,221,'HVCT221',2,3,1612805,NULL),(1614,14,222,'HVCT222',2,3,2098666.199999998,NULL),(1615,14,223,'HVCT223',2,3,1825787.65,NULL),(1616,14,224,'HVCT224',2,3,2005560.5,NULL),(1617,14,225,'HVCT225',2,3,1474303,NULL),(1618,14,226,'HVCT226',2,3,1747891,NULL),(1619,14,227,'HVCT227',2,3,1774720.5,NULL),(1620,14,228,'HVCT228',2,3,1604050,NULL),(1621,14,229,'HVCT229',2,3,1583060.5,NULL),(1622,14,230,'HVCT230',2,3,1738398.549999999,NULL),(1623,14,231,'HVCT231',2,3,859169.5,NULL),(1624,14,232,'HVCT232',2,3,1828379.5,NULL),(1625,14,233,'HVCT233',2,3,1574050,NULL),(1626,14,234,'HVCT234',2,3,1747891,NULL),(1627,14,235,'HVCT235',2,3,1301550,NULL),(1628,14,236,'HVCT236',2,3,1271550,NULL),(1629,14,237,'HVCT237',2,3,1328379.5,NULL),(1630,14,238,'HVCT238',2,3,855209,NULL),(1631,14,239,'HVCT239',2,3,1439928.5,NULL),(1632,14,240,'HVCT240',2,3,1054500,NULL),(1633,14,241,'HVCT241',2,3,1380879.5,NULL),(1634,14,242,'HVCT242',2,3,1108379.5,NULL),(1635,14,243,'HVCT243',2,3,715209,NULL),(1636,14,244,'HVCT244',2,3,1688220.5,NULL),(1637,14,110,'HVCT110',2,4,14633740,NULL),(1638,14,111,'HVCT111',2,4,8704740,NULL),(1639,14,112,'HVCT112',2,4,7702860,NULL),(1640,14,113,'HVCT113',2,4,5178800,NULL),(1641,14,114,'HVCT114',2,4,1984400,NULL),(1642,14,115,'HVCT115',2,4,6013700,NULL),(1643,14,116,'HVCT116',2,4,0,NULL),(1644,14,117,'HVCT117',2,4,4506040,NULL),(1645,14,118,'HVCT118',2,4,4842420,NULL),(1646,14,119,'HVCT119',2,4,3741133.846153846,NULL),(1647,14,120,'HVCT120',2,4,4440700,NULL),(1648,14,121,'HVCT121',2,4,4827900,NULL),(1649,14,122,'HVCT122',2,4,4428600,NULL),(1650,14,123,'HVCT123',2,4,5592620,NULL),(1651,14,124,'HVCT124',2,4,4155118,NULL),(1652,14,125,'HVCT125',2,4,0,NULL),(1653,14,126,'HVCT126',2,4,4421340,NULL),(1654,14,127,'HVCT127',2,4,1789432,NULL),(1655,14,128,'HVCT128',2,4,5614400,NULL),(1656,14,1,'HVCT101',2,4,5251400,NULL),(1657,14,129,'HVCT129',2,4,3630000,NULL),(1658,14,130,'HVCT130',2,4,3630000,NULL),(1659,14,131,'HVCT131',2,4,3230700,NULL),(1660,14,132,'HVCT132',2,4,3692826.923076923,NULL),(1661,14,133,'HVCT133',2,4,2722500,NULL),(1662,14,134,'HVCT134',2,4,5238090,NULL),(1663,14,135,'HVCT135',2,4,5238090,NULL),(1664,14,136,'HVCT136',2,4,4719000,NULL),(1665,14,137,'HVCT137',2,4,3680820,NULL),(1666,14,138,'HVCT138',2,4,4199910,NULL),(1667,14,139,'HVCT139',2,4,5668849.999999999,NULL),(1668,14,140,'HVCT140',2,4,5328653.846153846,NULL),(1669,14,141,'HVCT141',2,4,5541800,NULL),(1670,14,142,'HVCT142',2,4,4997300,NULL),(1671,14,246,'HVCT246',2,4,1206276.923076923,NULL),(1672,14,143,'HVCT143',2,4,3106442.307692308,NULL),(1673,14,144,'HVCT144',2,4,3630000,NULL),(1674,14,145,'HVCT145',2,4,4428600,NULL),(1675,14,146,'HVCT146',2,4,3230700,NULL),(1676,14,147,'HVCT147',2,4,1197900,NULL),(1677,14,148,'HVCT148',2,4,4573800,NULL),(1678,14,149,'HVCT149',2,4,4428600,NULL),(1679,14,150,'HVCT150',2,4,3230700,NULL),(1680,14,151,'HVCT151',2,4,2857926.923076923,NULL),(1681,14,152,'HVCT152',2,4,3230700,NULL),(1682,14,153,'HVCT153',2,4,2831400,NULL),(1683,14,154,'HVCT154',2,4,4139902,NULL),(1684,14,155,'HVCT155',2,4,3477450,NULL),(1685,14,156,'HVCT156',2,4,0,NULL),(1686,14,157,'HVCT157',2,4,298218.4615384615,NULL),(1687,14,159,'HVCT159',2,4,4199910,NULL),(1688,14,160,'HVCT160',2,4,2927297,NULL),(1689,14,161,'HVCT161',2,4,7689550.000000001,NULL),(1690,14,162,'HVCT162',2,4,5541800,NULL),(1691,14,163,'HVCT163',2,4,8091270,NULL),(1692,14,164,'HVCT164',2,4,7048250,NULL),(1693,14,165,'HVCT165',2,4,4719000,NULL),(1694,14,166,'HVCT166',2,4,4199910,NULL),(1695,14,167,'HVCT167',2,4,4199910,NULL),(1696,14,168,'HVCT168',2,4,3680820,NULL),(1697,14,169,'HVCT169',2,4,3680820,NULL),(1698,14,170,'HVCT170',2,4,6266590,NULL),(1699,14,171,'HVCT171',2,4,5762019.999999999,NULL),(1700,14,172,'HVCT172',2,4,6421470,NULL),(1701,14,173,'HVCT173',2,4,0,NULL),(1702,14,174,'HVCT174',2,4,5680950,NULL),(1703,14,175,'HVCT175',2,4,5757180,NULL),(1704,14,176,'HVCT176',2,4,3680820,NULL),(1705,14,177,'HVCT177',2,4,5348200,NULL),(1706,14,178,'HVCT178',2,4,4719000,NULL),(1707,14,179,'HVCT179',2,4,4199910,NULL),(1708,14,180,'HVCT180',2,4,3680820,NULL),(1709,14,181,'HVCT181',2,4,3680820,NULL),(1710,14,182,'HVCT182',2,4,4502410,NULL),(1711,14,183,'HVCT183',2,4,4199910,NULL),(1712,14,184,'HVCT184',2,4,4199910,NULL),(1713,14,185,'HVCT185',2,4,4199910,NULL),(1714,14,186,'HVCT186',2,4,4199910,NULL),(1715,14,187,'HVCT187',2,4,8657550,NULL),(1716,14,188,'HVCT188',2,4,5757180,NULL),(1717,14,189,'HVCT189',2,4,5757180,NULL),(1718,14,190,'HVCT190',2,4,5238090,NULL),(1719,14,191,'HVCT191',2,4,4719000,NULL),(1720,14,192,'HVCT192',2,4,4502410,NULL),(1721,14,193,'HVCT193',2,4,3680820,NULL),(1722,14,194,'HVCT194',2,4,4441910,NULL),(1723,14,195,'HVCT195',2,4,5680950,NULL),(1724,14,196,'HVCT196',2,4,5238090,NULL),(1725,14,197,'HVCT197',2,4,3680820,NULL),(1726,14,198,'HVCT198',2,4,3680820,NULL),(1727,14,199,'HVCT199',2,4,5541800,NULL),(1728,14,200,'HVCT200',2,4,6844970,NULL),(1729,14,201,'HVCT201',2,4,7145050,NULL),(1730,14,202,'HVCT202',2,4,6466240,NULL),(1731,14,203,'HVCT203',2,4,6466240,NULL),(1732,14,204,'HVCT204',2,4,5757180,NULL),(1733,14,205,'HVCT205',2,4,5757180,NULL),(1734,14,206,'HVCT206',2,4,4719000,NULL),(1735,14,207,'HVCT207',2,4,4199910,NULL),(1736,14,208,'HVCT208',2,4,3243172.307692308,NULL),(1737,14,209,'HVCT209',2,4,6768740,NULL),(1738,14,210,'HVCT210',2,4,7145050,NULL),(1739,14,211,'HVCT211',2,4,5762019.999999999,NULL),(1740,14,212,'HVCT212',2,4,6333140,NULL),(1741,14,213,'HVCT213',2,4,6376699.999999999,NULL),(1742,14,214,'HVCT214',2,4,6276270,NULL),(1743,14,215,'HVCT215',2,4,6120180,NULL),(1744,14,216,'HVCT216',2,4,4719000,NULL),(1745,14,217,'HVCT217',2,4,4719000,NULL),(1746,14,218,'HVCT218',2,4,4719000,NULL),(1747,14,219,'HVCT219',2,4,7689550.000000001,NULL),(1748,14,220,'HVCT220',2,4,6333140,NULL),(1749,14,221,'HVCT221',2,4,5082000,NULL),(1750,14,222,'HVCT222',2,4,6679199.999999999,NULL),(1751,14,223,'HVCT223',2,4,6421470,NULL),(1752,14,224,'HVCT224',2,4,6024590,NULL),(1753,14,225,'HVCT225',2,4,4936800,NULL),(1754,14,226,'HVCT226',2,4,5757180,NULL),(1755,14,227,'HVCT227',2,4,5238090,NULL),(1756,14,228,'HVCT228',2,4,5021500,NULL),(1757,14,229,'HVCT229',2,4,5722090,NULL),(1758,14,230,'HVCT230',2,4,5762019.999999999,NULL),(1759,14,231,'HVCT231',2,4,3230700,NULL),(1760,14,232,'HVCT232',2,4,4199910,NULL),(1761,14,233,'HVCT233',2,4,5021500,NULL),(1762,14,234,'HVCT234',2,4,5757180,NULL),(1763,14,235,'HVCT235',2,4,4719000,NULL),(1764,14,236,'HVCT236',2,4,4719000,NULL),(1765,14,237,'HVCT237',2,4,4199910,NULL),(1766,14,238,'HVCT238',2,4,3680820,NULL),(1767,14,239,'HVCT239',2,4,5396600,NULL),(1768,14,240,'HVCT240',2,4,1089000,NULL),(1769,14,241,'HVCT241',2,4,4502410,NULL),(1770,14,242,'HVCT242',2,4,4199910,NULL),(1771,14,243,'HVCT243',2,4,3680820,NULL),(1772,14,244,'HVCT244',2,4,5661590,NULL),(1773,14,110,'HVCT110',2,5,1104669.5,NULL),(1774,14,111,'HVCT111',2,5,697123.35,NULL),(1775,14,112,'HVCT112',2,5,642618.9,NULL),(1776,14,113,'HVCT113',2,5,486601.5,NULL),(1777,14,114,'HVCT114',2,5,0,NULL),(1778,14,115,'HVCT115',2,5,593323.5,NULL),(1779,14,116,'HVCT116',2,5,572614.35,NULL),(1780,14,117,'HVCT117',2,5,473134.2,NULL),(1781,14,118,'HVCT118',2,5,508454.1,NULL),(1782,14,119,'HVCT119',2,5,464240.7,NULL),(1783,14,120,'HVCT120',2,5,466273.5,NULL),(1784,14,121,'HVCT121',2,5,506929.5,NULL),(1785,14,122,'HVCT122',2,5,465003,NULL),(1786,14,123,'HVCT123',2,5,530052.6000000001,NULL),(1787,14,124,'HVCT124',2,5,598151.4,NULL),(1788,14,125,'HVCT125',2,5,NULL,NULL),(1789,14,126,'HVCT126',2,5,464240.7,NULL),(1790,14,127,'HVCT127',2,5,264264,NULL),(1791,14,128,'HVCT128',2,5,564102.0000000001,NULL),(1792,14,1,'HVCT101',2,5,551397,NULL),(1793,14,129,'HVCT129',2,5,381150,NULL),(1794,14,130,'HVCT130',2,5,381150,NULL),(1795,14,131,'HVCT131',2,5,339223.5,NULL),(1796,14,132,'HVCT132',2,5,381150,NULL),(1797,14,133,'HVCT133',2,5,297297,NULL),(1798,14,134,'HVCT134',2,5,423076.5,NULL),(1799,14,135,'HVCT135',2,5,423076.5,NULL),(1800,14,136,'HVCT136',2,5,381150,NULL),(1801,14,137,'HVCT137',2,5,297297,NULL),(1802,14,138,'HVCT138',2,5,339223.5,NULL),(1803,14,139,'HVCT139',2,5,595229.2500000001,NULL),(1804,14,140,'HVCT140',2,5,581889,NULL),(1805,14,141,'HVCT141',2,5,581889,NULL),(1806,14,142,'HVCT142',2,5,486601.5,NULL),(1807,14,246,'HVCT246',2,5,0,NULL),(1808,14,143,'HVCT143',2,5,339223.5,NULL),(1809,14,144,'HVCT144',2,5,381150,NULL),(1810,14,145,'HVCT145',2,5,465003,NULL),(1811,14,146,'HVCT146',2,5,339223.5,NULL),(1812,14,147,'HVCT147',2,5,0,NULL),(1813,14,148,'HVCT148',2,5,423076.5,NULL),(1814,14,149,'HVCT149',2,5,465003,NULL),(1815,14,150,'HVCT150',2,5,339223.5,NULL),(1816,14,151,'HVCT151',2,5,339223.5,NULL),(1817,14,152,'HVCT152',2,5,339223.5,NULL),(1818,14,153,'HVCT153',2,5,297297,NULL),(1819,14,154,'HVCT154',2,5,492954,NULL),(1820,14,155,'HVCT155',2,5,381150,NULL),(1821,14,156,'HVCT156',2,5,0,NULL),(1822,14,157,'HVCT157',2,5,0,NULL),(1823,14,159,'HVCT159',2,5,339223.5,NULL),(1824,14,160,'HVCT160',2,5,297297,NULL),(1825,14,161,'HVCT161',2,5,598151.4,NULL),(1826,14,162,'HVCT162',2,5,423076.5,NULL),(1827,14,163,'HVCT163',2,5,653164.0499999999,NULL),(1828,14,164,'HVCT164',2,5,587987.4,NULL),(1829,14,165,'HVCT165',2,5,381150,NULL),(1830,14,166,'HVCT166',2,5,339223.5,NULL),(1831,14,167,'HVCT167',2,5,339223.5,NULL),(1832,14,168,'HVCT168',2,5,297297,NULL),(1833,14,169,'HVCT169',2,5,297297,NULL),(1834,14,170,'HVCT170',2,5,473896.5,NULL),(1835,14,171,'HVCT171',2,5,478089.15,NULL),(1836,14,172,'HVCT172',2,5,534753.4500000001,NULL),(1837,14,173,'HVCT173',2,5,423076.5,NULL),(1838,14,174,'HVCT174',2,5,469576.7999999999,NULL),(1839,14,175,'HVCT175',2,5,465003,NULL),(1840,14,176,'HVCT176',2,5,297297,NULL),(1841,14,177,'HVCT177',2,5,415453.5,NULL),(1842,14,178,'HVCT178',2,5,381150,NULL),(1843,14,179,'HVCT179',2,5,339223.5,NULL),(1844,14,180,'HVCT180',2,5,297297,NULL),(1845,14,181,'HVCT181',2,5,297297,NULL),(1846,14,182,'HVCT182',2,5,339223.5,NULL),(1847,14,183,'HVCT183',2,5,339223.5,NULL),(1848,14,184,'HVCT184',2,5,339223.5,NULL),(1849,14,185,'HVCT185',2,5,339223.5,NULL),(1850,14,186,'HVCT186',2,5,339223.5,NULL),(1851,14,187,'HVCT187',2,5,727234.2,NULL),(1852,14,188,'HVCT188',2,5,465003,NULL),(1853,14,189,'HVCT189',2,5,465003,NULL),(1854,14,190,'HVCT190',2,5,423076.5,NULL),(1855,14,191,'HVCT191',2,5,381150,NULL),(1856,14,192,'HVCT192',2,5,339223.5,NULL),(1857,14,193,'HVCT193',2,5,297297,NULL),(1858,14,194,'HVCT194',2,5,339223.5,NULL),(1859,14,195,'HVCT195',2,5,469576.7999999999,NULL),(1860,14,196,'HVCT196',2,5,423076.5,NULL),(1861,14,197,'HVCT197',2,5,297297,NULL),(1862,14,198,'HVCT198',2,5,297297,NULL),(1863,14,199,'HVCT199',2,5,423076.5,NULL),(1864,14,200,'HVCT200',2,5,534753.4500000001,NULL),(1865,14,201,'HVCT201',2,5,598151.4,NULL),(1866,14,202,'HVCT202',2,5,539454.3000000002,NULL),(1867,14,203,'HVCT203',2,5,539454.3000000002,NULL),(1868,14,204,'HVCT204',2,5,465003,NULL),(1869,14,205,'HVCT205',2,5,465003,NULL),(1870,14,206,'HVCT206',2,5,381150,NULL),(1871,14,207,'HVCT207',2,5,339223.5,NULL),(1872,14,208,'HVCT208',2,5,0,NULL),(1873,14,209,'HVCT209',2,5,539454.3000000002,NULL),(1874,14,210,'HVCT210',2,5,598151.4,NULL),(1875,14,211,'HVCT211',2,5,478089.15,NULL),(1876,14,212,'HVCT212',2,5,525478.7999999999,NULL),(1877,14,213,'HVCT213',2,5,530052.6000000001,NULL),(1878,14,214,'HVCT214',2,5,506929.5,NULL),(1879,14,215,'HVCT215',2,5,465003,NULL),(1880,14,216,'HVCT216',2,5,381150,NULL),(1881,14,217,'HVCT217',2,5,381150,NULL),(1882,14,218,'HVCT218',2,5,381150,NULL),(1883,14,219,'HVCT219',2,5,598151.4,NULL),(1884,14,220,'HVCT220',2,5,525478.7999999999,NULL),(1885,14,221,'HVCT221',2,5,419265,NULL),(1886,14,222,'HVCT222',2,5,530052.6000000001,NULL),(1887,14,223,'HVCT223',2,5,534753.4500000001,NULL),(1888,14,224,'HVCT224',2,5,473896.5,NULL),(1889,14,225,'HVCT225',2,5,404019,NULL),(1890,14,226,'HVCT226',2,5,465003,NULL),(1891,14,227,'HVCT227',2,5,423076.5,NULL),(1892,14,228,'HVCT228',2,5,381150,NULL),(1893,14,229,'HVCT229',2,5,473896.5,NULL),(1894,14,230,'HVCT230',2,5,478089.15,NULL),(1895,14,231,'HVCT231',2,5,339223.5,NULL),(1896,14,232,'HVCT232',2,5,339223.5,NULL),(1897,14,233,'HVCT233',2,5,381150,NULL),(1898,14,234,'HVCT234',2,5,465003,NULL),(1899,14,235,'HVCT235',2,5,381150,NULL),(1900,14,236,'HVCT236',2,5,381150,NULL),(1901,14,237,'HVCT237',2,5,339223.5,NULL),(1902,14,238,'HVCT238',2,5,297297,NULL),(1903,14,239,'HVCT239',2,5,407830.5,NULL),(1904,14,240,'HVCT240',2,5,0,NULL),(1905,14,241,'HVCT241',2,5,339223.5,NULL),(1906,14,242,'HVCT242',2,5,339223.5,NULL),(1907,14,243,'HVCT243',2,5,297297,NULL),(1908,14,244,'HVCT244',2,5,423076.5,NULL);
/*!40000 ALTER TABLE `payroll_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payrolls`
--

DROP TABLE IF EXISTS `payrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payrolls` (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll_description` text COLLATE utf8_unicode_ci NOT NULL,
  `payroll_excel_filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payroll_type_id` int(11) NOT NULL,
  `payroll_date` int(11) NOT NULL,
  `payroll_date_trans` int(11) NOT NULL,
  `payroll_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payrolls`
--

LOCK TABLES `payrolls` WRITE;
/*!40000 ALTER TABLE `payrolls` DISABLE KEYS */;
INSERT INTO `payrolls` VALUES (9,'Phụ cấp hành chính tháng 6 năm 2016','<p>Phụ cấp h&agrave;nh ch&iacute;nh th&aacute;ng 6 năm 2016</p>','1468996809.xlsx',4,1467306000,1467738000,1,'2016-07-20 06:40:28','2016-07-20 17:40:28'),(11,'Thu nhập tăng thêm tháng 6 năm 2016','<p>Thu nhập tăng th&ecirc;m th&aacute;ng 6 năm 2016 theo HP023 v&agrave; QUY036 ng&agrave;y 06/07/2016</p>','1469515894.xlsx',3,1467738000,1468170000,1,'2016-07-26 06:52:26','2016-07-26 17:52:26'),(13,'Lương căn bản đợt 1 tháng 6 năm 2016','<p>Lương căn bản đợt 1 th&aacute;ng 6 năm 2016 RDT0146 ng&agrave;y 08/6/2016</p>','1469519053.xlsx',5,1465318800,1465491600,1,'2016-07-26 07:44:45','2016-07-26 18:44:45'),(14,'Lương căn bản đợt 2 tháng 6 năm 2016','<p>Lương căn bản đợt 2 th&aacute;ng 6 năm 2016 RDT0177 ng&agrave;y 05/7/2016</p>','1469520089.xlsx',2,1467651600,1468170000,1,'2016-07-26 08:11:20','2016-07-26 19:11:20');
/*!40000 ALTER TABLE `payrolls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'superadmin','_superadmin',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(2,'user editor','_user-editor',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(3,'group editor','_group-editor',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(4,'permission editor','_permission-editor',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(5,'profile type editor','_profile-editor',0,'2016-05-27 23:42:09','2016-05-27 23:42:09'),(11,'HRM admin','_hrm-admin',0,'2016-05-28 03:44:44','2016-05-28 03:44:44'),(12,'HRM user','_hrm-user',0,'2016-05-28 03:44:53','2016-05-28 03:44:53');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
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
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profile_field_profile_id_profile_field_type_id_unique` (`profile_id`,`profile_field_type_id`),
  KEY `profile_field_profile_field_type_id_foreign` (`profile_field_type_id`),
  CONSTRAINT `profile_field_profile_field_type_id_foreign` FOREIGN KEY (`profile_field_type_id`) REFERENCES `profile_field_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profile_field_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `user_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
-- Table structure for table `school_courses`
--

DROP TABLE IF EXISTS `school_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_courses` (
  `school_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_course_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`school_course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_courses`
--

LOCK TABLES `school_courses` WRITE;
/*!40000 ALTER TABLE `school_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `school_courses` ENABLE KEYS */;
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
  `school_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_category_id` int(11) DEFAULT NULL,
  `school_level_id` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_id_1` int(11) DEFAULT NULL,
  `option_id_2` int(11) DEFAULT NULL,
  `option_id_3` int(11) DEFAULT NULL,
  `school_code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_upload_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
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
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL),(2,2,'127.0.0.1',0,0,0,NULL,NULL,NULL),(3,3,'127.0.0.1',0,0,0,NULL,NULL,NULL),(4,1,'192.168.1.8',0,0,0,NULL,NULL,NULL),(5,1,'192.168.1.49',0,0,0,NULL,NULL,NULL),(6,1,'192.168.1.5',0,0,0,NULL,NULL,NULL),(7,3,'192.168.1.5',0,0,0,NULL,NULL,NULL),(8,1,'192.168.1.6',0,0,0,NULL,NULL,NULL),(9,3,'192.168.1.6',0,0,0,NULL,NULL,NULL),(10,3,'192.168.1.8',0,0,0,NULL,NULL,NULL),(11,1,'192.168.1.3',0,0,0,NULL,NULL,NULL),(12,2,'192.168.1.3',0,0,0,NULL,NULL,NULL),(13,9,'192.168.1.8',0,0,0,NULL,NULL,NULL),(14,9,'192.168.1.7',0,0,0,NULL,NULL,NULL),(15,7,'127.0.0.1',0,0,0,NULL,NULL,NULL),(16,9,'192.168.1.4',0,0,0,NULL,NULL,NULL),(17,7,'192.168.1.4',0,0,0,NULL,NULL,NULL),(18,10,'192.168.1.4',0,0,0,NULL,NULL,NULL),(19,1,'192.168.1.4',0,0,0,NULL,NULL,NULL),(20,2,'192.168.1.4',0,0,0,NULL,NULL,NULL),(21,11,'127.0.0.1',0,0,0,NULL,NULL,NULL),(22,1,'::1',0,0,0,NULL,NULL,NULL),(23,2,'192.168.1.8',0,0,0,NULL,NULL,NULL),(24,12,'127.0.0.1',0,0,0,NULL,NULL,NULL),(25,1,'172.17.20.107',0,0,0,NULL,NULL,NULL),(26,14,'172.17.20.107',0,0,0,NULL,NULL,NULL),(27,100,'127.0.0.1',0,0,0,NULL,NULL,NULL),(28,102,'127.0.0.1',0,0,0,NULL,NULL,NULL),(29,115,'127.0.0.1',0,0,0,NULL,NULL,NULL),(30,2,'192.168.200.1',0,0,0,NULL,NULL,NULL),(31,1,'192.168.200.1',4,0,0,'2016-07-19 15:44:17',NULL,NULL),(32,2,'192.168.100.1',0,0,0,NULL,NULL,NULL),(33,111,'192.168.200.1',0,0,0,NULL,NULL,NULL),(34,111,'192.168.100.1',0,0,0,NULL,NULL,NULL);
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
  `code` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profile_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,1,'',NULL,'Đào Thị Cẩm','Nhung','','','','','','',NULL,'2016-05-27 23:42:10','2016-07-01 03:20:14'),(2,2,NULL,NULL,'Trưởng phòng kế toán','','',NULL,'',NULL,NULL,'',NULL,'2016-05-28 03:43:05','2016-07-08 05:09:39'),(19,105,NULL,NULL,'NV1 Phòng kế toán',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-07 23:49:45','2016-07-07 23:49:45'),(20,109,NULL,NULL,'NV2 Phòng kế toán',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 00:45:49','2016-07-08 00:45:49'),(21,110,NULL,NULL,'Nguyễn Thị','Hằng','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:46:51','2016-07-08 00:47:24'),(22,111,NULL,NULL,'Trần Viết','Phú','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:48:55','2016-07-08 03:12:44'),(23,112,NULL,NULL,'Bùi Văn','Trí','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:50:14','2016-07-08 03:13:09'),(24,113,NULL,NULL,'Nguyễn Thị','Sang','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:50:42','2016-07-08 03:13:34'),(25,114,NULL,NULL,'Trần Duy','Đồng','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:51:06','2016-07-08 03:13:55'),(26,115,NULL,NULL,'Trần Đức','Tuấn','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:51:29','2016-07-08 05:06:53'),(27,116,NULL,NULL,'Nguyễn','Vinh','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:51:49','2016-07-08 03:14:43'),(28,117,NULL,NULL,'Võ','Chi','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:53:56','2016-07-08 03:15:00'),(29,118,NULL,NULL,'Trương Văn','Ánh','',NULL,'',NULL,NULL,'',NULL,'2016-07-08 00:54:37','2016-07-08 03:15:25'),(30,119,NULL,NULL,'Võ Văn','Nam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 00:55:33','2016-07-08 00:55:33'),(31,120,NULL,NULL,'Bùi Anh','Tuấn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 00:55:57','2016-07-08 00:55:57'),(32,121,NULL,NULL,'Trần Thị Quyền','Linh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:12:58','2016-07-08 02:12:58'),(33,122,NULL,NULL,'Phạm Thị','Huệ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:13:26','2016-07-08 02:13:26'),(34,123,NULL,NULL,'Nguyễn Ánh Vân','Hà',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:13:53','2016-07-08 02:13:53'),(35,124,NULL,NULL,'Lê Thị Thanh','An',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:14:18','2016-07-08 02:14:18'),(36,125,NULL,NULL,'Đinh Như','Quỳnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:14:41','2016-07-08 02:14:41'),(37,126,NULL,NULL,'Lê Văn','Quỳnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:15:07','2016-07-08 02:15:07'),(38,127,NULL,NULL,'Trần Thị','Tuyết',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:15:41','2016-07-08 02:15:41'),(39,128,NULL,NULL,'Nguyễn Văn','Toàn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:16:19','2016-07-08 02:16:19'),(40,129,NULL,NULL,'Lê Thị Thanh','Thúy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:16:59','2016-07-08 02:16:59'),(41,130,NULL,NULL,'Nguyễn Thị Huyền','My',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:17:26','2016-07-08 02:17:26'),(42,131,NULL,NULL,'Hoàng Thị','Nga',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:17:50','2016-07-08 02:17:50'),(43,132,NULL,NULL,'Phạm Hồng','Thắng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:18:09','2016-07-08 02:18:09'),(44,133,NULL,NULL,'Nguyễn Thị','Vân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:18:28','2016-07-08 02:18:28'),(45,134,NULL,NULL,'Nguyễn Thị Hoài','Hương',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:18:48','2016-07-08 02:18:48'),(46,135,NULL,NULL,'Nguyễn Ánh','Dương',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:19:37','2016-07-08 02:19:37'),(47,136,NULL,NULL,'Trương Thị Thiên','Hương',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:20:01','2016-07-08 02:20:01'),(48,137,NULL,NULL,'Lê Thị Hồng','Miên',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:20:19','2016-07-08 02:20:19'),(49,138,NULL,NULL,'Trương Mỹ','Linh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:20:37','2016-07-08 02:20:37'),(50,139,NULL,NULL,'Bùi Văn','Hưng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:20:54','2016-07-08 02:20:54'),(51,140,NULL,NULL,'Nguyễn Thị Kim','Oanh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:21:29','2016-07-08 02:21:29'),(52,141,NULL,NULL,'Nguyễn Thị','Khoa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:21:49','2016-07-08 02:21:49'),(53,142,NULL,NULL,'Châu Thị','Chứa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:22:08','2016-07-08 02:22:08'),(54,143,NULL,NULL,'Nguyễn Hàm','Hiệp',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:22:25','2016-07-08 02:22:25'),(55,144,NULL,NULL,'Nguyễn Thị Hồng','Sâm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:22:44','2016-07-08 02:22:44'),(56,145,NULL,NULL,'Bùi Tuyết','Hạnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:23:34','2016-07-08 02:23:34'),(57,146,NULL,NULL,'Phạm Thị Ngọc','Diệp',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:23:51','2016-07-08 02:23:51'),(58,147,NULL,NULL,'Từ Mạnh','Thuận',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:24:25','2016-07-08 02:24:25'),(59,148,NULL,NULL,'Vương Hồng','Quân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:24:51','2016-07-08 02:24:51'),(60,149,NULL,NULL,'Vũ Thị Hồng','Lê',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:25:11','2016-07-08 02:25:11'),(61,150,NULL,NULL,'Phạm Đức','Hậu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:25:35','2016-07-08 02:25:35'),(62,151,NULL,NULL,'Nguyễn Mai','Lam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:26:02','2016-07-08 02:26:02'),(63,152,NULL,NULL,'Nguyễn Thị Hải','Yến',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:26:19','2016-07-08 02:26:19'),(64,153,NULL,NULL,'Bùi Tá','Vinh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:26:46','2016-07-08 02:26:46'),(65,154,NULL,NULL,'Nguyễn Thị Ngọc','Bích',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:27:06','2016-07-08 02:27:06'),(66,155,NULL,NULL,'Lê Dương Trung','Dũng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:27:24','2016-07-08 02:27:24'),(67,156,NULL,NULL,'Nguyễn Ngọc Quỳnh','Như',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:27:52','2016-07-08 02:27:52'),(68,157,NULL,NULL,'Phạm Thị Ái','Phi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:28:08','2016-07-08 02:28:08'),(69,158,NULL,NULL,'Hồ Quang','Long',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:28:27','2016-07-08 02:28:27'),(70,159,NULL,NULL,'Nguyễn Thế','Vũ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:28:50','2016-07-08 02:28:50'),(71,160,NULL,NULL,'Trần Thị','Loan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:29:14','2016-07-08 02:29:14'),(72,161,NULL,NULL,'Nguyễn Văn','Ngọc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:29:36','2016-07-08 02:29:36'),(73,162,NULL,NULL,'Lê Thanh','Nhàn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:29:52','2016-07-08 02:29:52'),(74,163,NULL,NULL,'Phạm Thanh','Đường',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:30:14','2016-07-08 02:30:14'),(75,164,NULL,NULL,'Đỗ Văn','Tập',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:30:34','2016-07-08 02:30:34'),(76,165,NULL,NULL,'Ngô Văn','Thận',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:30:53','2016-07-08 02:30:53'),(77,166,NULL,NULL,'Phạm Hữu','Nghĩa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:31:39','2016-07-08 02:31:39'),(78,167,NULL,NULL,'Huỳnh Diệp Ngọc','Long',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:31:54','2016-07-08 02:31:54'),(79,168,NULL,NULL,'Lê Thành','Đạt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:32:10','2016-07-08 02:32:10'),(80,169,NULL,NULL,'Nguyễn Thái','Tuy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:32:35','2016-07-08 02:32:35'),(81,170,NULL,NULL,'Phan Thế','Nhân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:32:52','2016-07-08 02:32:52'),(82,171,NULL,NULL,'Trương Thị Ngọc','Loan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:33:08','2016-07-08 02:33:08'),(83,172,NULL,NULL,'Nguyễn Quốc','Thanh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:33:30','2016-07-08 02:33:30'),(84,173,NULL,NULL,'Vũ Thế','Mạnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:33:46','2016-07-08 02:33:46'),(85,174,NULL,NULL,'Nguyễn Văn','Hiếu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:34:06','2016-07-08 02:34:06'),(86,175,NULL,NULL,'Vy Hải','Diện',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:34:27','2016-07-08 02:34:27'),(87,176,NULL,NULL,'Nguyễn Trường','Sinh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:34:43','2016-07-08 02:34:43'),(88,177,NULL,NULL,'Trần Minh','Hoàng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:34:58','2016-07-08 02:34:58'),(89,178,NULL,NULL,'Nguyễn Viết','Đông',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:35:16','2016-07-08 02:35:16'),(90,179,NULL,NULL,'Hà Anh','Huy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:35:33','2016-07-08 02:35:33'),(91,180,NULL,NULL,'Đậu Đức','Tráng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:35:57','2016-07-08 02:35:57'),(92,181,NULL,NULL,'Nguyễn Thanh','Bình',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:36:39','2016-07-08 02:36:39'),(93,182,NULL,NULL,'Nguyễn Đình','Duy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:36:56','2016-07-08 02:36:56'),(94,183,NULL,NULL,'Võ Thành','Duy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:37:13','2016-07-08 02:37:13'),(95,184,NULL,NULL,'Tạ Nhật','Huy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:37:30','2016-07-08 02:37:30'),(96,185,NULL,NULL,'Lê Quang','Hòa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:37:50','2016-07-08 02:37:50'),(97,186,NULL,NULL,'Trần Thanh','Thuấn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:38:11','2016-07-08 02:38:11'),(98,187,NULL,NULL,'Trần Thị Thúy','Hằng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:38:29','2016-07-08 02:38:29'),(99,188,NULL,NULL,'Tăng Thị Như','Hà',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:38:45','2016-07-08 02:38:45'),(100,189,NULL,NULL,'Nguyễn Ngọc','Châu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:39:04','2016-07-08 02:39:04'),(101,190,NULL,NULL,'Ngô Thị','Hồng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:39:24','2016-07-08 02:39:24'),(102,191,NULL,NULL,'Nguyễn Thị Thu','Hiền',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:39:46','2016-07-08 02:39:46'),(103,192,NULL,NULL,'Bùi Thị Thanh','Kỹ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:40:06','2016-07-08 02:40:06'),(104,193,NULL,NULL,'Bùi Xuân','Thắng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:40:22','2016-07-08 02:40:22'),(105,194,NULL,NULL,'Lê Thành','Niên',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:40:41','2016-07-08 02:40:41'),(106,195,NULL,NULL,'Phạm Văn','Tuấn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:41:00','2016-07-08 02:41:00'),(107,196,NULL,NULL,'Đinh Văn','Hiển',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:41:30','2016-07-08 02:41:30'),(108,197,NULL,NULL,'Nguyễn Hoàng','Tuấn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:41:55','2016-07-08 02:41:55'),(109,198,NULL,NULL,'Nguyễn Văn','Hiển',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:42:10','2016-07-08 02:42:10'),(110,199,NULL,NULL,'Đỗ Ngọc','Minh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:42:27','2016-07-08 02:42:27'),(111,200,NULL,NULL,'Đỗ Đình','Na',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:42:42','2016-07-08 02:42:42'),(112,201,NULL,NULL,'Bùi Quang','Hòa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:43:00','2016-07-08 02:43:00'),(113,202,NULL,NULL,'Mai Thị Bích','Vân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:43:18','2016-07-08 02:43:18'),(114,203,NULL,NULL,'Nguyễn Ngọc','Linh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:43:36','2016-07-08 02:43:36'),(115,204,NULL,NULL,'Trần Thị','Thoa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:43:53','2016-07-08 02:43:53'),(116,205,NULL,NULL,'Nguyễn Thị Thanh','Hằng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:44:11','2016-07-08 02:44:11'),(117,206,NULL,NULL,'Nguyễn Việt','Bắc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:44:28','2016-07-08 02:44:28'),(118,207,NULL,NULL,'Bùi Ngọc','An',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:44:45','2016-07-08 02:44:45'),(119,208,NULL,NULL,'Nguyễn Ngọc','Dung',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:45:03','2016-07-08 02:45:03'),(120,209,NULL,NULL,'Dương Thị Hồng','Nga',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:45:19','2016-07-08 02:45:19'),(121,210,NULL,NULL,'Tô Văn','Trực',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:45:35','2016-07-08 02:45:35'),(122,211,NULL,NULL,'Trần Vĩnh','Duy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:45:52','2016-07-08 02:45:52'),(123,212,NULL,NULL,'Hoàng Thị','Thúy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:46:59','2016-07-08 02:46:59'),(124,213,NULL,NULL,'Đào Tăng','Tín',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:47:18','2016-07-08 02:47:18'),(125,214,NULL,NULL,'Phạm Thị Phương','Loan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:47:38','2016-07-08 02:47:38'),(126,215,NULL,NULL,'Đỗ Thị Bích','Thủy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:47:56','2016-07-08 02:47:56'),(127,216,NULL,NULL,'Nguyễn Thành','Đoàn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:48:13','2016-07-08 02:48:13'),(128,217,NULL,NULL,'Hà Văn','Du',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:48:37','2016-07-08 02:48:37'),(129,218,NULL,NULL,'Nguyễn Thị Phương','Quỳnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:48:54','2016-07-08 02:48:54'),(130,219,NULL,NULL,'Tạ Hữu','Thính',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:49:13','2016-07-08 02:49:13'),(131,220,NULL,NULL,'Lưu Gia','Thoại',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:49:30','2016-07-08 02:49:30'),(132,221,NULL,NULL,'Nguyễn Thị Vân','Hảo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:49:46','2016-07-08 02:49:46'),(133,222,NULL,NULL,'Phạm Ngọc','Hoa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:50:02','2016-07-08 02:50:02'),(134,223,NULL,NULL,'Mai Phương','Uyên',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:50:43','2016-07-08 02:50:43'),(135,224,NULL,NULL,'Trần Ngọc','Dân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:51:24','2016-07-08 02:51:24'),(136,225,NULL,NULL,'Trần Thị','Diễm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:51:40','2016-07-08 02:51:40'),(137,226,NULL,NULL,'Lê Thị Ngọc','Ánh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:52:02','2016-07-08 02:52:02'),(138,227,NULL,NULL,'Võ Văn','Nhiên',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:52:18','2016-07-08 02:52:18'),(139,228,NULL,NULL,'Vũ Minh','Luân',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:52:33','2016-07-08 02:52:33'),(140,229,NULL,NULL,'Nguyễn Văn','Hưng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:52:49','2016-07-08 02:52:49'),(141,230,NULL,NULL,'Nguyễn Văn','Đều',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:53:10','2016-07-08 02:53:10'),(142,231,NULL,NULL,'Bùi Đức','Anh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:53:25','2016-07-08 02:53:25'),(143,232,NULL,NULL,'Trần Nguyễn Phương','Đông',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:53:50','2016-07-08 02:53:50'),(144,233,NULL,NULL,'Đinh Quốc','Hùng',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:54:29','2016-07-08 02:54:29'),(145,234,NULL,NULL,'Bùi Quang Tuấn','Sơn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:54:51','2016-07-08 02:54:51'),(146,235,NULL,NULL,'Nguyễn Thị','Thu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:55:09','2016-07-08 02:55:09'),(147,236,NULL,NULL,'Nguyễn Thị Thu','Huyền',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:55:32','2016-07-08 02:55:32'),(148,237,NULL,NULL,'Trần Ngọc Hoàng','Vũ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:55:52','2016-07-08 02:55:52'),(149,238,NULL,NULL,'Phan Minh','Chí',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:56:15','2016-07-08 02:56:15'),(150,239,NULL,NULL,'Mai Thị','Thúy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:56:32','2016-07-08 02:56:32'),(151,240,NULL,NULL,'Nguyễn Đình Ngọc','Thủy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:56:51','2016-07-08 02:56:51'),(152,241,NULL,NULL,'Bùi Thị Hồng','Hạnh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:57:08','2016-07-08 02:57:08'),(153,242,NULL,NULL,'Hoàng Thị Thu','Huệ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:57:26','2016-07-08 02:57:26'),(154,243,NULL,NULL,'Nguyễn Thị Ánh','Nguyệt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:57:48','2016-07-08 02:57:48'),(155,244,NULL,NULL,'Lương Tấn','Trung',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-08 02:58:04','2016-07-08 02:58:04'),(156,245,NULL,NULL,'Trịnh Thị Mỹ','Dung','',NULL,'',NULL,NULL,'',NULL,'2016-07-20 15:24:38','2016-07-20 15:26:46'),(157,246,NULL,NULL,'Vũ Văn','Thanh','',NULL,'',NULL,NULL,'',NULL,'2016-07-20 15:28:58','2016-07-20 15:29:39');
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
  `uid` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `uid` (`uid`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'HVCT101','nhungdaothicam@hvct.edu.vn','$2y$10$2G78CT/WWvjnhYFO/3aFTOPEBt/G61Ew3xuNDzK5i6g74HPEaeJqO',NULL,1,1,NULL,NULL,'2016-07-13 14:53:45','$2y$10$LlHxflfOv.CYA9Rc.yUTduPouuMQR9.VSQL/C5kOnzsas39ZKX9d.',NULL,0,'2016-05-27 23:42:10','2016-07-13 14:53:45'),(2,'HVCT100','phongketoantv@hvct.edu.vn','$2y$10$HtAWOj9SXGhZUbpDI3qU7OwwQ8bdnBGflWEy6Z3KcwgMUKUf4M3GO','{\"_superadmin\":1}',1,0,NULL,NULL,'2016-08-17 16:33:21','$2y$10$8LZ79JMzYjfH0nxoHDpbT.7Rqrito5znhAs.e0Uy6m5cgVVsdGHma',NULL,0,'2016-05-28 03:43:05','2016-08-17 16:33:21'),(105,'HVCT102','phongketoan1@hvct.edu.vn','$2y$10$B.E2EBCW.QUBev.iB6hTbeYkmQaFz4LM3bx8xVIpdZPGBtZVA0RGK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-07 23:49:45','2016-07-08 05:18:33'),(109,'HVCT103','phongketoan2@hvct.edu.vn','$2y$10$rYkJef26GVAUu1eD9.SuZOQqk51kAEyjMB5jZFfPWgQrpctKQaLLq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:45:49','2016-07-08 05:18:45'),(110,'HVCT110','hangnguyenthi@hvct.edu.vn','$2y$10$ntHa3Iu65gB7L7rtYqCxE.dAC8vIb881JSHOwI0BP4tsUsBV0OLsC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:46:51','2016-07-08 00:46:51'),(111,'HVCT111','phutranviet@hvct.edu.vn','$2y$10$eKGOmzyS9BwNhr50tAROs.SWxxNH39Q6sSJcKcI1fir7DJQj6FA.W',NULL,1,0,NULL,NULL,'2016-08-05 22:45:04','$2y$10$s/dnQSsLjBZpNQ/9l9v2yOwzce9KyIE9.H7mLEROSRf4g1CBvZvsq',NULL,0,'2016-07-08 00:48:55','2016-08-05 22:45:04'),(112,'HVCT112','tribuivan@hvct.edu.vn','$2y$10$dyfeTCeJ56PoKjWB1C.r3.UPCxL9u0f6sQrsobCl3IRPeIYc0.86C',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:50:14','2016-07-08 00:50:14'),(113,'HVCT113','sangnguyenthi@hvct.edu.vn','$2y$10$Rtgiv7gv5YoOg388gaAEpeNSg8PKtp87NdK3d26zmAnRxcdIq5.Xe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:50:42','2016-07-08 00:50:42'),(114,'HVCT114','dongtranduy@hvct.edu.vn','$2y$10$HYBM49AbR3b2/Qm.65ClT..EKE4NLDyq0.dW3oONBXbpMIF3PYqOa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:51:06','2016-07-08 00:51:06'),(115,'HVCT115','tuantranduc@hvct.edu.vn','$2y$10$4nkAeP6M8EDDokTBiqXU1uf9Cuhi4rKIDtIl.k6lKx7/XbWzeY/n.','',1,0,NULL,NULL,'2016-07-08 04:53:39','$2y$10$chxfAQta0TB4enU5Cf4WA.dX7NRAO0xaOL/jpef2QCsjP42wwevDK',NULL,0,'2016-07-08 00:51:29','2016-07-08 05:07:42'),(116,'HVCT116','vinhnguyen@hvct.edu.vn','$2y$10$9N6eQ7SVM7lCD0jL59xcXOq8HPmxi0VvSQszCpTKUDT5E5WxCgEbq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:51:49','2016-07-08 00:51:49'),(117,'HVCT117','chivo@hvct.edu.vn','$2y$10$0I5gOTp87nex4ffY8PNTt.DYGvDbdlVYZb92H7i715oujprhg1kz6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:53:56','2016-07-08 00:53:56'),(118,'HVCT118','anhtruongvan@hvct.edu.vn','$2y$10$vZKm2DtahUPjzVLhvVT7R.e7GXoP4LTGSEc63TFGS.5IJQssyJDju',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:54:37','2016-07-08 00:54:37'),(119,'HVCT119','namvovan@hvct.edu.vn','$2y$10$fjiFyKQeO4e1e/JdlmDeQeSMxobHoCJXVhLdun3CfIAO2PP8aSWgK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:55:33','2016-07-08 00:55:33'),(120,'HVCT120','tuanbuianh@hvct.edu.vn','$2y$10$crTiVg9Yy8KMaS84E1qldOXdWJgQvGMg9uF1iOCblwM48r5WgWzRy',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 00:55:57','2016-07-08 00:55:57'),(121,'HVCT121','linhtranthiquyen@hvct.edu.vn','$2y$10$tf2dbrFKS2gGSvcLsAqL2e0YI/Rn/R01Y2/RKxpqLY.SFtrWsnDxO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:12:58','2016-07-08 02:12:58'),(122,'HVCT122','huephamthi@hvct.edu.vn','$2y$10$vDLpjeT2aDw5LD3ht1Jt..z79sPFdzFppvLYtZJFz3mFszIJh6Bcm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:13:26','2016-07-08 02:13:26'),(123,'HVCT123','hanguyenanhvan@hvct.edu.vn','$2y$10$hsxrqeQtyUw7Ri3Ea7cVY.SeEYIRKKPBG7CSRmoZ6kRKL1HNQUphC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:13:53','2016-07-08 02:13:53'),(124,'HVCT124','anlethithanh@hvct.edu.vn','$2y$10$.paXvtKbRd/Ys1ieI0KSL.f25itbIh0NO2ggSkn/z7EVwfMgl1.4a',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:14:18','2016-07-08 02:14:18'),(125,'HVCT125','quynhdinhnhu@hvct.edu.vn','$2y$10$EHv7X9exBSLbdn1iB7nz4.d27cEYEJrWxPGtrkYt48cjh7g6I1Q3u',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:14:41','2016-07-08 02:14:41'),(126,'HVCT126','quynhlevan@hvct.edu.vn','$2y$10$fbxbNBu1yCQWsG3UfBWUZOrJyEVGOPyx.cqVKSpRj2.wTP04OiS16',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:15:07','2016-07-08 02:15:07'),(127,'HVCT127','tuyettranthi@hvct.edu.vn','$2y$10$B1COeyzfgOZa7a.bbf0j1O0bLiBuDZcJmiRcwimCKRdE3T6e1PGCG',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:15:41','2016-07-08 02:15:41'),(128,'HVCT128','toannguyenvan@hvct.edu.vn','$2y$10$sKMedM9LNYSP6RCcDOqejewpDcrNX.WJjLZeakEVRzpqIkvJG4w1S',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:16:19','2016-07-08 02:16:19'),(129,'HVCT129','thuylethithanh@hvct.edu.vn','$2y$10$bFu8qcfbLRTFGBceJTXdAOJlTUaxBGdrS1iwKA1HfgAmN/PcAyqD.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:16:59','2016-07-08 02:16:59'),(130,'HVCT130','mynguyenthihuyen@hvct.edu.vn','$2y$10$dpZWit5fIsFOTgin3xT/HOk8mfjUk1c.e2HNTZByXWqN38/E38AcW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:17:26','2016-07-08 02:17:26'),(131,'HVCT131','ngahoangthi@hvct.edu.vn','$2y$10$kejha1QzVRu2OIFGmOqg7u853WzotJOZ0poqC8CCr.GhcCEsFyZBK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:17:50','2016-07-08 02:17:50'),(132,'HVCT132','thangphamhong@hvct.edu.vn','$2y$10$MLXNDqm8s4UvFN0CslNGweerhI5XyS7S7r.81BqImJmjNbb7PqQ2m',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:18:09','2016-07-08 02:18:09'),(133,'HVCT133','vannguyenthi@hvct.edu.vn','$2y$10$2P2R0FgnNLXZ/1vlYBnpT.xMKD1VSspHNogkUNCVn9RlQIFqao36y',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:18:28','2016-07-08 02:18:28'),(134,'HVCT134','huongnguyenthihoai@hvct.edu.vn','$2y$10$omP8w4lMLp8KitIj9nj6peXLfyqYC5x1ePkE6cjEUEIIantkHUQx.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:18:48','2016-07-08 02:18:48'),(135,'HVCT135','duongnguyenanh@hvct.edu.vn','$2y$10$HJb2gY5aRRMOpsO1WQnGY.w4qsNEGsAbyb0ET.JXRHJjf.D2a/tVS',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:19:37','2016-07-08 02:19:37'),(136,'HVCT136','huongtruongthithien@hvct.edu.vn','$2y$10$yQD857IbOWpomy/HRN4wpemdfWA/nBzgkZgqRgFGsLNGqMmD02Jb.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:20:01','2016-07-08 02:20:01'),(137,'HVCT137','mienlethithong@hvct.edu.vn','$2y$10$EnEGwagqOaOrALBSQjuP.OR4LqI5QVr4HSPphJsfW3CcsuuMNVil2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:20:19','2016-07-08 02:20:19'),(138,'HVCT138','linhtruongmy@hvct.edu.vn','$2y$10$CVebrLFSLTS75pMI6Zp8kOa1IexKtXM9tTlwe1M16F7u83hKLwr5y',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:20:37','2016-07-08 02:20:37'),(139,'HVCT139','hungbuivan@hvct.edu.vn','$2y$10$08UauITbYqtAx0CCUM8UauK1g4p3h2e3B6P7HIX.lhbmdlK8Np6L6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:20:54','2016-07-08 02:20:54'),(140,'HVCT140','oanhnguyenthikim@hvct.edu.vn','$2y$10$4phYP/tTFktJuKHViG46DeNQB0Cq2fUETnDbWIioqCAp16Qenxomm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:21:29','2016-07-08 02:21:29'),(141,'HVCT141','khoanguyenthi@hvct.edu.vn','$2y$10$8nLG5109ZSOAJ2tU/4lIdeCOuasqCuTB8DIfsybuwTzrBrjbRasli',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:21:49','2016-07-08 02:21:49'),(142,'HVCT142','chuachauthi@hvct.edu.vn','$2y$10$qRmoPU2zmb82m/J93JtkoOXQC5LeRJ0l4fP6byRB/GwqRXFEhgQA6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:22:08','2016-07-08 02:22:08'),(143,'HVCT143','hiepnguyenham@hvct.edu.vn','$2y$10$MMxxFdWgaHUPXaqNUMwN6e8YDHVL6pMuCH6hSFe8A9WhJoqvnui22',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:22:25','2016-07-08 02:22:25'),(144,'HVCT144','samnguyenthihong@hvct.edu.vn','$2y$10$qb1K.GFhBIzy0u8/YGEMQuqSXZ6uQT7er3pxUZo6rXbbkq7ANw/TO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:22:44','2016-07-08 02:22:44'),(145,'HVCT145','hanhbuituyet@hvct.edu.vn','$2y$10$QgTqG804m69/srcoMZ7qR.1OAGIHX1./YS6tXJeoI2aBe2RIznRtm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:23:34','2016-07-08 02:23:34'),(146,'HVCT146','diepphamthingoc@hvct.edu.vn','$2y$10$AGAbeDngp6Oce3RvR4mF8ekinW8yrZNLA/AZ0kZ5534cHYTw1nfqa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:23:51','2016-07-08 02:23:51'),(147,'HVCT147','thuantumanh@hvct.edu.vn','$2y$10$zizHIOUCqCxkyxvIIyyahO16IsSXfN9qAD3H2zAeiVwcwP3/dQlma',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:24:25','2016-07-08 02:24:25'),(148,'HVCT148','quanvuonghong@hvct.edu.vn','$2y$10$qfNFXHe01.zQpWJqoV/sW.yJEmM4w2jlXMKtJZ30XOFaXcJmbV.7O',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:24:51','2016-07-08 02:24:51'),(149,'HVCT149','levuthihong@hvct.edu.vn','$2y$10$i1XI.pktoQUCcfTb.ozBZe5gCfnr7NSJJxUqwIH6j4AZkIr9Ot9xe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:25:11','2016-07-08 02:25:11'),(150,'HVCT150','hauphamduc@hvct.edu.vn','$2y$10$toTBltZ9dY4TcO/TKwkT4uxg8OT73.I2htLxd32z7hml1DaDDeF82',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:25:35','2016-07-08 02:25:35'),(151,'HVCT151','lamnguyenmai@hvct.edu.vn','$2y$10$5jMbqP7VSlg4dqL7xUvdSu8bdsD8sOJ2IHi4QdBhRH.XYdTZgaB8.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:26:02','2016-07-08 02:26:02'),(152,'HVCT152','yennguyenthihai@hvct.edu.vn','$2y$10$EHPeYuGfTP3c0lD1kXKk1udJodsvLi6iyvLxSqQzqeTAxQPk21WcS',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:26:19','2016-07-08 02:26:19'),(153,'HVCT153','vinhbuita@hvct.edu.vn','$2y$10$q8FQNCoXJYHrHWdtP5cqdem7UF04rosuPoLrTtCHe.paMZTwvN126',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:26:46','2016-07-08 02:26:46'),(154,'HVCT154','bichnguyenthingoc@hvct.edu.vn','$2y$10$ru6Vx1C.WjFMmfR95IaBQeLTEojgujVMZVY9NpHRoy0pTYmqQU7Tu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:27:06','2016-07-08 02:27:06'),(155,'HVCT155','dungleduongtrung@hvct.edu.vn','$2y$10$yzIw465stApjed30snHD6..4zm..nnmEZlMIcAmtxYl3Lf9/CYG/6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:27:24','2016-07-08 02:27:24'),(156,'HVCT156','nhunguyenngocquynh@hvct.edu.vn','$2y$10$aoVhKexmfJOMMLTG9KBkt.nz3w59XKE6fYDGpN4zbuVAcFE3B2MM.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:27:52','2016-07-08 02:27:52'),(157,'HVCT157','phiphamthiai@hvct.edu.vn','$2y$10$5euxcbPJEUOzA.4jWiCc/.R12Iimq/Z6ZFDGEd9hPYQRF1/iX1NPa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:28:08','2016-07-08 02:28:08'),(158,'HVCT158','longhoquang@hvct.edu.vn','$2y$10$iXRxt0SNN97oMWwSI7JbRe6sUlxtds/74qD.A4NG/JrQWFmB2hlVG',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:28:27','2016-07-08 02:28:27'),(159,'HVCT159','vunguyenthevu@hvct.edu.vn','$2y$10$4kabYpv2o3cZ4XObUcc6h.8hZYnFSXYtGRY94zn.KS6LLDTYKAz0.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:28:50','2016-07-08 02:28:50'),(160,'HVCT160','loantranthi@hvct.edu.vn','$2y$10$0s06XFlKIlaRnfSTeX7sUu5W/n6oRG9mjgPmow/5Rn2kENgmWRqmW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:29:14','2016-07-08 02:29:14'),(161,'HVCT161','ngocnguyenvan@hvct.edu.vn','$2y$10$RDZfjO05rkV/oHcPOYVKPu2tyJlJSkfcwH3t8EC0avuz/VLDhM4ti',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:29:36','2016-07-08 02:29:36'),(162,'HVCT162','nhanlethanh@hvct.edu.vn','$2y$10$U5/rADQg1SLlzAui2jPKROAysi2nm90yhZ8iwf.ni9FoihfI19bLa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:29:52','2016-07-08 02:29:52'),(163,'HVCT163','duongphamthanh@hvct.edu.vn','$2y$10$xlcRlPz1hIuz0v4AIlooUe0HKEao.zFGNc8OiSJlZ4uvgh/nbBF0i',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:30:14','2016-07-08 02:30:14'),(164,'HVCT164','tapdovan@hvct.edu.vn','$2y$10$U24N8SIzgKuTd0Xj2ko9m.3FJ4Qg3GXTU5iJ4cLdlldvnFsyckEny',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:30:34','2016-07-08 02:30:34'),(165,'HVCT165','thanngovan@hvct.edu.vn','$2y$10$.XOWKLzguSBLKTC.hckGiOUvQu6V8U9AJlIbFASeTgIZPWz1dmmz2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:30:53','2016-07-08 02:30:53'),(166,'HVCT166','nghiaphamhuu@hvct.edu.vn','$2y$10$5j0INqUtb2UuL27m0j/RKecXaxSPOk2PICdjSdZ46nt1LIzz.jUxG',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:31:39','2016-07-08 02:31:39'),(167,'HVCT167','longhuynhdiepngoc@hvct.edu.vn','$2y$10$R4pKMO7Y.IsNtRytIhSr2uuYadzuiBcHH6vrPkMNO4GGyx6yQulry',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:31:54','2016-07-08 02:31:54'),(168,'HVCT168','datlethanh@hvct.edu.vn','$2y$10$Nu3Qtvy35h3TJ32lUEoxGerfixCFyntI1GNuqYUrlq5UJ.8cxbR1e',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:32:10','2016-07-08 02:32:10'),(169,'HVCT169','tuynguyenthai@hvct.edu.vn','$2y$10$9olbSxn8/OPTQabS2s1Roe3HPr489aRS8X/5kicNIJOHinXFxPy8q',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:32:35','2016-07-08 02:32:35'),(170,'HVCT170','nhanphanthe@hvct.edu.vn','$2y$10$XQCFrASLVNrPzDQtNjMDfed0Hc3/WEitm379biK.7IQ4FRtX6.S8q',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:32:52','2016-07-08 02:32:52'),(171,'HVCT171','loantruongthingoc@hvct.edu.vn','$2y$10$NGEP1QvXLpFVEKJ322vb..zIzEDszAXPwCQwI.2wMLg2Lx.6Lw2z.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:33:08','2016-07-08 02:33:08'),(172,'HVCT172','thanhnguyenquoc@hvct.edu.vn','$2y$10$EslH3sHyxFhD/Loj3ehCO.ZWEd4rLsJ7jchj0FV3Z3s3eRLlnZ.Da',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:33:30','2016-07-08 02:33:30'),(173,'HVCT173','manhvuthe@hvct.edu.vn','$2y$10$1rwcvg03Nf63hGlElVR89.vyR1hfM2iecBInzpaKKUunykyHP9dIq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:33:46','2016-07-08 02:33:46'),(174,'HVCT174','hieunguyenvan@hvct.edu.vn','$2y$10$MMFuEw0TGGuuyZ3ng4euSu0SuaN4EHru5mmDWKOFOxsCBh2y5Xi1.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:34:06','2016-07-08 02:34:06'),(175,'HVCT175','dienvyhai@hvct.edu.vn','$2y$10$nKvnA2z7vDhhDjTM2UnLBu6kGUxg/4GpDhMVp4prkxV8v.wkT0RvO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:34:27','2016-07-08 02:34:27'),(176,'HVCT176','sinhnguyentruong@hvct.edu.vn','$2y$10$xIX3iusbbMVcbQVICj95eeVm9BZdGGpydDPleLlsEwBiGODh9QPrW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:34:43','2016-07-08 02:34:43'),(177,'HVCT177','hoangtranminh@hvct.edu.vn','$2y$10$aaiR6kSXKDrRUD.A6D1M9.MvzaxKY3QIotzKfaqXoO0T64eITvqEe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:34:58','2016-07-08 02:34:58'),(178,'HVCT178','dongnguyenviet@hvct.edu.vn','$2y$10$7RD0VS.P0HWk2xGNvVJwH.UhIEjoOl0RuIbb9dGnUlRGT9i6xC7F.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:35:16','2016-07-08 02:35:16'),(179,'HVCT179','huyhaanh@hvct.edu.vn','$2y$10$WGNMysh9gV8O8.K6Vzhln.V3gKxvVUbVBInOZ8XKaHUbdPDrHrItW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:35:33','2016-07-08 02:35:33'),(180,'HVCT180','trangdauduc@hvct.edu.vn','$2y$10$FmQiXpUlIoq9AMJ8GgO9A.W1hi.1Pl3jYB1.FCnbuDevFBboFr/f6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:35:57','2016-07-08 02:35:57'),(181,'HVCT181','binhnguyenthanh@hvct.edu.vn','$2y$10$ysq1z9Dtjp3fSgATA.5B7uRn7CFIObrCrY80RhoON6GRKVn59HgGi',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:36:39','2016-07-08 02:36:39'),(182,'HVCT182','duynguyendinh@hvct.edu.vn','$2y$10$1.wwHlGtxtrQmCVEq.YqrOxbyEH0aJlv46AWJb1a/kZ0G.NspJ.P2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:36:56','2016-07-08 02:36:56'),(183,'HVCT183','duyvothanh@hvct.edu.vn','$2y$10$KaQNA8bQo0pS5wlHjzOiSeLvF8U0w7aWzUgGLZyYs3ehu/IKlOqj.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:37:13','2016-07-08 02:37:13'),(184,'HVCT184','huytanhat@hvct.edu.vn','$2y$10$JQPbLrB1CRkPbSZCbaSXN.1iR0216e8lrqCaiXGpW1WigHsjlJNeu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:37:30','2016-07-08 02:37:30'),(185,'HVCT185','hoalequang@hvct.edu.vn','$2y$10$6kJDR/m.PDwkwd8r7iSNAeRdy4PC9AqazhRDwn1KEEXlmeQpIEcJC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:37:50','2016-07-08 02:37:50'),(186,'HVCT186','thuantranthanh@hvct.edu.vn','$2y$10$/FOO7.IyFW332IJQ.NFMT.cNKJfiHxQUgYH7R0u8RM31gLmHNPsg.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:38:11','2016-07-08 02:38:11'),(187,'HVCT187','hangtranthithuy@hvct.edu.vn','$2y$10$gXcRhQQ4r0JlU4JIv/4cM.mBUX.R4HBESXht2D5IBsdyDglY9iJfC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:38:29','2016-07-08 02:38:29'),(188,'HVCT188','hatangthinhuha@hvct.edu.vn','$2y$10$dUXYIRh.mTPzY2xwaHsgmu/.73hCDBogtn/b7U8JdIEBf5kEnD5bu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:38:45','2016-07-08 02:38:45'),(189,'HVCT189','chaunguyenngoc@hvct.edu.vn','$2y$10$QoM4i0P.ZAIwhCEjcXOhF.zr8.oJWyKTfeReF6MyvQEAeQNb9JpSq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:39:04','2016-07-08 02:39:04'),(190,'HVCT190','hongngothi@hvct.edu.vn','$2y$10$0AS1L5HUYBjt4/CSxzOY5.Kl7S1SwGij.PWslUFXeCZ1tecc6Rc5K',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:39:24','2016-07-08 02:39:24'),(191,'HVCT191','hiennguyenthithu@hvct.edu.vn','$2y$10$WK0Hljpo.yGgEGQqXOb4NO25R4D0aszh9l0vWM22gonwZzvXhNVNu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:39:46','2016-07-08 02:39:46'),(192,'HVCT192','kybuithithanh@hvct.edu.vn','$2y$10$B62U32rlqHSOFYyQxethi.OsrHPCkTpftnaKDx6MSr5LA9S4J/.Xi',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:40:06','2016-07-08 02:40:06'),(193,'HVCT193','thangbuixuan@hvct.edu.vn','$2y$10$fhSfsF9YmO46xiIAXcexqO3SKX54RZSlSxyeBCBnY4sqVyIqc6Eye',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:40:22','2016-07-08 02:40:22'),(194,'HVCT194','nienlethanh@hvct.edu.vn','$2y$10$b7twNu4D5C9KZ2iM.0sF8eHRBU4/LO5hyBVcN0Zj..LMVCPxBG6gK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:40:41','2016-07-08 02:40:41'),(195,'HVCT195','tuanphamkim@hvct.edu.vn','$2y$10$I6zPS/0d1Vn24B1iKkZwNuZxA/rCN//igF1XUDwcfVwh11QQPpjDq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:41:00','2016-07-08 02:41:00'),(196,'HVCT196','hiendinhvan@hvct.edu.vn','$2y$10$k0C5fj5z4/HXkQAnhUqvf.Sj4GF5ZvlKbZ.khRKtf5UCc/eCU8zVa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:41:30','2016-07-08 02:41:30'),(197,'HVCT197','tuannguyenhoang@hvct.edu.vn','$2y$10$.dAcwiVa7Dy2T9XrLABF6uC42/SxZRKs795JPk5xmZPEu2uI7p9bO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:41:55','2016-07-08 02:41:55'),(198,'HVCT198','hiennguyenvan@hvct.edu.vn','$2y$10$tKXC85lX0JoHG8I3Vs9O4OrmOVXs5ht6a3l8GiylroOnRo7EYM6pi',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:42:10','2016-07-08 02:42:10'),(199,'HVCT199','minhdongoc@hvct.edu.vn','$2y$10$NKbIanRKANaAd8SXMEwwr.RNj0QdotUI63j60HIhjVQzXYiXleC/S',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:42:27','2016-07-08 02:42:27'),(200,'HVCT200','nadodinh@hvct.edu.vn','$2y$10$0AjFdOJ80QPC.LRPTpulY.Lob2zU4kvSQV4qycGpi0nxY8sQeWc8a',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:42:42','2016-07-08 02:42:42'),(201,'HVCT201','hoabuiquang@hvct.edu.vn','$2y$10$fHgd/DmK234CU2m6eN4dW.ytTebscO.I1gRFskvqEXthmI9Z0mAfa',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:43:00','2016-07-08 02:43:00'),(202,'HVCT202','vanmaithibich@hvct.edu.vn','$2y$10$pZqPwlsNzclMrovvMROhOeCbQLlP59grUN9/OJqvUtxC66yeT9YaO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:43:18','2016-07-08 02:43:18'),(203,'HVCT203','linhnguyenngoc@hvct.edu.vn','$2y$10$uTmqo9egQSZVSCwebWW0VuG.mrpOmTFILACXEevWQE24mglB0uIIG',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:43:36','2016-07-08 02:43:36'),(204,'HVCT204','thoatranthi@hvct.edu.vn','$2y$10$9bGwHXg5066K.RQsbnNn/.PA8ZmueEuqi1STtdZ5oJ.kr/JuWbz4K',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:43:53','2016-07-08 02:43:53'),(205,'HVCT205','hangnguyenthithanh@hvct.edu.vn','$2y$10$jNob3WZ5r1vzJQ5NSgU.NuwkFgmMaNRGccWCv9aU5poROMfZZn28i',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:44:11','2016-07-08 02:44:11'),(206,'HVCT206','bacnguyenviet@hvct.edu.vn','$2y$10$RvIXGopN/wFuwMWB.ORBu.BXxYw98FTJfKpLQHPzkuEqTENs5OOPu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:44:28','2016-07-08 02:44:28'),(207,'HVCT207','anbuingoc@hvct.edu.vn','$2y$10$eJIR4boTfTFFeOHcZfy3iuFEuY1VC2Ym6VHa/qOlNqBdc.mqmbaq6',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:44:45','2016-07-08 02:44:45'),(208,'HVCT208','dungnguyenngoc@hvct.edu.vn','$2y$10$UA8cZrlja9VbbH7W4kC9KefLaQ3HlxKaYxGLQzr3HK/tUQsVo107.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:45:03','2016-07-08 02:45:03'),(209,'HVCT209','ngaduongthihong@hvct.edu.vn','$2y$10$Hbb3uru647BtVH1iVgKkSucptwWdlH7L9LpUznpxWzYM9aZ/la1xK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:45:19','2016-07-08 02:45:19'),(210,'HVCT210','tructovan@hvct.edu.vn','$2y$10$8k2L5Oz0UsOSEWmpyPnUeOeoHNSXHXxzdfgiCVc7SUqviQ1ViPRe2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:45:35','2016-07-08 02:45:35'),(211,'HVCT211','duytranvinh@hvct.edu.vn','$2y$10$e3VIBomL8412nv5l3TOhweKKu7mrZZTSKGbyRxk6O79uRjyfn/t9u',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:45:52','2016-07-08 02:45:52'),(212,'HVCT212','thuyhoangthi@hvct.edu.vn','$2y$10$jrbbhFM2sah77WaDHZnFEufnidLmii8B5tW0kzaJ0f95ZLDundLiK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:46:59','2016-07-08 02:46:59'),(213,'HVCT213','tindaotang@hvct.edu.vn','$2y$10$hNINf/pk0UQmIjTqTwhdTOc.FBtKxH3WMBnS5yguabYfTSzCOMN4m',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:47:18','2016-07-08 02:47:18'),(214,'HVCT214','loanphamthiphuong@hvct.edu.vn','$2y$10$tjbI4p8BDcol7xSZWWe2veSImqCSBP7WDLMITeVEUNzQvZKAYzmCq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:47:38','2016-07-08 02:47:38'),(215,'HVCT215','thuydothibich@hvct.edu.vn','$2y$10$bof/VOt1u8rOGJeflhjRZuC64.KWqyZBD.Zgc6HOvrEoyDCi0G3ma',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:47:56','2016-07-08 02:47:56'),(216,'HVCT216','doannguyenthanh@hvct.edu.vn','$2y$10$/40imAq43NVsphvHoH1TQemst3Q1bLnNe56.Jv6l4ylr9z38HwGyy',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:48:13','2016-07-08 02:48:13'),(217,'HVCT217','duhavan@hvct.edu.vn','$2y$10$W7sqvMidTZbb0vScg1Rb8OcrloOHSGkC9inagVYyNQzJYd5jRjtHK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:48:37','2016-07-08 02:48:37'),(218,'HVCT218','quynhnguyenthiphuong@hvct.edu.vn','$2y$10$vImwscPa4xHks8faXlCMtOAdO5/7M9NPs5Gcqe5jcxMa2Dd3lfyc2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:48:54','2016-07-08 02:48:54'),(219,'HVCT219','thinhtahuu@hvct.edu.vn','$2y$10$JpDAmSBO/nHY/kSnmyICouNb0NoimX9.s5P5ZaIN89wQsA/d6RVH.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:49:13','2016-07-08 02:49:13'),(220,'HVCT220','thoailuugia@hvct.edu.vn','$2y$10$1ZO5gwz6KxpguX675byJbuhAMCZGfK/4h1IemIZl4RA2goSc4xxUe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:49:30','2016-07-08 02:49:30'),(221,'HVCT221','haonguyenthivan@hvct.edu.vn','$2y$10$67c4PgaDZ6o7y.dP33xXpeXUGV6sFeyqKlIbK9jDcWASru9/BVdPm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:49:46','2016-07-08 02:49:46'),(222,'HVCT222','hoaphamngoc@hvct.edu.vn','$2y$10$6fay6XVxwQgznyidDADdVuNCB90hAvdnJ3MddxiC1cWrpiz4nVAY.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:50:02','2016-07-08 02:50:02'),(223,'HVCT223','uyenmaiphuong@hvct.edu.vn','$2y$10$dK77zvHm3NYshP818Z9QgeGGtzICEGNipv9xNkxzAA3bSGtiNbBjO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:50:43','2016-07-08 02:50:43'),(224,'HVCT224','dantranngoc@hvct.edu.vn','$2y$10$pv/7eLTXBkcooKV1Nsbzx.7mCLyIdXYQ9xZnRfkwqQA/85ptlJyIe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:51:24','2016-07-08 02:51:24'),(225,'HVCT225','diemtranthi@hvct.edu.vn','$2y$10$z9C4TGdXvCLzV3lE/C63MelWnIMWhOO30uMWPwY4LaFKpA1n/0hS2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:51:40','2016-07-08 02:51:40'),(226,'HVCT226','anhlethingoc@hvct.edu.vn','$2y$10$Ec0DXeZwtNoF.Dwd2F2qfewtIazcCXM.R2wOyROL/XpVN.hAnp3.q',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:52:02','2016-07-08 02:52:02'),(227,'HVCT227','nhienvovan@hvct.edu.vn','$2y$10$V/Wyftu0TlM/RwaZkYM2QuEJ8hpT3Y6IaPmCEFAkQURPladCFpvjq',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:52:18','2016-07-08 02:52:18'),(228,'HVCT228','luanvuminh@hvct.edu.vn','$2y$10$PCchqpyjInaesgP3brfgH.M762cIypITHRv56RxjILA/fRmSsWOSK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:52:33','2016-07-08 02:52:33'),(229,'HVCT229','hungnguyenvan@hvct.edu.vn','$2y$10$Fm1aI13JoEAXPWGXv1JX0eI98xjI8zsn/fiIJTLKJ4z3XUenVIGc.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:52:49','2016-07-08 02:52:49'),(230,'HVCT230','deunguyenvan@hvct.edu.vn','$2y$10$YsNz5lkLUshHKG0wh2OjiOC.SqEYKVD3MSkmSbxM6dQOKHNOlKPQG',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:53:10','2016-07-08 02:53:10'),(231,'HVCT231','anhbuiduc@hvct.edu.vn','$2y$10$hlZQGb//NQApTcsFp3xo6u1v9ebe8xbW4G7TpykjcTE2by.RP0Lz.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:53:25','2016-07-08 02:53:25'),(232,'HVCT232','dongtrannguyenphuong@hvct.edu.vn','$2y$10$ZvsHMH6OIWi687pA2R4/qecKOsoRn7fL4PSh8ttKbeFeBAqfVEnIm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:53:50','2016-07-08 02:53:50'),(233,'HVCT233','hungdinhquoc@hvct.edu.vn','$2y$10$aRiTDb8zigJhr4vhKP3Kte0E1js5L9wrpFFEbnMn58l7YmEMUDG9y',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:54:29','2016-07-08 02:54:29'),(234,'HVCT234','sonbuiquangtuan@hvct.edu.vn','$2y$10$6qcew.FgeBBMeoRy3hFcOu6n4qxbd3dSceEfKVSaKkEsqD9vzexTy',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:54:51','2016-07-08 02:54:51'),(235,'HVCT235','thunguyenthi@hvct.edu.vn','$2y$10$A0R/n0skTmdJ8aZXNglYKupJs9LoGf5fUif2oLeLvHY4Tl/q0uizO',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:55:09','2016-07-08 02:55:09'),(236,'HVCT236','huyennguyenthithu@hvct.edu.vn','$2y$10$Ky.yXpA4EqiM0hojEN.deekLcoSTTg3z8vch2v6kgfjnWDaxqtdFK',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:55:32','2016-07-08 02:55:32'),(237,'HVCT237','vutranngochoang@hvct.edu.vn','$2y$10$HrfFAPrv4EWtLj8GjTpHGeXkPgc.c3nNagPDNGQ/77xaGyW6JPvBe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:55:52','2016-07-08 02:55:52'),(238,'HVCT238','chiphanminh@hvct.edu.vn','$2y$10$d5ofVwyCPmM3oG59JEdO4.0Gh7RMn3d8wmFKXO0nlkf6v4idwWHni',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:56:15','2016-07-08 02:56:15'),(239,'HVCT239','thuymaithi@hvct.edu.vn','$2y$10$/DHsp1zYglEMHqh7BUfZ4.HTIunAvQrpaTXdg/cnX42Cz6EBqEiBu',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:56:32','2016-07-08 02:56:32'),(240,'HVCT240','thuynguyendinhngoc@hvct.edu.vn','$2y$10$LA391sGW/hhOzANZsBZqJuhVzZm1qle90TPMmnVM9kFA87ffCE5p2',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:56:51','2016-07-08 02:56:51'),(241,'HVCT241','hanhbuithihonghanh@hvct.edu.vn','$2y$10$nUsvpCPjsOKAl/Y5QI26nuCl8pdsl6dAkPjHkic1teecfDdDTMYfe',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:57:08','2016-07-08 02:57:08'),(242,'HVCT242','huehoangthithu@hvct.edu.vn','$2y$10$jjcX1MohZF3mGv15Vlhq3.I3GuMUHyCymaYLe/i.IqCcSu.mn0uwW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:57:26','2016-07-08 02:57:26'),(243,'HVCT243','nguyennguyenthianh@hvct.edu.vn','$2y$10$YGTO5JJd5vWSeAUgk/skPediCX.0g/u0appXZ3kDJz.gW.UEBQ5mW',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:57:48','2016-07-08 02:57:48'),(244,'HVCT244','trungluongtan@hvct.edu.vn','$2y$10$J4bQt4pPrR.GK5N6BKR/hed5iQqKT7hUoO.t/EmY/Du17fzetS8pC',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-08 02:58:04','2016-07-08 02:58:04'),(245,'HVCT245','dungtrinhthimy@hcvt.edu.vn','$2y$10$zRcjmi50meQRnRZ555PeHezCm9oZvaTeBEYV5yX37s/cgOYDwabE.',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-20 15:24:38','2016-07-20 15:24:38'),(246,'HVCT246','thanhvuvan@hvct.edu.vn','$2y$10$/xf5Rg/F7Pqp39EElHOAQOBG3AFnikM5oT940J4Nhk7gpif666hZm',NULL,1,0,NULL,NULL,NULL,NULL,NULL,0,'2016-07-20 15:28:58','2016-07-20 15:28:58');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,4),(1,5),(2,1),(2,4),(2,5),(9,1),(11,5),(12,5),(13,5),(14,5),(101,5),(102,5),(104,5),(105,4),(105,5),(109,4),(109,5),(110,5),(111,5),(112,5),(113,5),(114,5),(115,5),(116,5),(117,5),(118,5),(119,5),(120,5),(121,5),(122,5),(123,5),(124,5),(125,5),(126,5),(127,5),(128,5),(129,5),(130,5),(131,5),(132,5),(133,5),(134,5),(135,5),(136,5),(137,5),(138,5),(139,5),(140,5),(141,5),(142,5),(143,5),(144,5),(145,5),(146,5),(147,5),(148,5),(149,5),(150,5),(151,5),(152,5),(153,5),(154,5),(155,5),(156,5),(157,5),(158,5),(159,5),(160,5),(161,5),(162,5),(163,5),(164,5),(165,5),(166,5),(167,5),(168,5),(169,5),(170,5),(171,5),(172,5),(173,5),(174,5),(175,5),(176,5),(177,5),(178,5),(179,5),(180,5),(181,5),(182,5),(183,5),(184,5),(185,5),(186,5),(187,5),(188,5),(189,5),(190,5),(191,5),(192,5),(193,5),(194,5),(195,5),(196,5),(197,5),(198,5),(199,5),(200,5),(201,5),(202,5),(203,5),(204,5),(205,5),(206,5),(207,5),(208,5),(209,5),(210,5),(211,5),(212,5),(213,5),(214,5),(215,5),(216,5),(217,5),(218,5),(219,5),(220,5),(221,5),(222,5),(223,5),(224,5),(225,5),(226,5),(227,5),(228,5),(229,5),(230,5),(231,5),(232,5),(233,5),(234,5),(235,5),(236,5),(237,5),(238,5),(239,5),(240,5),(241,5),(242,5),(243,5),(244,5);
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

-- Dump completed on 2017-04-23 14:16:52
