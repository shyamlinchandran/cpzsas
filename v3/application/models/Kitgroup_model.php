<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Dimind
 */
class Kitgroup_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.name as kitname,a.id as kitid,b.name as customer,b.id as customer_id';
        $this->table = ' kit_group as a left  join suppliers as b on a.customer_id=b.id ';
        $this->column_order = array(null, 'a.name', 'b.name', null); //set column field database for datatable orderable   
        $this->column_search = array('b.name', 'a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {

        $this->wherecondition = " where a.type='" . $this->input->post('type') . "'";
        if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . " and  customer_id = " . $this->input->post('customer_id');
        }
    }

    function kit_items($id) {
        $qry = "select c.name as item,a.*,b.* from kit_group as a left join kit_items as b on b.kit_id=a.id left join item as c on c.id=b.item_id  where b.published='yes' and a.type='kit_group' and a.id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function get_kit_items($id) {
        $qry = "select a.*,b.*,c.*,d.name as unit,e.GST as GST,b.name as item FROM kit_items as a INNER JOIN item as b on b.id=a.item_id inner join taxgst as c on c.gstid=b.tax_id left JOIN units as d on d.id=b.unit_id left join taxgst as e on e.gstid=b.tax_id where a.published='yes' and kit_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function kitgroup($search, $customer_id) {
        $is = '';
        $qry = "select name as label,a.* from kit_group as a where a.type='kit_group' and name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $customer_id = "";
        if ($this->input->post('customer_id')) {
            $customer_id = $this->input->post('customer_id');
        }

        if ($customer_id == "") {
            $customer_id = 0;
        }
        $Kitgroup = $this->input->post('kit_name');
        $item_id = $this->input->post('productid', true);
        $quantity = $this->input->post('pquantity', true);
        $rate = $this->input->post('prate', true);
        $data = array(
            'name' => $Kitgroup,
            'customer_id' => $customer_id,
            'type' => $type
        );
        if ($id == 0) {
            $this->db->insert('kit_group', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('kit_group', $data);
            $qry = "update  kit_items set published ='no' where kit_id =" . $id;
            $this->db->query($qry);
            $insert_id = $id;
        }
        $length = sizeof($item_id);
        for ($i = 0; $i < $length; $i++) {
            $kit_items = array(
                'kit_id' => $insert_id,
                'item_id' => $item_id[$i],
                'quantity' => $quantity[$i],
                'rate' => $rate[$i],
                'published' => 'yes',
            );
            $this->db->insert('kit_items', $kit_items);
            $insert = $this->db->insert_id();
        }
        return $insert_id;
    }

}
