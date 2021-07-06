-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 08:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_penilaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_autentikasi`
--

CREATE TABLE `tb_autentikasi` (
  `id` bigint(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` enum('admin','guru') NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `pendidikan_terakhir` varchar(25) DEFAULT NULL,
  `agama` varchar(25) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_autentikasi`
--

INSERT INTO `tb_autentikasi` (`id`, `username`, `password`, `role`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nip`, `pendidikan_terakhir`, `agama`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-06 02:39:24', '2021-07-06 02:39:27'),
(2, 'guru', 'e10adc3949ba59abbe56e057f20f883e', 'guru', 'Widdy Arfiansyah', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-06 03:53:18', '2021-07-06 03:53:21'),
(6, 'guru01', 'e10adc3949ba59abbe56e057f20f883e', 'guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_mata_pelajaran`
--

CREATE TABLE `tb_data_mata_pelajaran` (
  `id_mapel` bigint(20) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(26) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_mata_pelajaran`
--

INSERT INTO `tb_data_mata_pelajaran` (`id_mapel`, `kode_mapel`, `mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'BTQ', 'Baca Tulis Quran', '2021-07-06 04:44:52', '2021-07-06 04:44:52'),
(2, 'FQH', 'Fiqih', '2021-07-06 04:52:14', '2021-07-06 04:52:14'),
(3, 'HDS', 'Hadits', '2021-07-07 05:20:14', '2021-07-07 05:20:14'),
(4, 'TRK', 'Tarikh', '2021-07-06 04:52:55', '2021-07-06 04:52:55'),
(5, 'ARB', 'Bahasa Arab', '2021-07-06 04:53:07', '2021-07-06 04:53:07'),
(6, 'AKH', 'Akhlaq', '2021-07-06 04:53:20', '2021-07-06 04:53:20'),
(7, 'AQD', 'Aqidah', '2021-07-06 04:53:26', '2021-07-06 04:53:26'),
(8, 'IML', 'Imla', '2021-07-07 05:20:24', '2021-07-07 05:20:24'),
(9, 'PRK', 'Praktik', '2021-07-07 05:23:51', '2021-07-07 05:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_siswa`
--

CREATE TABLE `tb_data_siswa` (
  `id_siswa` bigint(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_wali` varchar(25) NOT NULL,
  `tahun_masuk` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_siswa`
--

INSERT INTO `tb_data_siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nama_wali`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 'Widdy Arfiansyah', 'Laki-laki', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:43:40', '2021-07-06 04:43:40'),
(2, 'Agung Bimantara P', 'Laki-laki', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:50:11', '2021-07-06 04:50:11'),
(3, 'Mang Tamvan', 'Laki-laki', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:50:21', '2021-07-06 04:50:21'),
(4, 'Adela Greenfelder', 'Perempuan', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:50:32', '2021-07-06 04:50:32'),
(5, 'Lisa Anemon', 'Perempuan', '2021-07-07', 'Kepo', '2020', '2021-07-06 04:50:46', '2021-07-06 04:50:46'),
(6, 'Waffer Roma', 'Laki-laki', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:50:55', '2021-07-06 04:50:55'),
(7, 'Udin Markudin', 'Laki-laki', '2021-07-06', 'Kepo', '2020', '2021-07-06 04:51:09', '2021-07-06 04:51:09'),
(8, 'Asuna SAO', 'Perempuan', '2021-07-08', 'Kepo', '2020', '2021-07-07 05:07:09', '2021-07-07 05:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_tahun_ajaran`
--

CREATE TABLE `tb_data_tahun_ajaran` (
  `id_ta` bigint(20) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_tahun_ajaran`
--

INSERT INTO `tb_data_tahun_ajaran` (`id_ta`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(1, '2020/2021', '1', '2021-07-06 04:45:05', '2021-07-07 05:23:34'),
(2, '2020/2021', '2', '2021-07-07 05:23:38', '2021-07-07 05:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `pm_id` bigint(20) NOT NULL,
  `ps_id` bigint(20) NOT NULL,
  `nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran`
--

CREATE TABLE `tb_pengajaran` (
  `id_pengajaran` bigint(20) NOT NULL,
  `guru_id` bigint(20) NOT NULL,
  `ta_id` bigint(20) NOT NULL,
  `kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajaran`
--

INSERT INTO `tb_pengajaran` (`id_pengajaran`, `guru_id`, `ta_id`, `kelas`) VALUES
(1, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran_mapel`
--

CREATE TABLE `tb_pengajaran_mapel` (
  `id_pm` int(11) NOT NULL,
  `pengajaran_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajaran_siswa`
--

CREATE TABLE `tb_pengajaran_siswa` (
  `id_ps` bigint(20) NOT NULL,
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  ADD PRIMARY KEY (`id_pengajaran`);

--
-- Indexes for table `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indexes for table `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  ADD PRIMARY KEY (`id_ps`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  MODIFY `id_mapel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  MODIFY `id_ta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  MODIFY `id_pengajaran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  MODIFY `id_ps` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
