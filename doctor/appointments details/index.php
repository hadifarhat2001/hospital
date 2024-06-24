<?php
session_start();
if (!isset($_SESSION['PatientID'])) {
    $_SESSION['PatientID'] = $_GET['PatientID'];
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
    <link href="./style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Semi-transparent background */
            z-index: 9999;
            /* Ensure modal appears above everything */
        }

        .modal-content {
            background-color: #fefefe;
            /* White background */
            margin: 10% auto;
            /* Center modal vertically and horizontally */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Adjust width as needed */
            max-width: 500px;
            /* Maximum width for responsiveness */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal h2 {
            margin-bottom: 20px;
        }

        .modal form label {
            display: block;
            margin-bottom: 10px;
        }

        .modal form input[type="text"],
        .modal form input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .modal form button {
            background-color: #4caf50;
            /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .modal form button:hover {
            background-color: #45a049;
        }

        .card {
            background-color: #f0f0f0;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: inherit;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .flex-left {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <header>
        <div style="background-color: #00c6a9">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <span class=""> Doctor's Portal: View Patient Details </span>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
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

    <div class="center-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 flex-left">
                    <a href="./patient history/index.php" class="card mb-3">Patient History</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <a href="./patient test lab/index.php" class="card mb-3">Patient Lab tests</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 flex-left">
                    <a href="./prespection/index.php" class="card mb-3">Patient Prespection</a>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                    <a href="./patient medical history/index.php" class="card mb-3">Patient Medical History</a>
                </div> -->
            </div>
        </div>
    </div>
</body>

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
