-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 07:54 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wagas`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(3, 'cans'),
(4, 'Drinks'),
(5, 'Diapers'),
(6, 'School Supplies'),
(7, 'Shampoo'),
(8, 'Plates'),
(9, 'Noodles');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `date_reg` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `date_reg`, `address`, `contact_no`, `email`) VALUES
(1, 'awdawd', 'awdawd', '2016-01-05', '123123', '910293123', 'fejifji123'),
(2, 'fejie', 'fariolen', '0000-00-00', 'casia', '09322324465', 'fejie@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `wholesale_price` decimal(15,2) NOT NULL,
  `retail_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_name`, `product_name`, `wholesale_price`, `retail_price`, `quantity`, `unit`) VALUES
(5, 'Drinks', 'Coca Cola (8 oz)', '10.01', '12.00', 0, ''),
(6, 'Drinks', 'Nature Spring', '5.00', '10.00', 90, ''),
(7, 'Drinks', 'Nestea (Apple)', '8.00', '10.00', 0, ''),
(8, 'Drinks', 'Sprite (8 oz)', '10.00', '12.00', 0, ''),
(9, 'School Supplies', 'Pencil (Mongol)', '3.00', '5.00', 0, ''),
(10, 'Noodles', 'QUICK CHOW', '6.00', '7.99', 10, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `stock_id` varchar(20) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `unit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `transaction_id`, `quantity`, `stock_id`, `price`, `total`, `customer_id`, `product_name`, `unit`) VALUES
(2, 'EJTKCYL3Y', 2, '5', 12.00, 24.00, '', 'Coca Cola (8 oz)', ''),
(5, 'AGEIJQ6CJ', 10, '6', 5.00, 50.00, '', 'Nature Spring', ''),
(6, 'AGEIJQ6CJ', 2, '10', 7.99, 15.98, '', 'QUICK CHOW', 'pcs'),
(7, 'AGEIJQ6CJ', 2, '5', 12.00, 24.00, '', 'Coca Cola (8 oz)', ''),
(8, 'K4JNBCE2W', 5, '6', 5.00, 25.00, '', 'Nature Spring', '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocks_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `stocks_name` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `retail_price` double(10,2) NOT NULL,
  `wholesale_price` double(10,2) NOT NULL,
  `date_added` date NOT NULL,
  `date_expiry` date NOT NULL,
  `status` enum('out','in') NOT NULL,
  `suppliers_id` varchar(30) NOT NULL,
  `unit` enum('pcs','set') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocks_id`, `category_name`, `stocks_name`, `quantity`, `retail_price`, `wholesale_price`, `date_added`, `date_expiry`, `status`, `suppliers_id`, `unit`) VALUES
(1, 'Drinks', 'Coca Cola (8 oz)', 1, 12.00, 10.01, '2016-04-21', '2016-04-30', 'out', '11', ''),
(2, 'School Supplies', 'Pencil (Mongol)', 12, 5.00, 3.00, '2016-04-21', '2016-04-30', 'in', '12', ''),
(3, 'Drinks', 'Nature Spring', 100, 10.00, 5.00, '2016-04-21', '2016-05-31', 'out', '13', ''),
(4, 'Noodles', 'QUICK CHOW', 12, 7.99, 6.00, '2016-04-21', '2016-04-30', 'out', '13', ''),
(5, 'Drinks', 'Sprite (8 oz)', 12, 12.00, 10.00, '2016-03-28', '2016-03-31', 'in', '13', '');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_id` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_id`, `name`, `address`, `contact`) VALUES
(10, 'SP-FFMKAKJFN', '1234', 'awdawd123', 123123),
(11, 'SP-0GWYXQ240', '123', '123', 12312),
(12, 'SP-GBUDFEQW1', 'asdasd', 'asda', 0),
(13, 'SP-VHNTS3UX5', 'Goof', 'gooawf', 9123);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `total_paid` decimal(15,2) NOT NULL,
  `amount_tender` float(15,2) NOT NULL,
  `change1` float(15,2) NOT NULL,
  `users` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date_transaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `customer_id`, `total_paid`, `amount_tender`, `change1`, `users`, `status`, `date_transaction`) VALUES
(9, 'LLWEEKD20', '2', '66.00', 200.00, 134.00, 'admin admin', '', '0000-00-00'),
(10, 'EJTKCYL3Y', 'Walk In', '7.99', 1000.00, 992.01, 'admin admin', '', '2016-10-01'),
(11, 'EJTKCYL3Y', 'Walk In', '7.99', 120.00, 112.01, 'admin admin', '', '2016-03-24'),
(12, 'EJTKCYL3Y', 'Walk In', '24.00', 24.00, 0.00, 'admin admin', '', '2016-03-24'),
(13, 'AGEIJQ6CJ', 'Walk In', '22.00', 100.00, 78.00, 'admin admin', '', '2016-03-24'),
(14, 'AGEIJQ6CJ', 'Walk In', '10.00', 10.00, 0.00, 'admin admin', '', '2016-03-24'),
(15, 'AGEIJQ6CJ', 'Walk In', '65.98', 70.00, 4.02, 'admin admin', '', '2016-03-24'),
(16, 'AGEIJQ6CJ', 'Walk In', '65.98', 200.00, 134.02, 'admin admin', '', '2016-03-24'),
(17, 'AGEIJQ6CJ', 'Walk In', '65.98', 200.00, 134.02, 'admin admin', '', '2016-03-24'),
(18, 'AGEIJQ6CJ', 'Walk In', '89.98', 800.00, 710.02, 'admin admin', '', '2016-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `address`, `email`, `contact`, `status`, `type`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '', '', '', 'active', 'default'),
(2, 'genufuk', 'master123', 'fejie', 'fariolen', 'casia', '', '', 'disable', ''),
(3, 'fejie123', 'fejie123', 'fejie', 'fariolen', 'fejiei', '', 'fwaij123', 'active', 'admin'),
(4, 'cherry', 'cherry', 'cherry', 'cherry', 'cherry', 'cherry@gmail.com', 'cherry', 'active', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocks_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
