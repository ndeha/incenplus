-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2019 at 05:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `incenplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_by` int(5) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(5) unsigned DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_by`, `active`, `created_at`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 'Yogyakarta', 'Istimewa', 1, 1, '2019-03-06 07:00:00', '2019-03-06 18:44:56', 1, NULL),
(2, 'Buku', 'Perpustakaan', 1, 1, '2019-03-06 18:04:08', NULL, NULL, NULL),
(3, 'Gudang', 'Barang', 1, 1, '2019-03-06 18:27:58', NULL, NULL, NULL),
(4, 'Monjali', 'Lampion', 1, 1, '2019-03-07 15:22:48', NULL, NULL, NULL),
(6, 'Depok', 'Condong Catur', 1, 1, '2019-03-07 15:31:28', NULL, NULL, NULL),
(7, 'Sepatu', 'Converse, Vans, Nike', 1, 1, '2019-03-07 15:32:01', NULL, NULL, NULL),
(8, 'Baju', 'Pull & Bear, H&M', 1, 1, '2019-03-07 15:32:36', NULL, NULL, NULL),
(9, 'Tas', 'CK, Connection', 1, 1, '2019-03-07 15:32:51', NULL, NULL, NULL),
(10, 'Handphone', 'Vivo baru saja mengeluarkan smartphone terbaru yaitu Vivo V15', 2, 1, '2019-03-07 15:35:28', NULL, NULL, NULL),
(11, 'Hari Raya Nyepi', 'Hari Raya Nyepi 2019', 2, 1, '2019-03-07 15:36:18', NULL, NULL, NULL),
(13, 'Libur Lebaran 2019', 'Libur Lebaran ada 2 hari', 2, 1, '2019-03-07 15:55:25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(5) unsigned NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(125) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `created_at`, `deleted_at`, `active`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Administrator', '2019-03-06 00:00:00', NULL, 1),
(2, 'operator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Operator', '2019-03-07 13:00:00', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD KEY `created_by` (`created_by`,`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
