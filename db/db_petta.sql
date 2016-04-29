-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Apr 2016 pada 15.47
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_petta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `id_pengguna`, `nama_admin`) VALUES
(1, 6, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `foto_dosen` varchar(50) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `id_pengguna`, `foto_dosen`, `nama_dosen`, `nip`, `email`, `telepon`) VALUES
(1, 3, '04-04-16-15-29-59.jpg', 'Ragil Saputra', '23123123123123123', 'ragil@gmail.com', '087273828323'),
(2, 5, '', 'Aris', '123123123123', 'aris@gmail.com', '123123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'bidang 1'),
(2, 'bidang 2'),
(3, 'bidang 3'),
(4, 'helo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_pengguna`, `nama_mahasiswa`, `nim`, `email`, `telepon`) VALUES
(1, 2, 'Firhan Balweel', '24010313130080', 'firhan.faisal1995@gmail.com', '123'),
(2, 4, 'Tes', '123', 'tes@gmail.com', '-'),
(3, 8, 'Tes', '123', 'tes@gmail.com', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminatan`
--

CREATE TABLE IF NOT EXISTS `peminatan` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `waktu_peminatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_peminatan` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminatan`
--

INSERT INTO `peminatan` (`id`, `id_pengguna`, `id_tema`, `waktu_peminatan`, `status_peminatan`) VALUES
(7, 4, 10, '2016-03-11 04:05:30', ''),
(8, 4, 7, '2016-03-11 04:09:53', ''),
(9, 4, 2, '2016-03-12 10:19:29', ''),
(10, 2, 10, '2016-04-29 13:46:48', '1'),
(11, 2, 7, '2016-04-04 08:38:05', ''),
(12, 2, 11, '2016-04-29 13:47:20', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` char(2) NOT NULL,
  `notifikasi` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `level`, `notifikasi`) VALUES
(2, '24010313130080', 'a296d91f1ea267320f3f4d27800a59c32237e143', '3', 0),
(3, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2', 0),
(4, '24010313130081', '26752e7353a62fcabd95b8077fe7fe6ce16d5b9b', '3', 0),
(5, '321', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2', 0),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 0),
(8, '240', 'cae91e45aed80f3a3fe285c3c8c1a7e78d82d473', '3', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` bigint(20) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `level` char(2) NOT NULL,
  `baca` int(2) NOT NULL,
  `hapus` int(2) NOT NULL,
  `hapus2` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `pesan`, `tanggal`, `level`, `baca`, `hapus`, `hapus2`) VALUES
(96, 3, 2, 'asdasd', '2016-03-13 09:27:59', '2', 1, 1, 1),
(97, 3, 2, 'asdasdasd', '2016-03-13 09:28:01', '2', 1, 1, 1),
(98, 3, 2, 'asd', '2016-04-02 20:26:34', '2', 1, 0, 0),
(99, 3, 2, 'asd', '2016-04-08 10:35:53', '2', 1, 0, 0),
(100, 3, 2, 'Peminatan anda pada tema Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit telah di setujui', '2016-04-29 20:41:39', '2', 1, 0, 0),
(101, 3, 2, 'Peminatan anda pada tema <b>Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit</b> telah di setujui', '2016-04-29 20:42:47', '2', 1, 0, 0),
(102, 3, 2, 'Peminatan anda pada tema: ''Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit'' Telah di setujui', '2016-04-29 20:44:21', '2', 1, 0, 0),
(103, 3, 2, 'Peminatan anda pada tema: ''Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit'' Telah di setujui', '2016-04-29 20:46:38', '2', 1, 0, 0),
(104, 3, 2, 'Peminatan anda pada tema: ''Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit'' Telah di setujui', '2016-04-29 20:46:48', '2', 1, 0, 0),
(105, 3, 2, 'Peminatan anda pada tema: ''b'' Telah di setujui', '2016-04-29 20:47:20', '2', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `id_tema`, `id_kategori`) VALUES
(47, 2, 1),
(48, 2, 3),
(49, 2, 2),
(63, 7, 3),
(64, 10, 2),
(65, 10, 3),
(67, 11, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tema`
--

CREATE TABLE IF NOT EXISTS `tema` (
  `id_tema` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `judul` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `status_tema` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tema`
--

INSERT INTO `tema` (`id_tema`, `id_pengguna`, `judul`, `keterangan`, `tanggal_post`, `status_tema`) VALUES
(2, 3, 'Prediksi Kurs Dollar Jaringan Syaraf Tiruan', 'asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdas', '2016-03-07 20:46:18', 1),
(7, 5, 'Yes', 'asdasdasdasdasd', '2016-03-07 21:28:29', 0),
(10, 3, 'Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit', 'asdasdasdasdasda asdas asd ad asd as\r\nasda\r\nsd\r\nas\r\nd\r\nasdasd', '2016-03-09 14:09:02', 0),
(11, 3, 'b', 'h', '2016-04-08 10:35:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminatan`
--
ALTER TABLE `peminatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `peminatan`
--
ALTER TABLE `peminatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
