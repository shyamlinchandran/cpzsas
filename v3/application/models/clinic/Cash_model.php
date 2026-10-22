<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Cash_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.*';
        $this->table = 'cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id ';
        $this->column_search = array('a.Pat_Name', 'a.Bok_Id');
        $this->order = array('a.Bok_Id' => 'desc');
    }

    function where() {
        $this->wherecondition = "where a.Bok_Approved ='Payed' ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and Bok_Date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and Bok_Date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
    }
 
 
   
    function delete($id) {
        $qry = "delete from cli_booking where Bok_Id =" . $id;
        $this->db->query($qry);
    }

   

}
