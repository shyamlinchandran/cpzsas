<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coexp_model
 * company licence expiry
 *
 * @author Dimind
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Coexp_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.name as company';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = '`company_licence` as a LEFT JOIN company as b on a.company_id=b.com_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'company_id', 'mac_address', 'generated_key', 'end_date'); //set column field database for datatable orderable   
        $this->column_search = array('company_id', 'mac_address', 'end_date'); //set column field database for datatable searchable 
        $this->order = array('a.company_id' => 'desc'); // default order 
    }

    function where() {
        $this->wherecondition = "";
    }

    function getsing($id) {
        $qry = 'SELECT * FROM `company_licence` as a WHERE a.col_id=' . $id;
        $result = $this->db->query($qry);

        echo json_encode($result->row_array());
    }

    function getcompanies() {
        $qry = "select a.* from company as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["com_id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function save() {
        $id = $this->input->post('id');
        $company_id = $this->input->post('company_id'); // if it is zero then we will add the item
        $mac_address = $this->input->post('mac_address');
        $end_date = $this->getDate($this->input->post('end_date'));
        $mac1 = str_replace("-", "", $mac_address) . "/".$end_date;
        $key_no = $this->encryption->encrypt($mac1);
        $data = array(
            'company_id' => $company_id,
            'mac_address' => $mac_address,
            'generated_key' => $key_no,
            'end_date' => $end_date,
        );
        if ($id == 0) {

            $this->db->insert('company_licence', $data);
            $insert_id = $this->db->insert_id();
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
        } else {
            $this->db->where('col_id', $id);
            $this->db->update('company_licence', $data);
            $insert_id = $id;
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        }
        echo json_encode($response);
    }

}
