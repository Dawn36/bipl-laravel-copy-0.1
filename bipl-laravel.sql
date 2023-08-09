/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.33 : Database - bipl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bipl` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bipl`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `tbl_pkrv` */

DROP TABLE IF EXISTS `tbl_pkrv`;

CREATE TABLE `tbl_pkrv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_date` date DEFAULT NULL,
  `tenor` varchar(50) DEFAULT NULL,
  `mid_rate` varchar(50) DEFAULT NULL,
  `change` varchar(50) DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_pkrv` */

/*Table structure for table `tbl_pkrv_current` */

DROP TABLE IF EXISTS `tbl_pkrv_current`;

CREATE TABLE `tbl_pkrv_current` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upper` int(11) DEFAULT NULL,
  `lower` int(11) DEFAULT NULL,
  `previous` decimal(18,2) DEFAULT NULL,
  `current` decimal(18,2) DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_pkrv_current` */

insert  into `tbl_pkrv_current`(`id`,`upper`,`lower`,`previous`,`current`,`update_datetime`) values (1,0,7,'14.79','14.79','2022-08-18 11:16:41'),(2,8,15,'14.79','14.74','2022-08-18 11:16:41'),(3,16,30,'14.74','14.81','2022-08-18 11:16:41'),(4,31,60,'14.81','15.11','2022-08-18 11:16:41'),(5,61,90,'15.11','15.61','2022-08-18 11:16:41'),(6,91,120,'15.61','15.65','2022-08-18 11:16:41'),(7,121,180,'15.65','15.70','2022-08-18 11:16:41'),(8,181,270,'15.70','15.75','2022-08-18 11:16:41'),(9,271,365,'15.75','15.80','2022-08-18 11:16:41'),(10,366,730,'15.80','13.18','2022-08-18 11:16:41'),(11,731,1095,'13.18','13.24','2022-08-18 11:16:41'),(12,1096,1460,'13.24','13.25','2022-08-18 11:16:41'),(13,1461,1825,'13.25','13.23','2022-08-18 11:16:41'),(14,1826,2190,'13.23','13.16','2022-08-18 11:16:41'),(15,2191,2555,'13.16','13.09','2022-08-18 11:16:41'),(16,2556,2920,'13.09','12.98','2022-08-18 11:16:41'),(17,2921,3285,'12.98','12.93','2022-08-18 11:16:41'),(18,3286,3650,'12.93','12.91','2022-08-18 11:16:41'),(19,3651,5475,'12.91','13.28','2022-08-18 11:16:41'),(20,5476,7300,'13.28','13.48','2022-08-18 11:16:41');

/*Table structure for table `tbl_saving_plan` */

DROP TABLE IF EXISTS `tbl_saving_plan`;

CREATE TABLE `tbl_saving_plan` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `issue_date` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `rate` decimal(18,6) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_saving_plan` */

insert  into `tbl_saving_plan`(`id`,`issue_date`,`maturity_date`,`rate`,`is_active`) values (2,'2022-05-19','2022-09-14','14.795000',1),(3,'2022-06-30','2022-09-22','14.851400',1),(4,'2022-07-14','2022-10-06','14.996200',1),(5,'2022-02-24','2022-08-25','14.790000',1),(6,'2022-02-24','2022-08-03','14.790000',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
