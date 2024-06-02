<?php
require_once '../../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['RoomID'])) {
    $roomID = $_GET['RoomID'];

    // Prepare and execute the delete query
    $stmt = $mysqli->prepare("DELETE FROM rooms WHERE roomID = ?");
    $stmt->bind_param("s", $roomID);
    $stmt->execute();

    // Check if any rows were affected (if the Room existed)
    if ($stmt->affected_rows > 0) {
        $DeletedRoom = array('success' => 'Room deleted successfully.');
        echo json_encode($DeletedRoom);
        exit();
    } else {
        $DeletedRoom = array('success' => 'Room not found or could not be deleted.');
        echo json_encode($DeletedRoom);
        exit();
    }
} else {
    $DeletedRoom = array('success' => 'Invalid request.');
    echo json_encode($DeletedRoom);
    exit();
}
?>
