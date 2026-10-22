ALTER TABLE `chr_relations` ADD `rel_series` INT NOT NULL AFTER `rel_name`;
UPDATE chr_relations JOIN (SELECT @rank := 0) r SET rel_series=@rank:=@rank+1
ALTER TABLE `chr_family_head` CHANGE `panchayath_id` `panchayath` VARCHAR(250) NOT NULL;
ALTER TABLE `chr_diocese` ADD `is_default` ENUM('yes','no') NOT NULL AFTER `dio_name`;
ALTER TABLE `chr_family_head` ADD `parish_id` INT NOT NULL AFTER `hed_name`;
ALTER TABLE `chr_relations` ADD `rel_gender` ENUM('male','female') NOT NULL AFTER `rel_series`;