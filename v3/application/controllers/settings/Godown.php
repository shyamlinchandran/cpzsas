<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of godown
 *
 * @author dimind
 */
class Godown extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CompanyGodown_model', 'godown');
    }
     public function godown() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('godown');
            $crud->set_subject('Godown');
            $crud->required_fields('godown_name', 'godown_contactno', 'company');
            $crud->display_as('godown_name', 'Godown');
            $crud->display_as('godown_address', 'Address');
            $crud->display_as('godown_contactno', 'Contact Number');
            $crud->display_as('godown_contact_person', 'Contact Person');
            $crud->display_as('company', 'Company');
            $crud->set_rules('godown_contactno', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $crud->field_type('published', 'hidden', 'yes');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
