<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ledgers_model
 *
 * @author jijodileep
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('dataTable.php');

class Newmasters_model extends DataTable {

    function __construct() {
        parent::__construct('acc_ledgers');
    }

    function getautocomplete($q, $type) {

        $query = $this->db->query("select * from  acc_ledgers where name like ('%" . $q . "%') or code  like ('%" . $q . "%')");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['value'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['label'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['id'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }

    function create_ledger($data) {
        $this->db->insert('acc_ledgers', $data);
    }
 
}
 