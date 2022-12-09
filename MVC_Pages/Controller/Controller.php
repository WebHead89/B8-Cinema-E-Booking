<?php
    include_once __DIR__ . "/../Model/Model.php";
    
    class Controller {
        private $model;

        public function __construct() {
            $this->model = new Model();
        }

        public function addNewShow($movieID, $showroom, $showdate, $showtime) {
            // convert showRoom and showTime to showroomID and showtimeID
            $showTimes = $this->model->getShowTimes();
            $showTimeArr = array_column($showTimes, "idShowtime", "showtime");
            $showRooms = $this->model->getShowRooms();
            $roomNames = array_column($showRooms, "idRoom", "name"); // create an array with indices as name and value of idRoom
            
            $showroomID = $roomNames[$showroom];
            $showtimeID = $showTimeArr[$showtime];

            // check if show is unique
            $uniqueShow = $this->model->checkUniqueShow($showroomID, $showtimeID, $showdate);
            if($uniqueShow) {
                // add new show
                $this->model->addNewShow($movieID, $showroomID, $showdate, $showtimeID);

                // get show ID
                $showID = $this->model->getShowID($movieID, $showroomID, $showdate, $showtimeID);

                // create the new seats
                $this->model->createSeats($showID);

                return 0;
            } else {
                return -1;
            }

            
        }

        // Updates user status after email verification
        public function updateUserStatus($email, $emailHash, $status) {
            $update = "UPDATE user SET status=1 WHERE email=? AND emailHash=? AND status=?";
            $stmt = $mysqli->prepare($update);
            $stmt->bind_param("ssi", $email, $emailHash, $status);
            $stmt->execute();
        }
    }

?>