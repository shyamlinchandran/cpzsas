<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sliders_model
 *
 * @author dimind
 */
class Sliders_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        $this->table = 'sliders as a';
        $this->column_order = array(null, 'sli_title', 'sli_image', 'sli_description','published'); //set column field database for datatable orderable
        $this->column_search = array('sli_title', 'sli_description'); //set column field database for datatable searchable 
        $this->order = array('a.sli_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'SELECT a.* FROM sliders as a WHERE a.sli_id=' . $id;
        $result = $this->db->query($qry);

        echo json_encode($result->row_array());
    }

    function save($file_name) {
        $id = $this->input->post('id'); // if it is zero then we will add the item
        $title = $this->input->post('title');
        $hiddlogo = $this->input->post('hiddlogo');
        if ($file_name == '') {
            $file_name = $hiddlogo; 
        }
        $description = $this->input->post('description');
        $published = $this->input->post('published');
        $data = array(
            'sli_title' => $title,
            'sli_image' => $file_name,
            'sli_description' => $description,
            'published' => $published,
        );
        if ($id == 0) {
            $this->db->insert('sliders', $data);
            $insert_id = $this->db->insert_id();
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
        } else {
            $this->db->where('sli_id', $id);
            $this->db->update('sliders', $data);
            $insert_id = $id;
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        }


        echo json_encode($response);
    }

}
