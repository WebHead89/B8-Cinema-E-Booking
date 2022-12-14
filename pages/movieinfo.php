<?php
    session_start();

    // setup connection to db
    $mysqli = require __DIR__ . "/database.php";
    // get POST vairables
    $id = $_POST["movieID"];

    // get movie categories
    $sql = "SELECT * FROM `movie_category`";
        $result = $mysqli->query($sql);
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        $genere = array_column($categories, "category", "idCategory");

    // get showtimes
    $sql = "SELECT * FROM `showtime_table`";
        $result = $mysqli->query($sql);
        $showTimes = $result->fetch_all(MYSQLI_ASSOC);
        $showTimeArr = array_column($showTimes, "showtime", "idShowtime");

    // get movie row from database
    $sql = "SELECT * FROM `movies_table` WHERE idMovie = $id";
        $result = $mysqli->query($sql);
        $movieArr = $result->fetch_all(MYSQLI_ASSOC);
        $movie = $movieArr[0];

    // get shows
    $sql = "SELECT * FROM `show_table` WHERE movieID = $id;";
        $result = $mysqli->query($sql);
        $shows = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>More Information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/homepage.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
                        <a class="nav-link active" href="checkout.php" aria-current="page">View Cart</a>
                    </li>
                </ul>

                <div class="d-flex ms-auto order-5">
                    <div class="nav-item dropdown justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="row">
        <div class="col-md-1">
            <!Buffer spacing using bootstrap format>
        </div>
        <div class="col-md-12">
            <iframe width="840" height="472.5" src="<?php echo $movie["trailerVideo"]; ?>" title="YouTube video player"
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
            
    </div>

    <div class="container form-control form-block">
        <div class="row">
            <div class="center text-center">
	            <p style="font-size:45px;"> <?php echo $movie["title"]; ?> </p>
            </div><br>

            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h5>Description:</h5> 
                <p> <?php echo $movie["synopsis"]; ?> </p>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Movie Genre:</h5>
            </div>
            <div class="col-md-9">
                <p> <?php echo $genere[$movie["categoryID"]]; ?> </p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Director:</h5>
            </div>
            <div class="col-md-9">
                <p> <?php echo $movie["director"]; ?> </p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Movie Cast:</h5>
            </div>
            <div class="col-md-9">
                <p> <?php echo $movie["cast"]; ?> </p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Movie Status: </h5>
            </div>
            <div class="col-md-9">
                <?php if($movie["isCurrentlyPlaying"]) { ?>
                    <p> Currently Playing </p>
                <?php } else { ?>
                    <p> Upcoming </p>
                <?php } ?>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Showtimes:</h5>
            </div>

            <div class="col-md-4">
                <select class="form-control" id="showtime", name="showtime">
                    <?php foreach($shows as $show) {  ?>
                        <option> <?php echo $show["date"]; echo  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; 
                            echo $showTimeArr[$show["showtimeID"]]; ?> </option>
                    <?php } ?>	
                </select>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a href="booking.php?movieID=<?php echo $id ?>" class="btn btn-primary">Buy Tickets</a>
            </div>
                <br><br><br>
        </div>

    </div>

</body>


</html>