-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 10:01 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetool`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
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
-- Dumping data for table `api`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `FIRSTNAME`, `LASTNAME`, `SHORTNAME`, `PASSWORD`, `ROLE`, `CREATED`, `UPDATED`) VALUES
(1000, 'Simon', 'Buchmann', 'sbu', '1234', 0, '2021-08-08 13:25:00', '2021-08-08 13:25:00'),
(1147, 'Dominic', 'Blattner', 'dbl', '1234', 0, '2021-08-08 13:24:03', '2021-08-08 13:24:03'),
(9000, 'Teodor', 'Bucher', 'tbu', '4321', 2, '2021-08-08 13:26:17', '2021-08-08 13:26:17'),
(9999, 'Ulrich', 'Admin', 'tad', '12345', 1, '2021-08-08 13:26:44', '2021-08-08 13:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `PROJECT_ID` double NOT NULL,
  `PROJECTNAME` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`PROJECT_ID`, `PROJECTNAME`, `DESCRIPTION`) VALUES
(12.12, 'MyFirstProject', 'TryToGetThisOutOfDatabase'),
(4567.123, 'MySecondProject', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `ID` int(11) NOT NULL,
  `PROJECT_ID` double NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `TIME` varchar(45) NOT NULL,
  `WEEK` varchar(45) NOT NULL,
  `EDIT` datetime NOT NULL,
  `COMMENT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
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
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `employee`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
