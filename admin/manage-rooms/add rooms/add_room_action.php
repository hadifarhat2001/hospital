<?php
    require_once '../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $insertStmt = $mysqli->prepare("INSERT INTO rooms (RoomNumber, RoomType, Capacity, Availability) VALUES (?, ?, ?, 1)");
    $insertStmt->bind_param("isi", $_POST['RoomNumber'],$_POST['RoomType'], $_POST['Capacity']);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }

    ?>
