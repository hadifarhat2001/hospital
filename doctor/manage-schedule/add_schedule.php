<?php
require_once '../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$stmt = $mysqli->prepare("SELECT *  FROM doctors WHERE Username = ? OR Email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if (!$doctor) {
    echo "Invalid credentials or user not found.";
    exit();
}


$insertStmt = $mysqli->prepare("INSERT INTO doctor_schedule (doctorID, availability_date, start_time, end_time, duration, specialty) VALUES (?, ?, ?, ?, ?, ?)");
$insertStmt->bind_param("isssss", $doctor['DoctorID'],$_POST['availability_date'], $_POST['start_time'], $_POST['end_time'], $_POST['duration'], $doctor['Specialization']);
$insertStmt->execute();

if ($insertStmt->affected_rows > 0) {
    echo json_encode(array("success" => "New record created successfully"));
} else {
    echo json_encode(array("error" => "Error: " . $mysqli->error));
}

// $stmt->close();
// $mysqli->close();
