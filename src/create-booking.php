<?php

try {
    $mysqli = require __DIR__ . "/db.php";

    // Convert request data to JSON
    $data = json_decode(file_get_contents('php://input'), true);

    $req_user_id        =   $data["user_id"];
    $req_slot_number    =   $data["slot_number"];
    $req_week_number    =   $data["week_number"];
    $req_date           =   $data["date"];
    $req_time           =   $data["time"];

    if (
        empty($req_user_id) &&
        empty($req_slot_number) &&
        empty($req_week_number) &&
        empty($req_date) &&
        empty($req_time)) {
        exit("Error: Missing data.");
    }

    $query = "INSERT INTO bookings (user_id, slot_number, week_number, date, time)
        VALUES (?, ?, ?, ?, ?)";

    // Prepare SQL statement (prevent SQL injection)
    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($query)) {
        exit("SQL Error: " . $mysqli->error);
    }

    $stmt->bind_param(
        "iiiss",
        $req_user_id,
        $req_slot_number,
        $req_week_number,
        $req_date,
        $req_time
    );

    if ($stmt->execute()) {
        $mysqli->close();
        header("Location: ../public/index.php");
        exit;
    } else {
        exit("SQL Error: " . $mysqli->error . $mysqli->errno);
    }
} catch (Exception $e) {
    exit("Database error: " . $e->getMessage());
}
