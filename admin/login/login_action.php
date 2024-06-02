<?php
include_once "../../connection/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['psw']; 

    $sql = "SELECT Password FROM admins WHERE Username = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($DBPassword);
            $stmt->fetch();

            if (($password === $DBPassword)) {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo json_encode(
                    array("success" =>  "user loged in successfully"));
            } else {
               echo json_encode(array("error" => "Incorrect password."));
            }
        } else {
           echo json_encode(array("error" => "this username is not fount. Please check again your user to proceed."));
        }

        $stmt->close();
    } else {
       echo json_encode(array("error" => "Error preparing statement: " . $mysqli->error));
    }

    $mysqli->close();
} else {
    echo json_encode(array("error" =>"Invalid request method."));
}
?>
