<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Main_model
 *
 * @author Dimind
 */
require_once 'Base_model.php';

class Main_model extends Base_model {

    //put your code here
    public function getcompany($comid) {
        $this->database($comid);
        $qry = "select * from company";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    
    public function login($comid,$username, $password) {
        $this->database($comid);
        $qry = "select count(*) as cnt  from users where username='" . $username . "' and user_password ='" . $password . "'";
        $query = $this->db->query($qry);
        $out = $query->row_array();
        if ($out['cnt'] == 0) {
            $res['cnt'] = 0;
            return $res;
        } else {
            $qry = "select *   from users where username='" . $username . "' and user_password ='" . $password . "'";
            $query = $this->db->query($qry);
            $res['cnt'] = $out['cnt'];
            $res['user'] = $query->row_array();
            return $res;
        }
    }

    public function getenqlist($comid,$userid, $date) {
        $this->database($comid);
        //$date = date_create($date);
        //$date = date_format($date, 'Y-m-d H:i:s');
        $qry = "SELECT * FROM `kas_enquiry` WHERE enq_created_on = '" . $date . "'AND user_id=".$userid;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

}
