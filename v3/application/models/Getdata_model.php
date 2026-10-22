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
        $qry = "SELECT * FROM `set_database` as a inner join company as b on a.com_id=b.com_id WHERE b.comkey='$loginkey'";
        $val = $this->db->query($qry);
        return $val->row_array();
    }
    function insertlogin($data) {
        $this->db->insert('sett_login', $data);
    }

}
