-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Mar 2016 pada 15.37
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
(1, 3, '', 'Ragil Saputra', '23123123123123123', 'ragil@gmail.com', '087273828323'),
(2, 5, '', 'Aris', '123123123123', 'aris@gmail.com', '123123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'bidang 1'),
(2, 'bidang 2'),
(3, 'bidang 3');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_pengguna`, `nama_mahasiswa`, `nim`, `email`, `telepon`) VALUES
(1, 2, 'Firhan Balweel', '24010313130080', 'firhan.faisal1995@gmail.com', '08238423423'),
(2, 4, 'Tes', '123', 'tes@gmail.com', '-');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `level`, `notifikasi`) VALUES
(2, '24010313130080', 'a296d91f1ea267320f3f4d27800a59c32237e143', '3', 0),
(3, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2', 0),
(4, '24010313130081', '26752e7353a62fcabd95b8077fe7fe6ce16d5b9b', '3', 0),
(5, '321', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `pesan`, `tanggal`, `level`, `baca`, `hapus`, `hapus2`) VALUES
(84, 3, 2, 'woi...', '2016-03-07 14:38:46', '2', 1, 0, 0),
(85, 2, 3, 'ya?', '2016-03-07 14:39:22', '3', 1, 1, 0),
(86, 3, 2, 'hola', '2016-03-07 14:46:14', '2', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `id_tema`, `id_kategori`) VALUES
(3, 2, 1),
(4, 2, 3),
(6, 6, 1),
(7, 6, 2),
(8, 6, 3),
(9, 7, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tema`
--

INSERT INTO `tema` (`id_tema`, `id_pengguna`, `judul`, `keterangan`, `tanggal_post`, `status_tema`) VALUES
(2, 3, 'asd', 'asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd', '2016-03-07 20:46:18', 0),
(6, 3, 'tes aaj', 'aaaaa', '2016-03-07 21:22:16', 0),
(7, 5, 'Yes', 'asdasdasdasdasd', '2016-03-07 21:28:29', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
