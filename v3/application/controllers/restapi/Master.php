<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master
 *
 * @author jijodileep
 */
class Master extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('ajax_model', 'ajax');
        $this->load->model('api/Main_model', 'main');
    }

      public function customer_visit_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $userId = $tmp['login_user_id'];
        $longitude = $tmp['longitude'];
        $latitude = $tmp['latitude'];
        $devid = $tmp['devid'];
        $customer_id = $tmp['customer_id'];
        $remarks = $tmp['remarks'];
        $data = array(
            'customer_id'=>$customer_id,
            'user_id'=>$userId,
            'longitude'=>$longitude,
            'latitude'=>$latitude,
            'device_id'=>$devid,
            'remarks'=>$remarks
        );
        
        $this->main->InsertData($comid,'visited_customer',$data);
        $msg = [
            'status' => TRUE,
            'message' => 'Customer Visit'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function UserPunching_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $type = $tmp['type'];
        $userId = $tmp['userId'];
        $longitude = $tmp['longitude'];
        $latitude = $tmp['latitude'];
        $devid = $tmp['devid'];

        $data = array(
            'type'=>$type,
            'userId'=>$userId,
            'longitude'=>$longitude,
            'latitude'=>$latitude,
            'devid'=>$devid
        );
        
        $this->main->InsertData($comid,'user_punching',$data);
        $msg = [
            'status' => TRUE,
            'message' => 'Punching log updated'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function cash_bank_ledgers_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $res ['cash_ledgers'] = $this->main->cash_ledger($comid);  
        $res ['bank_ledgers'] = $this->main->bank_ledger($comid);  
        $msg = [
            'data'=>$res,
            'status' => TRUE,
            'message' => 'Punching log updated'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

   

    public function createArea_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		$name = $tmp['name'];
		
		$longitude = '';
		if(isset($tmp['longitude']) ){
			$longitude = $tmp['longitude']; 
		}
		$longitude = '';
		if(isset($tmp['latitude']) ){
			$latitude = $tmp['latitude']; 
		}

		$data = array(
				'longitude'=>$longitude,
				'latitude'=>$latitude,
                'area' => $name,
		);
			
		
		$id = $this->main->createArea($comid, $data);
		if((int) $id < 1 ){
			$msg = [
				'status' => FALSE,
				'result'=>$id,
				'message' => 'Area Already Exist'
			];
		}else{
			$msg = [
				'status' => TRUE,
				'result'=>$id,
				'message' => 'Area Created'
			];
		}
        $this->response($msg, REST_Controller::HTTP_OK);
	}
	
	public function customerreg_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		$name = $tmp['name'];
        $customer_id = $tmp['id'] ?? 0;
		$tin = $tmp['gstno'];
		$phone = $tmp['phone'];
		$address = $tmp['address'];
		$price_list_id = 0;
		if(isset( $tmp['price_list_id'] ) ){
			$price_list_id = $tmp['price_list_id'];
		}
		$area = 0 ;
		if(isset($tmp['area']) ){
			$area = $tmp['area'];
		}
		$longitude = '';
		if(isset($tmp['longitude']) ){
			$longitude = $tmp['longitude']; 
		}
		$latitude = '';
		if(isset($tmp['latitude']) ){
			$latitude = $tmp['latitude']; 
		}
		$state =45;
		$type = $tmp['type'];
		 $data = array(
				'longitude'=>$longitude,
				'latitude'=>$latitude,
                'name' => $name,
				'area'=>$area,
				//'credit_amount_exceed'=>$credit_amount_exceed ,
				//'credit_amount'=>$credit_amount,
				//'credit_period_exceed'=>$credit_period_exceed,
                'phone' => $phone,
               // 'tin' => $tin,
                'cst' => $state,
                //'gst' => $gst,
                //'email' => $email,
                'address_line1' => $address,
                //'address_line2' => $address_line2,
                //'details' => $details,
                'type' => $type,
                'published' => 'yes',
                //'credit_period' => $credit_period,
                //'bank' => $bank,
                //'account_no' => $account_no,
                //'ifsc_code' => $ifsc_code,
                //'route' => $route,
                //'area' => $area,
               'price_list' => $price_list_id,
            );
			
		$tin =str_replace(' ', '', $tin);
		if (!preg_match("/^([0-9]){2}([A-Za-z]){5}([0-9]){4}([A-Za-z]){1}([0-9]{1})([A-Za-z]){2}?$/", $tin)) { //GSTN validation
			$data['tin'] = '';
		}else{
			$data['tin'] = $tin;
		}
		$id = $this->main->createcustomer($comid, $data,$customer_id);
        $acc_ledgers = $this->main->customerbalance($comid,$id);  
		if((int) $id < 1 ){
			$msg = [
				'status' => FALSE,
				'result'=>$id,
				'acc_ledgers'=>$acc_ledgers,
				'message' => 'Customer Already Exist'
			];
		}else{
			$msg = [
				'status' => TRUE,
				'result'=>$id,
				'acc_ledgers'=>$acc_ledgers,
				'message' => 'Customer Registred'
			];
		}
        $this->response($msg, REST_Controller::HTTP_OK);
	}
	
    public function executive_tracking_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$data['latitude'] = $tmp['latitude'];
        $data['longitude'] = $tmp['longitude'];
        $data['time'] = $tmp['time'];
        $data['speed'] = $tmp['speed'];
        $data['heading'] = $tmp['heading'];
        $data['devid'] = $tmp['devid'];
		if(isset($tmp['login_user_id'])){
			$data['user_id'] = $tmp['login_user_id'];
		}
        $this->main->create_executive_tracking($comid, $devid,$data);
        $msg = [
            'status' => TRUE,
            'message' => 'Executive Tracking Updated'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

	
	public function mobile_log_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$text = $tmp['text'];
        $this->main->createmobile_log($comid, $devid,$text);
        $msg = [
            'status' => TRUE,
            'message' => 'Mobile Error Log Updated'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function devicereg_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $cnt = $this->main->createdevice($comid, $devid);
        if((int) $cnt == 1 ){
            $msg = [
                'status' => TRUE,
                'message' => 'Registred'
            ];
        }

        if((int) $cnt == 2 ){
            $msg = [
                'status' => TRUE,
                'message' => 'Device Already Registered'
            ];
        }

        if((int) $cnt == 0 ){
            $msg = [
                'status' => FALSE,
                'message' => 'Company Does not Exists'
            ];
        }
        
        $this->response($msg, REST_Controller::HTTP_OK);
    }
	
	 public function user_location_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $usr_loc_user = $tmp['user'];
        $usr_loc_longitude = $tmp['longitude'];
        $usr_loc_latitude = $tmp['latitude'];
		$data  = array(
			'devid'=>$devid,
			'usr_loc_user'=>$usr_loc_user,
			'usr_loc_longitude'=>$usr_loc_longitude,
			'usr_loc_latitude'=>$usr_loc_latitude
		);
        $this->main->save_user_location($comid, $data);
        $msg = [
            'status' => TRUE,
            'message' => 'Saved User Location'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function login_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $username = $tmp['username'];
        $passord = $tmp['password'];
        $res = $this->main->login($comid, $devid, $username, $passord);
        if ($res['cnt'] != 0) {
            $msg = [
                'status' => TRUE,
                'result' => $res['user'],
                'message' => 'Login Successful'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } else {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => 'Invalid Login'
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function devicedetails_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$login_user_id = 0;
		if(isset($tmp['login_user_id'])){
			$login_user_id = $tmp['login_user_id'];
		}
        try {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $res ['company_settings'] = $this->main->company_settings($comid);
			if((int) $res['company_settings'][0]['is_taxincluded'] > 0 ){
				 $config ['is_taxincluded'] = TRUE;
			}else{
				$config ['is_taxincluded'] = FALSE;
			}
            $res ['config'] = $config;
            $device = $this->main->getdevice($comid, $devid); //device details    
            $res ['company'] = $this->main->getcompany($comid,$device['branch_id']);
            $res ['device'] = $device;
			$res['point_settings'] =  $this->main->get_point_settings($comid);
            $res ['tax'] = $this->main->gettaxgst($comid, $device['bill_id']);
            $res ['unit'] = $this->main->getunits($comid, $device['bill_id']);
			$res ['category'] = $this->main->getcategory($comid);
			$res ['brand'] = $this->main->getbrand($comid);
			$res ['area'] = $this->main->getarea($comid);
            $res ['sales_orders'] = $this->main->getsales_orders($comid, $login_user_id);
            $res ['billnumber'] = $this->main->getbillnumber($comid, $device);
            $res ['acc_type'] = $this->main->getledgers($comid, 'acc_type');
            $res ['acc_sub_type'] = $this->main->getledgers($comid, 'acc_sub_type');
            $res ['acc_main'] = $this->main->getledgers($comid, 'acc_main');
            $res ['acc_ledgers'] = $this->main->customer_balance($comid);  
            $res ['cash_ledgers'] = $this->main->cash_ledger($comid);  
            $res ['bank_ledgers'] = $this->main->bank_ledger($comid);  
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function getuser_order_post($comid){
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $date = $tmp['date'];
		$login_user_id = 0;
		if(isset($tmp['login_user_id'])){
			$login_user_id = $tmp['login_user_id'];
		}

        try {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $res ['orders'] = $this->main->get_user_orders($comid, $login_user_id,$date);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function updatedevice_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $date = $tmp['date'];
		$login_user_id = 0;
		if(isset($tmp['login_user_id'])){
			$login_user_id = $tmp['login_user_id'];
		}
        try {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $res ['company_settings'] = $this->main->company_settings($comid);
			if((int) $res['company_settings'][0]['is_taxincluded'] > 0 ){
				 $config ['is_taxincluded'] = TRUE;
			}else{
				$config ['is_taxincluded'] = FALSE;
			}
           
            //$res ['config'] = $config;
            //$res ['company'] = $this->main->getcompany($comid);
            $device = $this->main->getdevice($comid, $devid); //device details         
            //$res ['device'] = $device;
            $res ['company_settings'] = $this->main->company_settings($comid);
			$res['point_settings'] =  $this->main->get_point_settings($comid);
            $res ['sales_orders'] = $this->main->getsales_orders($comid, $login_user_id,$date);
            $res ['customers'] = $this->main->getupdatedcustomer($comid,$devid,$date);
            $res ['tax'] = $this->main->getnewtaxgst($comid,$device['bill_id'],$date);
            $res ['unit'] = $this->main->getnewunits($comid,$device['bill_id'],$date);
			$res ['category'] = $this->main->getcategory($comid);
			$res ['brand'] = $this->main->getbrand($comid);
			$res ['area'] = $this->main->getarea($comid);
            $items = $this->main->getnewitems($comid, $device['godown_id'],$date); //godown wise  items details 
            $res ['items'] = $items;
			$res['price_list_details'] = $this->main->price_list_details($comid); 
			$res['price_list'] = $this->main->get_price_list($comid); 
            /*$res ['acc_type'] = $this->main->getledgers($comid, 'acc_type');
            $res ['acc_sub_type'] = $this->main->getledgers($comid, 'acc_sub_type');
            $res ['acc_main'] = $this->main->getledgers($comid, 'acc_main');*/
            $res ['acc_ledgers'] = $this->main->customer_balance($comid,$date);  
             $res ['cash_ledgers'] = $this->main->cash_ledger($comid);  
            $res ['bank_ledgers'] = $this->main->bank_ledger($comid);  
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function billtype_post($comid)
    {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        try
        {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $res ['company_settings'] = $this->main->company_settings($comid);
			if((int) $res['company_settings'][0]['is_taxincluded'] > 0 ){
				 $config ['is_taxincluded'] = TRUE;
			}else{
				$config ['is_taxincluded'] = FALSE;
			}
            $device = $this->main->getdevice($comid, $devid); //device details
            $res['billtype'] = $this->main->getbilltype($comid,$device);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }


      public function ledgerstatement_post($comid)
    {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $date = $tmp['start_date'];
        $end_date = $tmp['end_date'];
        $ledger_id = $tmp['ledger_id'];
        try
        {
            $res['statement'] = $this->main->ledgerstatement($comid,$ledger_id,$date,$end_date);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

     public function itemtransfer_post($comid)
    {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $date = $tmp['date'];
        try
        {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $res ['company_settings'] = $this->main->company_settings($comid);
			if((int) $res['company_settings'][0]['is_taxincluded'] > 0 ){
				 $config ['is_taxincluded'] = TRUE;
			}else{
				$config ['is_taxincluded'] = FALSE;
			}
            $device = $this->main->getdevice($comid, $devid); //device details
            $res['transferitems'] = $this->main->gettransferitems($comid,$device['godown_id'],$date);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
	
	public function ledger_balance_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		try {
			$date = "";
			if( isset($tmp['date']) ){
				$date = $tmp['date'];
			}
			$res ['ledger_balance'] = $this->main->customer_balance($comid,$date);
			$res['customer_points'] = $this->main->customer_points($comid);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
	}
	
	public function getitemstock_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$date = $tmp['date'];
		try {
            $device = $this->main->getdevice($comid, $devid); //device details         
            $res ['stockdetails'] = $this->main->getitemstock($device['godown_id'],$date,$comid);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
		
	}

	public function get_aeging_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$ledger_id = $tmp['ledger_id'];
		$type = $tmp['type'];
		try {
            $res ['aeging'] = $this->main->get_aeging($comid,$ledger_id,$type);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
		
	}
	
    public function config_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $device = $this->main->getdevice($comid, $devid); //device details        
        try {
            $items = $this->main->getitems($comid, $device['godown_id']); //godown wise  items details 
            $res ['items'] = $items;
            $res ['customers'] = $this->main->getcustomer($comid, $device['bill_id']);
			$res['price_list_details'] = $this->main->price_list_details($comid); 
			$res['price_list'] = $this->main->get_price_list($comid); 
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
	
	
	public function customer_info_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$page = $tmp['page'];
		$length = $tmp['length'];
        try {
			$customer_data = $this->main->get_customer_info($comid,$page,$length);
            $res ['customers'] = $customer_data['result'];
            $msg = [
				'start_time'=>$customer_data['start_time'],
				'end_time'=>$customer_data['end_time'],
				'total_rows'=>$customer_data['total_rows'],
                'status' => TRUE,
                'result' => $res,
                'message' => 'Customer Info is attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
	
	public function item_info_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
		$page = $tmp['page'];
		$length = $tmp['length'];
        try {
			$item_data = $this->main->get_item_info($comid,$page,$length);
            $res ['item'] = $item_data['result'];
            $msg = [
                'status' => TRUE,
				'start_time'=>$item_data['start_time'],
				'end_time'=>$item_data['end_time'],
				'total_rows'=>$item_data['total_rows'],
                'result' => $res,
                'message' => 'Item Info is attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
 
}
