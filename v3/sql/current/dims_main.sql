-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 12:53 PM
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
-- Database: `dims_main_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `comkey` varchar(6) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tin` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `menutype` int(11) NOT NULL,
  `company_master` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `name`, `comkey`, `address`, `phone`, `tin`, `details`, `menutype`, `company_master`, `email`) VALUES
(1, 'Dimind Innovation', '123456', 'Pookkatupady', '7559831834', '32', 'kj', 1, 1, 'dimindinnovation8891@gmail.com'),
(2, 'Super Admin', '123', 'Pookkatupady', '7559831834', '32', 'kj', 1, 1, 'dimindinnovation8891@gmail.com');

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
(1, 'Users', 3, 'Rahul', '7676767676', 'fgggghhhgh', '0000-00-00', '', '0000-00-00', 1);

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
(1, 'aaa', 'aaa', 'aaa', '2017-11-30', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE `company_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `discription` varchar(500) NOT NULL
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
(1, 'superuser', 2, 'admin'),
(2, 'user', 1, 'user'),
(3, 'superadmin', 3, 'sadmin');

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
(16, 'isbatch', '1', 'Enable Batch', 'yes');

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
(17, 'Company Settings', NULL, 0, 'fa-barcode	', 'yes'),
(51, 'Menus', 'masters/menu', 103, '', 'yes'),
(86, 'All', 'settings/NewMaster/Users', 104, '', 'yes'),
(91, 'Types', 'settings/CompanyMenuTypes/listall', 17, '', 'yes'),
(95, 'Master', 'settings/CompanyMaster/listall', 17, '', 'yes'),
(96, 'Subscription', 'settings/CompanySubscription/listall', 17, '', 'yes'),
(97, 'Version', 'settings/SoftwareVersion/listall', 17, '', 'yes'),
(98, 'Bill Settings ', 'masters/company_settings', 17, '', 'yes'),
(99, 'Companies', 'masters/company', 17, '', 'yes'),
(100, 'DataTables', 'master/Newmasters/set_database', 17, '', 'yes'),
(101, 'Company_Master', 'masters/company_master', 17, '', 'yes'),
(102, 'Designation ', 'settings/NewMaster/UserTypes', 104, '', 'yes'),
(103, 'Settings', NULL, 0, 'fa-wrench', 'yes'),
(104, 'Users', NULL, 0, ' fa-anchor', 'yes'),
(105, 'Login Settings', 'settings/loginsett/listall', 103, '', 'yes'),
(106, 'Subscription Menu Types', 'settings/SubscriptionMenuTypes/listall', 17, '', '');

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
(36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_all`
--

CREATE TABLE `menu_all` (
  `id` int(11) NOT NULL,
  `ListName` varchar(500) NOT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `published` enum('yes','no') NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_all`
--

INSERT INTO `menu_all` (`id`, `ListName`, `Url`, `parent`, `icon`, `published`, `updatedate`) VALUES
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
(23, 'Finacial Years', 'accounts/finacial', 13, '', 'yes', '2018-01-28 06:45:40'),
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
(46, 'Customers (Sundry Debtor)', 'suppliers/customers', 15, '', 'yes', '2018-03-29 06:01:26'),
(48, 'Sales ', 'transaction/sales/listall/sales', 29, '', 'yes', '2018-01-28 06:45:40'),
(49, 'Stock Ledger', 'reports/stock/leadger', 36, '', 'yes', '2018-01-28 06:45:40'),
(50, 'Settings', NULL, 0, 'fa-gear', 'yes', '2018-01-28 06:45:40'),
(51, 'Menus', 'masters/menu', 50, '', 'yes', '2018-01-28 06:45:40'),
(52, 'Sales Return', 'transaction/sales/listall/sales_return', 29, '', 'yes', '2018-01-28 06:45:40'),
(53, 'Check List', 'reports/accounts/checklist', 36, '', 'yes', '2018-01-28 06:45:40'),
(54, 'Db Download', 'settings/setting/db_download', 50, '', 'yes', '2018-01-28 06:45:40'),
(55, 'Item Group', 'items\\itemgroup', 24, '', 'yes', '2018-01-28 06:45:40'),
(56, 'keys', 'masters/keys', 50, '', 'yes', '2018-01-28 06:45:40'),
(57, 'Type Report', 'reports/sales/type', 36, '', 'yes', '2018-01-28 06:45:40'),
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
(96, 'Set DataTables', 'master/Newmasters/set_database', 15, '', 'yes', '2018-01-28 06:45:40'),
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
(121, 'Gstr1', NULL, 120, '', 'yes', '2018-01-28 06:45:40'),
(122, 'Gstr2', NULL, 120, '', 'yes', '2018-01-28 06:45:40'),
(123, 'General Settings', NULL, 0, 'fa-wrench', 'yes', '2018-01-28 06:45:40'),
(124, 'Godown Transfer', 'master/itemtransfer/list_all', 24, '', 'yes', '2018-03-28 21:08:22'),
(125, 'Purchase Report	', 'reports/purchase/purchasereport', 36, '', 'yes', '2018-01-28 06:45:40'),
(126, 'Sales Reports	', 'reports/Sales/salesreport', 36, '', 'yes', '2018-01-28 06:45:40'),
(127, 'Stock Position', 'stockposition/stockp/listall', 115, '', 'yes', '2018-01-28 06:45:40'),
(128, 'Status Master', 'crm/crm/status_master', 98, '', 'yes', '2018-02-16 21:33:35'),
(129, 'Set Device', 'settings/set_device/device', 50, '', 'yes', '2018-03-20 20:32:33'),
(130, 'State', 'masters/states', 50, '', 'yes', '2018-03-20 20:33:04'),
(131, 'Godown', 'master/godown/godown', 24, '', 'yes', '2018-03-20 20:47:30'),
(132, 'Racks', 'Item/racks', 24, '', 'yes', '2018-03-20 20:50:51'),
(133, 'Login Settings', 'settings/loginsett/listall', 50, '', 'yes', '2018-03-20 23:41:41'),
(134, 'Sales Item', 'transaction/items/listall/tyrsales', 138, '', 'yes', '2018-03-24 20:04:48'),
(135, 'Customer Vehicle', 'masters/customer', 138, '', 'yes', '2018-03-24 20:05:49'),
(136, 'Vehicle Manufacturers', 'masters/manufacturers', 138, '', 'yes', '2018-03-24 20:26:28'),
(137, ' Tyre Sales Report', 'reports/Sales/tyrsalesreport', 138, '', 'yes', '2018-03-24 20:06:44'),
(138, 'Tyres', NULL, 0, 'fa fa-line-chart', 'yes', '2018-03-24 21:10:34');

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
(1, 3, 'bqnalq41gs7nthiqis8mr0hiqcq615fr', '::1', 1, '2018-03-27 12:13:28', '0000-00-00 00:00:00'),
(2, 3, 'abkdqolgcbg1375a15g3g9ab4a5bjflc', '::1', 1, '2018-03-30 08:12:53', '0000-00-00 00:00:00'),
(3, 3, '6b4tp4if33dp7a3g9rif8741u51o6nht', '::1', 0, '2018-03-30 08:56:44', '0000-00-00 00:00:00'),
(4, 3, '97ni6njhakn3c4apkelj2hdcokk422jt', '::1', 0, '2018-03-30 08:58:15', '0000-00-00 00:00:00'),
(5, 3, 'p3iejtcoqe39oisegt55gps382b97vgd', '::1', 0, '2018-07-29 12:45:56', '0000-00-00 00:00:00'),
(6, 3, 'ufs43ktdi7egl16a7akrlr8manua4lnq', '::1', 0, '2018-08-05 07:45:04', '0000-00-00 00:00:00'),
(7, 3, '2cp6vf4fv7b8hk26bveg0mpbdkofsq3q', '::1', 0, '2018-08-05 08:38:55', '0000-00-00 00:00:00'),
(8, 3, '9dentrtfaba1v5p406ibrd67566q4jot', '::1', 0, '2018-08-05 08:39:04', '0000-00-00 00:00:00'),
(9, 3, 'ind3s0u52ck4ipg6miaj0u4qbhq1rltf', '::1', 1, '2018-08-05 08:44:21', '0000-00-00 00:00:00'),
(10, 3, 'vak9aqlcbrlbd3u8obidu68otoi1fck0', '::1', 0, '2018-08-06 15:40:22', '0000-00-00 00:00:00'),
(11, 3, 'noujm0d3sku8j8894bbtato1utf8vtvr', '::1', 0, '2018-08-07 14:02:42', '0000-00-00 00:00:00'),
(12, 3, 'jiqv3tv1cppkn66d1i1dgcc0qns6q4ja', '::1', 0, '2018-08-07 14:17:34', '0000-00-00 00:00:00'),
(13, 3, 'aph0epmsreoi9qjhuffekc78ipqe5v5f', '192.168.1.2', 1, '2018-08-08 06:14:50', '0000-00-00 00:00:00'),
(14, 3, 'mk5b2viotpgtor8v2t363bgjvejjfjge', '::1', 0, '2018-08-08 12:40:25', '0000-00-00 00:00:00'),
(15, 3, 'at43s4f818oqtl5e49b7l6hoej3g7qsq', '::1', 0, '2018-08-08 12:46:44', '0000-00-00 00:00:00'),
(16, 3, '01bhjt7tolf1t26r4f4fbkkdm3qsarot', '::1', 0, '2018-08-09 06:45:37', '0000-00-00 00:00:00'),
(17, 3, '2dl8a1ovaek3ie0f859eu07khi55qhgo', '::1', 0, '2018-08-09 06:47:32', '0000-00-00 00:00:00'),
(18, 3, 'bhk9mak9o5tnhdvulpke245p39ma48sl', '::1', 0, '2018-08-09 06:48:50', '0000-00-00 00:00:00'),
(19, 3, '5r80bjcbapbs5fqncp8gpt9356ra44od', '192.168.1.5', 1, '2018-08-12 15:01:41', '0000-00-00 00:00:00'),
(20, 3, 'o0idro5icjf41grp2eut4h66k3rpa7fu', '::1', 1, '2018-08-20 13:15:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `set_database`
--

CREATE TABLE `set_database` (
  `sdb_Id` int(11) NOT NULL,
  `sdb_name` varchar(200) NOT NULL,
  `sdb_username` varchar(100) NOT NULL,
  `sdb_password` varchar(50) NOT NULL,
  `sdb_server` varchar(50) NOT NULL,
  `com_id` int(11) NOT NULL,
  `sdb_isexcute` tinyint(4) NOT NULL,
  `sdb_curnt` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_database`
--

INSERT INTO `set_database` (`sdb_Id`, `sdb_name`, `sdb_username`, `sdb_password`, `sdb_server`, `com_id`, `sdb_isexcute`, `sdb_curnt`) VALUES
(1, 'dims', 'root', '', 'localhost', 1, 1, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `sub_to_company`
--

CREATE TABLE `sub_to_company` (
  `sub_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_to_company`
--

INSERT INTO `sub_to_company` (`sub_id`, `menu_id`, `details`) VALUES
(1, 13, ''),
(1, 15, ''),
(1, 29, ''),
(1, 36, ''),
(2, 13, ''),
(2, 15, ''),
(2, 24, ''),
(2, 98, ''),
(2, 115, ''),
(2, 123, '');

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
  `is_hide` tinyint(1) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_name`, `user_type`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `user_password`, `company`, `is-active`, `is_hide`, `updatedate`) VALUES
(1, 'shyamlin', 1, 'Kuniyil house', '7559831834', '546464455', 'shyamlinchandran@gmail.com', 'shyamlin', 'shyam123', 1, 1, 0, '2018-01-28 06:46:02'),
(3, '457', 1, '757547', '2345678654', '', '', 'aa', 'aa', 0, 0, 0, '2018-01-28 06:46:02'),
(4, 'sadmin', 3, '', '', '', '', '123', '123', 3, 0, 0, '2018-02-20 13:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `usersold`
--

CREATE TABLE `usersold` (
  `Id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_address` varchar(500) NOT NULL,
  `user_mobile` varchar(13) NOT NULL,
  `user_phone` varchar(13) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  `company` int(11) NOT NULL,
  `is-active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersold`
--

INSERT INTO `usersold` (`Id`, `user_name`, `user_address`, `user_mobile`, `user_phone`, `user_email`, `username`, `user_password`, `company`, `is-active`) VALUES
(1, 'shyamlin', 'Kuniyil house', '7559831834', '546464455', 'shyamlinchandran@gmail.com', 'aa', 'aa', 1, 1);

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `dashboard_user`
--
ALTER TABLE `dashboard_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_all`
--
ALTER TABLE `menu_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sett_login`
--
ALTER TABLE `sett_login`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `set_database`
--
ALTER TABLE `set_database`
  ADD PRIMARY KEY (`sdb_Id`);

--
-- Indexes for table `software_version`
--
ALTER TABLE `software_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usersold`
--
ALTER TABLE `usersold`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `comset_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_subcription`
--
ALTER TABLE `company_subcription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_user`
--
ALTER TABLE `dashboard_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `menu_all`
--
ALTER TABLE `menu_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `menu_to_user`
--
ALTER TABLE `menu_to_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `sett_login`
--
ALTER TABLE `sett_login`
  MODIFY `set_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `set_database`
--
ALTER TABLE `set_database`
  MODIFY `sdb_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `software_version`
--
ALTER TABLE `software_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usersold`
--
ALTER TABLE `usersold`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
