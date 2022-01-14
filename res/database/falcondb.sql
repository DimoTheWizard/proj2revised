-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 08:16 PM
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
  `activityAvailability` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activityName`, `activityLimit`, `activityAvailability`, `description`, `date`, `time`) VALUES
(4, 'Pro ForkKnife gaming', 4, 1, 'learn how to do 90\'s', '2022-01-14', '12:00:00'),
(5, 'Cooking Haggis', 5, 1, 'cook \"delicious\" traditional scottish food', '2022-01-19', '00:00:15'),
(6, 'Spear Fishing', 3, 1, 'catch fish by violently throwing spears', '2022-01-23', '09:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservedactivities`
--

CREATE TABLE `reservedactivities` (
  `userId` int(11) DEFAULT NULL,
  `activityId` int(11) DEFAULT NULL,
  `checkIn` date DEFAULT current_timestamp(),
  `rsrvActivitiesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservedactivities`
--

INSERT INTO `reservedactivities` (`userId`, `activityId`, `checkIn`, `rsrvActivitiesId`) VALUES
(3, 6, '2022-01-13', 2),
(5, 1, '2022-01-14', 24),
(5, 1, '2022-01-14', 25),
(5, 1, '2022-01-14', 26);

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
(2, 2, '2022-01-12', '2022-01-14', 1),
(5, 1, '2022-01-14', '2022-01-15', 3),
(5, 1, '2022-01-14', '2022-01-15', 4);

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
(2, 2, '2022-01-12', 1),
(3, 2, '2022-01-14', 2),
(4, 3, '2022-01-18', 3);

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
(2, 2, 1, 'Normal'),
(4, 3, 1, 'VIP'),
(6, 4, 1, 'VIP');

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
(2, 2),
(3, 1),
(4, 3);

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
  `pathCert` varchar(255) NOT NULL,
  `fName` varchar(15) NOT NULL,
  `lName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `usrLevel`, `pathCert`, `fName`, `lName`) VALUES
(2, 'test3@mail.com', 'test3', 'kekbestitem3', 'User', '../coronaCerts/EpicCertificate.pdf', 'test3F', 'test3L'),
(3, 'corkigae@gmail.com', 'Varus', 'nuggets123', 'User', 'fakepath', 'Anita', 'Hanjaab'),
(4, 'cykablyad@gmail.com', 'Kenshi', 'worcestershire12', 'User', 'fakePath', 'Dragma', 'Nadsk'),
(5, 'test@mail.com', 'test', '$argon2id$v=19$m=2048,t=4,p=3$UkF5dGtiUXk5LlRSL21DUg$Dtdlth76rRJRjtF05h35BnRtJPaih7cANzklhxXJzHc', 'guest', '', 'test', 'test;'),
(6, 'admin@mail.com', 'admin', '$argon2id$v=19$m=2048,t=4,p=3$cW1OU0suSHFPTEM4ZWpmeQ$GDvXlt3qEVg+idyj2XtblnfUznQw8e+p0NSgGL7i6rc', 'admin', '', 'admin', 'cooladmin'),
(7, 'weridalmail@gmail.com', 'weird al', '$argon2id$v=19$m=2048,t=4,p=3$LkdRSmUuN24zZHVNS2FTLw$oyXwQn9lzk82QDDlRbw2qDEU3hQzSeZ0zVXcj5sOt6Q', 'guest', '', 'al', 'yankovic'),
(8, 'funnytestemail@gmail.com', 'testUsername2', '$argon2id$v=19$m=2048,t=4,p=3$bVFRRlBIVGpKMUF3d1FTTw$hda74J9JtZO8fUb9G6pOxs//L1S9cm4HqgGOLp1qs8k', 'guest', '', 'Kainu', 'Reefs');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservedactivities`
--
ALTER TABLE `reservedactivities`
  MODIFY `rsrvActivitiesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reservedrooms`
--
ALTER TABLE `reservedrooms`
  MODIFY `rsrvRoomsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservedtables`
--
ALTER TABLE `reservedtables`
  MODIFY `rsrvTableId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

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
