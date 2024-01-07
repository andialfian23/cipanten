-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2024 pada 14.22
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cipanten`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_absensi`
--

CREATE TABLE `t_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_karyawan` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_dept`
--

CREATE TABLE `t_dept` (
  `id_dept` int(11) NOT NULL,
  `nama_dept` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_dept`
--

INSERT INTO `t_dept` (`id_dept`, `nama_dept`) VALUES
(1, 'IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_gaji`
--

CREATE TABLE `t_gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `nama_gaji` varchar(50) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `hitungan_kerja` enum('Harian','Mingguan','Bulanan') NOT NULL,
  `jam_kerja` time NOT NULL,
  `telat_masuk` int(11) DEFAULT NULL,
  `tidak_hadir` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_gaji`
--

INSERT INTO `t_gaji` (`id_gaji`, `id_jabatan`, `id_dept`, `nama_gaji`, `gaji_pokok`, `hitungan_kerja`, `jam_kerja`, `telat_masuk`, `tidak_hadir`, `keterangan`) VALUES
(1, 1, 1, 'Gaji Office Bulanan', 2600000, 'Bulanan', '10:00:00', 0, 85666, 'Gaji Bulanan'),
(7, 3, 1, 'Gaji Asisten Manager IT', 2600000, 'Harian', '00:00:00', 0, 87666, 'Gaji Asisten Manager IT'),
(11, 5, 1, 'Gaji Ketua IT', 2600000, 'Harian', '00:00:00', 0, 90000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_gaji_karyawan`
--

CREATE TABLE `t_gaji_karyawan` (
  `id_gk` int(11) NOT NULL,
  `tgl_gajian` datetime NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `id_gaji` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `jml_hadir` int(11) NOT NULL,
  `jml_tidak_hadir` int(11) NOT NULL,
  `jml_telat_masuk` int(11) NOT NULL,
  `ttl_gaji_pokok` int(11) NOT NULL,
  `ttl_bonus` int(11) NOT NULL,
  `ttl_tidak_hadir` int(11) NOT NULL,
  `ttl_telat_masuk` int(11) DEFAULT NULL,
  `total_terima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_gaji_karyawan`
--

INSERT INTO `t_gaji_karyawan` (`id_gk`, `tgl_gajian`, `tgl_awal`, `tgl_akhir`, `id_gaji`, `id_karyawan`, `jml_hadir`, `jml_tidak_hadir`, `jml_telat_masuk`, `ttl_gaji_pokok`, `ttl_bonus`, `ttl_tidak_hadir`, `ttl_telat_masuk`, `total_terima`) VALUES
(12, '2023-11-22 00:00:00', '2023-12-01', '2023-12-22', 1, 7, 1, 20, 0, 2600000, 0, 1713320, 0, 886680),
(13, '2022-12-22 00:00:00', '2023-12-01', '2023-12-22', 1, 8, 2, 19, 0, 2600000, 0, 1627654, 0, 972346),
(14, '2023-12-22 00:00:00', '2023-12-01', '2023-12-22', 1, 3, 1, 20, 0, 2600000, 0, 1713320, 0, 886680),
(15, '2023-12-22 00:00:00', '2023-12-01', '2023-12-22', 1, 2, 1, 20, 0, 2600000, 0, 1713320, 0, 886680),
(16, '2023-11-22 00:00:00', '2023-11-01', '2023-11-30', 1, 8, 1, 28, 0, 2600000, 190000, 2398648, 0, 391352),
(18, '2024-01-01 00:00:00', '2023-12-01', '2023-12-31', 1, 7, 1, 29, 0, 2600000, 0, 2484314, 0, 115686),
(19, '2024-01-01 00:00:00', '2023-12-01', '2023-12-31', 1, 8, 1, 29, 0, 2600000, 0, 2484314, 0, 115686),
(20, '2024-01-01 00:00:00', '2023-12-01', '2023-12-31', 1, 4, 1, 29, 0, 2600000, 0, 2484314, 0, 115686),
(21, '2024-01-01 00:00:00', '2023-12-01', '2023-12-31', 1, 3, 1, 29, 0, 2600000, 0, 2484314, 0, 115686);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_jabatan`
--

INSERT INTO `t_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'STAFF'),
(3, 'ASISTEN MANAGER'),
(5, 'KETUA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `id` int(11) NOT NULL,
  `id_karyawan` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `join_at` date NOT NULL,
  `status` enum('Aktif','Keluar','Tidak Diketahui') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_karyawan`
--

INSERT INTO `t_karyawan` (`id`, `id_karyawan`, `nama`, `jk`, `tgl_lahir`, `alamat`, `no_hp`, `foto`, `id_jabatan`, `id_dept`, `join_at`, `status`, `created_at`, `updated_at`) VALUES
(2, '167791', 'UNAN AGNAN', 'L', '1991-12-01', 'Kuningan', '08101011991', NULL, 1, 1, '2021-12-21', 'Aktif', '2023-11-21 00:00:00', '2024-01-07 00:00:00'),
(3, '166184', 'PENDI ANGGA SUKMANA', 'L', '1992-04-29', 'Maja', '0822222222222', NULL, 1, 1, '2021-12-01', 'Aktif', '2023-11-23 00:00:00', '2023-11-26 00:00:00'),
(4, '165007', 'JIMI MIKAIL ZAMZAMI', 'L', '1993-05-14', 'Kadipaten', '082170625938', NULL, 1, 1, '2021-11-11', 'Aktif', '2023-11-23 00:00:00', '2023-11-25 00:00:00'),
(5, '160015', 'GUGUN GUNAWAN', 'L', '1994-05-25', 'Weragati', '08444444444444', NULL, 1, 1, '2022-08-11', 'Aktif', '2023-11-24 00:00:00', '2023-11-25 00:00:00'),
(6, '160011', 'AJI ARADEA MINTAPRADJA', 'L', '1995-03-20', 'Sumedang', '08555555555555', NULL, 1, 1, '2022-08-04', 'Aktif', '2023-11-24 00:00:00', '2023-11-25 00:00:00'),
(7, '160096', 'ASEP NURDIANA', 'L', '1996-06-06', 'Simpeureum', '0866666666666', NULL, 1, 1, '2016-06-06', 'Aktif', '2023-11-25 00:00:00', '2023-11-25 00:00:00'),
(8, '160099', 'ANDI ALFIAN', 'L', '1999-10-23', 'Sindang', '0882000560334', NULL, 1, 1, '2023-06-05', 'Aktif', '2023-11-19 00:00:00', '2024-01-07 00:00:00'),
(9, '169000', 'ZAINAL ARIFIN', 'L', '1983-02-04', 'Kadipaten', '088333333333', NULL, 1, 1, '2015-09-04', 'Aktif', '2023-11-25 00:00:00', '2023-11-25 00:00:00'),
(10, '168050', 'DENI RISMAYA', 'L', '2002-10-17', 'Majalengka', '08111711100022', NULL, 1, 1, '2021-09-07', 'Aktif', '2023-11-25 00:00:00', '2023-11-25 00:00:00'),
(11, '168529', 'MUHAMAD RIZKIYA', 'L', '2003-08-08', 'KADIPATEN', '088880808823', NULL, 1, 1, '2021-12-17', 'Aktif', '2023-11-25 00:00:00', '2023-11-25 00:00:00'),
(12, '162497', 'TITIN PRATIWI', 'P', '1987-11-07', 'MAJALENGKA', '08871111987', NULL, 1, 1, '2019-01-14', 'Aktif', '2023-11-25 00:00:00', '2023-11-25 00:00:00'),
(15, '165457', 'DANNY IBRAHIM', 'L', '1987-06-01', 'Cirebon', '08237463278468', NULL, 3, 1, '2021-12-01', 'Aktif', '2023-11-26 00:00:00', '2023-11-26 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_qrcode`
--

CREATE TABLE `t_qrcode` (
  `id` int(11) NOT NULL,
  `qrcode` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  `expired` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, '162497', 'c9ccd7f3c1145515a9d3f7415d5bcbea', 2),
(3, '160099', '3523e3354352851c015745a7a2e45210', 3),
(5, 'cptnscanqrc', '631a1180c6be1037172a59c500562672', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_absensi`
--
ALTER TABLE `t_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `t_dept`
--
ALTER TABLE `t_dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indeks untuk tabel `t_gaji`
--
ALTER TABLE `t_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `t_gaji_karyawan`
--
ALTER TABLE `t_gaji_karyawan`
  ADD PRIMARY KEY (`id_gk`);

--
-- Indeks untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_qrcode`
--
ALTER TABLE `t_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_absensi`
--
ALTER TABLE `t_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_dept`
--
ALTER TABLE `t_dept`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_gaji`
--
ALTER TABLE `t_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_gaji_karyawan`
--
ALTER TABLE `t_gaji_karyawan`
  MODIFY `id_gk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `t_qrcode`
--
ALTER TABLE `t_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
