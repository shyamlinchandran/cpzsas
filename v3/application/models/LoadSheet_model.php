<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ledgers_model
 *
 * @author jijodileep
 */
class LoadSheet_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.voucher_no,DATE_FORMAT(CONVERT_TZ(a.created_date,"+00:00","+05:30"),"%d/%m/%Y-%H:%i:%S ") as created_date,u.user_name as created_by,sa.user_name as salesman,a.id';
        $this->table = '  `loading_sheet` as a INNER JOIN users as u on a.`created_by` = u.Id and a.status = 1 LEFT JOIN users as sa on sa.Id = a.salesman';
        $this->column_order = array('a.id', 'u.user_name', 'sa.user_name'); //set column field database for datatable orderable
        $this->column_search = array('a.id', 'u.user_name', 'sa.user_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
		$this->select = 'b.published as spub, b.type as stype,sales_id,a.*,b.invoice,b.invoice_date,b.total,IFNULL(s.name,cusname) as name,totals';
        $this->table = '  `loading_sheet_items` as a inner JOIN sales as b on a.invoice_id = b.sales_id left join (select load_sheet_id,sales_id as salesid,total as totals from  load_sheet_settlement  where is_delete = 0  group by sales_id asc ) as st on st.salesid = b.sales_id and st.load_sheet_id = a.loading_sheet_id left JOIN suppliers as s on s.id = b.customer_id';
        $this->column_order = array('a.id', 'b.invoice', 's.name'); //set column field database for datatable orderable
        $this->column_search = array('a.id', 'b.invoice', 's.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
		$this->wherecondition = ' where a.status ="active" and a.loading_sheet_id = '.$this->input->post('loadsheetid');
    }
	

	function remove(){
		$data = array(
			'status'=>'inactive'
		);
		$id = $this->input->post('invid');
		$this->db->where('id',$id);
		$this->db->update('loading_sheet_items',$data);
		$invoice_id = $this->input->post('invoice_id');
		$data = array(
			'loadsheet_status'=>'0'
		);
		$this->db->where('sales_id',$invoice_id);
		$this->db->update('sales',$data);
		$qry = "update load_sheet_settlement set is_delete = 1 where sales_id =  ".$invoice_id ;
		$this->db->query($qry);
	}
	function delete($id){
		$data = array(
			'status'=>0
		);
		$this->db->where('id',$id);
		$this->db->update('loading_sheet',$data);

		$qry = "update sales set loadsheet_status = 0 where sales_id in (select invoice_id from loading_sheet_items where loading_sheet_id = ".$id."  and status = 'active' ) ";
		$this->db->query($qry);
	}

	function getsing($id){
		$qry = "select * from units where id =".$id;
		$query = $this->db->query($qry)->row_array();
		return $query;
	}
	function parent($id){
		$parent_id = 0 ;
		if($id>0){
			$qry = "select IFNULL(unit_id,0) as unit_id from units where id ='".$id."'";
			$res = $this->db->query($qry);
			if($res->num_rows()>0){
				$query = $this->db->query($qry)->row_array();
				$parent_id =  $query['unit_id'];
			}
		}
		$qry = "SELECT a.* FROM `units` as a left join (select b.unit_id,COUNT(b.id) from units as b GROUP by unit_id) as c on c.unit_id=a.id WHERE c.unit_id is null or a.unit_id is null or a.unit_id =0 or a.id=".$parent_id;
		$result = $this->db->query($qry)->result_array();
		 $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
	}

	function Invoice(){
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$this->select = 'a.*,b.name ';
		$this->table = " sales as  a LEFT JOIN suppliers as b on a.customer_id  = b.id and a.published = 'yes' ";
		$this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array( 'b.name'); //set column field database for datatable searchable 
        $this->order = array( 'a.invoice_date' => 'desc'); // default order 
		$this->wherecondition = ' where loadsheet_status = 0  and a.published = "yes" ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }

		if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('type') . '"';
        }
	}
	

	function getinvoice(){
		$qry = "select * from loading_sheet order by id desc limit 0,1";
		$data = $this->db->query($qry);
		if($data->num_rows() < 1){
			return 'LS1';
		}else{
			$data = $data->row_array();
			$old_invoice = $data['voucher_no'];
			$old_invoice = str_replace("LS", "", $old_invoice);
			$old_invoice = (int) $old_invoice + 1;
			return 'LS'.$old_invoice;
		}
	}

	function switch(){
		$text   = str_replace("_",",",$this->input->post('text'));
		$qry = "update loading_sheet_items set status ='inactive' where invoice_id in (".$text.") ";
		$this->db->query($qry);

		$qry = "update sales set loadsheet_status = 0 where sales_id in (".$text.") ";
		$this->db->query($qry);

		$qry = "update load_sheet_settlement set is_delete = 1 where sales_id  in (".$text.")  " ;
		$this->db->query($qry);

		$invoice = $this->getinvoice();
		$tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
		$data = array(
			'voucher_no'=>$invoice,
			'created_by'=>$userid
		);
		$this->db->insert('loading_sheet',$data);
		$insert_id = $this->db->insert_id();

		$qry = 'select * from sales where sales_id in ( '.$text.') and loadsheet_status = 0 and published = "yes" ';
		$sales_data = $this->db->query($qry)->result_array();
		foreach($sales_data as $item){
			$load_sheet_data = array(
				'loading_sheet_id'=>$insert_id,
				'invoice_id'=>$item['sales_id']
			);
			$this->db->insert('loading_sheet_items',$load_sheet_data);
			$qry = "update sales set loadsheet_status = 1 where sales_id =".$item['sales_id'];
			$this->db->query($qry);
			$qry = "INSERT INTO `load_sheet_settlement`(load_sheet_id,sales_id,item_id,quantity,free_quantity,final_quantity,final_freequantity,total) SELECT load_sheet_id,sales_id,item_id,quantitys , free_quantity,quantitys,free_quantity,total From (SELECT ".$insert_id." as load_sheet_id,s.sales_id,si.item_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from sales as s INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (".$item['sales_id'].") GROUP by i.id,s.sales_id) as x";
			$this->db->query($qry);

		}

	}

	function save(){
		if($this->input->post('loadsheetid') ){
			$insert_id = $this->input->post('loadsheetid');
		}else{
			$text = $this->input->post('text');
			$salesman = $this->input->post('salesman');
			$invoice = $this->getinvoice();
			$tmp = $this->session->userdata('user');
			$userid = $tmp['Id'];
			$data = array(
				'voucher_no'=>$invoice,
				'created_by'=>$userid,
				'salesman'=>$salesman
			);
			$this->db->insert('loading_sheet',$data);
			$insert_id = $this->db->insert_id();
		}
		$qry = 'select * from sales where sales_id in ( '.str_replace("_",",",$this->input->post('text')).') and loadsheet_status = 0 and published = "yes" ';
		$sales_data = $this->db->query($qry)->result_array();
		foreach($sales_data as $item){
			$load_sheet_data = array(
				'loading_sheet_id'=>$insert_id,
				'invoice_id'=>$item['sales_id']
			);
			$this->db->insert('loading_sheet_items',$load_sheet_data);
			$qry = "update sales set loadsheet_status = 1 where sales_id =".$item['sales_id'];
			$this->db->query($qry);
			$qry = "INSERT INTO `load_sheet_settlement`(load_sheet_id,sales_id,item_id,quantity,free_quantity,final_quantity,final_freequantity,total) SELECT load_sheet_id,sales_id,item_id,quantitys , free_quantity,quantitys,free_quantity,total From (SELECT ".$insert_id." as load_sheet_id,s.sales_id,si.item_id,sum(si.quantity * box.base_unit_count) as quantitys ,sum(si.base_free_quantity) as free_quantity,s.total from sales as s INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id where s.sales_id in (".$item['sales_id'].") GROUP by i.id,s.sales_id) as x";
			$this->db->query($qry);
		}

	}

}
