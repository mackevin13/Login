-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 02:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `useraccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity`, `user_name`, `time_log`) VALUES
('Reset a Password', 'mc', '2021-04-28 23:34:39'),
('Reset a Password', 'mc', '2021-04-28 23:34:51'),
('Reset a Password', 'mc', '2021-04-29 19:37:55'),
('Reset a Password', 'mc', '2021-04-29 19:42:15'),
('Reset a Password', 'mc', '2021-04-29 19:43:06'),
('Reset a Password', 'mc', '2021-04-29 19:44:33'),
('Reset a Password', 'mc', '2021-04-29 19:45:49'),
('Reset a Password', 'mc', '2021-04-29 19:48:14'),
('Reset a Password', 'mc', '2021-04-30 22:47:50'),
('Reset a Password', 'mc', '2021-04-30 22:52:09'),
('Reset a Password', 'mc', '2021-05-03 00:14:03'),
('Logged In', 'mc', '2021-05-03 00:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `code` int(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`id`, `user_id`, `code`, `created_at`, `expiration`) VALUES
(1, 7, 494791, '2021-03-23 03:03:50', '2021-03-23 03:08:50'),
(2, 7, 574334, '2021-03-23 04:20:01', '2021-03-23 04:25:01'),
(3, 7, 515758, '2021-03-24 01:42:53', '2021-03-24 01:47:53'),
(4, 7, 118797, '2021-03-25 19:22:11', '2021-03-25 19:27:11'),
(5, 8, 463705, '2021-04-15 02:43:39', '2021-04-15 02:48:39'),
(27, 9, 504725, '2021-04-27 06:34:17', '2021-04-27 06:39:17'),
(28, 9, 361746, '2021-04-27 06:36:58', '2021-04-27 06:41:58'),
(29, 9, 237447, '2021-04-27 06:37:34', '2021-04-27 06:42:34'),
(30, 9, 113284, '2021-04-27 06:39:04', '2021-04-27 06:44:04'),
(31, 9, 700575, '2021-04-27 06:39:23', '2021-04-27 06:44:23'),
(32, 8, 656210, '2021-04-27 06:39:39', '2021-04-27 06:44:39'),
(33, 9, 376012, '2021-04-27 06:46:08', '2021-04-27 06:51:08'),
(34, 9, 455722, '2021-04-27 06:46:38', '2021-04-27 06:51:38'),
(35, 9, 141957, '2021-04-27 06:49:49', '2021-04-27 06:54:49'),
(36, 8, 877281, '2021-04-27 06:50:28', '2021-04-27 06:55:28'),
(37, 9, 815878, '2021-04-27 06:51:09', '2021-04-27 06:56:09'),
(38, 9, 881333, '2021-04-27 06:51:26', '2021-04-27 06:56:26'),
(39, 8, 648150, '2021-04-27 06:51:58', '2021-04-27 06:56:58'),
(40, 8, 556422, '2021-04-27 06:52:30', '2021-04-27 06:57:30'),
(41, 8, 502787, '2021-04-27 07:01:34', '2021-04-27 07:06:34'),
(42, 8, 920475, '2021-04-27 07:17:38', '2021-04-27 07:22:38'),
(43, 8, 387789, '2021-04-27 07:19:07', '2021-04-27 07:24:07'),
(44, 9, 497130, '2021-04-27 07:22:32', '2021-04-27 07:27:32'),
(45, 8, 366474, '2021-04-27 07:30:19', '2021-04-27 07:35:19'),
(46, 8, 246098, '2021-04-27 07:31:08', '2021-04-27 07:36:08'),
(47, 9, 646929, '2021-04-27 07:33:50', '2021-04-27 07:38:50'),
(48, 10, 810784, '2021-04-27 09:02:32', '2021-04-27 09:07:32'),
(49, 8, 637831, '2021-04-27 09:25:07', '2021-04-27 09:30:07'),
(50, 9, 165000, '2021-04-28 06:54:54', '2021-04-28 06:59:54'),
(51, 9, 891258, '2021-04-29 07:22:34', '2021-04-29 07:27:34'),
(52, 9, 566321, '2021-04-29 07:23:41', '2021-04-29 07:28:41'),
(53, 9, 299545, '2021-04-29 07:35:01', '2021-04-29 07:40:01'),
(54, 9, 509652, '2021-04-30 03:38:04', '2021-04-30 03:43:04'),
(55, 9, 927305, '2021-05-01 06:47:59', '2021-05-01 06:52:59'),
(56, 9, 920241, '2021-05-01 06:52:46', '2021-05-01 06:57:46'),
(57, 9, 474933, '2021-05-03 08:14:08', '2021-05-03 08:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `created_at`) VALUES
(1, 'mac', 'Mac222@gmail.com', 'a2fbc310fa0cc1bbd363436e8765b662', '2021-03-15 05:58:20.321600'),
(2, 'Mac', 'mackevin@gmail.com', 'a2fbc310fa0cc1bbd363436e8765b662', '2021-03-15 05:58:48.314655'),
(3, 'kevinpogi', 'qwe@gmail.com', 'a2fbc310fa0cc1bbd363436e8765b662', '2021-03-15 05:59:41.850493'),
(4, 'gerald', 'geraldpogi@gmail.com', 'a2fbc310fa0cc1bbd363436e8765b662', '2021-03-18 23:31:36.989654'),
(5, 'jpmb', 'johnpaulo.beyong0816@gmail.com', '2637a5c30af69a7bad877fdb65fbd78b', '2021-03-18 23:52:57.661382'),
(6, 'jpmbjpmb', 'johnpaulo.beyong0817@gmail.com', '$2y$10$lvC8djkrZkrccfW5n3jhIeWoV0GR679GDBolPcIAeCL9ZOGpt4Tt2', '2021-03-18 23:58:20.777856'),
(7, 'kwistin', 'kwistin@gmail.com', '$2y$10$.WgE2SceXiDnLXI4NS9vT.QW54rEqOS6pcZurkVmwMMGgJwkfoUuW', '2021-03-19 00:03:21.315934'),
(8, 'kwstn', 'mac@gmail.com', '$2y$10$UYgtq5Ay./iW29uzmeh/tuxn2l5iM8DckjTxzPpNJtcXEeigQGVnS', '2021-04-15 00:43:29.845698'),
(9, 'mc', 'mc@gmail.com', '$2y$10$egls61lTlaS/Ck/s8e4y3uizcdoQUdWWol7PqEE83PE6NU7F9pTTS', '2021-05-03 00:14:03.092976'),
(10, 'jobano', 'jobano@gmail.com', '$2y$10$/sPl6mcnccXVZ3.aJrpKCeXh8RLCp2/9/i1EP1ythiWxfRzdYP2tm', '2021-04-27 01:02:24.902979');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
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
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
