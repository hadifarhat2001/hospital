<?php
require_once '../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$stmt = $mysqli->prepare("SELECT PatientID FROM patients WHERE username = ? ");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    echo "Invalid credentials or user not found.";
    exit();
}

$sql = "SELECT a.appointmentID, r.roomNumber AS roomName, a.AppointmentDateTime, CONCAT(d.Firstname, ' ', d.LastName) AS doctorName
        FROM appointments a
        INNER JOIN rooms r ON a.RoomID = r.roomID
        INNER JOIN doctors d ON a.DOctorID = d.doctorID
        WHERE a.PatientID = ? AND a.AppointmentDateTime < CURDATE()";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $patient['PatientID']);
$stmt->execute();
$result = $stmt->get_result();
$pastAppointments = $result->fetch_all(MYSQLI_ASSOC);

json_encode($pastAppointments);

// $stmt->close();
// $mysqli->close();
?>
