<?php

header("Content-Type:application/json");

try {
    $mysqli = require __DIR__ . "/db.php";

    $query = "SELECT * FROM bookings";

    $result = $mysqli->query($query);

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo "Database error. " . $e->getMessage();
}
