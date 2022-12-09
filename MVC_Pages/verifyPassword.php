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

            include __DIR__ . "../Model/Model.php";

            $model = new Model();

            if (isset($_GET['email']) && isset($_GET['emailHash'])) {
                $email = $_GET['email'];
                $emailHash = $_GET['emailHash'];

            } else {
                $email = '';
                $emailHash = '';

            }

            
            // $sql = "SELECT email, emailHash FROM user WHERE email=? AND emailHash=?";            
            // $stmt = $mysqli->prepare($sql);
            // $stmt->bind_param("ss", $email, $emailHash);
            // $stmt->execute();
            // $resulting = $stmt->get_result();
            // $user = $resulting->fetch_assoc();

            $match = $model->findUserWithEmail($email, $emailHash, $status);

            // Once the new password is submitted, update the password in the database
            if (array_key_exists('submit', $_POST)) {
                // echo 'TEST';
                $password = $_POST['password'];
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                // echo $password;
                $update = "UPDATE user SET password=? WHERE email=? AND emailHash=?";
                $stmt = $mysqli->prepare($update);
                $stmt->bind_param("sss", $password_hash, $email, $emailHash);
                $stmt->execute();
                header("Location: login.php");
            }
        ?>
        <div class="centerBlock form-control">
		<main class="form-signin w-100 m-auto">
 		<form method='POST'>
			    <h1 class="h3 mb-3 fw-normal">Change Password</h1>
             	 <label for='password' style='color: black'>New Password: </label>
            	 <input type='text' value='' name='password'><br><br>
            	 <button  class="w-100 btn btn-lg btn-primary" type='submit' name='submit'>Submit</button>
        </form>
		</main>
	    </div>
</body>
</html>

<!-- In this file, we have the user input a new password to use -->
