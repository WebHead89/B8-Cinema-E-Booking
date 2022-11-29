<?php
    include __DIR__ . "/database.php";

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
            echo "SQL---------> " . $sql;
            $stmt->execute();
        }
    }



?>