<?php
class label_model extends DataTable{
    
    public function __construct()
    {
        parent::__construct();
        $this->select = '*';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'production_label';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'label'); //set column field database for datatable orderable   
        $this->column_search = array('label'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    } 

    function save(){
        $label=$this->input->post('label');
        $type=$this->input->post('type');
        $order=$this->input->post('order');
        $values=$this->input->post('values');
        $id=$this->input->post('id');


        $data=array(
            'label' => $label,
            'type'=>$type,
            'order'=>$order,
            'values'=>$values

        );

        if($id==0){
            $this->db->insert('production_label',$data);
        } 
        else{

            $this->db->where('id',$id)->update('production_label',$data);
        }
        

    $response = array(
        'valid' => true,
        'type' => 1,
        'message' => 'Saved Successfully.'
    );
    echo json_encode($response);
    }

    function delete($id){
        $this->db->where('id',$id)->delete('production_label');

    }
    function getdata($id){
     $result = $this->db->where('id',$id)->get('production_label')->row_array();
     echo json_encode($result);
    }

}
?>
