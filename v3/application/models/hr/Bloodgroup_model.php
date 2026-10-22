<?php

class Bloodgroup_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_bloodgroup';
        $this->column_order = array(null, 'blood_name'); //set column field database for datatable orderable
        $this->column_search = array('blood_name'); //set column field database for datatable searchable 
        $this->order = array('blood_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_bloodgroup where blood_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_bloodgroup where blood_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $blood_name = $this->input->post('blood_name');
        $blood_description = $this->input->post('blood_description');
        $blood_id = $this->input->post('blood_id');
        $data = array(
            'blood_name' => $blood_name,
            'blood_description' => $blood_description);
        if ($blood_id == '0') {
            $this->db->insert('hr_bloodgroup', $data);
        } else {
            $this->db->where('blood_id', $blood_id);
            $this->db->update('hr_bloodgroup', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
