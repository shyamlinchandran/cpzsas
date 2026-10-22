<?php

class Common_model extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($table, $data){
       // Inserting into your table
        $this->db->insert($table, $data);
        return true;
    }
	
	public function getuserbyid($table, $wherevar, $id){
        $this->db->select('a.*,DATE_FORMAT(usr_created_at, "%d %M %Y" ) as created,CASE WHEN order_date IS NOT NULL THEN DATE_FORMAT(order_date, "%d %M %Y"  ) ELSE "" END as updated');
		$this->db->join('(select * from orders where order_type = "sales" and customer_id = "'.$id.'"  order by order_id desc limit 0,1) as x','x.customer_id = usr_uuid','LEFT');
        $this->db->from($table);
        $this->db->where($wherevar, $id);
        $query = $this->db->get();
        return $query->row();
    
	}
	
	public function myorders($uuid){
		$this->db->where('o.customer_id', $uuid);
		$this->db->where('order_is_active', '1');
		$this->db->where('order_type', 'sales');
        $this->db->order_by('o.order_id', 'desc');
		$this->db->select('o.*,order_item_status,product_quantity,u.usr_name,DATE_FORMAT(order_date, "%d/%m/%Y" ) as order_date,p.product_name,product_total,DATE_FORMAT(date_of_fullfilment, "%d %M %Y" ) as fullfill_date,order_item_status');
		$this->db->join('usr_users as u ','u.usr_uuid = o.customer_id','INNER');
		$this->db->join('order_items as oi ','oi.order_id = o.order_id and oi.is_active = "1" ','INNER');
		$this->db->join('pd_products as p ','p.product_uuid = oi.product_id  ','INNER');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		$product = $query->result();
		return $product;
	}
	
	function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,

			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	 
    public function delete($table, $id, $primaryid){
        $this->db->where($primaryid, $id);
        $this->db->delete($table);
        return true;
    }
	
	public function get_session_cart($session_id,$order_type){
		$this->db->where('o.session_id',$session_id);
		$this->db->where('o.order_is_active',1);
		$this->db->where('o.order_type',$order_type);
		$this->db->select('oi.*,o.session_id');
		$this->db->join('order_items as oi ','oi.order_id = o.order_id  and oi.is_active = "1" ' , 'INNER');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		return $query;
	}
	
	public function update_session_cart($session_id){
		$uuid = $this->session->userdata('uuid');
		$this->db->where('o.session_id',$session_id);
		$this->db->where('o.order_is_active',1);
		$this->db->where('o.order_type','cart');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		if($query->num_rows() > 0  ){
			$res = $query->row();
			$session_order_id = $res->order_id;
			if(isset($uuid) ){
				$order_details = $this->get_order_id($uuid,'cart','');
				$order_id = $order_details[0]->order_id;
				$this->db->where('o.session_id',$session_id);
			}
		}
	}
	
	public function get_order_customization($uuid){
		$qry ="SELECT sf.feature_uuid,sf.feature_name,sf.feature_category,e.*,b.order_item_uuid FROM `orders` as a INNER JOIN order_items as b on a.order_id = b.order_id and b.is_active = 1 INNER JOIN order_customization as c on c.oc_id = b.customization_id INNER join customization as d on d.customization_product_uuid = b.product_id and d.customization_isactive = 1 INNER JOIN customization_features as e on e.custome_uuid=d.customization_uuid and (e.custome_feature_id = c.oc_feature_neck or e.custome_feature_id = c.oc_feature_sleev or custome_feature_id = c.oc_feature_length) inner join sm_features as sf on sf.feature_uuid = e.custome_feature_id where custome_isactive = 1 and order_uuid ='".$uuid."'";
		return $this->db->query($qry)->result_array();
	}
	
	public function getsalesorder($customer_uuid,$customer_address,$order_uuid,$order_type ='cart'){
		$this->db->where('o.order_type',$order_type);
		$this->db->where('o.customer_id',$customer_uuid);
		$this->db->where('o.order_is_active','1');
		$this->db->where('o.order_uuid',$order_uuid);
		$this->db->join('order_items as oi ','oi.order_id = o.order_id and order_type = "cart" and oi.is_active = "1" ' , 'INNER');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		return $query;
	}
	
	function get_order_details($user_uuid,$order_type){
		$this->db->where('order_type',$order_type);
		if(isset($user_uuid) ){
			$this->db->where('customer_id',$user_uuid);
		}else{
			if(!isset($_SESSION['guest']) ){
				$session_id = session_id();
				$_SESSION['guest']=$session_id;
			}else{
				$session_id = $_SESSION['guest'] ;
			}
			$this->db->where('session_id',$session_id);
		}
		$this->db->where('o.order_is_active','1');
		$this->db->select('concat(hit_feet," Feet (",hit_centimeter," cm )") as hit_name,IFNULL(oc.customization_image,"") as customization_img ,oi.*,p.product_name,o.order_total,o.order_discount,o.order_uuid,order_type,p.product_code,pi.product_image_name');
		$this->db->join('order_items as oi ','oi.order_id = o.order_id and order_type = "'.$order_type.'" and oi.is_active = "1" ' , 'INNER');
		$this->db->join('order_customization as oc ','oc.oc_id = oi.customization_id  ','LEFT');
		$this->db->join('sm_height as sh ','sh.hit_uuid = oi.product_height  ','LEFT');
		$this->db->join('pd_products as p ','p.product_uuid = oi.product_id','INNER');
		$this->db->join('pd_product_image as pi ','pi.product_image_pid = p.product_id and product_image_main = "1"  ' , 'INNER');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		$product = $query->result();
		return $product;
	}
	
	public function getCartByID($order_uuid){
		$this->db->where('o.order_uuid',$order_uuid);
		$this->db->where('o.order_is_active','1');
		$this->db->where('o.order_type','cart');
		$this->db->join('(SELECT sum(product_quantity) as product_quantity,sum(product_total) as cart_amount,order_id as oid FROM `order_items` as oi  WHERE oi.is_active = "1" GROUP by oi.order_id) as items','items.oid = order_id','INNER');
		$this->db->select('o.*,DATE_FORMAT(order_date, "%d %M %Y" ) as date,product_quantity,cart_amount');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		$product = $query->result();
		return $product;
	}
	public function getallorder($uuid){
		$this->db->order_by('o.order_id','desc');
		$this->db->where('o.customer_id',$uuid);
		$this->db->where('o.order_is_active','1');
		$this->db->where('o.order_type !=','wishlist');
		$this->db->join('usr_address as ua','o.customer_address = ua.usr_add_id','LEFT');
		$this->db->join('(SELECT sum(product_quantity) as product_quantity,sum(product_total) as cart_amount,order_id as oid FROM `order_items` as oi  WHERE oi.is_active = "1" GROUP by oi.order_id) as items','items.oid = order_id','INNER');
		$this->db->select('o.*,ua.*,DATE_FORMAT(order_date, "%d %M %Y" ) as date,product_quantity,cart_amount');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		$product = $query->result();
		return $product;
	}
	
	public function get_order_details_byid($order_uuid){
		$this->db->where('o.order_uuid',$order_uuid);
		$this->db->select('oi.*,p.product_name,o.order_total,o.order_discount,o.order_uuid,order_type,p.product_code');
		$this->db->join('order_items as oi ','oi.order_id = o.order_id  and oi.is_active = "1" ' , 'INNER');
		$this->db->join('pd_products as p ','p.product_uuid = oi.product_id','INNER');
		$this->db->from('orders as o ');
		$query = $this->db->get();
		$product = $query->result();
		return $product;
	}
	
	public function get_customer_address($uuid){
		if(isset($uuid) ){
			$this->db->where('usr_add_usr',$uuid);
		}else{
			if(!isset($_SESSION['guest']) ){
				$session_id = session_id();
				$_SESSION['guest']=$session_id;
			}else{
				$session_id = $_SESSION['guest'] ;
			}
			$this->db->where('usr_add_usr',$session_id);
		}
		$this->db->where('usr_add_isactive','1');
		$this->db->from('usr_address');
		$query = $this->db->get();
		$customer_address = $query->result();
		return $customer_address;
	}
	
	public function reset_session_cart($guest,$user_uuid){
		$update_data = array(
			'order_is_active'=>0
		);
		$this->db->where('session_id',$guest);
		$this->db->update('orders',$update_data);
		
		$update_data = array(
			'cus_siz_customer'=>$user_uuid
		);
		$this->db->where('cus_siz_session_id',$guest);
		$this->db->update('customer_sizes',$update_data);
	}
	
	public function update_order($uuid,$order_type){
		$this->db->where('order_type',$order_type);
		if(isset($uuid) ){
			$this->db->where('customer_id',$uuid);
		}else{
			if(!isset($_SESSION['guest']) ){
				$session_id = session_id();
				$_SESSION['guest']=$session_id;
			}else{
				$session_id = $_SESSION['guest'] ;
			}
			$this->db->where('session_id',$session_id);
		}
		$this->db->where('order_is_active','1');
		$this->db->from('orders');
		$query = $this->db->get();
		$order_id = 0 ;
		if($query->num_rows() > 0  ){
			$order = $query->result();
			$order_id = $order[0]->order_id;
			$this->db->where('order_id',$order_id);
			$this->db->where('is_active','1');
			$this->db->from('order_items');
			$this->db->select('sum(product_quantity*product_mrp) as total_mrp,sum(product_total) as total');
			$query = $this->db->get();
			$product = $query->result();
			$data = array(
				'order_total'=>$product[0]->total,
				'order_discount'=>$product[0]->total_mrp - $product[0]->total,
			);
			$this->db->where('order_id',$order_id);
			$this->db->update('orders',$data);
		}
		return $this->get_order_details($uuid,$order_type);
	}
	
	public function update_order_items($uuid,$order_item_uuid,$product_quantity,$order_item_status){
		if($order_item_status == 'update'){
			$this->db->where('order_item_uuid', $order_item_uuid);
			$this->db->where('is_active', '1');
			$this->db->from('order_items');
			$query = $this->db->get();
			if($query->num_rows() < 1 ){
			
			}else{
				$cart_item = $query->result();
				$product_price = $cart_item[0]->product_price;
				$product_total = (float) $product_quantity * (float) $cart_item[0]->product_price;
				$data = array(
					'product_quantity'=>$product_quantity,
					'product_total'=>$product_total
				);
				$this->db->where('order_item_uuid', $order_item_uuid);
				$this->db->update('order_items',$data);
			}
		}else{
				$data = array(
					'is_active'=>'0'
				);
				$this->db->where('order_item_uuid', $order_item_uuid);
				$this->db->update('order_items',$data);
		}
	}
	
	
	public function get_product_size_id($user_uuid,$product_uuid,$session_id){
		if(isset($user_uuid) ){
			
		}else{
			$user_uuid = '';
		}
		$product_size_id = 0 ;
		if($this->input->post('standard_size') ){
			$standard_size = $this->input->post('standard_size');
			$standard_size = explode("_",$standard_size);
			if(isset($user_uuid) ){
				$this->db->where('cus_siz_customer',$user_uuid);
			}else{
				$this->db->where('cus_siz_session_id',$session_id);
			}
			$this->db->where('cus_siz_product',$product_uuid);
			$this->db->where('siz_det_size_id',$standard_size[0]);
			$this->db->where('siz_det_value',$standard_size[1]);
			$this->db->join('customer_sizes_details  as b', 'a.cus_siz_id = b.cus_siz_id', 'INNER');
			$this->db->from('customer_sizes as a ');
			$query = $this->db->get();
			if($query->num_rows() < 1 ){
				$data = array(
					'cus_siz_type'=>'standard',
					'cus_siz_customer'=>$user_uuid,
					'cus_siz_product'=>$product_uuid,
					'cus_siz_session_id'=>$session_id,
					'cus_siz_isactive'=>'1'
				);
				$this->db->insert('customer_sizes',$data);
				$product_size_id = $this->db->insert_id();
				$data = array(
					'cus_siz_id'=>$product_size_id,
					'siz_det_size_id'=>$standard_size[0],
					'siz_det_value'=>$standard_size[1]
				);
				$this->db->insert('customer_sizes_details',$data);
			}else{
				$query  = $query->result();
				$product_size_id = $query[0]->cus_siz_id;
			}
		}
		
		if($this->input->post('csz_uuid',true)){
			$length = sizeof($this->input->post('csz_uuid',true));
			$csz_uuid = $this->input->post('csz_uuid',true);
			$csz_value = $this->input->post('csz_value',true);
			$is_create = 1;
			for($i = 0;$i<$length;$i++){
				$this->db->where('cus_siz_customer',$user_uuid);
				$this->db->where('cus_siz_product',$product_uuid);
				$this->db->where('siz_det_custome_size_id',$csz_uuid[$i]);
				$this->db->where('siz_det_value',$csz_value[$i]);
				$this->db->join('customer_sizes_details  as b', 'a.cus_siz_id = b.cus_siz_id', 'INNER');
				$this->db->from('customer_sizes as a ');
				$query = $this->db->get();
				if($query->num_rows() < 1 ){
					$is_create = 0;
				}
			}
			if((float) $is_create  == 0 ){
				$data = array(
					'cus_siz_type'=>'custome',
					'cus_siz_customer'=>$user_uuid,
					'cus_siz_product'=>$product_uuid,
					'cus_siz_isactive'=>'1'
				);
				$this->db->insert('customer_sizes',$data);
				$product_size_id = $this->db->insert_id();
				for($i = 0;$i<$length;$i++){
					$data = array(
						'cus_siz_id'=>$product_size_id,
						'siz_det_custome_size_id'=>$csz_uuid[$i],
						'siz_det_value'=>$csz_value[$i]
					);
					$this->db->insert('customer_sizes_details',$data);
				}
				
			}else{
				$query  = $query->result();
				$product_size_id = $query[0]->cus_siz_id;
			}
		}
		return $product_size_id;
	}
	public function getcartcustomization(){
			$order_item_uuid = $this->input->post('order_item_uuid');
			$order_id = $this->input->post('order_id');
			//$qry = "SELECT REPLACE(group_concat(CASE WHEN cus_siz_type = 'custome' then scs.csz_name else ss.siz_name end , ' : ' , siz_det_value ),',',' | ') as size,cus_siz_type FROM order_items as oi inner join `customer_sizes` as cs on cs.cus_siz_id = oi.product_size and oi.is_active ='1' INNER JOIN customer_sizes_details as csd on cs.cus_siz_id = csd.cus_siz_id LEFT JOIN sm_sizes as ss on ss.siz_uuid = csd.siz_det_size_id LEFT JOIN sm_custom_size as scs on scs.csz_uuid = csd.siz_det_custome_size_id where oi.order_item_uuid ='".$order_item_uuid."' GROUP by cs.cus_siz_id";
			$this->db->select("order_item_uuid,REPLACE(group_concat(CASE WHEN cus_siz_type = 'custome' then scs.csz_name else ss.siz_name end , ' : ' , siz_det_value ),',',' | ') as size,cus_siz_type");
			$this->db->join('`customer_sizes` as cs  ', 'cs.cus_siz_id = oi.product_size and oi.is_active ="1"', 'INNER');
			$this->db->join('customer_sizes_details as csd    ', 'cs.cus_siz_id = csd.cus_siz_id', 'INNER');
			$this->db->join('sm_sizes as ss   ', 'ss.siz_uuid = csd.siz_det_size_id ', 'LEFT');
			$this->db->join('sm_custom_size as scs   ', 'scs.csz_uuid = csd.siz_det_custome_size_id ', 'LEFT');
			$this->db->where('order_id', $order_id);
			$this->db->where('oi.is_active', 1);
			$this->db->group_by('order_item_uuid');
			$this->db->from('order_items as oi');
			$query = $this->db->get();
			return $query->result();
	}
	
	public function get_customization_id($product_uuid){
		$customization_id =  0 ;
		$neck_feature_id = '';
		$sleeves_feature_id = '';
		$length_feature_id = '';
		if($this->input->post('neck_feature_id')){
			$neck_feature_id = $this->input->post('neck_feature_id');
		}
		if($this->input->post('sleeves_feature_id')){
			$sleeves_feature_id = $this->input->post('sleeves_feature_id');
		}
		if($this->input->post('length_feature_id')){
			$length_feature_id = $this->input->post('length_feature_id');
		}
		$customization_image = $this->input->post('customization_image');
		if($length_feature_id != '' || $sleeves_feature_id != '' || $neck_feature_id != ''){
			$this->db->where('customization_image',$customization_image);
			$this->db->where('oc_feature_neck',$neck_feature_id);
			$this->db->where('oc_feature_sleev',$sleeves_feature_id);
			$this->db->where('oc_feature_length',$length_feature_id);
			$this->db->from('order_customization');
			$query = $this->db->get();
			if($query->num_rows() < 1 ){
				$data = array(
					'customization_image'=>$customization_image,
					'oc_feature_neck'=>$neck_feature_id,
					'oc_feature_sleev'=>$sleeves_feature_id,
					'oc_feature_length'=>$length_feature_id
				);
				$this->db->insert('order_customization',$data);
				$customization_id = $this->db->insert_id();
			}else{
				$query = $query->result();
				$customization_id = $query[0]->oc_id;
			}
		}
		return $customization_id ;
	}
	public function save_order_items($data){
				
			$this->db->where('is_active', '1');
			$this->db->where('order_id', $data['order_id']);
			$this->db->where('product_id', $data['product_id']);
			$this->db->where('product_size', $data['product_size']);
			$this->db->where('product_height',$data['product_height']);
			$this->db->where('product_custome_size',$data['product_custome_size']);
			$this->db->where('customization_id',$data['customization_id']);
			$this->db->from('order_items');
			$query = $this->db->get();
			$insert_id = 0 ;
			if($query->num_rows() < 1 ){
				$this->db->select('*');
				$this->db->where('product_uuid',$data['product_id']);
				$this->db->from('pd_products');
				$query = $this->db->get();
				$product = $query->result();
				$data['product_mrp'] = $product[0]->product_price;
				$data['product_price'] = $product[0]->product_discounted_price;
				$data['product_total'] = (float) $data['product_quantity'] * (float) $product[0]->product_discounted_price;
				$data['order_item_uuid'] = $this->gen_uuid(); 
				$this->db->insert('order_items',$data);
				$insert_id = $this->db->insert_id();
				}else{
					$this->db->where('order_id', $data['order_id']);
					$this->db->where('product_id', $data['product_id']);
					$this->db->where('product_size', $data['product_size']);
					$this->db->update('order_items',$data);
				}
				return $insert_id;
	}
	
	public function get_order_id($user_uuid,$order_type,$session_id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_is_active', '1');
		$this->db->where('order_type', $order_type);
		if(isset($user_uuid) ){
			$this->db->where('customer_id', $user_uuid);
		}else{
			$this->db->where('session_id', $session_id);
			$user_uuid = '';
		}
		$query = $this->db->get();
		if($query->num_rows() < 1 ){
			$order_number = uniqid(); 
			$data = array(
				'customer_id'=>$user_uuid,
				'session_id'=>$session_id,
				'order_type'=>$order_type,
				'order_date'=>date('Y-m-d'),
				'order_number'=>$order_number
			);
			$data['order_uuid'] = $this->gen_uuid(); 
			$this->db->insert('orders',$data);
			$insert_id = $this->db->insert_id();
			$this->db->select('*');
			$this->db->from('orders');
			$this->db->where('order_type', $order_type);
			if($user_uuid != ''){
				$this->db->where('customer_id', $user_uuid);
			}else{
				$this->db->where('session_id', $session_id);
			}
			$this->db->where('order_is_active', '1');
			$query = $this->db->get();
		}
		
		return $query->result();
	}
	
    function getallactive($table, $actvar, $orderby, $ascdes){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($actvar, 1);
        $this->db->order_by($orderby, $ascdes);
        $query = $this->db->get();
        return $query->result();
    }
	
    function getallactivelimit($table, $actvar, $orderby, $ascdes,$num,$len){
        $take  =  $num *$len;
        $offset = ( $num -1) *$len;
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($actvar, 1);
        $this->db->order_by($orderby, $ascdes);
        $this->db->limit($take, $offset);
        $query = $this->db->get();
        //echo  $this->db->last_query();
        return $query->result();
    } 
    function getparentnavs($table, $actvar, $orderby, $ascdes){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($actvar, 1);
        $this->db->where('navParent', 0);
        $this->db->order_by($orderby, $ascdes);
        $query = $this->db->get();
        return $query->result();
    }
	
    function getall($table, $orderby, $ascdes){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($orderby, $ascdes);
        $query = $this->db->get();
        return $query->result();
    }
	
    function getallinactive($table, $actvar, $orderby, $ascdes){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($actvar, 0);
        $this->db->order_by($orderby, $ascdes);
        $query = $this->db->get();
        return $query->result();
    }
	
	function product_size($id,$type='standard'){
		$this->db->select('b.*,ss.*,cs.*');
		$this->db->where('a.product_uuid',$id);
        $this->db->from('pd_products as a');
		$this->db->join(' pd_product_size_groups  as b', 'a.product_id = b.pd_size_group_product_id and b.pd_size_group_isactive = 1', 'INNER');
		$this->db->join(' sm_sizes as ss', 'ss.siz_id = b.pd_size_group_size_id and b.pd_size_group_type = "standard"', 'LEFT');
		$this->db->join(' sm_custom_size as cs ', 'cs.csz_id = b.pd_size_group_size_id and b.pd_size_group_type != "standard"', 'LEFT');
		if($type == 'standard'){
			$this->db->order_by('siz_order', 'asc');
		}else{
			$this->db->order_by('csz_order', 'asc');
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
    public function checklogin($u, $p){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('userName', $u);
		$this->db->where('userPassword', $p);
		$this->db->where('userActive', 1);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
    }
	
	function getallfeatures($table, $actvar,$orderby, $ascdes,$product_uuid){
		
		$this->db->select('feature_category,a.customization_image,b.*,d.feature_name,d.feature_icon,feature_icon as   image4,feature_icon as   image2');
		$this->db->join('customization_features as b', 'a.customization_uuid = b.custome_uuid  and custome_isactive =  1 ', 'INNER');
        $this->db->join('sm_features as d', 'd.feature_uuid = b.custome_feature_id', 'INNER');
        $this->db->join('pd_products as p', 'p.product_uuid = customization_product_uuid', 'INNER');
        $this->db->join('pd_product_customizations as pc', 'pc.pd_custome_product_id = p.product_id and pc.pd_custome_isactive = 1  and pc.pd_feature_uuid = b.custome_feature_id', 'INNER');
		$this->db->from('customization as a');
        $this->db->where($actvar, 1);
        $this->db->where('custome_isactive', 1);
        $this->db->where('customization_isactive', 1);
        //$this->db->where('feature_category', $feature_category);
        $this->db->where('customization_product_uuid', $product_uuid);
        $this->db->order_by($orderby, $ascdes);
        $query = $this->db->get();
        return $query->result_array();
	}
	
	function getmysizes($uuid){
		$qry = "SELECT cus_siz_type,GROUP_CONCAT(CASE WHEN a.cus_siz_type = 'custome' then csz_name else c.siz_name end , ' : ',b.siz_det_value , '  ' ) as size FROM `customer_sizes` as a INNER JOIN customer_sizes_details as b on a.cus_siz_id = b.cus_siz_id left join sm_sizes as c on c.siz_uuid = b.siz_det_size_id and a.cus_siz_type = 'standard' left JOIN sm_custom_size as d on d.csz_uuid = b.siz_det_custome_size_id and a.cus_siz_type ='custome' GROUP BY a.cus_siz_id order by a.cus_siz_id desc";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}
	
    function getbyid($table, $wherevar, $id,$sec_wherevar = '',$sec_id = ''){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($wherevar, $id);
		if($sec_wherevar != ''){
			$this->db->where($sec_wherevar, $sec_id);
		}
        $query = $this->db->get();
        return $query->row();
    }
	
	
    function getbyidlist($table, $wherevar, $id,$orderby = '' ,$ascdes ='' ){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($wherevar, $id);
		if($orderby != ''){
			$this->db->order_by($orderby, $ascdes);
		}
        $query = $this->db->get();
        return $query->result();
    }
	function get_product_images($id){
		 $this->db->select('*');
         $this->db->from('pd_product_image');
        $this->db->where('product_image_pid', $id);
        $query = $this->db->get();
        return $query->result();
	}
	function getproductByID($id){
		 $this->db->select('*');
         $this->db->from('pd_products');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        return $query->result();
		
	}

    function findbyonewhere($table, $wherevar, $value){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($wherevar, $value);
        $query = $this->db->get();
        return $query->result();
    }

    public function Existdata($where,$cond,$table)
	{
		$this->db->select('count(*) as num');
		$this->db->from($table);
		$this->db->where($where, $cond);
		$query = $this->db->get();
		return $query->row();
	}

    public function savebasicsData($table,$data)
	{
		if ($this->db->insert($table,$data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

    public function updatedata($inid,$table,$data,$primary){
		$this->db->where($primary, $inid);
		$this->db->update($table, $data);
		//echo $this->db->last_query();
		//die();
		return true;
	}

    public function saveotherData($table, $data){
		if ($this->db->insert($table, $data)) {
			return true;
			
		}
	}
    public function deleteData($inid,$table,$primary){
		$this->db->where($primary, $inid);
		$this->db->delete($table);
		//echo $this->db->last_query();
		//die();
		return true;
	}
    public function findnavid($page){
        $this->db->select('*');
        $this->db->from('navbar');
        $this->db->where('navHref', $page);
        $query = $this->db->get();
        return $query->row();
    }
    
    function getactivesubnavs($parent){
        $this->db->select('*');
        $this->db->from('navbar');
        $this->db->where('navActive', 1);
        $this->db->where('navParent', $parent);
        $this->db->order_by('navOrder', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function getallmodeswithname($table, $orderby, $ascdes){
        $this->db->select('*');
        $this->db->select('users.usersName as usersName');
        $this->db->from($table);
        $this->db->order_by($orderby, $ascdes);
        $this->db->join('users', 'modes.managerId = users.userId', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    function useradminusers(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userLevel', 3);
        $this->db->where('userActive', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function query($qry) {
        $query = $this->db->query($qry);
        return $query->result();
    }
     
}
?>