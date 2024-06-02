<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['PrescriptionID'])) {
    $PrescriptionID = $_GET['PrescriptionID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM prescriptions WHERE PrescriptionID = ?");
    $stmt->bind_param("s", $PrescriptionID);
    $stmt->execute();

    // Check if any rows were affected (if the prescriptions existed)
    if ($stmt->affected_rows > 0) {
        $DeletePresc = array('success' => 'prescriptions deleted successfully.');
        echo json_encode($DeletePresc);
        exit();
    } else {
        $DeletePresc = array('success' => 'prescriptions not found or could not be deleted.');
        echo json_encode($DeletePresc);
        exit();
    }
} else {
    $DeletePresc = array('success' => 'Invalid request.');
    echo json_encode($DeletePresc);
    exit();
}
?>
