<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['appointmentID'])) {
    $appointmentID = $_GET['appointmentID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM appointments WHERE appointmentID = ?");
    $stmt->bind_param("s", $appointmentID);
    $stmt->execute();

    // Check if any rows were affected (if the appointment existed)
    if ($stmt->affected_rows > 0) {
        $DeletedAppointments = array('success' => 'Appointment deleted successfully.');
        echo json_encode($DeletedAppointments);
        exit();
    } else {
        $DeletedAppointments = array('success' => 'Appointment not found or could not be deleted.');
        echo json_encode($DeletedAppointments);
        exit();
    }
} else {
    $DeletedAppointments = array('success' => 'Invalid request.');
    echo json_encode($DeletedAppointments);
    exit();
}
?>
