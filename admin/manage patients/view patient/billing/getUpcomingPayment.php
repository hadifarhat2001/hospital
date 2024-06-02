<?php
require_once '../../../../connection/db_connection.php';

// session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$PatientID = $_SESSION['PatientID'];

$sql = "SELECT b.BillingID, b.TotalAmount, b.BillingDate 
FROM billing b LEFT JOIN payments p ON p.BillingID = b.BillingID 
WHERE b.PatientID = ? and (b.BillingID not in (SELECT BillingID from payments));";


$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$upcomingPayments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($upcomingPayments);

// $stmt->close();
// $mysqli->close();
?>
