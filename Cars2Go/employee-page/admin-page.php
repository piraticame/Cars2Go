<?php
include ('employee-header.php');
?>
<html>
    <head>
    <link rel="stylesheet" href="../css/employee.css">
       
        </head>
    <body>
        <p class="welcoming">
            Welcome to the admin page <br><b><?php echo $_SESSION['username']; ?></b>!
        </p>
    <div class="container">


    <a href="add_car.php">
            <div class="menu-boxes">
            <img src="../img/addcarsicon.png" alt="add_car">
           
           <br><h2>ADD CARS</h2>
            </div>
        </a>

        <a href="update-car.php">
            <div class="menu-boxes">
            <img src="../img/updatecaricon.png" alt="update_car">
           
           <br><h2>UPDATE CARS</h2>
            </div>
        </a>
        <a href="delete-car.php">
            <div class="menu-boxes">
            <img src="../img/deletecaricon.png" alt="delete_car">
           
           <br><h2>DELETE CARS</h2>
            </div>
        </a>
        <a href="add-employee.php">
            <div class="menu-boxes">
            <img src="../img/addemployeeicon.png" alt="add_employee">
           
           <br><h2>ADD EMPLOYEE</h2>
            </div>
        </a>
        <a href="update-employee.php">
            <div class="menu-boxes">
            <img src="../img/updateemployeeicon.png" alt="update_employee">
           
           <br><h2>UPDATE EMPLOYEE</h2>
            </div>
        </a>
        <a href="delete-employee.php">
            <div class="menu-boxes">
            <img src="../img/deleteemployeeicon.png" alt="delete_employee">
           
           <br><h2>DELETE EMPLOYEE</h2>
            </div>
        </a>

        <a href="inventory.php">
            <div class="menu-boxes">
            <img src="../img/inventoryicon.png" alt="inventory">
           
           <br><h2>INVENTORY</h2>
            </div>
        </a>
        <a href="sales.php">
            <div class="menu-boxes">
            <img src="../img/salesicon.png" alt="sales">
           
           <br><h2>SALES</h2>
            </div>
        </a>
        
        <a href="add_driver.php">
            <div class="menu-boxes">
            <img src="../img/drivericon.png" alt="sales">
           
           <br><h2>ADD DRIVER</h2>
            </div>
        </a>
        
    </div>
      
    </body>
</html>