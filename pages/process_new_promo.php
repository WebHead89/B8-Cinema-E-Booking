<?php 
session_start();

// setting all variables from $_POST
$promo = $_POST["promocode"];
$discount = $_POST["discount"];

// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// get all the emails
$sql = "SELECT * FROM `user` WHERE promo='1'";
        $result = $mysqli->query($sql);
        $emailAccounts = $result->fetch_all(MYSQLI_ASSOC);

// sql insert statement to update the database 
$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("INSERT INTO `promotions_table` (`code`, `discount`) VALUES ('$promo', '$discount')");

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


if($stmt->execute()) {
    header("Location: admin_home.php");
    exit;
}

?>