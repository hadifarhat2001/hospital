<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['DoctorID'])) {
    $DoctorID = $_GET['DoctorID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM doctors WHERE DoctorID = ?");
    $stmt->bind_param("s", $DoctorID);
    $stmt->execute();

    // Check if any rows were affected (if the doctors existed)
    if ($stmt->affected_rows > 0) {
        $DeleteDoctor = array('success' => 'doctors deleted successfully.');
        echo json_encode($DeleteDoctor);
        exit();
    } else {
        $DeleteDoctor = array('success' => 'doctors not found or could not be deleted.');
        echo json_encode($DeleteDoctor);
        exit();
    }
} else {
    $DeleteDoctor = array('success' => 'Invalid request.');
    echo json_encode($DeleteDoctor);
    exit();
}
?>
