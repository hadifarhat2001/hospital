<?php
    require_once '../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $PatientID = $_SESSION['PatientID'];

    $dateTime = date('Y-m-d H:i:s', strtotime($_POST['TestDate']));
    $insertStmt = $mysqli->prepare("INSERT INTO labtests (PatientID, TestName, TestDate, Result, status) VALUES (?, ?, ?, null,0)");
    $insertStmt->bind_param("iss", $PatientID, $_POST['TestName'], $dateTime);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }

    ?>
