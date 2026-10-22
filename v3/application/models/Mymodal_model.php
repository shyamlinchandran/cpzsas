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
class Mymodal_model extends DataTable {

    public function __construct() {
        parent::__construct();
      
    }
	
	function save_supplier(){
		$modal_supplierName = $this->input->post('modal_supplierName');
		$modal_supplierPhone = $this->input->post('modal_supplierPhone');
		$modal_supplierGST = $this->input->post('modal_supplierGST');
		$modal_supplierEmail = $this->input->post('modal_supplierEmail');
		$modal_supplierAdd1 = $this->input->post('modal_supplierAdd1');
		$modal_supplierAdd2 = $this->input->post('modal_supplierAdd2');
		$area = $this->input->post('modal_supplierArea');
		$modal_supplierType =  $this->input->post('modal_supplierType');
		$modal_supplierstate = '';
		if( $this->input->post('modal_supplierstate')){
			$modal_supplierstate = $this->input->post('modal_supplierstate');
		}
		$data = array(
			'name'=>$modal_supplierName,
			'phone'=>$modal_supplierPhone,
			'area'=>$area,
			'cst'=>$modal_supplierstate,
			'tin'=>$modal_supplierGST ,
			'email'=>$modal_supplierEmail,
			'address_line1'=>$modal_supplierAdd1,
			'address_line2'=>$modal_supplierAdd2,
			'type'=>$modal_supplierType
		);
		$acc_main_id = 25;
		if($modal_supplierType === 'sup'){
			$acc_main_id = 24;
		}

		if($this->input->post('modal_aadhar')){
			$data['aadhar'] = $this->input->post('modal_aadhar');
		}
		if($this->input->post('modal_pan')){
			$data['pan'] = $this->input->post('modal_pan');
		}
		$this->db->insert('suppliers',$data);
		$insert_id = $this->db->insert_id();
		$ledger_data = array(
			"name" => $data['name'],
            "code" => $data['phone'],
            "ref_id" => $insert_id,
            "ref_code" => $modal_supplierType,
            "is_default" => true,
            "acc_main_id" => $acc_main_id,
            "openning_bal" => 0,
            "type" => 'Cr',
            "published" => 'yes'
        );
        $this->db->insert('acc_ledgers', $ledger_data);
		return $insert_id;
	}

   function save(){
		$hsncode = $this->input->post('modal_itemhsn');
		$modal_itemName = $this->input->post('modal_itemName');
		$modal_itemCategory = $this->input->post('modal_itemCategory');
		$modal_isautoBarcode = $this->input->post('modal_isautoBarcode');
		$modal_itemBarcode = $this->input->post('modal_itemBarcode');
		$modal_itemUnit = $this->input->post('modal_itemUnit');
		$modal_itemTax = $this->input->post('modal_itemTax');
		$modal_itemPrate = $this->input->post('modal_itemPrate');
		$modal_itemMrp = $this->input->post('modal_itemMrp');
		$modal_itemSrate = $this->input->post('modal_itemSrate');
		$item_type_id = $this->input->post('modal_itemtype');
		$item_type_id = $this->input->post('modal_itemtype');
		$brand_id = 0 ;
		if($this->input->post('modal_itemBrand')){
			$brand_id = $this->input->post('modal_itemBrand');
		}
		$item_type_id = 1;
		$qry = "SELECT b.* FROM taxgst as a INNER JOIN acc_ledgers as b on a.gstid =b.ref_id and ref_code in('Tax','SaleTax','PurTax') and gstid='".$modal_itemTax."' ";
		$query = $this->db->query($qry);
		$data = array(
			'name'=>$modal_itemName,
			'brand_id'=>$brand_id,
			'item_category_id'=>$modal_itemCategory,
			'hsncode'=>$hsncode,
			'is_autobarcode'=>$modal_isautoBarcode,
			'barcode'=>$modal_itemBarcode,
			'item_type_id'=>$item_type_id,
			'unit_id'=>$modal_itemUnit,
			'tax_id'=>$modal_itemTax,
			'prate'=>$modal_itemPrate,
			'srate'=>$modal_itemSrate,
			'MRP'=>$modal_itemMrp
		);
		if($query->num_rows() > 0 ){
			$query = $query->result_array();
			foreach($query as $item){
				if($item['ref_code'] == 'Tax'){
					$data['tax_ledger_id'] = $item['id'];
				}else if($item['ref_code'] == 'SaleTax'){
					$data['tax_sales_id'] = $item['id'];
				}else if($item['ref_code'] == 'PurTax'){
					$data['tax_purchase_id'] = $item['id'];
				}
			}
		}
		$this->db->insert('item', $data);
        $insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function update_company_message($data){
		$qry = 'update company_message set is_active = 0  where is_active = 1 and company_id = '.$data['company_id'];
		$this->db->query($qry);
		if($data['message'] != '' ){
			$this->db->insert('company_message',$data);
		}
	}

}
