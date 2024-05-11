-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 02:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'omv', 'om@lancer.co.in', '$2y$10$ZvBcKXdyFMAWH/we6Kn2SeoCVMg2KV36rpEW8qV9iNYIH5Flqa7xm');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, 'Durian'),
(2, 'Stanhope '),
(3, 'Royaloak'),
(4, 'Godrej Interio'),
(5, 'Evok'),
(6, 'Geeken'),
(7, 'BoConcept');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Chair'),
(2, 'Sofa'),
(3, 'Bed'),
(4, 'Lighting');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_table`
--

CREATE TABLE `delivery_table` (
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'Stanhope Engineered Wood Bed', 'Stanhope Engineered Wood King Size Drawer Storage Upholstered Bed In Finish.\r\nProduct Dimensions : 99.0 cm x 210.0 cm x 237.0 cm\r\nRecommended mattress thickness is 6 to 8 inches\r\nBed frame made of high-quality MDF and particle board\r\n', 'Wood Bed', 3, 2, 'bed1.jpg', 'bed2.jpg', 'bed3.jpg', '46409', '2023-04-22 11:14:55', 'true'),
(2, 'Stanhope Engineered Wood Bed', 'Toshi Engineered Wood Queen Size Drawer And Box Storage Bed In Rustic Walnut Finish\r\n', 'Product Dimensions : 30.0 cm x 208.0 cm x 160.0 cm', 3, 2, 'bed4.jpg', 'bed5.jpg', 'bed6.jpg', '18423', '2023-04-22 11:28:02', 'true'),
(3, 'Stanhope Engineered Wood Bed', 'Belize Engineered Wood Queen Size Upholstered Bed In Finish\r\nProduct Dimensions : 119.0 cm x 248.0 cm x 166.0 cm\r\nMade of MDF and Particle Board. Legs made up of Rubber Wood\r\nRecommended mattress size: King - 78\" x 72\" | Queen - 78\" x 60\"', 'Wood Bed', 3, 2, 'bed7.jpg', 'bed8.jpg', 'bed9.jpg', '31499', '2023-04-22 11:28:10', 'true'),
(4, 'Durian Solid Wood Bed', 'Duetto Solid Wood King Size Bed In Two-Tone Finish.\r\nProduct Dimensions : 73.0 cm x 224.0 cm x 228.0 cm\r\nPrimary material - Mango Wood\r\n15mm MDF panels to support to the mattress', 'Wood Bed', 3, 1, 'bed10.jpg', 'bed11.jpg', 'bed12.jpg', '43623', '2023-04-22 11:23:59', 'true'),
(5, 'Durian Engineered Wood Bed', 'Durian Engineered Wood King Size Drawer Storage Upholstered Bed In Finish.\nProduct Dimensions : 99.0 cm x 210.0 cm x 237.0 cm\nRecommended mattress thickness is 6 to 8 inches\nBed frame made of high-quality MDF and particle board', 'Wood Bed', 3, 1, 'bed13.jpg', 'bed14.jpg', 'bed15.jpg', '31499', '2023-04-22 11:31:33', 'true'),
(6, 'RoyalOak Lounge Chair', 'Carven Lounge Chair In Dark Grey Fabric\r\nProduct Dimensions : 81.0 cm x 74.0 cm x 71.0 cm\r\nLegs and armrests made from Beech Wood\r\nThe inner frame is made of plastic', 'Lounge Chair', 1, 3, 'chair1.jpg', 'chair2.jpg', 'chair3.png', '15849', '2023-04-22 11:35:05', 'true'),
(7, 'RoyalOak Footstool', 'RoyalOak Footstool.\r\nProduct Dimensions : 23.0 cm x 44.0 cm x 44.0 cm\r\nFrame made from premium Mango wood\r\nFabric: 100% Cotton', 'Footstool', 1, 3, 'chair4.jpg', 'chair5.jpg', 'chair6.jpg', '3419', '2023-04-22 11:37:19', 'true'),
(8, 'RoyalOak Fabric Manual Recliner', 'Lebowski Fabric One Seater Manual Recliner In Smoke Fabric Colour\r\nProduct Dimensions : 103.0 cm x 81.0 cm x 93.0 cm\r\nIts generous proportions make it a perfect choice to catch a quick nap.\r\nIndoor use  only.', 'Manual Recliner', 1, 3, 'chair7.jpg', 'chair8.png', 'chair9.png', '16974', '2023-04-22 11:40:02', 'true'),
(9, 'Evok Bar Stool - Set Of 2', 'Evok Bar Stool (Walnut Finish, Yellow) \r\nDimensions : 100.0 cm x 46.0 cm x 45.0 cm\r\nTall, dark, and sturdy. Crafted from mango wood with a walnut finish\r\nMade from high-grade mango wood', 'Bar Stool', 1, 5, 'chair10.jpg', 'chair11.jpg', 'chair12.jpg', '13589', '2023-04-22 11:42:18', 'true'),
(10, 'Evok Lounge Chair', 'Evok Lounge Chair In Blue Fabric\r\nProduct Dimensions : 61.0 cm x 102.0 cm x 94.0 cm', 'Lounge Chair', 1, 5, 'chair13.jpg', 'chair14.jpg', 'chair15.jpg', '22499', '2023-04-22 11:43:56', 'true'),
(11, 'Godrej Inferno Wooden Sofa', 'Godrej Inferno Wooden Sofa - American Walnut Finish (Green Olivia)\r\n2-seater Dimensions : 75.0 cm x 120.0 cm x 71.0 cm\r\nThis sofa’s frame is made from seasoned solid wood that undergoes a 3-step treatment for protection against borers and is kiln-dried fo', 'Wooden Sofa', 2, 4, 'sofa1.png', 'sofa2.jpg', 'sofa3.jpg', '30744', '2023-04-22 11:47:30', 'true'),
(12, 'Godrej Inferno Leather Sofa', 'Godrej Inferno Leather Sofa (Mustard Italian Leather)\r\n3-seater Dimensions : 72.0 cm x 213.0 cm x 89.0 cm\r\nThis sofa’s frame is made from seasoned solid wood with plywood boxing that undergoes a 3-step treatment for protection against borers and is kiln-d', ' Leather Sofa', 2, 4, 'sofa4.png', 'sofa5.jpg', 'sofa6.jpg', '24098', '2023-04-22 11:53:58', 'true'),
(13, 'Geeken Multicolor Canvas Table Lamp', 'Geeken Multicolor Canvas Table Lamp With Wood Base\r\nProduct Dimensions : 35.0 cm x 13.0 cm x 13.0 cm', ' Table Lamp', 4, 6, 'light1.jpg', 'light2.jpg', 'light3.jpg', '1364', '2023-04-22 11:57:15', 'true'),
(14, 'Geeken Table Lamp', 'Geeken Table Lamp\r\nProduct Dimensions : 79.0 cm x 25.0 cm x 25.0 cm\r\nInspired by impressionism which dwells on the philosophy of reflection without relying on realism. This collection celebrates the synthesis of natural beauty and harmonious irregularity ', 'Table Lamp', 4, 6, 'light4.jpg', 'light5.jpg', 'light6.jpg', '6199', '2023-04-22 11:59:29', 'true'),
(15, 'BoConcept Chandelier', 'BoConcept Chandelier\r\nProduct Dimensions: 57.0 cm x 57.0 cm\r\nBase made of Crystal and Steel in a Rose Gold finish.', 'Chandelier', 4, 7, 'light7.jpg', 'light8.jpg', 'light9.jpg', '29949', '2023-04-22 12:01:58', 'true'),
(16, 'BoConcept Chandelier', 'BoConcept Chandelier\r\nProduct Dimensions: 46.0 cm x 40.0 cm\r\nBase made of Steel and Glass in a White and Brass finish.', 'Chandelier', 4, 7, 'light10.jpg', 'light11.jpg', 'light12.jpg', '20583', '2023-04-22 12:04:41', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`, `resettoken`, `resettokenexpire`) VALUES
(1, 'omv', 'om@lancer.co.in', '$2y$10$q0nW3y9DZ6LkmObnvbdceO5lsXouv3zCm9Tnfk5GXmXIv3romwSue', 'Om Valia Image (1).jpeg', '::1', 'D/611,Starlight,Mahavir Nagar, Kandivali(W)', '9004475994', 'NULL', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery_table`
--
ALTER TABLE `delivery_table`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_table`
--
ALTER TABLE `delivery_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
