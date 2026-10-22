<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Message_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name';
        $this->table = 'sms as a left join sms_type as b on a.type=b.id';
        $this->column_search = array('name','sms');
        $this->order = array('a.id' => 'desc');
    }

    function where() {
        
    }

    function getsing($id) {
        $qry = 'select * from sms where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save() {
        $message = $this->input->post('msg');
        $type_id = $this->input->post('msgtype');
        $id = $this->input->post('id');
        $data = array(
            'sms' => $message,
            'type' => $type_id,
        );
        if ($id <= 0) {
            $this->db->insert('sms', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('sms', $data);
            $insert_id = $id;
        }
        return $insert_id;
    }

}
