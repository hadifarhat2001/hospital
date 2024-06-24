<?php
require_once "./appoitmnets/getpastappoitments.php";
require_once "./appoitmnets/getcurrentappoitments.php";
require_once "./medicalHistory/getMedicalHistory.php";
require_once "./billing/getPastPayments.php";
require_once "./billing/getUpcomingPayment.php";
require_once "./labTest/getPastLabTest.php";
require_once "./labTest/getUpcomingLabTest.php";
require_once "./appoitmnets/addApointment.php/getDoctorList.php";
require_once "./appoitmnets/addApointment.php/getAvilableRoomList.php";
require_once "./appoitmnets/addApointment.php/view_schedule.php";
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

            </div>
            <div class="quote_btn-container">
              <a href="../profile/index.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>profile</span>
              </a>
              <a href="./../logout/logout.php">
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
    <!-- hon 7a nballech n7et plan taba3na for the dashboard we need 4 cards  -->
    <section id="APPOINTMENTS">
      <div class="tab-container">
        <!-- Tab buttons -->
        <div class="tab-buttons">
          <div class="tab-button tab-button-appoitment active" onclick="openTabAppoitment(event, 'history-appoitment')">
            History
          </div>
          <div class="tab-button tab-button-appoitment" onclick="openTabAppoitment(event, 'upcoming-appoitment')">
            Upcoming Appointments
          </div>
        </div>

        <!-- Tab content: History -->
        <div id="history-appoitment" class="tab tab-appoitment active">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>roomNumber</th>
                <th>AppointmentDateTime</th>
                <th>doctorName</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($pastAppointments as $row): ?>
                <tr>
                  <td><?php echo $row['appointmentID']; ?></td>
                  <td><?php echo $row['roomName']; ?></td>
                  <td><?php echo $row['AppointmentDateTime']; ?></td>
                  <td><?php echo $row['doctorName']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
        </div>

        <!-- Tab content: Upcoming  -->
        <div id="upcoming-appoitment" class="tab tab-appoitment upcoming">
          <div class="table-header">
            <button class="btn add-appoitment" onclick="openAddAppointmentModal()">
              Add New Appointment
            </button>
          </div>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>roomNumber</th>
                <th>AppointmentDateTime</th>
                <th>doctorName</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php foreach ($currentAppointments as $row): ?>
                <tr>
                  <td><?php echo $row['appointmentID']; ?></td>
                  <td><?php echo $row['roomName']; ?></td>
                  <td><?php echo $row['AppointmentDateTime']; ?></td>
                  <td><?php echo $row['doctorName']; ?></td>
                  <td>

                    <button class="btn delete-btn" onclick="deleteAppoitment(<?php echo $row['appointmentID']; ?>)">
                      Delete
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal for adding appointment -->
      <div id="addAppointmentModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeModal()">&times;</span>
          <h2>Add New Appointment</h2>
          <form id="addAppointmentForm">

            <label for="specialty">Specialty:</label>
            <select id="specialty" name="specialty" required onchange="updateClassData()">
              <option value="">Select Specialty</option>
              <?php
              $uniqueSpecialties = array_unique(array_column($doctorSchedule, 'specialty'));
              foreach ($uniqueSpecialties as $specialty): ?>
                <option value="<?php echo $specialty; ?>"><?php echo $specialty; ?></option>
              <?php endforeach; ?>
            </select>
            <!-- Dropdown for selecting doctor -->
            <label for="doctor">Doctor:</label>
            <select id="doctor" name="doctor" required>
              <?php
              $uniquedoctor = array_unique(array_column($doctorSchedule, 'id'));

              foreach ($doctorSchedule as $uniquedoctor): ?>
                <?php $fullName = $doctor['FirstName'] . ' ' . $doctor['LastName']; ?>
                <option value="<?php echo $doctor['DoctorID']; ?>"><?php echo $fullName; ?></option>
              <?php endforeach; ?>
            </select>

            <!-- Dropdown for selecting room -->
            <label for="room">Room:</label>
            <select id="room" name="room" required >
              <option value="">Select Room</option>
              <?php foreach ($roomsList as $room): ?>
                <option value="<?php echo $room['RoomID']; ?>"><?php echo $room['RoomNumber']; ?></option>
              <?php endforeach; ?>
            </select>

            <!-- Dropdown for selecting date -->
            <label for="date">Appointment Date:</label>
            <select id="date" name="date" required onchange="updateTimeOptions()">
              <option value="">Select Appointment Date</option>
              <?php
              $dates = array();
              foreach ($doctorSchedule as $dateTime):
                $date = $dateTime['availability_date'];
                if (!in_array($date, $dates)) {
                  $dates[] = $date;
                  echo '<option value="' . $date . '">' . $date . '</option>';
                }
              endforeach;
              ?>
            </select>

            <!-- Dropdown for selecting time -->
            <label for="time">Appointment Time:</label>
            <select id="time" name="time" required>
              <option value="">Select Appointment Time</option>
            </select>




            <button type="submit">Submit</button>
          </form>
          <script>

            // Call updateTimeOptions to populate the time dropdown initially
            updateTimeOptions();
            var appointments = []; // fetch the appointments from your database and echo them here

            async function fetchAppointments(doctorId, date) {
              if (doctorId === null || date === null || typeof doctorId === 'undefined' || typeof date === 'undefined') {
                return; // Exit early if either doctorId or date is not provided or undefined
              }

              const url = `./appoitmnets/getAppointmentsList.php?doctorId=${doctorId}&date=${date}`;
              try {
                const response = await fetch(url);
                const data = await response.json();
                $appointments = data;  // Make sure this assignment is done before calling updateTimeOptions
              } catch (error) {
                console.error('Failed to fetch appointments:', error);
              }
            }
          </script>
        </div>
      </div>

      <script>
        var doctorId; // declare doctorId outside the event listener
        var date; // declare date outside the event listener
        var appointments = []; // fetch the appointments from your database and echo them here

        // fetchAppointments(doctorId, date);  // Make sure to define these variables or get them from appropriate sources



        document.getElementById('doctor').addEventListener('change', function () {
          doctorId = this.value;
          date = document.getElementById('date').value; // get the selected date
          // fetchAppointments(doctorId, date);  // Make sure to define these variables or get them from appropriate sources
        });

        document.getElementById('date').addEventListener('change', function () {
          date = this.value;
          // fetchAppointments(doctorId, date);  // Make sure to define these variables or get them from appropriate sources
        });

        // Function to update the time options based on the selected date and doctor
        async function updateTimeOptions() {
          var dateSelect = document.getElementById('date');
          var doctorSelect = document.getElementById('doctor');
          var timeSelect = document.getElementById('time');
          var duration = document.getElementById('duration');


          var selectedDate = dateSelect.options[dateSelect.selectedIndex].value;
          var selectedDoctor = doctorSelect.options[doctorSelect.selectedIndex].value;

          await fetchAppointments(selectedDoctor, selectedDate);  // Make sure to define these variables or get them from appropriate sources

          // Clear the time options
          timeSelect.options.length = 0;
          var doctorSchedule = <?php echo json_encode($doctorSchedule); ?>;
          var doctorAppointments = $appointments.filter(appointment => appointment.DoctorID == selectedDoctor);
          // Add the time options for the selected date
          doctorSchedule.forEach(schedule => {
            if (schedule.availability_date == selectedDate && schedule.DoctorID == selectedDoctor) {
              var start = new Date(schedule.availability_date + ' ' + schedule.start_time);
              var end = new Date(schedule.availability_date + ' ' + schedule.end_time);
              var duration = schedule.duration;

              while (start < end) {
                // Check if the time slot is reserved
                var isReserved = doctorAppointments.some(appointment => {
                  var appointmentDate = new Date(appointment.AppointmentDateTime);
                  return appointmentDate.getTime() == start.getTime();
                });

                if (!isReserved) {
                  var option = document.createElement('option');
                  option.value = start.toTimeString().split(' ')[0];
                  option.text = start.toTimeString().split(' ')[0];

                  timeSelect.add(option);
                }
                // Add duration minutes to the start time
                start.setMinutes(start.getMinutes() + duration);
              }
            }
          });
        }


        function updateClassData() {
          let selectedOption = document.getElementById('specialty').selectedOptions[0];
          let doctorSelect = document.getElementById('doctor');
          doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
          let filtereddoctors = <?php echo json_encode($doctorSchedule); ?>.filter(
            schedule => schedule.specialty == selectedOption.value
          );

          let addedDoctorIds = [];
          filtereddoctors.forEach(doctor => {
            if (!addedDoctorIds.includes(doctor.DoctorID)) {
              let option = document.createElement('option');
              option.value = doctor.DoctorID;
              option.textContent = doctor.FirstName + ' ' + doctor.LastName;
              option.setAttribute('data-specialty', doctor.specialty);
              doctorSelect.appendChild(option);
              addedDoctorIds.push(doctor.DoctorID);
            }
          });
        }

        updateClassData();
        // functions for appoitment
        function openTabAppoitment(evt, tabName) {
          var i, tabContent, tabButtons;
          tabContent = document.getElementsByClassName("tab-appoitment");
          for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
          }
          tabButtons = document.getElementsByClassName(
            "tab-button-appoitment"
          );
          for (i = 0; i < tabButtons.length; i++) {
            tabButtons[i].className = tabButtons[i].className.replace(
              " active",
              ""
            );
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
        }

        function openAddAppointmentModal() {
          var modal = document.getElementById("addAppointmentModal");
          modal.style.display = "block";
        }

        function closeModal() {
          var modal = document.getElementById("addAppointmentModal");
          modal.style.display = "none";
        }

        document.getElementById("addAppointmentForm").addEventListener("submit", function (event) {
          event.preventDefault();
          var formData = new FormData(this);

          // Additional code for fetching
          // Concatenate date and time
          var date = formData.get('date');
          var time = formData.get('time');
          var dateTime = date + ' ' + time;
          formData.set('dateTime', dateTime);
          // Remove the separate date and time from the form data
          formData.delete('date');
          formData.delete('time');

          fetch("./appoitmnets/addApointment.php/addAppointment.php", {
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
              }
            })
            .catch((error) => {
              alert("Error: " + error.message);
            });
        });

        function deleteAppoitment(appointmentID) {

          fetch("./appoitmnets/deleteAppointment.php?appointmentID=" + appointmentID, {
            method: "GET"
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.error) {
                alert(data.error);
              } else if (data.success) {
                alert(data.success);
              }
            })
            .catch((error) => {
              alert("Error: " + error.message);
            });
        }
      </script>
    </section>

    <!-- section for payments -->
    <section id="PAYMENTS">
      <div class="tab-container">
        <!-- Tab buttons -->
        <div class="tab-buttons">
          <div class="tab-button tab-button-payment active" onclick="openTabPayment(event, 'history-payment')">
            Past Payments
          </div>
          <div class="tab-button tab-button-payment" onclick="openTabPayment(event, 'upcoming-payment')">
            To Be Paid
          </div>
        </div>

        <!-- Tab content: History -->
        <div id="history-payment" class="tab tab-payment active">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pastPayments as $row): ?>
                <tr>
                  <td><?php echo $row['PaymentID']; ?></td>
                  <td><?php echo $row['AmountPaid']; ?></td>
                  <td><?php echo $row['PaymentDate']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Tab content: Upcoming Events -->
        <div id="upcoming-payment" class="tab tab-payment upcoming">
          <div class="table-header">
          </div>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Total Amount</th>
                <th>Billing date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($upcomingPayments as $row): ?>
                <tr>
                  <td><?php echo $row['BillingID']; ?></td>
                  <td><?php echo $row['TotalAmount']; ?></td>
                  <td><?php echo $row['BillingDate']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <script>
        // functions for payments
        function openTabPayment(evt, tabName) {
          var i, tabContent, tabButtons;
          tabContent = document.getElementsByClassName("tab-payment");
          for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
          }
          tabButtons = document.getElementsByClassName("tab-button-payment");
          for (i = 0; i < tabButtons.length; i++) {
            tabButtons[i].className = tabButtons[i].className.replace(
              " active",
              ""
            );
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
        }
      </script>
    </section>

    <!-- section for medical history -->
    <section id="medicalHistory">
      <div class="tab-container">
        <!-- Tab buttons -->
        <div class="tab-buttons">
          <div class="tab-button tab-button-medicalHistory active">
            History
          </div>
        </div>

        <!-- Tab content: History -->
        <div id="history-medicalHistory" class="tab tab-medicalHistory active">
        <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Doctor Name</th>
                  <th>Medication Name</th>
                  <th>Dosage</th>
                  <th>Prescription Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <?php foreach ($medicalHistory as $row): ?>
                <tr >
                    <td><?php echo $row['PrescriptionID']; ?></td>
                    <td><?php echo $row['DoctorName'];?></td>
                    <td><?php echo $row['Medication']; ?></td>
                    <td><?php echo $row['Dosage']; ?></td>
                    <td><?php echo $row['PrescriptionDate']; ?></td>
                </tr>
              <?php endforeach; ?>
                </tr>
              </tbody>
            </table>
        </div>

      </div>
    </section>

    <!-- test lab / results -->

    <section id="testlab">
      <div class="tab-container">
        <!-- Tab buttons -->
        <div class="tab-buttons">
          <div class="tab-button tab-button-testLab active" onclick="openTabTestlab(event, 'history-testLab')">
            History
          </div>
          <div class="tab-button tab-button-testLab" onclick="openTabTestlab(event, 'upcoming-testLab')">
            Upcoming Lab test
          </div>
        </div>

        <!-- Tab content: History -->
        <div id="history-testLab" class="tab tab-testLab active">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Test Name</th>
                <th>Test Date</th>
                <th>Results</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pastLabTest as $row): ?>
                <tr>
                  <td><?php echo $row['TestID']; ?></td>
                  <td><?php echo $row['TestName']; ?></td>
                  <td><?php echo $row['TestDate']; ?></td>
                  <td><?php echo $row['Result']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Tab content: Upcoming Events -->
        <div id="upcoming-testLab" class="tab tab-testLab upcoming">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Test Name</th>
                <th>Test Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($upcomingLabTest as $row): ?>
                <tr>
                  <td><?php echo $row['TestID']; ?></td>
                  <td><?php echo $row['TestName']; ?></td>
                  <td><?php echo $row['TestDate']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <script>
        // functions for Testlab
        function openTabTestlab(evt, tabName) {
          var i, tabContent, tabButtons;
          tabContent = document.getElementsByClassName("tab-testLab");
          for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
          }
          tabButtons = document.getElementsByClassName("tab-button-testLab");
          for (i = 0; i < tabButtons.length; i++) {
            tabButtons[i].className = tabButtons[i].className.replace(
              " active",
              ""
            );
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
        }
      </script>
    </section>
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
