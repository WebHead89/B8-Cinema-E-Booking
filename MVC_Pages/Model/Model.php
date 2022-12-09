<?php
    require __DIR__ . "/database.php";

    class Model {
        private $mysqli;

        public function __construct() {
            $db = new Database;
            $this->mysqli = $db->getConnection();
        }


        public function getMovieCategories() {
            $sql = "SELECT * FROM `movie_category`";
            $result = $this->mysqli->query($sql);
            $categories = $result->fetch_all(MYSQLI_ASSOC);
            return $categories;
        }

        public function addNewMovie($title, $cast, $director, $producer, $synopsis, $filepath, $trailerURL, $rating, $genereID, $x) {
            $stmt = $this->mysqli->stmt_init();
            $sql = "INSERT INTO `movies_table`(`title`, `cast`, `director`, `producer`, `synopsis`, `trailerPicture`, `trailerVideo`, `filmRating`, `categoryID`, `isCurrentlyPlaying`) 
                    VALUES ('{$title}','{$cast}','{$director}','{$producer}','{$synopsis}','{$filepath}','{$trailerURL}','{$rating}','{$genereID}','{$x}')";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();
        }

        public function getPromotions() {
            $sql = "SELECT * FROM `promotions_table`";
            $result = $this->mysqli->query($sql);
            $promotions = $result->fetch_all(MYSQLI_ASSOC);
            return $promotions;
        }

        public function getEmails() {
            $sql = "SELECT * FROM `user` WHERE promo='1'";
            $result = $this->mysqli->query($sql);
            $emailAccounts = $result->fetch_all(MYSQLI_ASSOC);
            return $emailAccounts;
        }

        public function addNewPromo($promoCode, $discount) {
            $stmt = $this->mysqli->stmt_init();
            $stmt = $this->mysqli->prepare("INSERT INTO `promotions_table` (`code`, `discount`) VALUES ('$promoCode', '$discount')");
            $stmt->execute();
        }

        public function getCurrentlyPlayingMovies() {
            $sql = "SELECT * FROM `movies_table` WHERE isCurrentlyPlaying = 1";
            $result = $this->mysqli->query($sql);
            $currentMovies = $result->fetch_all(MYSQLI_ASSOC);
            return $currentMovies;
        }

        public function getUpcomingMovies() {
            $sql = "SELECT * FROM `movies_table` WHERE isCurrentlyPlaying = 0";
            $result = $this->mysqli->query($sql);
            $upcomingMovies = $result->fetch_all(MYSQLI_ASSOC);
            return $upcomingMovies;
        }

        public function getShows() {
            $sql = "SELECT * FROM `show_table`";
            $result = $this->mysqli->query($sql);
            $shows = $result->fetch_all(MYSQLI_ASSOC);
            return $shows;
        }

        public function getShowRooms() {
            $sql = "SELECT * FROM `showroom_table`";
            $result = $this->mysqli->query($sql);
            $showRooms = $result->fetch_all(MYSQLI_ASSOC);
            //$roomNames = array_column($showRooms, "name", "idRoom"); // create an array with indices as idRoom and value of name
            return $showRooms;
        }

        public function getShowsOfMovie($movieID) {
            $sql = "SELECT * FROM `show_table` WHERE movieID = $movieID;";
            $result = $this->mysqli->query($sql);
            $shows = $result->fetch_all(MYSQLI_ASSOC);
            return $shows;
        }

        public function getShowTimes() {
            $sql = "SELECT * FROM `showtime_table`";
            $result = $this->mysqli->query($sql);
            $showTimes = $result->fetch_all(MYSQLI_ASSOC);
            //$showTimeArr = array_column($showTimes, "showtime", "idShowtime"); // array refrenced by idShowtime with value of showtime
            return $showTimes;
        }

        public function checkUniqueShow($showroomID, $showtimeID, $showdate) {
            $sql = "SELECT * FROM `show_table` WHERE showroomID = $showroomID and showtimeID = $showtimeID and date = '$showdate';";
            $result = $this->mysqli->query($sql);
            $result = $result->fetch_assoc();
            if($result) {
                return false;
            } else {
                return true;
            }
        }

        public function addNewShow($movieID, $showroomID, $showdate, $showtimeID) {
            $stmt = $this->mysqli->stmt_init();
            $stmt = $this->mysqli->prepare("INSERT INTO `show_table` (`date`, `movieID`, `showroomID`, `showtimeID`) 
                VALUES ('$showdate', '$movieID', '$showroomID', '$showtimeID');");
            $stmt->execute();
        }
        public function getShowID($movieID, $showroomID, $showdate, $showtimeID) {
            $sql = "SELECT * FROM `show_table` WHERE date='$showdate' AND showtimeID=$showtimeID and showroomID=$showroomID";
            $result = $this->mysqli->query($sql);
            $show = $result->fetch_assoc();
            $showID = $show["idShow"];
            return $showID;
        }

        public function createSeats($showID) {
            for($i = 1; $i <= 27; $i++) {
                $stmt = $this->mysqli->stmt_init();
                $stmt = $this->mysqli->prepare("INSERT INTO `seats_table` (`seatNumber`, `isReserved`, `showID`) VALUES ('$i', '0', '$showID');");
                $stmt->execute();
            }
        }

        public function addCurrentMovie($id) {
            $stmt = $this->mysqli->stmt_init();
            $stmt = $this->mysqli->prepare("UPDATE `movies_table` SET `isCurrentlyPlaying` = '1' WHERE `movies_table`.`idMovie` = $id;");
            $stmt->execute();
        }

	  public function signup($first_name, $last_name, $phone, $email, $password_hash, $promo, $hash) {
		$sql = "INSERT INTO user(first_name, last_name, phone, email, password, promo, emailHash, status)
        		VALUES(?, ?, ?, ?, ?, ?, ?, 2)";

		// init for sql execution
		$stmt = $this->mysqli->stmt_init();

		// print error statement and die if problems preparing
		if ( ! $stmt->prepare($sql)) {
   		 die("SQL error: " . $this->mysqli->error);
		}

		$stmt->bind_param("sssssis",
                  $_POST['first_name'],
                  $_POST['last_name'],
                  $_POST['phone'],
                  $_POST['email'],
                  $password_hash,
                  $promo,
                  $hash);


		// execute statement and catch exception for duplicate emails                   
		try {
    			if ($stmt->execute()) {
    
        			header("Location: ../signup-success.php");
        			exit;

   			 }
		} catch (Exception $e) {

    			echo "Duplicate Email. \n";
    			die($mysqli->error . " " . $mysqli->errno);

		}

	  }

	  public function getLoginInfo($email) {
   		 $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $this->mysqli->real_escape_string($email));
		$result = $this->mysqli->query($sql);
	   	$user = $result->fetch_assoc();		
		return $user;	 
	  } //getLoginInfo
       

   
        public function resetPassword() {	
		$sql = "UPDATE user SET emailHash = ? WHERE email = ?";
    		$stmt = $this->mysqli->prepare($sql);
    		$stmt->bind_param("ss", $hash, $email);
   		$stmt->execute();
	  }

      public function getShowSeats($showID) {
        // get seats from the database
        $sql = "SELECT * FROM `seats_table` WHERE `showID` = $showID";
        $result = $this->mysqli->query($sql);
        $seats = $result->fetch_all(MYSQLI_ASSOC);
        return $seats;
    }

        public function getTicketPrices() {
            $sql = "SELECT * FROM `ticket_type`;";
            $result = $this->mysqli->query($sql);
            $ticketTypes = $result->fetch_all(MYSQLI_ASSOC);
            $ticketPrices = array_column($ticketTypes, "price", "type");
            return $ticketPrices;
        }

        public function searchPromoCode($code) {
            $sql = "SELECT * FROM `promotions_table` WHERE `code` = '$code';";
            $result = $this->mysqli->query($sql);
            $promo = $result->fetch_assoc();
            return $promo;
        }

        public function getUserInfo($id) {
            $sql = "SELECT * FROM user WHERE id = $id";
            $result = $this->mysqli->query($sql);
            $user = $result->fetch_assoc();
            return $user;
        }

        public function getPaymentCards($id) {
            $sql = "SELECT * FROM `payment_card_table` WHERE `userID` = $id;";
            $result = $this->mysqli->query($sql);
            $paymentCards = $result->fetch_all(MYSQLI_ASSOC);
            return $paymentCards;
        } 

        public function createOneTimePaymentCard($cardNum, $expiration) {
            // create new payment Card, set user ID to -1, meaning 1 time card
            $stmt = $this->mysqli->stmt_init();
            $sql = "INSERT INTO `payment_card_table` (`idPaymentCard`, `cardNum`, `experationDate`, `userID`) VALUES (NULL, '$cardNum', '$expiration', '-1');";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();
        }

        public function getIdPaymentCard($cardNum) {
            $sql = "SELECT * FROM `payment_card_table` WHERE `cardNum` = $cardNum;";
            $result = $this->mysqli->query($sql);
            $card = $result->fetch_assoc();
            $idCard = $card["idPaymentCard"];
            return $idCard;
        }

        public function createBooking($totalPrice, $showID, $paymentID, $promoID, $userID) {
            $stmt = $this->mysqli->stmt_init();
            $sql = "INSERT INTO `booking_table` (`idBooking`, `totalPrice`, `showID`, `paymentID`, `promoID`, `customerID`) VALUES (NULL, '$totalPrice', 
                      '$showID', '$paymentID', '$promoID', '$userID');";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();
        }

        public function getBookingID($totalPrice, $showID, $paymentID, $promoID, $userID) {
            $sql = "  SELECT * FROM `booking_table` WHERE `totalPrice` = $totalPrice AND `showID` = $showID AND `paymentID` = $paymentID AND 
                      `customerID` = $userID AND `promoID` = $promoID";
            $result = $this->mysqli->query($sql);
            $booking = $result->fetch_assoc();
            $bookingID = $booking["idBooking"];
            return $bookingID;
        }

        public function createTicket($bookingID, $seat) {
            $stmt = $this->mysqli->stmt_init();
              $sql = "INSERT INTO `tickets_table` (`idTicket`, `bookingID`, `seatNumber`) VALUES (NULL, '$bookingID', '$seat');";
              $stmt = $this->mysqli->prepare($sql);
              $stmt->execute();
        }

        public function updateSeat($seat, $showID) {
            $stmt = $this->mysqli->stmt_init();
            $sql = "UPDATE `seats_table` SET `isReserved` = '1' WHERE `seats_table`.`seatNumber` = $seat AND `seats_table`.`showID` = $showID;";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();
        }
        
        public function getNumMovies() {
            $sql = "SELECT * FROM `movies_table`;";
            $result = $this->mysqli->query($sql);
            $numMovies = $result->num_rows;
            return $numMovies;
        }

        public function getMovies() {
            $sql = "SELECT * FROM `movies_table`;";
            $result = $this->mysqli->query($sql);
            return $result;
        }

        public function getBookings($userID) {
            $sql = "SELECT * FROM `booking_table` WHERE `customerID` = $userID;";
            $result = $this->mysqli->query($sql);
            $bookings = $result->fetch_all(MYSQLI_ASSOC);
            return $bookings;
        }

        public function getShow($showID) {
            $sql = "SELECT * FROM `show_table` WHERE `idShow` = $showID;";
            $result = $this->mysqli->query($sql);
            $show = $result->fetch_assoc();
            return $show;
        }

        public function getMovie($id) {
            $sql = "SELECT * FROM `movies_table` WHERE `idMovie` = $id";
            $result = $this->mysqli->query($sql);
            $movie = $result->fetch_assoc();
            return $movie;
        }

        public function getTickets($bookingID) {
            $sql = "SELECT * FROM `tickets_table` WHERE `bookingID` = $bookingID";
            $result = $this->mysqli->query($sql);
            $tickets = $result->fetch_all(MYSQLI_ASSOC);
            return $tickets;
        }

        public function updateUserInfo($first_name, $last_name, $phone, $password_hash, $promo, $address, $city, $state, $zip, $id) {
            $stmt = $this->mysqli->stmt_init();
            $stmt = $this->mysqli->prepare("UPDATE user SET first_name='$first_name', last_name='$last_name', phone='$phone', password='$password_hash', promo='$promo', address='$address', city='$city', state='$state', zip='$zip' WHERE id='$id'");
            $stmt->execute();
        }

        public function updateUserInfoLessParams($email, $emailHash, $status) {
            $update = "UPDATE user SET status=1 WHERE email=? AND emailHash=? AND status=?";
            $stmt = $this->mysqli->prepare($update);
            $stmt->bind_param("ssi", $email, $emailHash, $status);
            $stmt->execute();

        }

        public function createNewPaymentCard($cardNum, $expiration, $userID) {
            $stmt = $this->mysqli->stmt_init();
            $sql = "INSERT INTO `payment_card_table` (`idPaymentCard`, `cardNum`, `experationDate`, `userID`) VALUES (NULL, '$cardNum', '$expiration', '$userID');";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();
        }

        public function findUserWithEmail($email, $emailHash, $status) {
            $sql = "SELECT email, emailHash, status FROM user WHERE email=? AND emailHash=? AND status=?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ssi", $email, $emailHash, $status);
            $stmt->execute();
            $resulting = $stmt->get_result();
            $user = $resulting->fetch_assoc();
            return $resulting->num_rows;
        }

        public function findUserWithEmailPassword($email, $emailHash) {

            $sql = "SELECT email, emailHash FROM user WHERE email=? AND emailHash=?"; 
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ss", $email, $emailHash);
            // var_dump($stmt);
            $stmt->execute();
            $resulting = $stmt->get_result();
            $user = $resulting->fetch_assoc();
            print_r($user);
            return $user;

            // $sql = "SELECT * FROM `tickets_table` WHERE `bookingID` = $bookingID";
            // $result = $this->mysqli->query($sql);
            // $tickets = $result->fetch_all(MYSQLI_ASSOC);
            // return $tickets;
            
        }

        public function updatePassword($email, $emailHash, $password_hash) {
            $update = "UPDATE user SET password=? WHERE email=? AND emailHash=?";
            $stmt = $this->mysqli->prepare($update);
            $stmt->bind_param("sss", $password_hash, $email, $emailHash);
            $stmt->execute();
        }

        public function updateUserHash($email, $emailHash) {
            $update = "UPDATE user SET emailHash=? WHERE email=?";
            $stmt = $this->mysqli->prepare($update);
            $stmt->bind_param("ss", $emailHash, $email);
            $stmt->execute();
        }

    }



?>