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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_09_06_095840_create_otps_table',2);

/*Table structure for table `otps` */

DROP TABLE IF EXISTS `otps`;

CREATE TABLE `otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_code` bigint(20) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `otps` */

insert  into `otps`(`id`,`user_id`,`otp_code`,`expires_at`,`created_at`,`updated_at`) values (1,'q8pcC/xUL7MMyZKo5mTE4gu003du003d',333349,'2022-11-25 06:07:45','2022-11-25 06:05:45','2022-11-25 06:05:45'),(2,'8bUaVOjGBDzCcJ/QNt0xqwu003du003d',722603,'2022-11-25 06:23:07','2022-11-25 06:21:07','2022-11-25 06:21:07'),(3,'iqKhe8b24uLTgDOOmAU5Egu003du003d',583990,'2022-11-25 11:07:44','2022-11-25 11:05:44','2022-11-25 11:05:44'),(4,'B5h9UVC1iJRuYxJd55Sy+Au003du003d',635588,'2022-11-25 11:40:52','2022-11-25 11:38:52','2022-11-25 11:38:52'),(5,'B5h9UVC1iJRuYxJd55Sy+Au003du003d',436260,'2022-11-25 11:41:46','2022-11-25 11:39:46','2022-11-25 11:39:46'),(6,'FhHnbhNb8DYmSRem1rzBDwu003du003d',873472,'2022-11-28 05:18:29','2022-11-28 05:16:29','2022-11-28 05:16:29'),(7,'ZDIMOv5LspymhnmKY1btqQu003du003d',801053,'2022-11-28 08:35:56','2022-11-28 08:33:56','2022-11-28 08:33:56'),(8,'DtmBNOq8WsMOriopI6BOBAu003du003d',757026,'2022-12-07 06:56:22','2022-12-07 06:54:22','2022-12-07 06:54:22'),(9,'DtmBNOq8WsMOriopI6BOBAu003du003d',518395,'2022-12-07 07:16:43','2022-12-07 07:14:43','2022-12-07 07:14:43'),(10,'q8pcC/xUL7MMyZKo5mTE4gu003du003d',752860,'2022-12-07 07:17:27','2022-12-07 07:15:27','2022-12-07 07:15:27'),(11,'q8pcC/xUL7MMyZKo5mTE4gu003du003d',801767,'2022-12-07 07:25:08','2022-12-07 07:23:08','2022-12-07 07:23:08'),(12,'q8pcC/xUL7MMyZKo5mTE4gu003du003d',345209,'2022-12-07 07:27:07','2022-12-07 07:25:07','2022-12-07 07:25:07'),(13,'8bUaVOjGBDzCcJ/QNt0xqwu003du003d',303285,'2022-12-07 07:29:00','2022-12-07 07:27:00','2022-12-07 07:27:00'),(14,'FhHnbhNb8DYmSRem1rzBDwu003du003d',763186,'2022-12-07 08:12:53','2022-12-07 08:10:53','2022-12-07 08:10:53'),(15,'ivvX85TnxQa0HGcEF6wihwu003du003d',969971,'2022-12-07 08:38:55','2022-12-07 08:36:55','2022-12-07 08:36:55'),(16,'AzkBNb67GgYGD4AkjTF3AAu003du003d',894345,'2022-12-07 08:43:07','2022-12-07 08:41:07','2022-12-07 08:41:07'),(17,'ivvX85TnxQa0HGcEF6wihwu003du003d',254062,'2022-12-08 06:57:02','2022-12-08 06:55:03','2022-12-08 06:55:03'),(18,'Gu66CIyxjVzhDAdQNhi5ewu003du003d',254174,'2022-12-08 09:44:59','2022-12-08 09:42:59','2022-12-08 09:42:59'),(19,'O739CV//EMcza89brgKvsAu003du003d',458693,'2022-12-08 12:21:26','2022-12-08 12:19:26','2022-12-08 12:19:26'),(20,'B5h9UVC1iJRuYxJd55Sy+Au003du003d',535227,'2022-12-09 05:03:07','2022-12-09 05:01:07','2022-12-09 05:01:07'),(21,'cVxcFK4BwBUr3x6Kposokgu003du003d',483629,'2022-12-09 05:04:29','2022-12-09 05:02:29','2022-12-09 05:02:29'),(22,'YQfWKloW8AhzaZbDZ3FXSAu003du003d',674595,'2022-12-12 06:14:41','2022-12-12 06:12:42','2022-12-12 06:12:42'),(23,'d1/2My/VpusLWGzRFI6nagu003du003d',749040,'2022-12-13 04:54:15','2022-12-13 04:52:15','2022-12-13 04:52:15'),(24,'Gu66CIyxjVzhDAdQNhi5ewu003du003d',903569,'2022-12-13 07:25:14','2022-12-13 07:23:14','2022-12-13 07:23:14'),(25,'DtmBNOq8WsMOriopI6BOBAu003du003d',868199,'2022-12-26 07:37:53','2022-12-26 07:35:53','2022-12-26 07:35:53'),(26,'O739CV//EMcza89brgKvsAu003du003d',242585,'2022-12-26 07:38:56','2022-12-26 07:36:56','2022-12-26 07:36:56');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('dawngill08@gmail.com','$2y$10$BxUv5gHgcqCgQLuQ5QZ61OvbfhHjxOcnLWojut45RoU3SpEz1iSd6','2022-09-06 08:05:15');

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
  `rate` decimal(18,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_saving_plan` */

insert  into `tbl_saving_plan`(`id`,`issue_date`,`maturity_date`,`rate`,`is_active`) values (2,'2022-06-16','2022-10-06','15.18',1),(3,'2022-06-30','2022-10-07','14.85',1),(4,'2022-07-14','2022-12-05','15.00',1),(5,'2022-02-24','2022-10-26','14.79',1),(6,'2022-02-24','2022-10-07','14.79',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`phone_number`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'dawn','dawngill08@gmail.com',923412250984,NULL,'$2y$10$a2uHNb0B8ZQdTnzylj1V.utRWlQ75jx112nuJHEgDdhyReanteoAO',NULL,'2022-09-06 08:03:53','2022-09-06 08:03:53'),(2,'atif','atifrehman@gmail.com',923453135798,NULL,'$2y$10$a2uHNb0B8ZQdTnzylj1V.utRWlQ75jx112nuJHEgDdhyReanteoAO',NULL,'2022-09-06 08:03:53','2022-09-06 08:03:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
