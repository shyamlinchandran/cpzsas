<?php


class solution_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' c.name as sub,b.name as main,a.*';
        $this->table = 'solution as a left join category as b on a.category=b.id left join subcategory as c on c.id=a.subcategory';
        $this->column_order = array(null, 'a.name',); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
    function category() {
        $qry = "select a.* from category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
        }
        print_r($option);
    }

     function tax() {
        $qry = "select a.* from taxgst as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["gstid"] . '" >' . $row["GST"] . '</option>';
        }
        print_r($option);
    }

    function subcategory() {
        $qry = "select a.* from subcategory as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
        }
        print_r($option);
    }
    
    
    function getsing($id){
        $qry='select  * from solution where id ='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function delete($id){
        $qry = "delete from  solution where id =" . $id;
        $this->db->query($qry);
    }
function save($file_name=''){
    $id = $this->input->post('id'); 
    $name = $this->input->post('coname');
    $hiddlogo = $this->input->post('hiddlogo');
      
    $name=$this->input->post('name');
    $description=$this->input->post('description');
    $category=$this->input->post('category');
    $subcategory=$this->input->post('subcategory');
    $tax=$this->input->post('tax');
    $field1=$this->input->post('field1');
    $field2=$this->input->post('field2');

    $id=$this->input->post('id');
    $data=array(
        'name' =>$name,
        'description' =>$description,
        'category'=>$category,
        'subcategory'=>$subcategory,
        'imageupload' => $file_name,
        'tax'=>$tax,
        'field1'=>$field1,
        'field2'=>$field2);


    if($id=='0'){
        $this->db->insert('solution',$data);
        $response = array(
            'valid' => true,
            'type' => 1,
            'message' =>'Saved Successfully.'
        );
        
    }
    else{
        $this->db->where('id', $id);
        $this->db->update('solution',$data);
        $insert_id = $id;
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        
    }
    
    echo json_encode($response);    

}



}
