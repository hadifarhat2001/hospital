<?php
    require_once '../../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $BillingID = $_GET['BillingID'];

    $sql = "SELECT BillingID, TotalAmount, BillingDate FROM billing 
        WHERE BillingID = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $BillingID);
    $stmt->execute();
    $result = $stmt->get_result();
    //$BillingInfo = $result->fetch_all(MYSQLI_ASSOC);
    $BillingInfo = $result->fetch_assoc();

    date_default_timezone_set('America/New_York');
    $currentDateTime = date('Y-m-d H:i:s');

    $insertStmt = $mysqli->prepare("INSERT INTO payments ( BillingID, AmountPaid, PaymentDate) VALUES (?, ?, ?)");
    $insertStmt->bind_param("iss", $BillingID, $BillingInfo['TotalAmount'], $currentDateTime);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New payment made successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }
    ?>
