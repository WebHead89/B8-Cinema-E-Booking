<?php
include("View/User_View/View.php");
session_start();

$view = new View();
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/signin.css" rel="stylesheet"> <!Glitches without this stylesheet even though it's not needed>
<link href="../css/form-validation.css" rel="stylesheet">
<link href="../css/homepage.css" rel="stylesheet"> <!Only needed for background>
<title>E-Booking Checkout Confirmation</title>
</head>

<body id="bg">
<?php
    // display the navbar
    echo $view->getUserNavBar_NotHome();
?>

<div class="centerText">
	<h1 style="color:white;">Order has been placed!</h1>

	<form action="home.php" method="POST">
		<button class="w-100 btn btn-lg btn-primary" type="submit">Back to Home</button>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>