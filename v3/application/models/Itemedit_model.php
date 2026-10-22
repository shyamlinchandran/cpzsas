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
class Itemedit_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'is_active,landing_cost,special_rate,hsncode,brand_id,cess_id,IFNULL(wh_rate,0) as wh_rate,godown,item_category_id,barcode,name,id,tax_id,IFNULL(prate,0) as prate,IFNULL(srate,0) as srate,IFNULL(MRP,0) as MRP ,item_group_id';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a   ';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable   
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
//        $this->order = array('a.id' => 'desc'); // default order 
    }

    function tax() {
        $qry = "select a.* from taxgst as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["gstid"] . '" percent="' . $row["GST"] . '" igst="' . $row["igst"] . '" cgst="' . $row["cgst"] . '" sgst="' . $row["sgst"] . '">' . $row["GST"] . '</option>';
        }
        return $option;
    }
	 function cess() {
        $qry = "select a.* from cess_tbl as a  where cess_on_item =1 ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="0"> Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ces_id"] . '" >' . $row["ces_name"] . '</option>';
        }
        return $option;
    }
	
	function hsncode() {
        $qry = "select a.* from hsncode as a  where 1 ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="0"> Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["hsnid"] . '" >' . $row["hsncode"] . '</option>';
        }
        return $option;
    }
	
	function category(){
		$qry = "select a.* from item_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
        }
        return $option;
	}
	
	function discount() {
        $qry = "select a.* from item_group as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["discount"] . '</option>';
        }
        return $option;
    }

    function ims_godown() {
        $qry = "select a.* from ims_godown as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["godown_name"] . '</option>';
        }
        return $option;
    }
	
	function brand() {
        $qry = "select a.* from item_brand as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ibr_id"] . '" >' . $row["ibr_name"] . '</option>';
        }
        return $option;
    }

    function where() {
        $this->wherecondition = " where a.published = 'yes' ";
        if ($this->input->post('srh_text')) {
            $this->wherecondition = "where a.name like ('%" . $this->input->post('srh_text') . "%')";
        }
		if($this->input->post('brand')){
			 $this->wherecondition = $this->wherecondition . " and a.brand_id = ".$this->input->post('brand');
		}
		if($this->input->post('category_id')){
			 $this->wherecondition = $this->wherecondition . " and a.item_category_id = ".$this->input->post('category_id');
		}
        if($this->input->post('it_stat')){
			 $this->wherecondition = $this->wherecondition . " and a.is_active = ".$this->input->post('it_stat');
		}else{
			 $this->wherecondition = $this->wherecondition . " and a.is_active = 0";
        }
		
        $this->wherecondition = $this->wherecondition . " limit 200";
		
    }

    function updaterate($item_id, $prate, $MRP, $srate, $tax_id,$discount,$txtBARCODE,$category,$godown,$txtwh_rate,$cess_id,$brand,$hsncode,$landing_cost,$special_rate,$item_active) {
        $qry = "UPDATE item SET hsncode = '".$hsncode."', brand_id='".$brand."',cess_id='".$cess_id."',wh_rate='".$txtwh_rate."',godown='".$godown."',item_category_id='".$category."',barcode='".$txtBARCODE."',item_group_id = '".$discount."', prate = '" . $prate . "' , srate = '" . $srate . "' , MRP = '" . $MRP . "', tax_id = '" . $tax_id . "', landing_cost = '" . $landing_cost . "', special_rate = '" . $special_rate . "' , is_active = '" . $item_active . "' WHERE  id =" . $item_id;
		$this->db->query($qry);
    }

}
