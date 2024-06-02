<?php
require_once '../../connection/db_connection.php';

// session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];

$stmt = $mysqli->prepare("SELECT PatientID FROM patients WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    echo "Invalid credentials or user not found.";
    exit();
}

// TestID  , TestName,Result , status, TestDate => labtests
$sql = "SELECT * FROM labtests 
        WHERE PatientID = ? AND TestDate >= CURDATE() AND status = 0 "; 

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $patient['PatientID']);
$stmt->execute();
$result = $stmt->get_result();
$upcomingLabTest = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($upcomingLabTest);

// $stmt->close();
// $mysqli->close();
?>
