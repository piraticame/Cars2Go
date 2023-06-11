<?php
if (isset($_GET['id'])) {
  // Retrieve the value of the 'id' parameter
  $id = $_GET['id'];
} else {
  // Handle the case when the 'id' parameter is not set
  $id = 0; // Provide a default value or take appropriate action
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/checkout.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>


</head>
<body>
   <header>
    <?php
    include ('header.php');
   ?>
   </header>

   <div class="main">
     <h2 id="title">CAR BOOKING FORM</h2>
     <p id="description">
       Fill details below to complete your booking
     </p>

     <?php
     $sql = "SELECT * FROM car_view WHERE CarID = $id";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($result);
     $carName = $row['CarName'];
     $PlateNumber = $row['PlateNumber'];
     $ACperDay = $row['ACperDay'];
     $NonACperDay = $row['NonACperDay'];
     $CarImg = $row['CarImg'];
     ?>

    <div class="main-content">
      <div class="form-content">
        <form id="survey-form" method="post">
          <div class="car-details">
            <div class="car-text-fields">
              <label for="name" id="name-label">Selected Car</label>
              <input id="name" name="carname" type="text" value="<?php echo $carName ?>" readonly size="20"/>
              <label for="number" id="number-label">Number Plate</label>
              <input id="number" name="platenumber" type="text" value="<?php echo $PlateNumber ?>" readonly size="20" />
            </div>
            <img class="car-image" src="../img/<?php echo $CarImg; ?>" alt="Car Image">
          </div>

          <div class="date-wrapper">
            <label for="start-date" id="date-label">Start Date</label>
            <input id="start-date" name="startdate" type="date" required />&nbsp &nbsp
            <label for="end-date" id="date-label">End Date</label>
            <input id="end-date" name="enddate" type="date" required />
          </div>

          <fieldset>
  <legend>Choose Car Type</legend>
  <input type="radio" name="ac" id="AC" value="1" /><label for="AC">With AC</label><br />
  <input type="radio" name="ac" id="NonAC" value="0" /><label for="NonAC">Without AC</label><br />
</fieldset>

          <br>

          <label for="fare" id="number-label">Fare</label>
          <input id="fare" name="fare" type="number" readonly required/>

          <label for="dropdown">Select Driver</label>
          <?php
          $sql = "SELECT * FROM driver_view WHERE status = 'active'";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            // Print the opening select tag
            echo "<select name='driver' id='driver'>";
            echo "<option value=''>Select Driver</option>";

            while ($row = mysqli_fetch_assoc($result)) {
              $driverGender = $row['Gender']; 
              $driverContact = $row['Contact'];
              echo "<option value='" . $row['DriverID'] . "'>" . $row['FirstName'] . ' ' . $row['LastName'] . "</option>";
            }

            // Print the closing select tag
            echo "</select>";
          } else {
            // Handle the case when no available drivers are found
            echo "No available drivers.";
          }
          ?>

          <label for="gender" id="gender-label">Gender</label>
          <input id="gender" name="gender" type="text" value="" readonly required/>
          <label for="contact" id="contact-label">Contact</label>
          <input id="contact" name="contact" type="text" value=""  readonly required/>

          <button type="submit" name="submit" id="submit">RENT NOW</button>
        </form>
      </div>
    </div>
  </div>
  <?php
if (isset($_POST['submit'])) {
  $carname = $_POST['carname'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];
  $ac = $_POST['ac'];
  $cusId = $_SESSION['CusID'];
  $carId = $_GET['id'];


  if ($ac == 1) {
    $chargeType = $ACperDay;
  } else {
    $chargeType = $NonACperDay;
  }

  // Assuming you have established a database connection
  $fare = $chargeType; // Assign the fare based on the selected AC type

  // Retrieve the selected driver ID
  $driverId = $_POST['driver'];

  // Insert the booking data into the database
  $sql = "INSERT INTO booking (CusID, CarID, CarName, StartDate, EndDate, AC, ChargeType, TotalCharge, penalty, DriverID, status) 
          VALUES ('$cusId', '$carId', '$carname', '$startdate', '$enddate', '$ac', '$chargeType', '$fare', '', '$driverId', 'waiting')";

  $result = mysqli_query($conn, $sql);
  if ($result) {
  echo "<script>
    Swal.fire({
      title: 'Car Booked',
      text: 'You have successfully booked the car!',
      icon: 'success',
      confirmButtonText: 'OK'
    }).then(() => {
      window.location.href = 'view_booked_cars.php';
    });
  </script>";
} else {
  echo "<script>
    Swal.fire({
      title: 'Error',
      text: 'An error occurred while booking the car.',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  </script>";
}

}

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Retrieve gender and contact details based on the selected driver
    $('#driver').change(function() {
      const driverId = $(this).val();
      $.ajax({
        url: 'fetch_driver_details.php',
        method: 'POST',
        data: { driverId: driverId },
        success: function(response) {
          const { gender, contact } = JSON.parse(response);
          $('#gender').val(gender);
          $('#contact').val(contact);
        }
      });
    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  

    const startDateInput = document.querySelector("#start-date");
    const endDateInput = document.querySelector("#end-date");
    const fareInput = document.querySelector("#fare");
    const acRadios = document.querySelectorAll("input[name='ac']");

    // Calculate the number of days between start date and end date
    const calculateDays = () => {
      const startDate = new Date(startDateInput.value);
      const endDate = new Date(endDateInput.value);
      const timeDiff = endDate.getTime() - startDate.getTime();
      const days = Math.ceil(timeDiff / (1000 * 3600 * 24));
      return days;
    };

    // Update the fare based on the selected AC type and number of days
    const updateFare = () => {
      const days = calculateDays();
      const acType = document.querySelector("input[name='ac']:checked").value;

      // Update the fare based on the selected AC type
      const fare = acType === "1" ? <?php echo $ACperDay; ?> : <?php echo $NonACperDay; ?>;
      fareInput.value = fare * days;
    };

    // Listen for changes in the start date, end date, and AC type
    startDateInput.addEventListener("change", updateFare);
    endDateInput.addEventListener("change", updateFare);
    acRadios.forEach(radio => radio.addEventListener("change", updateFare));
  });
</script>
</body>
</html>

