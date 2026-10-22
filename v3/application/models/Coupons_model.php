<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coupons_model
 *
 * @author dimind
 */
class Coupons_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        $this->table = 'coupons as a';
        $this->column_order = array(null, 'cou_code' ,'name_lan','cou_image', 'date_from', 'date_to', 'cou_discountp','cou_discount', 'published'); //set column field database for datatable orderable
        $this->column_search = array('cou_code' , 'date_from', 'date_to'); //set column field database for datatable searchable 
        $this->order = array('a.cou_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'SELECT a.* FROM coupons as a WHERE a.cou_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save($file_name) {
        $id = $this->input->post('id'); // if it is zero then we will add the item
        $cou_code = $this->input->post('ccode');
        $name_lan = $this->input->post('name_lan');
        $hiddlogo = $this->input->post('hiddlogo');
        if ($file_name == '') {
            $file_name = $hiddlogo;
        }
        $cou_discountp = $this->input->post('discountp');
        $cou_discount = $this->input->post('discount');
        $description = $this->input->post('description');
        $published = $this->input->post('published');
        $start_date = $this->getDate($this->input->post('date_from'));
        $end_date = $this->getDate($this->input->post('date_to'));
        $data = array(
            'cou_code' => $cou_code,
            'name_lan' => $name_lan,
            'cou_image' => $file_name,
            'date_from' => $start_date,
            'date_to' => $end_date,
            'cou_discountp' => $cou_discountp,
            'cou_discount' => $cou_discount,
            'published' => $published,
        );
        if ($id == 0) {
            $this->db->insert('coupons', $data);
            $insert_id = $this->db->insert_id();
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
        } else {
            $this->db->where('cou_id', $id);
            $this->db->update('coupons', $data);
            $insert_id = $id;
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        }


        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete from coupons where cou_id =" . $id;
        $this->db->query($qry);
    }

}
