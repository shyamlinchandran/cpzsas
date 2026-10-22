<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Excel_data_insert_model extends DataTable {

    public function __construct() {
        parent::__construct();
    }

    public function Add_item($data_item) {
//$this->db->insert('item', $data_item);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function Add_item_ledger($data_item_ledger) {
        $this->db->insert('item_ledger', $data_item_ledger);

        /* $response = array(
          'valid' => false,
          'type' => 1,
          'message' => 'Saved Successfully.'
          );
          echo json_encode($response); */
    }

    public function Add_customer($data_customer) {
//$this->db->insert('suppliers', $data_customer);

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function savefromexcel() {
        $rowtotal = $this->input->post('counttotal');
        $columntotal = $this->input->post('countcol');
        $table_name = $this->input->post('table_name');
        $data = array();
        $ledger_data = array();
        $ledger_data['code'] = '0';

        for ($j = 1; $j <= $columntotal; $j++) {
            $table = $this->input->post('colselect_' . $j);
            if ($table != "0") {
                $check = 1;
                $field = $this->input->post('colselect_' . $j);
                $alias = $this->input->post('txtt_' . $j . '1');
                $setfield[$alias] = $field;
            }
        }
        $qry = "select * from new";
        $query = $this->db->query($qry);
        $query = $this->db->query($qry)->result_array();
        foreach ($query as $ms) {
            print_r(json_decode($ms['val']['Barcode'], JSON_UNESCAPED_UNICODE));
            

        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public
            function Add_cust_ledger($data_cust_ledger) {
//$this->db->insert('acc_ledgers', $data_cust_ledger);

        /* $response = array(
          'valid' => false,
          'type' => 1,
          'message' => 'Saved Successfully.'
          );
          echo json_encode($response); */
    }

}
 