<?php
session_start();



  $mysqli = require __DIR__ . "/database.php";

    // handle add new show
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // setting all variables from $_POST
        $movieID = $_POST["movieID"];
        $showroom = $_POST["showRoom"];
        $showdate = $_POST["showdate"];
        $showtime = $_POST["showtime"];

        // convert showRoom and showTime to showroomID and showtimeID
        // get showrooms
        $sql = "SELECT * FROM `showroom_table`";
        $result = $mysqli->query($sql);
        $showRooms = $result->fetch_all(MYSQLI_ASSOC);
        $roomNames = array_column($showRooms, "idRoom", "name"); // create an array with indices as name and value of idRoom
        // get showtimes
        $sql = "SELECT * FROM `showtime_table`";
        $result = $mysqli->query($sql);
        $showTimes = $result->fetch_all(MYSQLI_ASSOC);
        $showTimeArr = array_column($showTimes, "idShowtime", "showtime");

        $showroomID = $roomNames[$showroom];
        $showtimeID = $showTimeArr[$showtime];

        // check if time, date, room is unique
        $sql = "SELECT * FROM `show_table` WHERE showroomID = $showroomID and showtimeID = $showtimeID and date = '$showdate';";
        echo $sql;
            $result = $mysqli->query($sql);
            $result = $result->fetch_assoc();
        if($result) {
            echo '<script>alert("Show is not unique.")</script>';
        } else {
            // sql insert statement to update the database 
            $stmt = $mysqli->stmt_init();
            $stmt = $mysqli->prepare("INSERT INTO `show_table` (`date`, `movieID`, `showroomID`, `showtimeID`) 
                VALUES ('$showdate', '$movieID', '$showroomID', '$showtimeID');");
            $stmt->execute();
        }

    }

     // get currently playing movies
    $sql = "SELECT * FROM `movies_table` WHERE isCurrentlyPlaying = 1";
        $result = $mysqli->query($sql);
        $currentMovies = $result->fetch_all(MYSQLI_ASSOC);
    // get upcoming movies
    $sql = "SELECT * FROM `movies_table` WHERE isCurrentlyPlaying = 0";
        $result = $mysqli->query($sql);
        $upcomingMovies = $result->fetch_all(MYSQLI_ASSOC);
    // get shows
    $sql = "SELECT * FROM `show_table`";
        $result = $mysqli->query($sql);
        $shows = $result->fetch_all(MYSQLI_ASSOC);
    // get showrooms
    $sql = "SELECT * FROM `showroom_table`";
        $result = $mysqli->query($sql);
        $showRooms = $result->fetch_all(MYSQLI_ASSOC);
        $roomNames = array_column($showRooms, "name", "idRoom"); // create an array with indices as idRoom and value of name
    // get showtimes
    $sql = "SELECT * FROM `showtime_table`";
        $result = $mysqli->query($sql);
        $showTimes = $result->fetch_all(MYSQLI_ASSOC);
        $showTimeArr = array_column($showTimes, "showtime", "idShowtime");
    // get promotions
    $sql = "SELECT * FROM `promotions_table`";
        $result = $mysqli->query($sql);
        $promotions = $result->fetch_all(MYSQLI_ASSOC);
 

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/signin.css" rel="stylesheet">
<link href="../css/form-validation.css" rel="stylesheet">
<link href="../css/homepage.css" rel="stylesheet"> <!Only needed for background>
<title>E-Booking Edit Profile</title>



</head>

<body id="bg">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_home.php">E-Booking Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto order-0">

            </ul>

            <div class="d-flex ms-auto order-5">
                <div class="nav-item dropdown justify-content-end">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class='dropdown-item' href='logout.php'>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>



<div class="container form-control form-block">
	<div class="center my-3 gy-3">

    <div class="center text-center">
        <h1>Current Promotions</h1>
    </div>
        <?php foreach($promotions as $promo) { 
            echo "Promo Code: ";
            echo $promo["code"];
            echo "\tDiscount: ";
            echo $promo["discount"];
            ?>
            <br> <?php } ?>

        <!-- code to create a new promo -->
        <form action="process_new_promo.php" method="POST">
            <div class="row my-3 gy-3">
                <div class="col-md-4">
                    <label for="promo">Promo-Code</label>
                    <input type="text" class="form-control" id="promocode" name="promocode" required>
                </div>
                <div class="col-md-4">
                    <label for="promo">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount" required>
                </div>
            </div>
            <button class="w-20 btn btn-lg btn-primary" type="submit">Add Promotion</button><br>
        </form>

    <div class="center text-center">
	    <h1>Currently Playing Movies</h1><br>
    </div>
        <?php foreach($currentMovies as $rowMovie) { ?>
                <?php // loop to print all currently playing movies
                    $movieTitle = $rowMovie["title"];
                ?>
                <h2> <?php echo $movieTitle ?> </h2>
                <label for="cc_number" class="form-label"> Shows </label>
                </br>
                    <?php foreach($shows as $rowShow) {  // looping through all shows to print ones for this movie ?>
                        <?php 
                            // check that the show is for this movie
                            if( $rowShow["movieID"] == $rowMovie["idMovie"] ) {
                                // get the showroom name for the show
                                echo $roomNames[$rowShow["showroomID"]];
                                echo " "; // printing an extra space, temporary

                                // print show date
                                echo $rowShow["date"];
                                echo " ";

                                // get showtime for the show
                                echo $showTimeArr[$rowShow["showtimeID"]];
                                ?>
                                </br>
                                <?php
                            }
                        ?>
                    <?php } ?>

                    <!-- add code to create a new show -->
                    <form name="addShow" method="POST">
                        <?php $idMovie = $rowMovie["idMovie"]; ?>
                        <input type="hidden" id="movieID" name="movieID" value="<?php echo $idMovie; ?>">
                        <div class="row my-3 gy-3">
                            <div class="col-md-4">
                                <label for="promo">Showroom</label>
                                    <select class="form-control" id="showRoom", name="showRoom">
                                    <?php foreach($showRooms as $room) {  // pasting all showrooms in list ?>
                                        <option> <?php echo $room["name"]; ?> </option>
                                    <?php } ?>
                                    </select>
                            </div>
                            <div class="col-md-4 gy-5 center">
                                <label for="promo">Show Date</label>
                                <input type="date" id="showdate" name="showdate" required>
                            </div>
                            <div class="col-md-4">
                                <label for="promo">Showtime</label>
                                    <select class="form-control" id="showtime", name="showtime">
                                    <?php foreach($showTimes as $time) {  // pasting all showrooms in list ?>
                                        <option> <?php echo $time["showtime"]; ?> </option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div>
                        <button class="w-20 btn btn-lg btn-primary" type="submit">Add Showtime</button><br>
                    </form>


                </br>
        <?php } // end loop for displaying currentMovies ?> 
        <div class="center text-center">
            <br><h1>Upcoming Movies</h1>
        </div>
        <div class="row my-3 gy-3">
            <?php foreach($upcomingMovies as $rowMovie) { ?>
                <?php $movieTitle = $rowMovie["title"]; // loop to print all currently playing movies ?>
                <div class="col-md-9">
                    <?php echo $movieTitle ?>
                </div>
            <div class="col-md-3">
                <form action="process_add_current_movie.php" method="POST">
                    <?php $idMovie = $rowMovie["idMovie"]; ?>
                    <input type="hidden" id="movieID" name="movieID" value="<?php echo $idMovie; ?>">
                    <button class="w-20 btn btn-sm btn-primary" type="submit">Add To Current Movies</button>
                </form>
            </div>
            <br>
                <?php } ?>
            </div>
        </div>

    <button class="col-md-12 btn btn-lg btn-primary" type="submit" onclick="window.location.href = 'add_movie.php';">Create New Movie</button><br>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>