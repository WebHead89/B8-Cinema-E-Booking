<?php
include("View/Guest_View/View.php");
session_start();

$view = new View();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/signin.css" rel="stylesheet">
	<link href="../css/homepage.css" rel="stylesheet">
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
	<title>E-Booking Sign Up</title>
</head>

<body class="text-center" id="bg">

<?php

// display the navbar
echo $view->getNavbar();

// display the form
echo $view->getSignUp();

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

</body>
</html>