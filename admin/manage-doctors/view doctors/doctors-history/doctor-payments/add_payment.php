<?php
require_once '../../../../../connection/db_connection.php';


    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $DoctorID = $_SESSION['doctorID'];

    $insertStmt = $mysqli->prepare("INSERT INTO doctor_payment ( doctorID, amount, paid, date) VALUES (?, ?, 0 , ?)");
    $insertStmt->bind_param("iss", $DoctorID, $_POST['TotalAmount'], $_POST['BillingDate']);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }
    ?>
