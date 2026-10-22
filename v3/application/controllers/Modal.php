<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accounts
 *
 * @author u43255
 */
class Modal extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Mymodal_model', 'item');
    }
	
	public function save_item(){
		$insert_id = $this->item->save();
		echo $insert_id;
		
	}
	public function save_supplier(){
		$insert_id = $this->item->save_supplier();
		echo $insert_id;
		
	}
	
	public function update_company_message(){
		$company_message_comid = $this->input->post('company_message_comid');
		$company_message = $this->input->post('company_message');
		$company_message_comkey = $this->input->post('company_message_comkey');
		$data = array(
			'company_id'=>$company_message_comid,
			'company_key'=>$company_message_comkey,
			'message'=>$company_message
		);
		if($this->input->post('company_message_time')){
			$data['time'] = $this->input->post('company_message_time');
		}
		$this->item->update_company_message($data);
	}

   

}
