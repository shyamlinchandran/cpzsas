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
class Pricelist_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.price_list,a.id,a.note';
        $this->table = ' price_list as a ';
        $this->column_order = array(null, 'a.price_list', null); //set column field database for datatable orderable   
        $this->column_search = array('a.price_list'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {

       
    }
	
	function itemsearch($search) {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $res = explode(' ', $search);
        $ls = '';
		$part1 = '';
		$part2 = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
					$part1 = $part1 . " a.part_no1 like('%$sd%')";
					$part2 = $part2 . " a.part_no2 like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
					$part1 = $part1 . " and  a.part_no1 like('%$sd%')";
					$part2 = $part2 . " and  a.part_no2 like('%$sd%')";
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
        }
        $qry = "select 0 as godown_id,'' as itembatch,CONCAT(a.name,'      ,  BC:',barcode,'      ,  Mrp:',MRP) as label,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join item_group as b on a.item_group_id =b.id where($ls) or ($part1) or ($part2) or price_code ='%$search%'     or barcode like'%$search%' limit  50";
       	if((int) $isbatch  > 0){
			$qry = "select a.name,a.id,batches.godown_id,batches.batch as itembatch,CONCAT(a.name,' , Srate:',IFNULL(item_srate,srate),' Godown: ',godown_name) as label,IFNULL(item_srate,srate) as srate,b.discount as dis, (IFNULL(batches.current_stock,0)+batches.open_stock) as currentstk from item as a left join item_godown as batches on batches.item_id=a.id left join ims_godown as ims on ims.id=batches.godown_id  left join item_group as b on a.item_group_id =b.id where($ls) or price_code ='%$search%'     or barcode like'%$search%' limit  50";
		}
	   $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	function editrow(){
		$id = $this->input->post('id');
		$qry = "select b.name,a.* from price_list_items as a inner join item as b on b.id=a.item_id where a.id = ".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	public function where_item(){
		$id = $this->input->post('id');
		$this->select = 'b.*,c.name';
        $this->table = '`price_list` as a INNER JOIN price_list_items as b on a.id=b.price_list_id and b.published = "yes" inner join item as c on c.id=b.item_id ';
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

    function save() {
		$product_batch_id = $this->input->post('product_batch_id');
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
		$id = $this->input->post('id');
		$sales_rate = $this->input->post('sales_rate');
		$discount = $this->input->post('discount');
		$discount_amount = $this->input->post('discount_amount');
		$product_id = $this->input->post('product_id');
		$price_list_name =$this->input->post('price_list_name');
		$price_list_notes = $this->input->post('price_list_notes');
		$insert_id = $id;
		if((int) $id < 1){
			$data = array(
				'price_list'=>$price_list_name,
				'note'=>$price_list_notes
			);
			$this->db->insert('price_list',$data);
			$insert_id = $this->db->insert_id();
		}else{
			$data = array(
				'price_list'=>$price_list_name,
				'note'=>$price_list_notes
			);
			$this->db->where('id',$id);
			$this->db->update('price_list',$data);
		}
		$data = array(
			'price_list_id'=>$insert_id,
			'item_id'=>$product_id,
			'sales_rate'=>$sales_rate,
			'batch'=>$product_batch_id,
			'price_discount'=>$discount,
			'price_discount_amount'=>$discount_amount,
			'published'=>'yes'
		);
		$where_text = '';
		if((int) $isbatch  > 0){
			$where_text = " and batch = '".$product_batch_id."' ";
		}
		$qry = "select * from price_list_items where price_list_id=".$insert_id."  ".$where_text." and  item_id=".$product_id." ";
		$query = $this->db->query($qry);
		if($query->num_rows()>0){
			$this->db->where('price_list_id',$insert_id);
			$this->db->where('item_id',$product_id);
			$this->db->where('batch',$product_batch_id);
			$this->db->update(' price_list_items',$data);
		}else{
			$this->db->insert(' price_list_items',$data);
		}
		return $insert_id;
    }

}
