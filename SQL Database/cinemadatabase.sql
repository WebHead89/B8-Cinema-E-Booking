-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 02, 2022 at 12:52 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_ebooking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `idStatus` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tell Users table what the status of an acount is';

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`idStatus`, `status`) VALUES
(1, 'active'),
(2, 'inactive'),
(3, 'suspended');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `idType` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tell users table what account type the user is';

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`idType`, `type`) VALUES
(1, 'Admin'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `idBooking` int(11) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `customerID` int(10) UNSIGNED NOT NULL,
  `showID` int(11) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `promoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all of the bookings for the movie theater\n';

-- --------------------------------------------------------

--
-- Table structure for table `movies_table`
--

CREATE TABLE `movies_table` (
  `idMovie` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `cast` varchar(200) DEFAULT NULL,
  `director` varchar(45) DEFAULT NULL,
  `producer` varchar(45) DEFAULT NULL,
  `genre` varchar(45) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `trailerPicture` varchar(45) DEFAULT NULL,
  `trailerVideo` varchar(45) DEFAULT NULL,
  `filmRating` varchar(45) DEFAULT NULL,
  `categoryID` int(11) NOT NULL,
  `isCurrentlyPlaying` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all information on a movie';

--
-- Dumping data for table `movies_table`
--

INSERT INTO `movies_table` (`idMovie`, `title`, `cast`, `director`, `producer`, `genre`, `synopsis`, `trailerPicture`, `trailerVideo`, `filmRating`, `categoryID`, `isCurrentlyPlaying`) VALUES
(1, 'Avatar', '[cast]', '[director]', '[producer]','[genre]', '[synopsis]', NULL, NULL, 'rating', 1, 1),
(2, 'Happy Gilmore', '[cast]', '[director]', '[producer]', '[genre]', '[synopsis]', NULL, NULL, 'rating', 2, 0),
(3, 'Star Wars Rouge One', '[cast]', '[director]', '[produer]', '[genre]', '[synopsis]', NULL, NULL, 'rating', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `idCategory` int(11) NOT NULL,
  `category` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores the different categories of movies';

--
-- Dumping data for table `movie_category`
--

INSERT INTO `movie_category` (`idCategory`, `category`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Horror'),
(4, 'Sci FI'),
(5, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `payment_card_table`
--

CREATE TABLE `payment_card_table` (
  `idPaymentCard` int(11) NOT NULL,
  `cardNum` varchar(45) NOT NULL,
  `experationDate` varchar(45) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store payment cards of the users';

-- --------------------------------------------------------

--
-- Table structure for table `promotions_table`
--

CREATE TABLE `promotions_table` (
  `idPromotions` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `discount` decimal(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store promotions';

--
-- Dumping data for table `promotions_table`
--

INSERT INTO `promotions_table` (`idPromotions`, `code`, `discount`) VALUES
(1, 'freeMoney', '0.99');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `idReview` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(500) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores reviews for movies';

-- --------------------------------------------------------

--
-- Table structure for table `seats_table`
--

CREATE TABLE `seats_table` (
  `seatNumber` int(11) NOT NULL,
  `isReserved` tinyint(4) DEFAULT 0,
  `showID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='holds the all seats for a show, all seats are generated when a new show is created';

-- --------------------------------------------------------

--
-- Table structure for table `showroom_table`
--

CREATE TABLE `showroom_table` (
  `idRoom` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `seatNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all of the showrooms in the threater';

--
-- Dumping data for table `showroom_table`
--

INSERT INTO `showroom_table` (`idRoom`, `name`, `seatNumber`) VALUES
(1, 'Room 1', 30),
(2, 'Room 2', 30),
(3, 'Room 3', 30),
(4, 'Room 4', 30),
(5, 'Room 5', 30),
(6, 'Room 6', 30);

-- --------------------------------------------------------

--
-- Table structure for table `showtime_table`
--

CREATE TABLE `showtime_table` (
  `idShowtime` int(11) NOT NULL,
  `showtime` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store the showtimes for the theater';

--
-- Dumping data for table `showtime_table`
--

INSERT INTO `showtime_table` (`idShowtime`, `showtime`) VALUES
(1, '1:00 pm'),
(2, '4:00 pm'),
(3, '7:00 pm'),
(4, '10:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `show_table`
--

CREATE TABLE `show_table` (
  `idShow` int(11) NOT NULL,
  `date` date NOT NULL,
  `movieID` int(11) NOT NULL,
  `showroomID` int(11) NOT NULL,
  `showtimeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all the shows in a movie';

--
-- Dumping data for table `show_table`
--

INSERT INTO `show_table` (`idShow`, `date`, `movieID`, `showroomID`, `showtimeID`) VALUES
(2, '2022-11-11', 1, 2, 1),
(3, '2022-11-03', 1, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_table`
--

CREATE TABLE `tickets_table` (
  `idTicket` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `typeID` int(11) NOT NULL,
  `seatNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tables to store all of the tickets';

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `idType` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores the different types of tickets\n';

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
  `emailHash` varchar(32) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `promo`, `city`, `state`, `zip`, `status`, `admin`, `emailHash`, `address`) VALUES
(1, 'Test', '', '1234567890', 'test@test.com', '$2y$10$sKmAmFPogTsC6pUIMO/8eu4YNl9G3xzxrSRf/6Uyf4NkS2qr98FVS', 0, '', '', '', 0, 0, NULL, ''),
(2, 'test2', '', '987654321', 'test2@test.com', '$2y$10$tZhSQV3qUItCyQ2.c6byrOUYrnr7X2lEsUctI/R.Xk8jX/htGohnK', 0, '', '', '', 0, 0, NULL, ''),
(3, 'test2', '', '987654321', 'test3@test.com', '$2y$10$1RE7I/DzLunm3QWzpbxpd.7DMIrYI0tbbNzYP2K23YvsmL1rXXYcO', 0, '', '', '', 0, 0, NULL, ''),
(4, 'test4', '', '987654321', 'test4@test.com', '$2y$10$4LFoeUeMkurMUQxzG3d46.bJD4AuNPtDpYNOvOmXprFMKcJNbCvvC', 0, '', '', '', 0, 0, NULL, ''),
(8, 'Nick', 'Severson', '1234567890', 'nickseverson@me.com', '$2y$10$xL1XFGGhwdKnIEnby2RVIe4bmfHzwSxfXaiZNMePKkH.XWfkyEaZe', 0, NULL, NULL, NULL, 0, 0, NULL, ''),
(9, 'Tucker', 'Folsom', '1234567890', 'tucker@treats.com', '$2y$10$UX4i/OvMTFnmDO0SNHsiaOoYuhSKEzwh9KlTlcLaoCLHPv6uxrT8i', 0, NULL, NULL, NULL, 0, 0, NULL, ''),
(11, 'Tucker', 'Folsom', '1234567890', 'tucker2@treats.com', '$2y$10$aogyfuaJHUyUXs9DtmqE1OOwLGHKCJdq646i7gT/4b6VkVLDQhb1W', 1, NULL, NULL, NULL, 0, 0, NULL, ''),
(12, 'Tucker', 'Folsom', '1234567890', 'tucker3@treats.com', '$2y$10$92814ycftqjTDHVWBJJJCu6u.xAjyPVmL6EsvX2Zq87f4xhSCD6qO', 0, NULL, NULL, NULL, 0, 0, NULL, ''),
(31, 'Ben', 'Prestel', '7703304466', 'benjamin43.prestel@gmail.com', '$2y$10$gkRKY2a03MCt6dWdH547O./z7.ZU1K.qZE.utZJHXy/pTMqQADsv.', 1, '', '', '', 1, 0, '07cdfd23373b17c6b337251c22b7ea57', 'test'),
(32, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$Dq0OBR455f8WJyG3nq7evepn5uIPzWSpHga2FolJQFuHSEXXbMGYm', 1, NULL, NULL, NULL, 1, 1, '5751ec3e9a4feab575962e78e006250d', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `recievePromo` tinyint(4) NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `accountStatus` int(11) DEFAULT NULL,
  `accountType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table to store all the users of the system\n';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`idBooking`),
  ADD KEY `customerID_idx` (`customerID`),
  ADD KEY `showID_idx` (`showID`),
  ADD KEY `paymentID_idx` (`paymentID`),
  ADD KEY `promoID_idx` (`promoID`);

--
-- Indexes for table `movies_table`
--
ALTER TABLE `movies_table`
  ADD PRIMARY KEY (`idMovie`),
  ADD KEY `categoryType_idx` (`categoryID`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `payment_card_table`
--
ALTER TABLE `payment_card_table`
  ADD PRIMARY KEY (`idPaymentCard`);

--
-- Indexes for table `promotions_table`
--
ALTER TABLE `promotions_table`
  ADD PRIMARY KEY (`idPromotions`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `userID_idx` (`userID`),
  ADD KEY `movieID_idx` (`movieID`);

--
-- Indexes for table `seats_table`
--
ALTER TABLE `seats_table`
  ADD PRIMARY KEY (`seatNumber`,`showID`),
  ADD KEY `showID_idx` (`showID`);

--
-- Indexes for table `showroom_table`
--
ALTER TABLE `showroom_table`
  ADD PRIMARY KEY (`idRoom`);

--
-- Indexes for table `showtime_table`
--
ALTER TABLE `showtime_table`
  ADD PRIMARY KEY (`idShowtime`);

--
-- Indexes for table `show_table`
--
ALTER TABLE `show_table`
  ADD PRIMARY KEY (`idShow`),
  ADD KEY `moiveID_idx` (`movieID`),
  ADD KEY `showroom_idx` (`showroomID`),
  ADD KEY `showtime_idx` (`showtimeID`);

--
-- Indexes for table `tickets_table`
--
ALTER TABLE `tickets_table`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `bookingID_idx` (`bookingID`),
  ADD KEY `typeID_idx` (`typeID`),
  ADD KEY `seatNumber_idx` (`seatNumber`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `idUsers_UNIQUE` (`idUser`),
  ADD KEY `accountType_idx` (`accountType`),
  ADD KEY `accountStatus_idx` (`accountStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_status`
--
ALTER TABLE `account_status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies_table`
--
ALTER TABLE `movies_table`
  MODIFY `idMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movie_category`
--
ALTER TABLE `movie_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_card_table`
--
ALTER TABLE `payment_card_table`
  MODIFY `idPaymentCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promotions_table`
--
ALTER TABLE `promotions_table`
  MODIFY `idPromotions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `showroom_table`
--
ALTER TABLE `showroom_table`
  MODIFY `idRoom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `showtime_table`
--
ALTER TABLE `showtime_table`
  MODIFY `idShowtime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `show_table`
--
ALTER TABLE `show_table`
  MODIFY `idShow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets_table`
--
ALTER TABLE `tickets_table`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `paymentID` FOREIGN KEY (`paymentID`) REFERENCES `payment_card_table` (`idPaymentCard`),
  ADD CONSTRAINT `promoID` FOREIGN KEY (`promoID`) REFERENCES `promotions_table` (`idPromotions`),
  ADD CONSTRAINT `showID` FOREIGN KEY (`showID`) REFERENCES `show_table` (`idShow`);

--
-- Constraints for table `movies_table`
--
ALTER TABLE `movies_table`
  ADD CONSTRAINT `categoryType` FOREIGN KEY (`categoryID`) REFERENCES `movie_category` (`idCategory`);

--
-- Constraints for table `review_table`
--
ALTER TABLE `review_table`
  ADD CONSTRAINT `movieID` FOREIGN KEY (`movieID`) REFERENCES `movies_table` (`idMovie`),
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `seats_table`
--
ALTER TABLE `seats_table`
  ADD CONSTRAINT `seats_showID` FOREIGN KEY (`showID`) REFERENCES `show_table` (`idShow`);

--
-- Constraints for table `show_table`
--
ALTER TABLE `show_table`
  ADD CONSTRAINT `moiveID` FOREIGN KEY (`movieID`) REFERENCES `movies_table` (`idMovie`),
  ADD CONSTRAINT `showroom` FOREIGN KEY (`showroomID`) REFERENCES `showroom_table` (`idRoom`),
  ADD CONSTRAINT `showtime` FOREIGN KEY (`showtimeID`) REFERENCES `showtime_table` (`idShowtime`);

--
-- Constraints for table `tickets_table`
--
ALTER TABLE `tickets_table`
  ADD CONSTRAINT `bookingID` FOREIGN KEY (`bookingID`) REFERENCES `booking_table` (`idBooking`),
  ADD CONSTRAINT `seatNumber` FOREIGN KEY (`seatNumber`) REFERENCES `seats_table` (`seatNumber`),
  ADD CONSTRAINT `typeID` FOREIGN KEY (`typeID`) REFERENCES `ticket_type` (`idType`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `accountStatus` FOREIGN KEY (`accountStatus`) REFERENCES `account_status` (`idStatus`),
  ADD CONSTRAINT `accountType` FOREIGN KEY (`accountType`) REFERENCES `account_type` (`idType`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
