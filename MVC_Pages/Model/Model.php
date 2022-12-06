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
    }



?>