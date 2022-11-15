<?php

session_start();

// testing to see if users are logged in/see their ID
print_r($_SESSION);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM `movies_table` WHERE isCurrentlyPlaying = 1";
$result = $mysqli->query($sql);
$currentMovies = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `showroom_table`";
$result = $mysqli->query($sql);
$showRooms = $result->fetch_all(MYSQLI_ASSOC);
$roomNames = array_column($showRooms, "name", "idRoom");
// print_r($showRooms);

$sql = "SELECT * FROM movie_category";
$result = $mysqli->query($sql);
$category = $result->fetch_all(MYSQLI_ASSOC);

// Get all movies from movies_table
$sql = "SELECT * FROM movies_table";

$result = $mysqli->query($sql);

$num_movies = $result->num_rows;

$movie_array = [];
for ($i = 0; $i < $num_movies; $i++) {
    $movie = $result->fetch_assoc();
    $disabled = "0"; // 1 means disabled, 0 is not disabled
    // Use this for getting genre lol
    // $ratingID = $movie["categoryID"];
    // $rating = $mysqli->query("SELECT category FROM movie_category WHERE idCategory = $ratingID")->fetch_assoc();

    
    $div_start = "<div class='col-sm-4'>";
    $body = "<movie-card imgSrc='{$movie['trailerPicture']}' title='{$movie['title']}' rating='{$movie['filmRating']}' id='{$movie['idMovie']}' genre='{$movie['categoryID']}' playing='{$movie['isCurrentlyPlaying']}' disabled={$disabled} />";
    $div_end = "</div>";

    array_push($movie_array, $div_start . $body . $div_end);


}

// Example for grabing information from the database 
if (isset($_SESSION["user_id"])) {

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    // print_r("Hello " . $user["first_name"]);
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Booking Cinema System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="../css/homepage.css" rel="stylesheet">
    <script src="../components/movieCard.js" type="text/javascript" defer></script>

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
                        <a class="nav-link active" href="checkout.php" aria-current="page">View Cart</a>
                    </li>
                </ul>
                Sort Movies:
                <div class="col-md-4">
                    <form name="movieSorting">
                        <select class="form-control" id="movieCategories" , name="movieCategories" id="movieCategories" onchange="sortMovies()">
                            <option disabled="true">Sort By Category</option>
                            <option value="0">All Movies</option>
                            <?php foreach ($category as $cat) {  // pasting all categories in list 
                                echo "<option value='" . $cat["idCategory"] . "'>" . $cat["category"] . "</option>";
                            } ?>
                            <option disabled="true">Sort by available movies</option>
                            <option value="-1">Currently Playing</option>
                            <option value="-2">Coming Soon</option>
                        </select>
                        <button class="btn btn-outline-success" onclick="sortMovies(event)">Search</button>
                    </form>
                </div>
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->

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

    <div class="trailer">
        <iframe width="840" height="472.5" src="https://www.youtube.com/embed/In8fuzj3gck?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <!-- Get all movie info from movies_table db -->
    <!-- For each movie, render <div class="col-sm-4"> <movie-card> with movie info </div> -->
    <?php

    $mysqli = require __DIR__ . "/database.php";

    // Get all movies from movies_table
    $sql = "SELECT * FROM movies_table";

    $result = $mysqli->query($sql);

    $num_movies = $result->num_rows;

    echo "<div class='container'>";
    echo "<div class='row'>";

    for ($i = 0; $i < $num_movies; $i++) {
        $movie = $result->fetch_assoc();
        $disabled = "0"; // 1 means disabled, 0 is not disabled
        // Use this for getting genre lol
        // $ratingID = $movie["categoryID"];
        // $rating = $mysqli->query("SELECT category FROM movie_category WHERE idCategory = $ratingID")->fetch_assoc();

        echo "<div class='col-sm-4' name='movieCardCol'>";
        echo "<movie-card imgSrc='{$movie['trailerPicture']}' title='{$movie['title']}' rating='{$movie['filmRating']}' id='{$movie['idMovie']}' genre='{$movie['categoryID']}' playing='{$movie['isCurrentlyPlaying']}' disabled='{$disabled}' />";
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";

    ?>

    <script type="text/javascript">
        // Get all movie cards
        function sortMovies() {
            // 0 = All movies
            // 1 = Action
            // 2 = Comedy
            // 3 = Horror
            // 4 = Sci Fi
            // 5 = Romance
            // -1 = Currently Playing
            // -2 = Coming Soon

            // var movie_cards = document.getElementsByTagName("movie-card");
            // var movie_cards = document.getElementById("movieCardCol");
            var col_cards = document.getElementsByName("movieCardCol")
            var movie_cards = document.getElementsByTagName("movie-card")
            var sortingID = document.movieSorting.movieCategories.options[document.movieSorting.movieCategories.selectedIndex].value;
            console.log(movie_cards)
            console.log("Movie card length: " + movie_cards.length)
            console.log("Sorting ID: " + sortingID)

            for (let i = 0; i < movie_cards.length; i++) {

                let classListChange = col_cards[i]
                let movie = movie_cards[i]

                console.log(movie)
                console.log(classListChange)
                
                // Sort by playing status
                if (sortingID < 0) {

                    // Currently Playing
                    if (sortingID == -1) {
                        if (movie.getAttribute("playing") == "0") {
                            // movie.setAttribute("disabled", "1");
                            classListChange.classList.add("d-none");
                        } else {
                            classListChange.classList.remove("d-none");
                            // movie.setAttribute("disabled", "0");
                        }
                    }

                    // Coming Soon
                    if (sortingID == -2) {
                        if (movie.getAttribute("playing") == "1") {
                            // movie.setAttribute("disabled", "1");
                            classListChange.classList.add("d-none");
                        } else {
                            classListChange.classList.remove("d-none");
                            // movie.setAttribute("disabled", "0");
                        }
                    }

                // Show all movies
                } else if (sortingID == 0) {
                    classListChange.classList.remove("d-none");

                    // Sort by genre
                } else {

                    if (movie.getAttribute("genre") != sortingID) {
                        classListChange.classList.add("d-none");
                    } else {
                        classListChange.classList.remove("d-none");

                    }

                }
            }

            console.log(movie_cards)
            // console.log(movie_cards[2].getAttribute("genre"));
            // // var selectedCategory = document.getElementById('movieCategories').value;
            // // // console.log(selectedCategory)

            // console.log(document.movieSorting.movieCategories.selectedIndex);
            // console.log(document.movieSorting.movieCategories.options[document.movieSorting.movieCategories.selectedIndex].value);




        }
    </script>

    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>