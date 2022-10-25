<!DOCTYPE html>
<html>
    <head>
        <title> Password Change </title>
    </head>


    <body>
        <?php

            $mysqli = require __DIR__ . "/database.php";

            if (isset($_GET['email']) && isset($_GET['emailHash'])) {
                $email = $_GET['email'];
                $emailHash = $_GET['emailHash'];

            } else {
                $email = '';
                $emailHash = '';

            }


            $sql = "SELECT email, emailHash FROM user WHERE email=? AND emailHash=?";            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss", $email, $emailHash);
            $stmt->execute();
            $resulting = $stmt->get_result();
            $user = $resulting->fetch_assoc();

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
                    <form method='POST'>
                <label for='password' style='color: black'>New Password: </label>
                <input type='text' value='' name='password'><br>
                <button type='submit' name='submit'>Submit</button>
            </form>

<!-- In this file, we have the user input a new password to use -->