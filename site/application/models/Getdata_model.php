<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Getdata
 *
 * @author jijodileep
 */
class Getdata_model extends CI_Model {

    //put your code here
    function getdb($loginkey) {
        $qry = "SELECT CASE WHEN CURDATE() > end_date then 1 else 0 end as updatefin,a.*,b.*,c.version_name FROM `set_database` as a inner join company as b on a.com_id=b.com_id inner join software_version as c on c.id=b.version WHERE b.comkey='$loginkey'";
        // print_r($qry);
        $val = $this->db->query($qry);
        return $val->row_array();
    }
    function insertlogin($data) {
        $this->db->insert('sett_login', $data);
    }
	
	function getfinantialdb($loginkey){
		$qry = "SELECT b.sdb_Id,b.sdb_name ,b.sdb_username,b.sdb_password,b.sdb_server,b.com_id,a.comyear as year_id FROM `company` as a INNER JOIN set_database as b on a.com_id = b.com_id  WHERE base_comkey = '".$loginkey."'";
		return $this->db->query($qry)->result_array();
	}

}
