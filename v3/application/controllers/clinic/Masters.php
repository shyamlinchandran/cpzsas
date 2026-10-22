<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newmasters
 *
 * @author jijodileep
 */
class Masters extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
        $this->config->load('config');
    }
      public function Blood() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_bloodgroup');
            $crud->set_subject('Blood Groups');
            $crud->display_as('Blo_Name', 'Blood Group');
            $crud->required_fields('Blo_Name');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'gen_bgno_blood'));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_blood($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array(
        "no_gen_in_creation" => $gen_no
        );        
        $this->db->where('Blo_Id',$primary_key);
        $this->db->update('cli_bloodgroup',$data);
         
        return true;
    }
    public function Schedule_Time() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_timeschedule');
            $crud->set_subject('Time Schedules');
            $crud->display_as('schedule_time', 'Time Schedules');
            $crud->required_fields('Schedule_Time');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'gen_bgno_timesch'));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_timesch($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('TimeSch_Id',$primary_key);
        $this->db->update('cli_timeschedule',$data);
        return true;
    }
     public function potency() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_potency');
            $crud->set_subject('Potency');
            $crud->required_fields('Potency');
            $crud->columns('Potency','Details');
            $crud->unique_fields('Potency');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'gen_bgno_potency'));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_potency($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Pot_Id',$primary_key);
        $this->db->update('cli_potency',$data);
        return true;
    }
    public function Patients() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_patient');
            $crud->columns('Pat_Name', 'Pat_ID', 'Pat_phone');
            $crud->set_subject('Patients');
            $crud->required_fields('Pat_Name');
            $crud->display_as('Pat_Name', 'Name');
            $crud->display_as('Pat_Phone', 'Phone');
            $crud->display_as('Pat_Email', 'Email');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'gen_bgno_patient'));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_patient($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Pat_Id',$primary_key);
        $this->db->update('cli_patient',$data);
        return true;
    }
    public function Observations() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_observation');
            $crud->columns('Observation','details');
            $crud->set_subject('Observations');
            $crud->required_fields('Observation');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $crud->callback_after_insert(array($this, 'gen_bgno_observe'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_observe($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Obs_Id',$primary_key);
        $this->db->update('cli_observation',$data);
        return true;
    }
    public function Diagnosis() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_diagnose');
            $crud->columns('Diagnose','Details');
            $crud->set_subject('Diagnosis');
            $crud->required_fields('Diagnose');
            $crud->display_as('Diagnose', 'Diagnosis');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $crud->callback_after_insert(array($this, 'gen_bgno_diagnose'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_diagnose($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Dig_id',$primary_key);
        $this->db->update('cli_diagnose',$data);
        return true;
    }
    public function Doctors() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_doctor');
            $crud->columns('Doc_Name', 'Doc_Phone', 'Doc_Email');
            $crud->set_subject('Doctors');
            $crud->required_fields('Pat_Name');
            $crud->display_as('Doc_Name', 'Name');
            $crud->display_as('Doc_Phone', 'Phone');
            $crud->display_as('Doc_Email', 'Email');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $crud->callback_after_insert(array($this, 'gen_bgno_doctor'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_doctor($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Doc_Id',$primary_key);
        $this->db->update('cli_doctor',$data);
        return true;
    }
     public function medprocedures() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cli_procedures');
            $crud->columns('Pro_Name', 'Pro_Details');
            $crud->set_subject('Procedures');
            $crud->required_fields('Pro_Name');
            $crud->display_as('Pro_Name', 'Procedure');
            $crud->display_as('Pro_Details', 'Details');
            $server_tp  = $this->config->item('server_tp');
            $crud->field_type('sync_type', 'hidden', $server_tp);
            $crud->field_type('is_synced', 'hidden', 0);
            $crud->field_type('no_gen_in_creation', 'hidden', 0);
            $crud->field_type('sync_id', 'hidden', 0);
            $crud->field_type('updatedate','hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('sync_type', 'is_synced', 'no_gen_in_creation', 'sync_id', 'updatedate'));
            $crud->callback_after_insert(array($this, 'gen_bgno_procedure'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    function gen_bgno_procedure($post_array,$primary_key)
    {
        $gen_no = "S".$primary_key;
        $data = array("no_gen_in_creation" => $gen_no        );        
        $this->db->where('Pro_Id',$primary_key);
        $this->db->update('cli_procedures',$data);
        return true;
    }
}

?>