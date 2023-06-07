<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cars2go';
$conn = mysqli_connect($hostname, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();
?>