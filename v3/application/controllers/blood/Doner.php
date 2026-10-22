<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Doner
 *
 * @author dimind
 */
class Doner extends MY_Controller {

    //public $fitem = 4;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

  public function doner() {
        try {
          //  $type = 3;
           
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('donners');
            $crud->set_subject('Donners');
             $crud->set_relation('Bldgrp', 'blood','Bldgrp'); 
            $crud->display_as('Bldgrp', 'Blood Group');
            $crud->display_as('Mob', 'Mobile Number');
            $crud->required_fields('Name','Email','Phon','Address','Mob','Bldgrp','Age');
            $crud->columns('Name','Age','Mob','Address','Bldgrp');
            $crud->unique_fields('Mob');  
            $crud->set_rules('Email', 'Email', 'trim|required|valid_email');
            $crud->set_rules('Phon', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->set_rules('Mob', 'Mobile Number', 'required|min_length[10]|max_length[12]|integer');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
   
