-- --------------------------------------------------------
-- Host:                          127.0.0.1
-- Server version:                8.0.30 - MySQL Community Server - GPL
-- HeidiSQL Version:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jackduls
CREATE DATABASE IF NOT EXISTS `jackduls` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jackduls`;

-- Dumping structure for table jackduls.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adminname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`adminname`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jackduls.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id`, `adminname`, `password`, `created_at`) VALUES
	(11, 'jecky', '$2y$10$FQfSRsDOLnhE4ZSJFvgzLOuRehVGljDgNPtgFHFyq9mNjeG68J6Ma', '2025-06-14 05:10:23');

-- Dumping structure for table jackduls.data_support
CREATE TABLE IF NOT EXISTS `data_support` (
  `Kode` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Isi` text NOT NULL,
  `Balasan` text,
  `Status` enum('Belum Dibaca','Sudah Dibalas') DEFAULT 'Belum Dibaca',
  `Tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jackduls.data_support: ~3 rows (approximately)
INSERT INTO `data_support` (`Kode`, `Nama`, `Email`, `Isi`, `Balasan`, `Status`, `Tanggal`) VALUES
	(11, 'Toni', 'toni@gmail.com', 'Semoga sukses yaa', 'Terima kasih kembali!', 'Sudah Dibalas', '2025-06-16 01:12:53'),
	(12, 'Raka', 'raka@gmail.com', 'Terima kasih atas brand launchingnya', NULL, 'Belum Dibaca', '2025-06-16 02:49:10'),
	(13, 'Badrul', 'badrul@g.com', 'Kenapa produknya bagus-bagus?', NULL, 'Belum Dibaca', '2025-06-16 03:20:59');

-- Dumping structure for table jackduls.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Diproses',
  `tanggal_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jackduls.orders: ~5 rows (approximately)
INSERT INTO `orders` (`order_id`, `user_id`, `nama_produk`, `jumlah`, `total_harga`, `status`, `tanggal_order`) VALUES
	(1, 2, 'Kaos Polos Putih', 2, 100000.00, 'Selesai', '2025-06-16 07:00:00'),
	(2, 2, 'Celana Kargo Hitam', 1, 150000.00, 'Selesai', '2025-06-15 11:30:00'),
	(3, 2, 'Jaket Hoodie', 1, 250000.00, 'Diproses', '2025-06-16 02:00:00'),
	(4, 2, 'Topi Baseball', 1, 75000.00, 'Dibatalkan', '2025-06-14 09:00:00'),
	(5, 2, 'Kemeja Flanel', 1, 180000.00, 'Selesai', '2025-06-15 18:00:00');

-- Dumping structure for table jackduls.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table jackduls.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
	(1, 'user', '$2y$10$VHvDlqHYQHwXS6vN35c9TeMXmPwZYMbPtTPP.F.VlbhgA12gyWSnq', '2025-06-01 14:15:03'),
	(2, 'budi', '$2y$10$abcdef123456...examplehash', '2025-06-14 10:00:00'),
	(3, 'siti', '$2y$10$abcdef123456...examplehash', '2025-06-15 14:00:00'),
	(4, 'andi', '$2y$10$abcdef123456...examplehash', '2025-06-16 06:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;