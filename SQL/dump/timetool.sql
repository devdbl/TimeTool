-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2021 at 12:31 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetool`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(20) NOT NULL,
  `LASTNAME` varchar(20) NOT NULL,
  `SHORTNAME` varchar(4) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `CREATED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATED` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `FIRSTNAME`, `LASTNAME`, `SHORTNAME`, `PASSWORD`, `ROLE`, `CREATED`, `UPDATED`) VALUES
(1147, 'Dominic', 'Blattner', 'dbl', '$2y$10$l4N7uty3nnajGGha2lkjMuqA2.uv2XECPDARqOuE6fhmtQqzznWku', 1, '2021-09-07 21:04:30', '2021-08-08 13:24:03'),
(5555, 'Hans', 'Lustig', 'hlu', '$2y$10$SFk3yHKZ/NXJAcNgOEDxYOFW2b1bwI/JqZihCbMZvmledzl6i04Ty', 0, '2021-08-31 19:32:18', '2021-08-31 16:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `PROJECT_ID` double NOT NULL,
  `PROJECTNAME` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(45) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`PROJECT_ID`, `PROJECTNAME`, `DESCRIPTION`, `IS_ACTIVE`) VALUES
(12, 'qwert', 'HalliHallo', 1),
(1234, 'WebApp', 'Testing the webapp', 1),
(4567, 'MySecondProject', NULL, 1),
(31013, 'NotActive', 'Ein nicht aktives Projekt', 0),
(31031, 'First API Project', 'First API updated Project', 0),
(98745, 'Validation Test Proj', 'Add with new Validation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `ID` int(11) NOT NULL,
  `PROJECT_ID` double NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `TIME` int(24) NOT NULL,
  `REPORTDATE` date NOT NULL,
  `EDIT` datetime NOT NULL DEFAULT current_timestamp(),
  `COMMENT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`ID`, `PROJECT_ID`, `EMPLOYEE_ID`, `TIME`, `REPORTDATE`, `EDIT`, `COMMENT`) VALUES
(1, 1234, 1147, 8, '2021-08-17', '2021-08-16 21:25:33', 'Meine erste Buchung'),
(2, 1234, 1147, 2, '2021-08-19', '2021-08-16 21:25:33', 'Meine zweite Buchung'),
(32, 31031, 1147, 10, '2021-08-18', '2021-09-05 14:48:53', NULL),
(39, 1234, 5555, 10, '2021-08-11', '2021-09-10 00:17:52', NULL),
(40, 31013, 5555, 10, '2021-08-17', '2021-09-10 00:17:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`),
  ADD UNIQUE KEY `SHORTNAME` (`SHORTNAME`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`PROJECT_ID`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_time_personal` (`EMPLOYEE_ID`),
  ADD KEY `fk_time_project` (`PROJECT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `fk_time_personal` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_time_project` FOREIGN KEY (`PROJECT_ID`) REFERENCES `project` (`PROJECT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
