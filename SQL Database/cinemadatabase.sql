-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 03:39 AM
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
  `showID` int(11) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `promoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='table to store all of the bookings for the movie theater\n';

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`idBooking`, `totalPrice`, `showID`, `paymentID`, `customerID`, `promoID`) VALUES
(20, '20.00', 15, 6, 34, -1),
(21, '20.00', 17, 7, 34, -1),
(22, '8.00', 16, 6, 34, -1),
(23, '16.00', 15, 6, 37, -1),
(24, '24.00', 21, 17, 40, 1);

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
(1, 'Avatar', 'Sam Worthington, Zoe Saldana, Sigourney Weaver', 'James Cameron', 'James Cameron', 'Action', 'Blue people on a green planet and blue people die', '../pages/assets/avatar.jpg', 'https://www.youtube.com/embed/5PSNL1qE6VY', 'rating', 1, 1),
(4, 'Rogue One', 'Felicity Jones, Diego Luna', 'Gareth Edwards', 'Kathleen Kenedy', 'Sci-Fi', 'Spies, lasers, no lightsabers and everyone dies', '../pages/assets/rogueone.jpg', 'https://www.youtube.com/embed/frdj1zb9sMY', 'PG-13', 4, 1),
(5, 'Elvis', 'Austin Butler, Tom Hanks', 'Baz Luhrmann', 'Baz Luhrmann', 'Drama', 'Elvis is Elvis and he died on the toilet', '../pages/assets/elvis.jpg', 'https://www.youtube.com/embed/wBDLRvjHVOY', 'R', 1, 0),
(6, 'Titanic', 'Kate Winslet, Leonardo DiCaprio', 'James Cameron', 'James Cameron', 'Drama', 'Titanic hits an iceberg. Music plays. People die. Hearts go on.', '../pages/assets/titanic.webp', 'https://www.youtube.com/embed/kVrqfYjkTdQ', 'PG-13', 5, 1),
(7, 'Nope', 'Keke Palmer, Steven Yuen', 'Jordan Peele', 'Jordan Peele', 'Horror', 'SCARY MOVIE SCARY SCARY SCARY ... and people die', '../pages/assets/nope.jpg', 'https://www.youtube.com/embed/In8fuzj3gck', 'R', 3, 0);

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

--
-- Dumping data for table `payment_card_table`
--

INSERT INTO `payment_card_table` (`idPaymentCard`, `cardNum`, `experationDate`, `userID`) VALUES
(15, '1234567890987654', '09/27', 40),
(16, '4567890987654321', '06/26', 39);

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
(2, 'test', '0.50');

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
(1, 0, 21),
(1, 0, 22),
(1, 0, 23),
(1, 0, 24),
(1, 0, 25),
(2, 0, 15),
(2, 1, 16),
(2, 0, 17),
(2, 0, 18),
(2, 0, 19),
(2, 0, 20),
(2, 0, 21),
(2, 0, 22),
(2, 0, 23),
(2, 0, 24),
(2, 0, 25),
(3, 0, 15),
(3, 0, 16),
(3, 0, 17),
(3, 0, 18),
(3, 0, 19),
(3, 0, 20),
(3, 0, 21),
(3, 0, 22),
(3, 0, 23),
(3, 0, 24),
(3, 0, 25),
(4, 0, 15),
(4, 0, 16),
(4, 0, 17),
(4, 0, 18),
(4, 0, 19),
(4, 0, 20),
(4, 0, 21),
(4, 0, 22),
(4, 0, 23),
(4, 0, 24),
(4, 0, 25),
(5, 0, 15),
(5, 0, 16),
(5, 1, 17),
(5, 0, 18),
(5, 0, 19),
(5, 0, 20),
(5, 0, 21),
(5, 0, 22),
(5, 0, 23),
(5, 0, 24),
(5, 0, 25),
(6, 1, 15),
(6, 0, 16),
(6, 1, 17),
(6, 0, 18),
(6, 0, 19),
(6, 0, 20),
(6, 0, 21),
(6, 0, 22),
(6, 0, 23),
(6, 0, 24),
(6, 0, 25),
(7, 0, 15),
(7, 0, 16),
(7, 1, 17),
(7, 0, 18),
(7, 0, 19),
(7, 0, 20),
(7, 0, 21),
(7, 0, 22),
(7, 0, 23),
(7, 0, 24),
(7, 0, 25),
(8, 1, 15),
(8, 0, 16),
(8, 0, 17),
(8, 0, 18),
(8, 0, 19),
(8, 0, 20),
(8, 0, 21),
(8, 0, 22),
(8, 0, 23),
(8, 0, 24),
(8, 0, 25),
(9, 1, 15),
(9, 0, 16),
(9, 0, 17),
(9, 0, 18),
(9, 0, 19),
(9, 0, 20),
(9, 0, 21),
(9, 0, 22),
(9, 0, 23),
(9, 0, 24),
(9, 0, 25),
(10, 1, 15),
(10, 0, 16),
(10, 0, 17),
(10, 0, 18),
(10, 0, 19),
(10, 0, 20),
(10, 0, 21),
(10, 0, 22),
(10, 0, 23),
(10, 0, 24),
(10, 0, 25),
(11, 0, 15),
(11, 0, 16),
(11, 0, 17),
(11, 0, 18),
(11, 0, 19),
(11, 0, 20),
(11, 0, 21),
(11, 0, 22),
(11, 0, 23),
(11, 0, 24),
(11, 0, 25),
(12, 0, 15),
(12, 0, 16),
(12, 0, 17),
(12, 0, 18),
(12, 0, 19),
(12, 0, 20),
(12, 0, 21),
(12, 0, 22),
(12, 0, 23),
(12, 0, 24),
(12, 0, 25),
(13, 0, 15),
(13, 0, 16),
(13, 0, 17),
(13, 0, 18),
(13, 0, 19),
(13, 0, 20),
(13, 0, 21),
(13, 0, 22),
(13, 0, 23),
(13, 0, 24),
(13, 0, 25),
(14, 0, 15),
(14, 0, 16),
(14, 0, 17),
(14, 0, 18),
(14, 0, 19),
(14, 0, 20),
(14, 0, 21),
(14, 0, 22),
(14, 0, 23),
(14, 0, 24),
(14, 0, 25),
(15, 0, 15),
(15, 0, 16),
(15, 0, 17),
(15, 0, 18),
(15, 0, 19),
(15, 0, 20),
(15, 0, 21),
(15, 0, 22),
(15, 0, 23),
(15, 0, 24),
(15, 0, 25),
(16, 0, 15),
(16, 0, 16),
(16, 0, 17),
(16, 0, 18),
(16, 0, 19),
(16, 0, 20),
(16, 1, 21),
(16, 0, 22),
(16, 0, 23),
(16, 0, 24),
(16, 0, 25),
(17, 0, 15),
(17, 0, 16),
(17, 0, 17),
(17, 0, 18),
(17, 0, 19),
(17, 0, 20),
(17, 0, 21),
(17, 0, 22),
(17, 0, 23),
(17, 0, 24),
(17, 0, 25),
(18, 0, 15),
(18, 0, 16),
(18, 0, 17),
(18, 0, 18),
(18, 0, 19),
(18, 0, 20),
(18, 1, 21),
(18, 0, 22),
(18, 0, 23),
(18, 0, 24),
(18, 0, 25),
(19, 1, 15),
(19, 0, 16),
(19, 0, 17),
(19, 0, 18),
(19, 0, 19),
(19, 0, 20),
(19, 0, 21),
(19, 0, 22),
(19, 0, 23),
(19, 0, 24),
(19, 0, 25),
(20, 0, 15),
(20, 0, 16),
(20, 0, 17),
(20, 0, 18),
(20, 0, 19),
(20, 0, 20),
(20, 0, 21),
(20, 0, 22),
(20, 0, 23),
(20, 0, 24),
(20, 0, 25),
(21, 0, 15),
(21, 0, 16),
(21, 0, 17),
(21, 0, 18),
(21, 0, 19),
(21, 0, 20),
(21, 0, 21),
(21, 0, 22),
(21, 0, 23),
(21, 0, 24),
(21, 0, 25),
(22, 1, 15),
(22, 0, 16),
(22, 0, 17),
(22, 0, 18),
(22, 0, 19),
(22, 0, 20),
(22, 0, 21),
(22, 0, 22),
(22, 0, 23),
(22, 0, 24),
(22, 0, 25),
(23, 1, 15),
(23, 0, 16),
(23, 0, 17),
(23, 0, 18),
(23, 0, 19),
(23, 0, 20),
(23, 0, 21),
(23, 0, 22),
(23, 0, 23),
(23, 0, 24),
(23, 0, 25),
(24, 1, 15),
(24, 0, 16),
(24, 0, 17),
(24, 0, 18),
(24, 0, 19),
(24, 0, 20),
(24, 1, 21),
(24, 0, 22),
(24, 0, 23),
(24, 0, 24),
(24, 0, 25),
(25, 1, 15),
(25, 0, 16),
(25, 0, 17),
(25, 0, 18),
(25, 0, 19),
(25, 0, 20),
(25, 0, 21),
(25, 0, 22),
(25, 0, 23),
(25, 0, 24),
(25, 0, 25),
(26, 1, 15),
(26, 0, 16),
(26, 0, 17),
(26, 0, 18),
(26, 0, 19),
(26, 0, 20),
(26, 0, 21),
(26, 0, 22),
(26, 0, 23),
(26, 0, 24),
(26, 0, 25),
(27, 0, 15),
(27, 0, 16),
(27, 0, 17),
(27, 0, 18),
(27, 0, 19),
(27, 1, 20),
(27, 0, 21),
(27, 0, 22),
(27, 0, 23),
(27, 0, 24),
(27, 0, 25);

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
(20, '2022-11-30', 1, 2, 3),
(21, '2022-12-09', 4, 3, 1),
(22, '2022-12-08', 4, 4, 2),
(23, '2022-12-08', 6, 1, 3),
(24, '2022-12-09', 6, 2, 1),
(25, '2022-12-08', 6, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_table`
--

CREATE TABLE `tickets_table` (
  `idTicket` int(11) NOT NULL,
  `bookingID` int(11) NOT NULL,
  `seatNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tables to store all of the tickets';

--
-- Dumping data for table `tickets_table`
--

INSERT INTO `tickets_table` (`idTicket`, `bookingID`, `seatNumber`) VALUES
(11, 20, 22),
(12, 20, 23),
(13, 20, 24),
(14, 21, 5),
(15, 21, 6),
(16, 21, 7),
(17, 22, 2),
(18, 23, 25),
(19, 23, 26),
(20, 24, 24),
(21, 24, 18),
(22, 24, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `idType` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores the different types of tickets\n';

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`idType`, `type`, `price`) VALUES
(1, 'CHILD', '6.00'),
(2, 'ADULT', '8.00'),
(3, 'SENIOR', '6.00');

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
(39, 'Admin ', 'McAdmin', '1234567890', 'admin@gmail.com', '$2y$10$mevdYPPdpbocrjiexUoFT.dTpIThIymLLi1GbfwB/28LCIvxKiL7u', 1, '', '', '', 1, 1, '3dc4876f3f08201c7c76cb71fa1da439', ''),
(40, 'User ', 'McUser', '1234567890', 'user@gmail.com', '$2y$10$3GJjE74wNxu2ZJSZzqnxjeWgxWCqhmCKtplGAEVPqny4Sdp/.vj5K', 1, '', '', '', 1, 0, '7dcd340d84f762eba80aa538b0c527f7', '');

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
  ADD KEY `showID_idx` (`showID`),
  ADD KEY `paymentID_idx` (`paymentID`);

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
  MODIFY `idBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `idPaymentCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `idShow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tickets_table`
--
ALTER TABLE `tickets_table`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  ADD CONSTRAINT `seatNumber` FOREIGN KEY (`seatNumber`) REFERENCES `seats_table` (`seatNumber`);

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
