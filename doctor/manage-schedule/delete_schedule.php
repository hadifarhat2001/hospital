<?php
require_once '../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['ScheduleID'])) {
    $ScheduleID = $_GET['ScheduleID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM doctor_schedule WHERE schedule_ID = ?");
    $stmt->bind_param("s", $ScheduleID);
    $stmt->execute();

    // Check if any rows were affected (if the Schedule existed)
    if ($stmt->affected_rows > 0) {
        $DeleteAppointment = array('success' => 'Schedule deleted successfully.');
        echo json_encode($DeleteAppointment);
        exit();
    } else {
        $DeleteAppointment = array('success' => 'Schedule not found or could not be deleted.');
        echo json_encode($DeleteAppointment);
        exit();
    }
} else {
    $DeleteAppointment = array('success' => 'Invalid request.');
    echo json_encode($DeleteAppointment);
    exit();
}
?>
