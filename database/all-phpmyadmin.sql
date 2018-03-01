-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 28 Feb 2018 pada 15.19
-- Versi Server: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_planner`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `concept`
--

CREATE TABLE `concept` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `concept`
--

INSERT INTO `concept` (`id`, `name`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Acara Lamaran', NULL, 1, 0, '2018-02-20 03:00:00', '2018-02-21 02:33:06'),
(2, 'Acara Pengajian', NULL, 1, 1, '2018-02-20 03:00:01', NULL),
(3, 'Acara Siraman/Pra Nikah', NULL, 1, 2, '2018-02-20 03:00:02', NULL),
(4, 'Pre Wedding', NULL, 1, 3, '2018-02-20 03:00:03', NULL),
(5, 'Acara Akad Nikah', NULL, 1, 4, '2018-02-20 03:00:04', NULL),
(6, 'Acara Resepsi', NULL, 1, 5, '2018-02-20 03:00:05', NULL),
(7, 'Bulan Madu', NULL, 1, 6, '2018-02-20 03:00:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `concept_id` int(11) NOT NULL,
  `user_relation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `content`
--

INSERT INTO `content` (`id`, `concept_id`, `user_relation_id`, `user_id`, `name`, `description`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Pengurus Pernikahan', NULL, 1, 0, '2018-02-21 04:31:18', '2018-02-21 04:31:18'),
(2, 1, 1, 2, 'Dekorasi', NULL, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(3, 1, 1, 2, 'Lokasi Acara', NULL, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(4, 1, 1, 2, 'Foto', NULL, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(5, 1, 1, 2, 'Video', NULL, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(6, 1, 1, 2, 'Aksesoris', NULL, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(7, 1, 1, 2, 'Pengrias Wajah', NULL, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(8, 1, 1, 2, 'Katering', NULL, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(9, 1, 1, 2, 'Undangan', NULL, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(10, 1, 1, 2, 'Seserahan', NULL, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(11, 1, 1, 2, 'Kenang-kenangan', NULL, 1, 0, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(12, 1, 2, 5, 'Pengurus Pernikahan', NULL, 1, 0, '2018-02-24 03:10:07', '2018-02-24 03:10:07'),
(13, 1, 2, 5, 'Dekorasi', NULL, 1, 0, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(14, 1, 2, 5, 'Lokasi Acara', NULL, 1, 0, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(15, 1, 2, 5, 'Foto', NULL, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(16, 1, 2, 5, 'Video', NULL, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(17, 1, 2, 5, 'Aksesoris', NULL, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(18, 1, 2, 5, 'Pengrias Wajah', NULL, 1, 0, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(19, 1, 2, 5, 'Katering', NULL, 1, 0, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(20, 1, 2, 5, 'Undangan', NULL, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(21, 1, 2, 5, 'Seserahan', NULL, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(22, 1, 2, 5, 'Kenang-kenangan', NULL, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_detail`
--

CREATE TABLE `content_detail` (
  `id` int(11) NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `content_detail`
--

INSERT INTO `content_detail` (`id`, `content_id`, `name`, `value`, `is_noted`, `is_photo`, `is_video`, `is_link`, `is_cost`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nama Vendor', 'ok', 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:18', '2018-02-24 19:18:20'),
(2, 1, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:18', '2018-02-21 04:31:18'),
(3, 1, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:18', '2018-02-21 04:31:18'),
(4, 1, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:18', '2018-02-21 04:31:18'),
(5, 1, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 4, '2018-02-21 04:31:18', '2018-02-21 04:31:18'),
(6, 2, 'Nama Dekorator', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(7, 2, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(8, 2, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(9, 2, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(10, 2, 'Foto Acuan Dekorasi', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(11, 2, 'Tema Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(12, 2, 'Nuansa Warna Bunga', NULL, 0, 0, 0, 0, 0, 1, 6, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(13, 2, 'Nuansa Warna Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 7, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(14, 2, 'Kain Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 8, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(15, 2, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 9, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(16, 3, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(17, 3, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(18, 3, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(19, 3, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(20, 3, 'Foto Lokasi Acara', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(21, 3, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(22, 4, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(23, 4, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(24, 4, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(25, 4, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(26, 4, 'Foto Acuan Pernikahan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(27, 4, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(28, 5, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(29, 5, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(30, 5, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(31, 5, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(32, 5, 'Video Acuan Pernikahan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(33, 5, 'Tema Video', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(34, 5, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-21 04:31:19', '2018-02-21 04:31:19'),
(35, 6, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(36, 6, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(37, 6, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(38, 6, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(39, 6, 'Contoh Aksesoris', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(40, 6, 'Tema', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(41, 6, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(42, 7, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(43, 7, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(44, 7, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(45, 7, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(46, 7, 'Contoh Pengrias Wajah', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(47, 7, 'Tema', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(48, 7, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(49, 8, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(50, 8, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(51, 8, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(52, 8, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(53, 8, 'Contoh Makanan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(54, 8, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(55, 9, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(56, 9, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(57, 9, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(58, 9, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(59, 9, 'Contoh', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(60, 9, 'Isi Undangan', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(61, 9, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(62, 10, 'Lokasi', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(63, 10, 'Tanggal', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(64, 10, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(65, 10, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(66, 10, 'Foto', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(67, 10, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-21 04:31:20', '2018-02-21 04:31:20'),
(68, 11, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(69, 11, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(70, 11, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(71, 11, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(72, 11, 'Foto', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(73, 11, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-21 04:31:21', '2018-02-21 04:31:21'),
(74, 12, 'Nama Vendor', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:07', '2018-02-24 03:10:07'),
(75, 12, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:07', '2018-02-24 03:10:07'),
(76, 12, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:07', '2018-02-24 03:10:07'),
(77, 12, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(78, 12, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 4, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(79, 13, 'Nama Dekorator', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(80, 13, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(81, 13, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(82, 13, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(83, 13, 'Foto Acuan Dekorasi', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(84, 13, 'Tema Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(85, 13, 'Nuansa Warna Bunga', NULL, 0, 0, 0, 0, 0, 1, 6, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(86, 13, 'Nuansa Warna Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 7, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(87, 13, 'Kain Dekorasi', NULL, 0, 0, 0, 0, 0, 1, 8, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(88, 13, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 9, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(89, 14, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(90, 14, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(91, 14, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(92, 14, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:08', '2018-02-24 03:10:08'),
(93, 14, 'Foto Lokasi Acara', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(94, 14, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(95, 15, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(96, 15, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(97, 15, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(98, 15, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(99, 15, 'Foto Acuan Pernikahan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(100, 15, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(101, 16, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(102, 16, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(103, 16, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(104, 16, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(105, 16, 'Video Acuan Pernikahan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(106, 16, 'Tema Video', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(107, 16, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(108, 17, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:09', '2018-02-24 03:10:09'),
(109, 17, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(110, 17, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(111, 17, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(112, 17, 'Contoh Aksesoris', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(113, 17, 'Tema', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(114, 17, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(115, 18, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(116, 18, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(117, 18, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(118, 18, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(119, 18, 'Contoh Pengrias Wajah', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(120, 18, 'Tema', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(121, 18, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(122, 19, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(123, 19, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(124, 19, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:10', '2018-02-24 03:10:10'),
(125, 19, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(126, 19, 'Contoh Makanan', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(127, 19, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(128, 20, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(129, 20, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(130, 20, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(131, 20, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(132, 20, 'Contoh', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(133, 20, 'Isi Undangan', NULL, 0, 0, 0, 0, 0, 1, 5, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(134, 20, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 6, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(135, 21, 'Lokasi', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(136, 21, 'Tanggal', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(137, 21, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(138, 21, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(139, 21, 'Foto', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(140, 21, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(141, 22, 'Nama', NULL, 0, 0, 0, 0, 0, 1, 0, '2018-02-24 03:10:11', '2018-02-24 03:10:11'),
(142, 22, 'Kontak', NULL, 0, 0, 0, 0, 0, 1, 1, '2018-02-24 03:10:12', '2018-02-24 03:10:12'),
(143, 22, 'Alamat', NULL, 0, 0, 0, 0, 0, 1, 2, '2018-02-24 03:10:12', '2018-02-24 03:10:12'),
(144, 22, 'Biaya', NULL, 0, 0, 0, 0, 1, 1, 3, '2018-02-24 03:10:12', '2018-02-24 03:10:12'),
(145, 22, 'Foto', NULL, 0, 1, 0, 1, 0, 1, 4, '2018-02-24 03:10:12', '2018-02-24 03:10:12'),
(146, 22, 'Catatan', NULL, 1, 0, 0, 1, 0, 1, 5, '2018-02-24 03:10:12', '2018-02-24 03:10:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_detail_list`
--

CREATE TABLE `content_detail_list` (
  `id` int(11) NOT NULL,
  `content_detail_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `category` smallint(6) NOT NULL,
  `name` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `page`
--

INSERT INTO `page` (`id`, `category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Term of Use', '<p>Lorem ipsum dolor de</p><p>Test</p>', '2018-02-24 02:48:34', '2018-02-24 02:08:13'),
(2, 2, 'About Us', '<p>Lorem ipsum dolor de about</p><p>sdsdfsd</p>', '2018-02-24 02:48:50', '2018-02-24 02:10:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `procedure`
--

CREATE TABLE `procedure` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `file` varchar(100) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `procedure`
--

INSERT INTO `procedure` (`id`, `name`, `description`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Prosedur', NULL, 'prosedur-085359.png', 1, '2018-02-20 03:00:00', '2018-02-24 01:54:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `email`, `phone`, `password`, `remember_token`, `firebase_token`, `device_number`, `registered_device_number`, `registered_token`, `registered_at`, `forgot_token`, `token`, `status`, `role`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hendri Gunawan', NULL, 'admin@wedding.com', NULL, '$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.', 'A0FlhP38Ly9MULzgse5jxoqKmFzhqDJP7TPxSliWPQSRbDO7Fsu0FNCrNgY8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-02-19 02:54:13', '2018-02-19 02:54:13', NULL),
(2, 'Hendri Gunawan', 1, 'hendri.gnw@gmail.com', NULL, '$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.', 'tK58Ix70xSxfYbU1mPMvtOK3runaEQV2wJaZu0ejE7LXkeyNrCWJJ91jhm4T', 'xxx', 'fc53c83dca02e4dc', NULL, NULL, NULL, 'v2pTBeNZk00A9Cus1eyKyNowB', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6Ly8xMC4wLjAuMTkyL3dlZGRpbmctcGxhbm5lci13ZWIvcHVibGljL2FwaS92MS9hdXRoL2xvZ2luIiwiaWF0IjoxNTE5NzM1ODIwLCJleHAiOjE1MjA5NDU0MjAsIm5iZiI6MTUxOTczNTgyMCwianRpIjoiRE9GV21TVFdsYTZpMEJHRCJ9.4gK7E04Sw9lquunssBm_zzvheHnTHYEgsAiLqmJeA1o', 1, 10, '2018-02-27 05:50:20', '2018-02-19 02:54:13', '2018-02-27 05:50:20', NULL),
(3, 'Wina Marlina', 0, 'winamarlina97@gmail.com', NULL, '$2y$10$kIX7F7/JqN7itGh6oJnTGe.QAuYw.oL3nQJPXsQNF/BRyZs/RCPz.', 'tK58Ix70xSxfYbU1mPMvtOK3runaEQV2wJaZu0ejE7LXkeyNrCWJJ91jhm4T', 'xxx', 'xxx', NULL, NULL, NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjMsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2VkZGluZy1wbGFubmVyLXdlYi9wdWJsaWMvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1MTkxMzIyNzYsImV4cCI6MTUyMDM0MTg3NiwibmJmIjoxNTE5MTMyMjc2LCJqdGkiOiJhQm5aY09qNURNMFlWa0xXIn0.Fm7T5Ztv_zWHXDWoVcp-UKY5o4t7qwzMuEmEUWIE_xg', 1, 10, '2018-02-20 06:11:16', '2018-02-19 02:54:13', '2018-02-20 06:11:16', NULL),
(4, 'Gunawan', NULL, 'hendri.gnw1@gmail.com', NULL, '$2y$10$lxnkdhjmFhzn7Utve43SpO/RsE0cglPsYF54gC99zz24HUgYgdyHa', 'UaMLflGH5S4RdWb8dCvmV5BedJZKSHDxMEUoiCEkAo2KQuUquZsSV8r5lZWs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-02-21 03:07:30', '2018-02-21 03:07:30', NULL),
(5, 'Lorem Ipsum', 1, 'loremipsum@gmail.com', '08561471500', '$2y$10$oYp7nF9Zlh/WHyQ5gTTODOBBatGM1JHHHDkxKfYtr/FN91PULOosW', NULL, 'xxx', 'xxx', 'xxx', NULL, '2018-02-24 03:10:07', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjUsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC93ZWRkaW5nLXBsYW5uZXItd2ViL3B1YmxpYy9hcGkvdjEvYXV0aC9sb2dpbiIsImlhdCI6MTUxOTUyMzg5OSwiZXhwIjoxNTIwNzMzNDk5LCJuYmYiOjE1MTk1MjM4OTksImp0aSI6ImVEbWEybWpJbVJCM1ZNWDYifQ.AIrlMxXvjY3vmA24Nkqy6DNMkPQi_aXZ40QNe3cQkew', 1, 10, '2018-02-24 18:58:19', '2018-02-24 03:10:07', '2018-02-24 23:57:50', NULL),
(6, 'Lorem Ipsum Female', 0, 'loremipsumfemale@gmail.com', '085711202889', '$2y$10$dP6XnfZSvaf82fsOEPTR6eb5a8X71VjMw0MLZCtbBezqlKA130LwC', NULL, 'xxx', NULL, 'xxx', NULL, '2018-02-24 23:37:55', NULL, NULL, 1, 10, '2018-02-24 23:37:55', '2018-02-24 03:10:07', '2018-02-24 23:37:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_relation`
--

CREATE TABLE `user_relation` (
  `id` bigint(20) NOT NULL,
  `male_user_id` bigint(20) UNSIGNED NOT NULL,
  `female_user_id` bigint(20) UNSIGNED NOT NULL,
  `wedding_day` date DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_relation`
--

INSERT INTO `user_relation` (`id`, `male_user_id`, `female_user_id`, `wedding_day`, `venue`, `photo`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2018-09-05', 'Braja Mustika, Bogor', NULL, '2018-02-20', '2018-02-20'),
(2, 5, 6, NULL, NULL, NULL, '2018-02-24', '2018-02-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concept`
--
ALTER TABLE `concept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concept_id` (`concept_id`),
  ADD KEY `user_relation_id` (`user_relation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `content_detail`
--
ALTER TABLE `content_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `content_detail_list`
--
ALTER TABLE `content_detail_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_detail_id` (`content_detail_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedure`
--
ALTER TABLE `procedure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_relation`
--
ALTER TABLE `user_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `male_user_id` (`male_user_id`),
  ADD KEY `female_user_id` (`female_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concept`
--
ALTER TABLE `concept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `content_detail`
--
ALTER TABLE `content_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `content_detail_list`
--
ALTER TABLE `content_detail_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `procedure`
--
ALTER TABLE `procedure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_relation`
--
ALTER TABLE `user_relation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_2` FOREIGN KEY (`concept_id`) REFERENCES `concept` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_ibfk_5` FOREIGN KEY (`user_relation_id`) REFERENCES `user_relation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `content_detail`
--
ALTER TABLE `content_detail`
  ADD CONSTRAINT `content_detail_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `content_detail_list`
--
ALTER TABLE `content_detail_list`
  ADD CONSTRAINT `content_detail_list_ibfk_2` FOREIGN KEY (`content_detail_id`) REFERENCES `content_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_relation`
--
ALTER TABLE `user_relation`
  ADD CONSTRAINT `user_relation_ibfk_3` FOREIGN KEY (`male_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation_ibfk_4` FOREIGN KEY (`female_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
