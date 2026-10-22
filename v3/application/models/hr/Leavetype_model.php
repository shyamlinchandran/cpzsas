<?php

class Leavetype_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_leavetype';
        $this->column_order = array(null, 'leave_name'); //set column field database for datatable orderable
        $this->column_search = array('leave_name'); //set column field database for datatable searchable 
        $this->order = array('leave_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_leavetype where leave_id=' .$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_leavetype where leave_id =' .$id;
        $this->db->query($qry);
    }

    function save() {
        $leave_name = $this->input->post('leave_name');
        $leave_days = $this->input->post('leave_days');
        $is_active = $this->input->post('is_active');
        $leave_id = $this->input->post('leave_id');
        $data = array(
            'leave_name' => $leave_name,
            'is_active' => $is_active,
            'leave_days' => $leave_days);
        if ($leave_id == '0') {
            $this->db->insert('hr_leavetype', $data);
        } else {
            $this->db->where('leave_id', $leave_id);
            $this->db->update('hr_leavetype', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
