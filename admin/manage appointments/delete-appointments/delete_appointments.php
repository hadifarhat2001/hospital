<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['AppointmentID'])) {
    $AppointmentID = $_GET['AppointmentID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM appointments WHERE AppointmentID = ?");
    $stmt->bind_param("s", $AppointmentID);
    $stmt->execute();

    // Check if any rows were affected (if the Appointments existed)
    if ($stmt->affected_rows > 0) {
        $DeleteAppointment = array('success' => 'Appointments deleted successfully.');
        echo json_encode($DeleteAppointment);
        exit();
    } else {
        $DeleteAppointment = array('success' => 'Appointments not found or could not be deleted.');
        echo json_encode($DeleteAppointment);
        exit();
    }
} else {
    $DeleteAppointment = array('success' => 'Invalid request.');
    echo json_encode($DeleteAppointment);
    exit();
}
?>
