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
<title>E-Booking |Admin| Manage Movie</title>
</head>

<body class="text-center" id="bg">
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


<div class="container form-control form-block">
	<div class="center">
	<h1>Add Movie</h1>
		<form action="home.php" method="POST">
		
			<br><button type="button" class="btn btn-primary">Upload Poster Image</button><br><br>

			<div>
              <label for="trailerURL" class="form-label">Trailer URL</label>
              <input type="text" class="form-control" id="trailerURL">
              <div class="invalid-feedback">
                Valid trailer URL
              </div>
            </div>

            <div>
              <label for="title" class="form-label">Movie Title</label>
              <input type="text" class="form-control" id="title">
              <div class="invalid-feedback">
                Valid movie title is required.
              </div>
            </div>

            <div>
              <label for="cast" class="form-label">Movie Cast</label>
              <input type="text" class="form-control" id="cast">
              <div class="invalid-feedback">
                Valid cast names is required.
              </div>
            </div>
		
            <div>
              <label for="director" class="form-label">Movie Director</label>
              <input type="text" class="form-control" id="director">
              <div class="invalid-feedback">
                Valid director name is required.
              </div>
            </div>

            <div>
              <label for="producer" class="form-label">Movie Producer</label>
              <input type="text" class="form-control" id="producer">
              <div class="invalid-feedback">
                Valid producer name is required.
              </div>
            </div>

            <div>
              <label for="synopsis" class="form-label">Movie Synopsis</label>
              <input type="text" class="form-control" id="synopsis">
              <div class="invalid-feedback">
                Valid synopsis is required.
              </div>
            </div>

            <div>
              <label for="rating" class="form-label">Movie Film Rating</label>
              <input type="text" class="form-control" id="rating">
              <div class="invalid-feedback">
                Valid rating is required.
              </div>
            </div>

            <div>
              <label for="genere" class="form-label">Movie Genere</label>
				    <select class="form-control" id="genere", name="genere">
                    <?php foreach($categories as $category) {  ?>
                        <option> <?php echo $category["category"]; ?> </option>
                    <?php } ?>
				    </select>
            </div>

            <div>
              <label for="isCurrentlyPlaying" class="form-label">Upcoming/Currently Showing</label>
                <select class="form-control" id="isCurrentlyPlaying", name="isCurrentlyPlaying">
                    <option> Upcoming </option> <!-- set isCurrentlyPlaying  to 0-->
                    <option> Currently Showing </option> <!-- set isCurrentlyPlaying  to 1-->
				</select>
            </div>
		
		
		

            </br>
		    <button class="w-100 btn btn-lg btn-primary" type="submit">Add Movie</button>

		</form>
		
	
	
	
	</div>
</div>


<script>
function openTab(evt, name) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(name).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>

<script type="text/javascript">
document.getElementById("Th1").click();
</script>

</body>
</html>