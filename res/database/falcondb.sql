-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 09:57 AM
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
-- Database: `falcondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `activityName` varchar(255) NOT NULL,
  `activityLimit` int(11) NOT NULL,
  `activityAvailability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservedactivities`
--

CREATE TABLE `reservedactivities` (
  `userId` int(11) DEFAULT NULL,
  `activityId` int(11) DEFAULT NULL,
  `checkIn` date DEFAULT NULL,
  `rsrvActivitiesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservedrooms`
--

CREATE TABLE `reservedrooms` (
  `userId` int(11) DEFAULT NULL,
  `roomId` int(11) DEFAULT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `rsrvRoomsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservedrooms`
--

INSERT INTO `reservedrooms` (`userId`, `roomId`, `checkIn`, `checkOut`, `rsrvRoomsId`) VALUES
(2, 2, '2022-01-13', '2022-01-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservedtables`
--

CREATE TABLE `reservedtables` (
  `userId` int(11) DEFAULT NULL,
  `tableId` int(11) DEFAULT NULL,
  `checkIn` date DEFAULT NULL,
  `rsrvTableId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservedtables`
--

INSERT INTO `reservedtables` (`userId`, `tableId`, `checkIn`, `rsrvTableId`) VALUES
(2, 2, '2022-01-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `roomNr` int(11) NOT NULL,
  `roomAvailability` tinyint(1) NOT NULL,
  `roomType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomNr`, `roomAvailability`, `roomType`) VALUES
(2, 1, 1, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `tableNr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `tableNr`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usrLevel` varchar(20) NOT NULL,
  `pathCert` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `usrLevel`, `pathCert`) VALUES
(2, 'kekwEpicTarkovGamer@gmail.com', 'chadScav420', 'kekbestitem3', 'User', '../coronaCerts/EpicCertificate.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservedactivities`
--
ALTER TABLE `reservedactivities`
  ADD PRIMARY KEY (`rsrvActivitiesId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `activityId` (`activityId`);

--
-- Indexes for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  ADD PRIMARY KEY (`rsrvRoomsId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indexes for table `reservedtables`
--
ALTER TABLE `reservedtables`
  ADD PRIMARY KEY (`rsrvTableId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `tableId` (`tableId`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservedactivities`
--
ALTER TABLE `reservedactivities`
  MODIFY `rsrvActivitiesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  MODIFY `rsrvRoomsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservedtables`
--
ALTER TABLE `reservedtables`
  MODIFY `rsrvTableId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservedactivities`
--
ALTER TABLE `reservedactivities`
  ADD CONSTRAINT `reservedactivities_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservedactivities_ibfk_2` FOREIGN KEY (`activityId`) REFERENCES `activities` (`id`);

--
-- Constraints for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  ADD CONSTRAINT `reservedrooms_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservedrooms_ibfk_2` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `reservedtables`
--
ALTER TABLE `reservedtables`
  ADD CONSTRAINT `reservedtables_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservedtables_ibfk_2` FOREIGN KEY (`tableId`) REFERENCES `tables` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
