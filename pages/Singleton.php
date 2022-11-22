<?php
    // singleton class to store booking information
    class Singleton {
        // class instance
        private static $instance = null;

        // class attributes
        public $showID;                // the ID of the show chosen to book tickets for
        public $showDate;              // store the date of the show
        public $showTime;              // store the time of the show
        public $buttonTypeArray;       // array to store the types of buttons displayed(depends on the seat availability)
        public $selectedSeatsArray;    // array to store the seat numbers selected by the user
            // 1: reserved/unavailable seat
            // 2: open seat
            // 3: selected seat

        // constructor
        private function __construct() {
            $this->showID = -1;
            $this->buttonTypeArray = array_fill(0, 27, 2); // fill array of size 27 with 2's
        }

        public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new Singleton();
            }
            return self::$instance;
        }
    }


?>