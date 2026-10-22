<?php

class Enquiryfollowup_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'Enquiry_followup';
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select b.*,a.description,a.image,a.details from Enquiry_followup as a inner join enquiry_register as b on b.id=a.enquiry_id where enquiry_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save($file_name = "") {
        $id = $this->input->post('id');
        $details = $this->input->post('details');
        $description = $this->input->post('description');
        $data = array(
            'enquiry_id' => $id,
            'details' => $details,
            'image' => $file_name,
            'description' => $description
        );
        $this->db->insert('enquiry_followup ', $data);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
