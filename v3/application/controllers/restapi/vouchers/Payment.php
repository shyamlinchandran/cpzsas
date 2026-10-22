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
 * Description of sales
 *
 * @author jijodileep
 */
class Payment extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
    }

    function create_post($comid) {
        $this->load->model('api/Main_model', 'main');
		$company_details = $this->main->getcompany_details($comid);
        //database 
        $global_data['hostname'] = $company_details['sdb_server'];
        $global_data['username'] = $company_details['sdb_username'];
        $global_data['password'] = $company_details['sdb_password'];
        $global_data['database'] =  $company_details['sdb_name'];
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('vouchers_model', 'vouchers');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		$return_id = '0';
        for ($i = 0; $i < count($tmp); $i++) {
            $obj = $tmp[$i];
            $login_user_id = 2;
			if(isset($obj->login_user_id)){
				$login_user_id = $obj->login_user_id;
			}
            $tp = 'n'; // this is for new save          
            $toid = $obj->toid;
            $vid = 0;
			if( isset($obj->voucher_id) ){
				$vid = $obj->voucher_id;
			}
            $typed = $obj->type;
            if ($typed == "Payment") {
                $type = "pay";
            } else if ($typed == "Receipt") {
                $type = "rec";
            }
			$longitude = '';
				if(isset($obj->longitude) ){
					$longitude = $obj->longitude; 
				}
				$latitude = '';
				if(isset($obj->latitude) ){
					$latitude = $obj->latitude; 
				}
			$devid = '';
			if(isset($obj->devid) ){
				$devid = $obj->devid; 
			}
            $amount = $obj->amount;
            $voucher_no = $obj->vid;
            $narration = $obj->narration;
            $billtype = $obj->bill_type;
            $date = $this->vouchers->getDateapi($obj->date, '-');
			$is_exist = $this->vouchers->check_invoice_exist($obj->vid,$obj->bill_type);
			$result_array[$i]['voucher_no'] = $voucher_no;
			if((float) $is_exist < 1 ){
				//$date =  date_format("Y-m-d",$dated);
				//$date = $this->vouchers->getDate($obj->date);

				if ($vid > 0) {
					$tp = 'e';
				}
				$ledger = 1;
				if(strtolower($comid) == 'mces' || strtolower($comid) == 'mcesb'  ){
					$ledger = $this->vouchers->getuserledger($login_user_id,$narration,$billtype);
				}
				if(isset($obj->bank_id)){
					if($obj->bank_id !='' && $obj->bank_id !=0){
						$ledger = $obj->bank_id;
					}
				}
				$data = array(
					'amount' => $amount,
					'longitude'=>$longitude,
					'latitude'=>$latitude,
					'device_id'=>$devid,
					'naration' => $narration,
					'ledger'=>$ledger,
					'bill_type'=>$billtype,
					'trans_date' => $date,
					'created_by' => $login_user_id,
					'salesman'=>$login_user_id,
					'created_date' => date('Y-m-d h:i:sa'),
					'is_post' => "yes",
					'published' => "yes"
				);


				if(isset($obj->bank_pay_method) ){
					$data['bank_pay_method'] =  $obj->bank_pay_method;

					if(isset($obj->bank_ref) ){
						$data['bank_ref'] =  $obj->bank_ref;
					}
					if(isset($obj->card_no) ){
						$data['card_no'] =  $obj->card_no;
					}
					if(isset($obj->gpay_no) ){
						$data['gpay_no'] =  $obj->gpay_no;
					}
					


				}


				if(isset($obj->bank_method) ){
					if(strtolower($obj->bank_method) == 'card' || strtolower($obj->bank_method) == 'gpay'){
						$data['bank_pay_method'] =  $obj->bank_method;
					}

					
					if(strtolower($obj->bank_method) == 'card'){
						if(isset($obj->bank_transaction  ) ){
							$data['card_no'] =  $obj->bank_transaction  ;
							$data['bank_ref'] =  $obj->bank_transaction  ;
						}
					}

					if(strtolower($obj->bank_method) == 'gpay'){
						if(isset($obj->bank_transaction  ) ){
							$data['gpay_no'] =   $obj->bank_transaction ;
						}
					}


				}



				
				 $data['reference'] = '';
				if ($type == 'pay') {
                //$voucher_no = $this->vouchers->generatevouchernumber($type);
					//$result_array[$i]['voucher_no'] = $voucher_no;
					$response = $this->vouchers->UpdatePaymentVoucher($type, $data, $vid, $toid, $voucher_no,1,$ledger);
					$result_array[$i]['voucher_id'] = $response['id'];
					if(strtolower($comid) == 'mces' || strtolower($comid) == 'mcesb' || strtolower($comid) == '123456' ){
						$this->vouchers->sendmobilewhatsapp($comid,$toid,$response['id']);
					}
					if(isset($obj->aeging) ){
						foreach ($obj->aeging as $vouchers) {
							$this->vouchers->mobile_ageing_save($type, $response['id'], 'n',$vouchers->age_id,$vouchers->paid);
							$this->vouchers->mobile_ageing_trans_save($type, $response['id'], 'n',$vouchers->age_id,$vouchers->paid);
						}
					}
				}
				if ($type == 'rec') {
					//$voucher_no = $this->vouchers->generatevouchernumber($type);
				
					//$result_array[$i]['voucher_no'] = $voucher_no;
					$response = $this->vouchers->UpdateReceiptVoucher($type, $data, $vid, $toid, $voucher_no,1,$ledger);
					$result_array[$i]['voucher_id'] = $response['id'];
					if(strtolower($comid) == 'mces' || strtolower($comid) == 'mcesb' || strtolower($comid) == '123456' ){
						$this->vouchers->sendmobilewhatsapp($comid,$toid,$response['id']);
					}
					if(isset($obj->aeging) ){
						foreach ($obj->aeging as $vouchers) {
							$this->vouchers->mobile_ageing_save($type, $response['id'], 'n',$vouchers->age_id,$vouchers->paid);
							$this->vouchers->mobile_ageing_trans_save($type, $response['id'], 'n',$vouchers->age_id,$vouchers->paid);
						}
					}
				}
				$return_id = $return_id.','.$toid;
			}
        }
		$acc_ledgers = $this->vouchers->getreturnledgers($return_id);
        $response = array(
            'valid' => true,
			'acc_ledgers'=>$acc_ledgers,
			'result'=>$result_array,
            'message' => 'success'
        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

}
