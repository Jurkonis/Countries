-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 01:14 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `countries`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `radius` int(10) NOT NULL,
  `population` int(10) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `countryId` int(10) NOT NULL,
  `created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `radius`, `population`, `postalCode`, `countryId`, `created`) VALUES
(1, 'Jurmala', 123, 123, 123, 1, '2020-11-04'),
(4, 'Ryga', 33, 0, 0, 1, '2020-11-03'),
(26, 'gg', 123, 123, 123, 32, '2020-11-03'),
(28, 'gg', 123, 123, 123, 3, '2020-11-03'),
(29, 'gg', 0, 0, 0, 3, '2020-11-03'),
(30, 'asd', 0, 0, 0, 3, '2020-11-03'),
(31, 'bac', 0, 0, 0, 3, '2020-11-03'),
(32, '123', 0, 0, 0, 3, '2020-11-03'),
(33, 'abub', 0, 0, 0, 3, '2020-11-03'),
(34, 'gg', 123, 123, 123, 1, '2020-11-03'),
(35, 'gg', 123, 123, 123, 1, '2020-11-03'),
(36, 'gg', 123, 123, 123, 1, '2020-11-03'),
(37, 'gg', 123, 123, 123, 1, '2020-11-03'),
(38, 'gg', 123, 123, 123, 1, '2020-11-03'),
(39, 'ggs', 123, 123, 123, 1, '2020-11-03'),
(46, 'gg', 0, 0, 0, 1, '2020-11-03'),
(47, 'gg123', 0, 0, 0, 1, '2020-11-03'),
(48, 'gg1233', 0, 0, 0, 1, '2020-11-03'),
(49, 'gg12334', 0, 0, 0, 1, '2020-11-03'),
(50, 'gg55555', 0, 0, 0, 1, '2020-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `radius` int(10) NOT NULL,
  `population` int(10) NOT NULL,
  `phoneCode` int(10) NOT NULL,
  `created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `radius`, `population`, `phoneCode`, `created`) VALUES
(1, 'Latvia', 555, 444, 6969, '2020-11-03'),
(2, 'Estonia', 555, 444, 6969, '2020-11-03'),
(3, 'Lithuania', 555, 444, 6969, '2020-11-03'),
(4, 'Poland', 555, 444, 6969, '2020-11-03'),
(5, 'Russia', 343, 34, 123, '2020-11-03'),
(26, 'France', 23, 23, 122, '2020-11-03'),
(32, 'Germany', 123, 123, 123, '2020-11-22'),
(36, 'Slovakia', 123, 123, 123, '2020-11-03'),
(37, 'Denmark', 123, 123, 123, '2020-11-03'),
(38, 'Norway', 123, 123, 123, '2020-11-07'),
(42, 'Finland', 123, 123, 123, '2020-11-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryId` (`countryId`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
