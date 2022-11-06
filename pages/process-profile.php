<?php 
session_start();

// setting all variables from $_POST
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$phone=$_POST["phone"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$id=$_SESSION["user_id"];

// Password hash to store credit card # securely
$cc_hash = password_hash($_POST["cc_number"], PASSWORD_DEFAULT);

// Password hash to store password securely
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Set promo value to a variable
if ($_POST["promo"] == "Yes") {
    $promo = 1;
} else {
    $promo = 0;
}


// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("UPDATE user SET first_name='$first_name', last_name='$last_name', phone='$phone', password='$password_hash', promo='$promo', address='$address', city='$city', state='$state', zip='$zip' WHERE id='$id'");




if($stmt->execute()) {
    header("Location: editprofile.php");
    exit;
}

?>
