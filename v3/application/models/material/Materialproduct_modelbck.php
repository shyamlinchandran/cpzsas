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
class Materialproduct_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.id as itemid,b.name as itemname';
        $this->table = '`finished_goods` as a INNER JOIN item as b on a.main_item_id=b.id';
        $this->column_order = array(null,'b,name','a.fga_quantity',null); //set column field database for datatable orderable   
        $this->column_search = array('b.name','fga_quantity'); //set column field database for datatable searchable 
        $this->order = array('a.fga_id' => 'desc'); // default order 
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
        $qry = 'SELECT a.*,b.id as mainitemid,b.name as mainitemname,c.fgb_quantity as subqty,d.id as subitemid,d.name as subitemname, u.id as mainunitid,u.name as mainunit,y.id as subunitid, y.name as subunit,g.id as mgdwnid,g.godown_name as mgdwn,k.id as sgdwnid,k.godown_name as sgdwn FROM finished_goods as a INNER JOIN item as b on a.main_item_id=b.id LEFT OUTER JOIN finished_goods_sub as c on a.main_item_id=c.main_item_id INNER JOIN item as d on c.sub_item_id=d.id INNER JOIN units as u on a.unit_id=u.id INNER JOIN units as y on c.unit_id=y.id INNER JOIN ims_godown as g on a.godown_id=g.id INNER JOIN ims_godown as k on a.godown_id=k.id  WHERE a.fga_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function getproductsing($id) {
        $qry = 'SELECT a.*,b.id as mainitemid,b.name as mainitemname,c.bmb_quantity as subqty,d.id as subitemid,d.name as subitemname, u.id as mainunitid,u.name as mainunit,y.id as subunitid, y.name as subunit FROM bill_material_main as a INNER JOIN item as b on a.main_item_id=b.id LEFT OUTER JOIN bill_material_sub as c on a.main_item_id=c.main_item_id INNER JOIN item as d on c.sub_item_id=d.id INNER JOIN units as u on a.unit_id=u.id INNER JOIN units as y on c.unit_id=y.id WHERE a.main_item_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function unit() {
        $qry = 'select * from units';
        $unit = $this->db->query($qry);
        return $unit->result_array();
    }
    function godown($godown) {
        $qry = 'select * from ims_godown';
        $gwn = $this->db->query($qry);
        return $gwn->result_array();
    }
     function userlist() {
        $qry = 'select Id,user_name as username from users where `is-active` = 1';
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function delete($id) {
        $qry = "delete from bill_material_sub where bmb_id =" . $id;
        $this->db->query($qry);
    }

    public function save() {
        $id = $this->input->post('id');
        $user = $this->input->post('username');
        $date = $this->getDate($this->input->post('date'));
        $main_item_id = $this->input->post('product_id'); // if it is zero then we will add the item
        $main_quantity = $this->input->post('p_quantity'); 
        $main_unit = $this->input->post('p_unit_id'); 
        $p_godown = $this->input->post('godow');
        $p_quantity = $this->input->post('p_quantity');
        $transfer = 'production';
        $product_id = $this->input->post('product_id');
        $rawm_id = $this->input->post('rawmid',true);
        $r_quantity = $this->input->post('rqty', TRUE);
        $sub_unit = $this->input->post('r_unitid', TRUE); 
        $r_godown = $this->input->post('rgdwn',true);
        $main_data = array(
            'user_id'=>$user,
            'created_on'=>$date,
            'main_item_id' => $main_item_id,
            'fga_quantity' => $main_quantity,
            'unit_id'=>$main_unit,
            'godown_id'=>$p_quantity,
            );
            if ($id == 0) {
                $this->db->insert('finished_goods', $main_data);
                $insert_id = $this->db->insert_id();
            } else {
                $this->db->where('fga_id', $id);
                $this->db->update('finished_goods', $main_data);
                $insert_id = $id;
            }
        $length = sizeof($rawm_id);
        for ($i = 1; $i <= $length; $i++) {
            $data = array(
                'main_item_id' => $main_item_id,
                'fga_id'=>$insert_id,
                'sub_item_id' => $rawm_id[$i],
                'fgb_quantity' => $r_quantity[$i],
                'unit_id'=>$sub_unit[$i],
                'godown_id'=>$r_godown[$i],
            );
            if ($id == 0) {
                $this->db->insert('finished_goods_sub', $data);

            } else {
                $this->db->where('fgb_id', $id);
                $this->db->update('finished_goods_sub', $data);
            }
        }
        $length = sizeof($r_quantity);
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0 and $id > 0) {
                $insert_id = $id;
                $qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $insert_id;
                $this->db->query($qry);
                //$this->restore_godown_transfer_stock($insert_id);
            }
            $this->stock_trans(0, $id[$i], $r_quantity[$i], $date, 'cr', $transfer, $insert_id, 0, 0, 0, $r_godown);
            $this->godown_stock_trans(0, $rawm_id[$i], $r_quantity[$i], 'cr', 'item', $r_godown);
        }
        $this->stock_trans(0, $id, $p_quantity, $date, 'dt', $transfer, $id, 0, 0, 0, $p_godown);      
        $this->godown_stock_trans(0, $product_id, $p_quantity, 'dt', 'item', $p_godown);          
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
