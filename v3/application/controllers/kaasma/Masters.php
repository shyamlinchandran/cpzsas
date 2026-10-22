<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Masters
 *
 * @author admin
 */
class Masters extends MY_Controller {

//    public $fitem = 4;


    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function department() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('dpt_name');
            $crud->set_table('kas_department');
            $crud->set_subject('Departments Master');
            $crud->display_as('dpt_name', 'Name');
            $crud->display_as('dpt_description', 'Description');
            //$crud->unset_back_to_list();
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('dpt_name');
            //$crud->set_relation('company_id', 'company', 'name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function designations() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('dsg_name');
            $crud->set_table('kas_designation');
            $crud->set_subject('Designations Master');
            $crud->display_as('dsg_name', 'Name');
            $crud->display_as('dsg_description', 'Description');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('dsg_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function categories() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('cat_name','published');
            $crud->set_table('kas_category');
            $crud->set_subject('Category Master');
            $crud->display_as('cat_name', 'Name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('cat_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function customer_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('cty_name','published');
            $crud->set_table('kas_customer_type');
            $crud->set_subject('Customer Type');
            $crud->display_as('cty_name', 'Name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('cty_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function contact_person() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('cct_name','cct_phone','cct_status');
            $crud->set_table('kas_contacts');
            $crud->set_subject('Contact Persons');
            $crud->display_as('cct_name', 'Name');
            $crud->display_as('cct_phone', 'Phone');
            $crud->display_as('cct_status', 'Status');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('cct_name');
            $crud->set_rules('cct_phone', 'cct_phone', 'numeric');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function enquiry_status() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('est_name','est_series','published');
            $crud->set_table('kas_enq_status');
            $crud->set_subject('Enquiry Status');
            $crud->display_as('est_name', 'Name');
            $crud->display_as('est_series', 'Rank');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->required_fields('est_name','est_series');
            $crud->display_as('est_description', 'Description');
            $crud->unique_fields('est_name');
            //$crud->set_relation('company_id', 'company', 'name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function Users() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('user_name', 'user_address', 'user_mobile', 'user_phone', 'user_email', 'username', 'user_password');
            $crud->set_table('users');
            $crud->set_subject('Users');
            $crud->unique_fields('user_name', 'username');
            $crud->required_fields('user_name', 'user_mobile', 'user_email', 'user_password', 'username');
            $crud->where('is_hide', 0);
            $crud->display_as('user_name', 'Name');
            $crud->display_as('user_address', 'Address');
            $crud->display_as('user_mobile', 'Mobile');
            $crud->display_as('user_phone', 'Phone');
            $crud->display_as('user_email', 'Email');
            $crud->display_as('username', 'Username');
            $crud->display_as('department_id', 'Department');
            $crud->display_as('designation_id', 'Designation');
            $crud->display_as('user_password', 'Password');
            $crud->display_as('user_type', 'User Type');
            $crud->set_rules('user_mobile', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->set_rules('pin_code', 'PIN Code', 'max_length[6]|integer');
            $crud->set_rules('user_email', 'Email', 'trim|valid_email');
            $crud->field_type('is_hide', 'hidden', 0);
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->unset_back_to_list();
            $crud->set_relation('state', 'state', 'StateName');
            $crud->set_relation('district', 'kas_district', 'dst_name');
            $crud->set_relation('city', 'kas_cities', 'cty_name');
            $crud->set_relation('user_type', 'user_type', 'name');
            $crud->set_relation('department_id', 'kas_department', 'dpt_name');
            $crud->set_relation('designation_id', 'kas_designation', 'dsg_name');
            //$state = $crud->getState(); 
            //$crud->set_relation('company', 'company', 'name');
            $crud->field_type('company', 'hidden', 1);
            $output = $crud->render();
      /*      if($state == 'add')
           {
                $js='<script>$(\'select[name="district"] option[value="3"]\').attr("selected", "selected");</script>';
                $output->output .= $js; 
           }*/
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
