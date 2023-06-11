<html>
<head>
	
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/add_employee_style.css">
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
if (isset($_POST['EmpID'])) {
    $_SESSION['EmpID'] = $_POST['EmpID'];
    
  }
    $sql = "SELECT * FROM employee_view WHERE EmpID = " . $_SESSION['EmpID'];
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $row = mysqli_fetch_assoc($result);
    
      $empID = $row['EmpID'];
      $fname = $row['FirstName'];
      $lname = $row['LastName'];
      $contact = $row['Contact'];
      $role = $row['role'];
      $status = $row['status'];
      $EmployeeImg = $row['EmployeeImg'];
      
    } else {
      // Error handling in case the query fails
      echo "Error: " . mysqli_error($conn);
    }
    $sql = "SELECT * FROM employee_account_view WHERE EmpID = " . $_SESSION['EmpID'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($result){
        $username = $row['username'];
      $password = $row['password'];  
    }
    else{
        mysqli_error($conn);
    }
?>
  <div class="login">
   <br>
        <h1>UPDATE EMPLOYEE DETAILS</h1>
		<br/>
		<form action="update_employee.php" method="POST" enctype="multipart/form-data">

		  <div class="name"> 
            <div class="box">
                <input type="text" readonly name="id" value="<?php echo $empID; ?>">
                <span>Employee ID</span>            </div>
          
        </div>
		
		
        <div class="name"> 
            <div class="box">
                <input type="text" required="required" name="fname" value="<?php echo $fname; ?>">
                <span>First Name</span>            </div>
            <div class="box">
                <input type="text" required="required" name="lname" value="<?php echo $lname; ?>">
                <span>Last Name</span>            </div>
        </div>
        <div class="dob">
            <div class="box">
                <input type="text" required="required" name="contact" value="<?php echo $contact; ?>">
                <span>Contact</span>            </div>
                <div class="box">
                <input type="file" name="image" accept="jpg,png" value="<?php echo $EmployeeImg; ?>">
                <span>Img</span>   
                         </div>
        </div>
        <div class="dob">
  <fieldset>
    <legend>Role</legend>
    <label for="Admin">
      <input type="radio" value="admin" name="role" id="admin" <?php echo ($role == 'admin') ? 'checked' : ''; ?>>
      <span>Admin</span>
    </label>

    <label for="Employee">
      <input type="radio" value="employee" name="role" id="employee" <?php echo ($role == 'employee') ? 'checked' : ''; ?>>
      <span>Employee</span>
    </label>
  </fieldset>

  <fieldset>
    <legend>Status</legend>
    <label for="active">
      <input type="radio" value="active" name="status" id="active" <?php echo ($status === 'active') ? 'checked' : ''; ?>>
      <span>active</span>
    </label>

    <label for="inactive">
      <input type="radio" value="inactive" name="status" id="inactive" <?php echo ($status === 'inactive') ? 'checked' : ''; ?>>
      <span>inactive</span>
    </label>
  </fieldset>
</div>

		
        
 
        <div class="user">
            <div class="box">
                <input type="text" required="required" name="username" value="<?php echo $username; ?>">
                <span>Username</span>            </div>
            <div class="box">
                <input type="text" required="required" name="password" value="<?php echo $password; ?>">
                <span>Password</span>            </div>
        </div>
		

        <div class="click">
            <button type="submit" name="submit">Save Edit</button>
        </div>
</form>
  </div>

<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $image2 = $_FILES['image']['name'];
    
    // Check if a new image is uploaded or not
    if ($_FILES['image']['name'] !== '') {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $image2;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }
    } else {
        // No new image uploaded, retain the original value
        $image2 = $EmployeeImg;
    }

    $sql = "UPDATE employee_view SET FirstName = '$fname', LastName = '$lname', Contact = '$contact', role = '$role', status = '$status', EmployeeImg = '$image2' WHERE EmpID = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $sql = "UPDATE employee_account_view SET username = '$username', password = '$password' WHERE EmpID = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Employee Updated Successfully!',
                showConfirmButton: true
            }).then(function() {
                window.location.href = 'view_employees.php';
            });
        </script>";
        
            
        }
        else{
            echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Employee Update Failed!',
        text: 'Please try again.',
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'view_employees.php';
        }
    });
</script>";

            
        }
    }

}
?>


</body>
</html>
