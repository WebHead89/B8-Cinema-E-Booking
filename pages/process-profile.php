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

// binding params to be added
$stmt->bind_param("sssssis",
                  $_POST['first_name'],
                  $_POST['last_name'],
                  $_POST['phone'],
                  $_POST['email'],
                  $password_hash,
                  $promo,
                  $hash);

?>
