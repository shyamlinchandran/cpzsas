<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales_model
 *
 * @author u43255
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Booking_model extends DataTable {

    public function __construct() {
        parent::__construct();
     
    }
  function InsertBooking($data) {
        $this->db->insert('cli_booking', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function UpdateSales($data, $id, $or_type) {
        $this->db->where('sync_id', $data['sync_id']);
        $this->db->update('cli_booking', $data);
        $qry = "delete from cli_bok_diagnose WHERE `Bok_Id`=" . $data['sync_id'];
        $this->db->query($qry);
        $qry = "delete from cli_bok_observation WHERE `Bok_Id`=" . $data['sync_id'];
        $this->db->query($qry);   
         $qry = "delete from cli_bookingprocedures WHERE `Bok_Id`=" . $data['sync_id'];
        $this->db->query($qry);
    }

     function InsertProcedures($data) {
        $this->db->insert('cli_bookingprocedures', $data);
        $proc_id = $this->db->insert_id();
    }

     function InsertObservation($data) {
        $this->db->insert('cli_bok_observation', $data);
        $observation_id = $this->db->insert_id();
    }

     function InsertDiagnose($data) {
        $this->db->insert('cli_bok_diagnose', $data);
        $diagnose = $this->db->insert_id();
    }
}