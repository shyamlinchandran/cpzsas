<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once('dataTable.php');

class Material_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	function material(){
		$this->select = " DATE_FORMAT(date, '%d/%m/%Y' ) voucher_date,b.name,a.*";
        $this->table = "`material_card` as a left join suppliers as b on a.customer_id = b.id";
        $this->column_order = array(null, 'a.voucher_no','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.voucher_no','b.name', null); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
		$this->wherecondition = ' where a.type = "'.$this->input->post('type').'"  and a.published = "yes" ';
	}
	public function get_material($id){
		$qry ="select a.*,b.name,b.address_line1,b.tin from material_card as a left join suppliers as b on b.id = a.customer_id where  a.id ='".$id."' order by a.id desc limit 0,1";
		$query = $this->db->query($qry)->result_array();
		return $query;
	}
	
	function getMaterialItemscnt($id){
		$qry = "SELECT * FROM `material_card_items` as a INNER JOIN job_work_order_items as b on a.product_tbl_id = b.id and a.published ='yes' WHERE a.material_card_id =".$id;
		$query = $this->db->query($qry);
		return $query->num_rows();
	}
	
	public function getMaterialItems($id, $len, $size){
		$qry = "SELECT a.*,c.name as item,d.name as com_of,u.name as unit FROM `material_card_items` as a INNER JOIN job_work_order_items as b on a.product_tbl_id = b.id and a.published ='yes'  INNER JOIN item as c on c.id = a.item_id INNER JOIN item as d on d.id = b.item_id INNER JOIN units as u on u.id = c.unit_id WHERE a.material_card_id =".$id." limit $len,$size";
		$query = $this->db->query($qry)->result_array();
		return $query;
	}
	public function getinvoice($type){
		$qry ="select * from material_card where published ='yes' and type ='".$type."' order by id desc limit 0,1";
		$query = $this->db->query($qry);
		$preffix = 'MCI';
		if($type == 'out'){
			$preffix = 'MCO';
		}
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace($preffix, "", $query['voucher_no']);
			$invoice = (int) $invoice + 1;
			return $preffix.$invoice;
		}else{
			return $preffix.'1';
		}
		
	}
	
	function getjobcard($search, $type){
		$txt = " and a.status!= '".$type."' ";
		$qry = "SELECT  a.voucher_no as label,a.* from job_work_order as a  where status != 'completed' ".$txt." and  a.published='yes'  and  a.voucher_no like'%".$search."%'";
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function getmaterial_items($id){
		$qry ="SELECT a.*,i.name,b.godown_name,i.barcode FROM `material_card_items` as a INNER JOIN item as i on i.id = a.item_id and a.published='yes' INNER join ims_godown as b on b.id = a.godown_id where material_card_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function getjobcard_items_material($id){
		$qry ="SELECT a.*,i.name,b.godown_name,i.barcode FROM `job_work_order_raw_material` as a INNER JOIN item as i on i.id = a.material_id and a.published='yes' INNER join ims_godown as b on b.id = a.godown_id where job_work_order_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	function getjobcard_items($id){
		$qry = "SELECT a.*,b.godown_name,i.name FROM `job_work_order_items` as a INNER JOIN ims_godown as b on a.godown = b.id and a.published='yes' INNER JOIN item as i on i.id = a.item_id where job_work_order_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function getmaterial($id){
		$qry = "SELECT  DATE_FORMAT(eway_date, '%d/%m/%Y' ) voucher_way_date,DATE_FORMAT(date, '%d/%m/%Y' ) voucher_date,s.id as customer_id,s.name as customer_name,a.* FROM `material_card` as a left join suppliers as s on a.customer_id = s.id where a.id=".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}

	
	function productSearch($search){
            $qry=$this->db->select('a.*,b.name,b.srate,b.MRP')->from('bom_main as a')->join('item as b','a.itemid=b.id')->like('b.name',$search,'AFTER')->get()->result_array();
            foreach($qry as $row){
                $new_row['value']=htmlentities(stripcslashes($row['name']));
                $new_row['id']=htmlentities(stripcslashes($row['id']));
                $new_row['quantity']=htmlentities(stripcslashes($row['quantity']));
				$new_row['item_id']=htmlentities(stripcslashes($row['itemid']));
				$new_row['srate']=htmlentities(stripcslashes($row['srate']));
				$new_row['MRP']=htmlentities(stripcslashes($row['MRP']));
                $row_set[]= $new_row;
            }  
            echo json_encode($row_set);

        }
		
		 function getMaterialList($id){

            $qry=$this->db->select('a.*,b.name')->from('bom_sub_material as a')->join('item as b','a.materialid=b.id')->where('a.productid',$id)->where('a.is_available','Yes')->get()->result_array();
            echo json_encode($qry);
                
      }
	  
	  function restore_process($id){
			$qry = 'update item_ledger set published ="no" where trans_status ="man_journal" and trans_id =  '.$id;
			$this->db->query($qry);
			$qry = 'update acc_ledger_trans set published ="no" where tb_name = "man_journal" and tb_id = '.$id.' ';
			$this->db->query($qry);
			$qry = "select * from production_process_products where main_id =".$id." and is_available ='Yes' ";
			$result = $this->db->query($qry)->result_array();
			foreach($result as $item){
				$ttp = 'cr';
				$this->godown_stock_trans(0, $item['item_id'], $item['quantity'], $ttp, 'man_journal', $item['godown_id'], 0);
			}
			$qry = "select * from production_process_material_table where main_table_id = ".$id." and is_available='Yes' ";
			$result = $this->db->query($qry)->result_array();
			foreach($result as $item){
				$ttp = 'dt';
				$this->godown_stock_trans(0, $item['material_id'], $item['material_quantity'], $ttp, 'man_journal', $item['godown_id'], 0);
			}
		}
	  function restore_material_stock($id,$stock){
		  $qry = "select * from material_card where id = ".$id;
		  $material_card = $this->db->query($qry)->row_array();
		  if($material_card['stock_status'] == 'our_stock' ){
			  if($material_card['type'] == 'out'){
				  $qry = "update item_ledger  set published = 'no' where trans_status ='mat_transfer' and trans_id = ".$id;
				  $this->db->query($qry);
				  $qry = "select * from material_card_items where published='yes' and material_card_id=".$id;
				  $material_card_items = $this->db->query($qry)->result_array();
				  foreach($material_card_items as $item){
					  $this->godown_stock_trans(0, $item['item_id'], $item['quantity'], 'cr', 'item', $material_card['godown'],'');
					  $this->godown_stock_trans(0, $item['item_id'], $item['quantity'], 'dt', 'item', $item['godown_id'],'');			  
				  }
			  }else{
				$qry = "select * from production_process_main where is_available ='yes' and material_card_id = ".$id;
				$production_process_main = $this->db->query($qry);
				if($production_process_main->num_rows() > 0 ){
					$production_process_main = $production_process_main->row_array();
					$id = $production_process_main['id'];
					$this->restore_process($id);
				}
			  }
		  }
	  }
	  
	  public function getprocessinvoice(){
			$qry ="select * from production_process_main where is_available ='yes' and voucher_no!='' order by id desc limit 0,1";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0 ){
				$query = $query->row_array();
				$invoice = str_replace('MJ', "", $query['voucher_no']);
				$invoice = (int) $invoice + 1;
				return 'MJ'.$invoice;
			}else{
			return 'MJ1';
			}
		
		}
	  
	  function add_journal($id){
		  $qry = "select * from material_card where id = ".$id;
		  $material_card = $this->db->query($qry)->row_array();
		  $qry = "select * from production_process_main where material_card_id = ".$id;
		  $production_process_main = $this->db->query($qry);
		  $process_id = 0 ;
		  if($production_process_main->num_rows() > 0 ){
			  $production_process_main = $production_process_main->row_array();
			  $process_voucher_no = $production_process_main['voucher_no'];
			  $process_id =$production_process_main['id'];
			  $process_main_id = $production_process_main['id'];
		  }
		  $process_data = array(
			'bill_no'=>$material_card['voucher_no'],
			'status'=>1,
			'material_card_id'=>$id,
			'date'=>$material_card['date'],
			'is_available'=> 'yes'
		  );
		  $date = $material_card['date'];
		  if((float) $process_id < 1 ){
			  $process_data['voucher_no']= $this->getprocessinvoice();
			  $process_voucher_no = $process_data['voucher_no'];
			  $this->db->insert('production_process_main',$process_data);
			  $process_main_id = $this->db->insert_id();
		  }else{
			$this->db->where('material_card_id',$id);
		    $this->db->update('production_process_main',$process_data);
		  }
		  
		  $job_card_id = $material_card['job_card_id'];
		  $qry = "select * from job_work_order_items where published ='yes' and job_work_order_id = ".$job_card_id;
		  $job_card = $this->db->query($qry)->result_array();
		  foreach($job_card  as $job){
			  $process_products_array = array(
				'main_id'=>$process_main_id,
				'product_id'=>$job['id'],
				'quantity'=>$job['quantity'],
				'sales_rate'=>0,
				'mrp'=>0,
				'item_id'=>$job['item_id'],
				'godown_id'=>$material_card['godown'],
				'is_available'=>'yes'
			  );
			  $this->db->insert('production_process_products',$process_products_array);
			  $qry = "select * from material_card_items where published ='yes' and product_tbl_id = ".$job['id']." and material_card_id = ".$id;
			  $material_card_items = $this->db->query($qry)->result_array();
			  foreach($material_card_items as $card){
				  $material_table_array = array(
					'main_table_id'=>$process_main_id,
					'product_table_id'=>$job['id'],
					'godown_id'=>$card['godown_id'],
					'material_id'=>$card['item_id'],
					'material_quantity'=>$card['quantity'],
					'material_price'=>$card['rate'],
					'material_row_total'=>$card['material_total'],
					'is_available'=>'yes',
				  );
				  $this->db->insert('production_process_material_table',$material_table_array);
				 $this->stock_trans(0,$card['item_id'], $card['quantity'], $date, 'cr', 'man_journal', $process_main_id, 0, 0, 0,  $card['godown_id'], $process_voucher_no, 0);
				 $this->godown_stock_trans(0,$card['item_id'], $card['quantity'], 'cr', 'man_journal', $card['godown_id'], 0);
			 }
			$this->stock_trans(0,$job['item_id'], $job['quantity'], $date, 'dt', 'man_journal', $process_main_id, 0, 0, 0,  $material_card['godown'], $process_voucher_no, 0);
			$this->godown_stock_trans(0,$job['item_id'], $job['quantity'], 'dt', 'man_journal', $material_card['godown'], 0);
	      }
	 }
	  
			  
	  
	  function save(){
		  $type = $this->input->post('type');
		  $voucher_no = $this->getinvoice($type);
		  $id = $this->input->post('id');
		  $date = $this->getDate($this->input->post('date'));
		  $customer_id = $this->input->post('customer_id');
		  $job_card_id = $this->input->post('job_card_id');
		  //$qry = "update job_work_order set status = 'completed' where id = '".$job_card_id."'";
		  //$this->db->query($qry);
		  $qry = "select * from job_work_order where id = ".$job_card_id;
		  $query = $this->db->query($qry);
		  $job_card_voucher_no = '';
		  if($query->num_rows() > 0 ){
			  $query = $query->row_array();
			  $job_card_voucher_no = $query['voucher_no'];
			  if((float) $id > 0 ){
				  $material_qry = "select * from material_card where id = ".$id;
			      $material_query = $this->db->query($material_qry)->row_array();
				  $old_job_card_id = $material_query['job_card_id'];
				  $old_jobcard_qry = "select * from job_work_order where id = ".$old_job_card_id;
				  $old_jobcard = $this->db->query($old_jobcard_qry)->row_array();
				  if($old_jobcard['status'] == 'completed' ){
					  $job_card_type = 'in';
					  if($material_query['type'] == 'in'){
						  $job_card_type = 'out';
					   }
					   $qry = "update job_work_order set status = '". $job_card_type."' where id =".$old_jobcard['id'];
					   $this->db->query($qry);
				  }else{
					  $qry = "update job_work_order set status = 'created' where id =".$old_jobcard['id'];
					  $this->db->query($qry);
				  }
			   }
			   $qry = "select * from job_work_order where id = ".$job_card_id;
			   $query = $this->db->query($qry)->row_array();
			   if($query['status'] == 'created' ){
					$qry = "update job_work_order set status = '". $type."' where id =".$query['id'];
					$this->db->query($qry);
			   }else{
					  $qry = "update job_work_order set status = 'completed' where id =".$query['id'];
					  $this->db->query($qry);
			   }
		  }
		  $stock = $this->input->post('stock');
		  $eway_no = $this->input->post('eway_no');
		  $customer_id = $this->input->post('customer_id');
		  $eway_date = $this->getDate($this->input->post('eway_date'));
		  $ref_no = $this->input->post('ref_no');
		  $godown = $this->input->post('godown');
		  $material_id = $this->input->post('material_id',true);
		  $product_tbl_id = $this->input->post('product_tbl_id',true);
		  $material_quantity = $this->input->post('material_quantity',true);
		  $material_rate = $this->input->post('material_rate',true);
		  $material_godown = $this->input->post('material_godown',true);
		  $material_total = $this->input->post('material_total',true);
		  $total = $this->input->post('total');
		  $material_table_id = $this->input->post('material_table_id',true);
		  $data = array(
			'job_card_id'=>$job_card_id,
			'date'=> $date,
			'eway_no'=>$eway_no,
			'eway_date'=>$eway_date,
			'ref_no'=>$ref_no,
			'customer_id'=>$customer_id,
			'stock_status'=>$stock,
			'job_card_voucher_no'=>$job_card_voucher_no,
			'godown'=>$godown,
			'total'=>$total,
			'type'=>$type
		  );

		  if((float) $id  > 0 ){
			  $this->restore_material_stock($id,$stock);
			  $qry = "select * from material_card where id = ".$id;
			  $query = $this->db->query($qry)->row_array();
			  $voucher_no = $query['voucher_no'];
			  $this->db->where('id',$id);
			  $this->db->update('material_card',$data);
			  $insert_id = $id;
			  $qry = 'update material_card_items set published="no" where material_card_id ='.$insert_id;
			  $this->db->query($qry);
		  }else{
			$data['voucher_no'] = $voucher_no; 
			$this->db->insert('material_card',$data);
			$insert_id = $this->db->insert_id();
		  }
		  if($this->input->post('material_id',true)){
			  $length = sizeof($this->input->post('material_id',true));
			  for($i= 0;$i<$length;$i++){
					$data_material = array(
						'material_card_id'=>$insert_id,
						'item_id'=>$material_id[$i],
						'godown_id'=>$material_godown[$i],
						'quantity'=>$material_quantity[$i],
						'rate'=>$material_rate[$i],
						'material_total'=>$material_total[$i],
						'product_tbl_id'=>$product_tbl_id[$i],
						'published'=>'yes'
					);
					if((float) $material_table_id[$i] > 0 ){
						$this->db->where('id',$material_table_id[$i]);
						$this->db->update('material_card_items',$data_material);
					 }else{
						$this->db->insert('material_card_items',$data_material);
					}
					if($stock == 'our_stock'){
						if($type == 'out'){
							$this->stock_trans(0, $material_id[$i], $material_quantity[$i], $date, 'cr', 'mat_transfer', $insert_id, 0, 0, 0, $material_godown[$i],$voucher_no,'');
							$this->stock_trans(0, $material_id[$i], $material_quantity[$i], $date, 'dt', 'mat_transfer', $insert_id, 0, 0, 0, $godown,$voucher_no,'');
							$this->godown_stock_trans(0, $material_id[$i], $material_quantity[$i], 'cr', 'item', $material_godown[$i],'');
							$this->godown_stock_trans(0, $material_id[$i], $material_quantity[$i], 'dt', 'item', $godown,'');			  
						}
					}
			  }
			  if($stock == 'our_stock' && $type == 'in'){
				  $this->add_journal($insert_id);
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
