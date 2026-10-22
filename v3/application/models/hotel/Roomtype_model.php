<?php

class Roomtype_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hotel_room_type';
        $this->column_order = array(null, 'type_name'); //set column field database for datatable orderable
        $this->column_search = array('type_name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hotel_room_type where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hotel_room_type where id =' . $id;
        $this->db->query($qry);
    }

    function floor() {
        $qry = "select a.* from hotel_floor  as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["flr_id"] . '">' . $row["flr_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function save() {
        $type_name = $this->input->post('type_name');
        $type_id = $this->input->post('type_id');
        $data = array(
            'type_name' => $type_name,
        );
        if ($type_id == '0') {
            $this->db->insert('hotel_room_type', $data);
        } else {
            $this->db->where('id', $type_id);
            $this->db->update('hotel_room_type', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
