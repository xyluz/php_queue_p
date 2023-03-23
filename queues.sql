-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220614.9fd483de16
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2023 at 05:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpqueue`
--

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `dispatched_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `failed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `data`, `created_at`, `dispatched_at`, `completed_at`, `failed_at`) VALUES
(1, 'prisca', '2023-03-22 03:19:24', '2023-03-22 02:20:16', '2023-03-22 02:20:16', NULL),
(2, 'ebuka', '2023-03-22 03:19:24', '2023-03-22 02:20:17', '2023-03-22 02:20:18', NULL),
(3, 'ebuka', '2023-03-22 05:37:28', NULL, NULL, NULL),
(4, 'miracle', '2023-03-22 05:37:28', NULL, NULL, NULL),
(5, 'favour', '2023-03-22 05:37:56', NULL, NULL, NULL),
(6, 'henry', '2023-03-22 05:37:56', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



