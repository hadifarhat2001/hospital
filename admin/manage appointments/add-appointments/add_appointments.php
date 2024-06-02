<?php
    require_once '../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }


    $dateTime = date('Y-m-d H:i:s', strtotime($_POST['dateTime']));
    $insertStmt = $mysqli->prepare("INSERT INTO appointments (PatientID, DoctorID, RoomID, AppointmentDateTime, Status) VALUES (?, ?, ?, ?, 0)");
    $insertStmt->bind_param("iiis", $_POST['Patient'],$_POST['doctor'], $_POST['room'], $dateTime);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }

    ?>
