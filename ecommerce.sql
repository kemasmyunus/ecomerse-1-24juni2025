-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2025 at 08:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `deskripsi`, `stok`, `harga`, `gambar`) VALUES
(1, 'Pokeball', 'Bola ikonik dari anime Pokemon yang digunakan untuk menangkap monster.', 35, 50000, '1.jpg'),
(2, 'Digivice', 'Alat dari Digimon yang digunakan untuk berkomunikasi dengan Digimon.', 20, 85000, '2.jpg'),
(3, 'Bakugan', 'Bola mini dari anime Bakugan yang berubah menjadi monster saat dilempar.', 40, 60000, '3.jpg'),
(4, 'Tamiya Dash-1', 'Mini 4WD mobil balap dari anime Bakusou Kyoudai Let\'s & Go.', 25, 120000, '4.jpg'),
(5, 'Beyblade Dragoon', 'Gasing tempur dari anime Beyblade, versi milik Takao.', 35, 70000, '5.jpg'),
(6, 'Death Note', 'Buku kematian dari anime Death Note yang bisa membunuh dengan menulis nama.', 20, 90000, '6.jpg'),
(7, 'Headband Konoha', 'Ikat kepala ninja dari anime Naruto dengan simbol Desa Daun.', 69, 30000, '7.jpg'),
(8, 'Ijazah GM Asli', '---', 0, 95000, '8.jpg'),
(9, 'Sword Elucidator', 'Pedang utama milik Kirito dari anime Sword Art Online.', 10, 200000, '9.jpg'),
(10, 'Scouter', 'Alat pengukur power level dari anime Dragon Ball.', 18, 75000, '10.jpg'),
(11, 'Millennium Puzzle', 'Puzzle kuno dari Yu-Gi-Oh! yang menyimpan roh Pharaoh.', 12, 130000, '11.jpg'),
(12, 'Nichirin Blade', 'Pedang pembasmi iblis dari anime Demon Slayer.', 14, 180000, '12.jpg'),
(13, 'Hunter License', 'Kartu identitas dari anime Hunter x Hunter.', 21, 40000, '13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `barang_terjual`
--

CREATE TABLE `barang_terjual` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_terjual`
--

INSERT INTO `barang_terjual` (`id`, `barang_id`, `nama`, `deskripsi`, `jumlah`, `harga`, `total`, `gambar`, `tanggal`, `id_user`) VALUES
(1, 8, 'Ijazah GM Asli', '---', 15, 95000, 1425000, '8.jpg', '2025-06-24 05:22:12', 5),
(2, 7, 'Headband Konoha', 'Ikat kepala ninja dari anime Naruto dengan simbol Desa Daun.', 1, 30000, 30000, '7.jpg', '2025-06-24 05:34:04', 6),
(3, 1, 'Pokeball', 'Bola ikonik dari anime Pokemon yang digunakan untuk menangkap monster.', 1, 50000, 50000, '1.jpg', '2025-06-24 05:34:07', 6),
(4, 13, 'Hunter License', 'Kartu identitas dari anime Hunter x Hunter.', 1, 40000, 40000, '13.jpg', '2025-06-24 05:34:10', 6),
(5, 1, 'Pokeball', 'Bola ikonik dari anime Pokemon yang digunakan untuk menangkap monster.', 1, 50000, 50000, '1.jpg', '2025-06-24 06:41:18', 6),
(6, 1, 'Pokeball', 'Bola ikonik dari anime Pokemon yang digunakan untuk menangkap monster.', 1, 50000, 50000, '1.jpg', '2025-06-24 06:44:34', 6),
(7, 1, 'Pokeball', 'Bola ikonik dari anime Pokemon yang digunakan untuk menangkap monster.', 12, 50000, 600000, '1.jpg', '2025-06-24 06:45:11', 6),
(8, 2, 'Digivice', 'Alat dari Digimon yang digunakan untuk berkomunikasi dengan Digimon.', 10, 85000, 850000, '2.jpg', '2025-06-24 06:57:13', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(5, 'mikayotsuya', '123', 'admin'),
(6, 'asunayuuki', '123', 'pelanggan'),
(8, 'hinatahyuga', '123', 'pelanggan'),
(9, 'nezukokamado', '123', 'pelanggan'),
(10, 'sakuraharuno', '123', 'pelanggan'),
(11, 'remrezero', '123', 'pelanggan'),
(12, 'makotoshiina', '123', 'pelanggan'),
(13, 'kurisuakihabara', '123', 'pelanggan'),
(14, 'toukarushia', '123', 'pelanggan'),
(15, 'meguminkonosuba', '123', 'pelanggan'),
(18, 'takahashi', '123', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
