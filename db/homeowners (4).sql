-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2017 at 08:36 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homeowners`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `homeowner_id` int(11) NOT NULL,
  `penalty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeowner`
--

CREATE TABLE IF NOT EXISTS `homeowner` (
  `homeowner_id` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owned`
--

CREATE TABLE IF NOT EXISTS `owned` (
  `own_id` int(100) NOT NULL,
  `homeowners_id` varchar(100) NOT NULL,
  `property_id` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `terms` int(11) NOT NULL,
  `monthly_installment` decimal(10,2) NOT NULL,
  `totalpaid` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `datepayment` date NOT NULL,
  `months` int(11) NOT NULL,
  `currentnextdue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `property_id` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `property_name` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `price`, `downpayment`, `property_name`, `status`) VALUES
('PROPERTY-4LFCC0X0I', '90000', '2000.00', 'CAHEL', 'available'),
('PROPERTY-5NJQC10OT', '90000', '2000.00', 'AZUL', 'available'),
('PROPERTY-5QRB03EFE', '90000', '2000.00', 'GALLIO', 'available'),
('PROPERTY-JDG56VTIM', '90000', '2000.00', 'ROXXO', 'available'),
('PROPERTY-VDE1PP2EQ', '90000', '2000.00', 'VIERRDY', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate`) VALUES
('0.12');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(100) NOT NULL,
  `homeowner_id` varchar(30) NOT NULL,
  `property_id` varchar(30) NOT NULL,
  `datepayment` date NOT NULL,
  `total_paid` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `middlename` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `datereg` date NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `middlename`, `contact`, `datereg`, `user_type`, `username`, `password`) VALUES
('USER-0DAWD', 'fejie', 'fariolen', 'sorno', '0912312', '2015-07-09', 'admin', 'admin', 'admin'),
('USERS-HSBPYJLAX', 'shalou', 'ragasi', 'misa', '0932123', '0000-00-00', 'treasurer', 'andie', 'roswell');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `homeowner`
--
ALTER TABLE `homeowner`
  ADD PRIMARY KEY (`homeowner_id`);

--
-- Indexes for table `owned`
--
ALTER TABLE `owned`
  ADD PRIMARY KEY (`own_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `owned`
--
ALTER TABLE `owned`
  MODIFY `own_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
