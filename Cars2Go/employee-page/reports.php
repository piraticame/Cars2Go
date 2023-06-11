<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Reports</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/reports.css">
  </head>
  <body>
    <header>
            <?php
                include('employee-header.php');
            ?>
   </header>
<?php
$sql = "SELECT COUNT(PlateNumber) as 'car-count' FROM car WHERE status != 'deleted'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$car_count = $row['car-count'];


$sql = "SELECT COUNT(BookingID) as 'reserve-count' FROM booking_view WHERE status != 'deleted' AND status != 'returned'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$reserve_count = $row['reserve-count'];

$sql = "SELECT COUNT(BookingID) as 'booking-count' FROM booking_view WHERE status != 'deleted'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$booking_count = $row['booking-count'];

$sql = "SELECT SUM(TotalCharge) as 'total-sales' FROM booking_view WHERE status != 'deleted'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_sales = $row['total-sales'];


$sql = "SELECT CarName, COUNT(BookingID) as rental_count
        FROM booking_view
        WHERE status != 'deleted'
        GROUP BY CarName
        ORDER BY rental_count DESC
        LIMIT 5";
$result = mysqli_query($conn, $sql);
$top_cars = mysqli_fetch_all($result, MYSQLI_ASSOC);


$sql = "SELECT CarName, TotalCharge
        FROM booking_view
        WHERE status = 'ongoing' AND status != 'deleted' AND status != 'returned' OR status = 'waiting'";
$result = mysqli_query($conn, $sql);
$ongoing_rentals = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">REPORTS</p>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">SALES</p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $total_sales; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">CUSTOMER HISTORY</p>
              <span class="material-icons-outlined text-orange">add_shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $booking_count; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">CARS</p>
              <span class="material-icons-outlined text-green">shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $car_count; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">RESERVATION</p>
              <span class="material-icons-outlined text-red">notification_important</span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $reserve_count; ?></span>
          </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <p class="chart-title">Top 5 Cars</p>
            <div id="bar-chart">
              <?php
              foreach ($top_cars as $car) {
                $carName = $car['CarName'];
                $rentalCount = $car['rental_count'];
                // Display or process the car data here
                echo "Car Name: <b>$carName</b>, Rental Count: <b>$rentalCount</b> <br>";
            }
            
              ?>
            </div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Reservation and Sales</p>
            <div id="area-chart">
              <?php
              foreach ($ongoing_rentals as $rental) {
                $carName = $rental['CarName'];
                $totalCharge = $rental['TotalCharge'];
                // Display or process the rental data here
                echo "Car Name: <b>$carName,</b> Total Charge: <b>$totalCharge</b> <br>";
            }
              ?>
            </div>
          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/reports.js"></script>
  </body>
</html>