<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of blood
 *
 * @author jijodileep
 */
class Blood  extends MY_Controller {

    //put your code here
  public function __construct() {
      parent::__construct();
      $this->load->helper('url'); 
      
   }
 
     public function bloodgroup() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('blood');
            $crud->set_subject('Group');
            $crud->required_fields('Bldgrp');
            $crud->columns('Bldgrp','Description');
            $crud->display_as('Bldgrp', 'Blood Group');
            $crud->unique_fields('Bldgrp');  
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
