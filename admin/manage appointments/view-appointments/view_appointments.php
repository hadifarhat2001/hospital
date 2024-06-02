<?php
// require_once '../../../connection/db_connection.php';
require_once('../../connection/db_connection.php');
$sql = "SELECT a.appointmentID, r.roomNumber AS roomName, a.AppointmentDateTime, CONCAT(d.Firstname, ' ', d.LastName) AS doctorName,
CONCAT(p.Firstname, ' ', p.LastName) AS patientName, status
FROM appointments a
INNER JOIN rooms r ON a.RoomID = r.roomID
INNER JOIN doctors d ON a.DOctorID = d.doctorID
INNER JOIN patients p ON a.PatientID =  p.PatientID";


$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$AppointmentsList = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($AppointmentsList);

?>
