<?php

include('../database/config.php');
$driverId = $_POST['driverId'];

// Fetch the driver details from the database based on the driver ID
$sql = "SELECT Gender, Contact FROM driver_view WHERE DriverID = $driverId";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $gender = $row['Gender'];
  $contact = $row['Contact'];

  // Return the driver details in JSON format
  echo json_encode(array('gender' => $gender, 'contact' => $contact));
} else {
  // Handle the case when the driver details are not found
  echo json_encode(array('gender' => '', 'contact' => ''));
}
?>
