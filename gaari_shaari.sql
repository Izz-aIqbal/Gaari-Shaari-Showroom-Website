-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 05:52 PM
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
-- Database: `gaari_shaari`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmw_products`
--

CREATE TABLE `bmw_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `product_images` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmw_products`
--

INSERT INTO `bmw_products` (`product_id`, `product_name`, `price`, `discount`, `product_images`, `description`) VALUES
(17, 'z4', 99999999.99, NULL, NULL, 'jhjhjhhjn'),
(18, 'X90', 99999999.99, NULL, NULL, 'cccccc');

-- --------------------------------------------------------

--
-- Table structure for table `mercedes_products`
--

CREATE TABLE `mercedes_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `product_images` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mercedes_products`
--

INSERT INTO `mercedes_products` (`product_id`, `product_name`, `price`, `discount`, `product_images`, `description`) VALUES
(12, 'E-class', 99999999.99, 0.00, NULL, 'kkkjkjkjk'),
(13, 'maybach', 99999999.99, NULL, NULL, 'aaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `address`, `email`, `phone_number`, `product_name`, `total_amount`, `order_date`, `product_id`, `user_id`, `brand`) VALUES
(6, 'Shujahat Jadoon', 'isb', 'shujahatjadoon0@gmail.com', '09099090', 'M5 Competition', 154000.00, '2024-08-06 04:08:23', NULL, 1936, 'bmw'),
(7, 'admin', 'rwp', 'abc@gmail.com', '1112222333', 'E-class', 5000.00, '2024-08-06 04:09:54', NULL, 2147483647, 'mercedes'),
(8, 'Shujahat Jadoon', 'isb', 'shujahatjadoon0@gmail.com', '03000056222', 'M5 Competition', 154000.00, '2024-08-06 04:14:49', NULL, 1936, 'bmw'),
(9, 'admin', 'sss', 'abc@gmail.com', '99999', 'E-class', 5000.00, '2024-08-06 04:16:53', NULL, 2147483647, 'mercedes'),
(10, 'uzair', 'atd', 'xyz@gmail.com', '43211234', 'M5 Competition', 154000.00, '2024-08-06 04:18:56', NULL, 2147483647, 'bmw'),
(11, 'shuj', 'pk', 'shujahatali941@gmail.com', '989898989', 'M5 Competition', 154000.00, '2024-08-06 04:27:36', NULL, 25580, 'bmw'),
(12, 'mood', 'atd', 'at@gmail.com', '99999', 'M5 Competition', 154000.00, '2024-08-06 04:29:21', NULL, 668351223, 'bmw'),
(13, 'mood', 'atd', 'at@gmail.com', '99999', 'M7', 105500.00, '2024-08-06 04:35:28', NULL, 668351223, 'bmw'),
(14, 'shuj', 'ib', 'shujahatjadoon0@gmail.com', '999', 'AMG GT', 99999999.99, '2024-08-06 05:01:37', NULL, 1936, 'mercedes'),
(15, 'mood', 'ib', 'abc@gmail.com', '888', 'M5 Competition', 154000.00, '2024-08-06 05:02:45', NULL, 668351223, 'bmw'),
(16, 'areej', 'isb', 'asd@gmail.com', '444', 'M7', 105500.00, '2024-08-06 05:04:35', NULL, 667267, 'bmw'),
(17, 'areej', 'isb', 'asd@gmail.com', '444', 'M8 ', 90000.00, '2024-08-06 05:08:44', NULL, 667267, 'bmw'),
(18, 'Shujahat Jadoon', 'Bagra', 'shujahatjadoon0@gmail.com', '99999', 'M9', 55000.00, '2024-08-07 04:31:59', NULL, 1936, 'bmw'),
(19, 'Shujahat Jadoon', 'Bagra', 'shujahatali941@gmail.com', '99999', 'M9', 55000.00, '2024-08-07 04:36:36', NULL, 1936, 'bmw'),
(20, 'Shujahat Jadoon', 'Bagra', 'shujahatali941@gmail.com', '99999', 'M9', 55000.00, '2024-08-07 04:36:44', NULL, 1936, 'bmw'),
(21, 'Shujahat Jadoon', 'Bagra', 'shujahatjadoon0@gmail.com', '99999', 'M5', 29000.00, '2024-08-09 13:12:21', NULL, 1936, 'bmw'),
(22, 'Shujahat Jadoon', 'Bagra', 'shujahatali941@gmail.com', '99999', 'z4', 1111111.00, '2024-08-11 15:01:26', NULL, 1936, 'bmw'),
(23, 'Shujahat Jadoon', 'Bagra', 'shujahatjadoon0@gmail.com', '000000000', 'E-class', 99999999.99, '2024-08-17 20:04:35', NULL, 1936, 'mercedes'),
(24, 'hayan', 'abt', 'abc@gmail.com', '9999', 'z4', 99999999.99, '2024-08-17 20:06:56', NULL, 54644922, 'bmw'),
(25, 'Shujahat Jadoon', 'Bagra', 'shujahatali941@gmail.com', '666', 'E-class', 99999999.99, '2024-10-19 12:40:52', NULL, 64952428, 'mercedes');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `brand`) VALUES
(1, 11, 'uploads/1(1) (1).jpeg', 'Mercedes'),
(2, 11, 'uploads/1(5).jpeg', 'Mercedes'),
(3, 11, 'uploads/1(6).jpeg', 'Mercedes'),
(4, 11, 'uploads/1(7).jpeg', 'Mercedes'),
(5, 11, 'uploads/1(8).jpeg', 'Mercedes'),
(6, 11, 'uploads/1(9) (1).jpeg', 'Mercedes'),
(7, 16, 'uploads/bmw(1-25).jpg', 'BMW'),
(8, 16, 'uploads/bmw(1-26).jpg', 'BMW'),
(9, 16, 'uploads/bmw(1-27).jpg', 'BMW'),
(10, 16, 'uploads/bmw(1-28).jpg', 'BMW'),
(11, 16, 'uploads/bmw(1-29).jpg', 'BMW'),
(12, 12, 'uploads/merc(7-0-0).jpeg', 'Mercedes'),
(13, 12, 'uploads/merc(7-1).jpg', 'Mercedes'),
(14, 12, 'uploads/merc(7-2).jpg', 'Mercedes'),
(15, 12, 'uploads/merc(7-3).jpg', 'Mercedes'),
(16, 12, 'uploads/merc(7-4).jpg', 'Mercedes'),
(17, 12, 'uploads/merc(7-5).jpg', 'Mercedes'),
(18, 17, 'uploads/bmw(1-1).jpg', 'BMW'),
(19, 17, 'uploads/bmw(1-26).jpg', 'BMW'),
(20, 17, 'uploads/bmw(1-27).jpg', 'BMW'),
(21, 17, 'uploads/bmw(1-28).jpg', 'BMW'),
(22, 17, 'uploads/bmw(1-29).jpg', 'BMW'),
(23, 17, 'uploads/bmw(1-30).jpg', 'BMW'),
(24, 13, 'uploads/merc(1-1).jpg', 'Mercedes'),
(25, 13, 'uploads/merc(2-1).jpg', 'Mercedes'),
(26, 13, 'uploads/merc(2-2).jpg', 'Mercedes'),
(27, 13, 'uploads/merc(2-3).jpg', 'Mercedes'),
(28, 13, 'uploads/merc(2-4).jpeg', 'Mercedes'),
(29, 18, 'uploads/bmw(1-22).jpg', 'BMW'),
(30, 18, 'uploads/bmw(1-23).jpg', 'BMW'),
(31, 18, 'uploads/bmw(1-24).jpg', 'BMW'),
(32, 18, 'uploads/bmw(1-25).jpg', 'BMW');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1936, 'shujahat', 'admin', 'shujahatjadoon0@gmail.com'),
(25580, 'shuj', '0000', 'shujahatali941@gmail.com'),
(667267, 'areej', 'admin', 'asd@gmail.com'),
(54644922, 'hayan', 'admin', 'abc@gmail.com'),
(668351223, 'mood', 'admin', 'at@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmw_products`
--
ALTER TABLE `bmw_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `mercedes_products`
--
ALTER TABLE `mercedes_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmw_products`
--
ALTER TABLE `bmw_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mercedes_products`
--
ALTER TABLE `mercedes_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
