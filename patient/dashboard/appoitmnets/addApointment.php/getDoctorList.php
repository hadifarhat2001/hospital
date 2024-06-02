<?php
require_once '../../connection/db_connection.php';

// DoctorID  , FirstName, LastName, Specialization, ContactNumber , Email, Username =>doctors
$sql = "SELECT * FROM doctors";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$doctorList = $result->fetch_all(MYSQLI_ASSOC);

json_encode($doctorList);

?>
