-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2023 at 08:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'ziyan123', '$2y$10$AcJTcwQ5YERHlmi39K9aG.9yWEDAYAOQU7VfX3s9XStXUHKNFNiKC', '2023-11-26 18:09:05'),
(2, 'joshua', '$2y$10$Ns6eYSXGnaQTDTlI/hb5Quu7BowHoa5/PFR9yggL6tw4O.TlkZZr6', '2023-11-26 21:21:33'),
(3, 'Yonis', '$2y$10$uuWy08KNyRkMsY76Tw3/oOYJNgIMxEFelpltM2tS59H.fBPWSLzKm', '2023-11-26 21:52:46'),
(4, 'Gridy', '$2y$10$b7bbBV.qJkA2recgXcYSP.etSmNCCSKFCDKKnE9XGwb3EGd8zk4a.', '2023-11-26 22:25:34'),
(5, 'Zion', '$2y$10$3JKUknVzgYd5EQT8UQmSdepfpgRWBpnld3pvQBK2NTE2rx3Tfsxei', '2023-11-26 22:26:12'),
(6, 'Ziyan', '$2y$10$Nn5OZVXkjSdZi/q9pfCoZO.5oBnhkd5NQVDNIW5ViUGaWNH2dxi.a', '2023-11-26 22:26:49'),
(7, 'William', '$2y$10$5t91DbZSRar0NMei17YPc.DfHJBIfScIfjknbFFi34mCiWScbMDqC', '2023-11-26 22:27:17'),
(8, 'Zoha', '$2y$10$hRvbCDRXLUPbIbu8T3hrtuZ2qY2/MWJOoCoOHKQ4jJMuPy5lWJkJm', '2023-11-26 22:27:54'),
(9, 'Eric', '$2y$10$bLdRLk9U2lbdu/mxX5Tqb.ToOu.v5/fh8jbIn8i7Ddv7hSZdzlxFa', '2023-11-26 23:40:33'),
(10, 'ziyan10', '$2y$10$.GPbQwOpvnYyceKSthheuepUKNtSE1hEL9lyNNIqqpCuPFD9t1PyO', '2023-11-28 20:14:50'),
(11, 'ali', '$2y$10$pJUA/qbj5G2MmzjFPI2Ftem0245HKEaw9Roe90G.rEUc7EEiD31F.', '2023-11-29 14:22:29'),
(12, 'ziyan1', '$2y$10$0F3S.pAnI6um4ef1LoHFP.h9IsX6m9DAadEAr/lz1n1zGIDviQ1YS', '2023-11-29 21:57:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
