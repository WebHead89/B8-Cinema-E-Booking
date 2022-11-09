<?php 

ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", "587");

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

// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// sql insert statement to insert into the database
$sql = "INSERT INTO user(first_name, last_name, phone, email, password, promo, emailHash, status)
        VALUES(?, ?, ?, ?, ?, ?, ?, 2)";

// init for sql execution
$stmt = $mysqli->stmt_init();

// print error statement and die if problems preparing
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

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




// binding params to be added
$stmt->bind_param("sssssis",
                  $_POST['first_name'],
                  $_POST['last_name'],
                  $_POST['phone'],
                  $_POST['email'],
                  $password_hash,
                  $promo,
                  $hash);



// execute statement and catch exception for duplicate emails                   
try {
    if ($stmt->execute()) {
    
        header("Location: signup-success.html");
        exit;

    }
} catch (Exception $e) {

    echo "Duplicate Email. \n";
    die($mysqli->error . " " . $mysqli->errno);

}


?>