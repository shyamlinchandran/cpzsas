<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Costmodel
 *
 * @author dimind
 */
class Delivery_method_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        $this->table = 'delivery_method as a';
        $this->column_order = array(null, 'a.delivery_method', 'a.amount', 'a.type'); //set column field database for datatable orderable
        $this->column_search = array('a.delivery_method', 'a.type'); //set column field database for datatable searchable 
        $this->order = array('a.delivery_method' => 'asc'); // default order 
    }

    public function where() {
        $type = $this->input->post('type');
        $this->wherecondition = 'where  a.type="' . $type . '" ';
    }

    function getsing($id) {
        $qry = 'select * from delivery_method where delivery_method_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function get_state($id) {
        $qry = 'select a.*,IFNULL(state_id,0) as state from state as a left join delivery_method_states as b on a.StateID=b.state_id and b.method_id=' . $id . ' ';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function save() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $delivery_method = $this->input->post('delivery_method');
        $delivery_amt = $this->input->post('delivery_amt');
        $state = $this->input->post('state', true);
        $data = array(
            'delivery_method' => $delivery_method,
            'amount' => $delivery_amt,
            'type' => $type
        );
        if ($id == 0) {
            $this->db->insert('delivery_method', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('delivery_method_id', $insert_id);
            $this->db->update('delivery_method', $data);
            $qry = "delete  from delivery_method_states  where method_id =" . $id;
            $this->db->query($qry);
        }
        if ($this->input->post('state')) {
            foreach ($state as $in) {
                $data = array(
                    'method_id' => $insert_id,
                    'state_id' => $in
                );
                $this->db->insert('delivery_method_states', $data);
            }
        }
        $response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
