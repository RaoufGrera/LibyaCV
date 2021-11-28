-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table job_libya.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `block_admin` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.admins: ~0 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`admin_id`, `email`, `user_name`, `password`, `block_admin`, `level`, `remember_token`, `created_at`, `updated_at`, `last_seen`) VALUES
	(1, 'abd@yahoo.com', 'abd', '$2y$10$SiEs3uoyQJunhhLVOms8T.a3tYkXctOuLIud5YIG6kqlyFOdsX3Ru', '0', '1', 'iwJTOVLGuSISnZNMGleCIjuWd5CMkOTX5cWmPLEWLXVvIIQHRu0ic9mR8P6y', NULL, '2017-08-25 16:07:46', '2018-04-28');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table job_libya.allcv
CREATE TABLE IF NOT EXISTS `allcv` (
  `seeker_store_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` varchar(11) NOT NULL,
  PRIMARY KEY (`seeker_store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.allcv: ~0 rows (approximately)
/*!40000 ALTER TABLE `allcv` DISABLE KEYS */;
/*!40000 ALTER TABLE `allcv` ENABLE KEYS */;

-- Dumping structure for table job_libya.block_company
CREATE TABLE IF NOT EXISTS `block_company` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_id` int(10) unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`block_id`),
  KEY `block_company_comp_id_foreign` (`comp_id`),
  CONSTRAINT `block_company_comp_id_foreign` FOREIGN KEY (`comp_id`) REFERENCES `companys` (`comp_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.block_company: ~0 rows (approximately)
/*!40000 ALTER TABLE `block_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `block_company` ENABLE KEYS */;

-- Dumping structure for table job_libya.block_desc
CREATE TABLE IF NOT EXISTS `block_desc` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc_id` int(10) unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(11) NOT NULL,
  PRIMARY KEY (`block_id`),
  KEY `block_desc_desc_id_foreign` (`desc_id`),
  CONSTRAINT `block_desc_desc_id_foreign` FOREIGN KEY (`desc_id`) REFERENCES `job_description` (`desc_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.block_desc: ~2 rows (approximately)
/*!40000 ALTER TABLE `block_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `block_desc` ENABLE KEYS */;

-- Dumping structure for table job_libya.block_seeker
CREATE TABLE IF NOT EXISTS `block_seeker` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `seeker_block` int(11) NOT NULL,
  PRIMARY KEY (`block_id`),
  KEY `block_seeker_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `block_seeker_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.block_seeker: ~0 rows (approximately)
/*!40000 ALTER TABLE `block_seeker` DISABLE KEYS */;
/*!40000 ALTER TABLE `block_seeker` ENABLE KEYS */;

-- Dumping structure for table job_libya.companys
CREATE TABLE IF NOT EXISTS `companys` (
  `comp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL DEFAULT '1',
  `domain_id` int(10) unsigned NOT NULL DEFAULT '1',
  `compt_id` int(10) unsigned NOT NULL DEFAULT '1',
  `comp_user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_emp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_comp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size_comp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hide_cv` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `block_admin` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `see_it` int(11) NOT NULL DEFAULT '0',
  `comp_desc` text COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goodreads` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwrly` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compt_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isstar` int(1) DEFAULT '0',
  `stardate` datetime DEFAULT NULL,
  `endstar` datetime DEFAULT NULL,
  PRIMARY KEY (`comp_id`),
  KEY `companys_city_id_foreign` (`city_id`),
  KEY `companys_domain_id_foreign` (`domain_id`),
  KEY `companys_compt_id_foreign` (`compt_id`),
  CONSTRAINT `companys_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`),
  CONSTRAINT `companys_compt_id_foreign` FOREIGN KEY (`compt_id`) REFERENCES `job_comp_type` (`compt_id`),
  CONSTRAINT `companys_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.companys: ~0 rows (approximately)
/*!40000 ALTER TABLE `companys` DISABLE KEYS */;
/*!40000 ALTER TABLE `companys` ENABLE KEYS */;

-- Dumping structure for table job_libya.comp_exp
CREATE TABLE IF NOT EXISTS `comp_exp` (
  `compe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `compe_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`compe_id`),
  UNIQUE KEY `compe_name_UNIQUE` (`compe_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.comp_exp: ~2 rows (approximately)
/*!40000 ALTER TABLE `comp_exp` DISABLE KEYS */;
INSERT INTO `comp_exp` (`compe_id`, `compe_name`, `created_at`, `updated_at`) VALUES
	(11, 'مهندس برمجيات', '2017-09-30 16:18:33', '2017-09-30 16:18:33'),
	(19, 'شركة العين', '2017-11-02 21:41:31', '2017-11-02 21:41:31'),
	(20, '7:\'', '2017-12-02 15:18:01', '2017-12-02 15:18:01'),
	(21, 'شركة العصر الحديث', '2018-01-04 11:19:30', '2018-01-04 11:19:30'),
	(22, 'مهندس', '2018-01-12 02:45:57', '2018-01-12 02:45:57'),
	(23, 'غغغ', '2018-01-15 13:24:07', '2018-01-15 13:24:07'),
	(24, 'moksara', '2018-03-09 00:36:41', '2018-03-09 00:36:41'),
	(25, 'شركة الخيرية', NULL, NULL);
/*!40000 ALTER TABLE `comp_exp` ENABLE KEYS */;

-- Dumping structure for table job_libya.employers
CREATE TABLE IF NOT EXISTS `employers` (
  `emp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `activation` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `last_seen` date NOT NULL,
  `count_in` int(11) NOT NULL,
  `block_admin` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `level` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `block` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `employers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.employers: ~0 rows (approximately)
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;

-- Dumping structure for table job_libya.exams
CREATE TABLE IF NOT EXISTS `exams` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(80) NOT NULL,
  `level_id` int(11) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  `price` varchar(45) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `owner` varchar(60) NOT NULL,
  `forwho` varchar(250) NOT NULL,
  `ownerdesc` varchar(250) NOT NULL,
  `countq` int(10) NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.exams: ~2 rows (approximately)
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` (`exam_id`, `exam_name`, `level_id`, `isactive`, `price`, `time`, `domain_id`, `desc`, `url`, `owner`, `forwho`, `ownerdesc`, `countq`) VALUES
	(1, 'لغة انجليزية', 2, 1, '9000', '30', 2, '', 'english2', 'د.رضوان حسين', '', '', 20),
	(2, 'لغة انجليزية 1', 1, 1, '3000', '20', 1, 'اختبار لمبتدئ اللغة الإنجليزية', 'english1', 'د.رضوان حسين', 'لمبرمجين ومتعلمين اللغة النجليزيةة', 'رئيس قسم هندسة البرمجيات ودكتور ذكاء اصطناعي', 30);
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;

-- Dumping structure for table job_libya.faculty
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`faculty_id`),
  UNIQUE KEY `faculty_name_UNIQUE` (`faculty_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.faculty: ~13 rows (approximately)
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `created_at`, `updated_at`) VALUES
	(1, 'كلية الاقتصاد', NULL, NULL),
	(2, 'كلية الزراعة', NULL, NULL),
	(3, 'كلية تقنية المعلومات', NULL, NULL),
	(4, 'كلية العلوم', NULL, NULL),
	(5, 'كلية الهندسة', NULL, NULL),
	(6, 'كلية الاداب', NULL, NULL),
	(8, 'كلية اللغات', NULL, NULL),
	(9, 'كلية العلوميين', NULL, NULL),
	(10, 'كلية الكليات', NULL, NULL),
	(11, 'كلية الصحة', NULL, NULL),
	(12, 'كلية البطاطا', NULL, NULL),
	(17, 'كلية البعثيين', NULL, NULL),
	(18, '', NULL, NULL),
	(24, 'كلية الخضرات', NULL, NULL),
	(25, 'eertetr', NULL, NULL);
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;

-- Dumping structure for table job_libya.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `feedback_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `feedback_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.feedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table job_libya.firends
CREATE TABLE IF NOT EXISTS `firends` (
  `firend_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `req_firend_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`firend_id`),
  KEY `firends_seeker_id_foreign` (`seeker_id`),
  KEY `firends_req_firend_id_foreign` (`req_firend_id`),
  CONSTRAINT `firends_req_firend_id_foreign` FOREIGN KEY (`req_firend_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE,
  CONSTRAINT `firends_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.firends: ~2 rows (approximately)
/*!40000 ALTER TABLE `firends` DISABLE KEYS */;
/*!40000 ALTER TABLE `firends` ENABLE KEYS */;

-- Dumping structure for table job_libya.firend_spec
CREATE TABLE IF NOT EXISTS `firend_spec` (
  `seeker_id` int(11) NOT NULL,
  `firend_spec_id` int(10) unsigned NOT NULL,
  `firend_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `firend_spec_firend_spec_id_foreign` (`firend_spec_id`),
  KEY `firend_spec_firend_id_foreign` (`firend_id`),
  CONSTRAINT `firend_spec_firend_id_foreign` FOREIGN KEY (`firend_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE,
  CONSTRAINT `firend_spec_firend_spec_id_foreign` FOREIGN KEY (`firend_spec_id`) REFERENCES `spec_seeker` (`spec_seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.firend_spec: ~19 rows (approximately)
/*!40000 ALTER TABLE `firend_spec` DISABLE KEYS */;
/*!40000 ALTER TABLE `firend_spec` ENABLE KEYS */;

-- Dumping structure for table job_libya.followers_company
CREATE TABLE IF NOT EXISTS `followers_company` (
  `followers_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comp_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`followers_id`),
  KEY `followers_company_comp_id_foreign` (`comp_id`),
  KEY `followers_company_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `followers_company_comp_id_foreign` FOREIGN KEY (`comp_id`) REFERENCES `companys` (`comp_id`) ON DELETE CASCADE,
  CONSTRAINT `followers_company_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.followers_company: ~16 rows (approximately)
/*!40000 ALTER TABLE `followers_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `followers_company` ENABLE KEYS */;

-- Dumping structure for table job_libya.followers_seeker
CREATE TABLE IF NOT EXISTS `followers_seeker` (
  `followers_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `followers_seeker_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`followers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9689 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.followers_seeker: ~33 rows (approximately)
/*!40000 ALTER TABLE `followers_seeker` DISABLE KEYS */;
INSERT INTO `followers_seeker` (`followers_id`, `seeker_id`, `followers_seeker_id`, `create_date`) VALUES
	(9628, 6, 9627, '2017-08-18 22:39:13'),
	(9629, 7, 9627, '2017-08-18 22:39:20'),
	(9631, 5, 9627, '2017-08-18 22:39:29'),
	(9632, 14, 9627, '2017-08-19 14:04:07'),
	(9635, 39, 9627, '2017-08-19 14:05:23'),
	(9636, 41, 9627, '2017-08-19 14:05:49'),
	(9637, 46, 9627, '2017-08-19 14:06:15'),
	(9638, 45, 9627, '2017-08-19 14:06:20'),
	(9639, 42, 9627, '2017-08-19 14:06:25'),
	(9640, 44, 9627, '2017-08-19 14:06:28'),
	(9641, 43, 9627, '2017-08-19 14:06:30'),
	(9642, 56, 9627, '2017-08-19 14:07:52'),
	(9643, 60, 9627, '2017-08-19 14:08:32'),
	(9644, 24, 9627, '2017-08-19 14:11:47'),
	(9645, 26, 9627, '2017-08-19 14:11:50'),
	(9646, 203, 9627, '2017-08-19 14:12:17'),
	(9647, 226, 9627, '2017-08-19 14:12:18'),
	(9648, 20, 9627, '2017-08-19 14:14:25'),
	(9649, 22, 9627, '2017-08-19 14:14:27'),
	(9650, 90, 9627, '2017-08-21 17:26:00'),
	(9651, 9627, 9627, '2017-08-21 17:30:29'),
	(9652, 10, 9627, '2017-08-25 18:51:18'),
	(9653, 6186, 9627, '2017-08-25 19:02:04'),
	(9654, 2343, 9627, '2017-08-26 17:25:53'),
	(9656, 9627, 2343, '2017-08-26 19:31:43'),
	(9657, 8, 9627, '2017-08-26 20:07:22'),
	(9658, 35, 9627, '2017-08-31 10:26:34'),
	(9659, 3031, 9627, '2017-08-31 10:31:08'),
	(9660, 178, 9627, '2017-08-31 11:15:51'),
	(9661, 9, 9627, '2017-08-31 19:12:15'),
	(9662, 87, 9627, '2017-09-02 00:45:54'),
	(9663, 58, 9627, '2017-09-02 19:01:56'),
	(9664, 23, 9627, '2017-09-08 13:52:32'),
	(9665, 17, 9627, '2017-10-02 08:44:16'),
	(9666, 49, 9627, '2017-10-02 12:27:48'),
	(9667, 2343, 9681, '2017-10-20 21:39:21'),
	(9668, 9681, 9681, '2017-10-27 20:40:49'),
	(9669, 8128, 9627, '2017-10-27 23:40:03'),
	(9672, 9592, 9627, '2017-10-29 08:34:08'),
	(9673, 11, 9627, '2017-11-01 09:25:53'),
	(9674, 21, 9684, '2017-11-02 18:37:17'),
	(9675, 9684, 9684, '2017-11-02 20:11:06'),
	(9676, 9686, 9686, '2017-11-03 22:15:08'),
	(9678, 9626, 9686, '2017-11-11 17:17:53'),
	(9679, 9681, 9686, '2017-11-13 20:04:55'),
	(9680, 9626, 9627, '2017-11-13 22:24:05'),
	(9681, 9627, 9686, '2017-11-21 01:03:41'),
	(9682, 9681, 9627, '2017-12-11 15:07:34'),
	(9684, 9686, 9627, '2017-12-29 03:08:32'),
	(9685, 9687, 9686, '2018-01-21 13:14:50'),
	(9686, 9619, 9686, '2018-03-15 02:18:00'),
	(9687, 9624, 9686, '2018-03-18 00:49:15'),
	(9688, 9757, 9757, '2018-05-04 01:37:23');
/*!40000 ALTER TABLE `followers_seeker` ENABLE KEYS */;

-- Dumping structure for table job_libya.hobby
CREATE TABLE IF NOT EXISTS `hobby` (
  `hobby_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hobby_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hobby_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.hobby: ~26 rows (approximately)
/*!40000 ALTER TABLE `hobby` DISABLE KEYS */;
INSERT INTO `hobby` (`hobby_id`, `hobby_name`, `created_at`, `updated_at`) VALUES
	(1, 'klklkl', NULL, NULL),
	(2, 'القراءة', NULL, NULL),
	(3, 'الترجمة', NULL, NULL),
	(4, 'برجة', NULL, NULL),
	(5, 'برمجة', NULL, NULL),
	(6, 'شطرنج', NULL, NULL),
	(7, 'شاهي', NULL, NULL),
	(8, 'برمجة', NULL, NULL),
	(9, 'مبمرجين', NULL, NULL),
	(10, 'مطور', NULL, NULL),
	(11, 'شطرنجي', NULL, NULL),
	(12, 'حرنيف', NULL, NULL),
	(13, 'م', NULL, NULL),
	(14, 'حرنيف', NULL, NULL),
	(15, 'ملعبي', NULL, NULL),
	(16, 'فالح', NULL, NULL),
	(17, 'محرنف', NULL, NULL),
	(18, 'زابيطه', NULL, NULL),
	(19, 'مطور', NULL, NULL),
	(20, 'زابطيون', NULL, NULL),
	(21, 'هوايتي', NULL, NULL),
	(22, 'زابيطاتت', NULL, NULL),
	(23, 'بطش', NULL, NULL),
	(24, 'دجرطوني', NULL, NULL),
	(25, 'تكموتو', NULL, NULL),
	(26, 'هوايت1', NULL, NULL),
	(27, 'هوايتته6', NULL, NULL),
	(28, 'كرة قدم', NULL, NULL),
	(29, 'yyyyy', NULL, NULL);
/*!40000 ALTER TABLE `hobby` ENABLE KEYS */;

-- Dumping structure for table job_libya.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_cert
CREATE TABLE IF NOT EXISTS `job_cert` (
  `cert_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cert_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cert_id`),
  UNIQUE KEY `cert_name_UNIQUE` (`cert_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_cert: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_cert` DISABLE KEYS */;
INSERT INTO `job_cert` (`cert_id`, `cert_name`, `created_at`, `updated_at`) VALUES
	(1, 'oca oracle', NULL, NULL),
	(2, 'شهادة حاسوب', NULL, NULL),
	(3, 'اوركل', NULL, NULL);
/*!40000 ALTER TABLE `job_cert` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_certificate
CREATE TABLE IF NOT EXISTS `job_certificate` (
  `certificate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cert_id` int(10) unsigned NOT NULL,
  `cert_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`certificate_id`),
  KEY `job_certificate_seeker_id_foreign` (`seeker_id`),
  KEY `job_certificate_cert_id_foreign` (`cert_id`),
  CONSTRAINT `job_certificate_cert_id_foreign` FOREIGN KEY (`cert_id`) REFERENCES `job_cert` (`cert_id`) ON DELETE CASCADE,
  CONSTRAINT `job_certificate_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_certificate: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_certificate` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_city
CREATE TABLE IF NOT EXISTS `job_city` (
  `city_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_name_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_city: ~8 rows (approximately)
/*!40000 ALTER TABLE `job_city` DISABLE KEYS */;
INSERT INTO `job_city` (`city_id`, `city_name`, `created_at`, `updated_at`, `city_name_en`) VALUES
	(1, 'طرابلس', NULL, NULL, 'tripoli'),
	(2, 'بنغازي', NULL, NULL, 'beng'),
	(3, 'مصراته', NULL, NULL, 'misrata'),
	(4, 'الخمس', NULL, NULL, 'homs'),
	(5, 'الزاوية', NULL, NULL, 'zawia'),
	(6, 'زليتن', NULL, NULL, 'zlitn'),
	(7, 'البيضاء', NULL, NULL, 'albida'),
	(8, 'سبها', NULL, NULL, 'sabha'),
	(9, 'ترهونة', NULL, NULL, 'tarhona'),
	(10, 'غريان', NULL, NULL, 'gr');
/*!40000 ALTER TABLE `job_city` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_comp_type
CREATE TABLE IF NOT EXISTS `job_comp_type` (
  `compt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `compt_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`compt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_comp_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `job_comp_type` DISABLE KEYS */;
INSERT INTO `job_comp_type` (`compt_id`, `compt_name`, `created_at`, `updated_at`) VALUES
	(1, 'القطاع العام', NULL, NULL),
	(2, 'القطاع الخاص', NULL, NULL);
/*!40000 ALTER TABLE `job_comp_type` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_description
CREATE TABLE IF NOT EXISTS `job_description` (
  `desc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `nat_id` int(10) unsigned DEFAULT '1',
  `domain_id` int(10) unsigned NOT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `salary_id` int(10) unsigned DEFAULT NULL,
  `edt_id` int(10) unsigned DEFAULT NULL,
  `status_id` int(10) unsigned DEFAULT NULL,
  `job_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `job_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `job_skills` text COLLATE utf8_unicode_ci,
  `job_num` int(2) unsigned DEFAULT NULL,
  `exp_min` int(2) unsigned DEFAULT NULL,
  `exp_max` int(2) unsigned DEFAULT NULL,
  `age_min` int(2) unsigned DEFAULT NULL,
  `age_max` int(2) unsigned DEFAULT NULL,
  `job_gender` char(1) COLLATE utf8_unicode_ci DEFAULT 'n',
  `job_start` date NOT NULL,
  `job_end` date NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `block_admin` bit(1) NOT NULL DEFAULT b'0',
  `comp_active` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `see_it` int(10) unsigned NOT NULL DEFAULT '1',
  `specialty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isstar` int(1) NOT NULL DEFAULT '0',
  `starstartdate` date DEFAULT NULL,
  `starenddate` date DEFAULT NULL,
  `desc_down` bigint(20) unsigned NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`desc_id`),
  KEY `job_description_manager_id_foreign` (`manager_id`),
  KEY `job_description_domain_id_foreign` (`domain_id`),
  KEY `job_description_city_id_foreign` (`city_id`),
  KEY `job_description_nat_id_foreign` (`nat_id`),
  KEY `job_description_salary_id_foreign` (`salary_id`),
  KEY `job_description_status_id_foreign` (`status_id`),
  KEY `job_description_edt_id_foreign` (`edt_id`),
  KEY `job_description_type_id_foreign` (`type_id`),
  KEY `desc_down_UNIQUE` (`desc_down`),
  CONSTRAINT `job_description_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`),
  CONSTRAINT `job_description_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`),
  CONSTRAINT `job_description_edt_id_foreign` FOREIGN KEY (`edt_id`) REFERENCES `job_edt` (`edt_id`),
  CONSTRAINT `job_description_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`manager_id`) ON DELETE CASCADE,
  CONSTRAINT `job_description_nat_id_foreign` FOREIGN KEY (`nat_id`) REFERENCES `job_nat` (`nat_id`),
  CONSTRAINT `job_description_salary_id_foreign` FOREIGN KEY (`salary_id`) REFERENCES `job_salary` (`salary_id`),
  CONSTRAINT `job_description_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `job_status` (`status_id`),
  CONSTRAINT `job_description_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `job_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_description: ~20 rows (approximately)
/*!40000 ALTER TABLE `job_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_description` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_domain
CREATE TABLE IF NOT EXISTS `job_domain` (
  `domain_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domain_name_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_domain: ~14 rows (approximately)
/*!40000 ALTER TABLE `job_domain` DISABLE KEYS */;
INSERT INTO `job_domain` (`domain_id`, `domain_name`, `created_at`, `updated_at`, `domain_name_en`) VALUES
	(1, 'محاسبة/اقتصاد', NULL, NULL, 'money'),
	(2, 'تدريس / تدريب', NULL, NULL, 'tech'),
	(3, 'فندقة /مطاعم', NULL, NULL, 'pitza'),
	(4, 'هندسة', NULL, NULL, 'eng'),
	(5, 'تقنية معلومات', NULL, NULL, 'data'),
	(6, 'إدارة / سكرتارية ', NULL, NULL, 'sek'),
	(7, 'مبيعات/تسويق', NULL, NULL, 'salesmaket'),
	(8, 'سائقين/توصيل', NULL, NULL, 'delever'),
	(9, 'حلاقة/كوافيرة', NULL, NULL, 'skin'),
	(11, 'حرفيون/مهنيون', NULL, NULL, 'lham'),
	(13, 'طب / تمريض', NULL, NULL, 'docotor'),
	(16, 'إعلام /دعاية', NULL, NULL, 'media'),
	(17, 'خدم/عمالة', NULL, NULL, 'cleanhouse'),
	(18, 'اعمال اخري', NULL, NULL, 'otherwork');
/*!40000 ALTER TABLE `job_domain` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_ed
CREATE TABLE IF NOT EXISTS `job_ed` (
  `ed_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) unsigned NOT NULL,
  `edt_id` int(10) unsigned NOT NULL DEFAULT '1',
  `seeker_id` int(10) unsigned NOT NULL,
  `univ_id` int(10) unsigned NOT NULL,
  `faculty_id` int(10) unsigned NOT NULL DEFAULT '1',
  `sed_id` int(10) unsigned DEFAULT NULL,
  `avg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_one` int(1) DEFAULT '0',
  PRIMARY KEY (`ed_id`),
  KEY `job_ed_edt_id_foreign` (`edt_id`),
  KEY `job_ed_seeker_id_foreign` (`seeker_id`),
  KEY `job_ed_sed_id_foreign` (`sed_id`),
  KEY `job_ed_univ_id_foreign` (`univ_id`),
  KEY `job_ed_faculty_id_foreign` (`faculty_id`),
  KEY `job_ed_domain_id_foreign` (`domain_id`),
  CONSTRAINT `job_ed_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`),
  CONSTRAINT `job_ed_edt_id_foreign` FOREIGN KEY (`edt_id`) REFERENCES `job_edt` (`edt_id`),
  CONSTRAINT `job_ed_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  CONSTRAINT `job_ed_sed_id_foreign` FOREIGN KEY (`sed_id`) REFERENCES `spec_ed` (`sed_id`),
  CONSTRAINT `job_ed_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE,
  CONSTRAINT `job_ed_univ_id_foreign` FOREIGN KEY (`univ_id`) REFERENCES `univ` (`univ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_ed: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_ed` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_ed` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_edt
CREATE TABLE IF NOT EXISTS `job_edt` (
  `edt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `edt_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`edt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_edt: ~4 rows (approximately)
/*!40000 ALTER TABLE `job_edt` DISABLE KEYS */;
INSERT INTO `job_edt` (`edt_id`, `edt_name`, `created_at`, `updated_at`) VALUES
	(1, 'ثانوي/دبلوم متوسط', NULL, NULL),
	(2, 'بكالوريس/دبلوم عالي', NULL, NULL),
	(3, 'ماجستير', NULL, NULL),
	(4, 'دكتوراة', NULL, NULL),
	(5, 'بدون مؤهل', NULL, NULL);
/*!40000 ALTER TABLE `job_edt` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_exp
CREATE TABLE IF NOT EXISTS `job_exp` (
  `exp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `exp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compe_id` int(10) unsigned NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `exp_desc` text COLLATE utf8_unicode_ci,
  `specialty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`exp_id`),
  KEY `job_exp_seeker_id_foreign` (`seeker_id`),
  KEY `job_exp_domain_id_foreign` (`domain_id`),
  KEY `job_exp_compe_id_foreign` (`compe_id`),
  CONSTRAINT `job_exp_compe_id_foreign` FOREIGN KEY (`compe_id`) REFERENCES `comp_exp` (`compe_id`),
  CONSTRAINT `job_exp_domain_id_foreign` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`),
  CONSTRAINT `job_exp_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_exp: ~3 rows (approximately)
/*!40000 ALTER TABLE `job_exp` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_exp` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_hobby
CREATE TABLE IF NOT EXISTS `job_hobby` (
  `job_hobby_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hobby_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`job_hobby_id`),
  KEY `job_hobby_seeker_id_foreign` (`seeker_id`),
  KEY `job_hobby_hobby_id_foreign` (`hobby_id`),
  CONSTRAINT `job_hobby_hobby_id_foreign` FOREIGN KEY (`hobby_id`) REFERENCES `hobby` (`hobby_id`) ON DELETE CASCADE,
  CONSTRAINT `job_hobby_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_hobby: ~8 rows (approximately)
/*!40000 ALTER TABLE `job_hobby` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_hobby` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_info
CREATE TABLE IF NOT EXISTS `job_info` (
  `info_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info_text` text COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_info: ~1 rows (approximately)
/*!40000 ALTER TABLE `job_info` DISABLE KEYS */;
INSERT INTO `job_info` (`info_id`, `info_name`, `info_date`, `info_text`, `seeker_id`, `created_at`, `updated_at`) VALUES
	(1, 'مهندس برمجيات في شركة سوس ليبيا88', '2000', 'تفاصيل مفصلة عن التصفايل الفصلية', 9627, '2017-06-09 22:29:14', '2017-06-09 22:29:14'),
	(2, 'معلومة جديدة', '2007', 'تعرف تعرفني يوم عرفتك تعرفني عرفت روحك تعرف روحي ياعريف', 9686, '2018-04-29 00:17:48', '2018-04-29 00:17:48');
/*!40000 ALTER TABLE `job_info` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_lang
CREATE TABLE IF NOT EXISTS `job_lang` (
  `lang_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_lang: ~3 rows (approximately)
/*!40000 ALTER TABLE `job_lang` DISABLE KEYS */;
INSERT INTO `job_lang` (`lang_id`, `lang_name`, `created_at`, `updated_at`) VALUES
	(1, 'العربية', NULL, NULL),
	(2, 'الأنجليزية', NULL, NULL),
	(3, 'الفرنسية', NULL, NULL);
/*!40000 ALTER TABLE `job_lang` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_lang_seeker
CREATE TABLE IF NOT EXISTS `job_lang_seeker` (
  `lang_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`job_lang_id`),
  KEY `job_lang_seeker_seeker_id_foreign` (`seeker_id`),
  KEY `job_lang_seeker_lang_id_foreign` (`lang_id`),
  KEY `job_lang_seeker_level_id_foreign` (`level_id`),
  CONSTRAINT `job_lang_seeker_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `job_lang` (`lang_id`),
  CONSTRAINT `job_lang_seeker_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `job_level` (`level_id`),
  CONSTRAINT `job_lang_seeker_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_lang_seeker: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_lang_seeker` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_lang_seeker` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_level
CREATE TABLE IF NOT EXISTS `job_level` (
  `level_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_level: ~3 rows (approximately)
/*!40000 ALTER TABLE `job_level` DISABLE KEYS */;
INSERT INTO `job_level` (`level_id`, `level_name`, `created_at`, `updated_at`) VALUES
	(1, 'مبتدئ', NULL, NULL),
	(2, 'متوسط', NULL, NULL),
	(3, 'حسن', NULL, NULL),
	(4, 'عالي', NULL, NULL);
/*!40000 ALTER TABLE `job_level` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_nat
CREATE TABLE IF NOT EXISTS `job_nat` (
  `nat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_nat: ~4 rows (approximately)
/*!40000 ALTER TABLE `job_nat` DISABLE KEYS */;
INSERT INTO `job_nat` (`nat_id`, `nat_name`, `created_at`, `updated_at`) VALUES
	(1, 'ليبيا', NULL, NULL),
	(2, 'أجنبي', NULL, NULL),
	(3, 'غيرمحدد', NULL, NULL);
/*!40000 ALTER TABLE `job_nat` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_reference
CREATE TABLE IF NOT EXISTS `job_reference` (
  `ref_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_adj` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ref_id`),
  KEY `job_reference_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `job_reference_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_reference: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_reference` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_reference` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_salary
CREATE TABLE IF NOT EXISTS `job_salary` (
  `salary_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `salary_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_salary: ~7 rows (approximately)
/*!40000 ALTER TABLE `job_salary` DISABLE KEYS */;
INSERT INTO `job_salary` (`salary_id`, `salary_name`, `created_at`, `updated_at`) VALUES
	(1, 'غيرمحدد', NULL, NULL),
	(2, '1-500', NULL, NULL),
	(3, '500-1000', NULL, NULL),
	(4, '1000-1500', NULL, NULL),
	(5, '1500-3000', NULL, NULL),
	(6, '3000-5000', NULL, NULL),
	(7, '5000-10000', NULL, NULL);
/*!40000 ALTER TABLE `job_salary` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_seeker_req
CREATE TABLE IF NOT EXISTS `job_seeker_req` (
  `req_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `desc_id` int(10) unsigned NOT NULL,
  `match` int(10) unsigned NOT NULL,
  `req_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `req_event` tinyint(1) NOT NULL DEFAULT '0',
  `see` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`req_id`),
  KEY `job_seeker_req_desc_id_foreign` (`desc_id`),
  KEY `job_seeker_req_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `job_seeker_req_desc_id_foreign` FOREIGN KEY (`desc_id`) REFERENCES `job_description` (`desc_id`) ON DELETE CASCADE,
  CONSTRAINT `job_seeker_req_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_seeker_req: ~19 rows (approximately)
/*!40000 ALTER TABLE `job_seeker_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_seeker_req` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_skills
CREATE TABLE IF NOT EXISTS `job_skills` (
  `skills_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `skills_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`skills_id`),
  KEY `job_skills_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `job_skills_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_skills: ~5 rows (approximately)
/*!40000 ALTER TABLE `job_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_skills` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_status
CREATE TABLE IF NOT EXISTS `job_status` (
  `status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_status: ~2 rows (approximately)
/*!40000 ALTER TABLE `job_status` DISABLE KEYS */;
INSERT INTO `job_status` (`status_id`, `status_name`, `created_at`, `updated_at`) VALUES
	(1, 'دوام كامل', NULL, NULL),
	(2, 'دوام جزئي', NULL, NULL);
/*!40000 ALTER TABLE `job_status` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_training
CREATE TABLE IF NOT EXISTS `job_training` (
  `train_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `train_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `train_comp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `train_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`train_id`),
  KEY `job_training_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `job_training_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_training: ~1 rows (approximately)
/*!40000 ALTER TABLE `job_training` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_training` ENABLE KEYS */;

-- Dumping structure for table job_libya.job_type
CREATE TABLE IF NOT EXISTS `job_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.job_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `job_type` DISABLE KEYS */;
INSERT INTO `job_type` (`type_id`, `type_name`, `created_at`, `updated_at`) VALUES
	(1, 'موظف', NULL, NULL),
	(2, 'متعاقد', NULL, NULL),
	(3, 'متطوع', NULL, NULL),
	(4, 'متدرب', NULL, NULL);
/*!40000 ALTER TABLE `job_type` ENABLE KEYS */;

-- Dumping structure for table job_libya.level
CREATE TABLE IF NOT EXISTS `level` (
  `YR_ID` int(11) NOT NULL,
  `LEVEL` varchar(30) NOT NULL,
  `LEVEL_DESCRIPTION` varchar(255) NOT NULL,
  PRIMARY KEY (`YR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table job_libya.level: ~0 rows (approximately)
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
/*!40000 ALTER TABLE `level` ENABLE KEYS */;

-- Dumping structure for table job_libya.managers
CREATE TABLE IF NOT EXISTS `managers` (
  `manager_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `comp_id` int(10) unsigned NOT NULL,
  `level` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `block_admin` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`manager_id`),
  KEY `managers_comp_id_foreign` (`comp_id`),
  KEY `managers_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `managers_comp_id_foreign` FOREIGN KEY (`comp_id`) REFERENCES `companys` (`comp_id`) ON DELETE CASCADE,
  CONSTRAINT `managers_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.managers: ~4 rows (approximately)
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;

-- Dumping structure for view job_libya.master
 
-- Dumping structure for table job_libya.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.migrations: ~56 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2016_02_06_140808_create_faculty_table', 1),
	('2016_02_06_140850_create_spec_ed_table', 1),
	('2016_02_18_220037_create_univ_table', 1),
	('2016_02_22_215313_Create_job_nat_table', 1),
	('2016_02_23_215302_Create_job_city_table', 1),
	('2016_02_23_221018_Create_employers_table', 1),
	('2016_02_23_221415_Create_admins_table', 1),
	('2016_02_23_223419_Create_seekers_table', 1),
	('2016_02_24_234709_create_job_cert_table', 1),
	('2016_02_25_220357_create_sessions_table', 1),
	('2016_02_26_191014_Create_job_domain_table', 1),
	('2016_02_26_193420_Create_job_edt_table', 1),
	('2016_02_26_193421_Create_job_ed_table', 1),
	('2016_02_28_161229_Create_job_level_table', 1),
	('2016_02_28_161239_Create_job_lang_table', 1),
	('2016_02_28_161250_Create_job_lang_seeker_table', 1),
	('2016_03_01_230113_create_hobby_table', 1),
	('2016_03_02_201436_Create_job_skills_table', 1),
	('2016_03_02_201505_Create_job_training_table', 1),
	('2016_03_02_201544_Create_job_info_table', 1),
	('2016_03_02_201731_Create_job_certificate_table', 1),
	('2016_03_02_202733_Create_job_reference_table', 1),
	('2016_03_02_221053_Create_job_hobby_table', 1),
	('2016_03_03_172527_create_job_comp_type_table', 1),
	('2016_03_30_172555_create_job_status_table', 1),
	('2016_03_30_172613_create_job_type_table', 1),
	('2016_03_30_172623_create_job_salary_table', 1),
	('2016_03_31_125150_create_companys_table', 1),
	('2016_03_31_132941_create_comp_exp_table', 1),
	('2016_04_01_155010_Create_job_exp_table', 1),
	('2016_04_10_133730_create_managers_table', 1),
	('2016_04_10_165353_create_job_description_table', 1),
	('2016_04_14_001210_create_spec_table', 1),
	('2016_04_14_001304_create_spec_seeker_table', 1),
	('2016_05_05_193157_create_job_seeker_req_table', 1),
	('2016_05_12_213231_create_seeker_show_table', 1),
	('2016_05_14_162949_create_firends_table', 1),
	('2016_05_15_233429_create_firend_spec_table', 1),
	('2016_07_30_204455_create_followers_company_table', 1),
	('2016_08_18_160827_block_seeker_table', 1),
	('2016_08_19_170519_spec_company_table', 1),
	('2016_08_20_003746_create_block_company_table', 1),
	('2016_08_20_003833_create_block_desc_table', 1),
	('2016_08_20_005944_create_feedback_table', 1),
	('2016_12_04_175922_create_spec_desc_table', 1),
	('2016_07_14_174132_create-posts', 2),
	('2017_07_15_183337_create_notifications_table', 3),
	('2017_09_15_001700_create_posts_table', 4),
	('2014_10_12_000000_create_users_table', 5),
	('2014_10_12_100000_create_password_resets_table', 5),
	('2016_06_01_000001_create_oauth_auth_codes_table', 5),
	('2016_06_01_000002_create_oauth_access_tokens_table', 5),
	('2016_06_01_000003_create_oauth_refresh_tokens_table', 5),
	('2016_06_01_000004_create_oauth_clients_table', 5),
	('2016_06_01_000005_create_oauth_personal_access_clients_table', 5),
	('2017_11_22_124655_create_social_accounts_table', 5),
	('2018_05_03_233626_create_jobs_table', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table job_libya.note_type
CREATE TABLE IF NOT EXISTS `note_type` (
  `note_type_id` int(11) NOT NULL,
  `note_type_name` varchar(45) NOT NULL,
  PRIMARY KEY (`note_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.note_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `note_type` DISABLE KEYS */;
INSERT INTO `note_type` (`note_type_id`, `note_type_name`) VALUES
	(1, 'مصادقة'),
	(2, 'متابعة'),
	(3, 'حالة وظيفة'),
	(4, 'تعبئة رصيد');
/*!40000 ALTER TABLE `note_type` ENABLE KEYS */;

-- Dumping structure for table job_libya.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `data` varchar(255) NOT NULL DEFAULT 'notnull',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note_type_id` int(11) DEFAULT NULL,
  `isread` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`seeker_id`),
  KEY `notifications__indexacs` (`id`),
  CONSTRAINT `notifications_seekers_seeker_id_fk` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.notifications: ~217 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table job_libya.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
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

-- Dumping data for table job_libya.oauth_access_tokens: ~86 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('0053c9b2b5aafcb834257ed1f3c19bedf6da0a4baf59d39f246559fd940b52c71a759946309b95d3', 9686, 2, NULL, '[]', 0, '2018-04-20 21:17:19', '2018-04-20 21:17:19', '2019-04-20 21:17:19'),
	('00b51a970245c49777b6cbd7440d99506902a76a93e5fa9ee80d1834a3ae3de109c8102c0342b762', 9702, 2, NULL, '[]', 0, '2018-04-24 11:30:16', '2018-04-24 11:30:16', '2019-04-24 11:30:16'),
	('029d3fde6c7b26e055d6b250772db833a4bde663970faf0da95dba5b8a849d5bd4986b20c2164b3a', 9686, 2, NULL, '[]', 0, '2017-11-26 23:50:46', '2017-11-26 23:50:46', '2018-11-26 23:50:46'),
	('0313a98326a7c70067d53b4cbf486f6ef9007f0a89f74dcf8653ae03e98879ecdd802e7da778d228', 9686, 2, NULL, '[]', 0, '2018-02-05 10:59:54', '2018-02-05 10:59:54', '2019-02-05 10:59:54'),
	('032643efdd56c833beea98d6cf738aa6319ea0be9f337ab98187b5681f529fd16164b3b8dfaf6c4d', 9627, 2, NULL, '[]', 0, '2018-01-31 11:52:13', '2018-01-31 11:52:13', '2019-01-31 11:52:13'),
	('047335615ff0fe42581d392cf701418566f31ee6907d107d0b73f41f851771ea8800ced766721d55', 9702, 2, NULL, '[]', 0, '2018-01-31 13:17:39', '2018-01-31 13:17:39', '2019-01-31 13:17:39'),
	('089ec7f7e8870e290fac07d64773a04bada46117e19a1e06f4dccc8e95c922c8c36f8a8ffab9183c', 9686, 2, NULL, '[]', 0, '2018-04-19 14:27:46', '2018-04-19 14:27:46', '2019-04-19 14:27:46'),
	('0a483e87c3aac501e122bb79962ca5d196b08bf2a08d075ac514715566065c02da026e16daa89470', 9686, 2, NULL, '[]', 0, '2018-05-02 13:02:59', '2018-05-02 13:02:59', '2019-05-02 13:02:59'),
	('0ae56c68ec97e770847787c042594faa1e56e95920764171fdd1c4dd2725022882287675400bf8b4', 9627, 2, NULL, '[]', 0, '2018-01-31 11:52:22', '2018-01-31 11:52:22', '2019-01-31 11:52:22'),
	('0c8516201dc11c74e66406ec00f97352c3d6bbcbdc734a94e0437596b7e5d234a71eb812df9b615a', 9686, 2, NULL, '[]', 0, '2017-11-28 11:27:39', '2017-11-28 11:27:39', '2018-11-28 11:27:39'),
	('11311695608152edde7a9ed7c3116f4f6d767768ee8f27a9c6280329c6dd708649ff9133a4e172c2', 9686, 2, NULL, '[]', 0, '2018-01-31 13:14:57', '2018-01-31 13:14:57', '2019-01-31 13:14:57'),
	('14055e5bc4ada2d79ea3094e303858dc4c592bf24b96a48687efb440ae77513897eed3e223387811', 9686, 2, NULL, '[]', 0, '2018-04-08 18:26:17', '2018-04-08 18:26:17', '2019-04-08 18:26:17'),
	('14866c3b5fd06cb00c44f189c1da486df251f24b828f4f6aa29b388c52c6d0f731789c5b0f3d6b51', 9702, 2, NULL, '[]', 0, '2018-04-24 11:26:57', '2018-04-24 11:26:57', '2019-04-24 11:26:57'),
	('1800bbd673c22408fdf1005d8837a18cec804eadb48c1d602c59c015567f751268b1bd789a6dc35a', 9702, 2, NULL, '[]', 0, '2018-01-12 23:04:38', '2018-01-12 23:04:38', '2019-01-12 23:04:38'),
	('1b4b1d14bb3291fb732c18768c73609f055e2d17e57cb33a3b4a2c94d7be495da9bb19ebeee72b6e', 9702, 2, NULL, '[]', 0, '2018-01-14 13:14:15', '2018-01-14 13:14:15', '2019-01-14 13:14:15'),
	('1d2a7bd5205fc12777bee4de2bf44c3f401e9f6a2c03e82d774f8c29efd228d750ce80d71f3be815', 9686, 2, NULL, '[]', 0, '2017-11-28 11:08:08', '2017-11-28 11:08:08', '2018-11-28 11:08:08'),
	('1dcc0bc18c2094ec6697d186f6ef9480378dcacf3aa317a79d32552504c5e96f31a848bf17c40314', 9686, 2, NULL, '[]', 0, '2018-01-31 12:05:39', '2018-01-31 12:05:39', '2019-01-31 12:05:39'),
	('1f6a57516dc6b0e03d326b9c8d237383d0a1716dc00a0cab17a16181524abdbef72866b769f838f5', 9627, 2, NULL, '[]', 0, '2018-03-26 13:31:41', '2018-03-26 13:31:41', '2019-03-26 13:31:41'),
	('20c5309e92d9a49e0b13fa95e4fe51467ec301c46c840b072ef24da8b5d9234049f32b18cb91dab7', 9702, 2, NULL, '[]', 0, '2018-03-24 01:54:13', '2018-03-24 01:54:13', '2019-03-24 01:54:13'),
	('2172cc1dabecc98430f784cf7122b763b59e387ed3c565b25ceed4b8ec97074bec8a799b85943dac', 9686, 2, NULL, '[]', 0, '2018-01-15 11:30:26', '2018-01-15 11:30:26', '2019-01-15 11:30:26'),
	('21bab3d19e1b020c84e9d80d0d7701995a1aa99e3d01e187ffbad55130b3dba3cce4aba79d86ce04', 9627, 2, NULL, '[]', 0, '2017-12-03 12:50:17', '2017-12-03 12:50:17', '2018-12-03 12:50:17'),
	('23ffb7ddaf80d5e8926c69a24e90b87fabb682fbeadf4bc0d976f5ce7e591f4e385fbda14ee3597d', 9686, 3, NULL, '[]', 0, '2017-12-25 11:35:03', '2017-12-25 11:35:03', '2018-12-25 11:35:03'),
	('25d370ce53c60a13c8f2e2285c8bd96ef3b486139734ace34bf7911296743265f0974f384b3e13dc', 9702, 2, NULL, '[]', 0, '2018-03-24 02:04:01', '2018-03-24 02:04:01', '2019-03-24 02:04:01'),
	('28b7e615033b5ec1b2d2e34e7b98b3f3ab24f673eddb20ee82a5c678cc1d61df166bc5a5b09f0f1e', 9627, 2, NULL, '[]', 0, '2017-12-07 11:45:31', '2017-12-07 11:45:31', '2018-12-07 11:45:31'),
	('2b07838237fb5279afeee5536a08f6a0d0658e47d1b3c2fe9453c6e62f74fbcf72ae3f269a9ceff7', 9702, 2, NULL, '[]', 0, '2018-01-12 23:30:55', '2018-01-12 23:30:55', '2019-01-12 23:30:55'),
	('2c27c7f962f5f2b80db07c364cf7342960debc89ea764c1124fdaf7bccf346975b1c58d07257d4f5', 9686, 2, NULL, '[]', 0, '2018-04-08 18:58:45', '2018-04-08 18:58:45', '2019-04-08 18:58:45'),
	('2c519f44bf6bd12b1cad32cacbbae26dd6097b842892a8cfdf75e28ca746a451793ed40e20a65b33', 9686, 2, NULL, '[]', 0, '2018-01-31 12:05:39', '2018-01-31 12:05:39', '2019-01-31 12:05:39'),
	('2d17aea5543f5f68f2e51ea1cccc2fa996d55e1f719028351a58f510612c8bb915d4fae8e9f367bf', 9627, 2, NULL, '[]', 0, '2017-11-30 19:04:54', '2017-11-30 19:04:54', '2018-11-30 19:04:54'),
	('2d474f207e0fb4827e1484b315e461c2d0c01dc3c17fc56cee09947fb1fa9ae8fdecf0847905f965', 9686, 2, NULL, '[]', 0, '2018-01-17 11:16:47', '2018-01-17 11:16:47', '2019-01-17 11:16:47'),
	('2d5c9e02aaadf4ef3bce2673e4c24a06aed9f9876e1587ee5b95ab2683b923d81f10ee9634e982ca', 9702, 2, NULL, '[]', 0, '2018-01-12 23:04:38', '2018-01-12 23:04:38', '2019-01-12 23:04:38'),
	('3042ee1328e343bf807a12f1fde45a56ba9536122bbc392c890bfe49227a4563555a23e014917580', 9686, 2, NULL, '[]', 0, '2018-01-31 12:05:57', '2018-01-31 12:05:57', '2019-01-31 12:05:57'),
	('31482ba9b960ae593a61a138adca164c1bd4ecfa4d02e8dc404151789cf1a018ad64e1581d7031f4', 9686, 2, NULL, '[]', 0, '2018-01-12 23:35:02', '2018-01-12 23:35:02', '2019-01-12 23:35:02'),
	('3467045e13ae3114d3d3126f670c6c50c9a366c5a415e39adc2ee401c32362f16a7084263853f4be', 9627, 2, NULL, '[]', 0, '2018-03-09 00:01:55', '2018-03-09 00:01:55', '2019-03-09 00:01:55'),
	('35d9844381bd6c1442dd34c2569ffdaf6ec9d3e36e7bee88cd782e0e019b7cac1eca51f17cc9e641', 9686, 2, NULL, '[]', 0, '2018-04-08 19:01:17', '2018-04-08 19:01:17', '2019-04-08 19:01:17'),
	('37086ed2d4c58ca1c1077d0fd3d7d0d3d3d9bd37557cfaa09ccca9082edf1ae64e85c801244f949e', 9686, 2, NULL, '[]', 0, '2017-11-28 11:24:31', '2017-11-28 11:24:31', '2018-11-28 11:24:31'),
	('3a0fcbb7d0b3a57d02899e76d3b4014c13beee4b8a412f9914c7f59af59b9fcdb095030f8b97f836', 9686, 2, NULL, '[]', 0, '2018-04-25 18:43:11', '2018-04-25 18:43:11', '2019-04-25 18:43:11'),
	('3c16c9fef8ffe9926e05766f25a7a8349cfd3e8247f98f05cfbed887e4ef89e0d99f91bdb2c37edd', 9686, 2, NULL, '[]', 0, '2018-03-24 00:49:12', '2018-03-24 00:49:12', '2019-03-24 00:49:12'),
	('3c47f1710d5ebc4c1f448e6ec87c32fdae51c7affb77c41b7bccc7a8cb8f6ca115980c2fa8820617', 9702, 2, NULL, '[]', 0, '2018-01-12 23:30:41', '2018-01-12 23:30:41', '2019-01-12 23:30:41'),
	('3e0a1b153c0df99a815577ef8b6772eb1dbcc7aa3415ac5077ee85f373c9fa6db3ef27034e936ed3', 9702, 2, NULL, '[]', 0, '2018-01-12 02:43:12', '2018-01-12 02:43:12', '2019-01-12 02:43:12'),
	('3fea9787a833c393c79cf03b20b003c6a7d4034db03b8da6597c54e3a88d376a7c706c6229e1c55e', 9627, 2, NULL, '[]', 0, '2017-12-01 13:31:37', '2017-12-01 13:31:37', '2018-12-01 13:31:37'),
	('4208030afa0eb8e58ad7fddfab2fb4109ee10e470324cf0f340a23c01a19caaecd045451a7bc8f28', 9627, 2, NULL, '[]', 0, '2017-12-07 11:44:08', '2017-12-07 11:44:08', '2018-12-07 11:44:08'),
	('4391691d6377883c92b123ddd64c31be21d14565b0c9c6737d9498966704687f299182b6be1357f7', 9627, 2, NULL, '[]', 0, '2017-11-30 23:36:15', '2017-11-30 23:36:15', '2018-11-30 23:36:15'),
	('473a3452090d72f8e6d884df9b706b471f67eec3fefbd7824d16dbcf296689c7978e86d9c3d2e387', 9702, 2, NULL, '[]', 0, '2018-01-12 02:41:48', '2018-01-12 02:41:48', '2019-01-12 02:41:48'),
	('4797a81221e4bd988189db413e2c96e18913aa40ed7a21fa42dbedbaf90ca1f29dec5131c76341dc', 9686, 2, NULL, '[]', 0, '2018-04-07 12:55:37', '2018-04-07 12:55:37', '2019-04-07 12:55:37'),
	('486295c8a1965cf838f9170e42b511bf80e40ad844730989479f0602eb77471a5c2f937c685f0f8d', 9686, 2, NULL, '[]', 0, '2018-01-31 13:46:15', '2018-01-31 13:46:15', '2019-01-31 13:46:15'),
	('4afc36e767bada0b06a145a2dde7e27a93831d57edf0536acf4c03d64dbf825ae3b0ad17cc389870', 9702, 2, NULL, '[]', 0, '2018-01-12 21:42:56', '2018-01-12 21:42:56', '2019-01-12 21:42:56'),
	('4db43df7104ffdf0b1055cecdda65f01a7b339303e97fc9e3a19c75ac3ec7d5b4e7d8835745973d7', 9686, 2, NULL, '[]', 0, '2018-04-07 23:11:21', '2018-04-07 23:11:21', '2019-04-07 23:11:21'),
	('4e7bea8f3bf815f059e254067128004a25430d694c33db80b21ad4c2695e2b426d2c302a5441ae4a', 9686, 2, NULL, '[]', 0, '2018-04-08 18:41:28', '2018-04-08 18:41:28', '2019-04-08 18:41:28'),
	('4f3b55ecdce965fb98b0f5d9b0b25586d48667458ef0b01a7efd9171d99ed6f2a0fa6069b0474e0a', 9686, 2, NULL, '[]', 0, '2017-11-28 11:42:25', '2017-11-28 11:42:25', '2018-11-28 11:42:25'),
	('51c9b64b14e6a41be352147947b42c10b32729efedccd33e4aaa3a2c66022b6f1d3dd663e9de6283', 9627, 2, NULL, '[]', 0, '2018-03-22 23:03:59', '2018-03-22 23:03:59', '2019-03-22 23:03:59'),
	('524abe1568e88bd4430fe319ee0d10595aaee18a5f9a58437749ee9c9f32dcb272a8ed8cbfe8dfae', 9702, 2, NULL, '[]', 0, '2018-04-24 21:03:13', '2018-04-24 21:03:13', '2019-04-24 21:03:13'),
	('56288e59c71b673a77095b2c9300d2fed5578252550462e51a2a1f62b4f455d0bf33c4915af92b1b', 9686, 2, NULL, '[]', 0, '2017-11-26 20:15:37', '2017-11-26 20:15:37', '2018-11-26 20:15:37'),
	('56d787fb5746281d5c206e7c8ef5e791ada367220660ff4f2efd4fee6547719b002e7facecd61287', 9686, 2, NULL, '[]', 0, '2018-04-24 11:38:42', '2018-04-24 11:38:42', '2019-04-24 11:38:42'),
	('58cf88fe7fb9e4cda0c451083d66a8223d0ec3eafb89bb17a768e98a5b3c142628140918506416c6', 9686, 2, NULL, '[]', 0, '2018-01-17 11:05:19', '2018-01-17 11:05:19', '2019-01-17 11:05:19'),
	('5a41feb09e7633e11430ff66881894e0265befb00e18deffb7dd8bf2e0e61f6aadabc505196eb809', 9702, 2, NULL, '[]', 0, '2018-01-12 23:35:14', '2018-01-12 23:35:14', '2019-01-12 23:35:14'),
	('5be322f4fc626755bce7579cb3bfe3e21cc3fe5531d6c0d42bb364277a2237692eab218be8788f72', 9686, 2, NULL, '[]', 0, '2018-03-09 00:03:26', '2018-03-09 00:03:26', '2019-03-09 00:03:26'),
	('5c5fbcebde19b6c188296c34cb28f871451ec9ca09dd2357c11abd26b8399f76231e28a3f1077221', 9627, 2, NULL, '[]', 0, '2018-01-11 21:59:05', '2018-01-11 21:59:05', '2019-01-11 21:59:05'),
	('5db0fa8904c4c4fc4484889f6549e7787c4e603f2777fb2b908664b9222fe0957f254a6b2cda58f1', 9686, 2, NULL, '[]', 0, '2018-01-12 23:31:07', '2018-01-12 23:31:07', '2019-01-12 23:31:07'),
	('5fc66f8258967e319c079886f57c6b04a086c9c94cd08b377c084764c4aacc520dfd4be60fa2e213', 9686, 2, NULL, '[]', 0, '2018-04-25 18:42:34', '2018-04-25 18:42:34', '2019-04-25 18:42:34'),
	('5fcd780f76c4b763d7f65dda6cba0b205ac72c7093e2940abb8dce4df0007215c9d3db611db8be0d', 9702, 2, NULL, '[]', 0, '2018-04-22 13:56:12', '2018-04-22 13:56:12', '2019-04-22 13:56:12'),
	('63dc0038270c19d218ee48c388f74da5f4e178f6e58daa82757f9c745b55c8755ac558d63ad02ee8', 9686, 2, NULL, '[]', 0, '2018-01-31 12:05:39', '2018-01-31 12:05:39', '2019-01-31 12:05:39'),
	('665531eaa1630b44cd05cf70e681be9576161499bbc7fe2f149ac4716c1161e0c158130dd4cc4f78', 9702, 2, NULL, '[]', 0, '2018-01-12 02:03:47', '2018-01-12 02:03:47', '2019-01-12 02:03:47'),
	('692edec7fff7ede83fe89d9f1771380df7059de296ac92c8b616db234cd3409d2a2fc494720ed256', 9686, 2, NULL, '[]', 0, '2018-02-05 11:01:14', '2018-02-05 11:01:14', '2019-02-05 11:01:14'),
	('6b949c9e2d74f8879f658761e9a862ee3b1ab99783d5cc7fb9dbf1ab21cf014b1c4112f8507ea60c', 9694, 2, NULL, '[]', 0, '2018-01-12 01:16:51', '2018-01-12 01:16:51', '2019-01-12 01:16:51'),
	('6f7a4d3d8a90b05ca5d94aa3d05a5cd8d7b3db0357003dddebb14fde1ff0d5d412add3c471442949', 9686, 3, NULL, '[]', 0, '2017-11-24 12:55:14', '2017-11-24 12:55:14', '2018-11-24 12:55:14'),
	('77ca6a51ff52582f0bd3e802f80b59554edc4d20c59ece7bebd087633af5dac8b58d40d00ef61fd9', 9686, 2, NULL, '[]', 0, '2018-04-13 13:03:04', '2018-04-13 13:03:04', '2019-04-13 13:03:04'),
	('7c2f244e92f09f87439269497654869c10e89e8b486eb4101cdfd5a8b471734c5b357505cb06a939', 9686, 2, NULL, '[]', 0, '2018-04-08 18:54:10', '2018-04-08 18:54:10', '2019-04-08 18:54:10'),
	('7d28e33447d0d63f82f827166caaa5f836bd167db30e344899994c33f72fc218fc212e1d8c22b3d1', 9686, 2, NULL, '[]', 0, '2018-01-31 13:46:15', '2018-01-31 13:46:15', '2019-01-31 13:46:15'),
	('81f44b26bd30ca1b99ffa7ffd511d42cb951b80d811510a6631e8fb1dade3004ebda9850a5fecffc', 9686, 2, NULL, '[]', 0, '2018-04-13 11:37:55', '2018-04-13 11:37:55', '2019-04-13 11:37:55'),
	('83a40178bde07d6494052c7bab34bc0e8bffe15299e7c5c488bfb0b4c9b9dd1d95e8c9b638f46313', 9686, 2, NULL, '[]', 0, '2018-04-23 20:51:34', '2018-04-23 20:51:34', '2019-04-23 20:51:34'),
	('8a782a96f9b4819b071e51cb6803ff808fdcfc6c0f2d18df1bd498bde1703faee5cbc4d1c68adf09', 9686, 2, NULL, '[]', 0, '2018-01-12 23:35:07', '2018-01-12 23:35:07', '2019-01-12 23:35:07'),
	('8acac9baddcfa8c74c10e7e2d1c5b5c442f76a0ff1ba286561b535f526bd75263fa64a5e26bd6559', 9686, 2, NULL, '[]', 0, '2017-11-28 10:17:01', '2017-11-28 10:17:01', '2018-11-28 10:17:01'),
	('8b958e5884ee3bf29fa215b5167d986de2d9315b36b7d915c3635006bcedd49d459caf7ad8b491f1', 9686, 3, NULL, '[]', 0, '2017-11-24 12:55:54', '2017-11-24 12:55:54', '2018-11-24 12:55:54'),
	('8d0be931ab70f3c796f4fbd38a6d00022642e9d89a28658b84b965493f530b4ef1674473e26d4914', 9686, 3, NULL, '[]', 0, '2017-11-24 12:55:24', '2017-11-24 12:55:24', '2018-11-24 12:55:24'),
	('8d9eb8cef360a31f9933107c59a468145b682c1436ee2c8204cde3151c672b20060f5968bcc8b255', 9686, 2, NULL, '[]', 0, '2018-04-23 20:54:30', '2018-04-23 20:54:30', '2019-04-23 20:54:30'),
	('8df53af60a98fe22057fb57b465fce7432e0fb8b8a40f60d0b7fd7419f6505f5eafded9c81fb0839', 9686, 2, NULL, '[]', 0, '2017-11-26 23:52:05', '2017-11-26 23:52:05', '2018-11-26 23:52:05'),
	('8e0d705f8982d1023e6a9bdbdd32787b71903af3e2c7a640bb7b030b9e1816187fbabe88786f0741', 9627, 2, NULL, '[]', 0, '2018-01-10 14:25:20', '2018-01-10 14:25:20', '2019-01-10 14:25:20'),
	('8f58a1444c2ac7ecd10cf85f4b597f84a8d1a9a321a3f9cd4bad86f74591dcfa0065b8e7e745f6a5', 9686, 2, NULL, '[]', 0, '2018-04-07 13:54:48', '2018-04-07 13:54:48', '2019-04-07 13:54:48'),
	('908ff1c8dc9fe3c15aaedd2619aca66c218a70066ca9b1ba96e499a95f9ed8b11bb714cc2b839f4e', 9686, 2, NULL, '[]', 0, '2017-11-26 23:48:29', '2017-11-26 23:48:29', '2018-11-26 23:48:29'),
	('92920edd820f162c020b61bd7c64f0c331500b8304be0d2a9adee392cb77e6c180c89c5c018df39a', 9686, 2, NULL, '[]', 0, '2018-04-08 18:52:31', '2018-04-08 18:52:31', '2019-04-08 18:52:31'),
	('95dc367a05c0bca3215c63e4d9a4138027809cc9691eb97acfa24a18df757042a122564fb6f9d252', 9627, 2, NULL, '[]', 0, '2018-01-12 02:41:22', '2018-01-12 02:41:22', '2019-01-12 02:41:22'),
	('988679b5db43e94f3c368ee9d1ceb29e79faf6d45b1ae135e83b774ec30bb73d2ee8d6eb179c3bd0', 9627, 2, NULL, '[]', 0, '2017-11-30 19:54:59', '2017-11-30 19:54:59', '2018-11-30 19:54:59'),
	('98b9eaaf82fcd3ee4cd1223d007d2876bbc6465e0520891e8631ebcc39711bcf19053a0e6c24f8bb', 9686, 2, NULL, '[]', 0, '2018-01-12 21:55:42', '2018-01-12 21:55:42', '2019-01-12 21:55:42'),
	('9bcf6b33251689b28f974bcae00d1a0e4169cd9ef11793a54d86f988e59bda988cfa8feb8462a758', 9627, 2, NULL, '[]', 0, '2017-11-30 19:05:19', '2017-11-30 19:05:19', '2018-11-30 19:05:19'),
	('9d0c90228fd8bc3d7d866ccd5b935f900d5140b19113cabe77b4dc588d05cd42a8fa693cc9694a06', 9702, 2, NULL, '[]', 0, '2018-04-22 11:40:38', '2018-04-22 11:40:38', '2019-04-22 11:40:38'),
	('9d9a1ec6732809b5c0c8db8a2d4f1b1e77783475518fff543a487e0a61aec7e8b248d432bf16c669', 9702, 2, NULL, '[]', 0, '2018-01-12 02:10:31', '2018-01-12 02:10:31', '2019-01-12 02:10:31'),
	('9f95bce6b94ca984993de6e34a92909a7df6bc9b0a74c873f4ceadb0005b1f7459dda2a471a717a7', 9686, 2, NULL, '[]', 0, '2017-11-28 10:11:59', '2017-11-28 10:11:59', '2018-11-28 10:11:59'),
	('a51d39e16e50796a2e28e24a962519077c7c9ec04966f84f4b034b251c6867900cd482dad4c627d9', 9686, 2, NULL, '[]', 0, '2018-04-07 12:53:24', '2018-04-07 12:53:24', '2019-04-07 12:53:24'),
	('a74f0d930d05b5fb8e58a2212827e1330ecdeebebe109efcf8a2eb7eb1ff46cedfac84fc61d2aea3', 9686, 2, NULL, '[]', 0, '2018-01-17 11:10:16', '2018-01-17 11:10:16', '2019-01-17 11:10:16'),
	('a8b40e95e3d455453b2f2719a6dcda6568ed86f136b1bf74159283f9aa0713b2636ffcf1db1c6746', 9686, 2, NULL, '[]', 0, '2018-01-18 19:50:33', '2018-01-18 19:50:33', '2019-01-18 19:50:33'),
	('aa618a7fdf37ec960294a4088ccc80a485f13cae9afd994ce94879d6b87e7a503c53c4713318eaac', 9686, 2, NULL, '[]', 0, '2018-02-26 02:33:27', '2018-02-26 02:33:27', '2019-02-26 02:33:27'),
	('aa922926e40361df8149909c13e5e132edb02edcb4ef4882dca7441b23796bfec627c2f15049a0c3', 9706, 2, NULL, '[]', 0, '2018-01-12 02:00:22', '2018-01-12 02:00:22', '2019-01-12 02:00:22'),
	('aaf131254c290b762b87951416f3a66561c505e730f11476d59933ec742a0fc2ac3c12e4771bf76c', 9686, 3, NULL, '[]', 0, '2017-12-25 11:36:50', '2017-12-25 11:36:50', '2018-12-25 11:36:50'),
	('ad35a3986ed748ca2465d909497e3da4c3300934ae8172465623bcdb1e6fd1498724513a67e8ada1', 9686, 3, NULL, '[]', 0, '2017-11-24 12:56:18', '2017-11-24 12:56:18', '2018-11-24 12:56:18'),
	('b0c04ec55118805351c7a46811d8a498d74e32a44ad5128ec05ece2aeda8c1b854bd9ce3f458ab73', 9627, 2, NULL, '[]', 0, '2017-12-06 11:31:51', '2017-12-06 11:31:51', '2018-12-06 11:31:51'),
	('b2076e7ade94362005227fda54a6b654b25b40766eaddc418d85d9561e4ccf6adf907474dbd9ed51', 9702, 2, NULL, '[]', 0, '2018-01-12 21:42:42', '2018-01-12 21:42:42', '2019-01-12 21:42:42'),
	('b22dfeb0f762540cb817a4bd9ae1362bca9c3a64ab5f1e4cef2aa0cbfe46a20c53d2966d097d8bae', 9702, 2, NULL, '[]', 0, '2018-03-24 00:53:56', '2018-03-24 00:53:56', '2019-03-24 00:53:56'),
	('b3424858385cf55e33a93464a3cf089bf787e45d7d06cdfe006a4aab2cd0e629f6d9f99d0b69684a', 9686, 2, NULL, '[]', 0, '2018-04-18 21:16:45', '2018-04-18 21:16:45', '2019-04-18 21:16:45'),
	('b3ba8b5a0f8a37011d73dfcd8c2949e13760fd4fcc7383c64c759bbd7725db7f994aa5067334e189', 9702, 2, NULL, '[]', 0, '2018-01-12 02:22:36', '2018-01-12 02:22:36', '2019-01-12 02:22:36'),
	('b42e419e82272a29d12e0b4dcf1053bb042552539625fda0fc405842ffabd37f89ab7f4c3e26e6b7', 9686, 2, NULL, '[]', 0, '2017-11-28 11:41:03', '2017-11-28 11:41:03', '2018-11-28 11:41:03'),
	('b484dd6c4f054fcfcc17c8274e913a90dfd8e0b45a3d86d329ab068558dd4477454e97942ff19354', 9702, 2, NULL, '[]', 0, '2018-03-23 04:52:01', '2018-03-23 04:52:01', '2019-03-23 04:52:01'),
	('b67eab68c279e63b9fef6c4e052e54cb06aedc8848a86497a3a8cf05bcb6b9a9321ef9d8030f95bd', 9694, 3, NULL, '[]', 0, '2017-12-25 11:37:14', '2017-12-25 11:37:14', '2018-12-25 11:37:14'),
	('ba38b3c4dfdbd52a44d38705e711c4630ed491e90e38806f3d91efb0f3689d4ab3ff99ad6bc9a3b8', 9686, 2, NULL, '[]', 0, '2018-01-12 23:05:12', '2018-01-12 23:05:12', '2019-01-12 23:05:12'),
	('ba445d769af0ea009234265998e783dfe531e5f80373a2f658ac0e7f425f040ce2c36337044dc883', 9686, 2, NULL, '[]', 0, '2018-04-07 12:54:57', '2018-04-07 12:54:57', '2019-04-07 12:54:57'),
	('bb957307e86ec7b9eda50f1872c9b4966b6d2a7f8c3290e7e4d8ed861b5ec739b5c8210a08052797', 9686, 2, NULL, '[]', 0, '2017-11-28 14:21:17', '2017-11-28 14:21:17', '2018-11-28 14:21:17'),
	('bbfebcd995eda72db1d1c5e1cf952922b957371ddefe9cf5c94324f9133fdd1bf9e70d62e47233d5', 9686, 2, NULL, '[]', 0, '2018-04-08 18:57:59', '2018-04-08 18:57:59', '2019-04-08 18:57:59'),
	('bc221f1153eb704f557baae391dbb00ba26d21786cb34e7bee8c38ea50399dce6a74dcd222390df2', 9702, 2, NULL, '[]', 0, '2018-03-24 14:05:52', '2018-03-24 14:05:52', '2019-03-24 14:05:52'),
	('bccc008a9bc35f5a5021b42af80d088624faebffd3054483aaedc4b551ce57259a94e9360d08055e', 9694, 2, NULL, '[]', 0, '2018-01-12 01:17:08', '2018-01-12 01:17:08', '2019-01-12 01:17:08'),
	('bce9ffcad8c03251a0680d05d162231ce1a9c6e61c5b45e8ec3e4f53bd65e4a7776164e577212992', 9627, 2, NULL, '[]', 0, '2017-12-07 11:42:13', '2017-12-07 11:42:13', '2018-12-07 11:42:13'),
	('be95227bae48bf49fb77f632c4f9f6b5a5398689bc064d5751315aa3b9c0e3186d26d1eb5ec171ef', 9627, 2, NULL, '[]', 0, '2018-03-24 00:49:58', '2018-03-24 00:49:58', '2019-03-24 00:49:58'),
	('c0b83c28fa6f632b6be077d7dbedfd2cb11c33a8795ea1b7ebb506479f79825bd6f2c00e67151dc3', 9627, 2, NULL, '[]', 0, '2017-12-07 11:19:40', '2017-12-07 11:19:40', '2018-12-07 11:19:40'),
	('c1c9748a814232c93838a651ee89e48aa8bbc28604d120dd5c600006dac8a08e72ab49e91cfe0c0d', 9702, 2, NULL, '[]', 0, '2018-01-12 23:35:14', '2018-01-12 23:35:14', '2019-01-12 23:35:14'),
	('c1d484b37e84e44e0ea5381f119ae2ec9bec4018df93fa53a7b64864ad44f8432449667b08a2e587', 9686, 2, NULL, '[]', 0, '2018-01-31 12:29:54', '2018-01-31 12:29:54', '2019-01-31 12:29:54'),
	('c2af47ea44e0c4ff42d6ff07f863ab207949fbe907066dbac6b562b386c6749b50cb484157b011a3', 9686, 2, NULL, '[]', 0, '2018-03-23 03:01:29', '2018-03-23 03:01:29', '2019-03-23 03:01:29'),
	('c3cb8609644cd04087e2334c9d712f530b80483301ca7dcd1a038ec966d42e70f82f9ee23d0ef72e', 9702, 2, NULL, '[]', 0, '2018-04-24 21:22:45', '2018-04-24 21:22:45', '2019-04-24 21:22:45'),
	('c5912c41d70535173ee735abe12c9ba13b223a64e7bf3c8bd35c5f8fde87729a593c6ecf9152ada5', 9627, 2, NULL, '[]', 0, '2017-12-07 11:46:30', '2017-12-07 11:46:30', '2018-12-07 11:46:30'),
	('c815032b0d8431ed4f0dbc7750f3398096c2ee399a8a0b45ba9313d418ad838960025d4cd45c8453', 9686, 2, NULL, '[]', 0, '2018-01-18 19:48:50', '2018-01-18 19:48:50', '2019-01-18 19:48:50'),
	('c9076d45adf494011d70269ac4287a342c5cb4d99e832507614e0cf7e41fbfc806863388bd9d0f6e', 9702, 2, NULL, '[]', 0, '2018-01-12 02:04:41', '2018-01-12 02:04:41', '2019-01-12 02:04:41'),
	('ca37c26fe57033b6b5b0ed26c27d0d7632d20543d7bbb1e5eca117d29512c647ff8dc440972a2b17', 9686, 2, NULL, '[]', 0, '2018-04-08 18:38:46', '2018-04-08 18:38:46', '2019-04-08 18:38:46'),
	('ccf763da22c1596c1dab65160b328c49cf0bca9da090d508e176f825b620309505f54a361c30ffd1', 9702, 2, NULL, '[]', 0, '2018-04-22 14:02:31', '2018-04-22 14:02:31', '2019-04-22 14:02:31'),
	('ce96cdbd5eb1077f23d4557d61b491b1b371b4db22201b10abe674829e755da5983fbe4ece410496', 9686, 2, NULL, '[]', 0, '2018-04-21 18:57:11', '2018-04-21 18:57:11', '2019-04-21 18:57:11'),
	('cefc79f004f7e048f6426dc5bf8df6a6309b182a63c9e44888fb33877ff9cf003ccbb619379356e0', 9627, 2, NULL, '[]', 0, '2017-11-30 19:06:17', '2017-11-30 19:06:17', '2018-11-30 19:06:17'),
	('d150ed2bf649708114556c496001786dc63f2d72aa1aae3110de41b53ae8ea766f3a0511dcff649d', 9686, 2, NULL, '[]', 0, '2018-03-20 01:06:15', '2018-03-20 01:06:15', '2019-03-20 01:06:15'),
	('d5045e47c5120aef52d28536e1a9249718dcd6d434abbcb1a5ce396e3e68afde5ade0b3a132a2283', 9686, 2, NULL, '[]', 0, '2018-01-12 23:31:01', '2018-01-12 23:31:01', '2019-01-12 23:31:01'),
	('d550f5adda610bdd414d162c5e1ae8c28195c5a4ecb1257d240c336f8fc219516cf54fc665093495', 9702, 2, NULL, '[]', 0, '2018-04-22 10:56:05', '2018-04-22 10:56:05', '2019-04-22 10:56:05'),
	('d72daebbe5dc94e8b7a8e1de258556ca2fc1455ebe0ba33fe41dbbaeae0f2e73803464fdf835f727', 9686, 2, NULL, '[]', 0, '2018-04-24 00:17:34', '2018-04-24 00:17:34', '2019-04-24 00:17:34'),
	('d9cb4ae748ff7ccc260a7a302f5bcabbfebd85ecaf30cb6551ba166b255e01db6d04a6d19f188fa9', 9686, 2, NULL, '[]', 0, '2017-11-28 14:19:42', '2017-11-28 14:19:42', '2018-11-28 14:19:42'),
	('dbc2a3ad8ee403633ca6e1e9d02ff9cda1afcda0e397847b334cc62bfca133426a51ca61f8089abf', 9702, 2, NULL, '[]', 0, '2018-04-22 14:03:11', '2018-04-22 14:03:11', '2019-04-22 14:03:11'),
	('dec528c539ae7cb8764237dc2b0c6a2f0dc12f92a193b94827413e79b888b7b09e4449e775276f82', 9627, 2, NULL, '[]', 0, '2017-11-30 14:10:48', '2017-11-30 14:10:48', '2018-11-30 14:10:48'),
	('deee73d2565bcb4be5bd88492af9d8c85fdc6c50b39390803befd04b00534ccd896bd2352e96f475', 9702, 2, NULL, '[]', 0, '2018-01-17 11:10:12', '2018-01-17 11:10:12', '2019-01-17 11:10:12'),
	('e27e73f1b3b47b9ca7c4dce0b4f3469f8942430f2b88f43a67bfdba59b1f02a963da70c153179e7e', 9627, 2, NULL, '[]', 0, '2017-11-30 14:14:11', '2017-11-30 14:14:11', '2018-11-30 14:14:11'),
	('e3b5dd2e28a0c9bc64a7e74839a31cda41e7559c3f7b3313d3572ea4a6b1b12b53d37718e8a779dd', 9694, 2, NULL, '[]', 0, '2018-01-12 01:16:42', '2018-01-12 01:16:42', '2019-01-12 01:16:42'),
	('e74751051e16d729451af881d13b4c24483ee08134edf79e0674bf951b43fff6df2fb8bee5282ad6', 9686, 2, NULL, '[]', 0, '2018-01-15 11:37:17', '2018-01-15 11:37:17', '2019-01-15 11:37:17'),
	('e90c3c6cc55bfde41cf484c8ff1ed61e74a2e60e81a9c63cabeff70b56c5917a67b55edf506a6e2b', 9686, 2, NULL, '[]', 0, '2017-11-28 12:31:53', '2017-11-28 12:31:53', '2018-11-28 12:31:53'),
	('ea1d065c2ce3654ed61ea3f3e905689e1227f75ff76f8892518fec233025e901ca76cb17abf00fb7', 9702, 2, NULL, '[]', 0, '2018-01-12 23:30:55', '2018-01-12 23:30:55', '2019-01-12 23:30:55'),
	('f08e2e5261d4cc0e8e369f7033e8d45687bca8f812a2f69a3994eb563da235d5d538e8ec1da55392', 9686, 2, NULL, '[]', 0, '2018-04-13 11:34:16', '2018-04-13 11:34:16', '2019-04-13 11:34:16'),
	('f238e21bb98c1ca1855eddd8fb6b8cf109f0c905bd89e0ba7a2221980a6116d1efe3c0c88b67f269', 9702, 2, NULL, '[]', 0, '2018-03-24 00:50:57', '2018-03-24 00:50:57', '2019-03-24 00:50:57'),
	('f2b09058aa29f350c217eef6860fef210d9088020c52edcb7c859c0722942055a84debe2636395b6', 9706, 2, NULL, '[]', 0, '2018-01-12 01:19:00', '2018-01-12 01:19:00', '2019-01-12 01:19:00'),
	('f363b9585e36737786469f0b54492e0006e7962fd3fc6dd3bda09d6853671fb762eb7a34c25fce26', 9686, 2, NULL, '[]', 0, '2018-04-07 23:10:07', '2018-04-07 23:10:07', '2019-04-07 23:10:07'),
	('f7a61339c3153f2a08714de16ba841902334fbbe86ea184447a976653ed7e1ec5fce834d71919c5c', 9686, 2, NULL, '[]', 0, '2018-04-23 20:53:26', '2018-04-23 20:53:26', '2019-04-23 20:53:26'),
	('f7b4626f8e33f497b87e22019ff658ba42dd68f28533a538f20383d9e68ff2d865c195438676d5f9', 9702, 2, NULL, '[]', 0, '2018-04-23 09:53:03', '2018-04-23 09:53:03', '2019-04-23 09:53:03'),
	('f99c621e094aebd0aa4515012ae579e342bf9abfd34cfd693506afeac0a98a843015b3fc0062c6a5', 9686, 2, NULL, '[]', 0, '2017-11-28 10:11:48', '2017-11-28 10:11:48', '2018-11-28 10:11:48'),
	('fbf85888a1b3c4dbf4d33a84a60a1e97ff3abb2f2bcd904fb736906a92a6fadc0b295e193002af2d', 9686, 2, NULL, '[]', 0, '2018-04-07 12:02:37', '2018-04-07 12:02:37', '2019-04-07 12:02:37'),
	('fd0eede92917fe64bc21e1fbf8e93c6f71fdbdd7bb9308964bfb96ee7f90312563746897ef4bf0c7', 9627, 2, NULL, '[]', 0, '2017-12-01 11:43:43', '2017-12-01 11:43:43', '2018-12-01 11:43:43'),
	('ff3a32102c6a3fb034150123a91bd01fc9cc7b38f29215139e67264d94b3d6bbfde6295dab0e74e4', 9627, 2, NULL, '[]', 0, '2017-12-07 11:17:23', '2017-12-07 11:17:23', '2018-12-07 11:17:23'),
	('ff644b855c939d8ca4b295a8f39957d4a5607e002955bae27174fd6cf105d931b37e3c100d9113ac', 9702, 2, NULL, '[]', 0, '2018-04-22 11:40:18', '2018-04-22 11:40:18', '2019-04-22 11:40:18');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table job_libya.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.oauth_auth_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table job_libya.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.oauth_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'UI36hEdAOExdme7vi8RAvZin30IYIbeJARXIgDp5', 'http://localhost', 1, 0, 0, '2017-11-24 11:04:11', '2017-11-24 11:04:11'),
	(2, NULL, 'Laravel Password Grant Client', 'eOqdR81UWrJjSRXn14EMwBsGfzHw7HZLKt5mEJsm', 'http://localhost', 0, 1, 0, '2017-11-24 11:04:11', '2017-11-24 11:04:11'),
	(3, NULL, 'facebook', 'RLJPiMsCuJ0wHxTiGDQGCTZOVCArTNQOJJq40KKD', 'http://localhost', 0, 1, 0, '2017-11-24 11:29:55', '2017-11-24 11:29:55');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table job_libya.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.oauth_personal_access_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2017-11-24 11:04:11', '2017-11-24 11:04:11');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Dumping structure for table job_libya.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.oauth_refresh_tokens: ~86 rows (approximately)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
	('0120533da07f179dbbff9ccc5893e10a2525c15ace7a0301bb67cfc9b319e1f238933a41d9b746ab', '3e0a1b153c0df99a815577ef8b6772eb1dbcc7aa3415ac5077ee85f373c9fa6db3ef27034e936ed3', 0, '2019-01-12 02:43:12'),
	('03816506eceb9b392bf04a0eb1d1f7badf6551e40ad2faf0d04a203df03720114b2095ae8639a8a6', 'aa618a7fdf37ec960294a4088ccc80a485f13cae9afd994ce94879d6b87e7a503c53c4713318eaac', 0, '2019-02-26 02:33:27'),
	('077d229a1bc8da952a53fdcf64832fb0ca15e69ef2456e95ed4cc11610a0191742f6a6250c8c7bb6', 'ccf763da22c1596c1dab65160b328c49cf0bca9da090d508e176f825b620309505f54a361c30ffd1', 0, '2019-04-22 14:02:31'),
	('07dd7c53ac26cb0401dff9d36e8cdcaa9f845709599e180c7ade3cdee3438e21276e375f8ace23fb', 'bb957307e86ec7b9eda50f1872c9b4966b6d2a7f8c3290e7e4d8ed861b5ec739b5c8210a08052797', 0, '2018-11-28 14:21:17'),
	('09aabd58b98b237511c9cb898c06702c63885a3608c9347549c5b0747b9f0fddd11a6a9a18be3aa2', 'd72daebbe5dc94e8b7a8e1de258556ca2fc1455ebe0ba33fe41dbbaeae0f2e73803464fdf835f727', 0, '2019-04-24 00:17:34'),
	('0ad0345de3feebfc27ae7a5e4465a59dc208ef36148764db090f8f8da55336b080d70afe70e7771e', 'e74751051e16d729451af881d13b4c24483ee08134edf79e0674bf951b43fff6df2fb8bee5282ad6', 0, '2019-01-15 11:37:17'),
	('0c63f594cf925d1ff92beee4a614e62dd0ebae8e301c7657391fe8d051e9d9372549e50ade32c2ec', '35d9844381bd6c1442dd34c2569ffdaf6ec9d3e36e7bee88cd782e0e019b7cac1eca51f17cc9e641', 0, '2019-04-08 19:01:18'),
	('0d2bdacd532891177e14b3766104a5e40aa024b93e462132f6a56e9cbf554c9bcec398c7d28550fb', '0053c9b2b5aafcb834257ed1f3c19bedf6da0a4baf59d39f246559fd940b52c71a759946309b95d3', 0, '2019-04-20 21:17:19'),
	('0e0b692afd23089c08658a73a89d33f9d2c4a21e00afbe95388db7a9a590706a1c3e61b15e15e4db', 'bccc008a9bc35f5a5021b42af80d088624faebffd3054483aaedc4b551ce57259a94e9360d08055e', 0, '2019-01-12 01:17:08'),
	('103790364d8541d8dd30eed6d9a5c3710886e190047f05e77a2e9f77b754d7bcd7f6fd9b1082c27d', '032643efdd56c833beea98d6cf738aa6319ea0be9f337ab98187b5681f529fd16164b3b8dfaf6c4d', 0, '2019-01-31 11:52:13'),
	('12da31fa5d0145c1d3530db44e7cceef899a7d8f674c1add6605456918e49f1181d7b3387db72468', 'ba38b3c4dfdbd52a44d38705e711c4630ed491e90e38806f3d91efb0f3689d4ab3ff99ad6bc9a3b8', 0, '2019-01-12 23:05:13'),
	('189ed14fa8bfba7dbd12522358909b347b3760d3473c6dcaad90c842d719974feaad6083a13d3748', '4391691d6377883c92b123ddd64c31be21d14565b0c9c6737d9498966704687f299182b6be1357f7', 0, '2018-11-30 23:36:16'),
	('1ae7eba6e3cc82870b48ce960a8bbdd6184dfac1760641a1051cb9915af49c8e1b46e7b4eac083b0', '83a40178bde07d6494052c7bab34bc0e8bffe15299e7c5c488bfb0b4c9b9dd1d95e8c9b638f46313', 0, '2019-04-23 20:51:34'),
	('1b6fa310ccc7285de20d1b0163ac275229592d1a802f3f65e0faa5a30cf1c9f12653283cb3d5b572', 'fbf85888a1b3c4dbf4d33a84a60a1e97ff3abb2f2bcd904fb736906a92a6fadc0b295e193002af2d', 0, '2019-04-07 12:02:37'),
	('1e3c126ec2648403958c77a57a350809ec728c38ff5b6de3e81ed15bb6ecdca213f26a3e89a00f08', '5be322f4fc626755bce7579cb3bfe3e21cc3fe5531d6c0d42bb364277a2237692eab218be8788f72', 0, '2019-03-09 00:03:26'),
	('1fc13eb31ed2978ac99662578f95d853f29263e3b1b5399ecbdb692c4009e6a2243731a668578500', 'e3b5dd2e28a0c9bc64a7e74839a31cda41e7559c3f7b3313d3572ea4a6b1b12b53d37718e8a779dd', 0, '2019-01-12 01:16:42'),
	('2154723ed2a07de38d34e8dcefe485d8a5438fca2222b3a8c5f496dba0c8449d38e9e946d5d3ff27', '8d0be931ab70f3c796f4fbd38a6d00022642e9d89a28658b84b965493f530b4ef1674473e26d4914', 0, '2018-11-24 12:55:24'),
	('22bd5f20a19bac913e23548c82072a60e122588f4f2f5ec984d72f74b1dfed3e2a3c1ca61e8c6f38', '11311695608152edde7a9ed7c3116f4f6d767768ee8f27a9c6280329c6dd708649ff9133a4e172c2', 0, '2019-01-31 13:14:57'),
	('23cde1db92ba051a63d4210968f756ea726a7629865ac56b44e3340f84667b0587ad968806cf13a0', '1f6a57516dc6b0e03d326b9c8d237383d0a1716dc00a0cab17a16181524abdbef72866b769f838f5', 0, '2019-03-26 13:31:41'),
	('266e1e2f4b82c39948534b777faef4d046a512e5c7845e1e470a489f38701450db1258cb6b093cc9', '9d9a1ec6732809b5c0c8db8a2d4f1b1e77783475518fff543a487e0a61aec7e8b248d432bf16c669', 0, '2019-01-12 02:10:31'),
	('29a6e58a170dafa7baa0e9b3e82b3a3f209962cac8d6188c8371b4a50fa447f3e0beebe44f07e1e3', '665531eaa1630b44cd05cf70e681be9576161499bbc7fe2f149ac4716c1161e0c158130dd4cc4f78', 0, '2019-01-12 02:03:47'),
	('2c3dadb9c72785f3111c5f90b6e5d09f4f09020848d45b50e0d05b9c0c397c434e8f9d871d45c0a7', '988679b5db43e94f3c368ee9d1ceb29e79faf6d45b1ae135e83b774ec30bb73d2ee8d6eb179c3bd0', 0, '2018-11-30 19:54:59'),
	('2e9332e79fa7c78277b90a789c862ab371fc55f3f781e4a455ab8938c76ff355c37d499f728d483b', 'd550f5adda610bdd414d162c5e1ae8c28195c5a4ecb1257d240c336f8fc219516cf54fc665093495', 0, '2019-04-22 10:56:06'),
	('344a1bc26d929e1ccb46899211d9490d0712f936e7a1a6e85096a9c979607d9e3b96538f54d722fe', 'c1d484b37e84e44e0ea5381f119ae2ec9bec4018df93fa53a7b64864ad44f8432449667b08a2e587', 0, '2019-01-31 12:29:54'),
	('3551b3c3a60dced8ebbee97590898ea8598893d7b693dbf9a6e5fc27dd9033a01ce77f70b145bf66', '4797a81221e4bd988189db413e2c96e18913aa40ed7a21fa42dbedbaf90ca1f29dec5131c76341dc', 0, '2019-04-07 12:55:38'),
	('35aa5d9f74e8204cc48d93b8e1cf0d84c3a6b8e7cc65f642e4e0f8d771954c21ca7c01e9d34300b6', '029d3fde6c7b26e055d6b250772db833a4bde663970faf0da95dba5b8a849d5bd4986b20c2164b3a', 0, '2018-11-26 23:50:46'),
	('36f12926351678fce8f8e4627843386e07f289c67430278c8cdf546d036dbc353b358c9c5a000f48', '2b07838237fb5279afeee5536a08f6a0d0658e47d1b3c2fe9453c6e62f74fbcf72ae3f269a9ceff7', 0, '2019-01-12 23:30:55'),
	('389725eb7c70c35eb73c60c0d759597116c294f366e4a30a76fd6a5abb0715ec222cf561378f3ffc', 'c3cb8609644cd04087e2334c9d712f530b80483301ca7dcd1a038ec966d42e70f82f9ee23d0ef72e', 0, '2019-04-24 21:22:45'),
	('38fb54c5529b8800ac75a19ac0a8016046e09476bb862f7b61c1aa6eb9fd8f950c4e4f9b9b917f3a', 'f99c621e094aebd0aa4515012ae579e342bf9abfd34cfd693506afeac0a98a843015b3fc0062c6a5', 0, '2018-11-28 10:11:51'),
	('3de7eaec7eef620ac039a62b2e0779fdd50a6b50433e48aeb63cbbd29d0e6f2ea64d048f677a7345', 'cefc79f004f7e048f6426dc5bf8df6a6309b182a63c9e44888fb33877ff9cf003ccbb619379356e0', 0, '2018-11-30 19:06:17'),
	('3ed031df24cd5f5ad789c3b9df978e968a46fc5e744fd9802dfee425c374a04350eae92113777b39', 'd9cb4ae748ff7ccc260a7a302f5bcabbfebd85ecaf30cb6551ba166b255e01db6d04a6d19f188fa9', 0, '2018-11-28 14:19:42'),
	('3fece79fb36e08128162066bd5e0af9940cab714cc438add66957862a40e7183c5b5d6dea4ccebb6', '6b949c9e2d74f8879f658761e9a862ee3b1ab99783d5cc7fb9dbf1ab21cf014b1c4112f8507ea60c', 0, '2019-01-12 01:16:52'),
	('420a9ae6be8426fa80c4c6dd55ee6d5efc47ec4198c773fd92e6d66f7ab385017b9ed135c0023a27', 'f363b9585e36737786469f0b54492e0006e7962fd3fc6dd3bda09d6853671fb762eb7a34c25fce26', 0, '2019-04-07 23:10:07'),
	('46356c4a213ea5f4c5494980f251cce1ddaf106d2c3f7a9e89e56a2c4bd2cdadd2bc8e8ecc5d4931', '8e0d705f8982d1023e6a9bdbdd32787b71903af3e2c7a640bb7b030b9e1816187fbabe88786f0741', 0, '2019-01-10 14:25:21'),
	('4802850ab0e8f6bcd0f90302891338fe25d6ee213c414a84572d12e6b6ef0a3c304118e8727c51a2', '089ec7f7e8870e290fac07d64773a04bada46117e19a1e06f4dccc8e95c922c8c36f8a8ffab9183c', 0, '2019-04-19 14:27:47'),
	('4b44b816800fd38f82610b5cd5c977b8486021999f885593a33fb876dac613ed81325326e22bca10', '77ca6a51ff52582f0bd3e802f80b59554edc4d20c59ece7bebd087633af5dac8b58d40d00ef61fd9', 0, '2019-04-13 13:03:04'),
	('4b48de18b88d8132a0b8e060f2abe523fb9915b788cc8b235683c557cee319da5b527e07dc96ef4e', '98b9eaaf82fcd3ee4cd1223d007d2876bbc6465e0520891e8631ebcc39711bcf19053a0e6c24f8bb', 0, '2019-01-12 21:55:42'),
	('4bebd211fbe2b1221b38a64e8059ecbb90bb8f38d22955de3398eb049ca311a7a3ba9eca2afc29c6', '9f95bce6b94ca984993de6e34a92909a7df6bc9b0a74c873f4ceadb0005b1f7459dda2a471a717a7', 0, '2018-11-28 10:11:59'),
	('4feec969c75abca71ac4d0bd398603295278d298d38617d7b58350964f82db3a42c0fb8cba8c0e3a', '047335615ff0fe42581d392cf701418566f31ee6907d107d0b73f41f851771ea8800ced766721d55', 0, '2019-01-31 13:17:39'),
	('55745dac39952be9448cb72da9876ff24e8c4808cdbe0bfcb2099ffff11f6bb2652d8c59a400350e', '3467045e13ae3114d3d3126f670c6c50c9a366c5a415e39adc2ee401c32362f16a7084263853f4be', 0, '2019-03-09 00:01:56'),
	('59f3e56e14bee6aea1e1dcdd9f9ec17e46f05d82fe9d1d569d2cb3cb0f282fb693acc4aded1e545a', 'a8b40e95e3d455453b2f2719a6dcda6568ed86f136b1bf74159283f9aa0713b2636ffcf1db1c6746', 0, '2019-01-18 19:50:33'),
	('5a42d956cc41325aedebfc7425b15907458c9e5e489f9bcbe98bf304fef49a51e422f0ef91ac845d', '3c47f1710d5ebc4c1f448e6ec87c32fdae51c7affb77c41b7bccc7a8cb8f6ca115980c2fa8820617', 0, '2019-01-12 23:30:41'),
	('5b20e63709a2293b5c4c17ded7da7fe8caba2f252533773f11fb23207e82b4e33e66c0d273fc7b48', 'f7a61339c3153f2a08714de16ba841902334fbbe86ea184447a976653ed7e1ec5fce834d71919c5c', 0, '2019-04-23 20:53:26'),
	('5ee569bfc2b492de5ced797c201650edc9e2c14b10dc8da47281aca866f0dfffd8e79840e73cc215', '3a0fcbb7d0b3a57d02899e76d3b4014c13beee4b8a412f9914c7f59af59b9fcdb095030f8b97f836', 0, '2019-04-25 18:43:11'),
	('5f57802d7b97c5224c05b13e84fa19568f7eb988771c959e3168674b36c0f7608bc32fb7aad7e998', '2d17aea5543f5f68f2e51ea1cccc2fa996d55e1f719028351a58f510612c8bb915d4fae8e9f367bf', 0, '2018-11-30 19:04:54'),
	('5fc16b2f45961b3d2ef47ecb7b45314159457669f4ee4d5e17efe7c42531f2ca4275e955bd890e69', 'bce9ffcad8c03251a0680d05d162231ce1a9c6e61c5b45e8ec3e4f53bd65e4a7776164e577212992', 0, '2018-12-07 11:42:13'),
	('61146b3a4520546f94e59efbc60a89b21e5e0a459d16fca9e79ba6392d6f12e8762bacb6ff24aff8', 'ff3a32102c6a3fb034150123a91bd01fc9cc7b38f29215139e67264d94b3d6bbfde6295dab0e74e4', 0, '2018-12-07 11:17:23'),
	('627f00a939374274796b8a1b47b1fbe554ded7c95cb22a810ee7272e56f451ed85ed7697d65acf10', 'f2b09058aa29f350c217eef6860fef210d9088020c52edcb7c859c0722942055a84debe2636395b6', 0, '2019-01-12 01:19:00'),
	('6281a4db9963e7bf4898186a29fe56e608e8814a27c8c73cac1c402c6a3d9262cbe5de7d0e43f7b9', '0c8516201dc11c74e66406ec00f97352c3d6bbcbdc734a94e0437596b7e5d234a71eb812df9b615a', 0, '2018-11-28 11:27:39'),
	('66e7239ecab39b9ffecbdba125790bf70c100cad12ace22783038fa7982ba43b47db5d85fb45b260', '95dc367a05c0bca3215c63e4d9a4138027809cc9691eb97acfa24a18df757042a122564fb6f9d252', 0, '2019-01-12 02:41:22'),
	('6b036b897c872017de890a83d6686d72738230fbff1339500f282cffd82920797d682ed5719dcf43', '23ffb7ddaf80d5e8926c69a24e90b87fabb682fbeadf4bc0d976f5ce7e591f4e385fbda14ee3597d', 0, '2018-12-25 11:35:04'),
	('6d954bc20d6d1aec64fe035fc1a00331d68c968e85fe0fec48dca2bb0d828f357268e4b6f41decea', '5c5fbcebde19b6c188296c34cb28f871451ec9ca09dd2357c11abd26b8399f76231e28a3f1077221', 0, '2019-01-11 21:59:06'),
	('6d96ad0a0e5184d617e37971845cf94d1136c417ce19ba7011d179cd19d37eb9f909450caa67c6f3', '1d2a7bd5205fc12777bee4de2bf44c3f401e9f6a2c03e82d774f8c29efd228d750ce80d71f3be815', 0, '2018-11-28 11:08:08'),
	('6ed76a013be4325598db31ea84afaeced8c7048d02b3f329de03741559174e57971c15eb36bc29fe', '56d787fb5746281d5c206e7c8ef5e791ada367220660ff4f2efd4fee6547719b002e7facecd61287', 0, '2019-04-24 11:38:42'),
	('70726e4af807b237fff4bb6fd624a13ce836342b05c2a6a9525dd88bae734e181331a77b8c8dbec4', 'b22dfeb0f762540cb817a4bd9ae1362bca9c3a64ab5f1e4cef2aa0cbfe46a20c53d2966d097d8bae', 0, '2019-03-24 00:53:56'),
	('711557297515598a613ff9023d9acb18b6d5a5887d3ca17ba433904056ca2e84445352a7842f4038', '5db0fa8904c4c4fc4484889f6549e7787c4e603f2777fb2b908664b9222fe0957f254a6b2cda58f1', 0, '2019-01-12 23:31:07'),
	('71f19afd2bfcfb13eac730686a03715090428a9cbc0b17ff3968dce254419cd296e9cd1604a089c8', '92920edd820f162c020b61bd7c64f0c331500b8304be0d2a9adee392cb77e6c180c89c5c018df39a', 0, '2019-04-08 18:52:31'),
	('72e934879dd8e9b3612c0caf1fa14629ffbcb59173a7fa5b9ea027ba2f6fb6c43fd02cc1bd0a3641', '37086ed2d4c58ca1c1077d0fd3d7d0d3d3d9bd37557cfaa09ccca9082edf1ae64e85c801244f949e', 0, '2018-11-28 11:24:31'),
	('737da84f0c3c1b959f72ca6048e567ccbeafa7f2632ae9657ae3c8d0666b3495e75d1eecea0b3bbf', 'ba445d769af0ea009234265998e783dfe531e5f80373a2f658ac0e7f425f040ce2c36337044dc883', 0, '2019-04-07 12:54:57'),
	('748e47574e4cb35aa4f7199ba7f91b5b6439b00e654bcbae74d53d0c99946a957a3eb374b8dd80a0', '2172cc1dabecc98430f784cf7122b763b59e387ed3c565b25ceed4b8ec97074bec8a799b85943dac', 0, '2019-01-15 11:30:26'),
	('77e8c98c72e62c18e4d360e9c70408718c8ada1a36b2f3491add42877157876139eb559c2be3ccad', '1dcc0bc18c2094ec6697d186f6ef9480378dcacf3aa317a79d32552504c5e96f31a848bf17c40314', 0, '2019-01-31 12:05:40'),
	('78799f8f7c9ffbbf150b3c9a6908aa91ea187911874ed3efd0559e42193bdd7b909eb30f87718c81', '4f3b55ecdce965fb98b0f5d9b0b25586d48667458ef0b01a7efd9171d99ed6f2a0fa6069b0474e0a', 0, '2018-11-28 11:42:25'),
	('78a391f6994f189f297fb7b15b9b545b459eb4a11f2894ee91a81e182cdcc686066d80ae47a44929', '1800bbd673c22408fdf1005d8837a18cec804eadb48c1d602c59c015567f751268b1bd789a6dc35a', 0, '2019-01-12 23:04:38'),
	('7be35b55bcaee4135654a26bd5ab6bb02000cab6980cb7bcd5c31a1b4d2ae78163378329f692517a', 'f08e2e5261d4cc0e8e369f7033e8d45687bca8f812a2f69a3994eb563da235d5d538e8ec1da55392', 0, '2019-04-13 11:34:16'),
	('7c3434cdab6fa3272539ee0fb561e608e5a63c1e10aa8a9731bd4316adaef16a2e62e948ae2631ad', '1b4b1d14bb3291fb732c18768c73609f055e2d17e57cb33a3b4a2c94d7be495da9bb19ebeee72b6e', 0, '2019-01-14 13:14:15'),
	('7d49fe8f499f69cd256934a4c0c4cbe741856f345547f33f78411f370ed5dd903b35b3c8ccf39ffb', 'b484dd6c4f054fcfcc17c8274e913a90dfd8e0b45a3d86d329ab068558dd4477454e97942ff19354', 0, '2019-03-23 04:52:01'),
	('7e2ca503f2d72bbe32d9fe8879e31bb12c7f78727a5d4a01cec0ff1d1c39ca58b65b18685343b574', '486295c8a1965cf838f9170e42b511bf80e40ad844730989479f0602eb77471a5c2f937c685f0f8d', 0, '2019-01-31 13:46:15'),
	('7e6473eba8ec607ae22e200cbafa139f1093b53285fc7ec724fe527dacc2f1fbc91f618feff485df', 'dbc2a3ad8ee403633ca6e1e9d02ff9cda1afcda0e397847b334cc62bfca133426a51ca61f8089abf', 0, '2019-04-22 14:03:11'),
	('80ad4643f40cbff7666088223b2b210081e8cb96dbcf71a447f1153dc9536a2130f636fbc301338e', 'a51d39e16e50796a2e28e24a962519077c7c9ec04966f84f4b034b251c6867900cd482dad4c627d9', 0, '2019-04-07 12:53:24'),
	('80fa0dcde8eaa872e0ff4e5f4d1469e7d38400d91fe2345ada4e99e18bc393d2e288b167fd50473a', '3042ee1328e343bf807a12f1fde45a56ba9536122bbc392c890bfe49227a4563555a23e014917580', 0, '2019-01-31 12:05:57'),
	('81f14788c683562f1576187eaf33c4e92d2a9516734a5e2deddf84868b01f551f0cf7a52fe23248b', '0ae56c68ec97e770847787c042594faa1e56e95920764171fdd1c4dd2725022882287675400bf8b4', 0, '2019-01-31 11:52:22'),
	('82d4366d762356845c015a6beef095b285c9d5ab53ca7e40052ac3991c518ad904f2269daa9b936f', 'ad35a3986ed748ca2465d909497e3da4c3300934ae8172465623bcdb1e6fd1498724513a67e8ada1', 0, '2018-11-24 12:56:18'),
	('830fe95c8c63584ce3ec01c562f60c6fd849d6c14e26580b2bafdcc0ef0da980df8e31bcd2b19d20', '4208030afa0eb8e58ad7fddfab2fb4109ee10e470324cf0f340a23c01a19caaecd045451a7bc8f28', 0, '2018-12-07 11:44:08'),
	('83bee0559e2d64262382c41e354a423646f0f6baeb667d850b5c5b5428bbd0593be3163f1be97119', '14866c3b5fd06cb00c44f189c1da486df251f24b828f4f6aa29b388c52c6d0f731789c5b0f3d6b51', 0, '2019-04-24 11:26:58'),
	('83d210bed52f7ed1aa4815c989d36377f41df4669210e50a3244366befc527f72cf1432c6b867251', 'b3ba8b5a0f8a37011d73dfcd8c2949e13760fd4fcc7383c64c759bbd7725db7f994aa5067334e189', 0, '2019-01-12 02:22:36'),
	('8507924834031819d25eee39de6e2f68b469fa7221ab2d667b7edb038d3e943ab84358314ab378a0', 'bc221f1153eb704f557baae391dbb00ba26d21786cb34e7bee8c38ea50399dce6a74dcd222390df2', 0, '2019-03-24 14:05:52'),
	('8636b1afa707b720bb1fcefeac0ea2e8bef6fada2d1f26bd3e251ff27563a0d0c2d465928a662a87', '8d9eb8cef360a31f9933107c59a468145b682c1436ee2c8204cde3151c672b20060f5968bcc8b255', 0, '2019-04-23 20:54:30'),
	('863f14b9cbb51c56fc703e58c5cfb63b0399b98ad2b01253f5171249e04950c86bf5fc0b9c587045', 'e27e73f1b3b47b9ca7c4dce0b4f3469f8942430f2b88f43a67bfdba59b1f02a963da70c153179e7e', 0, '2018-11-30 14:14:11'),
	('883e1f6baf0f4eff20049a8920ac0e5614c4ad6b1a5d2c8e7ff06c74824230cbe2d663d0b5844130', '20c5309e92d9a49e0b13fa95e4fe51467ec301c46c840b072ef24da8b5d9234049f32b18cb91dab7', 0, '2019-03-24 01:54:13'),
	('8b2517bee81417e1c2679e5d52fdd0135bcac652f998b64b6e6b67d693c4dc72109f28164ff734c3', 'aa922926e40361df8149909c13e5e132edb02edcb4ef4882dca7441b23796bfec627c2f15049a0c3', 0, '2019-01-12 02:00:22'),
	('8b57497363b70954c9c581778809bd10ec300cdc6f5d44190388e37d6ad512de3ec9bfb1cb0e39b6', '4afc36e767bada0b06a145a2dde7e27a93831d57edf0536acf4c03d64dbf825ae3b0ad17cc389870', 0, '2019-01-12 21:42:56'),
	('93e3311c14cc033d7b09d40da5de968fdf197015358c8901481100d194ab384f5b68052696a62502', '8f58a1444c2ac7ecd10cf85f4b597f84a8d1a9a321a3f9cd4bad86f74591dcfa0065b8e7e745f6a5', 0, '2019-04-07 13:54:48'),
	('97f69f4e407077302aa631f782dd5b41e22a479e568041ae21a38cb9356ed8d22baea09ac5e52462', 'b3424858385cf55e33a93464a3cf089bf787e45d7d06cdfe006a4aab2cd0e629f6d9f99d0b69684a', 0, '2019-04-18 21:16:46'),
	('9804a31dad9be6782b95b9f76fd576016e09a56d90086fdce8fdf5711840c6d9ed5540501076fc2a', '4db43df7104ffdf0b1055cecdda65f01a7b339303e97fc9e3a19c75ac3ec7d5b4e7d8835745973d7', 0, '2019-04-07 23:11:21'),
	('9a05edc12abb3e4b6a6fa5c556b43857ecd4a81d0d8245bd50eb3fc6609ec81658d9c3596a4f1145', '5fcd780f76c4b763d7f65dda6cba0b205ac72c7093e2940abb8dce4df0007215c9d3db611db8be0d', 0, '2019-04-22 13:56:12'),
	('9a9edaffc680d49f585ba328ec605cd1575e105d4a2343a0dbe43ebec745583291700c022744992e', '81f44b26bd30ca1b99ffa7ffd511d42cb951b80d811510a6631e8fb1dade3004ebda9850a5fecffc', 0, '2019-04-13 11:37:55'),
	('9b90b0de0762b8d12d857e0f8715e646c6b29849d301f238b819cb9afa82188cac6c2dc28fc522f6', 'd5045e47c5120aef52d28536e1a9249718dcd6d434abbcb1a5ce396e3e68afde5ade0b3a132a2283', 0, '2019-01-12 23:31:01'),
	('9cdc85ac288a05712ec61e1fa9d4fc43237511836e6cee2e9187cadd36217449974b65a0ff5965c7', '25d370ce53c60a13c8f2e2285c8bd96ef3b486139734ace34bf7911296743265f0974f384b3e13dc', 0, '2019-03-24 02:04:01'),
	('a31b7b2cc41d1da78aa1bad9f919b179091816c24c6d8f3e80f0c3e81d4e7edd02166c067817f786', 'ca37c26fe57033b6b5b0ed26c27d0d7632d20543d7bbb1e5eca117d29512c647ff8dc440972a2b17', 0, '2019-04-08 18:38:47'),
	('a4c05ad1571e9939ad9618dc5d73fefc63761c485f25d8edbb23d3796d92e6a5b53d2d319be1add3', 'f7b4626f8e33f497b87e22019ff658ba42dd68f28533a538f20383d9e68ff2d865c195438676d5f9', 0, '2019-04-23 09:53:03'),
	('a6996568746ffb775a5eb75b645936552f7ae45302c401e374e62ae053e7ef44eb0b33faba61f129', 'aaf131254c290b762b87951416f3a66561c505e730f11476d59933ec742a0fc2ac3c12e4771bf76c', 0, '2018-12-25 11:36:51'),
	('a7dd9eb13cd43eb8dd13c7017fbdb571baff3b391f5450c2400f8f0d9a4c04fb139f171297409162', 'e90c3c6cc55bfde41cf484c8ff1ed61e74a2e60e81a9c63cabeff70b56c5917a67b55edf506a6e2b', 0, '2018-11-28 12:31:53'),
	('a87b19b8cf2aae627d3efa962ccd03f11d9a07db8a12b18ae8936e533c76c25f4e9ff5154f459d17', '692edec7fff7ede83fe89d9f1771380df7059de296ac92c8b616db234cd3409d2a2fc494720ed256', 0, '2019-02-05 11:01:14'),
	('a8f493cb3b4619c0b9a4bf12cb2fd5ee9c04864d418a5468f780ad29eef77b639c9b2b13108c0ba0', 'd150ed2bf649708114556c496001786dc63f2d72aa1aae3110de41b53ae8ea766f3a0511dcff649d', 0, '2019-03-20 01:06:16'),
	('abf6a421f8f6f47ba7e6dc0c8e5b77e4e63694b751f1b083fd83995a1157c52ec773101737de0bce', 'deee73d2565bcb4be5bd88492af9d8c85fdc6c50b39390803befd04b00534ccd896bd2352e96f475', 0, '2019-01-17 11:10:12'),
	('ac2ea677102600e35dc3438a04e8484a6348e308df47f39a87f63dfb7b1047b1a24d42290d0c1722', 'b2076e7ade94362005227fda54a6b654b25b40766eaddc418d85d9561e4ccf6adf907474dbd9ed51', 0, '2019-01-12 21:42:42'),
	('ac7459358425586c411af59c55afd8a892ccc628662d3fe9d689e674c57323b39333c2180d26862c', '31482ba9b960ae593a61a138adca164c1bd4ecfa4d02e8dc404151789cf1a018ad64e1581d7031f4', 0, '2019-01-12 23:35:02'),
	('ac9604733682939f579abc487503fd0deb509bec602f7bfb1e5c9b60bb9b802c7d87a41680284d72', '8acac9baddcfa8c74c10e7e2d1c5b5c442f76a0ff1ba286561b535f526bd75263fa64a5e26bd6559', 0, '2018-11-28 10:17:02'),
	('aebd5b4f17ed581689f615b4901df08c3e25dbb3d67a2d97a536cd6a9fd917835bed0a86dfd22061', 'b42e419e82272a29d12e0b4dcf1053bb042552539625fda0fc405842ffabd37f89ab7f4c3e26e6b7', 0, '2018-11-28 11:41:03'),
	('affbea031c3b2fd538e012d2e306a3fe1f65e48a0b80ac3283348c2394aeba1463b00d8bfcc7e807', '9d0c90228fd8bc3d7d866ccd5b935f900d5140b19113cabe77b4dc588d05cd42a8fa693cc9694a06', 0, '2019-04-22 11:40:38'),
	('b0346f1175ac6d232435146983ef979d93cf491de1162cce1b8651bc05e4190c37a1c4c909bece6b', '6f7a4d3d8a90b05ca5d94aa3d05a5cd8d7b3db0357003dddebb14fde1ff0d5d412add3c471442949', 0, '2018-11-24 12:55:14'),
	('b245d70eff65fda786692430107f93c78a106e7bf6e36a9e5acafbce352029c12e669af6c17f0eac', 'b67eab68c279e63b9fef6c4e052e54cb06aedc8848a86497a3a8cf05bcb6b9a9321ef9d8030f95bd', 0, '2018-12-25 11:37:14'),
	('b490bdb80641df6c9cb19288adebde086e19fb9e601d89c57d2610f4d56b3bad345fee3b5da99925', '3c16c9fef8ffe9926e05766f25a7a8349cfd3e8247f98f05cfbed887e4ef89e0d99f91bdb2c37edd', 0, '2019-03-24 00:49:12'),
	('b617f3a447a49f1a498370adfdc5ffab1a1be5974e211a10387d5a8466a37354eb8698aa144b793a', 'dec528c539ae7cb8764237dc2b0c6a2f0dc12f92a193b94827413e79b888b7b09e4449e775276f82', 0, '2018-11-30 14:10:49'),
	('b6c1f809d2c1673c759d067847d45021b77b75f40c5c08f9eb2b9c1e5337af9e151bd2df01b12908', '28b7e615033b5ec1b2d2e34e7b98b3f3ab24f673eddb20ee82a5c678cc1d61df166bc5a5b09f0f1e', 0, '2018-12-07 11:45:31'),
	('ba01f499f776c95bc4966729a0add07450b755a56d1adec1e0620bf692843cd632a2128083fff11d', '51c9b64b14e6a41be352147947b42c10b32729efedccd33e4aaa3a2c66022b6f1d3dd663e9de6283', 0, '2019-03-22 23:03:59'),
	('bc22770f5ce7dab2891a9fe355f174c76e85d51c5ef06c4e16a651737e0ca92ac9634086e97fe827', '8b958e5884ee3bf29fa215b5167d986de2d9315b36b7d915c3635006bcedd49d459caf7ad8b491f1', 0, '2018-11-24 12:55:54'),
	('bc6b307aae88345e0f0932d5ed5fb4afd7b82d3b10dbffb209c1890d89c41035d4c70d6c63155c2f', '908ff1c8dc9fe3c15aaedd2619aca66c218a70066ca9b1ba96e499a95f9ed8b11bb714cc2b839f4e', 0, '2018-11-26 23:48:30'),
	('bd941c35fcba6b7f2a7e535d1e55ea1510bc118a9f78aef0a3dc0fd5bfdc08c58876ec527c3f7364', '7c2f244e92f09f87439269497654869c10e89e8b486eb4101cdfd5a8b471734c5b357505cb06a939', 0, '2019-04-08 18:54:10'),
	('bdd839db2b1ec67595b4c832127ca5fd878a49a7f2b8b79cd443b01a1f333fa4cbd1ddd5a211528a', '473a3452090d72f8e6d884df9b706b471f67eec3fefbd7824d16dbcf296689c7978e86d9c3d2e387', 0, '2019-01-12 02:41:48'),
	('bde2f993b19e44131a6ee9f048e6c3dcb326b691b8812b75ab4aff87f05e311bfbb9b11f03c0364d', '5a41feb09e7633e11430ff66881894e0265befb00e18deffb7dd8bf2e0e61f6aadabc505196eb809', 0, '2019-01-12 23:35:14'),
	('c1b82e200a87ddaa0c44b32e172d2543ed01965aaf81fb4fe6428be58bf08185c0452b6d250dd1ae', '5fc66f8258967e319c079886f57c6b04a086c9c94cd08b377c084764c4aacc520dfd4be60fa2e213', 0, '2019-04-25 18:42:34'),
	('c337ce9c01f40e41ce9f923ab2c9d97d0d75a23b67083afeef315fc615cd6054cf7e23645bd5718e', '9bcf6b33251689b28f974bcae00d1a0e4169cd9ef11793a54d86f988e59bda988cfa8feb8462a758', 0, '2018-11-30 19:05:19'),
	('c4fef3cb0caaaafde6c0d4a5fac040de7a3930ccff9e7a1018c11ac29da6cb9e33aed8d846882f36', 'bbfebcd995eda72db1d1c5e1cf952922b957371ddefe9cf5c94324f9133fdd1bf9e70d62e47233d5', 0, '2019-04-08 18:57:59'),
	('c5b6dac2b4d712530752170b75cdd1f7c2203fab3c5a8c460ddd93cf359dff24685303371f6e0560', 'f238e21bb98c1ca1855eddd8fb6b8cf109f0c905bd89e0ba7a2221980a6116d1efe3c0c88b67f269', 0, '2019-03-24 00:50:57'),
	('c796a9db3cac3bbaf79e4833363a165b421e4cb83564388776a84e2a560113c18fe072f0ea97ff40', 'c1c9748a814232c93838a651ee89e48aa8bbc28604d120dd5c600006dac8a08e72ab49e91cfe0c0d', 0, '2019-01-12 23:35:14'),
	('ca5f5ac119d388f9d5190aa753046dd1cf56d536218dda0116a223074d65147bd6ddec39522b8a94', '0a483e87c3aac501e122bb79962ca5d196b08bf2a08d075ac514715566065c02da026e16daa89470', 0, '2019-05-02 13:02:59'),
	('cb620a897e3934e71f818a36dc9d651987cc6c3a07646c02f3553b735e14e89a344dc166fe370bf7', '4e7bea8f3bf815f059e254067128004a25430d694c33db80b21ad4c2695e2b426d2c302a5441ae4a', 0, '2019-04-08 18:41:28'),
	('cb83067746b1458fb69fc72598015c3f25599d34a3d18ed47c044554a2875028b532089f5b811e6f', '2d474f207e0fb4827e1484b315e461c2d0c01dc3c17fc56cee09947fb1fa9ae8fdecf0847905f965', 0, '2019-01-17 11:16:47'),
	('ce3a119d2427b7913c4665b2ba1a04ed914091d2b9ed357f7465bae655b5a98e5f9b444e43a8cfec', '2c519f44bf6bd12b1cad32cacbbae26dd6097b842892a8cfdf75e28ca746a451793ed40e20a65b33', 0, '2019-01-31 12:05:40'),
	('d0a71a520866b562208784db2151783e137e603669f062ff696b5a501ae2abf1b6f6321b3c674e87', '8df53af60a98fe22057fb57b465fce7432e0fb8b8a40f60d0b7fd7419f6505f5eafded9c81fb0839', 0, '2018-11-26 23:52:05'),
	('d63a45dd24c03dd163050679bab99b447c8c2c36ac626e33a1a2cd7d43b09a5debc55af0653a6979', 'c0b83c28fa6f632b6be077d7dbedfd2cb11c33a8795ea1b7ebb506479f79825bd6f2c00e67151dc3', 0, '2018-12-07 11:19:40'),
	('da28ed8d161fec8efcd9eeb3b99b0fee3aee38f902f0bd7c30d510687347aca8d0205097aa5ad48f', '7d28e33447d0d63f82f827166caaa5f836bd167db30e344899994c33f72fc218fc212e1d8c22b3d1', 0, '2019-01-31 13:46:15'),
	('dcff8a4451c32b5387891c4c1fa9f74a31412fbe9fbb1af158e81ae2867d6bda7c70e426b9d49893', '58cf88fe7fb9e4cda0c451083d66a8223d0ec3eafb89bb17a768e98a5b3c142628140918506416c6', 0, '2019-01-17 11:05:20'),
	('dd7999ed621249ff8369ba974cf21b0fcfd034c2f7aa3d86df250a0a84535840478b03aff4b62fd6', 'ff644b855c939d8ca4b295a8f39957d4a5607e002955bae27174fd6cf105d931b37e3c100d9113ac', 0, '2019-04-22 11:40:19'),
	('dee39670e38293cdcaa73c412f11b9562d86640977d5f985bec1c14592ba6e147343063a6ff429a4', 'c815032b0d8431ed4f0dbc7750f3398096c2ee399a8a0b45ba9313d418ad838960025d4cd45c8453', 0, '2019-01-18 19:48:50'),
	('e24b6d27b62651e4faec533a60d9fa8d9aedd58669e7dcdca98012ee136083091c905f53b5167e6a', '21bab3d19e1b020c84e9d80d0d7701995a1aa99e3d01e187ffbad55130b3dba3cce4aba79d86ce04', 0, '2018-12-03 12:50:18'),
	('e3e29f70d16327f892587ce11cbe6c4d0020156d4b3b70586b4394e3c7d2c703efceb730b834d1ce', 'b0c04ec55118805351c7a46811d8a498d74e32a44ad5128ec05ece2aeda8c1b854bd9ce3f458ab73', 0, '2018-12-06 11:31:51'),
	('e4237fcf5881946dd8e9240aa0bd593e1a4d4e4b2c6a1751d7f301cb99bc018cb9759c4cb0db4b19', '524abe1568e88bd4430fe319ee0d10595aaee18a5f9a58437749ee9c9f32dcb272a8ed8cbfe8dfae', 0, '2019-04-24 21:03:13'),
	('e58a952187e7f4a03f86244dbca7794af7a6407180d499c39870146b66f992e6842a465b1a07bab9', '56288e59c71b673a77095b2c9300d2fed5578252550462e51a2a1f62b4f455d0bf33c4915af92b1b', 0, '2018-11-26 20:15:38'),
	('e5e98195d540de333078d9b2ef68f053a19118baffb8c74fa3f14b5d62f89f70b3729e0483f4b610', 'ea1d065c2ce3654ed61ea3f3e905689e1227f75ff76f8892518fec233025e901ca76cb17abf00fb7', 0, '2019-01-12 23:30:55'),
	('e8e8129bf35ef32665d0345934d030c83a54686bc4b37b3c85e47ad70ef46412f2cc7e8699248cf4', '14055e5bc4ada2d79ea3094e303858dc4c592bf24b96a48687efb440ae77513897eed3e223387811', 0, '2019-04-08 18:26:17'),
	('e933a574fd5d4e28f13c4769c8167801ae8d1442ae0c812aa7c008375915b1af94c3a5bc4446d353', '0313a98326a7c70067d53b4cbf486f6ef9007f0a89f74dcf8653ae03e98879ecdd802e7da778d228', 0, '2019-02-05 10:59:55'),
	('eefd9aeee3f244f34edaeb624c0fb7d42cba79d4c16af0e32f745fe5fed96e720b6a359029e6ddd3', '2d5c9e02aaadf4ef3bce2673e4c24a06aed9f9876e1587ee5b95ab2683b923d81f10ee9634e982ca', 0, '2019-01-12 23:04:38'),
	('effe2a74ed3a93b1a27de1f633d87b666fa3f39657d5417c4d360d6bb7714286e2273db5c111509d', 'a74f0d930d05b5fb8e58a2212827e1330ecdeebebe109efcf8a2eb7eb1ff46cedfac84fc61d2aea3', 0, '2019-01-17 11:10:16'),
	('f06ce69c0362363c5e805e34cc67b0573789ffaed190232e904bc95771044b6fc3ea23217284452f', 'c9076d45adf494011d70269ac4287a342c5cb4d99e832507614e0cf7e41fbfc806863388bd9d0f6e', 0, '2019-01-12 02:04:42'),
	('f13cc6f57920768e236bbca6995bcced5b72cf75b6571872cd626c2d83b9e3e29f89f60e20755476', 'c5912c41d70535173ee735abe12c9ba13b223a64e7bf3c8bd35c5f8fde87729a593c6ecf9152ada5', 0, '2018-12-07 11:46:30'),
	('f394546cfc5e76ef3fb70701dc6f7dbaff0ebde72356b81b28ef62271011c4d24f789afb8a1e2fe9', '8a782a96f9b4819b071e51cb6803ff808fdcfc6c0f2d18df1bd498bde1703faee5cbc4d1c68adf09', 0, '2019-01-12 23:35:07'),
	('f652ed9172fdbb20c910d6aade76b2db16cda9630aefbf5c26de82f0498e45c8f039b392f79e7d72', 'fd0eede92917fe64bc21e1fbf8e93c6f71fdbdd7bb9308964bfb96ee7f90312563746897ef4bf0c7', 0, '2018-12-01 11:43:43'),
	('f82ac184eeb5b4dc92d346e7d7e62aa5b9dfa0632bcf0a0750e11eed82d1c5faca80194af25e9793', '00b51a970245c49777b6cbd7440d99506902a76a93e5fa9ee80d1834a3ae3de109c8102c0342b762', 0, '2019-04-24 11:30:16'),
	('f926d325a9efb0e6f027ba819510735f2eea90724ec1021d4ed3f4eb136b12b7735838a0315dc413', '2c27c7f962f5f2b80db07c364cf7342960debc89ea764c1124fdaf7bccf346975b1c58d07257d4f5', 0, '2019-04-08 18:58:45'),
	('fb13d6b98f8b9162969cf1f2b76f7f6a0b2287020004d1db512f392962c55d489ff7d6da5539af9a', 'ce96cdbd5eb1077f23d4557d61b491b1b371b4db22201b10abe674829e755da5983fbe4ece410496', 0, '2019-04-21 18:57:12'),
	('fc3dddfe9b1396c8043e9a86be1c85136437a7847f187a55c838cec7ed966fccb919f7a69932d37c', '3fea9787a833c393c79cf03b20b003c6a7d4034db03b8da6597c54e3a88d376a7c706c6229e1c55e', 0, '2018-12-01 13:31:37'),
	('fd360dd17b32465f548fc2425323521a81e6c37a6b1083fb60c08c56fee34635b4a4a8a01f8cfdcc', 'c2af47ea44e0c4ff42d6ff07f863ab207949fbe907066dbac6b562b386c6749b50cb484157b011a3', 0, '2019-03-23 03:01:29'),
	('ffbfab2a85db09a6d704eb111c5353029fbe79d3e9c18c1ca275c74aa968afde26179da5db9e02e6', 'be95227bae48bf49fb77f632c4f9f6b5a5398689bc064d5751315aa3b9c0e3186d26d1eb5ec171ef', 0, '2019-03-24 00:49:58');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table job_libya.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.password_resets: ~1 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('raouf.grera@gmail.com', '$2y$10$L9bby17NANr3soUuAy0mAeeU1R4MSXd8A.8i0LEEwI5QGJcrNtgJW', '2018-02-04 10:03:34');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table job_libya.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.posts: ~0 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table job_libya.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_name` varchar(350) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `isactive` bit(1) NOT NULL DEFAULT b'1',
  `answer_name1` text NOT NULL,
  `answer_name2` text NOT NULL,
  `answer_name3` text NOT NULL,
  `answer_name4` text NOT NULL,
  `istrue` varchar(1) NOT NULL,
  `isarabic` int(1) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.questions: ~6 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`question_id`, `question_name`, `exam_id`, `isactive`, `answer_name1`, `answer_name2`, `answer_name3`, `answer_name4`, `istrue`, `isarabic`) VALUES
	(1, 'من الذي فتح الاندلس', 1, b'1', 'ااني', 'هذا الصح', 'انتي', 'مش عارف', '2', NULL),
	(2, 'من شرب الشاهي', 1, b'1', 'اني وانتم', 'انتم بس', 'هذا الصح', 'مش عارف', '3', 1),
	(3, 'اول واخر سؤال', 2, b'1', 'مختاري سي', 'مختار االف', 'هذا الصح', 'اخر اختيار', '3', 1),
	(4, 'مامعني كلمة how', 2, b'1', 'كم', 'متي', 'اين', 'هذا الصح', '4', 0),
	(5, 'ما معني كلمة Car', 2, b'1', 'بشكليطه', 'دراجه', 'كهربة', 'هذا الصح', '4', 0),
	(6, 'ما معني كلمة door', 2, b'1', 'روشن', 'هذا الصح', 'سطح', 'ثلاجه', '2', 0);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping structure for table job_libya.rr
CREATE TABLE IF NOT EXISTS `rr` (
  `seeker_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sp_name` varchar(200) NOT NULL,
  PRIMARY KEY (`seeker_id`),
  KEY `sssopn` (`sp_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.rr: ~0 rows (approximately)
/*!40000 ALTER TABLE `rr` DISABLE KEYS */;
/*!40000 ALTER TABLE `rr` ENABLE KEYS */;

-- Dumping structure for table job_libya.seekers
CREATE TABLE IF NOT EXISTS `seekers` (
  `seeker_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(40) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(15) CHARACTER SET utf8 NOT NULL,
  `birth_day` date NOT NULL DEFAULT '1990-12-12',
  `gender` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'm',
  `is_active` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `activation` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `last_seen` date DEFAULT NULL,
  `count_in` int(11) NOT NULL DEFAULT '1',
  `match` int(11) NOT NULL DEFAULT '1',
  `health` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hide_cv` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(90) CHARACTER SET utf8 DEFAULT NULL,
  `block_admin` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `see_it` int(11) NOT NULL DEFAULT '1',
  `goal_text` text COLLATE utf8_unicode_ci,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goodreads` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwrly` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `save_cv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edt_id` int(11) unsigned NOT NULL DEFAULT '5',
  `faculty_id` int(11) unsigned DEFAULT NULL,
  `nat_id` int(10) unsigned NOT NULL DEFAULT '1',
  `domain_id` int(10) unsigned NOT NULL DEFAULT '1',
  `univ_id` int(11) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned NOT NULL DEFAULT '1',
  `code_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `allcv` int(1) NOT NULL DEFAULT '0',
  `allcvstartdate` date DEFAULT NULL,
  `allcvenddate` date DEFAULT NULL,
  `phoned_date` timestamp NULL DEFAULT NULL,
  `pay_cv` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `have_company` int(11) DEFAULT '0',
  `user_name_company` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exp_sum` int(11) DEFAULT NULL,
  `cv_down` bigint(20) NOT NULL,
  `fcm_token` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_view` tinyint(4) NOT NULL DEFAULT '1',
  `phone_view` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`seeker_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  KEY `seekers_nat_id_foreign` (`nat_id`),
  KEY `seekers_city_id_foreign` (`city_id`),
  KEY `seekers_domain_id_foregin` (`domain_id`),
  KEY `seekers_univ_id_foregion` (`univ_id`),
  KEY `seekers_edt_forgenkey` (`edt_id`),
  KEY `cv_down_UNIQUE` (`cv_down`),
  FULLTEXT KEY `full_name` (`fname`,`lname`),
  CONSTRAINT `seeekr_domainfdsforgein` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seekers_city_id_foregin` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`) ON UPDATE CASCADE,
  CONSTRAINT `seekers_edt_forgenkey` FOREIGN KEY (`edt_id`) REFERENCES `job_edt` (`edt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seekers_nat_id_foregin` FOREIGN KEY (`nat_id`) REFERENCES `job_nat` (`nat_id`) ON UPDATE CASCADE,
  CONSTRAINT `seekers_univ_id_foregion` FOREIGN KEY (`univ_id`) REFERENCES `univ` (`univ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9758 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.seekers: ~0 rows (approximately)
/*!40000 ALTER TABLE `seekers` DISABLE KEYS */;
/*!40000 ALTER TABLE `seekers` ENABLE KEYS */;

-- Dumping structure for table job_libya.seeker_exam
CREATE TABLE IF NOT EXISTS `seeker_exam` (
  `seeker_exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  `exam_result` varchar(45) NOT NULL,
  `time_end` varchar(45) DEFAULT NULL,
  `totaltime` varchar(45) DEFAULT NULL,
  `ispay` int(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`seeker_exam_id`),
  KEY `fgseeker_seeker_exam_idx` (`seeker_id`),
  KEY `fgseeker_exam_exams` (`exam_id`),
  CONSTRAINT `fgseeker_exam_exams` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fgseeker_exam_seeker` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.seeker_exam: ~0 rows (approximately)
/*!40000 ALTER TABLE `seeker_exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `seeker_exam` ENABLE KEYS */;

-- Dumping structure for table job_libya.seeker_price
CREATE TABLE IF NOT EXISTS `seeker_price` (
  `seeker_price_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `body` varchar(90) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `date` varchar(85) DEFAULT NULL,
  `hour` varchar(45) DEFAULT NULL,
  `minute` varchar(45) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`seeker_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.seeker_price: ~75 rows (approximately)
/*!40000 ALTER TABLE `seeker_price` DISABLE KEYS */;
INSERT INTO `seeker_price` (`seeker_price_id`, `seeker_id`, `price`, `phone_number`, `body`, `create_date`, `date`, `hour`, `minute`, `updated_at`, `created_at`) VALUES
	(1, 33, NULL, NULL, NULL, '2018-01-26', NULL, NULL, NULL, NULL, NULL),
	(2, 9626, NULL, '0924911029', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 9626, '1000', '0924911029', NULL, NULL, 'Fri Jan 26 19:04:46 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(4, 9626, '1000', '0924911029', NULL, NULL, 'Fri Jan 26 19:04:59 GMT+01:00 2018', '19', '4', NULL, NULL),
	(5, 9626, '1000', '0924911029', 'تم تحويل 1000 درهم من الرقم218924911029 الى رصيدك بنجاح', NULL, 'Fri Jan 26 19:05:52 GMT+01:00 2018', '19', '5', NULL, NULL),
	(6, 9626, '1000', '0924911029', 'تم تحويل 1000 درهم من الرقم218924911029 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:06:02 GMT+01:00 2018', '19', '6', NULL, NULL),
	(7, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:07:23 GMT+01:00 2018', '19', '7', NULL, NULL),
	(8, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:12:28 GMT+01:00 2018', '19', '12', NULL, NULL),
	(9, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:12:40 GMT+01:00 2018', '19', '12', NULL, NULL),
	(10, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:13:12 GMT+01:00 2018', '19', '13', NULL, NULL),
	(11, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:13 GMT+01:00 2018', '19', '14', NULL, NULL),
	(12, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:18 GMT+01:00 2018', '19', '14', NULL, NULL),
	(13, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:20 GMT+01:00 2018', '19', '14', NULL, NULL),
	(14, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:45 GMT+01:00 2018', '19', '14', NULL, NULL),
	(15, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:48 GMT+01:00 2018', '19', '14', NULL, NULL),
	(16, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:14:50 GMT+01:00 2018', '19', '14', NULL, NULL),
	(17, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:15:50 GMT+01:00 2018', '19', '15', NULL, NULL),
	(18, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:15:51 GMT+01:00 2018', '19', '15', NULL, NULL),
	(19, 9702, '1000', '0925548521', 'تم تحويل 1000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:16:03 GMT+01:00 2018', '19', '16', NULL, NULL),
	(20, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 19:16:21 GMT+01:00 2018', '19', '16', NULL, NULL),
	(21, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 21:53:09 GMT+01:00 2018', '21', '53', NULL, NULL),
	(22, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 21:56:04 GMT+01:00 2018', '21', '56', NULL, NULL),
	(23, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 21:59:03 GMT+01:00 2018', '21', '59', NULL, NULL),
	(24, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-26', 'Fri Jan 26 22:10:14 GMT+01:00 2018', '22', '10', NULL, NULL),
	(25, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:13:25 GMT+01:00 2018', '23', '13', NULL, NULL),
	(26, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:55:36 GMT+01:00 2018', '23', '55', NULL, NULL),
	(27, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:55:31 GMT+01:00 2018', '23', '55', NULL, NULL),
	(28, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:55:26 GMT+01:00 2018', '23', '55', NULL, NULL),
	(29, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:57:53 GMT+01:00 2018', '23', '57', NULL, NULL),
	(30, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Fri Jan 26 23:58:16 GMT+01:00 2018', '23', '58', NULL, NULL),
	(31, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 17:05:53 GMT+01:00 2018', '17', '5', NULL, NULL),
	(32, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 17:05:56 GMT+01:00 2018', '17', '5', NULL, NULL),
	(33, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 17:05:37 GMT+01:00 2018', '17', '5', NULL, NULL),
	(34, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 17:06:13 GMT+01:00 2018', '17', '6', NULL, NULL),
	(35, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 17:06:28 GMT+01:00 2018', '17', '6', NULL, NULL),
	(36, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 19:26:04 GMT+01:00 2018', '19', '26', NULL, NULL),
	(37, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-27', 'Sat Jan 27 19:25:49 GMT+01:00 2018', '19', '25', NULL, NULL),
	(38, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:26:30 GMT+01:00 2018', '23', '26', NULL, NULL),
	(39, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:27:04 GMT+01:00 2018', '23', '27', NULL, NULL),
	(40, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:27:41 GMT+01:00 2018', '23', '27', NULL, NULL),
	(41, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:31:29 GMT+01:00 2018', '23', '31', NULL, NULL),
	(42, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:35:09 GMT+01:00 2018', '23', '35', NULL, NULL),
	(43, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:47:52 GMT+01:00 2018', '23', '47', NULL, NULL),
	(44, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:50:33 GMT+01:00 2018', '23', '50', NULL, NULL),
	(45, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:58:35 GMT+01:00 2018', '23', '58', NULL, NULL),
	(46, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sat Jan 27 23:59:08 GMT+01:00 2018', '23', '59', NULL, NULL),
	(47, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sun Jan 28 00:00:25 GMT+01:00 2018', '0', '0', NULL, NULL),
	(48, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sun Jan 28 00:02:23 GMT+01:00 2018', '0', '2', NULL, NULL),
	(49, 9702, '9220', '0925548521', 'تم تحويل 9220 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-28', 'Sun Jan 28 00:02:50 GMT+01:00 2018', '0', '2', NULL, NULL),
	(50, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:13:12 GMT+01:00 2018', '10', '13', NULL, NULL),
	(51, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:19:14 GMT+01:00 2018', '10', '19', NULL, NULL),
	(52, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:19:45 GMT+01:00 2018', '10', '19', NULL, NULL),
	(53, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:21:41 GMT+01:00 2018', '10', '21', NULL, NULL),
	(54, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:23:04 GMT+01:00 2018', '10', '23', NULL, NULL),
	(55, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:24:37 GMT+01:00 2018', '10', '24', NULL, NULL),
	(56, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:33:25 GMT+01:00 2018', '10', '33', NULL, NULL),
	(57, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:35:01 GMT+01:00 2018', '10', '35', NULL, NULL),
	(58, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:37:41 GMT+01:00 2018', '10', '37', NULL, NULL),
	(59, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:39:36 GMT+01:00 2018', '10', '39', NULL, NULL),
	(60, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:45:07 GMT+01:00 2018', '10', '45', NULL, NULL),
	(61, 9702, '9000', '0925548521', 'تم تحويل 9000 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:48:40 GMT+01:00 2018', '10', '48', NULL, NULL),
	(62, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:50:09 GMT+01:00 2018', '10', '50', NULL, NULL),
	(63, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:51:44 GMT+01:00 2018', '10', '51', NULL, NULL),
	(64, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:54:10 GMT+01:00 2018', '10', '54', NULL, NULL),
	(65, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 10:56:42 GMT+01:00 2018', '10', '56', NULL, NULL),
	(66, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 13:00:26 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(67, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 13:04:45 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(68, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 13:22:07 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(69, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 13:30:06 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(70, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 13:44:18 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(71, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-29', 'Mon Jan 29 14:05:50 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(72, 9702, '9221', '0925548521', 'تم تحويل 9221 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-30', 'Tue Jan 30 12:11:03 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(73, 9702, '9221', '0925548521', 'تم تحويل 9221 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-30', 'Tue Jan 30 12:11:14 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(74, 9702, '9221', '0925548521', 'تم تحويل 9221 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-30', 'Tue Jan 30 12:11:36 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(75, 9702, '9221', '0925548521', 'تم تحويل 9221 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-01-30', 'Tue Jan 30 12:11:52 GMT+01:00 2018', NULL, NULL, NULL, NULL),
	(76, 9686, '4545', '03545487', '12', '2018-02-05', '12', '12', '12', NULL, '2018-02-05 12:32:26'),
	(77, 9702, '5200', '0925548521', 'تم تحويل 5200 درهم من الرقم218925548521 الى رصيدك بنجاح', '2018-02-05', 'Mon Feb 05 11:38:39 GMT+01:00 2018', NULL, NULL, '2018-02-05 12:38:41', '2018-02-05 12:38:41');
/*!40000 ALTER TABLE `seeker_price` ENABLE KEYS */;

-- Dumping structure for table job_libya.seeker_show
CREATE TABLE IF NOT EXISTS `seeker_show` (
  `show_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seeker_id` int(10) unsigned NOT NULL,
  `seeker_show_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`show_id`),
  KEY `seeker_show_seeker_show_id_foreign` (`seeker_show_id`),
  KEY `seeker_show_seeker_id_foreign` (`seeker_id`),
  CONSTRAINT `seeker_show_seeker_id_foreign` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE,
  CONSTRAINT `seeker_show_seeker_show_id_foreign` FOREIGN KEY (`seeker_show_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.seeker_show: ~85 rows (approximately)
/*!40000 ALTER TABLE `seeker_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `seeker_show` ENABLE KEYS */;

-- Dumping structure for table job_libya.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table job_libya.social_accounts
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `seeker_seeker_id` int(10) NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_seeker_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `social_accounts_seeker_seeker_id_provider_unique` (`seeker_seeker_id`,`provider`,`provider_seeker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.social_accounts: ~5 rows (approximately)
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
INSERT INTO `social_accounts` (`seeker_seeker_id`, `provider`, `provider_seeker_id`, `created_at`, `updated_at`) VALUES
	(9686, 'facebook', '11235s7', '2017-11-24 12:42:06', '2017-11-24 12:42:06'),
	(9686, 'google', '109105399338376782377', '2018-01-02 11:30:13', '2018-01-02 11:30:13'),
	(9694, 'facebook', '11234545s7', '2017-12-25 11:37:14', '2017-12-25 11:37:14'),
	(9702, 'facebook', '1289571377814237', '2018-01-14 13:14:09', '2018-01-14 13:14:09'),
	(9702, 'facebook', '1306052509499457', '2018-01-12 02:22:36', '2018-01-12 02:22:36'),
	(9706, 'facebook', '112344545545s7', '2018-01-12 01:19:00', '2018-01-12 01:19:00');
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;

-- Dumping structure for table job_libya.spec
CREATE TABLE IF NOT EXISTS `spec` (
  `spec_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`spec_id`),
  UNIQUE KEY `spec_name_UNIQUE` (`spec_name`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.spec: ~29 rows (approximately)
/*!40000 ALTER TABLE `spec` DISABLE KEYS */;
INSERT INTO `spec` (`spec_id`, `spec_name`, `created_at`, `updated_at`) VALUES
	(1, 'تصميم', NULL, NULL),
	(2, 'رسام', NULL, NULL),
	(3, 'فنان', NULL, NULL),
	(4, 'مبدع', NULL, NULL),
	(5, 'برمجة', NULL, NULL),
	(6, 'صيانة نظام', NULL, NULL),
	(7, 'php', NULL, NULL),
	(8, 'css', NULL, NULL),
	(9, 'c sharp', NULL, NULL),
	(10, 'vb.net', NULL, NULL),
	(11, 'html', NULL, NULL),
	(12, 'jquery', NULL, NULL),
	(13, 'database', NULL, NULL),
	(14, 'oracle', NULL, NULL),
	(15, 'تجاره', NULL, NULL),
	(16, 'تنزيل وينذوز', NULL, NULL),
	(20, 'الترجمة', NULL, NULL),
	(21, 'لغة أنجليزية', NULL, NULL),
	(22, 'أسنخدام البرامج المكتبية', NULL, NULL),
	(23, 'لغة فرنسية', NULL, NULL),
	(27, 'هندسة برمجيات', NULL, NULL),
	(31, 'مبرمج', NULL, NULL),
	(33, 'صيانة', NULL, NULL),
	(35, 'laravell', NULL, NULL),
	(38, 'تصميم شاشات', NULL, NULL),
	(40, 'تصميم كمبيوتر', NULL, NULL),
	(42, 'جهاز كمبيوتر', NULL, NULL),
	(73, 'Lara', NULL, NULL),
	(112, 'مهندس', NULL, NULL),
	(113, 'Laravel', NULL, NULL),
	(114, 'perl', NULL, NULL),
	(115, 'javascript', NULL, NULL),
	(116, 'صيانة كمبيوتر', NULL, NULL);
/*!40000 ALTER TABLE `spec` ENABLE KEYS */;

-- Dumping structure for table job_libya.spec_company
CREATE TABLE IF NOT EXISTS `spec_company` (
  `spec_company_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_id` int(10) unsigned NOT NULL,
  `comp_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`spec_company_id`),
  KEY `spec_company_spec_id_foreign` (`spec_id`),
  KEY `spec_company_comp_id_foreign` (`comp_id`),
  CONSTRAINT `spec_company_comp_id_foreign` FOREIGN KEY (`comp_id`) REFERENCES `companys` (`comp_id`) ON DELETE CASCADE,
  CONSTRAINT `spec_company_spec_id_foreign` FOREIGN KEY (`spec_id`) REFERENCES `spec` (`spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.spec_company: ~0 rows (approximately)
/*!40000 ALTER TABLE `spec_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `spec_company` ENABLE KEYS */;

-- Dumping structure for table job_libya.spec_desc
CREATE TABLE IF NOT EXISTS `spec_desc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_id` int(10) unsigned NOT NULL,
  `desc_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spec_desc_desc_id_foreign` (`desc_id`),
  CONSTRAINT `spec_desc_desc_id_foreign` FOREIGN KEY (`desc_id`) REFERENCES `job_description` (`desc_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.spec_desc: ~0 rows (approximately)
/*!40000 ALTER TABLE `spec_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `spec_desc` ENABLE KEYS */;

-- Dumping structure for table job_libya.spec_ed
CREATE TABLE IF NOT EXISTS `spec_ed` (
  `sed_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sed_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.spec_ed: ~19 rows (approximately)
/*!40000 ALTER TABLE `spec_ed` DISABLE KEYS */;
INSERT INTO `spec_ed` (`sed_id`, `sed_name`, `created_at`, `updated_at`) VALUES
	(1, 'هندسة البرمجيات', NULL, NULL),
	(2, 'هندسة نووية', NULL, NULL),
	(3, 'طب اسنان', NULL, NULL),
	(4, 'شبكات', NULL, NULL),
	(5, 'فيزياء', NULL, NULL),
	(6, 'محاسبة', NULL, NULL),
	(7, 'لغة إنجليزية', NULL, NULL),
	(8, 'هندسة معمارية', NULL, NULL),
	(9, 'تخصص المتخصصات', NULL, NULL),
	(10, 'تخصص البطاطات', NULL, NULL),
	(11, 'dfsfds', NULL, NULL),
	(12, 'تخصص الهندسي', NULL, NULL),
	(13, 'dfsfds', NULL, NULL),
	(14, 'dfsfds', NULL, NULL),
	(15, 'البعثيات', NULL, NULL),
	(23, 'هندسة البرمجيات', NULL, NULL),
	(24, 'تخصص الخضرين', NULL, NULL),
	(25, 'تحصص التخصصات', NULL, NULL),
	(26, 'مهندس شبكات', NULL, NULL);
/*!40000 ALTER TABLE `spec_ed` ENABLE KEYS */;

-- Dumping structure for table job_libya.spec_seeker
CREATE TABLE IF NOT EXISTS `spec_seeker` (
  `spec_seeker_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_id` int(10) unsigned NOT NULL,
  `seeker_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`spec_seeker_id`,`seeker_id`,`spec_id`),
  KEY `sekersdfjdsflk_idx` (`seeker_id`),
  KEY `spec_seekers_spec_forgeinkey_idx` (`spec_id`),
  CONSTRAINT `sekersdfjdsflk` FOREIGN KEY (`seeker_id`) REFERENCES `seekers` (`seeker_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `spec_seekers_spec_forgeinkey` FOREIGN KEY (`spec_id`) REFERENCES `spec` (`spec_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28618 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.spec_seeker: ~16 rows (approximately)
/*!40000 ALTER TABLE `spec_seeker` DISABLE KEYS */;

/*!40000 ALTER TABLE `spec_seeker` ENABLE KEYS */;

-- Dumping structure for table job_libya.store
CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(10) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(60) NOT NULL,
  `store_desc` varchar(100) NOT NULL,
  `store_price` varchar(20) NOT NULL,
  `isvalid` int(1) NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL,
  `store_url` varchar(20) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.store: ~5 rows (approximately)
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` (`store_id`, `store_name`, `store_desc`, `store_price`, `isvalid`, `image`, `store_url`) VALUES
	(1, 'تمييز وظيفة شاغرة', 'تمييز أعلان لمدة 10 ايام', '15000', 1, 'job-search.png', 'job'),
	(2, 'تمييز مؤسسة', 'تمييز مؤسسة لمدة 20 يوم', '35000', 1, 'companystore.png', 'company'),
	(3, 'مشاهدة كل السير', 'بحث بكل المعايير ومشاهدة كل السير الذاتية العامة لمدة 30 يوم', '80000', 1, 'candidates.png', 'cv'),
	(4, 'تحميل السيرة الذاتية', 'تحميل أو طباعة السيرة الذاتية الخاصة بك', '3000', 1, 'pdf.png', 'download'),
	(5, 'أعلان تجاري', ' عرض أعلان تجاري في معظم صفحات الموقع لمدة 30 يوم', '0', 0, 'billboard.png', ''),
	(6, 'تمييز وظيفة شاغرة*', 'تمييز أعلان لمدة 20 يوم', '20', 0, ' ', 'aa');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;

-- Dumping structure for table job_libya.store_company
CREATE TABLE IF NOT EXISTS `store_company` (
  `store_company_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`store_company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.store_company: ~3 rows (approximately)
/*!40000 ALTER TABLE `store_company` DISABLE KEYS */;
INSERT INTO `store_company` (`store_company_id`, `seeker_id`, `company_id`, `price`, `createdate`) VALUES
	(1, 9627, 5, '20000', '2017-07-28 13:36:53'),
	(2, 9627, 5, '35', '2017-10-22 13:15:15'),
	(3, 9627, 5, '35', '2017-10-22 13:34:03'),
	(4, 9627, 5, '35', '2017-10-22 13:35:24');
/*!40000 ALTER TABLE `store_company` ENABLE KEYS */;

-- Dumping structure for table job_libya.store_job
CREATE TABLE IF NOT EXISTS `store_job` (
  `seeker_store_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`seeker_store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table job_libya.store_job: ~9 rows (approximately)
/*!40000 ALTER TABLE `store_job` DISABLE KEYS */;
INSERT INTO `store_job` (`seeker_store_id`, `seeker_id`, `price`, `createdate`, `job_id`) VALUES
	(1, 9627, '20000', '2017-07-28 11:45:18', 3),
	(2, 9627, '3000', '2017-08-31 10:27:28', 4),
	(3, 9627, '15', '2017-10-22 13:19:17', 5),
	(4, 9627, '15000', '2017-10-24 11:12:41', 23),
	(5, 9627, '15000', '2017-10-24 11:12:46', 21),
	(6, 9627, '15000', '2017-10-24 11:12:52', 25),
	(7, 9627, '15000', '2017-10-24 11:44:36', 5),
	(8, 9627, '15000', '2017-10-24 11:56:20', 17),
	(9, 9627, '15000', '2017-10-24 11:56:24', 3),
	(10, 9627, '15000', '2017-10-27 23:30:14', 14);
/*!40000 ALTER TABLE `store_job` ENABLE KEYS */;

-- Dumping structure for table job_libya.univ
CREATE TABLE IF NOT EXISTS `univ` (
  `univ_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `univ_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`univ_id`),
  UNIQUE KEY `univ_name_UNIQUE` (`univ_name`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table job_libya.univ: ~12 rows (approximately)
/*!40000 ALTER TABLE `univ` DISABLE KEYS */;
INSERT INTO `univ` (`univ_id`, `univ_name`, `created_at`, `updated_at`) VALUES
	(1, 'بدون مؤهل', NULL, NULL),
	(2, 'جامعة سبها', NULL, NULL),
	(3, 'جامعة غريان', NULL, NULL),
	(4, 'جامعة مصراته', NULL, NULL),
	(5, 'جامعة بنغازي', NULL, NULL),
	(6, 'جامعة طرابلس', NULL, NULL),
	(7, 'جامعة ناصر', NULL, NULL),
	(13, 'جامعة البعث', NULL, NULL),
	(28, 'جامعة الجبل الغربي', NULL, NULL),
	(29, 'جامعة الجامعات', NULL, NULL),
	(30, 'جامعة بنغاز', NULL, NULL),
	(31, 'جامعة الخضراء', NULL, NULL),
	(32, 'جامعة', NULL, NULL),
	(33, 'hgjhghj', NULL, NULL);
/*!40000 ALTER TABLE `univ` ENABLE KEYS */;

-- Dumping structure for table job_libya.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table job_libya.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for view job_libya.master
-- Removing temporary table and create final VIEW structure

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
