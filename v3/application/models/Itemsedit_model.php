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
class Itemsedit_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'barcode,c.id as cid, a.id,a.name as itemname,e.godown_name ,a.barcode,a.srate as salerate,b.name as category,a.description,c.open_stock,a.open_stk_rate';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a left join item_category as b on a.item_category_id =b.id   left JOIN `item_godown` as c on a.id=c.item_id  INNER JOIN ims_godown as e on c.godown_id=e.id  ';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'itemname', 'e.godown_name', 'category', 'salerate', null); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'e.godown_name', 'a.barcode', 'b.name', 'a.description'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        //$this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        $this->wherecondition =  " where 1 ";
        if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and a.material_type=' . $this->input->post('material_type');
        }
		 if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_category_id=' . $this->input->post('category_id');
        }
		 if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . 'and a.brand_id=' . $this->input->post('brand');
        }
    }
	function wherecondition() {
        $this->select = '*';
        $this->table = 'item as a ';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable  
        $this->column_search = array('barcode', 'name');    //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
		$this->wherecondition = " where 1";
        if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and a.material_type=' . $this->input->post('material_type');
        }
		 if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_category_id=' . $this->input->post('category_id');
        }
		 if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and a.brand_id=' . $this->input->post('brand');
        }
	}

    function updatestk($cid, $stk, $srate, $itemid) {
        $qry = "UPDATE `item_godown` SET `open_stock` = '" . $stk . "' WHERE `item_godown`.`id` =" . $cid;
        $this->db->query($qry);
        $qry = "UPDATE `item` SET `open_stk_rate` = '" . $srate . "' WHERE `item`.`id` = " . $itemid;
        $this->db->query($qry); 
    }

}
