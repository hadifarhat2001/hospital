<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['HistoryID'])) {
    $HistoryID = $_GET['HistoryID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM patienthistory WHERE HistoryID = ?");
    $stmt->bind_param("s", $HistoryID);
    $stmt->execute();

    // Check if any rows were affected (if the Diagnosis existed)
    if ($stmt->affected_rows > 0) {
        $DeleteHistory = array('success' => 'Diagnosis deleted successfully.');
        echo json_encode($DeleteHistory);
        exit();
    } else {
        $DeleteHistory = array('success' => 'Diagnosis not found or could not be deleted.');
        echo json_encode($DeleteHistory);
        exit();
    }
} else {
    $DeleteHistory = array('success' => 'Invalid request.');
    echo json_encode($DeleteHistory);
    exit();
}
?>
