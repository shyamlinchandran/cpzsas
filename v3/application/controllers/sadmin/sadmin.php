<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sadmin
 *
 * @author admin
 */
class sadmin extends MY_Controller {
     public function __construct() {
        parent::__construct();
        $this->load->model('sadmin_model', 'sadmin');
    }
	 public function usertype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_usr_type');
            $crud->set_subject('User Types');
            $crud->columns('utp_name', 'utp_status');
            $crud->required_fields('utp_name','utp_status');
            $crud->display_as('utp_name', 'UserType Name');
            $crud->display_as('utp_status', 'User Status');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
     public function companyversion() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_com_version');
            $crud->set_subject('Company Version');
            $crud->columns('cve_name', 'cve_upscript','cve_url','cve_verchdet');
            $crud->required_fields('cve_name');
			
			$crud->display_as('cve_name', 'Current Version');
            $crud->display_as('cve_upscript', 'Updated Script');
            $crud->display_as('cve_url', 'Version Url');
            $crud->display_as('cve_verchdet', 'Version Change Details');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
}
