<?php
include("View/Guest_View/View.php");
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
<title>Sign up Success</title>
</head>

<body id="bg">

<?php

echo $view->getSignupSuccess();


?>




<script>
</script>

</body>
</html>