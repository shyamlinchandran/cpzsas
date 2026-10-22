<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax_model
 *
 * @author u43255
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once('dataTable.php');

class Common_model extends DataTable {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getpurchaseitems($search, $type) {

        $qry = "select CONCAT(a.name,' ',a.barcode) as label,a.id from item as a where name like('%$search%') or barcode like('%$search%') and item_type_id=2 limit 25";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getdistricts() {
        $qry = "select a.* from kas_district as a order by a.dst_name";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["dst_id"] . '">' . $row["dst_name"] . '</option>';
        }
        print_r($option);
    }
    function getusers() {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '">' . $row["user_name"] . '</option>';
        }
        print_r($option);
    }
    function getcusttype() {
        $qry = "select a.* from kas_customer_type as a order by cty_name";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cty_id"] . '">' . $row["cty_name"] . '</option>';
        }
        print_r($option);
    }
    function getcontactp() {
        $qry = "select a.* from kas_contacts as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cct_id"] . '">' . $row["cct_name"] . '</option>';
        }
        print_r($option);
    }
 function getslabs() {
        $qry = "select a.* from kas_slabs as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["slb_id"] . '">' . $row["slb_name"] . '</option>';
        }
        print_r($option);
    }


}
