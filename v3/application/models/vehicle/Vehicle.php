<?php

class Vehicle extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.name';
        $this->table = 'vehicles as a inner join suppliers as b on a.cus_id=b.id';
        $this->column_order = array(null, 'veh_name'); //set column field database for datatable orderable
        $this->column_search = array('veh_name','veh_no'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

   function save(){
    $id= $this->input->post('id');
    $veh_name=$this->input->post('veh_name');
    $veh_no=$this->input->post('veh_no');
    $veh_brand=$this->input->post('veh_brand');
    $veh_model=$this->input->post('veh_model');
    $cus_id=$this->input->post('cus_id');

    $data=[
        'veh_name'=>$veh_name, 
        'veh_no'=>$veh_no,
        'veh_brand'=>$veh_brand,
        'veh_model'=>$veh_model,
        'cus_id'=>$cus_id
    ];
    if($id==0){
      $this->db->insert('vehicles',$data);
      $id= $this->db->insert_id();
    }
    else{

        $this->db->where('id',$id);
        $this->db->update('vehicles',$data);

    }
    $response = array(
        'valid' => false,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );

    echo json_encode($response);

   }
   function delete($id){

    $this->db->from('vehicles')->where('id',$id);
    $this->db->delete();
   }

   function get_sing($id){
    $this->db->select('a.*,b.name');
    $this->db->where('a.id',$id);
    $data= $this->db->from('vehicles as a')->join('suppliers as b','a.cus_id = b.id')->get()->row_array();
    echo json_encode($data);

}
}
?>