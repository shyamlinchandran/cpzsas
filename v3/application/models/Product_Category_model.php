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
class Product_Category_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'product_category';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }
    function getsing($id){
        $qry='select * from product_category where id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function delete($id){
        $qry = "delete from  product_category where id =" . $id;
        $this->db->query($qry);
            }
function save(){
    $name=$this->input->post('name');
    $discription=$this->input->post('discription');
    $field1=$this->input->post('field1');
    $field2=$this->input->post('field2');
    $id=$this->input->post('id');
    $data=array(
        'name' => $name,
        'discription' =>$discription,
        'field1'=>$field1,
        'field2'=>$field2); 
    if($id=='0'){
        $this->db->insert('product_category',$data);
    }
    else{
        $this->db->where('id', $id);
        $this->db->update('product_category', $data);
    }
    $response = array(
        'valid' => false,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );
    echo json_encode($response);    

}

}