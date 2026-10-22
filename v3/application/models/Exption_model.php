<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exption_model
 *
 * @author jijodileep
 */
class Exption_model  extends DataTable {
    //put your code here
    function __construct() {
        parent::__construct(); 
    }
    function saveerror($err_url,$err_text,$errr_num){
        $qry="INSERT INTO `set_errors` ( `err_url`, `err_text`, `errr_num`) VALUES ('$err_url', '$err_text', '$errr_num');";
        $this->db->query($qry);
    }
}
