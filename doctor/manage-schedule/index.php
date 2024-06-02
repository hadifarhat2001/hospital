<?php
require_once "./view_schedule.php";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" />
  <!-- Custom styles for this template -->
  <link href="../../css/style.css" rel="stylesheet" />
  <link href="./style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../../css/responsive.css" rel="stylesheet" />
  <style>
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 9999;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
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
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    table {
      width: 100%;
      border-collapse: collapse;
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

    .view-btn {
      background-color: #04aa6d;
    }

    .btn {
      padding: 5px 10px;
      margin-right: 5px;
      cursor: pointer;
      color: white;
      border: none;
      cursor: pointer;
    }

    .add-Schedule {
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
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
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
        <button class="btn add-Schedule" onclick="openAddScheduleModal()">
          Add New Schedule
        </button>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>availability date</th>
            <th>start time</th>
            <th>end time</th>
            <th>duration</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach ($doctorSchedule as $row): ?>
            <tr>
              <td><?php echo $row['schedule_ID']; ?></td>
              <td><?php echo $row['availability_date']; ?></td>
              <td><?php echo $row['start_time']; ?></td>
              <td><?php echo $row['end_time']; ?></td>
              <td><?php echo $row['duration'] . ' mins'; ?></td>
              <td>
                <button class="btn delete-btn" onclick="deleteSchedule(<?php echo $row['schedule_ID']; ?>)">
                  Delete
                </button>

              </td>
            </tr>
          <?php endforeach; ?>

          </tr>
        </tbody>
      </table>

      <!-- Modal for adding Schedule -->
      <div id="addScheduleModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeModal()">&times;</span>
          <h2>Add New Schedule</h2>
          <form id="addScheduleForm">

            <!-- Other form fields here -->
            <label for="availability_date">Schedule Date:</label>
            <input type="date" id="availability_date" name="availability_date" required>

            <label for="start_time">Start Time:</label>
            <select id="start_time" name="start_time" required>
              <?php
              for ($hours = 8; $hours <= 18; $hours++) {
                for ($mins = 0; $mins < 60; $mins += 30) {
                  $display_hours = $hours > 12 ? $hours - 12 : $hours;
                  $period = $hours >= 12 ? 'PM' : 'AM';
                  $display_time = str_pad($display_hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . ' ' . $period;
                  $value_time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                  echo '<option value=' . $value_time . '>' . $display_time . '</option>';
                }
              }
              ?>
            </select>

            <label for="end_time">End Time:</label>
            <select id="end_time" name="end_time" required>
              <?php
              for ($hours = 8; $hours <= 18; $hours++) {
                for ($mins = 0; $mins < 60; $mins += 30) {
                  $display_hours = $hours > 12 ? $hours - 12 : $hours;
                  $period = $hours >= 12 ? 'PM' : 'AM';
                  $display_time = str_pad($display_hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT) . ' ' . $period;
                  $value_time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                  echo '<option value=' . $value_time . '>' . $display_time . '</option>';
                }
              }
              ?>
            </select>
            <!-- Adding duration field -->
            <label for="duration">Appointment Duration (minutes):</label>
            <input type="number" id="duration" name="duration" min="10" value="10" step="5" required>

            <button type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>

    function validateForm() {
      var isFormValid = true;

      var availabilityDate = document.getElementById('availability_date').value;
      if (new Date(availabilityDate) < new Date()) {
        isFormValid = false;
        alert('The availability date should be in greater than today.');
      }

      if (isFormValid) {

        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;

        var start = new Date("01/01/2024 " + startTime);
        var end = new Date("01/01/2024 " + endTime);

        // Calculate the difference in milliseconds
        var difference = end - start;

        // Convert back to hours and round down
        var hoursDifference = Math.floor(difference / 1000 / 60 / 60);

        if (hoursDifference < 1) {
          isFormValid = false;
          alert('The time difference should be at least one hour.');
        }
      }

      return isFormValid;
    }

    function openAddScheduleModal() {
      var modal = document.getElementById("addScheduleModal");
      modal.style.display = "block";
    }

    function closeModal() {
      var modal = document.getElementById("addScheduleModal");
      modal.style.display = "none";
    }

    document.getElementById("addScheduleForm").addEventListener("submit", function (event) {
      if(!validateForm()) {
        event.preventDefault();
        return;
      }

      // event.preventDefault();
      var formData = new FormData(this);
      fetch("./add_schedule.php", {
        method: "POST",
        body: formData
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else if (data.success) {
            alert(data.success);
            closeModal();
            location.reload();
          }
        })
        .catch((error) => {
          alert("Error: " + error.message);
        });
    });


    function deleteSchedule(ScheduleID) {

      fetch("./delete_schedule.php?ScheduleID=" + ScheduleID, {
        method: "GET"
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else if (data.success) {
            alert(data.success);
            location.reload();
          }
        })
        .catch((error) => {
          alert("Error: " + error.message);
        });
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