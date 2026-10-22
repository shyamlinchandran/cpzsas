<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Main_model
 *
 * @author Dimind
 */
require_once 'Base_model.php';

class Main_model extends Base_model {

    //put your code here
    public function getcompany() {
        $this->database($this->comid);
        $qry = "select * from company";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getdevice($dev_number) {
        $this->database($this->comid);
        $qry = "select * from set_device where dev_number='" . $dev_number . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    public function checkuser($email, $phone) {
        $this->database($this->comid);
        $qry = "select count(*) as cnt from suppliers as a  where a.phone='" . $phone . "' or a.email='" . $email . "'";
        $query = $this->db->query($qry);
        $res = $query->row_array();
        return $res['cnt'];
    }

    public function createuser($data) {
        $this->database($this->comid);
        $this->db->insert('suppliers', $data);
        $insert_id = $this->db->insert_id();
        $ledger_data = array(
            "name" => $data['name'],
            "code" => $data['phone'],
            "ref_id" => $insert_id,
            "ref_code" => 'cus',
            "is_default" => true,
            "acc_main_id" => 25,
            "openning_bal" => 0,
            "type" => 'Dr',
            "published" => 'yes'
        );
        $this->db->insert('acc_ledgers', $ledger_data);
        //$ledgers_code = $this->db->insert_id();
        //$this->ledgers_code(5, $ledgers_code);
    }

    public function login($username, $password) {
        $this->database($this->comid);
        $qry = "select count(*) as cnt  from suppliers where email='" . $username . "' OR phone='" . $username . "' and password ='" . $password . "'";
        $query = $this->db->query($qry);
        $out = $query->row_array();
        if ($out['cnt'] == 0) {
            $res['cnt'] = 0;
            return $res;
        } else {
            $qry = "select *  from suppliers where email='" . $username . "' OR phone='" . $username . "' and password ='" . $password . "'";
            $query = $this->db->query($qry);
            $res['cnt'] = $out['cnt'];
            $res['user'] = $query->row_array();
            return $res;
        }
    }

    public function allitems() {
        $this->database($this->comid);
        $qry = "SELECT * FROM `item_godown` as a INNER JOIN item as b on b.id=a.`item_id`";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function get_sliders() {
        $this->database($this->comid);
        $path = base_url().'uploads/sliders/';
        $qry = "SELECT *, CONCAT('".$path."',sli_image) as image_url FROM `sliders` WHERE published = 1";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function get_offers() {
        $this->database($this->comid);
        $path = base_url().'uploads/coupons/';
        $qry = "SELECT *, DATE_FORMAT(date_from,'%d-%m-%Y') as start_date, DATE_FORMAT(date_to,'%d-%m-%Y') as end_date, CONCAT('".$path."',cou_image) as image_url FROM `coupons` WHERE published = 1";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function subitems($category_id) {
        $this->database($this->comid);
        $qry = "SELECT id, name, srate, current_stock FROM item WHERE item_category_id=" . $category_id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function item_details($id) {
        $this->database($this->comid);
        $qry = "SELECT * FROM item as a  WHERE a.id=" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getitems($barcode) {
        $this->database($this->comid);
        $qry = "SELECT * FROM `item_godown` as a INNER JOIN item as b on b.id=a.`item_id` where barcode = '" . $barcode . "'  LIMIT 1";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getcategory() {
        $this->database($this->comid);
        $qry = "select * from item_category";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewitems($godownid, $date) {
        $this->database($this->comid);
        $qry = "select * from item_godown as a inner join item as b on b.id =a.item_id where godown_id = '" . $godownid . "' and b.updatedate > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function gettransferitems($godownid, $date) {
        $this->database($this->comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select t.item_id,t.qty,t.transfer_id,i.from_id,i.date from item_transfer_sub as t inner join item_transfer as i on t.transfer_id=i.id  where to_id ='" . $godownid . "' and i.updatedate > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getunits($dev_number) {
        $this->database($this->comid);
        $qry = "select * from units ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewunits($dev_number, $date) {
        $this->database($this->comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from units where `updatedate` > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getcustomer($dev_number) {
        $this->database($this->comid);
        $qry = "select * from suppliers ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function gettaxgst($dev_number) {
        $this->database($this->comid);
        $qry = "select * from taxgst ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewtaxgst($dev_number, $date) {
        $this->database($this->comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from taxgst where `updatedate` > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getledgers($type) {
        $this->database($this->comid);
        $qry = 'select * from ' . $type;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewledgers($type, $date) {
        $this->database($this->comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from " . $type . " where `updatedate`>'" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

}
