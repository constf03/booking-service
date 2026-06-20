<?php

$host = "db";
$db_name = "booking-service-db";
$user = "root";
$password = "supersecretpassword123";

// Create MySQL db connection
$mysqli = new mysqli($host, $user, $password, $db_name);

// Handle connection errors
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
