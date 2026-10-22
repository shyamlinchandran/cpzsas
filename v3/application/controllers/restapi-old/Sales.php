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
class Sales extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
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
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
		$return_id = '0';
        for ($i = 0; $i < count($tmp); $i++) {
				$this->load->model('sales_model', 'sales');
				//$this->data = array();
				//$this->cesdata = array();
				$obj = $tmp[$i];
				$or_type = $obj->type;
				$billtype = $obj->bill_type;
				/* if ($billtype == '') {
				$invoice = $this->sales->getinoviceno($or_type);
				} else {
				$invoice = $this->sales->getinoviceno($billtype);
				} */
				$result_array[$i]['invoice'] = $obj->invoice;
				$invoice = $obj->invoice;
				$is_exist = $this->sales->check_invoice_exist($obj->invoice,$obj->bill_type);
			if((float) $is_exist < 1 ){
				$invoicedate = $this->sales->getDate($obj->invoice_date, '-');
				$id = 0 ;
				if(isset($obj->sales_id)){
					$id = $obj->sales_id;
				}
				$subtot = $obj->subtot;
				$taxtotal = $obj->taxtotal;
				$rount = $obj->roundoff;
				$cess = 0 ;
				$devid = '';
				if(isset($obj->devid)){
					$devid = $obj->devid;
				}
				if(isset($obj->cess)){
					$cess = $obj->cess;
				}
				$narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
				$saletype = 'b2b';
				if(isset($obj->saletype)){
					$saletype = $obj->saletype;
				}
				$additional_cess = 0;
				if(isset($obj->$additional_cess)){
					$additional_cess = $obj->$additional_cess;
				}
				$login_user_id = 0;
				if(isset($obj->login_user_id)){
					$login_user_id = $obj->login_user_id;
				}
				$estimate_id = 0;
				//if(isset($obj->sales_order_id)){
					//$estimate_id = $obj->sales_order_id;
					//if (is_numeric($estimate_id)) {
						//$this->sales->update_order($estimate_id);
					//}
			//	}
				$sales_ref_type = 'Nil';
				$sales_ref_id = '0';
				$sales_order_invoice = 'Nil';
				if(isset($obj->sales_order_invoice)){
					if($obj->sales_order_invoice != '' ){
						$sales_order_invoice = $obj->sales_order_invoice;
						$estimate_id = $this->sales->get_order_id($obj->sales_order_invoice);
						$this->sales->update_order($estimate_id);
						$sales_ref_type = 'estimate';
						$sales_ref_id = $estimate_id;
					}
				}
				$longitude = '';
				if(isset($obj->longitude) ){
					$longitude = $obj->longitude; 
				}
				$latitude = '';
				if(isset($obj->latitude) ){
					$latitude = $obj->latitude; 
				}
				if(isset($obj->customer_id) ){
					if($obj->customer_id != ''){
						$return_id = $return_id.','.$obj->customer_id;
					}
				}
				$cash_amount = 0;
				if($obj->cash_type == 'Cash'){
					$cash_amount =  $obj->total;
				}
				if($obj->cash_type == 'cash'){
					$cash_amount =  $obj->total;
				}
				$redeemed_amount = 0 ;
				$redeemed_points = 0 ;
				if(isset($obj->redeemed_amount) ){
					$redeemed_amount =  $obj->redeemed_amount;
				}
				if(isset($obj->redeemed_points) ){
					$redeemed_points =  $obj->redeemed_points;
				}
				$data = array(
					'ref_no'=>'',
					'redeemed_amount'=>$redeemed_amount,
					'redeemed_points'=>$redeemed_points,
					'longitude'=>$longitude,
					'device_id'=>$devid,
					'is_mobile'=>1,
				//	'sales_ref_type'=>$sales_ref_type,
					//'sales_ref_id'=>$sales_ref_id,
					'despatch_details'=>$or_type,
					'terms_condition'=>$sales_order_invoice,
					'latitude'=>$latitude,
					'cash_amount'=>$cash_amount,
					'estimate_id'=>$estimate_id,
					'invoice_date' => $invoicedate,
					'status'=>'pending',
					'customer_id' => $obj->customer_id,
					'saletype' => $saletype,
					'additional_cess'=>$additional_cess,
					'cash_type' => $obj->cash_type,
					'delivery_date' => $this->sales->getDate($obj->delivery_date, '-'),
					'credit_eod' => $this->sales->getDate($obj->credit_eod, '-'),
					'total' => $obj->total,
					'cess'=>$cess,
					'salesman' => $login_user_id,
					'route' => $obj->route,
					'vehicle' => $obj->vehicle,
					'area' => $obj->area,
					'tax' => $obj->tax,
					'ref_amount' => $obj->ref_amount,
					'tax_id' => 0,
					'advance' => $obj->advance,
					'other' => $obj->other,
					'freight' => $obj->freight,
					'discount' => $obj->discount,
					'roundoff' => $obj->roundoff,
					'invoice' => $invoice,
					'ref_id' => $obj->ref_id,
					'created_date' => date('Y-m-d H:i:s', time()),
					'narration' => $narration,
					'created_by' => $login_user_id,
					'type' => $or_type,
					'bill_type' => $billtype,
					'printtype' => 1,
					'cost_center'=>1,
					'cusname' => $obj->cusname,
					'cusdetails' => $obj->cusdetails,
					'cusemail' => $obj->cusemail,
					'published' => 'yes'
				);
			
				$company_settings = $this->sales->getCompanySettings();
				$is_taxincluded = $company_settings[0]['is_taxincluded'];
				$insert_id = 0;
				if ($id == 0) {
					$insert_id = $this->sales->InsertSales($data,1);
					$result_array[$i]['sales_id'] = $insert_id;
				} else {
					$this->sales->UpdateSales($data, $id, $or_type);
					$insert_id = $id;
					$result_array[$i]['sales_id'] = $insert_id;
				}
				$bill_margin = 0;
				$this->sales->get_sales_point($obj->total,$obj->customer_id,$insert_id);
				foreach ($obj->salesitems as $sale) {
					$dis_amt = 0 ;
					if((float) $sale->quantity >0 && (float) $sale->rate > 0 &&  (float) $sale->discount > 0){
						$tota = (float) $sale->quantity * (float) $sale->rate ;
						$dis_amt = (float) $tota * $sale->discount/100;
					}
					$itm_ces_id = 0;
					if(isset($sale->itm_ces_id)){
						$itm_ces_id	= $sale->itm_ces_id;
					}
					$itm_ces_name = '';
					if(isset($sale->itm_ces_name)){
						$itm_ces_name	= $sale->itm_ces_name;
					}
					$itm_ces_per = 0;
					if(isset($sale->itm_ces_per)){
						$itm_ces_per = $sale->itm_ces_per;
					}
					$itm_raw_ces = 0 ;
					if(isset($sale->itm_raw_cess)){
						$itm_raw_ces = $sale->itm_raw_cess;
					}
					$ces = 0;
					if(isset($sale->ces)){
						$ces = $this->sales->getces($sale->ces);
					}
					$ces_amt = 0;
					if(isset($sale->ces_amt)){
						$ces_amt = $sale->ces_amt;
					}
					$godown = 1;
					if((int)  $sale->godown > 0){
						$godown = $sale->godown;
					}
					$prate = 0 ;
					if(isset($sale->prate)){
						if((int)  $sale->prate > 0){
							$prate = $sale->prate;
						}
					}
					$actual_quantity = 0;
					$damage_quantity = 0;
					if(isset($sale->issueqty)){
						$actual_quantity = $sale->issueqty;
					}
					if(isset($sale->damageqty)){
						$damage_quantity = $sale->damageqty;
					}
					$data_items = array(
						'sales_id' => $insert_id,
						'item_id' => $sale->item_id,
						'item_rate'=>$prate,
						'mar_pur_rate'=>$prate,
						'godown' => $godown,
						'sales_ref_type'=>$sales_ref_type,
						'sales_ref_id'=>$sales_ref_id,
						'actual_quantity'=>$actual_quantity,
						'damage_quantity'=>$damage_quantity,
						'itm_ces_id'=>$itm_ces_id,
						'itm_ces_name'=>$itm_ces_name,
						'itm_ces_per'=>$itm_ces_per,
						'itm_raw_ces'=>$itm_raw_ces,
						'ces'=>$ces,
						'ces_amt'=>$ces_amt,
						'is_taxincluded'=>$is_taxincluded,
						'free_quantity'=>0,
						'batch'=>'',
						'unit_id' => $sale->unit_id,
						'base_unit_id' => $sale->base_unit_id,
						'quantity' => $sale->quantity,
						'rate' => $sale->discount,
						'dis_amt'=>$dis_amt,
						'mrp' => $sale->rate,
						'tax_id' => $sale->tax_id,
						'tax' => $sale->tax,
						'discount' => 0,
						'total' => $sale->total,
						'published' => 'yes'
					);
					$prate = $this->sales->getquantity($data_items['unit_id'], $prate, $data_items['item_id']);
					//$data_items['mrp'] = $this->sales->getboxrate($sale->item_id,$sale->rate,$sale->unit_id);
					if((int) $is_taxincluded < 1 ){
						$data_items['mrp'] = ((float) $sale->total - (float) $sale->tax - (float) $itm_raw_ces ) / (float) $sale->quantity;
					}
					$data_items['item_rate'] =  $prate;
					$sale_total = ($sale->quantity *  $sale->rate ) - $sale->discount;
					if((int)$is_taxincluded > 0  ){
						//$sale_total = ((float) $sale->quantity *  (float) $sale->rate ) - $sale->discount - $itm_raw_ces - $ces_amt - $sale->tax;
					}
					$sale_total = (float) $sale->total - (float) $sale->tax - (float) $itm_raw_ces;
					if((int)$is_taxincluded > 0 && $saletype == 'b2c' ){
						$sale_total = (float) $sale_total - (float) $ces_amt;
					}
					$item_margin = (float) $sale_total - (float) $prate *  (float) $sale->quantity ;
					$data_items['item_margin'] = $item_margin;
					$bill_margin = (float) $bill_margin + (float) $item_margin;
					$this->sales->InsertSales_items($data_items, $or_type, $invoicedate,1,1,$invoice,$saletype);
					$data_sales =array(
						'bill_margin'=>$bill_margin
					);
					$this->sales->update_bill_margin($data_sales,$insert_id);
				}
				if($or_type != 'estimate'){
					$this->sales->savesub($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id,1,1);
				}
			}
        }
		$acc_ledgers = $this->sales->getreturnledgers($return_id);
		$customer_points = $this->main->customer_points($comid);
        $msg = [
            'status' => TRUE, 
			'customer_points'=>$customer_points,
			'acc_ledgers'=>$acc_ledgers,
			'result' => $result_array,
            'message' => 'items are attached to the result'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
