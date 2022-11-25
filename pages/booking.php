<?php
    include("Singleton.php");
    include("Factory.php");
    session_start();

    if (!isset($_SESSION['bookingInfo'])) {
        $_SESSION['bookingInfo'] = Singleton::getInstance();
    }
    $bookingInfo = $_SESSION['bookingInfo'];

    // get movie id
    $movieID = $_GET["movieID"];
    // reset the object data if user switches to a new movie
    if($bookingInfo->movieID != $movieID) {
        $bookingInfo->showID = -1;
        unset($bookingInfo->selectedSeatsArray);
        $bookingInfo->selectedSeatsArray = array();
        // set the ticket types
        $bookingInfo->childTickets = 0;
        $bookingInfo->adultTickets = 0;
        $bookingInfo->seniorTickets = 0;
    }

    // setup connection to db
    $mysqli = require __DIR__ . "/database.php";

    // get showtimes
    $sql = "SELECT * FROM `showtime_table`";
        $result = $mysqli->query($sql);
        $showTimes = $result->fetch_all(MYSQLI_ASSOC);
        $showTimeArr = array_column($showTimes, "showtime", "idShowtime");

    // get shows
    $sql = "SELECT * FROM `show_table` WHERE movieID = $movieID;";
        $result = $mysqli->query($sql);
        $shows = $result->fetch_all(MYSQLI_ASSOC);
    
    // get ticket types
    $sql = "SELECT * FROM `ticket_type`;";
        $result = $mysqli->query($sql);
        $ticketTypes = $result->fetch_all(MYSQLI_ASSOC);
        $ticketPrices = array_column($ticketTypes, "price", "type");

    // check for POSTS
    if(isset($_POST['postID'])) {
        // if the POST is for selecting the showtime
        if($_POST['postID'] == "showtimeBookingPage") {
            // set the showID, date, and time
            $bookingInfo->movieID = $_GET['movieID'];
            $bookingInfo->showID = $_POST['showID'];
            $bookingInfo->showDate = $_POST['showDate'];
            $bookingInfo->showTime = $_POST['showTime'];

            // set the ticket types
            $bookingInfo->childTickets = 0;
            $bookingInfo->adultTickets = 0;
            $bookingInfo->seniorTickets = 0;

            // reset the seats array
            unset($bookingInfo->selectedSeatsArray);
            $bookingInfo->selectedSeatsArray = array();
        }

        // if POST is to submit booking
        if($_POST['postID'] == "submitBooking") {
            // check to make sure the ticket numbers match to seats selected
            $totalTickets = $bookingInfo->childTickets + $bookingInfo->adultTickets + $bookingInfo->seniorTickets;
            if($totalTickets != count($bookingInfo->selectedSeatsArray)) {
                echo '<script>alert("Incorrect number of tickets to seats.")</script>';
            } else {
                // process to payment page
                
            }
        }

        // if POST is to reset the showID
        if($_POST['postID'] == "resetShow") {
            $bookingInfo->showID = -1;
        }

        // if POST is to add a seat selected by user
        if($_POST['postID'] == "userAddSeat") {
            $seatLoc = $_POST['seatIndex'];
            // set the seat to selected
            $bookingInfo->buttonTypeArray[$seatLoc] = 3;

            // add to selectedSeatsArray
            if($bookingInfo->selectedSeatsArray == NULL) {
                $bookingInfo->selectedSeatsArray = array();
            }
            array_push($bookingInfo->selectedSeatsArray, (int)$seatLoc + 1);

        }

        // if POST is to remove a seat selected by user
        if($_POST['postID'] == "userRemoveSeat") {
            $seatLoc = $_POST['seatIndex'];
            $value = (int)$seatLoc + 1;
            $index = array_search($value, $bookingInfo->selectedSeatsArray, FALSE);
            unset($bookingInfo->selectedSeatsArray[$index]);
            $bookingInfo->buttonTypeArray[$seatLoc] = 2;
        }

        // following POSTS are to update ticket prices
        if($_POST['postID'] == "addAdultTicket") {
            $bookingInfo->adultTickets++;
        }

        if($_POST['postID'] == "removeAdultTicket") {
            if($bookingInfo->adultTickets != 0) {
                $bookingInfo->adultTickets--;
            }
        }

        if($_POST['postID'] == "addChildTicket") {
            $bookingInfo->childTickets++;
        }

        if($_POST['postID'] == "removeChildTicket") {
            if($bookingInfo->childTickets != 0) {
                $bookingInfo->childTickets--;
            }
        }

        if($_POST['postID'] == "addSeniorTicket") {
            $bookingInfo->seniorTickets++;
        }

        if($_POST['postID'] == "removeSeniorTicket") {
            if($bookingInfo->seniorTickets != 0) {
                $bookingInfo->seniorTickets--;
            }
        }

    }

    // update the buttons table
    if($bookingInfo->showID != -1) {
        // get seats from the database
        $sql = "SELECT * FROM `seats_table` WHERE `showID` = $bookingInfo->showID";
        $result = $mysqli->query($sql);
        $seats = $result->fetch_all(MYSQLI_ASSOC);

        // set the buttonTypeArray from database
        for($i = 0; $i < 27; $i++) {
            if($seats[$i]["isReserved"]) {
                $bookingInfo->buttonTypeArray[$i] = 1;
            }
        }

    // if there is no show selected reset seats and selectedSeats array
    } else {
        for($i = 0; $i < 27; $i++) {
            $bookingInfo->buttonTypeArray[$i] = 2;
        }
        unset($bookingInfo->selectedSeatsArray);
        $bookingInfo->selectedSeatsArray = array();
        // set the ticket types
        $bookingInfo->childTickets = 0;
        $bookingInfo->adultTickets = 0;
        $bookingInfo->seniorTickets = 0;
    }

    // print details of Singleton class
    echo "Booking Info: ";
    var_dump($bookingInfo);
   

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book a movie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/booking.css" rel="stylesheet">
    <link href="../css/homepage.css" rel="stylesheet">

</head>

<body id="bg">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">E-Booking Cinema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto order-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="checkout.html" aria-current="page">View Cart</a>
                    </li>
                </ul>

                <div class="d-flex ms-auto order-5">
                    <div class="nav-item dropdown justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Will need to add responsiveness for if a seat is open or not and selected or not -->
    <div class="column theater">
        <div id="movie_screen">
            Movie Screen
        </div>
        <div class="seats">
            <div class="row first">
                <?php
                $i = 0; 
                for($i; $i < 3; $i++) { ?>
                    <div class="col-md-1">
                        <?php echo Factory::getButton($bookingInfo->buttonTypeArray[$i], $i); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="row second">
                <?php 
                $i = 3;
                for($i; $i < 8; $i++) { ?>
                    <div class="col-md-1">
                        <?php echo Factory::getButton($bookingInfo->buttonTypeArray[$i], $i); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="row second">
                <?php 
                $i = 8;
                for($i; $i < 13; $i++) { ?>
                    <div class="col-md-1">
                        <?php echo Factory::getButton($bookingInfo->buttonTypeArray[$i], $i); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="row third">
                <?php 
                $i = 13;
                for($i; $i < 20; $i++) { ?>
                    <div class="col-md-1">
                        <?php echo Factory::getButton($bookingInfo->buttonTypeArray[$i], $i); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="row third">
                <?php 
                $i = 20;
                for($i; $i < 27; $i++) { ?>
                    <div class="col-md-1">
                        <?php echo Factory::getButton($bookingInfo->buttonTypeArray[$i], $i); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="column booking">

        <h3 style="text-align: center;">Showtimes</h3>
        <div class="showtimes">
        <?php  
            // if no show is selected, display showtimes
            if($bookingInfo->showID == -1) {
                foreach($shows as $show) { ?>
                    <form name="addShow" method="POST">
                        <input type="hidden" id="postID" name="postID" value="showtimeBookingPage">
                        <input type="hidden" id="showID" name="showID" value="<?php echo $show["idShow"]; ?>">
                        <input type="hidden" id="showDate" name="showDate" value="<?php echo $show["date"]; ?>">
                        <input type="hidden" id="showTime" name="showTime" value="<?php echo $showTimeArr[$show["showtimeID"]]; ?>">
                        <button class="btn btn-secondary child" type="submit"> <?php echo $show["date"] . "&nbsp-&nbsp" 
                                . $showTimeArr[$show["showtimeID"]]; ?> </button>
                    </form>
                <?php } 
            // if a showtime is selected only display that showtime
            } else { ?>
            <div class="row">
                <div class="col-md-7">
                <button class="btn btn-secondary child"> <?php echo $bookingInfo->showDate . "&nbsp-&nbsp" 
                                . $bookingInfo->showTime; ?> </button>
                </div>
                <div class="col-md-2">
                <form name="resetShow" method="POST">
                    <input type="hidden" id="postID" name="postID" value="resetShow">
                    <button class="btn btn-secondary child" type="submit"> Reset </button>
                </form>
                </div>
            </div>
            <?php } ?>
            <h3 style="text-align: center;">Seats</h3>
            <?php 
            if($bookingInfo->selectedSeatsArray != NULL) {
                foreach($bookingInfo->selectedSeatsArray as $seat) {
                    echo "Seat " . $seat; ?>
                    <br>
            <?php } 
            }?>
        </div>

        <div class="ticketSelection">
            <p>You have selected <?php echo count($bookingInfo->selectedSeatsArray) ?> seats. Please choose your ticket types below:</p>
            <div class="ticketType">
                Adult Tickets: <?php echo $bookingInfo->adultTickets; ?> Selected
                <div class="btn-group" role="group" aria-label="test">
                    <form name='removeAdultTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='removeAdultTicket'>
                        <button type="submit" class="btn btn-secondary">-</button>
                    </form>
                    <form name='addAdultTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='addAdultTicket'>
                        <button type="submit" class="btn btn-secondary">+</button>
                    </form>
                </div>
            </div>

            <div class="ticketType">
                Child Tickets: <?php echo $bookingInfo->childTickets; ?> Selected
                <div class="btn-group" role="group" aria-label="test">
                    <form name='removeChildTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='removeChildTicket'>
                        <button type="submit" class="btn btn-secondary">-</button>
                    </form>
                    <form name='addChildTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='addChildTicket'>
                        <button type="submit" class="btn btn-secondary">+</button>
                    </form>
                </div>
            </div>

            <div class="ticketType">
                Senior Tickets: <?php echo $bookingInfo->seniorTickets; ?> Selected
                <div class="btn-group" role="group" aria-label="test">
                    <form name='removeSeniorTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='removeSeniorTicket'>
                        <button type="submit" class="btn btn-secondary">-</button>
                    </form>
                    <form name='addSeniorTicket' method='POST'>
                        <input type='hidden' id='postID' name='postID' value='addSeniorTicket'>
                        <button type="submit" class="btn btn-secondary">+</button>
                    </form>
                </div>
            </div>
            <?php 
                $childPrice = $ticketPrices["CHILD"];
                $adultPrice = $ticketPrices["ADULT"];
                $seniorPrice = $ticketPrices["SENIOR"];
                $totalPrice = $childPrice * $bookingInfo->childTickets + $adultPrice * $bookingInfo->adultTickets + $seniorPrice * $bookingInfo->seniorTickets;
            ?>
            Total Price: $ <?php echo $totalPrice; ?>
        </div>
        <form name='submitBooking' method='POST'>
            <input type='hidden' id='postID' name='postID' value='submitBooking'>
            <button type="submit" class="btn btn-secondary proceedToPayment">Add tickets to cart</button>
        </form>


        <?php // create as form, do post to this page, only process if ticket amount is correct then load payment page
              // after payment page, process the booking and send to confirmation page
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="../scripts/booking.js"></script>

</body>

</html>