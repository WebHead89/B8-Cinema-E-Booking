<?php
session_start();



    $mysqli = require __DIR__ . "/database.php";
    // get user information
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $userID = $user["id"];

    // get bookings for user
    $sql = "SELECT * FROM `booking_table` WHERE `customerID` = $userID;";
    $result = $mysqli->query($sql);
    $bookings = $result->fetch_all(MYSQLI_ASSOC);

    // get showrooms
    $sql = "SELECT * FROM `showroom_table`";
    $result = $mysqli->query($sql);
    $showRooms = $result->fetch_all(MYSQLI_ASSOC);
    $roomNamesArr = array_column($showRooms, "name", "idRoom"); // create an array with indices as idRoom and value of name

    // get showtimes
    $sql = "SELECT * FROM `showtime_table`";
    $result = $mysqli->query($sql);
    $showTimes = $result->fetch_all(MYSQLI_ASSOC);
    $showTimeArr = array_column($showTimes, "showtime", "idShowtime");
    

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/signin.css" rel="stylesheet">
<link href="../css/form-validation.css" rel="stylesheet">
<link href="../css/homepage.css" rel="stylesheet"> 
<title>E-Booking Edit Profile</title>
</head>

<body id="bg">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">E-Booking Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto order-0">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php" aria-current="page">Home</a>
                </li>
                <li>
                    <a class="nav-link active" href="viewBookings.php" aria-current="page">View Bookings</a>
                </li>
            </ul>

            <!-- </div> -->
            <div class="d-flex ms-auto order-5">
                <div class="nav-item dropdown justify-content-end">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        if (isset($_SESSION["user_id"])) {
                            echo "<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>";
                            echo "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<li><a class='dropdown-item' href='login.php'>Login</a></li>";
                            echo "<li><a class='dropdown-item' href='signup.html'>Register</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>



<div class="container form-control form-block">
    <h1> Bookings </h1>
    <hr class="my-4">

    <?php   
        if($bookings) {
            foreach($bookings as $booking) {
                // print booking
                echo "BookingID: " . $booking["idBooking"] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Total Price: $" . $booking["totalPrice"] . "<br>";
                // print show, date, time, room
                    // get the show
                    $showID = $booking["showID"];
                    $sql = "SELECT * FROM `show_table` WHERE `idShow` = $showID;";
                    $result = $mysqli->query($sql);
                    $show = $result->fetch_assoc();
                    $showTime = $show["showtimeID"];
                    $showRoom = $show["showroomID"];

                    // get the movie
                    $movieID = $show["movieID"];
                    $sql = "SELECT * FROM `movies_table` WHERE `idMovie` = $movieID";
                    $result = $mysqli->query($sql);
                    $movie = $result->fetch_assoc();
                echo "ShowID: " . $showID . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Movie: " . $movie["title"] 
                    . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowDate: " . $show["date"] 
                    . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowTime: " . $showTimeArr[$showTime]
                    . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowRoom: " . $roomNamesArr[$showRoom] . "<br>";
                // print tickets
                echo "Tickets<br>";
                    // get the tickets
                    $bookingID = $booking["idBooking"];
                    $sql = "SELECT * FROM `tickets_table` WHERE `bookingID` = $bookingID";
                    $result = $mysqli->query($sql);
                    $tickets = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($tickets as $ticket) {
                        echo "Seat: " . $ticket["seatNumber"] . "<br>";
                    }

                echo "<hr class='my-4'>";

            }
        } else {
            echo "No bookings.";
        }
    ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>