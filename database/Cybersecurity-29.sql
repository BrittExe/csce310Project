-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2023 at 12:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Cybersecurity`
--

-- --------------------------------------------------------

--
-- Table structure for table `Certification`
--

CREATE TABLE `Certification` (
  `Cert_ID` int(11) NOT NULL,
  `Level` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Certification`
--

INSERT INTO `Certification` (`Cert_ID`, `Level`, `Name`, `Description`) VALUES
(1, 'IAT 1', 'CompTIA A+', NULL),
(2, 'IAT 2', 'GSEC', NULL),
(3, 'IAT 3', 'CISA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Cert_Enrollment`
--

CREATE TABLE `Cert_Enrollment` (
  `CertE_Num` int(11) NOT NULL,
  `UIN` int(11) DEFAULT NULL,
  `Cert_ID` int(11) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `Training_Status` varchar(100) DEFAULT NULL,
  `Program_Num` int(11) DEFAULT NULL,
  `Semester` varchar(100) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `Class_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`Class_ID`, `Name`, `Description`, `Type`) VALUES
(1, 'CSCE 310', NULL, 'CSCE');

-- --------------------------------------------------------

--
-- Table structure for table `Class_Enrollment`
--

CREATE TABLE `Class_Enrollment` (
  `CE_Num` int(11) NOT NULL,
  `UIN` int(11) DEFAULT NULL,
  `Class_ID` int(11) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `Semester` varchar(100) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `College_Student`
--

CREATE TABLE `College_Student` (
  `UIN` int(11) NOT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Hispanic_Latino` binary(1) DEFAULT NULL,
  `Race` varchar(50) DEFAULT NULL,
  `US_Citizen` binary(1) DEFAULT NULL,
  `First_Generation` binary(1) DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `GPA` float DEFAULT NULL,
  `Major` varchar(50) DEFAULT NULL,
  `Minor_1` varchar(50) DEFAULT NULL,
  `Minor_2` varchar(25) DEFAULT NULL,
  `Expected_Graduation` smallint(6) DEFAULT NULL,
  `School` varchar(50) DEFAULT NULL,
  `Classification` varchar(50) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Student_Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `Event_ID` int(11) NOT NULL,
  `Program_Num` int(11) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `Start_Time` time DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Event_Type` varchar(100) DEFAULT NULL,
  `UIN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`Event_ID`, `Program_Num`, `Start_Date`, `Start_Time`, `Location`, `End_Date`, `End_Time`, `Event_Type`, `UIN`) VALUES
(1, 1, '2023-11-28', '15:49:58', 'ZACH', '2023-11-28', '16:50:23', 'General', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Event_Tracking`
--

CREATE TABLE `Event_Tracking` (
  `ET_Num` int(11) NOT NULL,
  `Event_ID` int(11) NOT NULL,
  `UIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Programs`
--

CREATE TABLE `Programs` (
  `Program_Num` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Programs`
--

INSERT INTO `Programs` (`Program_Num`, `Name`, `Description`) VALUES
(1, 'CLDP', 'Cyber Leader Development Program'),
(2, 'VICEROY', 'Virtual Institutes for Cyber and Electromagnetic Spectrum Research and Employ'),
(3, 'Pathways', 'Pathways'),
(4, 'SFS', 'CyberCorps: Scholarship for Service'),
(5, 'CySP', 'DoD Cybersecurity Scholarship Program');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Total_College_Student`
-- (See below for the actual view)
--
CREATE TABLE `Total_College_Student` (
`UIN` int(11)
,`First_Name` varchar(20)
,`M_Initial` char(2)
,`Last_Name` varchar(20)
,`Username` varchar(20)
,`Passwords` varchar(20)
,`User_Type` varchar(20)
,`Email` varchar(30)
,`Discord_Name` varchar(30)
,`Is_Deleted` tinyint(1)
,`Gender` varchar(50)
,`Hispanic_Latino` binary(1)
,`Race` varchar(50)
,`US_Citizen` binary(1)
,`First_Generation` binary(1)
,`DoB` date
,`GPA` float
,`Major` varchar(50)
,`Minor_1` varchar(50)
,`Minor_2` varchar(25)
,`Expected_Graduation` smallint(6)
,`School` varchar(50)
,`Classification` varchar(50)
,`Phone` int(11)
,`Student_Type` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `Track`
--

CREATE TABLE `Track` (
  `Tracking_Num` int(11) NOT NULL,
  `Program_Num` int(11) DEFAULT NULL,
  `UIN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UIN` int(11) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `M_Initial` char(2) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Passwords` varchar(20) NOT NULL,
  `User_Type` varchar(20) NOT NULL DEFAULT 'Student',
  `Email` varchar(30) NOT NULL,
  `Discord_Name` varchar(30) NOT NULL,
  `Is_Deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UIN`, `First_Name`, `M_Initial`, `Last_Name`, `Username`, `Passwords`, `User_Type`, `Email`, `Discord_Name`, `Is_Deleted`) VALUES
(12, '', '', '', 'Admin', 'Admin', 'Admin', '', '', 0),
(13, 'name', '', '', 'Admin2', 'Admin2', 'Admin', '', '', 0);

--
-- Triggers `User`
--
DELIMITER $$
CREATE TRIGGER `StudentCreate` AFTER INSERT ON `User` FOR EACH ROW IF NEW.User_Type = 'College Student' THEN
INSERT INTO `College_Student` (`UIN`, `Gender`, `Hispanic_Latino`, `Race`, `US_Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor_1`, `Minor_2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES (NEW.UIN, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `StudentDelete` AFTER DELETE ON `User` FOR EACH ROW DELETE FROM `College_Student` WHERE `College_Student`.UIN = OLD.UIN
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `StudentUpdate` AFTER UPDATE ON `User` FOR EACH ROW IF NEW.User_Type = 'College Student' AND OLD.User_Type != 'College Student' THEN
INSERT INTO `College_Student` (`UIN`, `Gender`, `Hispanic_Latino`, `Race`, `US_Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor_1`, `Minor_2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES (NEW.UIN, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `Total_College_Student`
--
DROP TABLE IF EXISTS `Total_College_Student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Total_College_Student`  AS SELECT `User`.`UIN` AS `UIN`, `User`.`First_Name` AS `First_Name`, `User`.`M_Initial` AS `M_Initial`, `User`.`Last_Name` AS `Last_Name`, `User`.`Username` AS `Username`, `User`.`Passwords` AS `Passwords`, `User`.`User_Type` AS `User_Type`, `User`.`Email` AS `Email`, `User`.`Discord_Name` AS `Discord_Name`, `User`.`Is_Deleted` AS `Is_Deleted`, `College_Student`.`Gender` AS `Gender`, `College_Student`.`Hispanic_Latino` AS `Hispanic_Latino`, `College_Student`.`Race` AS `Race`, `College_Student`.`US_Citizen` AS `US_Citizen`, `College_Student`.`First_Generation` AS `First_Generation`, `College_Student`.`DoB` AS `DoB`, `College_Student`.`GPA` AS `GPA`, `College_Student`.`Major` AS `Major`, `College_Student`.`Minor_1` AS `Minor_1`, `College_Student`.`Minor_2` AS `Minor_2`, `College_Student`.`Expected_Graduation` AS `Expected_Graduation`, `College_Student`.`School` AS `School`, `College_Student`.`Classification` AS `Classification`, `College_Student`.`Phone` AS `Phone`, `College_Student`.`Student_Type` AS `Student_Type` FROM (`User` join `College_Student` on(`User`.`UIN` = `College_Student`.`UIN`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Certification`
--
ALTER TABLE `Certification`
  ADD PRIMARY KEY (`Cert_ID`);

--
-- Indexes for table `Cert_Enrollment`
--
ALTER TABLE `Cert_Enrollment`
  ADD PRIMARY KEY (`CertE_Num`),
  ADD KEY `Cert_Enrollment_FK` (`UIN`),
  ADD KEY `Cert_Enrollment_FK_1` (`Cert_ID`),
  ADD KEY `Cert_Enrollment_FK_2` (`Program_Num`);

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`Class_ID`);

--
-- Indexes for table `Class_Enrollment`
--
ALTER TABLE `Class_Enrollment`
  ADD PRIMARY KEY (`CE_Num`),
  ADD KEY `Class_Enrollment_FK` (`UIN`),
  ADD KEY `Class_Enrollment_FK_1` (`Class_ID`);

--
-- Indexes for table `College_Student`
--
ALTER TABLE `College_Student`
  ADD PRIMARY KEY (`UIN`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `Event_FK` (`Program_Num`),
  ADD KEY `Event_FK_UIN` (`UIN`);

--
-- Indexes for table `Event_Tracking`
--
ALTER TABLE `Event_Tracking`
  ADD PRIMARY KEY (`ET_Num`),
  ADD KEY `Event_Tracking_FK_UIN` (`UIN`),
  ADD KEY `Event_Tracking_FK_EventID` (`Event_ID`);

--
-- Indexes for table `Programs`
--
ALTER TABLE `Programs`
  ADD PRIMARY KEY (`Program_Num`);

--
-- Indexes for table `Track`
--
ALTER TABLE `Track`
  ADD PRIMARY KEY (`Tracking_Num`),
  ADD KEY `Track_FK` (`UIN`),
  ADD KEY `Track_FK_1` (`Program_Num`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UIN`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Certification`
--
ALTER TABLE `Certification`
  MODIFY `Cert_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Cert_Enrollment`
--
ALTER TABLE `Cert_Enrollment`
  MODIFY `CertE_Num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `College_Student`
--
ALTER TABLE `College_Student`
  MODIFY `UIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Event_Tracking`
--
ALTER TABLE `Event_Tracking`
  MODIFY `ET_Num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Programs`
--
ALTER TABLE `Programs`
  MODIFY `Program_Num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Track`
--
ALTER TABLE `Track`
  MODIFY `Tracking_Num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cert_Enrollment`
--
ALTER TABLE `Cert_Enrollment`
  ADD CONSTRAINT `Cert_Enrollment_FK` FOREIGN KEY (`UIN`) REFERENCES `College_Student` (`UIN`),
  ADD CONSTRAINT `Cert_Enrollment_FK_1` FOREIGN KEY (`Cert_ID`) REFERENCES `Certification` (`Cert_ID`),
  ADD CONSTRAINT `Cert_Enrollment_FK_2` FOREIGN KEY (`Program_Num`) REFERENCES `Programs` (`Program_Num`);

--
-- Constraints for table `Class_Enrollment`
--
ALTER TABLE `Class_Enrollment`
  ADD CONSTRAINT `Class_Enrollment_FK` FOREIGN KEY (`UIN`) REFERENCES `College_Student` (`UIN`),
  ADD CONSTRAINT `Class_Enrollment_FK_1` FOREIGN KEY (`Class_ID`) REFERENCES `Classes` (`Class_ID`);

--
-- Constraints for table `College_Student`
--
ALTER TABLE `College_Student`
  ADD CONSTRAINT `College_Student_ibfk_1` FOREIGN KEY (`UIN`) REFERENCES `User` (`UIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_FK` FOREIGN KEY (`Program_Num`) REFERENCES `Programs` (`Program_Num`),
  ADD CONSTRAINT `Event_FK_UIN` FOREIGN KEY (`UIN`) REFERENCES `User` (`UIN`);

--
-- Constraints for table `Event_Tracking`
--
ALTER TABLE `Event_Tracking`
  ADD CONSTRAINT `Event_Tracking_FK_EventID` FOREIGN KEY (`Event_ID`) REFERENCES `Event` (`Event_ID`),
  ADD CONSTRAINT `Event_Tracking_FK_UIN` FOREIGN KEY (`UIN`) REFERENCES `User` (`UIN`);

--
-- Constraints for table `Track`
--
ALTER TABLE `Track`
  ADD CONSTRAINT `Track_FK` FOREIGN KEY (`UIN`) REFERENCES `College_Student` (`UIN`),
  ADD CONSTRAINT `Track_FK_1` FOREIGN KEY (`Program_Num`) REFERENCES `Programs` (`Program_Num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
