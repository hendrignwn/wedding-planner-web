-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `concept`;
CREATE TABLE `concept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `concept` (`id`, `name`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	'Acara Lamaran',	NULL,	1,	0,	'2018-02-20 03:00:00',	'2018-02-21 02:33:06'),
(2,	'Acara Pengajian',	NULL,	1,	1,	'2018-02-20 03:00:01',	NULL),
(3,	'Acara Siraman/Pra Nikah',	NULL,	1,	2,	'2018-02-20 03:00:02',	NULL),
(4,	'Pre Wedding',	NULL,	1,	3,	'2018-02-20 03:00:03',	NULL),
(5,	'Acara Akad Nikah',	NULL,	1,	4,	'2018-02-20 03:00:04',	NULL),
(6,	'Acara Resepsi',	NULL,	1,	5,	'2018-02-20 03:00:05',	NULL),
(7,	'Bulan Madu',	NULL,	1,	6,	'2018-02-20 03:00:06',	NULL);

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `concept_id` int(11) NOT NULL,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `concept_id` (`concept_id`),
  KEY `user_relation_id` (`user_relation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `content_ibfk_2` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `content_ibfk_5` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `content_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content` (`id`, `concept_id`, `user_relation_id`, `user_id`, `name`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	2,	'Pengurus Pernikahan',	NULL,	1,	0,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(2,	1,	1,	2,	'Dekorasi',	NULL,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(3,	1,	1,	2,	'Lokasi Acara',	NULL,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(4,	1,	1,	2,	'Foto',	NULL,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(5,	1,	1,	2,	'Video',	NULL,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(6,	1,	1,	2,	'Aksesoris',	NULL,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(7,	1,	1,	2,	'Pengrias Wajah',	NULL,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(8,	1,	1,	2,	'Katering',	NULL,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(9,	1,	1,	2,	'Undangan',	NULL,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(10,	1,	1,	2,	'Seserahan',	NULL,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(11,	1,	1,	2,	'Kenang-kenangan',	NULL,	1,	0,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21');

DROP TABLE IF EXISTS `content_detail`;
CREATE TABLE `content_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text,
  `is_noted` smallint(6) NOT NULL DEFAULT '0',
  `is_photo` smallint(6) NOT NULL DEFAULT '0',
  `is_video` smallint(6) NOT NULL DEFAULT '0',
  `is_link` smallint(6) NOT NULL DEFAULT '0',
  `is_cost` smallint(6) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  CONSTRAINT `content_detail_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content_detail` (`id`, `content_id`, `name`, `value`, `is_noted`, `is_photo`, `is_video`, `is_link`, `is_cost`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	1,	'Nama Vendor',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(2,	1,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(3,	1,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(4,	1,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(5,	1,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	4,	'2018-02-21 04:31:18',	'2018-02-21 04:31:18'),
(6,	2,	'Nama Dekorator',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(7,	2,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(8,	2,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(9,	2,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(10,	2,	'Foto Acuan Dekorasi',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(11,	2,	'Tema Dekorasi',	NULL,	0,	0,	0,	0,	0,	1,	5,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(12,	2,	'Nuansa Warna Bunga',	NULL,	0,	0,	0,	0,	0,	1,	6,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(13,	2,	'Nuansa Warna Dekorasi',	NULL,	0,	0,	0,	0,	0,	1,	7,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(14,	2,	'Kain Dekorasi',	NULL,	0,	0,	0,	0,	0,	1,	8,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(15,	2,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	9,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(16,	3,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(17,	3,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(18,	3,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(19,	3,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(20,	3,	'Foto Lokasi Acara',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(21,	3,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	5,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(22,	4,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(23,	4,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(24,	4,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(25,	4,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(26,	4,	'Foto Acuan Pernikahan',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(27,	4,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	5,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(28,	5,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(29,	5,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(30,	5,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(31,	5,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(32,	5,	'Video Acuan Pernikahan',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(33,	5,	'Tema Video',	NULL,	0,	0,	0,	0,	0,	1,	5,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(34,	5,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	6,	'2018-02-21 04:31:19',	'2018-02-21 04:31:19'),
(35,	6,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(36,	6,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(37,	6,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(38,	6,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(39,	6,	'Contoh Aksesoris',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(40,	6,	'Tema',	NULL,	0,	0,	0,	0,	0,	1,	5,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(41,	6,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	6,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(42,	7,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(43,	7,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(44,	7,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(45,	7,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(46,	7,	'Contoh Pengrias Wajah',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(47,	7,	'Tema',	NULL,	0,	0,	0,	0,	0,	1,	5,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(48,	7,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	6,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(49,	8,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(50,	8,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(51,	8,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(52,	8,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(53,	8,	'Contoh Makanan',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(54,	8,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	5,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(55,	9,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(56,	9,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(57,	9,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(58,	9,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(59,	9,	'Contoh',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(60,	9,	'Isi Undangan',	NULL,	0,	0,	0,	0,	0,	1,	5,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(61,	9,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	6,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(62,	10,	'Lokasi',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(63,	10,	'Tanggal',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(64,	10,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(65,	10,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(66,	10,	'Foto',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(67,	10,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	5,	'2018-02-21 04:31:20',	'2018-02-21 04:31:20'),
(68,	11,	'Nama',	NULL,	0,	0,	0,	0,	0,	1,	0,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21'),
(69,	11,	'Kontak',	NULL,	0,	0,	0,	0,	0,	1,	1,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21'),
(70,	11,	'Alamat',	NULL,	0,	0,	0,	0,	0,	1,	2,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21'),
(71,	11,	'Biaya',	NULL,	0,	0,	0,	0,	1,	1,	3,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21'),
(72,	11,	'Foto',	NULL,	0,	1,	0,	1,	0,	1,	4,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21'),
(73,	11,	'Catatan',	NULL,	1,	0,	0,	1,	0,	1,	5,	'2018-02-21 04:31:21',	'2018-02-21 04:31:21');

DROP TABLE IF EXISTS `content_detail_list`;
CREATE TABLE `content_detail_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_detail_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_detail_id` (`content_detail_id`),
  CONSTRAINT `content_detail_list_ibfk_2` FOREIGN KEY (`content_detail_id`) REFERENCES `content_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` smallint(6) NOT NULL,
  `name` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page` (`id`, `category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1,	1,	'Term of Use',	'<p>Lorem ipsum dolor de</p><p>Test</p>',	'2018-02-24 02:48:34',	'2018-02-24 02:08:13'),
(2,	2,	'About Us',	'<p>Lorem ipsum dolor de about</p><p>sdsdfsd</p>',	'2018-02-24 02:48:50',	'2018-02-24 02:10:06');

DROP TABLE IF EXISTS `procedure`;
CREATE TABLE `procedure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `file` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `procedure` (`id`, `name`, `description`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Prosedur',	NULL,	'prosedur-085359.jpg',	1,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `status` smallint(6) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `name`, `gender`, `email`, `phone`, `password`, `remember_token`, `firebase_token`, `device_number`, `token`, `status`, `role`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Hendri Gunawan',	NULL,	'admin@wedding.com',	NULL,	'$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.',	'lwlB6kSsmam10c3YHPGhUER0SjKpn4NQl9Dfu6sHs6sTBzoF5UybQ5Qk8esH',	NULL,	NULL,	NULL,	1,	1,	NULL,	'2018-02-19 02:54:13',	'2018-02-19 02:54:13',	NULL),
(2,	'Hendri Gunawan',	1,	'hendri.gnw@gmail.com',	NULL,	'$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.',	'tK58Ix70xSxfYbU1mPMvtOK3runaEQV2wJaZu0ejE7LXkeyNrCWJJ91jhm4T',	'xxx',	'xxx',	'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly8xMC4wLjAuMTkyL3dlZGRpbmctcGxhbm5lci13ZWIvcHVibGljL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTE5MTMyODI2LCJleHAiOjE1MjAzNDI0MjYsIm5iZiI6MTUxOTEzMjgyNiwianRpIjoibTRDYkVBc3hXSGxmcVRoOSJ9.1BjEFd84ABcVAFecRQm_WdAv17iZkUV_h9D2tXdgAXo',	1,	10,	'2018-02-20 06:20:26',	'2018-02-19 02:54:13',	'2018-02-20 06:20:26',	NULL),
(3,	'Wina Marlina',	0,	'winamarlina97@gmail.com',	NULL,	'$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.',	'tK58Ix70xSxfYbU1mPMvtOK3runaEQV2wJaZu0ejE7LXkeyNrCWJJ91jhm4T',	'xxx',	'xxx',	'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2VkZGluZy1wbGFubmVyLXdlYi9wdWJsaWMvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1MTkxMzIyNzYsImV4cCI6MTUyMDM0MTg3NiwibmJmIjoxNTE5MTMyMjc2LCJqdGkiOiJhQm5aY09qNURNMFlWa0xXIn0.Fm7T5Ztv_zWHXDWoVcp-UKY5o4t7qwzMuEmEUWIE_xg',	1,	10,	'2018-02-20 06:11:16',	'2018-02-19 02:54:13',	'2018-02-20 06:11:16',	NULL),
(4,	'Gunawan',	NULL,	'hendri.gnw1@gmail.com',	NULL,	'$2y$10$lxnkdhjmFhzn7Utve43SpO/RsE0cglPsYF54gC99zz24HUgYgdyHa',	'UaMLflGH5S4RdWb8dCvmV5BedJZKSHDxMEUoiCEkAo2KQuUquZsSV8r5lZWs',	NULL,	NULL,	NULL,	1,	1,	NULL,	'2018-02-21 03:07:30',	'2018-02-21 03:07:30',	NULL);

DROP TABLE IF EXISTS `user_relation`;
CREATE TABLE `user_relation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `male_user_id` bigint(20) unsigned NOT NULL,
  `female_user_id` bigint(20) unsigned NOT NULL,
  `wedding_day` date DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `male_user_id` (`male_user_id`),
  KEY `female_user_id` (`female_user_id`),
  CONSTRAINT `user_relation_ibfk_3` FOREIGN KEY (`male_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_relation_ibfk_4` FOREIGN KEY (`female_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_relation` (`id`, `male_user_id`, `female_user_id`, `wedding_day`, `venue`, `photo`, `created_at`, `updated_at`) VALUES
(1,	2,	3,	'2018-09-05',	'Braja Mustika, Bogor',	NULL,	'2018-02-20',	'2018-02-20');

-- 2018-02-24 09:10:50
