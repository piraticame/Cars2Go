<?php
require 'database/config.php';

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <title>Cars2Go</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <nav class="navbar">
        <button class="btn-bars">
            MENU <span><i class="fas fa-bars"></i></span>
        </button>

        <div class="navbar-collapse">
            <span class="btn-close">
                <i class="fas fa-times"></i>
            </span>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">About us</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Available Cars</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Faq</a>
                </li>
            </ul>

            <p class="nav-para">We are a car rental booking system to cater all your car rental needs and will surely achieve your expectations.</p>

           
        </div>
    </nav>

    <!-- header -->
    <header class="header">
        <a href="index.php" class="site-name">
            <h2>CARS2GO<span>.</span></h2>
        </a>
        <div class="header-wrapper">
            <h3>WELCOME TO CARS2GO</h3>
            <h1>We are a car rental booking system to cater all your car rental needs and will surely achieve your expectations.</h1>

            <div class="header-links">
                <a href="#">Check Cars</a>
                <a href="login.php">Login</a>
            </div>

           
        </div>
    </header>
    <!-- end of header -->

    <script src="script.js"></script>
</body>
</html>