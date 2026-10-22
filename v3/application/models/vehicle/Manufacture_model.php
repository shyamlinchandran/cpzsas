<?php

class Manufacture_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'veh_manufacture';
        $this->column_order = array(null, 'veh_name'); //set column field database for datatable orderable
        $this->column_search = array('veh_name'); //set column field database for datatable searchable 
        $this->order = array('veh_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from veh_manufacture where veh_id=' .$veh_id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  veh_manufacture where veh_id =' .$veh_id;
        $this->db->query($qry);
    }

    function save() {
        $veh_name = $this->input->post('veh_name');
        $veh_description = $this->input->post('veh_description');
        $veh_id = $this->input->post('veh_id');
        $data = array(
            'veh_name' => $veh_name,
            'veh_description' => $veh_description);
        if ($veh_id == '0') {
            $this->db->insert('veh_manufacture', $data);
        } else {
            $this->db->where('veh_id', $veh_id);
            $this->db->update('veh_manufacture', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    
}
