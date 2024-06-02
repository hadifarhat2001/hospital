<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['PatientID'])) {
    $PatientID = $_GET['PatientID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM patients WHERE PatientID = ?");
    $stmt->bind_param("s", $PatientID);
    $stmt->execute();

    // Check if any rows were affected (if the Patients existed)
    if ($stmt->affected_rows > 0) {
        $DeletePatient = array('success' => 'Patients deleted successfully.');
        echo json_encode($DeletePatient);
        exit();
    } else {
        $DeletePatient = array('success' => 'Patients not found or could not be deleted.');
        echo json_encode($DeletePatient);
        exit();
    }
} else {
    $DeletePatient = array('success' => 'Invalid request.');
    echo json_encode($DeletePatient);
    exit();
}
?>
