<?php

class Department_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_department';
        $this->column_order = array(null, 'dept_name'); //set column field database for datatable orderable
        $this->column_search = array('dept_name'); //set column field database for datatable searchable 
        $this->order = array('dept_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_department where dept_id=' .$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_department where dept_id =' .$id;
        $this->db->query($qry);
    }

    function save() {
        $dept_name = $this->input->post('dept_name');
        $dept_description = $this->input->post('dept_description');
        $dept_id = $this->input->post('dept_id');
        $data = array(
            'dept_name' => $dept_name,
            'dept_description' => $dept_description);
        if ($dept_id == '0') {
            $this->db->insert('hr_department', $data);
        } else {
            $this->db->where('dept_id', $dept_id);
            $this->db->update('hr_department', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
