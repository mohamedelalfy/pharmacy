-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2018 at 12:12 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT '0',
  `Sales` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Sales`) VALUES
(17, 'Tets1', 'tes11', 0, 0, 1),
(18, 'Mohamed', 'This is just name', 2, 0, 1),
(19, 'Test 3', 'Test 3', 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Producing_Date` date NOT NULL,
  `Expiration_Date` date NOT NULL,
  `Images` varchar(255) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `Name`, `Description`, `Price`, `Producing_Date`, `Expiration_Date`, `Images`, `Cat_ID`, `Sales`) VALUES
(14, 'Omega 3', 'this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3this is Good Omega 3', '80', '2018-07-01', '2018-07-31', '393402100_Omega-3-Mini-Fish-Oil-Kenya.png', 17, 10),
(15, 'stroiquno', 'Item testItem test', '50', '2018-07-19', '2018-07-20', '27648925_2014-01-21 19.23.56-1.jpg', 18, 0),
(16, 'Item For Test', 'This is Item Just For Test', '80', '2018-07-09', '2018-07-28', '295257568_1-34.jpg', 17, 20),
(17, 'Test5', 'Test5 Test5 Test5', '50', '2018-07-05', '2018-07-07', '941192627_32c9a508aa65f0269672abf2d62909f858ac3f30.jpg', 19, 0),
(18, 'Test 9', 'Test 9Test 9', '20', '2018-07-03', '2018-07-28', '273010254_download.jpg', 18, 10),
(19, 'Asthoaks', 'Asthoaks for any Asthoaks', '50', '2018-07-26', '2018-07-04', '176300049_simg5a6ed5b675835.jpg', 17, 20);

-- --------------------------------------------------------

--
-- Table structure for table `private_message`
--

CREATE TABLE `private_message` (
  `M_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Images` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private_message`
--

INSERT INTO `private_message` (`M_ID`, `User_ID`, `Date`, `Images`, `Subject`, `Message`) VALUES
(1, 7, '2018-08-07 00:00:00', '', 'استعلام ', 'هل يوجد هذه الادويه ام لا ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `RegStatus` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `Email`, `FullName`, `GroupID`, `RegStatus`, `Date`, `Images`) VALUES
(1, 'Mohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'mohamedadel31038@gmail.com', 'Mohamed Adel Mohamed Salah', 1, 1, '2018-07-01', ''),
(7, 'Apo Hepa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Mohamed@yahoo.com', 'Mohamed Apo Hepa Mohamed', 0, 1, '2018-07-24', '440124512_18142728_657259821148816_957911057_n.jpg'),
(8, 'Ali Mohamed Ali', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Ebrahim@yahoo.com', 'Ali Mohamed Mohamed', 0, 1, '2018-07-25', ''),
(9, 'AliMohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'Ali@yahoo.com', '', 0, 0, '2018-07-28', ''),
(10, 'Geme', '601f1889667efaebb33b8c12572835da3f027f78', 'Gemi@yahoo.com', '', 0, 0, '2018-07-28', ''),
(11, 'Adel', '601f1889667efaebb33b8c12572835da3f027f78', 'Adel@yahoo.com', '', 0, 1, '2018-07-30', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `private_message`
--
ALTER TABLE `private_message`
  ADD PRIMARY KEY (`M_ID`),
  ADD KEY `Message` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `private_message`
--
ALTER TABLE `private_message`
  MODIFY `M_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `private_message`
--
ALTER TABLE `private_message`
  ADD CONSTRAINT `Message` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
