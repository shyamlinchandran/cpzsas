<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuToUser_model
 *
 * @author dimind
 */
class MenuToUser_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'distinct b.user_name,b.Id as uid';
        $this->table = 'menu_to_user as a inner join users as b on a.user_id =b.Id';
        $this->column_order = array(null, 'user_name'); //set column field database for datatable orderable
        $this->column_search = array('b.user_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
 function user($id) {
        $qry = 'select * from users where Id='.$id;
        $re = $this->db->query($qry);
        return $re->result_array();
    }
    function menus() {
        $qry = "select  * from menus ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getmenus($id) {
        $qry = "select a.*,b.*,IFNULL(uid,0) as user from menus as a left JOIN (select is_cancel,is_add,e.menu_id,e.is_read,e.is_delete,e.is_write,d.user_name,d.id as uid from menu_to_user as e INNER JOIN users as d on e.user_id=d.Id WHERE e.user_id=" . $id . " ) as b on a.id=b.menu_id order by uid DESC";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function where() {
        
    }

 function userlist() {
        $qry = 'select Id,user_name as username from users where `is-active` = 1';
        $re = $this->db->query($qry);
        return $re->result_array();
    }
//
//    function save() {
//        $name = $this->input->post('name'); // if it is zero then we will add the item
//        $barcode = $this->input->post('barcode');
//        $price_code = $this->input->post('price_code');
//        $item_category_id = $this->input->post('item_category_id');
//        $item_group_id = $this->input->post('item_group_id');        
//        $unit = $this->input->post('unit_id');
//        $open_stock = $this->input->post('open_stock');
//        $current_stock = $this->input->post('current_stock');
//        $reorder_point = $this->input->post('reorder_point');
//        $prate = $this->input->post('prate'); // if it is zero then we will add the item
//        $srate = $this->input->post('srate');
//        $MRP = $this->input->post('MRP');
//        $commission = $this->input->post('commission');
//        $tax_id = $this->input->post('tax_id');
//        $published = $this->input->post('published');
//
//
//        $data = array(
//            'name' => $name,
//            'barcode' => $barcode,
//            'price_code' => $price_code,
//            'item_category_id' => $item_category_id,
//            'item_group_id' => $item_group_id,
//            'unit_id' => $unit,
//            'open_stock	' => $open_stock,
//            'current_stock' => $current_stock,
//            'reorder_point' => $reorder_point,
//            'prate' => $prate,
//            'srate' => $srate,
//            'MRP' => $MRP,
//            'commission' => $commission,
//            'tax_id	' => $tax_id,
//            'published' => $published
//        );  
//        $this->db->insert('item', $data);  
//        $response = array(
//            'valid' => false,
//            'type' => 1,
//            'message' => 'Saved Successfully.'
//        );
//        echo json_encode($response);
//    }
//
//
}
