<?php
    require_once '../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $username = $_SESSION['username'];
    $PatientID = $_SESSION['PatientID'];
    $dateNow = date('Y-m-d H:i:s');
    
    $stmt = $mysqli->prepare("SELECT DoctorID  FROM doctors WHERE Username = ? OR Email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();

    if (!$doctor) {
        echo "Invalid credentials or user not found.";
        exit();
    }
    $insertStmt = $mysqli->prepare("INSERT INTO `patienthistory`(`PatientID`, `DoctorId`, `HistoryDate`, `Diagnosis`, `Treatment`) VALUES
                                    (?, ?, ?, ?, ?)");
    $insertStmt->bind_param("iisss", $PatientID, $doctor['DoctorID'], $dateNow, $_POST['Diagnosis'], $_POST['Treatment']);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }

    ?>
