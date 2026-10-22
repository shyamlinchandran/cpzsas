<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecoverSales_model extends CI_Model {

    public function find_or_create_customer($name,$tin,$phone) {
        $name = trim($name);
        $this->db->where('name', $name);
        $query = $this->db->get('suppliers');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        }
        
        // Using the same structure as Sales_model->insert_customerdetails
        $data = array(
            'name' => $name,
            'type' => 'cus',
            'phone' => $phone,
            'address_line1' => '',
            'tin' => $tin,
            'published' => 'yes'
        );
        $this->db->insert('suppliers', $data);
        $id = $this->db->insert_id();
        
        $ledger_data = array(
            "name" => $name,
            "code" => '',
            "ref_id" => $id,
            "ref_code" => 'cus',
            "is_default" => true,
            "acc_main_id" => 25,
            "openning_bal" => 0,
            "type" => 'Dr',
            "published" => 'yes'
        );
        $this->db->insert('acc_ledgers', $ledger_data);
        
        return $id;
    }

    public function find_or_create_item($name, $hsn_code = null) {
        $name = trim($name);
        $this->db->where('name', $name);
        $query = $this->db->get('item');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        }
        
        // Handle HSN
        $hsnid = 0;
        if (!empty($hsn_code)) {
            $this->db->where('hsncode', $hsn_code);
            $hsn_query = $this->db->get('hsncode');
            if ($hsn_query->num_rows() > 0) {
                $hsnid = $hsn_query->row()->hsnid;
            } else {
                $this->db->insert('hsncode', array('hsncode' => $hsn_code));
                $hsnid = $this->db->insert_id();
            }
        }
        
        // Insert item with basic defaults
        $data = array(
            'name' => $name,
            'hsncode' => $hsnid,
            'published' => 'yes',
            'item_category_id' => 1,
            'unit_id' => 1,
            'tax_id' => 0
        );
        $this->db->insert('item', $data);
        return $this->db->insert_id();
    }
}
