<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of church/masters
 *
 * @author dimind
 */
class Masters extends MY_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        }

    public function community() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_prayer_community');
            $crud->set_subject('Prayer community');
            $crud->required_fields('com_name');
            $crud->columns('com_name');
            $crud->unique_fields('com_name');
            $crud->display_as('com_name', 'Community');
            //$crud->field_type('published', 'hidden', 'yes');
            //$crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            //$crud->unset_columns(array('published','updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function wards() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_wards');
            $crud->set_subject('Wards');
            $crud->required_fields('wrd_name');
            $crud->columns('wrd_name');
            $crud->unique_fields('wrd_name');
            $crud->display_as('wrd_name', 'Ward');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function fathers() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_fathers');
            $crud->set_subject('Fathers');
            $crud->required_fields('ftr_name');
            $crud->columns('ftr_name');
            $crud->unique_fields('ftr_name');
            $crud->display_as('ftr_name', 'Father');
            $crud->display_as('ftr_details', 'Details');
            $crud->display_as('ftr_published', 'Active');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function village() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_village');
            $crud->set_subject('Village');
            $crud->required_fields('vlg_name');
            $crud->columns('vlg_name');
            $crud->unique_fields('vlg_name');
            $crud->display_as('vlg_name', 'Village');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

   public function district() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_district');
            $crud->set_subject('District');
            $crud->required_fields('dist_name');
            $crud->columns('dist_name');
            $crud->unique_fields('dist_name');
            $crud->display_as('dist_name', 'District');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function taluk() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_taluk');
            $crud->set_subject('Taluk');
            $crud->required_fields('tal_name');
            $crud->columns('tal_name');
            $crud->unique_fields('tal_name');
            $crud->display_as('tal_name', 'Taluk');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function diocese() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_diocese');
            $crud->set_subject('Diocese');
            $crud->required_fields('dio_name');
            $crud->columns('dio_name');
            $crud->unique_fields('dio_name');
            $crud->display_as('dio_name', 'Diocese');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function parish() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_parish');
            $crud->set_subject('Parish');
            $crud->required_fields('par_name');
            $crud->columns('par_name','par_isdefault');
            $crud->unique_fields('par_name');
            $crud->display_as('par_name', 'Parish');
            $crud->display_as('par_isdefault', 'Default Parish');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    public function locality() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_land');
            $crud->set_subject('Locality');
            $crud->required_fields('lnd_name');
            $crud->columns('lnd_name');
            $crud->unique_fields('lnd_name');
            $crud->display_as('lnd_name', 'Locality');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

   public function Relations() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('chr_relations');
            $crud->set_subject('Relations');
            $crud->required_fields('rel_name','rel_series');
            $crud->columns('rel_name','rel_series','rel_gender');
            $crud->unique_fields('rel_name','rel_series');
            $crud->display_as('rel_name', 'Relationship');
            $crud->display_as('rel_series', 'Rank');
            $crud->display_as('rel_gender', 'Gender');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
 

}


