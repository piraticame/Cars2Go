<html>
<head>
	<link rel="stylesheet" href="../css/add_employee_style.css">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>

</head>

<body>
	<header>
		<?php
			include('employee-header.php');
		?>
	</header>

	<div class="login">
		<br>
		<h1>ENTER EMPLOYEE DETAILS</h1>
		<br/>
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="dob">
				<div class="box">
					<input type="text" required="required" name="fname">
					<span>First Name</span>
				</div>
				<div class="box">
					<input type="text" required="required" name="lname">
					<span>Last Name</span>
				</div>
			</div>
			<div class="dob">
				<div class="box">
					<input type="text" required="required" name="contact">
					<span>Contact</span>
				</div>
				<div class="box">
					<input type="text" required="required" name="role">
					<span>Role</span>
				</div>
			</div>
			<div class="dob">
				<div class="box">
					<input type="text" required="required" name="username">
					<span>Username</span>
				</div>
				<div class="box">
					<input type="text" required="required" name="password">
					<span>Password</span>
				</div>
			</div>

            
			<div class="dob">
                
				<div class="box" id="2">
					<input type="file" required="required" name="picture">
					<img src="" alt="">
					<span style="margin-bottom: 1rem;">Picture</span>
				</div>
                
			</div>

			<div class="name">
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
$contact = $_POST['contact'];
$role = $_POST['role'];
$imageName = $_FILES['picture']['name'];
$username = $_POST['username'];
$password = $_POST['password'];

// CHECK IF THE USER ALREADY EXISTS
$query = "SELECT * FROM employee_account_view WHERE username = '$username'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo '<script> alert("Username already exists"); </script>';
    exit();
}
else{

    $query = "CALL InsertEmployee(?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $query);
    
    // Bind the parameter values to the prepared statement
    mysqli_stmt_bind_param($stmt1, "sssssss", $fname, $lname, $contact, $role, $imageName, $username, $password);
    $query_run1 = mysqli_stmt_execute($stmt1);
    if ($query_run1) {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $imageName;
    
        mysqli_stmt_close($stmt1);
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }
		echo '<script>
		Swal.fire({
		  icon: "success",
		  title: "Employee Saved",
		  text: "Your Employee has been successfully saved.",
		  showConfirmButton: true
		}).then(() => {
		  window.location.href = "view_employees.php";
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
		  window.location.href = "add_employee.php";
		});
	  </script>';
    }
    
    
}
	}
?>
</html>
