<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Dimind
 */
class Services_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name,b.phone,p.bill_no,DATE_FORMAT(a.date, "%d/%m/%Y" )  as invdate';
        $this->table = ' `service` as a left join proposal as p on a.quatation_no=p.id INNER JOIN suppliers as b on a.customer_id =b.id  and a.published="yes" ';
        $this->column_order = array(null, 'a.date','a.id','a.id','b.name','b.phone', 'net_total',null); //set column field database for datatable orderable   
        $this->column_search = array('a.name','b.name'); //set column field database for datatable searchable 
        $this->order = array('a.date' => 'desc'); // default order 
    }

    function where() {

       
    }
	
	function itemsearch($search) {
		$qry = "select a.*,a.name as label from item as a where name like'%".$search."%' or barcode like'%".$search."%' ";
	   $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	function editrow(){
		$id = $this->input->post('id');
		$qry = "select b.name,a.* from price_list_items as a inner join item as b on b.id=a.item_id where a.id = ".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	public function getinvoiceno($id){
		$qry = "select * from set_billtype where id=".$id;
		$billtype = $this->db->query($qry)->row_array();
		$qry = "select * from service where bill_type = ".$id ." order by id desc limit 0,1" ;
		$query = $this->db->query($qry);
		if($query->num_rows() < 1){
			$invoice = $billtype['startnumber'];
		}else{
			$query  = $query->row_array();
			$old = $query['invoice'];
			$old = str_replace($billtype['preffix'], "", $query['invoice']);
			$old = str_replace($billtype['suffix'], "", $old);
			$old = str_replace("2020", "", $old);
			$old = str_replace($billtype['seperator'], "", $old);
			$old = $old + 1;
            $invoice = $old;
		}
		return $invoice;
	}
	
	function getinvoice($id){
		$qry = "select * from set_billtype where id=".$id;
		$billtype = $this->db->query($qry)->row_array();
		$qry = "select * from service where bill_type = ".$id ." order by id desc limit 0,1" ;
		$query = $this->db->query($qry);
		if($query->num_rows() < 1){
			$invoice = $billtype['preffix'].$billtype['seperator'].$billtype['startnumber'].$billtype['seperator'].$billtype['suffix'];
		}else{
			$query  = $query->row_array();
			$old = $query['invoice'];
			$old = str_replace($billtype['preffix'], "", $query['invoice']);
			$old = str_replace($billtype['suffix'], "", $old);
			$old = str_replace("2020", "", $old);
			$old = str_replace($billtype['seperator'], "", $old);
			$old = $old + 1;
            $invoice = $billtype['preffix'] . $billtype['seperator'] . $old . $billtype['seperator'] . $billtype['suffix'];
		}
		return $invoice;
	}
	
	public function where_item(){
		$id = $this->input->post('id');
		$this->select = 'b.*,c.name';
        $this->table = '`price_list` as a INNER JOIN price_list_items as b on a.id=b.price_list_id inner join item as c on c.id=b.item_id ';
        $this->column_order = array(null, 'a.price_list','c.name', null); //set column field database for datatable orderable   
        $this->column_search = array('a.price_list','c.name'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
        $this->wherecondition = " where a.id = '" . $this->input->post('id') . "' ";
    }
	
    function kit_items($id) {
        $qry = "select c.name as item,a.*,b.* from kit_group as a left join kit_items as b on b.kit_id=a.id left join item as c on c.id=b.item_id  where b.published='yes' and a.type='kit_group' and a.id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function get_kit_items($id) {
        $qry = "select a.*,b.*,c.*,d.name as unit,e.GST as GST,b.name as item FROM kit_items as a INNER JOIN item as b on b.id=a.item_id inner join taxgst as c on c.gstid=b.tax_id left JOIN units as d on d.id=b.unit_id left join taxgst as e on e.gstid=b.tax_id where a.published='yes' and kit_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function kitgroup($search, $customer_id) {
        $is = '';
        $qry = "select name as label,a.* from kit_group as a where a.type='kit_group' and name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	
	public function getsing($id){
		$qry = "select DATE_FORMAT(a.date,'%d/%m/%Y') as dates,pro.bill_no,a.*,b.*,c.name,s.name as supplier from service as a inner join suppliers as s on s.id=a.customer_id inner join service_items as b on a.id=b.service_id and b.published ='yes' inner join item as c on c.id=b.description left join proposal as pro on pro.id=a.quatation_no where a.id=".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	public function getdetails($id){
		$qry ="SELECT c.address_line2,c.address_line1,bill_no,c.tin,DATE_FORMAT(a.date, '%e %M %Y') as sdate,b.total as subtotal,b.tax as subtax,a.total as gtotal,a.tax as gtax,a.*,b.*,c.name,d.name as itemname,t.GST FROM `service` as a left join proposal as pro on pro.id=a.quatation_no  INNER JOIN service_items as b on a.id=b.service_id and b.published='yes' INNER JOIN suppliers as c on c.id=a.customer_id INNER join item as d on d.id=b.description INNER join taxgst as t on t.gstid=b.tax_id where a.id=".$id;
		$result = $this->db->query($qry);
		return $result->result_array();
	}

    function save() {
		$cost_center = 0 ;
		if($this->input->post('Costcenter')){
			$cost_center = $this->input->post('Costcenter');
		}
		$g_tax = $this->input->post('g_tax');
		$g_total = $this->input->post('g_total');
		$is_ces = 0;
		if($this->input->post('is_ces')){
			$is_ces = 1;
		}
		$date = $this->getDate($this->input->post('date'));
		$btype = $this->input->post('btype');
		$cash_type = $this->input->post('cash_type');
		if($this->input->post('invoice_no')){
			$invoice_no = $this->input->post('invoice_no');
		}else{
			$invoice_no = $this->getinvoice(19);
		}
		$customer_id = $this->input->post('customer_id');
		$quatation_no = $this->input->post('quatation_no');
		$g_ces = 0 ;
		if((float) $is_ces > 0 ){
			$g_ces = $this->input->post('g_ces');
			$g_total = (float) $g_total + (float)$g_ces ;
		}
		$id = $this->input->post('id');
		$rount = round($g_total)-$g_total;
		$data = array(
			'cost_center'=>$cost_center,
			'bill_type'=>$btype,
			'ces_amt'=>$g_ces,
			'net_total'=>round($g_total),
			'total'=>$this->input->post('g_total'),
			'roundoff'=>round($g_total)-$g_total,
			'is_ces'=>$is_ces,
			'tax'=>$g_tax,
			'customer_id'=>$customer_id,
			'invoice'=>$invoice_no,
			'date'=>$date,
			'quatation_no'=>$quatation_no,
			'cash_type'=>$cash_type
		);
		if((int) $id  >0 ){
			$this->db->where('id',$id);
			$this->db->update('service',$data);
			$qry = "update service_items set published ='no' where service_id=".$id;
			$this->db->query($qry);
			$qry = "update acc_ledger_trans set published ='no' where tb_id=".$id." and trn_tp = 'service'";
			$this->db->query($qry);
			$insert_id = $id;
		}else{
			$this->db->insert('service',$data);
			$insert_id = $this->db->insert_id();
		}
		if($cash_type == 'cash'){
			$toid = $this->cashaccount;
			$this->trans_save($invoice_no, $insert_id, 'service', 'service', $this->sales, $this->cashaccount, $date, '0.00', round($g_total), $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
		}else{
			$res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
			$toid = $res['id'];
            $this->trans_save($invoice_no, $insert_id, 'service', 'service', $this->sales, $res['id'], $date, '0.00', round($g_total), $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
		}
		if ($rount > 0) {
            $this->trans_save($invoice_no, $insert_id, 'service', 'service', $toid, $this->rount, $date, $rount, '0.00', $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($invoice_no, $insert_id, 'service', 'service', $toid, $this->rount, $date, '0.00', $rount, $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
        }
		$this->trans_save($invoice_no, $insert_id, 'service', 'service', $toid, $this->sales, $date, $g_total- $g_tax - $g_ces, '0.00', $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
		if((float) $is_ces > 0 ){
			$this->trans_save($invoice_no, $insert_id, 'service', 'service', $toid, 124, $date,  $g_ces, '0.00', $data['invoice']. 'On '.$date, 1, $data['cost_center'], 1);
		}
		$item_ids = $this->input->post('item_ids',true);
		$item_salerate = $this->input->post('item_salerate',true);
		$tax_ids = $this->input->post('tax_ids',true);
		$item_taxamount = $this->input->post('item_taxamount',true);
		$item_total = $this->input->post('item_total',true);
		$item_quantity = $this->input->post('item_quantity',true);
		if($this->input->post('item_ids',true)){
			$size = sizeof($this->input->post('item_ids',true));
			for($i=0;$i<$size;$i++){
				$data = array(
					'service_id'=>$insert_id,
					'description'=>$item_ids[$i],
					'quantity'=>$item_quantity[$i],
					'amount'=>$item_salerate[$i],
					'tax_id'=>$tax_ids[$i],
					'tax'=>$item_taxamount[$i],
					'total'=>$item_total[$i]
				);
			$this->tax_add($data['tax_id'], $data['total'], $data['tax'], $data['total'] - $data['tax']);

				$this->db->insert('service_items',$data);
			}
		}
		$this->tax_save($invoice_no, $insert_id, 'service', $toid, $date, $invoice_no. 'On '.$date, 'service', $cost_center, 1, 1, 0);
		return $insert_id;
    }

}
