<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemsBarcode
 *
 * @author jijodileep
 */
class ItemsBarcode extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model', 'items');
    }
    public function generate($id){
        
    }
    //put your code here
}
