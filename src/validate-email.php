<?php

$mysqli = require __DIR__ . "/db.php";

$query = sprintf(
    "SELECT * FROM users
    WHERE email = '%s'",
    $mysqli->real_escape_string($_GET["email"])
);

$result = $mysqli->query($query);

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["isAvailable" => $is_available]);
