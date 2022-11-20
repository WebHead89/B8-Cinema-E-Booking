-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 20, 2022 at 05:57 PM
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
  `trailerPicture` varchar(500) DEFAULT NULL,
  `trailerVideo` varchar(45) DEFAULT NULL,
  `filmRating` varchar(45) DEFAULT NULL,
  `categoryID` int(11) NOT NULL,
  `isCurrentlyPlaying` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all information on a movie';

--
-- Dumping data for table `movies_table`
--

INSERT INTO `movies_table` (`idMovie`, `title`, `cast`, `director`, `producer`, `genre`, `synopsis`, `trailerPicture`, `trailerVideo`, `filmRating`, `categoryID`, `isCurrentlyPlaying`) VALUES
(1, 'Avatar', '[cast]', '[director]', '[producer]', '[genre]', '[synopsis]', '../pages/assets/avatar.jpg', 'https://www.youtube.com/embed/5PSNL1qE6VY', 'rating', 1, 1),
(4, 'Rogue One', 'Test Cast', 'Test Director', 'Test Producer', NULL, 'Test Synopsis', '../pages/assets/rogueone.jpg', 'https://www.youtube.com/embed/frdj1zb9sMY', 'PG-13', 4, 1),
(5, 'Elvis', 'Elvis Cast', 'Elvis Director', 'Elvis Producer', NULL, 'Elvis is elvis', '../pages/assets/elvis.jpg', 'https://www.youtube.com/embed/wBDLRvjHVOY', 'R', 1, 0),
(6, 'Titanic', 'Titanic Cast', 'Titanic Director', 'Titanic Producer', NULL, 'Titanic hits an iceberg. Music plays. People die. Hearts go on.', '../pages/assets/titanic.webp', 'https://www.youtube.com/embed/kVrqfYjkTdQ', 'PG-13', 5, 0),
(7, 'Nope', 'Nope Cast', 'Jordan Peele', 'Jordan Peele', NULL, 'SCARY MOVIE SCARY SCARY SCARY', '../pages/assets/nope.jpg', 'https://www.youtube.com/embed/In8fuzj3gck', 'R', 3, 0);

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
(1, 'freeMoney', '0.99'),
(2, 'test', '0.99'),
(3, 'test', '0.99');

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

--
-- Dumping data for table `seats_table`
--

INSERT INTO `seats_table` (`seatNumber`, `isReserved`, `showID`) VALUES
(1, 0, 15),
(1, 0, 16),
(1, 0, 17),
(1, 0, 18),
(1, 0, 19),
(1, 0, 20),
(2, 0, 15),
(2, 0, 16),
(2, 0, 17),
(2, 0, 18),
(2, 0, 19),
(2, 0, 20),
(3, 0, 15),
(3, 0, 16),
(3, 0, 17),
(3, 0, 18),
(3, 0, 19),
(3, 0, 20),
(4, 0, 15),
(4, 0, 16),
(4, 0, 17),
(4, 0, 18),
(4, 0, 19),
(4, 0, 20),
(5, 0, 15),
(5, 0, 16),
(5, 0, 17),
(5, 0, 18),
(5, 0, 19),
(5, 0, 20),
(6, 0, 15),
(6, 0, 16),
(6, 0, 17),
(6, 0, 18),
(6, 0, 19),
(6, 0, 20),
(7, 0, 15),
(7, 0, 16),
(7, 0, 17),
(7, 0, 18),
(7, 0, 19),
(7, 0, 20),
(8, 0, 15),
(8, 0, 16),
(8, 0, 17),
(8, 0, 18),
(8, 0, 19),
(8, 0, 20),
(9, 0, 15),
(9, 0, 16),
(9, 0, 17),
(9, 0, 18),
(9, 0, 19),
(9, 0, 20),
(10, 0, 15),
(10, 0, 16),
(10, 0, 17),
(10, 0, 18),
(10, 0, 19),
(10, 0, 20),
(11, 0, 15),
(11, 0, 16),
(11, 0, 17),
(11, 0, 18),
(11, 0, 19),
(11, 0, 20),
(12, 0, 15),
(12, 0, 16),
(12, 0, 17),
(12, 0, 18),
(12, 0, 19),
(12, 0, 20),
(13, 0, 15),
(13, 0, 16),
(13, 0, 17),
(13, 0, 18),
(13, 0, 19),
(13, 0, 20),
(14, 0, 15),
(14, 0, 16),
(14, 0, 17),
(14, 0, 18),
(14, 0, 19),
(14, 0, 20),
(15, 0, 15),
(15, 0, 16),
(15, 0, 17),
(15, 0, 18),
(15, 0, 19),
(15, 0, 20),
(16, 0, 15),
(16, 0, 16),
(16, 0, 17),
(16, 0, 18),
(16, 0, 19),
(16, 0, 20),
(17, 0, 15),
(17, 0, 16),
(17, 0, 17),
(17, 0, 18),
(17, 0, 19),
(17, 0, 20),
(18, 0, 15),
(18, 0, 16),
(18, 0, 17),
(18, 0, 18),
(18, 0, 19),
(18, 0, 20),
(19, 0, 15),
(19, 0, 16),
(19, 0, 17),
(19, 0, 18),
(19, 0, 19),
(19, 0, 20),
(20, 0, 15),
(20, 0, 16),
(20, 0, 17),
(20, 0, 18),
(20, 0, 19),
(20, 0, 20),
(21, 0, 15),
(21, 0, 16),
(21, 0, 17),
(21, 0, 18),
(21, 0, 19),
(21, 0, 20),
(22, 0, 15),
(22, 0, 16),
(22, 0, 17),
(22, 0, 18),
(22, 0, 19),
(22, 0, 20),
(23, 0, 15),
(23, 0, 16),
(23, 0, 17),
(23, 0, 18),
(23, 0, 19),
(23, 0, 20),
(24, 0, 15),
(24, 0, 16),
(24, 0, 17),
(24, 0, 18),
(24, 0, 19),
(24, 0, 20),
(25, 0, 15),
(25, 0, 16),
(25, 0, 17),
(25, 0, 18),
(25, 0, 19),
(25, 0, 20),
(26, 0, 15),
(26, 0, 16),
(26, 0, 17),
(26, 0, 18),
(26, 0, 19),
(26, 0, 20),
(27, 0, 15),
(27, 0, 16),
(27, 0, 17),
(27, 0, 18),
(27, 0, 19),
(27, 0, 20);

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
(1, 'Room 1', 27),
(2, 'Room 2', 27),
(3, 'Room 3', 27),
(4, 'Room 4', 27),
(5, 'Room 5', 27),
(6, 'Room 6', 27);

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
(15, '2022-11-24', 1, 3, 2),
(16, '2022-11-17', 1, 4, 3),
(17, '2022-11-16', 4, 5, 4),
(18, '2022-11-30', 1, 1, 1),
(19, '2022-12-07', 1, 5, 2),
(20, '2022-11-30', 1, 2, 3);

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
  MODIFY `idMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idPromotions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `idShow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
