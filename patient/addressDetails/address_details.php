<?php
// Start the session
session_start();

// Check if username and email session variables are set
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
} else {
    // Redirect to login page or handle session not set scenario
    header("Location: ../login/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Address Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .response-message {
            margin-top: 10px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Address Details</h2>
        <!-- <div>
            <p>Username: <?php echo $username; ?></p>
            <p>Email: <?php echo $email; ?></p>
        </div> -->
        <form id="signupForm" action="add_address_details.php" method="post">
            <label for="streetAddress">Street Address:</label>
            <input type="text" id="streetAddress" name="streetAddress" required><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required><br>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required><br>

            <label for="zipCode">Zip Code:</label>
            <input type="text" id="zipCode" name="zipCode" required><br>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required><br>

            <button type="submit" id="signupBtn">Submit Address</button>
        </form>
        <div id="responseMessage" class="response-message"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("signupForm");
            const responseMessage = document.getElementById("responseMessage");

            form.addEventListener("submit", function (event) {
                event.preventDefault();
                const formData = new FormData(form);

                fetch("add_address_details.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.error) {
                            responseMessage.innerHTML =
                                "<span class='error'>" + data.error + "</span>";
                        } else if (data.success) {
                            responseMessage.innerHTML =
                                "<span class='success'>" + data.success + "</span>";
                                window.location.href = "../login/login.html";
                        }
                    })
                    .catch((error) => {
                        responseMessage.innerHTML =
                            "<span class='error'>Error: " + error.message + "</span>";
                    });
            });

            form.addEventListener("input", function () {
                document.getElementById("signupBtn").disabled = !form.checkValidity();
            });
        });
    </script>
</body>

</html>
