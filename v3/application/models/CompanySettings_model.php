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
class CompanySettings_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.address,a.name,b.comset_bank,c.StateName,a.com_id';
        $this->table = 'company as a inner join company_settings as b on a.com_id=b.com_id left JOIN state as c on c.StateID=b.comset_statecode';
       
        $this->column_search = array('a.name');
        $this->order = array('a.com_id' => 'asc');
    }

    function where() {
       
    }
	
	function where_key(){
		$this->select = ' a.key,a.type,a.id';
        $this->table = '`keys` as a';
        $this->column_search = array('a.type');
        $this->order = array('a.type' => 'asc');
		$this->wherecondition =' where a.type!="" ';
	}
	
	function save_key(){
		$id = $this->input->post('id');
		$qry = "select * from `keys` where id=".$id;
		$settings = $this->db->query($qry)->row_array();
		$company_settings = $settings['value'];
		$company_settings =json_decode($company_settings,true);
		$text = '[';
		$j =0;
		$comset_key = $this->input->post('comset_key');
		$comset_value = $this->input->post('comset_value');
		$comset_type = $this->input->post('comset_type');
		if(!$this->input->post('comset_after')){
			$text = $text .'{"key":"'.$comset_key.'","value":"'.$comset_value.'","type":"'.$comset_type.'"}';
			$j =1;
		}
		foreach($company_settings as $item){
			$value = $item['value'];
			if($this->input->post($item['key'])){
				$value = $this->input->post($item['key']);
			}
			if($j>0){
				$text = $text .',';
			}
			$text = $text .'{"key":"'.$item['key'].'","value":"'.$value.'","type":"'.$item['type'].'"}';
			if($this->input->post('comset_after')){
				if($this->input->post('comset_after') == $item['key']){
					$text = $text .',{"key":"'.$comset_key.'","value":"'.$comset_value.'","type":"'.$comset_type.'"}';
				}
			}
			$j++;
		}
		$text = $text .']';
		$data = array(
				'value'=>$text
			);
		$this->db->where('type',$settings['type']);
		$this->db->update('`keys`',$data);
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
	
	function save(){
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher','enquiry','lead_master')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$value = $this->input->post($item['key']);
				if($j>0){
					$text = $text .',';
				}
				$text = $text .'{"key":"'.$item['key'].'","value":"'.$value.'","type":"'.$item['type'].'"}';
				$j++;
			}
			$text = $text .']';
			$data = array(
				'value'=>$text
			);
			$this->db->where('type',$type);
			$this->db->update('`keys`',$data);
		}
		
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
    
	function getsing($id) {
        $qry = "select * from company as a INNER join company_settings as b on a.com_id=b.com_id where a.com_id=".$id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

}
