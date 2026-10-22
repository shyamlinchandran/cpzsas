<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Thaitems
 *
 * @author jijodileep
 */
class Thaitems extends MY_Controller {

    var $cus = 1;

    public function __construct() {
        parent::__construct();
        $this->load->model('ledgers_model', 'ledger');
    }

    public function items() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tha_items');
            $crud->set_subject('Items');
            $crud->required_fields('name', 'rate');
            $crud->unique_fields('name');
            $crud->set_rules('rate', 'Rate', 'required|integer');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
     public function size() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tha_size');
            $crud->set_subject('Size');
            $crud->required_fields('name', 'messurement');
            $crud->unique_fields('name'); 
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    //put your code here
    public function customers() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tha_customer');
            $crud->set_subject('Customers');
            $crud->required_fields('name', 'phone', 'address');
            $crud->columns('name', 'phone', 'address');
            $crud->unique_fields('phone');
            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->callback_after_insert(array($this, 'create_ledger'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger($post_array, $primary_key) {
        $this->createled($post_array['name'], $post_array['phone'], $primary_key, 'cus', $this->cus);
        return TRUE;
    }

//created ledger
    public function createled($name, $code, $primary_key, $ref_code, $acc_main_id) {
        $data = array(
            "name" => $name,
            "code" => $code,
            "ref_id" => $primary_key,
            "ref_code" => $ref_code,
            "is_default" => true,
            "acc_main_id" => $acc_main_id,
            "openning_bal" => 0,
            "published" => 'yes'
        );
        $this->ledger->create_ledger($data);
    }

}
