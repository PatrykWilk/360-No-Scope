-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2019 at 02:48 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `360noscope`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomid` int(10) NOT NULL,
  `tourid` int(8) NOT NULL,
  `roomname` varchar(50) NOT NULL,
  `roomimage` varchar(50) DEFAULT NULL,
  `roomfloor` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomid`, `tourid`, `roomname`, `roomimage`, `roomfloor`) VALUES
(1000000008, 6, 'Living Room', NULL, 3),
(1000000009, 8, 'brap', NULL, NULL),
(1000000010, 9, 'toy room', NULL, 5),
(1000000011, 10, 'Living Room', NULL, 3),
(1000000012, 10, 'Bed Room', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `tourid` int(8) NOT NULL,
  `tourname` varchar(30) NOT NULL,
  `tourvisible` int(1) NOT NULL DEFAULT '0',
  `tourviews` int(4) NOT NULL DEFAULT '0',
  `userid` int(5) NOT NULL,
  `tourcreated` datetime NOT NULL,
  `tourfloorplan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`tourid`, `tourname`, `tourvisible`, `tourviews`, `userid`, `tourcreated`, `tourfloorplan`) VALUES
(9, '25 Wellington Street', 0, 0, 10001, '2019-01-29 11:57:41', '9_floorplan.jpg'),
(10, '25 Carlisle Way', 0, 0, 10000, '2019-01-29 12:33:46', '10_floorplan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(5) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `company` varchar(30) DEFAULT NULL,
  `regdate` datetime NOT NULL,
  `permiss` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `pass`, `company`, `regdate`, `permiss`) VALUES
(10000, 'Joseph', 'Hopping', 'joe_hopping@hotmail.co.uk', 'c22b5f9178342609428d6f51b2c5af4c0bde6a42', '', '2019-01-26 14:23:01', 0),
(10001, 'duje', 'bav', 'duje@gmail.com', 'd4cef45ee62779247c30d11899c10bebbe739747', NULL, '2019-01-29 11:57:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tourid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000013;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `tourid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
