<?php
require_once '../../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$PatientID = $_SESSION['PatientID'];


$sql = "SELECT * FROM labtests 
        WHERE PatientID = ? AND TestDate < CURDATE()";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$pastLabTest = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($pastLabTest);


?>
