
<head>
	<link rel="stylesheet" href="../css/add_car_style.css">
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
        <h1>ENTER CAR DETAILS</h1>
		<br/>
		
    <form action="add_car.php" method="POST" enctype="multipart/form-data">
        <div class="name"> 
            <div class="box">
                <input type="text" required="required" name="name">
                <span>CAR NAME</span>            </div>
        </div>
		
		 <div class="add">
           <div class="box" id="box">
                <input type="text" required="required" name="plate">
               <span>PLATE NUMBER</span>			   </div>
        </div>
        <div class="dob">
          <div class="box">
                <input type="number" required="required" name="nonacperday">
              <span>NON AC PER DAY</span>            </div>
            <div class="box">
                <input type="number" required="required" name="acperday">
                <span>AC PER DAY</span>            </div>
        </div>
       
		 <div class="user">
        </div>
		 <div class="name"> 
            <div class="box">
                <input type="file" required="required" name="image" accept="jpg" max="2MB">
                         </div>
            
        </div>
        <div class="click">
            <button type="submit" name="submit">SUBMIT</button>
        </div>
    </div>
    </form>


</body>
<?php
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $plate = $_POST['plate'];
    $nonacperday = $_POST['nonacperday'];
    $acperday = $_POST['acperday'];
    $imageName = $_FILES['image']['name'];
    
    // Prepare the stored procedure call
    $query = "CALL InsertCarView(?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the parameter values to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssdds", $name, $plate, $acperday, $nonacperday, $imageName);
    
    // Execute the stored procedure
    $query_run = mysqli_stmt_execute($stmt);
    
    if ($query_run) {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $imageName;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }echo 
        '<script>
        Swal.fire({
          icon: "success",
          title: "Car added!",
          text: "Your Car has been successfully saved.",
          showConfirmButton: true
        }).then(() => {
          window.location.href = "view_cars.php";
        });
      </script>';
      $lastInsertedID = mysqli_insert_id($conn);

      // Add the current $_SESSION ID into the logs table
      $sessionID = $_SESSION['CusID'];
      $logSql = "INSERT INTO emplogs_view (CusID, Timestamp, Action) VALUES ('" . $_SESSION['CusID'] . "', NOW(), 'Added a car')";
$logResult = mysqli_query($conn, $logSql);

    } else {
        echo 
        '<script>
        Swal.fire({
          icon: "success",
          title: "Car added!",
          text: "Your Car has been successfully saved.",
          showConfirmButton: true
        }).then(() => {
          window.location.href = "add_cars.php";
        });
      </script>';
      
    }
    
    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
</html>
