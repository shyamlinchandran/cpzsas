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
class Materialbill_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.id as itemid,b.name as itemname';
        $this->table = '`bill_material_main` as a INNER JOIN item as b on a.main_item_id=b.id';
        $this->column_order = array(null,'b,name','a.bmm_quantity',null); //set column field database for datatable orderable   
        $this->column_search = array('b.name','bmm_quantity'); //set column field database for datatable searchable 
        $this->order = array('a.bmm_id' => 'desc'); // default order 
    }

    function where($id) {
        $this->wherecondition = "where a.sett_id = '" . $id . "'";
    }
function mainitem($search) {
        $qry = "select name as label,id FROM item where name like('%$search%') and material_type=1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
   function subitems($search) {
        $qry = "select name as label,id FROM item where name like('%$search%') and material_type!=1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function getsing($id) {
        $qry = 'SELECT a.*,b.id as mainitemid,b.name as mainitemname,c.bmb_quantity as subqty,d.id as subitemid,d.name as subitemname, u.id as mainunitid,u.name as mainunit,y.id as subunitid, y.name as subunit FROM bill_material_main as a INNER JOIN item as b on a.main_item_id=b.id LEFT OUTER JOIN bill_material_sub as c on a.main_item_id=c.main_item_id INNER JOIN item as d on c.sub_item_id=d.id INNER JOIN units as u on a.unit_id=u.id INNER JOIN units as y on c.unit_id=y.id WHERE a.bmm_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function unit() {
        $qry = 'select * from units';
        $unit = $this->db->query($qry);
        return $unit->result_array();
    }

      function save() {
        $id = $this->input->post('id');
        $main_item_id = $this->input->post('product_id'); // if it is zero then we will add the item
        $main_quantity = $this->input->post('p_quantity'); 
        $main_unit = $this->input->post('p_unit_id'); 
        $main_data = array(
                'main_item_id' => $main_item_id,
                'bmm_quantity' => $main_quantity,
                'unit_id'=>$main_unit,
            );
            if ($id == 0) {
                $this->db->insert('bill_material_main', $main_data);
                $insert_id = $this->db->insert_id();
            } else {
                $this->db->where('bmm_id', $id);
                $this->db->update('bill_material_main', $main_data);
                $insert_id = $id;
            }
        $rawm_id = $this->input->post('rawmid', TRUE);
        $r_quantity = $this->input->post('rqty', TRUE);
        $sub_unit = $this->input->post('r_unitid', TRUE); 
        $length = sizeof($rawm_id);
        for ($i = 1; $i <= $length; $i++) {
            $data = array(
                'main_item_id' => $main_item_id,
                'bmm_id'=>$insert_id,
                'sub_item_id' => $rawm_id[$i],
                'bmb_quantity' => $r_quantity[$i],
                'unit_id'=>$sub_unit[$i],
            );
            if ($id == 0) {
                $this->db->insert('bill_material_sub', $data);

            } else {
                $this->db->where('bmb_id', $id);
                $this->db->update('bill_material_sub', $data);
            }
        }
       $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully'
        );
        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete from bill_material_sub where bmb_id =" . $id;
        $this->db->query($qry);
    }

}
