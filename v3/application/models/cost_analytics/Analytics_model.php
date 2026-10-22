<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Costmodel
 *
 * @author dimind
 */
class Analytics_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.any_id as mainanid,b.any_name as mainanname';
        $this->table = 'analytics_center as a LEFT JOIN analytics_center as b on a.fk_any_id=b.any_id';
        $this->column_order = array(null, 'a.any_name', 'mainanname', 'any_description'); //set column field database for datatable orderable
        $this->column_search = array('a.any_name'); //set column field database for datatable searchable 
        $this->order = array('a.any_id' => 'desc'); // default order 
    }

    function getsing_any($id) {
        $qry = 'select a.*,b.any_id as mainanid,b.any_name as mainanname from analytics_center as a LEFT JOIN analytics_center as b on a.fk_any_id=b.any_id where a.any_id =' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function analyt_centres($search) {
        $qry = "select a.any_name as label,a.* from analytics_center as a where (any_name like('%$search%') or any_description like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function analytics_center_all() {
        $qry = "select a.* from analytics_center as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["any_id"] . '">' . $row["any_name"] . '</option>';
        }
        print_r($option);
    }

    function save() {

        $id = $this->input->post('id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $main_an = $this->input->post('mainan_id');
        if($main_an=='')
        {
            $main_an = 0;
        }
        $details = $this->input->post('details');

        $insert_id = 0;
        $data = array(
            'any_name' => $name,
            'fk_any_id' => $main_an,
            'any_description' => $details,
        );
        if ($this->multiple != 0) {
            $data['name_lan'] =  $this->input->post('name_lan');
        }

            if ($id == 0) {
                $this->db->insert('analytics_center', $data);
                $insert_id = $this->db->insert_id();
            } else {
                $insert_id = $id;
                $this->db->where('any_id', $id);
                $this->db->update('analytics_center', $data);
            }
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }

        function delete($id) {
            $qry = "delete from analytics_center where any_id =" . $id;
            $this->db->query($qry);
        }

    }
    