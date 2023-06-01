-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 06:10 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_account_check` (IN `username` VARCHAR(255), IN `password` VARCHAR(255))   BEGIN
    	SELECT username FROM customer_account WHERE username = username;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_account_register` (IN `user_ID` INT, IN `user` VARCHAR(255), IN `pass` VARCHAR(255))   BEGIN
    	INSERT INTO customer_accounts_view(CusID,username,password) VALUES(user_ID, user, pass);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_login` (INOUT `p_username` VARCHAR(30), IN `p_password` VARCHAR(30), OUT `p_customer_id` INT, OUT `p_login_success` BOOLEAN)   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_register` (IN `fname` VARCHAR(100), IN `lname` VARCHAR(100), IN `mname` VARCHAR(100), IN `contact` VARCHAR(11), IN `dateofbirth` DATE)   BEGIN
    INSERT INTO customer_view(FirstName, LastName, MiddleName, Contact, DateOfBirth)
    VALUES (fname, lname, mname, contact, dateofbirth);
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
  `DriverID` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `CarID` int(10) NOT NULL,
  `CarName` varchar(100) NOT NULL,
  `PlateNumber` varchar(100) NOT NULL,
  `ACperDay` int(11) NOT NULL,
  `ACperKm` int(11) NOT NULL,
  `NonACperDay` int(11) NOT NULL,
  `NonACperKm` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `CarImg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `cuslogs`
--

INSERT INTO `cuslogs` (`CusLogID`, `CusID`, `Timestamp`, `Action`) VALUES
(1, 4, '2023-06-01 16:08:46', 'Logged in');

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CusID`, `FirstName`, `LastName`, `MiddleName`, `Contact`, `DateOfBirth`) VALUES
(4, 'Howard Glen', 'Gloria', 'Cortel', '09514079156', '2003-02-11'),
(5, 'Glen', 'Gloria', 'Onong', '09125907727', '2023-06-28'),
(6, 'Harold', 'Glen', 'GLoria', '123123', '2023-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `CusID` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`CusID`, `username`, `password`) VALUES
(4, 'piraticame', 'lockDOWN11!'),
(5, 'glen', '123'),
(6, 'test', '123');

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
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Contact` varchar(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `customer_accounts_view`
--
DROP TABLE IF EXISTS `customer_accounts_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_accounts_view`  AS SELECT `customer_account`.`CusID` AS `CusID`, `customer_account`.`username` AS `username`, `customer_account`.`password` AS `password` FROM `customer_account``customer_account`  ;

-- --------------------------------------------------------

--
-- Structure for view `customer_view`
--
DROP TABLE IF EXISTS `customer_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_view`  AS SELECT `customer`.`CusID` AS `CusID`, `customer`.`FirstName` AS `FirstName`, `customer`.`LastName` AS `LastName`, `customer`.`MiddleName` AS `MiddleName`, `customer`.`Contact` AS `Contact`, `customer`.`DateOfBirth` AS `DateOfBirth` FROM `customer``customer`  ;

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
  ADD PRIMARY KEY (`CarID`);

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
  ADD PRIMARY KEY (`DriverID`);

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
  MODIFY `CusLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CusID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `EmpID` int(10) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
