<?php

class Vehicledetails_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'veh_details';
        $this->column_order = array(null, 'veh_number'); //set column field database for datatable orderable
        $this->column_search = array('veh_number'); //set column field database for datatable searchable 
        $this->order = array('veh_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from veh_details where veh_id=' . $veh_id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  veh_details where veh_id =' . $veh_id;
        $this->db->query($qry);
    }

    function save() {
        $veh_number = $this->input->post('veh_number');
        $veh_type = $this->input->post('veh_type');
        $veh_engine = $this->input->post('veh_engine');
        $veh_regdate = $this->input->post('veh_regdate');
        $veh_expdate = $this->input->post('veh_expdate');
        $veh_id = $this->input->post('$veh_id');
        $data = array(
            'veh_number' => $veh_number,
            'veh_type' => $veh_type,
            'veh_engine' => $veh_engine,
            'veh_regdate' => $this->getDate($veh_regdate),
            'veh_expdate' => $this->getDate($veh_expdate),
        );
        if ($veh_id == '0') {
            $this->db->insert('veh_details', $data);
        } else {
            $this->db->where('veh_id', $veh_id);
            $this->db->update('veh_details', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
