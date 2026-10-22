<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Physical_stock_model extends DataTable {

    public function __construct() {
        parent::__construct();

    }
	
	function where(){
		$this->select = "*";
		$this->table =  "physical_stk_update";
		$this->column_order = array( 'voucher_no'); 
		$this->column_search = array( 'voucher_no'); 
		$this->order = array('id' => 'asc'); 
		$this->wherecondition = ' where published = "yes" ';
	}
	
	function Physical_stock(){
		$id = $this->input->post('id');
		$txt = 'i.name ,i.name as itemname';
		if(strtolower($this->session->userdata('login_base_comid')) == 'senzation'){
			$txt = 'concat(i.name," batch : ",IFNULL(ig.batch,"") ) as itemname';
		}
		if((float) $id < 1 ){
			$this->select = "ig.batch,'' as actualStk ,0 as quantity,g.id as godown_id,i.id,".$txt.",i.barcode,g.godown_name,IFNULL(ig.open_stock,0) as open_stock,IFNULL(ig.open_stock,0) + IFNULL(ig.current_stock,0) as stock";
			$this->table = "item as i CROSS JOIN ims_godown as g on 1=1 and i.published = 'yes'  left JOIN item_godown as ig on ig.godown_id = g.id and ig.item_id = i.id";
			$this->column_order = array(null, 'i.name','i.barcode'); 
			$this->column_search = array( 'i.name','i.barcode'); 
			$this->order = array('i.name' => 'asc'); 
			$this->wherecondition = ' where i.published = "yes" ';
		}else{
			$txt = '';
			$settings = $this->getCompanySettings();
			$is_batch = $settings[0]['is_batch'];
			if((float) $is_batch > 0  ){
				$txt = ' and ps.batch = ig.batch';
			}
			$this->select = "ig.batch,actualStk,ps.quantity,".$txt.",i.barcode,godown_name,ig.open_stock,g.id as godown_id,i.id,ig.open_stock + ig.current_stock + CASE WHEN ps.type ='cr' then ps.quantity else -1*ps.quantity end as stocks,current as stock";
			$this->table = "`physical_stk_update_items` as ps INNER JOIN item as i on i.id = ps.item_id  and i.published = 'yes' INNER JOIN ims_godown as g on g.id =ps.godown_id INNER JOIN item_godown as ig on ig.godown_id = g.id and ig.item_id = ps.item_id ".$txt." ";
			$this->column_order = array(null, 'i.name','i.barcode'); 
			$this->column_search = array( 'i.name','i.barcode'); 
			$this->order = array('i.name' => 'asc'); 
			$this->wherecondition = ' where  ps.phy_stk_upd_id =  '.$id;
		}
		
		if($this->input->post('brand')){
			 $this->wherecondition = $this->wherecondition . " and i.brand_id = ".$this->input->post('brand');
		}
		if($this->input->post('category_id')){
			 $this->wherecondition = $this->wherecondition . " and i.item_category_id = ".$this->input->post('category_id');
		}
	}
	
	public function getinvoice(){
		$qry ="select * from physical_stk_update where published ='yes' order by id desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('PS', "", $query['voucher_no']);
			$invoice = (int) $invoice + 1;
			return 'PS'.$invoice;
		}else{
			return 'PS1';
		}
		
	}
	
	function restore_physical_stock($id,$godown_id,$item_id){
		$qry = "select * from physical_stk_update_items where item_id = ".$item_id." and godown_id = ".$godown_id." and  published ='yes' and  phy_stk_upd_id= ".$id;
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			$type = $item['type'];
			$ttp = 'cr';
			if($type == 'cr'){
				$ttp = "dt";
			}
			//$this->stock_trans(0,$item['item_id'], $item['quantity'], date('Y-m-d H:i:s', time()), $ttp, 'stock_update', $item['id'], 0, 0, 0,  $item['godown_id'], $item['voucher_no'], 0);
			$settings = $this->getCompanySettings();
			$is_batch = $settings[0]['is_batch'];
			if((float) $is_batch < 1 ){
				$this->godown_stock_trans(0, $item['item_id'], $item['quantity'], $ttp, 'stock_update', $item['godown_id'], 0);
			}else{
				$this->godown_stock_trans(0, $item['item_id'], $item['quantity'], $ttp, 'stock_update', $item['godown_id'],$item['batch'] );
			}
		}
		$qry = "update item_ledger set published = 'no' where godown = ".$godown_id."  and item_id = ".$item_id." and  trans_status='stock_update' and trans_id = ".$id;
		$this->db->query($qry);
		$qry = "update ";
	}
	
	public function save(){
		$godown_id = $this->input->post('godown_id',true);
		$item_ids = $this->input->post('item_ids',true);
		$quantity = $this->input->post('quantity',true);
		$actualStk = $this->input->post('actualStk',true);
		$voucher_no = $this->getinvoice();
		$current =  $this->input->post('current',true);
		$batch =  $this->input->post('batch',true);
		$settings = $this->getCompanySettings();
		$is_batch = $settings[0]['is_batch'];
		$id = $this->input->post('id');
		$length = sizeof($item_ids);
		if((float) $length > 0 ){
			if((float) $id < 1 ){
				$data = array(
					'voucher_no'=>$voucher_no,
					'voucher_date'=>date('Y-m-d H:i:s', time()),
				);
				$this->db->insert('physical_stk_update',$data);
				$insert_id = $this->db->insert_id();				
			}else{
				$qry = "select * from physical_stk_update where id = ".$id;
				$query = $this->db->query($qry)->row_array();
				$voucher_no  = $query['voucher_no'];
				$insert_id = $id;
				$data = array(
					'last_udatedate'=>date('Y-m-d H:i:s', time())
				);
				$this->db->where('id',$insert_id);
				$this->db->update('physical_stk_update',$data);
			}
			
			for($i = 0; $i<$length;$i++){
				$item_quantity = $quantity[$i];
				$type = 'dt';
				if((float) $item_quantity < 0 ){
					$item_quantity = $item_quantity * -1;
					$type = 'cr';
				}
				$data = array(
					'phy_stk_upd_id'=>$insert_id,
					'godown_id'=>$godown_id[$i],
					'item_id'=>$item_ids[$i],
					'quantity'=>$item_quantity,
					'actualStk'=>$actualStk[$i],
					'current'=>$current[$i],
					'type'=>$type,
					'batch'=>$batch[$i]
				);
				if((float) $id > 0 ){
					$this->restore_physical_stock($insert_id,$godown_id[$i],$item_ids[$i]);
					$this->db->where('item_id',$item_ids[$i]);
					$this->db->where('godown_id',$godown_id[$i]);
					$this->db->where('phy_stk_upd_id',$insert_id);
					$this->db->update('physical_stk_update_items',$data);
				}else{
					$this->db->insert('physical_stk_update_items',$data);
				}
				$ttp = $type ;
				if((float) $item_quantity > 0 ){
					if((float) $is_batch < 1 ){
						$this->stock_trans(0,$item_ids[$i], $item_quantity, date('Y-m-d H:i:s', time()), $ttp, 'stock_update', $insert_id, 0, 0, 0,  $godown_id[$i], $voucher_no, 0);
						$this->godown_stock_trans(0, $item_ids[$i], $item_quantity, $ttp, 'stock_update',$godown_id[$i], 0);
					}else{
						$this->stock_trans(0,$item_ids[$i], $item_quantity, date('Y-m-d H:i:s', time()), $ttp, 'stock_update', $insert_id, 0, 0, 0,  $godown_id[$i], $voucher_no, $batch[$i]);
						$this->godown_stock_trans(0, $item_ids[$i], $item_quantity, $ttp, 'stock_update',$godown_id[$i],$batch[$i] );
					}
				}
				
			}
			
		}
	}

    
    

   

}
