ALTER TABLE `item`  ADD `tax_ledger_id` INT NOT NULL  AFTER `tax_id`,  ADD `tax_sales_id` INT NOT NULL  AFTER `tax_ledger_id`,  ADD `tax_purchase_id` INT NOT NULL  AFTER `tax_sales_id`;
ALTER TABLE `item` ADD `brand_id` INT NOT NULL AFTER `name`;
ALTER TABLE `item` ADD `item_online` ENUM('no','yes') NOT NULL AFTER `analytics_id`;
ALTER TABLE `item_image` ADD `iim_type` ENUM('image','video') NOT NULL AFTER `iim_id`;