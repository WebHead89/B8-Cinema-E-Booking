<?php

$mysqli = require __DIR__ . "/database.php";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    echo $email;
    $hash = md5( rand(0, 1000));
    $subject = 'Password | Reset';
    $message = 'Your password reset link is: http://localhost/EBookDemo/B8-Cinema-E-Booking/pages/verifyPassword.php?email='.$email.'&emailHash='.$hash;
    $headers = 'From:ebookingcinema2022@gmail.com' . "\r\n"; // Set from headers
    if (mail($email, $subject, $message, $headers)) {
        echo "Email sent";
    } else {
        echo "Email sending failed";
    } // Send our email

    $sql = "UPDATE user SET emailHash = ? WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $hash, $email);
    $stmt->execute();


    // header("Location: home.php");

}


?>

<!-- 
    If a user forgets their password:
    1. User enters their email address
    2. User is sent an email with a link to a page where they can reset their password
    3. User enters their new password
    4. User is redirected to login page
-->