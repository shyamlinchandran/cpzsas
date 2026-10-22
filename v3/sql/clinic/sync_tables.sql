ALTER TABLE `cli_booking`  ADD `is_synced` BOOLEAN NOT NULL ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_bloodgroup`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_category`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_clinic`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_diagnose`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_doctor`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;

ALTER TABLE `cli_patient`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_potency` ADD `is_synced` BOOLEAN NOT NULL , ADD `sync_type` VARCHAR(20) NOT NULL AFTER `is_synced`, ADD `no_gen_in_creation` VARCHAR(10) NOT NULL AFTER `sync_type`, ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_procedures`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_observation`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_timeschedule` ADD `is_synced` BOOLEAN NOT NULL , ADD `sync_type` VARCHAR(20) NOT NULL AFTER `is_synced`, ADD `no_gen_in_creation` VARCHAR(10) NOT NULL AFTER `sync_type`, ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_relationships`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_sales_items`  ADD `is_synced` BOOLEAN NOT NULL  ,  ADD `sync_type` VARCHAR(20) NOT NULL  AFTER `is_synced`,  ADD `no_gen_in_creation` VARCHAR(10) NOT NULL  AFTER `sync_type`,  ADD `sync_id` INT NOT NULL;
ALTER TABLE `cli_time_intervell` ADD `is_synced` BOOLEAN NOT NULL , ADD `sync_type` VARCHAR(20) NOT NULL AFTER `is_synced`, ADD `no_gen_in_creation` VARCHAR(10) NOT NULL AFTER `sync_type`, ADD `sync_id` INT NOT NULL;


