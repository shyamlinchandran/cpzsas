<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once('dataTable.php');

class Jobcard_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	function jobcard(){
		$this->select = " DATE_FORMAT(date, '%d/%m/%Y' ) voucher_date,DATE_FORMAT(due_date, '%d/%m/%Y' ) voucher_due_date,b.name,a.*";
        $this->table = "`job_work_order` as a left join suppliers as b on a.customer = b.id";
        $this->column_order = array(null, 'a.voucher_no','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.voucher_no','b.name', null); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
		$this->wherecondition = ' where a.type = "'.$this->input->post('type').'"  and a.published = "yes" ';
	}
	
	function get_jobcard($id){
		$qry ="select a.*,b.name,b.address_line1,b.tin from job_work_order as a left join suppliers as b on b.id = a.customer where  a.id ='".$id."' order by a.id desc limit 0,1";
		$query = $this->db->query($qry)->result_array();
		return $query;
	}
	
	function getjobcardItemscnt($id){
		$qry = "SELECT a.*,c.name as product,d.name as rawmaterial from job_work_order_items as a INNER JOIN job_work_order_raw_material as b on a.id = b.job_work_order_item_id and a.published ='yes' and b.published ='yes' INNER JOIN item as c on c.id = a.item_id  INNER JOIN item as d on d.id = b.material_id where a.job_work_order_id = ".$id;
		$query = $this->db->query($qry);
		return $query->num_rows();
	}
	
	function getjobcardItems($id, $len, $size){
		$qry = "SELECT u.name as unit,b.*,c.name as product,d.name as rawmaterial from job_work_order_items as a INNER JOIN job_work_order_raw_material as b on a.id = b.job_work_order_item_id and a.published ='yes' and b.published ='yes' INNER JOIN item as c on c.id = a.item_id  INNER JOIN item as d on d.id = b.material_id inner join units as u on u.id = d.unit_id where a.job_work_order_id = ".$id." limit $len,$size";
		$query = $this->db->query($qry)->result_array();
		return $query;
	}
	
	
	public function getinvoice($type){
		$qry ="select * from job_work_order where published ='yes' and type ='".$type."' order by id desc limit 0,1";
		$query = $this->db->query($qry);
		$preffix = 'JCI';
		if($type == 'out'){
			$preffix = 'JCO';
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
	
	function getjobcard_items_material($id){
		$qry ="SELECT a.*,i.name,b.godown_name FROM `job_work_order_raw_material` as a INNER JOIN item as i on i.id = a.material_id and a.published='yes' INNER join ims_godown as b on b.id = a.godown_id where job_work_order_item_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	function getjobcard_items($id){
		$qry = "SELECT a.*,b.godown_name,i.name FROM `job_work_order_items` as a INNER JOIN ims_godown as b on a.godown = b.id and a.published='yes' INNER JOIN item as i on i.id = a.item_id where job_work_order_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	function getjobcard($id){
		$qry = "SELECT  DATE_FORMAT(due_date, '%d/%m/%Y' ) voucher_due_date,DATE_FORMAT(date, '%d/%m/%Y' ) voucher_date,s.id as customer_id,s.name as customer_name,a.* FROM `job_work_order` as a left join suppliers as s on a.customer = s.id where a.id=".$id;
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
	  
	  function save(){
		  $type = $this->input->post('type');
		  $voucher_no = $this->getinvoice($type);
		  $id = $this->input->post('id');
		  $date = $this->getDate($this->input->post('date'));
		  $due_date = $this->getDate($this->input->post('due_date'));
		  $customer_id = $this->input->post('customer_id');
		  $branch = $this->input->post('branch');
		  $reference = $this->input->post('reference');
		  $despatch = $this->input->post('despatch');
		  $location = $this->input->post('location');
		  $vehicle = $this->input->post('vehicle');
		  $godown = $this->input->post('godown');	  
		  $data = array(
			'date'=>$date,
			'customer'=>$customer_id,
			'due_date'=>$due_date,
			'branch_id'=>$branch,
			'ref_no'=>$reference,
			'despatch_through'=>$despatch,
			'location'=>$location,
			'vehicle_no'=>$vehicle,
			'to_godown'=>$godown,
			'type'=>$type
		  );
		  if((float)  $id < 1 ){
			  $data['voucher_no'] = $voucher_no;
			  $this->db->insert('job_work_order',$data);
			  $insert_id = $this->db->insert_id();
		  }else{
		      $this->db->where('id',$id);
			  $this->db->update('job_work_order',$data);
			  $insert_id = $id;
			  $qry = 'update job_work_order_items set published="no" where job_work_order_id ='.$insert_id;
			  $this->db->query($qry);
			  $qry = 'update job_work_order_raw_material set published="no" where job_work_order_id ='.$insert_id;
			  $this->db->query($qry);
		  }
		  $product_index = $this->input->post('product_index',true);
		  $product_id = $this->input->post('product_id',true);
		  $products_table_id = $this->input->post('products_table_id',true);
		  $item_ids = $this->input->post('item_ids',true);
		  $products_godown_id = $this->input->post('products_godown_id',true);
		  $quantity = $this->input->post('quantity',true);
		  $length = sizeof($product_index);
		  for($i = 0;$i<$length;$i++){
			  $product_data = array(
				'job_work_order_id'=>$insert_id,
				'item_id'=>$item_ids[$i],
				'godown'=>$products_godown_id[$i],
				'quantity'=>$quantity[$i],
				'published'=>'yes'
			  );
			  if((float) $products_table_id[$i] > 0 ){
				  $this->db->where('id',$products_table_id[$i]);
				  $this->db->update('job_work_order_items',$product_data);
				  $product_insert_id = $products_table_id[$i];
			  }else{
				$this->db->insert('job_work_order_items',$product_data);
				$product_insert_id = $this->db->insert_id();
			  }
			  if($this->input->post('material_id'.$product_index[$i],true) ){
				  $material_array = $this->input->post('material_id'.$product_index[$i],true);
				  $material_table_id = $this->input->post('material_table_id'.$product_index[$i],true);
				  $material_godown = $this->input->post('material_godown'.$product_index[$i],true);
				  $material_quantity = $this->input->post('material_quantity'.$product_index[$i],true);
				  $material_price = $this->input->post('material_price'.$product_index[$i],true);
				  $material_row_total = $this->input->post('material_row_total'.$product_index[$i],true);
				  $length_material = sizeof($material_array);
				  for($j=0;$j<$length_material;$j++){
					  $material_data = array(
						'job_work_order_id'=>$insert_id,
						'job_work_order_item_id'=>$product_insert_id,
						'material_id'=>$material_array[$j],
						'godown_id'=>$material_godown[$j],
						'quantity'=>$material_quantity[$j],
						'rate'=>$material_price[$j],
						'published'=>'yes'
					  );
					  if((float) $material_table_id[$j] > 0 ){
						$this->db->where('id',$material_table_id[$j]);
						$this->db->update('job_work_order_raw_material',$material_data);
					 }else{
						$this->db->insert('job_work_order_raw_material',$material_data);
					}
				  }
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
