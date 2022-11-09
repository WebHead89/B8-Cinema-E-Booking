<?php
session_start();



  $mysqli = require __DIR__ . "/database.php";
    // get movie categories
    $sql = "SELECT * FROM `movie_category`";
    $result = $mysqli->query($sql);
    $categories = $result->fetch_all(MYSQLI_ASSOC);
    // get showrooms
    $sql = "SELECT * FROM `showroom_table`";
    $result = $mysqli->query($sql);
    $showRooms = $result->fetch_all(MYSQLI_ASSOC);
    $roomNames = array_column($showRooms, "name", "idRoom"); // create an array with indices as idRoom and value of name

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
<title>E-Booking Add Movie</title>
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

            </ul>

            <div class="d-flex ms-auto order-5">
                <div class="nav-item dropdown justify-content-end">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>



<div class="container form-control form-block">
	<div class="center">
        <div class="center text-center">
	        <h1>Add Movie</h1>
        </div>
		<form action="process_add_movie.php" method="POST">
		
		    <label for="image" class="form-label">Upload Poster Image (filepath)</label><br>
            <input type="text" class="form-control" id="image" name="image"><br>

            <label for="trailerURL" class="form-label">Trailer URL</label>
            <input type="text" class="form-control" id="trailerURL" name="trailerURL"><br>

            <label for="title" class="form-label">Movie Title</label>
            <input type="text" class="form-control" id="title" name="title"><br>

            <label for="cast" class="form-label">Movie Cast</label>
            <input type="text" class="form-control" id="cast" name="cast"><br>

            <label for="director" class="form-label">Movie Director</label>
            <input type="text" class="form-control" id="director" name="director"><br>

            <label for="producer" class="form-label">Movie Producer</label>
            <input type="text" class="form-control" id="producer" name="producer"><br>

            <label for="rating" class="form-label">Movie Film Rating</label>
            <input type="text" class="form-control" id="rating" name="rating"><br>

            <div>
              <label for="genere" class="form-label">Movie Genere</label>
				    <select class="form-control" id="genere", name="genere">
                    <?php foreach($categories as $category) {  ?>
                        <option> <?php echo $category["category"]; ?> </option>
                    <?php } ?>
				    </select>
                <br>
            </div>

            <div>
              <label for="isCurrentlyPlaying" class="form-label">Upcoming/Currently Showing</label>
                <select class="form-control" id="isCurrentlyPlaying", name="isCurrentlyPlaying">
                    <option> Upcoming </option> <!-- set isCurrentlyPlaying  to 0-->
                    <option> Currently Showing </option> <!-- set isCurrentlyPlaying  to 1-->
				</select>
                <br>
            </div>

            <label for="synopsis" class="form-label">Movie Synopsis</label>
            <textarea rows="5" class="form-control" id="synopsis" name="synopsis"></textarea><br>

            </br>
		    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Movie</button>

		</form>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>