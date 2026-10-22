-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2018 at 03:27 PM
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
-- Database: `dims_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `chr_baptism_register`
--

CREATE TABLE `chr_baptism_register` (
  `bap_id` int(11) NOT NULL,
  `bap_date` date NOT NULL,
  `hed_id` int(11) NOT NULL,
  `bap_dad` int(11) NOT NULL,
  `bap_mom` int(11) NOT NULL,
  `bap_in` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `blessed_name` varchar(250) NOT NULL,
  `blessed_details` varchar(1000) NOT NULL,
  `father_id` int(11) NOT NULL,
  `father_details` varchar(1000) NOT NULL,
  `bap_amount` decimal(10,3) NOT NULL,
  `bap_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_cremation_register`
--

CREATE TABLE `chr_cremation_register` (
  `crr_id` int(11) NOT NULL,
  `crr_death_date` date NOT NULL,
  `crr_date` date NOT NULL,
  `hed_id` int(11) NOT NULL,
  `fmm_id` int(11) NOT NULL,
  `fmm_age` int(11) NOT NULL,
  `crr_death_reason` varchar(500) NOT NULL,
  `crr_charges` decimal(10,3) NOT NULL,
  `father_id` int(11) NOT NULL,
  `father_details` varchar(1000) DEFAULT NULL,
  `crr_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_fathers`
--

CREATE TABLE `chr_fathers` (
  `ftr_id` int(11) NOT NULL,
  `ftr_name` varchar(250) NOT NULL,
  `ftr_details` varchar(1000) NOT NULL,
  `ftr_published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_marriage_register`
--

CREATE TABLE `chr_marriage_register` (
  `mrg_id` int(11) NOT NULL,
  `dio_id` int(11) NOT NULL,
  `parish_id` int(11) NOT NULL,
  `hed_id_a` int(11) NOT NULL,
  `hed_id_b` int(11) NOT NULL,
  `dada_id` int(11) NOT NULL,
  `dadb_id` int(11) NOT NULL,
  `moma_id` int(11) NOT NULL,
  `momb_id` int(11) NOT NULL,
  `bride_groom_id` int(11) NOT NULL,
  `bride_id` int(11) NOT NULL,
  `wedding_date` date NOT NULL,
  `witnessa` varchar(100) NOT NULL,
  `witnessb` varchar(100) NOT NULL,
  `father_id` int(11) NOT NULL,
  `father_details` varchar(1000) DEFAULT NULL,
  `mrg_amount` decimal(10,3) NOT NULL,
  `mrg_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_parish`
--

CREATE TABLE `chr_parish` (
  `par_id` int(11) NOT NULL,
  `par_name` varchar(500) NOT NULL,
  `par_isdefault` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chr_baptism_register`
--
ALTER TABLE `chr_baptism_register`
  ADD PRIMARY KEY (`bap_id`);

--
-- Indexes for table `chr_cremation_register`
--
ALTER TABLE `chr_cremation_register`
  ADD PRIMARY KEY (`crr_id`);

--
-- Indexes for table `chr_fathers`
--
ALTER TABLE `chr_fathers`
  ADD PRIMARY KEY (`ftr_id`);

--
-- Indexes for table `chr_marriage_register`
--
ALTER TABLE `chr_marriage_register`
  ADD PRIMARY KEY (`mrg_id`);

--
-- Indexes for table `chr_parish`
--
ALTER TABLE `chr_parish`
  ADD PRIMARY KEY (`par_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chr_baptism_register`
--
ALTER TABLE `chr_baptism_register`
  MODIFY `bap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chr_cremation_register`
--
ALTER TABLE `chr_cremation_register`
  MODIFY `crr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chr_fathers`
--
ALTER TABLE `chr_fathers`
  MODIFY `ftr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_marriage_register`
--
ALTER TABLE `chr_marriage_register`
  MODIFY `mrg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chr_parish`
--
ALTER TABLE `chr_parish`
  MODIFY `par_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
