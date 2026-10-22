<?php

class Roomcategory_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hotel_room_category';
        $this->column_order = array(null, 'roomcat_name'); //set column field database for datatable orderable
        $this->column_search = array('roomcat_name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hotel_room_category where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete  from  hotel_room_category where id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $roomcat_name = $this->input->post('roomcat_name');
        $roomcat_description = $this->input->post('roomcat_description');
        $roomcat_id = $this->input->post('roomcat_id');
        $data = array(
            'roomcat_name' => $roomcat_name,
            'roomcat_description' => $roomcat_description,
        );
        if ($roomcat_id == '0') {
            $this->db->insert('hotel_room_category', $data);
        } else {
            $this->db->where('id', $roomcat_id);
            $this->db->update('hotel_room_category', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
