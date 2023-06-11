
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../css/logs.css">
</head>


<body>
<header>
    <?php
    include ('employee-header.php');
   ?>
   </header>
   
   
 <h1>LOGS</h1>
<div class='tabs'>
  <div class='tab-buttons'>
    <span class='content1'>Customer</span>
    <span class='content2'>Employee</span>
    
    <div id='lamp' class='content1'></div>
  </div>
  <div class='tab-content'>
    
    <div class='content1'>

	
  <div class="container">

    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th scope="col">Customer Log ID</th>
          <th scope="col">Customer ID</th>
          <th scope="col">Timestamp</th>
          <th scope="col">Action</th>
          
        
        
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM cuslogs_view";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
          echo "<td scope='row' data-label='Customer Log ID'>".$row['CusLogID']."</td>";
          echo "<td scope='row' data-label='Customer ID'>".$row['CusID']."</td>";
          echo "<td scope='row' data-label='Timestamp'>".$row['Timestamp']."</td>";
          echo "<td scope='row' data-label='Action'>".$row['Action']."</td>";
          echo "</tr>";
        }
        ?>

        
      </tbody>
    </table>
  </div>
	
	</div>
	
	
	
	
	
<div class='content2'>
<div class="container">

    <table class="table table-fluid" id="myTable2">
      <thead>
        <tr>
          <th scope="col">Employee Log ID</th>
          <th scope="col">Employee ID</th>
          <th scope="col">Timestamp</th>
          <th scope="col">Action</th>
          
        
        
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM emplogs_view";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td scope='row' data-label='Customer Log ID'>".$row['EmpLogID']."</td>";
            echo "<td scope='row' data-label='Customer ID'>".$row['EmpID']."</td>";
            echo "<td scope='row' data-label='Timestamp'>".$row['Timestamp']."</td>";
            echo "<td scope='row' data-label='Action'>".$row['Action']."</td>";
            echo "</tr>";
        }
        ?>
        
        
      </tbody>
    </table>
  </div>




</div>
  
 
 
 
 
 
 
 
 
 
 
  </div>
</div>
<div class='credit'>
  
</div>

   <script>
   
   $('.tab-content>div').hide();
$('.tab-content>div').first().slideDown();
  $('.tab-buttons span').click(function(){
    var thisclass=$(this).attr('class');
    $('#lamp').removeClass().addClass('#lamp').addClass(thisclass);
    $('.tab-content>div').each(function(){
      if($(this).hasClass(thisclass)){
        $(this).fadeIn(800);
      }
      else{
        $(this).hide();
      }
    });
  });


   
   </script>
   
    <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  
   <script>
    $(document).ready(function() {
      $('#myTable2').DataTable();
    });
  </script>
  
  
 </body>
 </html>