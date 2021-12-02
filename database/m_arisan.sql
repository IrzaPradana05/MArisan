-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 01:01 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m_arisan`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `name`, `age`, `address`, `phone`, `email`) VALUES
(1, 'John', '20', 'USA', '+736746983', 'john@mail.com'),
(2, 'Eric', '17', 'Brazil', '+23876789254', 'eric@mail.com'),
(3, 'Rina', '19', 'Mexico', '+98748943', 'rina@mail.com'),
(13, 'alex', '11', 'akldjkl', '3204823', 'asa@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_kamar`
--

CREATE TABLE `m_kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(100) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `luas` varchar(50) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `tahunan` varchar(50) DEFAULT NULL,
  `bulanan` varchar(50) DEFAULT NULL,
  `mingguan` varchar(50) DEFAULT NULL,
  `harian` varchar(50) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 -> show, 1 -> hide'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kamar`
--

INSERT INTO `m_kamar` (`id_kamar`, `nama_kamar`, `kapasitas`, `luas`, `fasilitas`, `tahunan`, `bulanan`, `mingguan`, `harian`, `deleted`) VALUES
(1, 'KMR01', 1, '5x5', 'Full', NULL, '500000', NULL, NULL, 1),
(2, 'KMR04', 1, '4x6', 'Lemari, Kasur Tidur', NULL, NULL, '350000', '50000', 1),
(3, 'KMR02', 1, '4x6', 'Lemari, Kasur Tidur', NULL, NULL, '350000', NULL, 1),
(4, 'KMR03', 1, NULL, NULL, NULL, NULL, '350000', NULL, 1),
(5, 'KMR04', 2, NULL, NULL, NULL, NULL, '350000', NULL, 1),
(6, 'KMR02', 1, '4x6', 'Lemari, Kasur Tidur', NULL, NULL, '350000', NULL, 1),
(7, 'KMR05', 2, NULL, NULL, NULL, NULL, '350000', NULL, 1),
(8, 'aS\\', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE `m_kelas` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(10) DEFAULT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id`, `kode_kelas`, `nama_kelas`) VALUES
(1, 'X-A', '10 A'),
(2, 'X-B', '10 B'),
(3, 'XI-A', '11 A'),
(4, 'XI-B', '11 B'),
(5, 'XII-A', '12 A'),
(6, 'XII-B', '12 B');

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE `m_siswa` (
  `nis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'users->id',
  `no_ktp_wali` bigint(20) NOT NULL DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `kode_kelas` varchar(10) DEFAULT NULL COMMENT 'm_kelas->kode_kelas',
  `tanggal_lahir` date DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`nis`, `id_user`, `no_ktp_wali`, `nama`, `kode_kelas`, `tanggal_lahir`, `jk`) VALUES
(11111, 14, 123123123, 'anisa', 'X-A', '2021-08-26', 'P'),
(1234567, 18, 11287198721, 'Limbad Ilbad', 'X-B', '2008-07-08', 'L'),
(32432432, 17, 123123123, 'Joni', 'X-A', '2021-08-17', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `m_wali`
--

CREATE TABLE `m_wali` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'users->id',
  `no_ktp` bigint(20) NOT NULL DEFAULT 0,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_wali`
--

INSERT INTO `m_wali` (`id`, `id_user`, `no_ktp`, `nama`, `email`, `no_telp`, `alamat`) VALUES
(1, 6, 11287198721, 'Satrio', 'ada@mail.com', '123453', 'malang'),
(3, 16, 3470298349802, 'Ahsan', 'ahsan@mail.com', '08394279837', 'malang'),
(4, 19, 123123123, 'Thariq', 'thariq@mail.com', '089123123', 'malang');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_hasil_psikotes`
--

CREATE TABLE `t_hasil_psikotes` (
  `id` int(11) NOT NULL,
  `id_pengumuman` int(11) NOT NULL DEFAULT 0,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `nilai` varchar(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hasil_psikotes`
--

INSERT INTO `t_hasil_psikotes` (`id`, `id_pengumuman`, `nis`, `nilai`, `tanggal`, `created_by`) VALUES
(9, 1, 11111, '85', '2021-08-09 11:37:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_hasil_reflin`
--

CREATE TABLE `t_hasil_reflin` (
  `id` int(11) NOT NULL,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `nilai` varchar(10) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_hasil_reflin`
--

INSERT INTO `t_hasil_reflin` (`id`, `nis`, `nilai`, `tanggal`, `created_by`) VALUES
(1, 32432432, '72', '2021-08-09 14:02:20', 1),
(3, 11111, '70', '2021-08-09 14:03:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_karir`
--

CREATE TABLE `t_karir` (
  `id` int(11) NOT NULL,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_karir`
--

INSERT INTO `t_karir` (`id`, `nis`, `catatan`, `tanggal`, `created_by`) VALUES
(1, 32432432, 'pengen jadi guru', '2021-08-07 22:39:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_konseling`
--

CREATE TABLE `t_konseling` (
  `id` int(11) NOT NULL,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_konseling`
--

INSERT INTO `t_konseling` (`id`, `nis`, `catatan`, `tanggal`, `created_by`) VALUES
(1, 11111, 'catatan', '2021-08-07 22:22:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggaran`
--

CREATE TABLE `t_pelanggaran` (
  `id` int(11) NOT NULL,
  `nis_pelanggar` bigint(20) NOT NULL DEFAULT 0,
  `kategori_pelanggaran` varchar(50) DEFAULT NULL,
  `poin_pelanggaran` int(11) NOT NULL DEFAULT 0,
  `pelanggaran` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `sanksi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pelanggaran`
--

INSERT INTO `t_pelanggaran` (`id`, `nis_pelanggar`, `kategori_pelanggaran`, `poin_pelanggaran`, `pelanggaran`, `tanggal`, `created_by`, `sanksi`) VALUES
(2, 32432432, 'sedang', 5, 'bolos', '2021-08-06 04:39:35', 1, 'ngecat'),
(3, 11111, 'berat', 10, 'tawuran di pasar kembang', '2021-08-06 04:45:03', 1, NULL),
(4, 11111, 'berat', 10, 'mabuk', '2021-08-06 21:04:34', 1, 'skors');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengumuman_psikotes`
--

CREATE TABLE `t_pengumuman_psikotes` (
  `id` int(11) NOT NULL,
  `teks_pengumuman` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengumuman_psikotes`
--

INSERT INTO `t_pengumuman_psikotes` (`id`, `teks_pengumuman`, `tanggal`, `created_by`) VALUES
(1, 'TES pada tanggal 20 September', '2021-08-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pesan`
--

CREATE TABLE `t_pesan` (
  `id` int(11) NOT NULL,
  `id_user_pengirim` int(11) NOT NULL DEFAULT 0,
  `id_user_penerima` int(11) NOT NULL DEFAULT 0,
  `teks` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 -> unread, 1 -> read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pesan`
--

INSERT INTO `t_pesan` (`id`, `id_user_pengirim`, `id_user_penerima`, `teks`, `tanggal`, `status`) VALUES
(1, 1, 14, 'ksajas', '2021-08-11 00:00:00', 0),
(2, 14, 1, 'ksajas', '2021-08-11 00:00:00', 1),
(3, 16, 1, 'ksajas', '2021-08-11 00:00:00', 1),
(4, 14, 1, 'ksajas hkj', '2021-08-11 00:00:00', 1),
(10, 1, 18, 'hallo', '2021-08-13 09:52:26', 1),
(11, 18, 1, 'iya', '2021-08-13 10:01:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_peserta_psikotes`
--

CREATE TABLE `t_peserta_psikotes` (
  `id` int(11) NOT NULL,
  `id_pengumuman` int(11) NOT NULL DEFAULT 0,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_peserta_psikotes`
--

INSERT INTO `t_peserta_psikotes` (`id`, `id_pengumuman`, `nis`, `tanggal`) VALUES
(1, 1, 11111, '2021-08-10 00:00:00'),
(2, 1, 1234567, '2021-08-13 09:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `t_prestasi`
--

CREATE TABLE `t_prestasi` (
  `id` int(11) NOT NULL,
  `nis` bigint(20) NOT NULL DEFAULT 0,
  `kategori_prestasi` varchar(50) DEFAULT NULL,
  `prestasi` text DEFAULT NULL,
  `hadiah` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_prestasi`
--

INSERT INTO `t_prestasi` (`id`, `nis`, `kategori_prestasi`, `prestasi`, `hadiah`, `tanggal`, `created_by`) VALUES
(1, 11111, 'dalam sekolah', 'ranking 1 kelas', 'SPP 2 bulan', '2021-08-06', 1),
(2, 32432432, 'luar sekolah', 'juara sepakbola', 'uang 500.000', '2021-08-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '0 -> Admin, 1 -> Panitia, 2 -> anggota, 3 -> Tamu',
  `no_hp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` int(11) NOT NULL DEFAULT 1 COMMENT '1 -> laki-laki, 2-> perempuan',
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_komitmen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `no_hp`, `nik`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `surat_komitmen`) VALUES
(1, 'Pujianti', 'pujianti', 'admin@mail.com', NULL, '$2y$10$KzbKi9oeaDVJ8sgtcEpoYuS89oXpg2tBeo9pAnynnhSFZkrrAtscq', NULL, '2020-12-16 14:29:34', '2020-12-16 14:29:34', 0, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(14, 'anisa', NULL, 'ada@mail.com', NULL, '$2y$10$K3Tpko2QjDItnuRvPZBql.eEP5A9DnqJE/Gxtu/PPeiXTUjTlwWne', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(16, 'Ahsan', NULL, 'ahsan@mail.com', NULL, '$2y$10$ybHwW.oghjQKZMXA9YSi.eq73CnNCfrwiP.m39lynRzkNVR564Xqm', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(17, 'Joni', NULL, 'jon@mail.com', NULL, '$2y$10$mQw4kXeTIxG07P2xHJ0TDe8S81azvJovJmfxY5AfMx6pDLw40xRsu', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(18, 'Limbad Ilbad', NULL, 'siswa@mail.com', NULL, '$2y$10$h3gnmIPdzFCqB6Viap7kiuoj4y7moLQ7OQMgWY0iwwQ9DPcR9Qtxy', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(19, 'Thariq', NULL, 'thariq@mail.com', NULL, '$2y$10$7GSa7Gk4jJlR5B90a9uRE.42t4J9Qpsspdu6tE4up.6wpWITZ5Vzi', NULL, NULL, NULL, 2, NULL, NULL, 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kamar`
--
ALTER TABLE `m_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `m_kelas`
--
ALTER TABLE `m_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_siswa`
--
ALTER TABLE `m_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `m_wali`
--
ALTER TABLE `m_wali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `t_hasil_psikotes`
--
ALTER TABLE `t_hasil_psikotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_hasil_reflin`
--
ALTER TABLE `t_hasil_reflin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_karir`
--
ALTER TABLE `t_karir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_konseling`
--
ALTER TABLE `t_konseling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pengumuman_psikotes`
--
ALTER TABLE `t_pengumuman_psikotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pesan`
--
ALTER TABLE `t_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_peserta_psikotes`
--
ALTER TABLE `t_peserta_psikotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_prestasi`
--
ALTER TABLE `t_prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_kamar`
--
ALTER TABLE `m_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_kelas`
--
ALTER TABLE `m_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_wali`
--
ALTER TABLE `m_wali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_hasil_psikotes`
--
ALTER TABLE `t_hasil_psikotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_hasil_reflin`
--
ALTER TABLE `t_hasil_reflin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_karir`
--
ALTER TABLE `t_karir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_konseling`
--
ALTER TABLE `t_konseling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pelanggaran`
--
ALTER TABLE `t_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_pengumuman_psikotes`
--
ALTER TABLE `t_pengumuman_psikotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pesan`
--
ALTER TABLE `t_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_peserta_psikotes`
--
ALTER TABLE `t_peserta_psikotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_prestasi`
--
ALTER TABLE `t_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
