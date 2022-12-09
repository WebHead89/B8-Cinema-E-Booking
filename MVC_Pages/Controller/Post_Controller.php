<?php
    include __DIR__ . "/../Model/Model.php";
    include __DIR__ . "/../Singleton.php";
    $model = new Model();
    session_start();

    if(isset($_POST['postID'])) {
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //ADMIN POSTS                                                                                                
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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
            header("Location: ../admin_home.php");
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


        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //BOOKING POSTS                                                                                              
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        // if the POST is for selecting the showtime
        if($_POST['postID'] == "showtimeBookingPage") {
            $bookingInfo = $_SESSION['bookingInfo'];
            // set the showID, date, and time
            $bookingInfo->showID = $_POST['showID'];
            $bookingInfo->showDate = $_POST['showDate'];
            $bookingInfo->showTime = $_POST['showTime'];

            // set the ticket types
            $bookingInfo->childTickets = 0;
            $bookingInfo->adultTickets = 0;
            $bookingInfo->seniorTickets = 0;

            // reset discount
            $bookingInfo->promoCode = "";
            $bookingInfo->promoDiscount = 0;

            // reset the seats array
            unset($bookingInfo->selectedSeatsArray);
            $bookingInfo->selectedSeatsArray = array();
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        // if POST is to submit booking
        if($_POST['postID'] == "submitBooking") {
            $bookingInfo = $_SESSION['bookingInfo'];
            // check to make sure the ticket numbers match to seats selected
            $totalTickets = $bookingInfo->childTickets + $bookingInfo->adultTickets + $bookingInfo->seniorTickets;
            if($totalTickets != count($bookingInfo->selectedSeatsArray)) {
                // incorrect tickets, send post to booking, or create session var
                header("Location: ../booking.php?movieID=$bookingInfo->movieID");
            } else {
                // process to payment page
                header("Location: ../checkout.php");
            }
        }

        // if POST is to reset the showID
        if($_POST['postID'] == "resetShow") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $bookingInfo->showID = -1;
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        // if POST is to add a seat selected by user
        if($_POST['postID'] == "userAddSeat") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $seatLoc = $_POST['seatIndex'];
            // set the seat to selected
            $bookingInfo->buttonTypeArray[$seatLoc] = 3;

            // add to selectedSeatsArray
            if($bookingInfo->selectedSeatsArray == NULL) {
                $bookingInfo->selectedSeatsArray = array();
            }
            array_push($bookingInfo->selectedSeatsArray, (int)$seatLoc + 1);
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        // if POST is to remove a seat selected by user
        if($_POST['postID'] == "userRemoveSeat") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $seatLoc = $_POST['seatIndex'];
            $value = (int)$seatLoc + 1;
            $index = array_search($value, $bookingInfo->selectedSeatsArray, FALSE);
            unset($bookingInfo->selectedSeatsArray[$index]);
            $bookingInfo->buttonTypeArray[$seatLoc] = 2;
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        // following POSTS are to update ticket prices
        if($_POST['postID'] == "addAdultTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $bookingInfo->adultTickets++;
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        if($_POST['postID'] == "removeAdultTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            if($bookingInfo->adultTickets != 0) {
                $bookingInfo->adultTickets--;
            }
            $location = "Location: ../booking.php?movieID=$bookingInfo->movieID";
            echo "ID: " . $bookingInfo->movieID;
            header($location);
        }

        if($_POST['postID'] == "addChildTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $bookingInfo->childTickets++;
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        if($_POST['postID'] == "removeChildTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            if($bookingInfo->childTickets != 0) {
                $bookingInfo->childTickets--;
            }
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        if($_POST['postID'] == "addSeniorTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $bookingInfo->seniorTickets++;
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        if($_POST['postID'] == "removeSeniorTicket") {
            $bookingInfo = $_SESSION['bookingInfo'];
            if($bookingInfo->seniorTickets != 0) {
                $bookingInfo->seniorTickets--;
            }
            header("Location: ../booking.php?movieID=$bookingInfo->movieID");
        }

        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //Checkout POSTS                                                                                              
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $paymentID;
        $checkout = false;
        $promoID = -1;
        // if the POST is for selecting a promoCode
        if($_POST['postID'] == "submitPromo") {
            $bookingInfo = $_SESSION['bookingInfo'];
            $promo = $_POST['promo'];
            // query for promoCodes
            $promo = $model->searchPromoCode($promo);
            if($promo) {
                $bookingInfo->promoCode = $promo["code"];
                $bookingInfo->promoDiscount = $promo["discount"];
                $promoID = $promo["idPromotions"];
            } else {
                echo '<script>alert("Incorrect promocode.")</script>';
            }
            header("Location: ../checkout.php");
        }

        if($_POST['postID'] == "submitPayment") {
            $paymentID = $_POST['cardID'];
            $checkout = true;
        }

        if($_POST['postID'] == "submitNewPayment") {
            $cardNum = $_POST['cardNumber'];
            $expiration = $_POST['expiration'];
            
            // create new card
            $model->createOneTimePaymentCard($cardNum, $expiration);
        
            // set paymentID for booking info
            $paymentID = $model->getIdPaymentCard($cardNum);
            $checkout = true;
        }

          if($checkout) {
            $bookingInfo = $_SESSION['bookingInfo'];
            // get total price
            $ticketPrices = $model->getTicketPrices();

			// get total price
			$childPrice = $ticketPrices["CHILD"];
			$adultPrice = $ticketPrices["ADULT"];
			$seniorPrice = $ticketPrices["SENIOR"];
			$totalPrice = $childPrice * $bookingInfo->childTickets + $adultPrice * $bookingInfo->adultTickets + $seniorPrice * $bookingInfo->seniorTickets;

            // get promoID
            $promo = $model->searchPromoCode($bookingInfo->promoCode);
            if($promo) {
                $promoID = $promo["idPromotions"];
            }

            // get userID
            $userInfo = $model->getUserInfo($_SESSION["user_id"]);
			$userID = $userInfo["id"];

            // create booking
            $model->createBooking($totalPrice, $bookingInfo->showID, $paymentID, $promoID, $userID);
          
            // get bookingID
            $bookingID = $model->getBookingID($totalPrice, $bookingInfo->showID, $paymentID, $promoID, $userID);
     
            // create tickets
            foreach($bookingInfo->selectedSeatsArray as $seat) {
                $model->createTicket($bookingID, $seat);
            }
          
            // update the seats table to reserved for the show
            foreach($bookingInfo->selectedSeatsArray as $seat) {
                $model->updateSeat($seat, $bookingInfo->showID);
            }

            // SEND EMAIL OF BOOKING CONFIRMATION

            // reset the bookingInfo session class
            $bookingInfo->showID = -1;
            unset($bookingInfo->selectedSeatsArray);
            $bookingInfo->selectedSeatsArray = array();
            // set the ticket types
            $bookingInfo->childTickets = 0;
            $bookingInfo->adultTickets = 0;
            $bookingInfo->seniorTickets = 0;
            // reset promo
            $bookingInfo->promoDiscount = 0;
            $bookingInfo->promoCode = "";


            // send to confirmation page
            header("Location: ../confirmation.html");

        }

        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //Edit Profile POSTS                                                                                              
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if($_POST['postID'] == "editProfile") {
            // setting all variables from $_POST
            $first_name=$_POST["first_name"];
            $last_name=$_POST["last_name"];
            $phone=$_POST["phone"];
            $address=$_POST["address"];
            $city=$_POST["city"];
            $state=$_POST["state"];
            $zip=$_POST["zip"];
            $id=$_SESSION["user_id"];
            $password= $_POST["password"];

            // Password hash to store credit card # securely
            // $cc_hash = password_hash($_POST["cc_number"], PASSWORD_DEFAULT);

            // if there is a new credit cardnum and epiration date, then create the new credit card
            $newCardNum = $_POST["cc_number"];
            $newCardExpire = $_POST["cc_expiration"];

            if($newCardExpire != "" AND $newCardNum != "") {
                $model->createNewPaymentCard($newCardNum, $newCardExpire, $id);
            }

            // get password from DB, check if equal, if not then update the password
            $user = $model->getUserInfo($id);
            $current_password_hash = $user["password"];

            $password_hash;
            if($password == $current_password_hash) {
                $password_hash = $password;
            } else {
                $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            }

            // Set promo value to a variable
            if ($_POST["promo"] == "Yes") {
                $promo = 1;
            } else {
                $promo = 0;
            }
            
            $model->updateUserInfo($first_name, $last_name, $phone, $password_hash, $promo, $address, $city, $state, $zip, $id);
            header("Location: ../editprofile.php");
        }
  
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //Other POSTS                                                                                              
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


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

	   if($_POST['postID'] == "login") {
		// setting all variables from $_POST
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user = $model->getLoginInfo($email);
		if ($user) {

      		if (password_verify($_POST["password"], $user["password"]) && $user['status'] == 1) {

		      	session_start();
  	      		$_SESSION["user_id"] = $user["id"];
        
        			if($user["admin"] == 0) {
          				header("Location: ../home.php");
        			} else {
          				header("Location: ../admin_home.php");
        			}
 
      		} elseif ($user["status"] == 2) {
	
 				echo '
        			<script type="text/JavaScript">
          				alert("You must confirm your email before logging in.");
        			</script>';
      		}
		}
    		$is_invalid = true;
	   } // login 


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