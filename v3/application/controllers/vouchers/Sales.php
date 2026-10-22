<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author DELL
 */
class Sales  extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }
    
       public function sales($type, $id = 0, $copy = 'no') {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['copy'] = $copy;
        $data['type'] = $type;
        $data['viewtype'] = $type;
        if ($copy == "view") {
            $data['viewtype'] = $copy;
        }
        $zeroindex = $this->sales->zeroindex();
        $settings = $this->sales->getCompanySettings();
        $data['zeroindex'] = $zeroindex;
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('vouchers/sales_create', $data);
    }

}
