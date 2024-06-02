<?php
include_once "../../../connection/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode']; 
    $country = $_POST['country'];

    $email = $_SESSION['doctor-email'];
    $username = $_SESSION['doctor-username'];
    $DoctorID;
    
    $sql = "SELECT Email, DoctorID FROM doctors WHERE Email = ? OR Username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();   
    $stmt->store_result();
    $stmt->bind_result($DBEmail, $DBDoctorID);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $DoctorID = $DBDoctorID;
        $insertStmt = $mysqli->prepare("INSERT INTO doctoraddresses (DoctorID, StreetAddress, City, State, ZipCode, Country) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssss", $DoctorID, $streetAddress, $city, $state, $zipCode, $country);
        $insertStmt->execute();
        
        if ($insertStmt->affected_rows > 0) {
            echo json_encode(array("success" => "New record created successfully"));
            //  redirect to login  page or patient page 
        } else {
            echo json_encode(array("error" => "Error: " . $mysqli->error));
        }
        $insertStmt->close();
        
    } else {
        if ($DBEmail != $email ) {
            echo json_encode(array("error" => "User Error: User not exisit"));
        }
        else {
            echo json_encode(array("error" => "somthing went worng"));
        }
    }
    $stmt->close();
}

$mysqli->close();
?>
