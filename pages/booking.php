<?php
    include("Singleton.php");
    session_start();

    $bookingInfo = Singleton::getInstance();

    // get movie id
    $movieID = $_GET["movieID"];

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

    if(isset($_POST['postID'])) {
        // if the POST is for selecting the showtime
        if($_POST['postID'] == "showtimeBookingPage") {
            // set the showID, date, and time
            $bookingInfo->showID = $_POST['showID'];
            $bookingInfo->showDate = $_POST['showDate'];
            $bookingInfo->showTime = $_POST['showTime'];

            // get seats from the database
            $sql = "SELECT * FROM `seats_table` WHERE `showID` = $bookingInfo->showID";
                $result = $mysqli->query($sql);
                $seats = $result->fetch_all(MYSQLI_ASSOC);

            // set the buttonTypeArray
            for($i = 0; $i < 27; $i++) {
                if($seats[$i]["isReserved"]) {
                    $bookingInfo->buttonTypeArray[$i] = 1;
                }
            }

        }

        // if the post is for slecting a seat

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
                for($i; $i < 3; $i++) { 
                    if ($bookingInfo->buttonTypeArray[$i] == 1) { 
                        echo "<button type='button' class='unavailable_seat'></button>";
                    } else if ($bookingInfo->buttonTypeArray[$i] == 2) {
                        echo "<button type='button' class='open_seat'></button>";
                    } else {
                        echo "<button type='button' class='selected_seat'></button>";
                    } ?>
                <?php } ?>
            </div>
            <div class="row second">
                <?php 
                $i = 3;
                for($i; $i < 8; $i++) { 
                    if ($bookingInfo->buttonTypeArray[$i] == 1) { 
                        echo "<button type='button' class='unavailable_seat'></button>";
                    } else if ($bookingInfo->buttonTypeArray[$i] == 2) {
                        echo "<button type='button' class='open_seat'></button>";
                    } else {
                        echo "<button type='button' class='selected_seat'></button>";
                    } ?>
                <?php } ?>
            </div>
            <div class="row second">
                <?php 
                $i = 8;
                for($i; $i < 13; $i++) { 
                    if ($bookingInfo->buttonTypeArray[$i] == 1) { 
                        echo "<button type='button' class='unavailable_seat'></button>";
                    } else if ($bookingInfo->buttonTypeArray[$i] == 2) {
                        echo "<button type='button' class='open_seat'></button>";
                    } else {
                        echo "<button type='button' class='selected_seat'></button>";
                    } ?>
                <?php } ?>
            </div>
            <div class="row third">
                <?php 
                $i = 13;
                for($i; $i < 20; $i++) { 
                    if ($bookingInfo->buttonTypeArray[$i] == 1) { 
                        echo "<button type='button' class='unavailable_seat'></button>";
                    } else if ($bookingInfo->buttonTypeArray[$i] == 2) {
                        echo "<button type='button' class='open_seat'></button>";
                    } else {
                        echo "<button type='button' class='selected_seat'></button>";
                    } ?>
                <?php } ?>
            </div>
            <div class="row third">
                <?php 
                $i = 20;
                for($i; $i < 27; $i++) { 
                    if ($bookingInfo->buttonTypeArray[$i] == 1) { 
                        echo "<button type='button' class='unavailable_seat'></button>";
                    } else if ($bookingInfo->buttonTypeArray[$i] == 2) {
                        echo "<button type='button' class='open_seat'></button>";
                    } else {
                        echo "<button type='button' class='selected_seat'></button>";
                    } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="column booking">

        <h3 style="text-align: center;">Showtimes</h3>
        <div class="showtimes">
        <?php  if(isset($_POST['postID'])) {
            if($_POST['postID'] == "showtimeBookingPage") { ?>
                <button class="btn btn-secondary child"> <?php echo $bookingInfo->showDate . "&nbsp-&nbsp" 
                                . $bookingInfo->showTime; ?> </button>
            <?php } } else { ?>
                <?php foreach($shows as $show) { ?>
                    <form name="addShow" method="POST">
                        <input type="hidden" id="postID" name="postID" value="showtimeBookingPage">
                        <input type="hidden" id="showID" name="showID" value="<?php echo $show["idShow"]; ?>">
                        <input type="hidden" id="showDate" name="showDate" value="<?php echo $show["date"]; ?>">
                        <input type="hidden" id="showTime" name="showTime" value="<?php echo $showTimeArr[$show["showtimeID"]]; ?>">
                        <button class="btn btn-secondary child" type="submit"> <?php echo $show["date"] . "&nbsp-&nbsp" 
                                . $showTimeArr[$show["showtimeID"]]; ?> </button>
                    </form>
                <?php } ?>
            <?php } ?>
            <h3 style="text-align: center;">Tickets</h3>
        </div>

        <div class="ticketSelection">
            <p>You have selected X seats. Please choose your ticket types below:</p>
            <div class="ticketType">
                Adult Tickets: X Selected
                <div class="btn-group" role="group" aria-label="test">
                    <button type="button" class="btn btn-secondary">-</button>
                    <button type="button" class="btn btn-secondary">+</button>
                </div>
            </div>

            <div class="ticketType">
                Child Tickets: X Selected
                <div class="btn-group" role="group" aria-label="test">
                    <button type="button" class="btn btn-secondary">-</button>
                    <button type="button" class="btn btn-secondary">+</button>
                </div>
            </div>

            <div class="ticketType">
                Senior Tickets: X Selected
                <div class="btn-group" role="group" aria-label="test">
                    <button type="button" class="btn btn-secondary">-</button>
                    <button type="button" class="btn btn-secondary">+</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary proceedToPayment">Add tickets to cart</button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="../scripts/booking.js"></script>

</body>

</html>