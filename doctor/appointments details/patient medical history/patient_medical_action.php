<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$PatientID = $_SESSION['PatientID'];
$username = $_SESSION['username'];

$sql = "SELECT a.PrescriptionID,CONCAT('Dr. ', d.FirstName, ' ', d.LastName) AS DoctorName , a.Medication, a.Dosage, a.PrescriptionDate
        FROM prescriptions a
        INNER JOIN doctors d ON a.DoctorID = d.DoctorID 
        WHERE a.PatientID = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$medicalHistory = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($medicalHistory);


?>
