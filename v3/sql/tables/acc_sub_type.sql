-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 01:14 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dims_latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_sub_type`
--

CREATE TABLE `acc_sub_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acc_type_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_sub_type`
--

INSERT INTO `acc_sub_type` (`id`, `name`, `acc_type_id`, `published`, `updatedate`) VALUES
(1, 'Current Asset', 3, 'yes', '2018-11-16 10:32:25'),
(2, 'Current Liability', 4, 'yes', '2018-11-16 10:32:45'),
(3, 'Fixed Asset', 3, 'yes', '2018-11-16 10:33:06'),
(4, 'Direct Expense', 1, 'yes', '2018-11-16 10:33:26'),
(5, 'Direct Income', 2, 'yes', '2018-11-16 10:33:40'),
(6, 'Indiect Expense', 1, 'yes', '2018-11-16 10:34:36'),
(7, 'Indirect Income', 2, 'yes', '2018-11-16 10:34:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
