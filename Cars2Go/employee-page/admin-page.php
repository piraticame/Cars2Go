<?php
include ('employee-header.php');
if (isset($_SESSION['role']) && $_SESSION['role'] == 'employee') {
    header('location: employee-page.php');
}

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

    
    <a href="view_cars.php">
            <div class="menu-boxes">
            <img src="../img/viewcarsicon.png" alt="delete_car">
           
           <br><h2>VIEW CARS</h2>
            </div>
        </a>

    <a href="add_car.php">
            <div class="menu-boxes">
            <img src="../img/addcarsicon.png" alt="add_car">
           
           <br><h2>ADD CARS</h2>
            </div>
        </a>

        <a href="view_booking.php">
            <div class="menu-boxes">
            <img src="../img/booked.png" alt="sales">
           <br><h2>VIEW BOOKING</h2>
            </div>
        </a>

        <a href="view_employees.php">
            <div class="menu-boxes">
            <img src="../img/employeeicon.png" alt="sales">
           <br><h2>VIEW EMPLOYEES</h2>
            </div>
        </a>


        <a href="add_employee.php">
            <div class="menu-boxes">
            <img src="../img/addemployeeicon.png" alt="add_employee">
           
           <br><h2>ADD EMPLOYEE</h2>
            </div>
        </a>
        
        <a href="view_driver.php">
            <div class="menu-boxes">
            <img src="../img/driver.png" alt="delete_employee">
           
           <br><h2>VIEW DRIVERS</h2>
            </div>
        </a>
        <a href="add_driver.php">
            <div class="menu-boxes">
            <img src="../img/drivericon.png" alt="sales">
           
           <br><h2>ADD DRIVER</h2>
            </div>
        </a>

        <a href="inventory_page.php">
            <div class="menu-boxes">
            <img src="../img/inventoryicon.png" alt="inventory">
           <br><h2>INVENTORY</h2>
            </div>
        </a>
        <a href="reports.php">
            <div class="menu-boxes">
            <img src="../img/salesicon.png" alt="sales">
           
           <br><h2>REPORTS</h2>
            </div>
        </a>
        

        <a href="logs.php">
            <div class="menu-boxes">
            <img src="../img/logsicon.png" alt="logs">
           
           <br><h2>LOGS</h2>
            </div>
        </a>
        
        
    </div>
      
    </body>
</html>