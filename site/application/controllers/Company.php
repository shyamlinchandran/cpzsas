<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author jijodileep
 */
class Company extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $Product = $this->Common_model->getbyid('ozone_main.company_message', 'company_key', $id,'is_active',1);
        header('Content-Type: application/json');
        echo json_encode( $Product ); 
    }
}
