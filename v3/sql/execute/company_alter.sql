ALTER TABLE `company` DROP `header`;
ALTER TABLE `company_settings` ADD `com_tax_type` ENUM('GST','VAT') NOT NULL DEFAULT 'GST' AFTER `item_min_rate`;
ALTER TABLE `company_settings` ADD `is_ageing` ENUM('0','1') NOT NULL AFTER `item_min_rate`;


17/11
ALTER TABLE `company_settings` ADD `is_production` ENUM('0','1') NOT NULL AFTER `com_tax_type`, ADD `is_analytics` ENUM('0','1') NOT NULL AFTER `is_production`, ADD `is_costcenter` ENUM('0','1') NOT NULL AFTER `is_analytics`;

22/11

ALTER TABLE `company_settings` ADD `is_multipletax` ENUM('0','1') NOT NULL AFTER `is_costcenter`;

08/01/19
ALTER TABLE `company_settings` ADD `item_image` ENUM('0','1') NOT NULL AFTER `is_multipletax`, ADD `item_video` ENUM('0','1') NOT NULL AFTER `item_image`, ADD `item_alternate` ENUM('0','1') NOT NULL AFTER `item_video`;
