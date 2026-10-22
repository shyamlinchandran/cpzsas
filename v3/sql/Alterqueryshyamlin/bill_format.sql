-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2018 at 03:28 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dim`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_format`
--

CREATE TABLE `bill_format` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_format`
--

INSERT INTO `bill_format` (`id`, `name`, `code`, `published`) VALUES
(1, 'Bill1', 'bill', 'yes'),
(2, 'Bill2', 'bill1', 'yes'),
(3, 'Bill3', 'bill2', 'yes'),
(4, 'Bill4', 'bill3', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_format`
--
ALTER TABLE `bill_format`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_format`
--
ALTER TABLE `bill_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
