-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 11:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedulems`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashcorpprofile`
--

CREATE TABLE `dashcorpprofile` (
  `ProfileId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `ProfileImage` varchar(100) NOT NULL,
  `TimeUploaded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashcorpprofile`
--

INSERT INTO `dashcorpprofile` (`ProfileId`, `UserId`, `ProfileImage`, `TimeUploaded`) VALUES
(1, 1, 'DashCorp1.png', '2022-06-01 09:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `dashcorpschedule`
--

CREATE TABLE `dashcorpschedule` (
  `ScheduleId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `schedule_title` varchar(100) NOT NULL,
  `schedule_detail` text NOT NULL,
  `schedule_location` varchar(100) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `TimeAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashcorpschedule`
--

INSERT INTO `dashcorpschedule` (`ScheduleId`, `UserId`, `schedule_title`, `schedule_detail`, `schedule_location`, `schedule_date`, `schedule_start_time`, `schedule_end_time`, `TimeAdded`) VALUES
(1, 1, 'Serious Learning', 'All modules', 'IAA Library', '2022-06-06', '10:00:00', '14:00:00', '2022-05-31 21:48:32'),
(2, 1, 'uihyiuguyfgu', 'strdrtdtyrd', 'tyfdytfdytfyut', '2022-06-09', '13:35:00', '12:36:00', '2022-06-08 09:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `dashcorptask`
--

CREATE TABLE `dashcorptask` (
  `TaskId` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `TaskTitle` varchar(100) NOT NULL,
  `TaskDetail` text NOT NULL,
  `TaskDate` date NOT NULL,
  `TaskTime` time NOT NULL,
  `TimeTaskAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashcorptask`
--

INSERT INTO `dashcorptask` (`TaskId`, `UserId`, `TaskTitle`, `TaskDetail`, `TaskDate`, `TaskTime`, `TimeTaskAdded`) VALUES
(1, 1, 'Learning AI', 'Search Algorithm', '2022-06-09', '07:00:00', '2022-05-31 21:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `dashcorpusers`
--

CREATE TABLE `dashcorpusers` (
  `UserId` int(10) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contacts` varchar(13) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TimeRegistered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashcorpusers`
--

INSERT INTO `dashcorpusers` (`UserId`, `FullName`, `Email`, `Contacts`, `Nationality`, `City`, `Gender`, `Username`, `Password`, `TimeRegistered`) VALUES
(1, 'Fabrino Mhengilolo', 'fabrinomhengilolo@gmail.com', '0768192810', 'Tanzanian', 'Mbeya', 'M', 'DashCorp', '$2y$10$O8SPbj8QXk.eSSuC1rQGDep3TrueT9OGZswlzRa1p1YaAoykbNp3C', '2022-06-01 00:41:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashcorpprofile`
--
ALTER TABLE `dashcorpprofile`
  ADD PRIMARY KEY (`ProfileId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `dashcorpschedule`
--
ALTER TABLE `dashcorpschedule`
  ADD PRIMARY KEY (`ScheduleId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `dashcorptask`
--
ALTER TABLE `dashcorptask`
  ADD PRIMARY KEY (`TaskId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `dashcorpusers`
--
ALTER TABLE `dashcorpusers`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashcorpprofile`
--
ALTER TABLE `dashcorpprofile`
  MODIFY `ProfileId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dashcorpschedule`
--
ALTER TABLE `dashcorpschedule`
  MODIFY `ScheduleId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dashcorptask`
--
ALTER TABLE `dashcorptask`
  MODIFY `TaskId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dashcorpusers`
--
ALTER TABLE `dashcorpusers`
  MODIFY `UserId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashcorpprofile`
--
ALTER TABLE `dashcorpprofile`
  ADD CONSTRAINT `dashcorpprofile_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `dashcorpusers` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dashcorpschedule`
--
ALTER TABLE `dashcorpschedule`
  ADD CONSTRAINT `dashcorpschedule_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `dashcorpusers` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dashcorptask`
--
ALTER TABLE `dashcorptask`
  ADD CONSTRAINT `dashcorptask_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `dashcorpusers` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
