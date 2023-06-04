<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cars2go';
$conn = mysqli_connect($hostname, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
header("Cache-Control: no-cache, must-revalidate");





session_start();
?>