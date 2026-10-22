<?php

class Implementation_type_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = "id,name";    
        $this->table = 'implementation_type as i';
        $this->column_order = array(null, 'i.name', null); //set column field database for datatable orderable   
        $this->column_search = array('i.name'); //set column field database for datatable searchable 
        $this->order = array('i.id' => 'desc'); // default order 
    }
    public function save()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
        );

        if ($id == 0) {
            $this->db->insert('implementation_type', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('implementation_type', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
    function getsing($id)
    {
        $qry = 'select a.id,a.name from implementation_type as a where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());        
    }
    public function delete($id)
    {
        $qry = "Delete from implementation_type where id=".$id;
        $this->db->query($qry);
    }
  
}