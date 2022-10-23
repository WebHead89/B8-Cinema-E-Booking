<!DOCTYPE html>
<html>

<head>
    <title> Email Verification </title>
</head>

<body>
    <?php

// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// Get URL parameters
if (isset($_GET['email']) && isset($_GET['emailHash'])) {
    $email = $_GET['email'];
    $emailHash = $_GET['emailHash'];
    $status = 0;
} else {
    $email = '';
    $emailHash = '';
    $status = 0;
}

// Finds the user in the database that matches the email and emailHash and has a status of 0
$sql = "SELECT email, emailHash, status FROM user WHERE email=? AND emailHash=? AND status=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssi", $email, $emailHash, $status);
$stmt->execute();
$resulting = $stmt->get_result();
$user = $resulting->fetch_assoc();

// If a user is found, update their status to 1 (active)
$match = $resulting->num_rows;
if ($match > 0) {
    $update = "UPDATE user SET status=1 WHERE email=? AND emailHash=? AND status=?";
    $stmt = $mysqli->prepare($update);
    $stmt->bind_param("ssi", $email, $emailHash, $status);
    $stmt->execute();
    echo "Your account has been verified. You can now login.";
}
    ?>
</body>

</html>