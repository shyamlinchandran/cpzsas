<?php

class Salary_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'salary_components';
        $this->column_order = array(null, 'component_name'); //set column field database for datatable orderable
        $this->column_search = array('component_name'); //set column field database for datatable searchable 
        $this->order = array('component_name' => 'asc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from salary_components where component_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_course where course_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $component = $this->input->post('component');
        $salary_id = $this->input->post('salary_id');
        $basic_amt = $this->input->post('basic_amt');
        $component_type = $this->input->post('component_type');
        $data = array(
            'component_name' => $component,
            'component_type' => $component_type,
            'basic_amount' => $basic_amt
        );
        if ($salary_id == '0') {
            $this->db->insert('salary_components', $data);
        } else {
            $this->db->where('component_id', $salary_id);
            $this->db->update('salary_components', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
