<?php 
session_start();

// setting all variables from $_POST
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$phone=$_POST["phone"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$id=$_SESSION["user_id"];
$expiration =$_POST["cc_expiration"];

// Password hash to store credit card # securely
$cc_hash = password_hash($_POST["cc_number"], PASSWORD_DEFAULT);

// Password hash to store password securely
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Set promo value to a variable
if ($_POST["promo"] == "Yes") {
    $promo = 1;
} else {
    $promo = 0;
}


// require database.php for database connection
$mysqli = require __DIR__ . "/database.php";

// checking to see if password has been changed
if ($_POST["password"] == "") {

    // sql update statement to update the user database (no password)

    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare("UPDATE user SET first_name='$first_name', last_name='$last_name', phone='$phone', promo='$promo', address='$address', city='$city', state='$state', zip='$zip' WHERE id='$id'");
} else {

// sql insert statement to update the user database (with password)

$stmt = $mysqli->stmt_init();
$stmt = $mysqli->prepare("UPDATE user SET first_name='$first_name', last_name='$last_name', phone='$phone', password='$password_hash', promo='$promo', address='$address', city='$city', state='$state', zip='$zip' WHERE id='$id'");
}
// checking to see if credit card info exists
    $sql2 = "SELECT * FROM card_info_table
         WHERE user_id = {$_SESSION["user_id"]}";

    $result2 = $mysqli->query($sql2);

    $user2 = $result2->fetch_assoc();

    if($user2["user_id"] != $_SESSION["user_id"]) {

        $sql3 = "INSERT INTO card_info_table(card_number, expiration, user_id)
        VALUES(?, ?, ?)";


        $stmt2 = $mysqli->stmt_init();

        $stmt2->prepare($sql3);

        $stmt2->bind_param("ssi",
                  $cc_hash,
                  $expiration,
                  $id);
    } else {
        $stmt2 = $mysqli->stmt_init();
        $stmt2 = $mysqli->prepare("UPDATE card_info_table SET card_number='$cc_hash', expiration='$expiration' WHERE user_id='$id'");
    }





if($stmt->execute() && $stmt2->execute()) {
    header("Location: signup-success.html");
    exit;
}

?>
