<?php

class Room_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hotel_room';
        $this->column_order = array(null, 'room_name'); //set column field database for datatable orderable
        $this->column_search = array('room_name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hotel_room where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete  from  hotel_room where id =' . $id;
        $this->db->query($qry);
    }

    function tax() {
        $qry = "select a.* from taxgst  as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["gstid"] . '">' . $row["GST"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function room_category() {
        $qry = "select a.* from hotel_room_category  as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["roomcat_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function room_floor($id) {
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

    function roomtype($id) {
        if ($id == 0) {
            $qry = "select a.* from hotel_room_type  as a ";
            $exeres = $this->db->query($qry);
            $result = $exeres->result_array();
            $no = 0;
            $option = '<option value="">Select</option>';
            foreach ($result as $row) {
                $option .= '<option room_bedcost="0" room_amount="0" value="' . $row["id"] . '">' . $row["type_name"] . '</option>';
                $no++;
            }
            print_r($option);
        } else {
            $qry = "SELECT * FROM `hotel_room_rate` as a INNER join hotel_room_type as b on a.`room_type`=b.id WHERE room_id=" . $id;
            $exeres = $this->db->query($qry);
            $result = $exeres->result_array();
            $no = 0;
            $option = '';
            foreach ($result as $row) {
                $option .= '<option room_bedcost= "' . $row["room_bedcost"] . '" room_amount= "' . $row["room_amount"] . '" value="' . $row["id"] . '">' . $row["type_name"] . '</option>';
                $no++;
            }
            print_r($option);
        }
    }

    function hotel_room_rate($id) {
        $qry = "select * from hotel_room_rate where   room_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {
        $room_name = $this->input->post('room_name');
        $room_description = $this->input->post('room_description');
        $room_floor = $this->input->post('room_floor');
        $room_id = $this->input->post('room_id');
        $room_max_num = $this->input->post('room_max_num');
        $room_category = $this->input->post('room_category');
        $room_roomtype = $this->input->post('room_roomtype');
        $room_tax = $this->input->post('room_tax');
        $room_amount = $this->input->post('room_amount');
        $room_bedcost = $this->input->post('room_bedcost');
        $data = array(
            'flr_id' => $room_floor,
            'room_name' => $room_name,
            'room_description' => $room_description,
            'room_floor' => $room_floor,
            'room_max_num' => $room_max_num,
            'room_category' => $room_category,
        );
        if ($room_id == '0') {
            $this->db->insert('hotel_room', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $room_id);
            $this->db->update('hotel_room', $data);
            $insert_id = $room_id;
            $qry = "delete from hotel_room_rate where room_id=" . $insert_id;
            $this->db->query($qry);
        }
        $room_type = $this->input->post('room', true);
        $tax_id = $this->input->post('room_tax', true);
        $room_amount = $this->input->post('room_amount', true);
        $room_bedcost = $this->input->post('room_bedcost', true);
        if ($this->input->post('room', true)) {
            $length = sizeof($room_type);
            for ($i = 0; $i < $length; $i++) {
                $data = array(
                    'room_id' => $insert_id,
                    'tax_id' => $tax_id[$i],
                    'room_type' => $room_type[$i],
                    'room_amount' => $room_amount[$i],
                    'room_bedcost' => $room_bedcost[$i]
                );
                $this->db->insert('hotel_room_rate', $data);
            }
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
