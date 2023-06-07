
<head>
	<link rel="stylesheet" href="../css/inventory_style.css">
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
	
</head>

<body>
 <header>
    <?php
    include ('employee-header.php');
   ?>
   </header>
   
   
  <div class="editablecontents">
      <div class="container">
        <div class="filter-div">
        <div class="button-form">
        <form action="" method="POST" name="myform">
          
        <input type="text" name="search" placeholder="search">
        
  <button type="submit" name="filter-search"><img src="../img/search-icon.png" class="icon"></button>
</form>

        </div>
        </div>
        <br />

        <?php
          if(isset($_POST['filter-search']) && isset($_POST['search'])){
            $search = $_POST['search'];
            if($search == ''){
             //alert please input valid search and reload
              echo '<script type="text/javascript">alert("Please input valid search");</script>';

              $query = "SELECT * FROM car_view";
              $query_run = mysqli_query($conn, $query);
              //table to display information of the cars
              echo "<table class='table'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Car ID</th>";
              echo "<th>Car Name</th>";
              echo "<th>Plate Number</th>";
              echo "<th>AC per Day fee</th>";
              echo "<th>Non-AC per Day fee</th>";
              echo "<th>Status</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while($row = mysqli_fetch_array($query_run)){
                echo "<tr>";
                echo "<td>" . $row['CarID'] . "</td>";
                echo "<td>" . $row['CarName'] . "</td>";
                echo "<td>" . $row['PlateNumber'] . "</td>";
                echo "<td>" . $row['ACperDay'] . "</td>";
                echo "<td>" . $row['NonACperDay'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
  
            }
            else{
              $stmt = $conn->prepare("SELECT * FROM car_view WHERE LOWER(CarName) LIKE ? OR LOWER(status) LIKE ?");
              $searchTerm = '%' . strtolower($search) . '%';
              $stmt->bind_param("ss", $searchTerm, $searchTerm);
              $stmt->execute();
              $result = $stmt->get_result();
              
            //table to display information of the cars
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Car ID</th>";
            echo "<th>Car Name</th>";
            echo "<th>Plate Number</th>";
            echo "<th>AC per Day fee</th>";
            echo "<th>Non-AC per Day fee</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row['CarID'] . "</td>";
              echo "<td>" . $row['CarName'] . "</td>";
              echo "<td>" . $row['PlateNumber'] . "</td>";
              echo "<td>" . $row['ACperDay'] . "</td>";
              echo "<td>" . $row['NonACperDay'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            }
          }
          else{
            
            $query = "SELECT * FROM car_view";
            $query_run = mysqli_query($conn, $query);
            //table to display information of the cars
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Car ID</th>";
            echo "<th>Car Name</th>";
            echo "<th>Plate Number</th>";
            echo "<th>AC per Day fee</th>";
            echo "<th>Non-AC per Day fee</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($query_run)){
              echo "<tr>";
              echo "<td>" . $row['CarID'] . "</td>";
              echo "<td>" . $row['CarName'] . "</td>";
              echo "<td>" . $row['PlateNumber'] . "</td>";
              echo "<td>" . $row['ACperDay'] . "</td>";
              echo "<td>" . $row['NonACperDay'] . "</td>";
              echo "<td>" . $row['status'] . "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

          }
        
        ?>
      </div>
  

  </div>
  <br />

</body>
</html>
