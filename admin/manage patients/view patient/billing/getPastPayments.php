<?php
require_once '../../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$PatientID = $_SESSION['PatientID'];

$sql = "SELECT p.PaymentID, p.AmountPaid, p.PaymentDate
        FROM payments p
        INNER JOIN billing b ON p.BillingID = b.BillingID 
        WHERE b.PatientID = ? ";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$pastPayments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($pastPayments);


?>
