-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2023 pada 15.27
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
  `shift` int(1) NOT NULL DEFAULT 1,
  `waktu_masuk` time NOT NULL,
  `waktu_pulang` time DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_absensi`
--

INSERT INTO `t_absensi` (`id_absensi`, `id_karyawan`, `tanggal`, `shift`, `waktu_masuk`, `waktu_pulang`, `created_at`, `updated_at`) VALUES
(1, '160099', '2023-11-22', 1, '07:30:00', '17:00:00', '2023-11-22 07:30:00', '2023-11-22 17:00:00');

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
  `nama_gaji` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'STAFF IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_karyawan`
--

CREATE TABLE `t_karyawan` (
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

INSERT INTO `t_karyawan` (`id_karyawan`, `nama`, `jk`, `tgl_lahir`, `alamat`, `no_hp`, `foto`, `id_jabatan`, `id_dept`, `join_at`, `status`, `created_at`, `updated_at`) VALUES
('160090', 'Abdurrahman Syarif', 'L', '1990-10-10', 'Majalengka', '0810101990', NULL, 1, 1, '2010-10-10', 'Aktif', '2023-11-21 00:00:00', '2023-11-21 00:00:00'),
('160091', 'Unan Agnan', 'L', '1991-01-01', 'Kuningan', '08101011991', NULL, 1, 1, '2011-01-01', 'Aktif', '2023-11-21 00:00:00', '2023-11-21 00:00:00'),
('160092', 'Pendi Angga Sukmana', 'L', '1992-02-02', 'Maja', '0822222222222', NULL, 1, 1, '2012-02-02', 'Aktif', '2023-11-23 00:00:00', '2023-11-23 00:00:00'),
('160093', 'Jimi Mikail Zamzami', 'L', '1993-03-03', 'Kasokandel', '083333333333', NULL, 1, 1, '2013-03-03', 'Aktif', '2023-11-23 00:00:00', '2023-11-23 00:00:00'),
('160094', 'Gugun Gunawan', 'L', '1994-04-04', 'Weragati', '08444444444444', NULL, 1, 1, '2014-04-04', 'Aktif', '2023-11-24 00:00:00', '2023-11-24 00:00:00'),
('160095', 'Aji Aradea', 'L', '1995-05-05', 'Sumedang', '08555555555555', NULL, 1, 1, '2015-05-05', 'Aktif', '2023-11-24 00:00:00', '2023-11-24 00:00:00'),
('160099', 'Andi Alfian', 'L', NULL, 'Sindang', '0882000560334', NULL, 1, 1, '2023-11-19', 'Aktif', '2023-11-19 00:00:00', '2023-11-19 00:00:00');

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

--
-- Dumping data untuk tabel `t_qrcode`
--

INSERT INTO `t_qrcode` (`id`, `qrcode`, `nilai`, `expired`) VALUES
(1, '160099.png', '160099', 1700663688),
(2, '160094.png', '160094', 1700920432),
(3, '160090.png', '160090', 1700920534),
(4, '160095.png', '160095', 1700921151);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `id_karyawan` varchar(6) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `id_karyawan`, `username`, `password`, `level`) VALUES
(1, '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, '2', 'guest', '084e0343a0486ff05530df6c705c8bb4', 2);

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
-- Indeks untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

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
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_dept`
--
ALTER TABLE `t_dept`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_gaji`
--
ALTER TABLE `t_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_qrcode`
--
ALTER TABLE `t_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
