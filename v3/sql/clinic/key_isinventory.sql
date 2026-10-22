INSERT INTO `keys` (`id`, `key`, `value`, `page`, `details`, `published`, `updatedate`) VALUES (NULL, 'isinventory', '0', 'sales', '1', 'yes', CURRENT_TIMESTAMP);

ALTER TABLE `cli_booking` ADD `Bok_Cashtype` ENUM('Cash','Credit') NOT NULL AFTER `Bok_Summery`;

UPDATE `cli_bloodgroup` set no_gen_in_creation =CONCAT( 'S',Blo_Id)
