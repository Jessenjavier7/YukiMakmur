-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 07:59 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `buy_price` float NOT NULL,
  `sell_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `picture` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `vendor_id` varchar(50) NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `user_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_detail`
--

CREATE TABLE `stock_in_detail` (
  `stock_in_detail_id` varchar(50) NOT NULL,
  `stock_in_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `buy_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `buy_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_general`
--

CREATE TABLE `stock_out_general` (
  `out_general_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `user_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_general_detail`
--

CREATE TABLE `stock_out_general_detail` (
  `out_general_detail_id` varchar(50) NOT NULL,
  `out_general_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `sale_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `sale_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_vendor`
--

CREATE TABLE `stock_out_vendor` (
  `out_vendor_id` varchar(50) NOT NULL,
  `vendor_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `user_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_vendor_detail`
--

CREATE TABLE `stock_out_vendor_detail` (
  `out_vendor_detail_id` varchar(50) NOT NULL,
  `out_vendor_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `sale_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `sale_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('Admin','User') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock_in_detail`
--
ALTER TABLE `stock_in_detail`
  ADD PRIMARY KEY (`stock_in_detail_id`),
  ADD KEY `stock_in_id` (`stock_in_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `stock_out_general`
--
ALTER TABLE `stock_out_general`
  ADD PRIMARY KEY (`out_general_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock_out_general_detail`
--
ALTER TABLE `stock_out_general_detail`
  ADD PRIMARY KEY (`out_general_detail_id`),
  ADD KEY `out_general_id` (`out_general_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `stock_out_vendor`
--
ALTER TABLE `stock_out_vendor`
  ADD PRIMARY KEY (`out_vendor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stock_out_vendor_detail`
--
ALTER TABLE `stock_out_vendor_detail`
  ADD PRIMARY KEY (`out_vendor_detail_id`),
  ADD KEY `out_vendor_id` (`out_vendor_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `stock_in_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_in_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_in_detail`
--
ALTER TABLE `stock_in_detail`
  ADD CONSTRAINT `stock_in_detail_ibfk_1` FOREIGN KEY (`stock_in_id`) REFERENCES `stock_in` (`stock_in_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_in_detail_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_out_general`
--
ALTER TABLE `stock_out_general`
  ADD CONSTRAINT `stock_out_general_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_out_general_detail`
--
ALTER TABLE `stock_out_general_detail`
  ADD CONSTRAINT `stock_out_general_detail_ibfk_1` FOREIGN KEY (`out_general_id`) REFERENCES `stock_out_general` (`out_general_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_out_general_detail_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_out_vendor`
--
ALTER TABLE `stock_out_vendor`
  ADD CONSTRAINT `stock_out_vendor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_out_vendor_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_out_vendor_detail`
--
ALTER TABLE `stock_out_vendor_detail`
  ADD CONSTRAINT `stock_out_vendor_detail_ibfk_1` FOREIGN KEY (`out_vendor_id`) REFERENCES `stock_out_vendor` (`out_vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_out_vendor_detail_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
