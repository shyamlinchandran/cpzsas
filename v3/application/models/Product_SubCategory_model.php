<?php
class Product_SubCategory_model   extends DataTable {

    public function __construct() {
        parent::__construct();
       // $this->select = ' c.name as sub,b.name as main,a.*';
       //$this->table = 'Product_SubCategory as a left join category as b on a.category=b.id left join category as c on c.id=a.subcategory';
        $this->select = ' a.*,b.name as cat';
        $this->table = 'product_sub_category as a left join category as b on a.category=b.id';
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
     
    function getsing($id){
        $qry='select * from product_sub_category where id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function delete($id){
        $qry = "delete  from  product_sub_category where id =" . $id;
        $this->db->query($qry);
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
    

function save(){
    $name=$this->input->post('name');
    $description=$this->input->post('description');
    $category=$this->input->post('category');
    $field1=$this->input->post('field1');
    $field2=$this->input->post('field2');
    $id=$this->input->post('id');
    $data=array(
        'name' =>$name,
        'description' =>$description,
        'category'=>$category,
        'field1'=>$field1,
        'field2'=>$field2); 
    if($id=='0'){
        $this->db->insert('product_sub_category',$data);
    }
    else{
        $this->db->where('id', $id);
        $this->db->update('product_sub_category',$data);
    }
    $response = array(
        'valid' => false,
        'type' => 1,
        'message' =>'Saved Successfully.'
    );
    echo json_encode($response);    

}

}