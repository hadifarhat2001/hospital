    <?php
    require_once '../../../../connection/db_connection.php';

    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: login.php"); 
        exit();
    }

    $username = $_SESSION['username'];

    $stmt = $mysqli->prepare("SELECT PatientID FROM patients WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if (!$patient) {
        echo "Invalid credentials or user not found.";
        exit();
    }
    $dateTime = date('Y-m-d H:i:s', strtotime($_POST['dateTime']));
    $insertStmt = $mysqli->prepare("INSERT INTO appointments (PatientID, DoctorID, RoomID, AppointmentDateTime, Status) VALUES (?, ?, ?, ?, 0)");
    $insertStmt->bind_param("iiis", $patient['PatientID'],$_POST['doctor'], $_POST['room'], $dateTime);
    $insertStmt->execute();

    if ($insertStmt->affected_rows > 0) {
        echo json_encode(array("success" => "New record created successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $mysqli->error));
    }

    ?>
