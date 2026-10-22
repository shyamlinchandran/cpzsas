<?php

class Roomrate_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hotel_room_rate';
        $this->column_order = array(null, 'rate_amount'); //set column field database for datatable orderable
        $this->column_search = array('rate_amount'); //set column field database for datatable searchable 
        $this->order = array('room_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hotel_room_rate where room_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hotel_room_rate where room_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $rate_amount = $this->input->post('rate_amount');
        $room_extrabed = $this->input->post('room_extrabed');
        $room_id = $this->input->post('room_id');
        $data = array(
            'rate_amount' => $rate_amount,
            'room_extrabed' => $room_extrabed,
        );
        if ($room_id == '0') {
            $this->db->insert('hotel_room_rate', $data);
        } else {
            $this->db->where('room_id', $room_id);
            $this->db->update('hotel_room_rate', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
