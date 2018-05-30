-- Adminer 4.6.2 MySQL dump

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
  `grouping` int(11) NOT NULL,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `is_not_deleted` smallint(6) NOT NULL DEFAULT '1',
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
  `is_not_deleted` smallint(6) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  CONSTRAINT `content_detail_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_all_date` smallint(6) NOT NULL DEFAULT '0',
  `message_at` timestamp NULL DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
(1,	1,	'Kebijakan Privasi',	'<p>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>\r\n<p>Dari mana asalnya?\r\nTidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah \"de Finibus Bonorum et Malorum\" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", berasal dari sebuah baris di bagian 1.10.32.</p>',	'2018-02-24 02:48:34',	'2018-02-24 02:08:13'),
(2,	2,	'Tentang Kami',	'<p>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>\r\n<p>Dari mana asalnya?\r\nTidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah \"de Finibus Bonorum et Malorum\" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", berasal dari sebuah baris di bagian 1.10.32.</p>',	'2018-02-24 02:48:50',	'2018-02-24 02:10:06'),
(3,	3,	'Ketentuan Penggunaan',	'<p>Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>\r\n<p>Dari mana asalnya?\r\nTidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari Hampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin yang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah satu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia mendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari bagian 1.10.32 dan 1.10.33 dari naskah \"de Finibus Bonorum et Malorum\" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang ditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika yang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", berasal dari sebuah baris di bagian 1.10.32.</p>',	'2018-03-08 04:54:42',	NULL);

DROP TABLE IF EXISTS `procedure`;
CREATE TABLE `procedure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `procedure` (`id`, `name`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	'RT/RW',	'Mengurus surat pengantar nikah untuk dibawa ke kelurahan',	1,	0,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(2,	'KELURAHAN',	'Mengurus surat pengantar untuk dibawa ke KUA kecamatan',	1,	1,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(3,	'KUA KECAMATAN',	'Mengurus surat pengantar rekomendasi nikah untuk dibawa ke KUA kecamatan akad nikah',	1,	2,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(4,	'KUA KECAMATAN',	'Pendaftaran nikah di KUA tempat dilaksanakannya akad nikah',	1,	3,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(5,	'Akad di KUA KECAMATAN (Biaya nikah gratis)',	'Akad di luar KUA KECAMATAN (Membayar Rp 600.000 di bank persepsi yang ada diwilayah KUA akad nikah',	1,	4,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(6,	'',	'Menyerahkan slip setoran biaya nikah ke KUA tempat akad nikah',	1,	5,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(7,	'KUA KECAMATAN',	'Pemerikasaan data nikah calon pengantin & wali nikah di tempat akad nikah',	1,	6,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01'),
(8,	'LOKASI NIKAH',	'Pelaksanaan akad nikah & penyerahan buku nikah',	1,	7,	'2018-02-20 03:00:00',	'2018-02-24 01:54:01');

DROP TABLE IF EXISTS `procedure_administration`;
CREATE TABLE `procedure_administration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `checklist` smallint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `procedure_id` (`procedure_id`),
  KEY `user_relation_id` (`user_relation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `procedure_administration_ibfk_6` FOREIGN KEY (`procedure_id`) REFERENCES `procedure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `procedure_administration_ibfk_7` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `procedure_administration_ibfk_9` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `procedure_payment`;
CREATE TABLE `procedure_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `account_number` varchar(50) DEFAULT NULL,
  `account_bank` varchar(50) DEFAULT NULL,
  `account_holder` varchar(100) DEFAULT NULL,
  `payment_total` decimal(10,0) NOT NULL,
  `installment_total_1` decimal(14,0) DEFAULT '0',
  `installment_total_2` decimal(14,0) DEFAULT '0',
  `installment_total_3` decimal(14,0) DEFAULT '0',
  `installment_date_1` date DEFAULT NULL,
  `installment_date_2` date DEFAULT NULL,
  `installment_date_3` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_relation_id` (`user_relation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `procedure_payment_ibfk_3` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `procedure_payment_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `procedure_preparation`;
CREATE TABLE `procedure_preparation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `preparation_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_relation_id` (`user_relation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `procedure_preparation_ibfk_3` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `procedure_preparation_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `report_problem`;
CREATE TABLE `report_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `category` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_device_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_token` text COLLATE utf8mb4_unicode_ci,
  `registered_at` timestamp NULL DEFAULT NULL,
  `forgot_token` text COLLATE utf8mb4_unicode_ci,
  `token` text COLLATE utf8mb4_unicode_ci,
  `status` smallint(6) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `name`, `gender`, `email`, `phone`, `password`, `remember_token`, `user_id_token`, `firebase_token`, `device_number`, `registered_device_number`, `registered_token`, `registered_at`, `forgot_token`, `token`, `status`, `role`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Administrator',	NULL,	'admin@agendanikah.com',	NULL,	'$2y$10$JxpunDrKXU8bzcuoggx4GeFqZIRABR/jyhG4IrhD8wp2ZcJFkBAZ2',	'j0MNOSPJdPK9MgVbZ7s12dt4k9ZCgKNTMh7vMgMK3BfGiLAtpz0UeLKK6TGT',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	1,	NULL,	'2018-05-18 03:31:33',	'2018-05-18 03:31:33',	NULL),
(2,	'Hendri Gunawan',	1,	'hendri.gnw@gmail.com',	'08561471500',	'$2y$10$IqbmVtB6IP6lBmjljdhyieYFJaX.J/N8ThZzhR1O9iisMQt7Zsxmu',	NULL,	'f13b7efe-a55d-47a2-a569-b55bcc0f9211',	'APA91bHBPog_Gulg-KkmxQg4vcjjOc1qIPnjP8-wydRVPOeZ5A6HtNoQSkA5WA9r7Bc2_FAtZwrOq21K61BluU1_eVp-1-qAXvDPl8WVFGoL0Uy5wOH2OvcBSmP1crFrQEmkfhIDqyeu',	'35c5ac1aea928d08',	'35c5ac1aea928d08',	NULL,	'2018-05-28 01:54:08',	NULL,	'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly8xMC4wLjAuMTcxL2FnZW5kYW5pa2FoL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTI3NjcxMjkzLCJleHAiOjE1Mjg4ODA4OTMsIm5iZiI6MTUyNzY3MTI5MywianRpIjoiN1FXMHJxRFNDMnh0eHZSWiJ9.4AaiSiopD_7Ka1Q0M3G7ySjS-UQKOzGXRhLgrepDMl8',	1,	10,	'2018-05-30 02:08:13',	'2018-05-28 01:54:08',	'2018-05-30 02:08:13',	NULL),
(3,	'Wina Marlina',	0,	'winamarlina97@gmail.com',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'TMvAbhj9WogvmusBqlG2RvptQ',	NULL,	NULL,	NULL,	5,	10,	NULL,	'2018-05-28 01:54:08',	'2018-05-28 01:54:08',	NULL);

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
(1,	2,	3,	'2018-05-28',	'Jakarta',	NULL,	'2018-05-28',	'2018-05-28');

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vendor` (`id`, `category`, `name`, `description`, `file`, `address`, `phone`, `instagram`, `website`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	'asdads',	'asda sd',	'asd asd',	'asda-sd-041805.jpg',	'asd',	'12312312',	'12312313',	'3123',	1,	1,	'2018-05-17 21:18:05',	'2018-05-17 21:18:05');

DROP TABLE IF EXISTS `vendor_detail`;
CREATE TABLE `vendor_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`),
  CONSTRAINT `vendor_detail_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vendor_detail` (`id`, `vendor_id`, `name`, `file`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1,	1,	'Photo 1',	'photo-1-060030.jpg',	1,	2,	'2018-05-17 23:00:30',	'2018-05-17 23:00:30');

-- 2018-05-30 11:57:40
