<?php

class Floor_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hotel_floor';
        $this->column_order = array(null, 'flr_name'); //set column field database for datatable orderable
        $this->column_search = array('flr_name'); //set column field database for datatable searchable 
        $this->order = array('flr_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hotel_floor where flr_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hotel_floor where flr_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $flr_name = $this->input->post('flr_name');
        $flr_id = $this->input->post('flr_id');
        $data = array(
            'flr_name' => $flr_name,
        );
        if ($flr_id == '0') {
            $this->db->insert('hotel_floor', $data);
        } else {
            $this->db->where('flr_id', $flr_id);
            $this->db->update('hotel_floor', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
