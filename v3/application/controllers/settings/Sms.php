<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sms
 *
 * @author jijodileep
 */
class Sms extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
    }

    public function sms_types() {
        //put your code here
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('sms_type');
            $crud->set_subject('Sms Type');
            $crud->required_fields('name');
            $crud->columns('name');  
            $crud->unique_fields('name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function msg() {
        //put your code here
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('sms');
            $crud->set_subject('Messages');
            $crud->required_fields('sms','type');
            $crud->columns('sms','type');  
            $crud->unset_columns(array('published'));
            $crud->unique_fields('type');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

     public function sms_settings() {
        //put your code here
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('sms_settings');
            $crud->set_subject(label('SMS Settings', $this, $this->user));
            $crud->required_fields('username','api_password','sender','priority','is_default','url');
            $crud->columns('username','api_password','sender','priority','is_default');  
            $crud->unique_fields('url');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('updatedate'));  
            $columns = array('username','api_password','sender','priority','is_default','url');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
     public function api() {
        //put your code here
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('sms');
            $crud->set_subject('Messages');
            $crud->required_fields('sms','type');
            $crud->columns('sms','type');  
            $crud->unset_columns(array('published'));
            $crud->unique_fields('type');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
