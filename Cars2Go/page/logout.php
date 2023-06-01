<?php
include ('../database/config.php');
session_start();
session_destroy();
header('location: ../index.php');

?>