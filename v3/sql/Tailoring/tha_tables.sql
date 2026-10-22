-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 11:28 AM
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
-- Database: `dims_tailor`
--

-- --------------------------------------------------------

--
-- Table structure for table `tha_customer`
--

CREATE TABLE `tha_customer` (
  `thacu_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_customer`
--

INSERT INTO `tha_customer` (`thacu_id`, `name`, `phone`, `address`, `date`) VALUES
(12, 'Jijo', '21321144144', 'ERNAKULAM', '2018-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `tha_items`
--

CREATE TABLE `tha_items` (
  `thait_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_items`
--

INSERT INTO `tha_items` (`thait_id`, `name`, `rate`, `details`) VALUES
(1, 'Pants', 250.00, ''),
(2, 'Shirt', 300.00, 'test'),
(3, 'Skirt', 250.00, 'kjkjkjjj'),
(4, 'Churidhaar', 200.00, 'kihikh');

-- --------------------------------------------------------

--
-- Table structure for table `tha_messurement`
--

CREATE TABLE `tha_messurement` (
  `mesid` int(11) NOT NULL,
  `messurement` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `crdtd` date NOT NULL,
  `updted` date NOT NULL,
  `del` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_messurement`
--

INSERT INTO `tha_messurement` (`mesid`, `messurement`, `item_id`, `cust_id`, `crdtd`, `updted`, `del`) VALUES
(1, '22x22 ', 1, 6, '2017-05-27', '2017-05-27', '0000-00-00'),
(2, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 2, 6, '2017-05-27', '2017-05-27', '0000-00-00'),
(3, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 1, 9, '2017-05-27', '2017-05-27', '0000-00-00'),
(4, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 3, 7, '2017-05-27', '2017-05-27', '0000-00-00'),
(5, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdfsds', 3, 10, '2017-05-27', '2017-05-27', '0000-00-00'),
(6, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 1, 10, '2018-08-08', '2018-08-08', '0000-00-00'),
(7, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 2, 10, '2017-05-27', '2017-05-27', '0000-00-00'),
(8, '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 1, 12, '2018-08-08', '2018-08-08', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tha_pickup`
--

CREATE TABLE `tha_pickup` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `free_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_pickup`
--

INSERT INTO `tha_pickup` (`id`, `code`, `Name`, `details`, `free_code`) VALUES
(1, 'Pickup', 'Pickup', '', ''),
(2, 'Details ', 'Details ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tha_sales`
--

CREATE TABLE `tha_sales` (
  `tms_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `dtime` varchar(10) NOT NULL,
  `invoice` varchar(20) NOT NULL,
  `status` smallint(6) NOT NULL,
  `ddate` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `customer` int(11) NOT NULL,
  `credtt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pstatus` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_sales`
--

INSERT INTO `tha_sales` (`tms_id`, `date`, `dtime`, `invoice`, `status`, `ddate`, `total`, `customer`, `credtt`, `pstatus`) VALUES
(1, '2017-05-27', '4', '2017-1', 0, '2017-05-27', '250.00', 6, '0000-00-00 00:00:00', 0),
(2, '2017-05-27', '12pm', '2017-2', 0, '2017-05-27', '250.00', 6, '2017-05-27 09:17:28', 0),
(3, '2017-05-01', '5', '2017-3', 0, '2017-05-01', '750.00', 6, '2017-05-27 09:27:26', 0),
(4, '2017-05-27', '11:30', '2017-4', 0, '2017-05-27', '500.00', 9, '2017-05-27 18:40:15', 0),
(5, '2017-05-27', '9', '2017-5', 0, '2017-05-27', '1500.00', 7, '2017-05-27 18:41:03', 0),
(6, '2017-05-27', '4', '2017-6', 0, '2017-05-27', '1100.00', 10, '2017-05-27 18:42:07', 0),
(7, '2017-05-27', '5', '2017-7', 0, '2017-05-27', '750.00', 10, '2017-05-27 19:24:18', 0),
(8, '2018-08-08', '12', '2017-8', 0, '2018-08-08', '250.00', 10, '2018-08-08 19:19:31', 0),
(9, '2018-08-08', '1', '2017-9', 0, '2018-08-08', '250.00', 12, '2018-08-08 21:34:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tha_sales_items`
--

CREATE TABLE `tha_sales_items` (
  `tmsi_id` int(11) NOT NULL,
  `tms_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `messurement` text NOT NULL,
  `extra` text NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `siz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_sales_items`
--

INSERT INTO `tha_sales_items` (`tmsi_id`, `tms_id`, `item_id`, `qty`, `rate`, `total`, `messurement`, `extra`, `published`, `siz_id`) VALUES
(1, 1, 1, '1.00', '250.00', '250.00', '22x22 ', 'kjfdsfs', 'yes', 0),
(2, 2, 1, '1.00', '250.00', '250.00', '22x22 ', 'fdsfdsfs', 'yes', 0),
(3, 3, 1, '3.00', '250.00', '750.00', '22x22 ', 'ffgfdgfd', 'no', 0),
(4, 3, 1, '3.00', '250.00', '750.00', '22x22 ', 'ffgfdgfd', 'no', 0),
(5, 3, 2, '3.00', '300.00', '900.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'ggdfg', 'no', 0),
(6, 3, 1, '3.00', '250.00', '750.00', '22x22 ', 'ffgfdgfd', 'yes', 0),
(7, 4, 1, '2.00', '250.00', '500.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'uugg ', 'yes', 1),
(8, 5, 3, '6.00', '250.00', '1500.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'jijijijij jjh', 'yes', 1),
(9, 6, 3, '1.00', '250.00', '250.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdfsds', 'ddde', 'no', 1),
(10, 6, 1, '2.00', '250.00', '500.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'ddddd', 'no', 1),
(11, 6, 2, '2.00', '300.00', '600.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'dddcd', 'no', 1),
(12, 6, 1, '2.00', '250.00', '500.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'ddddd', 'yes', 1),
(13, 6, 2, '2.00', '300.00', '600.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'dddcd', 'yes', 1),
(14, 7, 1, '3.00', '250.00', '750.00', 'dasdgsaiudas', 'gjdkf', 'no', 0),
(15, 7, 1, '3.00', '250.00', '750.00', 'dasdgsaiudas', 'gjdkf', 'yes', 0),
(16, 8, 1, '1.00', '250.00', '250.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'SASASA', 'yes', 1),
(17, 9, 1, '1.00', '250.00', '250.00', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', 'dsdd', 'yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tha_size`
--

CREATE TABLE `tha_size` (
  `siz_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `messurement` varchar(500) NOT NULL,
  `comments` varchar(1100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tha_size`
--

INSERT INTO `tha_size` (`siz_id`, `name`, `messurement`, `comments`) VALUES
(1, '22', '22x22xkjfkjdfhskjfhsd fsd fkjdsfhjsdhfjkhsdf', ''),
(2, '28', '22*ihuh 55*7', 'hgg'),
(3, '26', '56*7 56*7 ', 'dcfd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tha_customer`
--
ALTER TABLE `tha_customer`
  ADD PRIMARY KEY (`thacu_id`);

--
-- Indexes for table `tha_items`
--
ALTER TABLE `tha_items`
  ADD PRIMARY KEY (`thait_id`);

--
-- Indexes for table `tha_messurement`
--
ALTER TABLE `tha_messurement`
  ADD PRIMARY KEY (`mesid`);

--
-- Indexes for table `tha_pickup`
--
ALTER TABLE `tha_pickup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tha_sales`
--
ALTER TABLE `tha_sales`
  ADD PRIMARY KEY (`tms_id`);

--
-- Indexes for table `tha_sales_items`
--
ALTER TABLE `tha_sales_items`
  ADD PRIMARY KEY (`tmsi_id`);

--
-- Indexes for table `tha_size`
--
ALTER TABLE `tha_size`
  ADD PRIMARY KEY (`siz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tha_customer`
--
ALTER TABLE `tha_customer`
  MODIFY `thacu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tha_items`
--
ALTER TABLE `tha_items`
  MODIFY `thait_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tha_messurement`
--
ALTER TABLE `tha_messurement`
  MODIFY `mesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tha_pickup`
--
ALTER TABLE `tha_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tha_sales`
--
ALTER TABLE `tha_sales`
  MODIFY `tms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tha_sales_items`
--
ALTER TABLE `tha_sales_items`
  MODIFY `tmsi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tha_size`
--
ALTER TABLE `tha_size`
  MODIFY `siz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
