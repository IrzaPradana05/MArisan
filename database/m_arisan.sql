-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 12:01 PM
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
-- Table structure for table `h_keuangan`
--

CREATE TABLE `h_keuangan` (
  `id` int(11) NOT NULL,
  `tipe` int(11) NOT NULL DEFAULT 1 COMMENT '1->debit, 2->kredit',
  `catatan` text DEFAULT NULL,
  `nominal` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_arisan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_keuangan`
--

INSERT INTO `h_keuangan` (`id`, `tipe`, `catatan`, `nominal`, `created_date`, `created_by`, `id_user`, `id_arisan`) VALUES
(31, 2, 'Pembayaran iuran Arisan 3 Periode 2 oleh Tina', 600000, '2021-12-11 18:27:28', 1, 20, 12),
(32, 2, 'Pembayaran iuran Arisan 3 Periode 1 oleh Tina', 600000, '2021-12-11 18:27:39', 1, 20, 12),
(33, 2, 'Pembayaran iuran Arisan 3 Periode 2 oleh Panitia Emy', 600000, '2021-12-11 18:27:51', 1, 21, 12),
(34, 2, 'Pembayaran iuran Arisan 3 Periode 1 oleh Panitia Emy', 600000, '2021-12-11 18:28:00', 1, 21, 12),
(35, 1, 'Pembayaran dana Arisan 3 Kepada Panitia Emy Periode 2', 1200000, '2021-12-11 18:35:20', 1, 21, 12),
(36, 1, 'Pembayaran dana Arisan 3 Kepada Tina Periode 2', 1200000, '2021-12-11 18:36:07', 1, 20, 12),
(37, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 2 oleh Aina', 400000, '2021-12-13 20:30:46', 1, 24, 14),
(38, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 1 oleh Aina', 400000, '2021-12-13 20:30:57', 1, 24, 14),
(39, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 2 oleh Panitia Emy', 400000, '2021-12-13 20:35:04', 1, 21, 14),
(40, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 1 oleh Panitia Emy', 400000, '2021-12-13 20:36:35', 1, 21, 14),
(41, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 2 oleh Agus', 400000, '2021-12-13 20:36:44', 1, 22, 14),
(42, 2, 'Pembayaran iuran Arisan Desember 2021 Periode 1 oleh Agus', 400000, '2021-12-13 20:36:54', 1, 22, 14),
(43, 1, 'Pembayaran dana Arisan Desember 2021 Kepada Aina Periode 2', 1200000, '2021-12-13 20:38:27', 1, 24, 14),
(44, 1, 'Pembayaran dana Arisan Desember 2021 Kepada Agus Periode 2', 1200000, '2021-12-13 20:38:35', 1, 22, 14);

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
-- Table structure for table `m_arisan`
--

CREATE TABLE `m_arisan` (
  `id_arisan` int(11) NOT NULL,
  `nama_arisan` varchar(100) DEFAULT NULL,
  `jumlah_slot` int(11) NOT NULL,
  `slot_terisi` int(11) NOT NULL DEFAULT 0,
  `iuran_perbulan` int(11) NOT NULL,
  `periode` int(11) NOT NULL DEFAULT 0,
  `status_arisan` int(11) NOT NULL COMMENT '0 -> batal, 1 -> menunggu, 2 -> aktif, 3 -> selesai',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_arisan`
--

INSERT INTO `m_arisan` (`id_arisan`, `nama_arisan`, `jumlah_slot`, `slot_terisi`, `iuran_perbulan`, `periode`, `status_arisan`, `created_date`, `created_by`) VALUES
(12, 'Arisan 3', 2, 2, 600000, 2, 3, '2021-12-11 18:23:36', 21),
(14, 'Arisan Desember 2021', 3, 3, 400000, 2, 2, '2021-12-13 20:23:18', 24);

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

CREATE TABLE `m_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(100) DEFAULT NULL,
  `kode_role` int(11) NOT NULL DEFAULT 0 COMMENT '0 -> Admin, 1 -> Panitia, 3 -> Anggota'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`id`, `nama_role`, `kode_role`) VALUES
(1, 'Admin', 0),
(2, 'Panitia', 1),
(3, 'Anggota', 2);

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
-- Table structure for table `t_iuran_arisan`
--

CREATE TABLE `t_iuran_arisan` (
  `id` int(11) NOT NULL,
  `id_arisan` int(11) NOT NULL DEFAULT 0,
  `periode` int(11) NOT NULL DEFAULT 0,
  `tenggat_waktu` datetime DEFAULT NULL,
  `status_bayar` int(11) NOT NULL DEFAULT 0 COMMENT '0 -> belum bayar, 1 -> sudah bayar, 2 -> diperiksa, 3 -> tidak valid',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `bukti_bayar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_iuran_arisan`
--

INSERT INTO `t_iuran_arisan` (`id`, `id_arisan`, `periode`, `tenggat_waktu`, `status_bayar`, `id_user`, `bukti_bayar`) VALUES
(36, 12, 1, '2022-01-11 00:00:00', 1, 21, 'images/bukti-bayar/1639221884.jpg'),
(37, 12, 2, '2022-02-11 00:00:00', 1, 21, 'images/bukti-bayar/1639221894.jpg'),
(38, 12, 1, '2022-01-11 00:00:00', 1, 20, 'images/bukti-bayar/1639221854.jpg'),
(39, 12, 2, '2022-02-11 00:00:00', 1, 20, 'images/bukti-bayar/1639221863.jpg'),
(40, 14, 1, '2022-01-13 00:00:00', 1, 24, 'images/bukti-bayar/1639402074.jpg'),
(41, 14, 2, '2022-02-13 00:00:00', 1, 24, 'images/bukti-bayar/1639402223.jpg'),
(42, 14, 3, '2022-03-13 00:00:00', 0, 24, NULL),
(43, 14, 1, '2022-01-13 00:00:00', 1, 22, 'images/bukti-bayar/1639402481.jpg'),
(44, 14, 2, '2022-02-13 00:00:00', 1, 22, 'images/bukti-bayar/1639402492.jpg'),
(45, 14, 3, '2022-03-13 00:00:00', 0, 22, NULL),
(46, 14, 1, '2022-01-13 00:00:00', 1, 21, 'images/bukti-bayar/1639402581.jpg'),
(47, 14, 2, '2022-02-13 00:00:00', 1, 21, 'images/bukti-bayar/1639402304.jpg'),
(48, 14, 3, '2022-03-13 00:00:00', 0, 21, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_slot_arisan`
--

CREATE TABLE `t_slot_arisan` (
  `id` int(11) NOT NULL,
  `id_arisan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `status_undian` int(11) NOT NULL DEFAULT 0 COMMENT '0 -> berlangsung, 1 -> menang, 2 -> menunggu pembayaran',
  `tgl_menang` datetime DEFAULT NULL,
  `periode` int(11) NOT NULL DEFAULT 0,
  `bukti_transfer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_slot_arisan`
--

INSERT INTO `t_slot_arisan` (`id`, `id_arisan`, `id_user`, `status_undian`, `tgl_menang`, `periode`, `bukti_transfer`) VALUES
(26, 12, 21, 1, '2021-12-11 18:28:29', 2, NULL),
(27, 12, 20, 1, '2021-12-11 18:28:17', 1, NULL),
(28, 13, 21, 0, NULL, 0, NULL),
(29, 14, 24, 1, '2021-12-13 20:38:09', 2, NULL),
(30, 14, 22, 1, '2021-12-13 20:37:55', 1, NULL),
(31, 14, 21, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `surat_komitmen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_wallet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wallet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` int(11) NOT NULL DEFAULT 4 COMMENT '0 -> menunggu, 1 -> iya, 2 -> tidak valid, 4 -> belum isi data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `no_hp`, `nik`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `surat_komitmen`, `tipe_wallet`, `no_wallet`, `status_aktif`) VALUES
(1, 'Pujianti', 'pujianti', 'admin@mail.com', NULL, '$2y$10$KzbKi9oeaDVJ8sgtcEpoYuS89oXpg2tBeo9pAnynnhSFZkrrAtscq', NULL, '2020-12-16 14:29:34', '2020-12-16 14:29:34', 0, '8789798787', '564687979', 2, 'Malang', '1998-12-17', 'turen', NULL, 'Bank BNI', '546789789789', 1),
(20, 'Tina', 'anggota1', NULL, NULL, '$2y$10$.AOGaeCwfY9F4Lntyk6dJeAp43E8fhS5Peqv9FcEWUyiU2yF.mRxq', NULL, NULL, NULL, 2, '98798798', '987987897', 1, 'hjhjkhj', '2021-12-22', 'ljlkjlkj', 'images/surat-komitmen/1639478923.jpg', 'OVO', '3726432987', 0),
(21, 'Panitia Emy', 'panitia1', NULL, NULL, '$2y$10$itGUf8CveKv7Nea.NU7Rm./g03GyqqQ90Gd6VmcMgq6OJouArbHdK', NULL, NULL, NULL, 1, '0239849237878', '328740293849238908', 1, 'Bogor', '2006-11-15', 'alskjdkas', 'images/surat-komitmen/1639053779.png', 'Bank BCA', '29348923774', 1),
(22, 'Agus', 'anggota2', NULL, NULL, '$2y$10$.AOGaeCwfY9F4Lntyk6dJeAp43E8fhS5Peqv9FcEWUyiU2yF.mRxq', NULL, NULL, NULL, 2, '98798798', '987987897', 1, 'bogor', '2021-12-22', 'bogor', 'images/surat-komitmen/1639401877.jpg', 'OVO', '3726432987', 1),
(23, 'Dodi', 'anggota3', NULL, NULL, '$2y$10$OeiJ4uwlT93wHtgmQ1ip7O06J565q9ZWLhXQCUfUKAJVedDW/p8eG', NULL, NULL, NULL, 2, '32984782378', '475893478', 1, 'malang', '2021-12-08', 'malang', 'images/surat-komitmen/1639189162.jpg', 'Bank BRI', '2387482378', 1),
(24, 'Aina', 'panitia2', NULL, NULL, '$2y$10$CkfWz3vJs9ZDBeuPOJzLr.AhE4ExRI5lJJLlLC5pq1u/Ik6mNAyE2', NULL, NULL, NULL, 1, '87564669798', '65798898097', 2, 'bogor', '2008-12-11', 'bogor', 'images/surat-komitmen/1639401622.jpg', 'Bank BRI', '3257698797', 1),
(25, NULL, 'anggota2', NULL, NULL, '$2y$10$mq1HwlQNIvixB2XERGU0kexED9TmOX3JRTieWL/k9KsBKmkB8Pfru', NULL, NULL, NULL, 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `h_keuangan`
--
ALTER TABLE `h_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_arisan`
--
ALTER TABLE `m_arisan`
  ADD PRIMARY KEY (`id_arisan`);

--
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `t_iuran_arisan`
--
ALTER TABLE `t_iuran_arisan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_slot_arisan`
--
ALTER TABLE `t_slot_arisan`
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
-- AUTO_INCREMENT for table `h_keuangan`
--
ALTER TABLE `h_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_arisan`
--
ALTER TABLE `m_arisan`
  MODIFY `id_arisan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_iuran_arisan`
--
ALTER TABLE `t_iuran_arisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `t_slot_arisan`
--
ALTER TABLE `t_slot_arisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
