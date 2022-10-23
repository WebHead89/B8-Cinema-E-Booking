<?php
//php to connect to server and check validation upon submitting the login
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

      if (password_verify($_POST["password"], $user["password"])) {

        session_start();

        $_SESSION["user_id"] = $user["id"];

        header("Location: home.php");

      }
      
    }
    
    $is_invalid = true;
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/signin.css" rel="stylesheet">
	<link href="../css/homepage.css" rel="stylesheet">
    <meta name="generator" content="Hugo 0.101.0">
    <title>E-Booking Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

    

    




    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
</head>
  
  
<body class="text-center" id="bg">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.html">E-Booking Cinema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto order-0">
                <li class="nav-item">
                    <a class="nav-link active" href="home.html" aria-current="page">Home</a>
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
                        <li><a class="dropdown-item" href="login.html">Login</a></li>
                        <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>


<div class="centerBlock form-control">
	<main class="form-signin w-100 m-auto">
	  <form method="post">
		<h1 class="h3 mb-3 fw-normal">Login</h1>

    <?php if ($is_invalid): ?>
  <em>Invalid Login</em>
  <?php endif; ?>

		<div class="form-floating">
		  <input type="email" class="form-control" id="email" name="email">
		  <label for="floatingInput">Email address</label>
		</div>
		<div class="form-floating">
		  <input type="password" class="form-control" id="password" name="password">
		  <label for="floatingPassword">Password</label>
		</div>
		
		<input type="checkbox" onclick="myFunction()">Show Password
		
		<button class="w-100 btn btn-lg btn-primary">Sign in</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
    
  </body>
</html>