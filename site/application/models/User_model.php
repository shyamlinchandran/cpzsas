<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author jijodileep
 */
require_once('dataTable.php');

class User_model extends DataTable {

    function __construct() {
        parent::__construct();
    }

    function login($username, $password) {
//        $qry = "select AES_DECRYPT(user_password,'" . $this->pass_encryption . "') as password,a.*,b.name as utype,b.dash from users as a inner join user_type as b on a.user_type = b.id  where AES_DECRYPT(user_password,'" . $this->pass_encryption . "')='$password' and username ='$username'";

        $qry = "select AES_DECRYPT(user_password,'" . $this->pass_encryption . "') as password,a.*,b.name as utype,b.dash,c.* from users as a inner join user_type as b on a.user_type = b.id left join user_settings as c on c.user_id=a.Id where AES_DECRYPT(user_password,'" . $this->pass_encryption . "')='$password' and username ='$username'";
        $val = $this->db->query($qry);
        //print_r($val->row_array());
        return $val->row_array();
    }

    function getdb() {
        $qry = "select * from set_database";
        $val = $this->db->query($qry);
        return $val->result_array();
    }

}
