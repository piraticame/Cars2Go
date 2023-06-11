-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 12:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars2go`
--

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `customer_account_check` (IN `username` VARCHAR(255), IN `password` VARCHAR(255))   BEGIN
    	SELECT username FROM customer_account WHERE username = username;
        END$$

CREATE PROCEDURE `customer_account_register` (IN `user_ID` INT, IN `user` VARCHAR(255), IN `pass` VARCHAR(255))   BEGIN
    	INSERT INTO customer_accounts_view(CusID,username,password) VALUES(user_ID, user, pass);
        END$$

CREATE PROCEDURE `customer_login` (INOUT `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_customer_id` INT, OUT `p_login_success` BOOLEAN)   BEGIN
  DECLARE v_customer_id INT;
  DECLARE v_username VARCHAR(255);

  -- Check if the username and password match in the customer_view
  SELECT CusID, Username INTO v_customer_id, v_username
  FROM customer_accounts_view
  WHERE Username = p_username AND Password = p_password;

  IF v_customer_id IS NOT NULL THEN
    -- Set the output parameter values
    SET p_customer_id = v_customer_id;
    SET p_username = v_username;
    SET p_login_success = TRUE;
  ELSE
    -- Set the output parameter values
    SET p_customer_id = NULL;
    SET p_username = NULL;
    SET p_login_success = FALSE;
  END IF;
END$$

CREATE PROCEDURE `customer_register` (IN `fname` VARCHAR(100), IN `lname` VARCHAR(100), IN `mname` VARCHAR(100), IN `contact` VARCHAR(11), IN `dateofbirth` DATE)   BEGIN
    INSERT INTO customer_view(FirstName, LastName, MiddleName, Contact, DateOfBirth)
    VALUES (fname, lname, mname, contact, dateofbirth);
END$$

CREATE PROCEDURE `employee_login` (INOUT `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_employee_id` INT, OUT `p_login_success` BOOLEAN)   BEGIN
  DECLARE v_employee_id INT;
  DECLARE v_username VARCHAR(255);

  -- Check if the username and password match in the employee_account_view
  SELECT EmpID, Username INTO v_employee_id, v_username
  FROM employee_account_view
  WHERE username = p_username AND password = p_password;

  IF v_employee_id IS NOT NULL THEN
    -- Set the output parameter values
    SET p_employee_id = v_employee_id;
    SET p_username = v_username;
    SET p_login_success = TRUE;
  ELSE
    -- Set the output parameter values
    SET p_employee_id = NULL;
    SET p_username = NULL;
    SET p_login_success = FALSE;
  END IF;
END$$

CREATE PROCEDURE `InsertCarView` (IN `p_name` VARCHAR(255), IN `p_plate` VARCHAR(255), IN `p_acperday` INT(11), IN `p_nonacperday` INT(11), IN `p_imageName` VARCHAR(255))   BEGIN
    INSERT INTO car_view (CarName, PlateNumber, ACperDay, NonACperDay, status, CarImg)
    VALUES (p_name, p_plate, p_acperday, p_nonacperday, 'available', p_imageName);
END$$

CREATE PROCEDURE `InsertDriver` (IN `p_fname` VARCHAR(100), IN `p_lname` VARCHAR(100), IN `p_contact` VARCHAR(11), IN `p_address` VARCHAR(255), IN `p_gender` VARCHAR(50), IN `p_birthday` DATE, IN `p_license` VARCHAR(255), IN `p_imageName` VARCHAR(255))   BEGIN
    INSERT INTO driver_view (FirstName, LastName, Contact, Address, Gender, DateOfBirth, License, status, DriverImg)
    VALUES (p_fname, p_lname, p_contact, p_address, p_gender, p_birthday, p_license, 'active', p_imageName);
END$$

CREATE PROCEDURE `InsertEmployee` (IN `p_FirstName` VARCHAR(100), IN `p_LastName` VARCHAR(100), IN `p_Contact` VARCHAR(11), IN `p_Role` VARCHAR(255), IN `p_EmployeeImg` VARCHAR(255), IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    -- Insert statement
    INSERT INTO employee_view (FirstName, LastName, Contact, role, status, EmployeeImg)
    VALUES (p_FirstName, p_LastName, p_Contact, p_Role, 'available', p_EmployeeImg);

    -- Get the EmpID of the inserted row
    SET @EmpID := LAST_INSERT_ID();

    -- Insert into employee_account_view
    INSERT INTO employee_account_view (EmpID, username, password)
    VALUES (@EmpID, p_username, p_password);

    -- Select statement
    SELECT * FROM employee_view WHERE EmpID = @EmpID;
END$$

CREATE PROCEDURE `insertEmployeeAccount` (IN `EmpID` INT(10), IN `username` VARCHAR(255), IN `password` VARCHAR(255))   BEGIN 
    INSERT INTO employee_account_view(EmpID,username,password) VALUES (EmpID,username,password);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `BookingID` int(11) NOT NULL,
  `CusID` int(10) NOT NULL,
  `CarID` int(10) NOT NULL,
  `CarName` varchar(100) NOT NULL,
  `Fare` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `NoDays` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `CusID` int(10) NOT NULL,
  `CarID` int(10) NOT NULL,
  `CarName` varchar(100) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `AC` tinyint(1) NOT NULL,
  `ChargeType` varchar(100) NOT NULL,
  `TotalCharge` int(11) NOT NULL,
  `penalty` int(11) NOT NULL,
  `DriverID` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `booking_view`
-- (See below for the actual view)
--
CREATE TABLE `booking_view` (
`BookingID` int(11)
,`CusID` int(10)
,`CarID` int(10)
,`CarName` varchar(100)
,`StartDate` date
,`EndDate` date
,`AC` tinyint(1)
,`ChargeType` varchar(100)
,`TotalCharge` int(11)
,`penalty` int(11)
,`DriverID` int(11)
,`status` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `CarID` int(10) NOT NULL,
  `CarName` varchar(100) NOT NULL,
  `PlateNumber` varchar(100) NOT NULL,
  `ACperDay` int(11) NOT NULL,
  `NonACperDay` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `CarImg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `car_available_view`
-- (See below for the actual view)
--
CREATE TABLE `car_available_view` (
`CarID` int(10)
,`CarName` varchar(100)
,`PlateNumber` varchar(100)
,`ACperDay` int(11)
,`NonACperDay` int(11)
,`status` varchar(100)
,`CarImg` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `car_view`
-- (See below for the actual view)
--
CREATE TABLE `car_view` (
`CarID` int(10)
,`CarName` varchar(100)
,`PlateNumber` varchar(100)
,`ACperDay` int(11)
,`NonACperDay` int(11)
,`status` varchar(100)
,`CarImg` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `cuslogs`
--

CREATE TABLE `cuslogs` (
  `CusLogID` int(11) NOT NULL,
  `CusID` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cuslogs_view`
-- (See below for the actual view)
--
CREATE TABLE `cuslogs_view` (
`CusLogID` int(11)
,`CusID` int(10)
,`Timestamp` timestamp
,`Action` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CusID` int(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `Contact` varchar(11) DEFAULT NULL,
  `DateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `CusID` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_accounts_view`
-- (See below for the actual view)
--
CREATE TABLE `customer_accounts_view` (
`CusID` int(10)
,`username` varchar(255)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_view`
-- (See below for the actual view)
--
CREATE TABLE `customer_view` (
`CusID` int(10)
,`FirstName` varchar(100)
,`LastName` varchar(100)
,`MiddleName` varchar(100)
,`Contact` varchar(11)
,`DateOfBirth` date
);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `DriverID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Contact` varchar(11) DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `License` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `DriverImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `driver_view`
-- (See below for the actual view)
--
CREATE TABLE `driver_view` (
`DriverID` int(11)
,`FirstName` varchar(100)
,`LastName` varchar(100)
,`Contact` varchar(11)
,`Address` varchar(255)
,`Gender` varchar(50)
,`DateOfBirth` date
,`License` varchar(255)
,`status` varchar(100)
,`DriverImg` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `emplogs`
--

CREATE TABLE `emplogs` (
  `EmpLogID` int(11) NOT NULL,
  `EmpID` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `emplogs_view`
-- (See below for the actual view)
--
CREATE TABLE `emplogs_view` (
`EmpLogID` int(11)
,`EmpID` int(10)
,`Timestamp` timestamp
,`Action` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Contact` varchar(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `EmployeeImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `FirstName`, `LastName`, `Contact`, `role`, `status`, `EmployeeImg`) VALUES
(1, 'Marvin Boss', 'marvs', 'N/A', 'admin', 'active', '352608649_269443912320880_3410201373638782538_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `EmpID` int(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_account`
--

INSERT INTO `employee_account` (`EmpID`, `username`, `password`) VALUES
(1, 'root', 'root');

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_account_view`
-- (See below for the actual view)
--
CREATE TABLE `employee_account_view` (
`EmpID` int(10)
,`username` varchar(255)
,`password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_view`
-- (See below for the actual view)
--
CREATE TABLE `employee_view` (
`EmpID` int(10)
,`FirstName` varchar(100)
,`LastName` varchar(100)
,`Contact` varchar(11)
,`role` varchar(255)
,`status` varchar(100)
,`EmployeeImg` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `booking_view`
--
DROP TABLE IF EXISTS `booking_view`;

CREATE VIEW `booking_view`  AS SELECT `booking`.`BookingID` AS `BookingID`, `booking`.`CusID` AS `CusID`, `booking`.`CarID` AS `CarID`, `booking`.`CarName` AS `CarName`, `booking`.`StartDate` AS `StartDate`, `booking`.`EndDate` AS `EndDate`, `booking`.`AC` AS `AC`, `booking`.`ChargeType` AS `ChargeType`, `booking`.`TotalCharge` AS `TotalCharge`, `booking`.`penalty` AS `penalty`, `booking`.`DriverID` AS `DriverID`, `booking`.`status` AS `status` FROM `booking`  ;

-- --------------------------------------------------------

--
-- Structure for view `car_available_view`
--
DROP TABLE IF EXISTS `car_available_view`;

CREATE VIEW `car_available_view`  AS SELECT `car`.`CarID` AS `CarID`, `car`.`CarName` AS `CarName`, `car`.`PlateNumber` AS `PlateNumber`, `car`.`ACperDay` AS `ACperDay`, `car`.`NonACperDay` AS `NonACperDay`, `car`.`status` AS `status`, `car`.`CarImg` AS `CarImg` FROM `car` WHERE `car`.`status` = 'available';

-- --------------------------------------------------------

--
-- Structure for view `car_view`
--
DROP TABLE IF EXISTS `car_view`;

CREATE VIEW `car_view`  AS SELECT `car`.`CarID` AS `CarID`, `car`.`CarName` AS `CarName`, `car`.`PlateNumber` AS `PlateNumber`, `car`.`ACperDay` AS `ACperDay`, `car`.`NonACperDay` AS `NonACperDay`, `car`.`status` AS `status`, `car`.`CarImg` AS `CarImg` FROM `car`;

-- --------------------------------------------------------

--
-- Structure for view `cuslogs_view`
--
DROP TABLE IF EXISTS `cuslogs_view`;

CREATE VIEW `cuslogs_view`  AS SELECT `cuslogs`.`CusLogID` AS `CusLogID`, `cuslogs`.`CusID` AS `CusID`, `cuslogs`.`Timestamp` AS `Timestamp`, `cuslogs`.`Action` AS `Action` FROM `cuslogs`;

-- --------------------------------------------------------

--
-- Structure for view `customer_accounts_view`
--
DROP TABLE IF EXISTS `customer_accounts_view`;

CREATE VIEW `customer_accounts_view`  AS SELECT `customer_account`.`CusID` AS `CusID`, `customer_account`.`username` AS `username`, `customer_account`.`password` AS `password` FROM `customer_account`;

-- --------------------------------------------------------

--
-- Structure for view `customer_view`
--
DROP TABLE IF EXISTS `customer_view`;

CREATE VIEW `customer_view`  AS SELECT `customer`.`CusID` AS `CusID`, `customer`.`FirstName` AS `FirstName`, `customer`.`LastName` AS `LastName`, `customer`.`MiddleName` AS `MiddleName`, `customer`.`Contact` AS `Contact`, `customer`.`DateOfBirth` AS `DateOfBirth` FROM `customer`;

-- --------------------------------------------------------

--
-- Structure for view `driver_view`
--
DROP TABLE IF EXISTS `driver_view`;

CREATE VIEW `driver_view`  AS SELECT `driver`.`DriverID` AS `DriverID`, `driver`.`FirstName` AS `FirstName`, `driver`.`LastName` AS `LastName`, `driver`.`Contact` AS `Contact`, `driver`.`Address` AS `Address`, `driver`.`Gender` AS `Gender`, `driver`.`DateOfBirth` AS `DateOfBirth`, `driver`.`License` AS `License`, `driver`.`status` AS `status`, `driver`.`DriverImg` AS `DriverImg` FROM `driver`;

-- --------------------------------------------------------

--
-- Structure for view `emplogs_view`
--
DROP TABLE IF EXISTS `emplogs_view`;

CREATE VIEW `emplogs_view`  AS SELECT `emplogs`.`EmpLogID` AS `EmpLogID`, `emplogs`.`EmpID` AS `EmpID`, `emplogs`.`Timestamp` AS `Timestamp`, `emplogs`.`Action` AS `Action` FROM `emplogs`;

-- --------------------------------------------------------

--
-- Structure for view `employee_account_view`
--
DROP TABLE IF EXISTS `employee_account_view`;

CREATE VIEW `employee_account_view`  AS SELECT `employee_account`.`EmpID` AS `EmpID`, `employee_account`.`username` AS `username`, `employee_account`.`password` AS `password` FROM `employee_account`;

-- --------------------------------------------------------

--
-- Structure for view `employee_view`
--
DROP TABLE IF EXISTS `employee_view`;

CREATE VIEW `employee_view`  AS SELECT `employee`.`EmpID` AS `EmpID`, `employee`.`FirstName` AS `FirstName`, `employee`.`LastName` AS `LastName`, `employee`.`Contact` AS `Contact`, `employee`.`role` AS `role`, `employee`.`status` AS `status`, `employee`.`EmployeeImg` AS `EmployeeImg` FROM `employee`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD KEY `CusID` (`CusID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `BookingID` (`BookingID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `CusID` (`CusID`),
  ADD KEY `DriverID` (`DriverID`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`CarID`),
  ADD UNIQUE KEY `PlateNumber` (`PlateNumber`);

--
-- Indexes for table `cuslogs`
--
ALTER TABLE `cuslogs`
  ADD PRIMARY KEY (`CusLogID`),
  ADD KEY `CusID` (`CusID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CusID`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`CusID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`DriverID`),
  ADD UNIQUE KEY `License` (`License`);

--
-- Indexes for table `emplogs`
--
ALTER TABLE `emplogs`
  ADD PRIMARY KEY (`EmpLogID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`EmpID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `CarID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuslogs`
--
ALTER TABLE `cuslogs`
  MODIFY `CusLogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CusID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emplogs`
--
ALTER TABLE `emplogs`
  MODIFY `EmpLogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`CusID`) REFERENCES `customer` (`CusID`),
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `car` (`CarID`),
  ADD CONSTRAINT `booked_ibfk_3` FOREIGN KEY (`BookingID`) REFERENCES `booking` (`BookingID`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `car` (`CarID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`CusID`) REFERENCES `customer` (`CusID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`DriverID`) REFERENCES `driver` (`DriverID`);

--
-- Constraints for table `cuslogs`
--
ALTER TABLE `cuslogs`
  ADD CONSTRAINT `cuslogs_ibfk_1` FOREIGN KEY (`CusID`) REFERENCES `customer` (`CusID`);

--
-- Constraints for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD CONSTRAINT `customer_account_ibfk_1` FOREIGN KEY (`CusID`) REFERENCES `customer` (`CusID`);

--
-- Constraints for table `emplogs`
--
ALTER TABLE `emplogs`
  ADD CONSTRAINT `emplogs_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);

--
-- Constraints for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD CONSTRAINT `employee_account_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
