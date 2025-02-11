-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2025 at 07:11 PM
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
-- Database: `leaderboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_stats`
--

CREATE TABLE `user_stats` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Points` int(11) NOT NULL,
  `Wins` int(11) NOT NULL,
  `Losses` int(11) NOT NULL,
  `LastActivity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_stats`
--

INSERT INTO `user_stats` (`UserID`, `Username`, `Points`, `Wins`, `Losses`, `LastActivity`) VALUES
(2, 'UserB', 120, 20, 8, '2024-01-14 15:45:00'),
(4, 'UserD', 130, 18, 7, '2024-01-13 12:00:00'),
(5, 'UserE', 120, 25, 10, '2024-01-15 11:30:00'),
(6, 'UserF', 140, 20, 5, '2024-01-15 10:00:00'),
(7, 'UserG', 130, 18, 9, '2024-01-14 18:30:00'),
(9, 'UserI', 140, 22, 8, '2024-01-13 17:45:00'),
(10, 'UserJ', 130, 19, 6, '2024-01-15 09:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_stats`
--
ALTER TABLE `user_stats`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_stats`
--
ALTER TABLE `user_stats`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
