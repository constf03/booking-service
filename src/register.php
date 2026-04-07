<?php

$mysqli = require __DIR__ . "/db.php";

// Request data vars
$req_name = $_POST["name"];
$req_email = $_POST["email"];
$req_password = $_POST["password"];
$req_password_confirm = $_POST["password-confirm"];

// Password length vars
$PASSWORD_MIN_LENGTH = 8;
$PASSWORD_MIN_LETTERS = 1;
$PASSWORD_MIN_NUMBERS = 1;

// Validate input data
// Name
if (empty($req_name)) {
    die("Validation Error: Name is required.");
}

// Validate input data
// Email
if (!filter_var($req_email, FILTER_VALIDATE_EMAIL)) {
    die("Validation Error: Valid email address is required.");
}

// Validate input data
// Password: minimum length
if (strlen($req_password) < $PASSWORD_MIN_LENGTH) {
    die("Validation Error: Password must be at least $PASSWORD_MIN_LENGTH characters.");
}

// Validate input data
// Password: minimum amount of letters
if (!preg_match("/[a-z]{{$PASSWORD_MIN_LETTERS},}/i", $req_password)) {
    die("Validation Error: Password must contain at least $PASSWORD_MIN_LETTERS letters.");
}

// Validate input data
// Password: minimum amount of numbers
if (!preg_match("/[0-9]{{$PASSWORD_MIN_NUMBERS},}/", $req_password)) {
    die("Validation Error: Password must contain at least $PASSWORD_MIN_NUMBERS numbers.");
}

// Validate input data
// Password: match confirmation
if ($req_password_confirm !== $req_password) {
    die("Validation Error: Password does not match.");
}

// Hash password
$password_hash = password_hash($req_password, PASSWORD_DEFAULT);

// DB SQL query
$query = "INSERT INTO users (name, email, password_hash)
          VALUES (?, ?, ?)";

// Prepare SQL statement (prevent SQL injection)
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($query)) {
    die("SQL Error: $mysqli->error");
}

$stmt->bind_param("sss", $req_name, $req_email, $password_hash);

if ($stmt->execute()) {
    header("Location: ../public/register-success.html");
    exit;
} else {
    die("SQL Error: $mysqli->error $mysqli->errno");
}

