<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clinic Dash_model
 *
 * @author dimind
 */
class Dash_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.Bok_Id,a.Cus_Id,b.Pat_Name,b.Pat_Phone';
        $this->table = ' cli_booking as a INNER JOIN cli_patient as b on a.Cus_Id=b.Pat_Id';
        $this->column_search = array('a.Pat_Name', 'a.Bok_Id');
        //$this->order = array('a.Bok_Id' => 'desc');
    }
    function where($type) {
        $today = date("Y-m-d");
        if($type!="")
        {
            $this->wherecondition = "where `Bok_Approved` in('".$type."') and  `Bok_date`='".$today."'";
        }
        else
        {
             $this->wherecondition = "";
        }

    }
   

}
