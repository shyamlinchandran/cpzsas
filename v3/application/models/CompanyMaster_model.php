<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMaster_model
 *
 * @author admin
 */
class CompanyMaster_model extends DataTable {
    public function __construct() {
        parent::__construct();
        $this->table = 'company_subcription as a inner join company_master as b on a.id =b.subcription';
        $this->column_order = array(null, 'grp_name', 'no_sub_company','contact_number','contact_person', 'address'); //set column field database for datatable orderable
        $this->column_search = array('grp_name', 'contact_person', 'address'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
        $this->select = ' b.id as id,a.subcription_name,b.id as subid,a.*,b.*';
    }
	 function where() {
        
    }
	function Subscription() {
        $qry = 'select id as subid,subcription_name,sum(id*0) as p_id from company_subcription';
        $re = $this->db->query($qry);
        return $re->result_array();
    }
	
	function save() {
        $groupname = $this->input->post('grpname'); // if it is zero then we will add the item
        $no_sub_company = $this->input->post('no_sub_company');
        $contact_person = $this->input->post('contact_person');
        $contact_number = $this->input->post('contact_number');
        $address = $this->input->post('address');
        $created_date = $this->getDate($this->input->post('created_date', true));
        //$chq_status = $this->input->post('chq_status');
        $created_by = $this->input->post('created_by');
        $end_date = $this->getDate($this->input->post('end_date', true));
        $Subscription = $this->input->post('Subscription');
		
		
        $data = array(
            'grp_name' => $groupname,
            'no_sub_company' => $no_sub_company,
            'contact_person' => $contact_person,
            'contact_number' => $contact_number,
            'address' => $address,
            'created_date' => $created_date,
            'created_by	' => $created_by,
            'end_date' => $end_date,
            'subcription' => $Subscription
        );
       
            $this->db->insert('company_master', $data);
        

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
