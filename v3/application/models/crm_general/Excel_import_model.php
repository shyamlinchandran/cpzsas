<?php

class Excel_import_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        
    }

	 function gettablefields($table_name)
    {
        $dropdownvalue = "";
        if ($table_name == 'lead') {
            $dropdownvalue = '<option value="0">Select</option><option value="date">Date Y-m-d</option><option value="companyName">Name</option><option value="adress">Address</option><option value="gst">GSTIN</option><option value="contactPerson">Contact Person</option>  <option value="contactNumber">Contact Number</option>     <option value="email">Email</option>    <option value="source">Sourse of Enquiry</option><option value="area">Area</option><option value="unbuss">Nature of Bussiness</option><option value="remarks">Remarks</option>';
        }
        if ($table_name == 'enquiry') {
            $dropdownvalue = '<option value="0">Select</option><option value="date">Date Y-m-d</option><option value="companyName">Name</option><option value="adress">Address</option><option value="type">Type Of Enquiry</option><option value="product_id">Goods/Service/Course</option><option value="quantity">Quantity</option><option value="price">Price</option><option value="gst">GSTIN</option><option value="contactPerson">Contact Person</option>  <option value="contactNumber">Contact Number</option>     <option value="email">Email</option>          <option value="source">Sourse of Enquiry</option><option value="area">Area</option><option value="unbuss">Nature of Bussiness</option><option value="remarks">Remarks</option>';
        }

        return $dropdownvalue;

    }

   

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */
	public function savefromexcel()
    {
		$rowtotal = $this->input->post('counttotal');
        $columntotal = $this->input->post('countcol');
        $table_name = $this->input->post('table_name');
		for ($i = 2; $i <= $rowtotal; $i++) {
			$data = array();
			$leadname = '';
			$product_id = '';
			$quantity = '';
			$price = '';
			$type_of_enquiry = '' ;
			for ($j = 1; $j <= $columntotal; $j++) {
				$field = $this->input->post('colselect_' . $j);
				$field_value = $this->input->post('txt_' . $j . '_' . $i);
				if($field != ''  ){
				
					if($field == 'sourse'){
						if($field_value != ''){
							$qry = 'select * from source_enquiry where source_of_enquiry ="'.$field_value.'" limit 0,1';
							$query = $this->db->query($qry);
							if($query->num_rows() > 0  ){
								$query = $query->row_array();
								$data[$field] = $query['id'];
							}else{
								$data_sourse = array(
									'source_of_enquiry'=>$field_value
								);
								$this->db->insert('source_enquiry',$data_sourse);
								$data[$field] = $this->db->insert_id();
							}
						}
					}else if($field == 'area'){
						if($field_value != ''){
							$qry = 'select * from ims_area where area ="'.$field_value.'" limit 0,1';
							$query = $this->db->query($qry);
							if($query->num_rows() > 0  ){
								$query = $query->row_array();
								$data[$field] = $query['id'];
							}else{
								$data_area = array(
									'area'=>$field_value
								);
								$this->db->insert('ims_area',$data_area);
								$data[$field] = $this->db->insert_id();
							}
						}
					}else if($field == 'unbuss'){
						if($field_value != ''){
							$qry = 'select * from bussiness_other where type ="'.$field_value.'" limit 0,1';
							$query = $this->db->query($qry);
							if($query->num_rows() > 0  ){
								$query = $query->row_array();
								$data[$field] = $query['id'];
							}else{
								$data_unbuss = array(
									'type'=>$field_value
								);
								$this->db->insert('bussiness_other',$data_unbuss);
								$data[$field] = $this->db->insert_id();
							}
						}
					}else if($field == 'type'){
						if($field_value != ''){
							$type_of_enquiry = $field_value;
							$qry = 'select * from item_type where name ="'.$field_value.'" limit 0,1';
							$query = $this->db->query($qry);
							if($query->num_rows() > 0  ){
								$query = $query->row_array();
								$data[$field] = $query['id'];
							}else{
								$data_type = array(
									'name'=>$field_value
								);
								$this->db->insert('item_type',$data_type);
								$data[$field] = $this->db->insert_id();
							}
						}
					}else if($field == 'lead'){
						if($field_value != ''){
							if(!isset($data['companyName']) ){
								$data['companyName'] = $field_value;
							}
							$leadname = $field_value;
						}
					}else if($field == 'product_id' || $field == 'quantity' || $field == 'price'){
						if($field == 'product_id'){
							$product_id = $field_value;
						}else if($field == 'quantity'){
							$quantity = $field_value;
						}else if($field == 'price'){
							$price = $field_value;
						}
					
					}else{
						if($field_value != ''){
							$data[$field] = $field_value;
						}
					}
					
					
					
					
					
				}
			}
			if($table_name == 'lead'){
				if(isset($data['companyName'])){
					$qry = 'select * from lead_register where companyName = "'.$data['companyName'].'"';
					$query = $this->db->query($qry);
					if($query->num_rows() <  1 ){
						$this->db->insert('lead_register',$data);
					}
				}
			} 
			if($table_name == 'enquiry'){
				$userid = $this->session->userdata('user');
				$userid = $userid['Id'];
				if(isset($data['companyName'])){
					if($leadname != '' ){
						$leaddata = array();
						$qry = 'select * from lead_register where companyName = "'.$leadname.'"';
						$query = $this->db->query($qry);
						if( $query->num_rows() > 0 ){
							$query  = $query->row_array();
							$data['lead_id'] = $query['id'];
						}else{
							$leaddata = array(
								'companyName'=>$leadname
							);
							if(isset($data['sourse']) ){
								$leaddata['source'] = $data['sourse'];
							}
							if(isset($data['area']) ){
								$leaddata['area'] = $data['area'];
							}
							if(isset($data['unbuss']) ){
								$leaddata['unbuss'] = $data['unbuss'];
							}
							if(isset($data['email']) ){
								$leaddata['email'] = $data['email'];
							}
							if(isset($data['adress']) ){
								$leaddata['adress'] = $data['adress'];
							}
							if(isset($data['remarks']) ){
								$leaddata['remarks'] = $data['remarks'];
							}
							if(isset($data['contactNumber']) ){
								$leaddata['contactNumber'] = $data['contactNumber'];
							}
							if(isset($data['contactPerson']) ){
								$leaddata['contactPerson'] = $data['contactPerson'];
							}
							if(isset($data['gst']) ){
								$leaddata['gst'] = $data['gst'];
							}
							$this->db->insert('lead_register',$leaddata);
							$data['lead_id'] = $this->db->insert_id();
						}
					}
					$data['user'] = $userid;
					$this->db->insert('enquiry_register',$data);
					$insert_id = $this->db->insert_id();
					if($product_id != ''){
						if(isset($data['type'] ) ){
							$type = $data['type'];
						}else{
							$type = 1;
						}
						if($quantity == ''){
							$quantity = 1;
						}
						if($price == ''){
							$quantity = 1;
						}
						$qry = "select * from item where name = '".$product_id."' and item_type_id = ".$type." ";
						$query = $this->db->query($qry);
						if($query->num_rows() > 0 ){
							$query = $query->row_array();
							$enquiry_product_array = array(
								'enquiry_id'=>$insert_id,
								'product_id'=>$query['id'],
								'quantity'=>$quantity,
								'price'=>$price
							);
							$this->db->insert('enquiry_product',$enquiry_product_array);
						}else{
							$data_item = array(
								'name'=>$product_id,
								'srate'=>$price
							);
							$this->db->insert('item',$data_item);
							$product_id = $this->db->insert_id();
							$enquiry_product_array = array(
								'enquiry_id'=>$insert_id,
								'product_id'=>$product_id,
								'quantity'=>$quantity,
								'price'=>$price
							);
							$this->db->insert('enquiry_product',$enquiry_product_array);
							
						}
					}
				}
			}
		}
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

   
}
