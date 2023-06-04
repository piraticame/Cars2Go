-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 12:11 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_login` (INOUT `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_customer_id` INT, OUT `p_login_success` BOOLEAN)   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_login` (INOUT `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_employee_id` INT, OUT `p_login_success` BOOLEAN)   BEGIN
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

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`CarID`, `CarName`, `PlateNumber`, `ACperDay`, `ACperKm`, `NonACperDay`, `NonACperKm`, `status`, `CarImg`) VALUES
(1, 'Audi A4', 'LA2032', 2500, 50, 2000, 35, 'available', 'audi-a4.jpg'),
(2, 'BMW-6', 'LA2032', 2500, 50, 2000, 35, 'unavailable', 'bmw6.jpg');

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
,`ACperKm` int(11)
,`NonACperDay` int(11)
,`NonACperKm` int(11)
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

--
-- Dumping data for table `cuslogs`
--

INSERT INTO `cuslogs` (`CusLogID`, `CusID`, `Timestamp`, `Action`) VALUES
(1, 4, '2023-06-01 16:08:46', 'Logged in'),
(3, 4, '2023-06-01 16:14:47', 'Logged in'),
(4, 4, '2023-06-01 16:14:53', 'Logged out'),
(5, 7, '2023-06-01 16:16:53', 'Registered'),
(6, 7, '2023-06-01 16:17:07', 'Logged in'),
(7, 7, '2023-06-01 16:17:29', 'Logged out'),
(8, 4, '2023-06-01 17:12:57', 'Logged in'),
(9, 4, '2023-06-01 17:13:28', 'Logged out'),
(10, 4, '2023-06-01 17:13:39', 'Logged in'),
(11, 4, '2023-06-01 17:14:44', 'Logged in'),
(12, 4, '2023-06-01 17:15:26', 'Logged in'),
(13, 4, '2023-06-01 17:15:41', 'Logged out'),
(14, 4, '2023-06-01 17:15:47', 'Logged in'),
(15, 4, '2023-06-01 17:16:28', 'Logged in'),
(16, 4, '2023-06-01 17:37:12', 'Logged in'),
(17, 4, '2023-06-01 17:38:44', 'Logged in'),
(18, 6, '2023-06-01 17:38:47', 'Logged in'),
(19, 4, '2023-06-01 17:40:26', 'Logged in'),
(20, 4, '2023-06-01 17:42:38', 'Logged in'),
(21, 4, '2023-06-01 17:42:45', 'Logged in'),
(22, 6, '2023-06-01 17:44:17', 'Logged in'),
(23, 6, '2023-06-01 17:47:26', 'Logged out'),
(24, 4, '2023-06-01 17:47:32', 'Logged in'),
(25, 4, '2023-06-01 19:30:18', 'Logged out'),
(26, 4, '2023-06-01 19:32:07', 'Logged in'),
(27, 4, '2023-06-01 19:32:15', 'Logged out'),
(28, 4, '2023-06-01 19:34:03', 'Logged in'),
(29, 4, '2023-06-01 19:34:15', 'Logged in'),
(30, 4, '2023-06-01 19:36:18', 'Logged out'),
(33, 6, '2023-06-03 06:41:21', 'Logged in'),
(34, 6, '2023-06-03 06:43:23', 'Logged out'),
(35, 4, '2023-06-03 06:48:12', 'Logged in'),
(36, 4, '2023-06-03 07:09:56', 'Logged out'),
(40, 6, '2023-06-03 07:43:23', 'Logged in'),
(41, 6, '2023-06-03 07:43:39', 'Logged out');

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CusID`, `FirstName`, `LastName`, `MiddleName`, `Contact`, `DateOfBirth`) VALUES
(4, 'Howard Glen', 'Gloria', 'Cortel', '09514079156', '2003-02-11'),
(5, 'Glen', 'Gloria', 'Onong', '09125907727', '2023-06-28'),
(6, 'Harold', 'Glen', 'GLoria', '123123', '2023-06-21'),
(7, 'Jesseca', 'Tubo', 'Latras', '091551515', '2023-06-29');

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
(6, 'test', '123'),
(7, 'Pretty GF', '123');

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

--
-- Dumping data for table `emplogs`
--

INSERT INTO `emplogs` (`EmpLogID`, `EmpID`, `Timestamp`, `Action`) VALUES
(1, 1, '2023-06-02 06:41:27', 'Logged in'),
(2, 1, '2023-06-03 06:40:17', 'Logged in'),
(3, 1, '2023-06-03 06:40:53', 'Logged in'),
(4, 1, '2023-06-03 07:10:22', 'Logged in'),
(5, 1, '2023-06-03 07:19:43', 'Logged in'),
(6, 2, '2023-06-03 07:25:52', 'Logged in'),
(7, 2, '2023-06-03 07:43:44', 'Logged in'),
(8, 1, '2023-06-03 07:50:25', 'Logged in'),
(9, 2, '2023-06-03 07:52:52', 'Logged in'),
(10, 1, '2023-06-03 07:53:02', 'Logged in'),
(11, 1, '2023-06-04 07:46:44', 'Logged in'),
(12, 1, '2023-06-04 07:56:17', 'Logged in'),
(13, 1, '2023-06-04 08:13:11', 'Logged in'),
(14, 1, '2023-06-04 08:22:56', 'Logged in'),
(15, 1, '2023-06-04 08:42:07', 'Logged in'),
(16, 1, '2023-06-04 08:47:36', 'Logged in'),
(17, 1, '2023-06-04 09:28:43', 'Logged in');

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
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `FirstName`, `LastName`, `Contact`, `role`, `status`) VALUES
(1, 'Admin', 'Admin', 'N/A', 'admin', 'active'),
(2, 'Wawee', 'Gloria', '0966545', 'employee', 'active');

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
(1, 'root', 'root'),
(2, 'test', '123');

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
);

-- --------------------------------------------------------

--
-- Structure for view `car_available_view`
--
DROP TABLE IF EXISTS `car_available_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `car_available_view`  AS SELECT `car`.`CarID` AS `CarID`, `car`.`CarName` AS `CarName`, `car`.`PlateNumber` AS `PlateNumber`, `car`.`ACperDay` AS `ACperDay`, `car`.`ACperKm` AS `ACperKm`, `car`.`NonACperDay` AS `NonACperDay`, `car`.`NonACperKm` AS `NonACperKm`, `car`.`status` AS `status`, `car`.`CarImg` AS `CarImg` FROM `car` WHERE `car`.`status` = 'available''available'  ;

-- --------------------------------------------------------

--
-- Structure for view `cuslogs_view`
--
DROP TABLE IF EXISTS `cuslogs_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cuslogs_view`  AS SELECT `cuslogs`.`CusLogID` AS `CusLogID`, `cuslogs`.`CusID` AS `CusID`, `cuslogs`.`Timestamp` AS `Timestamp`, `cuslogs`.`Action` AS `Action` FROM `cuslogs``cuslogs`  ;

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

-- --------------------------------------------------------

--
-- Structure for view `emplogs_view`
--
DROP TABLE IF EXISTS `emplogs_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `emplogs_view`  AS SELECT `emplogs`.`EmpLogID` AS `EmpLogID`, `emplogs`.`EmpID` AS `EmpID`, `emplogs`.`Timestamp` AS `Timestamp`, `emplogs`.`Action` AS `Action` FROM `emplogs``emplogs`  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_account_view`
--
DROP TABLE IF EXISTS `employee_account_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_account_view`  AS SELECT `employee_account`.`EmpID` AS `EmpID`, `employee_account`.`username` AS `username`, `employee_account`.`password` AS `password` FROM `employee_account``employee_account`  ;

-- --------------------------------------------------------

--
-- Structure for view `employee_view`
--
DROP TABLE IF EXISTS `employee_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_view`  AS SELECT `employee`.`EmpID` AS `EmpID`, `employee`.`FirstName` AS `FirstName`, `employee`.`LastName` AS `LastName`, `employee`.`Contact` AS `Contact`, `employee`.`role` AS `role`, `employee`.`status` AS `status` FROM `employee``employee`  ;

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
  MODIFY `CarID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cuslogs`
--
ALTER TABLE `cuslogs`
  MODIFY `CusLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CusID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `DriverID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emplogs`
--
ALTER TABLE `emplogs`
  MODIFY `EmpLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
