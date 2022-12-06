<?php
include("View/Admin_View/View.php");
include("Controller/Controller.php");
session_start();

$view = new View();
$controller = new Controller();

// check to make sure showtime is unique
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // setting all variables from $_POST
    $movieID = $_POST["movieID"];
    $showroom = $_POST["showRoom"];
    $showdate = $_POST["showdate"];
    $showtime = $_POST["showtime"];

    // call controller to add new show time, if not unique display alert
    if($controller->addNewShow($movieID, $showroom, $showdate, $showtime) == -1) {
        echo '<script>alert("Show is not unique.")</script>';
    }
}

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
<title>E-Booking Admin Home</title>
</head>

<body id="bg">

    <?php
    // display the navbar
    echo $view->getAdminNavbar();
    ?>

    <div class="container form-control form-block">
        <div class="center my-3 gy-3">

            <?php

            // display promotions
            echo $view->displayPromotions();

            // display current movies
            echo $view->getCurrentMovies();

            // display upcoming movies
            echo $view->getUpcomingMovies();

            // display button to add a new movie
            echo $view->addNewMovie();

            ?>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>