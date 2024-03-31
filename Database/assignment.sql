-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 08:35 AM
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
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(21, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(22, 'Kim Hau', 'KH', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'Jie Qing', 'JQ', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'Vivian', 'VV', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `product_id`, `title`, `price`, `category_id`, `created_at`, `qty`, `total`) VALUES
(83, 3, 20, 'Casetify Travel Lover', 99.00, 19, '2024-03-31 08:18:16', 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(19, 'Phone Case', 'Product_Category_659.jpg', 'Yes', 'Yes'),
(20, 'Charging Cable', 'Product_Category_74.jpg', 'Yes', 'Yes'),
(21, 'Earbuds', 'Product_Category_757.jpg', 'Yes', 'Yes'),
(22, 'Chargers', 'Product_Category_325.png', 'Yes', 'Yes'),
(23, 'PowerBanks', 'Product_Category_872.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `message_date` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `first_name`, `last_name`, `phone_no`, `message_date`, `email`, `message`, `status`) VALUES
(16, 'Meteor', 'See', '+60193309187', '2024-03-10 08:36:38', 'meteorsee1108@gmail.com', 'test1', 'Pending Reply'),
(17, 'See', 'Lek', '193309187', '2024-03-10 08:39:11', 'meteorsee1108@1utar.my', 'test2', 'Received'),
(30, 'Keng Lek', 'See', '+60193309187', '2024-03-27 01:45:44', 'meteorsee1108@1utar.my', 'test2703\r\n', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `order_notes` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `invoice_number`, `product_id`, `product_title`, `product_price`, `product_qty`, `product_total`, `order_date`, `status`, `first_name`, `last_name`, `address`, `state`, `postal`, `email`, `phone_no`, `order_notes`, `user_id`) VALUES
(124, 'INV20240325145623', 19, 'Casetify Gravity 3.0', 100.00, 3, 300.00, '2024-03-25 02:56:23', 'Order Received', 'Keng Lek See', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(125, 'INV20240325145623', 20, 'Casetify Travel Lover', 99.00, 1, 99.00, '2024-03-25 02:56:23', 'Order Received', 'Keng Lek See', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(126, 'INV20240331140923', 18, 'Casetify Black Kingsnake', 60.00, 3, 180.00, '2024-03-31 02:09:23', 'Order Received', 'Keng Lek', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(127, 'INV20240331140923', 19, 'Casetify Gravity 3.0', 100.00, 1, 100.00, '2024-03-31 02:09:23', 'Order Received', 'Keng Lek', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(128, 'INV20240331140923', 20, 'Casetify Travel Lover', 99.00, 1, 99.00, '2024-03-31 02:09:23', 'Order Received', 'Keng Lek', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(129, 'INV20240331140923', 46, 'Blue Powerbank', 90.00, 1, 90.00, '2024-03-31 02:09:23', 'Order Received', 'Keng Lek', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(130, 'INV20240331141420', 18, 'Casetify Black Kingsnake', 60.00, 1, 60.00, '2024-03-31 02:14:20', 'Order Received', 'Keng Lek', 'See', '91, JLN PARIT HAJI BAKI,84000, MUAR, JOHOR', 'Johor', 84000, 'meteorsee1108@1utar.my', '+60193309187', '', 3),
(133, 'INV20240331143235', 20, 'Casetify Travel Lover', 99.00, 1, 99.00, '2024-03-31 02:32:35', 'Payment Cancel', 'Metoer', 'See', '1150, Jalan Seksyen 1/2, 31900, Kampar Perak', 'JOHOR', 84000, 'meteorsee1108@gmail.com', '+60193309187', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account_number` int(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `payment_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `user_id`, `invoice_number`, `bank_name`, `bank_account_number`, `image_name`, `payment_date`) VALUES
(24, 3, 'INV1710597493', 'Public Bank', 21321, 'INV1710597493.png', 2147483647),
(25, 3, 'INV1710597599', 'Public Bank', 456, '', 2147483647),
(26, 3, 'INV1710597658', 'Public Bank', 16514, 'INV1710597658.jpg', 2147483647),
(27, 3, 'INV1710597755', 'Public Bank', 16514, 'INV1710597755.png', 2147483647),
(28, 3, 'INV1710597904', 'Public Bank', 16514, 'INV1710597904.png', 2147483647),
(29, 3, 'INV1710597978', 'Public Bank', 16514, 'INV1710597978.png', 2147483647),
(30, 3, 'INV1710598249', 'Public Bank', 16514, 'INV1710598249.jpg', 2147483647),
(31, 3, 'INV1710599709', 'Public Bank', 16514, 'INV1710599709.jpg', 2147483647),
(32, 3, 'INV1711189608', 'Public Bank', 16514, 'INV1711189608.jpg', 2147483647),
(33, 3, 'INV1711189717', 'Public Bank', 16514, 'INV1711189717.jpg', 2147483647),
(34, 3, 'INV1711189784', 'Public Bank', 16514, 'INV1711189784.jpg', 2147483647),
(35, 3, 'INV20240325022847', 'Public Bank', 16514, 'INV20240325022847.jpg', 2147483647),
(36, 3, 'INV20240325122405', 'Public Bank', 16514, 'INV20240325122405.png', 2147483647),
(37, 3, 'INV20240331140923', 'Public Bank', 16514, 'INV20240331140923.jpg', 2147483647),
(38, 3, 'INV20240331141420', 'Public Bank', 16514, 'INV20240331141420.jpg', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(18, 'Casetify Black Kingsnake', 'Black on the back.', 60.00, 'Product-3288.jpg', 19, 'Yes', 'Yes'),
(19, 'Casetify Gravity 3.0', 'Designed with Space element. Magsafe Compatible.', 100.00, 'Product-9178.jpg', 19, 'Yes', 'Yes'),
(20, 'Casetify Travel Lover', 'Designed with Teen Element', 99.00, 'Product-7571.jpg', 19, 'Yes', 'Yes'),
(21, 'Casetify PP-0008', 'Designed with Parcel element. Magsafe Compatible.', 88.00, 'Product-4768.jpg', 19, 'Yes', 'Yes'),
(22, 'Casetify Dont Be Afraid', 'Designed with Big Words', 77.00, 'Product-1887.jpg', 19, 'Yes', 'Yes'),
(23, 'Casetify White', 'White Case.', 50.00, 'Product-9505.jpg', 19, 'Yes', 'Yes'),
(24, 'Casetify Black', 'Black.', 20.00, 'Product-2192.jpg', 19, 'Yes', 'Yes'),
(25, 'Earbuds', 'Nice.', 20.00, 'Product-27.jpeg', 21, 'Yes', 'Yes'),
(26, 'Jabra Earbuds', 'Good.', 50.00, 'Product-6780.jpg', 21, 'Yes', 'Yes'),
(27, 'Razer Earbuds', 'Designed with Razer Logo.', 50.00, 'Product-1852.jpg', 21, 'Yes', 'Yes'),
(28, 'Beats Earbuds', 'Great.', 45.00, 'Product-3110.jpg', 21, 'Yes', 'Yes'),
(29, 'Earbuds', 'Simple Design.', 56.00, 'Product-6467.jpg', 21, 'Yes', 'Yes'),
(30, 'Tronsmart Earbuds', 'Special Design.', 50.00, 'Product-4597.jpg', 21, 'Yes', 'Yes'),
(31, 'Lighting Charging Cable', 'For Apple iPhone. Lighting to Type C', 20.00, 'Product-862.jpg', 20, 'Yes', 'Yes'),
(32, 'Type C Cable', 'Type C to Type C', 20.00, 'Product-5831.jpg', 20, 'Yes', 'Yes'),
(33, 'Type C Cable', 'Type C to Type A', 20.00, 'Product-1619.jpg', 20, 'Yes', 'Yes'),
(34, 'Micro-USB Cable', 'Deprecated Product.', 10.00, 'Product-1349.png', 20, 'Yes', 'Yes'),
(35, 'Lighting Charging Cable', 'Lighting to Type-A.', 20.00, 'Product-3177.jpg', 20, 'Yes', 'Yes'),
(36, 'Type C Charger', 'Single Type C port', 20.00, 'Product-1315.png', 22, 'Yes', 'Yes'),
(37, 'Anker USB A Charger', 'Have two USB Type A ports.', 25.00, 'Product-7819.png', 22, 'Yes', 'Yes'),
(38, 'Powerlogy Charger', 'Have Multiple ports. Two Type C and two Type A.', 100.00, 'Product-4480.png', 22, 'Yes', 'Yes'),
(39, 'Normal USB Charger', 'Single Type A port.', 10.00, 'Product-2602.png', 22, 'Yes', 'Yes'),
(40, 'Anker iQ GAN Charger', '45W iQ single Type C port charger.', 45.00, 'Product-8878.png', 22, 'Yes', 'Yes'),
(41, 'Pavareal 20000mAh Powerbank', '20000mAh, one Type C and two Type A ports.', 60.00, 'Product-5749.png', 23, 'Yes', 'Yes'),
(42, 'JoyRoom 20000mAh Powerbank', 'Two Type C and two Type A', 70.00, 'Product-9400.png', 23, 'Yes', 'Yes'),
(43, 'Anker Powerbank', '10000mAh, one Type A and one Type C.', 50.00, 'Product-9709.png', 23, 'Yes', 'Yes'),
(44, 'Solar Powerbank', '18000mAh, solar panel on top. Two Type A and one Type C.', 80.00, 'Product-2486.png', 23, 'Yes', 'Yes'),
(45, 'Belkin Powerbank', '10000mAh, one Type C and two Type A.', 50.00, 'Product-319.png', 23, 'Yes', 'Yes'),
(46, 'Blue Powerbank', '15000mAh, with wireless charger and Type C cable.', 90.00, 'Product-5690.png', 23, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `username`, `phone_no`, `email`, `password`) VALUES
(3, 'Meteor', 'See', 'MS', '+60193309187', 'meteorsee@gmail.com', '202cb962ac59075b964b07152d234b70'),
(5, 'Vivian', 'Na', 'VV', '1234', '', '202cb962ac59075b964b07152d234b70'),
(6, 'Kim Hau', 'Yau', 'KH', '12345', '', '202cb962ac59075b964b07152d234b70'),
(7, 'Jie Qing', 'Chai', 'JQ', '123', '', '202cb962ac59075b964b07152d234b70'),
(8, 'Yu Xuan', 'Tee', 'YX', '123', '', '202cb962ac59075b964b07152d234b70'),
(9, 'Keng Lek', 'See', 'SKL', '+60193309187', '', '202cb962ac59075b964b07152d234b70'),
(10, 'Yu Xuan', 'Tee', 'TYX', '+60193309187', '', '202cb962ac59075b964b07152d234b70'),
(11, 'Meteor', 'See', 'cjq', '123', '', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`),
  ADD CONSTRAINT `tbl_cart_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
