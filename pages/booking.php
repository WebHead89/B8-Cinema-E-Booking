<?php
    session_start();

    // setup connection to db
    $mysqli = require __DIR__ . "/database.php";
   

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
                <div class="open_seat" id="seat1" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat2" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat3" onclick="selectSeat(this.id)"></div>
            </div>
            <div class="row second">
                <div class="open_seat" id="seat4" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat5" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat6" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat7" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat8" onclick="selectSeat(this.id)"></div>
            </div>
            <div class="row second">
                <div class="open_seat" id="seat9" onclick="selectSeat(this.id)"></div>
                <div class="unavailable_seat" id="seat10" onclick="selectSeat(this.id)"></div>
                <div class="unavailable_seat" id="seat11" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat12" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat13" onclick="selectSeat(this.id)"></div>
            </div>
            <div class="row third">
                <div class="open_seat" id="seat14" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat15" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat16" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat17" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat18" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat19" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat20" onclick="selectSeat(this.id)"></div>


            </div>
            <div class="row third">
                <div class="open_seat" id="seat21" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat22" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat23" onclick="selectSeat(this.id)"></div>
                <div class="unavailable_seat" id="seat24" onclick="selectSeat(this.id)"></div>
                <div class="unavailable_seat" id="seat25" onclick="selectSeat(this.id)"></div>
                <div class="unavailable_seat" id="seat26" onclick="selectSeat(this.id)"></div>
                <div class="open_seat" id="seat27" onclick="selectSeat(this.id)"></div>

            </div>
        </div>
    </div>

    <div class="column booking">
        <h3 style="text-align: center;">Showtimes</h3>
        <div class="showtimes">
            <a href="#" class="btn btn-secondary child">6:45 - 8:00 PM</a>
            <a href="#" class="btn btn-secondary child">8:15 - 9:30 PM</a>
            <a href="#" class="btn btn-secondary child">9:45 - 11:00 PM</a>
            <a href="#" class="btn btn-secondary child">11:15 - 12:30 AM</a>



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