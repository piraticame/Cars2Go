
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
    <title>Cars2Go</title>
  </head>
<body>
   <header>
    <?php
    include ('header.php');
   ?>
   </header>
   <br>
   <br>
    
   <div class="main-container">
   <?php
// Assuming you have established a database connection

// Fetch data from the SQL table
$query = "SELECT * FROM car_view WHERE status = 'available'";
$result = mysqli_query($conn, $query);

// Loop through the fetched rows to generate clickable divs
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['CarID'];
  $carName = $row['CarName'];
  $PlateNumber = $row['PlateNumber'];
  $ACperDay = $row['ACperDay'];
  $NonACperDay = $row['NonACperDay'];
  $CarImg = $row['CarImg'];

  echo "<div class='car-div' id='div$id'>";
  echo "<a href='checkout.php?id=$id'>";
  echo "<img src='../img/$CarImg' alt=''>";
  echo "<h3><i>$carName</i></h3>";
  echo "<p>Plate Number: $PlateNumber</p>";
  echo "<p>AC per Day:  P$ACperDay</p>";
  echo "<p>Non AC per Day: P$NonACperDay</p>";
  echo "</a>";
  echo "</div>";

}

?>
   </div>

</body>
</html>