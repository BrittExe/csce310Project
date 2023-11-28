-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2023 at 09:08 PM
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
-- Table structure for table `College_Student`
--

CREATE TABLE `College_Student` (
  `UIN` int(11) NOT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Hispanic/Latino` binary(1) DEFAULT NULL,
  `Race` varchar(50) DEFAULT NULL,
  `U.S._Citizen` binary(1) DEFAULT NULL,
  `First_Generation` binary(1) DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `GPA` float DEFAULT NULL,
  `Major` varchar(50) DEFAULT NULL,
  `Minor_#1` varchar(50) DEFAULT NULL,
  `Minor_#2` varchar(25) DEFAULT NULL,
  `Expected_Graduation` smallint(6) DEFAULT NULL,
  `School` varchar(50) DEFAULT NULL,
  `Classification` varchar(50) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Student_Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `College_Student`
--

INSERT INTO `College_Student` (`UIN`, `Gender`, `Hispanic/Latino`, `Race`, `U.S._Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor_#1`, `Minor_#2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES
(1, NULL, 0x46, NULL, NULL, NULL, NULL, 3.79, NULL, '\"A Language\"', NULL, NULL, NULL, NULL, NULL, NULL);

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
,`Hispanic/Latino` binary(1)
,`Race` varchar(50)
,`U.S._Citizen` binary(1)
,`First_Generation` binary(1)
,`DoB` date
,`GPA` float
,`Major` varchar(50)
,`Minor_#1` varchar(50)
,`Minor_#2` varchar(25)
,`Expected_Graduation` smallint(6)
,`School` varchar(50)
,`Classification` varchar(50)
,`Phone` int(11)
,`Student_Type` varchar(50)
);

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
(1, '', '', '', 'Britt', '', 'College Student', 'brittschiller@tamu.edu', '', 1);

--
-- Triggers `User`
--
DELIMITER $$
CREATE TRIGGER `StudentCreate` AFTER INSERT ON `User` FOR EACH ROW IF NEW.User_Type = 'College Student' THEN
INSERT INTO `College_Student` (`UIN`, `Gender`, `Hispanic/Latino`, `Race`, `U.S. Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor #1`, `Minor #2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES (NEW.UIN, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `StudentUpdate` AFTER UPDATE ON `User` FOR EACH ROW IF NEW.User_Type = 'College Student' AND OLD.User_Type != 'College Student' THEN
INSERT INTO `College_Student` (`UIN`, `Gender`, `Hispanic/Latino`, `Race`, `U.S. Citizen`, `First_Generation`, `DoB`, `GPA`, `Major`, `Minor #1`, `Minor #2`, `Expected_Graduation`, `School`, `Classification`, `Phone`, `Student_Type`) VALUES (NEW.UIN, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `Total_College_Student`
--
DROP TABLE IF EXISTS `Total_College_Student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Total_College_Student`  AS SELECT `User`.`UIN` AS `UIN`, `User`.`First_Name` AS `First_Name`, `User`.`M_Initial` AS `M_Initial`, `User`.`Last_Name` AS `Last_Name`, `User`.`Username` AS `Username`, `User`.`Passwords` AS `Passwords`, `User`.`User_Type` AS `User_Type`, `User`.`Email` AS `Email`, `User`.`Discord_Name` AS `Discord_Name`, `User`.`Is_Deleted` AS `Is_Deleted`, `College_Student`.`Gender` AS `Gender`, `College_Student`.`Hispanic/Latino` AS `Hispanic/Latino`, `College_Student`.`Race` AS `Race`, `College_Student`.`U.S._Citizen` AS `U.S._Citizen`, `College_Student`.`First_Generation` AS `First_Generation`, `College_Student`.`DoB` AS `DoB`, `College_Student`.`GPA` AS `GPA`, `College_Student`.`Major` AS `Major`, `College_Student`.`Minor_#1` AS `Minor_#1`, `College_Student`.`Minor_#2` AS `Minor_#2`, `College_Student`.`Expected_Graduation` AS `Expected_Graduation`, `College_Student`.`School` AS `School`, `College_Student`.`Classification` AS `Classification`, `College_Student`.`Phone` AS `Phone`, `College_Student`.`Student_Type` AS `Student_Type` FROM (`User` join `College_Student` on(`User`.`UIN` = `College_Student`.`UIN`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `College_Student`
--
ALTER TABLE `College_Student`
  ADD PRIMARY KEY (`UIN`);

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
-- AUTO_INCREMENT for table `College_Student`
--
ALTER TABLE `College_Student`
  MODIFY `UIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `College_Student`
--
ALTER TABLE `College_Student`
  ADD CONSTRAINT `College_Student_ibfk_1` FOREIGN KEY (`UIN`) REFERENCES `User` (`UIN`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
