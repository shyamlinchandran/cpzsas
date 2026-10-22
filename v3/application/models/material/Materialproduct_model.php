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
        $this->select = 'a.*,b.Id as userid, b.user_name as username,c.id as godownid,c.godown_name as godown';
        $this->table = '`finished_goods_main` as a INNER JOIN users as b on a.user_id=b.Id INNER JOIN ims_godown as c on a.from_godown=c.id';
        $this->column_order = array(null,'a.created_on','b.user_name','c.godown_name',null); //set column field database for datatable orderable   
        $this->column_search = array('b.user_name','c.godown_name'); //set column field database for datatable searchable 
        $this->order = array('a.fgm_id' => 'desc'); // default order 
    }

    function where($id) {
        $this->wherecondition = "where a.sett_id = '" . $id . "'";
    }
function mainitem($search) {
        $qry = "select name as label,id FROM item as a INNER JOIN bill_material_main as b on a.id=b.main_item_id where a.name like('%$search%') and a.material_type=1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
   function subitems($search) {
        $qry = "select name as label,id FROM item where name like('%$search%') and material_type!=1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function getsing($id) {
        $qry = 'SELECT a.*,b.*,c.id as itemid, c.name as itemname,d.id as godownid,d.godown_name as godown,e.id as unitid,e.name as unit FROM `finished_goods_main` as a INNER JOIN finished_goods as b on a.fgm_id=b.fgm_id INNER JOIN item as c on b.main_item_id=c.id LEFT JOIN ims_godown as d on b.godown_id=d.id LEFT JOIN units as e on b.unit_id=e.id WHERE a.fgm_id=' . $id;
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
        $qry = "delete from finished_goods_main where fgm_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from finished_goods where fgm_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from finished_goods_sub where fgm_id =" . $id;
        $this->db->query($qry);
    }

    public function save() {
        $id = $this->input->post('id');
        $user = $this->input->post('username');
        $date = $this->getDate($this->input->post('date'));
        $from_godown = $this->input->post('r_godow');
        $main_item_id = $this->input->post('pmainid',true); // if it is zero then we will add the item
        $main_quantity = $this->input->post('pqty',true); 
        $main_unit = $this->input->post('p_unitid',true); 
        $p_godown = $this->input->post('mgid',true);
        $transfer = 'production';
        $main_data = array(
            'user_id'=>$user,
            'created_on'=>$date,
            'from_godown'=>$from_godown,
            );
        if ($id == 0) {
                $this->db->insert('finished_goods_main', $main_data);
                $insert_main = $this->db->insert_id();
            } else {
                $this->db->where('fgm_id', $id);
                $this->db->update('finished_goods_main', $main_data);
                $insert_main = $id;
            }
        $length = sizeof($main_item_id);
        for ($i = 1; $i <= $length; $i++) {
            $item_data = array(
            'fgm_id'=>$insert_main,
            'main_item_id' => $main_item_id[$i],
            'fga_quantity' => $main_quantity[$i],
            'unit_id'=>$main_unit[$i],
            'godown_id'=>$p_godown[$i],
            );
            if ($id == 0) {
                $this->db->insert('finished_goods', $item_data);
                $insert_id = $this->db->insert_id();
            } else {
                $this->db->where('fga_id', $id);
                $this->db->update('finished_goods', $item_data);
                $insert_id = $id;
            }
            if ($i == 1 and $id > 0) {
                $insert_id = $id;
                $qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $insert_id;
                $this->db->query($qry);
                //$this->restore_godown_transfer_stock($insert_id);
            }
            //$this->stock_trans(0, $main_item_id[$i], $main_quantity[$i], $date, 'dt', $transfer, $insert_id, 0, 0, 0, $p_godown[$i]);      
            //$this->godown_stock_trans(0, $main_item_id[$i], $main_quantity[$i], 'dt', 'item', $p_godown[$i]);     
            $qry = 'select * from bill_material_sub where main_item_id='.$main_item_id[$i];
            $exe = $this->db->query($qry);
            $sub_items = $exe->result_array();
            foreach ($sub_items as $item) {
                    $rawm_id = $item['sub_item_id'];
                    $r_quantity = $item['bmb_quantity'];
                    $mul_qty = round($r_quantity, 2) * round($main_quantity[$i],2);
                    $sub_unit = $item['unit_id']; 
                    $r_godown =  $from_godown;     //$sub_items['sub_item_id'];
                    $data = array(
                    'main_item_id' => $main_item_id[$i],
                    'fgm_id'=>$insert_main,
                    'fga_id'=>$insert_id,
                    'sub_item_id' => $rawm_id,
                    'fgb_quantity' => $mul_qty,
                    'unit_id'=>$sub_unit,
                    'godown_id'=>$r_godown,
                    );
                //$this->stock_trans(0, $id, $mul_qty, $date, 'cr', $transfer, $insert_id, 0, 0, 0, $r_godown);
                //$this->godown_stock_trans(0, $rawm_id, $mul_qty, 'cr', 'item', $r_godown);
                if ($id == 0) {
                    $this->db->insert('finished_goods_sub', $data);

                } else {
                    $this->db->where('fgb_id', $id);
                    $this->db->update('finished_goods_sub', $data);
                }
            } 
        }            
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
