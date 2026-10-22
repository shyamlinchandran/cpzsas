-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2022 at 10:58 AM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Ozononlyempty`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_ageing`
--

CREATE TABLE `acc_ageing` (
  `age_id` int(11) NOT NULL,
  `voucher_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tb_id` int(11) NOT NULL,
  `tb_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tb_crdate` date NOT NULL,
  `tb_caldate` date NOT NULL,
  `led_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `credit` double(100,2) NOT NULL,
  `debit` double(100,2) NOT NULL,
  `paid` double(100,2) NOT NULL,
  `balance` double(100,2) NOT NULL,
  `status` int(2) NOT NULL,
  `last_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_type` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'c',
  `pay_id` int(11) NOT NULL DEFAULT '1',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_ageing_trans`
--

CREATE TABLE `acc_ageing_trans` (
  `id` int(11) NOT NULL,
  `ageing_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `voucher_type` enum('voucher','cheque') NOT NULL DEFAULT 'voucher',
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_ledgers`
--

CREATE TABLE `acc_ledgers` (
  `id` int(100) UNSIGNED NOT NULL,
  `fin_sync_id` int(11) NOT NULL DEFAULT '0',
  `ledger_main_id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `acc_ledger_code` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `code` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ref_id` int(20) NOT NULL DEFAULT '0',
  `tax_id` int(11) NOT NULL DEFAULT '0',
  `ref_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `hsncode` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '1',
  `acc_main_id` int(100) DEFAULT NULL,
  `type` enum('Dr','Cr') COLLATE utf8_unicode_ci NOT NULL,
  `openning_bal` decimal(10,2) DEFAULT '0.00',
  `opening_balance_paid` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_for_purchase` tinyint(1) NOT NULL,
  `is_for_sales` tinyint(1) NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT 'name'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_ledgers`
--

INSERT INTO `acc_ledgers` (`id`, `fin_sync_id`, `ledger_main_id`, `name`, `acc_ledger_code`, `code`, `ref_id`, `tax_id`, `ref_code`, `hsncode`, `is_default`, `acc_main_id`, `type`, `openning_bal`, `opening_balance_paid`, `published`, `updatedate`, `is_for_purchase`, `is_for_sales`, `name_lan`) VALUES
(1, 0, 0, 'Cash In Hand', '', 'Cash', 1, 0, 'yes', 0, 0, 4, 'Dr', '0.00', '0.00', 'yes', '2022-07-06 14:28:47', 0, 0, NULL),
(10, 0, 0, 'Purchase', '', 'Purchase', 0, 0, 'yes', 0, 0, 8, 'Dr', '0.00', '0.00', 'yes', '2021-06-05 04:48:47', 0, 0, NULL),
(11, 0, 0, 'Sales', '1', 'Sales', 0, 0, 'yes', 0, 0, 9, 'Dr', '0.00', '0.00', 'yes', '2018-11-21 13:00:45', 0, 0, NULL),
(12, 0, 0, 'Round Off', '1', 'Round Off', 0, 0, 'yes', 0, 0, 11, 'Dr', '0.00', '0.00', 'yes', '2019-01-13 23:46:05', 0, 0, NULL),
(13, 0, 0, 'Purchase Freight ', '1', 'PFreight ', 0, 0, 'yes', 0, 0, 8, 'Dr', '0.00', '0.00', 'yes', '2018-11-21 13:21:25', 0, 0, NULL),
(15, 0, 0, 'Coolie', '', 'Coolie', 0, 0, 'yes', 0, 0, 8, 'Dr', '0.00', '0.00', 'yes', '2019-01-13 23:45:03', 0, 0, NULL),
(16, 0, 0, 'Discount ', '', 'Discount', 0, 0, 'yes', 0, 0, 11, 'Dr', '0.00', '0.00', 'yes', '2019-01-13 23:45:31', 0, 0, NULL),
(24, 0, 0, 'Commission Payable', '', 'Commission', 0, 0, 'yes', 0, 0, 11, 'Dr', '0.00', '0.00', 'yes', '2019-01-13 23:44:36', 0, 0, NULL),
(106, 0, 0, 'Assets', '', 'Assets', 0, 0, 'yes', 0, 0, 13, 'Dr', '0.00', '0.00', 'yes', '2018-12-29 04:04:37', 0, 0, NULL),
(107, 0, 0, 'GST-0', '1', '0', 1, 0, 'Tax', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-06-26 11:53:26', 0, 0, NULL),
(108, 0, 0, 'Sales-0', '1', '0', 1, 0, 'SaleTax', 0, 1, 21, 'Dr', '0.00', '0.00', 'yes', '2019-06-26 11:53:26', 0, 0, NULL),
(109, 0, 0, 'Purchase-0', '1', '0', 1, 0, 'PurTax', 0, 1, 19, 'Dr', '0.00', '0.00', 'yes', '2019-06-26 11:53:26', 0, 0, NULL),
(112, 0, 0, 'GST-18', '2', '18', 2, 0, 'Tax', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:37:50', 0, 0, 'name'),
(113, 0, 0, 'Sales-18', '2', '18', 2, 0, 'SaleTax', 0, 1, 21, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:37:50', 0, 0, 'name'),
(114, 0, 0, 'Purchase-18', '2', '18', 2, 0, 'PurTax', 0, 1, 19, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:37:50', 0, 0, 'name'),
(115, 0, 0, 'GST-12', '3', '12', 3, 0, 'Tax', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:14', 0, 0, 'name'),
(116, 0, 0, 'Sales-12', '3', '12', 3, 0, 'SaleTax', 0, 1, 21, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:14', 0, 0, 'name'),
(117, 0, 0, 'Purchase-12', '3', '12', 3, 0, 'PurTax', 0, 1, 19, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:14', 0, 0, 'name'),
(118, 0, 0, 'GST-28', '4', '28', 4, 0, 'Tax', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:44', 0, 0, 'name'),
(119, 0, 0, 'Sales-28', '4', '28', 4, 0, 'SaleTax', 0, 1, 21, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:44', 0, 0, 'name'),
(120, 0, 0, 'Purchase-28', '4', '28', 4, 0, 'PurTax', 0, 1, 19, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:38:44', 0, 0, 'name'),
(121, 0, 0, 'GST-5', '5', '5', 5, 0, 'Tax', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:39:43', 0, 0, 'name'),
(122, 0, 0, 'Sales-5', '5', '5', 5, 0, 'SaleTax', 0, 1, 21, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:39:43', 0, 0, 'name'),
(123, 0, 0, 'Purchase-5', '5', '5', 5, 0, 'PurTax', 0, 1, 19, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:39:43', 0, 0, 'name'),
(124, 0, 0, 'Kerala Flood Cess', '0', '1', 1, 0, 'Cess', 0, 1, 10, 'Dr', '0.00', '0.00', 'yes', '2019-12-02 10:57:01', 0, 0, 'name'),
(166, 0, 0, 'Bank', '1', 'ifsc', 3, 0, 'Bank', 0, 1, 1, 'Dr', '0.00', '0.00', 'yes', '2020-08-17 10:08:17', 0, 0, 'name'),
(14, 0, 0, 'Sales Freight ', '1', 'SFreight', 0, 0, 'yes', 0, 1, 8, 'Dr', '0.00', '0.00', 'yes', '2020-08-20 05:45:51', 0, 0, 'name');

-- --------------------------------------------------------

--
-- Table structure for table `acc_ledger_trans`
--

CREATE TABLE `acc_ledger_trans` (
  `tran_id` int(20) NOT NULL,
  `tb_id` int(20) DEFAULT NULL,
  `tb_name` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `trn_tp` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `voucher_no` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `to_ledger_id` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `ledger_id` int(20) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `tran_amt` float DEFAULT NULL,
  `tran_date` date DEFAULT NULL,
  `tran_debit` decimal(10,2) DEFAULT '0.00',
  `tran_credit` decimal(10,2) DEFAULT '0.00',
  `tran_crtd_dt` datetime DEFAULT NULL,
  `tran_crtd_by` int(11) DEFAULT NULL,
  `cost_center` varchar(30) CHARACTER SET utf8 NOT NULL,
  `tran_narration` mediumtext CHARACTER SET utf8,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_main`
--

CREATE TABLE `acc_main` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `code` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `acc_sub_type_id` int(100) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_main`
--

INSERT INTO `acc_main` (`id`, `name`, `code`, `branch_id`, `acc_sub_type_id`, `published`, `updatedate`, `name_lan`) VALUES
(1, 'Bank Accounts', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(2, 'Bank OCC Accounts', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(3, 'Bank OD Account', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(4, 'Cash in Hand', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(5, 'Current Asset', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(6, 'Current Liability', '', 0, 2, 'yes', '2018-11-16 06:05:48', NULL),
(7, 'Deposits (Asset)', '', 0, 3, 'yes', '2018-11-16 06:05:48', NULL),
(8, 'Direct Exp', '', 0, 4, 'yes', '2018-11-16 06:05:48', NULL),
(9, 'Direct Income', '', 0, 5, 'yes', '2018-11-16 06:05:48', NULL),
(10, 'Duties and Taxes', '', 0, 2, 'yes', '2018-11-16 06:05:48', NULL),
(11, 'Indirect Expense', '', 0, 6, 'yes', '2018-11-16 06:05:48', NULL),
(12, 'Indirect Income', '', 0, 7, 'yes', '2018-11-16 06:05:48', NULL),
(13, 'Fixed asset', '', 0, 3, 'yes', '2018-11-16 06:05:48', NULL),
(14, 'Investments', '', 0, 3, 'yes', '2018-11-16 06:05:48', NULL),
(15, 'Loans and Advances(Asset)', '', 0, 3, 'yes', '2018-11-16 06:05:48', NULL),
(16, 'Loans (Liability)', '', 0, 2, 'yes', '2018-11-16 06:05:48', NULL),
(17, 'Mis Exp (Asset)', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(18, 'Provisions', '', 0, 2, 'yes', '2018-11-16 06:05:48', NULL),
(19, 'Purchase', '', 0, 4, 'yes', '2018-11-16 06:05:48', NULL),
(20, 'Reserves and Surplus', '', 0, 4, 'yes', '2018-11-16 06:05:48', NULL),
(21, 'Sales Accounts', '', 0, 5, 'yes', '2018-11-16 06:05:48', NULL),
(22, 'Secured Loans', '', 0, 5, 'yes', '2018-11-16 06:05:48', NULL),
(23, 'Stock in Hand(Closing Stock)', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(24, 'Sundry Creditor', '', 0, 2, 'yes', '2018-11-16 06:05:48', NULL),
(25, 'Sundry Debtor', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(26, 'Suspense A/C', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(27, 'Unsecured Loans', '', 0, 1, 'yes', '2018-11-16 06:05:48', NULL),
(28, 'Capital Account', '', 0, 2, 'yes', '2018-11-16 06:17:23', NULL),
(39, 'Employee', '', 0, 2, 'yes', '2022-02-26 05:43:37', NULL),
(40, 'Employee', '', 0, 2, 'yes', '2022-02-26 05:44:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acc_settings`
--

CREATE TABLE `acc_settings` (
  `set_id` int(11) NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `set_key` varchar(20) CHARACTER SET utf8 NOT NULL,
  `set_value` varchar(1500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_settings`
--

INSERT INTO `acc_settings` (`set_id`, `type`, `set_key`, `set_value`) VALUES
(1, 'profit', 'dir_income', '9,21,22'),
(2, 'profit', 'dir_expence', '8,19,20'),
(3, 'profit', 'indir_expence', '11'),
(4, 'profit', 'indir_income', '12'),
(5, 'balance', 'asset', '1,3'),
(6, 'balance', 'liability', '2');

-- --------------------------------------------------------

--
-- Table structure for table `acc_sub_type`
--

CREATE TABLE `acc_sub_type` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `sub_code` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `acc_type_id` int(100) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_sub_type`
--

INSERT INTO `acc_sub_type` (`id`, `name`, `name_lan`, `sub_code`, `code`, `acc_type_id`, `published`, `updatedate`) VALUES
(1, 'Current Asset', NULL, '', '0', 3, 'yes', '2018-11-16 10:32:25'),
(2, 'Current Liability', NULL, '', '0', 4, 'yes', '2018-11-16 10:32:45'),
(3, 'Fixed Asset', NULL, '', '0', 3, 'yes', '2018-11-16 10:33:06'),
(4, 'Direct Expense', NULL, '', '0', 1, 'yes', '2018-11-16 10:33:26'),
(5, 'Direct Income', NULL, '', '0', 2, 'yes', '2018-11-16 10:33:40'),
(6, 'Indiect Expense', NULL, '', '0', 1, 'yes', '2018-11-16 10:34:36'),
(7, 'Indirect Income', NULL, '', '0', 2, 'yes', '2018-11-16 10:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE `acc_type` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `type_code` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`id`, `name`, `type_code`, `published`, `updatedate`, `name_lan`) VALUES
(1, 'Expense ', '', 'yes', '2018-01-28 06:45:28', NULL),
(2, 'Income', '', 'yes', '2018-01-28 06:45:28', NULL),
(3, 'Asset', '', 'yes', '2018-04-07 06:45:04', NULL),
(4, 'Liability', '', 'yes', '2018-01-28 06:45:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `analytics_center`
--

CREATE TABLE `analytics_center` (
  `any_id` int(11) NOT NULL,
  `any_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `fk_any_id` int(11) NOT NULL,
  `any_description` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analytics_center`
--

INSERT INTO `analytics_center` (`any_id`, `any_name`, `name_lan`, `fk_any_id`, `any_description`) VALUES
(1, 'General', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `auditLog`
--

CREATE TABLE `auditLog` (
  `auditLogID` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `user` int(11) NOT NULL,
  `syschange` text NOT NULL,
  `syschange_sub` text NOT NULL,
  `tb_name` varchar(500) NOT NULL,
  `tb_id` int(11) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_ifsc_code` varchar(50) NOT NULL,
  `bank_acc_no` varchar(50) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `bank_address` varchar(500) NOT NULL,
  `bank_phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_name`, `bank_ifsc_code`, `bank_acc_no`, `bank_branch`, `bank_address`, `bank_phone`) VALUES
(3, 'Bank', 'ifsc', 'Account Number', 'branch', 'Bank  address ', 'phone ');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_batch`
--

CREATE TABLE `barcode_batch` (
  `barcode_batch_id` int(11) NOT NULL,
  `batch_name` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barcode_batch_items`
--

CREATE TABLE `barcode_batch_items` (
  `id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `item_name` varchar(1000) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `Bid` int(11) NOT NULL,
  `Code` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Barcode` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `Openstock` decimal(10,0) NOT NULL,
  `Prate` decimal(10,0) NOT NULL,
  `Whol_salerte` decimal(10,0) NOT NULL,
  `mrp` decimal(10,0) NOT NULL,
  `Item` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_format`
--

CREATE TABLE `bill_format` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `bom_main`
--

CREATE TABLE `bom_main` (
  `id` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `price_per_quantity` double NOT NULL,
  `ledgertotal` float NOT NULL,
  `materialtotal` float NOT NULL,
  `grandtotal` double NOT NULL,
  `is_available` varchar(11) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bom_sub_ledger`
--

CREATE TABLE `bom_sub_ledger` (
  `id` int(11) NOT NULL,
  `ledgerid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `is_available` varchar(11) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bom_sub_material`
--

CREATE TABLE `bom_sub_material` (
  `id` int(11) NOT NULL,
  `materialid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `price` float NOT NULL,
  `total` double NOT NULL,
  `is_available` varchar(11) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_other`
--

CREATE TABLE `bussiness_other` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `note` text NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bussiness_other`
--

INSERT INTO `bussiness_other` (`id`, `type`, `note`, `updateddate`) VALUES
(5, 'New Type', 'new', '2019-12-03 13:15:59'),
(6, 'whole sale', '', '2020-03-24 08:59:36'),
(7, 'Retail', '', '2020-03-24 09:00:00'),
(8, 'Manufacturing', '', '2020-03-24 09:00:27'),
(9, 'Distributor', '', '2020-03-24 09:00:49'),
(10, 'schools', '', '2020-03-24 09:01:06'),
(11, 'colleges', '', '2020-03-24 09:01:14'),
(12, 'IT', '', '2020-04-09 14:56:59'),
(13, 'FMCG', '', '2020-07-08 10:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_type`
--

CREATE TABLE `bussiness_type` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `note` text NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bussiness_type`
--

INSERT INTO `bussiness_type` (`id`, `type`, `note`, `updateddate`) VALUES
(2, 'd', 'sdfsdfsdfsdf', '2019-11-22 13:09:07'),
(3, 'individual', '', '2019-12-09 10:24:01'),
(4, 'corporate', '', '2019-12-09 10:24:11'),
(5, 'company', '', '2019-12-09 10:24:57'),
(6, 'Trust', '', '2020-03-24 09:14:02'),
(7, 'Franchise', '', '2020-07-08 10:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cess_tbl`
--

CREATE TABLE `cess_tbl` (
  `ces_id` int(11) NOT NULL,
  `ces_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `name_lan` varchar(500) DEFAULT NULL,
  `ces_percent` decimal(10,3) NOT NULL,
  `cess_on_tax` tinyint(1) NOT NULL,
  `cess_on_item` tinyint(1) NOT NULL,
  `ces_start_date` date NOT NULL,
  `ces_end_date` date NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cess_tbl`
--

INSERT INTO `cess_tbl` (`ces_id`, `ces_name`, `name_lan`, `ces_percent`, `cess_on_tax`, `cess_on_item`, `ces_start_date`, `ces_end_date`, `published`, `updatedate`) VALUES
(1, 'Kerala Flood Cess', NULL, '1.000', 1, 0, '2018-01-01', '2021-07-31', 'yes', '2021-07-29 05:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `chqdetails`
--

CREATE TABLE `chqdetails` (
  `chq_id` int(11) NOT NULL,
  `chq_trans` enum('Clearing','Issue') NOT NULL,
  `chq_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `chq_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `chq_amount` decimal(10,2) NOT NULL,
  `chq_bank` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `chq_status` enum('Cleared','Submitted','Rejected') NOT NULL,
  `chq_frm` int(11) NOT NULL,
  `chq_to` int(11) NOT NULL,
  `chq_sdate` date NOT NULL,
  `chq_details` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `collected_by` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(20) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `comkey` varchar(6) CHARACTER SET utf8 NOT NULL,
  `retail_store_id` varchar(500) NOT NULL DEFAULT '',
  `logo` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `is_multiplegodown` enum('1','0','','') NOT NULL,
  `address` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 NOT NULL,
  `tin` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `FSSAI` varchar(100) NOT NULL,
  `details` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `menutype` int(11) NOT NULL,
  `company_master` int(11) NOT NULL,
  `email` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `name_lan` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_lan` varchar(1500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `is_main`, `name`, `comkey`, `retail_store_id`, `logo`, `is_multiplegodown`, `address`, `phone`, `tin`, `FSSAI`, `details`, `menutype`, `company_master`, `email`, `name_lan`, `address_lan`, `updatedate`) VALUES
(1, 0, 'New Company', '123', '', '', '', 'Company Address', '11111111', 'GSTNO', '', 'Company Details', 1, 1, 'comemail@gmail.com', NULL, NULL, '2022-06-25 08:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `company_branch`
--

CREATE TABLE `company_branch` (
  `brc_id` int(11) NOT NULL,
  `brc_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `brc_address` text NOT NULL,
  `brc_phone` varchar(500) NOT NULL,
  `brc_email` varchar(500) NOT NULL,
  `brc_tin` varchar(500) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_branch`
--

INSERT INTO `company_branch` (`brc_id`, `brc_name`, `brc_address`, `brc_phone`, `brc_email`, `brc_tin`, `updatedate`) VALUES
(1, 'main', '<p>\r\n	Address</p>\r\n', '', '', '', '2020-07-06 10:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `id` int(11) NOT NULL,
  `grp_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `no_sub_company` int(11) NOT NULL,
  `contact_person` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `contact_number` varchar(13) CHARACTER SET utf8 NOT NULL,
  `address` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `created_date` date NOT NULL,
  `created_by` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `end_date` date NOT NULL,
  `subcription` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `grp_name`, `no_sub_company`, `contact_person`, `contact_number`, `address`, `created_date`, `created_by`, `end_date`, `subcription`, `updatedate`) VALUES
(1, 'ss', 4, 'sss', 'sss', 'ss', '2017-07-22', 'ss', '2017-07-22', 1, '2018-01-28 06:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `comset_id` int(20) NOT NULL,
  `com_id` int(20) NOT NULL,
  `is_makemodel` tinyint(1) NOT NULL DEFAULT '0',
  `comset_statecode` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `comset_currency` int(11) NOT NULL,
  `comset_currrncy_symbol` varchar(30) CHARACTER SET utf8 NOT NULL,
  `terms_condition` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `comset_account_no` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `comset_ifsccode` varchar(1100) CHARACTER SET utf8 NOT NULL,
  `comset_bank` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `comset_declaration` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `comset_state` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `select_master` tinyint(1) NOT NULL,
  `is_godown` tinyint(1) NOT NULL,
  `item_rack` tinyint(1) NOT NULL,
  `is_unit` tinyint(1) NOT NULL,
  `is_confirm` enum('0','1') NOT NULL,
  `is_itemcode` tinyint(1) NOT NULL,
  `barcode_settings` tinyint(1) NOT NULL,
  `is_discription` tinyint(1) NOT NULL,
  `is_billtype` tinyint(1) NOT NULL,
  `is_bankac` tinyint(1) NOT NULL,
  `is_batch` tinyint(1) NOT NULL,
  `is_taxincluded` tinyint(1) NOT NULL,
  `item_commission` tinyint(1) NOT NULL,
  `item_min_rate` tinyint(1) NOT NULL,
  `is_ageing` tinyint(1) NOT NULL,
  `is_adjustment` tinyint(1) NOT NULL,
  `is_size` tinyint(1) NOT NULL DEFAULT '0',
  `com_tax_type` enum('GST','VAT') NOT NULL DEFAULT 'GST',
  `is_cess` tinyint(1) NOT NULL,
  `is_production` tinyint(1) NOT NULL,
  `is_item_type` tinyint(1) DEFAULT '1',
  `crm_type` enum('CRM','COURSE_CRM') NOT NULL,
  `is_kitgroup` tinyint(1) NOT NULL,
  `is_cash_collection` tinyint(1) NOT NULL,
  `is_kitcustomer` tinyint(1) NOT NULL,
  `is_analytics` tinyint(1) NOT NULL,
  `is_costcenter` tinyint(1) NOT NULL,
  `is_multipletax` tinyint(1) NOT NULL,
  `is_composite` tinyint(1) NOT NULL,
  `item_image` tinyint(1) NOT NULL,
  `item_video` tinyint(1) NOT NULL,
  `item_advanced` tinyint(4) NOT NULL DEFAULT '0',
  `item_alternate` tinyint(1) NOT NULL,
  `is_bkground_print` tinyint(1) NOT NULL,
  `is_autobarcode` tinyint(1) DEFAULT NULL,
  `auto_barcode` varchar(1500) NOT NULL DEFAULT '1000',
  `barcode_preffix` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`comset_id`, `com_id`, `is_makemodel`, `comset_statecode`, `comset_currency`, `comset_currrncy_symbol`, `terms_condition`, `comset_account_no`, `comset_ifsccode`, `comset_bank`, `comset_declaration`, `comset_state`, `select_master`, `is_godown`, `item_rack`, `is_unit`, `is_confirm`, `is_itemcode`, `barcode_settings`, `is_discription`, `is_billtype`, `is_bankac`, `is_batch`, `is_taxincluded`, `item_commission`, `item_min_rate`, `is_ageing`, `is_adjustment`, `is_size`, `com_tax_type`, `is_cess`, `is_production`, `is_item_type`, `crm_type`, `is_kitgroup`, `is_cash_collection`, `is_kitcustomer`, `is_analytics`, `is_costcenter`, `is_multipletax`, `is_composite`, `item_image`, `item_video`, `item_advanced`, `item_alternate`, `is_bkground_print`, `is_autobarcode`, `auto_barcode`, `barcode_preffix`) VALUES
(1, 1, 1, '45', 1, '$', 'Terms n Conditions', '45645645623', '4564564562', 'SBI', '', 'Kerala', 1, 0, 1, 1, '1', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 'GST', 1, 1, 1, 'CRM', 0, 1, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, '001', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_subcription`
--

CREATE TABLE `company_subcription` (
  `id` int(11) NOT NULL,
  `subcription_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `subcription_version` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `details` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `created_date` date NOT NULL,
  `created_by` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_subcription`
--

INSERT INTO `company_subcription` (`id`, `subcription_name`, `subcription_version`, `details`, `created_date`, `created_by`, `updatedate`) VALUES
(1, 'General', '1', 'General', '2018-01-16', '16/01/2018', '2018-01-28 06:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` int(11) NOT NULL,
  `type` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `discription` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_type`
--

INSERT INTO `company_type` (`id`, `type`, `discription`, `updatedate`) VALUES
(1, 'General', '', '2018-01-28 06:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `cost_centre`
--

CREATE TABLE `cost_centre` (
  `cost_id` int(11) NOT NULL,
  `cost_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `fk_cost_id` int(11) DEFAULT NULL,
  `cos_amountp` decimal(10,3) NOT NULL,
  `cost_description` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_centre`
--

INSERT INTO `cost_centre` (`cost_id`, `cost_name`, `name_lan`, `fk_cost_id`, `cos_amountp`, `cost_description`) VALUES
(1, 'Cost Center General', '12', 0, '0.000', '');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `cou_id` int(11) NOT NULL,
  `cou_code` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `cou_image` varchar(500) NOT NULL DEFAULT 'no_image.png',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `cou_discountp` decimal(10,3) NOT NULL,
  `cou_discount` decimal(10,3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `published` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_debit_voucher`
--

CREATE TABLE `credit_debit_voucher` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bill_type` int(11) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `type` enum('credit_note','debit_note') NOT NULL DEFAULT 'credit_note',
  `main_ledger` int(11) NOT NULL,
  `narration` text NOT NULL,
  `ref_no` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `credit_debit_voucher_trans`
--

CREATE TABLE `credit_debit_voucher_trans` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `ledger` int(11) NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `crm_batch`
--

CREATE TABLE `crm_batch` (
  `id` int(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crm_batch`
--

INSERT INTO `crm_batch` (`id`, `batch`, `note`, `updateddate`, `name_lan`) VALUES
(1, 'JUN-2019', '', '2019-11-06 10:44:49', '1'),
(2, 'DEC-2019', '', '2019-11-06 10:44:58', '1'),
(3, 'JUN-2020', '', '2019-11-06 10:45:07', '1'),
(4, 'DEC-2020', '', '2019-11-06 10:45:16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `crm_student`
--

CREATE TABLE `crm_student` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cst` varchar(15) CHARACTER SET utf8 NOT NULL,
  `pincode` int(11) NOT NULL,
  `email` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `adhar` bigint(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('female','male','other') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'female',
  `age` int(11) NOT NULL,
  `father` text COLLATE utf8_unicode_ci NOT NULL,
  `mother` text COLLATE utf8_unicode_ci NOT NULL,
  `lan` bigint(11) NOT NULL,
  `qualify` text COLLATE utf8_unicode_ci NOT NULL,
  `allocid` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `enrollment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `materials` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `stud_status` text COLLATE utf8_unicode_ci NOT NULL,
  `reference` text COLLATE utf8_unicode_ci NOT NULL,
  `refby` text COLLATE utf8_unicode_ci NOT NULL,
  `refmob` bigint(20) NOT NULL,
  `plan` int(11) NOT NULL,
  `address_line1` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `address_line2` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `type` varchar(4) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `area` int(11) DEFAULT '1',
  `route` enum('passed','failed','other') COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_list` int(11) DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `batch` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency_tbl`
--

CREATE TABLE `currency_tbl` (
  `crr_id` int(11) NOT NULL,
  `crr_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `crr_symbol` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_tax` enum('yes','no') NOT NULL,
  `crr_value` decimal(10,2) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_tbl`
--

INSERT INTO `currency_tbl` (`crr_id`, `crr_name`, `crr_symbol`, `is_tax`, `crr_value`, `updatedate`, `name_lan`) VALUES
(1, 'Indian Rupees', '₹', 'yes', '0.00', '2018-12-29 11:23:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_dollar_value`
--

CREATE TABLE `daily_dollar_value` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `dollar_value` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updatetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `damage`
--

CREATE TABLE `damage` (
  `damage_id` int(11) NOT NULL,
  `invoice` varchar(1000) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `salesman` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damage`
--

INSERT INTO `damage` (`damage_id`, `invoice`, `date`, `salesman`, `user`, `customer_id`, `published`) VALUES
(1, '', '2019-12-17', 0, 0, 0, 'yes'),
(2, '', '2019-12-17', 0, 0, 0, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_user`
--

CREATE TABLE `dashboard_user` (
  `id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `usertype` int(11) NOT NULL,
  `file` varchar(1000) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard_user`
--

INSERT INTO `dashboard_user` (`id`, `name`, `usertype`, `file`) VALUES
(1, 'superuser', 1, 'sadmin'),
(2, 'user', 2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_method`
--

CREATE TABLE `delivery_method` (
  `delivery_method_id` int(11) NOT NULL,
  `delivery_method` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `type` enum('delivery_method','payment_method') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_method_states`
--

CREATE TABLE `delivery_method_states` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE `delivery_type` (
  `id` int(11) NOT NULL,
  `delivery_type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `percent` int(11) NOT NULL,
  `name_lan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `name`, `percent`, `name_lan`) VALUES
(1, 'Discount 5000', 5000, ''),
(2, 'Discount 1750', 1750, ''),
(3, 'Discount 6750', 6750, ''),
(4, 'DISCOUNT 3500', 3500, ''),
(5, 'Discount 300', 300, ''),
(6, 'Discunt 500', 500, ''),
(7, 'Discount 1000', 1000, ''),
(8, 'Discount 1500', 1500, ''),
(9, 'Discount 2000', 2000, ''),
(10, 'Discount 2800', 2800, '');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` char(100) NOT NULL,
  `district_state` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `document_id` int(11) NOT NULL,
  `document_name` text NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`document_id`, `document_name`, `note`) VALUES
(1, 'SSLC Certificate', ''),
(2, 'Degree Certificate', ''),
(3, 'PG Certificate', ''),
(4, 'Driving Licence', ''),
(5, 'Post_Graduate', ''),
(6, 'Plus two', ''),
(7, 'Passport', ''),
(8, 'Iqama', ''),
(9, 'Visa ', ''),
(10, 'Insurance Certificate', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_allocation`
--

CREATE TABLE `enquiry_allocation` (
  `id` int(11) NOT NULL,
  `followup` int(11) NOT NULL DEFAULT '0',
  `Sdate` date NOT NULL,
  `enq_id` int(11) NOT NULL,
  `enq_user` text NOT NULL,
  `user` text NOT NULL,
  `Edate` date NOT NULL,
  `Ddate` date NOT NULL,
  `remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_closure`
--

CREATE TABLE `enquiry_closure` (
  `id` int(11) NOT NULL,
  `enq_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dates` varchar(100) NOT NULL,
  `amounts` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_followup`
--

CREATE TABLE `enquiry_followup` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `label` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `next_follow_up_date` date NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_product`
--

CREATE TABLE `enquiry_product` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_register`
--

CREATE TABLE `enquiry_register` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `next_follow_up_date` date NOT NULL,
  `label` int(11) NOT NULL DEFAULT '0',
  `statuss` int(11) NOT NULL DEFAULT '0',
  `course` int(11) NOT NULL DEFAULT '0',
  `loggedin` int(11) DEFAULT NULL,
  `stud_id` int(11) DEFAULT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `parentsName` varchar(100) DEFAULT NULL,
  `parentsInfo` varchar(100) DEFAULT NULL,
  `collegeName` varchar(100) DEFAULT NULL,
  `location_id` varchar(100) DEFAULT NULL,
  `refperson` varchar(100) DEFAULT NULL,
  `ref_per_contact` varchar(100) DEFAULT NULL,
  `area` int(11) NOT NULL DEFAULT '1',
  `lead_id` int(11) DEFAULT NULL,
  `contactPerson` varchar(100) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `contactNumber` varchar(100) DEFAULT NULL,
  `user` varchar(500) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `typebuss` int(11) DEFAULT NULL,
  `unbuss` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `collectedPerson` varchar(100) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `type` varchar(500) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `allocatedAmount` decimal(10,2) DEFAULT NULL,
  `closedAmount` decimal(10,2) DEFAULT NULL,
  `enquaryAmount` decimal(10,2) DEFAULT NULL,
  `gst` varchar(500) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `allocate_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feestructure`
--

CREATE TABLE `feestructure` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `university` int(11) NOT NULL,
  `totalfee` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `discountpercent` int(11) NOT NULL,
  `refname` text NOT NULL,
  `refmob` bigint(20) NOT NULL,
  `discountedfee` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finished_goods`
--

CREATE TABLE `finished_goods` (
  `fga_id` int(11) NOT NULL,
  `fgm_id` int(11) NOT NULL,
  `main_item_id` int(11) NOT NULL,
  `fga_quantity` decimal(10,3) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finished_goods_main`
--

CREATE TABLE `finished_goods_main` (
  `fgm_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_godown` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `finished_goods_sub`
--

CREATE TABLE `finished_goods_sub` (
  `fgb_id` int(11) NOT NULL,
  `fga_id` int(11) NOT NULL,
  `fgm_id` int(11) NOT NULL,
  `main_item_id` int(11) NOT NULL,
  `sub_item_id` int(11) NOT NULL,
  `fgb_quantity` decimal(10,3) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fin_year`
--

CREATE TABLE `fin_year` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `godown`
--

CREATE TABLE `godown` (
  `id` int(11) NOT NULL,
  `godown_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `godown_address` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `godown_contactno` varchar(13) CHARACTER SET utf8 NOT NULL,
  `godown_contact_person` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `company` int(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `godown`
--

INSERT INTO `godown` (`id`, `godown_name`, `godown_address`, `godown_contactno`, `godown_contact_person`, `company`, `updatedate`) VALUES
(1, 'Main Location', 'address', '3232144455', '', 1, '2018-12-14 06:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `godown_type`
--

CREATE TABLE `godown_type` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `discription` varchar(500) NOT NULL,
  `field1` varchar(500) NOT NULL,
  `field2` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_booking`
--

CREATE TABLE `hotel_booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bok_start_date` date NOT NULL DEFAULT '0000-00-00',
  `bok_end_date` date NOT NULL DEFAULT '0000-00-00',
  `image` varchar(500) NOT NULL DEFAULT '',
  `id_proof` varchar(500) NOT NULL DEFAULT '',
  `is_taxincluded` enum('0','1') NOT NULL DEFAULT '0',
  `booking_phone` varchar(100) NOT NULL,
  `booking_date` date NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL DEFAULT '0000-00-00',
  `booking_email` varchar(100) NOT NULL,
  `booking_advance` decimal(10,2) NOT NULL,
  `booking_packs` varchar(100) NOT NULL,
  `booking_amount` decimal(10,2) NOT NULL,
  `booking_tax` decimal(10,2) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_status` enum('Created','Checkin','Checkout','Completed') NOT NULL DEFAULT 'Created'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_booking_details`
--

CREATE TABLE `hotel_booking_details` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `extra_beds` int(11) NOT NULL,
  `room_rate` decimal(10,2) NOT NULL,
  `extra_bed_rate` decimal(10,2) NOT NULL,
  `total_extra_bed_rate` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_floor`
--

CREATE TABLE `hotel_floor` (
  `flr_id` int(11) NOT NULL,
  `flr_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room`
--

CREATE TABLE `hotel_room` (
  `id` int(11) NOT NULL,
  `flr_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_description` varchar(100) NOT NULL,
  `room_floor` varchar(100) NOT NULL,
  `room_max_num` varchar(100) NOT NULL,
  `room_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_category`
--

CREATE TABLE `hotel_room_category` (
  `id` int(11) NOT NULL,
  `roomcat_name` varchar(100) NOT NULL,
  `roomcat_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_rate`
--

CREATE TABLE `hotel_room_rate` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_amount` varchar(100) NOT NULL,
  `room_bedcost` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_type`
--

CREATE TABLE `hotel_room_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_bloodgroup`
--

CREATE TABLE `hr_bloodgroup` (
  `blood_id` int(11) NOT NULL,
  `blood_name` varchar(100) NOT NULL,
  `blood_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_bloodgroup`
--

INSERT INTO `hr_bloodgroup` (`blood_id`, `blood_name`, `blood_description`) VALUES
(1, 'midhun', 'koool'),
(4, 'midhun', 'good'),
(5, 'blood', 'donor'),
(6, 'universal', 'donor');

-- --------------------------------------------------------

--
-- Table structure for table `hr_course`
--

CREATE TABLE `hr_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_course`
--

INSERT INTO `hr_course` (`course_id`, `course_name`) VALUES
(1, 'Plus Two'),
(2, 'Post Graduate'),
(3, 'Degree'),
(4, 'SSLC'),
(5, 'Degree'),
(7, 'Post Graduate'),
(8, 'Degree'),
(9, 'Old'),
(10, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `hr_department`
--

CREATE TABLE `hr_department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_department`
--

INSERT INTO `hr_department` (`dept_id`, `dept_name`, `dept_description`) VALUES
(8, 'sales ', ''),
(9, 'Purchase', ''),
(10, 'accountent&purchase', ''),
(12, 'manager', ''),
(13, 'store keeper', ''),
(14, 'delivery', '');

-- --------------------------------------------------------

--
-- Table structure for table `hr_designation`
--

CREATE TABLE `hr_designation` (
  `desig_id` int(11) NOT NULL,
  `desig_name` varchar(100) NOT NULL,
  `desig_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_education`
--

CREATE TABLE `hr_education` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `pro_mobile` varchar(30) NOT NULL,
  `edu_course` varchar(100) NOT NULL,
  `edu_start_date` date NOT NULL,
  `edu_end_date` date NOT NULL,
  `edu_type` varchar(100) NOT NULL,
  `edu_percent` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_education`
--

INSERT INTO `hr_education` (`id`, `emp_id`, `pro_mobile`, `edu_course`, `edu_start_date`, `edu_end_date`, `edu_type`, `edu_percent`) VALUES
(2, 1, '', '3', '2019-11-24', '2019-11-24', 'Full', '1100'),
(3, 2, '', '3', '2019-11-23', '2019-11-23', 'Full', '30');

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_documents`
--

CREATE TABLE `hr_employee_documents` (
  `doc_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `document_type` int(11) NOT NULL,
  `document` text NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_leave`
--

CREATE TABLE `hr_employee_leave` (
  `emp_leave_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_emp_dist_details`
--

CREATE TABLE `hr_emp_dist_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `emp_salary` decimal(10,3) NOT NULL DEFAULT '0.000',
  `employee_paid` decimal(10,3) NOT NULL,
  `total` decimal(10,3) NOT NULL DEFAULT '0.000',
  `distribution_id` int(11) NOT NULL,
  `leave_days` decimal(10,3) NOT NULL,
  `extra_leaves` decimal(10,3) NOT NULL DEFAULT '0.000',
  `status` enum('created','paid') NOT NULL DEFAULT 'created',
  `last_paid_date` date NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_emp_salary`
--

CREATE TABLE `hr_emp_salary` (
  `sal_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_holidays`
--

CREATE TABLE `hr_holidays` (
  `holi_id` int(11) NOT NULL,
  `holi_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_holidays`
--

INSERT INTO `hr_holidays` (`holi_id`, `holi_name`, `start_date`, `end_date`) VALUES
(1, 'sadsad', '2019-07-22', '2019-07-22'),
(2, 'lopangafsy', '2019-01-07', '0000-00-00'),
(4, 'kuttapi', '2019-11-07', '2019-05-07'),
(7, 'final', '2019-09-07', '0000-00-00'),
(8, 'saddasdasdsadsa', '0000-00-00', '2019-11-07'),
(9, '123', '0000-00-00', '0000-00-00'),
(10, '1234', '2019-06-08', '0000-00-00'),
(11, 'qw', '2019-08-08', '0000-00-00'),
(12, 'dday', '0000-00-00', '0000-00-00'),
(13, 'sday', '2019-07-08', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_jobdetails`
--

CREATE TABLE `hr_jobdetails` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `Job_date` date NOT NULL,
  `job_department` varchar(100) NOT NULL,
  `job_role` varchar(100) NOT NULL,
  `job_email` varchar(100) NOT NULL,
  `job_date_joining` date NOT NULL,
  `job_date_leaving` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_leavetype`
--

CREATE TABLE `hr_leavetype` (
  `leave_id` int(11) NOT NULL,
  `leave_name` varchar(100) NOT NULL,
  `leave_days` varchar(100) NOT NULL,
  `max_deduction_precentage` decimal(10,2) NOT NULL DEFAULT '60.00',
  `max_earning_percentage` decimal(10,2) NOT NULL DEFAULT '60.00',
  `primary_deduction_precentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sec_deduction_percentage` decimal(10,2) NOT NULL,
  `pri_deduction_period` int(11) NOT NULL,
  `pri_earning_percentage` decimal(10,2) NOT NULL,
  `deduction_base` enum('Bonus','Basic_salary') NOT NULL DEFAULT 'Bonus',
  `is_fixed` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_leavetype`
--

INSERT INTO `hr_leavetype` (`leave_id`, `leave_name`, `leave_days`, `max_deduction_precentage`, `max_earning_percentage`, `primary_deduction_precentage`, `sec_deduction_percentage`, `pri_deduction_period`, `pri_earning_percentage`, `deduction_base`, `is_fixed`, `is_active`) VALUES
(1, 'Sick Leave', '12', '60.00', '60.00', '5.00', '0.00', 0, '0.00', 'Bonus', 0, 1),
(2, 'Casual Leave', '12', '60.00', '60.00', '20.00', '3.00', 7, '2.00', 'Bonus', 0, 0),
(3, 'Earned Leave', '15', '60.00', '60.00', '5.00', '0.00', 10, '0.00', 'Bonus', 0, 0),
(4, 'Transfer Leave', '3', '60.00', '60.00', '5.00', '0.00', 0, '0.00', 'Bonus', 0, 1),
(5, 'vacation leave', '60-90', '60.00', '60.00', '25.00', '2.00', 0, '0.00', 'Bonus', 1, 0),
(6, 'emergency leave genuine', '15-60', '60.00', '60.00', '20.00', '3.00', 7, '10.00', 'Bonus', 1, 1),
(7, 'emergency leave non genuine', '15', '60.00', '60.00', '5.00', '0.00', 0, '0.00', 'Bonus', 1, 1),
(8, 'joining date', '1', '1.00', '1.00', '1.00', '1.00', 1, '1.00', 'Bonus', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hr_paysettings`
--

CREATE TABLE `hr_paysettings` (
  `pay_id` int(11) NOT NULL,
  `pay_name` varchar(100) NOT NULL,
  `pay_type` varchar(100) NOT NULL,
  `is_varying` tinyint(4) DEFAULT '0',
  `series_no` int(11) NOT NULL,
  `pay_enable` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_paysettings`
--

INSERT INTO `hr_paysettings` (`pay_id`, `pay_name`, `pay_type`, `is_varying`, `series_no`, `pay_enable`) VALUES
(1, 'HRA', 'Earnings', 0, 0, 1),
(4, 'Bank', 'Deductions', 0, 0, 1),
(5, 'Advance', 'Deductions', 0, 0, 1),
(6, 'Salary', 'Earnings', 1, 0, 1),
(8, 'Bonus', 'Earnings', 0, 0, 1),
(9, 'Incenteve', 'Earnings', 0, 0, 1),
(11, 'Ot', 'Earnings', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_pay_details`
--

CREATE TABLE `hr_pay_details` (
  `pay_id` int(11) NOT NULL,
  `distribution_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `paying_amount` decimal(10,3) NOT NULL,
  `notes` text NOT NULL,
  `paid_amount` decimal(10,3) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_pay_details`
--

INSERT INTO `hr_pay_details` (`pay_id`, `distribution_id`, `employee_id`, `paying_amount`, `notes`, `paid_amount`, `amount`, `date`) VALUES
(1, 2, 4, '125.000', '', '0.000', '0.000', '2019-12-11'),
(972, 27, 29, '65.000', 'slahudheen ot 5ro mistake', '0.000', '0.000', '2022-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `hr_profile`
--

CREATE TABLE `hr_profile` (
  `emp_id` int(11) NOT NULL,
  `pro_fname` varchar(100) NOT NULL,
  `pro_lname` varchar(100) NOT NULL,
  `pro_permt_address` varchar(100) NOT NULL,
  `pro_cur_address` varchar(100) NOT NULL,
  `pro_email` varchar(100) NOT NULL,
  `pro_mobile` varchar(30) NOT NULL,
  `pro_image` varchar(100) NOT NULL,
  `allowed_leaves` int(11) NOT NULL,
  `pro_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_role`
--

CREATE TABLE `hr_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_role`
--

INSERT INTO `hr_role` (`role_id`, `role_name`, `role_description`) VALUES
(10, 'super adimn', ''),
(11, 'admin', '01'),
(12, 'sales', ''),
(13, 'purchase', ''),
(14, 'supervisor', ''),
(15, 'manger', ''),
(16, 'accontent', ''),
(17, 'data entry', ''),
(18, 'delivery', ''),
(19, 'sales support', '');

-- --------------------------------------------------------

--
-- Table structure for table `hr_salary_components`
--

CREATE TABLE `hr_salary_components` (
  `id` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `component_type` varchar(500) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `note` text NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_salary_distribution`
--

CREATE TABLE `hr_salary_distribution` (
  `distribution_id` int(11) NOT NULL,
  `month` varchar(500) NOT NULL,
  `year` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `notes` text NOT NULL,
  `is_paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_salary_package`
--

CREATE TABLE `hr_salary_package` (
  `package_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `note` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `renewal_date` date NOT NULL,
  `disabled_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('inactive','active') NOT NULL DEFAULT 'active',
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_sal_dist_components`
--

CREATE TABLE `hr_sal_dist_components` (
  `id` int(11) NOT NULL,
  `sal_dis_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `component_type` varchar(500) NOT NULL,
  `status` enum('created','paid') NOT NULL DEFAULT 'created',
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_sal_pack_components`
--

CREATE TABLE `hr_sal_pack_components` (
  `sal_com_id` int(11) NOT NULL,
  `sal_pack_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `component_type` text NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_sal_pack_components`
--

INSERT INTO `hr_sal_pack_components` (`sal_com_id`, `sal_pack_id`, `component_id`, `component_type`, `amount`, `published`) VALUES
(1, 1, 1, 'Earnings', '0.000', 'no'),
(2, 1, 6, 'Earnings', '100.000', 'no'),
(3, 1, 7, 'Earnings', '0.000', 'no'),
(4, 1, 8, 'Earnings', '0.000', 'no'),
(5, 1, 4, 'Deductions', '0.000', 'no'),
(6, 1, 5, 'Deductions', '0.000', 'no'),
(7, 2, 1, 'Earnings', '0.000', 'no'),
(8, 2, 6, 'Earnings', '110.000', 'no'),
(2067, 240, 5, 'Deductions', '0.000', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `hr_visa_passport_details`
--

CREATE TABLE `hr_visa_passport_details` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `visa_type` varchar(100) NOT NULL,
  `iqama_no` varchar(500) NOT NULL,
  `iqama_issue_date` date NOT NULL,
  `iqama_end_date` date NOT NULL,
  `passport_no` varchar(500) NOT NULL,
  `pass_issue_date` date NOT NULL,
  `pass_end_date` date NOT NULL,
  `licence` varchar(500) NOT NULL,
  `licence_issue_date` date NOT NULL,
  `licence_end_date` date NOT NULL,
  `insurence` varchar(500) NOT NULL,
  `insurence_issue_date` date NOT NULL,
  `insurence_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_visa_type`
--

CREATE TABLE `hr_visa_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(500) NOT NULL,
  `type_code` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_visa_type`
--

INSERT INTO `hr_visa_type` (`id`, `type_name`, `type_code`) VALUES
(1, 'Visiting Visa', 'Vst'),
(2, 'Job Visa', 'Jv');

-- --------------------------------------------------------

--
-- Table structure for table `hsncode`
--

CREATE TABLE `hsncode` (
  `hsnid` int(11) NOT NULL,
  `hsn_main_id` int(11) NOT NULL DEFAULT '0',
  `hsncode` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `published` tinyint(4) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hsncode`
--

INSERT INTO `hsncode` (`hsnid`, `hsn_main_id`, `hsncode`, `published`, `updatedate`, `name_lan`) VALUES
(1, 0, '000', 1, '2019-04-19 15:54:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_area`
--

CREATE TABLE `ims_area` (
  `id` int(11) NOT NULL,
  `area` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `name_lan` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `details` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_driver`
--

CREATE TABLE `ims_driver` (
  `Id` int(11) NOT NULL,
  `Driver_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `licence_no` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Address` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `Mobile` double NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_godown`
--

CREATE TABLE `ims_godown` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  `godown_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `godown_code` varchar(100) NOT NULL,
  `godown_address` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `godown_contactno` varchar(13) CHARACTER SET utf8 NOT NULL,
  `godown_contact_person` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `company` int(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_godown`
--

INSERT INTO `ims_godown` (`id`, `parent`, `type`, `godown_name`, `godown_code`, `godown_address`, `godown_contactno`, `godown_contact_person`, `company`, `updatedate`, `name_lan`) VALUES
(1, 0, '', 'Main Location', 'ML', 'Address', '', '', 1, '2019-03-18 15:42:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_pickup`
--

CREATE TABLE `ims_pickup` (
  `id` int(11) NOT NULL,
  `code` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `Name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `free_code` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_route`
--

CREATE TABLE `ims_route` (
  `id` int(11) NOT NULL,
  `route_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `area` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_vehicle`
--

CREATE TABLE `ims_vehicle` (
  `Id` int(11) NOT NULL,
  `Vehicle_num` varchar(25) CHARACTER SET utf8 NOT NULL,
  `driver` int(11) NOT NULL,
  `Freecode` int(11) NOT NULL,
  `Freecode2` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` int(20) NOT NULL,
  `instructions` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(100) UNSIGNED NOT NULL,
  `fin_sync_id` int(11) NOT NULL DEFAULT '0',
  `item_main_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `supplier` int(11) NOT NULL,
  `free_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `free_qty_for` decimal(10,2) NOT NULL DEFAULT '0.00',
  `part_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `part_no1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `part_no2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `make_model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `field_1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_3` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_4` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_5` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_6` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_7` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_8` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_9` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_10` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serv_time` time NOT NULL,
  `item_size_id` int(11) NOT NULL DEFAULT '0',
  `name_lan` varchar(500) CHARACTER SET utf8 NOT NULL,
  `brand_id` int(11) NOT NULL,
  `barcode` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `tutionfee` decimal(11,0) NOT NULL,
  `examfee` decimal(10,0) NOT NULL,
  `certificatefee` decimal(10,2) NOT NULL,
  `otherfee` decimal(10,2) NOT NULL,
  `university` int(11) NOT NULL,
  `price_code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `item_category_id` int(100) DEFAULT NULL,
  `item_group_id` int(11) NOT NULL,
  `unit_id` int(100) DEFAULT NULL,
  `item_wt` decimal(10,2) NOT NULL,
  `end_unit` int(11) NOT NULL,
  `end_unit_kg` decimal(10,2) NOT NULL,
  `item_color_id` int(11) NOT NULL,
  `sub_unit_one` int(11) NOT NULL DEFAULT '0',
  `sub_unit_two` int(11) NOT NULL DEFAULT '0',
  `open_stock` decimal(10,2) DEFAULT NULL,
  `current_stock` decimal(10,2) DEFAULT NULL,
  `reorder_point` int(11) NOT NULL,
  `min_level` int(11) NOT NULL,
  `max_level` int(11) NOT NULL,
  `rack` int(11) NOT NULL,
  `prate` decimal(10,2) DEFAULT NULL,
  `srate` decimal(10,2) DEFAULT NULL,
  `special_rate2` decimal(10,2) NOT NULL,
  `special_rate` decimal(10,2) NOT NULL,
  `wh_rate` decimal(10,2) NOT NULL,
  `MRP` int(11) NOT NULL,
  `open_stk_rate` float NOT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `tax_ledger_id` int(11) NOT NULL,
  `tax_sales_id` int(11) NOT NULL,
  `tax_purchase_id` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `hsncode` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `godown` int(11) NOT NULL DEFAULT '1',
  `description` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `material_type` int(11) NOT NULL,
  `analytics_id` int(11) NOT NULL,
  `is_autobarcode` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `item_online` enum('no','yes') COLLATE utf8_unicode_ci NOT NULL,
  `cess_id` int(11) NOT NULL DEFAULT '0',
  `war_period` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `landing_cost` float DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itemtypecategory`
--

CREATE TABLE `itemtypecategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `itemtypevalue` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtypecategory`
--

INSERT INTO `itemtypecategory` (`id`, `categoryid`, `itemtypevalue`, `published`) VALUES
(1, 45, 7, 'no'),
(2, 45, 8, 'no'),
(3, 45, 1, 'no'),
(4, 45, 5, 'no'),
(5, 45, 7, 'no'),
(6, 45, 8, 'no'),
(7, 45, 1, 'yes'),
(8, 45, 7, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `itemtypemaster`
--

CREATE TABLE `itemtypemaster` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtypemaster`
--

INSERT INTO `itemtypemaster` (`id`, `name`, `description`, `createddate`) VALUES
(1, 'RAM', 'MEMORY', '2020-05-06 06:48:51'),
(2, 'Display', '1', '2020-05-06 11:36:43'),
(3, 'displayww', 'gfgfgtf', '2020-05-08 11:17:20'),
(4, 'ram type', 'thghgh', '2020-05-08 11:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `itemtypevalue`
--

CREATE TABLE `itemtypevalue` (
  `id` int(11) NOT NULL,
  `itemtypeid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(200) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtypevalue`
--

INSERT INTO `itemtypevalue` (`id`, `itemtypeid`, `name`, `description`, `published`) VALUES
(1, 1, '2gb', 'Low memory', 'yes'),
(5, 1, '4gb', 'med', 'yes'),
(6, 1, '6gb', 'good', 'yes'),
(7, 2, '500px', '', 'yes'),
(8, 2, '54tr45tgr', '', 'yes'),
(9, 3, '1800', 'ffgh', 'yes'),
(10, 3, '200000', 'huhjuh', 'yes'),
(11, 4, 'DDR3', 'DDR3', 'yes'),
(12, 4, 'DDR4', 'DDR4', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item_alternates`
--

CREATE TABLE `item_alternates` (
  `iia_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `alt_item_id` int(11) NOT NULL,
  `type` enum('alternate','kitgroup') NOT NULL DEFAULT 'alternate',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_barcode`
--

CREATE TABLE `item_barcode` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `barcode` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `rate` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_brand`
--

CREATE TABLE `item_brand` (
  `ibr_id` int(11) NOT NULL,
  `ibr_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ibr_description` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `discount` int(11) NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_brand`
--

INSERT INTO `item_brand` (`ibr_id`, `ibr_name`, `ibr_description`, `updatedate`, `discount`, `name_lan`) VALUES
(1, 'General', '', '2020-08-17 10:06:33', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(100) UNSIGNED NOT NULL,
  `category_main_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `discount` int(11) NOT NULL,
  `item_type_id` int(100) DEFAULT NULL,
  `item_category_id` int(100) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category_main_id`, `name`, `discount`, `item_type_id`, `item_category_id`, `published`, `updatedate`, `name_lan`) VALUES
(1, 0, 'General', 0, NULL, NULL, 'yes', '2019-06-05 13:42:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_color`
--

CREATE TABLE `item_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `color_code` varchar(100) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_damage`
--

CREATE TABLE `item_damage` (
  `id` int(11) NOT NULL,
  `damage_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `batch` varchar(500) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_feature`
--

CREATE TABLE `item_feature` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `itemtypevalue` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_godown`
--

CREATE TABLE `item_godown` (
  `id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `batch` varchar(500) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `item_srate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_prate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_whrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_mrp` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_opnstkrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `published` enum('yes','no') NOT NULL,
  `current_stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `open_stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_group`
--

CREATE TABLE `item_group` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `discount` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_group`
--

INSERT INTO `item_group` (`id`, `name`, `discount`, `published`, `name_lan`, `updatedate`) VALUES
(2, 'zero', 0, 'yes', NULL, '2020-06-11 14:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE `item_image` (
  `iim_id` int(11) NOT NULL,
  `iim_type` enum('image','video','url') NOT NULL,
  `item_id` int(11) NOT NULL,
  `iim_name` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_ledger`
--

CREATE TABLE `item_ledger` (
  `id` int(100) UNSIGNED NOT NULL,
  `item_id` int(100) DEFAULT NULL,
  `batch` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `open_stock` decimal(10,2) DEFAULT '0.00',
  `voucher_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'voucher',
  `quantity` decimal(10,2) DEFAULT NULL,
  `item_base_quantity` decimal(10,2) NOT NULL,
  `item_unit_rate` decimal(10,2) NOT NULL,
  `item_tax` int(11) NOT NULL,
  `voucher_costcenter` int(11) NOT NULL,
  `voucher_branch` int(11) NOT NULL,
  `voucher_billtype` int(11) NOT NULL,
  `item_value` decimal(10,3) NOT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_type` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `trans_status` varchar(20) CHARACTER SET utf8 NOT NULL,
  `trans_id` int(100) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `MRP` decimal(10,2) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `godown` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_order_specification`
--

CREATE TABLE `item_order_specification` (
  `spec_id` int(11) NOT NULL,
  `spec_item` int(11) NOT NULL,
  `spec_type` enum('radio','check','text','text_area','date','select') NOT NULL,
  `specification` text NOT NULL,
  `label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_price`
--

CREATE TABLE `item_price` (
  `id` int(11) NOT NULL,
  `sales_rate` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_name` varchar(1500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_quantity_price`
--

CREATE TABLE `item_quantity_price` (
  `qprice_id` int(11) NOT NULL,
  `qprice_item` int(11) NOT NULL,
  `qprice_type` enum('above','below','between') NOT NULL,
  `qprice_below` int(11) NOT NULL,
  `qprice_above` int(11) NOT NULL,
  `qprice_min` int(11) NOT NULL,
  `qprice_max` int(11) NOT NULL,
  `qprice_rate` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_racks`
--

CREATE TABLE `item_racks` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rack_id` int(11) NOT NULL,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_racks_master`
--

CREATE TABLE `item_racks_master` (
  `id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `rows` int(11) NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_size`
--

CREATE TABLE `item_size` (
  `size_id` int(11) NOT NULL,
  `size_code` varchar(500) NOT NULL,
  `size` varchar(500) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_size`
--

INSERT INTO `item_size` (`size_id`, `size_code`, `size`, `updatedate`) VALUES
(1, 'Small', 'sm', '2020-04-24 13:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `item_sub_tags`
--

CREATE TABLE `item_sub_tags` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `code` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE `item_tags` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_tags_master`
--

CREATE TABLE `item_tags_master` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(500) NOT NULL,
  `code` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_transfer`
--

CREATE TABLE `item_transfer` (
  `id` int(11) NOT NULL,
  `invoice` varchar(500) NOT NULL DEFAULT '',
  `date` date NOT NULL,
  `eway_date` date NOT NULL,
  `eway_no` varchar(500) NOT NULL,
  `from_id` int(11) NOT NULL,
  `reference` varchar(500) NOT NULL DEFAULT '',
  `ref_date` date NOT NULL,
  `transport_mode` varchar(500) NOT NULL DEFAULT '',
  `vehicle_no` varchar(500) DEFAULT '',
  `purpose` varchar(500) NOT NULL DEFAULT '',
  `place` varchar(500) NOT NULL DEFAULT '',
  `published` enum('yes','no','','') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_unit` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_transfer_sub`
--

CREATE TABLE `item_transfer_sub` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `batch` varchar(500) NOT NULL,
  `stock_trans` varchar(500) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_rate` decimal(10,2) NOT NULL,
  `unit_id` int(11) NOT NULL DEFAULT '1',
  `base_unit_id` int(11) NOT NULL DEFAULT '1',
  `to_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `transfer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `published`, `updatedate`, `name_lan`) VALUES
(2, 'Services', 'yes', '2018-04-07 07:59:08', NULL),
(1, 'Goods', 'yes', '2018-04-07 07:59:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_video`
--

CREATE TABLE `item_video` (
  `iiv_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `iiv_name` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_work_order`
--

CREATE TABLE `job_work_order` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `voucher_no` varchar(500) NOT NULL,
  `customer` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `ref_no` varchar(500) NOT NULL,
  `despatch_through` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `vehicle_no` varchar(500) NOT NULL,
  `to_godown` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `status` enum('created','in','out','completed') NOT NULL DEFAULT 'created',
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_work_order_items`
--

CREATE TABLE `job_work_order_items` (
  `id` int(11) NOT NULL,
  `job_work_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `godown` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_work_order_raw_material`
--

CREATE TABLE `job_work_order_raw_material` (
  `id` int(11) NOT NULL,
  `job_work_order_id` int(11) NOT NULL,
  `job_work_order_item_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(100) UNSIGNED NOT NULL,
  `key` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `value` text CHARACTER SET utf8,
  `type` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `page` enum('sales','purchase','payment','reciept','journal','common') COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `value`, `type`, `page`, `details`, `published`, `updatedate`) VALUES
(3, 'cash', '1', '', '', 'cash Account', 'yes', '2018-01-28 06:45:39'),
(4, '2fapay', 'true', '', '', 'Two factor authentication for payment', 'yes', '2018-01-28 06:45:39'),
(5, 'paycode', 'PAY-250', '', '', 'Payment voucher code plus number', 'yes', '2018-01-28 06:45:39'),
(6, 'joucode', 'JOU-358', '', '', 'Journel voucher code plus number', 'yes', '2018-01-28 06:45:39'),
(7, 'reccode', 'REC-258', '', '', 'Receipt code plus number', 'yes', '2018-01-28 06:45:39'),
(8, 'sales8', 'S8-200', '', 'sales', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(9, 'estimate', 'EST-100', '', '', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(10, 'sales8b', 'S8B-200', '', 'sales', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(11, 'sales_return', 'SR-200', '', 'sales', 'sales_return', 'yes', '2018-01-28 06:45:39'),
(12, 'dprate', '1', '', '', 'default purchase rate show 1 and 0 shows code ', 'yes', '2018-01-28 06:45:39'),
(13, 'paper', 'A4', '', '', 'Default paper size', 'yes', '2018-01-28 06:45:39'),
(14, 'paperorient', 'P', '', '', 'paperorient potrait p', 'yes', '2018-01-28 06:45:39'),
(15, 'grpdiscount', '1', '', 'sales', '0 if not avilable', 'yes', '2018-01-28 06:45:39'),
(16, 'isbatch', '0', '', 'sales', 'Enable Batch', 'yes', '2018-04-07 05:27:45'),
(17, 'sales', 'DIMS-203', '', 'sales', 'sales', 'yes', '2018-01-28 06:45:39'),
(18, 'info', 'kdsfjhg kjhdgfhdsgkfdsg kjfdshfg\\adsgfk sdhgfdsg k', '', 'sales', 'sdmnfgdskjgfdsghfhds fjdsgfh sdagfhds gfhsdgfkds kfdsagfsadkfgsdh gfhsgdjfgsjdgfsajhfshadgfjasdgfhgdshfgjadsgfjsagdhfsajfg adsgfsadg jfasdjfgssjgfjdsag gfgads gfadsgfhdsah fdsgfhsdajfgdsjgfjadsgfsdajfgds fjasg fasgfhgasjfgsadhgfhdsagfgsadh gfsdah gfks adgfl safgslidfgsildgfi gr9ewqrqwi elriweqrweqlgrqewl9rgqewrigqewlri', 'yes', '2018-01-28 06:45:39'),
(19, 'abc', 'ss-10', '', '', 'sales abc bill number', 'yes', '2018-01-28 06:45:39'),
(20, 'is_godown', '1', '', '', 'godown check', 'yes', '2018-01-28 06:45:39'),
(21, 'General', '[{\"key\":\"com_tax_type\",\"value\":\"GST\",\"type\":\"select\"},{\"key\":\"item_transfer_bill\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_discription\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_billtype\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_cess\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_production\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_taxincluded\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_itemcode\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_ageing\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_analytics\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_costcenter\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_bankac\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_batch\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"barcode_settings\",\"value\":\"1\",\"type\":\"int\"}]', 'general', '', '', 'yes', '2021-07-19 07:25:18'),
(22, 'Item', '[{\"key\":\"item_image\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"item_video\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"additional_cess\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"item_alternate\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_multipletax\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"show_tax_ledger\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_item_type\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_godown\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_makemodel\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_confirm\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_unit\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"item_rack\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"item_commission\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"item_min_rate\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"item_advanced\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_autobarcode\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_size\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"barcode_preffix\",\"value\":\"Y\",\"type\":\"text\"},{\"key\":\"auto_barcode\",\"value\":\"1.000\",\"type\":\"decimal\"},{\"key\":\"is_feature\",\"value\":\"1\",\"type\":\"int\"}]', 'item', '', '', 'yes', '2021-07-19 07:27:27'),
(23, 'Sales', '[{\"key\":\"is_adjustment\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"round_off\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"sale_cash_type\",\"value\":\"cash\",\"type\":\"select\"},{\"key\":\"is_freequantity\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"global_mrp\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"global_mrp_value\",\"value\":\"0\",\"type\":\"decimal\"},{\"key\":\"global_discount\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_kitgroup\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_kitcustomer\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_cash_collection\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"is_composite\",\"value\":\"0\",\"type\":\"int\"},{\"key\":\"is_bkground_print\",\"value\":\"1\",\"type\":\"int\"}]', 'Sales', '', '', 'yes', '2021-07-19 07:29:08'),
(24, 'Purchase', '[]', 'Purchase', '', '', 'yes', '2020-04-14 14:39:47'),
(25, 'company', '[{\"key\":\"comset_currency\",\"value\":\"1\",\"type\":\"select\"},{\"key\":\"currency_symbol\",\"value\":\"Symbl\",\"type\":\"text\"},{\"key\":\"comset_bank\",\"value\":\"Bank\",\"type\":\"text\"},{\"key\":\"comset_account_no\",\"value\":\"Account Number\",\"type\":\"text\"},{\"key\":\"comset_ifsccode\",\"value\":\"IFSCCODE\",\"type\":\"text\"},{\"key\":\"crm_type\",\"value\":\"CRM\",\"type\":\"text\"},{\"key\":\"comset_statecode\",\"value\":\"45\",\"type\":\"select\"},{\"key\":\"terms_condition\",\"value\":\"terms_condition\",\"type\":\"text\"},{\"key\":\"comset_declaration\",\"value\":\"comset_declaration\",\"type\":\"text\"}]', 'company', '', '', 'yes', '2020-08-20 05:41:08'),
(26, 'Voucher', '[{\"key\":\"select_master\",\"value\":\"1\",\"type\":\"int\"}]', 'voucher', '', '', 'yes', '2020-04-24 13:01:20'),
(27, 'enquiry', '[{\"key\":\"User_Authentication\",\"value\":\"0\",\"type\":\"int\"}]', 'enquiry', '', '', 'yes', '2020-12-07 10:16:02'),
(28, 'Lead_master', '[{\"key\":\"Area\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"Type_of_Bussiness\",\"value\":\"\",\"type\":\"int\"},{\"key\":\"Source_Of_Enquiry\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"Nature_of_bussiness\",\"value\":\"1\",\"type\":\"int\"},{\"key\":\"State\",\"value\":\"1\",\"type\":\"int\"}]', 'lead_master', '', '', 'yes', '2020-12-01 07:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `kit_group`
--

CREATE TABLE `kit_group` (
  `id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `type` enum('kit_group','price_code') NOT NULL,
  `customer_id` int(11) NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 NOT NULL DEFAULT 'details'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kit_items`
--

CREATE TABLE `kit_items` (
  `id` int(11) NOT NULL,
  `kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `label_master`
--

CREATE TABLE `label_master` (
  `id` int(11) NOT NULL,
  `label` text NOT NULL,
  `note` text NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `label_master`
--

INSERT INTO `label_master` (`id`, `label`, `note`, `updateddate`) VALUES
(2, 'new', 'new after delete', '2019-11-25 11:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `lead_register`
--

CREATE TABLE `lead_register` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `next_follow_up_date` date DEFAULT NULL,
  `course` int(11) DEFAULT '0',
  `loggedin` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `area` int(11) DEFAULT '1',
  `route` enum('passed','failed','other') DEFAULT NULL,
  `contactPerson` varchar(100) DEFAULT NULL,
  `source` int(100) DEFAULT NULL,
  `contactNumber` varchar(100) DEFAULT NULL,
  `parentsName` varchar(500) NOT NULL,
  `parentsInfo` varchar(500) NOT NULL,
  `collegeName` varchar(500) NOT NULL,
  `refperson` varchar(500) NOT NULL,
  `ref_per_contact` varchar(500) NOT NULL,
  `user` varchar(500) DEFAULT NULL,
  `typebuss` int(11) DEFAULT NULL,
  `unbuss` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `collectedPerson` varchar(100) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `type` varchar(500) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `totalAmount` decimal(10,2) DEFAULT NULL,
  `allocatedAmount` decimal(10,2) DEFAULT NULL,
  `closedAmount` decimal(10,2) DEFAULT NULL,
  `enquaryAmount` decimal(10,2) DEFAULT NULL,
  `gst` varchar(500) DEFAULT NULL,
  `updateddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listitems`
--

CREATE TABLE `listitems` (
  `listitemid` int(10) UNSIGNED NOT NULL,
  `listid` int(10) UNSIGNED NOT NULL,
  `productid` int(10) UNSIGNED NOT NULL,
  `size` double UNSIGNED DEFAULT NULL,
  `units` varchar(255) DEFAULT NULL,
  `type` enum('tobuy','instock','fullinventory','mininventory') NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acctid` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `listid` int(10) UNSIGNED NOT NULL,
  `listname` varchar(255) NOT NULL,
  `acctid` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material_card`
--

CREATE TABLE `material_card` (
  `id` int(11) NOT NULL,
  `job_card_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `eway_no` varchar(500) NOT NULL,
  `eway_date` date NOT NULL,
  `voucher_no` varchar(500) NOT NULL,
  `ref_no` varchar(500) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `stock_status` enum('our_stock','third_party') NOT NULL,
  `job_card_voucher_no` varchar(100) NOT NULL,
  `godown` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_card_items`
--

CREATE TABLE `material_card_items` (
  `id` int(11) NOT NULL,
  `material_card_id` int(11) NOT NULL,
  `product_tbl_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `material_total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `material_type`
--

CREATE TABLE `material_type` (
  `mty_id` int(11) NOT NULL,
  `mty_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_type`
--

INSERT INTO `material_type` (`mty_id`, `mty_name`, `updatedate`, `name_lan`) VALUES
(1, 'Finished Goods', '2018-11-17 02:12:47', NULL),
(2, 'Raw Material', '2018-11-17 02:12:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `member_cate_id` int(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `address_line1` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `address_line2` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_category`
--

CREATE TABLE `member_category` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `rank` int(100) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_family`
--

CREATE TABLE `member_family` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `member_type_id` int(100) NOT NULL,
  `member_id` int(100) NOT NULL,
  `email` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `ListName` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `Url` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `menu_series` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `menu_key` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visibility` varchar(1000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `ListName`, `Url`, `parent`, `icon`, `menu_series`, `published`, `menu_key`, `updatedate`, `visibility`) VALUES
(9, 'Members', 'main/members/listall', 14, '', 3, 'yes', '', '2018-12-30 14:27:36', '[]'),
(10, 'Member Category', 'masters/member_category', 14, '', 1, 'yes', '', '2018-12-30 14:27:31', '[]'),
(11, 'Basic Units', 'BasicUnits/listall', 15, '', 204, 'yes', '', '2019-10-12 06:12:12', '[]'),
(12, 'Suppliers (Sundry Creditors)', 'suppliers/listall/sup', 15, '', 202, 'yes', '', '2019-10-12 06:11:59', '[]'),
(13, 'Accounts Master', NULL, 0, ' fa-anchor', 100, 'yes', '', '2019-10-12 05:50:09', '[]'),
(15, 'General Masters', NULL, 0, ' fa-gavel', 200, 'yes', '', '2019-10-12 05:50:12', '[]'),
(17, 'Company Info', 'company/com_info/listall', 123, '', 1, 'yes', '', '2019-02-13 13:33:28', '[]'),
(19, 'Sub Account', 'accounts/accsubtype', 13, '', 6, 'yes', '', '2019-05-02 06:10:15', '[]'),
(20, 'Main Account', 'accounts/acctype', 13, '', 7, 'yes', '', '2019-05-02 06:09:52', '[]'),
(21, 'Ledger Group', 'accounts_master/LedgerGroup/listall', 13, '', 4, 'yes', '', '2019-02-06 12:50:54', '[]'),
(22, 'Ledgers', 'accounts_master/Ledger/listall', 13, '', 5, 'yes', '', '2019-02-09 04:48:31', '[]'),
(24, 'Inventory Management', NULL, 0, ' fa-barcode', 300, 'yes', '', '2019-10-12 05:50:16', '[]'),
(25, 'Item Type', 'items\\itemtype', 24, '', 304, 'yes', '', '2019-10-12 06:17:35', '[]'),
(26, 'Category', 'items\\itemcategory', 24, '', 305, 'yes', '', '2019-10-12 06:17:38', '[]'),
(29, 'Transactions', NULL, 0, ' fa-balance-scale', 400, 'yes', '', '2019-10-12 05:50:21', '[]'),
(30, 'Payment Vouchers', 'transaction\\vouchers\\listall\\payment', 294, '', 1, 'yes', 'Alt+p', '2019-10-12 06:28:55', '[]'),
(31, 'Journal Vouchers', 'transaction\\vouchers\\listall\\journal', 294, '', 3, 'yes', '', '2019-10-12 06:28:58', '[]'),
(32, 'Receipt Vouchers', 'transaction\\vouchers\\listall\\receipt', 294, '', 2, 'yes', '', '2019-10-12 06:29:03', '[]'),
(33, 'Purchase Register', 'transaction/purchase/listall/purchase', 293, '', 406, 'yes', '', '2019-10-12 06:25:43', '[]'),
(35, 'Member Type', 'masters/member_type', 14, '', 2, 'yes', '', '2018-12-21 09:54:13', '[]'),
(36, 'Financial Reports', NULL, 0, ' fa-line-chart', 500, 'yes', '', '2019-10-12 05:50:25', '[]'),
(37, 'Ledger Book', 'reports/accounts/leadger', 36, '', 5, 'yes', '', '2022-11-07 14:02:05', '[]'),
(41, 'Cash Book', 'reports/accounts/cashbook', 36, '', 2, 'yes', '', '2018-12-30 14:30:12', '[]'),
(42, 'Day Book', 'reports/accounts/daybook', 36, '', 4, 'yes', '', '2018-12-30 14:30:23', '[]'),
(43, 'Trial Balance', 'reports/accounts/trial', 36, '', 7, 'yes', '', '2018-12-30 14:30:37', '[]'),
(44, 'Sales Order', 'transaction/sales/listall/estimate', 292, '', 405, 'yes', '', '2019-10-12 06:26:59', '[]'),
(45, 'Reference (Agent)', 'masters/reference', 15, '', 205, 'yes', '', '2019-10-12 06:12:20', '[]'),
(46, 'Customers (Sundry Debtor)', 'customers/listall', 15, '', 201, 'yes', '', '2019-10-12 06:11:54', '[]'),
(48, 'Sales Register', 'transaction/sales/listall/sales', 292, '', 403, 'yes', '', '2019-10-12 06:23:58', '[]'),
(49, 'Stock Ledger', 'reports/stock/leadger', 297, '', 15, 'yes', '', '2019-10-12 06:36:57', '[]'),
(50, 'Settings', NULL, 0, 'fa-gear', 800, 'yes', '', '2019-10-12 05:50:59', '[]'),
(51, 'Menus', 'masters/menu', 50, '', 804, 'yes', 'Alt+m', '2019-10-12 05:58:21', '[]'),
(52, 'Sales Return', 'transaction/sales/listall/sales_return', 292, '', 404, 'yes', '', '2019-10-12 06:23:48', '[]'),
(53, 'Check List', 'reports/accounts/checklist', 36, '', 3, 'yes', '', '2018-12-30 14:30:17', '[]'),
(54, 'Db Download', 'settings/setting/db_download', 50, '', 803, 'yes', '', '2019-10-12 05:58:13', '[]'),
(55, 'Item Discount Group', 'items\\itemgroup', 24, '', 306, 'yes', '', '2019-10-12 06:17:41', '[]'),
(57, 'Discount Group  Report', 'reports/sales/type', 297, '', 5, 'yes', '', '2020-06-18 02:11:55', '[]'),
(58, 'Item Master', 'inventory_master/Item/listall', 24, '', 301, 'yes', '', '2020-04-11 11:10:57', '[]'),
(60, 'Messages', 'settings/sms/msg', 290, '', 10, 'yes', '', '2019-10-12 05:57:00', '[]'),
(63, 'Districts', 'blood/blood/districts', 61, '', 1, 'yes', '', '2018-12-30 14:32:56', '[]'),
(87, 'GST', 'masters/gst', 15, '', 203, 'yes', '', '2019-10-12 06:12:06', '[]'),
(88, 'Hsn Code', 'masters/hsncode', 24, '', 303, 'yes', '', '2019-10-12 06:17:32', '[]'),
(89, 'Aging ', 'reports/aging/listall', 115, '', 1, 'yes', '', '2020-06-18 02:09:25', '[]'),
(91, 'Software Version', 'settings/SoftwareVersion/listall', 50, '', 815, 'yes', '', '2019-10-12 06:03:50', '[]'),
(92, 'Users', 'settings/NewMaster/Users', 291, '', 1, 'yes', '', '2019-10-12 06:01:21', '[]'),
(95, 'Company Settings', 'settings/CompanySettings/listall', 123, '', 3, 'yes', '', '2020-06-18 13:26:38', '[]'),
(97, 'Menu To User', 'settings/MenuToUser/listall', 291, '', 2, 'yes', '', '2019-10-12 06:01:27', '[]'),
(105, 'Purchase Return', 'transaction/purchase/listall/purchase_return', 293, '', 407, 'yes', 'Alt+r', '2019-10-12 06:26:07', '[]'),
(106, 'Purchase Order', 'transaction/purchase/listall/order	', 293, '', 408, 'yes', '', '2019-10-12 06:26:10', '[]'),
(108, 'Bill Types', 'master/Newmasters/bill_type', 50, '', 806, 'yes', '', '2019-10-12 06:03:18', '[]'),
(109, 'Area', 'master/Newmasters/Area	', 15, '', 208, 'yes', 'Alt+a', '2019-10-12 06:12:52', '[]'),
(111, 'Print Types	', 'master/Newmasters/print_type	', 50, '', 805, 'yes', '', '2019-10-12 06:03:09', '[]'),
(112, 'Excel Import', 'item/excel', 50, '', 810, 'yes', '', '2019-10-12 05:58:59', '[]'),
(115, 'Inventory Reports', NULL, 0, 'fa fa-line-chart', 600, 'yes', '', '2019-10-12 05:50:37', '[]'),
(118, 'Item Wise Sales Register', 'reports/item/itemereport', 297, '', 8, 'yes', '', '2019-10-12 06:37:04', '[]'),
(120, 'GST Reports', NULL, 0, 'fa fa-bar-chart', 700, 'yes', '', '2019-10-12 05:50:41', '[]'),
(121, 'GSTR 1', 'reports/gst/gstreport', 483, '', 1, 'yes', '', '2022-04-19 08:06:52', '[]'),
(122, 'GSTR 2 Report', 'reports/gst/gstr2report', 483, '', 2, 'yes', '', '2022-04-19 08:06:52', '[]'),
(123, 'General Settings', NULL, 50, 'fa-wrench', 801, 'yes', '', '2019-10-12 05:53:11', '[]'),
(124, 'Godown Transfer', 'master/itemtransfer/list_all', 29, '', 405, 'yes', '', '2019-10-12 06:30:04', '[]'),
(125, 'Purchase Report	', 'reports/purchase/purchasereport', 296, '', 11, 'yes', '', '2019-10-12 06:39:44', '[]'),
(126, 'Sales Reports	', 'reports/Sales/salesreport', 295, '', 14, 'yes', '', '2019-10-12 06:40:35', '[]'),
(129, 'Set Device', 'settings/set_device/device', 50, '', 811, 'yes', '', '2019-10-12 05:59:04', '[]'),
(131, 'Godown', 'master/godown/godown', 24, '', 302, 'yes', '', '2019-10-12 06:17:28', '[]'),
(132, 'Racks', 'Item/racks', 24, '', 310, 'yes', '', '2019-10-12 06:17:58', '[]'),
(133, 'Login Logs', 'settings/loginsett/listall', 50, '', 812, 'yes', '', '2019-10-12 05:59:07', '[]'),
(156, 'Item Wise Sales Report', 'reports/itemwisereport/sales	', 297, '', 9, 'yes', '', '2019-10-12 06:37:08', '[]'),
(157, 'Opening Stock Report', 'reports/itemdetails/listall', 297, '', 4, 'yes', '', '2020-04-12 05:44:30', '[]'),
(159, 'Item Wise Margin Report', 'reports/marginreport/itemwise', 297, '', 6, '', '', '2019-10-12 06:37:15', '[]'),
(160, 'BillWise Margin Report', 'reports/marginreport/billwise', 295, '', 2, '', '', '2019-10-12 06:40:31', '[]'),
(161, 'Stock Movement Report', 'reports/itemwisereport/quantity', 297, '', 16, '', '', '2019-10-12 06:37:22', '[]'),
(162, 'Total Sales Report', 'reports/totalinvoicereport/sales', 295, '', 19, '', '', '2019-10-12 06:40:27', '[]'),
(163, 'Total Purchase Report', 'reports/totalinvoicereport/purchase', 296, '', 18, '', '', '2019-10-12 06:39:50', '[]'),
(165, 'Item Wise Purchase Report', 'reports/itemwisereport/purchase', 297, '', 7, '', '', '2019-10-12 06:37:28', '[]'),
(166, 'Invoice Report', 'reports/invoice/invoicereport', 295, '', 3, '', '', '2019-10-12 06:40:23', '[]'),
(191, 'Damage Stock', 'master/Itemdamage/list_all', 29, '', 404, 'yes', '', '2019-10-12 06:29:57', '[]'),
(194, 'My Menu', 'settings/menus/user_menu', 50, '', 813, 'yes', '', '2019-10-12 05:59:12', '[]'),
(198, 'Material Type', 'master/amaster/material_type', 15, '', 206, 'yes', '', '2019-10-12 06:12:40', '[]'),
(199, 'Profit & Loss A/C', 'reports/accounts/profitandlossdaywise', 36, '', 6, 'yes', '', '2020-07-09 12:24:21', '[]'),
(200, 'Purchase Return Report', 'reports/purchase/purchasereturn', 296, '', 12, 'yes', '', '2019-10-12 06:39:55', '[]'),
(201, 'Sales Order Report', 'reports/Sales/saleorder', 295, '', 13, 'yes', '', '2019-10-12 06:40:17', '[]'),
(203, ' Sales Return Report', 'reports/Sales/salesreturn', 295, '', 1, 'yes', '', '2019-10-12 06:40:14', '[]'),
(204, 'Currency', 'master/amaster/currency_type', 15, '', 211, 'yes', '', '2019-10-12 06:13:10', '[]'),
(205, 'Total Outstanding Report', 'reports/outstandingreport/outstandingreport', 115, '', 17, 'yes', '', '2018-12-30 14:36:40', '[]'),
(206, 'Outstanding Reports', 'reports/aging/outstand', 115, '', 10, 'yes', '', '2018-12-30 14:36:00', '[]'),
(207, 'Coupons', 'master/coupons/listall', 15, '', 212, 'yes', '', '2019-10-12 06:13:16', '[]'),
(210, 'Route', 'master/newmasters/route', 15, '', 209, 'yes', '', '2019-10-12 06:12:59', '[]'),
(211, 'Sales Bill', 'transaction/sales/sales/sales', 292, '', 406, 'yes', 'Alt+b', '2022-02-05 06:05:02', '[]'),
(212, 'Purchase Bill', 'transaction/purchase/create/purchase', 293, '', 409, 'yes', '', '2019-10-12 06:26:17', '[]'),
(213, 'Opening Stock Edit', 'itemedit/listall', 24, '', 308, 'yes', '', '2019-10-12 06:17:50', '[]'),
(214, 'Set Database', 'master/Newmasters/year_database', 50, '', 814, 'yes', '', '2019-10-12 05:59:15', '[]'),
(216, 'Brands', 'master/amaster/brands_master', 24, '', 307, 'yes', '', '2019-10-12 06:17:47', '[]'),
(218, 'Printers', 'master/amaster/printers', 50, '', 807, 'yes', '', '2019-10-12 06:03:47', '[]'),
(220, 'Cess', 'masters/cess', 15, '', 210, 'yes', '', '2019-10-12 06:13:03', '[]'),
(222, 'User Settings', 'settings/NewMaster/user_settings', 291, '', 3, 'yes', '', '2019-10-12 06:01:40', '[]'),
(223, 'Stock Report', 'reports/Items/listall', 297, '', 0, 'yes', '', '2022-01-05 09:17:50', '[]'),
(224, 'Sales Order Merge Report', 'reports/SalesOrderMerge/mergereport', 295, '', 0, 'yes', '', '2019-10-12 06:40:04', '[]'),
(226, 'Bill Format', 'billformat/billformat', 50, '', 817, 'yes', '', '2019-10-12 05:59:23', '[]'),
(229, 'Slider', 'settings/sliders/listall', 50, '', 818, 'yes', '', '2019-10-12 05:59:29', '[]'),
(230, 'Cheque', 'transaction/chque/list_all', 29, '', 406, '', '', '2022-04-29 09:48:51', '[]'),
(231, 'Bank', 'Masters/bank', 13, '', 2, 'yes', '', '2019-04-29 04:40:08', '[]'),
(232, 'Customer Ledger Balance', 'reports/Ledger_balance/ledger_balance/cus', 36, '', 0, 'yes', '', '2019-04-08 08:01:38', '[]'),
(233, 'Supplier Ledger Balance', 'reports/Ledger_balance/ledger_balance/sup', 36, '', 0, 'yes', '', '2019-04-08 08:01:56', '[]'),
(235, 'Detailed stock report', 'reports/items/list_all', 297, '', 0, 'yes', '', '2020-12-12 05:38:00', '[{\"targets\": 0 , \"visible\": false },{\"targets\": 1 , \"visible\": false },{\"targets\": 2 , \"visible\": false },{\"targets\": 5 , \"visible\": false }]'),
(241, 'SMS', 'settings/message/listall', 290, '', 11, 'yes', '', '2019-10-12 05:57:17', '[]'),
(242, 'SMS Types', 'settings/sms/sms_types', 290, '', 11, 'yes', '', '2019-10-12 05:57:20', '[]'),
(243, 'SMS Settings', 'settings/sms/sms_settings', 290, '', 802, 'yes', '', '2019-10-12 05:57:24', '[]'),
(244, 'Day Summary Report', 'reports/Daybook/Daybook', 417, '', 0, '', '', '2021-04-19 08:33:00', '[]'),
(245, 'Commission Report', 'reports/Commission/Commision', 115, '', 0, 'yes', '', '2020-06-18 02:09:02', '[]'),
(246, 'Quick Voucher', 'transaction/Quick_voucher/listall', 294, '', 4, 'yes', '', '2019-10-12 06:29:09', '[]'),
(247, 'Day Report', 'reports/Daybook/Day_Report', 36, '', 0, 'yes', '', '2019-07-07 12:55:24', '[]'),
(251, 'Merge', 'Merge/Ledger', 250, '', 0, 'yes', '', '2019-07-08 09:55:53', '[]'),
(252, 'Corrupted Ledger', 'reports/Ledger_mistake/ledger_mistake', 36, '', 0, 'yes', '', '2019-07-15 11:21:36', '[]'),
(256, 'Tags', 'Item_tags/list_all', 254, '', 0, 'yes', '', '2019-07-24 06:04:51', '[]'),
(257, 'Item Tags', 'Item_tags/list_tag', 254, '', 0, 'yes', '', '2019-07-24 08:18:40', '[]'),
(260, 'Vehicle', 'Vehicle_masters/vehicle', 259, '', 0, '', '', '2019-07-29 13:21:09', '[]'),
(261, 'Insurance', 'Vehicle_masters/vehicle_insurance', 259, '', 0, '', '', '2019-07-29 13:29:23', '[]'),
(262, 'Insurance Company', 'Vehicle_masters/vehicle_insurance_company', 259, '', 0, '', '', '2019-07-29 13:32:41', '[]'),
(263, 'Manufactur', 'Vehicle_masters/vehicle_manufacture', 259, '', 0, '', '', '2019-07-29 13:40:20', '[]'),
(264, 'Drivers', 'Vehicle_masters/vehicle_drivers', 259, '', 0, '', '', '2019-07-29 13:59:37', '[]'),
(265, 'Vehicle Sales', 'sales_vehicle/Sales_vehicle/listall', 259, '', 0, 'yes', '', '2019-08-01 12:38:55', '[]'),
(266, 'Vehicle Report', 'veh_reports/Trip_reports/listall', 259, '', 0, 'yes', '', '2019-08-01 12:39:37', '[]'),
(277, 'Visa Types', 'Vehicle_masters/visa_type', 268, '', 0, 'yes', '', '2019-08-03 12:11:16', '[]'),
(290, 'SMS Master', NULL, 50, '', 802, '', '', '2019-10-12 05:55:58', '[]'),
(291, 'User Settings', NULL, 50, '', 0, '', '', '2019-10-12 06:00:41', '[]'),
(292, 'Sales', NULL, 29, '', 401, 'yes', '', '2019-10-26 20:45:22', '[]'),
(293, 'Purchase', NULL, 29, '', 402, 'yes', '', '2019-10-26 20:45:49', '[]'),
(294, 'Vouchers', NULL, 29, '', 403, '', '', '2019-10-12 06:28:11', '[]'),
(295, 'Sales Reports', NULL, 115, '', 0, '', '', '2022-01-26 04:18:06', '[]'),
(296, 'Purchase Reports', NULL, 115, '', 0, '', '', '2019-10-12 06:36:32', '[]'),
(297, 'Item Reports', NULL, 115, '', 0, '', '', '2019-10-12 06:36:42', '[]'),
(305, 'Salary Distribution', 'hr/SalaryDistribution/list_all', 317, '', 3, 'yes', '', '2022-02-26 08:36:47', '[]'),
(306, 'Salary Package', 'hr/SalaryPackage/list_all', 317, '', 2, 'yes', '', '2022-02-26 08:36:15', '[]'),
(309, 'Designation', 'hr/designation/list_all', 317, '', 6, 'yes', '', '2022-02-26 08:39:03', '[]'),
(310, 'Department', 'hr/department/list_all', 317, '', 7, 'yes', '', '2022-02-26 08:39:18', '[]'),
(311, 'Role', 'hr/role/list_all', 317, '', 8, 'yes', '', '2022-02-26 08:39:30', '[]'),
(312, 'Holidays', 'hr/Holidays/list_all', 317, '', 9, 'yes', '', '2022-02-26 08:39:44', '[]'),
(313, 'Pay Settings', 'hr/paysettings/list_all', 317, '', 10, 'yes', '', '2022-02-26 08:39:57', '[]'),
(314, 'Leave Type', 'hr/leavetype/list_all', 317, '', 11, 'yes', '', '2022-02-26 08:40:12', '[]'),
(315, 'Course', 'hr/course/list_all', 317, '', 12, 'yes', '', '2022-02-26 08:40:27', '[]'),
(316, 'Employee', 'hr/Employee/list_all', 317, '', 1, 'yes', '', '2022-02-26 08:35:30', '[]'),
(317, 'HR', NULL, 1000, 'fa fa-user-plus', 0, '', '', '2022-02-28 06:38:25', '[]'),
(318, 'Lead report', 'crm_general/reports/Lead_report/list_leads_report', 336, '', 0, 'yes', '', '2019-11-22 14:06:02', '[]'),
(319, 'Enquiry report', 'crm_general/reports/Enquiry_report/list_enquiry_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:58', '[]'),
(320, 'Productwise Enquiry report', 'crm_general/reports/Productwise_report/list_product_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:54', '[]'),
(321, 'Followup history report', 'crm_general/reports/Followup_report/list_followup_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:50', '[]'),
(322, 'Enquiry completion report', 'crm_general/reports/Enquiry_completion_report/list_completion_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:44', '[]'),
(323, 'Allocated Enquiry Report', 'crm_general/reports/Allocated_report/list_allocated_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:40', '[]'),
(324, 'Business Opportunity Report', 'crm_general/reports/Bussiness_opportunity_report/list_opportunity_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:35', '[]'),
(325, 'Business plan report', 'crm_general/reports/Bussiness_plan_report/list_busiplan_report', 336, '', 0, 'yes', '', '2019-11-22 14:05:30', '[]'),
(326, 'Leads Master', 'crm_general/Leads_master/listall', 335, '', 0, '', '', '2019-11-22 14:04:39', '[]'),
(327, 'Enquiry Register', 'crm_general/Enquiry_register/list_all', 335, '', 0, '', '', '2019-11-22 14:04:18', '[]'),
(328, 'Enquiry Master', 'crm_general/Enquiry_allocation/list_all', 335, '', 0, '', '', '2019-11-22 14:03:11', '[]'),
(329, 'CRM', NULL, 1000, 'fa fa-industry', 0, '', '', '2022-02-28 06:38:28', '[]'),
(330, 'Enquiry Master', 'crm_new/Enquiry_allocation/list_all', 332, '', 0, '', '', '2019-11-22 09:19:35', '[]'),
(331, 'Enquiry Register', 'crm_new/Enquiry_register/list_all', 332, '', 0, '', '', '2019-11-22 09:19:31', '[]'),
(332, 'Student Crm', NULL, 1000, 'fas fa-sitemap', 0, '', '', '2022-02-28 06:38:31', '[]'),
(333, 'Type of Bussiness', 'crm_general/Leads_master/listTypeofBuss', 337, '', 0, 'yes', '', '2019-11-22 14:05:08', '[]'),
(334, 'Nature of Bussiness', 'crm_general/Enquiry_allocation/listOtherofBuss', 337, '', 0, 'yes', '', '2019-12-02 11:51:16', '[]'),
(335, 'CRM Transactions', NULL, 329, '', 0, '', '', '2019-11-22 14:01:45', '[]'),
(336, 'CRM Reports', NULL, 329, '', 0, '', '', '2019-11-22 14:01:33', '[]'),
(337, 'CRM Masters', NULL, 329, '', 0, '', '', '2019-11-22 14:01:39', '[]'),
(338, 'Quotation', 'transaction/Quotation/listall', 292, '', 406, 'yes', '', '2020-06-18 02:05:21', '[]'),
(339, 'Status Master', 'crm_general/Enquiry_followup/listStatus', 337, '', 0, 'yes', '', '2020-04-08 06:20:50', '[]'),
(340, 'Price List', 'pricelist/Pricelist/listall', 24, '', 0, 'yes', '', '2020-06-18 02:02:00', '[]'),
(341, 'Modify Item Rates', 'Itemsedit/listall', 24, '', 0, '', '', '2020-04-16 06:08:45', '[]'),
(342, 'POS', 'pos/Main/listall', 292, '', 0, '', '', '2020-04-24 11:43:13', '[]'),
(343, 'Branch', 'Masters/company_branch', 15, '', 0, '', '', '2020-06-18 13:57:51', '[]'),
(344, 'Cost Center', 'cost_analytics/Cost_centre/listall', 15, '', 0, '', '', '2020-06-18 14:00:10', '[]'),
(345, 'Payment List', 'transaction\\vouchers\\list_all\\payment', 36, '', 0, '', '', '2020-06-19 11:24:07', '[]'),
(346, 'Receipt List', 'transaction\\vouchers\\list_all\\receipt', 36, '', 0, '', '', '2020-06-19 11:24:07', '[]'),
(347, 'Sales Cash Report', 'reports/invoice/salescashreport', 295, '', 0, '', '', '2020-06-20 13:22:49', '[]'),
(348, 'Set Free Quantity', 'itemedit/list', 24, '', 0, '', '', '2020-07-03 11:05:48', '[]'),
(349, 'Contra', 'transaction\\vouchers\\listall\\contra', 294, '', 0, '', '', '2020-07-05 10:42:04', '[]'),
(350, 'Sales Summary Report', 'reports/Sales/sales_summary', 295, '', 0, 'yes', '', '2020-07-06 05:01:33', '[]'),
(351, 'Company Keys', 'settings/CompanySettings/company_keys', 123, '', 0, '', '', '2020-08-20 05:47:54', '[]'),
(352, 'Service CRM', NULL, 1000, 'fa fa-wrench', 0, '', '', '2022-02-28 06:38:34', '[]'),
(353, 'Service Call Register', 'crm_service/Enquiry_allocation/list_all', 352, '', 0, 'yes', '', '2020-07-30 10:51:28', '[]'),
(354, 'Allocated Services', 'crm_service/Enquiry_register/list_all', 352, '', 0, 'yes', '', '2020-07-30 10:53:01', '[]'),
(355, 'Service Bill', 'crm_service/Enquiry_list/listall', 352, '', 0, 'yes', '', '2020-07-30 10:53:01', '[]'),
(356, 'Area Wise Item Report', 'reports/area/Itemwise', 295, '', 0, 'yes', '', '2020-11-25 11:29:38', '[]'),
(357, 'Route Customer Bill Details', 'reports/area/Customerwise', 295, '', 0, 'yes', '', '2020-11-25 05:43:37', '[]'),
(358, 'Hsn Wise Report', 'reports/hsn/Hsnreport', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(359, 'Item Wise Hsn Report', 'reports/hsn/itemreport', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(360, 'E-way Bill Report', 'reports/hsn/eway', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(361, 'Delivery Note', 'transaction/sales/listall/delivery_note', 292, '', 0, '', '', '2020-11-13 13:04:44', '[]'),
(368, 'Balance Sheet', 'reports/accounts/balancesheet', 36, '', 0, '', '', '2020-12-07 04:38:59', '[]'),
(369, 'Ledger Group report', 'reports/accounts/mainLeadger', 36, '', 0, '', '', '2020-12-07 05:14:58', '[]'),
(370, 'Production', NULL, 29, 'fa fa-line-chart', 404, 'yes', '', '2022-04-29 09:46:34', '[]'),
(371, 'BoM List', 'production/bom/bom_controller/listall', 370, '', 0, 'yes', '', '2020-09-02 05:55:00', '[]'),
(372, 'Status', 'production/status/Status_controller/listall', 370, '', 0, 'yes', '', '2020-09-01 21:30:29', '[]'),
(373, 'Stage', 'production/stage/stage_controller/listall', 370, '', 0, 'yes', '', '2020-09-01 21:30:15', '[]'),
(374, 'Additional Fileds', 'production/label/label_controller/listall', 370, '', 0, 'yes', '', '2020-09-01 21:29:48', '[]'),
(375, 'Process', 'production/process/process_controller/listall', 370, '', 0, 'yes', '', '2020-09-30 09:12:30', '[]'),
(376, 'Order Items Total', 'reports/items/order_items', 295, '', 0, 'yes', '', '2021-01-04 11:54:57', ''),
(377, 'Multi Unit Stock', 'reports/items/unit_stock', 297, '', 0, 'yes', '', '2020-12-21 11:45:18', ''),
(379, 'Couser Master', 'education/Course/listall', 332, '', 0, '', '', '2020-12-14 05:37:48', '[]'),
(380, 'Student', 'education/Student/listall', 332, '', 0, '', '', '2020-12-14 05:37:45', '[]'),
(381, 'Discount', 'education/Course/listDiscount', 332, '', 0, '', '', '2020-12-14 05:37:40', '[]'),
(382, 'Batches', 'education/Student/batch', 332, '', 0, '', '', '2020-12-14 05:37:34', '[]'),
(383, 'Fees', 'education/Student/feeStructure', 332, '', 0, '', '', '2020-12-14 05:37:31', '[]'),
(384, 'University', 'education/Course/university', 332, '', 0, '', '', '2020-12-14 05:37:29', '[]'),
(385, 'Label Master', 'crm_new/Enquiry_followup/listLabel', 332, '', 0, 'yes', '', '2020-12-14 05:37:26', '[]'),
(386, 'Document Master', 'education/Student/listDoc', 332, '', 0, 'yes', '', '2020-12-14 05:37:22', '[]'),
(387, 'Districts', 'masters/states', 332, '', 207, 'yes', '', '2020-12-14 05:37:19', '[]'),
(388, 'Source Of Enquiry', 'source_of_enquiry/Source_of_enquiry/list_all', 332, '', 0, '', '', '2020-12-14 05:38:47', '[]'),
(389, 'Address report', 'reports/Address_report/index', 36, '', 0, '', '', '2021-01-19 06:43:22', '[]'),
(390, 'Customer Balance', 'reports/Invoice/customercashreport', 36, '', 0, '', '', '2021-01-19 07:13:26', '[]'),
(391, 'Itemwise Order', 'reports/itemwisereport/salesorder', 297, '', 0, 'yes', '', '2021-02-11 07:19:36', ''),
(392, 'Item Wise Order Register', 'reports/item/itemereport/estimate', 297, '9', 0, '', '', '2021-02-11 07:34:49', '[]'),
(393, 'Export Report', NULL, 50, '', 0, 'yes', '', '2021-03-29 12:32:03', '[]'),
(397, 'Jou Voucher Report', 'reports/New_Voucher_Report/listall', 39300, '', 0, '', '', '2021-02-18 13:00:58', ''),
(400, 'Stock Level Report', 'reports/Item/stocklevel', 115, '', 0, '', '', '2021-02-18 13:05:37', '[]'),
(401, 'Closing Stock Report', 'reports/items/fifo_lifo', 1000, '', 0, '', '', '2022-02-28 06:39:48', '[]'),
(402, 'Customer Sales Report', 'reports/invoice/customereisereport', 36, '', 0, '', '', '2021-03-20 05:13:49', ''),
(403, 'GST EXPORT', 'reports/GST1Report/list', 36, '', 0, '', '', '2021-03-23 05:23:43', '[]'),
(404, 'Stock Movment Report', 'reports/Stock_movement_report/list', 297, '', 0, '', '', '2021-03-23 06:16:23', '[]'),
(407, 'Pay Voucher Report', 'reports/New_voucher_payment/listall', 401, '', 0, '', '', '2021-02-18 06:11:23', ''),
(408, 'Rec Voucher Report', 'reports/New_voucher_receipt/listall', 401, '', 0, '', '', '2021-02-18 06:13:56', ''),
(409, 'Sale Voucher Report', 'reports/New_Sales_report/listall', 401, '', 0, '', '', '2021-02-18 06:13:59', ''),
(410, 'Pur Voucher Report', 'reports/New_Purchase_report/listall', 401, '', 0, '', '', '2021-02-18 08:54:48', ''),
(411, 'Contra Voucher Report', 'reports/New_voucher_contra/listall', 401, '', 0, '', '', '2021-02-18 06:14:00', ''),
(414, 'Gst purchase tax wise', 'reports/hsn/Billwise_purchase', 120, '', 0, '', '', '2021-05-06 05:35:01', '[]'),
(415, 'Gst sales tax wise', 'reports/hsn/Billwise', 120, '', 0, 'yes', '', '2021-05-06 05:35:01', '[]'),
(417, 'MIS Reports', NULL, 115, '', 0, '', '', '2021-04-19 08:13:38', '[]'),
(419, 'Route Summary Report', 'reports/sales/customersales', 417, '', 0, '', '', '2021-04-19 08:23:42', '[]'),
(420, 'Stock Journal', 'Stock_journal/listall', 24, '', 0, '', '', '2021-04-21 04:59:57', '[]'),
(422, 'Monthly Report', 'reports/MIS/Monthly_summary', 417, '', 0, '', '', '2021-04-27 06:09:51', '[]'),
(423, 'Daybook Custome', 'reports/Daybook/daybook_custome', 36, '', 0, '', '', '2021-04-28 07:54:14', '[]'),
(424, 'GST Sales Day Summary', 'reports/hsn/Daywise', 483, '', 0, 'yes', '', '2022-04-19 08:06:52', '[]'),
(425, 'Import', 'crm_general/Excel_import/excel', 335, '', 0, '', '', '2021-05-15 05:05:55', '[]'),
(428, 'Stock Journal Report', 'reports/ItemTransaction/stock_journal', 297, '', 0, '', '', '2021-05-26 06:41:57', '[]'),
(429, 'Godown Transfer Report', 'reports/ItemTransaction/godown_transfer', 297, '', 0, '', '', '2021-05-26 06:41:53', '[]'),
(430, 'UserWise Collection', 'reports/MIS/route_summary', 417, '', 0, '', '', '2021-06-17 10:25:47', '[]'),
(432, 'Vehicle', 'master/Newmasters/ims_vehicle', 15, '', 0, '', '', '2021-06-09 07:50:54', '[]'),
(434, 'AVG Item Margin', 'reports/marginreport/custom_report', 297, '', 0, 'yes', 'Alt+j', '2022-02-05 06:07:41', '[]'),
(436, 'SalesMan performance', 'reports/MIS/agent_summary', 417, '', 0, '', '', '2021-06-18 04:37:36', '[]'),
(437, 'Stock Movement', 'reports/ItemTransaction/item_movement', 297, '', 0, 'yes', '', '2021-06-19 08:40:43', '[]'),
(438, 'HsnWise Quantity Report', 'reports/hsn/Hsnreport_new', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(439, 'Physical Stock Update', 'Physical_stock/list', 24, '', 0, '', '', '2021-06-22 06:30:47', '[]'),
(440, 'Physical Stock Report', 'reports/ItemTransaction/physical_stk_update', 115, '', 0, '', '', '2021-06-22 06:30:47', '[]'),
(441, 'Job Card In', 'Jobcard/list_all/in', 370, '', 0, '', '', '2021-07-05 05:25:54', '[]'),
(442, 'Job Card Out', 'Jobcard/list_all/out', 370, '', 0, '', '', '2021-07-05 05:25:54', '[]'),
(443, 'Material In', 'Material/list_all/in', 370, '', 0, 'yes', '', '2021-07-06 05:07:04', '[]'),
(444, 'Material Out', 'Material/list_all/out', 370, '', 0, '', '', '2021-07-06 05:07:00', '[]'),
(445, 'Sales HSN REPORT', 'reports/hsn/saleshsn', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(446, 'UQC', 'master/Newmasters/uqc', 15, '', 0, '', '', '2021-07-30 08:29:56', '[]'),
(447, 'Landing Cost Margin Report', 'reports/Marginreport/landing_cost', 295, '', 0, 'yes', '', '2021-08-17 04:58:07', '[]'),
(448, 'Sales Exchange Report\n', 'reports/Salesreturn/Adjustment', 295, '', 0, 'yes', '', '2021-09-06 06:23:58', ''),
(449, 'Point Settings', 'Masters/points', 15, '', 0, '', '', '2021-09-15 03:58:55', '[]'),
(450, 'Item Wise SR Register', 'reports/item/itemereport/sales_return', 297, '', 0, '', '', '2021-09-15 04:07:49', '[]'),
(451, 'Item Wise SR Report', 'reports/itemwisereport/sales/sales_return', 297, '', 0, '', '', '2021-09-15 04:07:49', '[]'),
(452, 'Purchase Hsn Report', 'reports/hsn/purchasehsn', 483, '', 0, '', '', '2022-04-19 08:06:52', '[]'),
(453, 'Customer Point Report', 'reports/Address_report/Reedeem', 295, '', 0, '', '', '2021-10-01 07:46:06', '[]'),
(454, 'Replacement voucher', 'Replace_items/list', 294, '', 0, 'yes', '', '2022-02-25 10:33:52', '[]'),
(455, 'Districts', 'master/Newmasters/district', 15, '', 0, '', '', '2021-10-29 07:40:01', '[]'),
(456, 'Customer Type', 'master/Newmasters/customer_type', 15, '', 0, '', '', '2021-10-29 07:40:01', '[]'),
(457, 'Sales Forecast Report', 'reports/invoice/sales_forecast', 295, '', 0, '', '', '2021-11-19 04:28:29', '[]'),
(458, 'MELTING', 'gold/Melting/list_all', 461, '', 0, '', '', '2021-12-10 08:43:17', '[]'),
(459, 'Production', 'gold/Production/list_all', 29, '', 404, '', '', '2022-04-29 09:46:34', '[]'),
(460, 'Design', 'gold/Design/list_all', 461, '', 0, '', '', '2021-12-10 08:43:23', '[]'),
(461, 'Gold', NULL, 1000, '', 0, '', '', '2022-02-28 06:39:05', '[]'),
(462, 'Sales And Jobcard', 'gold/SalesJob/list_all', 461, '', 0, '', '', '2021-12-10 08:43:51', '[]'),
(463, 'Godown Stock Register', 'reports/Stock/day_stock', 115, '', 0, '', '', '2021-12-10 11:57:04', '[]'),
(464, 'Agewise Debtors Report', 'reports/Ledger_balance/period_ledger_balance', 36, '', 0, '', '', '2021-12-29 07:51:05', '[]'),
(465, 'P Order Pending', 'reports/Purchase_order_pending/list', 295, '', 0, '', '', '2022-01-26 11:31:41', '[]'),
(466, 'Sales Order Pending', 'reports/Sales_order_pending/list', 296, '', 0, '', '', '2022-01-26 11:31:46', '[]'),
(467, 'GST SUMMARY', 'reports/GstSummary/gstsummary', 36, '', 0, '', '', '2022-01-26 04:20:33', '[]'),
(470, 'Cheque Collection Report', 'reports/Cheque/Cheque_data', 36, '', 0, '', '', '2022-02-07 08:17:43', '[]'),
(471, 'Salary Report', 'hr/SalaryReport/salary_report', 317, '', 5, 'yes', '', '2022-02-26 08:38:15', '[]'),
(472, 'Employee Report', 'hr/EmployeeReport/list_all', 317, '', 4, 'yes', '', '2022-02-26 08:37:44', '[]'),
(474, 'Attendance', 'hr/Attendance/list_all', 317, '', 0, '', '', '2022-02-26 11:29:22', '[]'),
(475, 'Employee Leave', 'hr/EmployeeLeave/list_all', 317, '', 0, '', '', '2022-02-26 11:59:42', '[]'),
(476, 'Leave Type', 'master/Newmasters/hr_leavetype', 317, '', 0, '', '', '2022-02-26 11:59:42', '[]'),
(477, ' B2b Sales Report', 'reports/Gst/b2breport', 484, '', 0, '', '', '2022-04-19 09:03:53', '[]'),
(478, ' B2c Sales Report', 'reports/Gst/b2creport', 484, '', 0, '', '', '2022-04-19 09:04:01', '[]'),
(479, 'Debit Note', 'transaction/Credit_Debit_Vouchers/list_all/debit_note', 294, '', 0, '', '', '2022-03-02 08:30:06', '[]'),
(480, 'Credit Note', 'transaction/Credit_Debit_Vouchers/list_all', 294, '', 0, '', '', '2022-03-01 05:49:53', '[]'),
(481, ' Hsn sales', 'reports/hsn/saleshsn_consolidate', 484, '', 0, '', '', '2022-04-27 11:26:46', '[]'),
(482, 'Item List Report', 'reports/item/list_item', 297, '', 0, 'yes', '', '2022-03-16 10:11:35', '[]'),
(483, 'General Reports', '', 115, '', 1, 'yes', '', '2022-04-19 08:01:49', '[]'),
(484, 'GSTR1 Reports', '', 120, '', 1, 'yes', '', '2022-04-19 08:12:38', '[]'),
(485, 'GSTR2 Reports', '', 120, '', 1, 'yes', '', '2022-04-19 08:12:38', '[]'),
(486, 'GSTR2 Export', 'reports/GST1Report/list_purchase', 485, '', 1, 'yes', '', '2022-04-19 09:02:52', '[]'),
(488, 'DashBoards', NULL, 0, 'fa fa-dashboard', -1, '', '', '2022-04-29 10:47:54', '[]'),
(491, 'Admin Dashboard', 'dashboard/summary', 488, '', 0, '', '', '2022-06-18 04:40:45', '[]'),
(492, 'GSTR1 Export', 'reports/GST1Report/list_sales', 484, '', 1, 'yes', '', '2022-05-06 11:54:39', '[]'),
(493, 'Item Group sales Report', 'reports/Brandreport/brand_category', 295, '', 0, 'yes', '', '2022-05-13 12:19:43', '[]'),
(494, 'Brand Sales Analysis', 'reports/Brandreport/brand_sales', 295, '', 0, 'yes', '', '2022-05-13 12:19:00', '[]'),
(495, 'Change Item Tax', 'inventory_master/Item/change_item_tax', 24, '', 0, '', '', '2022-07-22 04:34:02', '[]'),
(496, 'Cancelled', 'reports/Sales/salesreport/cancelled', 295, '', 0, 'yes', '', '2022-10-07 07:34:40', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `menutocmpnytype`
--

CREATE TABLE `menutocmpnytype` (
  `menuid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menutocmpnytype`
--

INSERT INTO `menutocmpnytype` (`menuid`, `typeid`, `updatedate`) VALUES
(13, 2, '2018-01-28 06:45:41'),
(24, 2, '2018-01-28 06:45:41'),
(36, 2, '2018-01-28 06:45:41'),
(50, 2, '2018-01-28 06:45:41'),
(13, 3, '2018-01-28 06:45:41'),
(24, 3, '2018-01-28 06:45:41'),
(29, 3, '2018-01-28 06:45:41'),
(87, 3, '2018-01-28 06:45:41'),
(15, 4, '2018-01-28 06:45:41'),
(29, 4, '2018-01-28 06:45:41'),
(36, 4, '2018-01-28 06:45:41'),
(13, 1, '2018-01-28 06:45:41'),
(24, 1, '2018-01-28 06:45:41'),
(29, 1, '2018-01-28 06:45:41'),
(36, 1, '2018-01-28 06:45:41'),
(15, 5, '2018-01-28 06:45:41'),
(24, 5, '2018-01-28 06:45:41'),
(29, 5, '2018-01-28 06:45:41'),
(75, 5, '2018-01-28 06:45:41'),
(13, 1, '2018-01-28 06:45:41'),
(15, 1, '2018-01-28 06:45:41'),
(24, 1, '2018-01-28 06:45:41'),
(29, 1, '2018-01-28 06:45:41'),
(36, 1, '2018-01-28 06:45:41'),
(50, 1, '2018-01-28 06:45:41'),
(98, 1, '2018-01-28 06:45:41'),
(115, 1, '2018-01-28 06:45:41'),
(116, 1, '2018-01-28 06:45:41'),
(117, 1, '2018-01-28 06:45:41'),
(119, 1, '2018-01-28 06:45:41'),
(120, 1, '2018-01-28 06:45:41'),
(121, 1, '2018-01-28 06:45:41'),
(122, 1, '2018-01-28 06:45:41'),
(123, 1, '2018-01-28 06:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_to_company`
--

CREATE TABLE `menu_to_company` (
  `company_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `is_delete` int(11) NOT NULL,
  `is_dashboard` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_to_user`
--

INSERT INTO `menu_to_user` (`id`, `menu_id`, `user_id`, `is_read`, `is_write`, `is_delete`, `is_dashboard`, `updatedate`) VALUES
(6727, 22, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6728, 21, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6729, 20, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6730, 19, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6731, 231, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6732, 92, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6733, 91, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6734, 111, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6735, 108, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6736, 218, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6737, 204, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6738, 130, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6739, 11, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6740, 45, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6741, 109, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6742, 87, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6743, 221, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6744, 210, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6745, 198, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6746, 216, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6747, 26, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6748, 25, 3, 1, 1, 1, 0, '2019-05-29 12:50:38'),
(6749, 55, 3, 1, 1, 1, 0, '2019-05-29 12:50:39'),
(6750, 88, 3, 1, 1, 1, 0, '2019-05-29 12:50:39'),
(6751, 132, 3, 1, 1, 1, 0, '2019-05-29 12:50:39'),
(6752, 123, 3, 0, 0, 0, 0, '2019-05-29 12:50:39'),
(6753, 17, 3, 1, 1, 1, 0, '2019-05-29 12:50:39'),
(6754, 95, 3, 1, 1, 1, 0, '2019-05-29 12:50:39'),
(6755, 13, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(6756, 15, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(6757, 24, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(6758, 29, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(6760, 50, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(6763, 123, 3, 1, 1, 1, 1, '2019-05-29 12:58:37'),
(7018, 13, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7019, 19, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7020, 20, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7021, 21, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7022, 22, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7023, 231, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7024, 15, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7025, 11, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7026, 12, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7027, 45, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7028, 46, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7029, 87, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7030, 109, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7031, 130, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7032, 198, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7033, 204, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7034, 207, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7035, 210, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7036, 220, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7037, 24, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7038, 25, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7039, 26, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7040, 55, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7041, 58, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7042, 88, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7043, 131, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7044, 132, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7045, 193, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7046, 213, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7047, 216, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7048, 29, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7049, 124, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7050, 191, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7051, 230, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7052, 292, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7053, 293, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7054, 294, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7055, 338, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7056, 36, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7057, 37, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7058, 41, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7059, 42, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7060, 43, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7061, 53, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7062, 89, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7063, 199, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7064, 232, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7065, 233, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7066, 244, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7067, 245, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7068, 247, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7069, 252, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7070, 253, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7071, 50, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7072, 51, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7073, 54, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7074, 91, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7075, 108, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7076, 111, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7077, 112, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7078, 123, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7079, 129, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7080, 133, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7081, 194, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7082, 214, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7083, 218, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7084, 226, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7085, 229, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7086, 290, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7087, 291, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7088, 115, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7089, 205, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7090, 206, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7091, 295, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7092, 296, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7093, 297, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7094, 120, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7095, 121, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7096, 122, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7097, 123, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7098, 17, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7099, 95, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7100, 290, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7101, 60, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7102, 238, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7103, 239, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7104, 240, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7105, 241, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7106, 242, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7107, 243, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7108, 291, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7109, 92, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7110, 97, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7111, 222, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7112, 292, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7113, 44, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7114, 48, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7115, 52, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7116, 211, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7117, 293, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7118, 33, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7119, 105, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7120, 106, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7121, 212, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7122, 294, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7123, 30, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7124, 31, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7125, 32, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7126, 246, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7127, 295, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7128, 126, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7129, 160, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7130, 162, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7131, 166, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7132, 201, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7133, 203, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7134, 224, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7135, 296, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7136, 125, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7137, 163, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7138, 200, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7139, 297, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7140, 49, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7141, 57, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7142, 118, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7143, 156, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7144, 157, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7145, 159, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7146, 161, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7147, 165, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7148, 223, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7149, 235, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7150, 317, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7151, 305, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7152, 306, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7153, 307, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7154, 309, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7155, 310, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7156, 311, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7157, 312, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7158, 313, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7159, 314, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7160, 315, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7161, 316, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7162, 329, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7163, 335, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7164, 336, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7165, 337, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7166, 332, 7, 0, 0, 0, 0, '2019-12-04 13:51:53'),
(7167, 284, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7168, 330, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7169, 331, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7170, 335, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7171, 326, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7172, 327, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7173, 328, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7174, 336, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7175, 318, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7176, 319, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7177, 320, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7178, 321, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7179, 322, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7180, 323, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7181, 324, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7182, 325, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7183, 337, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7184, 286, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7185, 333, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7186, 334, 7, 1, 1, 1, 0, '2019-12-04 13:51:53'),
(7806, 13, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7807, 19, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7808, 20, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7809, 21, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7810, 22, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7811, 231, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7812, 15, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7813, 11, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7814, 12, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7815, 45, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7816, 46, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7817, 87, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7818, 109, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7819, 130, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7820, 198, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7821, 204, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7822, 207, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7823, 210, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7824, 220, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7825, 24, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7826, 25, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7827, 26, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7828, 55, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7829, 58, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7830, 88, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7831, 131, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7832, 132, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7833, 193, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7834, 213, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7835, 216, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7836, 29, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7837, 124, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7838, 191, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7839, 230, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7840, 292, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7841, 293, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7842, 294, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7843, 338, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7844, 36, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7845, 37, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7846, 41, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7847, 42, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7848, 43, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7849, 53, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7850, 89, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7851, 199, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7852, 232, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7853, 233, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7854, 244, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7855, 245, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7856, 247, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7857, 252, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7858, 253, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7859, 50, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7860, 51, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7861, 54, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7862, 91, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7863, 108, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7864, 111, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7865, 112, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7866, 123, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7867, 129, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7868, 133, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7869, 194, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7870, 214, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7871, 218, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7872, 226, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7873, 229, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7874, 290, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7875, 291, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7876, 115, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7877, 205, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7878, 206, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7879, 295, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7880, 296, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7881, 297, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7882, 120, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7883, 121, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7884, 122, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7885, 123, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7886, 17, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7887, 95, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7888, 290, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7889, 60, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7890, 238, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7891, 239, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7892, 240, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7893, 241, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7894, 242, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7895, 243, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7896, 291, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7897, 92, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7898, 97, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7899, 222, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7900, 292, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7901, 44, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7902, 48, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7903, 52, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7904, 211, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7905, 293, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7906, 33, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7907, 105, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7908, 106, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7909, 212, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7910, 294, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7911, 30, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7912, 31, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7913, 32, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7914, 246, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7915, 295, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7916, 126, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7917, 160, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7918, 162, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7919, 166, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7920, 201, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7921, 203, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7922, 224, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7923, 296, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7924, 125, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7925, 163, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7926, 200, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7927, 297, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7928, 49, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7929, 57, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7930, 118, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7931, 156, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7932, 157, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7933, 159, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7934, 161, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7935, 165, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7936, 223, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7937, 235, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7938, 329, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7939, 335, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7940, 336, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7941, 337, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7942, 332, 8, 0, 0, 0, 0, '2019-12-04 14:03:12'),
(7943, 284, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7944, 330, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7945, 331, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7946, 335, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7947, 326, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7948, 327, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7949, 328, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7950, 336, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7951, 318, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7952, 319, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7953, 320, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7954, 321, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7955, 322, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7956, 323, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7957, 324, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7958, 325, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7959, 337, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7960, 286, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7961, 333, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7962, 334, 8, 1, 1, 1, 0, '2019-12-04 14:03:12'),
(7963, 284, 4, 1, 1, 0, 0, '2019-12-12 10:41:55'),
(7964, 329, 4, 0, 0, 0, 0, '2019-12-12 10:41:55'),
(7965, 336, 4, 1, 1, 1, 0, '2019-12-12 10:41:55'),
(7966, 335, 4, 1, 1, 1, 0, '2019-12-12 10:41:55'),
(7967, 337, 4, 1, 1, 1, 0, '2019-12-12 10:41:55'),
(7968, 156, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7969, 336, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7970, 323, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7971, 322, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7972, 321, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7973, 320, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7974, 319, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7975, 318, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7976, 325, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7977, 324, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7978, 335, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7979, 328, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7980, 327, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7981, 326, 4, 1, 1, 1, 0, '2019-12-12 10:41:56'),
(7982, 286, 4, 1, 0, 0, 0, '2019-12-12 10:41:56'),
(7983, 52, 4, 1, 1, 0, 0, '2019-12-12 10:41:56'),
(7984, 48, 4, 1, 1, 0, 0, '2019-12-12 10:41:56'),
(7985, 211, 4, 1, 0, 0, 0, '2019-12-12 10:41:56'),
(7986, 329, 5, 0, 0, 0, 0, '2019-12-12 10:42:25'),
(7987, 335, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7988, 336, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7989, 337, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7990, 335, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7991, 326, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7992, 327, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7993, 328, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7994, 336, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7995, 318, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7996, 319, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7997, 320, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7998, 321, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(7999, 322, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8000, 323, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8001, 324, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8002, 325, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8003, 337, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8004, 286, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8005, 333, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8006, 334, 5, 1, 1, 1, 0, '2019-12-12 10:42:25'),
(8383, 292, 6, 0, 0, 0, 0, '2020-04-12 04:52:46'),
(8384, 44, 6, 1, 1, 1, 0, '2020-04-12 04:52:46'),
(8385, 48, 6, 1, 1, 1, 0, '2020-04-12 04:52:46'),
(8386, 52, 6, 1, 1, 1, 0, '2020-04-12 04:52:46'),
(8387, 211, 6, 1, 1, 1, 0, '2020-04-12 04:52:46'),
(8388, 32, 6, 1, 1, 1, 0, '2020-04-12 04:52:46'),
(8588, 29, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8589, 292, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8590, 48, 9, 1, 0, 0, 0, '2020-07-08 10:18:19'),
(8591, 211, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8592, 44, 9, 0, 1, 1, 0, '2020-07-08 10:18:19'),
(8593, 50, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8594, 194, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8595, 329, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8596, 337, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8597, 286, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8598, 334, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8599, 333, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8600, 339, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8601, 336, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8602, 324, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8603, 323, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8604, 322, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8605, 321, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8606, 320, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8607, 319, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8608, 318, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8609, 325, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8610, 335, 9, 0, 0, 0, 0, '2020-07-08 10:18:19'),
(8611, 328, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8612, 327, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8613, 326, 9, 1, 1, 1, 0, '2020-07-08 10:18:19'),
(8614, 29, 11, 0, 0, 0, 0, '2020-07-09 09:41:28'),
(8615, 124, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8616, 191, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8617, 230, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8618, 292, 11, 0, 0, 0, 0, '2020-07-09 09:41:28'),
(8619, 44, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8620, 48, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8621, 52, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8622, 211, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8623, 338, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8624, 342, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8625, 293, 11, 0, 0, 0, 0, '2020-07-09 09:41:28'),
(8626, 33, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8627, 105, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8628, 106, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8629, 212, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8630, 294, 11, 0, 0, 0, 0, '2020-07-09 09:41:28'),
(8631, 30, 11, 1, 1, 1, 0, '2020-07-09 09:41:28'),
(8632, 31, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8633, 32, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8634, 246, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8635, 349, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8636, 329, 11, 0, 0, 0, 0, '2020-07-09 09:41:29'),
(8637, 335, 11, 0, 0, 0, 0, '2020-07-09 09:41:29'),
(8638, 326, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8639, 327, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8640, 328, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8641, 336, 11, 0, 0, 0, 0, '2020-07-09 09:41:29'),
(8642, 318, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8643, 319, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8644, 320, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8645, 321, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8646, 322, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8647, 323, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8648, 324, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8649, 325, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8650, 337, 11, 0, 0, 0, 0, '2020-07-09 09:41:29'),
(8651, 286, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8652, 333, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8653, 334, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8654, 339, 11, 1, 1, 1, 0, '2020-07-09 09:41:29'),
(8655, 29, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8656, 124, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8657, 191, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8658, 230, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8659, 292, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8660, 44, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8661, 48, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8662, 52, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8663, 211, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8664, 338, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8665, 342, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8666, 293, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8667, 33, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8668, 105, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8669, 106, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8670, 212, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8671, 294, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8672, 30, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8673, 31, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8674, 32, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8675, 246, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8676, 349, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8677, 329, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8678, 335, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8679, 326, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8680, 327, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8681, 328, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8682, 336, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8683, 318, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8684, 319, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8685, 320, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8686, 321, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8687, 322, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8688, 323, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8689, 324, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8690, 325, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8691, 337, 12, 0, 0, 0, 0, '2020-07-09 09:41:42'),
(8692, 286, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8693, 333, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8694, 334, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8695, 339, 12, 1, 1, 1, 0, '2020-07-09 09:41:42'),
(8696, 29, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8697, 124, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8698, 191, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8699, 230, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8700, 292, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8701, 44, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8702, 48, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8703, 52, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8704, 211, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8705, 338, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8706, 342, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8707, 293, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8708, 33, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8709, 105, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8710, 106, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8711, 212, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8712, 294, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8713, 30, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8714, 31, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8715, 32, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8716, 246, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8717, 349, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8718, 329, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8719, 335, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8720, 326, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8721, 327, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8722, 328, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8723, 336, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8724, 318, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8725, 319, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8726, 320, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8727, 321, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8728, 322, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8729, 323, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8730, 324, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8731, 325, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8732, 337, 13, 0, 0, 0, 0, '2020-07-09 09:41:53'),
(8733, 286, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8734, 333, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8735, 334, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(8736, 339, 13, 1, 1, 1, 0, '2020-07-09 09:41:53'),
(9024, 29, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9025, 191, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9026, 294, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9027, 349, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9028, 32, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9029, 31, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9030, 30, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9031, 293, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9032, 106, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9033, 212, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9034, 105, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9035, 33, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9036, 292, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9037, 48, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9038, 338, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9039, 211, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9040, 342, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9041, 44, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9042, 52, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9043, 230, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9044, 124, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9045, 120, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9046, 121, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9047, 122, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9048, 36, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9049, 37, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9050, 43, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9051, 199, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9052, 42, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9053, 41, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9054, 15, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9055, 130, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9056, 46, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9057, 87, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9058, 45, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9059, 210, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9060, 220, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9061, 12, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9062, 11, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9063, 109, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9064, 115, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9065, 295, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9066, 126, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9067, 297, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9068, 235, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9069, 223, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9070, 49, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9071, 206, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9072, 296, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9073, 125, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9074, 24, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9075, 213, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9076, 193, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9077, 55, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9078, 26, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9079, 88, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9080, 25, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9081, 341, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9082, 58, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9083, 216, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9084, 132, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9085, 131, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9086, 13, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9087, 231, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9088, 22, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9089, 21, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9090, 50, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9091, 108, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9092, 112, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9093, 291, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9094, 222, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9095, 97, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9096, 92, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9097, 111, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9098, 123, 15, 0, 0, 0, 0, '2020-07-17 13:42:22'),
(9099, 17, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9100, 95, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9101, 226, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9102, 54, 15, 1, 1, 1, 0, '2020-07-17 13:42:22'),
(9103, 29, 14, 0, 0, 0, 0, '2020-08-17 10:15:39'),
(9104, 191, 14, 1, 1, 1, 0, '2020-08-17 10:15:39'),
(9105, 294, 14, 0, 0, 0, 0, '2020-08-17 10:15:40'),
(9106, 32, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9107, 349, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9108, 31, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9109, 30, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9110, 246, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9111, 124, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9112, 293, 14, 0, 0, 0, 0, '2020-08-17 10:15:40'),
(9113, 106, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9114, 105, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9115, 212, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9116, 33, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9117, 230, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9118, 292, 14, 0, 0, 0, 0, '2020-08-17 10:15:40'),
(9119, 48, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9120, 338, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9121, 44, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9122, 52, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9123, 211, 14, 1, 1, 1, 0, '2020-08-17 10:15:40'),
(9124, 342, 14, 1, 1, 1, 0, '2020-08-17 10:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `online_sales_item`
--

CREATE TABLE `online_sales_item` (
  `ons_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ons_published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `pay_key` varchar(500) NOT NULL,
  `user` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `physical_stk_update`
--

CREATE TABLE `physical_stk_update` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(500) NOT NULL,
  `voucher_date` date NOT NULL,
  `description` text NOT NULL,
  `last_udatedate` date NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `physical_stk_update_items`
--

CREATE TABLE `physical_stk_update_items` (
  `id` int(11) NOT NULL,
  `phy_stk_upd_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `batch` varchar(1000) NOT NULL,
  `type` enum('cr','dt') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `actualStk` decimal(10,3) NOT NULL,
  `current` decimal(10,3) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

CREATE TABLE `point_settings` (
  `id` int(11) NOT NULL,
  `min_point_to_redeem` decimal(10,2) NOT NULL,
  `one_currency_equivalent` decimal(10,2) NOT NULL,
  `one_point_equivalent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `point_transaction`
--

CREATE TABLE `point_transaction` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `collected_point` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_sales`
--

CREATE TABLE `pos_sales` (
  `sales_id` int(11) NOT NULL,
  `invoice` varchar(500) NOT NULL,
  `invoice_date` date NOT NULL,
  `pay_type` enum('Cash','Credit','Card') NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(500) NOT NULL,
  `customer_phone` varchar(500) NOT NULL,
  `booking_address` varchar(500) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `payed` date NOT NULL,
  `supervisor_note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_sales_items`
--

CREATE TABLE `pos_sales_items` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `published` enum('yes','no','','') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

CREATE TABLE `price_list` (
  `id` int(11) NOT NULL,
  `price_list` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_list_items`
--

CREATE TABLE `price_list_items` (
  `id` int(11) NOT NULL,
  `price_list_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `batch` varchar(500) NOT NULL,
  `sales_rate` decimal(10,2) NOT NULL,
  `price_discount` decimal(10,2) NOT NULL,
  `price_discount_amount` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `prn_id` int(11) NOT NULL,
  `prn_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `prn_type` enum('inkjet','barcode','thermal','dot_matrix') NOT NULL,
  `is_default` enum('yes','no') NOT NULL DEFAULT 'no',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`prn_id`, `prn_name`, `prn_type`, `is_default`, `updatedate`) VALUES
(1, 'Microsoft Print to PDF', 'inkjet', 'yes', '2019-01-20 10:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `process_type`
--

CREATE TABLE `process_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `field1` varchar(100) NOT NULL,
  `field2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_label`
--

CREATE TABLE `production_label` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `values` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_process_additional_ledgers`
--

CREATE TABLE `production_process_additional_ledgers` (
  `id` int(11) NOT NULL,
  `main_table_id` int(11) DEFAULT NULL,
  `ledger_id` int(11) DEFAULT NULL,
  `ledger_amount` double DEFAULT NULL,
  `is_available` varchar(11) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_process_ledger_table`
--

CREATE TABLE `production_process_ledger_table` (
  `id` int(11) NOT NULL,
  `main_table_id` int(11) DEFAULT NULL,
  `product_table_id` int(11) DEFAULT NULL,
  `ledger_id` int(11) DEFAULT NULL,
  `ledger_amount` float DEFAULT NULL,
  `is_available` varchar(11) DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_process_main`
--

CREATE TABLE `production_process_main` (
  `id` int(11) NOT NULL,
  `bill_no` bigint(20) DEFAULT NULL,
  `voucher_no` varchar(500) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_available` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_process_material_table`
--

CREATE TABLE `production_process_material_table` (
  `id` int(11) NOT NULL,
  `main_table_id` int(11) DEFAULT NULL,
  `product_table_id` int(11) DEFAULT NULL,
  `godown_id` int(11) NOT NULL,
  `material_id` int(11) DEFAULT NULL,
  `material_quantity` double DEFAULT NULL,
  `material_price` float DEFAULT NULL,
  `material_row_total` double DEFAULT NULL,
  `is_available` varchar(11) DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_process_products`
--

CREATE TABLE `production_process_products` (
  `id` int(11) NOT NULL,
  `main_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL DEFAULT '0',
  `quantity` float DEFAULT NULL,
  `sales_rate` double DEFAULT NULL,
  `mrp` double DEFAULT NULL,
  `production_cost` double DEFAULT NULL,
  `is_available` varchar(11) DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_stage`
--

CREATE TABLE `production_stage` (
  `id` int(11) NOT NULL,
  `stage` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `is_previous` varchar(50) NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `production_status`
--

CREATE TABLE `production_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `percentage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production_status`
--

INSERT INTO `production_status` (`id`, `status`, `percentage`) VALUES
(1, 'Start', '20'),
(2, 'Completed', '100');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(10) UNSIGNED NOT NULL,
  `productname` varchar(255) NOT NULL,
  `expiration` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` enum('cost','item') NOT NULL DEFAULT 'item',
  `acctid` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `discription` varchar(100) NOT NULL,
  `field1` varchar(100) NOT NULL,
  `field2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_category`
--

CREATE TABLE `product_sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `field1` varchar(100) NOT NULL,
  `field2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(100) UNSIGNED NOT NULL,
  `invoice` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `cost_center` varchar(30) CHARACTER SET utf8 NOT NULL,
  `bill_no` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `shipping_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_gstin` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_state` int(11) NOT NULL,
  `cash_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `printtype` int(11) NOT NULL,
  `date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `rdate` date NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `additional_cess` decimal(10,2) NOT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `other` decimal(10,2) DEFAULT NULL,
  `freight` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `roundoff` decimal(10,2) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `narration` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `created_by` int(100) DEFAULT NULL,
  `bill_type` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` enum('pending','incompleted','completed') COLLATE utf8_unicode_ci NOT NULL,
  `purchase_status` enum('draft','send','confirmed') COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('purchase','porder','purchase_return','order') COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `cur_exc_amt` decimal(10,2) NOT NULL DEFAULT '1.00',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `salesman` int(11) NOT NULL,
  `supgst` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `supstate` int(11) NOT NULL,
  `ewb_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `supplier_ref` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `po_ref_no` text COLLATE utf8_unicode_ci NOT NULL,
  `customer_ref_no` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `ewb_details` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `route` int(11) NOT NULL,
  `vehicle` int(11) DEFAULT '0',
  `area` int(11) NOT NULL,
  `billing_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(100) UNSIGNED NOT NULL,
  `purchase_id` int(100) DEFAULT NULL,
  `item_order` int(11) NOT NULL DEFAULT '0',
  `item_id` int(100) DEFAULT NULL,
  `batch` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(100) DEFAULT NULL,
  `base_unit_id` int(100) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `base_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `free_quantity` decimal(10,2) NOT NULL,
  `base_free_quantity` decimal(10,2) NOT NULL,
  `order_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `item_discription` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `itm_ces_id` int(11) NOT NULL DEFAULT '0',
  `itm_ces_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `itm_ces_per` decimal(10,2) NOT NULL DEFAULT '0.00',
  `itm_raw_ces` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `analytics` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `godown` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL,
  `mrp_per` decimal(10,2) NOT NULL,
  `srate_per` decimal(10,2) NOT NULL,
  `whrate_per` decimal(10,2) NOT NULL,
  `special_rate_per` decimal(10,2) NOT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items_imei`
--

CREATE TABLE `purchase_items_imei` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `pur_itms_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `imei` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_ledgers`
--

CREATE TABLE `purchase_ledgers` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `is_taxincluded` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `id` int(20) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `details` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `qualification`, `details`, `created_at`, `updated_at`) VALUES
(3, 'physics', 'sddn', '2021-01-12 04:21:56', '2021-01-12 04:21:56'),
(4, 'chemistry', 'im a ', '2021-01-12 04:21:32', '2021-01-12 04:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(11) NOT NULL,
  `invoice` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `invoice_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `cusname` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `roundoff` decimal(10,2) NOT NULL,
  `bill_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `invoice`, `invoice_date`, `total`, `tax`, `discount`, `customer_id`, `published`, `cusname`, `phone`, `roundoff`, `bill_type`) VALUES
(1, 'QUO1', '2020-04-10', '30.00', '0.00', '0.00', 0, 'yes', '', '', '0.00', 14),
(2, 'QUO2', '2020-07-18', '11263.00', '0.00', '0.00', 0, 'yes', '', '', '0.40', 14),
(3, 'QUO3', '2020-07-18', '2625.00', '0.00', '0.00', 0, 'yes', '', '', '0.00', 14);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `qtn_itms_id` int(11) NOT NULL,
  `qtn_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `godown` int(11) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `dis_amt` decimal(10,2) NOT NULL,
  `roundoff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_items`
--

INSERT INTO `quotation_items` (`qtn_itms_id`, `qtn_id`, `item_id`, `quantity`, `rate`, `tax_id`, `tax`, `discount`, `total`, `published`, `godown`, `mrp`, `dis_amt`, `roundoff`) VALUES
(1, 1, 5, '1.00', '0.00', 1, '0.00', '0.00', '30.00', 'yes', 1, '30.00', '0.00', 0),
(2, 2, 1, '1.00', '0.00', 5, '5.00', '0.00', '105.00', 'yes', 1, '100.00', '0.00', 0),
(3, 2, 3, '5.00', '0.00', 2, '1620.00', '0.00', '10620.00', 'yes', 0, '1800.00', '0.00', 0),
(4, 2, 4, '2.00', '0.00', 4, '117.60', '0.00', '537.60', 'yes', 0, '210.00', '0.00', 0),
(5, 3, 1, '25.00', '0.00', 5, '125.00', '0.00', '2625.00', 'yes', 1, '100.00', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `rows` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `ref_id` int(20) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `details` varchar(300) CHARACTER SET utf8 NOT NULL,
  `percent_type` tinyint(1) NOT NULL,
  `percent` decimal(5,2) NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `address_lan` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `replacement`
--

CREATE TABLE `replacement` (
  `rep_id` int(11) NOT NULL,
  `rep_date` date NOT NULL,
  `rep_invoice` varchar(100) NOT NULL,
  `rep_bill_type` int(11) NOT NULL,
  `rep_user` int(11) NOT NULL,
  `rep_salesman` int(11) NOT NULL,
  `rep_customer` int(11) NOT NULL,
  `rep_reference` text NOT NULL,
  `rep_updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `replacement_items`
--

CREATE TABLE `replacement_items` (
  `rep_itm_id` int(11) NOT NULL,
  `rep_itm_rep_id` int(11) NOT NULL,
  `rep_itm_item` int(11) NOT NULL,
  `rep_itm_unit` int(11) NOT NULL,
  `rep_itm_base_unit` int(11) NOT NULL,
  `rep_itm_godown` int(11) NOT NULL,
  `rep_itm_quantity` decimal(10,2) NOT NULL,
  `rep_itm_rate` decimal(10,2) NOT NULL,
  `rep_itm_base_quantity` decimal(10,2) NOT NULL,
  `rep_itm_total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(100) UNSIGNED NOT NULL,
  `no` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `short` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `room_type_id` int(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(100) UNSIGNED NOT NULL,
  `invoice` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `device_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `credit_eod` date NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `dollar_value` decimal(10,2) NOT NULL,
  `packing_details` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cess` decimal(10,2) NOT NULL DEFAULT '0.00',
  `additional_cess` decimal(10,2) NOT NULL,
  `cash_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bank_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bank_id` int(11) DEFAULT '0',
  `bank_pay_method` enum('gpay','Card') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Card',
  `gpay_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `card_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `bank_ref` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `delivery_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_id` int(100) DEFAULT '0',
  `is_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `is_assigned` tinyint(1) NOT NULL DEFAULT '0',
  `is_synced` tinyint(1) NOT NULL DEFAULT '0',
  `other` decimal(10,2) DEFAULT NULL,
  `freight` decimal(10,2) DEFAULT NULL,
  `advance` decimal(10,2) DEFAULT '0.00',
  `discount` decimal(10,2) DEFAULT NULL,
  `redeemed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `redeemed_points` decimal(10,2) NOT NULL DEFAULT '0.00',
  `global_mrp` decimal(10,2) NOT NULL DEFAULT '0.00',
  `roundoff` decimal(10,2) DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `ref_amount` decimal(10,2) NOT NULL,
  `sales_ref` int(100) NOT NULL DEFAULT '0',
  `buyer` text COLLATE utf8_unicode_ci NOT NULL,
  `manager_id` int(100) DEFAULT NULL,
  `sales_man_id` int(100) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `narration` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `created_by` int(100) DEFAULT NULL,
  `type` enum('estimate','sales','sales8','sales_return','delivery_note') COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_type` int(11) NOT NULL,
  `paper_size` enum('full','half') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'full',
  `bill_margin` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `customer_id` int(20) DEFAULT NULL,
  `longitude` text COLLATE utf8_unicode_ci NOT NULL,
  `latitude` text COLLATE utf8_unicode_ci NOT NULL,
  `estimate_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('completed','incompleted','pending') COLLATE utf8_unicode_ci NOT NULL,
  `sales_status` enum('created','partialy_delivered','delivery_completed') COLLATE utf8_unicode_ci NOT NULL,
  `cash_type` enum('Cash','Credit','Bank','COB','Ca_Cr','Ba_Cr','Ba_Ca_Cr') COLLATE utf8_unicode_ci NOT NULL,
  `cash_status` tinyint(1) NOT NULL DEFAULT '0',
  `printtype` int(11) NOT NULL,
  `area` int(11) DEFAULT '0',
  `route` int(11) DEFAULT '0',
  `vehicle` int(11) DEFAULT '0',
  `salesman` int(11) DEFAULT NULL,
  `packed_by` int(11) NOT NULL,
  `cusname` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `cusgst` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cusstate` int(11) NOT NULL,
  `collected_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `adjustment_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `adjustment_ref` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ewb_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ref_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `pre_carriage` text COLLATE utf8_unicode_ci NOT NULL,
  `place_of_receipt` text COLLATE utf8_unicode_ci NOT NULL,
  `flight_no` text COLLATE utf8_unicode_ci NOT NULL,
  `port_of_landing` text COLLATE utf8_unicode_ci NOT NULL,
  `port_of_discharge` text COLLATE utf8_unicode_ci NOT NULL,
  `final_destination` text COLLATE utf8_unicode_ci NOT NULL,
  `country_final_destination` text COLLATE utf8_unicode_ci NOT NULL,
  `country_origin_of_goods` text COLLATE utf8_unicode_ci NOT NULL,
  `transport_mode` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `con_name` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `con_addr` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `con_contact` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  `con_gst` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `con_state` int(11) DEFAULT NULL,
  `ewb_details` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `terms_condition` varchar(1500) CHARACTER SET utf8 DEFAULT 'Enter text here...',
  `despatch_details` varchar(1500) CHARACTER SET utf8 DEFAULT 'Enter text here...',
  `cusdetails` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `cusemail` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `cost_center` varchar(30) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `saletype` enum('b2b','b2c') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_coupon`
--

CREATE TABLE `sales_coupon` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sal_itms_id` int(100) UNSIGNED NOT NULL,
  `sales_id` int(100) DEFAULT NULL,
  `sales_ref_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sales_ref_id` int(11) NOT NULL DEFAULT '0',
  `emei` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `emei_pur_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(100) DEFAULT NULL,
  `item_landing_cost` decimal(10,2) NOT NULL,
  `batch` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `size_id` int(11) NOT NULL DEFAULT '0',
  `unit_id` int(100) DEFAULT NULL,
  `base_unit_id` int(100) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit_qty` decimal(10,2) NOT NULL,
  `cartel_wt` decimal(10,2) NOT NULL,
  `cartel_no` decimal(10,2) NOT NULL,
  `base_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `base_free_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `base_damage_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `actual_quantity` decimal(10,2) NOT NULL,
  `damage_quantity` decimal(10,2) NOT NULL,
  `free_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `free_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `itm_fre_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
  `itm_fre_qty_for` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estimate_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rate` decimal(10,2) DEFAULT NULL,
  `ces` decimal(10,2) NOT NULL DEFAULT '0.00',
  `itm_ces_id` int(11) NOT NULL DEFAULT '0',
  `itm_ces_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `itm_ces_per` decimal(10,2) NOT NULL DEFAULT '0.00',
  `itm_raw_ces` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ces_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mrp` decimal(10,2) DEFAULT NULL,
  `item_commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_rate` decimal(10,2) NOT NULL,
  `mar_pur_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_margin` decimal(10,2) NOT NULL,
  `godown` int(11) NOT NULL,
  `analytics` int(11) NOT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL,
  `add_dis_per` decimal(10,2) NOT NULL,
  `add_dis_amt` decimal(10,2) NOT NULL,
  `item_discription` text COLLATE utf8_unicode_ci,
  `delivered_qty` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_ledgers`
--

CREATE TABLE `sales_ledgers` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `is_taxincluded` tinyint(1) NOT NULL DEFAULT '1',
  `ledger_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_print`
--

CREATE TABLE `sales_print` (
  `sp_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `bill_format_id` int(11) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `is_print` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_bill_ledger`
--

CREATE TABLE `service_bill_ledger` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `ledg_name` varchar(50) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax_perc` int(11) NOT NULL,
  `serv_amt` decimal(10,0) NOT NULL,
  `tax_amt` decimal(10,0) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_bill_main`
--

CREATE TABLE `service_bill_main` (
  `id` int(11) NOT NULL,
  `call_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `serv_eng` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_bill_sub`
--

CREATE TABLE `service_bill_sub` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `tax_amt` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sett_login`
--

CREATE TABLE `sett_login` (
  `set_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `set_ip` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `set_status` tinyint(1) NOT NULL,
  `set_logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `set_logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_login`
--

INSERT INTO `sett_login` (`set_id`, `user_id`, `session_id`, `set_ip`, `set_status`, `set_logintime`, `set_logout`) VALUES
(1, 1, '46tpbjosn6sunh27l3ina1h1v55k02uh', '103.210.40.228', 1, '2020-07-09 16:04:16', '0000-00-00 00:00:00'),
(2, 1, '4i6o1omgd5l81997faq586htmkpv8all', '103.210.40.226', 1, '2020-07-10 10:52:35', '0000-00-00 00:00:00'),
(3, 1, 'v3ppclf5e2qveojlvnqnp7sbq404ea4h', '157.46.131.179', 1, '2020-07-11 07:06:18', '0000-00-00 00:00:00'),
(4, 1, 'mlnamo9gjrr86nmh589nf9dncq37ejot', '157.46.131.179', 1, '2020-07-12 04:45:39', '0000-00-00 00:00:00'),
(5, 1, '4ntrughopg921mpf4asgjpmcukdlbb2p', '49.15.84.0', 1, '2020-07-12 11:19:07', '0000-00-00 00:00:00'),
(6, 1, '0g3rc9sjtv3htksi2vbaagra09hrmvuc', '137.97.107.148', 1, '2020-07-12 12:14:34', '0000-00-00 00:00:00'),
(7, 1, 'vkqc0ma2gc7aam29bodenhd9h7bmkibo', '103.210.40.245', 1, '2020-07-12 12:48:29', '0000-00-00 00:00:00'),
(8, 1, 'se6eg2t68d7ujolkpsh5oi5o0qtfbl0r', '157.46.131.179', 1, '2020-07-12 14:36:48', '0000-00-00 00:00:00'),
(9, 1, 'qpjern7ocm8g4lenhaadq4t21mqn5fjc', '157.46.131.179', 1, '2020-07-13 03:54:46', '0000-00-00 00:00:00'),
(10, 1, '9n8vt5afon9dn3gjnp3mpcsdgub59b8j', '103.210.40.249', 1, '2020-07-13 04:33:55', '0000-00-00 00:00:00'),
(11, 1, '6kp3t6b7qkvrrt9ebef2n88jlgiupijp', '137.97.135.234', 1, '2020-07-13 06:36:33', '0000-00-00 00:00:00'),
(12, 1, 'rk1f5v0f4hern3qptkpjrl89p7vo9bvh', '137.97.181.201', 1, '2020-07-13 08:34:29', '0000-00-00 00:00:00'),
(13, 1, 'qk1d9f5jkine12gdca46lbvppmmh2rpe', '137.97.156.83', 1, '2020-07-13 13:27:18', '0000-00-00 00:00:00'),
(14, 1, 'ong6qfed73gu83sveejn30i20frskaim', '137.97.154.134', 1, '2020-07-14 03:25:22', '0000-00-00 00:00:00'),
(15, 1, 'v2kkjkjognnst6740tebu3cjmfnfh9d5', '157.46.131.179', 1, '2020-07-14 12:26:33', '0000-00-00 00:00:00'),
(16, 1, '24jmdqlv53577sgcnndea4icr1gai3t0', '157.46.131.179', 1, '2020-07-14 14:55:32', '0000-00-00 00:00:00'),
(17, 1, '9rsu7bkrgnnklnggb7d1mil93he30v1u', '157.46.130.214', 1, '2020-07-15 07:34:32', '0000-00-00 00:00:00'),
(18, 1, 'rfid9sf06esj87oih8vuo8u2l47jto66', '27.97.219.72', 1, '2020-07-15 09:34:37', '0000-00-00 00:00:00'),
(19, 1, 'u3hi4m3nm425vfe5u1bqklcj96644loc', '103.17.110.106', 1, '2020-07-15 11:05:31', '0000-00-00 00:00:00'),
(20, 1, 't4fbludi2s9kjsv9bpanfjl8gg1fa859', '157.46.140.197', 1, '2020-07-17 04:33:40', '0000-00-00 00:00:00'),
(21, 1, '0fsou7ajtd17v3ha67pa7mlpvvno4iqn', '157.46.140.197', 1, '2020-07-17 04:53:50', '0000-00-00 00:00:00'),
(22, 1, 'cn62es204kh5e47llctpg5mv278uj95p', '103.17.110.118', 1, '2020-07-17 05:58:01', '0000-00-00 00:00:00'),
(23, 1, 'cfionm0rfcnrbpril9p4deq0ojj5qpec', '157.46.140.197', 0, '2020-07-17 06:02:24', '0000-00-00 00:00:00'),
(24, 1, 'fil1937fc8ifq1p4pigp2e6jfg7bn40p', '157.46.140.197', 1, '2020-07-17 06:03:48', '0000-00-00 00:00:00'),
(25, 1, 'b12gnq2qjih5djmtbuluppksgqcemqrv', '157.46.140.197', 1, '2020-07-17 06:18:22', '0000-00-00 00:00:00'),
(26, 1, 's0m0dvuiul8p19sk77v97kq9sian0tos', '137.97.122.92', 0, '2020-07-17 06:36:17', '0000-00-00 00:00:00'),
(27, 13, '0ioof98eug0pqmnkgguvq1po4l4mjbfa', '137.97.122.92', 1, '2020-07-17 06:36:37', '0000-00-00 00:00:00'),
(28, 12, '3q7mh3i5v9ubj73h539jm7bob0r24ut6', '103.17.110.118', 0, '2020-07-17 06:44:18', '0000-00-00 00:00:00'),
(29, 1, 'btjjnrtfjv329lgm962rou383k43t25a', '103.17.110.118', 0, '2020-07-17 06:44:44', '0000-00-00 00:00:00'),
(30, 12, '9g4tg4ukeki6k5qp8cr8i19rti9ri2el', '103.17.110.118', 1, '2020-07-17 06:45:12', '0000-00-00 00:00:00'),
(31, 1, 'ruf2gddl2c4ht8l5nq7sbm4htdblqqrn', '157.46.140.197', 1, '2020-07-17 11:45:04', '0000-00-00 00:00:00'),
(32, 1, 'bpvfrcpf9ait8q306u7s473f7qi713oa', '103.17.110.118', 1, '2020-07-17 12:46:37', '0000-00-00 00:00:00'),
(33, 1, '9uk7kn48ev4mnaa0085lpq560k21vbne', '157.46.140.197', 1, '2020-07-17 12:51:00', '0000-00-00 00:00:00'),
(34, 1, '5jhqqbpb2j7cnbusjd9m3e5c10n4st5j', '157.46.140.197', 1, '2020-07-17 13:13:27', '0000-00-00 00:00:00'),
(35, 15, 'tdi9p7pn9uuj37fc85ulvdg9o2ghsm75', '157.46.140.197', 0, '2020-07-17 13:22:20', '0000-00-00 00:00:00'),
(36, 1, '0ek12eqpe5bmls13nctjq1gkfbq38jie', '157.46.140.197', 0, '2020-07-17 13:25:31', '0000-00-00 00:00:00'),
(37, 15, 'd6910i2bhrp8vlemt3hltl0c5mtedepo', '157.46.140.197', 0, '2020-07-17 13:26:44', '0000-00-00 00:00:00'),
(38, 1, 'd617a76gasfvalv6hot2qi7d0deuiu0g', '157.46.140.197', 0, '2020-07-17 13:27:53', '0000-00-00 00:00:00'),
(39, 15, 'tan0mpigrqb66rr77ro02sh48t5hc77v', '157.46.140.197', 1, '2020-07-17 13:28:04', '0000-00-00 00:00:00'),
(40, 15, 'pj41n9hjsgjbn4ris3bjep2217g2fusu', '157.46.140.197', 0, '2020-07-17 13:37:20', '0000-00-00 00:00:00'),
(41, 1, 'heq1ff16tttp3om93753qd1ta2cmi9dp', '157.46.140.197', 1, '2020-07-17 13:37:26', '0000-00-00 00:00:00'),
(42, 15, '2bl73tnp7ms3jl341gm6drga9s1ugfmv', '157.46.140.197', 1, '2020-07-17 13:42:40', '0000-00-00 00:00:00'),
(43, 1, 'vmb143nggomde8kh5jiuern0msgfc0au', '157.46.140.197', 1, '2020-07-18 02:42:09', '0000-00-00 00:00:00'),
(44, 13, '2co1mcsa4npatrvpom3rlas6enhqk25i', '157.46.140.197', 0, '2020-07-18 03:43:06', '0000-00-00 00:00:00'),
(45, 1, 'shp4k1i2nogup7the9do21ltse8np3re', '157.46.140.197', 0, '2020-07-18 03:44:40', '0000-00-00 00:00:00'),
(46, 13, 'eocv7skms2t70uskv4qci9u0h3ia5c04', '157.46.140.197', 1, '2020-07-18 03:44:54', '0000-00-00 00:00:00'),
(47, 1, 'mk4tn930c7t7s81vtcsck9vjja4rsnha', '157.46.140.197', 1, '2020-07-18 04:04:29', '0000-00-00 00:00:00'),
(48, 1, '748rfgnhvpfhdkg695r2vb47ohda5v5h', '27.97.178.229', 1, '2020-07-18 07:22:18', '0000-00-00 00:00:00'),
(49, 13, 'ini7fql1p8ov021kkabqdeoh1q51o3r0', '27.97.178.229', 0, '2020-07-18 07:33:46', '0000-00-00 00:00:00'),
(50, 1, 'e1os56k65hdre9v3ulku5k1mp0gcshv0', '27.97.178.229', 0, '2020-07-18 07:34:59', '0000-00-00 00:00:00'),
(51, 13, '8gbi6d6la70dqijqunhm7m3nuejvb44h', '27.97.178.229', 0, '2020-07-18 07:36:06', '0000-00-00 00:00:00'),
(52, 1, 'fgte35ft70i93bt3f10emegdi08j1ds0', '27.97.178.229', 1, '2020-07-18 07:36:22', '0000-00-00 00:00:00'),
(53, 1, '5pevfq2290uleqoq2c00sopcmgqjvqtt', '27.97.178.229', 1, '2020-07-18 08:33:15', '0000-00-00 00:00:00'),
(54, 1, '62jfmhivvpakca71us2ou8rqv8ovb0n6', '157.46.140.197', 1, '2020-07-18 12:45:24', '0000-00-00 00:00:00'),
(55, 1, '9o0ho7mfdc28bj370p9h6ol0m8ff2ir6', '137.97.184.123', 1, '2020-07-19 07:01:28', '0000-00-00 00:00:00'),
(56, 1, 'i0a74gtutb8jkg7gj4ns4l5qaiaoc5p1', '157.46.154.197', 1, '2020-07-20 03:42:15', '0000-00-00 00:00:00'),
(57, 1, '63dpeqlmpvhmh1h8epdprtikfcesnl0s', '157.44.224.65', 1, '2020-08-17 09:54:57', '0000-00-00 00:00:00'),
(58, 1, 'ffd7a1tt6vg1i12qdupe8td15lj87fdo', '157.46.164.191', 1, '2020-08-20 05:40:20', '0000-00-00 00:00:00'),
(59, 1, '2kl18qcu6gfo1v53gi6r4k1dueq1s854', '157.46.156.189', 1, '2020-08-29 11:47:49', '0000-00-00 00:00:00'),
(60, 1, 't4n90sv96b4p5ukrorah8ondt11r9cbl', '157.44.219.175', 0, '2021-06-05 05:10:41', '0000-00-00 00:00:00'),
(61, 1, '44efe5gp5emoo7rpfq511m4eonccqjih', '157.44.165.180', 1, '2021-07-19 07:24:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `set_billtype`
--

CREATE TABLE `set_billtype` (
  `id` int(11) NOT NULL,
  `is_pos` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `print_type` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `startnumber` bigint(20) NOT NULL,
  `seperator` varchar(1) CHARACTER SET utf8 NOT NULL,
  `suffix` varchar(30) CHARACTER SET utf8 NOT NULL,
  `preffix` varchar(100) CHARACTER SET utf8 NOT NULL,
  `transaction` enum('sales','purchase','sales_return','purchase_return','estimate','order','pay','rec','jou','quotation','trip','contra','service','booking','delivery_note','replacement','credit_note','debit_note') NOT NULL,
  `cash` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `set_rate` enum('srate','MRP','wh_rate','special_rate') NOT NULL DEFAULT 'srate',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_billtype`
--

INSERT INTO `set_billtype` (`id`, `is_pos`, `type`, `print_type`, `branch_id`, `startnumber`, `seperator`, `suffix`, `preffix`, `transaction`, `cash`, `bank`, `godown_id`, `set_rate`, `updatedate`, `name_lan`) VALUES
(1, 0, 'Purchase', 1, 2, 1, '-', '', 'PU', 'purchase', 1, 166, 1, 'srate', '2022-02-28 06:33:29', NULL),
(2, 0, 'Sales', 1, 2, 1, '', '', 'MS', 'sales', 1, 166, 1, 'srate', '2022-02-28 06:33:34', NULL),
(3, 0, 'Purchase Order', 1, 2, 1, '', '', 'PO', 'order', 1, 166, 1, 'srate', '2022-02-28 06:33:34', NULL),
(4, 0, 'Sales Order', 6, 1, 1, '', '', 'SO', 'estimate', 1, 166, 1, 'srate', '2022-02-28 07:09:52', NULL),
(5, 0, 'Sale Return', 1, 1, 1, '', '', 'SR', 'sales_return', 1, 166, 1, 'srate', '2020-08-17 10:10:02', NULL),
(6, 0, 'Purchase Return', 1, 2, 1, '', '', 'PR', 'purchase_return', 1, 166, 1, 'srate', '2022-02-28 06:33:34', NULL),
(8, 0, 'Payment', 1, 1, 1, '', '', 'PAY', 'pay', 1, 166, 1, 'srate', '2020-08-17 10:09:12', NULL),
(9, 0, 'Receipt', 1, 1, 1, '', '', 'REC', 'rec', 1, 166, 1, 'srate', '2020-08-17 10:09:46', NULL),
(10, 0, 'Journal', 1, 1, 1, '', '', 'JOU', 'jou', 1, 166, 1, 'srate', '2020-08-17 10:08:53', NULL),
(18, 0, 'Contra', 1, 1, 1, '', '', 'Con/', 'contra', 1, 166, 1, 'srate', '2020-08-17 10:08:39', NULL),
(19, 0, 'Delivery note', 5, 1, 1, '', '', 'DN', 'delivery_note', 1, 166, 1, 'srate', '2022-02-28 07:09:33', NULL),
(21, 0, 'Credit Note', 5, 3, 1, '', '', 'CN', 'credit_note', 1, 166, 1, 'srate', '2022-03-09 08:45:25', NULL),
(22, 0, 'Delivery note', 5, 3, 1, '', '', 'DN', 'delivery_note', 1, 166, 1, 'srate', '2022-03-09 08:45:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `set_database`
--

CREATE TABLE `set_database` (
  `sdb_Id` int(11) NOT NULL,
  `sdb_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `sdb_username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sdb_password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sdb_server` varchar(15) CHARACTER SET utf8 NOT NULL,
  `year_id` int(11) NOT NULL,
  `sdb_curnt` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_database`
--

INSERT INTO `set_database` (`sdb_Id`, `sdb_name`, `sdb_username`, `sdb_password`, `sdb_server`, `year_id`, `sdb_curnt`, `updatedate`) VALUES
(1, 'dims_old', 'admin', 'admin123', 'local', 2018, 1, '2019-01-31 08:52:45'),
(2, 'dims_new', 'aa', 'aa', 'local', 2019, 1, '2019-01-10 18:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `set_device`
--

CREATE TABLE `set_device` (
  `dev_id` int(11) NOT NULL,
  `edit_itemrate` tinyint(1) NOT NULL DEFAULT '0',
  `dev_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `bill_id` int(11) NOT NULL,
  `sales_billtype` int(11) NOT NULL,
  `payment_billtype` int(11) NOT NULL,
  `estimate_billtype` int(11) NOT NULL,
  `salereturn_billtype` int(11) NOT NULL,
  `receipt_billtype` int(11) NOT NULL,
  `dev_number` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `com_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_device`
--

INSERT INTO `set_device` (`dev_id`, `edit_itemrate`, `dev_name`, `bill_id`, `sales_billtype`, `payment_billtype`, `estimate_billtype`, `salereturn_billtype`, `receipt_billtype`, `dev_number`, `com_id`, `godown_id`, `branch_id`) VALUES
(1, 0, 'Device', 17, 0, 8, 4, 5, 9, '77b4574481dbbd17', 1, 1, 0),
(2, 0, 'dev', 17, 0, 8, 4, 5, 9, '9e8e6a841c931c03', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `set_errors`
--

CREATE TABLE `set_errors` (
  `err_id` int(11) NOT NULL,
  `err_url` varchar(800) CHARACTER SET utf8 NOT NULL,
  `err_text` text NOT NULL,
  `errr_num` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `err_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_errors`
--

INSERT INTO `set_errors` (`err_id`, `err_url`, `err_text`, `errr_num`, `err_date`) VALUES
(1, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:28:50'),
(2, 'http://localhost/dims/reports/Gst/gstreprt_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:28:52'),
(3, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:28:53'),
(4, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:28:56'),
(5, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:28:58'),
(6, 'http://localhost/dims/reports/Gst/gstreprt_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:29:03'),
(7, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:29:04'),
(8, 'http://localhost/dims/reports/Gst/gstreprt_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:29:06'),
(9, 'http://localhost/dims/reports/Gst/gstreport_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:29:08'),
(10, 'http://localhost/dims/reports/Gst/gstreprt_custome', 'Requested page not found. [404]', '404', '2019-04-19 16:29:09'),
(11, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-04 10:38:03'),
(12, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-04 10:39:02'),
(13, 'http://localhost/PClinic/clinic/Booking/booking', 'Internal Server Error [500].', '500', '2019-05-04 15:26:31'),
(14, 'http://localhost/PClinic/clinic/Booking/booking', 'Internal Server Error [500].', '500', '2019-05-04 15:26:43'),
(15, 'http://localhost/dims/customers/save', 'Internal Server Error [500].', '500', '2019-05-05 15:37:10'),
(16, 'http://localhost/dims/reports/Collection/collection', 'Internal Server Error [500].', '500', '2019-05-06 13:05:00'),
(17, 'http://localhost/dims/reports/Collection/collection', 'Internal Server Error [500].', '500', '2019-05-06 13:05:23'),
(18, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-07 15:35:09'),
(19, 'http://localhost/dims/transaction/sales/save/sales', 'Requested JSON parse failed.', '200', '2019-05-07 16:06:55'),
(20, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-08 08:03:28'),
(21, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-08 08:06:36'),
(22, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-08 11:08:11'),
(23, 'http://localhost/PClinic/clinic/Doctor/edit/20831', 'Internal Server Error [500].', '500', '2019-05-11 12:38:10'),
(24, 'http://localhost/dims/Item/savefromexcel', 'Internal Server Error [500].', '500', '2019-05-11 13:59:13'),
(25, 'http://localhost/dims/Item/savefromexcel', 'Internal Server Error [500].', '500', '2019-05-11 14:09:36'),
(26, 'http://localhost/dims/Item/savefromexcel', 'Internal Server Error [500].', '500', '2019-05-11 14:15:01'),
(27, 'http://localhost/dims/Item/savefromexcel', 'Internal Server Error [500].', '500', '2019-05-11 14:41:10'),
(28, 'http://localhost/dims/Item/savefromexcel', 'Internal Server Error [500].', '500', '2019-05-11 15:30:26'),
(29, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-12 07:24:14'),
(30, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-12 07:24:28'),
(31, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-12 07:24:59'),
(32, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:06:46'),
(33, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:06:47'),
(34, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:06:47'),
(35, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:09:19'),
(36, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:09:19'),
(37, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:09:19'),
(38, 'http://localhost/dims/customers/save', 'Requested JSON parse failed.', '200', '2019-05-12 14:09:19'),
(39, 'http://localhost/PClinic/clinic/Doctor/edit/20831', 'Internal Server Error [500].', '500', '2019-05-12 15:16:42'),
(40, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-15 06:10:12'),
(41, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-15 06:13:46'),
(42, 'http://localhost/dims/reports/Commission/Commision', 'Internal Server Error [500].', '500', '2019-05-15 06:49:15'),
(43, 'http://localhost/dims/reports/Commission/Commision', 'Internal Server Error [500].', '500', '2019-05-15 06:49:21'),
(44, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-15 07:07:46'),
(45, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-15 07:08:06'),
(46, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-15 07:09:03'),
(47, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-15 10:19:44'),
(48, 'http://localhost/dims/reports/Daybook/Daybook_List', 'Internal Server Error [500].', '500', '2019-05-15 10:56:57'),
(49, 'http://localhost/dims/reports/Daybook/Daybook_List', 'Internal Server Error [500].', '500', '2019-05-15 10:57:04'),
(50, 'http://localhost/dims/transaction/purchase/save/purchase', 'Requested JSON parse failed.', '200', '2019-05-23 12:29:54'),
(51, 'http://localhost/dims/transaction/purchase/save/purchase', 'Requested JSON parse failed.', '200', '2019-05-25 05:50:54'),
(52, 'http://localhost/dims/transaction/purchase/save/purchase', 'Requested JSON parse failed.', '200', '2019-05-25 05:54:22'),
(53, 'http://localhost/dims/transaction/purchase/save/purchase', 'Internal Server Error [500].', '500', '2019-05-25 05:58:16'),
(54, 'http://localhost/dims/transaction/purchase/save/purchase', 'Internal Server Error [500].', '500', '2019-05-25 06:07:02'),
(55, 'http://localhost/dims/transaction/purchase/save/purchase', 'Internal Server Error [500].', '500', '2019-05-25 06:08:47'),
(56, 'http://localhost/dims/transaction/purchase/save/purchase', 'Internal Server Error [500].', '500', '2019-05-25 06:10:26'),
(57, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-28 05:27:28'),
(58, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-28 06:24:02'),
(59, 'http://localhost/dims/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2019-05-28 06:25:34'),
(60, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-28 11:29:50'),
(61, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-28 11:31:18'),
(62, 'http://localhost/dimsstudy/cost_analytics/analytics_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:43:10'),
(63, 'http://localhost/dimsstudy/cost_analytics/cost_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:43:20'),
(64, 'http://localhost/dimsstudy/cost_analytics/analytics_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:44:16'),
(65, 'http://localhost/dimsstudy/cost_analytics/cost_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:44:16'),
(66, 'http://localhost/dimsstudy/cost_analytics/analytics_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:44:30'),
(67, 'http://localhost/dimsstudy/cost_analytics/cost_centre/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:44:31'),
(68, 'http://localhost/dimsstudy/master/coupons/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:44:58'),
(69, 'http://localhost/dimsstudy/masters/cess', 'Internal Server Error [500].', '500', '2019-05-29 12:44:59'),
(70, 'http://localhost/dimsstudy/masters/cess', 'Internal Server Error [500].', '500', '2019-05-29 12:45:00'),
(71, 'http://localhost/dimsstudy/master/amaster/currency_type', 'Internal Server Error [500].', '500', '2019-05-29 12:45:01'),
(72, 'http://localhost/dimsstudy/customers/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:45:05'),
(73, 'http://localhost/dimsstudy/masters/gst', 'Internal Server Error [500].', '500', '2019-05-29 12:45:08'),
(74, 'http://localhost/dimsstudy/masters/gst', 'Internal Server Error [500].', '500', '2019-05-29 12:45:24'),
(75, 'http://localhost/dimsstudy/customers/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:46:00'),
(76, 'http://localhost/dimsstudy/master/amaster/currency_type', 'Internal Server Error [500].', '500', '2019-05-29 12:46:01'),
(77, 'http://localhost/dimsstudy/customers/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:46:18'),
(78, 'http://localhost/dimsstudy/master/amaster/material_type', 'Internal Server Error [500].', '500', '2019-05-29 12:46:19'),
(79, 'http://localhost/dimsstudy/master/amaster/material_type', 'Internal Server Error [500].', '500', '2019-05-29 12:46:21'),
(80, 'http://localhost/dimsstudy/master/amaster/material_type', 'Internal Server Error [500].', '500', '2019-05-29 12:46:29'),
(81, 'http://localhost/dimsstudy/master/coupons/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:47:05'),
(82, 'http://localhost/dimsstudy/itemsedit/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:47:44'),
(83, 'http://localhost/dimsstudy/master/godown/godown', 'Internal Server Error [500].', '500', '2019-05-29 12:47:48'),
(84, 'http://localhost/dimsstudy/item/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:48:14'),
(85, 'http://localhost/dimsstudy/kitgroup/listall/price_code', 'Internal Server Error [500].', '500', '2019-05-29 12:48:17'),
(86, 'http://localhost/dimsstudy/kitgroup/listall/kit_group', 'Internal Server Error [500].', '500', '2019-05-29 12:48:17'),
(87, 'http://localhost/dimsstudy/kitgroup/listall/price_code', 'Internal Server Error [500].', '500', '2019-05-29 12:48:18'),
(88, 'http://localhost/dimsstudy/itemedit/listall', 'Internal Server Error [500].', '500', '2019-05-29 12:48:20'),
(89, 'http://localhost/dimsstudy/MultipleBarcode/list_all', 'Internal Server Error [500].', '500', '2019-05-29 12:48:24'),
(90, 'http://localhost/dimsstudy/transaction/chque/list_all', 'Requested page not found. [404]', '404', '2019-05-29 12:48:37'),
(91, 'http://localhost/dimsstudy/pos/main/listall', 'Requested page not found. [404]', '404', '2019-05-29 12:48:50'),
(92, 'http://localhost/dimsstudy/master/Itemdamage/list_all', 'Internal Server Error [500].', '500', '2019-05-29 12:48:50'),
(93, 'http://localhost/dimsstudy/master/itemtransfer/list_all', 'Internal Server Error [500].', '500', '2019-05-29 12:48:51'),
(94, 'http://localhost/dimsstudy/transactionvoucherslistalljournal', 'Requested page not found. [404]', '404', '2019-05-29 12:48:51'),
(95, 'http://localhost/dimsstudy/transactionvoucherslistallpayment', 'Requested page not found. [404]', '404', '2019-05-29 12:48:52'),
(96, 'http://localhost/dimsstudy/transaction/purchase/create/purchase', 'Requested page not found. [404]', '404', '2019-05-29 12:48:52'),
(97, 'http://localhost/dimsstudy/transaction/purchase/listall/order	', 'Requested page not found. [404]', '404', '2019-05-29 12:48:53'),
(98, 'http://localhost/dimsstudy/transaction/purchase/listall/purchase_return', 'Requested page not found. [404]', '404', '2019-05-29 12:48:53'),
(99, 'http://localhost/dimsstudy/transaction/purchase/listall/purchase', 'Requested page not found. [404]', '404', '2019-05-29 12:48:54'),
(100, 'http://localhost/dimsstudy/transaction/quotation/listall', 'Requested page not found. [404]', '404', '2019-05-29 12:48:54'),
(101, 'http://localhost/dimsstudy/transactionvoucherslistall\receipt', 'Requested page not found. [404]', '404', '2019-05-29 12:48:55'),
(102, 'http://localhost/dimsstudy/transaction/sales/sales/sales', 'Requested page not found. [404]', '404', '2019-05-29 12:48:55'),
(103, 'http://localhost/dimsstudy/transaction/sales/listall/estimate', 'Requested page not found. [404]', '404', '2019-05-29 12:48:56'),
(104, 'http://localhost/dimsstudy/transaction/sales/listall/sales_return', 'Requested page not found. [404]', '404', '2019-05-29 12:48:57'),
(105, 'http://localhost/dimsstudy/billformat/billformat', 'Internal Server Error [500].', '500', '2019-05-29 12:49:15'),
(106, 'http://localhost/dimsstudy/transactionvoucherslistallpayment', 'Requested page not found. [404]', '404', '2019-05-29 14:25:02'),
(107, 'http://localhost/dimsstudy/transactionvoucherslistallpayment', 'Requested page not found. [404]', '404', '2019-05-29 14:25:04'),
(108, 'http://localhost/dims/item/excel', 'Internal Server Error [500].', '500', '2019-05-30 08:29:05'),
(109, 'http://localhost/dims/item/excel', 'Internal Server Error [500].', '500', '2019-05-30 08:29:14'),
(110, 'http://localhost/dims/item/excel', 'Internal Server Error [500].', '500', '2019-05-30 10:00:11'),
(111, 'http://localhost/dims/item/excel', 'Internal Server Error [500].', '500', '2019-05-30 10:00:16'),
(112, 'http://localhost/dims/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-05-30 11:58:14'),
(113, 'http://ozoneerp.com/v2/kitgroup/save', 'Requested JSON parse failed.', '200', '2019-10-27 09:44:07'),
(114, 'http://ozoneerp.com/v2/settings/sms/sms_types', 'Internal Server Error [500].', '500', '2019-10-27 10:14:37'),
(115, 'http://ozoneerp.com/v2/settings/sms/sms_types', 'Internal Server Error [500].', '500', '2019-10-27 10:14:45'),
(116, 'http://ozoneerp.com/v2/crm_new/Enquiry_register/view/15', 'Internal Server Error [500].', '500', '2019-11-01 08:22:36'),
(117, 'http://ozoneerp.com/v2/crm_new/Enquiry_allocation/save_allocation', 'Internal Server Error [500].', '500', '2019-11-10 13:03:54'),
(118, 'http://ozoneerp.com/v2/crm_new/Enquiry_allocation/save_allocation', 'Internal Server Error [500].', '500', '2019-11-10 13:04:17'),
(119, 'http://ozoneerp.com/v2/crm_new/Enquiry_allocation/save_allocation', 'Internal Server Error [500].', '500', '2019-11-10 13:15:53'),
(120, 'http://www.ozoneerp.com/v2/crm_general/Enquiry_allocation/save', 'Internal Server Error [500].', '500', '2019-11-11 13:17:11'),
(121, 'http://ozoneerp.com/v2/crm_general/Enquiry_allocation/save', 'Internal Server Error [500].', '500', '2019-11-20 07:01:33'),
(122, 'http://ozoneerp.com/v2/crm_general/Enquiry_allocation/save', 'Internal Server Error [500].', '500', '2019-11-20 07:07:51'),
(123, 'http://www.ozoneerp.com/v2/crm_general/Enquiry_allocation/save', 'Internal Server Error [500].', '500', '2019-11-20 08:58:36'),
(124, 'http://www.ozoneerp.com/v2/crm_general/Leads_master/listTypeofBuss', 'Requested page not found. [404]', '404', '2019-11-22 14:07:16'),
(125, 'http://www.ozoneerp.com/v2/crm_general/Leads_master/listTypeofBuss', 'Requested page not found. [404]', '404', '2019-11-22 14:07:38'),
(126, 'http://ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-11-28 14:03:36'),
(127, 'http://www.ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-11-29 10:09:24'),
(128, 'http://www.ozoneerp.com/v2/hr/SalaryPackage/list_all', 'Requested page not found. [404]', '404', '2019-11-29 10:09:27'),
(129, 'http://www.ozoneerp.com/v2/hr/paysettings/listall', 'Requested page not found. [404]', '404', '2019-11-29 10:09:29'),
(130, 'http://www.ozoneerp.com/v2/hr/Salary/list_all', 'Requested page not found. [404]', '404', '2019-11-29 10:09:31'),
(131, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:02:08'),
(132, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:02:10'),
(133, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:02:16'),
(134, 'http://ozoneerp.com/v2/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:14:31'),
(135, 'http://ozoneerp.com/v2/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:16:21'),
(136, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:18:28'),
(137, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:18:30'),
(138, 'http://ozoneerp.com/v2/transaction/sales/listall/sales', 'Internal Server Error [500].', '500', '2019-12-02 11:20:01'),
(139, 'http://ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-12-03 13:04:41'),
(140, 'http://ozoneerp.com/v2/hr/paysettings/listall', 'Requested page not found. [404]', '404', '2019-12-03 13:04:42'),
(141, 'http://ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-12-03 13:04:43'),
(142, 'http://ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-12-03 13:04:48'),
(143, 'http://ozoneerp.com/v2/hr/SalaryPackage/list_all', 'Requested page not found. [404]', '404', '2019-12-03 13:04:53'),
(144, 'http://ozoneerp.com/v2/hr/SalaryDistribution/list_all', 'Requested page not found. [404]', '404', '2019-12-03 13:05:04'),
(145, 'http://www.ozoneerp.com/v2/masters/hsncode', 'Internal Server Error [500].', '500', '2019-12-07 11:27:57'),
(146, 'http://www.ozoneerp.com/v2/masters/hsncode', 'Internal Server Error [500].', '500', '2019-12-07 11:28:09'),
(147, 'http://www.ozoneerp.com/v2/assets/pdf/arawa.pdf', 'Requested page not found. [404]', '404', '2019-12-07 12:32:00'),
(148, 'http://www.ozoneerp.com/v2/master/Itemdamage/save', 'Requested JSON parse failed.', '200', '2019-12-17 17:10:07'),
(149, 'https://demo.ozoneerp.com/v3/hr/paysettings/listall', 'Requested page not found. [404]', '404', '2020-02-23 10:51:24'),
(150, 'https://demo.ozoneerp.com/v3/hr/paysettings/listall', 'Requested page not found. [404]', '404', '2020-02-23 10:51:28'),
(151, 'https://demo.ozoneerp.com/v3/hr/paysettings/listall', 'Requested page not found. [404]', '404', '2020-02-23 10:51:34'),
(152, 'https://demo.ozoneerp.com/v3/settings/sms/sms_types', 'Internal Server Error [500].', '500', '2020-04-01 03:22:10'),
(153, 'https://demo.ozoneerp.com/v3/assets/pdf/arawa.pdf', 'Requested page not found. [404]', '404', '2020-04-01 03:24:58'),
(154, 'https://demo.ozoneerp.com/v3/inventory_master/Item/listall', 'Internal Server Error [500].', '500', '2020-04-11 11:11:28'),
(155, 'https://demo.ozoneerp.com/v3/inventory_master/Item/listall', 'Internal Server Error [500].', '500', '2020-04-11 11:11:43'),
(156, 'https://demo.ozoneerp.com/v3/transaction/purchase/save/order', 'Requested JSON parse failed.', '200', '2020-04-27 15:33:58'),
(157, '', 'Requested JSON parse failed.', '200', '2020-04-30 14:12:21'),
(158, 'https://demo.ozoneerp.com/v3/transaction/purchase/save/purchase', 'Requested JSON parse failed.', '200', '2020-05-02 02:35:49'),
(159, 'https://demo.ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-05-02 03:31:08'),
(160, 'https://demo.ozoneerp.com/v3/inventory_master/Item/create', 'Internal Server Error [500].', '500', '2020-05-02 06:49:50'),
(161, 'https://demo.ozoneerp.com/v3/customers/listall', 'Internal Server Error [500].', '500', '2020-05-02 06:49:56'),
(162, 'https://demo.ozoneerp.com/v3/suppliers/listall/sup', 'Internal Server Error [500].', '500', '2020-05-02 06:50:00'),
(163, 'https://demo.ozoneerp.com/v3/customers/listall', 'Internal Server Error [500].', '500', '2020-05-02 06:50:15'),
(164, 'https://demo.ozoneerp.com/v3/itemsitemcategory', 'Requested page not found. [404]', '404', '2020-05-02 09:36:35'),
(165, 'https://demo.ozoneerp.com/v3/itemsitemcategory', 'Requested page not found. [404]', '404', '2020-05-02 11:51:50'),
(166, '', 'Requested JSON parse failed.', '200', '2020-05-05 04:45:11'),
(167, 'https://demo.ozoneerp.com/v3/settings/CompanySettings/listall', 'Internal Server Error [500].', '500', '2020-05-05 05:28:49'),
(168, 'https://demo.ozoneerp.com/v3/settings/CompanySettings/listall', 'Internal Server Error [500].', '500', '2020-05-05 05:30:23'),
(169, 'https://demo.ozoneerp.com/v3/settings/CompanySettings/listall', 'Internal Server Error [500].', '500', '2020-05-05 05:30:38'),
(170, 'https://demo.ozoneerp.com/v3/accounts_master/ledger/save', 'Internal Server Error [500].', '500', '2020-05-07 06:17:00'),
(171, 'https://demo.ozoneerp.com/v3/pos/Main/listall', 'Internal Server Error [500].', '500', '2020-05-07 11:14:28'),
(172, 'https://demo.ozoneerp.com/v3/pos/Main/listall', 'Internal Server Error [500].', '500', '2020-05-07 11:14:42'),
(173, 'https://demo.ozoneerp.com/v3/customers/save', 'Internal Server Error [500].', '500', '2020-05-12 07:42:59'),
(174, 'https://demo.ozoneerp.com/v3/settings/CompanySettings/listall', 'Internal Server Error [500].', '500', '2020-05-15 13:14:37'),
(175, 'https://demo.ozoneerp.com/v3/inventory_master/Item/create', 'Internal Server Error [500].', '500', '2020-05-15 13:17:16'),
(176, 'https://demo.ozoneerp.com/v3/inventory_master/Item/create', 'Internal Server Error [500].', '500', '2020-05-15 13:20:07'),
(177, 'https://demo.ozoneerp.com/v3/inventory_master/Item/create', 'Internal Server Error [500].', '500', '2020-05-15 13:29:48'),
(178, 'https://ozoneerp.com/v3/customers/save', 'Internal Server Error [500].', '500', '2020-06-11 14:31:50'),
(179, 'https://www.ozoneerp.com/v3/customers/save', 'Internal Server Error [500].', '500', '2020-06-11 14:32:50'),
(180, 'https://www.ozoneerp.com/v3/customers/save', 'Internal Server Error [500].', '500', '2020-06-11 14:33:08'),
(181, 'https://ozoneerp.com/v3/accounts_master/ledger/save', 'Internal Server Error [500].', '500', '2020-06-17 09:14:40'),
(182, 'https://ozoneerp.com/v3/accounts_master/ledger/save', 'Internal Server Error [500].', '500', '2020-06-17 09:15:28'),
(183, 'https://ozoneerp.com/v3/accounts_master/ledger/save', 'Internal Server Error [500].', '500', '2020-06-17 09:21:59'),
(184, 'https://ozoneerp.com/v3/accounts_master/ledger/save', 'Internal Server Error [500].', '500', '2020-06-17 09:22:41'),
(185, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 10:53:39'),
(186, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 10:54:13'),
(187, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 11:08:52'),
(188, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 11:14:08'),
(189, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 11:16:40'),
(190, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Requested JSON parse failed.', '200', '2020-06-17 11:31:20'),
(191, 'https://ozoneerp.com/v3/transaction/sales/save/sales', 'Internal Server Error [500].', '500', '2020-06-27 09:55:15'),
(192, 'https://ozoneerp.com/v3/settings/set_device/device', 'Internal Server Error [500].', '500', '2020-07-03 04:56:39'),
(193, 'https://ozoneerp.com/v3/settings/set_device/device', 'Internal Server Error [500].', '500', '2020-07-03 04:56:46'),
(194, 'https://ozoneerp.com/v3/transaction/vouchers/save', 'Internal Server Error [500].', '500', '2020-07-05 06:52:38'),
(195, 'https://ozoneerp.com/v3/transaction/vouchers/savecontra', 'Requested JSON parse failed.', '200', '2020-07-12 14:38:34'),
(196, '', 'Internal Server Error [500].', '500', '2020-07-13 06:36:40'),
(197, '', 'Internal Server Error [500].', '500', '2020-07-13 06:36:43'),
(198, '', 'Internal Server Error [500].', '500', '2020-07-13 06:36:57'),
(199, '', 'Internal Server Error [500].', '500', '2020-07-13 06:37:06'),
(200, '', 'Internal Server Error [500].', '500', '2020-07-13 06:37:14'),
(201, 'https://ozoneerp.com/v3/transaction/vouchers/savecontra', 'Requested JSON parse failed.', '200', '2020-07-18 03:18:21'),
(202, '', 'Requested page not found. [404]', '404', '2020-07-18 05:42:45'),
(203, 'https://ozoneerp.com/v3/crm_general/Enquiry_followup/save', 'Internal Server Error [500].', '500', '2020-07-18 07:32:30'),
(204, 'https://ozoneerp.com/v3/masters/units/delete/3', 'Internal Server Error [500].', '500', '2020-08-17 09:57:43'),
(205, 'https://ozoneerp.com/v3/masters/units/delete/3', 'Internal Server Error [500].', '500', '2020-08-17 09:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `set_printtype`
--

CREATE TABLE `set_printtype` (
  `id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `page` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pagesize` int(11) NOT NULL,
  `half_pagesize` int(11) NOT NULL,
  `pdf_type` enum('Mpdf','pdf') NOT NULL,
  `paper` varchar(10) NOT NULL,
  `code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `bill_default` enum('no','yes') NOT NULL,
  `image` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `print_settings` text NOT NULL,
  `footer_settings` text NOT NULL,
  `bill_format` int(11) NOT NULL,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `language` enum('English','Arabic') NOT NULL DEFAULT 'English'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_printtype`
--

INSERT INTO `set_printtype` (`id`, `name`, `page`, `pagesize`, `half_pagesize`, `pdf_type`, `paper`, `code`, `published`, `bill_default`, `image`, `updatedate`, `print_settings`, `footer_settings`, `bill_format`, `name_lan`, `language`) VALUES
(1, 'Main Print', '20', 20, 5, 'Mpdf', 'A4', 'bill_settings', 'yes', 'yes', NULL, '2022-07-16 11:03:32', '[{\"Field\":\"due_date\",\"Field_name\":\"due_date\",\"Isvisible\":\"YES\",\"display_as\":\"Due Date\",\"width\":\"\"},{\"Field\":\"delivery_date\",\"Field_name\":\"delivery_date\",\"Isvisible\":\"YES\",\"display_as\":\"Delivery Date\",\"width\":\"\"},{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"unit\",\"Field_name\":\"unit\",\"Isvisible\":\"YES\",\"display_as\":\"Uint\",\"width\":\"40px\"},{\"Field\":\"free_quantity\",\"Field_name\":\"free_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"FQty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"YES\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English'),
(4, 'POS', '[65,500]', 23, 0, 'Mpdf', '[65,500]', 'new', 'yes', 'no', '', '2022-02-28 07:03:48', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English'),
(5, 'Delivery Note', 'P', 10, 0, 'Mpdf', 'A4', 'spanish', 'yes', 'no', '', '2022-02-28 06:43:53', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'Arabic'),
(6, 'Estimate', '30', 30, 0, 'pdf', '', 'estimate', 'yes', '', NULL, '2022-02-28 07:03:08', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English'),
(7, 'Print 2', '30', 30, 0, 'pdf', '', 'bill3', 'yes', '', NULL, '2021-06-03 11:40:13', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English'),
(8, 'Print 3', '33', 30, 0, 'pdf', '', 'bill5', 'yes', '', NULL, '2021-06-03 11:40:13', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English'),
(9, 'Print 4', '30', 30, 0, 'pdf', '', 'bill1_1', 'yes', '', NULL, '2021-06-03 11:40:13', '[{\"Field\":\"item_name\",\"Field_name\":\"item_name\",\"Isvisible\":\"YES\",\"display_as\":\"Item\",\"width\":\"120px\"},{\"Field\":\"item_barcode\",\"Field_name\":\"item_barcode\",\"Isvisible\":\"NO\",\"display_as\":\"Barcode\",\"width\":\"40px\"},{\"Field\":\"hsn_code\",\"Field_name\":\"hsn_code\",\"Isvisible\":\"YES\",\"display_as\":\"HSN\",\"width\":\"40px\"},{\"Field\":\"item_quantity\",\"Field_name\":\"item_quantity\",\"Isvisible\":\"YES\",\"display_as\":\"Qty\",\"width\":\"40px\"},{\"Field\":\"MRP\",\"Field_name\":\"MRP\",\"Isvisible\":\"NO\",\"display_as\":\"MRP\",\"width\":\"40px\"},{\"Field\":\"Rate\",\"Field_name\":\"Rate\",\"Isvisible\":\"YES\",\"display_as\":\"Rate \",\"width\":\"40px\"},{\"Field\":\"discount\",\"Field_name\":\"discount\",\"Isvisible\":\"NO\",\"display_as\":\"Discount\",\"width\":\"40px\"},{\"Field\":\"beforetax\",\"Field_name\":\"beforetax\",\"Isvisible\":\"YES\",\"display_as\":\"Amount\",\"width\":\"40px\"},{\"Field\":\"taxpercentage\",\"Field_name\":\"taxpercentage\",\"Isvisible\":\"YES\",\"display_as\":\"GST %\",\"width\":\"40px\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"YES\",\"display_as\":\"SGST\",\"width\":\"40px\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"YES\",\"display_as\":\"CGST\",\"width\":\"40px\"},{\"Field\":\"item_cess\",\"Field_name\":\"item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\",\"width\":\"40px\"},{\"Field\":\"Total\",\"Field_name\":\"Total\",\"Isvisible\":\"YES\",\"display_as\":\"Total\",\"width\":\"40px\"}]', '[{\"Field\":\"Before_Tax\",\"Field_name\":\"Before_Tax\",\"Isvisible\":\"YES\",\"display_as\":\"Before Tax\"},{\"Field\":\"SGST\",\"Field_name\":\"SGST\",\"Isvisible\":\"NO\",\"display_as\":\"SGST\"},{\"Field\":\"CGST\",\"Field_name\":\"CGST\",\"Isvisible\":\"NO\",\"display_as\":\"CGST\"},{\"Field\":\"Total_tax\",\"Field_name\":\"Total_tax\",\"Isvisible\":\"YES\",\"display_as\":\"GST \"},{\"Field\":\"Item_cess\",\"Field_name\":\"Item_cess\",\"Isvisible\":\"NO\",\"display_as\":\"Item Cess\"},{\"Field\":\"KFC\",\"Field_name\":\"KFC\",\"Isvisible\":\"YES\",\"display_as\":\"KFC\"},{\"Field\":\"Bill_discount\",\"Field_name\":\"Bill_discount\",\"Isvisible\":\"NO\",\"display_as\":\"Bill Discount\"},{\"Field\":\"round_off\",\"Field_name\":\"round_off\",\"Isvisible\":\"YES\",\"display_as\":\"Round Off\"},{\"Field\":\"Bill_total\",\"Field_name\":\"Bill_total\",\"Isvisible\":\"YES\",\"display_as\":\"Bill Total\"},{\"Field\":\"Terms\",\"Field_name\":\"Terms\",\"Isvisible\":\"YES\",\"display_as\":\"Terms\"},{\"Field\":\"Bank_details\",\"Field_name\":\"Bank_details\",\"Isvisible\":\"YES\",\"display_as\":\"Bank Details\"}]', 0, NULL, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `code` varchar(500) NOT NULL,
  `size` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `code`, `size`, `description`, `updatedate`) VALUES
(2, '120*60', '120*60', '', '2019-09-08 15:18:00'),
(3, '160*80', '160*80', '', '2019-09-08 15:18:00'),
(4, '30*30', '30*30', '', '2019-09-08 15:18:00'),
(5, '60*60', '60*60', '', '2019-09-08 15:18:00'),
(6, '80*80', '80*80', '', '2019-09-08 15:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `sli_id` int(11) NOT NULL,
  `sli_title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sli_image` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sli_description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sms` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `is_default` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_keywords`
--

CREATE TABLE `sms_keywords` (
  `id` int(11) NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `published` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `api_password` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `sender` varchar(6) CHARACTER SET utf8 NOT NULL,
  `priority` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_type`
--

CREATE TABLE `sms_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `software_version`
--

CREATE TABLE `software_version` (
  `id` int(11) NOT NULL,
  `version_name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `folder_path` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `db_path` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` datetime NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_version`
--

INSERT INTO `software_version` (`id`, `version_name`, `folder_path`, `db_path`, `created_date`, `created_by`, `updatedate`) VALUES
(1, 'V1', 'ss', 'ss', '2017-07-03 00:00:00', '2017-07-10 00:00:00', '2018-12-14 06:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `imageupload` varchar(500) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `field1` varchar(100) NOT NULL,
  `field2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `source_enquiry`
--

CREATE TABLE `source_enquiry` (
  `id` int(11) NOT NULL,
  `source_of_enquiry` varchar(500) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source_enquiry`
--

INSERT INTO `source_enquiry` (`id`, `source_of_enquiry`, `details`) VALUES
(2, 'test', 'test'),
(3, 'Direct walking', 'nvn'),
(4, 'telecall', 'm'),
(5, 'Advertising', 'khkj'),
(6, 'skynet', 'dfsdfsdfs'),
(7, 'softland', 'dgdhfh'),
(8, 'CA referal', 'ca'),
(9, 'Telephone', 'leads'),
(10, 'walk in', 'leads'),
(11, 'webleads', 'leads'),
(12, 'webinar/workshops', 'leads'),
(13, 'Refferal', 'leads');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateName` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `Notes` longtext,
  `ChangeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `CountryID`, `StateName`, `code`, `Notes`, `ChangeDate`, `name_lan`) VALUES
(36, 1, 'ANDHRA PRADESH', 37, NULL, '2021-02-22 05:08:55', ''),
(37, 1, 'ASSAM', 18, NULL, '2021-02-22 05:09:14', ''),
(38, 1, 'ARUNACHAL PRADESH', 12, NULL, '2021-02-22 05:09:25', ''),
(39, 1, 'GUJRAT', 24, NULL, '2021-02-22 05:09:49', ''),
(40, 1, 'BIHAR', 10, NULL, '2021-02-22 05:09:59', ''),
(41, 1, 'HARYANA', 6, NULL, '2021-02-22 05:10:09', ''),
(42, 1, 'HIMACHAL PRADESH', 2, NULL, '2021-02-13 09:03:33', ''),
(43, 1, 'JAMMU & KASHMIR', 1, NULL, '2021-02-13 09:03:21', ''),
(44, 1, 'KARNATAKA', 29, NULL, '2021-02-22 05:10:29', ''),
(45, 1, 'KERALA', 32, NULL, '2021-02-13 09:02:18', ''),
(46, 1, 'MADHYA PRADESH', 23, NULL, '2021-02-22 05:10:39', ''),
(47, 1, 'MAHARASHTRA', 27, NULL, '2021-02-22 05:10:49', ''),
(48, 1, 'MANIPUR', 14, NULL, '2021-02-22 05:10:58', ''),
(49, 1, 'MEGHALAYA', 17, NULL, '2021-02-22 05:11:05', ''),
(50, 1, 'MIZORAM', 15, NULL, '2021-02-22 05:11:14', ''),
(51, 1, 'NAGALAND', 13, NULL, '2021-02-22 05:11:26', ''),
(52, 1, 'ORISSA', 0, NULL, '2018-03-21 13:05:42', ''),
(53, 1, 'PUNJAB', 3, NULL, '2021-02-13 09:03:48', ''),
(54, 1, 'RAJASTHAN', 8, NULL, '2021-02-22 05:11:51', ''),
(55, 1, 'SIKKIM', 11, NULL, '2021-02-22 05:11:59', ''),
(56, 1, 'TAMIL NADU', 33, NULL, '2021-02-13 09:04:38', ''),
(57, 1, 'TRIPURA', 16, NULL, '2021-02-22 05:12:10', ''),
(58, 1, 'UTTAR PRADESH', 9, NULL, '2021-02-22 05:12:17', ''),
(59, 1, 'WEST BENGAL', 19, NULL, '2021-02-22 05:12:24', ''),
(60, 1, 'DELHI', 7, NULL, '2021-02-22 05:12:37', ''),
(61, 1, 'GOA', 30, NULL, '2021-02-22 05:12:53', ''),
(62, 1, 'PONDICHERY', 34, NULL, '2021-02-22 05:13:04', ''),
(63, 1, 'LAKSHDWEEP', 31, NULL, '2021-02-22 05:13:13', ''),
(64, 1, 'DAMAN & DIU', 26, NULL, '2021-02-22 05:13:22', ''),
(65, 1, 'DADRA & NAGAR', 26, NULL, '2021-02-22 05:13:46', ''),
(66, 1, 'CHANDIGARH', 4, NULL, '2021-02-13 09:04:01', ''),
(67, 1, 'ANDAMAN & NICOBAR', 0, NULL, '2018-03-21 13:05:43', ''),
(68, 1, 'UTTARANCHAL', 0, NULL, '2018-03-21 13:05:43', ''),
(69, 1, 'JHARKHAND', 20, NULL, '2021-02-22 05:14:18', ''),
(70, 1, 'CHATTISGARH', 22, NULL, '2021-02-22 05:14:29', ''),
(71, 0, 'Kerala', 32, NULL, '2021-02-18 05:02:44', ''),
(72, 0, 'KERALA', 32, NULL, '2021-02-21 13:56:25', '');

-- --------------------------------------------------------

--
-- Table structure for table `status_master`
--

CREATE TABLE `status_master` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `note` text NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_master`
--

INSERT INTO `status_master` (`id`, `status`, `note`, `updateddate`) VALUES
(1, 'positive', 'new updated Status', '2019-11-25 13:54:34'),
(3, 'interested', 'Add after delete', '2019-11-25 13:58:47'),
(4, 'neutral', '', '2019-12-03 08:37:02'),
(5, 'visited', '', '2019-12-03 08:37:25'),
(6, 'negative', '', '2019-12-03 08:37:42'),
(7, 'call back', '', '2020-07-08 10:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `stock_journal`
--

CREATE TABLE `stock_journal` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(20) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `reference` varchar(100) NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_journal_items`
--

CREATE TABLE `stock_journal_items` (
  `id` int(11) NOT NULL,
  `stock_journal_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('increase','decrease') NOT NULL,
  `godown_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `srate` decimal(10,2) NOT NULL,
  `prate` decimal(10,2) NOT NULL,
  `stock_value` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_journal_ledger`
--

CREATE TABLE `stock_journal_ledger` (
  `id` int(11) NOT NULL,
  `stock_journal_id` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(100) UNSIGNED NOT NULL,
  `lead_ref_id` int(11) NOT NULL,
  `supplier_main_id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` text COLLATE utf8_unicode_ci NOT NULL,
  `latitude` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 NOT NULL,
  `total_points` decimal(10,2) NOT NULL DEFAULT '0.00',
  `redeemed_points` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cus_agent` int(11) DEFAULT NULL,
  `cus_salesman` int(11) DEFAULT NULL,
  `cus_rate` enum('srate','MRP','wh_rate','special_rate','') COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contact_person` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contact_number` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tin` varchar(15) CHARACTER SET utf8 NOT NULL,
  `cst` varchar(15) CHARACTER SET utf8 NOT NULL,
  `gst` varchar(15) CHARACTER SET utf8 NOT NULL,
  `district` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `email` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'password',
  `address_line1` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `address_line2` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `details` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(3) CHARACTER SET utf8 NOT NULL,
  `listed_in_supplier` tinyint(1) NOT NULL DEFAULT '0',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `credit_period` int(100) NOT NULL,
  `credit_period_exceed` int(11) NOT NULL DEFAULT '0',
  `credit_amount` decimal(10,2) NOT NULL,
  `credit_amount_exceed` int(11) NOT NULL DEFAULT '0',
  `bank` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `account_no` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ifsc_code` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `area` int(11) DEFAULT '1',
  `route` int(11) DEFAULT '1',
  `price_list` int(11) DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL,
  `address_line1_lan` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `address_line2_lan` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `pincode` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(500) NOT NULL,
  `code` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `percent` decimal(4,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxgst`
--

CREATE TABLE `taxgst` (
  `gstid` int(11) NOT NULL,
  `cgst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sgst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `igst` decimal(10,2) NOT NULL DEFAULT '0.00',
  `GST` varchar(1500) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `cess_type` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxgst`
--

INSERT INTO `taxgst` (`gstid`, `cgst`, `sgst`, `igst`, `GST`, `cess_type`, `published`, `updatedate`) VALUES
(1, '0.00', '0.00', '0.00', '0', 0, 0, '2019-06-25 20:23:21'),
(2, '9.00', '9.00', '18.00', '18', 1, 0, '2019-12-02 05:31:59'),
(3, '6.00', '6.00', '12.00', '12', 1, 0, '2019-12-02 05:31:40'),
(4, '14.00', '14.00', '28.00', '28', 1, 0, '2019-12-02 05:31:49'),
(5, '2.50', '2.50', '5.00', '5', 0, 0, '2019-12-02 05:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(100) UNSIGNED NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `uqc` int(11) NOT NULL,
  `unit_main_id` int(11) NOT NULL DEFAULT '0',
  `unit_id` int(100) DEFAULT NULL,
  `code` varchar(3) CHARACTER SET utf8 NOT NULL,
  `unit_count` decimal(10,2) DEFAULT '1.00',
  `base_unit_count` decimal(10,2) NOT NULL DEFAULT '1.00',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(1500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `uqc`, `unit_main_id`, `unit_id`, `code`, `unit_count`, `base_unit_count`, `published`, `updatedate`, `name_lan`) VALUES
(1, 'No', 0, 0, NULL, 'No', '1.00', '1.00', 'yes', '2019-09-08 09:17:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university_type`
--

CREATE TABLE `university_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` varchar(20) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name_lan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_type`
--

INSERT INTO `university_type` (`id`, `name`, `code`, `published`, `updateddate`, `name_lan`) VALUES
(8, 'NORTH EAST FRONTIER TECHNICAL UNIVERSITY', 'NEFTU', 'yes', '2019-10-29 05:54:50', ''),
(9, 'IEC UNIVERSITY', 'IEC', 'yes', '2019-10-29 05:51:58', ''),
(10, 'MAHATHMA GANDHI KASHI VIDYAPITH', 'MGKVP', 'yes', '2019-10-29 05:52:10', ''),
(11, 'SHUBARTHY UNIVERSITY-FIRST YEAR', 'SVU1', 'yes', '2019-10-29 05:54:29', ''),
(12, 'SHUBARTHY UNIVERSITY-SECOND YEAR', 'SVU2', 'yes', '2019-10-29 05:53:09', ''),
(13, 'SHUBARTHY UNIVERSITY-THIRD YEAR', 'SVU3', 'yes', '2019-10-29 05:55:08', ''),
(14, 'VISWA BHARATHIYA VIDYA PARISHAD', 'VBVP', 'yes', '2019-11-21 06:47:20', '');

-- --------------------------------------------------------

--
-- Table structure for table `upccache`
--

CREATE TABLE `upccache` (
  `upc` bigint(13) UNSIGNED NOT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `sizeweight` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uqc`
--

CREATE TABLE `uqc` (
  `uqc_id` int(11) NOT NULL,
  `uqc_name` varchar(500) NOT NULL,
  `uqc_details` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uqc`
--

INSERT INTO `uqc` (`uqc_id`, `uqc_name`, `uqc_details`, `published`) VALUES
(2, 'BAG', 'BAGS', 'yes'),
(3, 'BAL', 'BALE', 'yes'),
(4, 'BDL', 'BUNDLES', 'yes'),
(5, 'BKL', 'BUCKLES', 'yes'),
(6, 'BOU', 'BILLIONS OF UNITS', 'yes'),
(7, 'BOX', 'BOX', 'yes'),
(8, 'BTL', 'BOTTLES', 'yes'),
(9, 'BUN', 'BUNCHES', 'yes'),
(10, 'CAN', 'CANS', 'yes'),
(11, 'CBM', 'CUBIC METER', 'yes'),
(12, 'CCM', 'CUBIC CENTIMETER', 'yes'),
(13, 'CMS', 'CENTIMETER', 'yes'),
(14, 'CTN', 'CARTONS', 'yes'),
(15, 'DOZ', 'DOZEN', 'yes'),
(16, 'DRM', 'DRUM', 'yes'),
(17, 'GGR', 'GREAT GROSS', 'yes'),
(18, 'GMS', 'GRAMS', 'yes'),
(19, 'GRS', 'GROSS', 'yes'),
(20, 'GYD', 'GROSS YARDS', 'yes'),
(21, 'KGS', 'KILOGRAMS', 'yes'),
(22, 'KLR', 'KILOLITRE', 'yes'),
(23, 'KME', 'KILOMETRE', 'yes'),
(24, 'MLT', 'MILLILITRE', 'yes'),
(25, 'MTR', 'METERS', 'yes'),
(26, 'MTS', 'METRIC TON', 'yes'),
(27, 'NOS', 'NUMBERS', 'yes'),
(28, 'PAC', 'PACKS', 'yes'),
(29, 'PCS', 'PIECES', 'yes'),
(30, 'PRS', 'PAIRS', 'yes'),
(31, 'QTL', 'QUINTAL', 'yes'),
(32, 'ROL', 'ROLLS', 'yes'),
(33, 'SET', 'SETS', 'yes'),
(34, 'SQF', 'SQUARE FEET', 'yes'),
(35, 'SQM', 'SQUARE METERS', 'yes'),
(36, 'SQY', 'SQUARE YARDS', 'yes'),
(37, 'TBS', 'TABLETS', 'yes'),
(38, 'TGM', 'TEN GRAMS', 'yes'),
(39, 'THD', 'THOUSANDS', 'yes'),
(40, 'TON', 'TONNES', 'yes'),
(41, 'TUB', 'TUBES', 'yes'),
(42, 'UGS', 'US GALLONS', 'yes'),
(43, 'UNT', 'UNITS', 'yes'),
(44, 'YDS', 'YARDS', 'yes'),
(45, 'OTH', 'OTHERS', 'yes');

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
  `percentage` decimal(10,2) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `company` int(11) NOT NULL,
  `is-active` tinyint(1) NOT NULL,
  `is_hide` int(11) NOT NULL,
  `branch` int(11) NOT NULL DEFAULT '1',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `user_type`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `percentage`, `user_password`, `company`, `is-active`, `is_hide`, `branch`, `updatedate`) VALUES
(1, 'admin', 1, 'address', '22939909', '546464455', 'admin@mail.com', 'admin', '10.00', '§<ÓpŽ®7„’žÎºÚÝ', 1, 1, 0, 1, '2019-05-15 10:18:00'),
(14, 'User', 2, 'Address', '9847861200', ' ', 'user@gmail.cm', 'user', '0.00', '§<ÓpŽ®7„’žÎºÚÝ', 1, 1, 0, 1, '2020-08-17 10:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_action_log`
--

CREATE TABLE `user_action_log` (
  `uac_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_action_log`
--

INSERT INTO `user_action_log` (`uac_id`, `user_id`, `menu_id`, `created_date`) VALUES
(1, 3, 240, '2019-04-19 16:03:47'),
(2, 3, 240, '2019-04-19 16:05:19'),
(3, 3, 240, '2019-04-19 16:05:24'),
(4, 3, 87, '2019-04-19 16:30:00'),
(5, 3, 87, '2019-04-19 16:30:38'),
(6, 3, 87, '2019-04-19 16:30:48'),
(7, 3, 87, '2019-04-19 16:31:33'),
(8, 3, 87, '2019-04-19 16:31:37'),
(9, 3, 95, '2019-04-19 16:31:40'),
(10, 3, 87, '2019-04-19 16:31:48'),
(11, 3, 87, '2019-04-19 16:32:00'),
(12, 3, 19, '2019-04-19 16:32:07'),
(13, 3, 20, '2019-04-19 16:32:08'),
(14, 3, 87, '2019-04-19 16:32:10'),
(15, 3, 87, '2019-04-19 16:32:24'),
(16, 3, 204, '2019-04-19 16:32:31'),
(17, 3, 108, '2019-04-30 05:08:26'),
(18, 3, 222, '2019-04-30 05:08:30'),
(19, 3, 60, '2019-04-30 05:08:39'),
(20, 3, 95, '2019-04-30 05:08:59'),
(21, 3, 87, '2019-04-30 05:09:17'),
(22, 3, 198, '2019-04-30 05:09:50'),
(23, 3, 45, '2019-04-30 05:09:51'),
(24, 3, 58, '2019-04-30 05:10:27'),
(25, 3, 48, '2019-04-30 05:18:09'),
(26, 3, 52, '2019-04-30 05:18:41'),
(27, 3, 33, '2019-04-30 05:19:00'),
(28, 3, 48, '2019-04-30 05:19:25'),
(29, 3, 33, '2019-04-30 05:19:31'),
(30, 3, 231, '2019-04-30 05:20:17'),
(31, 3, 231, '2019-04-30 05:20:20'),
(32, 3, 108, '2019-04-30 05:20:57'),
(33, 3, 22, '2019-04-30 11:19:37'),
(34, 3, 19, '2019-04-30 11:19:41'),
(35, 3, 22, '2019-04-30 11:19:54'),
(36, 3, 231, '2019-04-30 11:20:01'),
(37, 3, 231, '2019-04-30 11:20:32'),
(38, 3, 231, '2019-05-01 03:55:15'),
(39, 3, 33, '2019-05-01 08:51:16'),
(40, 3, 33, '2019-05-01 08:51:33'),
(41, 3, 33, '2019-05-01 08:51:38'),
(42, 3, 33, '2019-05-01 08:51:42'),
(43, 3, 33, '2019-05-02 09:30:08'),
(44, 3, 95, '2019-05-02 14:32:22'),
(45, 3, 95, '2019-05-02 14:32:57'),
(46, 3, 48, '2019-05-02 14:33:01'),
(47, 3, 58, '2019-05-02 14:33:19'),
(48, 3, 48, '2019-05-02 14:33:25'),
(49, 3, 48, '2019-05-02 14:33:54'),
(50, 3, 48, '2019-05-03 11:15:38'),
(51, 3, 48, '2019-05-03 11:15:44'),
(52, 3, 48, '2019-05-03 11:25:31'),
(53, 3, 231, '2019-05-03 12:43:16'),
(54, 3, 48, '2019-05-03 12:45:37'),
(55, 3, 48, '2019-05-03 12:49:56'),
(56, 3, 108, '2019-05-03 12:55:36'),
(57, 3, 48, '2019-05-03 12:56:13'),
(58, 3, 22, '2019-05-03 12:58:36'),
(59, 3, 108, '2019-05-03 12:58:58'),
(60, 3, 108, '2019-05-03 12:59:06'),
(61, 3, 48, '2019-05-03 12:59:13'),
(62, 3, 108, '2019-05-03 13:04:10'),
(63, 3, 48, '2019-05-03 13:04:32'),
(64, 3, 108, '2019-05-03 13:05:09'),
(65, 3, 108, '2019-05-03 13:05:18'),
(66, 3, 48, '2019-05-03 13:05:20'),
(67, 3, 48, '2019-05-03 13:05:26'),
(68, 3, 48, '2019-05-03 13:23:33'),
(69, 3, 95, '2019-05-03 14:57:55'),
(70, 3, 95, '2019-05-03 14:58:08'),
(71, 3, 48, '2019-05-03 14:58:11'),
(72, 3, 87, '2019-05-03 14:59:24'),
(73, 3, 87, '2019-05-03 14:59:28'),
(74, 3, 48, '2019-05-03 14:59:36'),
(75, 3, 48, '2019-05-03 15:16:54'),
(76, 3, 48, '2019-05-04 04:43:55'),
(77, 3, 48, '2019-05-04 04:46:48'),
(78, 3, 48, '2019-05-04 05:19:10'),
(79, 3, 48, '2019-05-04 05:20:14'),
(80, 3, 48, '2019-05-04 05:21:11'),
(81, 3, 48, '2019-05-04 05:26:02'),
(82, 3, 48, '2019-05-04 05:29:07'),
(83, 3, 48, '2019-05-04 05:35:16'),
(84, 3, 48, '2019-05-04 05:57:10'),
(85, 3, 58, '2019-05-04 05:57:55'),
(86, 3, 48, '2019-05-04 05:58:39'),
(87, 3, 226, '2019-05-04 05:59:12'),
(88, 3, 48, '2019-05-04 06:04:02'),
(89, 3, 226, '2019-05-04 06:04:04'),
(90, 3, 48, '2019-05-04 06:04:07'),
(91, 3, 48, '2019-05-04 06:05:06'),
(92, 3, 48, '2019-05-04 06:30:59'),
(93, 3, 48, '2019-05-04 06:31:35'),
(94, 3, 95, '2019-05-04 06:37:51'),
(95, 3, 222, '2019-05-04 06:37:57'),
(96, 3, 108, '2019-05-04 06:38:09'),
(97, 3, 48, '2019-05-04 06:38:28'),
(98, 3, 92, '2019-05-04 06:38:45'),
(99, 3, 108, '2019-05-04 06:52:51'),
(100, 3, 48, '2019-05-04 06:58:43'),
(101, 3, 48, '2019-05-04 07:04:59'),
(102, 3, 48, '2019-05-04 07:43:59'),
(103, 3, 48, '2019-05-04 07:51:55'),
(104, 3, 48, '2019-05-04 07:52:57'),
(105, 3, 108, '2019-05-04 09:43:26'),
(106, 3, 108, '2019-05-04 09:46:13'),
(107, 3, 48, '2019-05-04 09:52:00'),
(108, 3, 108, '2019-05-04 10:36:26'),
(109, 3, 108, '2019-05-04 10:36:51'),
(110, 3, 48, '2019-05-04 10:37:39'),
(111, 3, 33, '2019-05-04 10:40:04'),
(112, 3, 33, '2019-05-04 10:40:21'),
(113, 3, 108, '2019-05-04 10:41:11'),
(114, 3, 108, '2019-05-04 10:41:21'),
(115, 3, 108, '2019-05-04 11:21:31'),
(116, 3, 226, '2019-05-04 11:21:44'),
(117, 3, 108, '2019-05-04 11:21:45'),
(118, 3, 48, '2019-05-04 11:21:58'),
(119, 3, 231, '2019-05-04 11:25:27'),
(120, 3, 48, '2019-05-04 11:25:35'),
(121, 3, 231, '2019-05-04 11:29:11'),
(122, 3, 230, '2019-05-04 11:29:21'),
(123, 3, 230, '2019-05-04 11:29:45'),
(124, 3, 216, '2019-05-04 12:23:23'),
(125, 3, 22, '2019-05-04 14:03:31'),
(126, 3, 22, '2019-05-04 14:03:33'),
(127, 3, 22, '2019-05-04 14:03:35'),
(128, 3, 22, '2019-05-04 14:08:33'),
(129, 3, 22, '2019-05-04 14:08:35'),
(130, 3, 22, '2019-05-04 14:08:37'),
(131, 3, 22, '2019-05-04 14:08:39'),
(132, 3, 210, '2019-05-04 14:08:43'),
(133, 3, 22, '2019-05-04 14:15:03'),
(134, 3, 22, '2019-05-04 14:15:05'),
(135, 3, 22, '2019-05-04 14:15:56'),
(136, 3, 48, '2019-05-04 14:16:02'),
(137, 3, 48, '2019-05-04 14:17:28'),
(138, 3, 48, '2019-05-04 15:26:54'),
(139, 3, 48, '2019-05-04 15:56:05'),
(140, 3, 48, '2019-05-05 08:12:31'),
(141, 3, 48, '2019-05-05 08:12:48'),
(142, 3, 48, '2019-05-05 08:15:46'),
(143, 3, 48, '2019-05-05 08:16:52'),
(144, 3, 48, '2019-05-05 09:03:35'),
(145, 3, 48, '2019-05-05 09:47:33'),
(146, 3, 226, '2019-05-05 10:22:24'),
(147, 3, 222, '2019-05-05 10:22:29'),
(148, 3, 48, '2019-05-05 14:41:53'),
(149, 3, 48, '2019-05-05 14:45:10'),
(150, 3, 48, '2019-05-05 14:45:20'),
(151, 3, 58, '2019-05-05 14:46:04'),
(152, 3, 52, '2019-05-05 14:46:08'),
(153, 3, 48, '2019-05-05 14:46:09'),
(154, 3, 48, '2019-05-05 14:46:33'),
(155, 3, 48, '2019-05-05 14:47:26'),
(156, 3, 48, '2019-05-05 14:47:44'),
(157, 3, 48, '2019-05-05 14:48:07'),
(158, 3, 48, '2019-05-05 15:16:25'),
(159, 3, 48, '2019-05-05 15:16:31'),
(160, 3, 48, '2019-05-05 15:16:44'),
(161, 3, 48, '2019-05-05 15:39:02'),
(162, 3, 48, '2019-05-05 15:39:14'),
(163, 3, 48, '2019-05-06 04:15:15'),
(164, 3, 52, '2019-05-06 04:16:16'),
(165, 3, 48, '2019-05-06 05:20:03'),
(166, 3, 48, '2019-05-06 07:03:06'),
(167, 3, 48, '2019-05-06 07:03:58'),
(168, 3, 48, '2019-05-06 09:54:51'),
(169, 3, 58, '2019-05-06 09:55:17'),
(170, 3, 48, '2019-05-06 09:55:36'),
(171, 3, 95, '2019-05-06 09:55:59'),
(172, 3, 95, '2019-05-06 09:56:19'),
(173, 3, 48, '2019-05-06 09:56:23'),
(174, 3, 58, '2019-05-06 09:59:31'),
(175, 3, 58, '2019-05-06 09:59:40'),
(176, 3, 48, '2019-05-06 09:59:49'),
(177, 3, 48, '2019-05-06 11:03:23'),
(178, 3, 48, '2019-05-06 11:42:44'),
(179, 3, 22, '2019-05-06 11:44:01'),
(180, 3, 22, '2019-05-06 11:44:03'),
(181, 3, 22, '2019-05-06 11:44:03'),
(182, 3, 22, '2019-05-06 11:44:04'),
(183, 3, 226, '2019-05-06 12:49:12'),
(184, 3, 48, '2019-05-06 14:05:27'),
(185, 3, 48, '2019-05-06 14:09:09'),
(186, 3, 48, '2019-05-06 14:14:08'),
(187, 3, 48, '2019-05-06 14:37:08'),
(188, 3, 48, '2019-05-06 14:49:48'),
(189, 3, 48, '2019-05-06 14:50:54'),
(190, 3, 48, '2019-05-06 14:56:55'),
(191, 3, 48, '2019-05-07 04:29:56'),
(192, 3, 48, '2019-05-07 04:32:09'),
(193, 3, 48, '2019-05-07 04:32:45'),
(194, 3, 48, '2019-05-07 04:33:27'),
(195, 3, 87, '2019-05-07 04:34:33'),
(196, 3, 48, '2019-05-07 04:34:51'),
(197, 3, 48, '2019-05-07 04:36:33'),
(198, 3, 48, '2019-05-07 04:55:21'),
(199, 3, 48, '2019-05-07 04:55:48'),
(200, 3, 230, '2019-05-07 04:56:51'),
(201, 3, 48, '2019-05-07 04:56:58'),
(202, 3, 230, '2019-05-07 04:57:12'),
(203, 3, 230, '2019-05-07 04:57:35'),
(204, 3, 230, '2019-05-07 04:57:44'),
(205, 3, 230, '2019-05-07 04:57:46'),
(206, 3, 230, '2019-05-07 04:57:49'),
(207, 3, 48, '2019-05-07 04:57:52'),
(208, 3, 230, '2019-05-07 04:58:01'),
(209, 3, 230, '2019-05-07 04:58:04'),
(210, 3, 230, '2019-05-07 04:58:25'),
(211, 3, 230, '2019-05-07 04:58:27'),
(212, 3, 230, '2019-05-07 04:59:08'),
(213, 3, 230, '2019-05-07 04:59:11'),
(214, 3, 230, '2019-05-07 05:00:25'),
(215, 3, 230, '2019-05-07 05:00:27'),
(216, 3, 231, '2019-05-07 05:00:50'),
(217, 3, 48, '2019-05-07 05:01:01'),
(218, 3, 48, '2019-05-07 05:01:57'),
(219, 3, 52, '2019-05-07 05:15:03'),
(220, 3, 52, '2019-05-07 05:15:57'),
(221, 3, 48, '2019-05-07 05:17:23'),
(222, 3, 52, '2019-05-07 05:17:30'),
(223, 3, 48, '2019-05-07 05:56:36'),
(224, 3, 48, '2019-05-07 05:57:24'),
(225, 3, 48, '2019-05-07 05:58:04'),
(226, 3, 48, '2019-05-07 05:58:45'),
(227, 3, 48, '2019-05-07 06:09:09'),
(228, 3, 48, '2019-05-07 07:01:33'),
(229, 3, 108, '2019-05-07 08:43:22'),
(230, 3, 231, '2019-05-07 09:01:08'),
(231, 3, 48, '2019-05-07 09:06:42'),
(232, 3, 58, '2019-05-07 09:06:59'),
(233, 3, 58, '2019-05-07 09:08:52'),
(234, 3, 48, '2019-05-07 09:08:55'),
(235, 3, 58, '2019-05-07 09:15:32'),
(236, 3, 48, '2019-05-07 09:53:18'),
(237, 3, 48, '2019-05-07 10:11:07'),
(238, 3, 48, '2019-05-07 10:16:01'),
(239, 3, 48, '2019-05-07 10:16:09'),
(240, 3, 48, '2019-05-07 10:19:13'),
(241, 3, 48, '2019-05-07 10:27:33'),
(242, 3, 48, '2019-05-07 10:27:47'),
(243, 3, 48, '2019-05-07 10:28:58'),
(244, 3, 48, '2019-05-07 10:29:23'),
(245, 3, 48, '2019-05-07 10:30:45'),
(246, 3, 48, '2019-05-07 10:31:02'),
(247, 3, 48, '2019-05-07 10:32:39'),
(248, 3, 48, '2019-05-07 10:32:44'),
(249, 3, 48, '2019-05-07 10:32:50'),
(250, 3, 48, '2019-05-07 10:36:48'),
(251, 3, 48, '2019-05-07 12:09:43'),
(252, 3, 48, '2019-05-07 12:15:30'),
(253, 3, 48, '2019-05-07 12:17:01'),
(254, 3, 48, '2019-05-07 12:25:07'),
(255, 3, 48, '2019-05-07 12:30:15'),
(256, 3, 95, '2019-05-07 12:39:20'),
(257, 3, 48, '2019-05-07 12:40:17'),
(258, 3, 48, '2019-05-07 13:51:39'),
(259, 3, 48, '2019-05-07 13:51:53'),
(260, 3, 58, '2019-05-07 13:53:14'),
(261, 3, 58, '2019-05-07 13:53:43'),
(262, 3, 58, '2019-05-07 13:54:05'),
(263, 3, 48, '2019-05-07 13:54:18'),
(264, 3, 58, '2019-05-07 13:54:57'),
(265, 3, 58, '2019-05-07 13:55:42'),
(266, 3, 48, '2019-05-07 13:55:55'),
(267, 3, 48, '2019-05-07 14:52:45'),
(268, 3, 48, '2019-05-07 15:31:29'),
(269, 3, 48, '2019-05-07 15:31:49'),
(270, 3, 48, '2019-05-07 15:35:12'),
(271, 3, 48, '2019-05-07 15:53:03'),
(272, 3, 48, '2019-05-07 15:53:32'),
(273, 3, 48, '2019-05-07 15:54:09'),
(274, 3, 230, '2019-05-07 15:54:17'),
(275, 3, 230, '2019-05-07 16:06:05'),
(276, 3, 48, '2019-05-07 16:06:58'),
(277, 3, 48, '2019-05-07 16:07:14'),
(278, 3, 51, '2019-05-08 05:29:09'),
(279, 3, 48, '2019-05-08 05:35:15'),
(280, 3, 48, '2019-05-08 08:02:20'),
(281, 3, 48, '2019-05-08 08:02:46'),
(282, 3, 48, '2019-05-08 08:03:31'),
(283, 3, 48, '2019-05-08 08:03:49'),
(284, 3, 48, '2019-05-08 08:04:25'),
(285, 3, 48, '2019-05-08 08:05:46'),
(286, 3, 48, '2019-05-08 08:06:49'),
(287, 3, 48, '2019-05-08 08:07:41'),
(288, 3, 48, '2019-05-08 08:08:21'),
(289, 3, 48, '2019-05-08 08:09:02'),
(290, 3, 48, '2019-05-08 08:09:51'),
(291, 3, 48, '2019-05-08 08:10:40'),
(292, 3, 48, '2019-05-08 08:10:45'),
(293, 3, 48, '2019-05-08 08:11:24'),
(294, 3, 48, '2019-05-08 08:13:32'),
(295, 3, 48, '2019-05-08 08:14:08'),
(296, 3, 48, '2019-05-08 08:15:08'),
(297, 3, 48, '2019-05-08 08:15:42'),
(298, 3, 48, '2019-05-08 08:18:25'),
(299, 3, 48, '2019-05-08 08:27:22'),
(300, 3, 48, '2019-05-08 11:07:48'),
(301, 3, 48, '2019-05-08 11:08:16'),
(302, 3, 48, '2019-05-08 11:39:47'),
(303, 3, 48, '2019-05-08 12:01:06'),
(304, 3, 48, '2019-05-08 12:06:16'),
(305, 3, 48, '2019-05-08 12:07:56'),
(306, 3, 48, '2019-05-08 12:22:18'),
(307, 3, 48, '2019-05-08 12:29:28'),
(308, 3, 48, '2019-05-08 12:29:45'),
(309, 3, 48, '2019-05-08 12:33:49'),
(310, 3, 198, '2019-05-08 14:08:55'),
(311, 3, 48, '2019-05-09 05:33:06'),
(312, 3, 48, '2019-05-09 09:46:42'),
(313, 3, 48, '2019-05-09 09:47:09'),
(314, 3, 48, '2019-05-09 09:48:18'),
(315, 3, 48, '2019-05-09 09:49:12'),
(316, 3, 48, '2019-05-09 09:58:54'),
(317, 3, 48, '2019-05-09 09:59:33'),
(318, 3, 48, '2019-05-09 10:01:15'),
(319, 3, 48, '2019-05-09 10:09:05'),
(320, 3, 48, '2019-05-09 10:09:29'),
(321, 3, 48, '2019-05-09 10:10:16'),
(322, 3, 48, '2019-05-09 10:11:09'),
(323, 3, 48, '2019-05-09 10:16:43'),
(324, 3, 48, '2019-05-09 10:18:14'),
(325, 3, 48, '2019-05-09 10:34:38'),
(326, 3, 48, '2019-05-09 10:35:05'),
(327, 3, 48, '2019-05-09 10:35:24'),
(328, 3, 48, '2019-05-09 10:35:32'),
(329, 3, 48, '2019-05-09 10:36:07'),
(330, 3, 48, '2019-05-09 10:43:35'),
(331, 3, 48, '2019-05-09 12:26:11'),
(332, 3, 48, '2019-05-09 14:08:28'),
(333, 3, 48, '2019-05-09 16:57:52'),
(334, 3, 48, '2019-05-09 17:38:56'),
(335, 3, 48, '2019-05-10 05:10:30'),
(336, 3, 48, '2019-05-10 06:37:02'),
(337, 3, 48, '2019-05-10 07:30:55'),
(338, 3, 48, '2019-05-10 10:55:45'),
(339, 3, 48, '2019-05-11 11:13:58'),
(340, 3, 52, '2019-05-11 12:22:14'),
(341, 3, 48, '2019-05-11 12:22:14'),
(342, 3, 48, '2019-05-11 12:22:42'),
(343, 3, 52, '2019-05-11 12:38:15'),
(344, 3, 48, '2019-05-11 12:38:15'),
(345, 3, 51, '2019-05-11 12:53:13'),
(346, 3, 51, '2019-05-11 12:53:18'),
(347, 3, 108, '2019-05-11 13:46:25'),
(348, 3, 92, '2019-05-11 13:46:29'),
(349, 3, 129, '2019-05-11 13:46:30'),
(350, 3, 58, '2019-05-11 15:52:49'),
(351, 3, 58, '2019-05-11 15:53:27'),
(352, 3, 58, '2019-05-11 15:56:24'),
(353, 3, 58, '2019-05-11 17:50:00'),
(354, 3, 48, '2019-05-12 06:01:29'),
(355, 3, 58, '2019-05-12 07:22:07'),
(356, 3, 58, '2019-05-12 07:22:11'),
(357, 3, 58, '2019-05-12 07:22:22'),
(358, 3, 58, '2019-05-12 07:22:31'),
(359, 3, 58, '2019-05-12 07:22:32'),
(360, 3, 48, '2019-05-12 07:23:37'),
(361, 3, 48, '2019-05-12 07:24:18'),
(362, 3, 48, '2019-05-12 07:24:31'),
(363, 3, 48, '2019-05-12 07:24:39'),
(364, 3, 11, '2019-05-12 07:25:13'),
(365, 3, 48, '2019-05-12 07:25:28'),
(366, 3, 48, '2019-05-12 07:26:03'),
(367, 3, 58, '2019-05-12 07:26:20'),
(368, 3, 58, '2019-05-12 07:26:23'),
(369, 3, 58, '2019-05-12 07:27:39'),
(370, 3, 48, '2019-05-12 07:28:56'),
(371, 3, 48, '2019-05-12 07:29:46'),
(372, 3, 48, '2019-05-12 07:30:28'),
(373, 3, 48, '2019-05-12 10:39:28'),
(374, 3, 48, '2019-05-12 11:31:43'),
(375, 3, 52, '2019-05-12 13:55:25'),
(376, 3, 48, '2019-05-12 13:55:25'),
(377, 3, 48, '2019-05-12 14:04:13'),
(378, 3, 48, '2019-05-12 14:06:33'),
(379, 3, 48, '2019-05-12 14:09:06'),
(380, 3, 48, '2019-05-12 15:16:47'),
(381, 3, 48, '2019-05-13 05:37:32'),
(382, 3, 48, '2019-05-13 06:46:46'),
(383, 3, 48, '2019-05-13 07:07:03'),
(384, 3, 48, '2019-05-13 07:10:17'),
(385, 3, 48, '2019-05-13 07:20:16'),
(386, 3, 48, '2019-05-13 10:36:24'),
(387, 3, 48, '2019-05-13 12:06:39'),
(388, 3, 48, '2019-05-13 12:09:44'),
(389, 3, 48, '2019-05-13 12:11:27'),
(390, 3, 48, '2019-05-13 12:15:21'),
(391, 3, 48, '2019-05-13 12:16:06'),
(392, 3, 48, '2019-05-13 12:16:23'),
(393, 3, 48, '2019-05-13 12:22:16'),
(394, 3, 48, '2019-05-13 12:34:05'),
(395, 3, 48, '2019-05-13 12:35:05'),
(396, 3, 11, '2019-05-13 12:40:33'),
(397, 3, 198, '2019-05-13 12:40:35'),
(398, 3, 45, '2019-05-13 12:40:36'),
(399, 3, 48, '2019-05-13 12:46:07'),
(400, 3, 48, '2019-05-13 12:50:26'),
(401, 3, 48, '2019-05-13 12:50:53'),
(402, 3, 48, '2019-05-13 12:52:08'),
(403, 3, 92, '2019-05-13 12:59:23'),
(404, 3, 92, '2019-05-13 12:59:50'),
(405, 3, 92, '2019-05-13 13:00:02'),
(406, 3, 92, '2019-05-13 13:00:16'),
(407, 3, 48, '2019-05-14 08:34:59'),
(408, 3, 48, '2019-05-14 08:46:54'),
(409, 3, 108, '2019-05-14 08:51:27'),
(410, 3, 108, '2019-05-14 08:51:40'),
(411, 3, 222, '2019-05-14 08:51:53'),
(412, 3, 108, '2019-05-14 08:52:30'),
(413, 3, 222, '2019-05-14 09:13:33'),
(414, 3, 222, '2019-05-14 09:15:58'),
(415, 3, 48, '2019-05-14 09:23:34'),
(416, 3, 48, '2019-05-14 09:23:46'),
(417, 3, 48, '2019-05-14 09:25:53'),
(418, 3, 48, '2019-05-14 09:26:26'),
(419, 3, 21, '2019-05-14 09:26:47'),
(420, 3, 22, '2019-05-14 09:26:48'),
(421, 3, 19, '2019-05-14 09:26:49'),
(422, 3, 20, '2019-05-14 09:26:50'),
(423, 3, 11, '2019-05-14 09:26:52'),
(424, 3, 108, '2019-05-14 09:27:16'),
(425, 3, 33, '2019-05-14 09:27:51'),
(426, 3, 33, '2019-05-14 09:28:17'),
(427, 3, 33, '2019-05-14 09:28:40'),
(428, 3, 48, '2019-05-14 12:33:55'),
(429, 3, 48, '2019-05-14 12:34:28'),
(430, 3, 33, '2019-05-14 12:35:05'),
(431, 3, 48, '2019-05-14 12:57:30'),
(432, 3, 48, '2019-05-14 12:57:36'),
(433, 3, 48, '2019-05-14 12:59:15'),
(434, 3, 48, '2019-05-14 13:04:00'),
(435, 3, 48, '2019-05-14 13:04:13'),
(436, 3, 92, '2019-05-15 06:05:36'),
(437, 3, 92, '2019-05-15 06:05:47'),
(438, 3, 92, '2019-05-15 06:05:53'),
(439, 3, 92, '2019-05-15 06:05:58'),
(440, 3, 48, '2019-05-15 06:06:03'),
(441, 3, 48, '2019-05-15 06:10:15'),
(442, 3, 48, '2019-05-15 06:10:43'),
(443, 3, 48, '2019-05-15 06:12:28'),
(444, 3, 33, '2019-05-15 07:04:50'),
(445, 3, 105, '2019-05-15 07:05:12'),
(446, 3, 230, '2019-05-15 07:05:39'),
(447, 3, 230, '2019-05-15 07:06:11'),
(448, 3, 230, '2019-05-15 07:06:16'),
(449, 3, 230, '2019-05-15 07:06:24'),
(450, 3, 230, '2019-05-15 07:06:26'),
(451, 3, 108, '2019-05-15 07:08:20'),
(452, 3, 108, '2019-05-15 07:08:37'),
(453, 3, 222, '2019-05-15 07:09:15'),
(454, 3, 48, '2019-05-15 07:41:55'),
(455, 3, 33, '2019-05-15 08:02:16'),
(456, 3, 48, '2019-05-15 08:15:10'),
(457, 3, 52, '2019-05-15 08:58:12'),
(458, 3, 48, '2019-05-15 09:01:50'),
(459, 3, 52, '2019-05-15 09:02:07'),
(460, 3, 48, '2019-05-15 09:03:02'),
(461, 3, 33, '2019-05-15 09:24:04'),
(462, 3, 48, '2019-05-15 09:27:48'),
(463, 3, 33, '2019-05-15 09:27:49'),
(464, 3, 105, '2019-05-15 09:27:51'),
(465, 3, 33, '2019-05-15 09:28:25'),
(466, 3, 105, '2019-05-15 09:29:15'),
(467, 3, 33, '2019-05-15 09:29:17'),
(468, 3, 105, '2019-05-15 09:29:49'),
(469, 3, 33, '2019-05-15 09:43:12'),
(470, 3, 48, '2019-05-15 09:43:27'),
(471, 3, 48, '2019-05-15 09:43:35'),
(472, 3, 222, '2019-05-15 10:12:03'),
(473, 3, 222, '2019-05-15 10:12:26'),
(474, 3, 48, '2019-05-15 10:12:32'),
(475, 3, 48, '2019-05-15 10:18:25'),
(476, 3, 108, '2019-05-15 10:19:18'),
(477, 3, 108, '2019-05-15 10:19:29'),
(478, 3, 48, '2019-05-15 10:19:32'),
(479, 3, 48, '2019-05-15 10:19:47'),
(480, 3, 48, '2019-05-15 11:24:24'),
(481, 3, 108, '2019-05-15 11:47:20'),
(482, 3, 108, '2019-05-15 11:47:31'),
(483, 3, 108, '2019-05-15 11:47:32'),
(484, 3, 222, '2019-05-15 11:47:46'),
(485, 3, 222, '2019-05-15 11:47:55'),
(486, 3, 105, '2019-05-15 11:48:07'),
(487, 3, 33, '2019-05-15 11:48:08'),
(488, 3, 33, '2019-05-15 11:50:18'),
(489, 3, 48, '2019-05-15 12:05:57'),
(490, 3, 48, '2019-05-15 12:07:01'),
(491, 3, 48, '2019-05-15 12:55:08'),
(492, 3, 230, '2019-05-15 13:15:45'),
(493, 3, 230, '2019-05-15 13:16:00'),
(494, 3, 230, '2019-05-15 13:18:55'),
(495, 3, 230, '2019-05-15 13:19:19'),
(496, 3, 230, '2019-05-15 13:19:21'),
(497, 3, 230, '2019-05-15 13:19:44'),
(498, 3, 230, '2019-05-15 13:19:52'),
(499, 3, 230, '2019-05-15 13:19:54'),
(500, 3, 230, '2019-05-15 13:22:48'),
(501, 3, 230, '2019-05-15 13:27:51'),
(502, 3, 230, '2019-05-15 13:28:23'),
(503, 3, 230, '2019-05-15 13:31:37'),
(504, 3, 230, '2019-05-15 13:31:38'),
(505, 3, 230, '2019-05-15 13:31:44'),
(506, 3, 230, '2019-05-15 13:31:45'),
(507, 3, 230, '2019-05-15 13:36:56'),
(508, 3, 230, '2019-05-15 13:37:04'),
(509, 3, 230, '2019-05-15 13:37:06'),
(510, 3, 230, '2019-05-15 13:40:35'),
(511, 3, 48, '2019-05-16 05:26:33'),
(512, 3, 213, '2019-05-16 05:48:01'),
(513, 3, 245, '2019-05-16 05:50:35'),
(514, 3, 245, '2019-05-16 05:50:52'),
(515, 3, 58, '2019-05-16 05:50:57'),
(516, 3, 58, '2019-05-16 05:50:59'),
(517, 3, 245, '2019-05-16 05:51:06'),
(518, 3, 245, '2019-05-16 05:51:11'),
(519, 3, 245, '2019-05-16 11:12:07'),
(520, 3, 245, '2019-05-16 11:14:47'),
(521, 3, 245, '2019-05-16 11:15:28'),
(522, 3, 245, '2019-05-16 11:15:29'),
(523, 3, 245, '2019-05-16 11:15:32'),
(524, 3, 245, '2019-05-16 11:15:38'),
(525, 3, 245, '2019-05-16 11:15:45'),
(526, 3, 48, '2019-05-16 11:39:46'),
(527, 3, 48, '2019-05-16 12:24:48'),
(528, 3, 33, '2019-05-16 13:21:47'),
(529, 3, 58, '2019-05-16 13:22:12'),
(530, 3, 33, '2019-05-16 13:22:32'),
(531, 3, 48, '2019-05-16 13:24:03'),
(532, 3, 58, '2019-05-16 13:24:17'),
(533, 3, 33, '2019-05-16 13:24:36'),
(534, 3, 95, '2019-05-16 13:24:50'),
(535, 3, 95, '2019-05-16 13:25:00'),
(536, 3, 33, '2019-05-16 13:25:04'),
(537, 3, 48, '2019-05-16 13:27:11'),
(538, 3, 33, '2019-05-16 13:31:53'),
(539, 3, 33, '2019-05-16 13:46:06'),
(540, 3, 48, '2019-05-16 13:47:55'),
(541, 3, 33, '2019-05-16 13:50:59'),
(542, 3, 48, '2019-05-17 05:40:03'),
(543, 3, 58, '2019-05-17 07:15:09'),
(544, 3, 95, '2019-05-17 09:22:51'),
(545, 3, 48, '2019-05-17 11:16:38'),
(546, 3, 33, '2019-05-17 11:16:40'),
(547, 3, 33, '2019-05-17 11:38:26'),
(548, 3, 33, '2019-05-17 13:12:16'),
(549, 3, 48, '2019-05-17 14:16:28'),
(550, 3, 48, '2019-05-17 14:25:30'),
(551, 3, 48, '2019-05-18 04:36:05'),
(552, 3, 48, '2019-05-18 04:36:10'),
(553, 3, 48, '2019-05-18 08:32:45'),
(554, 3, 48, '2019-05-18 09:38:55'),
(555, 3, 48, '2019-05-18 10:57:33'),
(556, 3, 48, '2019-05-18 10:58:35'),
(557, 3, 48, '2019-05-18 11:01:39'),
(558, 3, 48, '2019-05-18 11:03:48'),
(559, 3, 48, '2019-05-18 11:04:38'),
(560, 3, 48, '2019-05-18 11:35:03'),
(561, 3, 48, '2019-05-18 11:35:06'),
(562, 3, 48, '2019-05-18 11:35:11'),
(563, 3, 48, '2019-05-18 12:03:50'),
(564, 3, 245, '2019-05-23 05:48:36'),
(565, 3, 245, '2019-05-23 11:00:16'),
(566, 3, 33, '2019-05-23 11:37:41'),
(567, 3, 33, '2019-05-23 11:45:33'),
(568, 3, 230, '2019-05-23 11:49:52'),
(569, 3, 33, '2019-05-23 11:50:07'),
(570, 3, 33, '2019-05-23 11:51:07'),
(571, 3, 33, '2019-05-23 12:00:00'),
(572, 3, 33, '2019-05-23 12:29:58'),
(573, 3, 33, '2019-05-23 12:33:55'),
(574, 3, 33, '2019-05-23 13:32:12'),
(575, 3, 33, '2019-05-23 13:32:15'),
(576, 3, 48, '2019-05-24 06:47:58'),
(577, 3, 33, '2019-05-24 10:36:02'),
(578, 3, 51, '2019-05-24 10:36:13'),
(579, 3, 204, '2019-05-24 10:36:22'),
(580, 3, 204, '2019-05-24 10:39:24'),
(581, 3, 95, '2019-05-24 10:39:55'),
(582, 3, 95, '2019-05-24 10:42:29'),
(583, 3, 48, '2019-05-24 10:42:59'),
(584, 3, 33, '2019-05-24 10:43:02'),
(585, 3, 95, '2019-05-24 10:45:47'),
(586, 3, 33, '2019-05-24 10:46:12'),
(587, 3, 33, '2019-05-24 13:14:08'),
(588, 3, 33, '2019-05-25 04:09:28'),
(589, 3, 33, '2019-05-25 05:52:24'),
(590, 3, 87, '2019-05-25 05:53:17'),
(591, 3, 33, '2019-05-25 05:53:40'),
(592, 3, 33, '2019-05-25 05:55:00'),
(593, 3, 33, '2019-05-25 05:55:51'),
(594, 3, 108, '2019-05-25 05:56:24'),
(595, 3, 33, '2019-05-25 05:56:43'),
(596, 3, 33, '2019-05-25 05:56:51'),
(597, 3, 33, '2019-05-25 05:57:05'),
(598, 3, 108, '2019-05-25 05:57:10'),
(599, 3, 108, '2019-05-25 05:57:15'),
(600, 3, 108, '2019-05-25 05:57:28'),
(601, 3, 33, '2019-05-25 05:57:41'),
(602, 3, 33, '2019-05-25 06:01:01'),
(603, 3, 33, '2019-05-25 06:02:15'),
(604, 3, 33, '2019-05-25 06:08:33'),
(605, 3, 33, '2019-05-25 06:14:22'),
(606, 3, 33, '2019-05-25 06:17:35'),
(607, 3, 33, '2019-05-25 07:18:10'),
(608, 3, 33, '2019-05-25 07:20:40'),
(609, 3, 95, '2019-05-25 07:22:36'),
(610, 3, 48, '2019-05-27 09:28:08'),
(611, 3, 48, '2019-05-27 10:33:44'),
(612, 3, 48, '2019-05-27 10:38:16'),
(613, 3, 33, '2019-05-27 10:41:41'),
(614, 3, 58, '2019-05-27 10:42:04'),
(615, 3, 33, '2019-05-27 10:42:11'),
(616, 3, 48, '2019-05-27 10:43:41'),
(617, 3, 48, '2019-05-27 10:44:46'),
(618, 3, 95, '2019-05-27 10:45:53'),
(619, 3, 95, '2019-05-27 10:46:04'),
(620, 3, 48, '2019-05-27 10:46:08'),
(621, 3, 87, '2019-05-27 10:47:58'),
(622, 3, 87, '2019-05-27 10:48:09'),
(623, 3, 48, '2019-05-27 10:48:15'),
(624, 3, 22, '2019-05-27 10:52:25'),
(625, 3, 21, '2019-05-27 10:52:34'),
(626, 3, 22, '2019-05-27 10:54:23'),
(627, 3, 21, '2019-05-27 10:54:47'),
(628, 3, 48, '2019-05-27 10:56:36'),
(629, 3, 48, '2019-05-27 10:57:20'),
(630, 3, 48, '2019-05-27 10:57:21'),
(631, 3, 48, '2019-05-27 11:09:54'),
(632, 3, 48, '2019-05-27 11:10:15'),
(633, 3, 48, '2019-05-27 11:10:57'),
(634, 3, 48, '2019-05-27 11:11:01'),
(635, 3, 48, '2019-05-27 11:16:17'),
(636, 3, 48, '2019-05-27 11:16:34'),
(637, 3, 48, '2019-05-27 11:17:04'),
(638, 3, 58, '2019-05-27 11:20:02'),
(639, 3, 108, '2019-05-27 11:25:11'),
(640, 3, 108, '2019-05-27 11:25:56'),
(641, 3, 48, '2019-05-27 11:28:28'),
(642, 3, 108, '2019-05-27 11:29:19'),
(643, 3, 108, '2019-05-27 11:30:58'),
(644, 3, 21, '2019-05-27 11:31:58'),
(645, 3, 58, '2019-05-27 11:34:42'),
(646, 3, 33, '2019-05-27 11:41:15'),
(647, 3, 58, '2019-05-27 11:44:04'),
(648, 3, 33, '2019-05-27 11:50:35'),
(649, 3, 33, '2019-05-27 11:53:26'),
(650, 3, 33, '2019-05-27 11:54:13'),
(651, 3, 33, '2019-05-27 11:56:29'),
(652, 3, 204, '2019-05-27 12:00:58'),
(653, 3, 204, '2019-05-27 12:01:10'),
(654, 3, 204, '2019-05-27 12:01:19'),
(655, 3, 190, '2019-05-27 12:01:24'),
(656, 3, 190, '2019-05-27 12:01:24'),
(657, 3, 33, '2019-05-27 12:01:24'),
(658, 3, 33, '2019-05-27 12:01:51'),
(659, 3, 58, '2019-05-27 12:08:34'),
(660, 3, 132, '2019-05-27 12:10:15'),
(661, 3, 33, '2019-05-27 12:10:17'),
(662, 3, 33, '2019-05-27 12:10:24'),
(663, 3, 58, '2019-05-27 12:10:28'),
(664, 3, 33, '2019-05-27 12:10:35'),
(665, 3, 33, '2019-05-27 12:11:30'),
(666, 3, 58, '2019-05-27 12:11:44'),
(667, 3, 58, '2019-05-27 12:11:50'),
(668, 3, 48, '2019-05-27 14:42:23'),
(669, 3, 33, '2019-05-27 15:15:53'),
(670, 3, 48, '2019-05-27 15:16:12'),
(671, 3, 33, '2019-05-27 15:16:25'),
(672, 3, 230, '2019-05-28 04:27:59'),
(673, 3, 231, '2019-05-28 04:28:03'),
(674, 3, 95, '2019-05-28 04:35:49'),
(675, 3, 22, '2019-05-28 04:40:39'),
(676, 3, 22, '2019-05-28 04:40:43'),
(677, 3, 22, '2019-05-28 04:40:43'),
(678, 3, 22, '2019-05-28 04:40:51'),
(679, 3, 21, '2019-05-28 04:40:53'),
(680, 3, 21, '2019-05-28 04:40:55'),
(681, 3, 21, '2019-05-28 04:40:56'),
(682, 3, 22, '2019-05-28 04:41:00'),
(683, 3, 22, '2019-05-28 04:41:01'),
(684, 3, 21, '2019-05-28 04:41:06'),
(685, 3, 21, '2019-05-28 04:41:06'),
(686, 3, 21, '2019-05-28 04:41:09'),
(687, 3, 21, '2019-05-28 04:41:12'),
(688, 3, 21, '2019-05-28 04:41:32'),
(689, 3, 21, '2019-05-28 04:41:32'),
(690, 3, 21, '2019-05-28 04:41:33'),
(691, 3, 48, '2019-05-28 06:43:10'),
(692, 3, 48, '2019-05-28 06:43:26'),
(693, 3, 48, '2019-05-28 06:43:35'),
(694, 3, 48, '2019-05-28 06:43:52'),
(695, 3, 48, '2019-05-28 06:44:22'),
(696, 3, 48, '2019-05-28 06:44:29'),
(697, 3, 48, '2019-05-28 11:29:30'),
(698, 3, 48, '2019-05-28 11:29:54'),
(699, 3, 58, '2019-05-28 12:22:45'),
(700, 3, 58, '2019-05-28 12:22:52'),
(701, 3, 58, '2019-05-28 12:22:52'),
(702, 3, 58, '2019-05-28 12:31:07'),
(703, 3, 58, '2019-05-28 12:31:11'),
(704, 3, 58, '2019-05-28 12:31:16'),
(705, 3, 48, '2019-05-28 12:54:11'),
(706, 3, 48, '2019-05-28 12:56:34'),
(707, 3, 204, '2019-05-28 13:15:23'),
(708, 3, 204, '2019-05-28 13:16:53'),
(709, 3, 204, '2019-05-28 13:17:19'),
(710, 3, 204, '2019-05-28 13:17:28'),
(711, 3, 204, '2019-05-28 13:19:55'),
(712, 3, 33, '2019-05-28 13:20:17'),
(713, 3, 48, '2019-05-28 14:12:27'),
(714, 3, 204, '2019-05-28 14:21:42'),
(715, 3, 58, '2019-05-28 14:29:16'),
(716, 3, 58, '2019-05-29 04:39:26'),
(717, 3, 58, '2019-05-29 04:39:30'),
(718, 1, 21, '2019-05-29 12:43:21'),
(719, 1, 22, '2019-05-29 12:43:27'),
(720, 1, 21, '2019-05-29 12:44:18'),
(721, 1, 22, '2019-05-29 12:44:18'),
(722, 1, 19, '2019-05-29 12:44:19'),
(723, 1, 20, '2019-05-29 12:44:20'),
(724, 1, 11, '2019-05-29 12:44:42'),
(725, 1, 87, '2019-05-29 12:45:58'),
(726, 1, 220, '2019-05-29 12:46:04'),
(727, 1, 220, '2019-05-29 12:46:06'),
(728, 1, 220, '2019-05-29 12:46:17'),
(729, 1, 87, '2019-05-29 12:46:19'),
(730, 1, 198, '2019-05-29 12:46:56'),
(731, 1, 45, '2019-05-29 12:46:57'),
(732, 1, 198, '2019-05-29 12:47:00'),
(733, 1, 220, '2019-05-29 12:47:01'),
(734, 1, 204, '2019-05-29 12:47:02'),
(735, 1, 204, '2019-05-29 12:47:08'),
(736, 1, 87, '2019-05-29 12:47:09'),
(737, 1, 198, '2019-05-29 12:47:10'),
(738, 1, 45, '2019-05-29 12:47:10'),
(739, 1, 210, '2019-05-29 12:47:25'),
(740, 1, 130, '2019-05-29 12:47:26'),
(741, 1, 216, '2019-05-29 12:47:46'),
(742, 1, 88, '2019-05-29 12:47:50'),
(743, 1, 132, '2019-05-29 12:48:25'),
(744, 1, 231, '2019-05-29 12:48:37'),
(745, 1, 108, '2019-05-29 12:49:01'),
(746, 1, 222, '2019-05-29 12:49:24'),
(747, 1, 51, '2019-05-29 12:49:31'),
(748, 1, 60, '2019-05-29 12:49:42'),
(749, 1, 194, '2019-05-29 12:49:43'),
(750, 1, 92, '2019-05-29 12:50:15'),
(751, 1, 95, '2019-05-29 12:50:29'),
(752, 1, 33, '2019-05-29 14:26:56'),
(753, 3, 216, '2019-05-30 05:05:54'),
(754, 3, 216, '2019-05-30 05:06:03'),
(755, 1, 108, '2019-05-30 05:06:30'),
(756, 1, 58, '2019-05-30 05:07:27'),
(757, 1, 245, '2019-05-30 05:07:57'),
(758, 1, 33, '2019-05-30 10:59:37'),
(759, 1, 33, '2019-05-30 10:59:41'),
(760, 1, 33, '2019-05-30 10:59:46'),
(761, 1, 48, '2019-05-30 11:54:23'),
(762, 1, 48, '2019-05-30 11:57:11'),
(763, 1, 48, '2019-05-30 11:57:39'),
(764, 1, 48, '2019-05-30 11:58:00'),
(765, 1, 48, '2019-05-30 11:58:17'),
(766, 1, 48, '2019-05-30 11:58:32'),
(767, 1, 48, '2019-05-30 11:58:42'),
(768, 1, 33, '2019-05-30 12:33:08'),
(769, 1, 95, '2019-05-30 12:33:21'),
(770, 1, 33, '2019-05-30 12:36:02'),
(771, 1, 48, '2019-05-30 12:37:41'),
(772, 1, 33, '2019-05-30 12:38:21'),
(773, 1, 33, '2019-05-30 12:44:19'),
(774, 1, 58, '2019-05-30 12:45:27'),
(775, 1, 95, '2019-05-30 12:46:05'),
(776, 1, 95, '2019-05-30 12:46:14'),
(777, 1, 48, '2019-05-30 12:46:18'),
(778, 1, 58, '2019-05-30 12:46:23'),
(779, 1, 58, '2019-05-30 12:47:42'),
(780, 1, 95, '2019-05-30 12:48:43'),
(781, 1, 95, '2019-05-30 12:49:14'),
(782, 1, 58, '2019-05-30 12:49:18'),
(783, 1, 95, '2019-05-30 12:50:49'),
(784, 1, 95, '2019-05-30 12:51:48'),
(785, 1, 58, '2019-05-30 12:52:44'),
(786, 1, 95, '2019-05-30 12:52:50'),
(787, 1, 95, '2019-05-30 12:53:11'),
(788, 1, 95, '2019-05-30 12:54:42'),
(789, 1, 58, '2019-05-30 12:54:48'),
(790, 1, 95, '2019-05-30 12:56:17'),
(791, 1, 95, '2019-05-30 12:56:25'),
(792, 1, 58, '2019-05-30 12:56:35'),
(793, 1, 58, '2019-05-30 13:34:40'),
(794, 1, 58, '2019-05-30 13:50:06'),
(795, 1, 58, '2019-05-30 13:59:59'),
(796, 1, 95, '2019-05-30 14:04:38'),
(797, 1, 51, '2019-05-30 14:05:15'),
(798, 1, 51, '2019-05-30 14:05:48'),
(799, 1, 108, '2019-05-30 14:08:41'),
(800, 1, 33, '2019-05-30 14:31:15'),
(801, 1, 58, '2019-05-30 14:31:28'),
(802, 1, 105, '2019-05-30 14:35:17'),
(803, 1, 33, '2019-05-30 14:35:18'),
(804, 1, 44, '2019-05-30 14:35:24'),
(805, 1, 48, '2019-05-30 14:35:26'),
(806, 1, 48, '2019-05-30 14:35:34'),
(807, 1, 58, '2019-05-30 14:35:40'),
(808, 1, 58, '2019-05-30 14:37:43'),
(809, 1, 58, '2019-05-30 14:41:56'),
(810, 1, 48, '2019-05-31 06:10:41'),
(811, 3, 48, '2019-05-31 09:58:37'),
(812, 1, 48, '2019-06-01 06:30:38'),
(813, 1, 52, '2019-06-01 11:10:10'),
(814, 1, 58, '2019-06-01 11:10:52'),
(815, 1, 48, '2019-06-01 11:14:33'),
(816, 1, 58, '2019-06-01 12:21:15'),
(817, 1, 58, '2019-06-01 12:22:09'),
(818, 1, 58, '2019-06-01 12:22:11'),
(819, 1, 48, '2019-06-01 12:22:13'),
(820, 1, 48, '2019-06-01 12:37:20'),
(821, 1, 58, '2019-06-01 13:38:50'),
(822, 1, 58, '2019-06-01 13:40:09'),
(823, 1, 48, '2019-06-01 13:40:14'),
(824, 1, 58, '2019-06-01 13:43:35'),
(825, 1, 48, '2019-06-01 13:43:39'),
(826, 1, 58, '2019-06-01 13:44:06'),
(827, 1, 58, '2019-06-01 13:44:12'),
(828, 1, 48, '2019-06-01 13:44:16'),
(829, 1, 58, '2019-06-01 13:44:36'),
(830, 1, 48, '2019-06-01 13:45:26'),
(831, 1, 58, '2019-06-01 13:46:24'),
(832, 1, 48, '2019-06-01 13:46:38'),
(833, 1, 58, '2019-06-01 13:46:54'),
(834, 1, 48, '2019-06-01 13:46:58'),
(835, 1, 48, '2019-06-01 13:48:07'),
(836, 1, 58, '2019-06-01 13:48:34'),
(837, 1, 48, '2019-06-01 13:48:49'),
(838, 1, 58, '2019-06-01 13:49:01'),
(839, 1, 58, '2019-06-01 13:49:14'),
(840, 1, 48, '2019-06-01 13:49:20'),
(841, 1, 58, '2019-06-01 13:49:41'),
(842, 1, 48, '2019-06-01 13:50:11'),
(843, 1, 58, '2019-06-01 13:53:14'),
(844, 1, 58, '2019-06-01 13:53:29'),
(845, 1, 58, '2019-06-01 13:53:30'),
(846, 1, 48, '2019-06-01 13:53:33'),
(847, 1, 58, '2019-06-01 14:01:36'),
(848, 1, 48, '2019-06-01 14:01:41'),
(849, 1, 58, '2019-06-01 14:02:00'),
(850, 1, 48, '2019-06-01 14:02:08'),
(851, 1, 58, '2019-06-01 14:02:22'),
(852, 1, 48, '2019-06-01 14:03:02'),
(853, 1, 58, '2019-06-01 14:03:16'),
(854, 1, 58, '2019-06-01 14:04:14'),
(855, 1, 48, '2019-06-01 14:04:16'),
(856, 1, 48, '2019-06-01 14:05:54'),
(857, 1, 48, '2019-06-01 14:07:04'),
(858, 1, 48, '2019-06-01 14:07:20'),
(859, 1, 58, '2019-06-01 14:29:33'),
(860, 1, 48, '2019-06-01 14:34:18'),
(861, 1, 48, '2019-06-02 08:52:41'),
(862, 1, 48, '2019-06-02 08:52:50'),
(863, 1, 51, '2019-06-02 09:10:33'),
(864, 1, 48, '2019-06-26 11:51:00'),
(865, 1, 87, '2019-06-26 11:53:19'),
(866, 1, 48, '2019-06-26 11:53:27'),
(867, 1, 190, '2019-09-07 15:50:27'),
(868, 1, 190, '2019-09-07 15:50:27'),
(869, 1, 231, '2019-09-07 15:50:31'),
(870, 3, 198, '2019-09-07 15:51:22'),
(871, 3, 198, '2019-09-07 15:51:38'),
(872, 3, 88, '2019-09-07 15:55:29'),
(873, 3, 48, '2019-09-08 13:31:35'),
(874, 3, 22, '2019-09-08 14:22:32'),
(875, 3, 19, '2019-09-08 14:22:36'),
(876, 3, 20, '2019-09-08 14:22:38'),
(877, 3, 11, '2019-09-08 14:22:43'),
(878, 3, 52, '2019-09-08 14:53:49'),
(879, 3, 52, '2019-09-08 14:53:52'),
(880, 1, 58, '2019-09-08 14:57:35'),
(881, 1, 58, '2019-09-08 14:57:48'),
(882, 1, 58, '2019-09-08 14:57:50'),
(883, 1, 58, '2019-09-08 14:57:52'),
(884, 1, 58, '2019-09-08 14:57:55'),
(885, 1, 58, '2019-09-08 14:57:56'),
(886, 1, 58, '2019-09-08 14:57:58'),
(887, 1, 58, '2019-09-08 14:58:00'),
(888, 1, 58, '2019-09-08 15:00:25'),
(889, 1, 58, '2019-09-08 15:01:49'),
(890, 1, 58, '2019-09-08 15:12:07'),
(891, 1, 246, '2019-09-09 05:23:04'),
(892, 1, 246, '2019-09-09 05:23:14'),
(893, 1, 231, '2019-09-10 04:59:14'),
(894, 1, 246, '2019-09-10 05:14:21'),
(895, 1, 246, '2019-09-10 05:14:27'),
(896, 1, 246, '2019-09-10 05:14:30'),
(897, 1, 216, '2019-09-10 05:14:31'),
(898, 1, 88, '2019-09-10 05:14:33'),
(899, 1, 48, '2019-09-10 05:16:32'),
(900, 1, 231, '2019-09-10 05:16:49'),
(901, 1, 216, '2019-09-10 05:18:17'),
(902, 1, 58, '2019-09-10 05:18:22'),
(903, 1, 213, '2019-09-10 05:18:24'),
(904, 1, 246, '2019-09-10 05:20:27'),
(905, 1, 88, '2019-09-10 05:20:28'),
(906, 1, 58, '2019-09-10 05:20:30'),
(907, 1, 58, '2019-09-10 05:20:41'),
(908, 1, 58, '2019-09-10 05:20:43'),
(909, 1, 58, '2019-09-10 05:20:46'),
(910, 1, 58, '2019-09-10 05:21:11'),
(911, 1, 58, '2019-09-10 05:21:14'),
(912, 1, 88, '2019-09-10 05:21:29'),
(913, 1, 58, '2019-09-10 05:21:33'),
(914, 1, 58, '2019-09-10 05:21:37'),
(915, 1, 58, '2019-09-10 05:21:38'),
(916, 1, 88, '2019-09-10 05:21:42'),
(917, 1, 131, '2019-09-10 05:21:43'),
(918, 1, 216, '2019-09-10 05:21:45'),
(919, 1, 246, '2019-09-10 05:21:49'),
(920, 1, 51, '2019-09-10 05:22:03'),
(921, 1, 51, '2019-09-10 05:24:34'),
(922, 1, 246, '2019-09-10 05:24:36'),
(923, 1, 216, '2019-09-10 05:24:37'),
(924, 1, 131, '2019-09-10 05:24:38'),
(925, 1, 88, '2019-09-10 05:24:39'),
(926, 1, 58, '2019-09-10 05:24:40'),
(927, 1, 213, '2019-09-10 05:24:43'),
(928, 1, 11, '2019-09-10 05:32:34'),
(929, 1, 11, '2019-09-10 05:33:41'),
(930, 1, 11, '2019-09-10 05:34:41'),
(931, 1, 11, '2019-09-10 05:41:07'),
(932, 1, 231, '2019-09-10 05:41:11'),
(933, 1, 230, '2019-09-10 05:41:45'),
(934, 1, 48, '2019-09-10 05:41:52'),
(935, 1, 48, '2019-09-10 05:42:21'),
(936, 1, 190, '2019-09-10 05:45:55'),
(937, 1, 190, '2019-09-10 05:45:55'),
(938, 1, 190, '2019-09-10 05:46:00'),
(939, 1, 190, '2019-09-10 05:46:01'),
(940, 1, 190, '2019-09-10 05:46:01'),
(941, 1, 190, '2019-09-10 05:46:01'),
(942, 1, 48, '2019-09-10 06:14:21'),
(943, 1, 48, '2019-09-10 06:14:58'),
(944, 1, 190, '2019-09-10 06:15:11'),
(945, 1, 190, '2019-09-10 06:15:11'),
(946, 1, 48, '2019-09-10 06:18:57'),
(947, 1, 48, '2019-09-10 06:19:49'),
(948, 1, 58, '2019-09-16 10:25:33'),
(949, 1, 58, '2019-09-16 10:25:33'),
(950, 1, 58, '2019-09-16 11:08:19'),
(951, 1, 58, '2019-09-16 11:08:45'),
(952, 1, 95, '2019-09-16 13:18:03'),
(953, 1, 95, '2019-09-16 13:18:14'),
(954, 1, 48, '2019-09-25 13:32:47'),
(955, 1, 95, '2019-09-25 13:33:04'),
(956, 1, 48, '2019-09-25 13:33:22'),
(957, 1, 48, '2019-09-25 13:33:22'),
(958, 1, 95, '2019-09-26 11:44:46'),
(959, 1, 58, '2019-09-26 14:25:54'),
(960, 3, 87, '2019-09-27 09:40:48'),
(961, 3, 87, '2019-09-27 09:40:53'),
(962, 3, 87, '2019-09-27 09:44:06'),
(963, 1, 260, '2019-09-27 10:03:08'),
(964, 1, 261, '2019-09-27 10:03:44'),
(965, 1, 262, '2019-09-27 10:03:55'),
(966, 1, 263, '2019-09-27 10:04:00'),
(967, 3, 87, '2019-09-27 11:44:16'),
(968, 1, 51, '2019-09-28 06:06:56'),
(969, 1, 51, '2019-09-28 06:07:16'),
(970, 1, 33, '2019-10-02 11:22:42'),
(971, 1, 48, '2019-10-02 12:25:24'),
(972, 1, 44, '2019-10-03 14:53:57'),
(973, 1, 246, '2019-10-03 14:56:44'),
(974, 1, 246, '2019-10-03 14:57:02'),
(975, 1, 92, '2019-10-03 15:10:44'),
(976, 1, 92, '2019-10-03 15:18:18'),
(977, 4, 48, '2019-10-03 15:23:37'),
(978, 4, 48, '2019-10-03 15:24:30'),
(979, 3, 48, '2019-10-04 12:11:33'),
(980, 3, 48, '2019-10-04 12:13:27'),
(981, 3, 48, '2019-10-04 12:13:37'),
(982, 3, 48, '2019-10-04 12:13:40'),
(983, 1, 246, '2019-10-11 12:44:06'),
(984, 1, 44, '2019-10-11 12:47:28'),
(985, 1, 230, '2019-10-14 04:52:34'),
(986, 1, 44, '2019-10-24 09:19:16'),
(987, 1, 52, '2019-10-24 09:20:10'),
(988, 1, 52, '2019-10-24 09:29:42'),
(989, 1, 258, '2019-10-24 09:30:07'),
(990, 1, 52, '2019-10-24 09:31:58'),
(991, 1, 258, '2019-10-24 09:32:03'),
(992, 1, 58, '2019-10-24 09:32:12'),
(993, 1, 58, '2019-10-24 09:32:17'),
(994, 1, 58, '2019-10-24 09:32:31'),
(995, 1, 230, '2019-10-27 08:58:00'),
(996, 1, 95, '2019-10-27 09:02:59'),
(997, 1, 95, '2019-10-27 09:03:28'),
(998, 1, 11, '2019-10-27 09:05:55'),
(999, 1, 220, '2019-10-27 09:07:09'),
(1000, 1, 220, '2019-10-27 09:07:32'),
(1001, 1, 210, '2019-10-27 09:14:02'),
(1002, 1, 258, '2019-10-27 09:14:58'),
(1003, 1, 267, '2019-10-27 09:16:03'),
(1004, 1, 267, '2019-10-27 09:17:54'),
(1005, 1, 267, '2019-10-27 09:19:24'),
(1006, 1, 58, '2019-10-27 09:27:10'),
(1007, 1, 95, '2019-10-27 09:31:10'),
(1008, 1, 95, '2019-10-27 09:31:27'),
(1009, 1, 58, '2019-10-27 09:35:13'),
(1010, 1, 95, '2019-10-27 09:35:22'),
(1011, 1, 58, '2019-10-27 09:35:31'),
(1012, 1, 95, '2019-10-27 09:38:43'),
(1013, 1, 58, '2019-10-27 09:39:00'),
(1014, 1, 213, '2019-10-27 09:53:07'),
(1015, 1, 213, '2019-10-27 09:56:48'),
(1016, 1, 58, '2019-10-27 09:57:34'),
(1017, 1, 132, '2019-10-27 10:01:24'),
(1018, 1, 226, '2019-10-27 10:04:11'),
(1019, 1, 240, '2019-10-27 10:14:47'),
(1020, 1, 60, '2019-10-27 10:15:22'),
(1021, 1, 92, '2019-10-27 10:17:16'),
(1022, 1, 222, '2019-10-27 10:17:36'),
(1023, 1, 231, '2019-10-27 11:08:27'),
(1024, 1, 231, '2019-10-27 11:08:34'),
(1025, 1, 231, '2019-10-27 11:09:02'),
(1026, 1, 22, '2019-10-27 11:48:00'),
(1027, 1, 22, '2019-10-27 11:48:02'),
(1028, 1, 22, '2019-10-27 11:48:05'),
(1029, 1, 51, '2019-10-27 11:48:58'),
(1030, 1, 108, '2019-10-27 11:49:13'),
(1031, 1, 44, '2019-10-27 11:49:25'),
(1032, 1, 108, '2019-10-27 11:49:40'),
(1033, 1, 108, '2019-10-27 11:49:52'),
(1034, 1, 48, '2019-10-27 11:50:20'),
(1035, 1, 48, '2019-10-27 11:50:39'),
(1036, 1, 48, '2019-10-27 11:51:02'),
(1037, 1, 95, '2019-10-27 12:38:56'),
(1038, 1, 22, '2019-11-01 08:22:46'),
(1039, 3, 44, '2019-11-07 09:32:23'),
(1040, 3, 44, '2019-11-07 09:32:23'),
(1041, 3, 44, '2019-11-07 09:32:23'),
(1042, 3, 44, '2019-11-07 09:32:28'),
(1043, 1, 48, '2019-11-10 07:11:02'),
(1044, 1, 95, '2019-11-10 07:12:11'),
(1045, 1, 92, '2019-11-10 13:30:04'),
(1046, 1, 92, '2019-11-10 13:41:08'),
(1047, 1, 58, '2019-11-10 13:41:55'),
(1048, 1, 58, '2019-11-10 13:45:27'),
(1049, 1, 58, '2019-11-10 13:45:39'),
(1050, 1, 58, '2019-11-10 13:52:39'),
(1051, 1, 95, '2019-11-10 14:30:15'),
(1052, 1, 58, '2019-11-12 12:28:05'),
(1053, 1, 301, '2019-11-18 06:39:37'),
(1054, 1, 58, '2019-11-20 06:23:05'),
(1055, 1, 95, '2019-11-20 06:25:13'),
(1056, 1, 58, '2019-11-20 06:28:55'),
(1057, 1, 58, '2019-11-20 06:29:03'),
(1058, 1, 58, '2019-11-20 06:30:24'),
(1059, 1, 58, '2019-11-20 06:40:06'),
(1060, 1, 58, '2019-11-20 06:43:54'),
(1061, 1, 301, '2019-11-20 12:55:58'),
(1062, 1, 301, '2019-11-20 12:55:58'),
(1063, 1, 301, '2019-11-20 12:55:58'),
(1064, 1, 48, '2019-11-20 13:05:52'),
(1065, 1, 33, '2019-11-20 13:06:50'),
(1066, 1, 230, '2019-11-20 13:07:46'),
(1067, 5, 301, '2019-11-20 13:29:19'),
(1068, 5, 301, '2019-11-20 13:29:20'),
(1069, 5, 301, '2019-11-20 13:29:20'),
(1070, 3, 95, '2019-11-20 13:31:48'),
(1071, 1, 58, '2019-11-20 16:00:20'),
(1072, 1, 58, '2019-11-21 08:47:36'),
(1073, 1, 58, '2019-11-21 09:03:48'),
(1074, 1, 226, '2019-11-22 09:03:47'),
(1075, 1, 226, '2019-11-22 09:03:56'),
(1076, 1, 226, '2019-11-22 09:05:19'),
(1077, 1, 333, '2019-11-22 14:14:08'),
(1078, 1, 334, '2019-11-22 14:14:14'),
(1079, 1, 326, '2019-11-28 13:43:52'),
(1080, 1, 326, '2019-11-28 13:43:52'),
(1081, 1, 326, '2019-11-28 13:43:52'),
(1082, 1, 333, '2019-11-29 10:07:59'),
(1083, 1, 87, '2019-12-02 08:46:27'),
(1084, 1, 87, '2019-12-02 10:28:55'),
(1085, 1, 87, '2019-12-02 10:32:49'),
(1086, 1, 87, '2019-12-02 10:37:12'),
(1087, 1, 87, '2019-12-02 10:37:52'),
(1088, 1, 87, '2019-12-02 10:38:15'),
(1089, 1, 87, '2019-12-02 10:38:45'),
(1090, 1, 87, '2019-12-02 10:39:45'),
(1091, 1, 87, '2019-12-02 10:42:08'),
(1092, 1, 48, '2019-12-02 10:43:45'),
(1093, 1, 87, '2019-12-02 10:43:50'),
(1094, 1, 87, '2019-12-02 10:43:59'),
(1095, 1, 87, '2019-12-02 10:44:00'),
(1096, 1, 334, '2019-12-02 10:55:23'),
(1097, 1, 333, '2019-12-02 10:55:25'),
(1098, 1, 87, '2019-12-02 11:01:29'),
(1099, 1, 87, '2019-12-02 11:01:45'),
(1100, 1, 87, '2019-12-02 11:01:54'),
(1101, 1, 87, '2019-12-02 11:01:57'),
(1102, 1, 87, '2019-12-02 11:02:03'),
(1103, 1, 48, '2019-12-02 11:06:50'),
(1104, 1, 95, '2019-12-02 11:07:15'),
(1105, 1, 48, '2019-12-02 11:10:51'),
(1106, 1, 48, '2019-12-02 11:14:35'),
(1107, 1, 48, '2019-12-02 11:23:37'),
(1108, 1, 48, '2019-12-02 11:26:35'),
(1109, 1, 48, '2019-12-02 11:26:39'),
(1110, 1, 48, '2019-12-02 11:31:56'),
(1111, 1, 48, '2019-12-02 11:31:58'),
(1112, 1, 333, '2019-12-02 11:54:36'),
(1113, 1, 334, '2019-12-02 11:57:59'),
(1114, 1, 333, '2019-12-02 11:58:01'),
(1115, 1, 334, '2019-12-02 11:58:04'),
(1116, 1, 334, '2019-12-02 11:58:07'),
(1117, 1, 58, '2019-12-03 05:38:01'),
(1118, 1, 58, '2019-12-03 05:38:06'),
(1119, 1, 58, '2019-12-03 05:38:07'),
(1120, 1, 58, '2019-12-03 05:38:09'),
(1121, 1, 58, '2019-12-03 05:38:10'),
(1122, 1, 58, '2019-12-03 05:38:12'),
(1123, 1, 19, '2019-12-03 08:57:31'),
(1124, 1, 58, '2019-12-03 08:57:37'),
(1125, 1, 58, '2019-12-03 09:46:57'),
(1126, 1, 58, '2019-12-03 09:46:59'),
(1127, 1, 58, '2019-12-03 11:19:14'),
(1128, 1, 58, '2019-12-03 12:20:38'),
(1129, 3, 58, '2019-12-03 12:41:14'),
(1130, 1, 334, '2019-12-03 12:43:53'),
(1131, 1, 334, '2019-12-03 12:44:01'),
(1132, 1, 334, '2019-12-03 12:44:04'),
(1133, 1, 334, '2019-12-03 12:44:06'),
(1134, 1, 333, '2019-12-03 12:44:08'),
(1135, 1, 333, '2019-12-03 12:44:12'),
(1136, 1, 333, '2019-12-03 12:44:17'),
(1137, 1, 48, '2019-12-03 13:05:21'),
(1138, 1, 334, '2019-12-03 13:11:56'),
(1139, 1, 48, '2019-12-03 13:12:06'),
(1140, 1, 51, '2019-12-03 13:15:35'),
(1141, 1, 333, '2019-12-03 13:15:44'),
(1142, 1, 334, '2019-12-03 13:15:46'),
(1143, 1, 334, '2019-12-03 13:16:01'),
(1144, 1, 51, '2019-12-03 13:19:01'),
(1145, 1, 51, '2019-12-03 13:19:14'),
(1146, 1, 21, '2019-12-03 13:23:50'),
(1147, 1, 45, '2019-12-03 13:24:41'),
(1148, 1, 58, '2019-12-04 10:18:06'),
(1149, 1, 58, '2019-12-04 10:18:12'),
(1150, 1, 338, '2019-12-04 10:52:58'),
(1151, 1, 338, '2019-12-04 10:52:58'),
(1152, 1, 338, '2019-12-04 10:53:18'),
(1153, 1, 338, '2019-12-04 10:53:18'),
(1154, 1, 338, '2019-12-04 10:53:43'),
(1155, 1, 338, '2019-12-04 10:53:43'),
(1156, 1, 338, '2019-12-04 10:54:25'),
(1157, 1, 338, '2019-12-04 10:54:25'),
(1158, 1, 338, '2019-12-04 10:54:29'),
(1159, 1, 58, '2019-12-04 10:54:43'),
(1160, 1, 338, '2019-12-04 10:55:04'),
(1161, 1, 338, '2019-12-04 10:55:04'),
(1162, 1, 48, '2019-12-04 11:02:07'),
(1163, 1, 333, '2019-12-04 13:33:18'),
(1164, 1, 334, '2019-12-04 13:33:21'),
(1165, 1, 92, '2019-12-04 13:35:08'),
(1166, 1, 92, '2019-12-04 13:36:05'),
(1167, 1, 92, '2019-12-04 13:36:40'),
(1168, 1, 92, '2019-12-04 13:36:45'),
(1169, 1, 92, '2019-12-04 13:44:09'),
(1170, 1, 92, '2019-12-04 13:44:22'),
(1171, 1, 92, '2019-12-04 13:46:08'),
(1172, 1, 92, '2019-12-04 13:46:18'),
(1173, 1, 92, '2019-12-04 13:46:31'),
(1174, 1, 92, '2019-12-04 13:49:40'),
(1175, 1, 58, '2019-12-04 13:50:16'),
(1176, 1, 58, '2019-12-04 13:50:20'),
(1177, 8, 58, '2019-12-04 13:58:12'),
(1178, 7, 58, '2019-12-04 14:00:36'),
(1179, 6, 333, '2019-12-04 14:04:20'),
(1180, 6, 334, '2019-12-04 14:04:24'),
(1181, 7, 326, '2019-12-04 14:21:55'),
(1182, 7, 326, '2019-12-04 14:21:55'),
(1183, 7, 326, '2019-12-04 14:21:55'),
(1184, 7, 326, '2019-12-04 14:22:06'),
(1185, 7, 326, '2019-12-04 14:22:06'),
(1186, 7, 326, '2019-12-04 14:22:06'),
(1187, 1, 326, '2019-12-04 14:22:25'),
(1188, 1, 326, '2019-12-04 14:22:25'),
(1189, 1, 326, '2019-12-04 14:22:25'),
(1190, 1, 326, '2019-12-04 14:23:13'),
(1191, 1, 326, '2019-12-04 14:23:13'),
(1192, 1, 326, '2019-12-04 14:23:14'),
(1193, 1, 326, '2019-12-04 14:23:25'),
(1194, 1, 326, '2019-12-04 14:23:25'),
(1195, 1, 326, '2019-12-04 14:23:25'),
(1196, 1, 87, '2019-12-07 11:26:15'),
(1197, 1, 216, '2019-12-07 11:26:32'),
(1198, 1, 216, '2019-12-07 11:26:42'),
(1199, 1, 216, '2019-12-07 11:26:52'),
(1200, 1, 216, '2019-12-07 11:27:03'),
(1201, 1, 88, '2019-12-07 11:30:27'),
(1202, 1, 131, '2019-12-07 11:30:35'),
(1203, 1, 48, '2019-12-07 11:34:21'),
(1204, 1, 58, '2019-12-07 11:38:30'),
(1205, 1, 95, '2019-12-07 11:59:23'),
(1206, 1, 95, '2019-12-07 12:00:02'),
(1207, 1, 95, '2019-12-07 12:00:25'),
(1208, 1, 95, '2019-12-07 12:02:04'),
(1209, 1, 95, '2019-12-07 12:04:52'),
(1210, 1, 95, '2019-12-07 12:05:09'),
(1211, 1, 48, '2019-12-07 12:12:40'),
(1212, 1, 92, '2019-12-07 12:19:48'),
(1213, 1, 222, '2019-12-07 12:20:12'),
(1214, 1, 222, '2019-12-07 12:21:02'),
(1215, 1, 222, '2019-12-07 12:21:25'),
(1216, 1, 58, '2019-12-07 12:26:57'),
(1217, 1, 58, '2019-12-07 12:29:07'),
(1218, 1, 226, '2019-12-07 12:31:55'),
(1219, 1, 231, '2019-12-07 13:05:13'),
(1220, 1, 333, '2019-12-09 10:23:42'),
(1221, 1, 333, '2019-12-09 10:24:03'),
(1222, 1, 333, '2019-12-09 10:24:58'),
(1223, 1, 92, '2019-12-10 08:49:35'),
(1224, 1, 58, '2019-12-12 12:14:54'),
(1225, 1, 58, '2019-12-12 12:16:30'),
(1226, 1, 58, '2019-12-12 12:17:05'),
(1227, 1, 58, '2019-12-12 12:17:13'),
(1228, 1, 58, '2019-12-12 12:17:38'),
(1229, 1, 58, '2019-12-12 12:21:51'),
(1230, 1, 48, '2019-12-12 12:22:41'),
(1231, 1, 48, '2019-12-12 12:22:56'),
(1232, 1, 48, '2019-12-12 12:24:54'),
(1233, 1, 48, '2019-12-12 12:24:55'),
(1234, 1, 48, '2019-12-12 12:24:55'),
(1235, 1, 48, '2019-12-12 12:25:07'),
(1236, 1, 48, '2019-12-12 12:25:14'),
(1237, 1, 213, '2019-12-12 12:28:13'),
(1238, 1, 58, '2019-12-12 12:33:17'),
(1239, 1, 48, '2019-12-15 10:35:13'),
(1240, 1, 48, '2019-12-15 10:35:17'),
(1241, 1, 216, '2019-12-17 08:19:18'),
(1242, 1, 216, '2019-12-17 08:19:32'),
(1243, 1, 216, '2019-12-17 08:19:45'),
(1244, 1, 216, '2019-12-17 08:19:58'),
(1245, 1, 216, '2019-12-17 08:20:25'),
(1246, 1, 216, '2019-12-17 08:20:36'),
(1247, 1, 216, '2019-12-17 08:21:04'),
(1248, 1, 216, '2019-12-17 08:21:21'),
(1249, 1, 216, '2019-12-17 08:21:31'),
(1250, 1, 58, '2019-12-17 08:26:01'),
(1251, 1, 87, '2019-12-17 08:26:16'),
(1252, 1, 87, '2019-12-17 08:28:53'),
(1253, 1, 58, '2019-12-17 08:30:10'),
(1254, 1, 58, '2019-12-17 08:39:32'),
(1255, 1, 58, '2019-12-17 15:34:44'),
(1256, 1, 58, '2019-12-17 15:34:52'),
(1257, 1, 58, '2019-12-17 15:34:59'),
(1258, 1, 58, '2019-12-17 15:35:05'),
(1259, 1, 33, '2019-12-17 15:58:28'),
(1260, 1, 33, '2019-12-17 15:59:11'),
(1261, 1, 33, '2019-12-17 16:00:05'),
(1262, 1, 213, '2019-12-17 16:05:13'),
(1263, 1, 213, '2019-12-17 16:05:23'),
(1264, 1, 213, '2019-12-17 16:06:21'),
(1265, 1, 213, '2019-12-17 16:09:18'),
(1266, 1, 213, '2019-12-17 16:09:20'),
(1267, 1, 213, '2019-12-17 16:09:36'),
(1268, 1, 213, '2019-12-17 16:13:32'),
(1269, 1, 213, '2019-12-17 16:14:03'),
(1270, 1, 213, '2019-12-17 16:14:37'),
(1271, 1, 48, '2019-12-18 08:39:30'),
(1272, 1, 58, '2019-12-18 08:42:29'),
(1273, 1, 33, '2019-12-18 08:42:48'),
(1274, 1, 58, '2019-12-18 08:46:12'),
(1275, 1, 48, '2019-12-19 07:25:50'),
(1276, 1, 48, '2019-12-19 07:26:02'),
(1277, 1, 48, '2019-12-19 07:26:07'),
(1278, 1, 58, '2019-12-19 10:19:56'),
(1279, 1, 33, '2019-12-19 10:36:49'),
(1280, 1, 33, '2019-12-21 07:44:22'),
(1281, 1, 48, '2019-12-22 09:17:03'),
(1282, 1, 21, '2019-12-22 11:20:23'),
(1283, 1, 22, '2019-12-22 11:20:24'),
(1284, 1, 22, '2019-12-22 11:20:30'),
(1285, 1, 48, '2019-12-22 11:20:58'),
(1286, 1, 58, '2019-12-22 11:37:27'),
(1287, 1, 58, '2019-12-22 11:37:45'),
(1288, 1, 58, '2019-12-22 11:39:28'),
(1289, 1, 58, '2019-12-22 11:48:50'),
(1290, 1, 213, '2019-12-22 11:50:43'),
(1291, 1, 213, '2019-12-22 11:51:06'),
(1292, 1, 213, '2019-12-22 11:52:41'),
(1293, 1, 213, '2019-12-22 11:52:52'),
(1294, 1, 213, '2019-12-22 11:52:57'),
(1295, 1, 58, '2019-12-22 12:08:21'),
(1296, 1, 58, '2019-12-22 12:10:48'),
(1297, 1, 58, '2019-12-22 12:14:18'),
(1298, 1, 58, '2019-12-22 12:15:05'),
(1299, 1, 58, '2019-12-22 12:18:30'),
(1300, 1, 48, '2019-12-22 12:20:43'),
(1301, 1, 48, '2019-12-22 12:20:46'),
(1302, 1, 48, '2019-12-22 12:23:36'),
(1303, 1, 48, '2019-12-22 12:23:42'),
(1304, 1, 48, '2019-12-22 12:26:38'),
(1305, 1, 95, '2019-12-22 12:34:22'),
(1306, 1, 95, '2019-12-22 12:34:50'),
(1307, 1, 58, '2019-12-22 12:35:55'),
(1308, 1, 95, '2019-12-22 12:43:58'),
(1309, 1, 95, '2019-12-22 12:44:38'),
(1310, 1, 95, '2020-01-02 08:26:26'),
(1311, 3, 48, '2020-01-10 08:29:49'),
(1312, 1, 220, '2020-01-17 12:56:03'),
(1313, 1, 58, '2020-01-17 13:04:51'),
(1314, 1, 58, '2020-01-17 13:09:07'),
(1315, 1, 11, '2020-01-17 13:21:31'),
(1316, 1, 11, '2020-01-17 13:22:52'),
(1317, 1, 11, '2020-01-17 13:23:30'),
(1318, 1, 11, '2020-01-17 13:24:21'),
(1319, 1, 58, '2020-01-17 13:24:49'),
(1320, 1, 58, '2020-01-17 13:24:50'),
(1321, 1, 58, '2020-01-17 14:26:35'),
(1322, 1, 58, '2020-01-17 14:31:21'),
(1323, 1, 95, '2020-01-17 14:31:54'),
(1324, 1, 222, '2020-01-17 14:33:02'),
(1325, 1, 95, '2020-01-17 14:33:13'),
(1326, 1, 48, '2020-01-17 14:34:35'),
(1327, 1, 48, '2020-01-17 14:41:56'),
(1328, 1, 58, '2020-01-17 14:54:27'),
(1329, 1, 58, '2020-01-17 14:54:31'),
(1330, 1, 58, '2020-01-17 14:54:39'),
(1331, 1, 22, '2020-01-17 14:59:58'),
(1332, 1, 22, '2020-01-17 15:00:01'),
(1333, 1, 22, '2020-01-17 15:00:01'),
(1334, 1, 22, '2020-01-17 15:00:06'),
(1335, 1, 92, '2020-02-13 07:14:26'),
(1336, 1, 92, '2020-02-13 07:16:10'),
(1337, 1, 92, '2020-02-13 07:28:58'),
(1338, 1, 92, '2020-02-13 12:19:44'),
(1339, 1, 58, '2020-02-22 01:49:15'),
(1340, 1, 52, '2020-02-22 07:28:44'),
(1341, 1, 48, '2020-02-22 07:30:11'),
(1342, 1, 48, '2020-02-22 07:30:16'),
(1343, 1, 52, '2020-02-22 07:30:25'),
(1344, 1, 48, '2020-02-22 07:33:35'),
(1345, 1, 48, '2020-02-22 07:33:42'),
(1346, 1, 48, '2020-02-22 07:36:42'),
(1347, 1, 58, '2020-02-22 07:46:26'),
(1348, 1, 58, '2020-02-22 07:52:13'),
(1349, 1, 52, '2020-02-22 07:55:39'),
(1350, 1, 48, '2020-02-22 07:56:23'),
(1351, 1, 48, '2020-02-22 07:56:27'),
(1352, 1, 52, '2020-02-22 07:58:40'),
(1353, 1, 48, '2020-02-22 07:58:55'),
(1354, 1, 48, '2020-02-22 07:58:59'),
(1355, 1, 48, '2020-02-23 09:01:06'),
(1356, 1, 48, '2020-02-23 09:40:04'),
(1357, 1, 48, '2020-02-23 09:40:07'),
(1358, 1, 33, '2020-02-23 10:01:12'),
(1359, 1, 95, '2020-02-23 10:02:12'),
(1360, 1, 95, '2020-02-23 10:02:21'),
(1361, 1, 58, '2020-02-23 10:02:31'),
(1362, 1, 48, '2020-02-23 10:15:24'),
(1363, 1, 33, '2020-02-23 10:39:42'),
(1364, 1, 334, '2020-02-23 10:50:39'),
(1365, 1, 333, '2020-02-23 10:50:43'),
(1366, 1, 333, '2020-02-23 10:50:49'),
(1367, 1, 334, '2020-02-23 10:50:49'),
(1368, 1, 333, '2020-02-23 10:51:20'),
(1369, 1, 334, '2020-02-23 10:51:21'),
(1370, 1, 51, '2020-02-23 10:51:41'),
(1371, 1, 51, '2020-02-23 10:51:50'),
(1372, 1, 51, '2020-02-23 10:51:53'),
(1373, 1, 58, '2020-02-23 11:37:52'),
(1374, 1, 48, '2020-02-23 11:39:33'),
(1375, 1, 48, '2020-02-23 11:42:39'),
(1376, 1, 222, '2020-02-23 11:42:51'),
(1377, 1, 222, '2020-02-23 11:42:58'),
(1378, 1, 222, '2020-02-23 11:43:07'),
(1379, 1, 222, '2020-02-23 11:43:31'),
(1380, 1, 48, '2020-02-23 11:43:34'),
(1381, 1, 48, '2020-02-24 05:53:23'),
(1382, 1, 48, '2020-02-24 05:53:51'),
(1383, 1, 48, '2020-02-24 05:54:19'),
(1384, 1, 58, '2020-02-24 05:58:04'),
(1385, 1, 246, '2020-02-24 05:58:34'),
(1386, 1, 246, '2020-02-24 05:58:40'),
(1387, 1, 58, '2020-02-24 13:34:23'),
(1388, 1, 95, '2020-02-24 13:34:33'),
(1389, 1, 48, '2020-03-13 07:33:29'),
(1390, 1, 334, '2020-03-24 08:59:23'),
(1391, 1, 334, '2020-03-24 08:59:47'),
(1392, 1, 334, '2020-03-24 09:00:07'),
(1393, 1, 334, '2020-03-24 09:00:37'),
(1394, 1, 334, '2020-03-24 09:01:32'),
(1395, 1, 333, '2020-03-24 09:13:10'),
(1396, 1, 333, '2020-03-24 09:14:03'),
(1397, 1, 58, '2020-03-26 13:09:46'),
(1398, 1, 58, '2020-03-26 13:09:54'),
(1399, 1, 58, '2020-03-26 13:10:00'),
(1400, 1, 334, '2020-03-27 06:11:48'),
(1401, 1, 333, '2020-03-27 06:11:58'),
(1402, 1, 58, '2020-03-27 06:18:28'),
(1403, 1, 326, '2020-03-29 05:55:36'),
(1404, 1, 326, '2020-03-29 05:55:36'),
(1405, 1, 326, '2020-03-29 05:55:36'),
(1406, 1, 326, '2020-03-29 05:56:28'),
(1407, 1, 326, '2020-03-29 05:56:28');
INSERT INTO `user_action_log` (`uac_id`, `user_id`, `menu_id`, `created_date`) VALUES
(1408, 1, 326, '2020-03-29 05:56:28'),
(1409, 1, 213, '2020-03-29 06:42:37'),
(1410, 1, 48, '2020-03-29 11:10:35'),
(1411, 1, 33, '2020-03-29 13:06:07'),
(1412, 1, 48, '2020-03-29 13:06:24'),
(1413, 1, 33, '2020-03-29 13:06:28'),
(1414, 1, 44, '2020-03-29 13:09:24'),
(1415, 1, 44, '2020-03-29 13:09:49'),
(1416, 1, 194, '2020-03-29 13:34:08'),
(1417, 1, 194, '2020-03-29 13:34:27'),
(1418, 1, 226, '2020-03-29 13:35:35'),
(1419, 1, 51, '2020-03-29 13:36:29'),
(1420, 1, 51, '2020-03-29 13:36:53'),
(1421, 1, 326, '2020-03-29 14:36:43'),
(1422, 1, 326, '2020-03-29 14:36:47'),
(1423, 1, 326, '2020-03-29 14:36:48'),
(1424, 1, 326, '2020-03-29 14:37:52'),
(1425, 1, 326, '2020-03-29 14:37:53'),
(1426, 1, 326, '2020-03-29 14:37:53'),
(1427, 1, 60, '2020-04-01 03:21:54'),
(1428, 1, 60, '2020-04-01 03:22:07'),
(1429, 1, 240, '2020-04-01 03:22:15'),
(1430, 1, 226, '2020-04-01 03:24:16'),
(1431, 1, 226, '2020-04-01 03:24:31'),
(1432, 1, 226, '2020-04-01 03:25:11'),
(1433, 1, 58, '2020-04-01 04:02:23'),
(1434, 1, 58, '2020-04-01 04:15:55'),
(1435, 1, 58, '2020-04-01 04:20:11'),
(1436, 1, 58, '2020-04-01 04:20:41'),
(1437, 1, 95, '2020-04-01 04:21:49'),
(1438, 1, 48, '2020-04-02 06:14:47'),
(1439, 1, 95, '2020-04-02 06:15:31'),
(1440, 1, 48, '2020-04-02 06:39:30'),
(1441, 1, 339, '2020-04-08 06:20:22'),
(1442, 1, 339, '2020-04-08 06:20:26'),
(1443, 1, 339, '2020-04-08 06:21:08'),
(1444, 1, 339, '2020-04-08 06:21:24'),
(1445, 1, 339, '2020-04-08 07:01:07'),
(1446, 1, 339, '2020-04-08 07:01:19'),
(1447, 1, 326, '2020-04-08 14:24:54'),
(1448, 1, 326, '2020-04-08 14:24:54'),
(1449, 1, 326, '2020-04-08 14:24:54'),
(1450, 1, 326, '2020-04-08 14:25:20'),
(1451, 1, 326, '2020-04-08 14:25:20'),
(1452, 1, 326, '2020-04-08 14:25:20'),
(1453, 1, 326, '2020-04-08 14:26:44'),
(1454, 1, 22, '2020-04-08 14:30:20'),
(1455, 1, 334, '2020-04-09 14:56:44'),
(1456, 1, 334, '2020-04-09 14:56:59'),
(1457, 1, 338, '2020-04-10 14:29:51'),
(1458, 1, 338, '2020-04-10 14:29:51'),
(1459, 1, 338, '2020-04-10 14:31:56'),
(1460, 1, 338, '2020-04-10 14:31:56'),
(1461, 1, 11, '2020-04-10 14:35:51'),
(1462, 1, 11, '2020-04-10 14:36:04'),
(1463, 1, 11, '2020-04-10 14:36:35'),
(1464, 1, 45, '2020-04-10 14:52:23'),
(1465, 1, 45, '2020-04-10 14:53:34'),
(1466, 1, 95, '2020-04-11 07:13:22'),
(1467, 1, 95, '2020-04-11 07:16:08'),
(1468, 1, 95, '2020-04-11 07:24:02'),
(1469, 1, 95, '2020-04-11 07:25:29'),
(1470, 1, 95, '2020-04-11 07:26:31'),
(1471, 1, 48, '2020-04-11 07:32:13'),
(1472, 1, 58, '2020-04-11 11:17:24'),
(1473, 1, 58, '2020-04-11 11:35:39'),
(1474, 1, 58, '2020-04-11 11:37:30'),
(1475, 1, 95, '2020-04-11 12:00:54'),
(1476, 1, 95, '2020-04-11 12:01:31'),
(1477, 1, 58, '2020-04-11 12:01:35'),
(1478, 1, 58, '2020-04-11 12:26:15'),
(1479, 1, 58, '2020-04-11 12:27:31'),
(1480, 1, 95, '2020-04-11 12:31:41'),
(1481, 1, 95, '2020-04-11 12:32:54'),
(1482, 1, 58, '2020-04-11 12:33:06'),
(1483, 1, 58, '2020-04-11 12:33:14'),
(1484, 1, 58, '2020-04-11 14:23:35'),
(1485, 1, 58, '2020-04-11 14:51:55'),
(1486, 1, 58, '2020-04-11 14:53:06'),
(1487, 1, 95, '2020-04-12 02:29:01'),
(1488, 1, 95, '2020-04-12 02:29:19'),
(1489, 1, 95, '2020-04-12 02:31:59'),
(1490, 1, 95, '2020-04-12 02:33:53'),
(1491, 1, 95, '2020-04-12 02:39:22'),
(1492, 1, 95, '2020-04-12 02:41:58'),
(1493, 1, 95, '2020-04-12 02:42:06'),
(1494, 1, 58, '2020-04-12 02:42:15'),
(1495, 1, 58, '2020-04-12 02:52:08'),
(1496, 1, 58, '2020-04-12 02:58:27'),
(1497, 1, 58, '2020-04-12 03:04:25'),
(1498, 1, 58, '2020-04-12 03:08:00'),
(1499, 1, 58, '2020-04-12 03:08:03'),
(1500, 1, 58, '2020-04-12 03:08:07'),
(1501, 1, 58, '2020-04-12 03:08:10'),
(1502, 1, 33, '2020-04-12 05:42:41'),
(1503, 1, 33, '2020-04-12 05:42:44'),
(1504, 1, 33, '2020-04-12 05:42:46'),
(1505, 1, 51, '2020-04-12 05:43:38'),
(1506, 1, 51, '2020-04-12 05:44:00'),
(1507, 1, 51, '2020-04-12 05:44:20'),
(1508, 1, 51, '2020-04-12 05:44:37'),
(1509, 1, 48, '2020-04-12 05:48:26'),
(1510, 1, 95, '2020-04-12 05:49:07'),
(1511, 1, 341, '2020-04-12 06:41:55'),
(1512, 1, 341, '2020-04-14 10:34:34'),
(1513, 1, 58, '2020-04-14 10:44:19'),
(1514, 1, 58, '2020-04-14 10:44:28'),
(1515, 1, 58, '2020-04-14 10:44:53'),
(1516, 1, 48, '2020-04-14 10:46:46'),
(1517, 1, 48, '2020-04-14 10:50:20'),
(1518, 1, 95, '2020-04-14 10:52:27'),
(1519, 1, 95, '2020-04-14 10:53:04'),
(1520, 1, 95, '2020-04-14 10:53:39'),
(1521, 1, 95, '2020-04-14 10:54:08'),
(1522, 1, 341, '2020-04-15 05:38:27'),
(1523, 1, 341, '2020-04-15 05:40:40'),
(1524, 1, 341, '2020-04-15 05:41:59'),
(1525, 1, 341, '2020-04-15 05:41:59'),
(1526, 1, 341, '2020-04-15 05:41:59'),
(1527, 1, 341, '2020-04-15 05:43:32'),
(1528, 1, 341, '2020-04-15 05:43:32'),
(1529, 1, 341, '2020-04-15 05:43:32'),
(1530, 1, 341, '2020-04-15 05:43:32'),
(1531, 1, 341, '2020-04-15 05:43:32'),
(1532, 1, 341, '2020-04-15 05:43:32'),
(1533, 1, 58, '2020-04-15 05:44:00'),
(1534, 1, 58, '2020-04-15 05:44:01'),
(1535, 1, 58, '2020-04-15 05:44:01'),
(1536, 1, 58, '2020-04-15 05:44:01'),
(1537, 1, 58, '2020-04-15 05:44:01'),
(1538, 1, 58, '2020-04-15 05:44:01'),
(1539, 1, 58, '2020-04-15 05:44:01'),
(1540, 1, 58, '2020-04-15 05:44:01'),
(1541, 1, 58, '2020-04-15 05:44:11'),
(1542, 1, 58, '2020-04-15 06:19:20'),
(1543, 1, 58, '2020-04-15 06:19:25'),
(1544, 1, 58, '2020-04-15 06:19:36'),
(1545, 1, 95, '2020-04-15 06:25:44'),
(1546, 1, 58, '2020-04-15 06:32:35'),
(1547, 1, 48, '2020-04-15 06:32:50'),
(1548, 1, 95, '2020-04-15 10:05:17'),
(1549, 1, 95, '2020-04-15 10:05:41'),
(1550, 1, 48, '2020-04-15 10:13:46'),
(1551, 1, 48, '2020-04-15 10:14:26'),
(1552, 1, 48, '2020-04-15 10:14:29'),
(1553, 1, 21, '2020-04-15 10:20:58'),
(1554, 1, 21, '2020-04-15 10:21:03'),
(1555, 1, 21, '2020-04-15 10:21:03'),
(1556, 1, 22, '2020-04-15 10:21:15'),
(1557, 1, 22, '2020-04-15 10:21:18'),
(1558, 1, 22, '2020-04-15 10:21:31'),
(1559, 1, 22, '2020-04-15 10:21:31'),
(1560, 1, 22, '2020-04-15 10:21:41'),
(1561, 1, 22, '2020-04-15 10:21:41'),
(1562, 1, 22, '2020-04-15 10:21:42'),
(1563, 1, 22, '2020-04-15 10:21:43'),
(1564, 1, 22, '2020-04-15 10:21:43'),
(1565, 1, 22, '2020-04-15 10:21:44'),
(1566, 1, 22, '2020-04-15 10:23:05'),
(1567, 1, 58, '2020-04-15 10:29:37'),
(1568, 1, 341, '2020-04-15 10:38:44'),
(1569, 1, 33, '2020-04-15 10:42:25'),
(1570, 1, 44, '2020-04-15 10:42:46'),
(1571, 1, 194, '2020-04-15 10:46:44'),
(1572, 9, 194, '2020-04-15 10:48:34'),
(1573, 9, 194, '2020-04-15 10:48:56'),
(1574, 9, 58, '2020-04-15 10:49:53'),
(1575, 9, 58, '2020-04-15 10:50:31'),
(1576, 9, 33, '2020-04-15 10:53:47'),
(1577, 9, 22, '2020-04-15 11:08:00'),
(1578, 9, 22, '2020-04-15 11:08:09'),
(1579, 9, 22, '2020-04-15 11:08:09'),
(1580, 9, 22, '2020-04-15 11:08:09'),
(1581, 9, 45, '2020-04-15 11:11:59'),
(1582, 1, 58, '2020-04-16 05:07:54'),
(1583, 1, 58, '2020-04-16 05:17:43'),
(1584, 1, 95, '2020-04-16 05:18:01'),
(1585, 1, 95, '2020-04-16 05:18:23'),
(1586, 1, 58, '2020-04-16 05:18:32'),
(1587, 1, 45, '2020-04-17 02:40:01'),
(1588, 1, 92, '2020-04-17 02:40:43'),
(1589, 1, 92, '2020-04-17 02:44:08'),
(1590, 1, 222, '2020-04-17 02:44:21'),
(1591, 1, 95, '2020-04-17 02:47:04'),
(1592, 1, 95, '2020-04-17 02:49:37'),
(1593, 1, 108, '2020-04-17 03:04:57'),
(1594, 1, 222, '2020-04-17 03:05:08'),
(1595, 1, 222, '2020-04-17 03:06:02'),
(1596, 1, 58, '2020-04-17 05:25:58'),
(1597, 1, 58, '2020-04-17 06:04:17'),
(1598, 1, 194, '2020-04-17 13:08:13'),
(1599, 9, 194, '2020-04-17 13:08:52'),
(1600, 9, 194, '2020-04-17 13:09:13'),
(1601, 9, 58, '2020-04-17 13:14:40'),
(1602, 1, 58, '2020-04-18 07:22:10'),
(1603, 1, 58, '2020-04-18 07:23:35'),
(1604, 1, 58, '2020-04-18 07:23:35'),
(1605, 1, 58, '2020-04-18 07:23:36'),
(1606, 1, 58, '2020-04-18 07:23:37'),
(1607, 1, 58, '2020-04-18 07:23:41'),
(1608, 1, 58, '2020-04-18 07:23:42'),
(1609, 1, 58, '2020-04-18 07:23:44'),
(1610, 1, 58, '2020-04-18 07:23:45'),
(1611, 1, 58, '2020-04-18 07:23:46'),
(1612, 1, 58, '2020-04-18 07:23:48'),
(1613, 1, 58, '2020-04-18 07:23:51'),
(1614, 1, 58, '2020-04-18 07:23:53'),
(1615, 1, 58, '2020-04-18 07:24:02'),
(1616, 1, 58, '2020-04-19 05:01:00'),
(1617, 1, 58, '2020-04-21 01:45:53'),
(1618, 1, 58, '2020-04-21 01:49:35'),
(1619, 1, 58, '2020-04-21 01:53:11'),
(1620, 1, 216, '2020-04-21 02:30:56'),
(1621, 1, 92, '2020-04-21 02:31:16'),
(1622, 1, 338, '2020-04-21 02:52:31'),
(1623, 1, 338, '2020-04-21 02:52:31'),
(1624, 1, 231, '2020-04-21 14:03:31'),
(1625, 1, 21, '2020-04-21 14:03:46'),
(1626, 1, 21, '2020-04-21 14:03:49'),
(1627, 1, 21, '2020-04-21 14:03:51'),
(1628, 1, 22, '2020-04-21 14:03:57'),
(1629, 1, 19, '2020-04-21 14:04:58'),
(1630, 1, 20, '2020-04-21 14:05:03'),
(1631, 1, 19, '2020-04-21 14:05:08'),
(1632, 1, 204, '2020-04-21 14:14:47'),
(1633, 1, 204, '2020-04-21 14:16:03'),
(1634, 1, 58, '2020-04-21 14:17:45'),
(1635, 1, 58, '2020-04-21 14:27:38'),
(1636, 1, 213, '2020-04-21 14:28:30'),
(1637, 1, 58, '2020-04-21 14:28:55'),
(1638, 1, 213, '2020-04-21 14:29:14'),
(1639, 1, 58, '2020-04-21 14:34:00'),
(1640, 1, 213, '2020-04-21 14:34:06'),
(1641, 1, 341, '2020-04-21 14:34:23'),
(1642, 1, 131, '2020-04-21 14:46:49'),
(1643, 1, 341, '2020-04-21 14:46:53'),
(1644, 1, 213, '2020-04-21 14:46:54'),
(1645, 1, 131, '2020-04-21 14:46:58'),
(1646, 1, 194, '2020-04-21 14:47:36'),
(1647, 9, 194, '2020-04-21 14:48:39'),
(1648, 9, 194, '2020-04-21 14:49:14'),
(1649, 9, 194, '2020-04-21 14:49:46'),
(1650, 1, 51, '2020-04-21 14:55:45'),
(1651, 1, 51, '2020-04-21 14:56:18'),
(1652, 1, 48, '2020-04-21 15:15:09'),
(1653, 1, 338, '2020-04-21 15:19:05'),
(1654, 1, 338, '2020-04-21 15:19:05'),
(1655, 1, 44, '2020-04-21 15:19:32'),
(1656, 1, 230, '2020-04-22 08:01:53'),
(1657, 1, 230, '2020-04-22 08:11:19'),
(1658, 1, 230, '2020-04-22 08:13:01'),
(1659, 1, 222, '2020-04-22 08:37:52'),
(1660, 1, 108, '2020-04-22 09:48:56'),
(1661, 1, 108, '2020-04-22 09:50:22'),
(1662, 1, 58, '2020-04-24 13:30:17'),
(1663, 1, 58, '2020-04-24 14:36:25'),
(1664, 1, 58, '2020-04-24 14:36:31'),
(1665, 1, 48, '2020-04-24 14:42:49'),
(1666, 1, 95, '2020-04-24 15:18:42'),
(1667, 1, 230, '2020-04-25 08:16:33'),
(1668, 1, 108, '2020-04-25 08:23:06'),
(1669, 1, 58, '2020-04-27 14:43:41'),
(1670, 1, 58, '2020-04-27 14:43:45'),
(1671, 1, 22, '2020-04-27 14:44:45'),
(1672, 1, 22, '2020-04-27 14:44:49'),
(1673, 1, 22, '2020-04-27 14:44:50'),
(1674, 1, 216, '2020-04-27 14:57:00'),
(1675, 1, 88, '2020-04-27 14:57:18'),
(1676, 1, 58, '2020-04-27 15:06:27'),
(1677, 1, 95, '2020-04-27 15:08:43'),
(1678, 1, 95, '2020-04-27 15:10:06'),
(1679, 1, 58, '2020-04-27 15:10:19'),
(1680, 1, 95, '2020-04-27 15:10:52'),
(1681, 1, 95, '2020-04-27 15:11:06'),
(1682, 1, 58, '2020-04-27 15:11:29'),
(1683, 1, 11, '2020-04-27 15:11:56'),
(1684, 1, 58, '2020-04-27 15:12:08'),
(1685, 1, 58, '2020-04-27 15:32:13'),
(1686, 1, 222, '2020-04-28 05:09:27'),
(1687, 1, 214, '2020-04-28 05:23:12'),
(1688, 1, 58, '2020-04-28 05:25:50'),
(1689, 1, 88, '2020-04-28 05:27:38'),
(1690, 1, 131, '2020-04-28 05:27:39'),
(1691, 1, 88, '2020-04-28 05:27:40'),
(1692, 1, 216, '2020-04-28 05:27:48'),
(1693, 1, 58, '2020-04-28 05:27:58'),
(1694, 1, 58, '2020-04-28 05:28:21'),
(1695, 1, 58, '2020-04-28 05:28:49'),
(1696, 1, 33, '2020-04-28 05:29:16'),
(1697, 1, 58, '2020-04-28 05:29:31'),
(1698, 1, 105, '2020-04-28 05:36:22'),
(1699, 1, 33, '2020-04-28 05:36:23'),
(1700, 1, 51, '2020-04-28 06:02:12'),
(1701, 1, 51, '2020-04-28 06:02:49'),
(1702, 1, 51, '2020-04-28 06:03:50'),
(1703, 1, 58, '2020-04-29 07:03:39'),
(1704, 1, 95, '2020-04-29 07:04:22'),
(1705, 1, 95, '2020-04-29 07:04:53'),
(1706, 1, 58, '2020-04-29 07:04:55'),
(1707, 1, 231, '2020-04-29 13:55:09'),
(1708, 1, 21, '2020-04-29 13:55:26'),
(1709, 1, 20, '2020-04-29 13:55:30'),
(1710, 1, 87, '2020-04-29 13:57:03'),
(1711, 1, 87, '2020-04-29 13:58:59'),
(1712, 1, 11, '2020-04-29 14:00:14'),
(1713, 1, 45, '2020-04-29 14:00:16'),
(1714, 1, 210, '2020-04-29 14:02:20'),
(1715, 1, 341, '2020-04-29 14:02:32'),
(1716, 1, 341, '2020-04-29 14:03:28'),
(1717, 1, 341, '2020-04-29 14:04:26'),
(1718, 1, 341, '2020-04-29 14:05:06'),
(1719, 1, 58, '2020-04-29 14:07:06'),
(1720, 1, 58, '2020-04-29 14:07:40'),
(1721, 1, 131, '2020-04-29 14:10:15'),
(1722, 1, 131, '2020-04-29 14:10:46'),
(1723, 1, 58, '2020-04-29 14:13:57'),
(1724, 1, 216, '2020-04-29 14:15:41'),
(1725, 1, 213, '2020-04-29 14:15:48'),
(1726, 1, 216, '2020-04-29 14:15:52'),
(1727, 1, 213, '2020-04-29 14:16:01'),
(1728, 1, 48, '2020-04-29 14:25:54'),
(1729, 1, 105, '2020-04-29 14:46:37'),
(1730, 1, 338, '2020-04-29 14:50:58'),
(1731, 1, 338, '2020-04-29 14:50:58'),
(1732, 1, 338, '2020-04-29 14:53:09'),
(1733, 1, 338, '2020-04-29 14:53:09'),
(1734, 1, 129, '2020-04-29 14:55:39'),
(1735, 1, 95, '2020-04-29 14:55:42'),
(1736, 1, 95, '2020-04-30 02:19:16'),
(1737, 1, 22, '2020-05-02 02:49:48'),
(1738, 1, 22, '2020-05-02 02:49:54'),
(1739, 1, 22, '2020-05-02 02:49:54'),
(1740, 1, 22, '2020-05-02 02:49:55'),
(1741, 1, 22, '2020-05-02 02:50:04'),
(1742, 1, 22, '2020-05-02 02:50:04'),
(1743, 1, 22, '2020-05-02 03:26:14'),
(1744, 1, 22, '2020-05-02 03:26:16'),
(1745, 1, 22, '2020-05-02 03:29:41'),
(1746, 1, 230, '2020-05-02 03:59:09'),
(1747, 1, 226, '2020-05-02 04:01:44'),
(1748, 1, 48, '2020-05-02 09:08:59'),
(1749, 1, 231, '2020-05-02 09:35:19'),
(1750, 1, 21, '2020-05-02 09:35:20'),
(1751, 1, 22, '2020-05-02 09:35:25'),
(1752, 1, 19, '2020-05-02 09:35:26'),
(1753, 1, 20, '2020-05-02 09:35:30'),
(1754, 1, 11, '2020-05-02 09:35:37'),
(1755, 1, 45, '2020-05-02 09:35:40'),
(1756, 1, 45, '2020-05-02 09:35:41'),
(1757, 1, 198, '2020-05-02 09:36:03'),
(1758, 1, 130, '2020-05-02 09:36:05'),
(1759, 1, 204, '2020-05-02 09:36:09'),
(1760, 1, 341, '2020-05-02 09:36:16'),
(1761, 1, 58, '2020-05-02 09:36:23'),
(1762, 1, 131, '2020-05-02 09:36:28'),
(1763, 1, 131, '2020-05-02 09:36:30'),
(1764, 1, 88, '2020-05-02 09:36:31'),
(1765, 1, 88, '2020-05-02 09:36:32'),
(1766, 1, 48, '2020-05-02 09:41:15'),
(1767, 1, 58, '2020-05-02 09:41:41'),
(1768, 1, 131, '2020-05-02 09:42:21'),
(1769, 1, 341, '2020-05-02 09:42:24'),
(1770, 1, 92, '2020-05-02 09:42:37'),
(1771, 1, 95, '2020-05-02 09:45:48'),
(1772, 1, 95, '2020-05-02 09:56:06'),
(1773, 1, 231, '2020-05-02 10:01:45'),
(1774, 1, 231, '2020-05-02 11:51:04'),
(1775, 1, 21, '2020-05-02 11:51:06'),
(1776, 1, 22, '2020-05-02 11:51:11'),
(1777, 1, 19, '2020-05-02 11:51:17'),
(1778, 1, 20, '2020-05-02 11:51:20'),
(1779, 1, 231, '2020-05-02 11:51:23'),
(1780, 1, 21, '2020-05-02 11:51:25'),
(1781, 1, 22, '2020-05-02 11:51:27'),
(1782, 1, 87, '2020-05-02 11:51:34'),
(1783, 1, 11, '2020-05-02 11:51:35'),
(1784, 1, 45, '2020-05-02 11:51:40'),
(1785, 1, 341, '2020-05-02 11:51:45'),
(1786, 1, 58, '2020-05-02 11:51:47'),
(1787, 1, 131, '2020-05-02 11:51:48'),
(1788, 1, 216, '2020-05-02 11:51:54'),
(1789, 1, 213, '2020-05-02 11:51:56'),
(1790, 1, 48, '2020-05-02 11:52:07'),
(1791, 1, 52, '2020-05-02 11:52:09'),
(1792, 1, 44, '2020-05-02 11:52:10'),
(1793, 1, 105, '2020-05-02 11:52:14'),
(1794, 1, 230, '2020-05-02 11:52:18'),
(1795, 1, 338, '2020-05-02 11:52:23'),
(1796, 1, 338, '2020-05-02 11:52:23'),
(1797, 1, 51, '2020-05-03 05:06:36'),
(1798, 1, 341, '2020-05-03 05:09:48'),
(1799, 1, 48, '2020-05-03 09:59:15'),
(1800, 1, 48, '2020-05-03 09:59:18'),
(1801, 1, 341, '2020-05-03 10:56:42'),
(1802, 1, 58, '2020-05-03 11:13:22'),
(1803, 1, 95, '2020-05-03 11:14:48'),
(1804, 1, 95, '2020-05-03 11:16:12'),
(1805, 1, 95, '2020-05-03 11:16:27'),
(1806, 1, 222, '2020-05-04 14:20:28'),
(1807, 1, 222, '2020-05-04 14:56:38'),
(1808, 1, 95, '2020-05-05 01:33:31'),
(1809, 1, 95, '2020-05-05 01:56:10'),
(1810, 1, 58, '2020-05-05 01:56:21'),
(1811, 1, 58, '2020-05-05 01:59:36'),
(1812, 1, 58, '2020-05-05 02:07:47'),
(1813, 1, 58, '2020-05-05 02:07:55'),
(1814, 1, 58, '2020-05-05 02:07:59'),
(1815, 1, 33, '2020-05-05 02:09:39'),
(1816, 1, 95, '2020-05-05 02:18:03'),
(1817, 1, 51, '2020-05-05 02:49:13'),
(1818, 1, 108, '2020-05-05 02:51:54'),
(1819, 1, 226, '2020-05-05 02:53:44'),
(1820, 1, 58, '2020-05-05 05:06:44'),
(1821, 1, 58, '2020-05-05 05:07:01'),
(1822, 1, 58, '2020-05-05 05:07:02'),
(1823, 1, 58, '2020-05-05 05:07:04'),
(1824, 1, 58, '2020-05-05 05:07:05'),
(1825, 1, 58, '2020-05-05 05:07:13'),
(1826, 1, 58, '2020-05-05 05:07:15'),
(1827, 1, 341, '2020-05-05 05:07:44'),
(1828, 1, 33, '2020-05-05 05:10:55'),
(1829, 1, 58, '2020-05-05 05:14:39'),
(1830, 1, 58, '2020-05-05 05:16:49'),
(1831, 1, 58, '2020-05-05 05:16:51'),
(1832, 1, 58, '2020-05-05 05:17:14'),
(1833, 1, 58, '2020-05-05 05:17:34'),
(1834, 1, 58, '2020-05-05 05:18:03'),
(1835, 1, 33, '2020-05-05 05:18:20'),
(1836, 1, 58, '2020-05-05 05:18:39'),
(1837, 1, 33, '2020-05-05 05:19:04'),
(1838, 1, 58, '2020-05-05 05:19:29'),
(1839, 1, 58, '2020-05-05 05:21:14'),
(1840, 1, 95, '2020-05-05 05:24:51'),
(1841, 1, 341, '2020-05-05 05:26:08'),
(1842, 1, 95, '2020-05-05 05:26:17'),
(1843, 1, 220, '2020-05-06 08:20:33'),
(1844, 1, 220, '2020-05-06 08:21:03'),
(1845, 1, 95, '2020-05-06 08:59:28'),
(1846, 1, 95, '2020-05-06 09:03:40'),
(1847, 1, 48, '2020-05-06 09:09:21'),
(1848, 1, 48, '2020-05-06 09:09:29'),
(1849, 1, 48, '2020-05-06 09:09:29'),
(1850, 1, 48, '2020-05-06 09:09:34'),
(1851, 1, 48, '2020-05-06 09:09:34'),
(1852, 1, 48, '2020-05-06 09:09:37'),
(1853, 1, 48, '2020-05-06 09:10:09'),
(1854, 1, 48, '2020-05-06 09:10:11'),
(1855, 1, 48, '2020-05-06 09:10:11'),
(1856, 1, 48, '2020-05-06 09:10:13'),
(1857, 1, 48, '2020-05-06 09:10:13'),
(1858, 1, 48, '2020-05-06 09:10:13'),
(1859, 1, 48, '2020-05-06 09:10:14'),
(1860, 1, 48, '2020-05-06 09:10:18'),
(1861, 1, 48, '2020-05-06 09:10:22'),
(1862, 1, 48, '2020-05-06 09:10:23'),
(1863, 1, 48, '2020-05-06 09:12:43'),
(1864, 1, 22, '2020-05-07 06:16:08'),
(1865, 1, 87, '2020-05-07 06:17:26'),
(1866, 1, 11, '2020-05-07 06:17:33'),
(1867, 1, 87, '2020-05-07 06:20:34'),
(1868, 1, 11, '2020-05-07 06:20:34'),
(1869, 1, 48, '2020-05-07 11:53:38'),
(1870, 1, 48, '2020-05-07 11:54:17'),
(1871, 1, 48, '2020-05-07 11:54:40'),
(1872, 1, 48, '2020-05-07 12:19:11'),
(1873, 1, 22, '2020-05-11 12:33:45'),
(1874, 1, 22, '2020-05-11 12:34:19'),
(1875, 1, 22, '2020-05-11 12:34:31'),
(1876, 1, 21, '2020-05-11 12:36:00'),
(1877, 1, 21, '2020-05-11 13:12:55'),
(1878, 1, 21, '2020-05-11 13:12:57'),
(1879, 1, 21, '2020-05-11 13:13:08'),
(1880, 1, 21, '2020-05-11 13:53:28'),
(1881, 1, 58, '2020-05-11 13:57:01'),
(1882, 1, 58, '2020-05-15 13:17:10'),
(1883, 1, 58, '2020-05-15 13:19:44'),
(1884, 1, 58, '2020-05-15 13:29:20'),
(1885, 1, 58, '2020-05-15 13:41:50'),
(1886, 1, 95, '2020-05-15 14:39:55'),
(1887, 1, 95, '2020-05-15 14:40:21'),
(1888, 1, 95, '2020-05-20 03:56:24'),
(1889, 1, 95, '2020-05-20 04:11:51'),
(1890, 1, 22, '2020-05-23 07:34:19'),
(1891, 1, 87, '2020-05-23 07:37:21'),
(1892, 1, 11, '2020-05-23 07:37:46'),
(1893, 1, 11, '2020-05-23 07:38:20'),
(1894, 1, 88, '2020-05-23 07:39:20'),
(1895, 1, 216, '2020-05-23 07:39:44'),
(1896, 1, 58, '2020-05-23 07:40:02'),
(1897, 1, 58, '2020-05-23 07:40:52'),
(1898, 1, 58, '2020-05-23 07:44:00'),
(1899, 1, 341, '2020-05-23 07:44:27'),
(1900, 1, 341, '2020-05-23 07:45:15'),
(1901, 1, 108, '2020-05-23 07:52:21'),
(1902, 1, 108, '2020-05-23 07:52:48'),
(1903, 1, 48, '2020-05-23 07:59:47'),
(1904, 1, 95, '2020-05-23 08:05:44'),
(1905, 1, 48, '2020-05-23 08:07:45'),
(1906, 1, 58, '2020-06-03 04:38:34'),
(1907, 1, 216, '2020-06-04 16:05:09'),
(1908, 1, 216, '2020-06-04 16:05:28'),
(1909, 1, 132, '2020-06-04 16:06:07'),
(1910, 1, 58, '2020-06-04 16:07:03'),
(1911, 1, 341, '2020-06-04 16:10:26'),
(1912, 1, 341, '2020-06-04 16:10:32'),
(1913, 1, 341, '2020-06-04 16:11:08'),
(1914, 1, 341, '2020-06-04 16:11:18'),
(1915, 1, 213, '2020-06-04 16:11:25'),
(1916, 1, 213, '2020-06-04 16:11:32'),
(1917, 1, 58, '2020-06-04 16:15:14'),
(1918, 1, 58, '2020-06-04 16:18:24'),
(1919, 1, 58, '2020-06-04 16:35:44'),
(1920, 1, 58, '2020-06-04 16:37:41'),
(1921, 1, 95, '2020-06-05 06:48:55'),
(1922, 1, 95, '2020-06-05 06:50:42'),
(1923, 1, 58, '2020-06-05 06:53:05'),
(1924, 1, 58, '2020-06-05 06:54:00'),
(1925, 1, 95, '2020-06-05 06:55:04'),
(1926, 1, 95, '2020-06-06 07:56:03'),
(1927, 1, 95, '2020-06-06 07:56:08'),
(1928, 1, 95, '2020-06-06 07:57:40'),
(1929, 1, 58, '2020-06-06 07:58:29'),
(1930, 1, 341, '2020-06-06 07:58:37'),
(1931, 1, 214, '2020-06-06 08:22:02'),
(1932, 1, 129, '2020-06-08 06:41:16'),
(1933, 1, 129, '2020-06-08 06:41:40'),
(1934, 1, 48, '2020-06-08 06:41:48'),
(1935, 1, 108, '2020-06-08 06:41:56'),
(1936, 1, 58, '2020-06-08 06:42:32'),
(1937, 1, 48, '2020-06-08 06:43:16'),
(1938, 1, 48, '2020-06-08 06:43:20'),
(1939, 1, 48, '2020-06-08 06:44:12'),
(1940, 1, 48, '2020-06-08 06:44:14'),
(1941, 1, 58, '2020-06-08 09:20:08'),
(1942, 1, 129, '2020-06-08 09:31:54'),
(1943, 1, 131, '2020-06-08 09:33:06'),
(1944, 1, 131, '2020-06-08 09:33:47'),
(1945, 1, 131, '2020-06-08 09:33:53'),
(1946, 1, 131, '2020-06-08 09:34:46'),
(1947, 1, 131, '2020-06-08 09:35:04'),
(1948, 1, 129, '2020-06-08 09:35:31'),
(1949, 1, 129, '2020-06-08 09:36:30'),
(1950, 1, 214, '2020-06-08 09:38:06'),
(1951, 1, 214, '2020-06-08 09:38:24'),
(1952, 1, 131, '2020-06-08 10:05:25'),
(1953, 1, 131, '2020-06-08 10:05:49'),
(1954, 1, 129, '2020-06-08 10:06:02'),
(1955, 1, 129, '2020-06-08 10:06:29'),
(1956, 1, 129, '2020-06-08 10:11:36'),
(1957, 1, 129, '2020-06-08 10:13:27'),
(1958, 1, 129, '2020-06-08 10:14:36'),
(1959, 1, 129, '2020-06-08 10:14:43'),
(1960, 1, 108, '2020-06-08 10:31:13'),
(1961, 1, 108, '2020-06-08 10:31:46'),
(1962, 1, 129, '2020-06-08 10:32:22'),
(1963, 1, 129, '2020-06-08 10:32:56'),
(1964, 1, 129, '2020-06-08 10:34:23'),
(1965, 1, 48, '2020-06-08 10:34:34'),
(1966, 1, 231, '2020-06-08 12:33:49'),
(1967, 1, 21, '2020-06-08 12:33:52'),
(1968, 1, 19, '2020-06-08 12:33:53'),
(1969, 1, 20, '2020-06-08 12:33:55'),
(1970, 1, 11, '2020-06-08 12:34:02'),
(1971, 1, 45, '2020-06-08 12:34:03'),
(1972, 1, 198, '2020-06-08 12:34:04'),
(1973, 1, 130, '2020-06-08 12:34:05'),
(1974, 1, 204, '2020-06-08 12:34:06'),
(1975, 1, 204, '2020-06-08 12:34:08'),
(1976, 1, 58, '2020-06-09 08:14:37'),
(1977, 1, 95, '2020-06-10 09:54:23'),
(1978, 1, 48, '2020-06-11 09:12:18'),
(1979, 1, 226, '2020-06-11 09:29:15'),
(1980, 1, 226, '2020-06-11 09:29:24'),
(1981, 1, 226, '2020-06-11 09:29:57'),
(1982, 1, 226, '2020-06-11 09:30:12'),
(1983, 1, 226, '2020-06-11 09:30:40'),
(1984, 1, 226, '2020-06-11 09:31:35'),
(1985, 1, 226, '2020-06-11 09:31:46'),
(1986, 1, 226, '2020-06-11 09:33:12'),
(1987, 1, 226, '2020-06-11 09:33:28'),
(1988, 1, 226, '2020-06-11 09:33:55'),
(1989, 1, 58, '2020-06-11 10:17:46'),
(1990, 1, 226, '2020-06-11 10:18:10'),
(1991, 1, 226, '2020-06-11 10:19:48'),
(1992, 1, 226, '2020-06-11 10:21:04'),
(1993, 1, 226, '2020-06-11 10:22:27'),
(1994, 1, 226, '2020-06-11 10:25:41'),
(1995, 1, 226, '2020-06-11 10:27:32'),
(1996, 1, 226, '2020-06-11 10:27:44'),
(1997, 1, 108, '2020-06-11 10:36:04'),
(1998, 1, 108, '2020-06-11 10:36:31'),
(1999, 1, 48, '2020-06-11 10:41:58'),
(2000, 1, 48, '2020-06-11 10:43:02'),
(2001, 1, 226, '2020-06-11 10:48:27'),
(2002, 1, 226, '2020-06-11 10:50:27'),
(2003, 1, 48, '2020-06-11 10:50:53'),
(2004, 1, 108, '2020-06-11 11:38:30'),
(2005, 1, 48, '2020-06-11 11:39:10'),
(2006, 1, 95, '2020-06-11 11:39:24'),
(2007, 1, 108, '2020-06-11 11:39:47'),
(2008, 1, 108, '2020-06-11 11:39:48'),
(2009, 1, 92, '2020-06-11 11:44:34'),
(2010, 1, 222, '2020-06-11 11:44:49'),
(2011, 1, 222, '2020-06-11 11:44:59'),
(2012, 1, 48, '2020-06-11 11:45:05'),
(2013, 1, 48, '2020-06-11 11:47:05'),
(2014, 1, 92, '2020-06-11 11:48:37'),
(2015, 1, 48, '2020-06-11 11:49:04'),
(2016, 1, 48, '2020-06-11 11:49:46'),
(2017, 1, 92, '2020-06-11 11:51:08'),
(2018, 1, 222, '2020-06-11 11:51:24'),
(2019, 1, 95, '2020-06-11 11:54:38'),
(2020, 1, 129, '2020-06-11 14:14:05'),
(2021, 1, 48, '2020-06-11 14:21:00'),
(2022, 1, 48, '2020-06-11 14:21:03'),
(2023, 1, 48, '2020-06-11 14:21:06'),
(2024, 1, 48, '2020-06-11 14:23:33'),
(2025, 1, 48, '2020-06-11 14:23:36'),
(2026, 1, 108, '2020-06-11 14:23:40'),
(2027, 1, 48, '2020-06-11 14:24:09'),
(2028, 1, 48, '2020-06-11 14:24:14'),
(2029, 1, 48, '2020-06-11 14:26:08'),
(2030, 1, 48, '2020-06-11 14:26:11'),
(2031, 1, 48, '2020-06-11 14:26:27'),
(2032, 1, 48, '2020-06-11 14:26:29'),
(2033, 1, 48, '2020-06-11 14:26:35'),
(2034, 1, 131, '2020-06-11 14:52:07'),
(2035, 1, 48, '2020-06-13 06:02:40'),
(2036, 1, 22, '2020-06-17 09:14:04'),
(2037, 1, 22, '2020-06-17 09:14:57'),
(2038, 1, 22, '2020-06-17 09:15:02'),
(2039, 1, 22, '2020-06-17 09:15:02'),
(2040, 1, 22, '2020-06-17 09:15:03'),
(2041, 1, 22, '2020-06-17 09:15:06'),
(2042, 1, 22, '2020-06-17 09:15:07'),
(2043, 1, 22, '2020-06-17 09:15:38'),
(2044, 1, 22, '2020-06-17 09:15:42'),
(2045, 1, 22, '2020-06-17 09:15:44'),
(2046, 1, 48, '2020-06-17 09:21:14'),
(2047, 1, 22, '2020-06-17 09:21:23'),
(2048, 1, 22, '2020-06-17 09:22:08'),
(2049, 1, 22, '2020-06-17 09:24:04'),
(2050, 1, 33, '2020-06-17 11:14:39'),
(2051, 1, 48, '2020-06-17 11:16:50'),
(2052, 1, 226, '2020-06-17 12:40:31'),
(2053, 1, 226, '2020-06-17 12:41:11'),
(2054, 1, 226, '2020-06-17 12:41:29'),
(2055, 1, 226, '2020-06-17 12:41:38'),
(2056, 1, 226, '2020-06-17 12:41:53'),
(2057, 1, 226, '2020-06-17 12:42:10'),
(2058, 1, 226, '2020-06-17 12:42:25'),
(2059, 1, 226, '2020-06-17 12:51:36'),
(2060, 1, 22, '2020-06-18 07:13:38'),
(2061, 1, 22, '2020-06-18 07:13:42'),
(2062, 1, 22, '2020-06-18 07:13:43'),
(2063, 1, 22, '2020-06-18 07:13:45'),
(2064, 1, 231, '2020-06-18 07:14:02'),
(2065, 1, 231, '2020-06-18 07:14:43'),
(2066, 1, 341, '2020-06-18 07:29:58'),
(2067, 1, 341, '2020-06-18 07:30:22'),
(2068, 1, 48, '2020-06-18 12:05:25'),
(2069, 1, 48, '2020-06-18 12:46:13'),
(2070, 1, 222, '2020-06-18 13:17:09'),
(2071, 1, 48, '2020-06-18 13:50:09'),
(2072, 1, 48, '2020-06-18 14:00:27'),
(2073, 1, 51, '2020-06-18 14:01:44'),
(2074, 1, 51, '2020-06-18 14:02:30'),
(2075, 1, 51, '2020-06-18 14:03:24'),
(2076, 1, 51, '2020-06-18 14:04:11'),
(2077, 1, 51, '2020-06-18 14:05:06'),
(2078, 1, 51, '2020-06-18 14:05:40'),
(2079, 1, 51, '2020-06-18 14:09:18'),
(2080, 1, 51, '2020-06-18 14:09:40'),
(2081, 1, 51, '2020-06-18 14:11:36'),
(2082, 1, 51, '2020-06-18 14:12:36'),
(2083, 1, 341, '2020-06-19 11:33:28'),
(2084, 1, 341, '2020-06-19 11:33:40'),
(2085, 1, 21, '2020-06-20 05:40:36'),
(2086, 1, 22, '2020-06-20 05:40:53'),
(2087, 1, 22, '2020-06-20 10:57:23'),
(2088, 1, 22, '2020-06-20 10:57:27'),
(2089, 1, 48, '2020-06-20 13:01:17'),
(2090, 1, 48, '2020-06-20 13:01:34'),
(2091, 1, 58, '2020-06-20 13:03:59'),
(2092, 1, 105, '2020-06-20 13:04:32'),
(2093, 1, 33, '2020-06-20 13:04:33'),
(2094, 1, 22, '2020-06-20 13:13:00'),
(2095, 1, 48, '2020-06-20 13:13:05'),
(2096, 1, 48, '2020-06-20 13:14:24'),
(2097, 1, 51, '2020-06-20 13:16:12'),
(2098, 1, 222, '2020-06-20 13:18:03'),
(2099, 1, 231, '2020-06-20 13:18:18'),
(2100, 1, 21, '2020-06-20 13:18:19'),
(2101, 1, 48, '2020-06-20 13:18:32'),
(2102, 1, 21, '2020-06-20 13:20:12'),
(2103, 1, 343, '2020-06-20 13:20:19'),
(2104, 1, 21, '2020-06-20 13:20:21'),
(2105, 1, 231, '2020-06-20 13:20:22'),
(2106, 1, 21, '2020-06-20 13:20:23'),
(2107, 1, 343, '2020-06-20 13:20:24'),
(2108, 1, 21, '2020-06-20 13:21:53'),
(2109, 1, 343, '2020-06-20 13:21:54'),
(2110, 1, 341, '2020-06-20 13:28:25'),
(2111, 1, 226, '2020-06-20 13:30:07'),
(2112, 1, 226, '2020-06-20 13:31:24'),
(2113, 1, 341, '2020-06-20 13:36:58'),
(2114, 1, 341, '2020-06-20 13:37:45'),
(2115, 1, 341, '2020-06-20 13:38:09'),
(2116, 1, 341, '2020-06-20 13:40:27'),
(2117, 1, 58, '2020-06-20 13:41:54'),
(2118, 1, 48, '2020-06-20 13:57:54'),
(2119, 1, 48, '2020-06-20 13:57:57'),
(2120, 1, 52, '2020-06-20 17:29:41'),
(2121, 1, 48, '2020-06-21 10:12:04'),
(2122, 1, 48, '2020-06-21 10:12:09'),
(2123, 1, 48, '2020-06-21 10:12:12'),
(2124, 1, 343, '2020-06-21 10:12:15'),
(2125, 1, 11, '2020-06-21 10:12:20'),
(2126, 1, 198, '2020-06-21 10:12:20'),
(2127, 1, 198, '2020-06-21 10:12:26'),
(2128, 1, 48, '2020-06-21 10:14:24'),
(2129, 1, 48, '2020-06-21 10:14:31'),
(2130, 1, 48, '2020-06-21 10:14:34'),
(2131, 1, 33, '2020-06-21 10:42:36'),
(2132, 1, 33, '2020-06-21 10:43:28'),
(2133, 1, 33, '2020-06-21 10:43:28'),
(2134, 1, 44, '2020-06-21 10:43:49'),
(2135, 1, 58, '2020-06-21 10:45:33'),
(2136, 1, 58, '2020-06-21 10:54:10'),
(2137, 1, 58, '2020-06-21 11:02:06'),
(2138, 1, 343, '2020-06-21 11:06:33'),
(2139, 1, 87, '2020-06-21 11:11:54'),
(2140, 1, 11, '2020-06-21 11:11:56'),
(2141, 1, 87, '2020-06-21 11:11:58'),
(2142, 1, 11, '2020-06-21 11:12:02'),
(2143, 1, 45, '2020-06-21 11:12:04'),
(2144, 1, 45, '2020-06-21 11:12:07'),
(2145, 1, 87, '2020-06-21 11:12:15'),
(2146, 1, 87, '2020-06-21 11:15:44'),
(2147, 1, 22, '2020-06-21 11:16:15'),
(2148, 1, 22, '2020-06-21 11:16:39'),
(2149, 1, 341, '2020-06-21 11:25:59'),
(2150, 1, 341, '2020-06-21 11:27:27'),
(2151, 1, 341, '2020-06-21 11:28:33'),
(2152, 1, 341, '2020-06-21 11:28:33'),
(2153, 1, 341, '2020-06-21 11:28:33'),
(2154, 1, 341, '2020-06-21 11:33:23'),
(2155, 1, 341, '2020-06-21 11:35:00'),
(2156, 1, 48, '2020-06-21 12:33:29'),
(2157, 1, 48, '2020-06-22 11:16:45'),
(2158, 1, 48, '2020-06-22 11:53:36'),
(2159, 1, 226, '2020-06-22 13:01:40'),
(2160, 1, 22, '2020-06-23 11:09:16'),
(2161, 1, 22, '2020-06-23 11:09:59'),
(2162, 1, 22, '2020-06-23 12:18:29'),
(2163, 1, 48, '2020-06-25 08:48:00'),
(2164, 1, 58, '2020-06-25 13:11:15'),
(2165, 1, 58, '2020-06-25 13:11:33'),
(2166, 1, 213, '2020-06-25 13:13:41'),
(2167, 1, 58, '2020-06-25 13:13:54'),
(2168, 1, 58, '2020-06-25 14:00:11'),
(2169, 1, 231, '2020-06-26 02:41:51'),
(2170, 1, 22, '2020-06-26 02:44:39'),
(2171, 1, 22, '2020-06-26 02:49:22'),
(2172, 1, 22, '2020-06-26 02:49:24'),
(2173, 1, 22, '2020-06-26 02:49:26'),
(2174, 1, 22, '2020-06-26 02:49:44'),
(2175, 1, 22, '2020-06-26 02:49:51'),
(2176, 1, 22, '2020-06-26 02:50:07'),
(2177, 1, 58, '2020-06-26 02:53:14'),
(2178, 1, 33, '2020-06-26 02:58:30'),
(2179, 1, 33, '2020-06-26 02:58:55'),
(2180, 1, 33, '2020-06-26 02:59:18'),
(2181, 1, 22, '2020-06-26 03:04:02'),
(2182, 1, 87, '2020-06-26 03:04:08'),
(2183, 1, 87, '2020-06-26 03:05:23'),
(2184, 1, 87, '2020-06-26 03:05:35'),
(2185, 1, 87, '2020-06-26 03:05:49'),
(2186, 1, 87, '2020-06-26 03:07:21'),
(2187, 1, 343, '2020-06-26 03:11:43'),
(2188, 1, 48, '2020-06-26 05:02:52'),
(2189, 1, 58, '2020-06-26 05:29:55'),
(2190, 1, 58, '2020-06-26 05:31:43'),
(2191, 1, 58, '2020-06-26 05:32:02'),
(2192, 1, 213, '2020-06-26 05:32:05'),
(2193, 1, 213, '2020-06-26 05:32:38'),
(2194, 1, 213, '2020-06-26 05:33:05'),
(2195, 1, 226, '2020-06-26 06:32:08'),
(2196, 1, 58, '2020-06-26 12:09:37'),
(2197, 1, 213, '2020-06-26 12:09:57'),
(2198, 1, 58, '2020-06-27 05:06:27'),
(2199, 1, 58, '2020-06-27 05:06:54'),
(2200, 1, 58, '2020-06-27 05:08:21'),
(2201, 1, 58, '2020-06-27 05:12:14'),
(2202, 1, 58, '2020-06-27 05:12:27'),
(2203, 1, 58, '2020-06-27 05:12:54'),
(2204, 1, 58, '2020-06-27 05:13:50'),
(2205, 1, 213, '2020-06-27 05:27:30'),
(2206, 1, 58, '2020-06-27 05:27:46'),
(2207, 1, 58, '2020-06-27 05:29:15'),
(2208, 1, 58, '2020-06-27 05:35:00'),
(2209, 1, 58, '2020-06-27 05:35:46'),
(2210, 1, 58, '2020-06-27 05:35:54'),
(2211, 1, 92, '2020-06-27 06:26:34'),
(2212, 1, 92, '2020-06-27 06:28:27'),
(2213, 1, 92, '2020-06-27 06:28:37'),
(2214, 1, 222, '2020-06-27 07:42:25'),
(2215, 9, 48, '2020-06-27 07:44:55'),
(2216, 9, 48, '2020-06-27 07:45:18'),
(2217, 9, 48, '2020-06-27 07:45:24'),
(2218, 9, 48, '2020-06-27 07:45:25'),
(2219, 9, 48, '2020-06-27 07:45:25'),
(2220, 9, 194, '2020-06-27 07:46:37'),
(2221, 9, 194, '2020-06-27 07:47:02'),
(2222, 9, 194, '2020-06-27 07:47:06'),
(2223, 9, 194, '2020-06-27 07:47:14'),
(2224, 1, 58, '2020-06-27 09:19:39'),
(2225, 1, 213, '2020-06-27 09:22:50'),
(2226, 1, 213, '2020-06-27 09:22:55'),
(2227, 1, 213, '2020-06-27 09:27:25'),
(2228, 1, 58, '2020-06-27 09:37:40'),
(2229, 1, 22, '2020-06-27 09:52:04'),
(2230, 1, 22, '2020-06-27 09:53:21'),
(2231, 1, 58, '2020-06-27 09:57:29'),
(2232, 1, 45, '2020-06-27 11:14:30'),
(2233, 1, 45, '2020-06-27 11:15:48'),
(2234, 1, 58, '2020-06-27 11:55:43'),
(2235, 1, 22, '2020-06-27 12:26:56'),
(2236, 1, 230, '2020-06-27 12:29:56'),
(2237, 1, 22, '2020-06-27 13:10:12'),
(2238, 1, 22, '2020-06-27 13:10:32'),
(2239, 1, 231, '2020-06-27 13:11:02'),
(2240, 1, 22, '2020-06-27 13:11:51'),
(2241, 1, 338, '2020-06-29 05:28:14'),
(2242, 1, 338, '2020-06-29 05:28:14'),
(2243, 1, 92, '2020-07-01 10:16:27'),
(2244, 1, 343, '2020-07-01 10:16:42'),
(2245, 1, 343, '2020-07-01 10:17:22'),
(2246, 1, 343, '2020-07-01 10:19:50'),
(2247, 1, 343, '2020-07-01 10:21:09'),
(2248, 1, 343, '2020-07-01 10:21:42'),
(2249, 1, 343, '2020-07-01 10:22:26'),
(2250, 1, 343, '2020-07-01 10:23:02'),
(2251, 1, 343, '2020-07-01 10:23:44'),
(2252, 1, 343, '2020-07-01 10:26:26'),
(2253, 1, 343, '2020-07-01 10:26:29'),
(2254, 1, 343, '2020-07-01 10:27:41'),
(2255, 1, 343, '2020-07-01 10:27:59'),
(2256, 1, 92, '2020-07-01 10:40:30'),
(2257, 1, 92, '2020-07-01 10:42:00'),
(2258, 1, 92, '2020-07-01 11:47:26'),
(2259, 1, 129, '2020-07-02 02:26:58'),
(2260, 1, 129, '2020-07-02 02:27:22'),
(2261, 1, 129, '2020-07-02 02:27:38'),
(2262, 1, 129, '2020-07-02 02:27:56'),
(2263, 1, 216, '2020-07-02 08:27:35'),
(2264, 1, 58, '2020-07-02 08:28:07'),
(2265, 1, 226, '2020-07-02 08:32:42'),
(2266, 1, 226, '2020-07-02 08:33:12'),
(2267, 1, 226, '2020-07-02 08:34:01'),
(2268, 1, 226, '2020-07-02 08:34:47'),
(2269, 1, 226, '2020-07-02 08:35:05'),
(2270, 1, 129, '2020-07-03 05:08:14'),
(2271, 1, 129, '2020-07-03 05:08:44'),
(2272, 1, 129, '2020-07-03 05:09:09'),
(2273, 1, 129, '2020-07-03 05:26:14'),
(2274, 1, 129, '2020-07-03 05:26:27'),
(2275, 1, 129, '2020-07-03 05:26:36'),
(2276, 1, 58, '2020-07-03 11:03:28'),
(2277, 1, 348, '2020-07-03 11:06:44'),
(2278, 1, 222, '2020-07-03 11:13:11'),
(2279, 1, 222, '2020-07-03 11:13:21'),
(2280, 1, 231, '2020-07-03 12:15:19'),
(2281, 1, 92, '2020-07-03 14:19:04'),
(2282, 1, 92, '2020-07-03 14:25:38'),
(2283, 1, 58, '2020-07-04 03:23:59'),
(2284, 1, 108, '2020-07-04 04:07:17'),
(2285, 1, 108, '2020-07-04 04:07:29'),
(2286, 1, 48, '2020-07-04 04:07:35'),
(2287, 1, 108, '2020-07-04 04:08:10'),
(2288, 1, 108, '2020-07-04 04:08:25'),
(2289, 9, 44, '2020-07-04 04:42:54'),
(2290, 1, 108, '2020-07-04 04:44:01'),
(2291, 1, 222, '2020-07-04 04:44:26'),
(2292, 1, 222, '2020-07-04 04:45:25'),
(2293, 9, 44, '2020-07-04 04:45:59'),
(2294, 9, 44, '2020-07-04 04:50:06'),
(2295, 9, 44, '2020-07-04 04:50:16'),
(2296, 1, 92, '2020-07-05 07:20:04'),
(2297, 1, 92, '2020-07-05 07:41:34'),
(2298, 1, 92, '2020-07-05 07:42:00'),
(2299, 1, 45, '2020-07-05 07:55:42'),
(2300, 1, 45, '2020-07-05 07:56:02'),
(2301, 1, 58, '2020-07-05 13:58:33'),
(2302, 1, 343, '2020-07-05 14:35:52'),
(2303, 1, 343, '2020-07-05 14:36:13'),
(2304, 1, 226, '2020-07-05 14:47:50'),
(2305, 1, 108, '2020-07-06 04:56:52'),
(2306, 1, 108, '2020-07-06 04:57:23'),
(2307, 1, 51, '2020-07-06 04:59:17'),
(2308, 1, 51, '2020-07-06 05:00:00'),
(2309, 1, 48, '2020-07-06 06:01:41'),
(2310, 1, 48, '2020-07-06 06:01:59'),
(2311, 1, 48, '2020-07-06 06:02:12'),
(2312, 1, 48, '2020-07-06 06:02:22'),
(2313, 1, 52, '2020-07-06 06:05:52'),
(2314, 1, 52, '2020-07-06 06:08:36'),
(2315, 1, 52, '2020-07-06 06:09:03'),
(2316, 1, 52, '2020-07-06 06:09:06'),
(2317, 1, 58, '2020-07-06 07:13:41'),
(2318, 1, 341, '2020-07-06 07:14:00'),
(2319, 1, 58, '2020-07-06 07:14:19'),
(2320, 1, 341, '2020-07-06 07:14:36'),
(2321, 1, 48, '2020-07-06 07:15:33'),
(2322, 1, 58, '2020-07-06 07:16:33'),
(2323, 1, 22, '2020-07-06 07:17:25'),
(2324, 1, 22, '2020-07-06 07:17:30'),
(2325, 1, 22, '2020-07-06 07:17:31'),
(2326, 1, 22, '2020-07-06 07:17:32'),
(2327, 1, 58, '2020-07-06 07:23:48'),
(2328, 1, 48, '2020-07-06 09:39:11'),
(2329, 1, 48, '2020-07-06 10:01:15'),
(2330, 1, 343, '2020-07-06 10:01:48'),
(2331, 1, 343, '2020-07-06 10:02:08'),
(2332, 1, 343, '2020-07-06 10:02:38'),
(2333, 1, 343, '2020-07-06 10:03:03'),
(2334, 1, 343, '2020-07-06 10:03:11'),
(2335, 1, 230, '2020-07-08 10:00:10'),
(2336, 1, 22, '2020-07-08 10:01:07'),
(2337, 1, 339, '2020-07-08 10:12:43'),
(2338, 1, 339, '2020-07-08 10:13:06'),
(2339, 1, 334, '2020-07-08 10:13:12'),
(2340, 1, 334, '2020-07-08 10:13:43'),
(2341, 1, 333, '2020-07-08 10:13:48'),
(2342, 1, 333, '2020-07-08 10:14:35'),
(2343, 1, 48, '2020-07-08 10:21:39'),
(2344, 1, 48, '2020-07-08 10:21:46'),
(2345, 1, 48, '2020-07-08 10:21:47'),
(2346, 1, 48, '2020-07-08 10:21:52'),
(2347, 1, 48, '2020-07-08 10:22:11'),
(2348, 1, 48, '2020-07-08 10:22:12'),
(2349, 1, 48, '2020-07-08 10:22:57'),
(2350, 1, 48, '2020-07-08 10:25:10'),
(2351, 1, 22, '2020-07-08 11:56:29'),
(2352, 1, 22, '2020-07-08 11:56:34'),
(2353, 1, 22, '2020-07-08 11:56:34'),
(2354, 1, 58, '2020-07-08 12:08:00'),
(2355, 1, 22, '2020-07-08 12:11:05'),
(2356, 1, 22, '2020-07-08 12:11:09'),
(2357, 1, 22, '2020-07-08 12:11:10'),
(2358, 1, 22, '2020-07-08 12:11:12'),
(2359, 1, 22, '2020-07-08 12:11:12'),
(2360, 1, 22, '2020-07-08 12:11:13'),
(2361, 1, 22, '2020-07-08 12:11:13'),
(2362, 1, 52, '2020-07-09 05:01:46'),
(2363, 1, 48, '2020-07-09 05:51:54'),
(2364, 1, 52, '2020-07-09 05:51:59'),
(2365, 1, 44, '2020-07-09 05:53:19'),
(2366, 1, 52, '2020-07-09 05:53:29'),
(2367, 1, 33, '2020-07-09 05:53:37'),
(2368, 1, 105, '2020-07-09 05:53:41'),
(2369, 1, 52, '2020-07-09 06:15:04'),
(2370, 1, 52, '2020-07-09 06:16:07'),
(2371, 1, 52, '2020-07-09 06:16:38'),
(2372, 1, 44, '2020-07-09 06:21:40'),
(2373, 1, 44, '2020-07-09 06:22:05'),
(2374, 1, 52, '2020-07-09 06:22:10'),
(2375, 1, 52, '2020-07-09 06:23:07'),
(2376, 1, 44, '2020-07-09 06:23:14'),
(2377, 1, 52, '2020-07-09 06:24:37'),
(2378, 1, 92, '2020-07-09 08:15:21'),
(2379, 1, 92, '2020-07-09 08:22:15'),
(2380, 1, 92, '2020-07-09 08:22:35'),
(2381, 1, 92, '2020-07-09 08:22:48'),
(2382, 1, 92, '2020-07-09 08:22:53'),
(2383, 1, 92, '2020-07-09 08:22:56'),
(2384, 1, 92, '2020-07-09 08:38:50'),
(2385, 1, 92, '2020-07-09 08:40:01'),
(2386, 1, 92, '2020-07-09 08:40:07'),
(2387, 1, 92, '2020-07-09 08:40:34'),
(2388, 1, 92, '2020-07-09 08:40:41'),
(2389, 1, 92, '2020-07-09 08:40:45'),
(2390, 1, 92, '2020-07-09 08:40:50'),
(2391, 1, 92, '2020-07-09 09:32:47'),
(2392, 1, 92, '2020-07-09 09:33:05'),
(2393, 1, 92, '2020-07-09 09:33:14'),
(2394, 1, 222, '2020-07-09 09:35:21'),
(2395, 1, 92, '2020-07-09 09:35:52'),
(2396, 1, 92, '2020-07-09 09:35:57'),
(2397, 1, 92, '2020-07-09 09:36:00'),
(2398, 1, 92, '2020-07-09 09:36:04'),
(2399, 1, 92, '2020-07-09 09:37:04'),
(2400, 1, 92, '2020-07-09 09:37:58'),
(2401, 1, 92, '2020-07-09 09:38:57'),
(2402, 1, 92, '2020-07-09 09:40:33'),
(2403, 1, 222, '2020-07-09 09:40:49'),
(2404, 1, 222, '2020-07-09 09:42:22'),
(2405, 1, 222, '2020-07-09 09:43:33'),
(2406, 1, 222, '2020-07-09 09:43:41'),
(2407, 1, 222, '2020-07-09 09:43:44'),
(2408, 1, 222, '2020-07-09 09:44:18'),
(2409, 1, 222, '2020-07-09 09:44:45'),
(2410, 1, 222, '2020-07-09 09:45:15'),
(2411, 1, 58, '2020-07-09 09:47:37'),
(2412, 1, 58, '2020-07-09 09:48:55'),
(2413, 1, 48, '2020-07-09 11:15:45'),
(2414, 1, 22, '2020-07-09 12:19:01'),
(2415, 1, 22, '2020-07-09 12:19:04'),
(2416, 1, 22, '2020-07-09 12:19:04'),
(2417, 1, 22, '2020-07-09 12:20:20'),
(2418, 1, 92, '2020-07-09 12:21:27'),
(2419, 1, 22, '2020-07-09 12:34:24'),
(2420, 1, 341, '2020-07-09 16:04:41'),
(2421, 1, 22, '2020-07-10 10:52:59'),
(2422, 1, 19, '2020-07-10 10:53:01'),
(2423, 1, 20, '2020-07-10 10:53:03'),
(2424, 1, 48, '2020-07-10 10:53:15'),
(2425, 1, 22, '2020-07-12 04:46:13'),
(2426, 1, 22, '2020-07-12 05:04:25'),
(2427, 1, 22, '2020-07-12 05:04:26'),
(2428, 1, 22, '2020-07-12 05:04:27'),
(2429, 1, 19, '2020-07-12 05:09:28'),
(2430, 1, 22, '2020-07-12 05:09:31'),
(2431, 1, 22, '2020-07-12 05:10:12'),
(2432, 1, 22, '2020-07-12 05:10:27'),
(2433, 1, 11, '2020-07-12 05:19:33'),
(2434, 1, 45, '2020-07-12 05:22:31'),
(2435, 1, 87, '2020-07-12 11:21:55'),
(2436, 1, 131, '2020-07-12 11:22:55'),
(2437, 1, 131, '2020-07-12 11:23:28'),
(2438, 1, 131, '2020-07-12 11:23:57'),
(2439, 1, 131, '2020-07-12 11:24:28'),
(2440, 1, 131, '2020-07-12 11:24:51'),
(2441, 1, 343, '2020-07-12 11:26:51'),
(2442, 1, 343, '2020-07-12 11:26:59'),
(2443, 1, 343, '2020-07-12 11:27:05'),
(2444, 1, 343, '2020-07-12 11:27:26'),
(2445, 1, 343, '2020-07-12 11:32:39'),
(2446, 1, 343, '2020-07-12 11:38:12'),
(2447, 1, 343, '2020-07-12 11:38:35'),
(2448, 1, 58, '2020-07-12 11:38:52'),
(2449, 1, 216, '2020-07-12 11:41:43'),
(2450, 1, 58, '2020-07-12 11:44:20'),
(2451, 1, 58, '2020-07-12 11:50:54'),
(2452, 1, 58, '2020-07-12 11:51:51'),
(2453, 1, 58, '2020-07-12 11:52:47'),
(2454, 1, 58, '2020-07-12 11:53:15'),
(2455, 1, 58, '2020-07-12 11:53:38'),
(2456, 1, 58, '2020-07-12 11:54:07'),
(2457, 1, 58, '2020-07-12 11:54:14'),
(2458, 1, 58, '2020-07-12 11:54:39'),
(2459, 1, 213, '2020-07-12 11:55:54'),
(2460, 1, 58, '2020-07-12 12:15:03'),
(2461, 1, 33, '2020-07-12 13:09:03'),
(2462, 1, 33, '2020-07-12 13:10:00'),
(2463, 1, 33, '2020-07-12 13:11:25'),
(2464, 1, 33, '2020-07-12 13:11:52'),
(2465, 1, 33, '2020-07-12 13:18:53'),
(2466, 1, 22, '2020-07-12 13:20:52'),
(2467, 1, 22, '2020-07-12 13:21:02'),
(2468, 1, 22, '2020-07-12 13:39:38'),
(2469, 1, 22, '2020-07-12 13:39:44'),
(2470, 1, 58, '2020-07-13 06:31:39'),
(2471, 1, 129, '2020-07-13 06:38:38'),
(2472, 1, 129, '2020-07-13 06:38:54'),
(2473, 1, 22, '2020-07-13 07:44:23'),
(2474, 1, 22, '2020-07-13 07:44:26'),
(2475, 1, 48, '2020-07-13 12:12:25'),
(2476, 1, 22, '2020-07-14 15:10:09'),
(2477, 1, 22, '2020-07-14 15:10:14'),
(2478, 1, 92, '2020-07-15 07:34:41'),
(2479, 1, 92, '2020-07-15 07:34:56'),
(2480, 1, 92, '2020-07-15 07:35:04'),
(2481, 1, 92, '2020-07-15 07:35:16'),
(2482, 1, 92, '2020-07-15 07:35:26'),
(2483, 1, 58, '2020-07-15 11:05:39'),
(2484, 1, 58, '2020-07-17 04:55:07'),
(2485, 1, 92, '2020-07-17 05:36:58'),
(2486, 1, 58, '2020-07-17 05:37:57'),
(2487, 1, 58, '2020-07-17 05:41:41'),
(2488, 1, 92, '2020-07-17 06:02:05'),
(2489, 1, 92, '2020-07-17 06:35:35'),
(2490, 1, 92, '2020-07-17 06:36:09'),
(2491, 1, 92, '2020-07-17 13:13:34'),
(2492, 1, 92, '2020-07-17 13:14:16'),
(2493, 1, 222, '2020-07-17 13:14:24'),
(2494, 1, 222, '2020-07-17 13:15:26'),
(2495, 15, 108, '2020-07-17 13:35:44'),
(2496, 15, 226, '2020-07-17 13:35:55'),
(2497, 1, 22, '2020-07-18 02:45:26'),
(2498, 1, 231, '2020-07-18 03:17:03'),
(2499, 1, 22, '2020-07-18 03:19:17'),
(2500, 1, 92, '2020-07-18 03:40:02'),
(2501, 1, 92, '2020-07-18 03:40:17'),
(2502, 1, 92, '2020-07-18 03:40:32'),
(2503, 1, 92, '2020-07-18 03:40:43'),
(2504, 1, 92, '2020-07-18 03:41:08'),
(2505, 1, 338, '2020-07-18 05:38:39'),
(2506, 1, 338, '2020-07-18 05:38:39'),
(2507, 1, 338, '2020-07-18 05:42:39'),
(2508, 1, 338, '2020-07-18 05:42:39'),
(2509, 1, 338, '2020-07-18 05:43:04'),
(2510, 1, 338, '2020-07-18 05:43:04'),
(2511, 1, 338, '2020-07-18 05:43:19'),
(2512, 1, 338, '2020-07-18 05:43:19'),
(2513, 1, 338, '2020-07-18 05:44:00'),
(2514, 1, 338, '2020-07-18 05:44:01'),
(2515, 1, 326, '2020-07-18 07:23:38'),
(2516, 1, 326, '2020-07-18 07:23:39'),
(2517, 1, 326, '2020-07-18 07:23:40'),
(2518, 1, 231, '2020-08-17 09:55:55'),
(2519, 1, 231, '2020-08-17 09:55:59'),
(2520, 1, 231, '2020-08-17 09:56:12'),
(2521, 1, 22, '2020-08-17 09:57:08'),
(2522, 1, 343, '2020-08-17 09:57:14'),
(2523, 1, 87, '2020-08-17 09:57:38'),
(2524, 1, 11, '2020-08-17 09:57:41'),
(2525, 1, 11, '2020-08-17 09:57:46'),
(2526, 1, 11, '2020-08-17 09:58:51'),
(2527, 1, 45, '2020-08-17 09:58:53'),
(2528, 1, 45, '2020-08-17 09:58:57'),
(2529, 1, 45, '2020-08-17 09:59:00'),
(2530, 1, 198, '2020-08-17 09:59:02'),
(2531, 1, 130, '2020-08-17 09:59:04'),
(2532, 1, 130, '2020-08-17 10:00:04'),
(2533, 1, 130, '2020-08-17 10:00:24'),
(2534, 1, 210, '2020-08-17 10:00:30'),
(2535, 1, 220, '2020-08-17 10:00:32'),
(2536, 1, 204, '2020-08-17 10:00:34'),
(2537, 1, 204, '2020-08-17 10:00:37'),
(2538, 1, 204, '2020-08-17 10:00:40'),
(2539, 1, 348, '2020-08-17 10:02:42'),
(2540, 1, 58, '2020-08-17 10:02:43'),
(2541, 1, 131, '2020-08-17 10:02:45'),
(2542, 1, 131, '2020-08-17 10:02:54'),
(2543, 1, 131, '2020-08-17 10:02:58'),
(2544, 1, 131, '2020-08-17 10:03:02'),
(2545, 1, 88, '2020-08-17 10:03:07'),
(2546, 1, 88, '2020-08-17 10:03:10'),
(2547, 1, 88, '2020-08-17 10:03:16'),
(2548, 1, 88, '2020-08-17 10:03:18'),
(2549, 1, 216, '2020-08-17 10:04:06'),
(2550, 1, 216, '2020-08-17 10:05:53'),
(2551, 1, 216, '2020-08-17 10:06:35'),
(2552, 1, 213, '2020-08-17 10:06:36'),
(2553, 1, 51, '2020-08-17 10:06:44'),
(2554, 1, 51, '2020-08-17 10:06:55'),
(2555, 1, 48, '2020-08-17 10:07:10'),
(2556, 1, 108, '2020-08-17 10:07:17'),
(2557, 1, 108, '2020-08-17 10:07:25'),
(2558, 1, 231, '2020-08-17 10:07:42'),
(2559, 1, 231, '2020-08-17 10:08:19'),
(2560, 1, 108, '2020-08-17 10:08:27'),
(2561, 1, 108, '2020-08-17 10:08:40'),
(2562, 1, 108, '2020-08-17 10:08:56'),
(2563, 1, 108, '2020-08-17 10:09:02'),
(2564, 1, 108, '2020-08-17 10:09:16'),
(2565, 1, 108, '2020-08-17 10:09:29'),
(2566, 1, 108, '2020-08-17 10:09:34'),
(2567, 1, 108, '2020-08-17 10:09:48'),
(2568, 1, 108, '2020-08-17 10:10:04'),
(2569, 1, 108, '2020-08-17 10:10:07'),
(2570, 1, 108, '2020-08-17 10:10:20'),
(2571, 1, 51, '2020-08-17 10:11:18'),
(2572, 1, 51, '2020-08-17 10:11:28'),
(2573, 1, 92, '2020-08-17 10:14:22'),
(2574, 1, 92, '2020-08-17 10:14:28'),
(2575, 1, 92, '2020-08-17 10:14:31'),
(2576, 1, 92, '2020-08-17 10:14:34'),
(2577, 1, 92, '2020-08-17 10:14:37'),
(2578, 1, 92, '2020-08-17 10:15:27'),
(2579, 1, 92, '2020-08-17 10:15:45'),
(2580, 1, 108, '2020-08-20 05:41:34'),
(2581, 1, 19, '2020-08-20 05:42:39'),
(2582, 1, 22, '2020-08-20 05:42:45'),
(2583, 1, 22, '2020-08-20 05:42:48'),
(2584, 1, 22, '2020-08-20 05:42:51'),
(2585, 1, 48, '2020-08-20 05:48:25'),
(2586, 1, 231, '2020-08-20 05:51:31'),
(2587, 1, 21, '2020-08-20 05:51:35'),
(2588, 1, 22, '2020-08-20 05:51:36'),
(2589, 1, 19, '2020-08-20 05:51:37'),
(2590, 1, 20, '2020-08-20 05:51:38'),
(2591, 1, 341, '2020-08-20 05:51:42'),
(2592, 1, 348, '2020-08-20 05:51:43'),
(2593, 1, 58, '2020-08-20 05:51:45'),
(2594, 1, 131, '2020-08-20 05:51:45'),
(2595, 1, 88, '2020-08-20 05:51:45'),
(2596, 1, 216, '2020-08-20 05:51:51'),
(2597, 1, 216, '2020-08-20 05:51:54'),
(2598, 1, 132, '2020-08-20 05:51:56'),
(2599, 1, 48, '2020-08-29 11:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `usr_loc_id` int(11) NOT NULL,
  `devid` varchar(100) NOT NULL,
  `usr_loc_user` int(11) NOT NULL,
  `usr_loc_longitude` varchar(100) NOT NULL,
  `usr_loc_latitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `uset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `edit_sale_rate` tinyint(1) NOT NULL DEFAULT '1',
  `user_default_godown` int(11) NOT NULL,
  `user_default_billtype` int(11) NOT NULL,
  `user_default_printtype` int(11) NOT NULL,
  `user_default_printer` int(11) NOT NULL,
  `user_default_analytics` int(11) NOT NULL,
  `user_default_costcenter` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `default_purchase_billtype` int(11) NOT NULL,
  `user_is_margin` int(11) NOT NULL,
  `default_sorder_billtype` int(11) NOT NULL,
  `default_sreturn_billtype` int(11) NOT NULL,
  `default_porder_billtype` int(11) NOT NULL,
  `default_preturn_billtype` int(11) NOT NULL,
  `default_rec_billtype` int(11) NOT NULL,
  `default_pay_billtype` int(11) NOT NULL,
  `default_del_note_billtype` int(11) NOT NULL,
  `user_default_dashboard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`uset_id`, `user_id`, `edit_sale_rate`, `user_default_godown`, `user_default_billtype`, `user_default_printtype`, `user_default_printer`, `user_default_analytics`, `user_default_costcenter`, `updatedate`, `default_purchase_billtype`, `user_is_margin`, `default_sorder_billtype`, `default_sreturn_billtype`, `default_porder_billtype`, `default_preturn_billtype`, `default_rec_billtype`, `default_pay_billtype`, `default_del_note_billtype`, `user_default_dashboard`) VALUES
(2, 1, 1, 1, 2, 1, 1, 1, 1, '2021-07-06 13:31:59', 1, 1, 4, 5, 3, 6, 0, 0, 0, 0),
(4, 14, 1, 1, 2, 1, 1, 1, 1, '2020-07-09 09:42:25', 1, 0, 4, 5, 3, 6, 0, 0, 0, 0),
(5, 11, 1, 1, 2, 1, 1, 1, 1, '2020-07-09 09:43:47', 1, 0, 4, 5, 3, 6, 0, 0, 0, 0),
(6, 13, 1, 1, 2, 1, 1, 1, 1, '2020-07-09 09:44:20', 1, 0, 4, 5, 3, 6, 0, 0, 0, 0),
(7, 12, 1, 1, 2, 1, 1, 1, 1, '2020-07-09 09:44:49', 1, 0, 4, 5, 3, 6, 0, 0, 0, 0),
(8, 15, 1, 1, 2, 1, 1, 1, 1, '2020-07-17 01:14:26', 1, 0, 4, 5, 3, 6, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `dash` varchar(30) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `dash`, `updatedate`) VALUES
(1, 'Admin', 'admin', '2018-01-28 10:51:35'),
(2, 'General', 'admin', '2018-01-28 10:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `veh_no` text,
  `veh_name` text,
  `veh_brand` varchar(100) DEFAULT NULL,
  `veh_model` varchar(100) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `veh_no`, `veh_name`, `veh_brand`, `veh_model`, `cus_id`) VALUES
(9, 'nos', 'names', 'brnds', 'models', 1),
(10, ' kL 10 H3030', 'bus', 'ok', 'ash', 1),
(11, 'KL 9 MH 1245 ', 'grand', 'Enfield', 'Bullet', 1),
(12, 'KL13', 'goinn', 'bMW', 'S12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `veh_details`
--

CREATE TABLE `veh_details` (
  `id` int(11) NOT NULL,
  `veh_id` int(11) NOT NULL,
  `veh_number` varchar(100) NOT NULL,
  `veh_type` varchar(100) NOT NULL,
  `veh_engine` varchar(100) NOT NULL,
  `veh_regdate` date NOT NULL,
  `veh_expdate` date NOT NULL,
  `periodial_date` date NOT NULL,
  `periodical_exp_date` date NOT NULL,
  `insurance_date` date NOT NULL,
  `insurance_exp_date` date NOT NULL,
  `battery_date` date NOT NULL,
  `battery_exp_date` date NOT NULL,
  `tyre_date` date NOT NULL,
  `tyre_exp_date` date NOT NULL,
  `start_km` decimal(10,0) NOT NULL,
  `end_km` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veh_drivers`
--

CREATE TABLE `veh_drivers` (
  `id` int(11) NOT NULL,
  `veh_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `daily_Km` decimal(10,2) NOT NULL,
  `incentive_km` decimal(10,2) NOT NULL,
  `driver_start_date` date NOT NULL,
  `driver_end_date` date NOT NULL,
  `driver_isactive` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veh_insurance`
--

CREATE TABLE `veh_insurance` (
  `id` int(11) NOT NULL,
  `veh_id` int(11) NOT NULL,
  `insurance_company` varchar(100) NOT NULL,
  `veh_start_date` date NOT NULL,
  `veh_end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veh_insurance_company`
--

CREATE TABLE `veh_insurance_company` (
  `id` int(11) NOT NULL,
  `comp_name` varchar(100) NOT NULL,
  `comp_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veh_manufacture`
--

CREATE TABLE `veh_manufacture` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veh_trip`
--

CREATE TABLE `veh_trip` (
  `id` int(11) NOT NULL,
  `invoice` varchar(500) NOT NULL,
  `bill_type` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `trip_from` varchar(1000) NOT NULL DEFAULT 'trip_from',
  `trip_to` varchar(1000) NOT NULL DEFAULT 'trip_to',
  `pay_type` enum('Cash','Credit') NOT NULL,
  `branch` int(11) NOT NULL,
  `Costcenter` int(11) NOT NULL,
  `trip_startdate` date NOT NULL,
  `trip_enddate` date NOT NULL,
  `trip_startkm` varchar(500) NOT NULL,
  `trip_endkm` varchar(500) NOT NULL,
  `trip_vehicle` varchar(500) NOT NULL,
  `trip_driver` varchar(500) NOT NULL,
  `trip_customer` varchar(500) NOT NULL,
  `trip_description` varchar(500) NOT NULL,
  `trip_fare` varchar(500) NOT NULL,
  `trip_tax` varchar(500) NOT NULL,
  `trip_taxamt` decimal(10,2) NOT NULL,
  `trip_othercharges` varchar(500) NOT NULL,
  `trip_totalkm` varchar(500) NOT NULL,
  `trip_total` varchar(500) NOT NULL,
  `trip_lastupdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(100) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `sales_ref_id` int(11) NOT NULL DEFAULT '0',
  `naration` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_autoCheck` int(11) NOT NULL DEFAULT '0',
  `trans_date` date NOT NULL,
  `vourcher_type` enum('payment','receipt','journal','contra') COLLATE utf8_unicode_ci NOT NULL,
  `contra_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bill_type` int(11) NOT NULL,
  `ledger` int(11) NOT NULL DEFAULT '1',
  `open_bal` decimal(10,2) NOT NULL,
  `open_paid` decimal(10,2) NOT NULL,
  `reference` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'reference',
  `created_by` int(100) DEFAULT NULL,
  `salesman` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `approved_by` int(100) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `del_by` int(100) DEFAULT NULL,
  `is_post` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT NULL,
  `del_date` datetime DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `voucher_no` varchar(15) CHARACTER SET utf8 NOT NULL,
  `device_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `invoices` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `voucher_invoice` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_center` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_quick`
--

CREATE TABLE `voucher_quick` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(500) NOT NULL,
  `ledger_from` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_quick_items`
--

CREATE TABLE `voucher_quick_items` (
  `id` int(11) NOT NULL,
  `voucher_quick_id` int(11) NOT NULL,
  `ledger_to` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `narration` varchar(500) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_trans`
--

CREATE TABLE `voucher_trans` (
  `id` int(100) UNSIGNED NOT NULL,
  `voucher_id` int(100) DEFAULT NULL,
  `acc_ledgers_id` int(100) DEFAULT NULL,
  `credit_amounnt` decimal(10,2) DEFAULT NULL,
  `sub_narration` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit_amount` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `v_enquiry_allocation`
--

CREATE TABLE `v_enquiry_allocation` (
  `id` int(11) NOT NULL,
  `followup` int(11) NOT NULL DEFAULT '0',
  `Sdate` date NOT NULL,
  `enq_id` int(11) NOT NULL,
  `enq_user` text NOT NULL,
  `user` text NOT NULL,
  `Edate` date NOT NULL,
  `Ddate` date NOT NULL,
  `remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_enquiry_closure`
--

CREATE TABLE `v_enquiry_closure` (
  `id` int(100) NOT NULL,
  `enq_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dates` varchar(100) NOT NULL,
  `amounts` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_enquiry_product`
--

CREATE TABLE `v_enquiry_product` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_enquiry_register`
--

CREATE TABLE `v_enquiry_register` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `next_follow_up_date` date NOT NULL,
  `statuss` int(11) NOT NULL DEFAULT '0',
  `course` int(11) NOT NULL DEFAULT '0',
  `loggedin` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `area` int(11) NOT NULL DEFAULT '1',
  `lead_id` int(11) NOT NULL,
  `contactPerson` varchar(100) NOT NULL,
  `source` int(100) NOT NULL,
  `contactNumber` varchar(100) NOT NULL,
  `user` varchar(500) NOT NULL,
  `typebuss` int(11) NOT NULL,
  `unbuss` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `collectedPerson` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `type` varchar(500) NOT NULL,
  `location` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `allocatedAmount` decimal(10,2) NOT NULL,
  `closedAmount` decimal(10,2) NOT NULL,
  `enquaryAmount` decimal(10,2) NOT NULL,
  `serv_no` varchar(500) NOT NULL,
  `route` int(11) NOT NULL,
  `updateddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bill_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_ageing`
--
ALTER TABLE `acc_ageing`
  ADD PRIMARY KEY (`age_id`);

--
-- Indexes for table `acc_ageing_trans`
--
ALTER TABLE `acc_ageing_trans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `acc_settings`
--
ALTER TABLE `acc_settings`
  ADD PRIMARY KEY (`set_id`);

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
-- Indexes for table `analytics_center`
--
ALTER TABLE `analytics_center`
  ADD PRIMARY KEY (`any_id`);

--
-- Indexes for table `auditLog`
--
ALTER TABLE `auditLog`
  ADD PRIMARY KEY (`auditLogID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcode_batch`
--
ALTER TABLE `barcode_batch`
  ADD PRIMARY KEY (`barcode_batch_id`);

--
-- Indexes for table `barcode_batch_items`
--
ALTER TABLE `barcode_batch_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`Bid`);

--
-- Indexes for table `bill_format`
--
ALTER TABLE `bill_format`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `bom_main`
--
ALTER TABLE `bom_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_sub_ledger`
--
ALTER TABLE `bom_sub_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_sub_material`
--
ALTER TABLE `bom_sub_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bussiness_other`
--
ALTER TABLE `bussiness_other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bussiness_type`
--
ALTER TABLE `bussiness_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cess_tbl`
--
ALTER TABLE `cess_tbl`
  ADD PRIMARY KEY (`ces_id`);

--
-- Indexes for table `chqdetails`
--
ALTER TABLE `chqdetails`
  ADD PRIMARY KEY (`chq_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `company_branch`
--
ALTER TABLE `company_branch`
  ADD PRIMARY KEY (`brc_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_centre`
--
ALTER TABLE `cost_centre`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `fk_cost_id` (`fk_cost_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`cou_id`);

--
-- Indexes for table `credit_debit_voucher`
--
ALTER TABLE `credit_debit_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_debit_voucher_trans`
--
ALTER TABLE `credit_debit_voucher_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_batch`
--
ALTER TABLE `crm_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_student`
--
ALTER TABLE `crm_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_tbl`
--
ALTER TABLE `currency_tbl`
  ADD PRIMARY KEY (`crr_id`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_dollar_value`
--
ALTER TABLE `daily_dollar_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damage`
--
ALTER TABLE `damage`
  ADD PRIMARY KEY (`damage_id`);

--
-- Indexes for table `dashboard_user`
--
ALTER TABLE `dashboard_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_method`
--
ALTER TABLE `delivery_method`
  ADD PRIMARY KEY (`delivery_method_id`);

--
-- Indexes for table `delivery_method_states`
--
ALTER TABLE `delivery_method_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_type`
--
ALTER TABLE `delivery_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `enquiry_allocation`
--
ALTER TABLE `enquiry_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_closure`
--
ALTER TABLE `enquiry_closure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_followup`
--
ALTER TABLE `enquiry_followup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_product`
--
ALTER TABLE `enquiry_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_register`
--
ALTER TABLE `enquiry_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feestructure`
--
ALTER TABLE `feestructure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finished_goods`
--
ALTER TABLE `finished_goods`
  ADD PRIMARY KEY (`fga_id`);

--
-- Indexes for table `finished_goods_main`
--
ALTER TABLE `finished_goods_main`
  ADD PRIMARY KEY (`fgm_id`),
  ADD KEY `fgm_id` (`fgm_id`),
  ADD KEY `fgm_id_2` (`fgm_id`);

--
-- Indexes for table `finished_goods_sub`
--
ALTER TABLE `finished_goods_sub`
  ADD PRIMARY KEY (`fgb_id`);

--
-- Indexes for table `fin_year`
--
ALTER TABLE `fin_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `godown`
--
ALTER TABLE `godown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `godown_type`
--
ALTER TABLE `godown_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_booking`
--
ALTER TABLE `hotel_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_booking_details`
--
ALTER TABLE `hotel_booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_floor`
--
ALTER TABLE `hotel_floor`
  ADD PRIMARY KEY (`flr_id`);

--
-- Indexes for table `hotel_room`
--
ALTER TABLE `hotel_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_room_category`
--
ALTER TABLE `hotel_room_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_room_rate`
--
ALTER TABLE `hotel_room_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_room_type`
--
ALTER TABLE `hotel_room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_bloodgroup`
--
ALTER TABLE `hr_bloodgroup`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `hr_course`
--
ALTER TABLE `hr_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `hr_department`
--
ALTER TABLE `hr_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `hr_designation`
--
ALTER TABLE `hr_designation`
  ADD PRIMARY KEY (`desig_id`);

--
-- Indexes for table `hr_education`
--
ALTER TABLE `hr_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_employee_documents`
--
ALTER TABLE `hr_employee_documents`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `hr_employee_leave`
--
ALTER TABLE `hr_employee_leave`
  ADD PRIMARY KEY (`emp_leave_id`);

--
-- Indexes for table `hr_emp_dist_details`
--
ALTER TABLE `hr_emp_dist_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_emp_salary`
--
ALTER TABLE `hr_emp_salary`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indexes for table `hr_holidays`
--
ALTER TABLE `hr_holidays`
  ADD PRIMARY KEY (`holi_id`);

--
-- Indexes for table `hr_jobdetails`
--
ALTER TABLE `hr_jobdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_leavetype`
--
ALTER TABLE `hr_leavetype`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `hr_paysettings`
--
ALTER TABLE `hr_paysettings`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `hr_pay_details`
--
ALTER TABLE `hr_pay_details`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `hr_profile`
--
ALTER TABLE `hr_profile`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `hr_role`
--
ALTER TABLE `hr_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `hr_salary_components`
--
ALTER TABLE `hr_salary_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_salary_distribution`
--
ALTER TABLE `hr_salary_distribution`
  ADD PRIMARY KEY (`distribution_id`);

--
-- Indexes for table `hr_salary_package`
--
ALTER TABLE `hr_salary_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `hr_sal_dist_components`
--
ALTER TABLE `hr_sal_dist_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_sal_pack_components`
--
ALTER TABLE `hr_sal_pack_components`
  ADD PRIMARY KEY (`sal_com_id`);

--
-- Indexes for table `hr_visa_passport_details`
--
ALTER TABLE `hr_visa_passport_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_visa_type`
--
ALTER TABLE `hr_visa_type`
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
-- Indexes for table `ims_godown`
--
ALTER TABLE `ims_godown`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemtypecategory`
--
ALTER TABLE `itemtypecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemtypemaster`
--
ALTER TABLE `itemtypemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemtypevalue`
--
ALTER TABLE `itemtypevalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_alternates`
--
ALTER TABLE `item_alternates`
  ADD PRIMARY KEY (`iia_id`);

--
-- Indexes for table `item_barcode`
--
ALTER TABLE `item_barcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_brand`
--
ALTER TABLE `item_brand`
  ADD PRIMARY KEY (`ibr_id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_color`
--
ALTER TABLE `item_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `item_damage`
--
ALTER TABLE `item_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_feature`
--
ALTER TABLE `item_feature`
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
-- Indexes for table `item_image`
--
ALTER TABLE `item_image`
  ADD PRIMARY KEY (`iim_id`);

--
-- Indexes for table `item_ledger`
--
ALTER TABLE `item_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_order_specification`
--
ALTER TABLE `item_order_specification`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `item_price`
--
ALTER TABLE `item_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_quantity_price`
--
ALTER TABLE `item_quantity_price`
  ADD PRIMARY KEY (`qprice_id`);

--
-- Indexes for table `item_racks`
--
ALTER TABLE `item_racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_racks_master`
--
ALTER TABLE `item_racks_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_size`
--
ALTER TABLE `item_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `item_sub_tags`
--
ALTER TABLE `item_sub_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_tags_master`
--
ALTER TABLE `item_tags_master`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `item_transfer`
--
ALTER TABLE `item_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_transfer_sub`
--
ALTER TABLE `item_transfer_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_video`
--
ALTER TABLE `item_video`
  ADD PRIMARY KEY (`iiv_id`);

--
-- Indexes for table `job_work_order`
--
ALTER TABLE `job_work_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_work_order_items`
--
ALTER TABLE `job_work_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_work_order_raw_material`
--
ALTER TABLE `job_work_order_raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kit_group`
--
ALTER TABLE `kit_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kit_items`
--
ALTER TABLE `kit_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_master`
--
ALTER TABLE `label_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_register`
--
ALTER TABLE `lead_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_card`
--
ALTER TABLE `material_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_card_items`
--
ALTER TABLE `material_card_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_type`
--
ALTER TABLE `material_type`
  ADD PRIMARY KEY (`mty_id`);

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
-- Indexes for table `online_sales_item`
--
ALTER TABLE `online_sales_item`
  ADD PRIMARY KEY (`ons_id`);

--
-- Indexes for table `physical_stk_update`
--
ALTER TABLE `physical_stk_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_stk_update_items`
--
ALTER TABLE `physical_stk_update_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_settings`
--
ALTER TABLE `point_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point_transaction`
--
ALTER TABLE `point_transaction`
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
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_list_items`
--
ALTER TABLE `price_list_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`prn_id`);

--
-- Indexes for table `production_label`
--
ALTER TABLE `production_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_process_additional_ledgers`
--
ALTER TABLE `production_process_additional_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_process_ledger_table`
--
ALTER TABLE `production_process_ledger_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_process_main`
--
ALTER TABLE `production_process_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_process_material_table`
--
ALTER TABLE `production_process_material_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_process_products`
--
ALTER TABLE `production_process_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_stage`
--
ALTER TABLE `production_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_status`
--
ALTER TABLE `production_status`
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
-- Indexes for table `purchase_items_imei`
--
ALTER TABLE `purchase_items_imei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_ledgers`
--
ALTER TABLE `purchase_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`qtn_itms_id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `replacement`
--
ALTER TABLE `replacement`
  ADD PRIMARY KEY (`rep_id`);

--
-- Indexes for table `replacement_items`
--
ALTER TABLE `replacement_items`
  ADD PRIMARY KEY (`rep_itm_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_coupon`
--
ALTER TABLE `sales_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sal_itms_id`);

--
-- Indexes for table `sales_ledgers`
--
ALTER TABLE `sales_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_print`
--
ALTER TABLE `sales_print`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `service_bill_ledger`
--
ALTER TABLE `service_bill_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bill_main`
--
ALTER TABLE `service_bill_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bill_sub`
--
ALTER TABLE `service_bill_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sett_login`
--
ALTER TABLE `sett_login`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `set_billtype`
--
ALTER TABLE `set_billtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_database`
--
ALTER TABLE `set_database`
  ADD PRIMARY KEY (`sdb_Id`);

--
-- Indexes for table `set_device`
--
ALTER TABLE `set_device`
  ADD PRIMARY KEY (`dev_id`);

--
-- Indexes for table `set_errors`
--
ALTER TABLE `set_errors`
  ADD PRIMARY KEY (`err_id`);

--
-- Indexes for table `set_printtype`
--
ALTER TABLE `set_printtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`sli_id`);

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
-- Indexes for table `source_enquiry`
--
ALTER TABLE `source_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StateID`);

--
-- Indexes for table `status_master`
--
ALTER TABLE `status_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_journal`
--
ALTER TABLE `stock_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_journal_items`
--
ALTER TABLE `stock_journal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_journal_ledger`
--
ALTER TABLE `stock_journal_ledger`
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
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `university_type`
--
ALTER TABLE `university_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uqc`
--
ALTER TABLE `uqc`
  ADD PRIMARY KEY (`uqc_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_action_log`
--
ALTER TABLE `user_action_log`
  ADD PRIMARY KEY (`uac_id`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`usr_loc_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`uset_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_details`
--
ALTER TABLE `veh_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_drivers`
--
ALTER TABLE `veh_drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_insurance`
--
ALTER TABLE `veh_insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_insurance_company`
--
ALTER TABLE `veh_insurance_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_manufacture`
--
ALTER TABLE `veh_manufacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veh_trip`
--
ALTER TABLE `veh_trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_quick`
--
ALTER TABLE `voucher_quick`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_quick_items`
--
ALTER TABLE `voucher_quick_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_trans`
--
ALTER TABLE `voucher_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_enquiry_allocation`
--
ALTER TABLE `v_enquiry_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_enquiry_closure`
--
ALTER TABLE `v_enquiry_closure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_enquiry_product`
--
ALTER TABLE `v_enquiry_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_enquiry_register`
--
ALTER TABLE `v_enquiry_register`
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
-- AUTO_INCREMENT for table `acc_ageing_trans`
--
ALTER TABLE `acc_ageing_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acc_ledgers`
--
ALTER TABLE `acc_ledgers`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `acc_ledger_trans`
--
ALTER TABLE `acc_ledger_trans`
  MODIFY `tran_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acc_main`
--
ALTER TABLE `acc_main`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `acc_settings`
--
ALTER TABLE `acc_settings`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `analytics_center`
--
ALTER TABLE `analytics_center`
  MODIFY `any_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `auditLog`
--
ALTER TABLE `auditLog`
  MODIFY `auditLogID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `barcode_batch`
--
ALTER TABLE `barcode_batch`
  MODIFY `barcode_batch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `barcode_batch_items`
--
ALTER TABLE `barcode_batch_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_format`
--
ALTER TABLE `bill_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_material_main`
--
ALTER TABLE `bill_material_main`
  MODIFY `bmm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_material_sub`
--
ALTER TABLE `bill_material_sub`
  MODIFY `bmb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bom_main`
--
ALTER TABLE `bom_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bom_sub_ledger`
--
ALTER TABLE `bom_sub_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bom_sub_material`
--
ALTER TABLE `bom_sub_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bussiness_other`
--
ALTER TABLE `bussiness_other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `bussiness_type`
--
ALTER TABLE `bussiness_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cess_tbl`
--
ALTER TABLE `cess_tbl`
  MODIFY `ces_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chqdetails`
--
ALTER TABLE `chqdetails`
  MODIFY `chq_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_branch`
--
ALTER TABLE `company_branch`
  MODIFY `brc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `comset_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_subcription`
--
ALTER TABLE `company_subcription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cost_centre`
--
ALTER TABLE `cost_centre`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_debit_voucher`
--
ALTER TABLE `credit_debit_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_debit_voucher_trans`
--
ALTER TABLE `credit_debit_voucher_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `crm_batch`
--
ALTER TABLE `crm_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `crm_student`
--
ALTER TABLE `crm_student`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currency_tbl`
--
ALTER TABLE `currency_tbl`
  MODIFY `crr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `daily_dollar_value`
--
ALTER TABLE `daily_dollar_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dashboard_user`
--
ALTER TABLE `dashboard_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `delivery_method_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_method_states`
--
ALTER TABLE `delivery_method_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_type`
--
ALTER TABLE `delivery_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `enquiry_allocation`
--
ALTER TABLE `enquiry_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_closure`
--
ALTER TABLE `enquiry_closure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_followup`
--
ALTER TABLE `enquiry_followup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_product`
--
ALTER TABLE `enquiry_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_register`
--
ALTER TABLE `enquiry_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feestructure`
--
ALTER TABLE `feestructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finished_goods`
--
ALTER TABLE `finished_goods`
  MODIFY `fga_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finished_goods_main`
--
ALTER TABLE `finished_goods_main`
  MODIFY `fgm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `finished_goods_sub`
--
ALTER TABLE `finished_goods_sub`
  MODIFY `fgb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fin_year`
--
ALTER TABLE `fin_year`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `godown`
--
ALTER TABLE `godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `godown_type`
--
ALTER TABLE `godown_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_booking`
--
ALTER TABLE `hotel_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_booking_details`
--
ALTER TABLE `hotel_booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_floor`
--
ALTER TABLE `hotel_floor`
  MODIFY `flr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_room`
--
ALTER TABLE `hotel_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_room_category`
--
ALTER TABLE `hotel_room_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_room_rate`
--
ALTER TABLE `hotel_room_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel_room_type`
--
ALTER TABLE `hotel_room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_bloodgroup`
--
ALTER TABLE `hr_bloodgroup`
  MODIFY `blood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hr_course`
--
ALTER TABLE `hr_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `hr_department`
--
ALTER TABLE `hr_department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `desig_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_education`
--
ALTER TABLE `hr_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hr_employee_documents`
--
ALTER TABLE `hr_employee_documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_employee_leave`
--
ALTER TABLE `hr_employee_leave`
  MODIFY `emp_leave_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_emp_dist_details`
--
ALTER TABLE `hr_emp_dist_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_emp_salary`
--
ALTER TABLE `hr_emp_salary`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_holidays`
--
ALTER TABLE `hr_holidays`
  MODIFY `holi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `hr_jobdetails`
--
ALTER TABLE `hr_jobdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_leavetype`
--
ALTER TABLE `hr_leavetype`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hr_paysettings`
--
ALTER TABLE `hr_paysettings`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `hr_pay_details`
--
ALTER TABLE `hr_pay_details`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=973;
--
-- AUTO_INCREMENT for table `hr_profile`
--
ALTER TABLE `hr_profile`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_role`
--
ALTER TABLE `hr_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `hr_salary_components`
--
ALTER TABLE `hr_salary_components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_salary_distribution`
--
ALTER TABLE `hr_salary_distribution`
  MODIFY `distribution_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_salary_package`
--
ALTER TABLE `hr_salary_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_sal_dist_components`
--
ALTER TABLE `hr_sal_dist_components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_sal_pack_components`
--
ALTER TABLE `hr_sal_pack_components`
  MODIFY `sal_com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2068;
--
-- AUTO_INCREMENT for table `hr_visa_passport_details`
--
ALTER TABLE `hr_visa_passport_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_visa_type`
--
ALTER TABLE `hr_visa_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hsncode`
--
ALTER TABLE `hsncode`
  MODIFY `hsnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_area`
--
ALTER TABLE `ims_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_driver`
--
ALTER TABLE `ims_driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_godown`
--
ALTER TABLE `ims_godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_pickup`
--
ALTER TABLE `ims_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_route`
--
ALTER TABLE `ims_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_vehicle`
--
ALTER TABLE `ims_vehicle`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `itemtypecategory`
--
ALTER TABLE `itemtypecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `itemtypemaster`
--
ALTER TABLE `itemtypemaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `itemtypevalue`
--
ALTER TABLE `itemtypevalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `item_alternates`
--
ALTER TABLE `item_alternates`
  MODIFY `iia_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_barcode`
--
ALTER TABLE `item_barcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_brand`
--
ALTER TABLE `item_brand`
  MODIFY `ibr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `item_color`
--
ALTER TABLE `item_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_damage`
--
ALTER TABLE `item_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_feature`
--
ALTER TABLE `item_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_godown`
--
ALTER TABLE `item_godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_group`
--
ALTER TABLE `item_group`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `item_image`
--
ALTER TABLE `item_image`
  MODIFY `iim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_ledger`
--
ALTER TABLE `item_ledger`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_order_specification`
--
ALTER TABLE `item_order_specification`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_price`
--
ALTER TABLE `item_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_quantity_price`
--
ALTER TABLE `item_quantity_price`
  MODIFY `qprice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_racks`
--
ALTER TABLE `item_racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_racks_master`
--
ALTER TABLE `item_racks_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_size`
--
ALTER TABLE `item_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_sub_tags`
--
ALTER TABLE `item_sub_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_tags`
--
ALTER TABLE `item_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_tags_master`
--
ALTER TABLE `item_tags_master`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_transfer`
--
ALTER TABLE `item_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_transfer_sub`
--
ALTER TABLE `item_transfer_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `item_video`
--
ALTER TABLE `item_video`
  MODIFY `iiv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `kit_group`
--
ALTER TABLE `kit_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kit_items`
--
ALTER TABLE `kit_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `label_master`
--
ALTER TABLE `label_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lead_register`
--
ALTER TABLE `lead_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `material_type`
--
ALTER TABLE `material_type`
  MODIFY `mty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member_category`
--
ALTER TABLE `member_category`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member_family`
--
ALTER TABLE `member_family`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;
--
-- AUTO_INCREMENT for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9125;
--
-- AUTO_INCREMENT for table `online_sales_item`
--
ALTER TABLE `online_sales_item`
  MODIFY `ons_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `physical_stk_update`
--
ALTER TABLE `physical_stk_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `physical_stk_update_items`
--
ALTER TABLE `physical_stk_update_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `point_settings`
--
ALTER TABLE `point_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `point_transaction`
--
ALTER TABLE `point_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prd_stock`
--
ALTER TABLE `prd_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prd_stockitem`
--
ALTER TABLE `prd_stockitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_list_items`
--
ALTER TABLE `price_list_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `prn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `production_label`
--
ALTER TABLE `production_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_process_additional_ledgers`
--
ALTER TABLE `production_process_additional_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_process_ledger_table`
--
ALTER TABLE `production_process_ledger_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_process_main`
--
ALTER TABLE `production_process_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_process_material_table`
--
ALTER TABLE `production_process_material_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_process_products`
--
ALTER TABLE `production_process_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_stage`
--
ALTER TABLE `production_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `production_status`
--
ALTER TABLE `production_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_items_imei`
--
ALTER TABLE `purchase_items_imei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_ledgers`
--
ALTER TABLE `purchase_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `qtn_itms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `ref_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `replacement`
--
ALTER TABLE `replacement`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `replacement_items`
--
ALTER TABLE `replacement_items`
  MODIFY `rep_itm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_coupon`
--
ALTER TABLE `sales_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sal_itms_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_ledgers`
--
ALTER TABLE `sales_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_print`
--
ALTER TABLE `sales_print`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_bill_ledger`
--
ALTER TABLE `service_bill_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_bill_main`
--
ALTER TABLE `service_bill_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_bill_sub`
--
ALTER TABLE `service_bill_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sett_login`
--
ALTER TABLE `sett_login`
  MODIFY `set_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `set_billtype`
--
ALTER TABLE `set_billtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `set_database`
--
ALTER TABLE `set_database`
  MODIFY `sdb_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `set_device`
--
ALTER TABLE `set_device`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `set_errors`
--
ALTER TABLE `set_errors`
  MODIFY `err_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `set_printtype`
--
ALTER TABLE `set_printtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `sli_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `source_enquiry`
--
ALTER TABLE `source_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `status_master`
--
ALTER TABLE `status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `stock_journal`
--
ALTER TABLE `stock_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_journal_items`
--
ALTER TABLE `stock_journal_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_journal_ledger`
--
ALTER TABLE `stock_journal_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `taxgst`
--
ALTER TABLE `taxgst`
  MODIFY `gstid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `university_type`
--
ALTER TABLE `university_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `uqc`
--
ALTER TABLE `uqc`
  MODIFY `uqc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_action_log`
--
ALTER TABLE `user_action_log`
  MODIFY `uac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2600;
--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `usr_loc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `uset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `veh_details`
--
ALTER TABLE `veh_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veh_drivers`
--
ALTER TABLE `veh_drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veh_insurance`
--
ALTER TABLE `veh_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veh_insurance_company`
--
ALTER TABLE `veh_insurance_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veh_manufacture`
--
ALTER TABLE `veh_manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veh_trip`
--
ALTER TABLE `veh_trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_quick`
--
ALTER TABLE `voucher_quick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_quick_items`
--
ALTER TABLE `voucher_quick_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_trans`
--
ALTER TABLE `voucher_trans`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `v_enquiry_allocation`
--
ALTER TABLE `v_enquiry_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `v_enquiry_closure`
--
ALTER TABLE `v_enquiry_closure`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `v_enquiry_product`
--
ALTER TABLE `v_enquiry_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `v_enquiry_register`
--
ALTER TABLE `v_enquiry_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
