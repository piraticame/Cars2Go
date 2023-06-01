<?php
include 'database/config.php';
//drop database
$sql = mysqli_query($conn, "DROP DATABASE cars2go;");
?>