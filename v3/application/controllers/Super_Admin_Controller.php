<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masters
 *
 * @author u43255
 */
class Super_Admin_Controller extends REST_Controller {


	 function getDate($date, $sep = '') {
        if ($date == "") {
            return;
        }
        if ($sep == '') {
            $sep = '/';
        }
        $parts = explode($sep, $date);
        return "$parts[2]-$parts[1]-$parts[0]";
    }
	
	
    public function syncData_post(){
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $serv_data= [
            'company_name'=> $tmp['company_name'],
            'company_key' =>$tmp['company_key'],
            'start_date' =>$tmp['start_date'],
            'end_date' =>$tmp['end_date'],
            'email' =>$tmp['email'],
            'address' =>$tmp['address'],
            'contact_person' =>$tmp['contact_person'],
            'contact_no' =>$tmp['contact_no'],
            'version' =>$tmp['version'],
            'lisence_key'=>$tmp['lisence_key']
        ];


    $this->db->insert('sync_data', $serv_data);
    $id=$this->db->insert_id();
	
	//if($tmp['sdb_username'] == 'ozoneuser'){
		$company_data = [
			'name'=> $tmp['company_name'],
			'comkey'=>$tmp['company_key'],
			'created_date'=>$this->getDate($tmp['start_date']),
			'end_date'=>$this->getDate($tmp['end_date']),
			'version'=>$tmp['version'],
			'contact_person'=>$tmp['contact_person'],
			'contact_phone'=>$tmp['contact_no'],
			'address'=>$tmp['address'],
			'lisence_key'=>$tmp['lisence_key']
		];
		$this->db->insert('company', $company_data);
		$insert_id=$this->db->insert_id();
		
		$data = [
            'sdb_name'=> $tmp['sdb_name'],
            'sdb_username'=>$tmp['sdb_username'],
            'sdb_password'=>$tmp['sdb_password'],
            'sdb_server'=>'143.244.130.189',
            'com_id' => $insert_id,
        ];

        $this->db->insert('set_database',$data);
	//}
    if($id){

        return json_encode(['data' => 'success']);

    }

 }



}




?>
