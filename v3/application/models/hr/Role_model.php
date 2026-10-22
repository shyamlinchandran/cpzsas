<?php

class Role_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_role';
        $this->column_order = array(null, 'role_name'); //set column field database for datatable orderable
        $this->column_search = array('role_name'); //set column field database for datatable searchable 
        $this->order = array('role_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_role where role_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_role where role_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $role_name = $this->input->post('role_name');
        $role_description = $this->input->post('role_description');
        $role_id = $this->input->post('role_id');
        $data = array(
            'role_name' => $role_name,
            'role_description' => $role_description);
        if ($role_id == '0') {
            $this->db->insert('hr_role', $data);
        } else {
            $this->db->where('role_id', $role_id);
            $this->db->update('hr_role', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
