<?php
    // singleton class to store booking information
    class Singleton {
        // class instance
        private static $instance = null;

        // class attributes
        public $movieID;               // store the movie
        public $showID;                // the ID of the show chosen to book tickets for
        public $showDate;              // store the date of the show
        public $showTime;              // store the time of the show
        public $buttonTypeArray;       // array to store the types of buttons displayed(depends on the seat availability)
            // 1: reserved/unavailable seat
            // 2: open seat
            // 3: selected seat
        public $selectedSeatsArray;    // array to store the seat numbers selected by the user
        public $adultTickets;           
        public $childTickets;
        public $seniorTickets;
        public $promoCode;
        public $promoDiscount;

        // constructor
        private function __construct() {
            $this->showID = -1;
            $this->buttonTypeArray = array_fill(0, 27, 2); // fill array of size 27 with 2's
            $this->selectedSeatsArray = array();
            $this->childTickets = 0;
            $this->adultTickets = 0;
            $this->seniorTickets = 0;
            $this->promoDiscount = 0;
            $this->promoCode = "";
        }

        public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new Singleton();
            }
            return self::$instance;
        }

    }


?>