-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: cinema_schema
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_status`
--

DROP TABLE IF EXISTS `account_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_status` (
  `idStatus` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tell Users table what the status of an acount is';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_status`
--

LOCK TABLES `account_status` WRITE;
/*!40000 ALTER TABLE `account_status` DISABLE KEYS */;
INSERT INTO `account_status` VALUES (1,'active'),(2,'inactive'),(3,'suspended');
/*!40000 ALTER TABLE `account_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_type`
--

DROP TABLE IF EXISTS `account_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_type` (
  `idType` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Tell users table what account type the user is';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_type`
--

LOCK TABLES `account_type` WRITE;
/*!40000 ALTER TABLE `account_type` DISABLE KEYS */;
INSERT INTO `account_type` VALUES (1,'Admin'),(2,'Customer');
/*!40000 ALTER TABLE `account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_table`
--

DROP TABLE IF EXISTS `booking_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_table` (
  `idBooking` int NOT NULL AUTO_INCREMENT,
  `totalPrice` decimal(10,2) NOT NULL,
  `customerID` int unsigned NOT NULL,
  `showID` int NOT NULL,
  `paymentID` int NOT NULL,
  `promoID` int DEFAULT NULL,
  PRIMARY KEY (`idBooking`),
  KEY `customerID_idx` (`customerID`),
  KEY `showID_idx` (`showID`),
  KEY `paymentID_idx` (`paymentID`),
  KEY `promoID_idx` (`promoID`),
  CONSTRAINT `customerID` FOREIGN KEY (`customerID`) REFERENCES `users` (`idUser`),
  CONSTRAINT `paymentID` FOREIGN KEY (`paymentID`) REFERENCES `payment_card_table` (`idPaymentCard`),
  CONSTRAINT `promoID` FOREIGN KEY (`promoID`) REFERENCES `promotions_table` (`idPromotions`),
  CONSTRAINT `showID` FOREIGN KEY (`showID`) REFERENCES `show_table` (`idShow`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store all of the bookings for the movie theater\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_table`
--

LOCK TABLES `booking_table` WRITE;
/*!40000 ALTER TABLE `booking_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_category`
--

DROP TABLE IF EXISTS `movie_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_category` (
  `idCategory` int NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='stores the different categories of movies';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_category`
--

LOCK TABLES `movie_category` WRITE;
/*!40000 ALTER TABLE `movie_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `movie_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies_table`
--

DROP TABLE IF EXISTS `movies_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies_table` (
  `idMovie` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `cast` varchar(200) DEFAULT NULL,
  `director` varchar(45) DEFAULT NULL,
  `producer` varchar(45) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `trailerPicture` varchar(45) DEFAULT NULL,
  `trailerVideo` varchar(45) DEFAULT NULL,
  `filmRating` varchar(45) DEFAULT NULL,
  `categoryID` int NOT NULL,
  PRIMARY KEY (`idMovie`),
  KEY `categoryType_idx` (`categoryID`),
  CONSTRAINT `categoryType` FOREIGN KEY (`categoryID`) REFERENCES `movie_category` (`idCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store all information on a movie';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies_table`
--

LOCK TABLES `movies_table` WRITE;
/*!40000 ALTER TABLE `movies_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `movies_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_card_table`
--

DROP TABLE IF EXISTS `payment_card_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_card_table` (
  `idPaymentCard` int NOT NULL AUTO_INCREMENT,
  `cardNum` varchar(45) NOT NULL,
  `experationDate` varchar(45) NOT NULL,
  `idUser` int unsigned NOT NULL,
  PRIMARY KEY (`idPaymentCard`),
  KEY `idUser_idx` (`idUser`),
  CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store payment cards of the users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_card_table`
--

LOCK TABLES `payment_card_table` WRITE;
/*!40000 ALTER TABLE `payment_card_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_card_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions_table`
--

DROP TABLE IF EXISTS `promotions_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions_table` (
  `idPromotions` int NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `discount` decimal(2,2) NOT NULL,
  PRIMARY KEY (`idPromotions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store promotions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions_table`
--

LOCK TABLES `promotions_table` WRITE;
/*!40000 ALTER TABLE `promotions_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotions_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_table`
--

DROP TABLE IF EXISTS `review_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review_table` (
  `idReview` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `review` varchar(500) NOT NULL,
  `movieID` int NOT NULL,
  `userID` int unsigned NOT NULL,
  PRIMARY KEY (`idReview`),
  KEY `userID_idx` (`userID`),
  KEY `movieID_idx` (`movieID`),
  CONSTRAINT `movieID` FOREIGN KEY (`movieID`) REFERENCES `movies_table` (`idMovie`),
  CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='stores reviews for movies';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_table`
--

LOCK TABLES `review_table` WRITE;
/*!40000 ALTER TABLE `review_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `review_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seats_table`
--

DROP TABLE IF EXISTS `seats_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seats_table` (
  `seatNumber` int NOT NULL,
  `isReserved` tinyint DEFAULT '0',
  `showID` int NOT NULL,
  PRIMARY KEY (`seatNumber`,`showID`),
  KEY `showID_idx` (`showID`),
  CONSTRAINT `seats_showID` FOREIGN KEY (`showID`) REFERENCES `show_table` (`idShow`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='holds the all seats for a show, all seats are generated when a new show is created';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seats_table`
--

LOCK TABLES `seats_table` WRITE;
/*!40000 ALTER TABLE `seats_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `seats_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `show_table`
--

DROP TABLE IF EXISTS `show_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `show_table` (
  `idShow` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `movieID` int NOT NULL,
  `showroomID` int NOT NULL,
  `showtimeID` int NOT NULL,
  PRIMARY KEY (`idShow`),
  KEY `moiveID_idx` (`movieID`),
  KEY `showroom_idx` (`showroomID`),
  KEY `showtime_idx` (`showtimeID`),
  CONSTRAINT `moiveID` FOREIGN KEY (`movieID`) REFERENCES `movies_table` (`idMovie`),
  CONSTRAINT `showroom` FOREIGN KEY (`showroomID`) REFERENCES `showroom_table` (`idRoom`),
  CONSTRAINT `showtime` FOREIGN KEY (`showtimeID`) REFERENCES `showtime_table` (`idShowtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store all the shows in a movie';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show_table`
--

LOCK TABLES `show_table` WRITE;
/*!40000 ALTER TABLE `show_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `show_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showroom_table`
--

DROP TABLE IF EXISTS `showroom_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `showroom_table` (
  `idRoom` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `seatNumber` int NOT NULL,
  PRIMARY KEY (`idRoom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store all of the showrooms in the threater';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showroom_table`
--

LOCK TABLES `showroom_table` WRITE;
/*!40000 ALTER TABLE `showroom_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `showroom_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `showtime_table`
--

DROP TABLE IF EXISTS `showtime_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `showtime_table` (
  `idShowtime` int NOT NULL AUTO_INCREMENT,
  `showtime` time DEFAULT NULL,
  PRIMARY KEY (`idShowtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='table to store the showtimes for the theater';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `showtime_table`
--

LOCK TABLES `showtime_table` WRITE;
/*!40000 ALTER TABLE `showtime_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `showtime_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_type`
--

DROP TABLE IF EXISTS `ticket_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_type` (
  `idType` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='stores the different types of tickets\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_type`
--

LOCK TABLES `ticket_type` WRITE;
/*!40000 ALTER TABLE `ticket_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets_table`
--

DROP TABLE IF EXISTS `tickets_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets_table` (
  `idTicket` int NOT NULL AUTO_INCREMENT,
  `bookingID` int NOT NULL,
  `typeID` int NOT NULL,
  `seatNumber` int NOT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `bookingID_idx` (`bookingID`),
  KEY `typeID_idx` (`typeID`),
  KEY `seatNumber_idx` (`seatNumber`),
  CONSTRAINT `bookingID` FOREIGN KEY (`bookingID`) REFERENCES `booking_table` (`idBooking`),
  CONSTRAINT `seatNumber` FOREIGN KEY (`seatNumber`) REFERENCES `seats_table` (`seatNumber`),
  CONSTRAINT `typeID` FOREIGN KEY (`typeID`) REFERENCES `ticket_type` (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tables to store all of the tickets';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets_table`
--

LOCK TABLES `tickets_table` WRITE;
/*!40000 ALTER TABLE `tickets_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idUser` int unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `recievePromo` tinyint NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `accountStatus` int DEFAULT NULL,
  `accountType` int DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUsers_UNIQUE` (`idUser`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `accountType_idx` (`accountType`),
  KEY `accountStatus_idx` (`accountStatus`),
  CONSTRAINT `accountStatus` FOREIGN KEY (`accountStatus`) REFERENCES `account_status` (`idStatus`),
  CONSTRAINT `accountType` FOREIGN KEY (`accountType`) REFERENCES `account_type` (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Table to store all the users of the system\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Ben','Prestel','7703304466','benjamin43.prestel@gmail.com','password',1,'Marietta','Ga','30062',1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-13 17:20:17
