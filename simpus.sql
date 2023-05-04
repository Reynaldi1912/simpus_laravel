-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 08.02
-- Versi server: 8.0.30
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `id` bigint NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `radius` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa`
--

INSERT INTO `desa` (`id`, `nama_desa`, `latitude`, `longitude`, `radius`, `created_at`, `updated_at`) VALUES
(1, 'Krasak', '-8.054235392277349', '113.21683489686815', '1.5', '2023-03-14 01:57:05', '2023-04-12 21:13:46'),
(2, 'Wonorejo', '-8.074423790328135', '113.23742517526117', '2.5', '2023-03-16 05:17:46', '2023-04-12 21:12:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exception`
--

CREATE TABLE `exception` (
  `id` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `id_user` int NOT NULL,
  `alasan` text NOT NULL,
  `status_appr` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `exception`
--

INSERT INTO `exception` (`id`, `id_jadwal`, `id_user`, `alasan`, `status_appr`, `created_at`, `updated_at`) VALUES
(1, 1, 194172003, 'Tidak Bisa Hadir', 2, '2023-04-03 12:37:53', '2023-05-02 19:18:21'),
(2, 2, 1941720002, 'izin tidak bisa hasir dikarenakan ada acara keluarga , minta ganti tanggal saja', 0, '2023-04-04 16:51:08', '2023-04-18 22:22:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_kunjungan`
--

CREATE TABLE `hasil_kunjungan` (
  `id` int NOT NULL,
  `nik` bigint NOT NULL,
  `berat_badan` float NOT NULL,
  `tinggi_badan` float NOT NULL,
  `tekanan_darah` varchar(10) NOT NULL,
  `diagnosa` text NOT NULL,
  `penyuluhan` text NOT NULL,
  `dokumentasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `hasil_kunjungan`
--

INSERT INTO `hasil_kunjungan` (`id`, `nik`, `berat_badan`, `tinggi_badan`, `tekanan_darah`, `diagnosa`, `penyuluhan`, `dokumentasi`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 2000191200000456, 67.6, 170, '11/228', 'mengalami keluhan pusing dan sering muntah', 'istirahat 8 jam sehari , makan minimal 2x sehari dan minum air putih , obat mual', NULL, '2023-04-12 13:45:39', '2023-04-12 13:45:39', '1941720001', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_exception`
--

CREATE TABLE `history_exception` (
  `id` int NOT NULL,
  `status_appr` int NOT NULL,
  `id_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `old_date` date NOT NULL,
  `new_date` date DEFAULT NULL,
  `kegiatan` text NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `history_exception`
--

INSERT INTO `history_exception` (`id`, `status_appr`, `id_user`, `old_date`, `new_date`, `kegiatan`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 2, '194172003', '2023-04-24', NULL, 'Penyuluhan Makanan Sehat', 'izin tidak disetujui karena petugas 1 bisa hadir', '2023-05-02 19:18:21', '2023-05-02 19:18:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint UNSIGNED NOT NULL,
  `upaya_kesehatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kegiatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `rincian_pelaksanaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_desa` bigint UNSIGNED NOT NULL,
  `nama_pelaksana1` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pelaksana2` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `upaya_kesehatan`, `kegiatan`, `tanggal_mulai`, `rincian_pelaksanaan`, `id_desa`, `nama_pelaksana1`, `nama_pelaksana2`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Penyuluhan', 'Penyuluhan Makanan Sehat', '2023-04-24', 'Melakukan Penyuluhan untuk masyarakat desa krasak', 1, 'Ninik Sumarni', 'Ninik Sumarni', '2023-04-03 05:10:12', '2023-04-18 22:20:29', NULL, NULL, 0),
(2, 'Penyuluhan', 'Penyuluhan Proteksi Diri', '2023-04-05', 'Penyuluhan kepada masayarakt desa wonorejo untuk virus covid 19', 2, 'Reynaldi Ramadhani', 'Reynaldi Ramadhani', '2023-04-03 05:37:07', '2023-04-18 22:22:37', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_03_06_081018_desa_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('051c55c1ea253c7271961d20c30d8666596b93649f6b18d9ff28eb9567b4757afb03b70e61829935', 1, 1, 'appToken', '[]', 1, '2023-02-28 01:52:18', '2023-02-28 01:52:18', '2024-02-28 08:52:18'),
('1c0857877b492543ea9677f86cfaa0300da8332f7a64b2b9e9833e097385eccf980e47350b9071ff', 1, 1, 'appToken', '[]', 0, '2023-02-28 01:47:42', '2023-02-28 01:47:42', '2024-02-28 08:47:42'),
('2d0bf5af85646fba96bb542ab14f850eb409d5c1ae6d2b63e80615715caef7eb91e565d40fef56e7', 1, 1, 'appToken', '[]', 1, '2023-02-28 01:47:54', '2023-02-28 01:47:54', '2024-02-28 08:47:54'),
('383c37c63ccbb49527b65f8ba4bcfdf7b3f1e154dacdc55f567ec8016e47723eb819d6551b0a8a4c', 1, 1, 'appToken', '[]', 0, '2023-02-28 04:50:48', '2023-02-28 04:50:48', '2024-02-28 11:50:48'),
('f63b7d2a4319dbc2122225a30364bfc308085dbc60bb1115fff6c9e30d78273c1c756d3ed76b39b5', 1, 1, 'appToken', '[]', 1, '2023-02-28 01:49:55', '2023-02-28 01:49:55', '2024-02-28 08:49:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'ZNPiI8eBXJPb4Cj7dIYbTwQgimsLR3kDNlTSgeBs', NULL, 'http://localhost', 1, 0, 0, '2023-02-28 01:47:20', '2023-02-28 01:47:20'),
(2, NULL, 'Laravel Password Grant Client', 'Ovcna7uRZpWpzF8OEc0BN2gqDRqabuluzkSwAlDU', 'users', 'http://localhost', 0, 1, 0, '2023-02-28 01:47:20', '2023-02-28 01:47:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-02-28 01:47:20', '2023-02-28 01:47:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `nik` bigint NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jml_anggota_keluarga` int NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bpjs` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) NOT NULL,
  `updated_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`nik`, `nama`, `jml_anggota_keluarga`, `tgl_lahir`, `umur`, `alamat`, `no_hp`, `bpjs`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2000191200000456, 'sifago zettiar D.P', 4, '2013-04-17', 24, 'jl.gondang krasak kedungjajang', '0897866567', 1, '2023-04-12 13:42:46', '2023-04-12 13:42:46', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_desa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `nama_lengkap`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_desa`) VALUES
('1941720001', 'ninik19@gmail.com', 'Ninik Sumarni', 'petugas', NULL, '$2y$10$ocsJTh8bNn3/SVXt7go3aONBaSjjbKyQ/cfHKmlDJXFrFt3yBpys.', NULL, '2023-03-14 01:58:56', '2023-03-14 01:58:56', '1'),
('1941720002', 'reynaldi@gmail.com', 'Reynaldi Ramadhani', 'petugas', NULL, '$2y$10$dpWJkj.Qs07/UEf0BdzYe.iy3fWo8.eBSvpZOkIqartc02uW0d6EK', NULL, '2023-04-03 05:11:05', '2023-04-03 05:11:05', '2'),
('194172003', 'aknuh@gmail.com', 'Mochammad Aknuh', 'petugas', NULL, '$2y$10$4deMx8s3WB6CBy/JEwFeweUT7DBZ/ukuVDTfQqKZgX3pi3TLtrODC', NULL, '2023-04-03 05:11:59', '2023-04-03 05:11:59', '1'),
('1941720142', 'reynaldiluma@gmail.com', 'Reynaldi Ramadhani Eka purnomo', 'admin', NULL, '$2y$10$6pWDN74da8iS50M4qMJCzOwfcMD26PzyJyDAyGyKgVIPwFqrRS8au', NULL, '2023-02-28 01:28:57', '2023-02-28 01:28:57', '0');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_detail_exception`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_detail_exception` (
`id` int
,`id_jadwal` int
,`username` varchar(255)
,`nama_lengkap` varchar(255)
,`nama_desa` varchar(255)
,`alasan` text
,`upaya_kesehatan` text
,`kegiatan` text
,`tanggal_mulai` date
,`rincian_pelaksanaan` text
,`status_kunjungan` int
,`status_appr` int
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_detail_hasil_kunjungan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_detail_hasil_kunjungan` (
`id` int
,`nik` bigint
,`berat_badan` float
,`tinggi_badan` float
,`tekanan_darah` varchar(10)
,`diagnosa` text
,`penyuluhan` text
,`dokumentasi` text
,`created_at` timestamp
,`updated_at` timestamp
,`created_by` varchar(255)
,`updated_by` varchar(20)
,`nama_petugas` varchar(255)
,`nama` varchar(100)
,`alamat` text
,`jml_anggota_keluarga` int
,`no_hp` varchar(15)
,`tgl_lahir` date
,`umur` int
,`bpjs` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_jadwal`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_jadwal` (
`id` bigint unsigned
,`upaya_kesehatan` text
,`kegiatan` text
,`tanggal_mulai` date
,`rincian_pelaksanaan` text
,`id_desa` bigint unsigned
,`nama_pelaksana1` varchar(70)
,`nama_pelaksana2` varchar(70)
,`created_at` timestamp
,`updated_at` timestamp
,`created_by` bigint unsigned
,`updated_by` bigint unsigned
,`nama_desa` varchar(255)
,`color` varchar(5)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_petugas`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_petugas` (
`id` varchar(255)
,`email` varchar(255)
,`nama_lengkap` varchar(255)
,`nama_desa` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_detail_exception`
--
DROP TABLE IF EXISTS `vw_detail_exception`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_detail_exception`  AS SELECT `a`.`id` AS `id`, `a`.`id_jadwal` AS `id_jadwal`, `c`.`id` AS `username`, `c`.`nama_lengkap` AS `nama_lengkap`, `d`.`nama_desa` AS `nama_desa`, `a`.`alasan` AS `alasan`, `b`.`upaya_kesehatan` AS `upaya_kesehatan`, `b`.`kegiatan` AS `kegiatan`, `b`.`tanggal_mulai` AS `tanggal_mulai`, `b`.`rincian_pelaksanaan` AS `rincian_pelaksanaan`, `b`.`status` AS `status_kunjungan`, `a`.`status_appr` AS `status_appr`, `a`.`created_at` AS `created_at` FROM (((`exception` `a` left join `jadwal` `b` on((`a`.`id_jadwal` = `b`.`id`))) left join `users` `c` on((`a`.`id_user` = `c`.`id`))) left join `desa` `d` on((`c`.`id_desa` = `d`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_detail_hasil_kunjungan`
--
DROP TABLE IF EXISTS `vw_detail_hasil_kunjungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_detail_hasil_kunjungan`  AS SELECT `a`.`id` AS `id`, `a`.`nik` AS `nik`, `a`.`berat_badan` AS `berat_badan`, `a`.`tinggi_badan` AS `tinggi_badan`, `a`.`tekanan_darah` AS `tekanan_darah`, `a`.`diagnosa` AS `diagnosa`, `a`.`penyuluhan` AS `penyuluhan`, `a`.`dokumentasi` AS `dokumentasi`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at`, `a`.`created_by` AS `created_by`, `a`.`updated_by` AS `updated_by`, `c`.`nama_lengkap` AS `nama_petugas`, `b`.`nama` AS `nama`, `b`.`alamat` AS `alamat`, `b`.`jml_anggota_keluarga` AS `jml_anggota_keluarga`, `b`.`no_hp` AS `no_hp`, `b`.`tgl_lahir` AS `tgl_lahir`, `b`.`umur` AS `umur`, `b`.`bpjs` AS `bpjs` FROM ((`hasil_kunjungan` `a` left join `pasien` `b` on((`a`.`nik` = `b`.`nik`))) left join `users` `c` on((`a`.`created_by` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_jadwal`
--
DROP TABLE IF EXISTS `vw_jadwal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_jadwal`  AS SELECT `a`.`id` AS `id`, `a`.`upaya_kesehatan` AS `upaya_kesehatan`, `a`.`kegiatan` AS `kegiatan`, `a`.`tanggal_mulai` AS `tanggal_mulai`, `a`.`rincian_pelaksanaan` AS `rincian_pelaksanaan`, `a`.`id_desa` AS `id_desa`, `a`.`nama_pelaksana1` AS `nama_pelaksana1`, `a`.`nama_pelaksana2` AS `nama_pelaksana2`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at`, `a`.`created_by` AS `created_by`, `a`.`updated_by` AS `updated_by`, `b`.`nama_desa` AS `nama_desa`, (case when (`a`.`status` = 0) then 'red' when (`a`.`status` = 1) then 'green' when (`a`.`status` = 2) then 'blue' end) AS `color` FROM (`jadwal` `a` join `desa` `b` on((`a`.`id_desa` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_petugas`
--
DROP TABLE IF EXISTS `vw_petugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_petugas`  AS SELECT `a`.`id` AS `id`, `a`.`email` AS `email`, `a`.`nama_lengkap` AS `nama_lengkap`, `b`.`nama_desa` AS `nama_desa` FROM (`users` `a` join `desa` `b`) WHERE (`a`.`id_desa` = `b`.`id`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exception`
--
ALTER TABLE `exception`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hasil_kunjungan`
--
ALTER TABLE `hasil_kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_exception`
--
ALTER TABLE `history_exception`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `desa`
--
ALTER TABLE `desa`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `exception`
--
ALTER TABLE `exception`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_kunjungan`
--
ALTER TABLE `hasil_kunjungan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `history_exception`
--
ALTER TABLE `history_exception`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
