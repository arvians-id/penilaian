-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 16 Nov 2021 pada 17.44
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

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
-- Struktur dari tabel `tb_autentikasi`
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
-- Dumping data untuk tabel `tb_autentikasi`
--

INSERT INTO `tb_autentikasi` (`id`, `username`, `password`, `role`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nip`, `pendidikan_terakhir`, `agama`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'fe60cd55fdfc68c9ee1814ce57c2e61c', 'admin', 'Widdy', 'Laki-laki', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'guru', 'fe60cd55fdfc68c9ee1814ce57c2e61c', 'guru', 'Nesciunt consequatu', 'Laki-laki', '2012-04-07', '123456789012345669', 'Voluptate quia irure', 'Et recusandae Nesci', '082299921720', 'Beatae inventore off', '2021-11-16 03:24:07', '2021-11-16 03:24:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_mata_pelajaran`
--

CREATE TABLE `tb_data_mata_pelajaran` (
  `id_mapel` bigint(20) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(26) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_data_mata_pelajaran`
--

INSERT INTO `tb_data_mata_pelajaran` (`id_mapel`, `kode_mapel`, `mata_pelajaran`, `created_at`, `updated_at`) VALUES
(1, 'BTQ', 'Non excepturi et sed', '2021-11-16 03:25:29', '2021-11-16 03:25:29'),
(2, 'IQRA', 'Atque eum voluptas e', '2021-11-16 03:25:39', '2021-11-16 03:25:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_siswa`
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
-- Dumping data untuk tabel `tb_data_siswa`
--

INSERT INTO `tb_data_siswa` (`id_siswa`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `nama_wali`, `tahun_masuk`, `created_at`, `updated_at`) VALUES
(1, 'Sunt maxime dolor vo', 'Laki-laki', '2021-11-16', 'Sunt maxime', '2020', '2021-11-16 03:24:56', '2021-11-16 03:24:56'),
(2, 'Amet ut ut nemo dol', 'Perempuan', '2021-11-16', 'Amet ut ut', '2020', '2021-11-16 03:25:18', '2021-11-16 03:25:18'),
(3, 'Pariatur Ipsum dolo', 'Perempuan', '2001-06-20', 'Quidem rep', '2020', '2021-11-16 04:51:17', '2021-11-16 04:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_tahun_ajaran`
--

CREATE TABLE `tb_data_tahun_ajaran` (
  `id_ta` bigint(20) NOT NULL,
  `tahun_ajaran` varchar(15) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_data_tahun_ajaran`
--

INSERT INTO `tb_data_tahun_ajaran` (`id_ta`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(1, '2020/2021', '2', '2021-11-16 03:25:46', '2021-11-16 03:25:46'),
(2, '2021/2022', '1', '2021-11-16 04:08:15', '2021-11-16 04:08:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL,
  `nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_nilai`
--

INSERT INTO `tb_nilai` (`pengajaran_id`, `siswa_id`, `mapel_id`, `nilai`) VALUES
(1, 1, 1, 70),
(1, 1, 2, 80),
(1, 2, 1, 0),
(1, 2, 2, 0),
(1, 3, 1, 39),
(1, 3, 2, 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajaran`
--

CREATE TABLE `tb_pengajaran` (
  `id_pengajaran` bigint(20) NOT NULL,
  `guru_id` bigint(20) NOT NULL,
  `ta_id` bigint(20) NOT NULL,
  `kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajaran`
--

INSERT INTO `tb_pengajaran` (`id_pengajaran`, `guru_id`, `ta_id`, `kelas`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajaran_mapel`
--

CREATE TABLE `tb_pengajaran_mapel` (
  `pengajaran_id` bigint(20) NOT NULL,
  `mapel_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajaran_mapel`
--

INSERT INTO `tb_pengajaran_mapel` (`pengajaran_id`, `mapel_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajaran_siswa`
--

CREATE TABLE `tb_pengajaran_siswa` (
  `pengajaran_id` bigint(20) NOT NULL,
  `siswa_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajaran_siswa`
--

INSERT INTO `tb_pengajaran_siswa` (`pengajaran_id`, `siswa_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indeks untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`pengajaran_id`,`siswa_id`,`mapel_id`),
  ADD KEY `tb_nilai_ibfk_3` (`siswa_id`),
  ADD KEY `tb_nilai_ibfk_4` (`mapel_id`);

--
-- Indeks untuk tabel `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  ADD PRIMARY KEY (`id_pengajaran`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `ta_id` (`ta_id`);

--
-- Indeks untuk tabel `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  ADD PRIMARY KEY (`pengajaran_id`,`mapel_id`),
  ADD KEY `tb_pengajaran_mapel_ibfk_1` (`mapel_id`);

--
-- Indeks untuk tabel `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  ADD PRIMARY KEY (`pengajaran_id`,`siswa_id`),
  ADD KEY `tb_pengajaran_siswa_ibfk_2` (`siswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_autentikasi`
--
ALTER TABLE `tb_autentikasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_data_mata_pelajaran`
--
ALTER TABLE `tb_data_mata_pelajaran`
  MODIFY `id_mapel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_data_siswa`
--
ALTER TABLE `tb_data_siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_data_tahun_ajaran`
--
ALTER TABLE `tb_data_tahun_ajaran`
  MODIFY `id_ta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  MODIFY `id_pengajaran` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `tb_nilai_ibfk_2` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_3` FOREIGN KEY (`siswa_id`) REFERENCES `tb_pengajaran_siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_4` FOREIGN KEY (`mapel_id`) REFERENCES `tb_pengajaran_mapel` (`mapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengajaran`
--
ALTER TABLE `tb_pengajaran`
  ADD CONSTRAINT `tb_pengajaran_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `tb_autentikasi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_ibfk_2` FOREIGN KEY (`ta_id`) REFERENCES `tb_data_tahun_ajaran` (`id_ta`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengajaran_mapel`
--
ALTER TABLE `tb_pengajaran_mapel`
  ADD CONSTRAINT `tb_pengajaran_mapel_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `tb_data_mata_pelajaran` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_mapel_ibfk_2` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengajaran_siswa`
--
ALTER TABLE `tb_pengajaran_siswa`
  ADD CONSTRAINT `tb_pengajaran_siswa_ibfk_1` FOREIGN KEY (`pengajaran_id`) REFERENCES `tb_pengajaran` (`id_pengajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengajaran_siswa_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `tb_data_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
