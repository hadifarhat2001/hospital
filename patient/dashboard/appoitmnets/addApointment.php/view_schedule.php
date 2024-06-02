<?php
require_once '../../connection/db_connection.php';

$sql = "SELECT *
 from doctor_schedule d
        INNER JOIN doctors t on t.DoctorID = d.doctorID";

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$doctorSchedule = $result->fetch_all(MYSQLI_ASSOC);

json_encode($doctorSchedule);


