-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 01:13 PM
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
-- Table structure for table `acc_main`
--

CREATE TABLE `acc_main` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `acc_sub_type_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_main`
--

INSERT INTO `acc_main` (`id`, `name`, `code`, `acc_sub_type_id`, `published`, `updatedate`) VALUES
(1, 'Bank Accounts', '', 1, 'yes', '2018-11-16 06:05:48'),
(2, 'Bank OCC Accounts', '', 1, 'yes', '2018-11-16 06:05:48'),
(3, 'Bank OD Account', '', 1, 'yes', '2018-11-16 06:05:48'),
(4, 'Cash in Hand', '', 1, 'yes', '2018-11-16 06:05:48'),
(5, 'Current Asset', '', 1, 'yes', '2018-11-16 06:05:48'),
(6, 'Current Liability', '', 2, 'yes', '2018-11-16 06:05:48'),
(7, 'Deposits (Asset)', '', 3, 'yes', '2018-11-16 06:05:48'),
(8, 'Direct Exp', '', 4, 'yes', '2018-11-16 06:05:48'),
(9, 'Direct Income', '', 5, 'yes', '2018-11-16 06:05:48'),
(10, 'Duties and Taxes', '', 2, 'yes', '2018-11-16 06:05:48'),
(11, 'Indirect Expense', '', 6, 'yes', '2018-11-16 06:05:48'),
(12, 'Indirect Income', '', 7, 'yes', '2018-11-16 06:05:48'),
(13, 'Fixed asset', '', 3, 'yes', '2018-11-16 06:05:48'),
(14, 'Investments', '', 3, 'yes', '2018-11-16 06:05:48'),
(15, 'Loans and Advances(Asset)', '', 3, 'yes', '2018-11-16 06:05:48'),
(16, 'Loans (Liability)', '', 2, 'yes', '2018-11-16 06:05:48'),
(17, 'Mis Exp (Asset)', '', 1, 'yes', '2018-11-16 06:05:48'),
(18, 'Provisions', '', 2, 'yes', '2018-11-16 06:05:48'),
(19, 'Purchase', '', 4, 'yes', '2018-11-16 06:05:48'),
(20, 'Reserves and Surplus', '', 4, 'yes', '2018-11-16 06:05:48'),
(21, 'Sales Accounts', '', 5, 'yes', '2018-11-16 06:05:48'),
(22, 'Secured Loans', '', 5, 'yes', '2018-11-16 06:05:48'),
(23, 'Stock in Hand(Closing Stock)', '', 1, 'yes', '2018-11-16 06:05:48'),
(24, 'Sundry Creditor', '', 2, 'yes', '2018-11-16 06:05:48'),
(25, 'Sundry Debtor', '', 1, 'yes', '2018-11-16 06:05:48'),
(26, 'Suspense A/C', '', 1, 'yes', '2018-11-16 06:05:48'),
(27, 'Unsecured Loans', '', 1, 'yes', '2018-11-16 06:05:48'),
(28, 'Capital Account', '', 2, 'yes', '2018-11-16 06:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_main`
--
ALTER TABLE `acc_main`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_main`
--
ALTER TABLE `acc_main`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
