<?php
include_once "./../../connection/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST['Email'];
    $contactNumber = $_POST['ContactNumber'];
    $username = $_SESSION['username'];

    // Check if email or username exists in the Patients table
    $sql = "SELECT Email, ContactNumber FROM Patients WHERE Email = ? OR Username = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($DBEmail, $DBContactNumber);
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
            // Update the patient's email and contact number
            $updateStmt = $mysqli->prepare("UPDATE patients SET Email = ?, ContactNumber = ? WHERE Username = ?");
            if ($updateStmt) {
                $updateStmt->bind_param("sss", $newEmail, $contactNumber, $username);
                $updateStmt->execute();
                
                if ($updateStmt->affected_rows > 0) {
                    echo json_encode(array("success" => "Record updated successfully"));
                    // Redirect to the desired page
                } else {
                    echo json_encode(array("error" => "Error updating record: " . $mysqli->error));
                }
                $updateStmt->close();
            } else {
                echo json_encode(array("error" => "Error preparing update statement: " . $mysqli->error));
            }
        } else {
            echo json_encode(array("error" => "User Error: User not exists"));
        }
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Error preparing statement: " . $mysqli->error));
    }

    $mysqli->close();
}
?>
