-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 04:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `inside_sell_price`
--

CREATE TABLE `inside_sell_price` (
  `inventory_id` varchar(50) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `harga_colly` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_dozen` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_piece` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` varchar(50) NOT NULL,
  `vendor_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `colly` int(10) NOT NULL,
  `dozen` int(10) NOT NULL,
  `piece` int(10) NOT NULL,
  `buy_price` float NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `vendor_id`, `name`, `colly`, `dozen`, `piece`, `buy_price`, `picture`, `created_at`, `updated_at`) VALUES
('B000001', 'V000001', 'Indomie', 0, 3000, 24, 1500, 'tes1.jpg', '2025-11-13 18:27:16', '2025-11-13 18:54:53'),
('B000002', 'V000002', 'Coca Cola', 0, 5000, 24, 3000, 'tes2.jpg', '2025-11-13 18:27:16', '2025-11-13 18:55:01'),
('B000003', 'V000002', 'Sprite', 0, 7000, 24, 5000, 'tes3.jpg', '2025-11-13 18:28:54', '2025-11-13 18:55:36'),
('B000004', 'V000001', 'Chitato', 0, 10000, 20, 7000, 'tes4.jpg', '2025-11-13 18:28:54', '2025-11-13 18:55:28'),
('B000005', 'V000003', 'Pepsodent', 0, 12000, 20, 9000, 'tes5.jpg', '2025-11-13 18:29:51', '2025-11-13 18:55:21'),
('B000006', 'V000003', 'Bango', 0, 10000, 20, 7000, 'tes6.jpg', '2025-11-13 18:29:51', '2025-11-13 18:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `outside_sell_price`
--

CREATE TABLE `outside_sell_price` (
  `inventory_id` varchar(50) NOT NULL,
  `harga_colly` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_dozen` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_piece` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`stock_in_id`, `date`, `vendor_id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
('BM000001', '2025-11-14 08:00:00', 'V000001', 282000.00, 'admin', '2025-11-14 08:44:48', '2025-11-14 08:50:16'),
('BM000002', '2025-11-14 09:00:00', 'V000002', 384000.00, 'admin', '2025-11-14 08:44:48', '2025-11-14 08:53:00'),
('BM000003', '2025-11-14 10:00:00', 'V000003', 480000.00, 'admin', '2025-11-14 08:45:25', '2025-11-14 08:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_detail`
--

CREATE TABLE `stock_in_detail` (
  `stock_in_detail_id` varchar(50) NOT NULL,
  `stock_in_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` enum('colly','dozen','piece') NOT NULL,
  `buy_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `buy_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_in_detail`
--

INSERT INTO `stock_in_detail` (`stock_in_detail_id`, `stock_in_id`, `inventory_id`, `quantity`, `unit`, `buy_price`) VALUES
('BMD000001', 'BM000001', 'B000001', 48, 'colly', 1500.00),
('BMD000001', 'BM000001', 'B000004', 30, 'colly', 7000.00),
('BMD000002', 'BM000002', 'B000002', 48, 'colly', 3000.00),
('BMD000002', 'BM000002', 'B000003', 48, 'colly', 5000.00),
('BMD000003', 'BM000003', 'B000005', 30, 'colly', 9000.00),
('BMD000003', 'BM000003', 'B000006', 30, 'colly', 7000.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_out_general`
--

INSERT INTO `stock_out_general` (`out_general_id`, `date`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
('KG000001', '2025-11-14 11:00:00', 86000.00, 'user1', '2025-11-14 09:13:30', '2025-11-14 09:16:04'),
('KG000002', '2025-11-14 12:00:00', 144000.00, 'user1', '2025-11-14 09:13:30', '2025-11-14 09:16:12'),
('KG000003', '2025-11-14 13:00:00', 110000.00, 'user1', '2025-11-14 09:15:32', '2025-11-14 09:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_general_detail`
--

CREATE TABLE `stock_out_general_detail` (
  `out_general_detail_id` varchar(50) NOT NULL,
  `out_general_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` enum('colly','dozen','piece') NOT NULL,
  `sale_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `sale_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_out_general_detail`
--

INSERT INTO `stock_out_general_detail` (`out_general_detail_id`, `out_general_id`, `inventory_id`, `quantity`, `unit`, `sale_price`) VALUES
('KGD000001', 'KG000001', 'B000001', 12, 'colly', 3000.00),
('KGD000001', 'KG000001', 'B000004', 5, 'colly', 10000.00),
('KGD000002', 'KG000002', 'B000002', 12, 'colly', 5000.00),
('KGD000002', 'KG000002', 'B000003', 12, 'colly', 7000.00),
('KGD000003', 'KG000003', 'B000005', 5, 'colly', 12000.00),
('KGD000003', 'KG000003', 'B000006', 5, 'colly', 10000.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_out_vendor`
--

INSERT INTO `stock_out_vendor` (`out_vendor_id`, `vendor_id`, `date`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
('KV000001', 'V000001', '2025-11-14 14:00:00', 86000.00, 'user1', '2025-11-14 09:22:56', '2025-11-14 09:22:56'),
('KV000002', 'V000002', '2025-11-14 15:00:00', 144000.00, 'user1', '2025-11-14 09:22:56', '2025-11-14 09:22:56'),
('KV000003', 'V000003', '2025-11-14 16:00:00', 110000.00, 'user1', '2025-11-14 09:23:17', '2025-11-14 09:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_vendor_detail`
--

CREATE TABLE `stock_out_vendor_detail` (
  `out_vendor_detail_id` varchar(50) NOT NULL,
  `out_vendor_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` enum('colly','dozen','piece') NOT NULL,
  `sale_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(15,2) GENERATED ALWAYS AS (`quantity` * `sale_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_out_vendor_detail`
--

INSERT INTO `stock_out_vendor_detail` (`out_vendor_detail_id`, `out_vendor_id`, `inventory_id`, `quantity`, `unit`, `sale_price`) VALUES
('KVD000001', 'KV000001', 'B000001', 12, 'colly', 3000.00),
('KVD000001', 'KV000001', 'B000004', 5, 'colly', 10000.00),
('KVD000002', 'KV000002', 'B000002', 12, 'colly', 5000.00),
('KVD000002', 'KV000002', 'B000003', 12, 'colly', 7000.00),
('KVD000003', 'KV000003', 'B000005', 5, 'colly', 12000.00),
('KVD000003', 'KV000003', 'B000006', 5, 'colly', 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nohp` int(15) NOT NULL,
  `location` enum('Dalam Kota','Luar Kota') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `password`, `type`, `created_at`, `updated_at`) VALUES
('admin', 'Andreas Rahmat', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Admin', '2025-11-14 01:33:26', '2025-11-14 01:33:26'),
('user1', 'User1', '*34D3B87A652E7F0D1D371C3DBF28E291705468C4', 'User', '2025-11-14 01:33:26', '2025-11-14 01:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nohp` int(15) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `name`, `nohp`, `created_at`, `updated_at`) VALUES
('V000001', 'Indofood', 0, '2025-11-14 08:36:05', '2025-11-14 08:36:05'),
('V000002', 'Coca Cola Company', 0, '2025-11-14 08:36:05', '2025-11-14 08:36:05'),
('V000003', 'Unilever', 0, '2025-11-14 08:37:37', '2025-11-14 08:42:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inside_sell_price`
--
ALTER TABLE `inside_sell_price`
  ADD PRIMARY KEY (`inventory_id`,`store_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `outside_sell_price`
--
ALTER TABLE `outside_sell_price`
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
  ADD PRIMARY KEY (`stock_in_detail_id`,`stock_in_id`,`inventory_id`),
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
  ADD PRIMARY KEY (`out_general_detail_id`,`out_general_id`,`inventory_id`),
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
  ADD PRIMARY KEY (`out_vendor_detail_id`,`out_vendor_id`,`inventory_id`),
  ADD KEY `out_vendor_id` (`out_vendor_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

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
-- Constraints for table `inside_sell_price`
--
ALTER TABLE `inside_sell_price`
  ADD CONSTRAINT `inside_sell_price_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  ADD CONSTRAINT `inside_sell_price_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`);

--
-- Constraints for table `outside_sell_price`
--
ALTER TABLE `outside_sell_price`
  ADD CONSTRAINT `outside_sell_price_ibfk_1` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`);

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

INSERT INTO store (store_id, name, nohp, location, created_at, updated_at) VALUES ('S000001', 'Perorangan', '08123456789', 'Dalam Kota', current_timestamp(), current_timestamp()), ('S000002', 'Lampung City Mall', '08123456788', 'Dalam Kota', current_timestamp(), current_timestamp());
INSERT INTO store (store_id, name, nohp, location, created_at, updated_at) VALUES ('S000003', 'Toserba', '08123456787', 'Luar Kota', current_timestamp(), current_timestamp());

INSERT INTO inside_sell_price (inventory_id, store_id, harga_colly, harga_dozen, harga_piece, created_at, updated_at) VALUES ('B000001', 'S000001', '1500', '2000', '3000', current_timestamp(), current_timestamp()), ('B000002', 'S000002', '5000', '6000', '7000', current_timestamp(), current_timestamp());

INSERT INTO outside_sell_price (inventory_id, harga_colly, harga_dozen, harga_piece, created_at, updated_at) VALUES ('B000001', '2500', '3000', '4000', current_timestamp(), current_timestamp()), ('B000002', '6000', '7000', '8000', current_timestamp(), current_timestamp());


CREATE TABLE stock_out_store (
  out_store_id varchar(50) NOT NULL PRIMARY KEY,
  store_id varchar(50) NOT NULL,
  date datetime NOT NULL,
  total decimal(15,2) NOT NULL DEFAULT 0.00,
  user_id varchar(50) NOT NULL,
  created_at datetime NOT NULL DEFAULT current_timestamp(),
  updated_at datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    FOREIGN key (store_id) REFERENCES store(store_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO stock_out_store (out_store_id, store_id, date, total, user_id, created_at, updated_at) VALUES
('KS000001', 'S000002', '2025-11-14 15:00:00', 144000.00, 'user1', '2025-11-14 09:22:56', '2025-11-14 09:22:56'),
('KS000002', 'S000003', '2025-11-14 16:00:00', 110000.00, 'user1', '2025-11-14 09:23:17', '2025-11-14 09:23:17');

CREATE TABLE stock_out_store_detail (
  out_store_detail_id varchar(50) NOT NULL PRIMARY KEY,
  out_store_id varchar(50) NOT NULL,
  inventory_id varchar(50) NOT NULL,
  quantity int(11) NOT NULL DEFAULT 0,
  unit enum('colly','dozen','piece') NOT NULL,
  sale_price decimal(15,2) NOT NULL DEFAULT 0.00,
  subtotal decimal(15,2) GENERATED ALWAYS AS (quantity * sale_price) STORED,
    
    FOREIGN KEY (out_store_id) REFERENCES stock_out_store(out_store_id),
    FOREIGN KEY (inventory_id) REFERENCES inventory(inventory_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

alter table stock_out_store_detail
drop PRIMARY key

alter table stock_out_store_detail
add PRIMARY key (out_store_detail_id,out_store_id,inventory_id)

INSERT INTO stock_out_store_detail (out_store_detail_id, out_store_id, inventory_id, quantity, unit, sale_price) VALUES
('KSD000001', 'KS000001', 'B000002', 12, 'colly', 5000.00),
('KSD000001', 'KS000001', 'B000003', 12, 'colly', 7000.00),
('KSD000002', 'KS000002', 'B000005', 5, 'colly', 12000.00),
('KSD000002', 'KS000002', 'B000006', 5, 'colly', 10000.00);