-- --------------------------------------------------------
-- Host:                         147.93.154.248
-- Server version:               10.11.13-MariaDB-0ubuntu0.24.04.1 - Ubuntu 24.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table msa_2026.item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `fin_sync_id` int(11) NOT NULL DEFAULT 0,
  `item_main_id` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `supplier` int(11) NOT NULL,
  `op_old` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `free_qty` decimal(10,2) NOT NULL DEFAULT 0.00,
  `free_qty_for` decimal(10,2) NOT NULL DEFAULT 0.00,
  `part_no` varchar(50) NOT NULL,
  `part_no1` varchar(500) NOT NULL,
  `part_no2` varchar(500) NOT NULL,
  `make_model` varchar(50) NOT NULL,
  `field_1` varchar(50) DEFAULT NULL,
  `field_2` varchar(50) DEFAULT NULL,
  `field_3` varchar(50) DEFAULT NULL,
  `field_4` varchar(50) DEFAULT NULL,
  `field_5` varchar(50) DEFAULT NULL,
  `field_6` varchar(50) DEFAULT NULL,
  `field_7` varchar(50) DEFAULT NULL,
  `field_8` varchar(50) DEFAULT NULL,
  `field_9` varchar(50) DEFAULT NULL,
  `field_10` varchar(50) DEFAULT NULL,
  `serv_time` time NOT NULL,
  `item_size_id` int(11) NOT NULL DEFAULT 0,
  `name_lan` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `barcode` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tutionfee` decimal(11,0) NOT NULL,
  `examfee` decimal(10,0) NOT NULL,
  `certificatefee` decimal(10,3) NOT NULL,
  `otherfee` decimal(10,3) NOT NULL,
  `university` int(11) NOT NULL,
  `price_code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `item_category_id` int(100) DEFAULT NULL,
  `item_group_id` int(11) NOT NULL,
  `unit_id` int(100) DEFAULT NULL,
  `item_wt` decimal(10,2) NOT NULL,
  `end_unit` int(11) NOT NULL,
  `end_unit_kg` decimal(10,2) NOT NULL,
  `item_color_id` int(11) NOT NULL,
  `sub_unit_one` int(11) NOT NULL DEFAULT 0,
  `sub_unit_two` int(11) NOT NULL DEFAULT 0,
  `open_stock` decimal(10,2) DEFAULT NULL,
  `open_stock_wt` decimal(10,3) NOT NULL,
  `current_stock` decimal(10,2) DEFAULT NULL,
  `reorder_point` int(11) NOT NULL,
  `min_level` int(11) NOT NULL,
  `max_level` int(11) NOT NULL,
  `rack` int(11) NOT NULL,
  `row` int(11) NOT NULL DEFAULT 0,
  `prate` decimal(10,3) DEFAULT NULL,
  `srate` decimal(10,3) DEFAULT NULL,
  `special_rate2` decimal(10,2) NOT NULL,
  `special_rate` decimal(10,3) NOT NULL,
  `wh_rate` decimal(10,3) NOT NULL,
  `MRP` int(11) NOT NULL,
  `open_stk_rate` float(10,3) NOT NULL,
  `openstkrate` float(10,3) NOT NULL,
  `commission` decimal(10,3) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `tax_ledger_id` int(11) NOT NULL,
  `tax_sales_id` int(11) NOT NULL,
  `tax_purchase_id` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `package_date` date NOT NULL,
  `date` date NOT NULL,
  `hsncode` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sq_hgt` decimal(10,2) NOT NULL,
  `sq_wt` decimal(10,2) NOT NULL,
  `sqft` decimal(10,4) NOT NULL,
  `godown` int(11) NOT NULL DEFAULT 1,
  `description` varchar(1500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `material_type` int(11) NOT NULL,
  `analytics_id` int(11) NOT NULL,
  `is_autobarcode` enum('0','1') NOT NULL DEFAULT '0',
  `item_online` enum('no','yes') NOT NULL,
  `cess_id` int(11) NOT NULL DEFAULT 0,
  `cigarette_cess_amount` decimal(10,2) NOT NULL,
  `cigarette_cess_percentage` decimal(10,2) NOT NULL,
  `war_period` varchar(500) NOT NULL DEFAULT '',
  `landing_cost` float DEFAULT NULL,
  `lcode` varchar(10) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `tax_on_mrp` tinyint(1) NOT NULL DEFAULT 0,
  `myrate` decimal(20,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25125 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table msa_2026.item_godown
CREATE TABLE IF NOT EXISTS `item_godown` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `godown_id` int(11) NOT NULL,
  `batch` varchar(500) NOT NULL,
  `EAN` varchar(500) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `item_srate` decimal(10,3) NOT NULL DEFAULT 0.000,
  `mystock` decimal(10,3) NOT NULL DEFAULT 0.000,
  `item_prate` decimal(10,3) NOT NULL DEFAULT 0.000,
  `item_whrate` decimal(10,3) NOT NULL DEFAULT 0.000,
  `item_mrp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `item_opnstkrate` decimal(10,3) NOT NULL DEFAULT 0.000,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `published` enum('yes','no') NOT NULL,
  `current_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `open_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `open_stock_wt` decimal(10,3) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29005 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Data exporting was unselected.

-- Dumping structure for table msa_2026.item_ledger
CREATE TABLE IF NOT EXISTS `item_ledger` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(100) DEFAULT NULL,
  `batch` varchar(500) NOT NULL,
  `open_stock` decimal(10,2) DEFAULT 0.00,
  `voucher_no` varchar(500) NOT NULL DEFAULT 'voucher',
  `quantity` decimal(10,2) DEFAULT NULL,
  `item_base_quantity` decimal(10,2) NOT NULL,
  `item_unit_rate` decimal(10,2) NOT NULL,
  `item_tax` int(11) NOT NULL,
  `voucher_costcenter` int(11) NOT NULL,
  `voucher_branch` int(11) NOT NULL,
  `voucher_billtype` int(11) NOT NULL,
  `item_value` decimal(10,3) NOT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_type` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `trans_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `trans_id` int(100) DEFAULT NULL,
  `rate` decimal(10,3) DEFAULT NULL,
  `MRP` decimal(10,3) DEFAULT NULL,
  `tax_id` int(100) DEFAULT NULL,
  `godown` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  `pu` enum('yes','no') NOT NULL DEFAULT 'yes',
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=367167 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
