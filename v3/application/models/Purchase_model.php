<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Purchase_model extends DataTable {

    public function __construct() {
        parent::__construct();
		$is_cigarette_cess = $this->input->post('is_cigarette_cess');
		$txt_join = '';
		$sel_txt = '';
		if($is_cigarette_cess > 0 ){
			$txt_join = ' ,sum(cig_ces_amt+cig_ces_per_amount) AS cessamt ';
			$sel_txt = ' cessamt,';
		}
        $this->table = 'purchase as a left join (SELECT purchase_id,SUM(total) AS itemtotal'.$txt_join.' FROM purchase_items where published = "yes" GROUP BY purchase_id) as pi on pi.purchase_id = a.id  left join  (SELECT purchase_id,SUM(amount) AS amount FROM purchase_ledgers where published = "yes" GROUP BY purchase_id) as pl on pl.purchase_id = a.id  left join suppliers as b on a.supplier_id =b.id left join acc_ledgers as c on c.ref_id=b.id and c.ref_code in ("cus","sup")';
        $this->column_order = array(null, 'b.name', 'invoice', 'date', 'total', null); //set column field database for datatable orderable
        $this->column_search = array('b.name', 'invoice', 'rdate'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->select = ' '.$sel_txt.'DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,c.id as ref,a.type as ptype, a.id as pid,a.published as pub,a.*,b.*';
    }

	   function getcigarette_cess_id(){
        $qry = "SELECT * FROM acc_ledgers WHERE name = 'Cigarette Cess'";
        $cigarette_cess = $this->db->query($qry);
        if($cigarette_cess->num_rows() > 0 ){
            $cigarette_cess = $cigarette_cess->row_array();
            return $cigarette_cess['id'];

        }else{
            $name = "Cigarette Cess";
            $ledger_code = '';
            $tax_id = 0;
            $hsncode = 0;
            $main_acc = 10;
            $data = array(
                'name' => $name,
                'acc_ledger_code' => $ledger_code,
                'tax_id' => $tax_id,
                'hsncode'=>$hsncode,
                'acc_main_id' => $main_acc,
                // 'is_for_sales' => $this->input->post('is_for_sales'),
                // 'is_for_purchase' => $this->input->post('is_for_purchase'),
                'type' => '',
                'openning_bal' => 0,
                'published' => 'yes'
            );
            $this->db->insert('acc_ledgers',$data);
            return $this->db->insert_id();
        }
    }


    function wheresupplier() {
//        $tmp = $this->session->userdata('user');
//        $userid = $tmp['Id'];
        $id = $this->input->post('supid');
        if ($this->input->post('stype')) {
            $this->wherecondition = "where a.published = 'yes' and a.type = '" . $this->input->post('stype') . "'  and a.supplier_id = " . $id;
        }
    }

	function get_item_id($code,$item_id,$mrp,$prate,$itm_bar_ref =''){
		$date = $this->input->post('date');
		$date = $this->getDate($date);
		$supplier_id =  $this->input->post('supid');
		$qry = 'select * from item where id = '.$item_id;
		$item_data = $this->db->query($qry)->row_array();
		$name = $item_data['name'];
		$name = preg_replace('/[0-9]+/', '', $name);
		$name = str_replace('-', '', $name);
		$item_data['name'] = $name.' '.$itm_bar_ref.'-'.round($mrp,0);
		$item_category_id = $item_data['item_category_id'];
		if($item_category_id == '' || $item_category_id  == 'null' || $item_category_id  == null){
			$item_category_id =0;
		}

		if($item_category_id  > 0 ){
			$qry = "SELECT * FROM item_category WHERE id = ".$item_category_id;
			$category = $this->db->query($qry)->row_array();
			$code = $category['category_code'];
			$inc = (int) $category['inc'];
			$inc =(int) $inc + 1;

			$qry = "select * from item where (id = ".$item_id." or base_item_id = ".$item_id." ) and mrp = ".$mrp." and prate = ".$prate."  ";
			$exits = $this->db->query($qry);
			if($exits->num_rows() > 0 ){
				$exits = $exits->row_array();
				return $exits['id'];
			}else{
				$qry = "update item_category set inc = ".$inc." where id =  ".$item_category_id;
				$this->db->query($qry);
				$base_item_id = $item_id;
				if((int) $item_data['base_item_id'] > 0 ){
					$base_item_id = $item_data['base_item_id'];
				}
				$new_data = array(
					'barcode'=>$code.$inc,
					'prate'=>$prate,
					'supplier_id'=>$supplier_id,
					'date'=>$date,
					'MRP'=>$mrp,
					'item_category_id'=>$item_data['item_category_id'],
					'unit_id'=>$item_data['unit_id'],
					'base_item_id'=>$base_item_id,
					'brand_id'=>$item_data['brand_id'],
					'name'=>$item_data['name'],
					'tax_id'=>$item_data['tax_id'],
					'tax_ledger_id'=>$item_data['tax_ledger_id'],
					'tax_sales_id'=>$item_data['tax_sales_id'],
					'tax_purchase_id'=>$item_data['tax_purchase_id'],
					'material_type'=>$item_data['material_type'],
					'is_autobarcode'=>"0"
				);
				$Msettings = $this->getCompanySettings();
				if(isset($Msettings[0]['is_cigarette_cess'])){
					if($Msettings[0]['is_cigarette_cess'] == 1){
						$new_data['cigarette_cess_amount'] = $item_data['cigarette_cess_amount'];
						$new_data['cigarette_cess_percentage'] = $item_data['cigarette_cess_percentage'];
					}
				}
				$this->db->insert('item',$new_data);

				return $this->db->insert_id();
				
			}
		}else{
			return $item_id;
		}
		
		
			
	}

	function getCategoryBarcode($mrp,$prate,$item_id,$type,$itm_bar_ref =''){
		$item = $item_id;
        $code = 'code';
		$item = $this->get_item_id($code,$item_id,$mrp,$prate,$itm_bar_ref);
        return $item;
    }


//add custom filter here
    function delete($id, $type) {
        if ($type == "purchase") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'cr');
        }
        if ($type == "purchase_return") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'dt');
        }

		$old_qry = "select * from purchase where id = ".$id." ";
		$old_data = $this->db->query($old_qry)->row_array();
		$old_date = $old_data['date'];


		$qry = "update acc_ageing set  credit = 0 ,debit =0 where tb_crdate = '".$old_date."' and tb_id = ".$id." and tb_name = 'purchase'";
		$this->db->query($qry);
        $qry = "delete from  purchase where id =" . $id;
        $this->db->query($qry);
        $qry = "delete from purchase_items  where purchase_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='purchase' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='purchase_return' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='purchase' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='purchase_return' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function zeroindex() {
        $qry = 'select * from taxgst where GST="0" limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function InsertService($data, $pur_data, $or_type, $branch, $curr_value = 1,$purchase_cashaccount) {
        $total = $data['amount'];
        if ($data['tax'] != 0) {
            $total = $total ;
        }
        $this->db->insert('purchase_ledgers', $data);
        if ($or_type != 'purchase_order' && $or_type != 'order') {
            if (strtolower($pur_data['cash_type']) == 'cash') {
                //$toid = $this->cashaccount;
				$toid = $purchase_cashaccount;
                $this->trans_save($pur_data['invoice'], $data['purchase_id'], 'purchase', $or_type, $this->purchase, $data['ledger_id'], $pur_data['date'], '0.00', round(($total -$data['tax'] ) * $curr_value, 2),'1231'. $pur_data['narration'], 1, $pur_data['cost_center'], $branch);
            } else {
                $res = $this->getLedgers($pur_data['supplier_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($pur_data['invoice'], $data['purchase_id'], 'purchase', $or_type, $res['id'], $data['ledger_id'], $pur_data['date'], '0.00', round(($total -$data['tax'] ) * $curr_value, 2), '78231'.$pur_data['narration'], 1, $pur_data['cost_center'], $branch);
            }

            if ($data['tax'] != 0) {
                $this->tax_add($data['tax_id'], 0, $data['tax'],0);
            }
        }
    }

    function max() {
        $qry = 'select max(id) as max_id from purchase';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function cancel($id, $type) {
        if ($type == "purchase") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'cr');
        }
        if ($type == "purchase_return") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'dt');
        }

		$old_qry = "select * from purchase where id = ".$id." ";
		$old_data = $this->db->query($old_qry)->row_array();
		$old_date = $old_data['date'];
		$qry = "update acc_ageing set  credit = 0 ,debit =0 where tb_crdate = '".$old_date."' and  tb_id = ".$id." and tb_name = 'purchase'";
		$this->db->query($qry);
        $qry = "update  purchase set published ='no'  where id =" . $id;
        $this->db->query($qry);
        $qry = "update  purchase_items set published ='no' where purchase_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='purchase' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='purchase_return' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='purchase' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='purchase_return' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function where() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
       
        if ($this->input->post('type')) {
            $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
        }
        if ($this->input->post('btype')) {
			$this->wherecondition = $this->wherecondition . " and  a.bill_type = '" . $this->input->post('btype') . "'";
		}
		 if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and a.date >='" . $this->getDate($this->input->post('startdate'))."'";
		}
		if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and a.date <='" . $this->getDate($this->input->post('enddate'))."'";
		}
		 $this->wherecondition = $this->wherecondition . ' and (IFNULL(amount,0) > 0 or IFNULL(itemtotal,0) > 0  ) ';
    }

    function getpurchaseItems($id, $len, $size) {
        $qry = "select  g.*,u.code, h.hsncode as hsncd,a.mrp as mrps, a.*,b.* from purchase_items as a inner join item as b on a.item_id= b.id left join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid inner join units as u on u.id = a.unit_id where purchase_id= $id and a.published='yes' order by a.id desc limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchase($id) {
        $qry = "select a.published as pub, DATE_FORMAT(date,'%d-%m-%Y') as in_date,  a.type as ptp, a.*,b.* from purchase as a left join suppliers as b on a.supplier_id=b.id where a.id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItems($id) {
        $qry = " select h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = " select  h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

     function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT bill_no FROM  purchase  where  bill_type='" . $type . "' and published='yes'  order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['bill_no']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }

    function getorderdetails($id) {
        $qry = "select a.total,a.tax,a.invoice,a.date from purchase as a left join suppliers as b on a.supplier_id=b.id where a.id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchaseItemscnt($id) {
        $qry = "select  * from purchase_items as a inner join item as b on a.item_id= b.id  where a.published='yes' and purchase_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    public function alreadyexistcheck($invoice, $supplier) {
        $qry = "select count(*) as cnt from purchase where type != 'purchase_return' and published='yes' and invoice='$invoice' and supplier_id =$supplier";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }
	
	public function purchase_emei($id){
		$qry = "select * from purchase_items_imei where published = 'yes' and pur_itms_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function insert_supplierdetails($data){
		$this->db->insert('suppliers',$data);
		$id = $this->db->insert_id();
		$ledger_data = array(
                        "name" => $data['name'],
                        "code" => $data['phone'],
                        "ref_id" => $id,
                        "ref_code" => 'cus',
                        "is_default" => true,
                        "acc_main_id" => 24,
                        "openning_bal" => 0,
                        "type" => 'Cr',
                        "published" => 'yes'
                    );
        $this->db->insert('acc_ledgers', $ledger_data);
		return $id;
	}

	public function updatepurchasebarcode($pindex,$purchase_id,$item_id,$quantity,$code,$date){
		$qry = 'select * from purchase_items_barcode where date = "'.$date.'" order by id desc limit 0,1 ';
		$d = $this->db->query($qry);
		if($d->num_rows() > 0 ){
			$d = $d->row_array();
			$start = (int) $d['cnt'] ;
		}else{
			$start =  0 ;
		}
		for($i = 0; $i  < $quantity; $i++){
			$start = (int) $start + 1;
			$data = array(
				'purchase_id'=>$purchase_id,
				'pindex'=>$pindex,
				'cnt'=>$start,
				'item_id'=>$item_id,
				'date'=>$date,
				'barcode'=>$code.$start
			);
			$this->db->insert('purchase_items_barcode',$data);
		}

	}

	public function update_rates($item_id,$auto_stock_cost,$auto_landing_cost){
		 $qry = 'select * from item_auto_rate where published ="yes" and item_id ='.$item_id;
		 $result = $this->db->query($qry)->result_array();
		 foreach($result as $it){

			if ($it['auto_base'] == 'stock_rate') {
				$base_rate = $auto_stock_cost;
			} else {
				$base_rate = $auto_landing_cost;
			}

			$auto_per = $it['auto_per'];
			$new_rate = $base_rate + ($base_rate * $auto_per / 100);
			$data = array($it['auto_filed'] => $new_rate);
			  $this->db->where('id', $item_id);
			  $this->db->update('item', $data);
		 }
	}

    public function save($or_type) {
		$rate_auto_update = 0 ;
		if($this->input->post('rate_auto_update')){
			$rate_auto_update = $this->input->post('rate_auto_update');
		}

		$Is_SQFT = $this->input->post('Is_SQFT');

		$category_barcode = 0 ;
        $settings = $this->getCompanySettings();
        if(isset($settings[0]['category_barcode'])){
            $category_barcode = $settings[0]['category_barcode'];
        }

		$lcode = 0;
		if(isset($settings[0]['lcode']) ){
			$lcode = $settings[0]['lcode'];

		}

		$old_date = '';

		$id = $this->input->post('p_id');
		if($id  == 0 ){

        }else{
			//if($this->session->userdata('login_base_comid') == 'raj'){
           	  $this->checkvoucherAudit($id,'Purchase');
			//}
        }
		 $insert_id = 0;
		if($this->input->post('item_id', TRUE) || $this->input->post('serv_amt', TRUE)  ){
        //  $cons = new Common_db();
			$supid = 0 ;
			if($this->input->post('supid')){
				$supid = $this->input->post('supid');
			}
			if((int) $supid < 1){
				$supplier_details = array(
					'name'=>$this->input->post('supname'),
					'phone'=>$this->input->post('phone'),
					'address_line1'=>$this->input->post('address'),
					'tin'=>$this->input->post('gst'),
					'type'=>'sup'
				);
				$supid = $this->insert_supplierdetails($supplier_details);
			}
			$curr_value = 1;
			$com_currency = $this->input->post('com_currency');
			$comset_currency = $this->input->post('comset_currency');
			if ($comset_currency != $com_currency) {
				$curr_value = $this->input->post('curr_value');
			}
			$costcenter = 0;
			if ($this->input->post('Costcenter')) {
				$costcenter = $this->input->post('Costcenter');
			}
			$is_mul_led = $this->input->post('is_multipletax');
			$id = $this->input->post('p_id');
			$lc_auto_update = $this->input->post('lc_auto_update');
			$is_taxincuded = $this->input->post('is_taxincuded');
			$route = $this->input->post('route');
			$vehicle = $this->input->post('vehicle');
			$billtype = $this->input->post('btype');
			$branch = $this->getbranch($billtype);
			$purchase_cashaccount = $this->getcashaccount($billtype);
			if((float) $purchase_cashaccount < 1 ){
				$purchase_cashaccount = 1;
			}
			$printtype = $this->input->post('printtype');
			$billingname = $this->input->post('supname');
			if($this->input->post('billingname')){
				$billingname = $this->input->post('billingname');
			}
			$area = $this->input->post('area');
			$tmp = $this->session->userdata('user');
			$userid = $tmp['Id'];
			if ($or_type == 'purchase') {
				$invoice = $this->input->post('invoice');
				if ($billtype == "") {
					$billno = $this->getinoviceno($or_type);
				} else {
					$billno = $this->getinoviceno($billtype);
				}
			} else {
				if ($billtype == "") {
					$billno = $this->getinoviceno($or_type);
					$invoice = $billno;
				} else {
					$billno = $this->getinoviceno($billtype);
					$invoice = $billno;
				}
			}
			$salesman = $this->input->post('salesman');
			$date = $this->input->post('date');
			$rdate = $this->input->post('rdate');
			$type = $this->input->post('type');
			$tax_common = $this->input->post('tax_common');
			$discount = $this->input->post('discount');
			$rount = $this->input->post('rount');
			$tax = $this->input->post('tax');
			$taxtotal = $this->input->post('taxtotal');
			$txtEstimate_id = $this->input->post('txtEstimate_id');
			$gtotal = $this->input->post('gtotal');
			
			$ewb_no = $this->input->post('route');
			$ewb_details = $this->input->post('ewbdetails');
			$gst = $this->input->post('gst');
			$state = $this->input->post('states');
			$narration = 'Purchase invoice' . $invoice . ' on  ' . $date;
			if ($this->alreadyexistcheck($invoice, $supid) != 0 && $id == 0) {
				$response = array(
					'valid' => false,
					'type' => 1,
					'message' => 'Alreay Exist.'
				);
				echo json_encode($response);
				return;
			}
			$freight = 0;
			$other = 0;
			if ($this->input->post('freight')) {
				$freight = $this->input->post('freight');
			}
			if ($this->input->post('other')) {
				$other = $this->input->post('other');
			}
			$itm_net_ces = 0 ;
			if( $this->input->post('itm_net_ces') ){
				$itm_net_ces = $this->input->post('itm_net_ces');
			}
			$manufacture_date = '';
			$expiry_date = '';
			if($this->input->post('mdate',true)){
				$manufacture_date = $this->input->post('mdate',true);
			}
			if($this->input->post('edate',true)){
				$expiry_date = $this->input->post('edate',true);
			}
			
			
			$shipping_name =  $this->input->post('con_name');
			$shipping_address =  $this->input->post('con_addr');
			$shipping_contact =  $this->input->post('con_contact');
			$shipping_gstin =  $this->input->post('con_gst');
			$shipping_state =  $this->input->post('con_state');
			$supplier_ref = $this->input->post('supplier_ref');
			$po_ref_no = $this->input->post('po_ref_no');
			$customer_ref_no = $this->input->post('customer_ref_no');
			$notes = $this->input->post('notes');
			$data = array(
				'supplier_ref'=>$supplier_ref,
				'po_ref_no'=>$po_ref_no,
				'customer_ref_no'=>$customer_ref_no,
				'notes'=>$notes,
				'shipping_name'=>$shipping_name,
				'shipping_address'=>$shipping_address,
				'shipping_contact'=>$shipping_contact,
				'shipping_gstin'=>$shipping_gstin,
				'shipping_state'=>$shipping_state,
				'additional_cess'=>$itm_net_ces,
				'supplier_id' => $supid,
				'cash_type' => $type,
				'currency_id' => $com_currency,
				'cur_exc_amt' => $curr_value,
				'date' => $this->getDate($date),
				'rdate' => $this->getDate($rdate),
				'total' => $gtotal,
				'cost_center' => $costcenter,
				'ewb_no' => $ewb_no,
				'ewb_details' => $ewb_details,
				'supgst' => $gst,
				'supstate' => $state,
				'tax' => $taxtotal,
				'tax_id' => $tax_common,
				'salesman' => $salesman,
				'route' => $route,
				'vehicle' => $vehicle,
				'area' => $area,
				// 'bill_type' => $billtype,
				'order_id' => $txtEstimate_id,
				'printtype' => $printtype,
				'other' => $other,
				'freight' => $freight,
				'discount' => $discount,
				'roundoff' => $rount,
				'created_date' => date('Y-m-d H:i:s'),
				'narration' => $narration,
				'billing_name' => $billingname,
				'type' => $or_type,
				'published' => 'yes',
			);
			$bank_id = 0 ;
			if($type == 'Bank'){
				$data['bank_id'] = $this->input->post('bank_account') ;
				$bank_id =  $this->input->post('bank_account');
				$data['bank_type'] = $this->input->post('bank_pay_method') ;
				$data['bank_reference'] = $this->input->post('card_number') ;
				if($this->input->post('bank_pay_method') =='gpay'){
					$data['bank_reference'] = $this->input->post('gpay_number') ;
				}
			}
			if($this->input->post('due_date') ){
				$data['due_date'] = $this->getDate($this->input->post('due_date'));
			}
			$insert_id = 0;
			if ($id == 0) {
				$data['bill_no'] = $billno;
				$data['bill_type'] = $billtype;
				$data['invoice'] = $invoice;
				$data['created_by'] = $userid;
				$this->db->insert('purchase', $data);
				$insert_id = $this->db->insert_id();
				$this->checkvoucherAudit($insert_id,'Purchase');
				
			} else {
				$old_qry = "select * from purchase where id = ".$id." ";
				$old_data = $this->db->query($old_qry)->row_array();
				$old_date = $old_data['date'];
				$purchase_barcode = $this->input->post('purchase_barcode');
				if((float) $purchase_barcode >  0  ){
					$qry = 'update purchase_items_barcode set is_deleted = 1 where purchase_id = '.$id;
					$this->db->query($qry);
				}

				if ($or_type == 'purchase') {
					$data['invoice'] = $invoice;
				}
				$qry = "select * from purchase where id=".$id;
				$query = $this->db->query($qry)->row_array();
				$data['invoice'] = $invoice;
				$data['bill_no'] = $query['bill_no'];
				$billno =  $query['bill_no'];
				$invoice = $query['invoice'];
				$insert_id = $id;
				$this->db->where('id', $id);
				$this->db->update('purchase', $data);
				$data['created_by'] = $userid;
				$this->updatevoucherAudit($id,'Purchase',$data['type'],$query['invoice'],$data['total'],'',0,0,$data['created_by']);
				if (!$txtEstimate_id == 0) {
					$this->restoreorder($id, $txtEstimate_id);
				}
				if ($or_type != 'purchase_order' && $or_type != 'order') {
					if ($or_type == 'purchase') {
						$this->restorestock($insert_id, 'pur');
					} else if ($or_type == 'purchase_return') {
						$this->restorestock($insert_id, 'pur');
					}
					$ttp = 'cr';
					if ($or_type == 'purchase_return') {
						$ttp = 'dt';
					}
					$this->restore_godown_stock_trans($id, $ttp);
				}

				$qry = "update  purchase_items set published ='no' where purchase_id =" . $insert_id;
				$this->db->query($qry);
				$qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $insert_id;
				$this->db->query($qry);
				$qry = "update  acc_ledger_trans set published ='no' where tb_name='Purchase' and tb_id =" . $insert_id;
				$this->db->query($qry);
				$qry = "update  purchase_ledgers set published ='no'  where purchase_id =" . $id;
				$this->db->query($qry);
				if((float) $this->input->post('is_IMEI') > 0  ){
					$qry = "update  purchase_items_imei set published ='no'  where purchase_id =" . $id;
					$this->db->query($qry);
				}
			}
			$serv_ledgerid = $this->input->post('serv_ledgerid', TRUE);
			$serv_taxid = $this->input->post('serv_taxid', TRUE);
			$serv_amt = $this->input->post('serv_amt', TRUE);
			$serv_taxamt = $this->input->post('serv_taxamt', TRUE);
			$sertaxtotal = $this->input->post('sertaxtotal', TRUE);
			$sergtotal = $this->input->post('sergtotal', TRUE);
			$serv_is_taxincuded = $this->input->post('serv_is_taxincuded', TRUE);
			if ($this->input->post('serv_ledgerid')) {
            $length = sizeof($serv_ledgerid);
            for ($i = 0; $i < $length; $i++) {
                $ser_data = array(
                    'purchase_id' => $insert_id,
                    'ledger_id' => $serv_ledgerid[$i],
                    'amount' => $serv_amt[$i],
                    'tax_id' => $serv_taxid[$i],
                    'tax' => $serv_taxamt[$i],
                    'is_taxincluded' => $serv_is_taxincuded[$i],
                    'published' => 'yes'
                );

                $this->InsertService($ser_data, $data, $or_type, $branch, $curr_value,$purchase_cashaccount);
            }
        }
        /* // not using now 
          $supname = $this->input->post('supname');
          $phone = $this->input->post('phone');
          $email = $this->input->post('email');
          $cst = $this->input->post('cst');
          $tin = $this->input->post('tin');
          $address_line1 = $this->input->post('address_line1');
          $address_line2 = $this->input->post('address_line2');
          $details = $this->input->post('details');
         */
			$pur_itms_index_id = $this->input->post('pur_itms_index_id', TRUE);
			$index_id = $this->input->post('index_id', TRUE);
			$item_id = $this->input->post('item_id', TRUE);
			$item_qty = $this->input->post('item_qty', TRUE);
			$unit_item = $this->input->post('unit_item', TRUE);
			$godown = $this->input->post('godown', TRUE);
			
			if($this->input->post('purchase_tax_on_mrp') > 0 ){
				$itm_tax_on_mrp = $this->input->post('itm_tax_on_mrp', TRUE);
			}
			$mrp_per = $this->input->post('mrpper', TRUE);
			$srate_per = $this->input->post('srateper', TRUE);
			$whrate_per = $this->input->post('whrateper', TRUE);
			$special_rate_per = $this->input->post('special_rateper', TRUE);
					
			$tax_item = $this->input->post('tax_item', TRUE);
			$mrp_item = $this->input->post('mrp_item', TRUE);
			$hsncode = $this->input->post('hsncode', TRUE);
			$prate_item = $this->input->post('prate_item', TRUE);
			$is_taxincluded = $this->input->post('is_taxincuded', TRUE);
			$tax_amount = $this->input->post('tax_amount', TRUE);
			$sale_rate = $this->input->post('sale_rate', TRUE);
			$itmdtn = $this->input->post('itmdtn', TRUE);
			$item_wh_rate = $this->input->post('item_wh_rate', TRUE);
			$item_special_rate = $this->input->post('item_special_rate', TRUE);
			$dis_item = $this->input->post('dis_item', TRUE);
			$item_order = $this->input->post('item_no', TRUE);
			$dis_amt = $this->input->post('dis_amt', TRUE);
			$rowTotal = $this->input->post('rowTotal');
			if($this->input->post('itm_lcode', TRUE)){
				$itm_lcode = $this->input->post('itm_lcode', TRUE);
			}
			if ($this->input->post('analytics_id')) {
				$analytics = $this->input->post('analytics_id', TRUE);
			}
			$item_batch_name = '';
			if ($this->input->post('item_batch_name')) {
				$item_batch_name = $this->input->post('item_batch_name');
			}
			$rowItemCes = $this->input->post('rowItemCes', TRUE);
			$rowitm_ces_id = $this->input->post('itm_ces_id', TRUE);
			$rowitm_ces_name = $this->input->post('itm_ces_name', TRUE);
			$rowitm_ces_per = $this->input->post('itm_ces_per', TRUE);
			$free_qty = $this->input->post('free_qty', TRUE);
			$length = 0;
			if($this->input->post('mrp_item', TRUE)){
				$length = sizeof($mrp_item);
			}
			$invoicedate = $rdate;
			$qry = "select date,DATE_FORMAT(date,'%d%m%Y') as days from purchase where id = ".$insert_id;
			$da = $this->db->query($qry)->row_array();
			$p_da = $da['days'];
			$p_date = $da['date'];

			$is_cigarette_cess = $this->input->post('is_cigarette_cess');
			$total_cig_ces_amt = 0;
			$total_cig_ces_per_amount = 0;
			if($is_cigarette_cess > 0 ){
				$unit_cig_ces_amt = $this->input->post('unitcigcesamt', TRUE);
				$unit_cig_ces_per = $this->input->post('cigcesper[]', TRUE);
				$cig_ces_amt = $this->input->post('cigcesamt', TRUE);
				$cig_ces_per_amount = $this->input->post('cigcesperamount', TRUE);
			}

			if($Is_SQFT > 0 ){
				$itemSQFTNO =  $this->input->post('itemSQFTNO', TRUE);
				$itemItemSQFT = $this->input->post('itemItemSQFT', TRUE);
			}

			if( $category_barcode > 0 ){
				$itm_desc = 	$this->input->post('itm_desc', TRUE);
			}

		for ($i = 0; $i < $length; $i++) {
			if($is_cigarette_cess > 0 ){
				$total_cig_ces_amt = (float) $total_cig_ces_amt + (float) $cig_ces_amt[$i];
				$total_cig_ces_per_amount =  (float)$total_cig_ces_per_amount  + (float) $cig_ces_per_amount[$i] ;
			}
			$itm_bar_ref = '';
			if($category_barcode > 0 ){
				$itm_bar_ref = $itm_desc[$i];
				$item_id[$i] = $this->getCategoryBarcode($mrp_item[$i],$prate_item[$i], $item_id[$i],0,$itm_bar_ref);
			}

			$itm_ces_id = 0;
			$itm_ces_name = '';
			$itm_ces_per = 0;
			$itm_raw_ces = 0;
			$additional_cess = $this->input->post('additional_cess');
			if((int) $additional_cess > 0 ){
				$itm_ces_id = $rowitm_ces_id[$i];
				$itm_ces_name = $rowitm_ces_name[$i];
				$itm_ces_per = $rowitm_ces_per[$i];
				$itm_raw_ces = $rowItemCes[$i];
			}
			
				$data = array(
					'analytics' => 0,
					'purchase_id' => $insert_id,
					'item_order'=>$item_order[$i],
					'mrp_per'=>$mrp_per[$i],
					'srate_per'=>$srate_per[$i],
					'whrate_per'=>$whrate_per[$i],
					'special_rate_per'=>$special_rate_per[$i],
					'dis_amt' => $dis_amt[$i],
					'item_id' => $item_id[$i],
					'itm_ces_id'=>$itm_ces_id,
					'itm_ces_name'=>$itm_ces_name,
					'itm_ces_per'=>$itm_ces_per,
					'itm_raw_ces'=>$itm_raw_ces,
					'batch' => '',
					'unit_id' => $unit_item[$i],
					'godown' => $godown[$i],
					'item_discription' => $itmdtn[$i],
					'base_unit_id' => $unit_item[$i],
					'is_taxincluded' => $is_taxincluded[$i],
					'quantity' => $item_qty[$i],
					'rate' => $prate_item[$i],
					'mrp' => $mrp_item[$i],
					'tax_id' => $tax_item[$i],
					'tax' => $tax_amount[$i],
					'discount' => $dis_item[$i],
					'total' => $rowTotal[$i],
					'published' => 'yes'
				);

				if($this->input->post('purchase_tax_on_mrp') > 0 ){
					$itm_tax_on_mrp = $this->input->post('itm_tax_on_mrp', TRUE);
					$data['purchase_tax_on_mrp'] = $itm_tax_on_mrp[$i];
				}

				if($is_cigarette_cess > 0 ){
					$data['unit_cig_ces_amt'] = $unit_cig_ces_amt[$i];
					$data['unit_cig_ces_per'] = $unit_cig_ces_per[$i];
					$data['cig_ces_amt'] = $cig_ces_amt[$i];
					$data['cig_ces_per_amount'] = $cig_ces_per_amount[$i];
				}
				if( $category_barcode > 0 ){
					//$itm_desc
					$data['itm_desc'] = $itm_desc[$i];
				}

				if($this->input->post('itm_lcode', TRUE)){
					$data['itm_lcode'] = $itm_lcode[$i];
				}

				if($lcode > 0 ){
					$array_item = array(
						'supplier_id'=>$supid
					);
					if($this->input->post('itm_lcode', TRUE)){
						$array_item['lcode'] = $itm_lcode[$i];
					}
					$this->db->where('id', $item_id[$i]);
					$this->db->update('item',$array_item);
				}
				if($Is_SQFT > 0 ){
					$data['SQFTNO'] =  $itemSQFTNO[$i];
					$data['ItemSQFT'] = $itemItemSQFT[$i];
				}
	
				$free = $free_qty[$i];
				if((float) $free > 0 ){
					$data['free_quantity'] = $free;
					$base_free_quantity = $this->getquantity($unit_item[$i], $free, $item_id[$i]);
					$data['base_free_quantity'] = $base_free_quantity;
				}
				$mdate = '';
				if($manufacture_date != ''){
					if($manufacture_date[$i] !=''  && $manufacture_date[$i] != 'undefined'){
						$data['manufacture_date'] = $this->getDate($manufacture_date[$i]);
						$mdate = $this->getDate($manufacture_date[$i]);
					}
				}
				$edate = '';
				if($expiry_date != ''){
					if($expiry_date[$i] !=''  && $expiry_date[$i] != 'undefined'  ){
						$data['expiry_date'] = $this->getDate($expiry_date[$i]);
						$edate = $this->getDate($expiry_date[$i]);
					}
				}
				if((int) $data['itm_ces_id'] > 0 ){
					$this->ces_add($data['itm_ces_id'],$data['itm_raw_ces']);
				}
				$batch = '';
				if ($this->input->post('item_batch_name')) {
					$data['batch'] = $item_batch_name[$i];
					$batch = $item_batch_name[$i];
				}
				
				if ($this->input->post('analytics_id')) {
					$data['analytics'] = $analytics[$i];
				}
				if ($or_type != 'purchase_order' && $or_type != 'order') {
					$reduceamount = 0 ;
					if($is_cigarette_cess > 0 ){
						$reduceamount = $cig_ces_amt[$i] + $cig_ces_per_amount[$i];
					}
					$this->tax_add($tax_item[$i], $rowTotal[$i], $tax_amount[$i], $rowTotal[$i] - $tax_amount[$i]-$itm_raw_ces - $reduceamount );
				}
				$qty = $this->getquantity($unit_item[$i], $item_qty[$i], $item_id[$i]);
				$data['base_quantity'] = $qty;
				$this->db->insert('purchase_items', $data);
				$pindex = $this->db->insert_id();
				$purchase_barcode = $this->input->post('purchase_barcode');
				
				if((float)$index_id[$i] < 1 && (float) $purchase_barcode >  0  ){
					$this->updatepurchasebarcode($pindex,$insert_id,$item_id[$i],$item_qty[$i],$p_da,$p_date);

				}else if((float) $purchase_barcode >  0  ){
					$qry = 'update purchase_items_barcode set is_deleted = 0 where pindex = '.$index_id[$i];
					$this->db->query($qry);
				}


				if((float) $this->input->post('is_IMEI') > 0  ){
				}
				if( $this->input->post('itemIMEI'.$pur_itms_index_id[$i]) ){
					$pur_item_insert_id = $this->db->insert_id();
					$emi_array = $this->input->post('itemIMEI'.$pur_itms_index_id[$i],true);
					$size_emei = sizeof($emi_array);
					for($inemi = 0; $inemi < $size_emei;$inemi++){
						$data_emi = array(
							'pur_itms_id'=>$pur_item_insert_id,
							'purchase_id'=>$insert_id,
							'item_id'=>$item_id[$i],
							'imei'=>$emi_array[$inemi]
						);
						$this->db->insert('purchase_items_imei',$data_emi);
					}
				}
				if (!$txtEstimate_id == 0) {
					$qry = "update purchase_items set order_quantity=order_quantity+" . $item_qty[$i] . " where published ='yes' and purchase_id= " . $txtEstimate_id . " and item_id=" . $item_id[$i];
					$this->db->query($qry);
				}
				if (!$txtEstimate_id == 0) {
					$qry = "select count(purchase_id) as count from purchase_items where published ='yes' and purchase_id=" . $txtEstimate_id . " and quantity > order_quantity ";
					$query = $this->db->query($qry)->row_array();
					if ($query['count'] == 0) {
						$qry = "update purchase set status='completed' where id=" . $txtEstimate_id;
						$this->db->query($qry);
					} else {
						$qry = "update purchase set status='incompleted' where id=" . $txtEstimate_id;
						$this->db->query($qry);
					}
				}
				if ($or_type != 'purchase_order' && $or_type != 'order') {
					$pur_rate = 0 ;
					if((float) $rowTotal[$i] > 0 &&   (float) $item_qty[$i] > 0 ){
						$pur_rate = ((float) $rowTotal[$i] -  (float) $tax_amount[$i] -  (float) $itm_raw_ces ) / (float) $item_qty[$i];
					}
					
					$pur_rate = $this->getbaserate($unit_item[$i], $pur_rate, $item_id[$i]);
					$itemData = array(
						'srate'=>$sale_rate[$i],
						'MRP' => $mrp_item[$i],
						'wh_rate'=>$item_wh_rate[$i],
						'special_rate'=>$item_special_rate[$i]
					//	'prate' => $pur_rate * $curr_value
					);
					
					$itemData['otherfee'] = $prate_item[$i];
					if((float) $pur_rate > 0 ){
						$itemData['prate'] = $pur_rate;
					}
					//$itemData['prate'] =  ((float) $rowTotal[$i] - (float) $tax_amount[$i] ) /  (float) $item_qty[$i];
					if((float) $lc_auto_update > 0 && (float) $rowTotal[$i] > 0  ){
						$itemData['landing_cost'] = (float) $rowTotal[$i] / (float) (float) $item_qty[$i];
						$itemData['landing_cost'] = $this->getbaserate($unit_item[$i], $itemData['landing_cost'], $item_id[$i]);
					}
					if($this->input->post('hsncode', TRUE)){
						$itemData['hsncode'] = $hsncode[$i];
					}
					if($this->session->userdata('login_base_comid') == 'asrfoods'){
						$purrate = $this->getbaserate($unit_item[$i], $prate_item[$i], $item_id[$i]);
						$itemData['prate'] = $purrate;
					}
					$this->db->where('id', $item_id[$i]);
					$this->db->update('item', $itemData);
					$ttp = 'dt';
					if ($or_type == 'purchase_return') {
						$ttp = 'cr';
					}
					$qty = $this->getquantity($unit_item[$i], $item_qty[$i], $item_id[$i]);
					$this->stock_trans(0, $item_id[$i], $qty, $this->getDate($invoicedate), $ttp, $or_type, $insert_id, $prate_item[$i], $mrp_item[$i], $tax_item[$i], $godown[$i], $invoice,$batch);
					$this->godown_stock_trans(0, $item_id[$i], $qty, $ttp, $or_type, $godown[$i],$batch,$mdate,$edate);
					$free = $free_qty[$i];
					if((float) $free > 0 ){
						$base_free_quantity = $this->getquantity($unit_item[$i], $free, $item_id[$i]);
						$this->stock_trans(0, $item_id[$i], $base_free_quantity, $this->getDate($invoicedate), $ttp, $or_type, $insert_id, $prate_item[$i], $mrp_item[$i], $tax_item[$i], $godown[$i], $invoice,$batch);
						$this->godown_stock_trans(0, $item_id[$i], $base_free_quantity, $ttp, $or_type, $godown[$i],$batch,$mdate,$edate);
					}
					$Msettings = $this->getCompanySettings();
					$Misbatch  = $Msettings[0]['is_batch'];
					if((int) $Misbatch > 0 ){
						$qry = "update item_godown set item_srate = '".$sale_rate[$i]."' where item_id = '".$item_id[$i]."' and batch = '".$batch."' ";
						if($sale_rate[$i] != '' && $sale_rate[$i] != 0 && $sale_rate[$i] != '0' ){
							$this->db->query($qry);
						}
						if($mrp_item[$i] != '' && $mrp_item[$i] != 0 && $mrp_item[$i] != '0' ){
							$qry = "update item_godown set item_mrp = '".$mrp_item[$i]."' where item_id = '".$item_id[$i]."' and batch = '".$batch."' ";
							$this->db->query($qry);
						}
						if($pur_rate != '' && $pur_rate != 0 && $pur_rate != '0' ){
							$qry = "update item_godown set item_prate	 = '".$pur_rate."' where item_id = '".$item_id[$i]."' and batch = '".$batch."' ";
							$this->db->query($qry);
						}
					}
				}
			}
			$cigarete_cess = (float) $total_cig_ces_amt + (float) $total_cig_ces_per_amount;
			if ($or_type != 'purchase_order' && $or_type != 'order') {
				$res = $this->getLedgers($supid, '', ' in ("cus","sup")');
				$toid = 0;
            //this is for ageging  

				if ($type == 'Cash') {

					//$toid = $this->cashaccount;
					if($old_date!=''){
						$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_id = ".$insert_id." and tb_name = 'purchase'";
						$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_crdate = '".$old_date."' and tb_id = ".$insert_id." and tb_name = 'purchase'";
						$this->db->query($qry);
					}
					$toid = $purchase_cashaccount;
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $this->purchase,$toid, $this->getDate($rdate), round($gtotal * $curr_value, 2), '0.00', $narration, 1, $costcenter, $branch);
				}else if($type == 'Bank'){
					if($old_date!=''){
						$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_id = ".$insert_id." and tb_name = 'purchase'";
						$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_crdate = '".$old_date."' and tb_id = ".$insert_id." and tb_name = 'purchase'";
						$this->db->query($qry);
					}
					$toid = $bank_id;
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $this->purchase,$toid, $this->getDate($rdate), round($gtotal * $curr_value, 2), '0.00', $narration, 1, $costcenter, $branch);
				} else {
					$toid = $res['id'];
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $this->purchase, $res['id'], $this->getDate($rdate), round($gtotal * $curr_value, 2), '0.00', $narration, 1, $costcenter, $branch);
					$this->addAgeing($id, $invoice, $insert_id, $or_type, $this->getDate($rdate), $this->getDate($rdate), $res['id'], date('Y-m-d H:i:s', time()), round($gtotal * $curr_value, 2), 0, 0, 0, 0,$old_date);
				}
				$subtot = $this->input->post('subtot');
				$taxtotal = $this->input->post('taxtotal');
				$salesamount = $subtot - $taxtotal;
				if ($is_mul_led == 0) {
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $this->purchase, $this->getDate($invoicedate), '0.00', round($salesamount * $curr_value, 2), $narration, 1, $costcenter, $branch);
				}
				if ($rount > 0) {
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $this->rount, $this->getDate($invoicedate), '0.00', round($rount * $curr_value, 2), $narration, 1, $costcenter, $branch);
				}
				if ($rount < 0) {
					$rount = $rount * -1;
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $this->rount, $this->getDate($invoicedate), round($rount * $curr_value, 2), '0.00', $narration, 1, $costcenter, $branch);
				}

				if((float)$cigarete_cess > 0 ){
                	$cigarette_cess_id = $this->getcigarette_cess_id();
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $cigarette_cess_id, $this->getDate($invoicedate), '0.00', round($cigarete_cess * $curr_value, 2), $narration, 1, $costcenter, $branch);
					
				}


            if (is_numeric($discount) == true && $discount != 0) {
                $this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $this->discount, $this->getDate($rdate), $discount,'0.00',  $narration, 1, $costcenter);
       	     }
				if (is_numeric($freight) == true && $freight != 0) {
					$this->trans_save($invoice, $insert_id, 'purchase', $or_type, $toid, $this->purchaseFr, $this->getDate($rdate), '0.00', round($freight * $curr_value, 2), $narration, 1, $costcenter, $branch);
				}
				$this->tax_save($invoice, $insert_id, $or_type, $toid, $this->getDate($invoicedate), $narration, $or_type, $costcenter, $is_mul_led, $branch, 0, $curr_value);
			}
		}
		$qry = "select * from purchase_items where purchase_id=".$insert_id;
		$query = $this->db->query($qry);
		if($query->num_rows()<1){
			//$qry = "delete from purchase where id=".$insert_id;
			//$this->db->query($qry);
		}
		$length = 0 ;
		if($this->input->post('mrp_item',true) ){
			$mrp_item = $this->input->post('mrp_item',true);
			$length = sizeof($mrp_item);
		}
		if ($or_type != 'purchase_order' && $or_type != 'order' && $length  > 0  ) {
			$this->ces_save($invoice, $insert_id, $or_type, $toid, $this->getDate($invoicedate), $narration, 'purchase', $costcenter, $is_mul_led, $branch, 0,$curr_value);
        }
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
