<?php
require_once '../../connection/db_connection.php';

session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$stmt = $mysqli->prepare("SELECT DoctorID  FROM doctors WHERE Username = ? OR Email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if (!$doctor) {
    echo "Invalid credentials or user not found.";
    exit();
}

$sql = "SELECT a.appointmentID, a.PatientID, r.roomNumber AS roomName, a.AppointmentDateTime, CONCAT(p.Firstname, ' ', p.LastName) AS patientName
        FROM appointments a
        INNER JOIN rooms r ON a.RoomID = r.roomID
        INNER JOIN patients p ON a.PatientID  = p.PatientID 
        WHERE a.doctorID = ? AND a.AppointmentDateTime >= CURDATE()";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $doctor['DoctorID']);
$stmt->execute();
$result = $stmt->get_result();
$new_appointmets = $result->fetch_all(MYSQLI_ASSOC);

json_encode($new_appointmets);

// $stmt->close();
// $mysqli->close();
?>
