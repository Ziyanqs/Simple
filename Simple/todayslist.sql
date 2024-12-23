-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2023 at 08:03 PM
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
-- Table structure for table `todayslist`
--

CREATE TABLE `todayslist` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fats` float NOT NULL,
  `carbs` float NOT NULL,
  `protein` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todayslist`
--

INSERT INTO `todayslist` (`id`, `name`, `fats`, `carbs`, `protein`) VALUES
(15, 'chicken', 0, 2.7, 26),
(16, 'rice', 0.58, 41.1, 4.6),
(17, 'beans', 10, 4, 5),
(18, 'bread', 0.9, 40, 15.2),
(19, 'eggs', 10.3, 1.4, 12.7),
(20, 'caesar salad with chicken', 11, 3, 9),
(21, 'salmon', 6.34, 0, 19.8),
(22, 'steak', 12.9, 0, 22.7),
(24, 'pancakes', 8, 37, 8),
(25, 'yogurt', 3.8, 17.25, 12.86),
(29, 'pancakes', 8, 37, 8),
(30, 'steak', 12.9, 0, 22.7),
(35, 'protein bar', 7, 27, 15),
(37, 'chocolate donut', 12, 38, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todayslist`
--
ALTER TABLE `todayslist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todayslist`
--
ALTER TABLE `todayslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
