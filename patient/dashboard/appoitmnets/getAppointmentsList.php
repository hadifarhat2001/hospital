<?php
require_once '../../../connection/db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// rest of your code
$doctorId = isset($_GET['doctorId']) ? $_GET['doctorId'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null; // get the date from the query parameters

if ($doctorId && $date) {
    // Fetch the appointments of the specific doctor on the specific date
    $sql = "SELECT * FROM appointments WHERE DoctorID = ? AND DATE(AppointmentDateTime) = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("is", $doctorId, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($appointments);
    json_encode($appointments);
} else {
    echo "No doctorId or date provided";
    json_encode([]);
}
?>