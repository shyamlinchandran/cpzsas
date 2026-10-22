<?php

class Source_of_enquiry_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'source_enquiry';
        $this->column_order = array('details', 'source_of_enquiry'); //set column field database for datatable orderable
        $this->column_search = array('source_of_enquiry'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
   function save() {
        $id = $this->input->post('id');
        $source = $this->input->post('source');
        $Details = $this->input->post('Details');       
        $data = array(
            'source_of_enquiry' => $source,
            'details' => $Details,
        );
        if ($id == 0) {
            $this->db->insert('source_enquiry', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('source_enquiry', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }
    function getsing($id) {
        $qry = 'select * from source_enquiry where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

}
