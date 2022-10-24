-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2022 at 11:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemadatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `promo` tinyint(1) NOT NULL DEFAULT 0,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `emailHash` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `promo`, `city`, `state`, `zip`, `status`, `admin`) VALUES
(1, 'Test', '', '1234567890', 'test@test.com', '$2y$10$sKmAmFPogTsC6pUIMO/8eu4YNl9G3xzxrSRf/6Uyf4NkS2qr98FVS', 0, '', '', '', 0, 0),
(2, 'test2', '', '987654321', 'test2@test.com', '$2y$10$tZhSQV3qUItCyQ2.c6byrOUYrnr7X2lEsUctI/R.Xk8jX/htGohnK', 0, '', '', '', 0, 0),
(3, 'test2', '', '987654321', 'test3@test.com', '$2y$10$1RE7I/DzLunm3QWzpbxpd.7DMIrYI0tbbNzYP2K23YvsmL1rXXYcO', 0, '', '', '', 0, 0),
(4, 'test4', '', '987654321', 'test4@test.com', '$2y$10$4LFoeUeMkurMUQxzG3d46.bJD4AuNPtDpYNOvOmXprFMKcJNbCvvC', 0, '', '', '', 0, 0),
(8, 'Nick', 'Severson', '1234567890', 'nickseverson@me.com', '$2y$10$xL1XFGGhwdKnIEnby2RVIe4bmfHzwSxfXaiZNMePKkH.XWfkyEaZe', 0, NULL, NULL, NULL, 0, 0),
(9, 'Tucker', 'Folsom', '1234567890', 'tucker@treats.com', '$2y$10$UX4i/OvMTFnmDO0SNHsiaOoYuhSKEzwh9KlTlcLaoCLHPv6uxrT8i', 0, NULL, NULL, NULL, 0, 0),
(11, 'Tucker', 'Folsom', '1234567890', 'tucker2@treats.com', '$2y$10$aogyfuaJHUyUXs9DtmqE1OOwLGHKCJdq646i7gT/4b6VkVLDQhb1W', 1, NULL, NULL, NULL, 0, 0),
(12, 'Tucker', 'Folsom', '1234567890', 'tucker3@treats.com', '$2y$10$92814ycftqjTDHVWBJJJCu6u.xAjyPVmL6EsvX2Zq87f4xhSCD6qO', 0, NULL, NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
