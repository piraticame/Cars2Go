
<head>
	<link rel="stylesheet" href="../css/add_car_style.css">
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
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
		
		<br>
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
        }
    
        echo '<script> alert("Data Saved"); </script>';
    } else {
        echo '<script> alert("Data Not Saved"); </script>';
    }
    
    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
</html>
