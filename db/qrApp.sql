-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2019 at 09:15 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_qrcode`
--

CREATE TABLE `ci_qrcode` (
  `id` int(11) NOT NULL,
  `url` varchar(222) DEFAULT NULL,
  `qr_image` varchar(222) DEFAULT NULL,
  `description` varchar(222) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_qrcode`
--

INSERT INTO `ci_qrcode` (`id`, `url`, `qr_image`, `description`, `created_at`, `modified_at`, `status`) VALUES
(2, 'unyscape.com', '45122049.png', NULL, '2019-09-25 12:25:48', NULL, 'Y'),
(3, 'google.com', '161336126.png', NULL, '2019-09-25 12:31:09', NULL, 'Y'),
(4, 'https://stackoverflow.com', '944118303.png', NULL, '2019-09-25 12:35:05', NULL, 'Y'),
(5, 'http://localhost/qrApp/site1', '1042064986.png', NULL, '2019-09-25 12:44:53', NULL, 'Y'),
(6, 'Http://localhost/qrApp/site2', '1169328998.png', NULL, '2019-09-25 12:45:01', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE `ci_users` (
  `id` int(11) NOT NULL,
  `name` varchar(222) DEFAULT NULL,
  `email` varchar(222) DEFAULT NULL,
  `password` varchar(222) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `address` varchar(222) DEFAULT NULL,
  `gender` varchar(222) DEFAULT NULL,
  `userType` enum('admin','user') NOT NULL DEFAULT 'user',
  `lastLogin` datetime DEFAULT NULL,
  `avatar` varchar(222) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`id`, `name`, `email`, `password`, `mobile`, `address`, `gender`, `userType`, `lastLogin`, `avatar`, `created_at`, `modified_at`, `status`) VALUES
(1, 'Santosh KUmar', 'santosh@unyscape.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'New delhi', NULL, 'admin', '2019-09-25 09:14:17', NULL, '2019-07-29 12:40:01', '2019-09-25 12:44:17', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_qrcode`
--
ALTER TABLE `ci_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_qrcode`
--
ALTER TABLE `ci_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
