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

<div class="centerText">
	<h1 style="color:white;">Fill in the following field(s) to get a link to reset your password</h1>

	<form action="sendPassword.php" method="POST">
        <label for='email' style='color: white'>Current Email:  </label>
        <input type='text' id='email' name='email'><br><br>
        <button type='submit'>Send Password Reset Link</button>
	</form>

</div>

<script>
</script>

</body>
</html>

<!-- 
    If they forget password:
    1. They enter their email
    2. They get an email with a link to resetPassword.php
    3. They enter their new password
    4. They get redirected to login.php
-->
