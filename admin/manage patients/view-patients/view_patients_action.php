<?php
// require_once '../../../connection/db_connection.php';
require_once('../../connection/db_connection.php');
$sql = "SELECT * FROM patients";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$PatientsList = $result->fetch_all(MYSQLI_ASSOC);

 json_encode($PatientsList);

?>
