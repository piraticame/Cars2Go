<?php
include ('../database/config.php');
session_start();
session_destroy();
header('location: login.php');
$user_id = $_SESSION['CusID'];
$logs = mysqli_query($conn, "INSERT INTO cuslogs_view(CusID, Timestamp, Action) VALUES ('$user_id', NOW(), 'Logged out')");

?>