<?php
include("view/User_view/View.php");
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
    <title> Password Change </title>
    </head>

<body class="text-center" id="bg">

<?php

echo $view ->getVerifyPassword(); 

?>

</body>
</html>