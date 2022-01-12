-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 11:33 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `falcondatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phonenumber` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `event`, `FirstName`, `LastName`, `email`, `phonenumber`) VALUES
(1, 'Peeking', '', '', '', 0),
(2, 'Zyzz meeting', 'Teodor', 'Folea', 'teodorfolea@yahoo.com', 723072264),
(3, 'Zyzz meeting', 'Teodor', 'Folea', 'teodorfolea@yahoo.com', 723072264),
(4, 'Zyzz meeting', 'Teodor', 'Folea', 'zackgenesisr@gmail.com', 723072264),
(5, 'Zyzz meeting', 'Teodor', 'Folea', 'zackgenesisr@gmail.com', 723072264),
(6, 'Zyzz meeting', 'Teodor', 'Folea', 'zackgenesisr@gmail.com', 723072264),
(7, 'Zyzz meeting', 'Teodor', 'Folea', 'zackgenesisr@gmail.com', 723072264),
(8, 'Feeding', 'Kayn', 'Viego', 'adc@gmail.com', 7213145),
(9, 'Feeding', 'Kayn', 'Viego', 'adc@gmail.com', 7213145),
(10, 'Feeding', 'Kayn', 'Viego', 'adc@gmail.com', 7213145),
(11, 'Feeding', 'Kayn', 'Viego', 'adc@gmail.com', 7213145),
(12, 'Arian teaches me how to be a chad', 'Arian', 'Atapour', 'arianissexy@gmail.com', 2147483647),
(13, 'RagaBomb', 'Skrillex', 'Sony', 'skrillex@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `userID` int(50) NOT NULL,
  `guestid` int(50) NOT NULL,
  `activityid` int(50) NOT NULL,
  `tableid` int(50) NOT NULL,
  `roomid` int(50) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`userID`, `guestid`, `activityid`, `tableid`, `roomid`, `email`) VALUES
(0, 0, 0, 0, 0, ''),
(0, 0, 0, 0, 0, ''),
(0, 0, 0, 0, 0, ''),
(0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(50) NOT NULL,
  `roomName` varchar(20) DEFAULT NULL,
  `roomQuantity` int(100) DEFAULT NULL,
  `usernameRes` varchar(255) NOT NULL,
  `emailRes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `roomName`, `roomQuantity`, `usernameRes`, `emailRes`) VALUES
(1, 'Cool', 20, 'Client', 'client@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(50) NOT NULL,
  `Date` date NOT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `tablenumber` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `Date`, `FirstName`, `LastName`, `tablenumber`) VALUES
(1, '2021-12-01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `checkIn` varchar(50) NOT NULL,
  `checkOut` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `loginid` int(50) NOT NULL,
  `userlevel` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `checkIn`, `checkOut`, `password`, `loginid`, `userlevel`) VALUES
(6, 'Tired', 'YesIam', 'tired@mail.com', '', '', '$argon2id$v=19$m=2048,t=4,p=3$', 0, 'guest'),
(7, 'test', 'testTest', 'test@mail.com', '', '', '$argon2id$v=19$m=2048,t=4,p=3$', 0, 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD KEY `userID` (`userID`),
  ADD KEY `reservations_ibfk_2` (`guestid`),
  ADD KEY `reservations_ibfk_3` (`activityid`),
  ADD KEY `reservations_ibfk_4` (`tableid`),
  ADD KEY `reservations_ibfk_5` (`roomid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Reservation_table` (`Date`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`guestid`) REFERENCES `guest` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`activityid`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_4` FOREIGN KEY (`tableid`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_5` FOREIGN KEY (`roomid`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
