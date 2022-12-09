<!DOCTYPE html>
<html>

<head>
    <title> Email Verification </title>
</head>

<body>
    <?php

// require database.php for database connection
// $mysqli = require __DIR__ . "/database.php";
include __DIR__ . "../Model/Model.php";

$model = new Model();

// Get URL parameters
if (isset($_GET['email']) && isset($_GET['emailHash'])) {
    $email = $_GET['email'];
    $emailHash = $_GET['emailHash'];
    $status = 2;
} else {
    $email = '';
    $emailHash = '';
    $status = 2;
}

// echo $email;
// echo $emailHash;
// echo $status;

// // Finds the user in the database that matches the email and emailHash and has a status of 0
// $sql = "SELECT email, emailHash, status FROM user WHERE email=? AND emailHash=? AND status=?";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param("ssi", $email, $emailHash, $status);
// $stmt->execute();
// $resulting = $stmt->get_result();
// $user = $resulting->fetch_assoc();
// echo $resulting->num_rows;

$match = $model->findUserWithEmail($email, $emailHash, $status);

// If a user is found, update their status to 1 (active)
// $match = $resulting->num_rows;
if ($match > 0) {

    // Setup call to controller to update user status instead
    $model->updateUserInfoLessParams($email, $emailHash, $status);
    header("Location: ./confirmation.html");
    echo "Your account has been verified. You can now login."; //replace with redirect to login page
    // Redirect to confirmation page
} else {
    echo "The url is either invalid or you already have activated your account.";
}

    ?>
</body>

</html>