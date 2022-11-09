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
$filename = basename($posterImage);
$filepath = "assets/" . $filename;
copy($posterImage, $filepath);
$filepath = "pages/" . $filepath;


// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// get isCurrentlyPlaying and genere
if($isCurrentlyPlaying == "Upcoming") {
    $x = 0;
} else {
    $x = 1;
}

// get movie categories
$sql = "SELECT * FROM `movie_category`";
$result = $mysqli->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);
$generes = array_column($categories, "idCategory", "category");
$genereID = $generes[$genere];

// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$sql = "INSERT INTO `movies_table`(`title`, `cast`, `director`, `producer`, `synopsis`, `trailerPicture`, `trailerVideo`, `filmRating`, `categoryID`, `isCurrentlyPlaying`) 
        VALUES ('{$title}','{$cast}','{$director}','{$producer}','{$synopsis}','{$filepath}','{$trailerURL}','{$rating}','{$genereID}','{$x}')";
$stmt = $mysqli->prepare($sql);



// return to admin home page
if($stmt->execute()) {
    header("Location: admin_home.php");
    exit;
}

?>