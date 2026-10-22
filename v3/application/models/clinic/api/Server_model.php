<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Server_model
 *
 * @author jijodileep
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'models/dataTable.php');

class Server_model extends DataTable {

    public function getallbooking() {
        $qry = "SELECT * FROM `cli_booking`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    public function  getfield($field){
        $strTemp = $field;
        $strTemp = trim($strTemp);

       if($strTemp !==  '') //Also tried this "if(strlen($strTemp) > 0)"
       {
          return $field;
        }

          return 0;        
    }
    public function getalldiagnosebyid($id) {
        $qry = "SELECT * FROM `cli_bok_diagnose`   WHERE Bok_Id =".$id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     public function getallobservationbyid($id) {
        $qry = "SELECT * FROM `cli_bok_observation`   WHERE Bok_Id= ".$id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }
      public function getallproceduresbyid($id) {
        $qry = "SELECT * FROM `cli_bookingprocedures`   WHERE Bok_Id= ".$id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }

     function updatesyncPatient($id) {
        $qry = "update  `cli_patient` set  is_synced=1   WHERE  Pat_Id =" . $id;
        $this->db->query($qry);
    }
     function updatesyncbooking($id) {
        $qry = "update  `cli_booking` set  is_synced=1   WHERE  Bok_Id =" . $id;
        $this->db->query($qry);
    }

     public function getallbloodgroup() {
        $qry = "SELECT * FROM `cli_bloodgroup`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     public function getallPatient() {
        $qry = "SELECT * FROM `cli_patient`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
       public function getallPatRelation($id) {
        $qry = "SELECT * FROM `cli_relationships`   WHERE  pat_id=".$id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }


    function updatesyncblood($id) {
        $qry = "update  `cli_bloodgroup` set  is_synced=1   WHERE  Blo_Id =" . $id;
        $this->db->query($qry);
    }
    function InsertRelation($data){
        $this->db->insert('cli_relationships', $data);
     
    }
    function insertpatient($data){
        $this->db->insert('cli_patient', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function updatepatient($id,$data){
        $this->db->where('Pat_Id', $id);
        $this->db->update('cli_patient', $data);
        $qry = "delete from cli_relationships where pat_id =" . $id;
        $this->db->query($qry);    }
    function insertblood($data) {
        $this->db->insert('cli_bloodgroup', $data);
    }
    function insertbooking($data) {
        $this->db->insert('cli_booking', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
   function updatebooking($id,$data) {
        $this->db->where('Bok_Id', $id);
        $this->db->update('cli_booking', $data);
        $qry = "delete from cli_bookingprocedures where Bok_Id =" . $id;
        $this->db->query($qry);
        $qry = "delete from cli_bok_observation where Bok_Id =" . $id;
        $this->db->query($qry);
        $qry = "delete from cli_bok_diagnose where Bok_Id =" . $id;
        $this->db->query($qry);
    }
    function InsertObservation($data){
        $this->db->insert('cli_bok_observation', $data);
    }
    function InsertProcedures($data){
        $this->db->insert('cli_bookingprocedures', $data);
    }
    function InsertDiagnose($data){
        $this->db->insert('cli_bok_diagnose', $data);
    }

    public function getallcategory(){
        $qry = "SELECT * FROM `cli_category`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesynccategory($id) {
        $qry = "update  `cli_category` set  is_synced=1   WHERE  cat_id =" . $id;
        $this->db->query($qry);
    }
     function Insertcategory($data){
        $this->db->insert('cli_category', $data);
    }
    public function getallclinic(){
        $qry = "SELECT * FROM cli_clinic   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncclinic($id) {
        $qry = "update  `cli_clinic` set  is_synced=1   WHERE  Cli_id =" . $id;
        $this->db->query($qry);
    }
     function Insertclinic($data){
        $this->db->insert('cli_clinic', $data);
    }
    public function getalldiagnose(){
        $qry = "SELECT * FROM `cli_diagnose`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncdiagnose($id) {
        $qry = "update  `cli_diagnose` set  is_synced=1   WHERE  Dig_id =" . $id;
        $this->db->query($qry);
    }
     function Insertcli_diagnose($data){
        $this->db->insert('cli_diagnose', $data);
    }
     public function getalldoctor(){
        $qry = "SELECT * FROM `cli_doctor`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncdoctor($id) {
        $qry = "update  `cli_doctor` set  is_synced=1   WHERE  Doc_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertdoctor($data){
        $this->db->insert('cli_doctor', $data);
    }
      public function getallobservation(){
        $qry = "SELECT * FROM `cli_observation`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncobservation($id) {
        $qry = "update  `cli_observation` set  is_synced=1   WHERE  Obs_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertcli_observation($data){
        $this->db->insert('cli_observation', $data);
    }
      public function getallpotency(){
        $qry = "SELECT * FROM `cli_potency`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncpotency($id) {
        $qry = "update  `cli_potency` set  is_synced=1   WHERE  Pot_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertpotency($data){
        $this->db->insert('cli_potency', $data);
    }
    public function getallprocedures(){
        $qry = "SELECT * FROM `cli_procedures`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncprocedures($id) {
        $qry = "update  `cli_procedures` set  is_synced=1   WHERE  Pro_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertcli_procedures($data){
        $this->db->insert('cli_procedures', $data);
    }

    public function getalltimeschedule(){
        $qry = "SELECT * FROM `cli_timeschedule`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncschedule($id) {
        $qry = "update  `cli_timeschedule` set  is_synced=1   WHERE  TimeSch_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertschedule($data){
        $this->db->insert('cli_timeschedule', $data);
    }

      public function getallintervell(){
        $qry = "SELECT * FROM `cli_time_intervell`   WHERE is_synced=0 and sync_type ='server'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function updatesyncintervell($id) {
        $qry = "update  `cli_time_intervell` set  is_synced=1   WHERE  Ti_Id =" . $id;
        $this->db->query($qry);
    }
     function Insertintervell($data){
        $this->db->insert('cli_time_intervell', $data);
    }
    //put your code here
}
