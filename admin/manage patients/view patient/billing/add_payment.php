<?php
    require_once '../../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $PatientID = $_SESSION['PatientID'];

    $insertStmt = $mysqli->prepare("INSERT INTO billing ( PatientID, TotalAmount, BillingDate) VALUES (?, ?, ?)");
    $insertStmt->bind_param("iss", $PatientID, $_POST['TotalAmount'], $_POST['BillingDate']);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }
    ?>
