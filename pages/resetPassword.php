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

<div class="centerBlock form-control">
	<main class="form-signin w-100 m-auto">
	<h1 style="color:white;font-size:20px;">Fill in the following field(s) to get a link to reset your password</h1>

	<form action="sendPassword.php" method="POST">
	<div class="form-floating">

	  <input type='text' class='form-control' id='email' name='email'><br>
        <label for='email'>Current Email:  </label>  
	</div>

      <button type='submit' class="w-100 btn btn-lg btn-primary">Send Password Reset Link</button>

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
