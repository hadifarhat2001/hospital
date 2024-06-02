<?php
require_once '../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$stmt = $mysqli->prepare("SELECT DoctorID  FROM doctors WHERE Username = ? OR Email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if (!$doctor) {
    echo "Invalid credentials or user not found.";
    exit();
}

$sql = "SELECT * from doctor_schedule where doctorID = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $doctor['DoctorID']);
$stmt->execute();
$result = $stmt->get_result();
$doctorSchedule = $result->fetch_all(MYSQLI_ASSOC);

json_encode($doctorSchedule);

// $stmt->close();
// $mysqli->close();
?>
