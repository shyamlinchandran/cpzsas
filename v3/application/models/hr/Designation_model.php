<?php

class Designation_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_designation';
        $this->column_order = array(null, 'desig_name'); //set column field database for datatable orderable
        $this->column_search = array('desig_name'); //set column field database for datatable searchable 
        $this->order = array('desig_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_designation where desig_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_designation where desig_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $desig_name = $this->input->post('desig_name');
        $desig_description = $this->input->post('desig_description');
        $desig_id = $this->input->post('desig_id');
        $data = array(
            'desig_name' => $desig_name,
            'desig_description' => $desig_description);
        if ($desig_id == '0') {
            $this->db->insert('hr_designation', $data);
        } else {
            $this->db->where('desig_id', $desig_id);
            $this->db->update('hr_designation', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
