<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masters
 *
 * @author u43255
 */
class Masters extends MY_Controller {

    //put your code here
    public function items() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ta_item');
            $crud->set_subject('Items');
            $crud->display_as('tait_name', 'Name');
            $crud->display_as('tai_rate', 'Rate');
            $crud->display_as('tait_details', 'Details');
            $crud->required_fields('tait_name','tai_rate');
            $crud->columns('tait_name','tai_rate');
            $crud->unique_fields('tait_name');
            $crud->field_type('published', 'hidden', 'yes');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
