<?php 
session_start();
// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// setting all variables from $_POST
$movieID = $_POST["movieID"];
$showroom = $_POST["showRoom"];
$showdate = $_POST["showdate"];
$showtime = $_POST["showtime"];

// convert showRoom and showTime to showroomID and showtimeID
// get showrooms
 $sql = "SELECT * FROM `showroom_table`";
 $result = $mysqli->query($sql);
 $showRooms = $result->fetch_all(MYSQLI_ASSOC);
 $roomNames = array_column($showRooms, "idRoom", "name"); // create an array with indices as name and value of idRoom
// get showtimes
$sql = "SELECT * FROM `showtime_table`";
$result = $mysqli->query($sql);
$showTimes = $result->fetch_all(MYSQLI_ASSOC);
$showTimeArr = array_column($showTimes, "idShowtime", "showtime");

$showroomID = $roomNames[$showroom];
$showtimeID = $showTimeArr[$showtime];


// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("INSERT INTO `show_table` (`date`, `movieID`, `showroomID`, `showtimeID`) VALUES ('$showdate', '$movieID', '$showroomID', '$showtimeID');");

if($stmt->execute()) {
    header("Location: admin_home.php");
    exit;
}

?>