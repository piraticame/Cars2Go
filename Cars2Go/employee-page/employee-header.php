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
    <img src="../img/logos.png">
</div>  
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </a>
        <div class="navbar-links">
          <ul>
            <li><a href="admin-page.php">Home</a></li>  <?php
            if(isset($_SESSION['CusID'])){
              echo '<li><a href="admin-page.php">' . $_SESSION['username'] . '</a></li>';
              echo '<li><a href="../page/logout.php">Logout</a></li>';
            }
            else{
              echo '<li><a href="../page/login.php">Login</a></li>';
            }
            ?> 
          </ul>
        </div>
      </nav>
            
    </body>
</html>