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

// BillingID , PatientID, TotalAmount, BillingDate => billing
// PaymentID , BillingID, AmountPaid, PaymentDate => payments
$sql = "SELECT b.BillingID, b.TotalAmount, b.BillingDate
        FROM payments p
        INNER JOIN billing b ON p.BillingID != b.BillingID 
        WHERE b.PatientID = ? ";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $patient['PatientID']);
$stmt->execute();
$result = $stmt->get_result();
$upcomingPayments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($upcomingPayments);

// $stmt->close();
// $mysqli->close();
?>
