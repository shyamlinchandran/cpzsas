<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author sathyan
 */
class Pos_model   extends DataTable {

    public function __construct() {
        parent::__construct();
		$this->select = 'a.*,b.type as billtype';
        $this->table = '`counter` as a inner join set_billtype as b on a.bill_type=b.id';
        $this->column_order = array('a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

	function getcustomerdata($search = '')
    {

        $qry = 'select a.* from suppliers as a ';
        if ($search != '') {
            $qry = $qry . " where  a.name like('%$search%') or a.phone  like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }
	
	public function counters(){
		$qry ="select * from counter";
		$result = $this->db->query($qry)->result_array();
		$option = '<option value="">Select</option>';
		foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
	}
	
	public function getpending($id){
		$qry ="select * from counter_trans where id=".$id;
		$result = $this->db->query($qry)->row_array();
		echo json_encode($result);
	}
	
	public function getsing($id){
		$qry ="select * from counter where id=".$id;
		$result = $this->db->query($qry)->row_array();
		echo json_encode($result);
	}
	
	function getpendinglist(){
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$tmp = $this->session->userdata('user');
		$userid = $tmp['Id'];
		$this->select = 'a.*,b.name';
        $this->table = "counter_trans as a inner join counter as b on b.id=a.counter_id ";
        $this->column_order = array('b.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->wherecondition = " where  user_id='".$userid."' and status ='0'";
	}

	function count_all_sales() {
        $qry = 'select * from ' . $this->table . ' ' . $this->wherecondition;
        $query = $this->db->query($qry);
        return $query->num_rows();
	}
	public function count_filtered_sales() {
        $this->getQueryDt();
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }
	function where_register(){
		$tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $this->wherecondition = " where a.type = '" . $this->input->post('type') . "' ";
		
		if ($this->input->post('vehicle')) {
            $this->wherecondition = $this->wherecondition . " and a.vehicle =" . $this->input->post('vehicle');
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . " and a.bill_type =" . $this->input->post('btype');
        }
		 if ($this->input->post('status')) {
            $this->wherecondition = $this->wherecondition . " and a.status ='" . $this->input->post('status')."'";
		}
		 if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and a.invoice_date >='" . $this->getDate($this->input->post('startdate'))."'";
		}
		if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and a.invoice_date <='" . $this->getDate($this->input->post('enddate'))."'";
		}
	}
	function pos_register(){
		$this->select = 'IFNULL(i,0) as refs,Vehicle_num,a.longitude as salelongitude,a.latitude as salelatitude,0 as ref,a.published as pub, a.type as stype, DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,  a.*,b.*,DATE_FORMAT(CONVERT_TZ(created_date,"+00:00","+05:30"),"%d/%m/%Y-%H:%i:%S ") as created_time';
        $this->table = 'sales as a inner join set_billtype as st on st.id = a.bill_type and is_pos = 1 left join (SELECT DISTINCT sales_ref_id as i FROM `sales_items` as si WHERE si.published = "yes") as x on x.i = a.sales_id left join suppliers as b on a.customer_id =b.id left join ims_vehicle  on a.vehicle = ims_vehicle.Id    ';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','a.total','b.email', 'b.phone', 'b.name', 'a.cusname', 'a.cusdetails','a.ref_no'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order
	}
	
	function getpos(){
		$this->select = 'a.published as pub, a.type as stype, DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,  a.*,b.*';
        $this->table = 'sales as a left join suppliers as b on a.customer_id =b.id';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name', 'a.cusname', 'a.cusdetails'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
		 $this->wherecondition = " where a.type = '" . $this->input->post('type') . "' ";
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . " and a.bill_type =" . $this->input->post('btype');
        }
	}
	
	function max() {
        $qry = 'select max(Sales_id) as max_id from sales where type ="' . $this->input->post('type') . '"';
        if ($this->input->post('btype')) {
            $qry = 'select max(Sales_id) as max_id from sales where bill_type= ' . $this->input->post('btype') . ' and type ="' . $this->input->post('type') . '"';
        }
        $query = $this->db->query($qry);
        return $query->row_array();
    }
	
	public function save_counter_trans(){
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$user_id  =  $this->input->post('user_id');
		$settings_id  =  $this->input->post('settings_id');
		$counter  =  $this->input->post('counter');
		$op_bal = $this->input->post('op_bal');
		$notes =   $this->input->post('notes');
		$cl_bal = 0;
		$qry ="select * from counter_trans where counter_id = '".$counter."' and trans_date='".date("Y-m-d")."' and logouttime like'%0000-00-00%' ";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			//$query  = $query->row_array();
			//$qry = "update counter_trans set logouttime ='".date('Y-m-d H:i:s', time())."' where id=".$query['id'];
			//$this->db->query($qry);
		}
		if($this->input->post('cl_bal')){
			$cl_bal = $this->input->post('cl_bal');
		}
		$notes = $this->input->post('notes');
		$data = array(
			'counter_id'=>$counter,
			'opening_balance'=>$op_bal,
			'user_id'=>$user_id,
			'notes'=>$notes
		);
		if((int) $settings_id > 0 ){
			$data['status'] =1;
			$data['logouttime'] =date('Y-m-d H:i:s', time());
			$data['closing_balance'] = $cl_bal;
			$this->db->where('id',$settings_id);
			$this->db->update('counter_trans',$data);
			$insert_id = $settings_id;
		}else{
			$qry = "select * from counter_trans where trans_date='".date("Y-m-d")."' and counter_id= '".$counter."' and status < 1";
			$query = $this->db->query($qry);
			if($query->num_rows() < 1){
				$data['trans_date']= date("Y-m-d");
				$data['login_time']= date('Y-m-d H:i:s', time());
				$this->db->insert('counter_trans',$data);
				$insert_id = $this->db->insert_id();
			}else{
				$insert_id = 0 ;
			}
			
		}
		return $insert_id;
	}

	
	public function save_counter(){
		$id = $this->input->post('id');
		$name = $this->input->post('counter');
		$bill_type = $this->input->post('btype');
		$details = $this->input->post('counter_details');
		$data = array(
			'name' =>$name,
			'bill_type'=>$bill_type,
			'details'=>$details
		);
		if((int) $id > 0){
			$this->db->where('id',$id);
			$this->db->update('counter',$data);
			$insert_id = $id;
		}else{
			$this->db->insert('counter',$data);
			$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	}
	public function where(){
		
	}
	public function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM sales as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,sales_id from sales as b WHERE bill_type='" . $type . "') as c on c.sales_id=a.sales_id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['invoice']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];

            return $num;
        }
    }
	
	function InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $invoice = "") {
        $qty = $data['quantity'];
        $this->db->insert('sales_items', $data);
        if ($or_type != 'estimate') {
            $this->tax_add($data['tax_id'], $data['total'], $data['tax'], $data['total'] - $data['tax']);
            $ttp = 'cr';
            if ($or_type == 'sales_return') {
                $ttp = 'dt';
            }
            $this->stock_trans(0, $data['item_id'], $qty, $invoicedate, $ttp, $or_type, $data['sales_id'], $data['mrp'], $data['mrp'], $data['tax_id'], $data['godown'], $invoice);
            $this->godown_stock_trans(0, $data['item_id'], $qty, $ttp, $or_type, $data['godown']);
        }
    }
	
	function savesub($data, $or_type, $insert_id, $subtot, $saletaxtot, $rount, $is_mul_led, $branch, $bank_ledger,$cash_ledger){
		$toid = $cash_ledger;
		if (strtolower($data['cash_type']) == 'cash' || strtolower($data['cash_type']) == 'bank') {
			$paytype = $cash_ledger;
			if(strtolower($data['cash_type']) == 'bank'){
				$paytype = $bank_ledger;
				$toid  = $bank_ledger;
			}
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $paytype, $data['invoice_date'], '0.00', round($data['total']), $data['narration'], 1, $data['cost_center'], $branch);
        } else if(strtolower($data['cash_type']) == 'cob'){
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $cash_ledger, $data['invoice_date'], '0.00', $data['cash_amount'], $data['narration'], 1, $data['cost_center'], $branch);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $bank_ledger, $data['invoice_date'], '0.00', $data['bank_amount'], $data['narration'], 1, $data['cost_center'], $branch);
		}

		$salesamount = ($data['total']-$data['roundoff']);
		if($data['roundoff']  < 0 ){
			$salesamount = ($data['total']+$data['roundoff']);
		}
		if ($is_mul_led == 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $salesamount, '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        } else {
            $this->tax_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);
        }
        if ($data['roundoff'] > 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], $data['roundoff'], '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        }
		if ($data['roundoff'] < 0) {
            $rount = $data['roundoff'] * -1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], '0.00', $rount, $data['narration'], 1, $data['cost_center'], $branch);
        }
	}
    function UpdateSales($data, $id, $or_type) {
        if ($or_type == 'sales') {
            $ttp = 'dt';
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, $ttp);
        } else if ($or_type == 'sales_return') {
            $ttp = 'cr';
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock($id, $ttp);
        }
        $this->db->where('sales_id', $id);
        $this->db->update('sales', $data);

        $qry = "update  sales_items set published ='no' where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  sales_coupon set published ='no' where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  sales_ledgers set published ='no'  where sales_id =" . $id;
        $this->db->query($qry);
    }
    function save() {
	  date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
	  $tmp = $this->session->userdata('user');
      $userid = $tmp['Id'];
	 // $qry  = "select * from counter_trans as a inner join counter as b on a.counter_id=b.id where trans_date ='".date("Y-m-d")."' and user_id = '".$userid."' and logouttime like'%0000-00-00%'";
	  //$query = $this->db->query($qry)->row_array();
	  //$bill_type = $query['bill_type'];
	  
	  $user = $this->session->userdata('user');
      $user_default_billtype = $user['user_default_billtype'];
	  $bill_type = $user_default_billtype;
	  $qry = "select * from set_billtype where transaction='sales' and  is_pos = 1 limit 0,1";
	  $dat = $this->db->query($qry);
	  if($dat->num_rows() > 0 ){
		$dat =  $dat->row_array();
		$bill_type = $dat['id'];
	  }
	  $branch=1;
	  $or_type ='sales';
	  $godown = 1 ;
	  $is_mul_led = 0;
	  $printtype = 1;
	  $bank_ledger  = 1 ;
	  $cash_ledger = 1;
	  $qry = "select * from set_billtype where id='".$bill_type."' limit 0,1";
	  $query = $this->db->query($qry);
	  if($query->num_rows()>0){
		$query = $query->row_array();
		$bank_ledger = $query['bank'];
		$cash_ledger = $query['cash'];
		$bill_type  = $query['id'];
		$printtype =  $query['print_type'];
		$branch = $query['branch_id'];
	  }else{
		 $query = "SELECT b.id FROM `bank` as a INNER JOIN acc_ledgers as b on a.id=b.ref_id and ref_code='bank' WHERE 1";
		 $query = $this->db->query($qry);
		 if($query->num_rows()>0){
			$query = $query->row_array();
			$bank_ledger = $query['id'];
		}
	  }
	  if((int) $bill_type < 1){
		$qry = "select * from set_billtype where transaction='sales' limit 0,1";
		$query = $this->db->query($qry)->row_array();
		$bill_type =  $query['id'];
		$printtype =  $query['print_type'];
		$branch = $query['branch_id'];
	  }
	  if($this->input->post('sales_id')){
		$sales_id = $this->input->post('sales_id');
		$qry = "select * from sales where sales_id=".$sales_id;
		$query = $this->db->query($qry)->row_array();
		$invoice = $query['invoice'];
	  }else{
		  $invoice = $this->getinoviceno($bill_type);
	  }
	   $customerName = '';
	  $customerPhone = '';
	  $customerEmail = '';
	  $cashAmount = 0;
	  $cardNO = 0;
	  $cardAmount = 0;
	  if($this->input->post('cardNO')){
		  $cardNO=$this->input->post('cardNO');
	  }
	  if($this->input->post('cardAmount')){
		  $cardAmount=$this->input->post('cardAmount');
	  }
	  if($this->input->post('cashAmount')){
		  $cashAmount=$this->input->post('cashAmount');
	  }
	  $paymentType =  $this->input->post('paymentType');
	  $cash_type = 'Cash';
	  if($paymentType=='card'){
		  $cash_type = 'Bank';
	  }else if($paymentType=='cashcard'){
		  $cash_type = 'COB';
	  }
	  if($this->input->post('customer')){
		$customerName = $this->input->post('customer');
	  }
	  if($this->input->post('phone')){
		$customerPhone = $this->input->post('phone');
	  }
	  if($this->input->post('email')){
		$customerEmail = $this->input->post('email');
	  }
	  $tmp = $this->session->userdata('user');
      $created_by = $tmp['Id'];
      $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . date('Y-m-d H:i:s', time());
	  $data = array(
            'cost_center' => 1,
            'cash_type' => $cash_type,
            'credit_eod' => date('Y-m-d H:i:s', time()),
            //'printtype' => $printtype,
			'card_no'=>$cardNO,
			'discount'=>0,
			'cash_amount'=>$cashAmount,
			'bank_amount'=>$cardAmount,
            //'total' => $gtotal,
            //'tax' => $tax,
            //'roundoff' => $rount,
            'narration' => $narration,
            'type' => 'sales',
           // 'bill_type' => $bill_type,
            'cusname' => $customerName,
            'cusdetails' => $customerPhone,
            'cusemail' => $customerEmail,
            'published' => 'yes'
		);
	if($this->input->post('sales_id')){
		$sales_id = $this->input->post('sales_id');
		$qry = "select * from sales where sales_id=".$sales_id;
		$query = $this->db->query($qry)->row_array();
		$data['invoice_date'] = $query['invoice_date'];
		$invoice = $query['invoice'];
		$data['invoice'] = $invoice;
		$this->db->where('sales_id',$sales_id);
		$this->db->update('sales',$data);
		$this->UpdateSales($data, $sales_id, 'sales');
	}else{
		$data['bill_type'] = $bill_type;
		$data['printtype'] = $printtype;
		$data['created_by'] = $created_by;
		$data['invoice_date'] = date('Y-m-d H:i:s', time());
        $data['created_date'] = date('Y-m-d H:i:s', time());
        $data['delivery_date'] = date('Y-m-d H:i:s', time());
		$data['invoice'] = $invoice;
		$this->db->insert('sales',$data);
		$sales_id = $this->db->insert_id();
	}
	  
	  if($this->input->post('ordproducts')){
		$ordproducts = $this->input->post('ordproducts');
		$length = sizeof($ordproducts);
		$purchase_total = 0;
		$tax_total = 0;
		for($i=0;$i<$length;$i++){
			$qry ="select * from item where id=".$ordproducts[$i]['id'];
			$query =  $this->db->query($qry)->row_array();
			$purchase_total = (float) $purchase_total + (float) $ordproducts[$i]['rowtotal'];
			$tax_total = (float) $tax_total + (float) $ordproducts[$i]['tax_total'];
			$sub_data = array(
                'analytics' => 0,
                'sales_id' => $sales_id,
                'item_id' => $ordproducts[$i]['id'],
                'is_taxincluded' =>'0',
                'godown' => $godown,
                'unit_id' => $query['unit_id'],
                'base_unit_id' => $query['unit_id'],
                'quantity' =>$ordproducts[$i]['qty'],
                //'rate' => $ordproducts[$i]['srate'],
                'mrp' => $ordproducts[$i]['srate'],
                'tax_id' => $ordproducts[$i]['tax_id'],
                'tax' => $ordproducts[$i]['tax_total'],
                'dis_amt' => $ordproducts[$i]['disc'],
                'discount' => 0,
                'total' => $ordproducts[$i]['rowtotal'],
                'published' => 'yes'
            );
			$this->InsertSales_items($sub_data, 'sales', date('Y-m-d H:i:s', time()), $is_mul_led, 1, $invoice);
		}
		//print_r();
		$rount = (float)$purchase_total - (float)round($purchase_total);
		$rount = round($rount,2);
		
		$query ="update sales set total = ".round((float)$purchase_total)." , tax= ".$tax_total.",roundoff=".(float)$rount ." where sales_id= ".$sales_id;
		$this->db->query($query);
		$data['total'] = round($purchase_total);
		$data['roundoff'] = (float)$purchase_total - (float)round($purchase_total);
		
		$subtot = round($purchase_total) + ((float)$purchase_total - (float)round($purchase_total));
        $this->savesub($data, $or_type, $sales_id, $subtot, $tax_total, $rount, $is_mul_led, $branch, $bank_ledger,$cash_ledger);
	  }
	  return $sales_id;
    }

}