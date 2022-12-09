-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 01:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ca2`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignmentID` int(11) NOT NULL,
  `moduleID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `grade` decimal(10,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `submit_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignmentID`, `moduleID`, `name`, `note`, `type`, `grade`, `due_date`, `submit_date`, `image`) VALUES
(1, 1, 'CA1 - History Presentation', 'Present about your favorite historical figure in magic', 'Recoverable', '78.00', '2022-12-02', '2022-11-30', ''),
(26, 1, 'Levitate Spell', 'Practice levitating objects of choice', 'Recoverable', '60.00', '2022-12-14', '2022-12-15', ''),
(27, 3, 'Levitate Charm', 'Practice levitating objects of choice', 'Recoverable', '79.00', '2022-12-07', '2022-12-20', ''),
(30, 1, 'Love Charm', 'Present about a historical figure in magic', 'Recoverableergjnej', '78.00', '2022-12-14', '2022-12-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `moduleID` int(11) NOT NULL,
  `moduleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`moduleID`, `moduleName`) VALUES
(1, 'History of Magic'),
(2, 'Transfiguration Spells'),
(3, 'Basics of Charms'),
(4, 'Healing Spells');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignmentID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`moduleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `moduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
