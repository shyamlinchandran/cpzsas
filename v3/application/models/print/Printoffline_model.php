<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Print
 *
 * @author jijodileep
 */
class Printoffline_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function loaddb($key, $year) {
        $qry = "SELECT * FROM `company` as a INNER JOIN set_database as b on a.`com_id` =b.com_id WHERE `comkey` ='$key' and  b.year_id='$year'";
        $query = $this->db->query($qry)->row_array();
        $config['hostname'] = $query['sdb_server'];
        $config['username'] = $query['sdb_username'];
        $config['password'] = $query['sdb_password'];
        $config['database'] = $query['sdb_name'];
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $this->db->close();
        $this->load->database($config);
        $newdata['hostname'] = $query['sdb_server'];
        $newdata['username'] = $query['sdb_username'];
        $newdata['password'] = $query['sdb_password'];
        $newdata['database'] = $query['sdb_name'];
        $newdata['isexcute'] = 1;
        $this->load->vars($newdata);
    }

    public function getallbills() {
        $qry = "SELECT * FROM `sales_print` as a INNER JOIN  printers as b on a.printer_id =b.prn_id WHERE is_print=0 limit 1";
        $query = $this->db->query($qry)->result_array();
        echo json_encode($query);
    }

    public function update($id) {
        $qry = "Update `sales_print` set is_print=1 WHERE sp_id=$id";
        $this->db->query($qry);
    }

    public function getlanguage($id) {
        $qry = "select * from   set_printtype  where  id=" . $id;
        $query = $this->db->query($qry)->row_array();
        return $query;
    }

}
