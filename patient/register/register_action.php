<?php
include_once "./../../connection/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender']; 
    $dob = $_POST['dob'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email']; 
    $username = $_POST['username'];
    $psw = $_POST['psw'];

    
    $sql = "SELECT Email, Username FROM Patients WHERE Email = ? OR Username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($DBEmail, $DBUsername);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        
        if ($DBEmail == $email) {
            echo json_encode(array("error" => "Email Error: Email already exists in the database."));
        }
        if ($DBUsername == $username) {
            echo json_encode(array("error" => "Username Error: Username already exists in the database."));
        }
    } else {
        
        $psw = trim($psw);
        $hashedPassword = password_hash($psw, PASSWORD_DEFAULT);
        
        $insertStmt = $mysqli->prepare("INSERT INTO Patients (FirstName, LastName, Gender, DateOfBirth, ContactNumber, Email, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssssss", $fname, $lname, $gender, $dob, $telephone, $email, $username, $hashedPassword);
        $insertStmt->execute();
        
        if ($insertStmt->affected_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo json_encode(array("success" => "New record created successfully"));
            
        } else {
            echo json_encode(array("error" => "Error: " . $mysqli->error));
        }

        $insertStmt->close();
    }

    $stmt->close();
}

$mysqli->close();
?>
