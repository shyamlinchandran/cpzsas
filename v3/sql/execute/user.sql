ALTER TABLE `users` ADD `is_hide` BOOLEAN NOT NULL AFTER `is-active`;


ALTER TABLE `sales_items` ADD `item_discription` TEXT NULL AFTER `dis_amt`;
ALTER TABLE `purchase` ADD `is_taxincluded` ENUM('0','1') NOT NULL AFTER `billing_name`;

ALTER TABLE `users` ADD `branch` INT NOT NULL DEFAULT '1' AFTER `is_hide`;
ALTER TABLE `menu_to_user` ADD `is_dashboard` BOOLEAN NOT NULL AFTER `is_delete`;

ALTER TABLE `menus` ADD `menu_series` INT NOT NULL AFTER `icon`;