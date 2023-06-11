<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Tables</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../css/view_cars.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

</head>

<body>
<header>
    <?php
    include ('employee-header.php');
   ?>
   </header>
   
   <div class="one">
  <h1 title="">VIEW CARS</h1>
</div>


  <div class="container">

    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th scope="col">Car ID</th>
          <th scope="col">Car Model</th>
          <th scope="col">Car Name</th>
          <th scope="col">Plate Number</th>
          <th scope="col">AC Per Day</th>
          <th scope="col">Non AC Per Day</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        
        </tr>
      </thead>
      <tbody>
          <?php
        $sql = "SELECT * FROM car_view where status != 'deleted'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td scope='row' data-label='#'>" . $row['CarID'] . "</td>";
          echo "<td><img width='80' height='50' src='../img/" . $row['CarImg'] . "' alt='' class='mwehe'></td>";
          echo "<td data-label='Car ID'>" . $row['CarName'] . "</td>";
          echo "<td scope='row' data-label='Plate Number'>" . $row['PlateNumber'] . "</td>";
          echo "<td scope='row' data-label='AC Per Day'>" . $row['ACperDay'] . "</td>";
          echo "<td scope='row' data-label='Non AC Per Day'>" . $row['NonACperDay'] . "</td>";
          echo "<td scope='row' data-label='Status'>" . $row['status'] . "</td>";
          echo "<td scope='row' data-label='Action'>
          <form method='post' action='update_cars.php' style='display:inline;'>
                <input type='hidden' name='CarID' value='" . $row['CarID'] . "'>
                <button type='submit' class='edit' title='Edit' data-toggle='tooltip' style='border:none; background:none; cursor:pointer;'><i class='material-icons'>&#xE254;</i></button>
         
                </form>
                <form method='post' style='display:inline;'>
                <input type='hidden' name='CarID1' value='" . $row['CarID'] . "'>
                <button type='submit' name='CarID2' class='delete' title='Delete' data-toggle='tooltip' style='border:none; background:none; cursor:pointer;'><i class='material-icons'>&#xE872;</i></button>
                </form>
                </td>";
          echo "</tr>";
        }
        
        if(isset($_POST['CarID2'])){
          $sql = "UPDATE car_view SET status = 'deleted' WHERE CarID = '".$_POST['CarID1']."'";
          $result = mysqli_query($conn, $sql);
          if($result){
          echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Car Deleted',
            text: 'The car has been successfully deleted.',
            timer: 3000
          });
        </script>";
        //reload page
        echo "<meta http-equiv='refresh' content='2'>";
          }
        mysqli_error($conn);
        }
        
        
          ?>
          <script>
  function storeCarID(carID) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_cars.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Request completed successfully
        console.log('CarID stored in session');
      }
    };
    xhr.send('CarID=' + carID);
  }
</script>
<?php
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