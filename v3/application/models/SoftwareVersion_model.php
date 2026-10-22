<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SoftwareVersion_model
 *
 * @author admin
 */
class SoftwareVersion_model extends DataTable {
    public function __construct() {
        parent::__construct();
        $this->table = 'software_version';
        $this->column_order = array(null, 'version_name', 'folder_path','db_path','created_date', 'created_by'); //set column field database for datatable orderable
        $this->column_search = array('version_name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
        $this->select = '*';
    }
	 function where() {
        
    }
	
	
	function save() {
        $version_name = $this->input->post('version_name'); // if it is zero then we will add the item
        $folder_path = $this->input->post('folder_path');
        $db_path = $this->input->post('db_path');
        $created_date = $this->getDate($this->input->post('created_date', true));
        $created_by = $this->input->post('created_by');		
        $data = array(
            'version_name' => $version_name,
            'folder_path' => $folder_path,
            'db_path' => $db_path,
            'created_date' => $created_date,
            'created_by' => $created_by,
        );
       
            $this->db->insert('software_version', $data);
        

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}


