<?php
require_once '../../../../connection/db_connection.php';

// session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}


$PatientID = $_SESSION['PatientID'];

$sql = "SELECT a.appointmentID, r.roomNumber AS roomName, a.AppointmentDateTime, CONCAT(d.Firstname, ' ', d.LastName) AS doctorName
        FROM appointments a
        INNER JOIN rooms r ON a.RoomID = r.roomID
        INNER JOIN doctors d ON a.DOctorID = d.doctorID
        WHERE a.PatientID = ? AND a.AppointmentDateTime >= CURDATE()";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $PatientID);
$stmt->execute();
$result = $stmt->get_result();
$currentAppointments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($currentAppointments);

// $stmt->close();
// $mysqli->close();
?>
