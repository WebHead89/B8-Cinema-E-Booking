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

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/signin.css" rel="stylesheet">
	<link href="../css/homepage.css" rel="stylesheet">
    <title>E-Booking |Admin| Add Promo</title>
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
                        <a class="nav-link active" href="checkout.php" aria-current="page">View Cart</a>
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


<div class="centerBlock form-control">
	<main class="form-signin w-100 m-auto">
	  <form action="home.php" method="POST">
		<h1 class="h3 mb-3 fw-normal">Hello [Admin]</h1>
		<h1 class="h3 mb-3 fw-normal">Add Promotion</h1>

		<div class="form-floating">
		  <input type="text" class="form-control" id="floatingInput" placeholder="Add Promotion Name">
		  <label for="floatingInput">Add Promotion Name</label>
		</div>
		
		<div class="form-floating">
		  <input type="text" class="form-control" id="floatingInput" placeholder="Promo Code">
		  <label for="floatingPassword">Promo Code</label>
		</div>
		
		<div class="form-floating">
		  <input type="text" class="form-control" id="floatingInput" placeholder="Discount (%)">
		  <label for="floatingPassword">Discount (%)</label>
		</div>
		
		<button class="w-100 btn btn-lg btn-primary" type="submit">Confirm</button>
	  </form>
	</main>
</div>

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

    
  </body>
</html>