<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../css/add_driver_style.css">
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

	
</head>

<body>
   <header>
    <?php
    include ('employee-header.php');
   ?>
   </header>

   <?php
   
if (isset($_POST['DriverID'])) {   
  $_SESSION['DriverID'] = $_POST['DriverID'];
}
   $sql = "SELECT * FROM driver_view WHERE DriverID = " . $_SESSION['DriverID'];
   $result = mysqli_query($conn, $sql);
   if ($result) {
     $row = mysqli_fetch_assoc($result);
      $driverID = $row['DriverID'];
      $fname = $row['FirstName'];
      $lname = $row['LastName'];
      $contact = $row['Contact'];
      $address = $row['Address'];
      $gender = $row['Gender'];
      $bday = $row['DateOfBirth'];
      $license = $row['License'];
      $status = $row['status'];
      $driverImg = $row['DriverImg'];

     
   } else {
     // Error handling in case the query fails
     echo "Error: " . mysqli_error($conn);
   }
   ?>
  <div class="login">
   <br>
        <h1>UPDATE DRIVER DETAILS</h1>
		<br/>
		
        <div class="name"> 
          <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" readonly name="driverID" value="<?php echo $driverID; ?>">

              <span>Driver ID</span>            </div>
        </div>
		
        <div class="dob">   
          <div class="box">
                <input type="text" name="fname" value="<?php echo $fname; ?>">
                <span>First Name</span>            </div>
        
          <div class="box">
                <input type="text" name="lname" value="<?php echo $lname; ?>">
              <span>Last Name</span>            </div>
        </div>  

        
        <div class="dob">   
          <div class="box">
                <input type="text" name="contact" value="<?php echo $contact; ?>">
                <span>Contact</span>            </div>
        
          <div class="box">
                <input type="text" name="address" value="<?php echo $address; ?>">
              <span>Address</span>            </div>
        </div>  

        
        <div class="dob">   
          <div class="box">
                <input type="text" name="gender" value="<?php echo $gender; ?>">
                <span>Gender</span>            </div>
        
          <div class="box">
                <input type="date" name="bday" value="<?php echo $bday; ?>">
              <span>Birthdate</span>            </div>
        </div>  
        
        <div class="dob">   
          <div class="box">
                <input type="text" name="license" value="<?php echo $license; ?>">
                <span>License Number</span>            </div>
        
          <div class="box">
                <input type="text" name="status" value="<?php echo $status; ?>">
              <span>Status</span>            </div>
        </div>  
        
        
        <div class="name"> 
          <div class="box">
            <input type="file" name="image" value="<?php echo $driverImg; ?>">

              <span>Driver Image</span>            </div>
        </div>
      
		
		 <div class="name"> 
            
        </div>
        <div class="click">
            <button type="submit" name="submit">SAVE EDIT</button>
        </div>
        </form>
    </div>
    <?php
if (isset($_POST['submit'])) {
    $driverID = $_POST['driverID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $license = $_POST['license'];
    $status = $_POST['status'];
    $driverImg2 = $_FILES['image']['name'];

    // Check if a new image is uploaded or not
    if ($_FILES['image']['name'] !== '') {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $driverImg2;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }
    } else {
        // No new image uploaded, retain the original value
        $driverImg2 = $driverImg;
    }

    // Update the table in SQL
    $sql = "UPDATE driver_view SET 
            FirstName = '$fname',
            LastName = '$lname',
            Contact = '$contact',
            Address = '$address',
            Gender = '$gender',
            DateOfBirth = '$bday',
            License = '$license',
            Status = '$status',
            DriverImg = '$driverImg2'
            WHERE DriverID = '$driverID'";

    if (mysqli_query($conn, $sql)) {
        // Successful update
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Update Successful',
                    text: 'Driver details have been updated.',
                    showConfirmButton: true
                }).then(() => {
                    window.location.href = 'view_driver.php';
                });
            </script>";
    } else {
        // Error handling in case the update fails
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'An error occurred while updating the driver details.',
                    confirmButtonText: 'Retry'
                });
            </script>";
    }
}
?>



</body>
</html>
