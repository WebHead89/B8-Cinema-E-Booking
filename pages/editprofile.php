<?php
session_start();



  $mysqli = require __DIR__ . "/database.php";
  // get user information
  $sql = "SELECT * FROM user
          WHERE id = {$_SESSION["user_id"]}";
          $result = $mysqli->query($sql);

          $user = $result->fetch_assoc();

$first_name = $user["first_name"];
$last_name = $user["last_name"];
$phone = $user["phone"];
$password = $user["password"];
$address = $user["address"];
$city = $user["city"];
$state = $user["state"];
$zip = $user["zip"];

// get payment card info
$counter = 0;
$sql = "SELECT * FROM payment_card_table
        WHERE userID = {$_SESSION["user_id"]}";
        $result = $mysqli->query($sql);

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
<title>E-Booking Edit Profile</title>
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
	<h1>Hello <?php echo $first_name ?></h1>
		<form action="process-profile.php" method="POST">
		
			<div class="col-sm-6">
              <label for="first_name" class="form-label">Edit First name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name ?>">
            </div>

            <div class="col-sm-6">
              <label for="last_name" class="form-label">Edit Last name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name ?>">
      </div>
		
		<label for="phone">Edit phone number:<br></label>
		<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
		
		<label for="floatingPassword">Edit password:</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
		
		<label for="floatingPassword">Confirm password:</label>
		<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="<?php echo $password ?>">
		<br>

    <label for="promo">Sign up for promotion?</label>
				<select class="form-control" id="promo", name="promo">
					<option>Yes</option>
					<option>No</option>
				</select>
		
    <h2>Edit Billing Address</h2>

    <div class="my-3">

      <div class="row gy-3">

        <div class="col-md-6">
          <label for="address" class="form-label">Address Line:</label>
          <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
        </div>

        <div class="col-md-6">
          <label for="city" class="form-label">City:</label>
          <input type="text" class="form-control" id="city" name="city" value="<?php echo $city ?>">
        </div>

        <div class="col-md-6">
          <label for="state" class="form-label">State:</label>
          <input type="text" class="form-control" id="state" name="state" value="<?php echo $state ?>">
        </div>

        <div class="col-md-3">
          <label for="zip" class="form-label">Zip Code:</label>
          <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $zip ?>">
        </div>

      </div>



</div>


		
		<h2>Save Payment Information</h2>

		<div class="my-3">

          <div class="row gy-3">
            <?php while($row = $result->fetch_assoc()) { ?>
              <?php
                $counter++;
                $idPaymentCard = $row["idPaymentCard"]; // use this to update the database
                $cardNum = $row["cardNum"];
                $expireDate = $row["experationDate"];
              ?>

              <div class="col-md-6">
                <label for="cc_number" class="form-label">Credit card number</label>
                <input type="text" class="form-control" id="cc_number" name="cc_number" value="<?php echo $cardNum ?>">
              </div>

              <div class="col-md-3">
                <label for="cc_expiration" class="form-label">Expiration</label>
                <input type="text" class="form-control" id="cc_expiration" name="cc_expiration" value="<?php echo $expireDate ?>">
              </div>

            <?php } ?>
          </div>

          <?php if($counter != 3) { ?>
            <?php // if the textboxes are not null then create a new row in the table for credit cards ?>
            <div class="row gy-3">

              <div class="col-md-6">
                <label for="cc_number" class="form-label">Credit card number</label>
                <input type="text" class="form-control" id="cc_number" name="cc_number" >
              </div>

              <div class="col-md-3">
                <label for="cc_expiration" class="form-label">Expiration</label>
                <input type="text" class="form-control" id="cc_expiration" name="cc_expiration" >
              </div>

            </div>
          
          <?php } ?>
    </div>
		
		<button class="w-100 btn btn-lg btn-primary" type="submit">Confirm</button>

		</form>
		
	
	
	
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>

</body>
</html>