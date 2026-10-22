-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2018 at 06:09 PM
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
-- Table structure for table `acc_ageing`
--

CREATE TABLE `acc_ageing` (
  `age_id` int(11) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `tb_id` int(11) NOT NULL,
  `tb_name` varchar(20) NOT NULL,
  `tb_crdate` date NOT NULL,
  `tb_caldate` date NOT NULL,
  `led_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `credit` double(10,2) NOT NULL,
  `debit` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `status` int(2) NOT NULL,
  `last_paid` decimal(10,2) NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `pay_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_ledgers`
--

CREATE TABLE `acc_ledgers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ref_id` int(20) NOT NULL,
  `ref_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `acc_main_id` int(10) DEFAULT NULL,
  `openning_bal` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_ledgers`
--

INSERT INTO `acc_ledgers` (`id`, `name`, `code`, `ref_id`, `ref_code`, `is_default`, `acc_main_id`, `openning_bal`, `published`) VALUES
(1, 'Cash In Hand', 'Cash', 0, 'yes', 0, 4, '0.00', 'yes'),
(2, 'Tax 14.5', '14.5', 1, 'Tax', 1, 7, '0.00', 'yes'),
(3, 'Sales 14.5', '14.5', 1, 'Tax', 1, 9, '0.00', 'yes'),
(4, 'Purchase 14.5', '14.5', 1, 'Tax', 1, 11, '0.00', 'yes'),
(5, 'Tax 5', '5', 2, 'Tax', 1, 7, '0.00', 'yes'),
(6, 'Sales 5', '5', 2, 'Tax', 1, 9, '0.00', 'yes'),
(7, 'Purchase 5', '5', 2, 'Tax', 1, 11, '0.00', 'yes'),
(10, 'Purchase', 'Purchase', 0, 'yes', 0, 11, '0.00', 'yes'),
(11, 'Sales', 'Sales', 0, 'yes', 0, 9, '0.00', 'yes'),
(12, 'Round Off', 'Round Off', 0, 'yes', 0, 25, '0.00', 'yes'),
(13, 'Purchase Freight ', 'PFreight ', 0, 'yes', 0, 8, '0.00', 'yes'),
(14, 'Sales Freight', 'Freight', 0, 'yes', 0, 24, '0.00', 'yes'),
(15, 'Coolie', 'Coolie', 0, 'yes', 0, 12, '0.00', 'yes'),
(16, 'Discount ', 'Discount', 0, 'yes', 0, 9, '0.00', 'yes'),
(23, 'anver', 'est', 3, 'ref', 1, 34, '0.00', 'yes'),
(24, 'Commission Payable', 'Commission', 0, 'yes', 0, 34, '0.00', 'yes'),
(35, 'Tax 2', '2', 3, 'Tax', 1, 7, '0.00', 'yes'),
(36, 'Sales 2', '2', 3, 'Tax', 1, 9, '0.00', 'yes'),
(37, 'Purchase 2', '2', 3, 'Tax', 1, 11, '0.00', 'yes'),
(38, 'Tax gst', '1', 4, 'Tax', 1, 7, '0.00', 'yes'),
(39, 'Sales gst', '1', 4, 'Tax', 1, 9, '0.00', 'yes'),
(40, 'Purchase gst', '1', 4, 'Tax', 1, 11, '0.00', 'yes'),
(92, 'Jijo', '2132114414', 12, 'cus', 1, 1, '0.00', 'yes'),
(70, 'OCEAN FREIGHT DETAILS', 'OCEAN FREI', 2, 'cha', 1, 1, '0.00', 'yes'),
(71, 'Transport of goods in a Coastal Vessel', 'Transport ', 3, 'cha', 1, 1, '0.00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `acc_ledger_trans`
--

CREATE TABLE `acc_ledger_trans` (
  `tran_id` int(20) NOT NULL,
  `tb_id` int(20) DEFAULT NULL,
  `tb_name` varchar(15) DEFAULT NULL,
  `trn_tp` varchar(10) DEFAULT NULL,
  `voucher_no` varchar(50) DEFAULT NULL,
  `to_ledger_id` varchar(100) DEFAULT NULL,
  `ledger_id` int(20) DEFAULT NULL,
  `tran_amt` float DEFAULT NULL,
  `tran_date` date DEFAULT NULL,
  `tran_debit` decimal(10,2) DEFAULT '0.00',
  `tran_credit` decimal(10,2) DEFAULT '0.00',
  `tran_crtd_dt` datetime DEFAULT NULL,
  `tran_crtd_by` int(11) DEFAULT NULL,
  `tran_narration` varchar(50000) DEFAULT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_main`
--

CREATE TABLE `acc_main` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `acc_sub_type_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_main`
--

INSERT INTO `acc_main` (`id`, `name`, `code`, `acc_sub_type_id`, `published`) VALUES
(1, 'Sundry Debtors', '', 2, 'yes'),
(2, 'Salary Account ', '', 1, 'yes'),
(3, 'Bank A/C', '', 3, 'yes'),
(4, 'Cash A/C', '', 3, 'yes'),
(5, 'Sundry Creditors', '', 1, 'yes'),
(6, 'Commission Receivable(income)', '', 2, 'yes'),
(7, 'Tax A/C', '', 1, 'yes'),
(8, 'Purchase Charges', '', 1, 'yes'),
(9, 'Sales A/C', '', 3, 'yes'),
(10, 'Tax Account', '', 1, 'yes'),
(11, 'Purchase A/C', '', 1, 'yes'),
(12, 'Sale Other Charges', '', 3, 'yes'),
(13, 'CAPITAL ACCOUNT', '', 4, 'yes'),
(14, 'CURRENT ACCOUNT', '', 4, 'yes'),
(15, 'LOANS AND DEPOSIT', '', 4, 'yes'),
(16, 'OUTSTANDING LIABILITIES', '', 4, 'yes'),
(17, 'FIXED ASSETS', '', 3, 'yes'),
(18, 'INVESTMENTS', '', 3, 'yes'),
(19, 'DEPOSITS AND ADVANCES', '', 3, 'yes'),
(20, 'CLOSING STOCK', '', 3, 'yes'),
(21, 'TRAVELLING EXPENSE', '', 1, 'yes'),
(22, 'SUNDRY EXPENSES', '', 1, 'yes'),
(23, 'VEHICLE RUNNING & MAINTANCE', '', 1, 'yes'),
(24, 'FREIGHT CHARGES', '', 1, 'yes'),
(25, 'Round Off', '', 3, 'yes'),
(34, 'Commission Payable ', 'Commission', 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `acc_sub_type`
--

CREATE TABLE `acc_sub_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acc_type_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_sub_type`
--

INSERT INTO `acc_sub_type` (`id`, `name`, `acc_type_id`, `published`) VALUES
(1, 'Indirect Exp', 1, 'yes'),
(2, 'Asset', 3, 'yes'),
(3, 'Direct Expense', 1, 'yes'),
(4, 'indirect income', 2, 'yes'),
(5, 'SUNDRY CREDITORS', 4, 'yes'),
(6, 'LOANS AND DEPOSIT', 4, 'yes'),
(7, 'BANK LIABILITY', 4, 'yes'),
(8, 'OUTSTANDING LIABILITIES', 4, 'yes'),
(9, 'FIXED ASSETS', 3, 'yes'),
(10, 'INVESTMENTS', 3, 'yes'),
(11, 'SUNDRY DEBTORS', 3, 'yes'),
(12, 'DEPOSITS AND ADVANCES', 3, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE `acc_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`id`, `name`, `published`) VALUES
(1, 'Expence ', 'yes'),
(2, 'Income', 'yes'),
(3, 'Asset', 'yes'),
(4, 'Liability', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `Bid` int(11) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Barcode` varchar(50) NOT NULL,
  `Openstock` decimal(10,0) NOT NULL,
  `Prate` decimal(10,0) NOT NULL,
  `Whol_salerte` decimal(10,0) NOT NULL,
  `mrp` decimal(10,0) NOT NULL,
  `Item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`Bid`, `Code`, `Barcode`, `Openstock`, `Prate`, `Whol_salerte`, `mrp`, `Item`) VALUES
(3, '432', '234', '2345', '43', '34', '324', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bldgrp`
--

CREATE TABLE `bldgrp` (
  `BldId` int(5) NOT NULL,
  `BldGrp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bldgrp`
--

INSERT INTO `bldgrp` (`BldId`, `BldGrp`) VALUES
(1, 'terte'),
(2, 'retre');

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `Id` int(11) NOT NULL,
  `Bldgrp` varchar(10) NOT NULL,
  `Description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`Id`, `Bldgrp`, `Description`) VALUES
(1, 'A+', 'A positive'),
(2, 'B+', 'B positive');

-- --------------------------------------------------------

--
-- Table structure for table `chqdetails`
--

CREATE TABLE `chqdetails` (
  `chq_id` int(11) NOT NULL,
  `chq_trans` enum('Clearing','Issue') NOT NULL,
  `chq_date` date NOT NULL,
  `chq_no` varchar(20) NOT NULL,
  `chq_amount` decimal(10,2) NOT NULL,
  `chq_bank` varchar(200) NOT NULL,
  `chq_status` enum('Cleared','Submitted','Rejected') NOT NULL,
  `chq_frm` int(11) NOT NULL,
  `chq_to` int(11) NOT NULL,
  `chq_sdate` date NOT NULL,
  `chq_details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chqdetails`
--

INSERT INTO `chqdetails` (`chq_id`, `chq_trans`, `chq_date`, `chq_no`, `chq_amount`, `chq_bank`, `chq_status`, `chq_frm`, `chq_to`, `chq_sdate`, `chq_details`) VALUES
(1, 'Clearing', '0000-00-00', '1000', '20000.00', 'SBI', 'Cleared', 72, 42, '2017-07-15', 'test'),
(2, 'Clearing', '0000-00-00', '234234', '234234.00', '234324', 'Cleared', 42, 72, '2017-07-28', '324324'),
(3, 'Clearing', '0000-00-00', '123213', '120.00', 'SBI', 'Cleared', 72, 42, '2017-07-15', 'sert');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `header` varchar(300) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `menutype` int(11) NOT NULL,
  `company_master` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cst` varchar(19) NOT NULL,
  `statecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `name`, `logo`, `header`, `address`, `phone`, `tin`, `details`, `menutype`, `company_master`, `email`, `cst`, `statecode`) VALUES
(1, 'LAKSHMI TRADERS', '6a461-win_20161231_11_29_35_pro.jpg', '6ec7e-win_20161231_11_29_35_pro.jpg', 'Near Aniyal Bridge Edavanakad Ernakulam - 682502<br/>    Email: lakshmitradersekd@gmail.com<br/>    Phone : 9846771399 Resi: 0484 2505716 ', '9846771399', '32FDGPS1606J1ZK', 'tetewt', 1, 2, 'lakshmitradersekd@gmail.com', 'Kerala', 32);

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `id` int(11) NOT NULL,
  `grp_name` varchar(20) NOT NULL,
  `no_sub_company` int(11) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `end_date` date NOT NULL,
  `subcription` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `grp_name`, `no_sub_company`, `contact_person`, `contact_number`, `address`, `created_date`, `created_by`, `end_date`, `subcription`) VALUES
(1, 'ss', 4, 'sss', 'sss', 'ss', '2017-07-22', 'ss', '2017-07-22', 1),
(2, 'qq', 3, 'dfdfd', 'ddddd', 'dd', '1997-05-22', '22/05/1997', '1997-05-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `comset_id` int(20) NOT NULL,
  `com_id` int(20) NOT NULL,
  `comset_statecode` varchar(10) NOT NULL,
  `comset_currency` varchar(300) NOT NULL,
  `comset_currrncy_symbol` varchar(3) NOT NULL,
  `comset_account_no` varchar(20) NOT NULL,
  `comset_ifsccode` varchar(11) NOT NULL,
  `comset_bank` varchar(500) NOT NULL,
  `comset_declaration` varchar(500) NOT NULL,
  `comset_state` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`comset_id`, `com_id`, `comset_statecode`, `comset_currency`, `comset_currrncy_symbol`, `comset_account_no`, `comset_ifsccode`, `comset_bank`, `comset_declaration`, `comset_state`) VALUES
(1, 1, '32', '324', '324', '32432', '32432', '32432', '32423', '23432');

-- --------------------------------------------------------

--
-- Table structure for table `company_subcription`
--

CREATE TABLE `company_subcription` (
  `id` int(11) NOT NULL,
  `subcription_name` varchar(50) NOT NULL,
  `subcription_version` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_subcription`
--

INSERT INTO `company_subcription` (`id`, `subcription_name`, `subcription_version`, `details`, `created_date`, `created_by`) VALUES
(1, 'www', 'www', 'wwww', '2017-07-25', 'wwww'),
(2, 'gygy', 'ttft', 'tftf', '2017-07-22', 'tftf'),
(3, 'ygygy', 'gygyg', 'ygygy', '2017-07-22', 'ygy');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `discription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`id`, `type`, `discription`) VALUES
(1, 'General', ''),
(2, 'Inventory', ''),
(3, '1', ''),
(4, 'qq', ''),
(5, 'Test', '');

-- --------------------------------------------------------

--
-- Table structure for table `donners`
--

CREATE TABLE `donners` (
  `Id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Age` int(11) NOT NULL,
  `Bldgrp` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Occupation` varchar(30) NOT NULL,
  `Phon` varchar(13) NOT NULL,
  `Mob` varchar(13) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `weight` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donners`
--

INSERT INTO `donners` (`Id`, `Name`, `Age`, `Bldgrp`, `Address`, `Occupation`, `Phon`, `Mob`, `Email`, `weight`) VALUES
(1, 'Akh', 23, 2, 'asd', 'study', '12232434454', '1234324324', 'asda@gmai.c', '23'),
(2, 'asd', 34, 2, 'sdef', 'dsf', '343432535435', '453453453454', 'edrf@g.c', 'df'),
(3, 'ajk', 23, 2, 'asdasdf', 'job', '12344554565', '32445232342', 'd@g.c', '23');

-- --------------------------------------------------------

--
-- Table structure for table `fin_year`
--

CREATE TABLE `fin_year` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fin_year`
--

INSERT INTO `fin_year` (`id`, `name`, `start_date`, `end_date`, `published`) VALUES
(3, '2016-2017', '2016-03-01', '2017-03-31', '');

-- --------------------------------------------------------

--
-- Table structure for table `hsncode`
--

CREATE TABLE `hsncode` (
  `hsnid` int(11) NOT NULL,
  `hsncode` varchar(200) NOT NULL,
  `published` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hsncode`
--

INSERT INTO `hsncode` (`hsnid`, `hsncode`, `published`) VALUES
(1, '071320', 0),
(2, '071331', 0),
(3, '12075090', 0),
(4, '071390', 0),
(5, '071310', 0),
(6, '0713', 0),
(7, '1101', 0),
(8, '1103', 0),
(9, '1701', 0),
(10, '1207', 0),
(11, '0904', 0),
(12, '19041020', 0),
(13, '1202', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ims_area`
--

CREATE TABLE `ims_area` (
  `id` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_area`
--

INSERT INTO `ims_area` (`id`, `area`, `details`) VALUES
(1, 'Kaloor', 'zz');

-- --------------------------------------------------------

--
-- Table structure for table `ims_driver`
--

CREATE TABLE `ims_driver` (
  `Id` int(11) NOT NULL,
  `Driver_name` varchar(50) NOT NULL,
  `licence_no` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Mobile` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_driver`
--

INSERT INTO `ims_driver` (`Id`, `Driver_name`, `licence_no`, `Address`, `Mobile`) VALUES
(1, 'sabu', '12345678', 'asdssfsd', 24325435435435),
(2, 'Driver', '65321', 'asd', 343223424243);

-- --------------------------------------------------------

--
-- Table structure for table `ims_godown`
--

CREATE TABLE `ims_godown` (
  `id` int(11) NOT NULL,
  `godown_name` varchar(100) NOT NULL,
  `godown_address` varchar(200) NOT NULL,
  `godown_contactno` varchar(13) NOT NULL,
  `godown_contact_person` varchar(50) NOT NULL,
  `company` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_godown`
--

INSERT INTO `ims_godown` (`id`, `godown_name`, `godown_address`, `godown_contactno`, `godown_contact_person`, `company`) VALUES
(1, 'Dimind Innovation', 'Pookkatupadi', '7559831834', '', 1),
(2, 'aa', 'aa', '2365987896', '', 2),
(3, 'Godown1', 'yyyyy', '7878787878', 'gyfygyg', 1),
(4, 'Godown2', 'ijijijij', '88888888', 'juhuhuhu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ims_pickup`
--

CREATE TABLE `ims_pickup` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `free_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_pickup`
--

INSERT INTO `ims_pickup` (`id`, `code`, `Name`, `details`, `free_code`) VALUES
(1, 'Pickup', 'Pickup', '', ''),
(2, 'Details ', 'Details ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ims_route`
--

CREATE TABLE `ims_route` (
  `id` int(11) NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_route`
--

INSERT INTO `ims_route` (`id`, `route_name`, `area`) VALUES
(1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ims_vehicle`
--

CREATE TABLE `ims_vehicle` (
  `Id` int(11) NOT NULL,
  `Vehicle_num` varchar(25) NOT NULL,
  `driver` int(11) NOT NULL,
  `Freecode` int(11) NOT NULL,
  `Freecode2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_vehicle`
--

INSERT INTO `ims_vehicle` (`Id`, `Vehicle_num`, `driver`, `Freecode`, `Freecode2`) VALUES
(1, 'kl14/h/2345', 1, 0, 0),
(2, '123', 2, 2, 0),
(3, 'kl59/j/5643', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `item_category_id` int(10) DEFAULT NULL,
  `item_group_id` int(11) NOT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `open_stock` decimal(10,2) DEFAULT NULL,
  `current_stock` decimal(10,2) DEFAULT NULL,
  `reorder_point` int(11) NOT NULL,
  `prate` decimal(10,2) DEFAULT NULL,
  `srate` decimal(10,2) DEFAULT NULL,
  `MRP` int(11) NOT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `hsncode` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_type_id` int(10) DEFAULT NULL,
  `item_category_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `name`, `item_type_id`, `item_category_id`, `published`) VALUES
(1, 'Food', 3, NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item_godown`
--

CREATE TABLE `item_godown` (
  `id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_group`
--

CREATE TABLE `item_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_group`
--

INSERT INTO `item_group` (`id`, `name`, `discount`, `published`) VALUES
(1, '5 %', 0, 'yes'),
(2, '0', 0, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item_ledger`
--

CREATE TABLE `item_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `open_stock` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT NULL,
  `godown` int(11) NOT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_type` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trans_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `trans_id` int(10) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `MRP` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `published`) VALUES
(1, 'Sales', 'yes'),
(2, 'Puchase', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `value`, `details`, `published`) VALUES
(3, 'cash', '1', 'cash Account', 'yes'),
(4, '2fapay', 'true', 'Two factor authentication for payment', 'yes'),
(5, 'paycode', 'PAY-250', 'Payment voucher code plus number', 'yes'),
(6, 'joucode', 'JOU-358', 'Journel voucher code plus number', 'yes'),
(7, 'reccode', 'REC-258', 'Receipt code plus number', 'yes'),
(8, 'sales8', 'S8-200', 'sales 8b bill number', 'yes'),
(9, 'estimate', 'EST-100', 'sales 8b bill number', 'yes'),
(10, 'sales8b', 'S8B-200', 'sales 8b bill number', 'yes'),
(11, 'sales_return', 'SR-200', 'sales_return', 'yes'),
(12, 'dprate', '1', 'default purchase rate show 1 and 0 shows code ', 'yes'),
(13, 'paper', 'A4', 'Default paper size', 'yes'),
(14, 'paperorient', 'P', 'paperorient potrait p', 'yes'),
(15, 'grpdiscount', '1', '0 if not avilable', 'yes'),
(16, 'isbatch', '0', 'Enable Batch', 'yes'),
(17, 'sales', 'BIL-1', 'sales', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `member_cate_id` int(10) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address_line1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `phone`, `member_cate_id`, `dob`, `email`, `address_line1`, `address_line2`, `details`, `published`) VALUES
(1, 'Appu', '7559831834', 0, '0000-00-00', 'shyamappu00@gmail.com', 'kuniyil house', 'Kuniyil vayalombran  rshtftytf fgtyftyjth tftyfytf', 'player', 'yes'),
(2, 'rdyrfd', '9995655343', 0, '0000-00-00', 'dgfdfv@ftyfuy.cgh', 'fdrtdrtfvg ttttftytytg ygitfg ', 'dsfdfg hftguyg', 'tyff', 'yes'),
(3, 'arjun', '6789654367', 0, '0000-00-00', 'adi@gmail.com', '456gugug', 'hzijzkk', 'Manger', 'yes'),
(4, 'ertterw', '1234567890', 0, '0000-00-00', 'erewrew@iuertew.lrithe', 'fdsfdsfd jhaf uadsgf asfh ashdf asfas fasufasdfas dfugsafas dfgsd fsadfsadhfguadsh gfuasfasf sadfg adsfgds fhghdsfghadsgf shfysdf dsfdsgfys fsdfgsdfias', 'werewrfft', 'ewrewrooehr', 'yes'),
(5, 'dfdskkfsd', '3123131232138', 0, '0000-00-00', 'jijodileep@gmail.com', 'jhfhjgj', 'jkjhjkhkjh', 'kjjkgjkgk', 'yes'),
(6, 'jijodileep', '97979070909', 1, '0000-00-00', 'sdfdsfds@gman.sadj', 'jjcjahdlkashkd', 'dsfdsfds', 'dsfdsfdsfdsf', 'yes'),
(7, 'asdadsadsa', '1233212345', 2, '2017-03-18', 'asdsadsa@dsfds.asda', 'ewrwerewr', 'dsadsad', 'wrewrewr', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `member_category`
--

CREATE TABLE `member_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_category`
--

INSERT INTO `member_category` (`id`, `name`, `rank`, `published`) VALUES
(1, 'wqewqe', 2, 'yes'),
(2, 'type1', 1, 'yes'),
(3, 'type3', 3, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `member_family`
--

CREATE TABLE `member_family` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `member_type_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_family`
--

INSERT INTO `member_family` (`id`, `name`, `member_type_id`, `member_id`, `email`, `phone`, `details`, `published`) VALUES
(18, 'Test2', 4, 12, 'ksk@gmail.com', '', '   hdfbj   ', 'yes'),
(4, 'Test', 4, 11, '', '', 'Test', 'yes'),
(5, 'Test2', 4, 11, 'ksk@gmail.com', '', 'hdfbj', 'yes'),
(17, 'hfghfhfgh', 5, 12, '', '', '  sdgdsfgdsgdfgdf  ', 'yes'),
(21, 'test', 5, 15, '', '12354698765', ' 2534 ', 'yes'),
(22, 'maly', 4, 15, '', '', ' 123 ', 'yes'),
(50, 'rdtftyhg', 4, 1, 'hjghjghjv@gmail.com', '123456', '      ', 'yes'),
(39, 'tyt', 5, 2, 'tfytft@yugyu.ftyf', '7559831834', '   ygyug   ', 'yes'),
(51, 'kkp', 5, 1, 'hjghjghjv@gmail.com', 'kkl;123456', '      ', 'yes'),
(44, 'aliya', 5, 3, 'aliya@gmail.com', 'ssssss', ' Visitor ', 'yes'),
(47, 'jijo', 4, 4, '', 'ertjert', ' rtretre ', 'yes'),
(53, 'hghgghk', 8, 5, '', '', ' ffuyfiytiuiutui ', 'yes'),
(54, 'sdasdsads', 4, 6, '', '', 'dasdsadsad', 'yes'),
(55, 'werwerewrewrw', 8, 7, '', '', 'werewrewr', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`id`, `name`, `published`) VALUES
(3, 'Main Member', ''),
(4, 'Child', 'yes'),
(5, 'Wife', ''),
(8, 'Uncle', 'yes'),
(9, 'Cousin', 'yes'),
(10, 'Neighboue', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `ListName` varchar(500) NOT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `ListName`, `Url`, `parent`, `icon`, `published`) VALUES
(9, 'Members', 'main/members/listall', 14, '', 'yes'),
(10, 'Member Category', 'masters/member_category', 14, '', 'yes'),
(11, 'units', 'masters/units', 15, '', 'yes'),
(12, 'Supplier', 'masters/supplier', 15, '', 'yes'),
(13, 'Accounts', '', 0, '', 'yes'),
(15, 'Masters', '', 0, '', 'yes'),
(18, 'Type', 'masters/roomtype', 16, '', 'yes'),
(19, 'Sub Type', 'accounts/accsubtype', 13, '', 'yes'),
(20, 'Type', 'accounts/acctype', 13, '', 'yes'),
(21, 'Main Ledgers', 'accounts/mainledgers', 13, '', 'yes'),
(22, 'Ledgers', 'accounts/ledgers', 13, '', 'yes'),
(23, 'Finacial Years', 'accounts/finacial', 13, '', 'yes'),
(24, 'Item Management', '', 0, '', 'yes'),
(25, 'Item Type', 'items\\itemtype', 24, '', 'yes'),
(26, 'Category', 'items\\itemcategory', 24, '', 'yes'),
(29, 'Transactions', '', 0, '', 'yes'),
(30, 'Payment Vouchers', 'transaction\\vouchers\\listall\\payment', 29, '', 'yes'),
(31, 'Journal Vouchers', 'transaction\\vouchers\\listall\\journal', 29, '', 'yes'),
(32, 'Receipt Vouchers', 'transaction\\vouchers\\listall\\receipt', 29, '', 'yes'),
(33, 'Purchase', 'transaction/purchase/listall', 29, '', 'yes'),
(35, 'Member Type', 'masters/member_type', 14, '', 'yes'),
(36, 'Reports', '', 0, '', 'yes'),
(37, 'Leadger', 'reports/accounts/leadger', 36, '', 'yes'),
(41, 'Cash Book', 'reports/accounts/cashbook', 36, '', 'yes'),
(42, 'Day Book', 'reports/accounts/daybook', 36, '', 'yes'),
(44, 'Estimate', 'transaction/sales/listall/estimate', 29, '', 'yes'),
(46, 'Customers', 'masters/customers', 15, '', 'yes'),
(48, 'Sales', 'transaction/sales/listall/sales', 29, '', 'yes'),
(49, 'Stock Leadger', 'reports/stock/leadger', 36, '', 'yes'),
(50, 'Settings', 'dashboard/main#', 0, '', 'yes'),
(52, 'Sales Return', 'transaction/sales/listall/sales_return', 29, '', 'yes'),
(53, 'Check List', 'reports/accounts/checklist', 36, '', 'yes'),
(55, 'Item Group', 'items\\itemgroup', 24, '', 'yes'),
(58, 'Sales Items', 'master\\items\\list_all\\1', 24, '', 'yes'),
(107, 'rooms', 'grocery/room_categories', 38, '', 'yes'),
(109, 'Menus', 'masters/menu', 50, '', 'yes'),
(110, 'hsn code', 'masters/hsncode', 50, '', 'yes'),
(111, 'Company', 'masters/company', 50, '', 'yes'),
(113, 'GST', 'masters/gst', 15, '', 'yes'),
(114, 'Purchase Items', 'master\\items\\list_all\\2', 24, '', 'yes'),
(115, 'Product Create', 'master/pstock/list_all', 0, '', 'yes'),
(116, 'Purchase Report', 'reports/purchase/purchasereport', 36, '', 'yes'),
(117, 'Sales Reports', 'reports/Sales/salesreport', 36, '', 'yes'),
(118, 'Item Stock', 'reports/stock/itemstock', 36, '', 'yes'),
(119, 'Invoice Wise Report', 'reports/invoice/invoicereport', 36, '', 'yes'),
(120, 'Item Wise Report', 'reports/item/itemereport', 36, '', 'yes'),
(121, 'Purchase Wise Report', 'reports/purchase/purchasereport', 36, '', 'yes'),
(122, 'Tailoring', NULL, 0, '', 'yes'),
(123, 'Item - Tailoring', 'master/thaitems/items', 122, '', 'yes'),
(124, 'Sales - Tailoring', 'tai/trans/listall', 122, '', 'yes'),
(125, 'Customer - Tailoring', 'master/thaitems/customers', 122, '', 'yes'),
(126, 'Size -Tailoring', 'master/thaitems/size', 122, '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `menutocmpnytype`
--

CREATE TABLE `menutocmpnytype` (
  `menuid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menutocmpnytype`
--

INSERT INTO `menutocmpnytype` (`menuid`, `typeid`) VALUES
(13, 2),
(24, 2),
(36, 2),
(50, 2),
(13, 3),
(24, 3),
(29, 3),
(87, 3),
(15, 4),
(29, 4),
(36, 4),
(13, 1),
(24, 1),
(29, 1),
(36, 1),
(15, 5),
(24, 5),
(29, 5),
(75, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu_to_company`
--

CREATE TABLE `menu_to_company` (
  `company_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `details` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_to_user`
--

CREATE TABLE `menu_to_user` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_write` tinyint(1) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_to_user`
--

INSERT INTO `menu_to_user` (`id`, `menu_id`, `user_id`, `is_read`, `is_write`, `is_delete`) VALUES
(112, 15, 0, 0, 0, 0),
(113, 11, 0, 1, 0, 0),
(114, 13, 0, 0, 0, 0),
(115, 23, 0, 1, 1, 1),
(116, 21, 0, 1, 1, 1),
(117, 19, 0, 1, 1, 1),
(118, 22, 0, 1, 1, 1),
(119, 20, 0, 1, 1, 1),
(120, 61, 0, 0, 0, 0),
(121, 64, 0, 1, 1, 1),
(122, 62, 0, 1, 1, 1),
(123, 63, 0, 1, 1, 1),
(137, 15, 1, 0, 0, 0),
(138, 11, 1, 1, 0, 0),
(139, 24, 1, 0, 0, 0),
(140, 25, 1, 1, 1, 1),
(141, 58, 1, 1, 1, 1),
(142, 26, 1, 1, 1, 1),
(143, 55, 1, 1, 1, 1),
(144, 13, 1, 0, 0, 0),
(145, 23, 1, 1, 1, 1),
(146, 21, 1, 1, 1, 1),
(147, 19, 1, 1, 1, 1),
(148, 22, 1, 1, 1, 1),
(149, 20, 1, 1, 1, 1),
(150, 61, 1, 0, 0, 0),
(151, 64, 1, 1, 0, 0),
(152, 36, 1, 0, 0, 0),
(153, 53, 1, 1, 1, 0),
(212, 24, 2, 0, 0, 0),
(213, 26, 2, 1, 1, 1),
(214, 55, 2, 1, 1, 1),
(215, 25, 2, 1, 1, 1),
(216, 58, 2, 1, 1, 1),
(217, 13, 2, 0, 0, 0),
(218, 21, 2, 1, 1, 1),
(219, 19, 2, 1, 1, 1),
(220, 22, 2, 1, 1, 1),
(221, 20, 2, 1, 1, 1),
(222, 23, 2, 1, 1, 1),
(223, 29, 2, 0, 0, 0),
(224, 32, 2, 1, 1, 1),
(225, 30, 2, 1, 1, 1),
(226, 47, 2, 1, 1, 1),
(227, 52, 2, 1, 1, 1),
(228, 33, 2, 1, 1, 1),
(229, 31, 2, 1, 1, 1),
(230, 48, 2, 1, 1, 1),
(231, 44, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prd_stock`
--

CREATE TABLE `prd_stock` (
  `id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `from_godown` int(11) NOT NULL,
  `to_godown` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prd_stock`
--

INSERT INTO `prd_stock` (`id`, `created_date`, `product_id`, `total_quantity`, `published`, `from_godown`, `to_godown`) VALUES
(1, '2017-11-20', 45, 50, 'yes', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prd_stockitem`
--

CREATE TABLE `prd_stockitem` (
  `id` int(11) NOT NULL,
  `stock_prod_id` int(11) NOT NULL,
  `sal_item_id` int(11) NOT NULL,
  `pur_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prd_stockitem`
--

INSERT INTO `prd_stockitem` (`id`, `stock_prod_id`, `sal_item_id`, `pur_item_id`, `quantity`, `total`, `published`) VALUES
(1, 1, 44, 45, 50, 10, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `cash_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `rdate` date NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `other` decimal(10,2) DEFAULT NULL,
  `freight` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(10,2) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `narration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `type` enum('purchase','porder') COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `base_unit_id` int(10) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `ref_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `details` varchar(300) NOT NULL,
  `percent_type` tinyint(1) NOT NULL,
  `percent` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`ref_id`, `name`, `address`, `details`, `percent_type`, `percent`) VALUES
(1, 'Midhun', 'Test', 'One ', 1, 34),
(2, 'Mathayi', 'mathis', '', 1, 10),
(3, 'anver', 'est', 'sdfdsfdsf', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `room_type_id` int(10) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `no`, `short`, `tax_id`, `room_type_id`, `price`, `published`) VALUES
(4, '123', 'jkjk', 4, 5, '1500.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE `room_booking` (
  `book_sub_id` int(20) NOT NULL,
  `book_id` int(20) DEFAULT NULL,
  `room_category_id` int(10) DEFAULT NULL,
  `member_category_id` int(10) DEFAULT NULL,
  `room_id` int(10) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `norooms` int(5) DEFAULT NULL,
  `no_days` int(10) DEFAULT NULL,
  `taxp` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `book_type` varchar(3) DEFAULT NULL COMMENT 'booking,checkin,checkout'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`book_sub_id`, `book_id`, `room_category_id`, `member_category_id`, `room_id`, `rate`, `norooms`, `no_days`, `taxp`, `tax`, `total`, `discount`, `book_type`) VALUES
(1, 16, 5, 3, NULL, '1500.00', 36, NULL, '20.01', '10803.24', '64803.24', '0.00', NULL),
(2, 17, 5, 3, 4, '1500.00', 69, NULL, '20.00', '20700.00', '124200.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_book_master`
--

CREATE TABLE `room_book_master` (
  `book_id` int(20) NOT NULL,
  `book_type` varchar(3) DEFAULT NULL COMMENT 'booking,checkin,checkout',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `booked_date` date DEFAULT NULL,
  `no_days` int(10) DEFAULT NULL,
  `no_adults` int(10) DEFAULT NULL,
  `no_childers` int(10) DEFAULT NULL,
  `no_extrabed` int(10) DEFAULT NULL,
  `member_id` int(10) DEFAULT NULL,
  `total_gt` decimal(10,2) DEFAULT '0.00',
  `total_tax` decimal(10,2) DEFAULT '0.00',
  `total_other` decimal(10,2) DEFAULT '0.00',
  `round` decimal(10,2) DEFAULT '0.00',
  `discount` decimal(10,2) DEFAULT '0.00',
  `tran_crtd_dt` datetime DEFAULT NULL,
  `tran_crtd_by` int(11) DEFAULT NULL,
  `tran_narration` varchar(50000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_book_master`
--

INSERT INTO `room_book_master` (`book_id`, `book_type`, `start_date`, `end_date`, `booked_date`, `no_days`, `no_adults`, `no_childers`, `no_extrabed`, `member_id`, `total_gt`, `total_tax`, `total_other`, `round`, `discount`, `tran_crtd_dt`, `tran_crtd_by`, `tran_narration`) VALUES
(1, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '5228.00', '900.00', '485.00', '-0.15', '656.85', '2017-03-17 07:26:10', NULL, NULL),
(2, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '64470.00', '10800.00', '36.00', '0.00', '366.00', '2017-03-17 07:27:40', NULL, NULL),
(3, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '64470.00', '10800.00', '36.00', '0.00', '366.00', '2017-03-17 07:29:34', NULL, NULL),
(4, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '64470.00', '10800.00', '36.00', '0.00', '366.00', '2017-03-17 07:29:39', NULL, NULL),
(5, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '64470.00', '10800.00', '36.00', '0.00', '366.00', '2017-03-17 07:29:40', NULL, NULL),
(6, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 1, 3, 3, 0, 1, '64470.00', '10800.00', '36.00', '0.00', '366.00', '2017-03-17 07:29:40', NULL, NULL),
(7, 'boo', '0000-00-00', '0000-00-00', '2017-03-17', 0, 36, 36, 0, 1, '65135.00', '10801.94', '369.00', '0.06', '36.00', '2017-03-17 07:30:25', NULL, NULL),
(8, 'boo', '2017-03-17', '2017-03-18', '2017-03-17', 1, 3, 3, 0, 2, '61173.00', '10801.98', '36.00', '0.48', '3665.46', '2017-03-17 07:32:11', NULL, NULL),
(9, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 2, 0, 0, 1, '5000.00', '900.00', '89.00', '0.00', '489.00', '2017-03-17 17:17:57', NULL, NULL),
(10, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 2, 0, 0, 1, '5000.00', '900.00', '89.00', '0.00', '489.00', '2017-03-17 17:18:10', NULL, NULL),
(11, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 2, 0, 0, 1, '5000.00', '900.00', '89.00', '0.00', '489.00', '2017-03-17 17:18:44', NULL, NULL),
(12, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 1, 1, 0, 1, '64821.00', '10803.24', '84.00', '-0.24', '66.00', '2017-03-17 17:19:49', NULL, NULL),
(13, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 1, 1, 0, 1, '64821.00', '10803.24', '84.00', '-0.24', '66.00', '2017-03-17 17:19:51', NULL, NULL),
(14, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 1, 1, 0, 1, '64821.00', '10803.24', '84.00', '-0.24', '66.00', '2017-03-17 17:20:32', NULL, NULL),
(15, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 1, 1, 0, 1, '64821.00', '10803.24', '84.00', '-0.24', '66.00', '2017-03-17 17:21:09', NULL, NULL),
(16, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 1, 1, 0, 1, '64821.00', '10803.24', '84.00', '-0.24', '66.00', '2017-03-17 17:21:50', NULL, NULL),
(17, 'boo', '2017-03-18', '2017-03-19', '2017-03-17', 1, 2, 2, 0, 1, '123570.00', '20700.00', '36.00', '0.00', '666.00', '2017-03-17 17:26:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `name`, `published`) VALUES
(3, 'dasdsadsad', 'no'),
(6, 'Jijo', 'yes'),
(8, 'Reading Room', 'yes'),
(9, 'Hall', 'yes'),
(10, 'Auditory', 'yes'),
(11, 'Living Room', 'yes'),
(13, 'Srever Room', 'yes'),
(14, 'Office', 'yes'),
(16, 'Conferense hall', 'yes'),
(18, 'Visiters Hall', 'yes'),
(19, 'Guest Room', 'yes'),
(20, 'Indoor Stadium', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `room_rate`
--

CREATE TABLE `room_rate` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) NOT NULL,
  `member_category_id` int(10) DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `type` enum('constant','percentage') COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_rate`
--

INSERT INTO `room_rate` (`id`, `room_id`, `member_category_id`, `rank`, `type`, `rate`, `published`) VALUES
(1, 3, 3, 0, 'percentage', '500.00', ''),
(2, 19, 3, 2, 'constant', '2334.00', 'yes'),
(3, 19, 3, 345, 'constant', '345435.00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `room_rate_settings`
--

CREATE TABLE `room_rate_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `member_category_id` int(10) DEFAULT NULL,
  `type` enum('constant','percentage','previous') COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` int(10) DEFAULT NULL,
  `nodays` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_rate_settings`
--

INSERT INTO `room_rate_settings` (`id`, `rank`, `member_category_id`, `type`, `value`, `nodays`, `published`) VALUES
(1, 1, 2, 'constant', 100, 3, 'yes'),
(2, 2, 2, 'percentage', 32, 2, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `price` decimal(4,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `short`, `tax_id`, `price`, `published`) VALUES
(3, 'ytutu', 'tyy', 12, '99.99', ''),
(4, '7567567', '567657', 4, '36.00', ''),
(5, 'adj', 'f', 4, '99.99', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `credit_eod` date NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `other` decimal(10,2) DEFAULT NULL,
  `freight` decimal(10,2) DEFAULT NULL,
  `advance` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(10,2) DEFAULT NULL,
  `ref_id` int(10) DEFAULT NULL,
  `ref_amount` decimal(10,2) NOT NULL,
  `sales_ref` int(10) NOT NULL,
  `manager_id` int(10) DEFAULT NULL,
  `sales_man_id` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `narration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `type` enum('estimate','sales','sales8','sales_return') COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `customer_id` int(20) NOT NULL,
  `cash_type` enum('Cash','Credit') COLLATE utf8_unicode_ci NOT NULL,
  `area` int(11) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `salesman` int(11) DEFAULT NULL,
  `cusname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusdetails` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusemail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sal_itms_id` int(10) UNSIGNED NOT NULL,
  `sales_id` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `base_unit_id` int(10) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sett_login`
--

CREATE TABLE `sett_login` (
  `set_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `set_ip` varchar(100) NOT NULL,
  `set_status` tinyint(1) NOT NULL,
  `set_logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `set_logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_login`
--

INSERT INTO `sett_login` (`set_id`, `user_id`, `session_id`, `set_ip`, `set_status`, `set_logintime`, `set_logout`) VALUES
(1, 3, 'k9cq08pj88oltshh1qf5b7fsaio930g6', '::1', 1, '2018-08-08 13:22:26', '0000-00-00 00:00:00'),
(2, 3, 'icoalms2onvfjfpo382ltapfk45qhjii', '::1', 0, '2018-08-08 15:19:23', '0000-00-00 00:00:00'),
(3, 3, 'otuaou8eb8fte1ov401u2mfqeskdpfbj', '::1', 1, '2018-08-08 15:59:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `sms` varchar(500) NOT NULL,
  `is_default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `type`, `sms`, `is_default`) VALUES
(1, 'sale', 'Dear #Name#, thank you for making #invoice#  order with us  Total Amount is #amt#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_keywords`
--

CREATE TABLE `sms_keywords` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `published` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `api_password` varchar(100) NOT NULL,
  `sender` varchar(6) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `is_default` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `software_version`
--

CREATE TABLE `software_version` (
  `id` int(11) NOT NULL,
  `version_name` varchar(500) NOT NULL,
  `folder_path` varchar(500) NOT NULL,
  `db_path` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_version`
--

INSERT INTO `software_version` (`id`, `version_name`, `folder_path`, `db_path`, `created_date`, `created_by`) VALUES
(1, 'ssss', 'ss', 'ss', '2017-07-03 00:00:00', '2017-07-10 00:00:00'),
(2, '222233', '22222', '22', '2017-07-18 00:00:00', '2017-07-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `tin` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cst` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gst` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address_line1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `credit_period` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `percent` decimal(4,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `name`, `percent`, `published`) VALUES
(1, '14.0', '14.00', 'yes'),
(2, '.5', '0.50', 'yes'),
(3, 'krishi', '0.50', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `taxgst`
--

CREATE TABLE `taxgst` (
  `gstid` int(11) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `igst` decimal(10,2) NOT NULL,
  `GST` decimal(10,2) NOT NULL,
  `published` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxgst`
--

INSERT INTO `taxgst` (`gstid`, `cgst`, `sgst`, `igst`, `GST`, `published`) VALUES
(1, '8.00', '8.00', '8.00', '24.00', 0),
(2, '2.50', '2.50', '0.00', '5.00', 0),
(3, '0.00', '0.00', '0.00', '0.00', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `trans_aging`
--

CREATE TABLE `trans_aging` (
  `tag_id` bigint(20) NOT NULL,
  `tag_voucher_no` varchar(20) NOT NULL,
  `tag_date` date NOT NULL,
  `tag_balance` decimal(10,2) NOT NULL,
  `tag_amt` decimal(10,2) NOT NULL,
  `tag_updtd` datetime NOT NULL,
  `tag_pid` int(11) NOT NULL,
  `tag_type` varchar(3) NOT NULL,
  `tag_crtd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tra_charges`
--

CREATE TABLE `tra_charges` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `details` varchar(500) DEFAULT NULL,
  `is_master` tinyint(1) NOT NULL,
  `fk_charge` int(11) NOT NULL,
  `is_substraction` tinyint(1) NOT NULL,
  `is_groupsum` tinyint(1) NOT NULL,
  `is_ledger` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_charges`
--

INSERT INTO `tra_charges` (`Id`, `Name`, `details`, `is_master`, `fk_charge`, `is_substraction`, `is_groupsum`, `is_ledger`) VALUES
(2, 'OCEAN FREIGHT', 'OCEAN FREIGHT DETAILS', 1, 0, 0, 0, 0),
(3, 'Transport of goods', 'Transport of goods in a Coastal Vessel', 0, 2, 0, 1, 1),
(4, ' Abatement @ 70%', 'Less :Abatement @ 70% As per Sl No.10', 0, 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tra_consignee`
--

CREATE TABLE `tra_consignee` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` double NOT NULL,
  `tin` varchar(15) NOT NULL,
  `mobile` double NOT NULL,
  `Gst` varchar(15) NOT NULL,
  `address_line1` varchar(500) NOT NULL,
  `address_line2` varchar(500) NOT NULL,
  `Credit_period` int(10) NOT NULL,
  `Details` varchar(500) NOT NULL,
  `ContactP` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_consignee`
--

INSERT INTO `tra_consignee` (`Id`, `Name`, `Phone`, `tin`, `mobile`, `Gst`, `address_line1`, `address_line2`, `Credit_period`, `Details`, `ContactP`, `Email`) VALUES
(1, 'Consignee', 44567785433, '3', 8996332113, '2', 'asd', 'asd', 2, 'asd', 'fsdf', 'AFGFHF@GMAIL.COM'),
(2, 'hhg', 65767, '6', 5465465767, '6', 'gfjhfj', 'gffbvn', 6, 'jyygjgj', 'fghfhgfhg', 'asas@gmail.com'),
(3, 'tewetretewr', 0, '', 0, '', 'treteterwtertewrt', '', 23, '', '435345435345', '');

-- --------------------------------------------------------

--
-- Table structure for table `tra_consigner`
--

CREATE TABLE `tra_consigner` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `tin` varchar(15) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `ConatctP` varchar(100) NOT NULL,
  `Gst` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `address_line1` varchar(500) NOT NULL,
  `address_line2` varchar(500) NOT NULL,
  `Details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_consigner`
--

INSERT INTO `tra_consigner` (`Id`, `Name`, `Phone`, `tin`, `mobile`, `ConatctP`, `Gst`, `Email`, `address_line1`, `address_line2`, `Details`) VALUES
(1, 'Consigner', '6576757755', '6', '6565657543', 'hhvhvhvhvhvhv', '5', 'gggf@ygyg.hh', 'hghvh', 'hhhvh', 'hhvh');

-- --------------------------------------------------------

--
-- Table structure for table `tra_delivery`
--

CREATE TABLE `tra_delivery` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `free_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_delivery`
--

INSERT INTO `tra_delivery` (`id`, `code`, `name`, `details`, `free_code`) VALUES
(1, 'Delivery ', 'Delivery ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tra_driver`
--

CREATE TABLE `tra_driver` (
  `Id` int(11) NOT NULL,
  `Driver_name` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Mobile` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_driver`
--

INSERT INTO `tra_driver` (`Id`, `Driver_name`, `Address`, `Mobile`) VALUES
(1, 'sabu', 'asdssfsd', 24325435435435),
(2, 'Driver', 'asd', 343223424243);

-- --------------------------------------------------------

--
-- Table structure for table `tra_forworder`
--

CREATE TABLE `tra_forworder` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `tin` varchar(15) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `ConatctP` varchar(100) NOT NULL,
  `Gst` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `address_line1` varchar(500) NOT NULL,
  `address_line2` varchar(500) NOT NULL,
  `Credit_period` int(10) NOT NULL,
  `Details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_forworder`
--

INSERT INTO `tra_forworder` (`Id`, `Name`, `Phone`, `tin`, `mobile`, `ConatctP`, `Gst`, `Email`, `address_line1`, `address_line2`, `Credit_period`, `Details`) VALUES
(1, 'sdfdsfds', '1234567890000', '2', '8996332113', 'asd', '56', 'asd@g.c', '1234567890', 'as', 23, '32'),
(2, 'Forwarder', '123456789045', '', NULL, 'dsfdsfdsf', '', '', 'sdfsdf', '', 322, ''),
(3, 'Rajappan', '7686886876', 'yy', '6565567890', 'hvhghg', 't', 'vhh@gg.hh', 'ghg', 'hgh', 6, 'hhgh'),
(4, 'jijo fw', '9832982398', '', NULL, 'Jijo Dileep', '', '', 'Test', '', 30, '');

-- --------------------------------------------------------

--
-- Table structure for table `tra_line`
--

CREATE TABLE `tra_line` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `freecode` varchar(100) DEFAULT NULL,
  `freecode2` varchar(100) DEFAULT NULL,
  `freecode3` varchar(100) DEFAULT NULL,
  `details` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_line`
--

INSERT INTO `tra_line` (`Id`, `Name`, `freecode`, `freecode2`, `freecode3`, `details`) VALUES
(1, 'Line', '3', '3', '3', '3'),
(2, 'fdsfdsf', 'ds', 'sdf', 'sdf', 'sdf'),
(3, 'asd', '1', '1', '1', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `tra_pitems`
--

CREATE TABLE `tra_pitems` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `txtname` varchar(20) NOT NULL,
  `type` varchar(4) NOT NULL,
  `tid` int(11) NOT NULL,
  `value` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_pitems`
--

INSERT INTO `tra_pitems` (`id`, `pid`, `txtname`, `type`, `tid`, `value`) VALUES
(8, 3, 'schr2', 'char', 2, 2009.00),
(9, 3, 'tax12', 'taxc', 1, 281.26),
(10, 3, 'tax22', 'taxc', 2, 10.04),
(11, 3, 'tax32', 'taxc', 3, 10.04),
(12, 3, 'tot2', 'char', 2, 2690.34),
(13, 3, 'schr3', 'char', 3, 2389.00),
(14, 3, 'schr4', 'char', 4, 380.00),
(15, 4, 'schr2', 'char', 2, 33981.00),
(16, 4, 'tax12', 'taxc', 1, 4757.34),
(17, 4, 'tax22', 'taxc', 2, 169.91),
(18, 4, 'tax32', 'taxc', 3, 169.91),
(19, 4, 'tot2', 'char', 2, 39631.16),
(20, 4, 'schr3', 'char', 3, 34534.00),
(21, 4, 'schr4', 'char', 4, 553.00);

-- --------------------------------------------------------

--
-- Table structure for table `tra_places`
--

CREATE TABLE `tra_places` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Per_in_Sales` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `details` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_places`
--

INSERT INTO `tra_places` (`Id`, `Name`, `Per_in_Sales`, `amount`, `details`) VALUES
(1, 'Kannur', 2, 23, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tra_purchase`
--

CREATE TABLE `tra_purchase` (
  `pid` int(11) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `sdate` date DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `forworder` int(11) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `container` varchar(50) DEFAULT NULL,
  `vessal` int(11) DEFAULT NULL,
  `pol` int(11) DEFAULT NULL,
  `pod` int(11) DEFAULT NULL,
  `consignee` int(11) DEFAULT NULL,
  `consiner` int(11) DEFAULT NULL,
  `aditon` double(10,2) DEFAULT NULL,
  `substration` double(10,2) DEFAULT NULL,
  `gtotal` double(10,2) DEFAULT NULL,
  `round` double(10,2) DEFAULT NULL,
  `is_sale` smallint(6) DEFAULT NULL,
  `crdtd_date` date DEFAULT NULL,
  `refinno` varchar(100) NOT NULL,
  `invoicevalue` varchar(20) NOT NULL,
  `qtyinbox` int(11) NOT NULL,
  `commidities` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_purchase`
--

INSERT INTO `tra_purchase` (`pid`, `invoice`, `sdate`, `rdate`, `forworder`, `line`, `comment`, `container`, `vessal`, `pol`, `pod`, `consignee`, `consiner`, `aditon`, `substration`, `gtotal`, `round`, `is_sale`, `crdtd_date`, `refinno`, `invoicevalue`, `qtyinbox`, `commidities`) VALUES
(1, '20000', '2017-06-09', '2017-06-09', 4, 3, 'kl-59-228', 'test01', 1, 2, 1, 2, 1, 2.00, 650.00, 22000.00, -0.26, 1, '2017-06-09', 'ref', 'invo', 200, 'Tiles'),
(2, 'tretrwtwet', '2017-06-10', '2017-06-10', 2, 2, 'dsfdsfdsf', '2343', 1, 1, 1, 1, 1, 0.00, 0.00, 2690.00, -0.34, 1, '2017-06-10', '', '', 0, ''),
(3, 'tretrwtwet', '2017-06-10', '2017-06-10', 4, 2, 'dsfdsfdsf', '2343', 1, 1, 1, 1, 1, 0.00, 0.00, 2690.00, -0.34, 1, '2017-06-10', '', '', 0, ''),
(4, 'tretretert', '2017-06-10', '2017-06-10', 4, 3, 'ertertert', 'retertert', 1, 1, 1, 1, 1, 0.00, 0.00, 39631.00, -0.16, 1, '2017-06-10', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tra_sales`
--

CREATE TABLE `tra_sales` (
  `pid` int(11) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `sdate` date DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `forworder` int(11) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `container` varchar(50) DEFAULT NULL,
  `vessal` int(11) DEFAULT NULL,
  `pol` int(11) DEFAULT NULL,
  `pod` int(11) DEFAULT NULL,
  `consignee` int(11) DEFAULT NULL,
  `consiner` int(11) DEFAULT NULL,
  `aditon` double(10,2) DEFAULT NULL,
  `substration` double(10,2) DEFAULT NULL,
  `gtotal` double(10,2) DEFAULT NULL,
  `round` double(10,2) DEFAULT NULL,
  `is_sale` smallint(6) DEFAULT NULL,
  `crdtd_date` date DEFAULT NULL,
  `refinno` varchar(100) NOT NULL,
  `invoicevalue` varchar(20) NOT NULL,
  `qtyinbox` int(11) NOT NULL,
  `commidities` varchar(100) NOT NULL,
  `vhno` int(11) NOT NULL,
  `drno` int(11) NOT NULL,
  `pid_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_sales`
--

INSERT INTO `tra_sales` (`pid`, `invoice`, `sdate`, `rdate`, `forworder`, `line`, `comment`, `container`, `vessal`, `pol`, `pod`, `consignee`, `consiner`, `aditon`, `substration`, `gtotal`, `round`, `is_sale`, `crdtd_date`, `refinno`, `invoicevalue`, `qtyinbox`, `commidities`, `vhno`, `drno`, `pid_p`) VALUES
(1, '1', '2017-06-09', '2017-06-09', 4, 3, 'kl-59-228', 'test01 2017-06-09', 1, 2, 1, 2, 1, 2.00, 650.00, 22000.00, -0.26, 0, '2017-06-10', 'ref', 'invo', 200, 'Tiles', 3, 2, 1),
(2, '2', '2017-06-10', '2017-06-10', 4, 3, 'ertertert', 'retertert 2017-06-10', 1, 1, 1, 1, 1, 0.00, 0.00, 22648.00, -0.26, 0, '2017-06-10', '', '', 0, '', 2, 2, 2),
(3, '3', '2017-06-10', '2017-06-10', 4, 3, 'ertertert', 'retertert 2017-06-10', 1, 1, 1, 1, 1, 0.00, 0.00, 39631.00, -0.16, 0, '2017-06-10', '', '', 0, '', 1, 1, 4),
(4, '4', '2017-06-10', '2017-06-10', 4, 2, 'dsfdsfdsf', '2343 2017-06-10', 1, 1, 1, 3, 1, 0.00, 0.00, 2690.00, -0.34, 0, '2017-06-10', '', '', 0, '', 3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tra_sitems`
--

CREATE TABLE `tra_sitems` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `txtname` varchar(20) NOT NULL,
  `type` varchar(4) NOT NULL,
  `tid` int(11) NOT NULL,
  `value` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_sitems`
--

INSERT INTO `tra_sitems` (`id`, `pid`, `txtname`, `type`, `tid`, `value`) VALUES
(1, 1, 'schr2', 'char', 2, 17655.00),
(2, 1, 'tax12', 'taxc', 1, 2471.70),
(3, 1, 'tax22', 'taxc', 2, 88.28),
(4, 1, 'tax32', 'taxc', 3, 88.28),
(5, 1, 'tot2', 'char', 2, 22648.26),
(6, 1, 'schr3', 'char', 3, 20000.00),
(7, 1, 'schr4', 'char', 4, 2345.00),
(8, 2, 'schr2', 'char', 2, 17655.00),
(9, 2, 'tax12', 'taxc', 1, 2471.70),
(10, 2, 'tax22', 'taxc', 2, 88.28),
(11, 2, 'tax32', 'taxc', 3, 88.28),
(12, 2, 'tot2', 'char', 2, 22648.26),
(13, 2, 'schr3', 'char', 3, 20000.00),
(14, 2, 'schr4', 'char', 4, 2345.00),
(15, 3, 'schr2', 'char', 2, 17655.00),
(16, 3, 'tax12', 'taxc', 1, 2471.70),
(17, 3, 'tax22', 'taxc', 2, 88.28),
(18, 3, 'tax32', 'taxc', 3, 88.28),
(19, 3, 'tot2', 'char', 2, 22648.26),
(20, 3, 'schr3', 'char', 3, 20000.00),
(21, 3, 'schr4', 'char', 4, 2345.00),
(22, 4, 'schr2', 'char', 2, 17655.00),
(23, 4, 'tax12', 'taxc', 1, 2471.70),
(24, 4, 'tax22', 'taxc', 2, 88.28),
(25, 4, 'tax32', 'taxc', 3, 88.28),
(26, 4, 'tot2', 'char', 2, 22648.26),
(27, 4, 'schr3', 'char', 3, 20000.00),
(28, 4, 'schr4', 'char', 4, 2345.00),
(29, 5, 'schr2', 'char', 2, 17655.00),
(30, 5, 'tax12', 'taxc', 1, 2471.70),
(31, 5, 'tax22', 'taxc', 2, 88.28),
(32, 5, 'tax32', 'taxc', 3, 88.28),
(33, 5, 'tot2', 'char', 2, 22648.26),
(34, 5, 'schr3', 'char', 3, 20000.00),
(35, 5, 'schr4', 'char', 4, 2345.00),
(36, 6, 'schr2', 'char', 2, 17655.00),
(37, 6, 'tax12', 'taxc', 1, 2471.70),
(38, 6, 'tax22', 'taxc', 2, 88.28),
(39, 6, 'tax32', 'taxc', 3, 88.28),
(40, 6, 'tot2', 'char', 2, 22648.26),
(41, 6, 'schr3', 'char', 3, 20000.00),
(42, 6, 'schr4', 'char', 4, 2345.00),
(43, 1, 'schr2', 'char', 2, 17655.00),
(44, 1, 'tax12', 'taxc', 1, 2471.70),
(45, 1, 'tax22', 'taxc', 2, 88.28),
(46, 1, 'tax32', 'taxc', 3, 88.28),
(47, 1, 'tot2', 'char', 2, 22648.26),
(48, 1, 'schr3', 'char', 3, 20000.00),
(49, 1, 'schr4', 'char', 4, 2345.00),
(50, 1, 'schr2', 'char', 2, 17655.00),
(51, 1, 'tax12', 'taxc', 1, 2471.70),
(52, 1, 'tax22', 'taxc', 2, 88.28),
(53, 1, 'tax32', 'taxc', 3, 88.28),
(54, 1, 'tot2', 'char', 2, 22648.26),
(55, 1, 'schr3', 'char', 3, 20000.00),
(56, 1, 'schr4', 'char', 4, 2345.00),
(57, 2, 'schr2', 'char', 2, 17655.00),
(58, 2, 'tax12', 'taxc', 1, 2471.70),
(59, 2, 'tax22', 'taxc', 2, 88.28),
(60, 2, 'tax32', 'taxc', 3, 88.28),
(61, 2, 'tot2', 'char', 2, 22648.26),
(62, 2, 'schr3', 'char', 3, 20000.00),
(63, 2, 'schr4', 'char', 4, 2345.00),
(64, 2, 'schr2', 'char', 2, 17655.00),
(65, 2, 'tax12', 'taxc', 1, 2471.70),
(66, 2, 'tax22', 'taxc', 2, 88.28),
(67, 2, 'tax32', 'taxc', 3, 88.28),
(68, 2, 'tot2', 'char', 2, 22648.26),
(69, 2, 'schr3', 'char', 3, 20000.00),
(70, 2, 'schr4', 'char', 4, 2345.00),
(71, 3, 'schr2', 'char', 2, 33981.00),
(72, 3, 'tax12', 'taxc', 1, 4757.34),
(73, 3, 'tax22', 'taxc', 2, 169.91),
(74, 3, 'tax32', 'taxc', 3, 169.91),
(75, 3, 'tot2', 'char', 2, 39631.16),
(76, 3, 'schr3', 'char', 3, 34534.00),
(77, 3, 'schr4', 'char', 4, 553.00),
(78, 4, 'schr2', 'char', 2, 2009.00),
(79, 4, 'tax12', 'taxc', 1, 281.26),
(80, 4, 'tax22', 'taxc', 2, 10.04),
(81, 4, 'tax32', 'taxc', 3, 10.04),
(82, 4, 'tot2', 'char', 2, 2690.34),
(83, 4, 'schr3', 'char', 3, 2389.00),
(84, 4, 'schr4', 'char', 4, 380.00);

-- --------------------------------------------------------

--
-- Table structure for table `tra_vehicle`
--

CREATE TABLE `tra_vehicle` (
  `Id` int(11) NOT NULL,
  `Vehicle_num` varchar(25) NOT NULL,
  `Contact_Person` varchar(50) NOT NULL,
  `Freecode` int(11) NOT NULL,
  `Freecode2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_vehicle`
--

INSERT INTO `tra_vehicle` (`Id`, `Vehicle_num`, `Contact_Person`, `Freecode`, `Freecode2`) VALUES
(1, 'kl14/h/2345', 'sabu', 0, 0),
(2, '123', 'saa', 2, 0),
(3, 'kl59/j/5643', '656476467', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tra_vessal`
--

CREATE TABLE `tra_vessal` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `free_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tra_vessal`
--

INSERT INTO `tra_vessal` (`id`, `code`, `name`, `details`, `free_code`) VALUES
(1, 'Vessal ', 'Vessal ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `unit_count` decimal(4,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `code`, `unit_id`, `unit_count`, `published`) VALUES
(1, 'Kg', 'Kg', NULL, '1.00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1',
  `user_address` varchar(500) NOT NULL,
  `user_mobile` varchar(13) NOT NULL,
  `user_phone` varchar(13) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  `company` int(11) NOT NULL,
  `is-active` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `user_type`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `user_password`, `company`, `is-active`, `updatedate`) VALUES
(1, 'shyamlin', 1, 'Kuniyil house', '7559831834', '546464455', 'shyamlinchandran@gmail.com', 'shyamlin', 'shyam123', 1, 1, '2018-01-28 06:46:02'),
(3, '457', 1, '757547', '2345678654', '', '', 'aa', 'aa', 0, 0, '2018-01-28 06:46:02'),
(4, 'sadmin', 3, '', '', '', '', '123', '123', 3, 0, '2018-02-20 13:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dash` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `dash`) VALUES
(1, 'Admin', 'admin'),
(2, 'General', 'admin'),
(3, 'superadmin', 'sadmin'),
(4, 'clinic', 'clinic');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `naration` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trans_date` date NOT NULL,
  `vourcher_type` enum('payment','receipt','journal') COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `approved_by` int(10) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `del_by` int(10) DEFAULT NULL,
  `is_post` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT NULL,
  `del_date` datetime DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `voucher_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_trans`
--

CREATE TABLE `voucher_trans` (
  `id` int(10) UNSIGNED NOT NULL,
  `voucher_id` int(10) DEFAULT NULL,
  `acc_ledgers_id` int(10) DEFAULT NULL,
  `credit_amounnt` decimal(10,2) DEFAULT NULL,
  `debit_amount` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_ageing`
--
ALTER TABLE `acc_ageing`
  ADD PRIMARY KEY (`age_id`);

--
-- Indexes for table `acc_ledgers`
--
ALTER TABLE `acc_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_ledger_trans`
--
ALTER TABLE `acc_ledger_trans`
  ADD PRIMARY KEY (`tran_id`),
  ADD UNIQUE KEY `tran_id` (`tran_id`);

--
-- Indexes for table `acc_main`
--
ALTER TABLE `acc_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_type`
--
ALTER TABLE `acc_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`Bid`),
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Indexes for table `bldgrp`
--
ALTER TABLE `bldgrp`
  ADD PRIMARY KEY (`BldId`),
  ADD UNIQUE KEY `BldId` (`BldId`);

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `chqdetails`
--
ALTER TABLE `chqdetails`
  ADD PRIMARY KEY (`chq_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`comset_id`);

--
-- Indexes for table `company_subcription`
--
ALTER TABLE `company_subcription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `donners`
--
ALTER TABLE `donners`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `fin_year`
--
ALTER TABLE `fin_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hsncode`
--
ALTER TABLE `hsncode`
  ADD PRIMARY KEY (`hsnid`);

--
-- Indexes for table `ims_area`
--
ALTER TABLE `ims_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_driver`
--
ALTER TABLE `ims_driver`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ims_pickup`
--
ALTER TABLE `ims_pickup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ims_route`
--
ALTER TABLE `ims_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_vehicle`
--
ALTER TABLE `ims_vehicle`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_godown`
--
ALTER TABLE `item_godown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_group`
--
ALTER TABLE `item_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `item_ledger`
--
ALTER TABLE `item_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_category`
--
ALTER TABLE `member_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_family`
--
ALTER TABLE `member_family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prd_stock`
--
ALTER TABLE `prd_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prd_stockitem`
--
ALTER TABLE `prd_stockitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD PRIMARY KEY (`book_sub_id`);

--
-- Indexes for table `room_book_master`
--
ALTER TABLE `room_book_master`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_rate`
--
ALTER TABLE `room_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_rate_settings`
--
ALTER TABLE `room_rate_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sal_itms_id`);

--
-- Indexes for table `sett_login`
--
ALTER TABLE `sett_login`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_keywords`
--
ALTER TABLE `sms_keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software_version`
--
ALTER TABLE `software_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxgst`
--
ALTER TABLE `taxgst`
  ADD PRIMARY KEY (`gstid`);

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
-- Indexes for table `trans_aging`
--
ALTER TABLE `trans_aging`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tra_charges`
--
ALTER TABLE `tra_charges`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_consignee`
--
ALTER TABLE `tra_consignee`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `tra_consigner`
--
ALTER TABLE `tra_consigner`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_delivery`
--
ALTER TABLE `tra_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tra_driver`
--
ALTER TABLE `tra_driver`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_forworder`
--
ALTER TABLE `tra_forworder`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_line`
--
ALTER TABLE `tra_line`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_pitems`
--
ALTER TABLE `tra_pitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tra_places`
--
ALTER TABLE `tra_places`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_purchase`
--
ALTER TABLE `tra_purchase`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pid` (`pid`);

--
-- Indexes for table `tra_sales`
--
ALTER TABLE `tra_sales`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `pid` (`pid`);

--
-- Indexes for table `tra_sitems`
--
ALTER TABLE `tra_sitems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tra_vehicle`
--
ALTER TABLE `tra_vehicle`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tra_vessal`
--
ALTER TABLE `tra_vessal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_trans`
--
ALTER TABLE `voucher_trans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_ageing`
--
ALTER TABLE `acc_ageing`
  MODIFY `age_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_ledgers`
--
ALTER TABLE `acc_ledgers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `acc_ledger_trans`
--
ALTER TABLE `acc_ledger_trans`
  MODIFY `tran_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_main`
--
ALTER TABLE `acc_main`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bldgrp`
--
ALTER TABLE `bldgrp`
  MODIFY `BldId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chqdetails`
--
ALTER TABLE `chqdetails`
  MODIFY `chq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `comset_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_subcription`
--
ALTER TABLE `company_subcription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donners`
--
ALTER TABLE `donners`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fin_year`
--
ALTER TABLE `fin_year`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hsncode`
--
ALTER TABLE `hsncode`
  MODIFY `hsnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ims_area`
--
ALTER TABLE `ims_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ims_driver`
--
ALTER TABLE `ims_driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ims_pickup`
--
ALTER TABLE `ims_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ims_route`
--
ALTER TABLE `ims_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ims_vehicle`
--
ALTER TABLE `ims_vehicle`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_godown`
--
ALTER TABLE `item_godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_group`
--
ALTER TABLE `item_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_ledger`
--
ALTER TABLE `item_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_category`
--
ALTER TABLE `member_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member_family`
--
ALTER TABLE `member_family`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `prd_stock`
--
ALTER TABLE `prd_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prd_stockitem`
--
ALTER TABLE `prd_stockitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `ref_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_booking`
--
ALTER TABLE `room_booking`
  MODIFY `book_sub_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room_book_master`
--
ALTER TABLE `room_book_master`
  MODIFY `book_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `room_rate`
--
ALTER TABLE `room_rate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_rate_settings`
--
ALTER TABLE `room_rate_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sal_itms_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sett_login`
--
ALTER TABLE `sett_login`
  MODIFY `set_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_keywords`
--
ALTER TABLE `sms_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `software_version`
--
ALTER TABLE `software_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxgst`
--
ALTER TABLE `taxgst`
  MODIFY `gstid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tha_customer`
--
ALTER TABLE `tha_customer`
  MODIFY `thacu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tha_items`
--
ALTER TABLE `tha_items`
  MODIFY `thait_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `siz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trans_aging`
--
ALTER TABLE `trans_aging`
  MODIFY `tag_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tra_charges`
--
ALTER TABLE `tra_charges`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tra_consignee`
--
ALTER TABLE `tra_consignee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tra_consigner`
--
ALTER TABLE `tra_consigner`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tra_delivery`
--
ALTER TABLE `tra_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tra_driver`
--
ALTER TABLE `tra_driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tra_forworder`
--
ALTER TABLE `tra_forworder`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tra_line`
--
ALTER TABLE `tra_line`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tra_pitems`
--
ALTER TABLE `tra_pitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tra_places`
--
ALTER TABLE `tra_places`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tra_purchase`
--
ALTER TABLE `tra_purchase`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tra_sales`
--
ALTER TABLE `tra_sales`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tra_sitems`
--
ALTER TABLE `tra_sitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tra_vehicle`
--
ALTER TABLE `tra_vehicle`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tra_vessal`
--
ALTER TABLE `tra_vessal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_trans`
--
ALTER TABLE `voucher_trans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
