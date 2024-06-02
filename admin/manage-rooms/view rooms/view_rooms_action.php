<?php
// require_once '../../../connection/db_connection.php';
require_once '../../connection/db_connection.php';
$sql = 'SELECT * FROM rooms';

$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$roomsList = $result->fetch_all(MYSQLI_ASSOC);

json_encode($roomsList);

?>
