
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
  <link rel="stylesheet" href="../css/view_driver.css">
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
  <h1 title="">VIEW DRIVERS</h1>
</div>


  <div class="container">

    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th scope="col">Driver ID</th>
          <th scope="col">Driver Photo</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Contact</th>
          <th scope="col">Gender</th>
          <th scope="col">License</th>
          <th scope="col">Address</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        
        </tr>
      </thead>
      <tbody>
          <?php
        $sql = "SELECT * FROM driver_view where status != 'deleted'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td scope='row' data-label='#'>" . $row['DriverID'] . "</td>";
          echo "<td><img width='80' height='80' src='../img/" . $row['DriverImg'] . "' alt='' class='mwehe'></td>";
          echo "<td data-label='Car ID'>" . $row['FirstName'] . "</td>";
          echo "<td scope='row' data-label='Plate Number'>" . $row['LastName'] . "</td>";
          echo "<td scope='row' data-label='AC Per Day'>" . $row['Contact'] . "</td>";
          echo "<td scope='row' data-label='Non AC Per Day'>" . $row['Gender'] . "</td>";
          echo "<td scope='row' data-label='Status'>" . $row['License'] . "</td>";
          echo "<td scope='row' data-label='Status'>" . $row['Address'] . "</td>";
          echo "<td scope='row' data-label='Status'>" . $row['status'] . "</td>";
          echo "<td scope='row' data-label='Action'>
          <form method='post' action='update_driver.php' style='display:inline;'>
                <input type='hidden' name='DriverID' value='" . $row['DriverID'] . "'>
                <button type='submit' class='edit' title='Edit' data-toggle='tooltip' style='border:none; background:none; cursor:pointer;'><i class='material-icons'>&#xE254;</i></button>
         
                </form>
                <form method='post' style='display:inline;'>
                <input type='hidden' name='DriverID' value='" . $row['DriverID'] . "'>
                <button type='submit' name='DriverID2' class='delete' title='Delete' data-toggle='tooltip' style='border:none; background:none; cursor:pointer;'><i class='material-icons'>&#xE872;</i></button>
                </form>
                </td>";
          echo "</tr>";
        }
        
        if(isset($_POST['DriverID2'])){
          $sql = "UPDATE driver_view SET status = 'deleted' WHERE DriverID = '".$_POST['DriverID']."'";
          $result = mysqli_query($conn, $sql);
          if($result){
            echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Employee Deleted',
        text: 'The Employee has been successfully deleted.',
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'view_driver.php';
        }
    });
</script>";

          }
        mysqli_error($conn);
        }
        
        
          ?>
          <script>
  function storeCarID(driverID) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_driver.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Request completed successfully
        console.log('DriverID stored in session');
      }
    };
    xhr.send('DriverID=' + driverID);
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