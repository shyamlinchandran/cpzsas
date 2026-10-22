<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once('dataTable.php');

class Stockjournal_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = 'stock_journal left join users on stock_journal.createdby =users.id  ';
        $this->column_order = array(null, 'voucher_no', null); //set column field database for datatable orderable
        $this->column_search = array('voucher_no'); //set column field database for datatable searchable 
        $this->order = array('stock_journal.id' => 'desc'); // default order 
        $this->select = 'stock_journal.*,user_name,DATE_FORMAT(CONVERT_TZ(updateddate,"+00:00","+05:30"),"%d/%m/%Y-%H:%i:%S ") as created_time';
		$this->wherecondition = ' where published ="yes" ';
    }


	 function generateDirectEway($id){
        $qry = "SELECT i.name as itemname,vehicle_no,vehicle,e_way_status,u.`name` AS code, h.hsncode AS hsn ,tg.godown_location AS tlocation,tg.godown_pincode  as tpincode,  fg.godown_location,fg.godown_pincode ,fg.godown_name,fg.godown_address,tg.godown_name AS gname,tg.godown_address AS taddress,fg.godown_code AS pin,tg.godown_code tpin, t.GST,i.tax_id,a.invoice,DATE_FORMAT(a.date,'%d/%m/%Y') as dates,from_id,b.qty,b.item_rate,b.to_id,b.qty*b.item_rate  as bef,distance, (b.qty*b.item_rate) + (b.qty*b.item_rate * t.GST) / 100 total, (b.qty*b.item_rate * t.GST) / 100 AS tax FROM item_transfer  AS a INNER JOIN item_transfer_sub AS b ON a.id = b.transfer_id AND b.published = 'yes' INNER JOIN item AS i ON i.id = b.item_id INNER JOIN taxgst AS t ON t.gstid = i.tax_id INNER JOIN ims_godown AS fg ON fg.id = a.from_id  INNER JOIN ims_godown AS tg ON tg.id = b.to_id LEFT JOIN hsncode AS h ON h.hsnid = i.hsncode LEFt JOIN units AS u ON u.id = b.unit_id  where e_way_status = 0 and a.id = ".$id;
        $sale_data = $this->db->query($qry);
		if($sale_data->num_rows() < 1){
			print_r('E-way Already Generated');
			return;
		}else{
			$sale_data = $sale_data->result_array();
		}
        $settings = $this->getCompanySettings();
        $gstcafe_api_key = '';
        if(isset($settings[0]['gstcafe_api_key'] ) ){
            $gstcafe_api_key = $settings[0]['gstcafe_api_key'];
        }

        $gstcafe_api_password = '';
        if(isset($settings[0]['gstcafe_api_password'] ) ){
            $gstcafe_api_password = $settings[0]['gstcafe_api_password'];
        }

        $gstcafe_api_gstin = '';
        if(isset($settings[0]['gstcafe_api_gstin'] ) ){
            $gstcafe_api_gstin = $settings[0]['gstcafe_api_gstin'];
        }

        $qry_com ="select * from company order by id asc limit 0,1";
        $com_data = $this->db->query($qry)->row_array();
        $invoice_date = $sale_data[0]['dates'];
			$data['supplyType'] = "O";        // Outward
            $data['subSupplyType'] = 5;
			$data['subSupplyDesc'] = "Stock transfer to another godown";
            $data['docType'] = "CHL";
            $data['docNo'] = $sale_data[0]['invoice'];
            $data['docDate'] = $invoice_date;
            $data['fromStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['actFromStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['fromGstin'] = $settings[0]['tin'];
            $data['fromAddr1'] = $sale_data[0]['godown_address'];
            $data['fromAddr2'] = $sale_data[0]['godown_address'];
            // $data['fromPlace'] = $settings['location'];
            $data['fromPlace'] = $sale_data[0]['godown_location'];

            $data['fromPincode'] = $sale_data[0]['godown_pincode'];
            //$data['fromPincode'] = '686665';

            $data['toGstin'] = $settings[0]['tin'];
            $data['toTrdName'] = $settings[0]['name'];
            $data['toAddr1'] = $sale_data[0]['taddress'];
            $data['toAddr2'] = $sale_data[0]['taddress'];

            $data['toPlace'] = $sale_data[0]['tlocation'];
            $data['toPincode'] = $sale_data[0]['tpincode'];
            $data['actToStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['toStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['transactionType'] = 1;
            $data['otherValue'] = 0;

              $length = sizeof($sale_data );
              $AssVal = 0;
			  $tot = 0 ;
              $TotInvVal = 0;
              $CgstVal = 0;
              $SgstVal = 0;
              $CesAmt = 0 ;
              $IgstVal =0;
              for($i = 0;$i<$length;$i++){
                  $ItemList[$i]['name']= $sale_data[$i]['itemname'];
                  $ItemList[$i]['productDesc']= $sale_data[$i]['itemname'];
                  $ItemList[$i]['hsnCode']= $sale_data[$i]['hsn'];
                  $ItemList[$i]['quantity']= $sale_data[$i]['qty'];
                  $ItemList[$i]['qtyUnit']= $sale_data[$i]['code'];
                  $ItemList[$i]['taxableAmount']= $sale_data[$i]['bef'];
                  $ItemList[$i]['cessRate']= 0;

                   $tot =  $tot + $sale_data[$i]['total'];
                  $AssVal = (float) $AssVal + $sale_data[$i]['bef'];
                  $TotInvVal = (float) $TotInvVal + (float) $sale_data[$i]['bef'];


                  if(substr($settings[0]['tin'], 0, 2) == substr($settings[0]['tin'], 0, 2)){
                      if($sale_data[$i]['tax'] > 0 ){
                          $ItemList[$i]['cgstRate']= round($sale_data[$i]['GST']/2,2);
                          $ItemList[$i]['sgstRate']= round($sale_data[$i]['GST']/2,2);
                          $ItemList[$i]['GST']= round($sale_data[$i]['GST']/2,2);
                          $CgstVal = (float)  $CgstVal + (float) $sale_data[$i]['tax']/2;
                          $SgstVal = (float)  $SgstVal + (float) $sale_data[$i]['tax']/2;
                      }else{
                          $ItemList[$i]['TotItemVal']= $sale_data[$i]['total'];
                          $ItemList[$i]['cgstRate']= round(0,2);
                          $ItemList[$i]['sgstRate']= round(0,2);
                      }
                      $ItemList[$i]['igstRate']= 0;
                  }else{
                         $ItemList[$i]['cgstRate']= round($sale_data[$i]['GST']/2,2);
                            $ItemList[$i]['GST']= round($sale_data[$i]['GST']/2,2);
                          $IgstVal = (float) $IgstVal + (float)$sale_data[$i]['tax'];
                          $ItemList[$i]['igstRate']= round($sale_data[$i]['GST'],2);
                  }
                  
                  
              }
              //  print_r( $ItemList);
              $data['ItemList'] = $ItemList;
              $data['totalValue'] = round($TotInvVal,2);
              $data['cgstValue'] = round($CgstVal,2);
              $data['sgstValue'] = round($CgstVal,2);
              $data['igstValue'] = $IgstVal;
              $data['cessValue'] = $CesAmt;
              $data['cessNonAdvolValue'] = $CesAmt;
              $data['totInvValue'] =$tot ;


              $EwbDtls['Distance'] = $sale_data[0]['distance'];
              $EwbDtls['TransDocDt'] = $invoice_date;
          //  $EwbDtls['VehNo'] = '';
          //  $EwbDtls['VehType'] = '';
          // $EwbDtls['TransDocNo'] = '';
              $data['EwayBillDetails'] = $EwbDtls;
              

              $data['transporterId'] = "";
              $data['transporterId'] = "";
              $data['transDocNo'] = "";
              $data['transMode'] =1;
              $data['transDistance'] ="26";
              $data['transDocDate'] = $invoice_date;
              $data['vehicleNo'] =$sale_data[0]['vehicle_no'];
              $data['vehicleType'] = "R";
              $data['distance'] = "26";
            // print_r($data);exit;
            $ch = curl_init();  
            $headers  = [
				'Content-Type: application/json',
				'Accept: application/json',
                'GSTIN:'.$settings[0]['tin'],
                'CustomerId:ASP10515',
                'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
                'APISecret:F6MemwSp9TaygzOT',
                'Source:API',
                'Environment-type:production',
                'Username:'.$gstcafe_api_key,
                'Password:'.$gstcafe_api_password

			];
			//print_r($headers);exit;
            // $headers  = [
			// 	'Content-Type: application/json',
			// 	'Accept: application/json',
            //     'GSTIN:32AAFCP0535R015',
            //     'CustomerId:ASP10515',
            //     'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
            //     'APISecret:F6MemwSp9TaygzOT',
            //     'Source:API',
            //     'Environment-type:Sandbox',
            //     'Username:speaktosatishkr',
            //     'Password:India@123'

			// ];
            $postData = json_encode($data);
			//print_r($postData);exit;
			//print_r($postData);
            curl_setopt($ch, CURLOPT_URL,"https://ewayapi.mygstcafe.com/managed/v1.03/GenerateEwayBill");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );           
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $result     = curl_exec ($ch);
			//print_r($result);
         //   print_r($postData);
//             if (curl_errno($ch)) {
//     echo "cURL Error: " . curl_error($ch) . "\n";
// } else {
//     echo "Response:\n";
//     print_r($result);
// }
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $status  = 0 ;
            $error = 'Api Error';
            $return = '';
            $EwbNo = '';
            $EwbDt = '';
            $EwbValidTill = '';
            if($statusCode ==200 ){
                $result_php = json_decode($result);
                print_r($result_php );
                if($result_php->status > 0 ){
                    $status  = 1 ;
                    $error = '';
                    $res = $result_php->data;
                    $return = 'e-way generated Successfully';

                    $EwbNo = $res->ewayBillNo;
                    $EwbDt = $res->ewayBillDate;
                    $EwbValidTill = $res->validUpto;
                    $qry = 'UPDATE item_transfer SET e_way_status=1,eway_date="'.$EwbDt.'",eway_no="'.$EwbNo.'"  WHERE  id='.$id ;
                    $this->db->query($qry);

                }else{
                    $error = 'Information  Error';
                    print_r($result_php);
                    $res = $result_php->Error;
                    if(isset($res[0])){
                        if(isset($res[0]->ErrorMessage)){
                            $return = $res[0]->ErrorMessage;
                        }
                    }
                    
                }
            }

            $e_way_data = array(
                'result'=>$result,
                'sales_id'=>$id,
                'status'=>$status,
                'error'=>$error,
                'EwbNo'=>$EwbNo,
                'EwbDt'=>$EwbDt,
                'EwbValidTill'=>$EwbValidTill,
            );
            $this->db->insert('e_way_transfer',$e_way_data);
       // }else{
            
        //}
        return  $return;
    }
	
	function delete($id) {
			$this->restorejournal_stock($id);
			$qry = "update item_ledger set published='no' where trans_status='stock_journal' and trans_id = ".$id;
			$this->db->query($qry);
			$qry = "update stock_journal_items set published='no' where  stock_journal_id= ".$id;
			$this->db->query($qry);
			$qry = "update stock_journal set published='no' where  id= ".$id;
			$this->db->query($qry);
	}
	
	function restorejournal_stock($id){
		$qry = "select * from stock_journal_items where published='yes' and  stock_journal_id = ".$id;
		$result = $this->db->query($qry);
		if($result->num_rows() > 0 ){
			$result = $result->result_array();
			foreach($result as $item){
				$ttp = 'cr';
				if($item['type'] == "decrease" ){
					$ttp = 'dt';
				}
				$this->godown_stock_trans(0, $item['item_id'], $item['quantity'], $ttp, 'stock_journal', $item['godown_id'], $item['batch']);
				
			}
		}
	}
	
	function getsing($id){
		$qry = "SELECT DATE_FORMAT(b.expirydate,'%d/%m/%Y') as sdate,a.*,b.*,c.name,c.barcode,d.godown_name,IFNULL(c.landing_cost,0) as landing_cost FROM `stock_journal` as a INNER join stock_journal_items as b on a.id=b.stock_journal_id INNER join item as c on c.id=b.item_id INNER join ims_godown as d on d.id=b.godown_id where b.published='yes' and a.id=".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	function journal_ledgers($id){
		$qry = "SELECT b.name,a.* FROM `stock_journal_ledger` as a INNER JOIN acc_ledgers as b on a.ledger_id = b.id WHERE a.published ='yes'  and a.stock_journal_id = '".$id."' ";
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}

	function itemssearch($search,$type){
		$txts = '';
		if(strtolower($this->session->userdata('login_base_comid')) =='palack' ){
			$txts = ' or barcode like"%'.$search.'%" ';
		}
		$qry = "select a.*,concat(a.name,' ,barcode:',a.barcode) as label from item as a where a.published = 'yes' and  name like '%".$search."%' $txts ";
		if($type == "barcode"){
			$qry = "select a.*,concat(a.name,' ,barcode:',a.barcode) as label from item as a where a.published = 'yes' and  barcode like '%".$search."%' $txts ";
		}

		$settings = $this->getCompanySettings();
        $isbatch = 0 ;
        if(isset($settings[0]['is_batch'])){
            $isbatch = $settings[0]['is_batch'];
        
        }
        if($isbatch > 0 ){
            $qry = "SELECT a.MRP,b.batch,CONCAT(a.name, ' ,batch : ', IFNULL(b.batch, 'No Batch'), ' ,barcode:', a.barcode) AS label,a.name,a.id,a.barcode,IFNULL(b.item_prate,a.prate) AS prate,IFNULL(b.item_srate,a.srate) AS srate,landing_cost FROM item AS a LEFT JOIN item_godown AS b ON a.id = b.item_id where a.published = 'yes' and  name like '%".$search."%'";
			if($type == "barcode"){
				$qry = "SELECT a.MRP,b.batch,CONCAT(a.name, ' ,batch : ', IFNULL(b.batch, 'No Batch'), ' ,barcode:', a.barcode) AS label,a.name,a.id,a.barcode,IFNULL(b.item_prate,a.prate) AS prate,IFNULL(b.item_srate,a.srate) AS srate,landing_cost FROM item AS a LEFT JOIN item_godown AS b ON a.id = b.item_id where a.published = 'yes' and  b.batch not in ('',0) and barcode like '%".$search."%'";
			}
        }
		
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
 
	public function getinvoice(){
		$qry ="select * from stock_journal where published ='yes' order by id desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('SJ', "", $query['voucher_no']);
			$invoice = (int) $invoice + 1;
			return 'SJ'.$invoice;
		}else{
			return 'SJ1';
		}
		
	}
    public function save() {
		$tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		$isbatch = $this->input->post('isbatch');
		$date = $this->input->post('date');
		$invoice = $this->input->post('invoice');
		$reference = $this->input->post('reference');
		$remarks =  $this->input->post('remarks');
		$id = $this->input->post('id');
		$data = array(
			'voucher_no'=>$invoice,
			'date'=>$this->getDate($date),
			'remarks'=>$remarks,
			'reference'=>$reference
			
		);
		if($id == 0){
			$data['createdby'] = $created_by;
			$this->db->insert('stock_journal',$data);
			$insert_id = $this->db->insert_id();
		}else{
			$data_array = array(
				'date'=>$this->getDate($date),
				'remarks'=>$remarks,
				'reference'=>$reference
				
			);
			$this->db->where('id',$id);
			$this->db->update('stock_journal',$data_array);

			$this->restorejournal_stock($id);
			$insert_id = $id;
			$qry = "update item_ledger set published='no' where trans_status='stock_journal' and trans_id = ".$id;
			$this->db->query($qry);
			$qry = "update stock_journal_items set published='no' where  stock_journal_id= ".$id;
			$this->db->query($qry);
			$qry = "update stock_journal_ledger set published='no' where  stock_journal_id= ".$id;
			$this->db->query($qry);
			
			$qry = "update acc_ledger_trans set published='no' where tb_name = 'stock_journal' and  tb_id= ".$id;
			$this->db->query($qry);
		}
		if((int) $isbatch > 0 ){
			$batch_dec =  $this->input->post('itmbatch_dec',TRUE);
		}
		
		$id_dec = $this->input->post('id_dec',TRUE);
		$godown_id_dec = $this->input->post('godown_id_dec',TRUE);
		$quantity_dec = $this->input->post('quantity_dec',TRUE);
		$wt_dec = $this->input->post('wt_dec',TRUE);
		$landing_dec = $this->input->post('landing_dec',TRUE);
		$stkrate_dec = $this->input->post('stkrate_dec',TRUE);
		$stkvalue_dec = $this->input->post('stkvalue_dec',TRUE);
		$srate_dec = $this->input->post('srate_dec',TRUE);
		$mrp_dec = $this->input->post('mrp_dec',TRUE);
		if($this->input->post('itmdate_dec',TRUE)){
			$itmdate_dec = $this->input->post('itmdate_dec',TRUE);
		}
		if($this->input->post('id_dec',TRUE)){
			$size_dec = sizeof($id_dec);
			for($i=0;$i<$size_dec;$i++){
				$data_dec = array(
					'stock_journal_id'=>$insert_id,
					'net_wt'=>$wt_dec[$i],
					'item_id'=>$id_dec[$i],
					'type'=>'decrease',
					'Mrp'=>$mrp_dec[$i],
					'quantity'=>$quantity_dec[$i],
					'srate'=>$srate_dec[$i],
					'prate'=>$stkrate_dec[$i],
					'stock_value'=>$stkvalue_dec[$i],
					'published'=>'yes',
					'godown_id'=>$godown_id_dec[$i]
				);
				if($this->input->post('itmdate_dec',TRUE)){
					if($itmdate_dec[$i] !='' ){
						$data_dec['expirydate'] = $this->getDate($itmdate_dec[$i]);
					}
				}
				$batchdec = '';
				if((int) $isbatch > 0 ){
					$batchdec = $batch_dec[$i];
					$data_dec['batch'] = $batchdec;
				}
				$this->db->insert('stock_journal_items',$data_dec);
				$ttp = 'cr';
				$this->stock_gold_trans(0,$id_dec[$i], $quantity_dec[$i],$wt_dec[$i],$wt_dec[$i], $this->getDate($date), $ttp, 'stock_journal', $insert_id, $srate_dec[$i], $srate_dec[$i], 0,  $godown_id_dec[$i], $invoice, $batchdec);
				$this->godown_stock_trans(0, $id_dec[$i], $quantity_dec[$i], $ttp, 'stock_journal', $godown_id_dec[$i],$batchdec,'','' ,$mrp_dec[$i],$srate_dec[$i],$stkrate_dec[$i]);
				$itemData = array(
					'prate'=>$stkrate_dec[$i],
					'srate'=>$srate_dec[$i],
					'landing_cost'=>$landing_dec[$i]
				);
				$this->db->where('id',$id_dec[$i]);
				$this->db->update('item',$itemData);
			}
		}
		
		if((int) $isbatch > 0 ){
			$batch_inc =  $this->input->post('itmbatch_inc',TRUE);
		}
		$id_inc = $this->input->post('id_inc',TRUE);
		$landing_inc = $this->input->post('landing_inc',TRUE);
		$godown_id_inc = $this->input->post('godown_id_inc',TRUE);
		$quantity_inc = $this->input->post('quantity_inc',TRUE);
		$stkrate_inc = $this->input->post('stkrate_inc',TRUE);
		$stkvalue_inc = $this->input->post('stkvalue_inc',TRUE);
		$wt_inc = $this->input->post('wt_inc',TRUE);
		$srate_inc = $this->input->post('srate_inc',TRUE);
		$mrp_inc = $this->input->post('mrp_inc',TRUE);
		if($this->input->post('itmdate_inc',TRUE)){
			$itmdate_inc = $this->input->post('itmdate_inc',TRUE);
		}

		if($this->input->post('id_inc',TRUE)){
			$size_inc = sizeof($id_inc);
			for($i=0;$i<$size_inc;$i++){
				
				$data_inc = array(
					'stock_journal_id'=>$insert_id,
					'item_id'=>$id_inc[$i],
					'Mrp'=>$mrp_inc[$i],
					'net_wt'=>$wt_inc[$i],
					'type'=>'increase',
					'quantity'=>$quantity_inc[$i],
					'srate'=>$srate_inc[$i],
					'prate'=>$stkrate_inc[$i],
					'stock_value'=>$stkvalue_inc[$i],
					'published'=>'yes',
					'godown_id'=>$godown_id_inc[$i]
				);
				$exp_inc = '';
				if($this->input->post('itmdate_inc',TRUE)){
					if($itmdate_inc[$i] !='' ){
						$data_inc['expirydate'] = $this->getDate($itmdate_inc[$i]);
						$exp_inc = $this->getDate($itmdate_inc[$i]);
					}
				}

				$batchinc = '';
				if((int) $isbatch > 0 ){
					$batchinc = $batch_inc[$i];
					$data_inc['batch'] = $batchinc;

				}
				$this->db->insert('stock_journal_items',$data_inc);
				$ttp = 'dt';
				$this->stock_gold_trans(0,$id_inc[$i], $quantity_inc[$i], $wt_inc[$i],$wt_inc[$i],$this->getDate($date), $ttp, 'stock_journal', $insert_id, $srate_inc[$i], $srate_inc[$i], 0,  $godown_id_inc[$i], $invoice, $batchinc);
				$this->godown_stock_trans(0, $id_inc[$i], $quantity_inc[$i], $ttp, 'stock_journal', $godown_id_inc[$i], $batchinc,'',$exp_inc,$mrp_inc[$i],$srate_inc[$i],$stkrate_inc[$i]);
				$itemData = array(
					'prate'=>$stkrate_inc[$i],
					'srate'=>$srate_inc[$i],
					'landing_cost'=>$landing_inc[$i]
				);
				$this->db->where('id',$id_inc[$i]);
				$this->db->update('item',$itemData);
			}
		}
		if($this->input->post('ledgerid',TRUE)){
			$ledgerid = $this->input->post('ledgerid',TRUE);
			$ledger_amount = $this->input->post('ledger_amount',TRUE);
			$llength = sizeof($ledgerid);
			for($i=0; $i <$llength ; $i++){
				$led_data=array(
					'ledger_id'=>$ledgerid[$i],
					'stock_journal_id'=>$insert_id,
				'amount'=>$ledger_amount[$i]
				);
				$this->db->insert('stock_journal_ledger', $led_data);
				$this->trans_save($invoice, $insert_id, "stock_journal", "stock_journal", 1, $ledgerid[$i], $this->getDate($date), '0.00', $led_data['amount'], $invoice.' on '.$date, 1, 0, 0);
				$this->trans_save($invoice, $insert_id, "stock_journal", "stock_journal", $ledgerid[$i],1 , $this->getDate($date), $led_data['amount'], '0.00', $invoice.' on '.$date, 1, 0, 0);
			}
		}
        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.',
        );
        echo json_encode($response);
    }

}
