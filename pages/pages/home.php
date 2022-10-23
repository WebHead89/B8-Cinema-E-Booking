<?php

session_start();

// testing to see if users are logged in/see their ID
print_r($_SESSION);

// Example for grabing information from the database 
if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    print_r("Hello " . $user["first_name"]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Booking Cinema System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
                <div class="mx-auto">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search Movies"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
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

    <div class="trailer">
        <iframe width="840" height="472.5" src="https://www.youtube.com/embed/In8fuzj3gck?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/avatar.jpg" alt="Avatar">
                    <div class="card-body">
                        <h5 class="card-title">Avatar (PG-13)</h5>
                        <a href="booking.html" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/avengers.jpg" alt="Avengers">
                    <div class="card-body">
                        <h5 class="card-title">Avengers (PG-13)</h5>
                        <a href="#" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/topgun.jpg" alt="Top Gun: Maverick">
                    <div class="card-body">
                        <h5 class="card-title">Top Gun: Maverick (PG-13)</h5>
                        <a href="#" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/northman.jpg" alt="Prey">
                    <div class="card-body">
                        <h5 class="card-title">The Northman (R)</h5>
                        <a href="#" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/rogueone.jpg" alt="Rogue One">
                    <div class="card-body">
                        <h5 class="card-title">Rogue One (PG-13)</h5>
                        <a href="#" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <img class="card-img-top" src="../assets/elvis.jpg" alt="Elvis">
                    <div class="card-body">
                        <h5 class="card-title">Elvis (PG-13)</h5>
                        <a href="#" class="btn btn-primary">Buy Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>