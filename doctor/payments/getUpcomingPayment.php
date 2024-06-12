<?php
require_once '../../connection/db_connection.php';

// session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];

$stmt = $mysqli->prepare("SELECT DoctorID FROM doctors WHERE username = ? OR Email	=  ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if (!$doctor) {
    echo "Invalid credentials or user not found.";
    exit();
}


$sql = "SELECT *
        FROM doctor_payment 
        WHERE DoctorID = ? AND paid = 0 ";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $doctor['DoctorID']);
$stmt->execute();
$result = $stmt->get_result();
$upcomingPayments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($upcomingPayments);

?>
