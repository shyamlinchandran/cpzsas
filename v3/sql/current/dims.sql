-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2018 at 03:04 PM
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
-- Database: `dims_check`
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
  `pay_id` int(11) NOT NULL,
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
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_ledgers`
--

CREATE TABLE `acc_ledgers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acc_ledger_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ref_id` int(20) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `ref_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `acc_main_id` int(10) DEFAULT NULL,
  `type` enum('Dr','Cr') COLLATE utf8_unicode_ci NOT NULL,
  `openning_bal` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_ledgers`
--

INSERT INTO `acc_ledgers` (`id`, `name`, `acc_ledger_code`, `code`, `ref_id`, `tax_id`, `ref_code`, `is_default`, `acc_main_id`, `type`, `openning_bal`, `published`, `updatedate`) VALUES
(1, 'Cash In Hand', '', 'Cash', 0, 0, 'yes', 0, 4, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(10, 'Purchase', '', 'Purchase', 0, 0, 'yes', 0, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(11, 'Sales', '1', 'Sales', 0, 0, 'yes', 0, 9, 'Dr', '0.00', 'yes', '2018-11-21 13:00:45'),
(12, 'Round Off', '1', 'Round Off', 0, 0, 'yes', 0, 25, 'Dr', '0.00', 'yes', '2018-11-21 13:21:00'),
(13, 'Purchase Freight ', '1', 'PFreight ', 0, 0, 'yes', 0, 8, 'Dr', '0.00', 'yes', '2018-11-21 13:21:25'),
(14, 'Sales Freight', '1', 'Freight', 0, 0, 'yes', 0, 24, 'Dr', '0.00', 'yes', '2018-11-21 13:24:23'),
(15, 'Coolie', '', 'Coolie', 0, 0, 'yes', 0, 12, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(16, 'Discount ', '', 'Discount', 0, 0, 'yes', 0, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(24, 'Commission Payable', '', 'Commission', 0, 0, 'yes', 0, 34, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(232, 'Purchase-28', '5', '28', 5, 0, 'PurTax', 1, 19, 'Dr', '0.00', 'yes', '2018-12-14 07:18:00'),
(231, 'Sales-28', '5', '28', 5, 0, 'SaleTax', 1, 21, 'Dr', '0.00', 'yes', '2018-12-14 07:18:00'),
(230, 'GST-28', '5', '28', 5, 0, 'Tax', 1, 10, 'Dr', '0.00', 'yes', '2018-12-29 11:09:57'),
(228, 'Sales-18', '4', '18', 4, 0, 'SaleTax', 1, 21, 'Dr', '0.00', 'yes', '2018-12-14 07:17:46'),
(229, 'Purchase-18', '4', '18', 4, 0, 'PurTax', 1, 19, 'Dr', '0.00', 'yes', '2018-12-14 07:17:46'),
(218, 'GST-0', '1', '0', 1, 0, 'Tax', 1, 10, 'Dr', '0.00', 'yes', '2018-12-29 11:10:19'),
(219, 'Sales-0', '1', '0', 1, 0, 'SaleTax', 1, 21, 'Dr', '0.00', 'yes', '2018-12-14 07:15:07'),
(220, 'Purchase-0', '1', '0', 1, 0, 'PurTax', 1, 19, 'Dr', '0.00', 'yes', '2018-12-14 07:15:07'),
(221, 'GST-5', '2', '5', 2, 0, 'Tax', 1, 10, 'Dr', '0.00', 'yes', '2018-12-29 11:10:15'),
(222, 'Sales-5', '2', '5', 2, 0, 'SaleTax', 1, 21, 'Dr', '0.00', 'yes', '2018-12-14 07:16:12'),
(223, 'Purchase-5', '2', '5', 2, 0, 'PurTax', 1, 19, 'Dr', '0.00', 'yes', '2018-12-14 07:16:12'),
(224, 'GST-12', '3', '12', 3, 0, 'Tax', 1, 10, 'Dr', '0.00', 'yes', '2018-12-29 11:10:09'),
(225, 'Sales-12', '3', '12', 3, 0, 'SaleTax', 1, 21, 'Dr', '0.00', 'yes', '2018-12-14 07:16:35'),
(226, 'Purchase-12', '3', '12', 3, 0, 'PurTax', 1, 19, 'Dr', '0.00', 'yes', '2018-12-14 07:16:35'),
(227, 'GST-18', '4', '18', 4, 0, 'Tax', 1, 10, 'Dr', '0.00', 'yes', '2018-12-29 11:10:04'),
(106, 'Assets', '', 'Assets', 0, 0, 'yes', 0, 13, 'Dr', '0.00', 'yes', '2018-12-29 04:04:37');

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
  `cost_center` varchar(30) NOT NULL,
  `tran_narration` varchar(50000) DEFAULT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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

-- --------------------------------------------------------

--
-- Table structure for table `acc_settings`
--

CREATE TABLE `acc_settings` (
  `set_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `set_key` varchar(20) NOT NULL,
  `set_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_settings`
--

INSERT INTO `acc_settings` (`set_id`, `type`, `set_key`, `set_value`) VALUES
(1, 'profit', 'dir_income', '9,21,22'),
(2, 'profit', 'dir_expence', '8,19,20'),
(3, 'profit', 'indir_expence', '11'),
(4, 'profit', 'indir_income', '12');

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

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE `acc_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`id`, `name`, `published`, `updatedate`) VALUES
(1, 'Expense ', 'yes', '2018-01-28 06:45:28'),
(2, 'Income', 'yes', '2018-01-28 06:45:28'),
(3, 'Asset', 'yes', '2018-04-07 06:45:04'),
(4, 'Liability', 'yes', '2018-01-28 06:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `analytics_center`
--

CREATE TABLE `analytics_center` (
  `any_id` int(11) NOT NULL,
  `any_name` varchar(250) NOT NULL,
  `fk_any_id` int(11) NOT NULL,
  `any_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analytics_center`
--

INSERT INTO `analytics_center` (`any_id`, `any_name`, `fk_any_id`, `any_description`) VALUES
(1, 'General', 0, '');

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
  `Item` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Table structure for table `cess_tbl`
--

CREATE TABLE `cess_tbl` (
  `ces_id` int(11) NOT NULL,
  `ces_name` varchar(250) NOT NULL,
  `ces_percent` decimal(10,3) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `chq_details` varchar(500) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `comkey` varchar(6) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `is_multiplegodown` enum('1','0','','') NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `menutype` int(11) NOT NULL,
  `company_master` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `name`, `comkey`, `logo`, `is_multiplegodown`, `address`, `phone`, `tin`, `details`, `menutype`, `company_master`, `email`, `updatedate`) VALUES
(1, 'COMPANY NAME', '', 'yes', '', 'ADDRESS', '1111111111', '123456789012', '', 1, 2, 'erterwt@mail.com', '2018-10-21 10:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `company_branch`
--

CREATE TABLE `company_branch` (
  `brc_id` int(11) NOT NULL,
  `brc_name` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_branch`
--

INSERT INTO `company_branch` (`brc_id`, `brc_name`, `updatedate`) VALUES
(1, 'main', '2018-10-25 09:27:08'),
(2, 'other', '2018-10-25 09:27:16');

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
  `subcription` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `grp_name`, `no_sub_company`, `contact_person`, `contact_number`, `address`, `created_date`, `created_by`, `end_date`, `subcription`, `updatedate`) VALUES
(1, 'ss', 4, 'sss', 'sss', 'ss', '2017-07-22', 'ss', '2017-07-22', 1, '2018-01-28 06:45:30'),
(2, 'qq', 3, 'dfdfd', 'ddddd', 'dd', '1997-05-22', '22/05/1997', '1997-05-22', 1, '2018-01-28 06:45:30');

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
  `comset_state` varchar(25) NOT NULL,
  `select_master` enum('0','1') NOT NULL,
  `is_godown` enum('0','1','','') NOT NULL,
  `item_rack` enum('0','1') NOT NULL,
  `is_unit` enum('0','1','','') NOT NULL,
  `is_itemcode` enum('0','1') NOT NULL,
  `is_discription` enum('0','1') NOT NULL,
  `is_billtype` enum('0','1','','') NOT NULL,
  `is_bankac` enum('0','1','','') NOT NULL,
  `is_batch` enum('0','1') NOT NULL,
  `is_taxincluded` enum('0','1') NOT NULL,
  `item_commission` enum('0','1') NOT NULL,
  `item_min_rate` enum('0','1') NOT NULL,
  `is_ageing` enum('0','1') NOT NULL,
  `com_tax_type` enum('GST','VAT') NOT NULL DEFAULT 'GST',
  `is_production` enum('0','1') NOT NULL,
  `is_analytics` enum('0','1') NOT NULL,
  `is_costcenter` enum('0','1') NOT NULL,
  `is_multipletax` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`comset_id`, `com_id`, `comset_statecode`, `comset_currency`, `comset_currrncy_symbol`, `comset_account_no`, `comset_ifsccode`, `comset_bank`, `comset_declaration`, `comset_state`, `select_master`, `is_godown`, `item_rack`, `is_unit`, `is_itemcode`, `is_discription`, `is_billtype`, `is_bankac`, `is_batch`, `is_taxincluded`, `item_commission`, `item_min_rate`, `is_ageing`, `com_tax_type`, `is_production`, `is_analytics`, `is_costcenter`, `is_multipletax`) VALUES
(1, 1, '32', 'Rupees', '$', '456456456', '456456456', 'SBI', '', 'Kerala', '0', '1', '0', '1', '1', '0', '1', '1', '0', '0', '0', '0', '0', 'GST', '1', '1', '1', '1');

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
  `created_by` varchar(100) NOT NULL,
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
  `type` varchar(100) NOT NULL,
  `discription` varchar(500) NOT NULL,
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
  `cost_name` varchar(250) NOT NULL,
  `fk_cost_id` int(11) DEFAULT NULL,
  `cos_amountp` decimal(10,3) NOT NULL,
  `cost_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_centre`
--

INSERT INTO `cost_centre` (`cost_id`, `cost_name`, `fk_cost_id`, `cos_amountp`, `cost_description`) VALUES
(1, 'General', 0, '0.000', '');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `cou_id` int(11) NOT NULL,
  `cou_code` varchar(20) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `cou_discountp` decimal(10,3) NOT NULL,
  `cou_discount` decimal(10,3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_busn_ntr`
--

CREATE TABLE `crm_busn_ntr` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_customers`
--

CREATE TABLE `crm_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `contact_person` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_district`
--

CREATE TABLE `crm_district` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_enquiry`
--

CREATE TABLE `crm_enquiry` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `business_nature` int(11) NOT NULL,
  `enq_source` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `follow_date` date NOT NULL,
  `in_time` date NOT NULL,
  `out_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_enq_src`
--

CREATE TABLE `crm_enq_src` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_enq_status`
--

CREATE TABLE `crm_enq_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_closed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crm_product`
--

CREATE TABLE `crm_product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency_tbl`
--

CREATE TABLE `currency_tbl` (
  `crr_id` int(11) NOT NULL,
  `crr_name` varchar(250) NOT NULL,
  `crr_symbol` varchar(255) CHARACTER SET utf8 NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_tbl`
--

INSERT INTO `currency_tbl` (`crr_id`, `crr_name`, `crr_symbol`, `updatedate`) VALUES
(1, 'Indian Rupees', '₹', '2018-12-29 11:23:58'),
(2, 'US Dolars', '$', '2018-12-29 11:23:58');

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
-- Table structure for table `damage`
--

CREATE TABLE `damage` (
  `damage_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_user`
--

CREATE TABLE `dashboard_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `usertype` int(11) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard_user`
--

INSERT INTO `dashboard_user` (`id`, `name`, `usertype`, `file`) VALUES
(1, 'superuser', 1, 'sadmin'),
(2, 'user', 2, 'user');

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fin_year`
--

INSERT INTO `fin_year` (`id`, `name`, `start_date`, `end_date`, `published`, `updatedate`) VALUES
(8, 'a', '2018-12-15', '2018-12-15', 'yes', '2018-12-20 13:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `godown`
--

CREATE TABLE `godown` (
  `id` int(11) NOT NULL,
  `godown_name` varchar(100) NOT NULL,
  `godown_address` varchar(200) NOT NULL,
  `godown_contactno` varchar(13) NOT NULL,
  `godown_contact_person` varchar(50) NOT NULL,
  `company` int(10) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `godown`
--

INSERT INTO `godown` (`id`, `godown_name`, `godown_address`, `godown_contactno`, `godown_contact_person`, `company`, `updatedate`) VALUES
(1, 'Main Location', 'address', '3232144455', '', 1, '2018-12-14 06:55:12'),
(2, 'Other', 'address', '2365987896', '', 2, '2018-12-14 06:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `hsncode`
--

CREATE TABLE `hsncode` (
  `hsnid` int(11) NOT NULL,
  `hsncode` varchar(200) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hsncode`
--

INSERT INTO `hsncode` (`hsnid`, `hsncode`, `published`, `updatedate`) VALUES
(1, '001', 0, '2018-01-28 06:45:35'),
(4, '333', 0, '2018-12-28 20:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `ims_area`
--

CREATE TABLE `ims_area` (
  `id` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_driver`
--

CREATE TABLE `ims_driver` (
  `Id` int(11) NOT NULL,
  `Driver_name` varchar(50) NOT NULL,
  `licence_no` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Mobile` double NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `company` int(10) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_godown`
--

INSERT INTO `ims_godown` (`id`, `godown_name`, `godown_address`, `godown_contactno`, `godown_contact_person`, `company`, `updatedate`) VALUES
(1, 'Main Location', 'address', '11111111111', '', 1, '2018-10-25 00:13:18'),
(2, 'Other Location', 'address1', '2222222222222', '', 1, '2018-10-25 00:15:23'),
(3, 'Sub', 'pp', '', '', 1, '2018-12-11 23:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `ims_pickup`
--

CREATE TABLE `ims_pickup` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `free_code` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ims_pickup`
--

INSERT INTO `ims_pickup` (`id`, `code`, `Name`, `details`, `free_code`, `updatedate`) VALUES
(1, 'Pickup', 'Pickup', '', '', '2018-01-28 06:45:37'),
(2, 'Details ', 'Details ', '', '', '2018-01-28 06:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `ims_route`
--

CREATE TABLE `ims_route` (
  `id` int(11) NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `area` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ims_vehicle`
--

CREATE TABLE `ims_vehicle` (
  `Id` int(11) NOT NULL,
  `Vehicle_num` varchar(25) NOT NULL,
  `driver` int(11) NOT NULL,
  `Freecode` int(11) NOT NULL,
  `Freecode2` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `min_level` int(11) NOT NULL,
  `max_level` int(11) NOT NULL,
  `rack` int(11) NOT NULL,
  `prate` decimal(10,2) DEFAULT NULL,
  `srate` decimal(10,2) DEFAULT NULL,
  `wh_rate` decimal(10,2) NOT NULL,
  `MRP` int(11) NOT NULL,
  `open_stk_rate` float NOT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax_ledger_id` int(11) NOT NULL,
  `tax_sales_id` int(11) NOT NULL,
  `tax_purchase_id` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `hsncode` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `godown` int(11) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `material_type` int(11) NOT NULL,
  `analytics_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `name`, `item_type_id`, `item_category_id`, `published`, `updatedate`) VALUES
(1, 'GENERAL', 3, 0, 'yes', '2018-01-28 06:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `item_damage`
--

CREATE TABLE `item_damage` (
  `id` int(11) NOT NULL,
  `damage_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `details` varchar(500) NOT NULL,
  `published` enum('yes','no','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `published` enum('yes','no','','') NOT NULL,
  `current_stock` decimal(10,2) NOT NULL,
  `open_stock` decimal(10,2) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
(1, '10%', 10, 'yes'),
(2, '5%', 5, 'yes'),
(5, 'zero', 0, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item_ledger`
--

CREATE TABLE `item_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `open_stock` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_type` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trans_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `trans_id` int(10) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `MRP` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `godown` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_price`
--

CREATE TABLE `item_price` (
  `id` int(11) NOT NULL,
  `sales_rate` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `name` varchar(200) NOT NULL,
  `rows` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_transfer`
--

CREATE TABLE `item_transfer` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `from_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_transfer_sub`
--

CREATE TABLE `item_transfer_sub` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `transfer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `published`, `updatedate`) VALUES
(2, 'Services', 'yes', '2018-04-07 07:59:08'),
(1, 'Goods', 'yes', '2018-04-07 07:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` enum('sales','purchase','payment','reciept','journal','common') COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `value`, `page`, `details`, `published`, `updatedate`) VALUES
(3, 'cash', '1', '', 'cash Account', 'yes', '2018-01-28 06:45:39'),
(4, '2fapay', 'true', '', 'Two factor authentication for payment', 'yes', '2018-01-28 06:45:39'),
(5, 'paycode', 'PAY-250', '', 'Payment voucher code plus number', 'yes', '2018-01-28 06:45:39'),
(6, 'joucode', 'JOU-358', '', 'Journel voucher code plus number', 'yes', '2018-01-28 06:45:39'),
(7, 'reccode', 'REC-258', '', 'Receipt code plus number', 'yes', '2018-01-28 06:45:39'),
(8, 'sales8', 'S8-200', 'sales', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(9, 'estimate', 'EST-100', '', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(10, 'sales8b', 'S8B-200', 'sales', 'sales 8b bill number', 'yes', '2018-01-28 06:45:39'),
(11, 'sales_return', 'SR-200', 'sales', 'sales_return', 'yes', '2018-01-28 06:45:39'),
(12, 'dprate', '1', '', 'default purchase rate show 1 and 0 shows code ', 'yes', '2018-01-28 06:45:39'),
(13, 'paper', 'A4', '', 'Default paper size', 'yes', '2018-01-28 06:45:39'),
(14, 'paperorient', 'P', '', 'paperorient potrait p', 'yes', '2018-01-28 06:45:39'),
(15, 'grpdiscount', '1', 'sales', '0 if not avilable', 'yes', '2018-01-28 06:45:39'),
(16, 'isbatch', '0', 'sales', 'Enable Batch', 'yes', '2018-04-07 05:27:45'),
(17, 'sales', 'DIMS-203', 'sales', 'sales', 'yes', '2018-01-28 06:45:39'),
(18, 'info', 'kdsfjhg kjhdgfhdsgkfdsg kjfdshfg\\adsgfk sdhgfdsg k', 'sales', 'sdmnfgdskjgfdsghfhds fjdsgfh sdagfhds gfhsdgfkds kfdsagfsadkfgsdh gfhsgdjfgsjdgfsajhfshadgfjasdgfhgdshfgjadsgfjsagdhfsajfg adsgfsadg jfasdjfgssjgfjdsag gfgads gfadsgfhdsah fdsgfhsdajfgdsjgfjadsgfsdajfgds fjasg fasgfhgasjfgsadhgfhdsagfgsadh gfsdah gfks adgfl safgslidfgsildgfi gr9ewqrqwi elriweqrweqlgrqewl9rgqewrigqewlri', 'yes', '2018-01-28 06:45:39'),
(19, 'abc', 'ss-10', '', 'sales abc bill number', 'yes', '2018-01-28 06:45:39'),
(20, 'is_godown', '1', '', 'godown check', 'yes', '2018-01-28 06:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `material_type`
--

CREATE TABLE `material_type` (
  `mty_id` int(11) NOT NULL,
  `mty_name` varchar(250) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_type`
--

INSERT INTO `material_type` (`mty_id`, `mty_name`, `updatedate`) VALUES
(1, 'Finished Goods', '2018-11-17 02:12:47'),
(2, 'Raw Material', '2018-11-17 02:12:47');

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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_category`
--

CREATE TABLE `member_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `menu_series` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `menu_key` varchar(50) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `ListName`, `Url`, `parent`, `icon`, `menu_series`, `published`, `menu_key`, `updatedate`) VALUES
(9, 'Members', 'main/members/listall', 14, '', 1, 'yes', '', '2018-12-21 09:54:08'),
(10, 'Member Category', 'masters/member_category', 14, '', 3, 'yes', '', '2018-12-21 09:54:21'),
(11, 'Basic Units', 'masters/units', 15, '', 1, 'yes', '', '2018-12-21 09:55:02'),
(12, 'Suppliers (Sundry Creditors)', 'suppliers/listall/sup', 15, '', 10, 'yes', '', '2018-12-21 09:57:22'),
(13, 'Accounts Master', NULL, 0, ' fa-anchor', 1, 'yes', '', '2018-11-18 02:08:28'),
(15, 'General Masters', NULL, 0, ' fa-gavel', 2, 'yes', '', '2018-11-18 02:08:54'),
(17, 'Company Info', 'masters/company', 123, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(19, 'Sub Type', 'accounts/accsubtype', 13, '', 6, 'yes', '', '2018-12-21 09:53:03'),
(20, 'Type', 'accounts/acctype', 13, '', 7, 'yes', '', '2018-12-21 09:53:07'),
(21, 'Ledger Group', 'accounts/mainledgers', 13, '', 5, 'yes', '', '2018-12-21 09:52:29'),
(22, 'Ledgers', 'accounts/ledgers', 13, '', 4, 'yes', '', '2018-12-21 09:52:26'),
(23, 'Financial Years', 'accounts/finacial', 13, '', 3, 'yes', '', '2018-12-21 09:52:07'),
(24, 'Inventory Management', NULL, 0, ' fa-barcode', 3, 'yes', '', '2018-11-18 02:09:07'),
(25, 'Item Type', 'items\\itemtype', 24, '', 8, 'yes', '', '2018-12-21 10:05:32'),
(26, 'Category', 'items\\itemcategory', 24, '', 2, 'yes', '', '2018-12-21 10:04:14'),
(29, 'Transactions', NULL, 0, ' fa-balance-scale', 4, 'yes', '', '2018-10-19 07:03:31'),
(30, 'Payment Vouchers', 'transaction\\vouchers\\listall\\payment', 29, '', 5, 'yes', 'Alt+p', '2018-12-28 05:23:53'),
(31, 'Journal Vouchers', 'transaction\\vouchers\\listall\\journal', 29, '', 4, 'yes', '', '2018-12-21 10:12:32'),
(32, 'Receipt Vouchers', 'transaction\\vouchers\\listall\\receipt', 29, '', 10, 'yes', '', '2018-12-21 10:14:04'),
(33, 'Purchase Voucher', 'transaction/purchase/listall/purchase', 29, '', 9, 'yes', '', '2018-12-21 10:13:57'),
(35, 'Member Type', 'masters/member_type', 14, '', 2, 'yes', '', '2018-12-21 09:54:13'),
(36, 'Financial Reports', NULL, 0, ' fa-line-chart', 5, 'yes', '', '2018-11-18 02:09:35'),
(37, 'Ledger', 'reports/accounts/leadger', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(38, 'Cheque', 'transaction/chque/list_all', 15, '', 2, 'yes', '', '2018-12-21 09:55:14'),
(41, 'Cash Book', 'reports/accounts/cashbook', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(42, 'Day Book', 'reports/accounts/daybook', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(43, 'Trial Balance', 'reports/accounts/trial', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(44, 'Sales Order', 'transaction/sales/listall/estimate', 29, '', 12, 'yes', '', '2018-12-21 10:14:14'),
(45, 'Reference (Agent)', 'masters/reference', 15, '', 9, 'yes', '', '2018-12-21 09:57:16'),
(46, 'Customers (Sundry Debtor)', 'customers/listall', 15, '', 5, 'yes', '', '2018-12-21 09:56:01'),
(48, 'Sales Voucher', 'transaction/sales/listall/sales', 29, '', 7, 'yes', '', '2018-12-21 10:13:52'),
(49, 'Stock Ledger', 'reports/stock/leadger', 115, '', 0, 'yes', '', '2018-11-18 06:41:19'),
(50, 'Settings', NULL, 0, 'fa-gear', 5, 'yes', '', '2018-11-18 02:09:53'),
(51, 'Menus', 'masters/menu', 50, '', 0, 'yes', 'Alt+m', '2018-12-28 05:23:40'),
(52, 'Sales Return', 'transaction/sales/listall/sales_return', 29, '', 13, 'yes', '', '2018-12-21 10:14:23'),
(53, 'Check List', 'reports/accounts/checklist', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(54, 'Db Download', 'settings/setting/db_download', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(55, 'Item Discount Group', 'items\\itemgroup', 24, '', 5, 'yes', '', '2018-12-21 10:07:10'),
(56, 'keys', 'masters/keys', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(57, 'Item wise Group (type) Report', 'reports/sales/type', 115, '', 0, 'yes', '', '2018-10-31 22:43:37'),
(58, 'Item Master', 'item/listall', 24, '', 6, 'yes', '', '2018-12-21 10:09:05'),
(60, 'Messages', 'settings/sms/msg', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(63, 'Districts', 'blood/blood/districts', 61, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(84, 'Batch', 'master/items/batch', 24, '', 1, 'yes', '', '2018-12-21 10:04:08'),
(87, 'GST', 'masters/gst', 15, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(88, 'Hsn Code', 'masters/hsncode', 24, '', 4, 'yes', '', '2018-12-21 10:04:50'),
(89, 'Aging ', 'reports/aging/listall', 36, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(90, 'Company Subscription', 'settings/CompanySubscription/listall', 123, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(91, 'Software Version', 'settings/SoftwareVersion/listall', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(92, 'Users', 'settings/NewMaster/Users', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(93, 'CompanyTypes', 'settings/CompanyMenuTypes/listall', 123, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(94, 'Company Master', 'settings/CompanyMaster/listall', 123, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(95, 'Company Settings', 'masters/company_settings', 123, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(97, 'Menu To User', 'settings/MenuToUser/listall', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(98, 'CRM', NULL, 0, 'fa-barcode	', 7, 'yes', '', '2018-10-19 07:03:41'),
(99, 'Customers', 'crm/crm/customers', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(100, 'Product master', 'crm/crm/product_master', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(101, 'Source of enquiry master', 'crm/crm/enquiry_source', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(102, 'Nature of business master', 'crm/crm/business_nature', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(103, 'Product master', 'crm/crm/product_master', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(104, 'Enquiry', 'crm/crm/listall', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(105, 'Purchase Return', 'transaction/purchase/listall/purchase_return', 29, '', 0, 'yes', 'Alt+r', '2018-12-28 05:24:11'),
(106, 'Purchase Order', 'transaction/purchase/listall/order	', 29, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(107, 'District master', 'crm/crm/district_master', 98, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(108, 'Bill Types', 'master/Newmasters/bill_type', 50, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(109, 'Area', 'master/Newmasters/Area	', 50, '', 0, 'yes', 'Alt+a', '2018-12-28 05:21:56'),
(111, 'Print Types	', 'master/Newmasters/print_type	', 15, '', 8, 'yes', '', '2018-12-21 09:57:02'),
(112, 'Excel Export (Item)', 'item/excel', 50, '', 0, 'yes', '', '2018-01-28 11:32:41'),
(113, 'Excel Export(Customer)', 'masters/excel', 50, '', 0, 'yes', '', '2018-01-28 11:33:36'),
(115, 'Inventory Reports', NULL, 0, 'fa fa-line-chart', 8, 'yes', '', '2018-11-18 02:10:33'),
(118, 'Item Wise Sales Register', 'reports/item/itemereport', 115, '', 0, 'yes', '', '2018-01-28 06:45:40'),
(120, 'GST Reports', NULL, 0, 'fa fa-bar-chart', 9, 'yes', '', '2018-11-18 02:10:47'),
(121, 'Gstr1', 'reports/gst/gstreport', 120, '', 0, 'yes', '', '2018-05-06 06:30:15'),
(122, 'Gstr2', 'reports/gst/gstr2report', 120, '', 0, 'yes', '', '2018-05-06 06:34:10'),
(123, 'General Settings', NULL, 0, 'fa-wrench', 10, 'yes', '', '2018-11-18 02:11:04'),
(124, 'Godown Transfer', 'master/itemtransfer/list_all', 29, '', 4, 'yes', '', '2018-12-21 10:54:06'),
(125, 'Purchase Report	', 'reports/purchase/purchasereport', 115, '', 0, 'yes', '', '2018-11-18 06:43:30'),
(126, 'Sales Reports	', 'reports/Sales/salesreport', 115, '', 0, 'yes', '', '2018-11-18 06:43:05'),
(128, 'Status Master', 'crm/crm/status_master', 98, '', 0, 'yes', '', '2018-02-16 21:33:35'),
(129, 'Set Device', 'settings/set_device/device', 50, '', 0, 'yes', '', '2018-03-20 20:32:33'),
(130, 'State', 'masters/states', 50, '', 0, 'yes', '', '2018-03-20 20:33:04'),
(131, 'Godown', 'master/godown/godown', 24, '', 3, 'yes', '', '2018-12-21 10:04:40'),
(132, 'Racks', 'Item/racks', 24, '', 0, 'yes', '', '2018-03-20 20:50:51'),
(133, 'Login Settings', 'settings/loginsett/listall', 50, '', 0, 'yes', '', '2018-03-20 23:41:41'),
(139, 'Clinic', NULL, 0, 'fa fa-ambulance', 9, 'yes', '', '2018-10-19 07:03:47'),
(140, 'Blood Group', 'clinic/Masters/Blood', 139, '', 0, 'yes', '', '2018-04-02 04:22:59'),
(141, 'Time Schedule', 'clinic/Masters/Schedule_Time', 139, '', 0, 'yes', '', '2018-04-02 04:34:31'),
(142, 'Patients', 'clinic/patients/listall', 139, '', 0, 'yes', '', '2018-04-01 20:09:07'),
(143, 'Doctors', 'clinic/masters/doctors', 139, '', 0, 'yes', '', '2018-04-01 20:16:29'),
(145, 'Appointments', 'clinic/booking/listall', 139, '', 0, 'yes', '', '2018-04-04 05:03:29'),
(146, 'Calendar', 'clinic/patients/calendar', 139, '', 0, 'yes', '', '2018-04-03 20:43:41'),
(147, 'Procedures', 'clinic/masters/medprocedures', 139, '', 0, 'yes', '', '2018-04-03 23:57:30'),
(149, 'My Patients', 'clinic/doctor/listall', 139, '', 0, 'yes', '', '2018-04-09 01:42:39'),
(150, 'Payment/Pharmacy', 'clinic/payment/listall', 139, '', 0, 'yes', '', '2018-04-12 20:11:52'),
(151, 'Approval', 'clinic/approvel/listall', 139, '', 0, 'yes', '', '2018-04-16 06:41:14'),
(152, 'Customer Price', 'settings/customerprice/listall', 15, '', 6, 'yes', '', '2018-12-21 09:55:58'),
(153, 'Item Price', 'settings/itemprice/listall', 24, '', 7, 'yes', '', '2018-12-21 10:05:28'),
(154, 'Patient History', 'clinic/completed/listall', 139, '', 0, 'yes', '', '2018-05-12 02:16:12'),
(156, 'Item Wise Sales Report', 'reports/itemwisereport/sales	', 115, '', 0, 'yes', '', '2018-10-31 22:44:44'),
(157, 'Item Report (detailed)', 'reports/itemdetails/listall', 115, '', 0, 'yes', '', '2018-10-19 07:26:23'),
(159, 'Item Wise Margin Report', 'reports/marginreport/itemwise', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(160, 'BillWise Margin Report', 'reports/marginreport/billwise', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(161, 'Stock Movement Report', 'reports/itemwisereport/quantity', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(162, 'Total Sales Report', 'reports/totalinvoicereport/sales', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(163, 'Total Purchase Report', 'reports/totalinvoicereport/purchase', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(165, 'Item Wise Purchase Report', 'reports/itemwisereport/purchase', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(166, 'Invoice Report', 'reports/invoice/invoicereport', 115, '', 0, '', '', '2018-10-19 07:26:23'),
(167, 'Church', NULL, 0, 'fa fa-crosshairs', 14, 'yes', '', '2018-10-19 07:04:08'),
(168, 'Prayer Community Master', 'church/masters/community', 167, '', 0, 'yes', '', '2018-07-24 02:58:15'),
(169, 'Wards Master', 'church/masters/wards', 167, '', 0, 'yes', '', '2018-07-24 06:05:19'),
(170, 'Family Register', 'church/family_head/listall', 167, '', 0, 'yes', '', '2018-07-25 05:21:13'),
(171, 'Districts Master', 'church/masters/district', 167, '', 0, 'yes', '', '2018-07-24 23:56:52'),
(172, 'Villages Master', 'church/masters/village', 167, '', 0, 'yes', '', '2018-07-24 23:57:15'),
(173, 'Taluk Master', 'church/masters/taluk', 167, '', 0, 'yes', '', '2018-07-25 07:07:54'),
(174, 'Diocese Master', 'church/masters/diocese', 167, '', 0, 'yes', '', '2018-07-25 07:12:21'),
(175, 'Land/locality Master', 'church/masters/locality', 167, '', 0, 'yes', '', '2018-07-24 20:31:22'),
(176, 'Relationship Master', 'church/masters/relations', 167, '', 0, 'yes', '', '2018-07-24 23:48:01'),
(177, 'Receipt types', 'church/receipt_type/listall', 167, '', 0, 'yes', '', '2018-07-28 02:10:40'),
(178, 'Receipt generate', 'church/receipt_generate/listall', 167, '', 0, 'yes', '', '2018-07-28 05:43:28'),
(179, 'Receipts Status', 'church/receipt_complete/listall', 167, '', 0, 'yes', '', '2018-07-28 20:10:59'),
(180, 'Tailoring', NULL, 0, 'fa fa-scissors', 17, 'yes', '', '2018-10-19 07:04:23'),
(181, 'Size Master', 'master/thaitems/size', 180, '', 0, 'yes', '', '2018-08-09 06:14:40'),
(182, 'Item Master', 'master/thaitems/items', 180, '', 0, 'yes', '', '2018-08-09 06:14:27'),
(183, 'Customer - Tailoring', 'master/thaitems/customers', 180, '', 0, 'yes', '', '2018-08-09 06:13:08'),
(184, 'Sales - Tailoring', 'tai/trans/listall', 180, '', 0, 'yes', '', '2018-08-09 06:13:26'),
(185, 'Baptism Register', 'church/baptism_register/listall', 167, '', 0, 'yes', '', '2018-08-14 20:52:24'),
(186, 'Death Register', 'church/deathcer_register/listall', 167, '', 0, 'yes', '', '2018-08-14 20:52:24'),
(187, 'Marriage Register', 'church/marriage_register/listall', 167, '', 0, 'yes', '', '2018-08-14 20:52:24'),
(188, 'Fathers', 'church/masters/fathers', 167, '', 0, 'yes', '', '2018-08-14 21:24:37'),
(189, 'Parish Master', 'church/masters/parish', 167, '', 0, 'yes', '', '2018-08-14 22:07:24'),
(190, 'Quotations', 'transaction/quotation/listall', 29, '', 0, 'yes', '', '2018-08-16 07:07:44'),
(191, 'Damage Stock', 'master/Itemdamage/list_all', 29, '', 2, 'yes', '', '2018-12-21 10:10:39'),
(192, 'Total Events', 'church/registern/listall', 167, '', 0, 'yes', '', '2018-10-07 03:29:06'),
(193, 'Product Transfer', 'master/items/list_all/sales', 24, '', 10, 'yes', '', '2018-12-21 10:09:18'),
(194, 'My Menu', 'settings/menus/user_menu', 50, '', 0, 'yes', '', '2018-10-14 21:52:20'),
(195, 'POS', 'pos/main/listall', 29, '', 6, 'yes', '', '2018-12-21 10:13:49'),
(196, 'Cost Centre', 'cost_analytics/cost_centre/listall', 13, '', 2, 'yes', '', '2018-12-21 09:51:56'),
(197, 'Analytics Centre', 'cost_analytics/analytics_centre/listall', 13, '', 1, 'yes', '', '2018-12-21 09:51:50'),
(198, 'Material Type', 'master/amaster/material_type', 15, '', 7, 'yes', '', '2018-11-17 01:47:48'),
(199, 'Profit & Loss A/C', 'reports/accounts/profitandloss', 36, '', 7, 'yes', '', '2018-11-17 21:17:19'),
(200, 'Purchase Return Report', 'reports/purchase/purchasereturn', 115, '', 6, 'yes', '', '2018-11-18 06:43:48'),
(201, 'Sales Order Report', 'reports/Sales/saleorder', 115, '', 7, 'yes', '', '2018-11-18 06:42:24'),
(203, ' Sales Return Report', 'reports/Sales/salesreturn', 115, '', 8, 'yes', '', '2018-11-18 06:45:09'),
(204, 'Currency', 'master/amaster/currency_type', 15, '', 4, 'yes', '', '2018-12-21 09:55:39'),
(205, 'Total Outstanding Report', 'reports/outstandingreport/outstandingreport', 115, '', 0, 'yes', '', '2018-11-19 21:47:13'),
(206, 'Outstanding Reports', 'reports/aging/outstand', 115, '', 0, 'yes', '', '2018-11-19 21:44:36'),
(207, 'Coupons', 'settings/newmaster/coupons', 15, '', 3, 'yes', '', '2018-12-21 09:55:36'),
(208, 'Bill of Materials', 'material/material_bill/listall', 29, '', 1, 'yes', '', '2018-11-28 04:40:36'),
(209, 'Finished Goods', 'material/material_product/listall', 29, '', 3, 'yes', '', '2018-12-21 10:12:28'),
(210, 'Route', 'master/newmasters/route', 50, '', 0, 'yes', '', '2018-11-30 03:34:05'),
(211, 'Sales Bill', 'transaction/sales/sales/sales', 29, '', 11, 'yes', '', '2018-12-21 10:14:06'),
(212, 'Purchase Bill', 'transaction/purchase/create/purchase', 29, '', 8, 'yes', '', '2018-12-21 10:13:54'),
(213, 'Opening Stock Edit', 'itemedit/listall', 24, '', 9, 'yes', '', '2018-12-21 10:09:13'),
(214, 'Set Database', 'master/Newmasters/year_database', 50, '', 0, 'yes', '', '2018-12-19 21:12:12');

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
  `details` varchar(500) DEFAULT NULL,
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
(3372, 24, 3, 0, 0, 0, 0, '2018-12-28 10:57:08'),
(3373, 55, 3, 1, 1, 1, 0, '2018-12-28 10:57:08'),
(3374, 58, 3, 1, 1, 1, 0, '2018-12-28 10:57:08'),
(3375, 84, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3376, 132, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3377, 213, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3378, 88, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3379, 193, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3380, 26, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3381, 131, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3382, 153, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3383, 25, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3384, 29, 3, 0, 0, 0, 0, '2018-12-28 10:57:09'),
(3385, 52, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3386, 105, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3387, 191, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3388, 32, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3389, 44, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3390, 48, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3391, 190, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3392, 124, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3393, 31, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3394, 209, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3395, 212, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3396, 106, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3397, 195, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3398, 30, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3399, 33, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3400, 208, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3401, 211, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3402, 36, 3, 0, 0, 0, 0, '2018-12-28 10:57:09'),
(3403, 89, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3404, 41, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3405, 199, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3406, 43, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3407, 53, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3408, 37, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3409, 42, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3410, 98, 3, 0, 0, 0, 0, '2018-12-28 10:57:09'),
(3411, 99, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3412, 102, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3413, 101, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3414, 104, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3415, 107, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3416, 128, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3417, 100, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3418, 103, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3419, 115, 3, 0, 0, 0, 0, '2018-12-28 10:57:09'),
(3420, 156, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3421, 160, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3422, 163, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3423, 118, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3424, 200, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3425, 125, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3426, 159, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3427, 162, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3428, 57, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3429, 166, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3430, 203, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3431, 206, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3432, 157, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3433, 161, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3434, 165, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3435, 201, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3436, 126, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3437, 205, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3438, 49, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3439, 15, 3, 0, 0, 0, 0, '2018-12-28 10:57:09'),
(3440, 12, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3441, 204, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3442, 207, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3443, 111, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3444, 11, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3445, 38, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3446, 46, 3, 1, 1, 1, 0, '2018-12-28 10:57:09'),
(3447, 87, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3448, 198, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3449, 45, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3450, 152, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3451, 50, 3, 0, 0, 0, 0, '2018-12-28 10:57:10'),
(3452, 92, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3453, 108, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3454, 112, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3455, 194, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3456, 129, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3457, 210, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3458, 51, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3459, 54, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3460, 91, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3461, 56, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3462, 60, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3463, 97, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3464, 109, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3465, 113, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3466, 130, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3467, 133, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3468, 214, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3469, 13, 3, 0, 0, 0, 0, '2018-12-28 10:57:10'),
(3470, 197, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3471, 21, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3472, 196, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3473, 20, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3474, 23, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3475, 19, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3476, 22, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3477, 120, 3, 0, 0, 0, 0, '2018-12-28 10:57:10'),
(3478, 122, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3479, 121, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3480, 123, 3, 0, 0, 0, 0, '2018-12-28 10:57:10'),
(3481, 95, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3482, 17, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3483, 94, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3484, 90, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3485, 93, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3486, 167, 3, 0, 0, 0, 0, '2018-12-28 10:57:10'),
(3487, 170, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3488, 173, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3489, 176, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3490, 179, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3491, 185, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3492, 188, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3493, 169, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3494, 172, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3495, 175, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3496, 178, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3497, 187, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3498, 168, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3499, 171, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3500, 174, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3501, 177, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3502, 186, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3503, 189, 3, 1, 1, 1, 0, '2018-12-28 10:57:10'),
(3504, 192, 3, 1, 1, 1, 0, '2018-12-28 10:57:10');

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
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cost_center` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bill_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `cash_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `printtype` int(11) NOT NULL,
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
  `bill_type` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` enum('pending','incompleted','completed') COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('purchase','porder','purchase_return','order') COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `salesman` int(11) NOT NULL,
  `supgst` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supstate` int(11) NOT NULL,
  `ewb_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ewb_details` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `route` int(11) NOT NULL,
  `vehicle` int(11) DEFAULT '0',
  `area` int(11) NOT NULL,
  `billing_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `order_quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `item_discription` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `analytics` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `godown` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_ledgers`
--

CREATE TABLE `purchase_ledgers` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `cusname` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `roundoff` decimal(10,2) NOT NULL,
  `bill_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rows` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `percent` decimal(5,2) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `bill_type` int(11) NOT NULL,
  `bill_margin` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `customer_id` int(20) DEFAULT NULL,
  `estimate_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('completed','incompleted','pending') COLLATE utf8_unicode_ci NOT NULL,
  `cash_type` enum('Cash','Credit','Bank') COLLATE utf8_unicode_ci NOT NULL,
  `printtype` int(11) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `salesman` int(11) DEFAULT NULL,
  `cusname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusgst` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cusstate` int(11) NOT NULL,
  `ewb_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ewb_details` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cusdetails` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusemail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_center` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
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
  `sal_itms_id` int(10) UNSIGNED NOT NULL,
  `sales_id` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `base_unit_id` int(10) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `estimate_quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `item_margin` decimal(10,2) NOT NULL,
  `godown` int(11) NOT NULL,
  `analytics` int(11) NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `is_taxincluded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL,
  `item_discription` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_ledgers`
--

CREATE TABLE `sales_ledgers` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `ledger_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `published` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `set_billtype`
--

CREATE TABLE `set_billtype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `print_type` int(11) NOT NULL,
  `startnumber` bigint(20) NOT NULL,
  `seperator` varchar(1) NOT NULL,
  `suffix` varchar(30) NOT NULL,
  `preffix` varchar(10) NOT NULL,
  `transaction` enum('sales','purchase','sales_return','purchase_return','estimate','order','pay','rec','jou') NOT NULL,
  `cash` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_billtype`
--

INSERT INTO `set_billtype` (`id`, `type`, `print_type`, `startnumber`, `seperator`, `suffix`, `preffix`, `transaction`, `cash`, `bank`, `godown_id`, `updatedate`) VALUES
(1, 'GST Purchase', 1, 1, '-', 'ss', 'ee', 'purchase', 0, 0, 1, '2018-04-07 03:52:16'),
(2, 'GST Sales', 1, 1, '', '', 'MS', 'sales', 1, 238, 1, '2018-12-13 19:55:26'),
(3, 'Purchase Order', 1, 1, '', '', 'PO', 'order', 0, 0, 1, '2018-04-07 03:51:40'),
(4, 'Sales Order', 1, 1, '', '', 'SO', 'estimate', 0, 0, 1, '2018-03-25 20:22:36'),
(5, 'Sale Return', 1, 1, '', '', 'SR', 'sales_return', 0, 0, 1, '2018-04-07 03:56:01'),
(6, 'Purchase Return', 1, 1, '', '', 'PR', 'purchase_return', 0, 0, 1, '2018-04-07 03:55:44'),
(8, 'Payment', 1, 1, '', '', 'PAY', 'pay', 0, 0, 1, '2018-04-07 03:51:16'),
(9, 'Receipt', 1, 1, '', '', 'REC', 'rec', 0, 0, 1, '2018-03-28 19:57:59'),
(10, 'Journal', 1, 1, '', '', 'JOU', 'jou', 0, 0, 1, '2018-04-07 03:51:03'),
(11, 'T1sales', 4, 1, '', 't1', 'sales', 'sales', 0, 0, 2, '2018-12-14 06:56:18'),
(12, 'T1 Purchase', 2, 1, '', '', '', 'purchase', 0, 0, 1, '2018-08-18 20:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `set_database`
--

CREATE TABLE `set_database` (
  `sdb_Id` int(11) NOT NULL,
  `sdb_name` varchar(20) NOT NULL,
  `sdb_username` varchar(10) NOT NULL,
  `sdb_password` varchar(10) NOT NULL,
  `sdb_server` varchar(15) NOT NULL,
  `year_id` int(11) NOT NULL,
  `sdb_curnt` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_device`
--

CREATE TABLE `set_device` (
  `dev_id` int(11) NOT NULL,
  `dev_name` varchar(50) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `dev_number` varchar(50) NOT NULL,
  `com_id` int(11) NOT NULL,
  `godown_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `set_printtype`
--

CREATE TABLE `set_printtype` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `page` varchar(20) NOT NULL,
  `pagesize` int(11) NOT NULL,
  `published` enum('yes','no','','') NOT NULL,
  `bill_default` enum('no','yes') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bill_format` varchar(20) NOT NULL DEFAULT 'bill'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_printtype`
--

INSERT INTO `set_printtype` (`id`, `name`, `page`, `pagesize`, `published`, `bill_default`, `updatedate`, `bill_format`) VALUES
(1, 'Main Print', 'full', 30, 'yes', 'yes', '2018-12-14 06:49:05', 'bill'),
(4, 'Print1', 'full', 35, 'yes', 'no', '2018-12-14 06:36:44', 'bill1');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `sms` varchar(500) NOT NULL,
  `is_default` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_keywords`
--

CREATE TABLE `sms_keywords` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `published` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `url` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateName` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `Notes` varchar(2000) DEFAULT NULL,
  `ChangeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `CountryID`, `StateName`, `code`, `Notes`, `ChangeDate`) VALUES
(36, 1, 'ANDHRA PRADESH', 28, NULL, '2018-08-06 07:52:43'),
(37, 1, 'ASSAM', 18, NULL, '2018-08-06 07:52:47'),
(38, 1, 'ARUNACHAL PRADESH', 12, NULL, '2018-08-06 07:52:57'),
(39, 1, 'GUJARAT', 24, NULL, '2018-08-06 07:54:15'),
(40, 1, 'BIHAR', 10, NULL, '2018-08-06 07:55:01'),
(41, 1, 'HARYANA', 6, NULL, '2018-08-06 07:55:07'),
(42, 1, 'HIMACHAL PRADESH', 2, NULL, '2018-08-06 07:55:18'),
(43, 1, 'JAMMU & KASHMIR', 1, NULL, '2018-03-21 13:05:42'),
(44, 1, 'KARNATAKA', 29, NULL, '2018-08-06 07:55:35'),
(45, 1, 'KERALA', 32, NULL, '2018-08-06 07:24:16'),
(46, 1, 'MADHYA PRADESH', 23, NULL, '2018-08-06 07:55:58'),
(47, 1, 'MAHARASHTRA', 27, NULL, '2018-08-06 07:56:05'),
(48, 1, 'MANIPUR', 14, NULL, '2018-08-06 07:56:25'),
(49, 1, 'MEGHALAYA', 17, NULL, '2018-08-06 07:56:48'),
(50, 1, 'MIZORAM', 15, NULL, '2018-08-06 07:57:57'),
(51, 1, 'NAGALAND', 13, NULL, '2018-08-06 07:58:05'),
(52, 1, 'ODISHA', 21, NULL, '2018-08-06 07:58:25'),
(53, 1, 'PUNJAB', 3, NULL, '2018-08-06 07:58:38'),
(54, 1, 'RAJASTHAN', 8, NULL, '2018-08-06 07:58:51'),
(55, 1, 'SIKKIM', 11, NULL, '2018-08-06 07:58:59'),
(56, 1, 'TAMIL NADU', 33, NULL, '2018-08-06 07:59:07'),
(57, 1, 'TRIPURA', 35, NULL, '2018-08-06 07:59:15'),
(58, 1, 'UTTAR PRADESH', 9, NULL, '2018-08-06 08:00:12'),
(59, 1, 'WEST BENGAL', 19, NULL, '2018-08-06 08:00:22'),
(60, 1, 'DELHI', 7, NULL, '2018-08-06 08:00:37'),
(61, 1, 'GOA', 30, NULL, '2018-03-21 13:05:43'),
(62, 1, 'PONDICHERY', 0, NULL, '2018-03-21 13:05:43'),
(63, 1, 'LAKSHDWEEP', 0, NULL, '2018-03-21 13:05:43'),
(64, 1, 'DAMAN & DIU', 0, NULL, '2018-03-21 13:05:43'),
(65, 1, 'DADRA & NAGAR', 0, NULL, '2018-03-21 13:05:43'),
(66, 1, 'CHANDIGARH', 0, NULL, '2018-03-21 13:05:43'),
(67, 1, 'ANDAMAN & NICOBAR', 0, NULL, '2018-03-21 13:05:43'),
(68, 1, 'UTTARANCHAL', 0, NULL, '2018-03-21 13:05:43'),
(69, 1, 'JHARKHAND', 0, NULL, '2018-03-21 13:05:43'),
(70, 1, 'CHATTISGARH', 0, NULL, '2018-03-21 13:05:43'),
(71, 1, 'UTTARANCHAL', 5, NULL, '0000-00-00 00:00:00'),
(72, 1, 'JHARKHAND', 20, NULL, '0000-00-00 00:00:00'),
(73, 1, 'CHATTISGARH', 22, NULL, '0000-00-00 00:00:00'),
(74, 1, 'TELANGANA', 36, NULL, '0000-00-00 00:00:00');

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
  `credit_period` int(10) NOT NULL,
  `bank` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `price_list` int(11) DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
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
  `cgst` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `igst` decimal(10,2) NOT NULL,
  `GST` varchar(50) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxgst`
--

INSERT INTO `taxgst` (`gstid`, `cgst`, `sgst`, `igst`, `GST`, `published`, `updatedate`) VALUES
(1, '0.00', '0.00', '0.00', '0', 0, '2018-12-14 02:44:55'),
(2, '2.50', '2.50', '0.00', '5', 0, '2018-12-14 02:44:55'),
(3, '6.00', '6.00', '0.00', '12', 0, '2018-12-14 02:44:55'),
(4, '9.00', '9.00', '0.00', '18', 0, '2018-12-14 02:44:55'),
(5, '14.00', '14.00', '0.00', '28', 0, '2018-12-14 02:44:55'),
(7, '44.00', '44.00', '0.00', '88', 0, '2018-12-28 20:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `unit_count` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `unit_id`, `code`, `unit_count`, `published`, `updatedate`) VALUES
(1, 'No', NULL, 'No', '1.00', 'yes', '2018-12-14 02:43:57'),
(2, 'kg', NULL, 'kg', '1.00', 'yes', '2018-12-28 06:47:49');

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
  `is_hide` int(11) NOT NULL,
  `branch` int(11) NOT NULL DEFAULT '1',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `user_type`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `user_password`, `company`, `is-active`, `is_hide`, `branch`, `updatedate`) VALUES
(1, 'admin', 1, 'address', '22939909', '546464455', 'admin@mail.com', 'admin', 'admin123', 1, 1, 0, 1, '2018-12-14 07:13:08'),
(3, 'user', 2, 'address', '2345678654', '', '', 'aa', 'aa', 1, 1, 0, 1, '2018-12-21 18:43:33'),
(4, 'dimind', 2, 'address', '212344444144', '', 'dimind@mail.com', 'dimind', '123', 1, 1, 0, 1, '2018-12-14 07:13:17');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dash` varchar(30) NOT NULL,
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
  `voucher_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cost_center` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`Bid`),
  ADD UNIQUE KEY `Code` (`Code`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

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
-- Indexes for table `crm_busn_ntr`
--
ALTER TABLE `crm_busn_ntr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_customers`
--
ALTER TABLE `crm_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_district`
--
ALTER TABLE `crm_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_enquiry`
--
ALTER TABLE `crm_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_enq_src`
--
ALTER TABLE `crm_enq_src`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_enq_status`
--
ALTER TABLE `crm_enq_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_product`
--
ALTER TABLE `crm_product`
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
-- Indexes for table `item_damage`
--
ALTER TABLE `item_damage`
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
-- Indexes for table `item_price`
--
ALTER TABLE `item_price`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `keys`
--
ALTER TABLE `keys`
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
-- Indexes for table `purchase_ledgers`
--
ALTER TABLE `purchase_ledgers`
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
-- Indexes for table `set_printtype`
--
ALTER TABLE `set_printtype`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StateID`);

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
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `id` (`id`);

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
-- AUTO_INCREMENT for table `acc_ageing_trans`
--
ALTER TABLE `acc_ageing_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_ledgers`
--
ALTER TABLE `acc_ledgers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `acc_ledger_trans`
--
ALTER TABLE `acc_ledger_trans`
  MODIFY `tran_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_main`
--
ALTER TABLE `acc_main`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `acc_settings`
--
ALTER TABLE `acc_settings`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `analytics_center`
--
ALTER TABLE `analytics_center`
  MODIFY `any_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `cess_tbl`
--
ALTER TABLE `cess_tbl`
  MODIFY `ces_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `brc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `crm_busn_ntr`
--
ALTER TABLE `crm_busn_ntr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_customers`
--
ALTER TABLE `crm_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_district`
--
ALTER TABLE `crm_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_enquiry`
--
ALTER TABLE `crm_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_enq_src`
--
ALTER TABLE `crm_enq_src`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_enq_status`
--
ALTER TABLE `crm_enq_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_product`
--
ALTER TABLE `crm_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency_tbl`
--
ALTER TABLE `currency_tbl`
  MODIFY `crr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_user`
--
ALTER TABLE `dashboard_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `godown`
--
ALTER TABLE `godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hsncode`
--
ALTER TABLE `hsncode`
  MODIFY `hsnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ims_pickup`
--
ALTER TABLE `ims_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `item_damage`
--
ALTER TABLE `item_damage`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_ledger`
--
ALTER TABLE `item_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_price`
--
ALTER TABLE `item_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `material_type`
--
ALTER TABLE `material_type`
  MODIFY `mty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_category`
--
ALTER TABLE `member_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_family`
--
ALTER TABLE `member_family`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3505;

--
-- AUTO_INCREMENT for table `online_sales_item`
--
ALTER TABLE `online_sales_item`
  MODIFY `ons_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `purchase_ledgers`
--
ALTER TABLE `purchase_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `qtn_itms_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `sales_ledgers`
--
ALTER TABLE `sales_ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sett_login`
--
ALTER TABLE `sett_login`
  MODIFY `set_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_billtype`
--
ALTER TABLE `set_billtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `set_database`
--
ALTER TABLE `set_database`
  MODIFY `sdb_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_device`
--
ALTER TABLE `set_device`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_printtype`
--
ALTER TABLE `set_printtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxgst`
--
ALTER TABLE `taxgst`
  MODIFY `gstid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_action_log`
--
ALTER TABLE `user_action_log`
  MODIFY `uac_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
