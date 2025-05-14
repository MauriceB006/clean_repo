-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 09:44 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `buslines1`
--

CREATE TABLE `buslines1` (
  `line_id` int(11) NOT NULL,
  `line_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buslines1`
--

INSERT INTO `buslines1` (`line_id`, `line_name`) VALUES
(1, 'LINE B1'),
(2, 'LINE B2'),
(3, 'LINE B3');

-- --------------------------------------------------------

--
-- Table structure for table `busstops`
--

CREATE TABLE `busstops` (
  `stop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus_card_applications`
--

CREATE TABLE `bus_card_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_card_applications`
--

INSERT INTO `bus_card_applications` (`id`, `name`, `email`, `phone`, `address`, `application_date`, `status`) VALUES
(1, 'creator2', 'creator@gmail.com', '76345828', 'ba3ed fadi sport tene bineye 3al yamin', '2025-04-14 22:54:54', 'approved'),
(2, 'afif sleiman', 'maurcie@gmail.com', '70073126', 'ba3ed fadi sport tene bineye 3al yamin yo', '2025-04-15 13:33:11', 'rejected'),
(3, 'afif sleiman', 'maurcie@gmail.com', '70073126', 'ba3ed fadi sport tene bineye 3al yamin', '2025-04-15 13:45:45', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','in_progress','resolved') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

CREATE TABLE `lostitems` (
  `item_id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `line_id` varchar(11) DEFAULT NULL,
  `item_description` text NOT NULL,
  `lost_date` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `status` enum('pending','found','claimed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lostitems`
--

INSERT INTO `lostitems` (`item_id`, `user_id`, `line_id`, `item_description`, `lost_date`, `contact_info`, `status`, `created_at`, `user_name`) VALUES
(34, NULL, '1', 'fdkjdlkjdpfgjpfeogpo', '2025-04-02', 'sikonbin@gmail.com', 'pending', '2025-04-15 13:09:09', 'CREATOR1');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `line_id` int(11) DEFAULT NULL,
  `report_type` enum('driver','incident','misconduct','other') NOT NULL,
  `prob_desc` varchar(255) DEFAULT NULL,
  `incident_date` date NOT NULL,
  `incident_time` time NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `status` enum('pending','investigating','resolved','dismissed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `line_id`, `report_type`, `prob_desc`, `incident_date`, `incident_time`, `is_public`, `status`, `created_at`) VALUES
(8, 9, 1, 'driver', 'a very reckless driver', '2002-12-12', '17:12:00', 0, '', '2025-04-28 15:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews12`
--

CREATE TABLE `reviews12` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line_id` varchar(10) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `travel_date` date NOT NULL,
  `travel_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews12`
--

INSERT INTO `reviews12` (`review_id`, `user_id`, `line_id`, `rating`, `comment`, `travel_date`, `travel_time`, `created_at`) VALUES
(1, 1, 'Line B3', 5, 'lkhjhjhkjhkj', '2025-04-05', '05:05:00', '2025-04-14 23:08:01'),
(2, 1, 'Line B3', 5, 'lkhjhjhkjhkj', '2025-04-05', '05:05:00', '2025-04-14 23:08:21'),
(3, 1, 'Line B2', 2, 'maltraitance des personnes ages', '2012-06-06', '20:30:00', '2025-04-15 16:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password1` varchar(255) NOT NULL,
  `remember_token` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `phone`, `password1`, `remember_token`, `created_at`) VALUES
(1, 'bobo', 'bobo@gmail.com', '76345828', '$2y$10$xMCPJ6gFZXSwAj585e30Uuygnk44F/HJZKM1Y9v/EwtMWXk0fT7r6', NULL, '2025-04-14 22:00:38'),
(3, 'creator2', 'creator@gmail.com', '767676', '$2y$10$JjRqAZxLrbOVWC7va3LKHO4zt0e8AdmD6.GV5FqgfP0oFIEb9NEzC', NULL, '2025-04-14 22:16:45'),
(4, 'samira', 'samira12@gmail.com', '03666876', '$2y$10$XI4yUfdRl21lqCl17KZZsunWHqwDGWjfpcoBDP/vYKUF/oxzkbmM2', NULL, '2025-04-15 10:57:04'),
(5, 'creator3', 'creator3@gmail.com', '123567', '$2y$10$bUbm45VerhV2ofKluPokxe6HFtM7OOjdpkyFcAfYFuhhm5y1/jyta', NULL, '2025-04-15 12:46:09'),
(6, 'afif sleiman', 'maurcie@gmail.com', '70073126', '$2y$10$NPdaLInGItc1FtVCV5IHTedcd0kMFeO.EFczuOVnb7gaewGkLizYK', NULL, '2025-04-15 13:19:25'),
(7, 'soha jamal eldin', 'soha42@gmail.com', '76382559', '$2y$10$XUIFOTlDZeAtehmZ3vXusu8S9U/v6v8Xk46wC6u7y4uLJGqbHdUNy', NULL, '2025-04-16 06:10:22'),
(8, 'anthony imad', 'antoun@gmail.com', '1221221', '$2y$10$Z2Gaw3lOkfT0vR3qewQtteSSeOuOZ.DoL7VeZBOa87eXsIBYR7xIG', NULL, '2025-04-23 13:25:33'),
(9, 'suly frouq', 'suly@gmail.com', '03333215', '$2y$10$nR0hx1cp1rntDtIpHfa/v.TYzRo8Cpa4fn4Lt0se2aJCAIlqYfvRG', NULL, '2025-04-28 15:10:16'),
(10, 'creator11', 'creator11@gmail.com', '767676', '$2y$10$Lp3l8MyRNYqfJhIENS8epeFK7dTUn1FGAHsz6pMZF//kZJWn69gqO', NULL, '2025-04-30 13:09:44'),
(11, 'naji ftouni', 'naji@gmail.com', '76545505', '$2y$10$6LL99rtzsaBVCvziTtlSzunwJZ4tGnMp4WVPktE/jxLruqXoLdVy6', NULL, '2025-05-06 14:26:34'),
(12, 'creatorMB', 'creatorMB@gmail.com', '76345828', '$2y$10$/MxC/27GvhwYSwm1n0x0/.TfikCliYeaaTRLdrhgkziS2tHy5Oj3S', NULL, '2025-05-07 11:43:42'),
(14, 'dany neaino', 'neaino@gmail.com', '76345828', '$2y$10$Oh4Rkt.xTwcpzMBWkBvt7OqooUi35aiGG7Oh71kpq6xW6Ib2rF7FS', NULL, '2025-05-13 14:13:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buslines1`
--
ALTER TABLE `buslines1`
  ADD PRIMARY KEY (`line_id`),
  ADD UNIQUE KEY `line_name` (`line_name`);

--
-- Indexes for table `busstops`
--
ALTER TABLE `busstops`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indexes for table `bus_card_applications`
--
ALTER TABLE `bus_card_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `line_id` (`line_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reports_ibfk_2` (`line_id`);

--
-- Indexes for table `reviews12`
--
ALTER TABLE `reviews12`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buslines1`
--
ALTER TABLE `buslines1`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `busstops`
--
ALTER TABLE `busstops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bus_card_applications`
--
ALTER TABLE `bus_card_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lostitems`
--
ALTER TABLE `lostitems`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews12`
--
ALTER TABLE `reviews12`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD CONSTRAINT `contactmessages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`line_id`) REFERENCES `buslines1` (`line_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
