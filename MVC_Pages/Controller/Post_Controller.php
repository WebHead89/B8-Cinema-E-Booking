<?php
    include __DIR__ . "/../Model/Model.php";
    $model = new Model();

    if(isset($_POST['postID'])) {

        // POST to add a new movie
        if($_POST['postID'] == "addMovie") {
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
            $filepath = "Assets/" . $filename;
            copy($posterImage, $filepath);
            $filepath = "MVC_Pages/Controller/" . $filepath;

            // get isCurrentlyPlaying and genere
            if($isCurrentlyPlaying == "Upcoming") {
                $x = 0;
            } else {
                $x = 1;
            }

            // get movie categories
            $categories = $model->getMovieCategories();
            $generes = array_column($categories, "idCategory", "category");
            $genereID = $generes[$genere];

            // sql insert statement to update the database 
            $model->addNewMovie($title, $cast, $director, $producer, $synopsis, $filepath, $trailerURL, $rating, $genereID, $x);

            // redirect to admin home
            header("Location: admin_home.php");
        } // add movie


        // POST to add a new promotion
        if($_POST['postID'] == "addPromotion") {
            // setting all variables from $_POST
            $promo = $_POST["promocode"];
            $discount = $_POST["discount"];

            // get all the emails
            $emailAccounts = $model->getEmails();

            // sql insert statement to update the database 
            $model->addNewPromo($promo, $discount);

            // add code here to send emails to all users in $emailaccouts
            foreach($emailAccounts as $account) {
                // send email to each account
                echo $account["email"];
                $email = $account['email'];
                $subject = "Promo Code";
                $message = "Your promo code is: $promo and your discount is: $discount";
                $headers = "From:ebookingcinema2022@gmail.com" . "\r\n";
                if (mail($email, $subject, $message, $headers)) {
                    echo "Email successfully sent to $email...";
                } else {
                    echo "Email sending failed...";
                }
            }

            header("Location: ../admin_home.php");

        } // addPromotion

        if($_POST['postID'] == "updateToCurrentlyPlaying") {
            // setting all variables from $_POST
            $movieID = $_POST["movieID"];
            $model->addCurrentMovie($movieID);
            header("Location: ../admin_home.php");
        } // updateToCurrentlyPlaying


	  if($_POST['postID'] == "signup") {
	  	// Server-side validation to make sure name is not NULL
		if (empty($_POST["first_name"])) {
			die("First name is requied");
		}
		if (empty($_POST["last_name"])) {
    			die("Last name is requied");
		}

		// Server-side validation to check for valid email
		if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			die("Valid email is required");
		}

		// Server-side validation to see if password is more than 8 char
		if (strlen($_POST["password"]) < 8) {
		    die("Password must be at least 8 characters");
		}

		// Validation to check if passwords match
		if ($_POST["password"] !== $_POST["password_confirmation"]) {
		    die("Passwords must match");
		}
		// setting all variables from $_POST

		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];

		// Password hash to store passwords securely
		$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

		// Set promo value to a variable
		if ($_POST["promo"] == "Yes") {
		    $promo = 1;
		} else {
		    $promo = 0;
		}

		// Generates random 32 char hash for email verification
		$hash = md5( rand(0, 1000));
		echo $hash;

		// Email verification
		$to = $_POST['email'];
		$subject = 'Signup | Verification';
		$message = '
		Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		------------------------
		Username: '.$_POST['email'].'
		Password: '.$_POST['password'].'
		------------------------
		Please click this link to activate your account:
		http://localhost/EBookDemo/B8-Cinema-E-Booking/pages/verify.php?email='.$_POST['email'].'&emailHash='.$hash.'
		';
		
		$headers = 'From:ebookingcinema2022@gmail.com' . "\r\n"; // Set from headers
		if (mail($to, $subject, $message, $headers)) {
		    echo "Email sent";	
		} else {
		    echo "Email sending failed";
		} // Send our email

		$model->signup($first_name, $last_name, $phone, $email, $password_hash, $promo, $hash);

	  } // signup	


	  if($_POST['postID'] == "sendResetPassword") {
            // setting all variables from $_POST
  		$email = $_POST['email'];
    		echo $email;
    		$hash = md5( rand(0, 1000));
    		$subject = 'Password | Reset';
    		$message = 'Your password reset link is: http://localhost/EBookDemo/B8-Cinema-E-Booking/MVC_Pages/verifyPassword.php?email='.$email.'&emailHash='.$hash;
    		$headers = 'From:ebookingcinema2022@gmail.com' . "\r\n"; // Set from headers
    		if (mail($email, $subject, $message, $headers)) {
        		echo "Email sent";
    		} else {
        		echo "Email sending failed";
    		}
		header("Location: ../home.php");

        } // sendResetPassword

    }


?>