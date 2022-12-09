<?php
include("View/User_View/View.php");
session_start();

$view = new View();
$id = $_POST["movieID"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Booking Movie Info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/homepage.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body id="bg">

    <?php
        // display navbar
        echo $view->getUserNavbar_NotHome();

        // display movie info
        echo $view->getMovieInfo($id);
    ?>

</body>


</html>