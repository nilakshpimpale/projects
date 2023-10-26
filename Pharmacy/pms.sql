-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 05:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `username`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(2, 'Admin', 'admin', 'adminlj', 'admin@admin.com', '1704307608', 'c84258e9c39059a89ab77d846ddab909', 'admin', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `bill_master`
--

CREATE TABLE `bill_master` (
  `bill_id` int(50) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `med_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `med_quantity` int(20) NOT NULL,
  `bill_date` date NOT NULL,
  `payment_type` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_master`
--

INSERT INTO `bill_master` (`bill_id`, `customer_name`, `med_name`, `med_quantity`, `bill_date`, `payment_type`) VALUES
(2, 'yrr', 'fytd', 5, '2022-01-20', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'pharmacist',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `fname`, `lname`, `username`, `email`, `phone`, `address`, `password`, `role`, `avatar`) VALUES
(7, 'Pharmacist', 'Two', '', 'pharmacist@two.com', '01700000000', '', '$2y$10$5pi1bPBuaQt4s83hGFcTH.eRZvFqsMDDN.onp6.HJENwo0jqJqKjq', 'pharmacist', 'avatar.png'),
(8, 'Pharmacist', 'Three', '', 'pharmacist@three.com', '0170000000', '', '$2y$10$RqNzWY0cxl9UCf01J.N9LOTTPb7GKarWAwM7/i8T8koNoFqQQk1Li', 'pharmacist', 'avatar.png'),
(9, 'Pharmacist', 'Four', '', 'pharmacist@four.com', '01700000000', '', '$2y$10$GVggPVg5obYkaX87nzDA/u7uyMA.ej4A96RNXtLXpFWeENLxed.T6', 'pharmacist', 'avatar.png'),
(11, 'chris', 'evans', 'pharma', 'chris@gmail.com', '9876543210', '', '25d55ad283aa400af464c76d713c07ad', 'pharmacist', 'avatar.png'),
(12, 'chris', 'ohoihi', 'hx20predator', 'john@sina.com', '6798567567', '', '$2y$10$dbOiCAE0NRpF8D6QyZtsqe6urUphvggEddHx0P9b6GOxpwHw3n96i', 'pharmacist', 'avatar.png'),
(14, 'qwert', 'ohoihi', 'pharm', 'john@par.com', '9234567890', '', '$2y$10$2JFaoOpMmrUB3u8/KAOgjORWdV8lwy19zXle/4OJJu76YUyxqBh.u', 'pharmacist', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `med_id` int(20) NOT NULL,
  `med_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `med_category` varchar(50) CHARACTER SET utf8 NOT NULL,
  `med_quantity` int(20) NOT NULL,
  `med_entry_date` date NOT NULL,
  `med_manufacture_date` date NOT NULL,
  `med_expiry_date` date NOT NULL,
  `med_description` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`med_id`, `med_name`, `med_category`, `med_quantity`, `med_entry_date`, `med_manufacture_date`, `med_expiry_date`, `med_description`) VALUES
(1, 'para', 'injection', 6, '2022-01-20', '2022-01-25', '2022-01-11', 'for fever');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_master`
--
ALTER TABLE `bill_master`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`med_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_master`
--
ALTER TABLE `bill_master`
  MODIFY `bill_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `med_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
