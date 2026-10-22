UPDATE `cli_bloodgroup` set no_gen_in_creation =CONCAT( 'S',Blo_Id), sync_type = "server";
UPDATE `cli_booking` set no_gen_in_creation =CONCAT( 'S',Bok_Id), sync_type = "server";
UPDATE `cli_category` set no_gen_in_creation =CONCAT( 'S',cat_id), sync_type = "server";
UPDATE `cli_clinic` set no_gen_in_creation =CONCAT( 'S',Cli_id), sync_type = "server";
UPDATE `cli_diagnose` set no_gen_in_creation =CONCAT( 'S',Dig_id), sync_type = "server";
UPDATE `cli_doctor` set no_gen_in_creation =CONCAT( 'S',Doc_id), sync_type = "server";
UPDATE `cli_observation` set no_gen_in_creation =CONCAT( 'S',Obs_Id), sync_type = "server";
UPDATE `cli_patient` set no_gen_in_creation =CONCAT( 'S',Pat_Id), sync_type = "server";
UPDATE `cli_potency` set no_gen_in_creation =CONCAT( 'S',Pot_Id), sync_type = "server";
UPDATE `cli_procedures` set no_gen_in_creation =CONCAT( 'S',Pro_Id), sync_type = "server";
UPDATE `cli_timeschedule` set no_gen_in_creation =CONCAT( 'S',TimeSch_Id), sync_type = "server"; 

UPDATE `cli_time_intervell` set no_gen_in_creation =CONCAT( 'S',Ti_id), sync_type = "server"; 