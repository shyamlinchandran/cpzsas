-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 12:26 PM
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
  `type` enum('Dr','Cr') COLLATE utf8_unicode_ci NOT NULL,
  `openning_bal` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_ledgers`
--

INSERT INTO `acc_ledgers` (`id`, `name`, `code`, `ref_id`, `ref_code`, `is_default`, `acc_main_id`, `type`, `openning_bal`, `published`, `updatedate`) VALUES
(1, 'Cash In Hand', 'Cash', 0, 'yes', 0, 4, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(2, 'Tax 14.5', '14.5', 1, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(3, 'Sales 14.5', '14.5', 1, 'Tax', 1, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(4, 'Purchase 14.5', '14.5', 1, 'Tax', 1, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(5, 'Tax 5', '5', 2, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(6, 'Sales 5', '5', 2, 'Tax', 1, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(7, 'Purchase 5', '5', 2, 'Tax', 1, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(8, 'Addition', '8394682383', 1, 'sup', 1, 5, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(10, 'Purchase', 'Purchase', 0, 'yes', 0, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(11, 'Sales', 'Sales', 0, 'yes', 0, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(12, 'Round Off', 'Round Off', 0, 'yes', 0, 25, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(13, 'Purchase Freight ', 'PFreight ', 0, 'yes', 0, 8, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(14, 'Sales Freight', 'Freight', 0, 'yes', 0, 24, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(15, 'Coolie', 'Coolie', 0, 'yes', 0, 12, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(16, 'Discount ', 'Discount', 0, 'yes', 0, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(24, 'Commission Payable', 'Commission', 0, 'yes', 0, 34, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(35, 'Tax 2', '2', 3, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(36, 'Sales 2', '2', 3, 'Tax', 1, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(37, 'Purchase 2', '2', 3, 'Tax', 1, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(38, 'Tax gst', '1', 4, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(39, 'Sales gst', '1', 4, 'Tax', 1, 9, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(40, 'Purchase gst', '1', 4, 'Tax', 1, 11, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(78, 'Tax GST -3', '3', 4, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(79, 'Tax GST -1', '1', 4, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(80, 'Tax GST -6', '6', 5, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-01-28 06:45:28'),
(109, 'Tax GST -360', '360', 7, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-05-07 14:17:01'),
(105, 'Tax GST -0', '0', 6, 'Tax', 1, 7, 'Dr', '0.00', 'yes', '2018-03-25 14:00:51'),
(106, 'Assets', 'Assets', 0, 'yes', 0, 17, 'Dr', '0.00', 'yes', '2018-03-27 00:47:43');

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
(1, 'Sundry Debtors', '', 2, 'yes', '2018-01-28 06:45:28'),
(2, 'Salary Account ', '', 1, 'yes', '2018-01-28 06:45:28'),
(3, 'Bank A/C', '', 3, 'yes', '2018-01-28 06:45:28'),
(4, 'Cash A/C', '', 3, 'yes', '2018-01-28 06:45:28'),
(5, 'Sundry Creditors', '', 1, 'yes', '2018-01-28 06:45:28'),
(6, 'Commission Receivable(income)', '', 2, 'yes', '2018-01-28 06:45:28'),
(7, 'Tax A/C', '', 1, 'yes', '2018-01-28 06:45:28'),
(8, 'Purchase Charges', '', 1, 'yes', '2018-01-28 06:45:28'),
(9, 'Sales A/C', '', 3, 'yes', '2018-01-28 06:45:28'),
(10, 'Tax Account', '', 1, 'yes', '2018-01-28 06:45:28'),
(11, 'Purchase A/C', '', 1, 'yes', '2018-01-28 06:45:28'),
(12, 'Sale Other Charges', '', 3, 'yes', '2018-01-28 06:45:28'),
(13, 'CAPITAL ACCOUNT', '', 4, 'yes', '2018-01-28 06:45:28'),
(14, 'CURRENT ACCOUNT', '', 4, 'yes', '2018-01-28 06:45:28'),
(15, 'LOANS AND DEPOSIT', '', 4, 'yes', '2018-01-28 06:45:28'),
(16, 'OUTSTANDING LIABILITIES', '', 4, 'yes', '2018-01-28 06:45:28'),
(17, 'FIXED ASSETS', '', 3, 'yes', '2018-01-28 06:45:28'),
(18, 'INVESTMENTS', '', 3, 'yes', '2018-01-28 06:45:28'),
(19, 'DEPOSITS AND ADVANCES', '', 3, 'yes', '2018-01-28 06:45:28'),
(20, 'CLOSING STOCK', '', 3, 'yes', '2018-01-28 06:45:28'),
(21, 'TRAVELLING EXPENSE', '', 1, 'yes', '2018-01-28 06:45:28'),
(22, 'SUNDRY EXPENSES', '', 1, 'yes', '2018-01-28 06:45:28'),
(23, 'VEHICLE RUNNING & MAINTANCE', '', 1, 'yes', '2018-01-28 06:45:28'),
(24, 'FREIGHT CHARGES', '', 1, 'yes', '2018-01-28 06:45:28'),
(25, 'Round Off', '', 3, 'yes', '2018-01-28 06:45:28'),
(34, 'Commission Payable ', 'Commission', 1, 'yes', '2018-01-28 06:45:28');

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
(1, 'Indirect Exp', 1, 'yes', '2018-01-28 06:45:28'),
(2, 'Asset', 3, 'yes', '2018-01-28 06:45:28'),
(3, 'Direct Expense', 1, 'yes', '2018-01-28 06:45:28'),
(4, 'indirect income', 2, 'yes', '2018-01-28 06:45:28'),
(5, 'SUNDRY CREDITORS', 4, 'yes', '2018-01-28 06:45:28'),
(6, 'LOANS AND DEPOSIT', 4, 'yes', '2018-01-28 06:45:28'),
(7, 'BANK LIABILITY', 4, 'yes', '2018-01-28 06:45:28'),
(8, 'OUTSTANDING LIABILITIES', 4, 'yes', '2018-01-28 06:45:28'),
(9, 'FIXED ASSETS', 3, 'yes', '2018-01-28 06:45:28'),
(10, 'INVESTMENTS', 3, 'yes', '2018-01-28 06:45:28'),
(11, 'SUNDRY DEBTORS', 3, 'yes', '2018-01-28 06:45:28'),
(12, 'DEPOSITS AND ADVANCES', 3, 'yes', '2018-01-28 06:45:28'),
(14, 'ram', 3, 'yes', '2018-01-28 06:45:28'),
(15, 'jishnu babu', 1, 'yes', '2018-08-07 10:11:42');

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
(4, 'Liability', 'yes', '2018-01-28 06:45:28'),
(6, 'balance', 'yes', '2018-08-07 10:12:01');

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
-- Table structure for table `chr_baptism register`
--

CREATE TABLE `chr_baptism register` (
  `bap_id` int(11) NOT NULL,
  `bap_date` date NOT NULL,
  `bap_parish` int(11) NOT NULL,
  `lnd_id` int(11) NOT NULL,
  `hed_id` int(11) NOT NULL,
  `bap_dad` int(11) NOT NULL,
  `bap_mom` int(11) NOT NULL,
  `bap_in` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `madyastan_id` int(11) NOT NULL,
  `pastor_id` int(11) NOT NULL,
  `bap_charge` decimal(10,3) NOT NULL,
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
  `fmm_id` int(11) NOT NULL,
  `fmm_age` int(11) NOT NULL,
  `crr_death_reason` varchar(500) NOT NULL,
  `crr_charges` decimal(10,3) NOT NULL,
  `pastor_id` int(11) NOT NULL,
  `crr_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_diocese`
--

CREATE TABLE `chr_diocese` (
  `dio_id` int(11) NOT NULL,
  `dio_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_diocese`
--

INSERT INTO `chr_diocese` (`dio_id`, `dio_name`) VALUES
(1, 'Adoor  Kadambakkad');

-- --------------------------------------------------------

--
-- Table structure for table `chr_district`
--

CREATE TABLE `chr_district` (
  `dist_id` int(11) NOT NULL,
  `dist_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_district`
--

INSERT INTO `chr_district` (`dist_id`, `dist_name`) VALUES
(1, 'Kollam'),
(2, 'Ernakulam');

-- --------------------------------------------------------

--
-- Table structure for table `chr_family_head`
--

CREATE TABLE `chr_family_head` (
  `hed_id` int(11) NOT NULL,
  `hed_familyno` bigint(11) NOT NULL,
  `hed_name` varchar(250) NOT NULL,
  `diocese_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `hed_housename` varchar(250) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  `panchayath` varchar(250) NOT NULL,
  `village_id` int(11) NOT NULL,
  `taluk_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `hed_phone` varchar(20) NOT NULL,
  `hed_mobile` varchar(20) NOT NULL,
  `hed_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_family_member`
--

CREATE TABLE `chr_family_member` (
  `mbr_id` int(11) NOT NULL,
  `mbr_name` varchar(250) NOT NULL,
  `mbr_relation` int(11) NOT NULL,
  `hed_id` int(11) NOT NULL,
  `mbr_dob` date DEFAULT NULL,
  `mbr_age` int(11) DEFAULT NULL,
  `mbr_education` varchar(100) DEFAULT NULL,
  `mbr_baptised_on` date DEFAULT NULL,
  `mbr_married_on` date DEFAULT NULL,
  `mbr_job` varchar(250) DEFAULT NULL,
  `mbr_remarks` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_land`
--

CREATE TABLE `chr_land` (
  `lnd_id` int(11) NOT NULL,
  `lnd_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_land`
--

INSERT INTO `chr_land` (`lnd_id`, `lnd_name`) VALUES
(1, 'Kizhavara');

-- --------------------------------------------------------

--
-- Table structure for table `chr_marriage_register`
--

CREATE TABLE `chr_marriage_register` (
  `mrg_id` int(11) NOT NULL,
  `dio_id` int(11) NOT NULL,
  `parish` varchar(250) NOT NULL,
  `bride_groom_id` int(11) NOT NULL,
  `bride_id` int(11) NOT NULL,
  `wedding_date` date NOT NULL,
  `witness1_id` int(11) NOT NULL,
  `witness2_id` int(11) NOT NULL,
  `pastor_id` int(11) NOT NULL,
  `mrg_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_panchayath`
--

CREATE TABLE `chr_panchayath` (
  `pan_id` int(11) NOT NULL,
  `pan_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_prayer_community`
--

CREATE TABLE `chr_prayer_community` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_prayer_community`
--

INSERT INTO `chr_prayer_community` (`com_id`, `com_name`) VALUES
(1, 'St. George');

-- --------------------------------------------------------

--
-- Table structure for table `chr_receipts`
--

CREATE TABLE `chr_receipts` (
  `rec_id` int(11) NOT NULL,
  `rtp_id` int(11) NOT NULL,
  `hed_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `rec_amount` decimal(10,3) NOT NULL,
  `rec_ispaid` enum('true','false') NOT NULL DEFAULT 'false',
  `rec_createdate` date NOT NULL,
  `rec_paid_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_receipts_gen`
--

CREATE TABLE `chr_receipts_gen` (
  `reg_id` int(11) NOT NULL,
  `reg_month` int(11) NOT NULL,
  `rtp_id` int(11) NOT NULL,
  `reg_createdon` date NOT NULL,
  `reg_amount` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chr_receipt_type`
--

CREATE TABLE `chr_receipt_type` (
  `rtp_id` int(11) NOT NULL,
  `rtp_name` varchar(250) NOT NULL,
  `rtp_amount` decimal(10,3) NOT NULL,
  `rtp_description` varchar(500) DEFAULT NULL,
  `rtp_is_allmembers` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_receipt_type`
--

INSERT INTO `chr_receipt_type` (`rtp_id`, `rtp_name`, `rtp_amount`, `rtp_description`, `rtp_is_allmembers`) VALUES
(1, 'monthly registration fee', '100.000', 'month fee for families', 'true'),
(2, 'other', '1000.000', 'sasas', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `chr_relations`
--

CREATE TABLE `chr_relations` (
  `rel_id` int(11) NOT NULL,
  `rel_name` varchar(250) NOT NULL,
  `rel_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_relations`
--

INSERT INTO `chr_relations` (`rel_id`, `rel_name`, `rel_series`) VALUES
(1, 'Father', 1),
(2, 'Mother', 2),
(3, 'Son', 3),
(4, 'Daughter', 4),
(5, 'Grandfather', 5),
(6, 'Grandmother', 6),
(7, 'Self', 7),
(8, 'Husband', 8),
(9, 'Wife', 9);

-- --------------------------------------------------------

--
-- Table structure for table `chr_taluk`
--

CREATE TABLE `chr_taluk` (
  `tal_id` int(11) NOT NULL,
  `tal_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_taluk`
--

INSERT INTO `chr_taluk` (`tal_id`, `tal_name`) VALUES
(1, 'Pathanapuram');

-- --------------------------------------------------------

--
-- Table structure for table `chr_village`
--

CREATE TABLE `chr_village` (
  `vlg_id` int(11) NOT NULL,
  `vlg_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_village`
--

INSERT INTO `chr_village` (`vlg_id`, `vlg_name`) VALUES
(1, 'Pathanapuram');

-- --------------------------------------------------------

--
-- Table structure for table `chr_wards`
--

CREATE TABLE `chr_wards` (
  `wrd_id` int(11) NOT NULL,
  `wrd_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chr_wards`
--

INSERT INTO `chr_wards` (`wrd_id`, `wrd_name`) VALUES
(1, 'Karimbalur');

-- --------------------------------------------------------

--
-- Table structure for table `cli_bloodgroup`
--

CREATE TABLE `cli_bloodgroup` (
  `Blo_Id` int(11) NOT NULL,
  `Blo_Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_bloodgroup`
--

INSERT INTO `cli_bloodgroup` (`Blo_Id`, `Blo_Name`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `cli_bok_diagnose`
--

CREATE TABLE `cli_bok_diagnose` (
  `Bok_Dig_Id` int(11) NOT NULL,
  `Bok_Id` int(11) NOT NULL,
  `Dig_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_bok_diagnose`
--

INSERT INTO `cli_bok_diagnose` (`Bok_Dig_Id`, `Bok_Id`, `Dig_Id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 1),
(4, 0, 1),
(5, 0, 1),
(6, 0, 1),
(7, 0, 1),
(8, 0, 1),
(9, 0, 1),
(10, 0, 1),
(11, 0, 1),
(12, 0, 1),
(13, 0, 1),
(14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cli_bok_observation`
--

CREATE TABLE `cli_bok_observation` (
  `Bok_Obv_Id` int(11) NOT NULL,
  `Bok_Id` int(11) NOT NULL,
  `Obv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_bok_observation`
--

INSERT INTO `cli_bok_observation` (`Bok_Obv_Id`, `Bok_Id`, `Obv_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 0, 1),
(4, 0, 1),
(5, 0, 1),
(6, 0, 1),
(7, 0, 1),
(8, 0, 1),
(9, 0, 1),
(10, 0, 1),
(11, 0, 1),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cli_booking`
--

CREATE TABLE `cli_booking` (
  `Bok_Id` bigint(20) NOT NULL,
  `Cus_Id` int(11) NOT NULL,
  `Cat_Id` int(11) NOT NULL,
  `Bok_Mob` varchar(500) NOT NULL,
  `Bok_Email` varchar(500) NOT NULL,
  `Bok_Date` date NOT NULL,
  `Shedule_id` int(11) NOT NULL,
  `Intervell_id` int(11) NOT NULL,
  `Bok_Starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Bok_EndTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Bok_Approved` enum('Approve','Reject','Pending','') NOT NULL,
  `Doc_Id` int(11) NOT NULL,
  `Bok_Note` text NOT NULL,
  `Apr_Note` text NOT NULL,
  `Bok_ReptNote` text NOT NULL,
  `Pre_note` text NOT NULL,
  `Bok_ReptComplete` tinyint(1) NOT NULL,
  `Bok_Amount` decimal(10,2) NOT NULL,
  `Bok_IsPaid` tinyint(1) NOT NULL,
  `Bok_DoctDescription` text NOT NULL,
  `Bok_Priscription` text NOT NULL,
  `Bok_DocNote` text NOT NULL,
  `Bok_Labnote` text,
  `Bok_Completed` tinyint(1) NOT NULL,
  `Bok_Summery` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_bookingprocedures`
--

CREATE TABLE `cli_bookingprocedures` (
  `Bpr_Id` int(11) NOT NULL,
  `Pro_Id` int(11) NOT NULL,
  `Bok_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_category`
--

CREATE TABLE `cli_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_category`
--

INSERT INTO `cli_category` (`cat_id`, `cat_name`) VALUES
(1, 'Fever'),
(2, 'Virus');

-- --------------------------------------------------------

--
-- Table structure for table `cli_clinic`
--

CREATE TABLE `cli_clinic` (
  `Cli_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `header` varchar(300) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `menutype` int(11) NOT NULL,
  `company_master` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_clinic`
--

INSERT INTO `cli_clinic` (`Cli_id`, `name`, `logo`, `header`, `address`, `phone`, `tin`, `details`, `menutype`, `company_master`, `email`) VALUES
(1, 'Clinic', '6a461-win_20161231_11_29_35_pro.jpg', '6ec7e-win_20161231_11_29_35_pro.jpg', 'ERNAKULAM - 683 110, KERALA', '1111111111', 'TIN', 'details', 1, 2, 'erterwt@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cli_diagnose`
--

CREATE TABLE `cli_diagnose` (
  `Dig_id` int(11) NOT NULL,
  `Diagnose` varchar(100) NOT NULL,
  `Details` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_diagnose`
--

INSERT INTO `cli_diagnose` (`Dig_id`, `Diagnose`, `Details`) VALUES
(1, 'Fever', 1),
(2, 'Viral', 1),
(3, 'Infection', 0),
(4, 'Several', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cli_doctor`
--

CREATE TABLE `cli_doctor` (
  `Doc_Id` int(11) NOT NULL,
  `Doc_Name` varchar(100) NOT NULL,
  `Doc_Phone` varchar(20) NOT NULL,
  `Doc_Email` varchar(200) NOT NULL,
  `Doc_Regno` varchar(20) NOT NULL,
  `Doc_Qualify` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_observation`
--

CREATE TABLE `cli_observation` (
  `Obs_Id` int(11) NOT NULL,
  `Observation` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_patient`
--

CREATE TABLE `cli_patient` (
  `Pat_Id` int(11) NOT NULL,
  `Pat_Name` varchar(100) NOT NULL,
  `Pat_Regno` varchar(20) NOT NULL,
  `Pat_Phone` varchar(15) NOT NULL,
  `Pat_Sms` tinyint(1) NOT NULL,
  `Pat_Email` varchar(100) NOT NULL,
  `Pat_Email_Notify` tinyint(1) NOT NULL,
  `Pat_Gender` varchar(6) NOT NULL,
  `Pat_Dob` date NOT NULL,
  `Pat_Age` int(11) NOT NULL,
  `Pat_Blood` int(11) NOT NULL,
  `Pat_Occupation` varchar(100) NOT NULL,
  `Pat_Groups` text NOT NULL,
  `Pat_Refered` varchar(100) NOT NULL,
  `Pat_Address` text NOT NULL,
  `Pat_Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_procedures`
--

CREATE TABLE `cli_procedures` (
  `Pro_Id` int(11) NOT NULL,
  `Pro_Name` varchar(200) NOT NULL,
  `Pro_Details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_procedures`
--

INSERT INTO `cli_procedures` (`Pro_Id`, `Pro_Name`, `Pro_Details`) VALUES
(1, 'Surgery', '<p>\r\n	daadf</p>\r\n'),
(2, 'Procedure', '<p>\r\n	sssasas</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `cli_relationships`
--

CREATE TABLE `cli_relationships` (
  `Rel_Id` int(11) NOT NULL,
  `Relation_type` varchar(20) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_sales_items`
--

CREATE TABLE `cli_sales_items` (
  `Sales_Id` int(11) NOT NULL,
  `Sales_Bok_Id` int(11) NOT NULL,
  `Item_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Tax_Item` int(11) NOT NULL,
  `Tax` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Published` enum('yes','no','','') NOT NULL,
  `Med_note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cli_timeschedule`
--

CREATE TABLE `cli_timeschedule` (
  `TimeSch_Id` int(11) NOT NULL,
  `Schedule_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_timeschedule`
--

INSERT INTO `cli_timeschedule` (`TimeSch_Id`, `Schedule_Time`) VALUES
(2, '12:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `cli_time_intervell`
--

CREATE TABLE `cli_time_intervell` (
  `Ti_id` int(11) NOT NULL,
  `Intervell` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cli_time_intervell`
--

INSERT INTO `cli_time_intervell` (`Ti_id`, `Intervell`) VALUES
(1, '00:05:00'),
(10, '00:10:00'),
(11, '00:15:00'),
(12, '00:30:00'),
(13, '00:45:00');

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
(1, 'COMPANY NAME', '', 'yes', '', 'ADDRESS', '1111111111', 'TIN', 'DETAILS', 1, 2, 'companyname@mail.com', '2018-08-08 15:06:14');

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
  `is_godown` enum('0','1','','') NOT NULL,
  `is_unit` enum('0','1','','') NOT NULL,
  `is_billtype` enum('0','1','','') NOT NULL,
  `is_bankac` enum('0','1','','') NOT NULL,
  `is_batch` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_settings`
--

INSERT INTO `company_settings` (`comset_id`, `com_id`, `comset_statecode`, `comset_currency`, `comset_currrncy_symbol`, `comset_account_no`, `comset_ifsccode`, `comset_bank`, `comset_declaration`, `comset_state`, `is_godown`, `is_unit`, `is_billtype`, `is_bankac`, `is_batch`) VALUES
(1, 1, '32', '1', '$', '456456456', '456456456', 'SBI', '', 'Kerala', '0', '1', '1', '1', '0');

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
-- Table structure for table `crm_busn_ntr`
--

CREATE TABLE `crm_busn_ntr` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crm_busn_ntr`
--

INSERT INTO `crm_busn_ntr` (`id`, `name`, `updatedate`) VALUES
(1, 'whole sale', '2018-01-28 06:45:32'),
(2, 'retail', '2018-01-28 06:45:32');

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

--
-- Dumping data for table `crm_district`
--

INSERT INTO `crm_district` (`id`, `name`, `updatedate`) VALUES
(1, 'Ernakulam', '2018-01-28 06:45:32'),
(2, 'Kannur', '2018-01-28 06:45:32'),
(3, 'Kollam', '2018-01-28 06:45:32');

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

--
-- Dumping data for table `crm_enq_src`
--

INSERT INTO `crm_enq_src` (`id`, `name`, `updatedate`) VALUES
(1, 'friends', '2018-01-28 06:45:33'),
(2, 'social media', '2018-01-28 06:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `crm_enq_status`
--

CREATE TABLE `crm_enq_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_closed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crm_enq_status`
--

INSERT INTO `crm_enq_status` (`id`, `status`, `is_closed`) VALUES
(1, 'Completed', 1),
(2, 'Active', 0),
(3, 'Pending', 0);

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
(7, 'sdfghj', '2018-08-07', '2018-08-07', 'yes', '2018-08-07 06:42:54');

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
(1, 'Dimind Innovation', 'Pookkatupadi', '7559831834', '', 1, '2018-01-28 06:45:34'),
(2, 'aa', 'aa', '2365987896', '', 2, '2018-01-28 06:45:34'),
(3, 'new', 'pkt', '112223', 'jd', 11323, '2018-01-28 06:45:34');

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
(1, '001', 0, '2018-01-28 06:45:35');

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
(1, 'Dimind Innovation', 'Pookkatupadi', '7559831834', '', 1, '2018-01-28 06:45:36');

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

--
-- Dumping data for table `ims_route`
--

INSERT INTO `ims_route` (`id`, `route_name`, `area`, `updatedate`) VALUES
(1, '1', 1, '2018-01-28 06:45:37');

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

--
-- Dumping data for table `ims_vehicle`
--

INSERT INTO `ims_vehicle` (`Id`, `Vehicle_num`, `driver`, `Freecode`, `Freecode2`, `updatedate`) VALUES
(1, 'kl14/h/2345', 1, 0, 0, '2018-01-28 06:45:38'),
(2, '123', 2, 2, 0, '2018-01-28 06:45:38'),
(3, 'kl59/j/5643', 2, 0, 0, '2018-01-28 06:45:38');

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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `hsncode` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `godown` int(11) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
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
(1, 'GENERAL', 3, 0, 'yes', '2018-01-28 06:45:38'),
(2, 'ELECTRICALS', 3, 0, 'yes', '2018-01-28 06:45:38'),
(3, 'PVC', 3, 0, 'yes', '2018-01-28 06:45:38'),
(4, 'GI PIPE', 3, 0, 'yes', '2018-01-28 06:45:38'),
(5, 'CP', 3, 0, 'yes', '2018-01-28 06:45:38'),
(6, 'CPVC', 3, 0, 'yes', '2018-01-28 06:45:38'),
(7, 'VITREOUS', 3, 0, 'yes', '2018-01-28 06:45:38'),
(8, 'PAINTS', 3, 0, 'yes', '2018-01-28 06:45:38'),
(9, 'PLUMBING', 3, 0, 'yes', '2018-01-28 06:45:38'),
(10, 'HARDWARES', 3, 0, 'yes', '2018-01-28 06:45:38'),
(11, 'GENERAL', 3, 1, 'yes', '2018-01-28 06:45:38'),
(12, 'FAN', 3, 2, 'yes', '2018-01-28 06:45:38'),
(13, 'CABLES', 3, 2, 'yes', '2018-01-28 06:45:38'),
(14, 'SWITCHES', 3, 2, 'yes', '2018-01-28 06:45:38'),
(15, 'PVC FITTINGS', 3, 5, 'yes', '2018-01-28 06:45:38'),
(16, 'LIGHTS', 3, 2, 'yes', '2018-01-28 06:45:38'),
(17, 'PVC PIPE', 3, 5, 'yes', '2018-01-28 06:45:38'),
(18, 'CP FITTINGS', 3, 8, 'yes', '2018-01-28 06:45:38'),
(19, 'CONDUIT FITTINGS', 3, NULL, 'yes', '2018-01-28 06:45:38'),
(20, 'CPVC FITTINGS', 3, 9, 'yes', '2018-01-28 06:45:38'),
(21, 'SANITARY', 3, 10, 'yes', '2018-01-28 06:45:38'),
(22, 'TOOLS', 3, 1, 'yes', '2018-01-28 06:45:38'),
(23, 'BRASS FITTINGS', 3, 1, 'yes', '2018-01-28 06:45:38'),
(24, 'POLISH', 3, 11, 'yes', '2018-01-28 06:45:38'),
(25, 'ELE FITTINGS', 3, 2, 'yes', '2018-01-28 06:45:38'),
(26, 'CABLES CONDUIT', 3, 2, 'yes', '2018-01-28 06:45:38'),
(27, 'PAINTS', 3, 1, 'yes', '2018-01-28 06:45:38'),
(28, 'ADESIVE', 3, 1, 'yes', '2018-01-28 06:45:38'),
(29, 'DB', 3, 1, 'yes', '2018-01-28 06:45:38'),
(30, 'PARTS', 3, 1, 'yes', '2018-01-28 06:45:38'),
(31, 'TILES', 3, 1, 'yes', '2018-01-28 06:45:38'),
(32, 'MCB', 3, 2, 'yes', '2018-01-28 06:45:38'),
(33, 'HOSE', 3, 5, 'yes', '2018-01-28 06:45:38'),
(34, 'APPLAINCES', 3, 2, 'yes', '2018-01-28 06:45:38'),
(35, 'GI FITTINGS', 3, 12, 'yes', '2018-01-28 06:45:38'),
(36, 'M0TOR', 3, 2, 'yes', '2018-01-28 06:45:38'),
(37, 'SCRWS', 3, 13, 'yes', '2018-01-28 06:45:38'),
(38, 'ELLEYS', 3, 2, 'yes', '2018-01-28 06:45:38'),
(39, 'GIRSH', 3, 2, 'yes', '2018-01-28 06:45:38'),
(40, 'FINOLEX', 3, 12, 'yes', '2018-01-28 06:45:38'),
(41, 'VGUARD', 3, 12, 'yes', '2018-01-28 06:45:38'),
(42, 'MARUTI', 3, 2, 'yes', '2018-01-28 06:45:38'),
(43, 'SPANISO', 3, 12, 'yes', '2018-01-28 06:45:38'),
(44, 'LED', 3, 2, 'yes', '2018-01-28 06:45:38'),
(45, 'rty', 3, 23, 'yes', '2018-01-28 06:45:38'),
(46, 'rtyrt', 3, NULL, 'yes', '2018-01-28 06:45:38'),
(47, '3', 3, 28, 'yes', '2018-01-28 06:45:38'),
(48, '4', 3, NULL, 'yes', '2018-01-28 06:45:38'),
(49, 'w', 3, 48, 'yes', '2018-01-28 06:45:38'),
(50, 'e', 3, NULL, 'yes', '2018-01-28 06:45:38'),
(51, 'ety', 3, 48, 'yes', '2018-01-28 06:45:38'),
(52, 'grertewt', 3, 48, 'yes', '2018-01-28 06:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `item_damage`
--

CREATE TABLE `item_damage` (
  `id` int(11) NOT NULL,
  `damage_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
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
(5, 'zero', 0, 'yes'),
(6, 'sddsdss', 13, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `item_ledger`
--

CREATE TABLE `item_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `open_stock` decimal(10,2) DEFAULT NULL,
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
(1, 'Goods', 'yes', '2018-04-07 07:59:11'),
(23, 'c ', 'yes', '2018-08-05 22:10:48'),
(24, 'dfsdf', 'yes', '2018-08-06 20:01:26'),
(25, 'sss', 'yes', '2018-08-06 20:01:26'),
(26, 'sssf', 'yes', '2018-08-06 20:01:26');

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

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`id`, `name`, `published`, `updatedate`) VALUES
(3, 'Main Member', '', '2018-01-28 06:45:39'),
(4, 'Child', 'yes', '2018-01-28 06:45:39'),
(5, 'Wife', '', '2018-01-28 06:45:39'),
(8, 'Uncle', 'yes', '2018-01-28 06:45:39'),
(9, 'Cousin', 'yes', '2018-01-28 06:45:39'),
(10, 'Neighboue', 'yes', '2018-01-28 06:45:39');

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
  `published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `ListName`, `Url`, `parent`, `icon`, `published`, `updatedate`) VALUES
(9, 'Members', 'main/members/listall', 14, '', 'yes', '2018-01-28 06:45:40'),
(10, 'Member Category', 'masters/member_category', 14, '', 'yes', '2018-01-28 06:45:40'),
(11, 'Basic Units', 'masters/units', 15, '', 'yes', '2018-01-28 06:45:40'),
(12, 'Supplier Sundry (Creditors)', 'suppliers/listall/sup', 15, '', 'yes', '2018-03-29 06:00:26'),
(13, 'Accounts Master', NULL, 0, ' fa-anchor', 'yes', '2018-01-28 06:45:40'),
(15, 'General Masters', NULL, 0, ' fa-gavel', 'yes', '2018-01-28 06:45:40'),
(17, 'Company Info', 'masters/company', 123, '', 'yes', '2018-01-28 06:45:40'),
(19, 'Sub Type', 'accounts/accsubtype', 13, '', 'yes', '2018-01-28 06:45:40'),
(20, 'Type', 'accounts/acctype', 13, '', 'yes', '2018-01-28 06:45:40'),
(21, 'Ledger Group', 'accounts/mainledgers', 13, '', 'yes', '2018-02-24 09:28:53'),
(22, 'Ledgers', 'accounts/ledgers', 13, '', 'yes', '2018-01-28 06:45:40'),
(23, 'Financial Years', 'accounts/finacial', 13, '', 'yes', '2018-08-06 00:12:47'),
(24, 'Inventory Management', NULL, 0, ' fa-barcode', 'yes', '2018-01-28 06:45:40'),
(25, 'Item Type', 'items\\itemtype', 24, '', 'yes', '2018-01-28 06:45:40'),
(26, 'Category', 'items\\itemcategory', 24, '', 'yes', '2018-01-28 06:45:40'),
(29, 'Transactions', NULL, 0, ' fa-balance-scale', 'yes', '2018-01-28 06:45:40'),
(30, 'Payment Vouchers', 'transaction\\vouchers\\listall\\payment', 29, '', 'yes', '2018-01-28 06:45:40'),
(31, 'Journal Vouchers', 'transaction\\vouchers\\listall\\journal', 29, '', 'yes', '2018-01-28 06:45:40'),
(32, 'Receipt Vouchers', 'transaction\\vouchers\\listall\\receipt', 29, '', 'yes', '2018-01-28 06:45:40'),
(33, 'Purchase', 'transaction/purchase/listall/purchase', 29, '', 'yes', '2018-01-28 06:45:40'),
(35, 'Member Type', 'masters/member_type', 14, '', 'yes', '2018-01-28 06:45:40'),
(36, 'Financial Reports', NULL, 0, ' fa-line-chart', 'yes', '2018-01-28 06:45:40'),
(37, 'Ledger', 'reports/accounts/leadger', 36, '', 'yes', '2018-01-28 06:45:40'),
(38, 'Cheque', 'transaction/chque/list_all', 15, '', 'yes', '2018-01-28 06:45:40'),
(41, 'Cash Book', 'reports/accounts/cashbook', 36, '', 'yes', '2018-01-28 06:45:40'),
(42, 'Day Book', 'reports/accounts/daybook', 36, '', 'yes', '2018-01-28 06:45:40'),
(43, 'Trial Balance', 'reports/accounts/trial', 36, '', 'yes', '2018-01-28 06:45:40'),
(44, 'Estimate', 'transaction/sales/listall/estimate', 29, '', 'yes', '2018-01-28 06:45:40'),
(45, 'Reference (Agent)', 'masters/reference', 15, '', 'yes', '2018-01-28 06:45:40'),
(46, 'Customers (Sundry Debtor)', 'customers/listall', 15, '', 'yes', '2018-04-05 04:31:57'),
(48, 'Sales ', 'transaction/sales/listall/sales', 29, '', 'yes', '2018-01-28 06:45:40'),
(49, 'Stock Ledger', 'reports/stock/leadger', 36, '', 'yes', '2018-01-28 06:45:40'),
(50, 'Settings', NULL, 0, 'fa-gear', 'yes', '2018-01-28 06:45:40'),
(51, 'Menus', 'masters/menu', 50, '', 'yes', '2018-01-28 06:45:40'),
(52, 'Sales Return', 'transaction/sales/listall/sales_return', 29, '', 'yes', '2018-01-28 06:45:40'),
(53, 'Check List', 'reports/accounts/checklist', 36, '', 'yes', '2018-01-28 06:45:40'),
(54, 'Db Download', 'settings/setting/db_download', 50, '', 'yes', '2018-01-28 06:45:40'),
(55, 'Item Group', 'items\\itemgroup', 24, '', 'yes', '2018-01-28 06:45:40'),
(56, 'keys', 'masters/keys', 50, '', 'yes', '2018-01-28 06:45:40'),
(57, 'Item Wise Group Report(type)', 'reports/sales/type', 36, '', 'yes', '2018-08-07 06:46:23'),
(58, 'Item Master', 'item/listall', 24, '', 'yes', '2018-01-28 06:45:40'),
(60, 'Messages', 'settings/sms/msg', 50, '', 'yes', '2018-01-28 06:45:40'),
(63, 'Districts', 'blood/blood/districts', 61, '', 'yes', '2018-01-28 06:45:40'),
(84, 'Batch', 'master/items/batch', 24, '', 'yes', '2018-01-28 06:45:40'),
(87, 'GST', 'masters/gst', 15, '', 'yes', '2018-01-28 06:45:40'),
(88, 'Hsn Code', 'masters/hsncode', 24, '', 'yes', '2018-01-28 06:45:40'),
(89, 'Aging ', 'reports/aging/listall', 36, '', 'yes', '2018-01-28 06:45:40'),
(90, 'Company Subscription', 'settings/CompanySubscription/listall', 123, '', 'yes', '2018-01-28 06:45:40'),
(91, 'Software Version', 'settings/SoftwareVersion/listall', 50, '', 'yes', '2018-01-28 06:45:40'),
(92, 'Users', 'settings/NewMaster/Users', 50, '', 'yes', '2018-01-28 06:45:40'),
(93, 'CompanyTypes', 'settings/CompanyMenuTypes/listall', 123, '', 'yes', '2018-01-28 06:45:40'),
(94, 'Company Master', 'settings/CompanyMaster/listall', 123, '', 'yes', '2018-01-28 06:45:40'),
(95, 'Company Settings', 'masters/company_settings', 123, '', 'yes', '2018-01-28 06:45:40'),
(97, 'Menu To User', 'settings/MenuToUser/listall', 50, '', 'yes', '2018-01-28 06:45:40'),
(98, 'CRM', NULL, 0, 'fa-barcode	', 'yes', '2018-01-28 06:45:40'),
(99, 'Customers', 'crm/crm/customers', 98, '', 'yes', '2018-01-28 06:45:40'),
(100, 'Product master', 'crm/crm/product_master', 98, '', 'yes', '2018-01-28 06:45:40'),
(101, 'Source of enquiry master', 'crm/crm/enquiry_source', 98, '', 'yes', '2018-01-28 06:45:40'),
(102, 'Nature of business master', 'crm/crm/business_nature', 98, '', 'yes', '2018-01-28 06:45:40'),
(103, 'Product master', 'crm/crm/product_master', 98, '', 'yes', '2018-01-28 06:45:40'),
(104, 'Enquiry', 'crm/crm/listall', 98, '', 'yes', '2018-01-28 06:45:40'),
(105, 'Purchase Return', 'transaction/purchase/listall/purchase_return', 29, '', 'yes', '2018-01-28 06:45:40'),
(106, 'Purchase Order', 'transaction/purchase/listall/order	', 29, '', 'yes', '2018-01-28 06:45:40'),
(107, 'District master', 'crm/crm/district_master', 98, '', 'yes', '2018-01-28 06:45:40'),
(108, 'Bill Types', 'master/Newmasters/bill_type', 50, '', 'yes', '2018-01-28 06:45:40'),
(109, 'Area', 'master/Newmasters/Area	', 50, '', 'yes', '2018-01-28 06:45:40'),
(111, 'Print Types	', 'master/Newmasters/print_type	', 15, '', 'yes', '2018-01-28 06:45:40'),
(112, 'Excel Export (Item)', 'item/excel', 50, '', 'yes', '2018-01-28 11:32:41'),
(113, 'Excel Export(Customer)', 'masters/excel', 50, '', 'yes', '2018-01-28 11:33:36'),
(115, 'Inventory Reports', NULL, 0, 'fa fa-line-chart', 'yes', '2018-01-28 06:45:40'),
(116, 'Sales Register', NULL, 115, '', 'yes', '2018-01-28 06:45:40'),
(117, 'Purchase Register', NULL, 115, '', 'yes', '2018-01-28 06:45:40'),
(118, 'Item Wise Sales Register', 'reports/item/itemereport', 115, '', 'yes', '2018-01-28 06:45:40'),
(119, 'Stock Report', NULL, 115, '', 'yes', '2018-01-28 06:45:40'),
(120, 'GST Reports', NULL, 0, 'fa fa-bar-chart', 'yes', '2018-01-28 06:45:40'),
(121, 'Gstr1', 'reports/gst/gstreport', 120, '', 'yes', '2018-05-06 06:30:15'),
(122, 'Gstr2', 'reports/gst/gstr2report', 120, '', 'yes', '2018-05-06 06:34:10'),
(123, 'General Settings', NULL, 0, 'fa-wrench', 'yes', '2018-01-28 06:45:40'),
(124, 'Godown Transfer', 'master/itemtransfer/list_all', 29, '', 'yes', '2018-05-01 04:08:58'),
(125, 'Purchase Report	', 'reports/purchase/purchasereport', 36, '', 'yes', '2018-01-28 06:45:40'),
(126, 'Sales Reports	', 'reports/Sales/salesreport', 36, '', 'yes', '2018-01-28 06:45:40'),
(127, 'Stock Position', 'stockposition/stockp/listall', 115, '', 'yes', '2018-01-28 06:45:40'),
(128, 'Status Master', 'crm/crm/status_master', 98, '', 'yes', '2018-02-16 21:33:35'),
(129, 'Set Device', 'settings/set_device/device', 50, '', 'yes', '2018-03-20 20:32:33'),
(130, 'State', 'masters/states', 50, '', 'yes', '2018-03-20 20:33:04'),
(131, 'Godown', 'master/godown/godown', 24, '', 'yes', '2018-03-20 20:47:30'),
(132, 'Racks', 'Item/racks', 24, '', 'yes', '2018-03-20 20:50:51'),
(133, 'Login Settings', 'settings/loginsett/listall', 50, '', 'yes', '2018-03-20 23:41:41'),
(139, 'Clinic', NULL, 0, 'fa fa-ambulance', 'yes', '2018-04-01 22:19:38'),
(140, 'Blood Group', 'clinic/Masters/Blood', 139, '', 'yes', '2018-04-02 04:22:59'),
(141, 'Time Schedule', 'clinic/Masters/Schedule_Time', 139, '', 'yes', '2018-04-02 04:34:31'),
(142, 'Patients', 'clinic/patients/listall', 139, '', 'yes', '2018-04-01 20:09:07'),
(143, 'Doctors', 'clinic/masters/doctors', 139, '', 'yes', '2018-04-01 20:16:29'),
(145, 'Appointments', 'clinic/booking/listall', 139, '', 'yes', '2018-04-04 05:03:29'),
(146, 'Calendar', 'clinic/patients/calendar', 139, '', 'yes', '2018-04-03 20:43:41'),
(147, 'Procedures', 'clinic/masters/medprocedures', 139, '', 'yes', '2018-04-03 23:57:30'),
(149, 'My Patients', 'clinic/doctor/listall', 139, '', 'yes', '2018-04-09 01:42:39'),
(150, 'Payment/Pharmacy', 'clinic/payment/listall', 139, '', 'yes', '2018-04-12 20:11:52'),
(151, 'Approval', 'clinic/approvel/listall', 139, '', 'yes', '2018-04-16 06:41:14'),
(152, 'Customer Price', 'settings/customerprice/listall', 15, '', 'yes', '2018-05-12 02:17:05'),
(153, 'Item Price', 'settings/itemprice/listall', 24, '', 'yes', '2018-08-07 06:34:38'),
(154, 'Patient History', 'clinic/completed/listall', 139, '', 'yes', '2018-05-12 02:16:12'),
(155, 'Item Wise Purchase Report	', 'reports/itemwisereport/purchase', 36, '', 'yes', '2018-06-02 05:51:35'),
(156, 'Item Wise Sales Report', 'reports/itemwisereport/sales	', 36, '', 'yes', '2018-08-07 06:46:42'),
(157, 'Item Report (detailed)', 'reports/itemdetails/listall', 158, '', 'yes', '2018-06-24 03:06:28'),
(158, 'Generic Reports', NULL, 0, 'fa fa-sellsy', 'yes', '2018-06-24 03:00:18'),
(159, 'Item Wise Margin Report', 'reports/marginreport/itemwise', 158, '', '', '2018-06-09 07:00:42'),
(160, 'BillWise Margin Report', 'reports/marginreport/billwise', 158, '', '', '2018-06-09 07:00:38'),
(161, 'Stock Movement Report', 'reports/itemwisereport/quantity', 158, '', '', '2018-06-09 07:00:48'),
(162, 'Total Sales Report', 'reports/totalinvoicereport/sales', 158, '', '', '2018-06-09 07:00:33'),
(163, 'Total Purchase Report', 'reports/totalinvoicereport/purchase', 158, '', '', '2018-06-09 07:00:27'),
(165, 'Item Wise Purchase Report', 'reports/itemwisereport/purchase', 158, '', '', '2018-06-09 07:00:18'),
(166, 'Invoice Report', 'reports/invoice/invoicereport', 158, '', '', '2018-06-09 07:00:03'),
(167, 'Church', NULL, 0, 'fa fa-crosshairs', 'yes', '2018-07-24 06:06:56'),
(168, 'Prayer Community Master', 'church/masters/community', 167, '', 'yes', '2018-07-24 02:58:15'),
(169, 'Wards Master', 'church/masters/wards', 167, '', 'yes', '2018-07-24 06:05:19'),
(170, 'Family Register', 'church/family_head/listall', 167, '', 'yes', '2018-07-25 05:21:13'),
(171, 'Districts Master', 'church/masters/district', 167, '', 'yes', '2018-07-24 23:56:52'),
(172, 'Villages Master', 'church/masters/village', 167, '', 'yes', '2018-07-24 23:57:15'),
(173, 'Taluk Master', 'church/masters/taluk', 167, '', 'yes', '2018-07-25 07:07:54'),
(174, 'Diocese Master', 'church/masters/diocese', 167, '', 'yes', '2018-07-25 07:12:21'),
(175, 'Land/locality Master', 'church/masters/locality', 167, '', 'yes', '2018-07-24 20:31:22'),
(176, 'Relationship Master', 'church/masters/relations', 167, '', 'yes', '2018-07-24 23:48:01'),
(177, 'Receipt types', 'church/receipt_type/listall', 167, '', 'yes', '2018-07-28 02:10:40'),
(178, 'Receipt generate', 'church/receipt_generate/listall', 167, '', 'yes', '2018-07-28 05:43:28'),
(179, 'Receipts Status', 'church/receipt_complete/listall', 167, '', 'yes', '2018-07-28 20:10:59'),
(181, 'Tailoring', NULL, 0, 'fa fa-scissors', 'yes', '2018-08-09 10:25:58'),
(182, 'Size Master', 'master/thaitems/size', 0, '', 'yes', '2018-08-09 09:36:18'),
(183, 'Item Master', 'master/thaitems/items', 0, '', 'yes', '2018-08-09 09:40:46'),
(184, 'Customer - Tailoring', 'master/thaitems/customers', 0, '', 'yes', '2018-08-09 09:40:46'),
(185, 'Sales - Tailoring', 'tai/trans/listall', 0, '', 'yes', '2018-08-09 09:40:46');

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
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_to_user`
--

INSERT INTO `menu_to_user` (`id`, `menu_id`, `user_id`, `is_read`, `is_write`, `is_delete`, `updatedate`) VALUES
(112, 15, 0, 0, 0, 0, '2018-01-28 06:45:43'),
(113, 11, 0, 1, 0, 0, '2018-01-28 06:45:43'),
(114, 13, 0, 0, 0, 0, '2018-01-28 06:45:43'),
(115, 23, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(116, 21, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(117, 19, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(118, 22, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(119, 20, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(120, 61, 0, 0, 0, 0, '2018-01-28 06:45:43'),
(121, 64, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(122, 62, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(123, 63, 0, 1, 1, 1, '2018-01-28 06:45:43'),
(212, 24, 2, 0, 0, 0, '2018-01-28 06:45:43'),
(213, 26, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(214, 55, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(215, 25, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(216, 58, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(217, 13, 2, 0, 0, 0, '2018-01-28 06:45:43'),
(218, 21, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(219, 19, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(220, 22, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(221, 20, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(222, 23, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(223, 29, 2, 0, 0, 0, '2018-01-28 06:45:43'),
(224, 32, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(225, 30, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(226, 47, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(227, 52, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(228, 33, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(229, 31, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(230, 48, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(231, 44, 2, 1, 1, 1, '2018-01-28 06:45:43'),
(290, 24, 3, 0, 0, 0, '2018-01-28 06:45:43'),
(291, 88, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(292, 55, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(293, 25, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(294, 84, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(295, 58, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(296, 26, 3, 1, 1, 1, '2018-01-28 06:45:43'),
(319, 13, 1, 0, 0, 0, '2018-01-28 06:45:43'),
(320, 19, 1, 1, 1, 1, '2018-01-28 06:45:43'),
(321, 20, 1, 1, 1, 1, '2018-01-28 06:45:43'),
(322, 21, 1, 1, 1, 1, '2018-01-28 06:45:43'),
(323, 22, 1, 1, 1, 1, '2018-01-28 06:45:43'),
(324, 23, 1, 1, 1, 1, '2018-01-28 06:45:43');

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
  `bill_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
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
  `bill_type` int(11) NOT NULL,
  `type` enum('purchase','porder','purchase_return','order') COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `salesman` int(11) NOT NULL,
  `route` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `billing_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
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
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `godown` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `customer_id` int(20) DEFAULT NULL,
  `cash_type` enum('Cash','Credit') COLLATE utf8_unicode_ci NOT NULL,
  `area` int(11) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `vehicle` int(11) DEFAULT NULL,
  `salesman` int(11) DEFAULT NULL,
  `cusname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusdetails` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusemail` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `saletype` enum('b2b','b2c') COLLATE utf8_unicode_ci NOT NULL
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
  `godown` int(11) NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_amt` decimal(10,3) NOT NULL
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
(1, 3, '0orgel42s95cbs3nl4k07uf5iumfrql0', '::1', 1, '2018-08-08 16:12:38', '0000-00-00 00:00:00'),
(2, 3, 'setjmikimdenh5i16kvb61lmip0r40cb', '::1', 1, '2018-08-09 06:28:08', '0000-00-00 00:00:00'),
(3, 3, 'te7gc4nqscru29peejmaiml8fjkm5nhf', '::1', 0, '2018-08-09 06:45:58', '0000-00-00 00:00:00');

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
  `godown_id` int(11) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_billtype`
--

INSERT INTO `set_billtype` (`id`, `type`, `print_type`, `startnumber`, `seperator`, `suffix`, `preffix`, `transaction`, `godown_id`, `updatedate`) VALUES
(1, 'GST Purchase', 1, 1, '-', 'ss', 'ee', 'purchase', 1, '2018-04-07 03:52:16'),
(2, 'GST Sales', 1, 1, '', '', 'MS', 'sales', 0, '2018-04-07 03:50:46'),
(3, 'Purchase Order', 1, 1, '', '', 'PO', 'order', 1, '2018-04-07 03:51:40'),
(4, 'Sales Order', 1, 1, '', '', 'SO', 'estimate', 1, '2018-03-25 20:22:36'),
(5, 'Sale Return', 1, 1, '', '', 'SR', 'sales_return', 1, '2018-04-07 03:56:01'),
(6, 'Purchase Return', 1, 1, '', '', 'PR', 'purchase_return', 1, '2018-04-07 03:55:44'),
(8, 'Payment', 1, 1, '', '', 'PAY', 'pay', 1, '2018-04-07 03:51:16'),
(9, 'Receipt', 1, 1, '', '', 'REC', 'rec', 1, '2018-03-28 19:57:59'),
(10, 'Journal', 1, 1, '', '', 'JOU', 'jou', 1, '2018-04-07 03:51:03'),
(11, 'T1sales', 1, 1, '', 't1', 'sales', 'sales', 2, '2018-08-05 05:40:55');

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
  `com_id` int(11) NOT NULL,
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

--
-- Dumping data for table `set_device`
--

INSERT INTO `set_device` (`dev_id`, `dev_name`, `bill_id`, `dev_number`, `com_id`, `godown_id`) VALUES
(1, 'Android', 2, '100', 123456, 1);

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
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_printtype`
--

INSERT INTO `set_printtype` (`id`, `name`, `page`, `pagesize`, `published`, `updatedate`) VALUES
(1, 'TESTING', '', 0, 'yes', '2018-01-28 06:45:47');

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
(1, 'ssss', 'ss', 'ss', '2017-07-03 00:00:00', '2017-07-10 00:00:00', '2018-01-28 06:45:49'),
(2, '222233', '22222', '22', '2017-07-18 00:00:00', '2017-07-31 00:00:00', '2018-01-28 06:45:49');

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

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `name`, `percent`, `published`, `updatedate`) VALUES
(1, '14.0', '14.00', 'yes', '2018-01-28 06:45:49'),
(2, '.5', '0.50', 'yes', '2018-01-28 06:45:49'),
(3, 'krishi', '0.50', 'yes', '2018-01-28 06:45:49'),
(5, 'five', '45.00', 'yes', '2018-01-28 06:45:49'),
(6, 'akhi', '5.00', 'yes', '2018-01-28 06:45:49'),
(7, '625614', '62.00', 'yes', '2018-01-28 06:45:49');

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
(1, '12.00', '12.00', '0.00', '24.00', 0, '2018-01-28 06:45:49'),
(2, '2.50', '2.50', '0.00', '5.00', 0, '2018-01-28 06:45:49'),
(3, '6.00', '6.00', '0.00', '12.00', 0, '2018-01-28 06:45:49'),
(4, '1.00', '1.00', '1.00', '1.00', 0, '2018-01-28 06:45:49'),
(5, '14.00', '14.00', '0.00', '28', 0, '2018-08-08 00:45:35'),
(6, '0.00', '0.00', '0.00', '0.00', 0, '2018-03-24 22:30:13'),
(7, '9.00', '9.00', '0.00', '18', 0, '2018-08-08 00:45:23');

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
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(10) DEFAULT NULL,
  `unit_count` decimal(10,2) DEFAULT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `code`, `unit_id`, `unit_count`, `published`, `updatedate`) VALUES
(1, 'No', 'No', 1, '1.00', 'yes', '2018-08-08 14:58:44');

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
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `user_type`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `user_password`, `company`, `is-active`, `is_hide`, `updatedate`) VALUES
(1, 'shyamlin', 1, 'Kuniyil house', '7559831834', '546464455', 'shyamlinchandran@gmail.com', 'shyamlin', 'shyam123', 1, 1, 0, '2018-01-28 06:46:02'),
(3, 'user', 2, '757547', '2345678654', '', '', 'aa', 'aa', 1, 0, 0, '2018-03-20 21:48:28');

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
-- Indexes for table `chqdetails`
--
ALTER TABLE `chqdetails`
  ADD PRIMARY KEY (`chq_id`);

--
-- Indexes for table `chr_baptism register`
--
ALTER TABLE `chr_baptism register`
  ADD PRIMARY KEY (`bap_id`);

--
-- Indexes for table `chr_cremation_register`
--
ALTER TABLE `chr_cremation_register`
  ADD PRIMARY KEY (`crr_id`);

--
-- Indexes for table `chr_diocese`
--
ALTER TABLE `chr_diocese`
  ADD PRIMARY KEY (`dio_id`);

--
-- Indexes for table `chr_district`
--
ALTER TABLE `chr_district`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `chr_family_head`
--
ALTER TABLE `chr_family_head`
  ADD PRIMARY KEY (`hed_id`);

--
-- Indexes for table `chr_family_member`
--
ALTER TABLE `chr_family_member`
  ADD PRIMARY KEY (`mbr_id`);

--
-- Indexes for table `chr_land`
--
ALTER TABLE `chr_land`
  ADD PRIMARY KEY (`lnd_id`);

--
-- Indexes for table `chr_marriage_register`
--
ALTER TABLE `chr_marriage_register`
  ADD PRIMARY KEY (`mrg_id`);

--
-- Indexes for table `chr_panchayath`
--
ALTER TABLE `chr_panchayath`
  ADD PRIMARY KEY (`pan_id`);

--
-- Indexes for table `chr_prayer_community`
--
ALTER TABLE `chr_prayer_community`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `chr_receipts`
--
ALTER TABLE `chr_receipts`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `chr_receipts_gen`
--
ALTER TABLE `chr_receipts_gen`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `chr_receipt_type`
--
ALTER TABLE `chr_receipt_type`
  ADD PRIMARY KEY (`rtp_id`);

--
-- Indexes for table `chr_relations`
--
ALTER TABLE `chr_relations`
  ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `chr_taluk`
--
ALTER TABLE `chr_taluk`
  ADD PRIMARY KEY (`tal_id`);

--
-- Indexes for table `chr_village`
--
ALTER TABLE `chr_village`
  ADD PRIMARY KEY (`vlg_id`);

--
-- Indexes for table `chr_wards`
--
ALTER TABLE `chr_wards`
  ADD PRIMARY KEY (`wrd_id`);

--
-- Indexes for table `cli_bloodgroup`
--
ALTER TABLE `cli_bloodgroup`
  ADD PRIMARY KEY (`Blo_Id`),
  ADD UNIQUE KEY `Blo_id` (`Blo_Id`);

--
-- Indexes for table `cli_bok_diagnose`
--
ALTER TABLE `cli_bok_diagnose`
  ADD PRIMARY KEY (`Bok_Dig_Id`);

--
-- Indexes for table `cli_bok_observation`
--
ALTER TABLE `cli_bok_observation`
  ADD PRIMARY KEY (`Bok_Obv_Id`);

--
-- Indexes for table `cli_booking`
--
ALTER TABLE `cli_booking`
  ADD PRIMARY KEY (`Bok_Id`);

--
-- Indexes for table `cli_bookingprocedures`
--
ALTER TABLE `cli_bookingprocedures`
  ADD PRIMARY KEY (`Bpr_Id`);

--
-- Indexes for table `cli_category`
--
ALTER TABLE `cli_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cli_clinic`
--
ALTER TABLE `cli_clinic`
  ADD PRIMARY KEY (`Cli_id`),
  ADD UNIQUE KEY `com_id` (`Cli_id`);

--
-- Indexes for table `cli_diagnose`
--
ALTER TABLE `cli_diagnose`
  ADD PRIMARY KEY (`Dig_id`);

--
-- Indexes for table `cli_doctor`
--
ALTER TABLE `cli_doctor`
  ADD PRIMARY KEY (`Doc_Id`);

--
-- Indexes for table `cli_observation`
--
ALTER TABLE `cli_observation`
  ADD PRIMARY KEY (`Obs_Id`);

--
-- Indexes for table `cli_patient`
--
ALTER TABLE `cli_patient`
  ADD PRIMARY KEY (`Pat_Id`);

--
-- Indexes for table `cli_procedures`
--
ALTER TABLE `cli_procedures`
  ADD PRIMARY KEY (`Pro_Id`);

--
-- Indexes for table `cli_relationships`
--
ALTER TABLE `cli_relationships`
  ADD PRIMARY KEY (`Rel_Id`);

--
-- Indexes for table `cli_sales_items`
--
ALTER TABLE `cli_sales_items`
  ADD PRIMARY KEY (`Sales_Id`);

--
-- Indexes for table `cli_timeschedule`
--
ALTER TABLE `cli_timeschedule`
  ADD PRIMARY KEY (`TimeSch_Id`);

--
-- Indexes for table `cli_time_intervell`
--
ALTER TABLE `cli_time_intervell`
  ADD PRIMARY KEY (`Ti_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `acc_ledger_trans`
--
ALTER TABLE `acc_ledger_trans`
  MODIFY `tran_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_main`
--
ALTER TABLE `acc_main`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `acc_sub_type`
--
ALTER TABLE `acc_sub_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chqdetails`
--
ALTER TABLE `chqdetails`
  MODIFY `chq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_baptism register`
--
ALTER TABLE `chr_baptism register`
  MODIFY `bap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_cremation_register`
--
ALTER TABLE `chr_cremation_register`
  MODIFY `crr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_diocese`
--
ALTER TABLE `chr_diocese`
  MODIFY `dio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_district`
--
ALTER TABLE `chr_district`
  MODIFY `dist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chr_family_head`
--
ALTER TABLE `chr_family_head`
  MODIFY `hed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_family_member`
--
ALTER TABLE `chr_family_member`
  MODIFY `mbr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_land`
--
ALTER TABLE `chr_land`
  MODIFY `lnd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_marriage_register`
--
ALTER TABLE `chr_marriage_register`
  MODIFY `mrg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_panchayath`
--
ALTER TABLE `chr_panchayath`
  MODIFY `pan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_prayer_community`
--
ALTER TABLE `chr_prayer_community`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_receipts`
--
ALTER TABLE `chr_receipts`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_receipts_gen`
--
ALTER TABLE `chr_receipts_gen`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chr_receipt_type`
--
ALTER TABLE `chr_receipt_type`
  MODIFY `rtp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chr_relations`
--
ALTER TABLE `chr_relations`
  MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chr_taluk`
--
ALTER TABLE `chr_taluk`
  MODIFY `tal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_village`
--
ALTER TABLE `chr_village`
  MODIFY `vlg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chr_wards`
--
ALTER TABLE `chr_wards`
  MODIFY `wrd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cli_bloodgroup`
--
ALTER TABLE `cli_bloodgroup`
  MODIFY `Blo_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cli_bok_diagnose`
--
ALTER TABLE `cli_bok_diagnose`
  MODIFY `Bok_Dig_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cli_bok_observation`
--
ALTER TABLE `cli_bok_observation`
  MODIFY `Bok_Obv_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cli_booking`
--
ALTER TABLE `cli_booking`
  MODIFY `Bok_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_bookingprocedures`
--
ALTER TABLE `cli_bookingprocedures`
  MODIFY `Bpr_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_category`
--
ALTER TABLE `cli_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cli_clinic`
--
ALTER TABLE `cli_clinic`
  MODIFY `Cli_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cli_diagnose`
--
ALTER TABLE `cli_diagnose`
  MODIFY `Dig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cli_doctor`
--
ALTER TABLE `cli_doctor`
  MODIFY `Doc_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_observation`
--
ALTER TABLE `cli_observation`
  MODIFY `Obs_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_patient`
--
ALTER TABLE `cli_patient`
  MODIFY `Pat_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_procedures`
--
ALTER TABLE `cli_procedures`
  MODIFY `Pro_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cli_relationships`
--
ALTER TABLE `cli_relationships`
  MODIFY `Rel_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_sales_items`
--
ALTER TABLE `cli_sales_items`
  MODIFY `Sales_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cli_timeschedule`
--
ALTER TABLE `cli_timeschedule`
  MODIFY `TimeSch_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cli_time_intervell`
--
ALTER TABLE `cli_time_intervell`
  MODIFY `Ti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crm_busn_ntr`
--
ALTER TABLE `crm_busn_ntr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crm_customers`
--
ALTER TABLE `crm_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_district`
--
ALTER TABLE `crm_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crm_enquiry`
--
ALTER TABLE `crm_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_enq_src`
--
ALTER TABLE `crm_enq_src`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crm_enq_status`
--
ALTER TABLE `crm_enq_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crm_product`
--
ALTER TABLE `crm_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `fin_year`
--
ALTER TABLE `fin_year`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `godown`
--
ALTER TABLE `godown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

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
-- AUTO_INCREMENT for table `sett_login`
--
ALTER TABLE `sett_login`
  MODIFY `set_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `set_billtype`
--
ALTER TABLE `set_billtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `set_database`
--
ALTER TABLE `set_database`
  MODIFY `sdb_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `set_device`
--
ALTER TABLE `set_device`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `set_printtype`
--
ALTER TABLE `set_printtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taxgst`
--
ALTER TABLE `taxgst`
  MODIFY `gstid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
