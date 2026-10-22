<?php
class status_model extends DataTable{
    
    public function __construct()
    {
        parent::__construct();
        $this->select = '*';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'production_status';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'status'); //set column field database for datatable orderable   
        $this->column_search = array('status'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    } 

    function save(){
        $status=$this->input->post('status');
        $percentage=$this->input->post('percentage');
        $id=$this->input->post('id');


        $data=array(
            'status' => $status,
            'percentage'=>$percentage
        );

        if($id==0){
            $this->db->insert('production_status',$data);
        } 
        else{

            $this->db->where('id',$id)->update('production_status',$data);
        }
        

    $response = array(
        'valid' => true,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );
    echo json_encode($response);
    }

    function delete($id){
        $this->db->where('id',$id)->delete('production_status');

    }
    function getdata($id){
     $result = $this->db->where('id',$id)->get('production_status')->row_array();
     echo json_encode($result);
    }

}
?>
