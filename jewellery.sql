-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 05:24 PM
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
-- Database: `jewellery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `sr_no` int(11) NOT NULL,
  `adm` varchar(150) NOT NULL,
  `adm_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`sr_no`, `adm`, `adm_pass`) VALUES
(1, 'vertika', 'vertika1709');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `jewellery_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `security_charge` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `total_security` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `jewellery_name`, `price`, `security_charge`, `total_price`, `total_security`, `user_name`, `phone`, `address`, `pincode`) VALUES
(1, 1, 'floral set', 800, 200, 800, 200, 'vertika', '29324744738', 'jsdsfs', 232873),
(2, 2, 'Heavy Sets', 1500, 500, 3000, 1000, 'vertika', '29324744738', 'jsdsfs', 232873),
(3, 3, 'Heavy Sets', 1500, 500, 3000, 1000, 'vertika', '29324744738', 'jsdsfs', 232873),
(4, 4, 'Bridal sets', 1200, 400, 2400, 800, 'vertika', '29324744738', 'jsdsfs', 232873),
(5, 5, 'Bridal sets', 1200, 400, 2400, 800, 'vertika', '29324744738', 'jsdsfs', 232873),
(6, 6, 'necklace', 750, 200, 1500, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(7, 7, 'necklace', 750, 200, 1500, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(8, 8, 'floral set', 800, 200, 1600, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(9, 9, 'Bridal sets', 1200, 400, 1200, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(10, 10, 'floral set', 800, 200, 800, 200, 'vertika', '29324744738', 'jsdsfs', 232873),
(11, 11, 'Bridal sets', 1200, 400, 1200, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(12, 12, 'Bridal sets', 1200, 400, 1200, 400, 'vertika', '29324744738', 'jsdsfs', 232873),
(13, 13, 'Bridal sets', 1200, 400, 2400, 800, 'vertika', '9636670570', 'jsdsfs', 232873),
(14, 14, 'special temple set', 1200, 750, 2400, 1500, 'vertika', '9636670570', 'jsdsfs', 232873),
(15, 15, 'special temple set', 1200, 750, 2400, 1500, 'vertika', '9636670570', 'jsdsfs', 232873),
(16, 16, 'Heavy Sets', 1500, 500, 3000, 1000, 'vertika', '9636670570', 'jsdsfs', 232873),
(17, 17, 'necklace', 750, 200, 1500, 400, 'vertika', '9636670570', 'jsdsfs', 232873),
(18, 18, 'Heavy Sets', 1500, 500, 3000, 1000, 'vertika', '9636670570', 'jsjjiohih', 232873),
(19, 19, 'TVS Jupiter', 800, 200, 2400, 600, 'Tavish vijay', '8000254103', 'kota', 324005);

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jewellery_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `return_date` date NOT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'booked',
  `order_id` varchar(150) NOT NULL,
  `datentime` date NOT NULL DEFAULT current_timestamp(),
  `arrival` int(11) NOT NULL DEFAULT 0,
  `rate_review` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `jewellery_id`, `booking_date`, `return_date`, `booking_status`, `order_id`, `datentime`, `arrival`, `rate_review`) VALUES
(1, 18, 5, '2023-11-22', '2023-11-23', 'booked', '23638cee', '2023-11-22', 1, NULL),
(2, 18, 4, '2023-11-25', '2023-11-27', 'cancelled', 'c7a996d2', '2023-11-22', 0, NULL),
(3, 18, 4, '2023-11-25', '2023-11-27', 'cancelled', '3c70382a', '2023-11-22', 0, NULL),
(4, 18, 3, '2023-11-30', '2023-12-02', 'booked', '8d22405a', '2023-11-22', 1, 0),
(5, 18, 3, '2023-11-30', '2023-12-02', 'booked', 'cb908c13', '2023-11-22', 1, NULL),
(6, 18, 7, '2023-11-29', '2023-12-01', 'cancelled', 'f8a2b4c8', '2023-11-22', 0, NULL),
(7, 18, 7, '2023-11-29', '2023-12-01', 'cancelled', '81b6160a', '2023-11-22', 0, NULL),
(8, 18, 5, '2023-11-25', '2023-11-27', 'cancelled', '64a02047', '2023-11-22', 0, NULL),
(9, 18, 3, '2023-11-25', '2023-11-26', 'cancelled', '8c109ae7', '2023-11-22', 0, NULL),
(10, 18, 5, '2023-11-30', '2023-12-01', 'cancelled', '82b1b596', '2023-11-22', 0, NULL),
(11, 18, 3, '2023-11-24', '2023-11-25', 'cancelled', 'a7281b65', '2023-11-22', 0, NULL),
(12, 18, 3, '2023-11-24', '2023-11-25', 'cancelled', '0a217bf6', '2023-11-22', 0, NULL),
(13, 18, 3, '2023-11-25', '2023-11-27', 'booked', 'c63c2958', '2019-11-22', 1, 1),
(14, 18, 6, '2023-11-25', '2023-11-27', 'booked', 'dab49881', '2023-11-24', 1, 1),
(15, 18, 6, '2023-11-26', '2023-11-28', 'booked', 'e6b71e18', '2023-11-24', 1, 1),
(16, 18, 4, '2023-11-25', '2023-11-27', 'booked', 'e787cd03', '2023-11-24', 1, 1),
(17, 18, 7, '2023-11-25', '2023-11-27', 'booked', 'ca328682', '2023-11-24', 1, 1),
(18, 18, 4, '2023-11-30', '2023-12-02', 'booked', '9a9aa23b', '2023-11-28', 1, 1),
(19, 28, 10, '2024-07-09', '2024-07-12', 'cancelled', '7be8c785', '2024-07-09', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(14, 'Sports Bike'),
(15, 'Scooty'),
(16, 'Standard Bike');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `fb` varchar(200) NOT NULL,
  `insta` varchar(200) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `mail`, `fb`, `insta`, `iframe`) VALUES
(1, '36 shastri nagar, Dadabari, Kota', 'https://maps.app.goo.gl/8tEFYd4QP261KVK57', 919352416613, 918000254103, 'tavishvijay7@gmail.com', 'https://www.facebook.com/vertikagarg1703', 'https://instagram.com/vertika_17?igshid=YmMyMTA2M2Y=', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d231096.55969034313!2d75.846965!3d25.173403!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396f9b30c41bb44d:0x5f5c103200045588!2sKota, Rajasthan!5e0!3m2!1sen!2sin!4v1698512547112!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `jewellery`
--

CREATE TABLE `jewellery` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `security_charge` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jewellery`
--

INSERT INTO `jewellery` (`id`, `name`, `price`, `security_charge`, `quantity`, `description`, `status`, `removed`) VALUES
(1, 'temple sets', 1000, 580, 5, 'temple jewellery minakari work', 1, 1),
(2, 'ihiugu', 5, 65464, 54, 'lkjhgfcvhb', 1, 1),
(3, 'Bullet 350', 1200, 400, 2, 'Bullet Classic 350', 1, 1),
(4, 'Hunter 350', 1800, 500, 2, 'Hunter350', 1, 0),
(5, 'RC KTM', 1600, 500, 2, 'KTMRC', 1, 0),
(6, 'Yamaha R15', 2000, 750, 2, 'power bike', 1, 0),
(7, 'Honda sp125', 1000, 200, 5, 'sp125', 1, 0),
(8, 'Activa 6g', 800, 200, 2, 'Activa 6g', 1, 0),
(9, 'fhifh', 293, 232, 2, 'efee', 1, 1),
(10, 'TVS Jupiter', 800, 200, 1, 'Jupiter', 1, 0),
(11, 'dfffi', 3282, 389, 2, 'efei', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jewellery_category`
--

CREATE TABLE `jewellery_category` (
  `sr_no` int(11) NOT NULL,
  `jewellery_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jewellery_category`
--

INSERT INTO `jewellery_category` (`sr_no`, `jewellery_id`, `category_id`) VALUES
(23, 4, 16),
(27, 7, 16),
(28, 8, 15),
(29, 10, 15),
(30, 3, 16),
(31, 5, 14),
(32, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `jewellery_image`
--

CREATE TABLE `jewellery_image` (
  `sr_no` int(11) NOT NULL,
  `jewellery_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jewellery_image`
--

INSERT INTO `jewellery_image` (`sr_no`, `jewellery_id`, `image`, `thumb`) VALUES
(17, 4, 'IMG_97100.webp', 0),
(18, 5, 'IMG_88809.jpg', 0),
(19, 6, 'IMG_65336.webp', 0),
(20, 7, 'IMG_52776.png', 0),
(21, 8, 'IMG_39290.jpg', 0),
(22, 10, 'IMG_63853.jpg', 0),
(23, 4, 'IMG_80148.jpg', 1),
(24, 5, 'IMG_42685.jpg', 1),
(25, 6, 'IMG_13039.jpg', 1),
(26, 10, 'IMG_33270.jpg', 1),
(27, 8, 'IMG_13372.jpg', 1),
(28, 7, 'IMG_42007.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `jewellery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'GoSpeedy', 'welcome to our Website', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `pass` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(200) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `address`, `phone`, `pincode`, `dob`, `pass`, `status`, `datentime`, `email`, `verification_code`, `is_verified`, `reset_token`, `token_expire`) VALUES
(18, 'vertika garg', 'shastri nagar kota', '9636670570', 232873, '2023-10-09', '$2y$10$HYIEsCbE7fMvp3P4AzErRORz4TNLGjmvFhUELG7i9UBNO/MDVeVb6', 1, '2023-11-17 23:53:42', 'gargvertika469@gmail.com', 'ebc214dbf0401bb0eb9265ffd7eb439a', 1, NULL, NULL),
(28, 'Tavish vijay', 'kota', '8000254103', 324005, '2002-11-05', '$2y$10$77rr29x403/LWIOSjrfoceC5JsUbvGjkI10HLeJ5aN6K75WL2KyKK', 1, '2024-07-09 09:40:02', 'tavishvijay7@gmail.com', '91a68ec829623a57441cfb79d2cbf201', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jewellery_id` (`jewellery_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `jewellery`
--
ALTER TABLE `jewellery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jewellery_category`
--
ALTER TABLE `jewellery_category`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `jewellery id` (`jewellery_id`),
  ADD KEY `category id` (`category_id`);

--
-- Indexes for table `jewellery_image`
--
ALTER TABLE `jewellery_image`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `jewellery_id` (`jewellery_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `jewellery_id` (`jewellery_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jewellery`
--
ALTER TABLE `jewellery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jewellery_category`
--
ALTER TABLE `jewellery_category`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `jewellery_image`
--
ALTER TABLE `jewellery_image`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`jewellery_id`) REFERENCES `jewellery` (`id`);

--
-- Constraints for table `jewellery_category`
--
ALTER TABLE `jewellery_category`
  ADD CONSTRAINT `category id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `jewellery id` FOREIGN KEY (`jewellery_id`) REFERENCES `jewellery` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `jewellery_image`
--
ALTER TABLE `jewellery_image`
  ADD CONSTRAINT `jewellery_image_ibfk_1` FOREIGN KEY (`jewellery_id`) REFERENCES `jewellery` (`id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`jewellery_id`) REFERENCES `jewellery` (`id`),
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
