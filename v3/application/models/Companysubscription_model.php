<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Companysubscription_model
 *
 * @author admin
 */
class Companysubscription_model extends DataTable {
    public function __construct() {
        parent::__construct();
        $this->table = 'company_subcription';
        $this->column_order = array(null, 'subcription_name', 'subcription_version','details'); //set column field database for datatable orderable
        $this->column_search = array('subcription_name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc');
        $this->select = '*';
    }
	 function where() {
        
    }
	
	
	function save() {
        $subcription_name = $this->input->post('subcription_name'); // if it is zero then we will add the item
        $subcription_version = $this->input->post('subcription_version');
        $details = $this->input->post('details');
        $created_date = $this->getDate($this->input->post('created_date', true));
        $created_by = $this->input->post('created_by');		
        $data = array(
            'subcription_name' => $subcription_name,
            'subcription_version' => $subcription_version,
            'details' => $details,
            'created_date' => $created_date,
            'created_by' => $created_by,
        );
       
            $this->db->insert('company_subcription', $data);
        

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}


