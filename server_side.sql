-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2016 at 10:55 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `server_side`
--

-- --------------------------------------------------------

--
-- Table structure for table `Basket`
--

CREATE TABLE `Basket` (
  `Id` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `QteProduct` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`Id`, `Name`) VALUES
(4, 'Figurine'),
(5, 'Mug'),
(6, 'Poster'),
(7, 'Movie'),
(8, 'Cosplay'),
(10, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `Id` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`Id`, `IdUser`, `IdProduct`, `OrderDate`) VALUES
(1, 1, 4, '2016-10-31 11:14:28'),
(2, 1, 4, '2016-10-31 13:36:41'),
(3, 1, 4, '2016-10-31 13:37:18'),
(4, 1, 1, '2016-10-31 13:37:48'),
(5, 1, 4, '2016-11-01 10:51:01'),
(6, 1, 2, '2016-11-01 10:51:52'),
(7, 1, 2, '2016-11-01 10:52:14'),
(8, 1, 1, '2016-11-01 12:23:13'),
(9, 1, 1, '2016-11-01 12:23:35'),
(10, 1, 2, '2016-11-01 12:24:16'),
(11, 1, 2, '2016-11-01 12:26:41'),
(12, 1, 2, '2016-11-01 12:28:20'),
(13, 1, 1, '2016-11-01 13:05:13'),
(14, 1, 1, '2016-11-01 13:51:10'),
(15, 1, 1, '2016-11-01 14:28:41'),
(16, 1, 2, '2016-11-01 14:28:41'),
(17, 1, 4, '2016-11-01 14:28:41'),
(18, 1, 1, '2016-11-01 14:28:41'),
(19, 1, 1, '2016-11-01 14:36:31'),
(20, 1, 4, '2016-11-01 14:37:09'),
(21, 1, 1, '2016-11-01 14:38:00'),
(22, 1, 1, '2016-11-01 14:38:00'),
(23, 1, 1, '2016-11-01 14:38:00'),
(24, 1, 5, '2016-11-01 14:38:00'),
(25, 1, 6, '2016-11-01 14:38:00'),
(26, 1, 1, '2016-11-02 12:05:40'),
(27, 1, 3, '2016-11-02 12:23:22'),
(28, 1, 1, '2016-11-02 12:26:16'),
(29, 1, 1, '2016-11-02 12:26:16'),
(30, 1, 2, '2016-11-02 12:26:16'),
(31, 1, 3, '2016-11-02 12:26:16'),
(32, 1, 4, '2016-11-02 12:26:16'),
(33, 1, 5, '2016-11-02 12:26:16'),
(34, 1, 6, '2016-11-02 12:26:16'),
(35, 1, 3, '2016-11-02 12:29:23'),
(36, 1, 6, '2016-11-02 14:06:09'),
(37, 1, 6, '2016-11-02 14:07:21'),
(38, 1, 6, '2016-11-02 14:07:54'),
(39, 1, 2, '2016-11-02 14:07:54'),
(40, 1, 3, '2016-11-02 14:07:54'),
(41, 1, 5, '2016-11-02 14:07:54'),
(42, 1, 7, '2016-11-15 19:12:02'),
(43, 1, 7, '2016-11-15 19:54:11'),
(44, 1, 8, '2016-11-15 19:54:11'),
(45, 1, 7, '2016-11-15 19:54:11'),
(46, 1, 11, '2016-11-15 19:54:11'),
(47, 1, 11, '2016-11-20 11:54:36'),
(48, 1, 7, '2016-11-22 15:13:36'),
(49, 1, 9, '2016-11-22 15:13:36'),
(50, 1, 9, '2016-11-22 15:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Picture` varchar(1000) NOT NULL,
  `IsStar` tinyint(1) NOT NULL DEFAULT '0',
  `IdCategory` int(11) NOT NULL,
  `Description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `Name`, `Price`, `Picture`, `IsStar`, `IdCategory`, `Description`) VALUES
(7, 'The Avengers: Hulk', 45, 'http://orig11.deviantart.net/1058/f/2013/127/f/3/the_avengers__hulk___theatrical_poster_by_squiddytron-d64iblm.png', 1, 6, 'Poster 1M50 X 3M'),
(8, 'Wanted Hulk Poster', 42, 'http://pre08.deviantart.net/7ab7/th/pre/i/2012/249/2/2/wanted_hulk_poster_by_shazly250-d5dsr99.jpg', 1, 6, 'Wanted Hulk 2012 3d Designed By Shazly Alejandro, 816 × 978'),
(9, 'incredible-hulk', 16, 'http://ep.yimg.com/ay/stylinonline/incredible-hulk-face-mug-7.jpg', 1, 5, 'Incredible Hulk Face Mug.'),
(10, 'Marvel Hulk', 7, 'https://s-media-cache-ak0.pinimg.com/236x/e9/5c/ff/e95cff805ce14889b6af510d44973457.jpg', 1, 5, 'Marvel Comics: Incredible Hulk Reflections Oversized Coffee Mug. Holds 18 fluid ounces Features: The Incredible Hulk! Oversized Coffee Cup Officially Licensed'),
(11, 'HULK CLASSIC', 3.99, 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS5IiDU3sTADIZ46WFy-Gwo5huxCjFWEgKfOli67EXJHmj0768Y', 1, 4, 'HULK CLASSIC AVENGERS FINE ART STATUE 524 777'),
(12, 'The Incredible Hulk', 7.86, 'https://shop.eaglemoss.com/images/shop_products/b1f634cb-e494-40dc-a9f7-a0005ce4716c.jpg', 1, 4, 'Marvel The Incredible Hulk Large Figurine.'),
(13, 'Mind Blowing Custom Hulk', 130, 'https://mydisguises.com/wp-content/uploads/2012/12/img5082f.jpg', 1, 8, ''),
(17, 'Hulk', 12, 'https://upload.wikimedia.org/wikipedia/en/5/59/Hulk_movie.jpg', 1, 7, 'Hulk is a 2003 American superhero film based on the fictional Marvel Comics character of the same name. Ang Lee directed the film, which stars Eric Bana as Dr. Bruce Banner, as well as Jennifer Connelly, Sam Elliott, Josh Lucas, and Nick Nolte. The film explores the origins of Bruce Banner, who after a lab accident involving gamma radiation finds himself able to turn into a huge green-skinned monster whenever he gets angry, while he is pursued by the United States military and comes into a conflict with his father.');

-- --------------------------------------------------------

--
-- Table structure for table `Rank`
--

CREATE TABLE `Rank` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rank`
--

INSERT INTO `Rank` (`Id`, `Name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Img` varchar(2000) NOT NULL,
  `Address` varchar(1500) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `RankId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `Name`, `Password`, `Img`, `Address`, `LastName`, `Email`, `RankId`) VALUES
(1, 'Kevin', '*42434304F38173D0FC396F60C077C662FE6EE7DD', 'https://scontent-lhr3-1.xx.fbcdn.net/v/t1.0-9/14568143_1202242519839320_6595824760446766948_n.jpg?oh=655f136df4dd48dee981e03a93fadcea&oe=589DCE1C', '8 Impasse de la Tuilerie', 'Connan', 'cyril.connan@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Basket`
--
ALTER TABLE `Basket`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Products_IdCategory` (`IdCategory`);

--
-- Indexes for table `Rank`
--
ALTER TABLE `Rank`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Basket`
--
ALTER TABLE `Basket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `Rank`
--
ALTER TABLE `Rank`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
