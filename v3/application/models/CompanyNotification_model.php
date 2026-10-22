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
class CompanyNotification_model extends DataTable {

    public function __construct() { 
        parent::__construct();
        $this->select = ' a.*,b.name,b.com_id';
        $this->table = 'support as a   left join company as b on a.company = b.com_id';
        $this->wherecondition = ' where a.is_delete = 0';
        $this->column_search = array('a.type','b.name');
        $this->order = array('a.id' => 'desc');
    }

    function where() {
       
    }
	
	
	
	function save(){
  		$id = $this->input->post('id');
		$company_id = $this->input->post('company_id');
		$type = $this->input->post('type');
		$message = $this->input->post('message');
		$time_out = $this->input->post('time_out');
		
		$data = array(
			'company' => $company_id,
			'type' => $type,
			'message' => $message,
			'timeout' => $time_out
		);
		
		if($id > 0) {
			// Update existing record
			$this->db->where('id', $id);
			$this->db->update('support', $data);
		} else {
			// Insert new record
			$this->db->insert('support', $data);
		}
		
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
    
	function getsing($id) {
        $qry = "select * from support where id=".$id." and is_delete = 0";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	
	function getcompanies() {
		$qry = "select com_id, name from company order by name asc";
		$result = $this->db->query($qry)->result_array();
		$html = '<option value="">Select</option>';
		foreach($result as $row) {
			$html .= '<option value="'.$row['com_id'].'">'.$row['name'].'</option>';
		}
		echo $html;
	}
	
	function delete($id) {
		$data = array('is_delete' => 1);
		$this->db->where('id', $id);
		$this->db->update('support', $data);
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );
        echo json_encode($response);
	}
	
	function getbytype($type) {
		$company_id = $this->session->userdata('login_base_comid');
		$qry = "select a.*, b.name from support a left join company b on a.company = b.com_id where a.type = '".$type."' and a.company = ".$company_id." and a.is_delete = 0 order by a.id desc limit 5";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}

}
