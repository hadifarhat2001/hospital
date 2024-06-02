<?php
require_once '../../../../connection/db_connection.php';

// session_start();

$DoctorID = $_SESSION['doctorID'];

$sql = "SELECT a.appointmentID, r.roomNumber AS roomName, a.AppointmentDateTime, CONCAT(p.Firstname, ' ', p.LastName) AS PaitentName
        FROM appointments a
        INNER JOIN rooms r ON a.RoomID = r.roomID
        INNER JOIN patients p ON a.PatientID = p.PatientID
        WHERE a.doctorID = ? AND a.AppointmentDateTime >= CURDATE()";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $DoctorID);
$stmt->execute();
$result = $stmt->get_result();
$currentAppointments = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($currentAppointments);

?>
