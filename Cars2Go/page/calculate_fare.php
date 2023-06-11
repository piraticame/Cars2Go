<?php
if (isset($_POST['days']) && isset($_POST['acType'])) {
  $days = $_POST['days'];
  $acType = $_POST['acType'];

  // Assuming you have established a database connection
  // Fetch the fare from the database based on the selected AC type
  $fare = $chargeType;

  // Calculate the total fare
  $totalFare = $fare * $days;

  // Return the total fare as the response
  echo $totalFare;
}
?>
