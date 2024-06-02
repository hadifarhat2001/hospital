<?php
// Start the session
include_once "./../../connection/db_connection.php";
session_start();

// Check if username and email session variables are set
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    // retrive all user profile info needed
    $sql = "SELECT FirstName, LastName, Email, DateOfBirth, ContactNumber FROM Patients WHERE Email = ? OR Username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();   
    $stmt->store_result();
    $stmt->bind_result($DBFirstName, $DBLastName, $DBEmail, $DBDateOfBirth, $DBContactNumber);
    $stmt->fetch();
    if ($stmt->num_rows > 0) { 

    }

} else {
    // Redirect to login page or handle session not set scenario
    header("Location: ../login/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Hospital project</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" />
    <!-- nice select -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />
    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />
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
            background-color: #00c6a9;
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
    <header>
        <div style="background-color: #00c6a9;">
            <div class=" container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="../dashboard/index.php">dashoard <span
                                            class="sr-only">(current)</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="quote_btn-container">
                            <a href="../logout/logout.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>log out</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <h2>Profile</h2>
            <form id="profileForm" action="edit_profile.php" method="post">
                <label for="FullName">Full name:</label>
                <p type="text" id="FullName" name="FullName" >
                <?php echo $DBFirstName . ' '  . $DBLastName 
                ?> </p>

                <label for="DateOfBirth">Date Of Birth:</label>
                <p type="text" id="DateOfBirth" name="DateOfBirth" ><?php echo $DBDateOfBirth ?> </p>

                <label for="Email">Email</label>
                <input type="text" id="Email" name="Email" value="<?php echo $DBEmail ?>" required><br>

                <label for="ContactNumber">Phone Number</label>
                <input type="text" id="ContactNumber" name="ContactNumber" value="<?php echo $DBContactNumber ?>" required><br>

                <button type="submit" id="signupBtn">Submit Changes</button>
            </form>
            <div id="responseMessage" class="response-message"></div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const form = document.getElementById("profileForm");
                const responseMessage = document.getElementById("responseMessage");

                form.addEventListener("submit", function (event) {
                    event.preventDefault();
                    const formData = new FormData(form);
                    fetch("edit_profile.php", {
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
    </section>
</body>

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
    integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

</html>