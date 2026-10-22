<?php

class Course_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_course';
        $this->column_order = array(null, 'course_name'); //set column field database for datatable orderable
        $this->column_search = array('course_name'); //set column field database for datatable searchable 
        $this->order = array('course_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_course where course_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_course where course_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $course_name = $this->input->post('course_name');
        $course_id = $this->input->post('course_id');
        $data = array(
            'course_name' => $course_name,
        );
        if ($course_id == '0') {
            $this->db->insert('hr_course', $data);
        } else {
            $this->db->where('course_id', $course_id);
            $this->db->update('hr_course', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
