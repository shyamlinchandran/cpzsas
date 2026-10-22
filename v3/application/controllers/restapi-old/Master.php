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
	
	public function customerreg_post($comid){
		$json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		$name = $tmp['name'];
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
		$longitude = '';
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
                'tin' => $tin,
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
		$id = $this->main->createcustomer($comid, $data);
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

    public function devicereg_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $this->main->createdevice($comid, $devid);
        $msg = [
            'status' => TRUE,
            'message' => 'Registred'
        ];
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
			$res ['area'] = $this->main->getarea($comid);
            $res ['sales_orders'] = $this->main->getsales_orders($comid, $login_user_id);
            $res ['billnumber'] = $this->main->getbillnumber($comid, $device);
            $res ['acc_type'] = $this->main->getledgers($comid, 'acc_type');
            $res ['acc_sub_type'] = $this->main->getledgers($comid, 'acc_sub_type');
            $res ['acc_main'] = $this->main->getledgers($comid, 'acc_main');
            $res ['acc_ledgers'] = $this->main->customer_balance($comid);  
			
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
			$res ['area'] = $this->main->getarea($comid);
            $items = $this->main->getnewitems($comid, $device['godown_id'],$date); //godown wise  items details 
            $res ['items'] = $items;
			$res['price_list_details'] = $this->main->price_list_details($comid); 
			$res['price_list'] = $this->main->get_price_list($comid); 
            /*$res ['acc_type'] = $this->main->getledgers($comid, 'acc_type');
            $res ['acc_sub_type'] = $this->main->getledgers($comid, 'acc_sub_type');
            $res ['acc_main'] = $this->main->getledgers($comid, 'acc_main');*/
            $res ['acc_ledgers'] = $this->main->customer_balance($comid,$date);  
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
 
}
