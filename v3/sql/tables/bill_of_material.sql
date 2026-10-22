-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 04:07 PM
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
-- Database: `dims_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_material_main`
--

CREATE TABLE `bill_material_main` (
  `bmm_id` int(11) NOT NULL,
  `main_item_id` int(11) NOT NULL,
  `bmm_quantity` decimal(10,3) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_material_sub`
--

CREATE TABLE `bill_material_sub` (
  `bmb_id` int(11) NOT NULL,
  `bmm_id` int(11) NOT NULL,
  `main_item_id` int(11) NOT NULL,
  `sub_item_id` int(11) NOT NULL,
  `bmb_quantity` decimal(10,3) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_material_main`
--
ALTER TABLE `bill_material_main`
  ADD PRIMARY KEY (`bmm_id`);

--
-- Indexes for table `bill_material_sub`
--
ALTER TABLE `bill_material_sub`
  ADD PRIMARY KEY (`bmb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_material_main`
--
ALTER TABLE `bill_material_main`
  MODIFY `bmm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill_material_sub`
--
ALTER TABLE `bill_material_sub`
  MODIFY `bmb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
