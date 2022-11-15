<?php 
session_start();

// setting all variables from $_POST
$movieID = $_POST["movieID"];

// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("UPDATE `movies_table` SET `isCurrentlyPlaying` = '1' WHERE `movies_table`.`idMovie` = $movieID;");

if($stmt->execute()) {
    header("Location: admin_home.php");
    exit;
}

?>