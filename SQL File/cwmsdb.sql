-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 05:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2020-12-10 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblcarwashbooking`
--

CREATE TABLE `tblcarwashbooking` (
  `id` int(11) NOT NULL,
  `bookingId` bigint(10) DEFAULT NULL,
  `packageType` varchar(120) DEFAULT NULL,
  `carWashPoint` int(11) DEFAULT NULL,
  `fullName` varchar(150) DEFAULT NULL,
  `mobileNumber` bigint(12) DEFAULT NULL,
  `washDate` date DEFAULT NULL,
  `washTime` time DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `status` varchar(120) DEFAULT NULL,
  `adminRemark` mediumtext DEFAULT NULL,
  `paymentMode` varchar(120) DEFAULT NULL,
  `txnNumber` varchar(120) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcarwashbooking`
--

INSERT INTO `tblcarwashbooking` (`id`, `bookingId`, `packageType`, `carWashPoint`, `fullName`, `mobileNumber`, `washDate`, `washTime`, `message`, `status`, `adminRemark`, `paymentMode`, `txnNumber`, `postingDate`, `lastUpdationDate`) VALUES
(8, 767952395, '1', 3, 'root', 781352115, '2023-04-08', '08:00:00', '', 'New', NULL, NULL, NULL, '2023-04-08 09:42:14', NULL),
(9, 665370784, '1', 3, 'root', 781352115, '2023-04-08', '08:00:00', '', 'New', NULL, NULL, NULL, '2023-04-08 09:42:58', NULL),
(11, 401452693, '1', 3, 'root', 781352115, '2023-04-08', '01:47:00', '', 'New', NULL, NULL, NULL, '2023-04-08 11:47:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `carwash` varchar(20) NOT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenquiry`
--

INSERT INTO `tblenquiry` (`id`, `FullName`, `EmailId`, `Subject`, `Description`, `carwash`, `PostingDate`, `Status`) VALUES
(4, 'Anuj kumar', 'anuj@gmail.com', 'General Enquiry', 'I want to know the price of car wash', '', '2021-12-13 18:27:53', 1),
(5, 'Amit', 'amit@gmail.com', 'Test', 'Test', '', '2021-12-14 19:14:22', 1),
(6, 'nuru', 'nuru@mail.com', 'repairing', 'helloe there', '', '2023-04-03 08:09:42', 1),
(7, 'man', 'admin@gmail.com', 'meating', 'hhh', '3', '2023-04-06 14:09:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext DEFAULT NULL,
  `openignHrs` varchar(255) DEFAULT NULL,
  `phoneNumber` bigint(20) DEFAULT NULL,
  `emailId` varchar(120) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`, `openignHrs`, `phoneNumber`, `emailId`) VALUES
(3, 'aboutus', '																																								<div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 15px;\">CAr Wash Management System is a brand which is literally going to change the way people think about car cleaning. It is a unique mechanized car cleaning concept where cars are getting pampered by the latest equipments including high pressure cleaning machines, spray injection and extraction machines, high powered vacuum cleaners, steam cleaners and so on.</span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-family: Georgia; font-size: 15px;\"><br></span></div><div style=\"text-align: justify;\"><br></div><div></div>\r\n										\r\n										\r\n										\r\n										', NULL, NULL, NULL),
(11, 'contact', '123 Street, Kigali, RWANDA', 'Mon - Fri, 8:00 AM - 9:00 PM', 250781352115, 'carwash@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblprice`
--

CREATE TABLE `tblprice` (
  `id` int(10) NOT NULL,
  `service` varchar(200) NOT NULL,
  `cost` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprice`
--

INSERT INTO `tblprice` (`id`, `service`, `cost`) VALUES
(1, 'BASIC CLEANING', '10000'),
(2, 'PREMIUM CLEANING', '15000'),
(3, 'COMPLEX CLEANING', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `carwash` varchar(50) NOT NULL,
  `is_active` int(6) NOT NULL DEFAULT 1,
  `created_on` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `names`, `username`, `password`, `email`, `carwash`, `is_active`, `created_on`) VALUES
(3, 'man martin', 'new class', '202cb962ac59075b964b07152d234b70', 'new@gmail.com', '3', 1, '2023-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `tblwashingpoints`
--

CREATE TABLE `tblwashingpoints` (
  `id` int(11) NOT NULL,
  `washingPointName` varchar(255) DEFAULT NULL,
  `washingPointAddress` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(20) DEFAULT NULL,
  `capacity` int(5) NOT NULL,
  `is_active` int(6) NOT NULL DEFAULT 1,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwashingpoints`
--

INSERT INTO `tblwashingpoints` (`id`, `washingPointName`, `washingPointAddress`, `contactNumber`, `capacity`, `is_active`, `creationDate`) VALUES
(1, 'Hoffman\'s Car Wash Kigali', 'Hoffman\'s Car Wash Kigali, 24V4+23J, Kigali', '0732 323 301', 5, 1, '2023-04-03 16:21:20'),
(3, 'New Class Car Wash', 'New Class Car Wash, ST 117, 34 KG 18 Ave, Gisimenti', '0788 506 368', 2, 1, '2023-04-03 16:24:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcarwashbooking`
--
ALTER TABLE `tblcarwashbooking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carWashPoint` (`carWashPoint`);

--
-- Indexes for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprice`
--
ALTER TABLE `tblprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblwashingpoints`
--
ALTER TABLE `tblwashingpoints`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcarwashbooking`
--
ALTER TABLE `tblcarwashbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblprice`
--
ALTER TABLE `tblprice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblwashingpoints`
--
ALTER TABLE `tblwashingpoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
