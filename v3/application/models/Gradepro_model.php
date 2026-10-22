<?php



class Gradepro_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'grade';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
    
    function getsing($id){
        $qry='select * from grade where id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function delete($id){
        $qry = "delete from  grade where id =" . $id;
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
        $this->db->insert('grade',$data);
    }
    else{
        $this->db->where('id', $id);
        $this->db->update('grade', $data);
    }
    $response = array(
        'valid' => false,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );
    echo json_encode($response);    

}
}