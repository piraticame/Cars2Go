
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Tables</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../css/inventory_page.css">
</head>

<body>
<header>
    <?php
    include ('employee-header.php');


   ?>
   </header>
   
   <div class="one">
        <h1>INVENTORY</h1>
</div>


  <div class="container">

    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th scope="col">Car ID</th>
          <th scope="col">Car Name</th>
          <th scope="col">Plate Number</th>
          <th scope="col">AC Per Day Fee</th>
          <th scope="col">Non-AC Per Day Fee</th>
          <th scope="col">Status</th>
        
        
        </tr>
      </thead>
      <tbody>
      <?php
$sql = "SELECT * FROM car_view";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td data-label='Car ID'><img width='100' height='100' src='../img/" . $row['CarImg'] . "' alt='Firelight'> " . $row['CarID'] . "</td>";
    echo "<td data-label='Car Name'>" . $row['CarName'] . "</td>";
    echo "<td data-label='Plate Number'>" . $row['PlateNumber'] . "</td>";
    echo "<td data-label='AC Per Day Fee'>₱" . $row['ACperDay'] . "</td>";
    echo "<td data-label='Non-AC Per Day Fee'>₱" . $row['NonACperDay'] . "</td>";
    echo "<td data-label='Status'>" . $row['status'] . "</td>";
    echo "</tr>";
}
?>

        
        
      </tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>