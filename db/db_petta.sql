-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 07:55 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_pengguna`, `nama_admin`) VALUES
(1, 6, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `foto_dosen` varchar(50) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `id_pengguna`, `foto_dosen`, `nama_dosen`, `nip`, `email`, `telepon`) VALUES
(1, 3, '30-04-16-12-34-19.jpg', 'Ragil Saputra', '6520180280180280', 'ragil@gmail.com', '087273828323'),
(2, 5, '01-05-16-12-54-25.jpg', 'Aris', '1234567890123456', 'aris@gmail.com', '123123123'),
(4, 10, '01-05-16-12-46-01.jpg', 'Nurdin Bachtiar', '67894561123456789', 'nurdin@gmail.com', '085412346687'),
(5, 11, '', 'Hilmie Arief W', '44556688798745', 'hilmi@gmail.com', '081380456778'),
(6, 12, '01-05-16-12-49-32.jpg', 'Indra Waspada', '99874561234456', 'indra@gmail.com', '087456654112'),
(7, 13, '', 'Suhartono', '556849777841235', 'suhartono@gmail.com', '087779444521'),
(8, 14, '', 'Djalal Er Riyanto', '554688795112354', 'djalal@gmail.com', '084021350522');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sistem Cerdas'),
(2, 'Sistem Pendukung Keputusan'),
(3, 'Logika Fuzzy'),
(4, 'Keamanan Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_pengguna`, `nama_mahasiswa`, `nim`, `email`, `telepon`) VALUES
(1, 2, 'Firhan Balweel', '24010313130080', 'firhan.faisal1995@gmail.com', '123'),
(2, 4, 'Mirza Chilman Garin', '24010313140088', 'mirzachilman@gmail.com', '085781429272'),
(4, 15, 'Octareno Heddy H', '24010313140086', 'renocth@gmail.com', '087955462132'),
(5, 16, 'Rizki Ramadiansyah', '24010313130091', 'rizkirmdn@gmail.com', '087955505521'),
(6, 17, 'ressas selsabil', '24010313140074', 'ressas@gmail.com', '087995554665'),
(7, 18, 'Amrizha', '24010313130079', 'amrizha@gmail.com', '088795555222'),
(8, 19, 'Ikhsan Wisnuadji', '24010313130108', 'ikhsan@gmail.com', '087779546222'),
(9, 20, 'Ananda Beniva', '24010313130078', 'ananda@gmail.com', '087955462222');

-- --------------------------------------------------------

--
-- Table structure for table `peminatan`
--

CREATE TABLE `peminatan` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `waktu_peminatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_peminatan` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminatan`
--

INSERT INTO `peminatan` (`id`, `id_pengguna`, `id_tema`, `waktu_peminatan`, `status_peminatan`) VALUES
(7, 4, 10, '2016-03-11 04:05:30', ''),
(8, 4, 7, '2016-03-11 04:09:53', ''),
(9, 4, 2, '2016-03-12 10:19:29', ''),
(10, 2, 10, '2016-04-29 13:46:48', '1'),
(11, 2, 7, '2016-04-04 08:38:05', ''),
(12, 2, 11, '2016-04-29 13:47:20', '1'),
(13, 15, 16, '2016-05-01 05:52:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` char(2) NOT NULL,
  `notifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `level`, `notifikasi`) VALUES
(2, '24010313130080', 'a296d91f1ea267320f3f4d27800a59c32237e143', '3', 0),
(3, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2', 0),
(4, '24010313130081', '26752e7353a62fcabd95b8077fe7fe6ce16d5b9b', '3', 0),
(5, '321', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2', 0),
(6, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 0),
(10, 'nurdin', '9db6cdeecb690eb2369b77c8be766043678d268f', '2', 0),
(11, 'Hilmie', '1a98ddaf820d16dfe55112029180370315b1314f', '2', 0),
(12, 'indra', '300a29a2fe6e701da25021b20bb3f00151bc5498', '2', 0),
(13, 'suhartono', '6505645811b627370cf5da621c52f16eb792b5d0', '2', 0),
(14, 'djalal', '03658647ea2d84f6ec35ce609567648903d0e1ba', '2', 0),
(15, '24010313140086', '5af2b2573a18bc55d77cb7c2789af421b776961d', '3', 0),
(16, '24010313130091', '5c40c4c006b12d022c003d93a5f8e43d2db15d63', '3', 0),
(17, '24010313140074', '2b44331f9b6f77f6b74e4c5d62cc3bc56eb70378', '3', 0),
(18, '24010313130079', '13791df5e6e0789747ee134df09589c6886495b4', '3', 0),
(19, '24010313130108', '50a160772596140ce2bb6e131856681ff6209dd4', '3', 0),
(20, '24010313130078', 'dc5156c95d9a56498b4c37cbdfdc8108a3e91d41', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` bigint(20) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `level` char(2) NOT NULL,
  `baca` int(2) NOT NULL,
  `hapus` int(2) NOT NULL,
  `hapus2` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
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
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `id_tema`, `id_kategori`) VALUES
(47, 2, 1),
(48, 2, 3),
(49, 2, 2),
(63, 7, 3),
(67, 11, 1),
(68, 12, 2),
(69, 13, 3),
(70, 14, 3),
(71, 14, 2),
(72, 10, 2),
(73, 10, 3),
(75, 15, 4),
(76, 16, 4),
(77, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `judul` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `status_tema` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id_tema`, `id_pengguna`, `judul`, `keterangan`, `tanggal_post`, `status_tema`) VALUES
(2, 3, 'Prediksi Kurs Dollar Jaringan Syaraf Tiruan', 'asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasd asdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdasdasdasdasd asdasdasd asdasdas', '2016-03-07 20:46:18', 1),
(7, 5, 'Situs WEB interaktif PSIM Yogyakarta', 'hubungi saya', '2016-03-07 21:28:29', 0),
(10, 3, 'Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit Membuat sistem pendeteksi tingkat kesiapan panen menggunakan satelit', 'Hubungi saya untuk lebih lanjut', '2016-03-09 14:09:02', 0),
(11, 3, 'Sistem informasi hotel di Kota Bandung berbasis WEB', 'hubungi saya', '2016-04-08 10:35:12', 1),
(12, 10, 'Sistem pendukung keputusan pemilihan perguruan tinggi dengan metode proses hierarki analitik', 'hubungi saya untuk lebih lanjut', '2016-05-01 00:00:00', 0),
(13, 11, 'The edge determining on the image with fuzzy method', 'hubungi saya untuk lebih lanjut', '2016-05-01 00:00:00', 0),
(14, 11, 'Penerapan logika fuzzy dalam sistem pendukung keputusan pembelian ponsel', 'hubungi saya untuk lebih lanjut', '2016-05-01 00:00:00', 0),
(15, 12, 'Sistem informasi geografis studi kasus PT. PLN [Persero] Unit Pelayanan Jaringan Sedayu Yogyakarta', 'hubungi saya untuk lebih lanjut', '2016-05-01 00:00:00', 0),
(16, 12, 'Prototype sistem keamanan rumah dengan menggunakan sensor infra merah dan teknologi FBUS pada ponsel GSM', 'hubungi saya', '2016-05-01 00:00:00', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `peminatan`
--
ALTER TABLE `peminatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
