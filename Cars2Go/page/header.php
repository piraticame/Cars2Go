<?php
include('../database/config.php');
?>
<html>
    <head>
      <link rel="stylesheet" href="../css/style.css">
      <script type="text/javascript" src="../js/script.js" defer></script>
  
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monomaniac+One&display=swap" rel="stylesheet">
      <title>Responsive Navbar</title>
       </head>
    <body>
      <nav class="navbar">
      <div class="brand-title">
    <img src="../img/logos.png" alt="" onmousedown="startTimer()" ontouchstart="startTimer()" onmouseup="endTimer()" ontouchend="endTimer()">
</div>  
<script>
            let pressTimer;

            // Function to start the timer
            function startTimer() {
                pressTimer = setTimeout(function () {
                    window.location.href = '../index.php'; // Replace with your desired URL
                }, 10); // 4000 milliseconds = 4 seconds
            }

            // Function to end the timer
            function endTimer() {
                clearTimeout(pressTimer);
            }
        </script>
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
        <div class="navbar-links">
          <ul>
            <li><a href="../index.php">Home</a></li>  <?php
            if(isset($_SESSION['CusID'])){
              echo '<li><a href="customer_page.php">' . $_SESSION['username'] . '</a></li>';
            }
            else{
              echo '<li><a href="login.php">Login</a></li>';
            }
            
            ?>
            <li><a href="cars.php">See Cars</a></li>
            <li><a href="faq.php">Faqs</a></li>
            
          </ul>
        </div>
      </nav>
      
    </body>
</html>