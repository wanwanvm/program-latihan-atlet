-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 02:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `program_latihan_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabor`
--

CREATE TABLE `cabor` (
  `id` int(11) NOT NULL,
  `nama_cabor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabor`
--

INSERT INTO `cabor` (`id`, `nama_cabor`) VALUES
(1, 'Voli'),
(2, 'Basket'),
(3, 'Bulutangkis');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_latihan`
--

CREATE TABLE `jenis_latihan` (
  `id` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` int(11) DEFAULT NULL,
  `benchmarking` float DEFAULT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_latihan`
--

INSERT INTO `jenis_latihan` (`id`, `id_program`, `nama`, `bobot`, `benchmarking`, `nilai`) VALUES
(1, 9, '20 Meter Sprint', 15, 3.68, 3.57),
(2, 9, 'Shuttle Run', 10, 15.42, 14.57),
(3, 9, 'Sit&Reach', 5, 3.1, 4.2),
(4, 9, 'Vertical Jump', 10, 3.7, 4.6),
(5, 9, 'Push Up', 10, 2.7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI'),
(7, 'VII'),
(8, 'VIII'),
(9, 'IX'),
(10, 'X'),
(11, 'XI'),
(12, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `program_latihan`
--

CREATE TABLE `program_latihan` (
  `id` int(11) NOT NULL,
  `id_pelatih` int(11) NOT NULL,
  `id_atlet` int(11) NOT NULL,
  `tanggal_latihan` date NOT NULL,
  `tinggi_badan` int(11) DEFAULT NULL,
  `berat_badan` int(11) DEFAULT NULL,
  `tes_lari` int(11) DEFAULT NULL,
  `vcr` float DEFAULT NULL,
  `putaran` float DEFAULT NULL,
  `kesimpulan` enum('baik','cukup','kurang baik','buruk') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_latihan`
--

INSERT INTO `program_latihan` (`id`, `id_pelatih`, `id_atlet`, `tanggal_latihan`, `tinggi_badan`, `berat_badan`, `tes_lari`, `vcr`, `putaran`, `kesimpulan`) VALUES
(9, 4, 8, '2021-08-30', 170, 60, 10000, 4.2, 96, 'baik');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'deputi'),
(2, 'pelatih'),
(3, 'atlit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_cabor` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `id_cabor`, `id_kelas`, `nama`, `email`, `password`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `foto`) VALUES
(2, 1, NULL, NULL, 'Assisten Deputi', 'asdep@gmail.com', '64075662f4744e8d8ccdca0bb0ebf8f4', NULL, NULL, NULL, NULL, NULL),
(4, 2, 3, NULL, 'Zakaria', 'zakaria@gmail.com', 'fc1b8a667755b9d93addd3e01f15c6d2', 'Jakarta', '1997-02-25', 'JL.PARANG TRITIS KERAMAT JAYA 1', 'Laki-Laki', 'wajah_1.jpeg'),
(5, 2, 1, NULL, 'Meirna', 'meirna@gmail.com', 'd90930c59711e15b983539ce8531af43', 'Medan', '1996-02-15', 'JL.KEMUNINGAN RAYA BARAT', 'Laki-Laki', 'wajah-wanita.jpeg'),
(8, 3, 3, 2, 'Murni', 'murni@gmail.com', '8657df87dbdada3ead87d31a3c56ac26', 'Padang', '2000-12-06', 'JL.BERLIN MUTIARA', 'Perempuan', 'wajah-3_1.jpeg'),
(9, 3, 3, 2, 'Dwiana', 'dwiana@gmail.com', 'e4e211b329cf8eab69f6b3820e743833', 'Cilacap', '1999-03-16', 'JL.MILITER RAYA BARAT', 'Laki-Laki', 'wajah-5.jpg'),
(11, 3, 2, 9, 'Firman', 'firman@gmail.com', '2c37fd83afb2aca9c0d5fd39bb11896c', 'Cilacap', '1999-01-13', 'JL.MILITER RAYA BARAT', 'Laki-Laki', 'wajah-6_1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabor`
--
ALTER TABLE `cabor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_latihan`
--
ALTER TABLE `jenis_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cabor` (`id_program`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_latihan`
--
ALTER TABLE `program_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelatih` (`id_pelatih`),
  ADD KEY `id_atlet` (`id_atlet`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cabor` (`id_cabor`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabor`
--
ALTER TABLE `cabor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_latihan`
--
ALTER TABLE `jenis_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `program_latihan`
--
ALTER TABLE `program_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program_latihan`
--
ALTER TABLE `program_latihan`
  ADD CONSTRAINT `program_latihan_ibfk_1` FOREIGN KEY (`id_pelatih`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program_latihan_ibfk_2` FOREIGN KEY (`id_atlet`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_cabor`) REFERENCES `cabor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
