<?php

class Processtype_model  extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table ='process_type';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }
    function getsing($id){
        $qry='select * from process_type where id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function delete($id){
        $qry = "delete from  process_type where id =" . $id;
        $this->db->query($qry);
    }
function save(){
    $name=$this->input->post('name');
    $description=$this->input->post('description');

    $field1=$this->input->post('field1');
    $field2=$this->input->post('field2');
    $id=$this->input->post('id');
    $data=array(
        'name' => $name,
        'description' =>$description,
        'field1'=>$field1,
        'field2'=>$field2); 
    if($id=='0'){
        $this->db->insert('process_type',$data);
    }
    else{
        $this->db->where('id', $id);
        $this->db->update('process_type', $data);
    }
    $response = array(
        'valid' => false,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );
    
    echo json_encode($response);    

}

}