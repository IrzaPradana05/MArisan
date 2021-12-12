-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 01:54 PM
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
(36, 1, 'Pembayaran dana Arisan 3 Kepada Tina Periode 2', 1200000, '2021-12-11 18:36:07', 1, 20, 12);

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
(12, 'Arisan 3', 2, 2, 600000, 2, 3, '2021-12-11 18:23:36', 21);

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
(39, 12, 2, '2022-02-11 00:00:00', 1, 20, 'images/bukti-bayar/1639221863.jpg');

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
(27, 12, 20, 1, '2021-12-11 18:28:17', 1, NULL);

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
(20, 'Tina', 'anggota1', NULL, NULL, '$2y$10$.AOGaeCwfY9F4Lntyk6dJeAp43E8fhS5Peqv9FcEWUyiU2yF.mRxq', NULL, NULL, NULL, 2, '98798798', '987987897', 1, 'hjhjkhj', '2021-12-22', 'ljlkjlkj', 'images/surat-komitmen/1639039489.png', 'OVO', '3726432987', 1),
(21, 'Panitia Emy', 'panitia1', NULL, NULL, '$2y$10$itGUf8CveKv7Nea.NU7Rm./g03GyqqQ90Gd6VmcMgq6OJouArbHdK', NULL, NULL, NULL, 1, '0239849237878', '328740293849238908', 1, 'Bogor', '2006-11-15', 'alskjdkas', 'images/surat-komitmen/1639053779.png', 'Bank BCA', '29348923774', 1),
(22, 'Agus', 'anggota2', NULL, NULL, '$2y$10$.AOGaeCwfY9F4Lntyk6dJeAp43E8fhS5Peqv9FcEWUyiU2yF.mRxq', NULL, NULL, NULL, 2, '98798798', '987987897', 1, 'bogor', '2021-12-22', 'bogor', 'images/surat-komitmen/1639039489.png', 'OVO', '3726432987', 4),
(23, 'Dodi', 'anggota3', NULL, NULL, '$2y$10$OeiJ4uwlT93wHtgmQ1ip7O06J565q9ZWLhXQCUfUKAJVedDW/p8eG', NULL, NULL, NULL, 2, '32984782378', '475893478', 1, 'malang', '2021-12-08', 'malang', 'images/surat-komitmen/1639189162.jpg', 'Bank BRI', '2387482378', 1);

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
-- Indexes for table `h_keuangan`
--
ALTER TABLE `h_keuangan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `m_arisan`
--
ALTER TABLE `m_arisan`
  ADD PRIMARY KEY (`id_arisan`);

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
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
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
-- Indexes for table `t_iuran_arisan`
--
ALTER TABLE `t_iuran_arisan`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `h_keuangan`
--
ALTER TABLE `h_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
-- AUTO_INCREMENT for table `m_arisan`
--
ALTER TABLE `m_arisan`
  MODIFY `id_arisan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `t_iuran_arisan`
--
ALTER TABLE `t_iuran_arisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
-- AUTO_INCREMENT for table `t_slot_arisan`
--
ALTER TABLE `t_slot_arisan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
