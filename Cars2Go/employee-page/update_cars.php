<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../css/add_car_style.css">
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
   
if (isset($_POST['CarID'])) {
  $_SESSION['CarID'] = $_POST['CarID'];
}
   $sql = "SELECT * FROM car_view WHERE CarID = " . $_SESSION['CarID'];
   $result = mysqli_query($conn, $sql);
   if ($result) {
     $row = mysqli_fetch_assoc($result);
   
     $carID = $row['CarID'];
     $carName = $row['CarName'];
     $plateNumber = $row['PlateNumber'];
     $acPerDay = $row['ACperDay'];
     $nonACPerDay = $row['NonACperDay'];
     $status = $row['status'];
     $carImg = $row['CarImg'];  
     
   } else {
     // Error handling in case the query fails
     echo "Error: " . mysqli_error($conn);
   }
   ?>
  <div class="login">
   <br>
        <h1>UPDATE CAR DETAILS</h1>
		<br/>
		
        <div class="name"> 
          <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" readonly name="carID" value="<?php echo $carID; ?>">

              <span>CAR ID</span>            </div>
            <div class="box">
                <input type="text" required="required" name="carName" value="<?php echo $carName; ?>">
                <span>CAR NAME</span>            </div>
        </div>
		
		 <div class="add">
           <div class="box" id="box">
                <input type="text" required="required" name="plateNumber"  value="<?php echo $plateNumber; ?>">
               <span>PLATE NUMBER</span>			   </div>
        </div>
        <div class="dob">   
          <div class="box">
                <input type="text" required="required" name="acPerDay" value="<?php echo $acPerDay; ?>">
                <span>AC PER DAY</span>            </div>
        
          <div class="box">
                <input type="text" required="required" name="nonACPerDay" value="<?php echo $nonACPerDay; ?>">
              <span>NON AC PER DAY</span>            </div>
        </div>  
       
        <div class="dob">   
           <div class="box">
                <input type="text" required="required" name="status" value="<?php echo $status; ?>">
               <span>status</span>            </div>
           
               <div class="box">
                <input type="file" value="<?php echo $carImg; ?>" name="image" accept="jpg,png">
                <span>Img</span>   
                         </div>
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
    $carID = $_POST['carID'];
    $carName = $_POST['carName'];
    $plateNumber = $_POST['plateNumber'];
    $acPerDay = $_POST['acPerDay'];
    $nonACPerDay = $_POST['nonACPerDay'];
    $status = $_POST['status'];
    $carImg2 = $_FILES['image']['name'];

    // Check if a new image is uploaded or not
    if ($_FILES['image']['name'] !== '') {
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . $carImg2;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image uploaded successfully
        }
    } else {
        // No new image uploaded, retain the original value
        $carImg2 = $carImg;
    }

    $sql = "UPDATE car_view SET CarName = '$carName', PlateNumber = '$plateNumber', ACperDay = '$acPerDay', NonACperDay = '$nonACPerDay', status = '$status', CarImg = '$carImg2' WHERE CarID = '$carID'";
    $sql = mysqli_query($conn, $sql);
    if ($sql) {
      echo "
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Car Info Updated',
          text: 'Car information has been successfully updated.'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'view_cars.php';
          }
        });
      </script>
      ";
    }
    
}
?>


</body>
</html>
