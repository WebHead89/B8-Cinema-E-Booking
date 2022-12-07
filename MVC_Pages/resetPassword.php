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
<link href="../css/signin.css" rel="stylesheet">
<link href="../css/homepage.css" rel="stylesheet">
<title>E-Booking Password Reset</title>
</head>

<body id="bg">

<?php

echo $view->getResetPassword();


?>

<script>
</script>

</body>
</html>