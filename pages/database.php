<?php

// database sign-in credentials (default for now)
$host = "localhost";
$dbname = "cinemadatabase";
$username = "root";
$password = "";

// signing into the database using credentials
$mysqli = new mysqli(hostname: $host,
username: $username,
password: $password,
database: $dbname);

// if connection failed, die and print error message
if ($mysqli->connect_errno) {
  die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;