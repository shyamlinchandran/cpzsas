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
class Cost_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.cost_id as maincostid,b.cost_name as maincostname';
        $this->table = 'cost_centre as a LEFT JOIN cost_centre as b on a.fk_cost_id=b.cost_id';
        $this->column_order = array(null, 'cost_name', 'maincostname', 'cos_amountp'); //set column field database for datatable orderable
        $this->column_search = array('a.cost_name', 'b.cost_name'); //set column field database for datatable searchable 
        $this->order = array('a.cost_id' => 'desc'); // default order 
    }

    function getsing_cost($id) {
        $qry = 'select a.*,b.cost_id as maincostid,b.cost_name as maincostname from cost_centre as a LEFT JOIN cost_centre as b on a.fk_cost_id=b.cost_id where a.cost_id  =' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function cost_centres($search) {
        $qry = "select a.cost_name as label,a.* from cost_centre as a where (cost_name like('%$search%') or cost_description like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {

        $id = $this->input->post('id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $main_cost = $this->input->post('maincost_id');
        if($main_cost=='')
        {
            $main_cost = 0;
        }
        $amount_p = $this->input->post('amount_p');
        if($amount_p == '' )
        {
            $amount_p = 0;
        }
        $details = $this->input->post('details');
        $insert_id = 0;
        $data = array(
            'cost_name' => $name, //				
            'fk_cost_id' => $main_cost,
            'cos_amountp' => $amount_p,
            'cost_description' => $details,
        );
        if ($this->multiple != 0) {
            $data['name_lan'] = $this->input->post('name_lan');
        }

        if ($id == 0) {
            $this->db->insert('cost_centre', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('cost_id', $id);
            $this->db->update('cost_centre', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete from cost_centre where cost_id =" . $id;
        $this->db->query($qry);
    }

}
