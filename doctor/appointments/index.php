<?php
require_once './view appointments/getcurrentappoitments.php';
require_once './view appointments/getpastappoitments.php';
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

        /* Style for table */
        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-bottom: 20px; */
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        .modal form button:hover {
            background-color: #45a049;
        }

        .edit-btn {
            background-color: #f4e951;
        }

        .delete-btn {
            background-color: #ee3131;
        }

        /* Style for buttons */
        .btn {
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
            color: white;
            /* padding: 14px 20px; */
            /* margin: 8px 0; */
            border: none;
            cursor: pointer;
        }

        .add-Room {
            background-color: #04aa6d;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
        }

        .body-container {
            margin-top: 5%;
            padding-left: 5%;
            padding-right: 5%;
        }
    </style>
</head>

<body>
    <header>
        <div style="background-color: #00c6a9">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> Dr|Appointments</span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="../dashboard/index.html"> Back to Dashboard</a>
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

    <div class="body-container">

        <div class="table-container">

            <div class="table-header">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>room Number</th>
                        <th>Appointment Date</th>
                        <th>patient Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($new_appointmets as $row): ?>
                    <tr>
                        <td><?php echo $row['appointmentID']; ?></td>
                        <td><?php echo $row['roomName']; ?></td>
                        <td><?php echo $row['AppointmentDateTime']; ?></td>
                        <td><?php echo $row['patientName']; ?></td>
                        <td>
                            <button class="btn delete-btn" onclick="viewAppointment(<?php echo $row['PatientID']; ?>)">
                                View
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    </tr>
                    <tr>
                        <?php foreach ($pastAppointments as $row): ?>
                    <tr>
                        <td><?php echo $row['appointmentID']; ?></td>
                        <td><?php echo $row['roomName']; ?></td>
                        <td><?php echo $row['AppointmentDateTime']; ?></td>
                        <td><?php echo $row['patientName']; ?></td>
                        <td>
                            <button class="btn delete-btn" onclick="viewAppointment(<?php echo $row['PatientID']; ?>)">
                                View
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function viewAppointment(PatientID) {
            window.location.href = "../appointments details/index.php?PatientID=" + PatientID;
        }
    </script>
    </div>
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
