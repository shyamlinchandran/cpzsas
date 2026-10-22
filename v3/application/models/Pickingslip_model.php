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
class Pickingslip_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name as cusname,u.user_name as username,sa.user_name as salesmanname';
        $this->table = ' `picking_slip` as a LEFT JOIN suppliers as b on a.customer = b.id LEFT JOIN users as u on u.Id = a.user LEFT JOIN users as sa on sa.Id = a.salesman ';
        $this->column_order = array(null, 'a.voucher_no', null); //set column field database for datatable orderable   
        $this->column_search = array('a.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('a.picking_slip_id' => 'desc'); // default order 
    }

    function where() {

       
    }
	
	function itemsearch($search) {
		$settings = $this->getCompanySettings();
		$category_product = 0 ;
		if(isset($settings[0]['category_product'] ) ){
			$category_product = $settings[0]['category_product'];
		}
		
		$category_label = 'a.name';
		$category_join = "";
		if((float) $category_product > 0  ){
			$category_label = ' CASE WHEN ic.name is null then "" else concat(ic.name,"/") end , CASE WHEN sic.name is null then "" else concat(sic.name,"/") end ,a.name ';
			$category_join = ' left join item_category as ic on ic.id = a.item_category_id  left join item_category as sic on sic.id = ic.item_category_id ';
		}	
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
        $qry = "select 0 as godown_id,'' as itembatch,CONCAT(".$category_label.",'      ,  Mrp:',MRP) as label,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a  ".$category_join ." left join item_group as b on a.item_group_id =b.id where($ls) or ($part1) or ($part2) or price_code ='%$search%'     or barcode ='$search' limit  50";
       	if((int) $isbatch  > 0){
			$qry = "select a.name,a.id,batches.godown_id,batches.batch as itembatch,CONCAT(".$category_label.",' , Srate:',IFNULL(item_srate,srate),' Godown: ',godown_name) as label,IFNULL(item_srate,srate) as srate,b.discount as dis, (IFNULL(batches.current_stock,0)+batches.open_stock) as currentstk from item as a ".$category_join ." left join item_godown as batches on batches.item_id=a.id left join ims_godown as ims on ims.id=batches.godown_id  left join item_group as b on a.item_group_id =b.id where($ls) or price_code ='%$search%'     or barcode ='$search' limit  50";
		}
	   $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	function editrow(){
		$id = $this->input->post('id');
		$qry = "select a.*,b.name from `picking_slip_items` as a LEFT JOIN item as b on a.item_id = b.id where a.id = ".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}

	function get_slip_items($id){
		$qry = "select a.*,b.name from `picking_slip_items` as a LEFT JOIN item as b on a.item_id = b.id where a.published = 'yes' and a.slip_id = ".$id;
		$result = $this->db->query($qry);
        return $result->result_array();
	}
	

	public function get_slip($id){
		$qry = "SELECT DATE_FORMAT(a.date, '%d/%m/%Y' ) as in_date,a.*,b.name as cusname,u.user_name as username,sa.user_name  as salesmanname FROM `picking_slip` as a LEFT JOIN suppliers as b on a.customer = b.id LEFT JOIN users as u on u.Id = a.user LEFT JOIN users as sa on sa.Id = a.salesman where picking_slip_id =".$id;
		$details = $this->db->query($qry)->row_array();
		return $details;
	}


	public function getsing($id){
		$qry = "SELECT DATE_FORMAT(a.date, '%d/%m/%Y' ) as in_date,a.*,b.name as cusname,u.user_name as username,sa.user_name  as salesmanname FROM `picking_slip` as a LEFT JOIN suppliers as b on a.customer = b.id LEFT JOIN users as u on u.Id = a.user LEFT JOIN users as sa on sa.Id = a.salesman where picking_slip_id =".$id;
		$details = $this->db->query($qry)->row_array();
		echo json_encode($details);
	}
	
	public function where_item(){
	
		$id = $this->input->post('id');
		$this->select = 'a.*,b.name';
        $this->table = '`picking_slip_items` as a LEFT JOIN item as b on a.item_id = b.id ';
        $this->column_order = array(null, 'itemname','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array('a.itemname','b.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->wherecondition = " where a.published = 'yes' and a.slip_id = '" . $this->input->post('id') . "' ";
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

	function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT voucher_no FROM  picking_slip  where  bill_type='" . $type . "' and published='yes'  order by picking_slip_id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['voucher_no']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = (int) $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }

    function save() {
		$sales_rate = $this->input->post('sales_rate');
		$id = $this->input->post('id');
		$itemname = $this->input->post('itemname');
		$quantity = $this->input->post('quantity');
		$product_id = $this->input->post('product_id');
		$date = $this->input->post('date');
		$salesman =$this->input->post('salesman');
		$user = $this->input->post('user');
		$supid = $this->input->post('supid');
		$bill_type = $this->input->post('bill_type');
		$voucher_no = $this->getinoviceno($bill_type);
		$insert_id = $id;
		if((int) $id < 1){
			$data = array(
				'voucher_no'=>$voucher_no,
				'bill_type'=>$bill_type,
				'date'=>$this->getDate($date),
				'salesman'=>$salesman,
				'user'=>$user,
				'customer'=>$supid
			);
			$this->db->insert('picking_slip',$data);
			$insert_id = $this->db->insert_id();
		}else{
			$data = array(
				'date'=>$this->getDate($date),
				'salesman'=>$salesman,
				'user'=>$user,
				'customer'=>$supid
			);
			$this->db->where('picking_slip_id',$id);
			$this->db->update('picking_slip',$data);
		}
		$data = array(
			'slip_id'=>$insert_id,
			'item_id'=>$product_id,
			'itemrate'=>$sales_rate,
			'itemquantity'=>$quantity,
			'itemname'=>$itemname,
			'itemtotal'=>$sales_rate * $quantity,
			'published'=>'yes'
		);
		$where_text = '';
		$ref_id = $this->input->post('ref_id') ;
		$qry = "select * from price_list_items where   id='".$ref_id."' ";
		$query = $this->db->query($qry);
		if($query->num_rows()>0){
			$this->db->where('id',$ref_id);
			$this->db->update('picking_slip_items',$data);
		}else{
			$this->db->insert('picking_slip_items',$data);
		}
		return $insert_id;
    }

	function delete_item($id){
		$qry = "update picking_slip_items set published ='no' where id =  ".$id;
		$this->db->query($qry);
	}

}
