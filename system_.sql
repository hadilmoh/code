-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 09:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `code_tk` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `msg` longtext NOT NULL,
  `commented_on` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `code_tk`, `user_id`, `customer_id`, `type`, `msg`, `commented_on`, `created_at`) VALUES
(121, 440729, 2, NULL, 'user', 'from user saja', '2023-02-01', '2023-02-01 04:54:51'),
(122, 440729, NULL, 563628, 'customer', 'from cutomer ali', '2023-02-01', '2023-02-01 04:56:40'),
(123, 440729, 2, NULL, 'user', 'hi', '2023-02-01', '2023-02-01 08:50:19'),
(124, 440729, NULL, 563628, 'customer', 'hello', '2023-02-01', '2023-02-01 08:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name_company` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `image`, `name_company`) VALUES
(1, '46781', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` bigint(20) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `name`, `email`, `phone`) VALUES
(450721, 'ahmed eid', 'ahmedeid@gmail.com', 0),
(485547, 'hadil moh', 'hadil@gmail.com', 0),
(563628, 'ali mohamed', 'hadilabogrin@gmail.com', 123456789),
(868600, 'mohamed', 'moha@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` bigint(20) NOT NULL,
  `department_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `status`) VALUES
(0, NULL, 0),
(1, 'Marckting', 0),
(2, 'sales', 1),
(3, 'HR', 1),
(4, 'IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `direct_manager`
--

CREATE TABLE `direct_manager` (
  `manager_id` bigint(20) NOT NULL,
  `manager_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direct_manager`
--

INSERT INTO `direct_manager` (`manager_id`, `manager_name`) VALUES
(0, ''),
(12345678, 'sajeda moh');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `n_id` int(11) NOT NULL,
  `n_code_tk` bigint(20) NOT NULL,
  `n_user_id` bigint(20) NOT NULL,
  `note` longtext NOT NULL,
  `n_commented_on` date NOT NULL DEFAULT current_timestamp(),
  `n_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`n_id`, `n_code_tk`, `n_user_id`, `note`, `n_commented_on`, `n_created_at`) VALUES
(9, 745452, 2, 'saja', '2023-01-30', '2023-01-30 18:16:16'),
(10, 745452, 2, 'HI', '2023-01-31', '2023-01-31 14:12:38'),
(11, 440729, 2, 'done', '2023-02-01', '2023-02-01 05:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `link` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `us_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `text`, `time`, `link`, `status`, `us_id`) VALUES
(57, 'A new ticket has arrived', '2023-02-01 09:18:38', 'http://localhost/ticketing/view_ticket.php?ticket_id=63', 1, 2),
(58, 'A new ticket has arrived', '2023-01-27 19:54:03', 'http://localhost/ticketing/view_ticket.php?ticket_id=63', 1, 3),
(59, 'A New Ticket Assigned To You,', '2023-01-27 19:55:42', 'http://localhost/ticketing/view_ticket.php?ticket_id=64', 1, 3),
(60, 'A New Ticket Assigned To You,', '2023-01-30 18:28:54', 'http://localhost/ticketing/view_ticket.php?ticket_id=63', 1, 2),
(61, 'A new ticket has arrived', '2023-01-28 07:30:52', 'http://localhost/ticketing/view_ticket.php?ticket_id=65', 1, 3),
(62, 'A new ticket has arrived', '2023-01-28 07:30:52', 'http://localhost/ticketing/view_ticket.php?ticket_id=65', 1, 5),
(63, 'The Ticket in a same request is closed', '2023-01-28 07:30:52', 'http://localhost/ticketing/view_ticket.php?ticket_id=64', 1, 3),
(64, 'A new ticket has arrived', '2023-01-28 08:03:10', 'http://localhost/ticketing/view_ticket.php?ticket_id=67', 1, 2),
(65, 'A new ticket has arrived', '2023-01-28 08:03:10', 'http://localhost/ticketing/view_ticket.php?ticket_id=67', 1, 3),
(66, 'A New Ticket Assigned To You,', '2023-01-28 11:46:02', 'http://localhost/ticketing/view_ticket.php?ticket_id=67', 1, 2),
(67, 'The Ticket in a same request is closed', '2023-01-30 18:22:42', 'http://localhost/ticketing/view_ticket.php?ticket_id=64', 1, 3),
(68, 'The Ticket in a same request is closed', '2023-01-31 14:01:22', 'http://localhost/ticketing/view_ticket.php?ticket_id=64', 1, 3),
(69, 'The Ticket in a same request is closed', '2023-01-31 14:01:22', 'http://localhost/ticketing/view_ticket.php?ticket_id=64', 1, 3),
(70, 'A new ticket has arrived', '2023-02-01 01:19:29', '', 1, 2),
(71, 'A new ticket has arrived', '2023-02-01 01:19:29', '', 1, 3),
(72, 'A New Ticket Assigned To You,', '2023-02-01 02:07:39', 'http://localhost/ticketing/view_ticket.php?ticket_id=69', 1, 2),
(73, 'New message', '2023-02-01 09:17:47', 'http://localhost/ticketing/view_ticket.php?ticket_id=', 1, 0),
(74, 'The Ticket in a same request is closed', '2023-02-02 07:29:45', 'http://localhost/ticketing/view_ticket.php?ticket_id=70', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) NOT NULL,
  `request_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_name`, `day`, `hour`, `priority`, `status`) VALUES
(11, 'r1', '1', '5', 'urgent', 1),
(12, 'r2', '2', '1', 'important', 1),
(13, 'r3', '0', '1', 'normal', 1),
(14, 'r4', '0', '1', 'normal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_department`
--

CREATE TABLE `request_department` (
  `department_id` bigint(20) DEFAULT NULL,
  `request_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_department`
--

INSERT INTO `request_department` (`department_id`, `request_id`) VALUES
(1, 11),
(2, 11),
(1, 12),
(2, 12),
(2, 13),
(3, 13),
(2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `request_user`
--

CREATE TABLE `request_user` (
  `user_id` bigint(20) DEFAULT NULL,
  `request_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_user`
--

INSERT INTO `request_user` (`user_id`, `request_id`) VALUES
(2, 12),
(3, 12),
(4, 12),
(2, 11),
(3, 11),
(3, 13),
(5, 13),
(3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `setting_joptitle`
--

CREATE TABLE `setting_joptitle` (
  `jopTitle_id` bigint(20) NOT NULL,
  `jopTitle_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_joptitle`
--

INSERT INTO `setting_joptitle` (`jopTitle_id`, `jopTitle_name`) VALUES
(1, 'employee'),
(2, 'Lime Manager'),
(3, 'HOF');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` bigint(20) NOT NULL,
  `date_t` date DEFAULT current_timestamp(),
  `code` bigint(20) NOT NULL,
  `request` bigint(20) NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On hold',
  `time` bigint(20) NOT NULL,
  `priority` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL DEFAULT 0,
  `customers` bigint(20) NOT NULL,
  `ticket_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `date_t`, `code`, `request`, `description`, `status`, `time`, `priority`, `department`, `user`, `customers`, `ticket_status`) VALUES
(63, '2023-01-27', 745452, 11, 'some thing ', 'In Progress', 29, 'urgent', 1, 2, 450721, 0),
(64, '2023-01-27', 745452, 11, 'some thing ', 'On hold', 29, 'urgent', 2, 3, 450721, 0),
(65, '2023-01-27', 500610, 13, 'some some', 'On hold', 1, 'normal', 2, 0, 868600, 0),
(66, '2023-01-27', 500610, 13, 'some some', 'On hold', 1, 'normal', 3, 0, 868600, 0),
(67, '2023-01-28', 893218, 11, 'some sole sloe', 'Spam', 29, 'urgent', 1, 2, 485547, 0),
(68, '2023-01-28', 893218, 11, 'some sole sloe', 'On hold', 29, 'urgent', 2, 0, 485547, 0),
(69, '2023-01-31', 440729, 11, 'sssssssssssss', 'Closed', 29, 'urgent', 1, 2, 563628, 0),
(70, '2023-01-31', 440729, 11, 'sssssssssssss', 'On hold', 29, 'urgent', 2, 0, 563628, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting_joptitle` bigint(20) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT 0,
  `Direct_manager` bigint(20) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `code` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_email`, `password`, `permission`, `setting_joptitle`, `department_id`, `Direct_manager`, `status`, `code`) VALUES
(0, 'unassigned', NULL, '', NULL, NULL, 0, 0, 0, '0'),
(2, 'sajamma', 'sajamma1998@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', 2, 1, 0, 1, '0'),
(3, 'hadeel', 'ha@gmail.com', '33248', 'user', 2, 2, 0, 1, '0'),
(4, 'mohammed', 'moh@gmail.com', '33248', 'user', 1, 1, 0, 1, '0'),
(5, 'mosab', 'mos@gmail.com', '33179', 'user', 1, 3, 0, 1, '0'),
(12345678, 'sajeda moh', 'hadeelbogreen@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'user', 1, 3, 2, 1, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `direct_manager`
--
ALTER TABLE `direct_manager`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `us_id` (`us_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_department`
--
ALTER TABLE `request_department`
  ADD KEY `department_id` (`department_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `request_user`
--
ALTER TABLE `request_user`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `setting_joptitle`
--
ALTER TABLE `setting_joptitle`
  ADD PRIMARY KEY (`jopTitle_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `customers` (`customers`),
  ADD KEY `request` (`request`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_joptitle` (`setting_joptitle`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `Direct_manager` (`Direct_manager`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966361;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `request_department`
--
ALTER TABLE `request_department`
  ADD CONSTRAINT `request_department_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `request_department_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);

--
-- Constraints for table `request_user`
--
ALTER TABLE `request_user`
  ADD CONSTRAINT `request_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `request_user_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
