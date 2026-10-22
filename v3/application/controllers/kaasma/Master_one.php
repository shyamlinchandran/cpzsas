<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Masters_one
 *
 * @author Dimind
 */
class Master_one extends MY_Controller {
 

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    
    public function districts() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('kas_district');
            $crud->set_subject('Districts Master');
            $crud->columns('dst_name','state_id');
            $crud->unique_fields('dst_name');
            $crud->required_fields('dst_name');
            $crud->display_as('dst_name', 'District');
            $crud->display_as('dst_description', 'Description');
            $crud->display_as('state_id', 'State');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $crud->field_type('published', 'hidden', 'yes');
            $crud->set_relation('state_id', 'kas_state', 'StateName');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function cities() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('kas_cities');
            $crud->set_subject('Cities Master');
            $crud->columns('cty_name','district_id');
            $crud->unique_fields('cty_name');
            $crud->required_fields('cty_name');
            $crud->display_as('cty_name', 'City');
            $crud->display_as('cty_description', 'Description');
            $crud->display_as('district_id', 'District');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $crud->field_type('published', 'hidden', 'yes');
            $crud->set_relation('district_id', 'kas_district', 'dst_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function area() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ims_area');
            $crud->set_subject('Area');
            $crud->required_fields('area');
            $crud->columns('area', 'details');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function rating() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('kas_rating');
            $crud->set_subject('Rating');
            $crud->required_fields('rte_name');
            $crud->columns('rte_name');
            $crud->display_as('rte_name', 'Rating');
            $crud->display_as('rte_description', 'Description');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function slabs() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('kas_slabs');
            $crud->set_subject('Slabs Master');
            $crud->required_fields('slb_name');
            $crud->columns('slb_name');
            $crud->display_as('slb_name', 'Slab');
            $crud->display_as('slb_description', 'Description');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function company_types() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('kas_company_type');
            $crud->set_subject('Company Types');
            $crud->required_fields('cot_name');
            $crud->columns('cot_name');
            $crud->display_as('cot_name', 'Company-type');
            $crud->display_as('cot_description', 'Description');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function states() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('States');
            $crud->columns('StateName', 'code');
            $crud->set_table('kas_state');
            $crud->required_fields('StateName', 'code');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->field_type('CountryID', 'hidden',1);
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
}
