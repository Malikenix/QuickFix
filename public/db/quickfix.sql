-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 07:57 AM
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
-- Database: `quickfix`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(87, 'Electricians'),
(88, 'Plumbers'),
(89, 'Carpenters');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(5) NOT NULL,
  `city_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Alegria'),
(2, 'Bogo city'),
(3, 'Carcar city'),
(4, 'Cebu city'),
(5, 'Danao city'),
(6, 'Lapu-lapu city'),
(7, 'Mandaue city'),
(8, 'Talisay city');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'john', 'john@123', 'sadasdasd', '2025-10-14 04:03:32'),
(2, 'john', 'john@123', 'sadasdasd', '2025-10-14 04:03:32'),
(3, 'asdasd', 'adasd@gmail.com', 'ada', '2025-10-14 04:03:57'),
(4, 'asdasd', 'adasd@gmail.com', 'ada', '2025-10-14 04:05:16'),
(5, 'asdasd', 'adasd@gmail.com', 'ada', '2025-10-14 04:11:58'),
(6, 'erica', 'dbhhsuhhd@gmail.com', 'hello world goodbye', '2025-11-18 03:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(5) NOT NULL,
  `login_id` int(5) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city_id` int(5) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `login_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city_id`, `pincode`, `profile_picture`, `bio`, `birthdate`) VALUES
(8, 360, 'john', 'arancillo', 'johnarancillo110119@gmail.com', '09481870374', 'cebu city', 4, '110119', '1763436056_Untitled design.jpg', 'hello world', '2015-01-29'),
(9, 362, 'carlo', 'embate', 'arielembate@gmail.com', '09999999998', 'cebu city', 4, '110119', NULL, NULL, NULL),
(10, 363, 'jaycar', 'otida', 'jaycarotida@gmail.com', '091919191911', 'cebu city', 4, '110119', 'uploads/download.jpg', '', '0000-00-00'),
(12, 365, 'Hello', 'World', 'dbhhsuhhd@gmail.com', '09935883250', 'cebu city', 4, '110119', NULL, NULL, NULL),
(13, 366, 'luigi', 'mirambel', 'luigimirambel@gmail.com', '09481870374', 'cebu city', 4, '120119', 'uploads/event-qr-RUN-14.png', '', '0000-00-00'),
(14, 368, 'root', 'root', 'root@gmail.com', '09999999999', 'Adg IT CENTER', 4, '110119', '1759152058_5ea5d501-8b0a-4114-b61d-d7a61297180a.jpg', 'dadadas', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hire_master`
--

CREATE TABLE `hire_master` (
  `hire_id` int(5) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `pay_mode` varchar(20) NOT NULL,
  `total` int(20) NOT NULL,
  `hire_date` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hire_master`
--

INSERT INTO `hire_master` (`hire_id`, `customer_id`, `full_name`, `phone`, `address`, `pincode`, `pay_mode`, `total`, `hire_date`, `due_date`) VALUES
(0, 14, 'john arancillo', '0999393323', 'Pajac lapu lapu city', '110119', '', 0, '2025-09-23 03:39:58', '2025-09-23 14:18:14'),
(29, 8, 'john aranicllo', '09481870374', 'cebu city', '110119', '', 0, '2025-02-22 09:44:50', '2025-09-23 14:18:14'),
(30, 8, 'john', '09281870374', 'cebu city', '110119', '', 0, '2025-03-21 04:20:08', '2025-09-23 14:18:14'),
(31, 10, 'jaycar123', '091919191911', 'cebu city', '110119', '', 0, '2025-07-05 03:30:00', '2025-09-23 14:18:14'),
(32, 13, 'John Arancillo', '09935883250', 'cebu city', '120119', '', 0, '2025-07-19 11:22:25', '2025-09-23 14:18:14'),
(33, 13, 'John Arancillo', '09935883250', 'cebu city', '120119', '', 0, '2025-07-19 11:37:21', '2025-09-23 14:18:14'),
(34, 14, 'hello world', '09481870374', 'Honoria Paras Building, Fuente Osmena Cebu City', '110119', '', 0, '2025-09-13 10:49:56', '2025-09-23 14:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `hire_service`
--

CREATE TABLE `hire_service` (
  `hire_id` int(11) NOT NULL,
  `service_id` int(5) NOT NULL,
  `sp_id` int(5) NOT NULL,
  `service_title` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hire_service`
--

INSERT INTO `hire_service` (`hire_id`, `service_id`, `sp_id`, `service_title`, `price`, `qty`, `status`) VALUES
(0, 43, 63, 'carpenter', 0.00, 1, 'completed'),
(29, 42, 61, 'Plumbing your house', 1000.00, 1, 'completed'),
(30, 42, 61, 'Plumbing your house', 1000.00, 1, 'pending'),
(31, 42, 61, 'Plumbing your house', 1000.00, 1, 'pending'),
(32, 41, 61, 'electrician', 599.50, 1, 'pending'),
(33, 41, 62, 'Electricians', 1000.00, 1, 'inprogress'),
(34, 42, 61, 'Plumbing your house', 1000.00, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(5) NOT NULL,
  `role_id` int(5) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `role_id`, `username`, `password`) VALUES
(335, 1, 'admin', '$2y$10$Nt6ew7qWxbtWMZjcMWz8SOki1k2ZqKvh89rWgiEgFqmHj4e3f5jhe'),
(355, 3, 'jay_gabani', '$2y$10$wXEeA6MNy13EsgQlF8G3w.fhZC4NCH2kEi0amMj9CdtTvU.ZiUsMO'),
(358, 2, 'jeel', '$2y$10$40EBg/w9DlFItbzn9X5a3uj44gZg8Xf2BTSeZD2YENvdRkeHzGxMO'),
(359, 3, 'harsh', '$2y$10$DWwYtA3iYk.aOGW2z9oVEOp6XNJXWLWQ2fUvHKYtfAwKzWmzAVkJO'),
(360, 3, 'johnrows404', '$2y$10$.u7KsBo7FsOvQ8p3enKXFu/En8PiovBJCies6feX74SiMT.p8di8G'),
(361, 2, 'erica12', '$2y$10$3pm6ZbmDL3Blj1QQgVNajOaR1tS8oKPEIwUpsB/8lHAEZEi6A0Z.y'),
(362, 3, 'arielembate', '$2y$10$H./83.7NQtuPoV3n5VydY.4.s71R65eD2Sap1hhrSDUQoA6zsJ7b2'),
(363, 3, 'jaycar123', '$2y$10$7UNqs8Cw71chIf8w7NrD.uRI73Gk/AhELu.0ShHhru7guuiVc428y'),
(364, 3, 'John2123', '$2y$10$fzg/DbmmnHrGwL1fG9IX7ekKqMgYLEE0xJpN9VLvHb7GAGf/kB93K'),
(365, 3, 'HelloWorld123', '$2y$10$q60VBpOIf22vMvoB/rT8Dut6cdVXoR/nYb41vHnmnxaNdSWTjyXFW'),
(366, 3, 'luigi123', '$2y$10$e3I8nw/7EgSrIJxVPmXwQu5A7xqGHRIeGL1Mj/jwuCHtE4L9XSIz2'),
(367, 2, 'Provider@123', '$2y$10$FZwcsbuupg22e.xbRQ6/ruyIYu9G1c8j7o9XvhTkUV2x4Va46BbDW'),
(368, 3, 'root', '$2y$10$RH.dpbl0g/bq2.spv.BDzu92uOkAMYD.vQSeJnSU7AFAXMIBTQRl.'),
(369, 2, 'john', '$2y$10$HL8JECuV5.kyO5FmsL2S6uXkd0.6YvEcO9I3yvdJJIJYnhiI87.7K');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(5) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'serviceprovider'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(5) NOT NULL,
  `category_id` int(5) DEFAULT NULL,
  `service_name` varchar(50) DEFAULT NULL,
  `service_availibility` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `category_id`, `service_name`, `service_availibility`) VALUES
(41, 87, 'Electrical Wiring', 1),
(42, 88, 'House Plumbing', 1),
(43, 89, 'House Wood furniture', 1),
(44, 88, 'plumbers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp`
--

CREATE TABLE `sp` (
  `sp_id` int(5) NOT NULL,
  `login_id` int(5) NOT NULL,
  `sp_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `city_id` int(5) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `status` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp`
--

INSERT INTO `sp` (`sp_id`, `login_id`, `sp_name`, `email`, `phone`, `city_id`, `pincode`, `status`, `profile_picture`, `bio`, `birthdate`) VALUES
(61, 361, '', 'erica@gmail.com', '09876543211', 4, '110119', 'active', 'uploads/HD-wallpaper-anime-dandadan.jpg', '', '2024-02-06'),
(62, 367, 'Carry Romero', 'CarryRemoro@gmail.com', '09999999998', 4, '110119', 'active', NULL, NULL, NULL),
(63, 369, 'john arancilo', 'Johnarancillo110119@gmail.com', '0192919219112', 4, '110119', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sp_service`
--

CREATE TABLE `sp_service` (
  `sp_id` int(5) NOT NULL,
  `service_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `service_title` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_service`
--

INSERT INTO `sp_service` (`sp_id`, `service_id`, `category_id`, `service_title`, `price`, `description`, `availability`) VALUES
(61, 41, 87, 'electrician', '599.50', 'provide electrical circuit failure', 1),
(61, 42, 88, 'Plumbing your house', '1000', 'everything can be fixed', 1),
(61, 44, 88, 'hello world', '1,500,000', 'hahahhaa', 1),
(62, 41, 87, 'Electricians', '1000', 'electrical', 1),
(63, 41, 87, 'electrician', '10000', 'dasdasdsad', 1),
(63, 43, 89, 'carpenter', '', 'sdasdsadas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `updatetry`
--

CREATE TABLE `updatetry` (
  `id` int(5) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(15) NOT NULL,
  `number` varchar(255) NOT NULL,
  `profile_pic` tinyint(255) NOT NULL,
  `verified` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `hire_master`
--
ALTER TABLE `hire_master`
  ADD PRIMARY KEY (`hire_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `hire_service`
--
ALTER TABLE `hire_service`
  ADD UNIQUE KEY `order_id` (`hire_id`,`service_id`,`sp_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `sp_id` (`sp_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sp`
--
ALTER TABLE `sp`
  ADD PRIMARY KEY (`sp_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `sp_service`
--
ALTER TABLE `sp_service`
  ADD PRIMARY KEY (`sp_id`,`service_id`),
  ADD KEY `sevice_id` (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `updatetry`
--
ALTER TABLE `updatetry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sp`
--
ALTER TABLE `sp`
  MODIFY `sp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `updatetry`
--
ALTER TABLE `updatetry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

--
-- Constraints for table `hire_master`
--
ALTER TABLE `hire_master`
  ADD CONSTRAINT `hire_master_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `hire_service`
--
ALTER TABLE `hire_service`
  ADD CONSTRAINT `hire_service_ibfk_1` FOREIGN KEY (`hire_id`) REFERENCES `hire_master` (`hire_id`),
  ADD CONSTRAINT `hire_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `hire_service_ibfk_3` FOREIGN KEY (`sp_id`) REFERENCES `sp` (`sp_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `sp`
--
ALTER TABLE `sp`
  ADD CONSTRAINT `sp_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`),
  ADD CONSTRAINT `sp_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `sp_service`
--
ALTER TABLE `sp_service`
  ADD CONSTRAINT `sp_service_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `sp_service_ibfk_2` FOREIGN KEY (`sp_id`) REFERENCES `sp` (`sp_id`),
  ADD CONSTRAINT `sp_service_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
