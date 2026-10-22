INSERT INTO `menus` (`id`, `ListName`, `Url`, `parent`, `icon`, `published`, `updatedate`) VALUES (NULL, 'Quotations', 'transaction/quotation/listall', '', '', 'yes', CURRENT_TIMESTAMP)


UPDATE `menus` SET `parent`=115 WHERE parent=158
DELETE FROM menus WHERE id=158

ALTER TABLE `menus` ADD `menu_key` VARCHAR(50) NOT NULL AFTER `published`;