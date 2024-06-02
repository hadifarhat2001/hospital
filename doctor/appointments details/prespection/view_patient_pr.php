<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$PatientID = $_SESSION['PatientID'];

$sql = "SELECT p.PrescriptionID, CONCAT(d.Firstname, ' ', d.LastName) AS doctorName, p.PrescriptionDate, p.Medication, p.Dosage  FROM prescriptions p
        INNER JOIN doctors d ON p.DoctorID  = d.DoctorID 
        WHERE PatientID = ?"; 

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$prespections = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($prespections);

?>
