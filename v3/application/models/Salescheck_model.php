<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salescheck_model
 *
 * @author dimind
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Salescheck_model extends DataTable {

    //put your code here
    function check_items($id) {
        $qry = "select b.name,b.barcode,a.* from sales_items as a inner join item as b on a.item_id= b.id where sales_id= $id and a.published='yes'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {
        $id = $this->input->post('id');
        $sales_item_id = $this->input->post('sale_items_id', TRUE);
        $item_id = $this->input->post('item_ids', TRUE);
        $quantity = $this->input->post('check_item_qtys', TRUE);
        $length = sizeof($item_id);
        $total_quantity = 0;
        for ($i = 0; $i < $length; $i++) {
            $total_quantity = number_format($total_quantity + $quantity[$i]);
            $data = array(
                'delivered_qty' => $quantity[$i],
            );
            $this->db->where('sal_itms_id', $sales_item_id[$i]);
            $this->db->update('sales_items', $data);
        }
        $qry = "select * from sales_items where delivered_qty<quantity and published='yes' and sales_id=" . $id;
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            $qry = "update  sales set sales_status='delivery_completed' where   sales_id=" . $id;
            $query = $this->db->query($qry);
        } else {
            $qry = "update  sales set sales_status='partialy_delivered' where   sales_id=" . $id;
            $query = $this->db->query($qry);
        }
        $response = array(
            'valid' => TRUE,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
