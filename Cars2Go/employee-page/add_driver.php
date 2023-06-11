<html>
    
<head>
	<link rel="stylesheet" href="../css/add_driver_style.css">
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>

	
</head>

<body>
   <header>
    <?php
    include ('employee-header.php');
   ?>
   </header>

  <div class="login">
   <br>
        <h1>ENTER DRIVER DETAILS</h1>
		<br/>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="dob">
            <div class="box">
                <input type="text" required="required" name="fname">
                <span>Firt Name</span>            </div>
            <div class="box">
                <input type="text" required="required" name="lname">
                <span>Last Name</span>            </div>
        </div>
        <div class="dob">
            <div class="box">
                <input type="text" required="required" name="gender">
                <span>Gender</span>            </div>
            <div class="box">
                <input type="text" required="required" name="contact">
                <span>Contact</span>            </div>
        </div>
        <div class="add">
            <div class="box" id="box">
                <input type="text" required="required" name="address">
                <span>Address</span>            
				</div>
        </div>
        <div class="dob">
            <div class="box">
                <input type="text" required="required" name="license">
                <span>License Number</span>            </div>
            <div class="box">
                <input type="date" required="required" name="birthday">
                <span>Birthdate</span>            </div>
        </div>

		 <div class="name"> 
            <div class="box" id="2">
                <input type="file" required="required" name="picture" >
                <img src="" alt="">
                <span style="margin-bottom: 1rem;">Picture</span>
                        
        </div>
    </div>
        <div class="click">
            <button type="submit" name="submit">SUBMIT</button>
        </div>
        </form>
    </div>



</body>
<?php
    if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $birthday = $_POST['birthday'];
    $imageName = $_FILES['picture']['name'];
    //check if license number already exists
    $query = "SELECT * FROM driver_view WHERE License = '$license'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        
		echo '<script>
		Swal.fire({
		  icon: "failed",
		  title: "License exists",
		  text: "Drivers License already used.",
		  showConfirmButton: true
		}).then(() => {
		  window.location.href = "add_driver.php";
		});
	  </script>';
        return;
    }
    else{
        
    // Prepare the stored procedure call
    $query = "CALL InsertDriver(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the parameter values to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $contact, $address, $gender, $birthday, $license, $imageName);
    
    // Execute the stored procedure 
    $query_run = mysqli_stmt_execute($stmt);
    
    if ($query_run) {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $imageName;
    
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }
    
		echo '<script>
		Swal.fire({
		  icon: "success",
		  title: "Driver Saved",
		  text: "Your Driver has been successfully saved.",
		  showConfirmButton: true
		}).then(() => {
		  window.location.href = "view_driver.php";
		});
	  </script>';
	  
    } else {
		echo '<script>
		Swal.fire({
		  icon: "failed",
		  title: "Employee Not Saved",
		  text: "Your Employee is not saved.",
		  showConfirmButton: true
		}).then(() => {
		  window.location.href = "add_driver.php";
		});
	  </script>';
    }
    }
    
    // Close the statement and the database connection
}


?>
</html>
