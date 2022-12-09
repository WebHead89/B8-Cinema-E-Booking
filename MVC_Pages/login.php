<?php
include("View/Guest_View/View.php");
session_start();
$invalid_login = 0;
if (isset($_GET["invalid_login"])) {
  
  $invalid_login = $_GET["invalid_login"];
  // echo $invalid_login;
  if ($invalid_login == 1) {
    echo '<script type="text/JavaScript">
          				alert("Invalid log in.");
        			</script>';

  }
  if ($invalid_login == 2) {
    echo '<script type="text/JavaScript">
          				alert("Email not verified.");
        			</script>';

  }
}

$view = new View();
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

<?php

// display the navbar
echo $view->getNavbar();

// display the form
echo $view->getLogin();

?>

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