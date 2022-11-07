<?php 
session_start();

// setting all variables from $_POST
$posterImage=$_POST["image"];
$trailerURL=$_POST["trailerURL"];
$title=$_POST["title"];
$cast=$_POST["cast"];
$director=$_POST["director"];
$producer=$_POST["producer"];
$rating=$_POST["rating"];
$genere=$_POST["genere"];
$isCurrentlyPlaying=$_POST["isCurrentlyPlaying"];
$synopsis=$_POST["synopsis"];

// copy file to website folder


// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("UPDATE user SET first_name='$first_name', last_name='$last_name', phone='$phone', password='$password_hash', promo='$promo', address='$address', city='$city', state='$state', zip='$zip' WHERE id='$id'");



// return to admin home page
if($stmt->execute()) {
    header("Location: admin_home.php");
    exit;
}

?>