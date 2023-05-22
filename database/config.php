<?php
$hostname = 'localhost';
$username = 'root';
$password = '';

$conn = mysqli_connect($hostname, $username, $password);

$sql = mysqli_query($conn, "CREATE DATABASE cars2go;"); 
   
mysqli_select_db($conn,'cars2go');
if ($sql){ 
$sql2 = mysqli_query($conn, "CREATE TABLE `customer` (
    `CusID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `FirstName` varchar(100) NOT NULL,
    `LastName` varchar(100) NOT NULL,
    `MiddleName` varchar(100) NULL,
    `Contact` varchar(11) NULL,
    `username` varchar(30) NULL UNIQUE,
    `password` varchar(30) NOT NULL
  );"); 

  $sql2 = mysqli_query($conn, "CREATE TABLE `employee` (
    `EmpID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `FirstName` varchar(100) NOT NULL,
    `LastName` varchar(100) NOT NULL,
    `Contact` varchar(11) NULL,
    `username` varchar(30) NULL UNIQUE,
    `password` varchar(30) NULL
  );");

  $sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`cuslogs` (
      `CusLogID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `CusID` INT(10) NOT NULL,
      `Timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `Action` VARCHAR(255) NOT NULL
  );");

  $sql5 = mysqli_query($conn, "CREATE TABLE `cars2go`.`emplogs` (
      `EmpLogID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `EmpID` INT(10) NOT NULL,
      `Timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `Action` VARCHAR(255) NOT NULL
  );");

  $sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`car` (
    `CarID` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `CarName`  varchar(100) NOT NULL,
    `PlateNumber` varchar(100) NOT NULL,
    `ACperDay` INT NOT NULL,
    `ACperKm` INT NOT NULL,
    `NonACperDay` INT NOT NULL,
    `NonACperKm` INT NOT NULL,
    `CarImg` varchar(100) NOT NULL
  );");
  
  $sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`Driver` (
    `DriverID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `FirstName` varchar(100) NOT NULL,
    `LastName` varchar(100) NOT NULL,
    `Contact` varchar(11) NULL,
    `Address` varchar(255) NOT NULL,
    `Gender` varchar(50) NULL
  );");
 
 $sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`booked` (
  `BookingID` INT NOT NULL PRIMARY KEY,
  `CusID` INT(10) NOT NULL,
  `CarID` INT(10) NOT NULL,
  `CarName`  varchar(100) NOT NULL,
  `Fare` INT NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  `NoDays` INT NOT NULL,
  `TotalAmount` INT NOT NULL
);");

$sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`booking` (
  `BookingID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `CusID` INT(10) NOT NULL,
  `CarID` INT(10) NOT NULL,
  `CarName`  varchar(100) NOT NULL,
  `StartDate` DATE NOT NULL,
  `EndDate` DATE NOT NULL,
  `AC` boolean NOT NULL,
  `ChargeType` varchar(100) NOT NULL,
  `TotalCharge` INT NOT NULL,
  `DriverID` INT NULL,
  `Status` varchar(100) NOT NULL
);");

  $sql3 = mysqli_query($conn, "CREATE TABLE `cars2go`.`sales` (
    `BookingID` INT NOT NULL PRIMARY KEY,
    `CusID` INT(10) NOT NULL,
    `CarID` INT(10) NOT NULL,
    `CarName`  varchar(100) NOT NULL,
    `StartDate` DATE NOT NULL,
    `EndDate` DATE NOT NULL,
    `NoDays` INT NOT NULL,
    `AC` boolean NOT NULL,
    `ChargeType` varchar(100) NOT NULL,
    `TotalCharge` INT NOT NULL
  );");

    //FOREIGN KEYS
  $sql4 = mysqli_query($conn, "ALTER TABLE `cars2go`.`cuslogs`
  ADD FOREIGN KEY (`CusID`) REFERENCES `customer`(`CusID`);");
  
  $sql4 = mysqli_query($conn, "ALTER TABLE `cars2go`.`emplogs`
  ADD FOREIGN KEY (`EmpID`) REFERENCES `employee`(`EmpID`);");
  
  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booked`
  ADD FOREIGN KEY (`CusID`) REFERENCES `customer`(`CusID`);");

  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booked`
  ADD FOREIGN KEY (`CarID`) REFERENCES `car`(`CarID`);");

  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booked`
  ADD FOREIGN KEY (`BookingID`) REFERENCES `booking`(`BookingID`);");
  
  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booking`
  ADD FOREIGN KEY (`CarID`) REFERENCES `car`(`CarID`);");

  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booking`
  ADD FOREIGN KEY (`CusID`) REFERENCES `customer`(`CusID`);");
  
  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`booking`
  ADD FOREIGN KEY (`DriverID`) REFERENCES `driver`(`DriverID`);");

  $sql2 = mysqli_query($conn, "ALTER TABLE `cars2go`.`sales`
  ADD FOREIGN KEY (`BookingID`) REFERENCES `booking`(`BookingID`);");
}
?>