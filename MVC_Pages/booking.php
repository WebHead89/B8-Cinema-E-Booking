<?php
    include("View/User_View/View.php");
    session_start();

    // user cannot book seats if they are not logged into an account
    if (!isset($_SESSION["user_id"])) { 
        echo "invalid";
        header("Location: login.php");
    }

    // get movie id
    $movieID = $_GET["movieID"];

    // set booking movieID variable
    if (!isset($_SESSION['bookingInfo'])) {
        $_SESSION['bookingInfo'] = Singleton::getInstance();
    }
    $bookingInfo = $_SESSION['bookingInfo'];
    $bookingInfo->movieID = $movieID;

    if($bookingInfo->movieID != $movieID) {
        echo "DIfferent movie";
        $bookingInfo->showID = -1;
    }

    $view = new View();
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

    <?php
        // print navbar
        echo $view->getUserNavBar_NotHome();

        // print seats
        echo $view->getMovieSeats($movieID);
    ?>

    <div class="column booking">
        <?php
            // print showtimes
            echo $view->getShowtimes($movieID);

            // print ticket types
            echo $view->getSelectedSeats();

            // print add tickets
            echo $view->getTicketSelector();

        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="../scripts/booking.js"></script>

</body>

</html>